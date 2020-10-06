<?php
/**
 *Se llama el modelo conexion
 */
require_once "app/models/conexion.php";
/**
 * programaformación_controller
 * 
 * Se usa para el funcionamiento del CRUD de la clase programaformacion
 */
class programaformacion_controller {

    /**
     * @construct
     */
    public function __construct() {}
    /**
     * @petiionesAjax
     *
     * Función que será llamada desde js para traer, agregar, eliminar o editar los datos del instructor
     * @param type|String parametro que recibirá el string del caso que se ejecutará
     * @return type retorna los datos si es 'mostrar', 'obtenerdatos' y en los demás solo true o false
     */
    public static function Main($option, $array = []) {
        $login = new programaformacion_controller();
        switch ($option) {
        case 0:
            $result = $login->consult();
            break;

        case 1:
            $result = $login->insert($array);
            break;

        case 2:
            $result = $login->delete($array);
            break;

        case 3:
            $result = $login->consultUpdate($array);
            break;

        case 4:
            $result = $login->update($array);
            break;
        }
        return $result;
    }
    /**
     * @consult - función que hace la consulta de toda la información del instructor
     * @return retorna un array de datos
     */
    public function consult() {
        $conexion = Conexion::connection();
        $sql      = "SELECT * FROM programa_formacion";
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
        $sql      = "SELECT * FROM programa_formacion WHERE Nombre_Programa = '$array[0]' ";
        $result   = $conexion->query($sql);
        $filas    = $result->num_rows;
        if ($filas === 0) {
            $stmt = $conexion->prepare("INSERT INTO programa_formacion (Nombre_Programa, Descripcion_Programa)VALUES(?,?)");
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
        $sql      = "UPDATE programa_formacion SET Nombre_Programa = ?,  Descripcion_Programa = ? WHERE id_Programa  = ? ";
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
        $sql      = "DELETE FROM programa_formacion WHERE id_Programa = ? ";
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
        $sql      = "SELECT * FROM programa_formacion WHERE id_Programa = $array[0]";
        $result   = $conexion->query($sql);
        return $result;
    }
}

?>