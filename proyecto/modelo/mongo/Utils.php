<?php
class Utils {
    private $mongo;
    private $database;
    private $collectionName;

    public function __construct($host, $port, $database, $collectionName) {
        $this->mongo = new MongoDB\Driver\Manager("mongodb://$host:$port");
        $this->database = $database;
        $this->collectionName = $collectionName;
    }

    public function getAllDocuments() {
        $filter = [];
        $query = new MongoDB\Driver\Query($filter);
        $namespace = "$this->database.$this->collectionName";
        $cursor = $this->mongo->executeQuery($namespace, $query);

        $documents = [];
        foreach ($cursor as $document) {
            $documents[] = $document;
        }

        return $documents;
    }

    public function searchDocumentsByKeyValue($key, $value) {
        $allDocuments = $this->getAllDocuments();

        $matchingDocuments = [];
        foreach ($allDocuments as $document) {
            if (isset($document->$key) && $document->$key === $value) {
                $matchingDocuments[] = $document;
            }
        }

        return $matchingDocuments;
    }

    public function getNameById($id) {
        $filter = ['_id' => new MongoDB\BSON\ObjectID($id)];
        $query = new MongoDB\Driver\Query($filter);
        $namespace = "$this->database.$this->collectionName";
        $cursor = $this->mongo->executeQuery($namespace, $query);
    
        foreach ($cursor as $document) {
            return $document->nombre;
        }
    
        return null;
    }

    public function getObjectIdByName($name) {
        $filter = ['nombre' => $name];
        $query = new MongoDB\Driver\Query($filter);
        $namespace = "$this->database.$this->collectionName";
        $cursor = $this->mongo->executeQuery($namespace, $query);

        foreach ($cursor as $document) {
            return $document->_id;
        }

        return null;
    }

    public function getAllNames() {
        $query = new MongoDB\Driver\Query([]);
        $namespace = "$this->database.$this->collectionName";
        $cursor = $this->mongo->executeQuery($namespace, $query);
    
        $names = [];
        foreach ($cursor as $document) {
            $names[] = $document->nombre;
        }
    
        return $names;
    }

    public function findAssignmentsByIdParameter($field, $value) {
        $filter = [$field => new MongoDB\BSON\ObjectId($value),];
        $query = new MongoDB\Driver\Query($filter);
        $namespace = "$this->database.$this->collectionName";
        $cursor = $this->mongo->executeQuery($namespace, $query);

        $assignments = [];
        foreach ($cursor as $document) {
            $assignments[] = $document;
        }

        return $assignments;
    }

    public function findAssignmentsByParameter($field, $value) {
        $filter = [$field => $value];
        $query = new MongoDB\Driver\Query($filter);
        $namespace = "$this->database.$this->collectionName";
        $cursor = $this->mongo->executeQuery($namespace, $query);

        $assignments = [];
        foreach ($cursor as $document) {
            $assignments[] = $document;
        }

        return $assignments;
    }

    function limpiarTexto($texto) {
        $textoLimpio = preg_replace('/[.,;\'"`]/u', '', $texto); // Elimina puntos, comas, comillas
        $textoLimpio = str_replace(['á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú'], ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'], $textoLimpio); 
        
        return $textoLimpio;
    }
    public function findAssignmentsByParameters($params) {
        $filter = $params;
        $query = new MongoDB\Driver\Query($filter);
        $namespace = "$this->database.$this->collectionName";
        $cursor = $this->mongo->executeQuery($namespace, $query);
    
        $assignments = [];
        foreach ($cursor as $document) {
            $assignments[] = $document;
        }
    
        return $assignments;
    }
    
  public function insertDocument($document) {
        $bulkWrite = new MongoDB\Driver\BulkWrite();
        $bulkWrite->insert($document);

        $namespace = "$this->database.$this->collectionName";
        $this->mongo->executeBulkWrite($namespace, $bulkWrite);
    }

    public function getPruebaDocuments() {
        $filter = [];
        $options = []; // You can add options if needed, like sorting or limiting results
        $query = new MongoDB\Driver\Query($filter, $options);
    
        $namespace = "$this->database.$this->collectionName";
        $cursor = $this->mongo->executeQuery($namespace, $query);
    
        $documents = [];
        foreach ($cursor as $document) {
            $documents[] = $document;
        }
    
        return $documents;
    }
}