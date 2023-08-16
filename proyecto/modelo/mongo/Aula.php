<?php
class Aula {
    private $nombre;
    

    public function __construct($nombre) {
        $this->nombre = $nombre;
        
    }

    public function getDocument() {
        $document = [
            'nombre' => $this->nombre,
        ];
        return $document;
    }
}


?>