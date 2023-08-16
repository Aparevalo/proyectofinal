<?php
$page_title = 'Mostrar aulas';
require_once('includes/load.php');
include_once('modelo/mongo/mongo.php');
page_require_level(2);
$utilsPrueba = new Utils('localhost', 27017, 'Proyecto', 'Prueba');
$documents = $utilsPrueba->getPruebaDocuments();

?>

<?php include_once('layouts/header.php'); ?>



<div class="container mt-4">
  <div class="row">
    <?php $days = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado']; ?>
    <?php foreach ($days as $day) { ?>
      <div class="col-md-4">
        <div class="card">
          <div class="card-header" style="background-color: #f8f9fa;">
            <?php echo $day; ?>
          </div>
          <div class="card-body">
            <?php foreach ($documents as $document) { ?>
              <?php foreach ($document->$day as $course) { ?>
                <div class="curso-card mb-3" style="background-color: <?php echo ($course->Color); ?>">
                  <h5 class="card-title"><?php echo $course->Curso; ?></h5>
                  <p class="card-text"><?php echo $course->Horario; ?></p>
                </div>
              <?php } ?>
            <?php } ?>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>