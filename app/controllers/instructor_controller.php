<?php

require_once "app/models/conexion.php";

class instructor_controller{

    public function __construct(){}

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
    public function consult(){
        $conexion=Conexion::connection();
        $sql = "SELECT i.id_Instructor, i.Nombres, i.Apellidos, i.Documento,i.Correo, i.Color, t.Descripcion_tipoContrato FROM instructor i INNER JOIN tipocontrato t ON t.id_TipoContrato = i.id_TipoContrato ORDER BY id_Instructor";
        return $conexion->query($sql);
    }
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
    public function update($array){
        $conexion=Conexion::connection();
        $sql = "UPDATE instructor SET Nombres=?,Apellidos=?,Correo=?,Color=?, id_TipoContrato = ? WHERE id_Instructor=?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sssssi",$array[0],$array[1],$array[2],$array[3],$array[4],$array[5]);
        $stmt->execute();
    }


    public function delete($array){
        $conexion=Conexion::connection();
        $sql = "DELETE FROM instructor WHERE id_Instructor = ? ";
        $stmt=$conexion->prepare($sql);
        $stmt->bind_param("i",$array[0]);
        $stmt->execute();
    }
    public function consultUpdate($array){
        $conexion=Conexion::connection();
        $sql = "SELECT * FROM instructor WHERE id_Instructor = $array[0]";
        $result = $conexion->query($sql);
        return $result;
    }
}

?>