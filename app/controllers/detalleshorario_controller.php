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
class detalleshorario_controller {
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
        $login = new detalleshorario_controller();
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
        $conexion = Conexion::connection();
        $sql      = "SELECT id_Detalles_Horario, Dia, Hora_Inicio, Hora_Fin, i.id_Instructor ,Nombres, Color, Nombre_Ambiente, Nombre_Comp FROM detalles_horario dh INNER JOIN instructor i on dh.id_Instructor = i.id_Instructor INNER JOIN ambiente a on dh.id_Ambiente = a.id_Ambiente INNER JOIN competencia c on dh.id_Competencia = c.id_Competencia WHERE id_Horario = '$array[0]'";
        return $conexion->query($sql);
    }
    /**
     * @insert - función que hace una consulta para verificar que si exista o no ese registro
     *           en caso negativo hará un inserción de datos
     * @param type $array recibe un array de datos que se utlizaran para consultar o para insertar
     * @return type retorna un true o un false
     */
    public function insert($array) {
        $resp     = [];
        $conexion = Conexion::connection();
        // $sql      = "SELECT * FROM detalles_horario dh INNER JOIN horario h ON dh.id_Horario = h.id_Horario WHERE dia = '$array[0]' AND hora_inicio = '$array[1]' AND (id_Instructor = '$array[5]' OR id_Ambiente = '$array[3]') AND (h.fecha_inicio = '$array[8]' AND h.fecha_fin = '$array[9]')";
        $sql    = "SELECT * FROM detalles_horario dh INNER JOIN horario h ON dh.id_Horario = h.id_Horario WHERE Dia = '$array[0]' AND Hora_Inicio = '$array[1]' AND id_Instructor = '$array[5]' AND (h.Fecha_Inicio BETWEEN CAST('$array[8]' AS DATE) AND CAST('$array[9]' AS DATE))";
        $result = $conexion->query($sql);
        $filas  = $result->num_rows;
        if ($filas === 0) {
            $stmt = $conexion->prepare("INSERT INTO detalles_horario(Dia, Hora_Inicio, Hora_Fin, id_Ambiente, id_Competencia, id_Instructor, id_Horario, id_Usuario)
                VALUES( ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssiiiii", $array[0], $array[1], $array[2], $array[3], $array[4], $array[5], $array[6], $array[7]);
            $stmt->execute();
            echo 'Ok';
        } else {
            echo 'Error';
        }
    }
    /**
     * @consultInstructor - función que realiza una consulta inner join para buscar informacion en varias tablas
     * @param $array que recibe una array que trae los datos solicitados
     * @return type retorna la consulta
     */
    public function consultInstructor($array) {
        $conexion = Conexion::connection();
        $sql      = "SELECT Dia, Hora_Inicio, Hora_Fin, Color, Nombre_Ambiente, Nombre_Comp, Numero_Ficha FROM detalles_horario dh INNER JOIN instructor i ON dh.id_Instructor = i.id_Instructor INNER JOIN ambiente a ON dh.id_Ambiente = a.id_Ambiente INNER JOIN competencia c ON dh.id_Competencia = c.id_Competencia INNER JOIN horario h ON dh.id_Horario = h.id_Horario INNER JOIN ficha f ON h.id_Ficha = f.id_Ficha WHERE dh.id_Instructor = '$array[0]' AND (h.Fecha_Inicio BETWEEN CAST('$array[1]' AS DATE) AND CAST('$array[2]' AS DATE)) AND (h.Fecha_Fin BETWEEN CAST('$array[1]' AS DATE) AND CAST('$array[2]' AS DATE))";
        return $conexion->query($sql);
    }
    /**
     * @delete - función para eliminar una fila de datos según el id
     * @param type $array recibe un array con el id que se utilizara en la consulta
     * @return type retorna un true o un false
     */
    public function delete($array) {
        $conexion = Conexion::connection();
        $sql      = "DELETE FROM detalles_horario WHERE id_Detalles_Horario = ? ";
        $stmt     = $conexion->prepare($sql);
        $stmt->bind_param("i", $array[0]);
        $stmt->execute();
    }
    public function consultarHoras($array) {
        $conexion = Conexion::connection();
        $sql      = "SELECT COUNT(id_Instructor) FROM detalles_horario dh INNER JOIN horario h ON dh.id_Horario = h.id_Horario WHERE id_Instructor = '$array[0]' AND (h.Fecha_Inicio BETWEEN CAST('$array[1]' AS DATE) AND CAST('$array[2]' AS DATE))";
        return $conexion->query($sql);
    }
    public function existe($array) {
        $conexion = Conexion::connection();
        $sql      = "SELECT Dia, Hora_Inicio, Hora_Fin, h.Fecha_Inicio, h.Fecha_Fin, dh.id_Horario FROM detalles_horario dh INNER JOIN horario h ON dh.id_Horario = h.id_Horario WHERE Dia = '$array[0]' AND Hora_Inicio = '$array[1]' AND Hora_Fin = '$array[2]' AND h.Fecha_Inicio = '$array[3]' AND  h.Fecha_Fin ='$array[4]' AND dh.id_Horario = '$array[5]'";
        return $conexion->query($sql);
    }
}

?>