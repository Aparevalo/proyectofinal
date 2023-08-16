<?php 
class Profesor {
    private $nombre;
    private $carrera;
    private $materia;

    public function __construct($nombre, $carrera, $materia) {
        $this->nombre = $nombre;
        $this->carrera = $carrera;
        $this->materia = $materia;
    }

    public function getDocument() {
        $document = [
            'nombre' => $this->nombre,
            'carrera' => $this->carrera,
            'materia' => $this->materia
        ];
        return $document;
    }
}

?>