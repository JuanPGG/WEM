<?php
/**
 *Se llama el modelo conexion
 */
require_once "app/models/conexion.php";
/**
 * trimestre_controller
 * 
 * Se usa para el funcionamiento del CRUD de la clase trimestre
 */
class trimestre_controller {
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
        $login = new trimestre_controller();
        switch ($option) {
        case 0:
            $result = $login->consult($array);
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
        case 5:
            $result = $login->fechas();
            break;
        case 6:
            $result = $login->informacion($array);
            break;
        }
        return $result;
    }
     /**
     * @consult - función que hace la consulta de toda la información del trimestre
     * @return retorna un array de datos
     */
    public function consult($array) {
        $conexion = Conexion::conectar();
        $sql      = "SELECT * FROM trimestre WHERE id_Ficha = '$array[0]'";
        return $conexion->query($sql);
    }
    /**
     * @insert - función que hace una consulta para verificar que si exista o no ese registro
     *           en caso negativo hará un inserción de datos
     * @param type $array recibe un array de datos que se utlizaran para consultar o para insertar
     * @return type retorna un true o un false
     */
    public function insert($array) {
        $conexion = Conexion::conectar();
        $sql      = "SELECT * FROM trimestre WHERE Trimestre = '$array[0]' AND id_Ficha = '$array[3]' ";
        $result   = $conexion->query($sql);
        $filas    = $result->num_rows;
        if ($filas === 0) {
            $stmt = $conexion->prepare("INSERT INTO trimestre (Trimestre, Fecha_Inicio, Fecha_Fin, id_Ficha)VALUES(?,?,?,?)");
            $stmt->bind_param("sssi", $array[0], $array[1], $array[2], $array[3]);
            $stmt->execute();
        }
    }
     /**
     * @update - función que realiza una actualización de datos según el id
     * @param type $array recibe un array con los datos que se actualizaran
     * @return type retorna un true o un false
     */
    public function update($array) {
        $conexion = Conexion::conectar();
        $sql      = "UPDATE trimestre SET Trimestre = ?, Fecha_Inicio = ? , Fecha_Fin = ?, id_Ficha = ? WHERE id_Trimestre  = ? ";
        $stmt     = $conexion->prepare($sql);
        $stmt->bind_param("sssii", $array[0], $array[1], $array[2], $array[3], $array[4]);
        $stmt->execute();
    }
    /**
     * @delete - función para eliminar una fila de datos según el id
     * @param type $array recibe un array con el id que se utilizara en la consulta
     * @return type retorna un true o un false
     */
    public function delete($array) {
        $conexion = Conexion::conectar();
        $sql      = "DELETE FROM trimestre WHERE id_Trimestre = ? ";
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
        $conexion = Conexion::conectar();
        $sql      = "SELECT * FROM trimestre WHERE id_Trimestre = $array[0]";
        $result   = $conexion->query($sql);
        return $result;
    }
    public function fechas(){
        $conexion = Conexion::conectar();
        $sql      = "SELECT DISTINCT Fecha_Inicio, Fecha_Fin FROM trimestre";
        return $conexion->query($sql);
    }
    public function informacion($array) {
        $conexion = Conexion::conectar();
        $sql      = "SELECT Trimestre, f.Numero_Ficha FROM trimestre t INNER JOIN ficha f ON t.id_Ficha = f.id_Ficha WHERE id_Trimestre = '$array[0]'";
        return $conexion->query($sql);
    }
}

?>