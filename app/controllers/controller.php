<?php

require_once "login_controller.php";
require_once "instructor_controller.php";
require_once "api_response.php";
require_once "ambiente_controller.php";
require_once "ficha_controller.php";
require_once "programaformacion_controller.php";
require_once "contrato_controller.php";
require_once "horario_controller.php";
require_once "competencia_controller.php";
require_once "detalleshorario_controller.php";

class controller {

    public function Login($option, $array = []) {
        return login_controller::Main($option, $array);
    }
    public function instructor($option, $array = []) {
        return instructor_controller::Main($option, $array);
    }
    public function ambiente($option, $array = []) {
        return ambiente_controller::Main($option, $array);
    }
    public function competencia($option, $array = []) {
        return competencia_controller::Main($option, $array);
    }
    public function ficha($option, $array = []) {
        return ficha_controller::Main($option, $array);
    }
    public function programaformacion($option, $array = []) {
        return programaformacion_controller::Main($option, $array);
    }
    public function contrato($option, $array = []) {
        return contrato_controller::Main($option, $array);
    }
    public function horario($option, $array = []) {
        return horario_controller::Main($option, $array);
    }
    public function detalleshorario($option, $array = []) {
        return detalleshorario_controller::Main($option, $array);
    }
}
?>