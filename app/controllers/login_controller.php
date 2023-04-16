<?php
@session_start();
/**
 *Se llama el modelo conexion
 * Se llama y usa la libreria PHPMailer
 */
require_once "app/models/conexion.php";
use PHPMailer\PHPMailer\PHPMailer;

require 'lib/phpmailer/Exception.php';
require 'lib/phpmailer/PHPMailer.php';
require 'lib/phpmailer/SMTP.php';
/**
 * login_controller
 *
 * Clase en la que se harán las diferentes funciones de CRUD para el Usuario
 */
class login_controller {

    /**
     * @construct
     */
    private function __construct() {}
    /**
     * @Main
     *
     * Función que llama a los diferentes metodos de la clase
     * @param type $option Sirve para determinar la opción de switch que será utilizada
     * @param type|array $array Recibe los datos que llegan desde controller.php
     * @return type retornará los datos recibidos en result en un array
     */
    public static function Main($option, $array = []) {
        $login = new login_controller();
        switch ($option) {
        case 0:
            $result = $login->consult($array);
            break;

        case 1:
            $result = $login->insert($array);
            break;

        case 2:
            $result = $login->setToken($array);
            break;

        case 3:
            $result = $login->recuperarPw($array);
            break;

        case 4:
            $result = $login->consultarToken($array);
            break;

        case 5:
            $result = $login->consultarId($array);
            break;
        case 6:
            $result = $login->actualizarDatos($array);
            break;
        case 7:
            $result = $login->consultAdmin($array);
            break;
        case 8:
            $result = $login->insertAdmin($array);
            break;
        case 9:
            $result = $login->eliminarAdmin($array);
            break;
        }

        return $result;
    }

    /**
     * @consult
     *
     * En esta función se hará una consulta a la base de datos,
     * la cual determinará si existe un usuario y lo dejará loguear
     * @param type $array Array que contiene el correo y la contraseña
     * @return type Retorna un array con los datos de la fila encontrada en la consulta
     */
    public function consult($array) {
        $respuesta = [];
        $conexion = Conexion::conectar();
        $sql      = "SELECT * from usuario WHERE Correo = ? AND Contrasena = MD5(?) ";
        $stmt     = $conexion->prepare($sql);
        $stmt->bind_param("ss", $array[0], $array[1]);
        $stmt->execute();
        $result = $stmt->get_result();
        $resultado = $result->fetch_row();
        $_SESSION['user'] = $resultado;
        if($resultado != null){
            return $respuesta['Ok'] = 'Ok';
        }else{
            return $respuesta['Error'] = 'Error';
        }
    }
    /**
     * @insert
     *
     * En esta función se hará una consulta a la base de datos,
     * la cual determinará si hay un usuario registrado con ese correo,
     * en caso negativo procederá a realizar una inserción de datos
     * @param type $array Array que contiene los diferentes datos ingresados en registro.php
     * @return type retorna un true o false
     */
    public function insert($array) {
        $conexion = Conexion::conectar();
        $respuesta = [];
        $sql      = "SELECT * from usuario WHERE Correo = '$array[2]'";
        $result   = $conexion->query($sql);
        $filas    = $result->num_rows;
        if ($filas === 0) {
            $stmt = $conexion->prepare("INSERT INTO usuario(Nombres,Apellidos,Correo,Contrasena, Token,id_Rol) VALUES( ?, ?, ?, MD5(?), '', 2)");
            $stmt->bind_param("ssss", $array[0], $array[1], $array[2], $array[3]);
            $stmt->execute();
            return $respuesta['Ok'] = 'Ok';
        }else{
            return $respuesta['Error'] = 'Error';
        }
    }
    /**
     * @setToken
     *
     * En esta función se hará una consulta a la base de datos,
     * la cual determinará si el correo ingresado existe,
     * en caso firmativo, se le asignará un token y por medio de phpmailer se
     * envia un correo en el cual estará el link de redirección con el token asignado
     * @param type $array Array que contiene los diferentes datos ingresados en login.php
     * @return type retorna un true o false
     */
    public function setToken($array) {
        $conexion = Conexion::conectar();
        $controller = new controller();
        $url = $controller->url();
        $respuesta = [];
        $sql      = "SELECT Correo from usuario WHERE Correo = '$array[1]' ";
        $result   = $conexion->query($sql);
        $filas    = $result->num_rows;
        if ($filas === 1) {
            $sql  = "UPDATE usuario SET token = ? WHERE correo = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("ss", $array[0], $array[1]);
            $stmt->execute();
            $message = "<html><head>";
            $message .= "<style type='text/css'>";
            $message .= "
            .container-msg{
                width: 100%;
                text-align: center;
                padding: 100px 0px;
            }
            .boton{
                margin: 20px auto;
                font-size: 15px;
                border: none;
                padding: 8px;
                border-radius: 5px;
                cursor: pointer;
                background: rgb(252, 115, 35);
                color: white;
                transition: 300ms transform;
            }
            .container-msg > a{
                text-decoration: none;
                cursor: pointer;
                color: black;
            }
            a:hover > .boton{
                background: rgb(255, 94, 0);
                color: #000;
            }
            ";
            $message .= "</style></head><body>";
            $message .= "
            <div class='container-msg'>
                <h1>Restablecer contraseña</h1>
                <p>Este link solo será válido por 3 minutos.</p>
                <p>Para restablecer su contraseña haga click en el siguiente boton: </p>

                <a href='".$url."index.php?v=recuperarPw&token=" . $array[0] . "'><button class='boton'>Restablecer Contraseña</button></a>

                <p>En caso de que el botón anterior no funcione, haga uso del siguiente enlace: <a href='".$url."index.php?v=recuperarPw&token=" . $array[0] . "'>".$url."index.php?v=recuperarPw&token=" . $array[0] . "</a></p>

              </div>
            ";
            $message .= "</body></html>";
            $mail = new PHPMailer(true);
            //Server settings
            $mail->SMTPDebug = 0; // Enable verbose debug output
            $mail->isSMTP();
            $mail->CharSet    = 'UTF-8'; // Send using SMTP
            $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
            $mail->SMTPAuth   = true; // Enable SMTP authentication
            $mail->Username   = 'correoproyectowem@gmail.com'; // SMTP username
            $mail->Password   = 'proyectowem1234'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('correoproyectowem@gmail.com', 'Proyecto Wem');
            $mail->addAddress($array[1]); // Add a recipient

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Restablecer contraseña';
            $mail->Body    = $message;

            if ($mail->send()) {
                $sqlEvent = "SET GLOBAL event_scheduler = ON";
                $conexion->query($sqlEvent);
                $sql2 = "CREATE EVENT borrar_token
                        ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 3 MINUTE
                        DO UPDATE usuario SET token = '' WHERE token = '$array[0]'";
                $conexion->query($sql2);
                return $respuesta['Ok'] = 'Ok';
            } else {
                return $respuesta['Error'] = 'Error';
            }

        } else {
            return $respuesta['Existe'] = 'No';
        }
    }
    /**
     * @recuperarPw
     *
     * En esta función se hará una actualización de contraseña según el token asigndo
     * en la función anterior y una vez se actuliza, se eliminará el token
     * @param type $array Array que contiene los diferentes datos ingresados en recuperarPw.php
     * @return type retorna un true o false
     */
    public function recuperarPw($array) {
        $conexion = Conexion::conectar();
        $controller = new controller();
        $url = $controller->url();
        $sql      = "UPDATE usuario SET Contrasena = MD5(?) WHERE token = ?";
        $stmt     = $conexion->prepare($sql);
        $stmt->bind_param("ss", $array[0], $array[1]);
        if ($stmt->execute()) {
            $sql  = "UPDATE usuario SET token = null WHERE token = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("s", $array[1]);
            $stmt->execute();
            echo "<script>
            alert('Su contraseña ha cambiado con exito!');
            window.location = '".$url."index.php?v=sesion';
            </script>";
        }

    }
    /**
     * @insert
     *
     * En esta función se hará una consulta a la base de datos para saber si existe un token
     * @param type $array Array que contiene los diferentes datos ingresados en login.php
     * @return type retorna los datos encontrados según el token
     */
    public function consultarToken($array) {
        $conexion = Conexion::conectar();
        $sql      = "SELECT * from usuario WHERE token = ?";
        $stmt     = $conexion->prepare($sql);
        $stmt->bind_param("s", $array[0]);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_row();
    }
    /**
     * @consultarId
     *
     * En esta función se hará una consulta a la base de datos para traer los datos de usuario
     * @param type $array Array que contiene el id del usuario
     * @return type retorna los datos del usuario encontrado
     */
    public function consultarId($array) {
        $conexion = Conexion::conectar();
        $sql      = "SELECT * FROM usuario WHERE id_Usuario = $array[0]";
        $result   = $conexion->query($sql);
        return $result;
    }
    /**
     * @actualizarDatos
     *
     * En esta función se hará una consulta a la base de datos para actualizar los datos del usuario
     * @param type $array Array que contiene el nombre y el apellido
     * @return type retorna un true o false
     */
    public function actualizarDatos($array) {
        $conexion = Conexion::conectar();
        $sql      = "UPDATE usuario SET Nombres=?,Apellidos=? WHERE id_Usuario=?";
        $stmt     = $conexion->prepare($sql);
        $stmt->bind_param("ssi", $array[0], $array[1], $array[2]);
        $stmt->execute();
    }

    public function consultAdmin($array) {
        $conexion = Conexion::conectar();
        $sql      = "SELECT id_Usuario, Nombres, Apellidos, Correo from usuario WHERE id_Rol = 1 AND id_Usuario != '$array[0]'";
        return $conexion->query($sql);
    }

    public function insertAdmin($array) {
        $conexion = Conexion::conectar();
        $sql      = "SELECT * from usuario WHERE Correo = '$array[2]'";
        $result   = $conexion->query($sql);
        $filas    = $result->num_rows;
        if ($filas === 0) {
            $stmt = $conexion->prepare("INSERT INTO usuario(Nombres,Apellidos,Correo,Contrasena, id_Rol) VALUES( ?, ?, ?, MD5(?), 1)");
            $stmt->bind_param("ssss", $array[0], $array[1], $array[2], $array[3]);
            $stmt->execute();
        }
    }

    public function eliminarAdmin($array){
        $conexion = Conexion::conectar();
        $sql      = "DELETE FROM usuario WHERE id_Usuario = ? ";
        $stmt     = $conexion->prepare($sql);
        $stmt->bind_param("i", $array[0]);
        $stmt->execute();
    }
}
?>