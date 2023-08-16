<?php
class Aula {
    private $nombre;
    

    public function __construct($nombre) {
        $this->nombre = $nombre;
        
    }
public function insertSqlQuery() {
        $query = "INSERT INTO Aula (nombre) VALUES ";
        $query .= "('{$this->aula}')";

        return $query;
    }
}
?>