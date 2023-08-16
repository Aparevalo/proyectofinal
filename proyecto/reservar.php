<?php
$page_title = 'Agregar grupo';
require_once('includes/load.php');
include_once('modelo/mongo/mongo.php');
page_require_level(2);  
$user = current_user();

?>
<?php
if(isset($_POST['reserve'])){
   
    $roomNumber = $_POST['room-number'];
    $reservationDate = $_POST['reservation-date'];
    $startTime = $_POST['start-time'];
    $horaFinal = date('H:i', strtotime('+1 hour', strtotime($startTime)));            
    
    $diaReserva=obtenerDiaSemana($reservationDate);
    $utilsAula = new Utils('localhost', 27017, 'Proyecto', 'Aula');
    $utilsAsignacion = new Utils('localhost', 27017, 'Proyecto', 'Asignacion');
    $utilsReserva = new Utils('localhost', 27017, 'Proyecto', 'Reserva');
    $utilsProfesor = new Utils('localhost', 27017, 'Proyecto', 'Profesor');
    $aulaId = $utilsAula->getObjectIdByName($roomNumber);
    $profesorId = $utilsProfesor->getObjectIdByName($user['name']);
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
            if(quitarAcentos($assignment->dia)==quitarAcentos($diaReserva)){
                if($horai==$startTime){
                    echo '<script language="javascript">alert("El aula esta reservada a esas horas");</script>';
                }else{
                    $reserva = new Reserva($aulaId,$profesorId, $reservationDate, $startTime, $horaFinal);
                    $reservaDocumento = $reserva->getDocument();
                    $utilsReserva->insertDocument($reservaDocumento);
                    echo '<script language="javascript">alert("El aula fue reservada sin problemas");</script>';

                }
            }
                            
            }
        }else {
            echo "El aula no fue encontrada.";
        }
                

}
?>

<?php include_once('layouts/header.php'); ?>
<?php include_once('layouts/admin_client_reserva_form.php'); ?>
<?php include_once('layouts/footer.php'); ?>