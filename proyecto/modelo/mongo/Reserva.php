<?php
class Reserva {
    private $aula;
    private $profesor;
    private $dia;
    private $horaInicio;


    public function __construct($aula, $profesor, $fecha ,$horaInicio,$horaFin) {
        $this->aula = $aula;
        $this->profesor = $profesor;
        $this->fecha = $fecha;
        $this->horaInicio = $horaInicio;
        $this->horaFin = $horaFin;
        
    }

    public function getDocument() {
        $document = [
            'aula' => $this->aula,
            'profesor' => $this->profesor,
            'fecha' => $this->fecha,
            'horaInicio' => $this->horaInicio,
            'horaFin' => $this->horaFin
        ];
        return $document;
    }
}


?>