<?php
include_once('includes/load.php');
include_once('modelo/mongo/mongo.php');

$user = current_user();
header('Content-Type: text/html; charset=UTF-8');
libxml_use_internal_errors(true);
error_reporting(0);

$cadena = $_POST['text'];
$cadena = strtolower($cadena);
$cadena = limpiarTexto($cadena);

$matriz = array(
    'disponible' => array ('disponibilidad aula', 'disponible aula','disponibilidad laboratorio','disponible laboratorio'),
    'no disponible' => array('no disponible aula','ocupada aula'),
    'agregar' => array ('agregar aula', 'agregame aula','agregues aula','agregar laboratorio','agregame laboratorio','agregue laboratorio'),
    'reservar' => array ('reservar aula','reserva aula', 'reservame aula','reserves aula','reservar laboratorio','reservame laboratorio','reserves laboratorio'),
    'asignar' => array ('asigname aula', 'asignar aula','asigmes aula','asignar laboratorio','asigname laboratorio','asignes laboratorio'),
    'agregarAula' => array('agregar aula', 'agregame aula'),
    'agendar' => array ('agendame aula', 'agendar aula','agendes aula','agendar laboratorio','agendame laboratorio','agendes laboratororio'),
    'solicitar' => array ('solicitud aula', 'solicitame aula','solicitar aular','solicitar laboratorio','solicitame laboratorio','solicites laboratorio'),
    'asegurar' => array ( 'asegurame aula','asegurar aula','asegures aula','asegurar laboratorio','asegurame labotorio','asegures laboratorio'),
    'registrar' =>array ('registrame aula', 'registrar aula','registre aula','registrar laboratorio','registrame laboratorio','registre laboratorio'),
    'programar' =>array ('programame aula','programes aula','programar aula','programar laboratorio','programes laboratorio','programes laboratorio'),
    'ingresar' =>array ('ingresar aula','ingresame aula','ingreses aula','ingresar laboratorio','ingresame laboratorio','ingreses laboratorio'),
    'suscribir' => array ('suscribir aula','suscribame aula','suscribas aula','suscribir laboratorio','suscribame laboratorio','suscribas laboratorio'),
    'turno' => array ('turname aula','turnes aula','turno de aula','turno laboratorio','turname laboratorio','turnes laboratorio'),
    'apartar' => array ('apartame aula','apartar aula','apartes aula','apartar laboratorio','apartame laboratorio','apartes laboratorio'),
    'añadir' => array ( 'añadame aula','añadir aula', 'añades aula','añadir laboratorio','añadame laboratorio','añades laboratorio')
);

$fichero = 'files/datos_completos';
$lineas = leer_fichero($fichero);
if (empty($lineas)) {
    $resultado = analizar_entrada($cadena);
    escribir_fichero_array_w($resultado, $fichero);
    echo "Click en enviar para continuar";
}

$palabra_clave = strtolower($lineas[0]);
$aula_clave = strtolower($lineas[1]);
$hora_clave = strtolower($lineas[2]);
$dia_clave = strtolower($lineas[3]);
$profesor_clave = $lineas[4];
$final_clave = $lineas[5];
$fecha_clave = $lineas[6];

$utilsAula = new Utils('localhost', 27017, 'Proyecto', 'Aula');
$utilsAsignacion = new Utils('localhost', 27017, 'Proyecto', 'Asignacion');
$utilsReserva = new Utils('localhost', 27017, 'Proyecto', 'Reserva');
$utilsProfesor = new Utils('localhost', 27017, 'Proyecto', 'Profesor');


foreach ($matriz as $grupo => $palabras) {
    if (in_array($palabra_clave, $palabras)) {
        $encontrado = true;
        if ($encontrado) {
            if ($grupo == 'disponible') {
                if($user['user_level'] === '1'){
                verificarAula($lineas, $aula_clave, $utilsAula, $utilsAsignacion);
                eliminarfichero($fichero);
                }else{
                verificarAula($lineas, $aula_clave, $utilsAula, $utilsAsignacion);
                eliminarfichero($fichero);
                }
            }else if ($grupo == 'asignar') {
                if($user['user_level'] === '1'){
                asignarAula($lineas, $aula_clave, $profesor_clave, $dia_clave, $hora_clave, $final_clave, $utilsAula, $utilsProfesor, $utilsAsignacion);
                eliminarfichero($fichero);
                }else{
                    echo "Perdon pero no tiene los permisos para que yo pueda realizar tal acción";
                    eliminarfichero($fichero);
                } 
               
            }else if($grupo== 'agregarAula'){
                if($user['user_level'] === '1'){
                    agregarAula($lineas,$utilsAula);
                    eliminarfichero($fichero);
                    }else{
                        echo "Perdon pero no tiene los permisos para que yo pueda realizar tal acción";
                        eliminarfichero($fichero);
                    }
            }else if($grupo == 'reservar'){
                if($user['user_level'] === '1'){
                    reservarAula($lineas, $aula_clave, $profesor_clave, $fecha_clave, $hora_clave, $utilsAula, $utilsProfesor, $utilsReserva);
                    eliminarfichero($fichero);
                }else{
                    reservarAula($lineas, $aula_clave, $user['name'], $fecha_clave, $hora_clave, $utilsAula, $utilsProfesor, $utilsReserva);
                    eliminarfichero($fichero);
                }
                    
            }
        }else{echo "Resultado: No disponible" . PHP_EOL;} 
    }
}


?>
