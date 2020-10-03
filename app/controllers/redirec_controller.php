<?php
require_once "app/controllers/controller.php";

class redirec_controller {
    public function redireccion($ruta) {
        include_once 'app/vistas/' . $ruta . '.php';
    }
    public function index() {
        $this->redireccion('index');
    }
    public function sesion() {
        $this->redireccion('login');
    }
    public function registrar() {
        $this->redireccion('registro');
    }
    public function crud() {
        $this->redireccion('crud');
    }
    public function forms() {
        $this->redireccion('forms');
    }
    public function recuperarPw() {
        $this->redireccion('recuperarPw');
    }
    public function fichas() {
        $this->redireccion('fichas');
    }
    public function trimestre() {
        $this->redireccion('trimestres');
    }
    public function detallesinstructor() {
        $this->redireccion('instructor');
    }
    public function perfil() {
        $this->redireccion('perfil');
    }
    public function peticionUsuario($p) {
        $controller = new controller();
        switch ($p) {
        case 'mostrar':
            $array = [];
            array_push($array, $_POST['user']);
            $result    = $controller->Login(5, $array);
            $resultado = api_response::mostrar($result, ["id", "nombres", "apellidos", "correo"]);
            echo $resultado;
            break;

        case 'editar':
            $array = [];
            array_push($array, $_POST['nombres'], $_POST['apellidos'], $_POST['id']);
            $result = $controller->Login(6, $array);
            break;
        }
    }
    public function peticionesAjax($p) {
        $controller = new controller();
        switch ($p) {
        case 'mostrar':
            $result    = $controller->instructor(0);
            $resultado = api_response::mostrar($result, ["id", "nombres", "apellidos", "documento", "correo", "color", "tipoContrato"]);
            echo $resultado;
            break;

        case 'agregar':
            $array = [];
            array_push($array, $_POST['nombres'], $_POST['apellidos'], $_POST['documento'], $_POST['correo'], $_POST['color'], $_POST['tipoContrato']);
            $result = $controller->instructor(1, $array);
            break;

        case 'eliminar':
            $array = [];
            array_push($array, $_POST['id']);
            $result = $controller->instructor(2, $array);
            break;

        case 'obtenerdatos':
            $array = [];
            array_push($array, $_POST['id']);
            $result    = $controller->instructor(3, $array);
            $resultado = api_response::mostrar($result, ["id", "nombres", "apellidos", "documento", "correo", "color", "tipoContrato"]);
            echo $resultado;
            break;

        case 'editar':
            $array = [];
            array_push($array, $_POST['nombres'], $_POST['apellidos'], $_POST['correo'], $_POST['color'], $_POST['tipoContrato'], $_POST['id']);
            $result = $controller->instructor(4, $array);
            break;
        }

    }

    public function peticionesAjaxAmbiente($p) {
        $controller = new controller();
        switch ($p) {
        case 'mostrar':
            $result    = $controller->ambiente(0);
            $resultado = api_response::mostrar($result, ["id_amb", "nombre_ambiente", "descripcion_ambiente"]);
            echo $resultado;
            break;

        case 'agregar':
            $array = [];
            array_push($array, $_POST['nombre_ambiente'], $_POST['descripcion_ambiente']);
            $result = $controller->ambiente(1, $array);
            break;

        case 'eliminar':
            $array = [];
            array_push($array, $_POST['id_amb']);
            $result = $controller->ambiente(2, $array);
            break;

        case 'obtenerdatos':
            $array = [];
            array_push($array, $_POST['id_amb']);
            $result    = $controller->ambiente(3, $array);
            $resultado = api_response::mostrar($result, ["id_amb", "nombre_ambiente", "descripcion_ambiente"]);
            echo $resultado;
            break;

        case 'editar':
            $array = [];
            array_push($array, $_POST['nombre_ambiente'], $_POST['descripcion_ambiente'], $_POST['id_amb']);
            $result = $controller->ambiente(4, $array);
            break;
        }

    }
    public function peticionesAjaxCompetencia($p) {
        $controller = new controller();
        switch ($p) {
        case 'mostrar':
            $result    = $controller->competencia(0);
            $resultado = api_response::mostrar($result, ["id_comp", "nombre_comp", "descripcion_comp"]);
            echo $resultado;
            break;

        case 'agregar':
            $array = [];
            array_push($array, $_POST['nombre_comp'], $_POST['descripcion_comp']);
            $result = $controller->competencia(1, $array);
            break;

        case 'eliminar':
            $array = [];
            array_push($array, $_POST['id_comp']);
            $result = $controller->competencia(2, $array);
            break;

        case 'obtenerdatos':
            $array = [];
            array_push($array, $_POST['id_comp']);
            $result    = $controller->competencia(3, $array);
            $resultado = api_response::mostrar($result, ["id_comp", "nombre_comp", "descripcion_comp"]);
            echo $resultado;
            break;

        case 'editar':
            $array = [];
            array_push($array, $_POST['nombre_comp'], $_POST['descripcion_comp'], $_POST['id_comp']);
            $result = $controller->competencia(4, $array);
            break;
        }

    }
    public function peticionesAjaxFicha($p) {
        $controller = new controller();
        switch ($p) {
        case 'mostrar':
            $result    = $controller->ficha(0);
            $resultado = api_response::mostrar($result, ["id_fic", "nombre_gestor", "num_ficha", "id_programa"]);
            echo $resultado;
            break;

        case 'agregar':
            $array = [];
            array_push($array, $_POST['nombre_gestor'], $_POST['num_ficha'], $_POST['id_programa']);
            $result = $controller->ficha(1, $array);
            break;

        case 'eliminar':
            $array = [];
            array_push($array, $_POST['id_fic']);
            $result = $controller->ficha(2, $array);
            break;

        case 'obtenerdatos':
            $array = [];
            array_push($array, $_POST['id_fic']);
            $result    = $controller->ficha(3, $array);
            $resultado = api_response::mostrar($result, ["id_fic", "nombre_gestor", "num_ficha", "id_programa"]);
            echo $resultado;
            break;

        case 'editar':
            $array = [];
            array_push($array, $_POST['nombre_gestor'], $_POST['num_ficha'], $_POST['id_programa'], $_POST['id_fic']);
            $result = $controller->ficha(4, $array);
            break;
        }

    }

    public function peticionesAjaxProgramaFormacion($p) {
        $controller = new controller();
        switch ($p) {
        case 'mostrar':
            $result    = $controller->programaformacion(0);
            $resultado = api_response::mostrar($result, ["id_pf", "nombre_programa", "descripcion_programa"]);
            echo $resultado;
            break;

        case 'agregar':
            $array = [];
            array_push($array, $_POST['nombre_programa'], $_POST['descripcion_programa']);
            $result = $controller->programaformacion(1, $array);
            break;

        case 'eliminar':
            $array = [];
            array_push($array, $_POST['id_pf']);
            $result = $controller->programaformacion(2, $array);
            break;

        case 'obtenerdatos':
            $array = [];
            array_push($array, $_POST['id_pf']);
            $result    = $controller->programaformacion(3, $array);
            $resultado = api_response::mostrar($result, ["id_pf", "nombre_programa", "descripcion_programa"]);
            echo $resultado;
            break;

        case 'editar':
            $array = [];
            array_push($array, $_POST['nombre_programa'], $_POST['descripcion_programa'], $_POST['id_pf']);
            $result = $controller->programaformacion(4, $array);
            break;
        }

    }
    public function peticionesAjaxContrato($p) {
        $controller = new controller();
        switch ($p) {
        case 'mostrar':
            $result    = $controller->contrato(0);
            $resultado = api_response::mostrar($result, ["id_cont", "descripcion_tipocontrato", "horas_tipocontrato"]);
            echo $resultado;
            break;

        case 'agregar':
            $array = [];
            array_push($array, $_POST['descripcion_tipocontrato'], $_POST['horas_tipocontrato']);
            $result = $controller->contrato(1, $array);
            break;

        case 'eliminar':
            $array = [];
            array_push($array, $_POST['id_cont']);
            $result = $controller->contrato(2, $array);
            break;

        case 'obtenerdatos':
            $array = [];
            array_push($array, $_POST['id_cont']);
            $result    = $controller->contrato(3, $array);
            $resultado = api_response::mostrar($result, ["id_cont", "descripcion_tipocontrato", "horas_tipocontrato"]);
            echo $resultado;
            break;

        case 'editar':
            $array = [];
            array_push($array, $_POST['descripcion_tipocontrato'], $_POST['horas_tipocontrato'], $_POST['id_cont']);
            $result = $controller->contrato(4, $array);
            break;
        }

    }
    public function peticionesAjaxTrimestre($p) {
        $controller = new controller();
        switch ($p) {
        case 'mostrar':
            $array = [];
            array_push($array, $_POST['id_ficha']);
            $result    = $controller->horario(0, $array);
            $resultado = api_response::mostrar($result, ["id_horario", "trimestre", "fecha_inicio", "fecha_fin", "id_ficha"]);
            echo $resultado;
            break;

        case 'agregar':
            $array = [];
            array_push($array, $_POST['trimestre'], $_POST['fecha_inicio'], $_POST['fecha_fin'], $_POST['id_ficha']);
            $result = $controller->horario(1, $array);
            break;

        case 'eliminar':
            $array = [];
            array_push($array, $_POST['id_horario']);
            $result = $controller->horario(2, $array);
            break;

        case 'obtenerdatos':
            $array = [];
            array_push($array, $_POST['id_horario']);
            $result    = $controller->horario(3, $array);
            $resultado = api_response::mostrar($result, ["id_horario", "nombre_trimestre", "fecha_inicio", "fecha_fin", "id_ficha"]);
            echo $resultado;
            break;

        case 'editar':
            $array = [];
            array_push($array, $_POST['trimestre'], $_POST['fecha_inicio'], $_POST['fecha_fin'], $_POST['id_ficha'], $_POST['id_horario']);
            $result = $controller->horario(4, $array);
            break;
        }

    }
    public function peticionesAjaxDetallesHorario($p) {
        $controller = new controller();
        switch ($p) {
        case 'mostrar':
            $array = [];
            array_push($array, $_POST['id_trimestre']);
            $result    = $controller->detalleshorario(0, $array);
            $resultado = api_response::mostrar($result, ["id", "dia", "hora_inicio", "hora_fin", "id_instructor", "instructor", "color", "ambiente", "competencia"]);
            echo $resultado;
            break;

        case 'agregar':
            $array = [];
            array_push($array, $_POST['dia'], $_POST['hora_inicio'], $_POST['hora_fin'], $_POST['id_Ambiente'], $_POST['id_Competencia'], $_POST['id_Instructor'], $_POST['id_Horario'], $_POST['id_Usuario'], $_POST['fecha_inicio'], $_POST['fecha_fin']);
            $result = $controller->detalleshorario(1, $array);
            break;

        case 'obtenerInstructor':
            $array = [];
            array_push($array, $_POST['id_instructor'], $_POST['fecha_inicio'], $_POST['fecha_fin']);
            $result    = $controller->detalleshorario(2, $array);
            $resultado = api_response::mostrar($result, ["dia", "hora_inicio", "hora_fin", "color", "ambiente", "competencia", "ficha"]);
            echo $resultado;
            break;
        }

    }
}

?>