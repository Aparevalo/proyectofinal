<?php 
include_once('modelo/mongo/mongo.php');


function leer_fichero($fichero){
$linkes = file($fichero.'.txt', FILE_IGNORE_NEW_LINES);

return $linkes;
}

function escribir_ficherow($link,$fichero){
$file = fopen($fichero.".txt", "w");

fwrite($file, $link . PHP_EOL);

fclose($file);
}

function escribir_ficheroa($link,$fichero){
$file = fopen($fichero.".txt", "a");

fwrite($file, $link . PHP_EOL);

fclose($file);
}
function escribir_fichero_array_w($linkes,$fichero){
$file = fopen($fichero.".txt", "w");
foreach($linkes as $links){
fwrite($file, $links . PHP_EOL);
}
fclose($file);
}

function escribir_fichero_array_a($linkes,$fichero){
    $file = fopen($fichero.".txt", "w");
    foreach($linkes as $links){
    fwrite($file, $links . PHP_EOL);
    }
    fclose($file);
    }



function eliminarfichero($fichero){
$arch = fopen ($fichero.".txt", "w");
fwrite($arch, "");
fclose($arch);
}


function analizar_entrada($texto) {
    
    $palabras_clave = ['disponibilidad aula','disponible aula','agregar aula','agregame aula','servicio aula','reserva aula','reservarme aula','reservar aula','asignar aula','asigname aula',
    'agendar aula','agendame aula','solicitud aula','solicitar aula','solicitame aula','asegura aula','asegurar aula','asegurame aula','registrar aula','registre aula ','registrame aula',
    'programes aula','programar aula','prográmame aula','ingreses aula','ingresar aula','ingresame aula','turno aula','turname aula','turnes aula',
    'apartar aula','apartame aula','añadir aula','añadame aula','disponibilidad laboratorio','disponible laboratorio','agregar laboratorio','agregame laboratorio','reserva laboratorio',
    'reservarme laboratorio','asignar laboratorio','asigname laboratorio','agendar laboratorio','agendame laboratorio','solicitud laboratorio','solicitar laboratorio',
    'solicitame laboratorio','asegurar laboratorio','asegurar laboratorio','asegurame laboratorio','registrar laboratorio','registrame laboratorio','programar laboratorio','prográmame laboratorio',
    'ingresar laboratorio','ingresame laboratorio','suscribir laboratorio','suscribirme laboratorio','turno laboratorio','turname laboratorio',
    'apartar laboratorio','apartame laboratorio','añadir laboratorio','añadame laboratorio','mostrar aula ingeniero','muestres aula ingeniero','muestrame aula ingeniero','buscar aula docente','busque aula docente',
    'buscame aula docente','indicar aula profesor','indiques aula profesor','indicame aula profesor','mostrar aula docente','muestres aula docente','muestrame aula docente','mostrar aula profesor','muestres aula profesor',
    'muestrame aula profesor','buscar aula ingeniero','busque aula ingeniero','buscame aula ingeniero','buscar aula profesor','busque aula profesor','buscame aula profesor','indicar aula ingeniero','indiques aula ingeniero',
    'indicame aula ingeniero','indicar aula docente','indiques aula docente','indicame aula docente','mostrar laboratorio ingeniero','muestres laboratorio ingeniero','muestrame laboratorio ingeniero','buscar laboratorio docente',
    'busque laboratorio docente','buscame laboratorio docente','indicar laboratorio profesor','indiques laboratorio profesor','indicame laboratorio profesor','mostrar laboratorio docente','muestres laboratorio docente','muestrame laboratorio docente',
    'mostrar laboratorio profesor','muestres laboratorio profesor','muestrame laboratorio profesor','buscar laboratorio ingeniero','busque laboratorio ingeniero','buscame laboratorio ingeniero','buscar laboratorio profesor','busque laboratorio profesor',
    'buscame laboratorio profesor','indicar laboratorio ingeniero','indiques laboratorio ingeniero','indicame laboratorio ingeniero','indicar laboratorio docente','indiques laboratorio docente','indicame laboratorio docente'];
    $dias_semana = ['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo'];
    $entrada_palabras = explode(" ", strtolower($texto));
    $palabra_clave_encontrada = null;
    
    foreach ($palabras_clave as $palabra) {
        $palabras_clave_arr = explode(" ", strtolower($palabra));
        $interseccion = array_intersect($entrada_palabras, $palabras_clave_arr);
        if (count($interseccion) == count($palabras_clave_arr)) {
            $palabra_clave_encontrada = $palabra;
            break;
        }
    }
  
    
    if (isset($palabra_clave_encontrada)) {
        $dia = null;
        foreach ($dias_semana as $dia_semana) {
            if (stripos($texto, $dia_semana) !== false) {
                $dia = $dia_semana;
                break;
            }else{
                $dia = null;
            }
        }

        $utilsProfesor = new Utils('localhost', 27017, 'Proyecto', 'Profesor');
        $nombres_clave = $utilsProfesor->getAllNames();
        foreach ($nombres_clave as $nombre) {
            $nombre_array=explode(" ", strtolower($nombre));
            foreach ($nombre_array as $nombre_a){
                if (stripos($texto, $nombre_a) !== false) {
                    $profesor = $nombre;
                    break;
                }else{
                    $profesor=null;
                }
            }
            
        }
       
        preg_match('/aula\s+(\d+)/i', $texto, $matches);
        $aula_numero = isset($matches[1]) ? $matches[1] : null;
        $repeticiones=substr_count($texto, $aula_numero);
        if($repeticiones==1){
            $texto = str_replace($aula_numero, '', $texto);
        }else{
            $texto=replaceFirstOccurrence($aula_numero, '',$texto);
        }
        
        $numeros=contarNumeros($texto);
        preg_match('/\b((\d{1,2}:\d{2})|\d{1,2})\b/', $texto, $matches);
        $hora = isset($matches[0]) ? $matches[0]:null;
        if($numeros==1){
            $hora=verificarHora($texto,$hora);
        }else if($numeros==2){
            $hora_inicial=verificarHora($texto,$hora);
            $texto = str_replace($hora, '', $texto);
            $hora=$hora_inicial;
            preg_match('/\b((\d{1,2}:\d{2})|\d{1,2})\b/', $texto, $matches);
            $hora_final = isset($matches[0]) ? $matches[0]:null;
        }else if($numeros>2){
            $hora_inicial=verificarHora($texto,$hora);
            $texto = str_replace($hora, '', $texto);
            $hora=$hora_inicial;
            preg_match('/\b((\d{1,2}:\d{2})|\d{1,2})\b/', $texto, $matches);
            $hora_final = isset($matches[0]) ? $matches[0]:null;
            $texto = str_replace($hora, '', $texto);
            $fecha=obtenerFechaFromString($texto);
        }else{
            $fecha=obtenerFechaFromString($texto);
        }
        return [
            'palabra_clave' => $palabra_clave_encontrada,
            'aula_numero' => $aula_numero,
            'hora' => $hora,
            'dia'=> $dia,
            'profesor'=> $profesor,
            'hora_final'=>$hora_final,
            'fecha'=>$fecha
        ];
    }

    return null;
}

function array_contiene_null($array) {
    foreach ($array as $elemento) {
        if (is_string($elemento) && strpos($elemento, 'null') !== false) {
            return true;
        }
    }
    return false;
}

function array_null_key($array) {
    foreach ($array as $key => $elemento) {
        if (is_string($elemento) && strpos($elemento, 'null') !== false) {
            return $key;
        }
    }
    return false;
}

function replaceFirstOccurrence($search, $replace, $subject) {
    return implode($replace, explode($search, $subject, 2));
}

function contarNumeros($str) {
    $count = 0;
    $length = strlen($str);

    for ($i = 0; $i < $length; $i++) {
        if (ctype_digit($str[$i])) {
            $count++;
        }
    }

    return $count;
}

function quitarAcentos($cadena) {
    $acentos = array(
        'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
        'Á' => 'a', 'É' => 'e', 'Í' => 'i', 'Ó' => 'o', 'Ú' => 'u',
    );
    
    $cadenaSinAcentos = strtr($cadena, $acentos);
    return strtolower($cadenaSinAcentos);
}

function obtenerDiaSemana($fecha) {

    $convertedDate = date("Y-m-d", strtotime($fecha));
    $dayOfWeekNumber = date("w", strtotime($convertedDate));
    $daysOfWeek = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
    $dayOfWeekName = $daysOfWeek[$dayOfWeekNumber];
    return $dayOfWeekName;
}

function obtenerFechaFromString($texto) {
    $fecha = null;
    $pattern = '/\b(?<day>\d{1,2})\/(?<month>\d{1,2})\b/';

    if (preg_match($pattern, $texto, $matches)) {
        $day = $matches['day'];
        $month = $matches['month'];

        $currentYear = date('Y');
        $fecha = date("$currentYear-$month-$day");

        if (strtotime($fecha) === false) {
            return null; // No se pudo crear una fecha válida
        }
    }

    return $fecha;
}


function verificarFormatoHora($cadena) {
    $patron = '/^([01]\d|2[0-3]):([0-5]\d)$/';
    return preg_match($patron, $cadena) === 1;
}

function verificarHora($texto,$hora){
    if ($hora) {
        foreach ($texto as $palabra) {
            if (is_numeric($palabra)||verificarFormatoHora($palabra)) {
                $hora=$palabra;
                    break;
                }
            }
        
        if (verificarFormatoHora($hora)==false||strpos($hora, ':') === false) {
            if (stripos($texto, 'mañana') !== false) {    
                if (strpos($hora, ':') === false) {
                    $hora .= ':00';
                }
            } elseif (stripos($texto, 'tarde') !== false || stripos($texto, 'noche') !== false) {
               
                if (strpos($hora, ':') === false) {
                    $hora = ($hora + 12) . ':00';
                } else {
                    $hora_partes = explode(':', $hora);
                    $hora = ($hora_partes[0] + 12) . ':' . $hora_partes[1];
                }
            } elseif (stripos($texto, 'am') !== false) {
               
                if (strpos($hora, ':') === false) {
                    $hora = ($hora + 12) . ':00';
                } else {
                    $hora_partes = explode(':', $hora);
                    $hora = ($hora_partes[0] + 12) . ':' . $hora_partes[1];
                }
            } elseif (stripos($texto, 'pm') !== false) {
        
                if (strpos($hora, ':') === false) {
                    $hora .= ':00';
                }
            }
        }
    }
    return $hora;
}


function verificarAula($lineas,$aula_clave,$utilsAula, $utilsAsignacion){
    if ($lineas[2] == null && $lineas[3]==null) {
        $aulaId = $utilsAula->getObjectIdByName($aula_clave);
        if ($aulaId) {
            $assignments = $utilsAsignacion->findAssignmentsByParameter('aula', $aulaId);
            foreach ($assignments as $assignment) {
                echo "El aula esta disponible el dia:" . $assignment->dia . "<br>En las siguientes franjas por hora <br>";
                $timeSlots = generateTimeSlots($assignment->horaInicio, $assignment->horaFin);
                foreach ($timeSlots as $timeSlot) {
                    echo $timeSlot . PHP_EOL;
                }            
            }
        }
    } else if($lineas[2] == null && $lineas[3]){ 
        $aulaId = $utilsAula->getObjectIdByName($aula_clave);
        if ($aulaId) {
            $parameters = [
                'aula' => $aulaId,
                'dia' => $lineas[3]
            ];
            $assignments = findAssignmentsByParameters($parameters);
            foreach ($assignments as $assignment) {
                echo "El aula esta disponible el dia:" . $assignment->dia . "<br>En las siguientes franjas por hora <br>";
                $timeSlots = generateTimeSlots($assignment->horaInicio, $assignment->horaFin);
                foreach ($timeSlots as $timeSlot) {
                    echo $timeSlot . PHP_EOL;
                }
            }    
        }
    }else if($lineas[2] && $lineas[3]) {
        
        $aulaId = $utilsAula->getObjectIdByName($aula_clave);
        
        $parameters = [
            'aula' => $aulaId,
            'dia' => $lineas[3]
        ];
        
        $assignments = $utilsAsignacion->findAssignmentsByParameters($parameters);
        
        if ($aulaId) {
            if (!empty($assignments)) {
                foreach ($assignments as $assignment) {
                    $timeSlots = generateTimeSlots($assignment->horaInicio, $assignment->horaFin);
                    if (in_array($lineas[2], $timeSlots)) {
                        echo "El aula sí está disponible en ese horario <br>";
                    } else {
                        $timeSlotsAvailable = generateAvailableTimeSlots($assignment->horaInicio, $assignment->horaFin);
                        echo "El aula no está disponible en la siguiente franja horaria <br>";
                        foreach ($timeSlotsAvailable as $timeSlotAvailable) {
                            echo $timeSlotAvailable . PHP_EOL;
                        }
                    } 
                }
            } else {
                echo "El aula sí está disponible en ese horario <br>";
            }
        } else {
            echo "El aula no fue encontrada.";
        }
    }else if($lineas[2] && $lineas[3]==null){
        
        $aulaId = $utilsAula->getObjectIdByName($aula_clave);
        
        $parameters = [
            'aula' => $aulaId,
            'dia' => date('l') 
        ];
        
        $assignments = $utilsAsignacion->findAssignmentsByParameters($parameters);
        
        if ($aulaId) {
            if (!empty($assignments)) {
                foreach ($assignments as $assignment) {
                    $timeSlots = generateTimeSlots($assignment->horaInicio, $assignment->horaFin);
                    if (in_array($lineas[2], $timeSlots)) {
                        echo "El aula sí está disponible el dia de hoy en ese horario <br>";
                    } else {
                        $timeSlotsAvailable = generateAvailableTimeSlots($assignment->horaInicio, $assignment->horaFin);
                        echo "El aula no está disponible el dia de hoy en la siguiente franja horaria <br>";
                        foreach ($timeSlotsAvailable as $timeSlotAvailable) {
                            echo $timeSlotAvailable . PHP_EOL;
                        }
                    } 
                }
            } else {
                echo "El aula si esta disponible el dia de hoy en ese horario";
            }
        } else {
            echo "El aula no fue encontrada.";
        }
    }
}
    
function verificarAulaReserva($lineas,$aula_clave,$utilsAula,$utilsAsignacion,$utilsReserva){
    if ($lineas[2] == null && $lineas[3]==null) {
        $aulaId = $utilsAula->getObjectIdByName($aula_clave);
        if ($aulaId) {
            $assignmentsAsignacion = $utilsAsignacion->findAssignmentsByParameter('aula', $aulaId);
            $assignmentsReserva = $utilsReserva->findAssignmentsByParameter('aula', $aulaId);
            $assignmentsWithDayOfWeek = [];
            foreach ($assignmentsReserva as $assignment) {
                
                $fechaDocumento = $assignment->fecha;
                $diaSemana = obtenerDiaSemana($fechaDocumento);
                unset($assignment->fecha);
                $assignment->dia = $diaSemana;
                $assignmentsWithDayOfWeek[] = $assignment;
            }
            
            $assignments = array_merge($assignmentsAsignacion, $assignmentsWithDayOfWeek);
            foreach ($assignments as $assignment) {
                echo "El aula esta disponible el dia:" . $assignment->dia . "<br>En las siguientes franjas por hora <br>";
                $timeSlots = generateTimeSlots($assignment->horaInicio, $assignment->horaFin);
                foreach ($timeSlots as $timeSlot) {
                    echo $timeSlot . PHP_EOL;
                }            
            }
        }else {
            echo "El aula no fue encontrada.";
        }
    } else if($lineas[2] == null && $lineas[3]){ 
        $aulaId = $utilsAula->getObjectIdByName($aula_clave);
        if ($aulaId) {
            $parameters = [
                'aula' => $aulaId,
                'dia' => $lineas[3]
            ];
            $assignmentsAsignacion = $utilsAsignacion->findAssignmentsByParameters($parameters);
            $assignmentsReserva = $utilsReserva->findAssignmentsByParameters($parameters);
            $assignmentsWithDayOfWeek = [];
            foreach ($assignmentsReserva as $assignment) {
                
                $fechaDocumento = $assignment->fecha;
                $diaSemana = obtenerDiaSemana($fechaDocumento);
                unset($assignment->fecha);
                $assignment->dia = $diaSemana;
                $assignmentsWithDayOfWeek[] = $assignment;
            }
            
            $assignments = array_merge($assignmentsAsignacion, $assignmentsWithDayOfWeek);
            $assignments = array_merge($assignmentsAsignacion, $assignmentsReserva);
            foreach ($assignments as $assignment) {
                echo "El aula esta disponible el dia:" . $assignment->dia . "<br>En las siguientes franjas por hora <br>";
                $timeSlots = generateTimeSlots($assignment->horaInicio, $assignment->horaFin);
                foreach ($timeSlots as $timeSlot) {
                    echo $timeSlot . PHP_EOL;
                }
            }    
        }else {
            echo "El aula no fue encontrada.";
        }
    }else if($lineas[2] && $lineas[3]) {
        
        $aulaId = $utilsAula->getObjectIdByName($aula_clave);
        
        $parameters = [
            'aula' => $aulaId,
            'dia' => $lineas[3]
        ];
        $assignmentsAsignacion = $utilsAsignacion->findAssignmentsByParameters($parameters);
        $assignmentsReserva = $utilsReserva->findAssignmentsByParameters($parameters);
        $assignmentsWithDayOfWeek = [];
        foreach ($assignmentsReserva as $assignment) {
            
            $fechaDocumento = $assignment->fecha;
            $diaSemana = obtenerDiaSemana($fechaDocumento);
            unset($assignment->fecha);
            $assignment->dia = $diaSemana;
            $assignmentsWithDayOfWeek[] = $assignment;
        }
        
        $assignments = array_merge($assignmentsAsignacion, $assignmentsWithDayOfWeek);
        $assignments = array_merge($assignmentsAsignacion, $assignmentsReserva);
        if ($aulaId) {
            if (!empty($assignments)) {
                foreach ($assignments as $assignment) {
                    $timeSlots = generateTimeSlots($assignment->horaInicio, $assignment->horaFin);
                    if (in_array($lineas[2], $timeSlots)) {
                        echo "El aula sí está disponible en ese horario <br>";
                    } else {
                        $timeSlotsAvailable = generateAvailableTimeSlots($assignment->horaInicio, $assignment->horaFin);
                        echo "El aula no está disponible en la siguiente franja horaria <br>";
                        foreach ($timeSlotsAvailable as $timeSlotAvailable) {
                            echo $timeSlotAvailable . PHP_EOL;
                        }
                    } 
                }
            } else {
                echo "El aula esta disponible en ese horario";
            }
        }else {
            echo "El aula no fue encontrada.";
        }
    }else if($lineas[2] && $lineas[3]==null){
        $parameters = [
            'aula' => $aulaId,
            'dia' => date('l') 
        ];
        
        $assignmentsAsignacion = $utilsAsignacion->findAssignmentsByParameters($parameters);
        $assignmentsReserva = $utilsReserva->findAssignmentsByParameters($parameters);
        $assignmentsWithDayOfWeek = [];
        foreach ($assignmentsReserva as $assignment) {
            
            $fechaDocumento = $assignment->fecha;
            $diaSemana = obtenerDiaSemana($fechaDocumento);
            unset($assignment->fecha);
            $assignment->dia = $diaSemana;
            $assignmentsWithDayOfWeek[] = $assignment;
        }
        
        $assignments = array_merge($assignmentsAsignacion, $assignmentsWithDayOfWeek);
        $assignments = array_merge($assignmentsAsignacion, $assignmentsReserva);
        
        if ($aulaId) {
            if (!empty($assignments)) {
                foreach ($assignments as $assignment) {
                    $timeSlots = generateTimeSlots($assignment->horaInicio, $assignment->horaFin);
                    if (in_array($lineas[2], $timeSlots)) {
                        echo "El aula sí está disponible el dia de hoy en ese horario <br>";
                    } else {
                        $timeSlotsAvailable = generateAvailableTimeSlots($assignment->horaInicio, $assignment->horaFin);
                        echo "El aula no está disponible el dia de hoy en la siguiente franja horaria <br>";
                        foreach ($timeSlotsAvailable as $timeSlotAvailable) {
                            echo $timeSlotAvailable . PHP_EOL;
                        }
                    } 
                }
            } else {
                echo "El aula esta disponible el dia de hoy en ese horario";
            }
        } else {
            echo "El aula no fue encontrada.";
        }
    }
}


function asignarAula($lineas, $aula_clave, $profesor_clave, $dia_clave, $hora_clave, $final_clave, $utilsAula, $utilsProfesor, $utilsAsignacion) {
    if ($lineas[1] && $lineas[4]) {
        $aulaId = $utilsAula->getObjectIdByName($aula_clave);
        $profesorId = $utilsProfesor->getObjectIdByName($profesor_clave);
        
        if ($aulaId && $profesorId) {
            if ($dia_clave && $hora_clave && $final_clave) {
                $asignacion = new Asignacion($aulaId,$profesorId, $dia_clave, $hora_clave, $final_clave);
                $asignacionDocumento = $asignacion->getDocument();
                $utilsAsignacion->insertDocument($asignacionDocumento);
                echo "Aula asignada correctamente";
            } else {
                echo "No se ha especificado el dia, la hora de inicio o la hora final";
            }
        } else {
            echo "Profesor o aula no se han especificado";
        }
    }
}

function reservarAula($lineas, $aula_clave, $profesor_clave, $fecha_clave, $hora_clave, $utilsAula, $utilsProfesor, $utilsReserva) {
    if ($aula_clave&&$profesor_clave) {
        $aulaId = $utilsAula->getObjectIdByName($aula_clave);
        $profesorId = $utilsProfesor->getObjectIdByName($profesor_clave);
        if ($aulaId && $profesorId) {
            if ($fecha_clave && $hora_clave) {
                $horaInicialStr = $hora_clave;
                $horaInicialMinutos = intval(substr($horaInicialStr, 0, 2)) * 60 + intval(substr($horaInicialStr, 3, 2));
                $horaFinalMinutos = $horaInicialMinutos + 60;
                $horaFinal = sprintf("%02d:%02d", intdiv($horaFinalMinutos, 60), $horaFinalMinutos % 60);
                $reserva = new Reserva($aulaId,$profesorId, $fecha_clave, $hora_clave, $horaFinal);
                $reservaDocumento = $reserva->getDocument();
                $utilsReserva->insertDocument($reservaDocumento);
                echo "Aula reservada correctamente";
            } else {
                echo "No se ha especificado la hora o la fecha de reserva";
            }
        } else {
            echo "Profesor o aula no se han especificado";
        }
    }
}


function agregarAula($lineas, $utilsAula) {
    if ($lineas[1]) {
        $aulaId = $utilsAula->getObjectIdByName($aula_clave);
        if ($aulaId) {    
            echo "Aula ya se encuentra agregada";
        } else {
            $aula = new Aula($lineas[1]);
            $aulaDocumento = $aula->getDocument();
            $utilsAula->insertDocument($aulaDocumento);
            echo "Aula agregada correctamente";
        }
    }
}





?>