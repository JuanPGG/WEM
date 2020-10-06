<?php
/**
 *Se llama el modelo conexion
 */
require_once "app/models/conexion.php";
/**
 * ambiente_controller - Clase en la que se harán las diferentes funciones de CRUD para los ambientes
 */
class ambiente_controller {

    /**
     * @construct
     */
    public function __construct() {}

    /**
     * @Main - función que llama los diferentes métodos de la clase
     * @param type $option recibe un parametro tipo int para hacer el switch
     * @param type|array $array recibe un array con los diferentes datos que se utilizran
     * @return type retorna la variable result que retorna true, false o un array de datos
     */
    public static function Main($option, $array = []) {
        $login = new ambiente_controller();
        // Según la opción que llegue, hará la función en el switch
        switch ($option) {
        case 0:
            $result = $login->consult(); // Se llama la funcion que trae los datos
            break;

        case 1:
            $result = $login->insert($array); // Se llama la funcion que inserta los datos
            break;

        case 2:
            $result = $login->delete($array); // Se llama la funcion que elimina el dato segun el id
            break;

        case 3:
            $result = $login->consultUpdate($array); // Se llama la funcion que trae los datos según el id
            break;

        case 4:
            $result = $login->update($array); // Se llama la funcion actualiza los datos
            break;
        }
        return $result;
    }
    /**
     * @consult - función que hace la consulta de toda la información del ambiente
     * @return retorna un array de datos
     */
    public function consult() {
        $conexion = Conexion::connection();
        $sql      = "SELECT * from ambiente";
        return $conexion->query($sql);
    }
    /**
     * @insert - función que hace una consulta para verificar que si exista o no ese registro
     *           en caso negativo hará un inserción de datos
     * @param type $array recibe un array de datos que se utlizaran para consultar o para insertar
     * @return type retorna un true o un false
     */
    public function insert($array) {
        $conexion = Conexion::connection();
        $sql      = "SELECT * from ambiente WHERE Nombre_Ambiente = '$array[0]'"; // Se busca si existe
        $result   = $conexion->query($sql);
        $filas    = $result->num_rows;
        if ($filas === 0) {
            // En caso de que no exista se hace la consulta a continuación para insertar
            $stmt = $conexion->prepare("INSERT INTO ambiente (Nombre_Ambiente, Descripcion_Ambiente)VALUES(?,?)");
            $stmt->bind_param("ss", $array[0], $array[1]);
            $stmt->execute();
        }
    }
    /**
     * @update - función que realiza una actualización de datos según el id
     * @param type $array recibe un array con los datos que se actualizaran
     * @return type retorna un true o un false
     */
    public function update($array) {
        $conexion = Conexion::connection();
        $sql      = "UPDATE ambiente SET Nombre_Ambiente = ?, Descripcion_Ambiente = ? WHERE id_Ambiente = ? ";
        $stmt     = $conexion->prepare($sql);
        $stmt->bind_param("ssi", $array[0], $array[1], $array[2]);
        $stmt->execute();
    }
    /**
     * @delete - función para eliminar una fila de datos según el id
     * @param type $array recibe un array con el id que se utilizara en la consulta
     * @return type retorna un true o un false
     */
    public function delete($array) {
        $conexion = Conexion::connection();
        $sql      = "DELETE FROM ambiente WHERE id_Ambiente = ? ";
        $stmt     = $conexion->prepare($sql);
        $stmt->bind_param("i", $array[0]);
        $stmt->execute();
    }
    /**
     * @consultUpdate - función que consulta los datos según el id
     * @param type $array recibe un array con el id que se utilizará en la consulta
     * @return type retorna un array de datos
     */
    public function consultUpdate($array) {
        $conexion = Conexion::connection();
        $sql      = "SELECT * FROM ambiente WHERE id_Ambiente = $array[0]";
        $result   = $conexion->query($sql);
        return $result; // Se retornan los datos encontrados
    }
}

?>