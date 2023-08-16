<?php
$page_title = 'Mostrar aulas';
require_once('includes/load.php');
include_once('modelo/mongo/mongo.php');
page_require_level(2);
$utilsReserva = new Utils('localhost', 27017, 'Proyecto', 'Reserva');
$utilsAula = new Utils('localhost', 27017, 'Proyecto', 'Aula');
$utilsProfesor = new Utils('localhost', 27017, 'Proyecto', 'Profesor');
$documents = $utilsReserva->getAllDocuments();

?>

<?php include_once('layouts/header.php'); ?>



<div class="container">
    <h2>Registros de Reserva</h2>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    
                    <th>Aula</th>
                    <th>Profesor</th>
                    <th>Fecha</th>
                    <th>Hora de Inicio</th>
                    <th>Hora de Fin</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($documents as $document): ?>
                <tr>
                    <td><?= $utilsAula->getNameById($document->aula)?></td>
                    <td><?= $utilsProfesor->getNameById($document->profesor) ?></td>
                    <td><?= $document->fecha ?></td>
                    <td><?= $document->horaInicio ?></td>
                    <td><?= $document->horaFin?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include_once('layouts/footer.php'); ?>