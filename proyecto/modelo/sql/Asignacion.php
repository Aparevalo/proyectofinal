<?
class Asignacion {
    private $aula;
    private $profesor;
    private $dia;
    private $horaInicio;
    private $horaFin;

    public function __construct($aula, $profesor, $dia, $horaInicio, $horaFin) {
        $this->aula = $aula;
        $this->profesor = $profesor;
        $this->dia = $dia;
        $this->horaInicio = $horaInicio;
        $this->horaFin = $horaFin;
    }

    public function insertSqlQuery() {
        $query = "INSERT INTO asignaciones (aula, profesor, dia, horaInicio, horaFin) VALUES ";
        $query .= "('{$this->aula}', '{$this->profesor}', '{$this->dia}', '{$this->horaInicio}', '{$this->horaFin}')";

        return $query;
    }
}
?>