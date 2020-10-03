<?php

require_once "app/models/conexion.php";

class competencia_controller{

    public function __construct(){}

    public static function Main($option,$array=[]){
        $login = new competencia_controller();
        // Según la opción que llegue, hará la función en el switch
        switch($option){    
            case 0:
            $result=$login->consult(); // Se llama la funcion que trae los datos
            break;

            case 1:
            $result=$login->insert($array); // Se llama la funcion que inserta los datos
            break;

            case 2:
            $result=$login->delete($array); // Se llama la funcion que elimina el dato segun el id
            break;

            case 3:
            $result=$login->consultUpdate($array); // Se llama la funcion que trae los datos según el id
            break;

            case 4:
            $result=$login->update($array); // Se llama la funcion actualiza los datos
            break;
        }
        return $result;
    }
    public function consult(){ // función que trae los datos del ambiente
        $conexion=Conexion::connection();
        $sql = "SELECT * from competencia"; // consulta sql para traer todos los datos
        return $conexion->query($sql); // ejecución de la consulta y retorno del resultado
    }
    public function insert($array){ // función para insertar datos en la tabla ambiente
        $conexion=Conexion::connection();
        $sql = "SELECT * from competencia WHERE Nombre_Comp = '$array[0]'"; // Se busca si existe
        $result = $conexion->query($sql);
        $filas = $result->num_rows;
        if($filas === 0){ // En caso de que no exista se hace la consulta a continuación para insertar
            $stmt=$conexion->prepare("INSERT INTO competencia (Nombre_Comp, Descripcion_Comp)VALUES(?,?)");
            $stmt->bind_param("ss",$array[0],$array[1]);
            $stmt->execute();
        }
    }
    public function update($array){ // Función para actualizar los datos
        $conexion=Conexion::connection();
        $sql = "UPDATE competencia SET Nombre_Comp = ?, Descripcion_Comp = ? WHERE id_Competencia = ? ";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssi",$array[0],$array[1],$array[2]);
        $stmt->execute();
    }


    public function delete($array){ // función para eliminar el dato según el id que entra en el parametro
        $conexion=Conexion::connection();
        $sql = "DELETE FROM competencia WHERE id_Competencia = ? ";
        $stmt=$conexion->prepare($sql);
        $stmt->bind_param("i",$array[0]);
        $stmt->execute();
    }
    public function consultUpdate($array){ // función que trae los datos según el id de la tabla ambiente
        $conexion=Conexion::connection();
        $sql = "SELECT * FROM competencia WHERE id_Competencia = $array[0]";
        $result = $conexion->query($sql);
        return $result; // Se retornan los datos encontrados
    }
}

?>