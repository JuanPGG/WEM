<?php

require_once "app/models/conexion.php";

class contrato_controller{

    public function __construct(){}

    public static function Main($option,$array=[]){
        $login = new contrato_controller();
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
        $sql = "SELECT * FROM tipocontrato";
        return $conexion->query($sql);
    }
    public function insert($array){
        $conexion=Conexion::connection();
        $sql = "SELECT * FROM tipocontrato WHERE Horas_TipoContrato = '$array[1]' ";
        $result = $conexion->query($sql);
        $filas = $result->num_rows;
        if($filas === 0){
            $stmt=$conexion->prepare("INSERT INTO tipocontrato (Descripcion_TipoContrato, Horas_TipoContrato)VALUES(?,?)");
            $stmt->bind_param("si",$array[0],$array[1]);
            $stmt->execute();
        }
    }
    public function update($array){
        $conexion=Conexion::connection();
        $sql = "UPDATE tipocontrato SET Descripcion_TipoContrato = ?, Horas_TipoContrato = ?  WHERE id_TipoContrato  = ? ";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sii",$array[0],$array[1],$array[2]);
        $stmt->execute();
    }


    public function delete($array){
        $conexion=Conexion::connection();
        $sql = "DELETE FROM tipocontrato WHERE id_TipoContrato = ? ";
        $stmt=$conexion->prepare($sql);
        $stmt->bind_param("i",$array[0]);
        $stmt->execute();
    }
    public function consultUpdate($array){
        $conexion=Conexion::connection();
        $sql = "SELECT * FROM tipocontrato WHERE id_TipoContrato = $array[0]";
        $result = $conexion->query($sql);
        return $result;
    }
}

?>