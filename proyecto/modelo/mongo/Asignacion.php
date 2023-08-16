<?php 
class Asignacion {
    private $aula;
    private $profesor;
    private $dia;
    private $horaInicio;
    private $horaFin;

    public function __construct($aula, $profesor, $dia, $horaInicio, $horaFin) {
        $this->aula = $aula;
        $this->profesor = $profesor;
        $this->dia=$dia;
        $this->horaInicio = $horaInicio;
        $this->horaFin = $horaFin;
    }

    public function getDocument() {
        $document = [
            'aula' => $this->aula,
            'profesor' => $this->profesor,
            'dia'=> $this->dia,
            'horaInicio' => $this->horaInicio,
            'horaFin' => $this->horaFin
        ];
        return $document;
    }

    
}


?>