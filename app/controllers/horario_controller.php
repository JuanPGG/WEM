<?php

require_once "app/models/conexion.php";

class horario_controller {

    public function __construct() {}

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
    public function consult($array) {
        $conexion = Conexion::connection();
        $sql      = "SELECT * FROM horario WHERE id_Ficha = '$array[0]'";
        return $conexion->query($sql);
    }
    public function insert($array) {
        $conexion = Conexion::connection();
        $sql      = "SELECT * FROM horario WHERE Trimestre = '$array[0]' AND id_Ficha = '$array[3]' ";
        $result   = $conexion->query($sql);
        $filas    = $result->num_rows;
        if ($filas === 0) {
            $stmt = $conexion->prepare("INSERT INTO horario (Trimestre, Fecha_Inicio, Fecha_Fin, id_Ficha)VALUES(?,?,?,?)");
            $stmt->bind_param("sssi", $array[0], $array[1], $array[2], $array[3]);
            $stmt->execute();
        }
    }
    public function update($array) {
        $conexion = Conexion::connection();
        $sql      = "UPDATE horario SET Trimestre = ?, Fecha_Inicio = ? , Fecha_Fin = ?, id_Ficha = ? WHERE id_Horario  = ? ";
        $stmt     = $conexion->prepare($sql);
        $stmt->bind_param("sssii", $array[0], $array[1], $array[2], $array[3], $array[4]);
        $stmt->execute();
    }

    public function delete($array) {
        $conexion = Conexion::connection();
        $sql      = "DELETE FROM horario WHERE id_Horario = ? ";
        $stmt     = $conexion->prepare($sql);
        $stmt->bind_param("i", $array[0]);
        $stmt->execute();
    }
    public function consultUpdate($array) {
        $conexion = Conexion::connection();
        $sql      = "SELECT * FROM horario WHERE id_Horario = $array[0]";
        $result   = $conexion->query($sql);
        return $result;
    }
}

?>