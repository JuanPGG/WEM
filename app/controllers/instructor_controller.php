<?php
/**
 *Se llama el modelo conexion
 */
require_once "app/models/conexion.php";
/**
 * instructor_controller
 * 
 * Se usa para el funcionamiento del CRUD de la clase instructor
 */
class instructor_controller{
    /**
     * @construct
     */
    public function __construct(){}
    /**
     * @Main - función que llama los diferentes métodos de la clase
     * @param type $option recibe un parametro tipo int para hacer el switch
     * @param type|array $array recibe un array con los diferentes datos que se utilizran
     * @return type retorna la variable result que retorna true, false o un array de datos
     */
    public static function Main($option,$array=[]){
        $login = new instructor_controller();
        switch($option){    
            case 0:
            $result=$login->consult();
            break;

            case 1:
            $result=$login->insert($array);
            break;

            case 2:
            $result=$login->delete($array);
            break;

            case 3:
            $result=$login->consultUpdate($array);
            break;

            case 4:
            $result=$login->update($array);
            break;
        }
        return $result;
    }
    /**
     * @consult - función que hace la consulta de toda la información del instructor
     * @return retorna un array de datos
     */
    public function consult(){
        $conexion=Conexion::connection();
        $sql = "SELECT i.id_Instructor, i.Nombres, i.Apellidos, i.Documento,i.Correo, i.Color, t.Descripcion_tipoContrato FROM instructor i INNER JOIN tipocontrato t ON t.id_TipoContrato = i.id_TipoContrato ORDER BY id_Instructor";
        return $conexion->query($sql);
    }
    /**
     * @insert - función que hace una consulta para verificar que si exista o no ese registro
     *           en caso negativo hará un inserción de datos
     * @param type $array recibe un array de datos que se utlizaran para consultar o para insertar
     * @return type retorna un true o un false
     */
    public function insert($array){
        $conexion=Conexion::connection();
        $sql = "SELECT * from instructor WHERE Documento = '$array[2]' ";
        $result = $conexion->query($sql);
        $filas = $result->num_rows;
        if($filas === 0){
            $stmt=$conexion->prepare("INSERT INTO instructor(Nombres, Apellidos, Documento, Correo, Color, id_TipoContrato) 
                VALUES( ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssi",$array[0],$array[1],$array[2],$array[3],$array[4],$array[5]);
            $stmt->execute();
        }
    }
    /**
     * @update - función que realiza una actualización de datos según el id
     * @param type $array recibe un array con los datos que se actualizaran
     * @return type retorna un true o un false
     */
    public function update($array){
        $conexion=Conexion::connection();
        $sql = "UPDATE instructor SET Nombres=?,Apellidos=?,Correo=?,Color=?, id_TipoContrato = ? WHERE id_Instructor=?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sssssi",$array[0],$array[1],$array[2],$array[3],$array[4],$array[5]);
        $stmt->execute();
    }
     /**
     * @delete - función para eliminar una fila de datos según el id
     * @param type $array recibe un array con el id que se utilizara en la consulta
     * @return type retorna un true o un false
     */
    public function delete($array){
        $conexion=Conexion::connection();
        $sql = "DELETE FROM instructor WHERE id_Instructor = ? ";
        $stmt=$conexion->prepare($sql);
        $stmt->bind_param("i",$array[0]);
        $stmt->execute();
    }
    /**
     * @consultUpdate - función que consulta los datos según el id
     * @param type $array recibe un array con el id que se utilizará en la consulta
     * @return type retorna un array de datos
     */
    public function consultUpdate($array){
        $conexion=Conexion::connection();
        $sql = "SELECT * FROM instructor WHERE id_Instructor = $array[0]";
        $result = $conexion->query($sql);
        return $result;
    }
}

?>