<?php

require_once "app/models/conexion.php";

class detalleshorario_controller {

    public function __construct() {}

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
            $result = $login->consultUpdate($array);
            break;

        case 4:
            $result = $login->update($array);
            break;
        }
        return $result;
    }
    public function consult($array) {
        $conexion = Conexion::connection();
        $sql      = "SELECT id_Detalles_Horario, dia, hora_inicio, hora_fin, i.id_Instructor ,Nombres, Color, Nombre_Ambiente, Nombre_Comp FROM detalles_horario dh INNER JOIN instructor i on dh.id_Instructor = i.id_Instructor INNER JOIN ambiente a on dh.id_Ambiente = a.id_Ambiente INNER JOIN competencia c on dh.id_Competencia = c.id_Competencia WHERE id_Horario = '$array[0]'";
        return $conexion->query($sql);
    }
    public function insert($array) {
        $conexion = Conexion::connection();
        // $sql      = "SELECT * FROM detalles_horario dh INNER JOIN horario h ON dh.id_Horario = h.id_Horario WHERE dia = '$array[0]' AND hora_inicio = '$array[1]' AND (id_Instructor = '$array[5]' OR id_Ambiente = '$array[3]') AND (h.fecha_inicio = '$array[8]' AND h.fecha_fin = '$array[9]')";
        $sql    = "SELECT * FROM detalles_horario dh INNER JOIN horario h ON dh.id_Horario = h.id_Horario WHERE dia = '$array[0]' AND hora_inicio = '$array[1]' AND id_Instructor = '$array[5]' AND (h.Fecha_Inicio BETWEEN CAST('$array[8]' AS DATE) AND CAST('$array[9]' AS DATE))";
        $result = $conexion->query($sql);
        $filas  = $result->num_rows;
        if ($filas === 0) {
            $stmt = $conexion->prepare("INSERT INTO detalles_horario(dia, hora_inicio, hora_fin, id_Ambiente, id_Competencia, id_Instructor, id_Horario, id_Usuario)
                VALUES( ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssiiiii", $array[0], $array[1], $array[2], $array[3], $array[4], $array[5], $array[6], $array[7]);
            $stmt->execute();
            echo 'Ok';
        } else {
            echo 'Error';
        }
    }
    public function consultInstructor($array) {
        $conexion = Conexion::connection();
        $sql      = "SELECT dia, hora_inicio, hora_fin, Color, Nombre_Ambiente, Nombre_Comp, Numero_Ficha FROM detalles_horario dh INNER JOIN instructor i ON dh.id_Instructor = i.id_Instructor INNER JOIN ambiente a ON dh.id_Ambiente = a.id_Ambiente INNER JOIN competencia c ON dh.id_Competencia = c.id_Competencia INNER JOIN horario h ON dh.id_Horario = h.id_Horario INNER JOIN ficha f ON h.id_Ficha = f.id_Ficha WHERE dh.id_Instructor = '$array[0]' AND (h.Fecha_Inicio BETWEEN CAST('$array[1]' AS DATE) AND CAST('$array[2]' AS DATE)) AND (h.Fecha_Fin BETWEEN CAST('$array[1]' AS DATE) AND CAST('$array[2]' AS DATE))";
        return $conexion->query($sql);
    }
    // public function update($array){
    //     $conexion=Conexion::connection();
    //     $sql = "UPDATE instructor SET Nombres=?,Apellidos=?,Correo=?,Color=?, id_TipoContrato = ? WHERE id_Instructor=?";
    //     $stmt = $conexion->prepare($sql);
    //     $stmt->bind_param("sssssi",$array[0],$array[1],$array[2],$array[3],$array[4],$array[5]);
    //     $stmt->execute();
    // }

    // public function delete($array){
    //     $conexion=Conexion::connection();
    //     $sql = "DELETE FROM instructor WHERE id_Instructor = ? ";
    //     $stmt=$conexion->prepare($sql);
    //     $stmt->bind_param("i",$array[0]);
    //     $stmt->execute();
    // }
    // public function consultUpdate($array){
    //     $conexion=Conexion::connection();
    //     $sql = "SELECT * FROM instructor WHERE id_Instructor = $array[0]";
    //     $result = $conexion->query($sql);
    //     return $result;
    // }
}

?>