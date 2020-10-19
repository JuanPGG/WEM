<?php
/**
 *Se llama el controlador principal
 */
require_once "app/controllers/controller.php";
/**
 * redirec_controller
 *
 * Clase en la que se redireccionará a las diferentes vistas y
 * que hará las diferentes peticiones y llamadas los archivos js
 */
class redirec_controller {
    /**
     * @redireccion
     *
     * Función que será llamada por las diferentes vistas para hacer un redirecionamiento
     * @param type|String parametro que recibirá el string de la ruta a la que se redireccionará
     * @return type retorna una vista
     */
    public function redireccion($ruta) {
        include_once 'app/vistas/' . $ruta . '.php';
    }
    /**
     * @index
     *
     * Función para redireccionar a la vista index.php
     */
    public function index() {
        $this->redireccion('index');
    }
    /**
     * @sesion
     *
     * Función para redireccionar a la vista login.php
     */
    public function sesion() {
        $this->redireccion('login');
    }
    /**
     * @registrar
     *
     * Función para redireccionar a la vista registro.php
     */
    public function registrar() {
        $this->redireccion('registro');
    }
    /**
     * @recuperarPw
     *
     * Función para redireccionar a la vista recuperarPw.php
     */
    public function recuperarPw() {
        $this->redireccion('recuperarPw');
    }
    /**
     * @perfil
     *
     * Función para redireccionar a la vista perfil.php
     */
    public function perfil() {
        $this->redireccion('perfil');
    }
    /**
     * @detallesinstructor
     *
     * Función para redireccionar a la vista instructor.php
     */
    public function detallesinstructor() {
        $this->redireccion('instructor');
    }
    /**
     * @adminHorario
     *
     * Función para redireccionar a la vista crud.php
     */
    public function adminHorario() {
        $this->redireccion('/admin/horario');
    }
    /**
     * @adminForms
     *
     * Función para redireccionar a la vista forms.php
     */
    public function adminForms() {
        $this->redireccion('/admin/forms');
    }
    /**
     * @adminFichas
     *
     * Función para redireccionar a la vista fichas.php
     */
    public function adminFichas() {
        $this->redireccion('/admin/fichas');
    }
    /**
     * @adminTrimestre
     *
     * Función para redireccionar a la vista trimestres.php
     */
    public function adminTrimestre() {
        $this->redireccion('/admin/trimestres');
    }

    public function fichas() {
        $this->redireccion('/usuario/usuarioFichas');
    }
    public function trimestres() {
        $this->redireccion('/usuario/usuarioTrimestre');
    }
    public function horario() {
        $this->redireccion('/usuario/usuarioHorario');
    }
    /**
     * @peticionUsuario
     *
     * Función que será llamada desde js para traer o editar los datos del usuario
     * @param type|String parametro que recibirá el string del caso que se ejecutará
     * @return type retorna datos en el caso de 'mostrar' o un true o false en caso de 'editar'
     */
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
    /**
     * @petiionesAjax
     *
     * Función que será llamada desde js para traer, agregar, eliminar o editar los datos del instructor
     * @param type|String parametro que recibirá el string del caso que se ejecutará
     * @return type retorna los datos si es 'mostrar', 'obtenerdatos' y en los demás solo true o false
     */
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
    /**
     * @petiionesAjaxAmbiente
     *
     * Función que será llamada desde js para traer, agregar, eliminar o editar los datos del ambiente
     * @param type|String parametro que recibirá el string del caso que se ejecutará
     * @return type retorna los datos si es 'mostrar', 'obtenerdatos' y en los demás solo true o false
     */
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
    /**
     * @petiionesAjaxCompetencia
     *
     * Función que será llamada desde js para traer, agregar, eliminar o editar los datos de la competencia
     * @param type|String parametro que recibirá el string del caso que se ejecutará
     * @return type retorna los datos si es 'mostrar', 'obtenerdatos' y en los demás solo true o false
     */
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
    /**
     * @petiionesAjaxFicha
     *
     * Función que será llamada desde js para traer, agregar, eliminar o editar los datos de la ficha
     * @param type|String parametro que recibirá el string del caso que se ejecutará
     * @return type retorna los datos si es 'mostrar', 'obtenerdatos' y en los demás solo true o false
     */
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
    /**
     * @petiionesAjaxProgramaFormacion
     *
     * Función que será llamada desde js para traer, agregar, eliminar o editar los datos del programa de formación
     * @param type|String parametro que recibirá el string del caso que se ejecutará
     * @return type retorna los datos si es 'mostrar', 'obtenerdatos' y en los demás solo true o false
     */
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
    /**
     * @petiionesAjaxContrato
     *
     * Función que será llamada desde js para traer, agregar, eliminar o editar los datos del contrato
     * @param type|String parametro que recibirá el string del caso que se ejecutará
     * @return type retorna los datos si es 'mostrar', 'obtenerdatos' y en los demás solo true o false
     */
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
    /**
     * @petiionesAjaxTrimestre
     *
     * Función que será llamada desde js para traer, agregar, eliminar o editar los datos del trimestre
     * @param type|String parametro que recibirá el string del caso que se ejecutará
     * @return type retorna los datos si es 'mostrar', 'obtenerdatos' y en los demás solo true o false
     */
    public function peticionesAjaxTrimestre($p) {
        $controller = new controller();
        switch ($p) {
        case 'mostrar':
            $array = [];
            array_push($array, $_POST['id_ficha']);
            $result    = $controller->trimestre(0, $array);
            $resultado = api_response::mostrar($result, ["id_trimestre", "trimestre", "fecha_inicio", "fecha_fin","id_ficha"]);
            echo $resultado;
            break;
        case 'agregar':
            $array = [];
            array_push($array, $_POST['trimestre'], $_POST['fecha_inicio'], $_POST['fecha_fin'], $_POST['id_ficha']);
            $result = $controller->trimestre(1, $array);
            break;

        case 'eliminar':
            $array = [];
            array_push($array, $_POST['id_trimestre']);
            $result = $controller->trimestre(2, $array);
            break;

        case 'obtenerdatos':
            $array = [];
            array_push($array, $_POST['id_trimestre']);
            $result    = $controller->trimestre(3, $array);
            $resultado = api_response::mostrar($result, ["id_trimestre", "nombre_trimestre", "fecha_inicio", "fecha_fin","id_ficha"]);
            echo $resultado;
            break;

        case 'editar':
            $array = [];
            array_push($array, $_POST['trimestre'], $_POST['fecha_inicio'], $_POST['fecha_fin'], $_POST['id_ficha'], $_POST['id_trimestre']);
            $result = $controller->trimestre(4, $array);
            break;
        }
    }
    /**
     * @petiionesAjaxDetallesHorario
     *
     * Función que será llamada desde js para traer, agregar, eliminar o editar los datos del horario
     * @param type|String parametro que recibirá el string del caso que se ejecutará
     * @return type retorna los datos si es 'mostrar', 'obtenerInstructor' y en los demás solo true o false
     */
    public function peticionesAjaxHorario($p) {
        $controller = new controller();
        switch ($p) {
        case 'mostrar':
            $array = [];
            array_push($array, $_POST['id_trimestre']);
            $result    = $controller->horario(0, $array);
            $resultado = api_response::mostrar($result, ["id_horario", "dia", "hora_inicio", "hora_fin", "id_instructor", "instructor", "color", "ambiente", "competencia"]);
            echo $resultado;
            break;

        case 'agregar':
            $array = [];
            array_push($array, $_POST['dia'], $_POST['hora_inicio'], $_POST['hora_fin'], $_POST['id_Ambiente'], $_POST['id_Competencia'], $_POST['id_Instructor'], $_POST['id_Trimestre'], $_POST['id_Usuario'], $_POST['fecha_inicio'], $_POST['fecha_fin']);
            $result = $controller->horario(1, $array);
            if($result != 'Ok'){
                $resultado = api_response::mostrar($result, ["dia", "hora_inicio", "hora_fin", "nombre", "ficha"]);
                echo $resultado;
            }else{
                echo $result;
            }
            break;

        case 'obtenerInstructor':
            $array = [];
            array_push($array, $_POST['id_instructor'], $_POST['fecha_inicio'], $_POST['fecha_fin']);
            $result    = $controller->horario(2, $array);
            if($result != 'No encontrado'){
                $resultado = api_response::mostrar($result, ["dia", "hora_inicio", "hora_fin", "color", "id","ambiente", "competencia", "ficha"]);
                echo $resultado;
            }else{
                echo $result;
            }
            break;
        case 'eliminar':
            $array = [];
            array_push($array, $_POST['id_horario']);
            $controller->horario(3, $array);
            break;
        case 'horas':
            $array = [];
            array_push($array, $_POST['id_instructor'], $_POST['fecha_inicio'], $_POST['fecha_fin']);
            $result    = $controller->horario(4, $array);
            $resultado = api_response::mostrar($result, ["horas"]);
            echo $resultado;
            break;
        case 'existe':
            $array = [];
            array_push($array, $_POST['dia'], $_POST['hora_inicio'], $_POST['hora_fin'], $_POST['fecha_inicio'], $_POST['fecha_fin'], $_POST['id_trimestre']);
            $result    = $controller->horario(5, $array);
            $resultado = api_response::mostrar($result, ["dia", "hora_inicio", "hora_fin", "fecha_inicio", "fecha_fin", "id_trimestre"]);
            echo $resultado;
            break;
        }
    }
}

?>