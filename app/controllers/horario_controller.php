<?php
/**
 *Se llama el modelo conexion
 */
require_once "app/models/conexion.php";
/**
 * detalleshorario_controller
 *
 * Se usa para el funcionamiento del CRUD de la clase detalleshorario
 */
class horario_controller {
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
        $login = new horario_controller();
        switch ($option) {
            case 0:
            $result = $login->consult($array);
            break;
            case 1:
            $result = $login->insert($array);
            break;
            case 2:
            $result = $login->consultInstructor($array);
            break;
            case 3:
            $result = $login->delete($array);
            break;
            case 4:
            $result = $login->consultarHoras($array);
            break;
            case 5:
            $result = $login->existe($array);
            break;
        }
        return $result;
    }
    /**
     * @consult - función que hace la consulta de toda la información de detalleshorario
     * @return retorna un array de datos
     */
    public function consult($array) {
        $conexion = Conexion::conectar();
        $sql      = "SELECT id_Horario, Dia, Hora_Inicio, Hora_Fin, i.id_Instructor, Nombres, Color, Nombre_Ambiente, Nombre_Competencia FROM horario h INNER JOIN instructor i on h.id_Instructor = i.id_Instructor INNER JOIN ambiente a on h.id_Ambiente = a.id_Ambiente INNER JOIN competencia c on h.id_Competencia = c.id_Competencia WHERE id_Trimestre = '$array[0]'";
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
        $sql    = "SELECT Dia, Hora_Inicio, Hora_Fin, i.Nombres, f.Numero_Ficha FROM horario h INNER JOIN trimestre t ON h.id_Trimestre = t.id_Trimestre INNER JOIN instructor i ON h.id_Instructor = i.id_Instructor INNER JOIN ficha f ON t.id_Ficha = f.id_Ficha WHERE Dia = '$array[0]' AND Hora_Inicio = '$array[1]' AND h.id_Instructor = '$array[5]' AND (t.Fecha_Inicio BETWEEN CAST('$array[8]' AS DATE) AND CAST('$array[9]' AS DATE))";
        $result1 = $conexion->query($sql);
        $filas1  = $result1->num_rows;

        $sql2    = "SELECT Dia, Hora_Inicio, Hora_Fin, a.Nombre_Ambiente, f.Numero_Ficha FROM horario h INNER JOIN trimestre t ON h.id_Trimestre = t.id_Trimestre INNER JOIN ambiente a INNER JOIN ficha f WHERE Dia = '$array[0]' AND Hora_Inicio = '$array[1]' AND h.id_Ambiente = '$array[3]' AND (t.Fecha_Inicio BETWEEN CAST('$array[8]' AS DATE) AND CAST('$array[9]' AS DATE))";
        $result2 = $conexion->query($sql2);
        $filas2  = $result2->num_rows;
        if ($filas1 === 0) {
            if($filas2 === 0){
                $stmt = $conexion->prepare("INSERT INTO horario (Dia, Hora_Inicio, Hora_Fin, id_Ambiente, id_Competencia, id_Instructor, id_Trimestre, id_Usuario) VALUES( ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssiiiii", $array[0], $array[1], $array[2], $array[3], $array[4], $array[5], $array[6], $array[7]);
                $stmt->execute();
                return 'Ok';
            }else{
                return $result2;
            }
        } else {
            return $result1;
        }
    }
    /**
     * @consultInstructor - función que realiza una consulta inner join para buscar informacion en varias tablas
     * @param $array que recibe una array que trae los datos solicitados
     * @return type retorna la consulta
     */
    public function consultInstructor($array) {
        $conexion = Conexion::conectar();
        $sql      = "SELECT Dia, Hora_Inicio, Hora_Fin, Color,h.id_Instructor, Nombre_Ambiente, Nombre_Competencia, Numero_Ficha FROM horario h INNER JOIN instructor i ON h.id_Instructor = i.id_Instructor INNER JOIN ambiente a ON h.id_Ambiente = a.id_Ambiente INNER JOIN competencia c ON h.id_Competencia = c.id_Competencia INNER JOIN trimestre t ON h.id_Trimestre = t.id_Trimestre INNER JOIN ficha f ON t.id_Ficha = f.id_Ficha WHERE h.id_Instructor = '$array[0]' AND (t.Fecha_Inicio BETWEEN CAST('$array[1]' AS DATE) AND CAST('$array[2]' AS DATE))";
        $result = $conexion->query($sql);
        $filas  = $result->num_rows;
        if($filas === 0){
            return 'No encontrado';
        }
        return $result;
    }
    /**
     * @delete - función para eliminar una fila de datos según el id
     * @param type $array recibe un array con el id que se utilizara en la consulta
     * @return type retorna un true o un false
     */
    public function delete($array) {
        $conexion = Conexion::conectar();
        $sql      = "DELETE FROM horario WHERE id_Horario = ? ";
        $stmt     = $conexion->prepare($sql);
        $stmt->bind_param("i", $array[0]);
        $stmt->execute();
    }
    public function consultarHoras($array) {
        $conexion = Conexion::conectar();
        $sql      = "SELECT COUNT(id_Instructor) FROM horario h INNER JOIN trimestre t ON h.id_Trimestre = t.id_Trimestre WHERE id_Instructor = '$array[0]' AND (t.Fecha_Inicio BETWEEN CAST('$array[1]' AS DATE) AND CAST('$array[2]' AS DATE))";
        return $conexion->query($sql);
    }
    public function existe($array) {
        $conexion = Conexion::conectar();
        $sql      = "SELECT Dia, Hora_Inicio, Hora_Fin, t.Fecha_Inicio, t.Fecha_Fin, h.id_Trimestre FROM horario h INNER JOIN trimestre t ON h.id_Trimestre = t.id_Trimestre WHERE Dia = '$array[0]' AND Hora_Inicio = '$array[1]' AND Hora_Fin = '$array[2]' AND t.Fecha_Inicio = '$array[3]' AND  t.Fecha_Fin ='$array[4]' AND h.id_Trimestre = '$array[5]'";
        return $conexion->query($sql);
    }
}

?>