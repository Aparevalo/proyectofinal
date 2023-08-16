<?
class Modelo {
    protected function generarConsultaSelect($columnas, $tabla) {
        $select = "SELECT ";

        if (is_array($columnas)) {
            $select .= implode(", ", $columnas);
        } else {
            $select .= $columnas;
        }

        $from = " FROM " . $tabla;

        $consulta = $select . $from;
        return $consulta;
    }
}
?>