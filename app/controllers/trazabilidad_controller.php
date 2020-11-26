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
class trazabilidad_controller {
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
        $login = new trazabilidad_controller();
        switch ($option) {
        case 0:
            $result = $login->consult();
            break;
        case 1:
            $result = $login->buscar($array);
            break;
        }
        return $result;
    }
     /**
     * @consult - función que hace la consulta de toda la información del trimestre
     * @return retorna un array de datos
     */
    public function consult() {
        $conexion = Conexion::conectar();
        $sql      = "SELECT id_Trazabilidad, u.Nombres, f.Numero_Ficha, t.Trimestre, i.Nombres, c.Nombre_Competencia, a.Nombre_Ambiente, Fecha, Accion FROM trazabilidad tz INNER JOIN usuario u ON tz.id_Usuario = u.id_Usuario INNER JOIN trimestre t ON tz.id_Trimestre = t.id_Trimestre INNER JOIN ficha f ON t.id_Ficha = f.id_Ficha INNER JOIN instructor i ON tz.id_Instructor = i.id_Instructor INNER JOIN competencia c ON tz.id_Competencia = c.id_Competencia INNER JOIN ambiente a ON tz.id_Ambiente = a.id_Ambiente ORDER BY Fecha DESC";
        return $conexion->query($sql);
    }
    public function buscar($array){
        $conexion = Conexion::conectar();
        $sql      = "SELECT id_Trazabilidad, u.Nombres, f.Numero_Ficha, t.Trimestre, i.Nombres, c.Nombre_Competencia, a.Nombre_Ambiente, Fecha, Accion FROM trazabilidad tz INNER JOIN usuario u ON tz.id_Usuario = u.id_Usuario INNER JOIN trimestre t ON tz.id_Trimestre = t.id_Trimestre INNER JOIN ficha f ON t.id_Ficha = f.id_Ficha INNER JOIN instructor i ON tz.id_Instructor = i.id_Instructor INNER JOIN competencia c ON tz.id_Competencia = c.id_Competencia INNER JOIN ambiente a ON tz.id_Ambiente = a.id_Ambiente WHERE u.Nombres LIKE '{$array[0]}%' OR f.Numero_Ficha LIKE '%{$array[0]}' OR t.Trimestre LIKE '{$array[0]}%' OR c.Nombre_Competencia LIKE '{$array[0]}%' OR a.Nombre_Ambiente LIKE '{$array[0]}%' OR Fecha LIKE '%{$array[0]}%' OR i.Nombres LIKE '{$array[0]}%' OR Accion LIKE '{$array[0]}%' ORDER BY Fecha DESC";
        return $conexion->query($sql);
    }
}

?>