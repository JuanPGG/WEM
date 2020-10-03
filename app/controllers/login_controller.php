<?php

require_once "app/models/conexion.php";
use PHPMailer\PHPMailer\PHPMailer;

require 'lib/phpmailer/Exception.php';
require 'lib/phpmailer/PHPMailer.php';
require 'lib/phpmailer/SMTP.php';
/**
 * login_controller
 *
 * Clase en la que se harán las diferentes funciones de CRUD para la parte de Login y Registro
 */
class login_controller {

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
        $conexion = Conexion::connection();
        $sql      = "SELECT * from usuario WHERE Correo = ? AND Contrasena = MD5(?) ";
        $stmt     = $conexion->prepare($sql);
        $stmt->bind_param("ss", $array[0], $array[1]);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_row();
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
        $conexion = Conexion::connection();
        $sql      = "SELECT * from usuario WHERE Correo = '$array[2]'";
        $result   = $conexion->query($sql);
        $filas    = $result->num_rows;
        if ($filas === 0) {
            $stmt = $conexion->prepare("INSERT INTO usuario(Nombres,Apellidos,Correo,Contrasena) VALUES( ?, ?, ?, MD5(?))");
            $stmt->bind_param("ssss", $array[0], $array[1], $array[2], $array[3]);
            $stmt->execute();
            echo "<script>
            alert('Registrado con exito!');
            window.location = 'index.php?v=sesion';
            </script>";
            return $stmt;
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
        $conexion = Conexion::connection();
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
              background: #ccc;
              text-align: center;
            }
            .boton{
              margin: 20px auto;
              padding: 10px;
              border-radius: 8px;
              border-style: none;
              border: 1px solid gray;
              box-shadow: 2px 2px 4px 0 black;
              background: orange;
              cursor: pointer;
            }
            a{
              text-decoration: none;
              cursor: pointer;
              color: black;
            }
            a:hover > .boton{
              color: white;
              box-shadow: 1px 1px 2px 0 black;
            }
            ";
            $message .= "</style></head><body>";
            $message .= "
            <div class='container-msg'>
                <h1>Restablecer contraseña</h1>
                <p>Para restablecer su contraseña haga click en el siguiente boton: </p>

                <a href='http://localhost/Proyecto-WEM/index.php?v=recuperarPw&token=" . $array[0] . "'><button class='boton'>Restablecer Contraseña</button></a>
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
            $mail->Username   = 'proyectowemsena@gmail.com'; // SMTP username
            $mail->Password   = 'proyectowem1234'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 25; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('proyectowemsena@gmail.com', 'Proyecto Wem');
            $mail->addAddress($array[1]); // Add a recipient

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Restablecer contraseña';
            $mail->Body    = $message;

            if ($mail->send()) {
                echo '<script>alert("Se envio correctamente"); </script>';
                $sqlEvent = "SET GLOBAL event_scheduler = ON";
                $conexion->query($sqlEvent);
                $sql2 = "CREATE EVENT borrar_token
                        ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 1 MINUTE
                        DO UPDATE usuario SET token = null WHERE token = '$array[0]'";
                $conexion->query($sql2);

            } else {
                echo '<script>alert("No se envio el correo"); </script>';
            }

        } else {
            echo '<script>alert("El correo electronico no existe"); </script>';
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
        $conexion = Conexion::connection();
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
            window.location = 'index.php?v=sesion';
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
        $conexion = Conexion::connection();
        $sql      = "SELECT * from usuario WHERE token = ?";
        $stmt     = $conexion->prepare($sql);
        $stmt->bind_param("s", $array[0]);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_row();
    }
    public function consultarId($array) {
        $conexion = Conexion::connection();
        $sql      = "SELECT * FROM usuario WHERE id_Usuario = $array[0]";
        $result   = $conexion->query($sql);
        return $result;
    }
    public function actualizarDatos($array) {
        $conexion = Conexion::connection();
        $sql      = "UPDATE usuario SET Nombres=?,Apellidos=? WHERE id_Usuario=?";
        $stmt     = $conexion->prepare($sql);
        $stmt->bind_param("ssi", $array[0], $array[1], $array[2]);
        $stmt->execute();
    }
}
?>