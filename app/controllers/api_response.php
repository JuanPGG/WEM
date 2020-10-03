<?php

/**
 * api_response - clase que contiene un método en el que se hará una conversión de datos
 */
class api_response {
    /**
     * @construct
     * @return type
     */
    public function __construct() {}
    /**
     * @mostrar - función que convierte los datos en JSON
     * @param type $result recibe los datos de una consulta sql
     * @param type $array datos que se utilizaran para almacenar los datos del result
     * @return type retorna los datos en un JSON
     */
    public static function mostrar($result, $array) {
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            // ciclo para recorrer los datos según la consulta
            $fila = array();
            for ($i = 0; $i < count($array); $i++) { // ciclo para recorrer el array del controlador
                $fila[$array[$i]] = $row[$i]; // se allmacena cada fila en el array definido según la                                         posición del array del controlador
            }
            array_push($json, $fila); // Se almacena el array fila en un nuevo array
        }

        $jsonstring = json_encode($json); // Se convierte en json y posteriormente se retorna
        return $jsonstring;
    }
}

?>