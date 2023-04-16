<?php 
require_once 'app/controllers/controller.php';
$controller = new controller();
$url = $controller->url();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/ico" href="app/resources/img/logo.ico">
  <title>Formulario De Registro | WEM</title>
  <link rel="stylesheet" href="app/resources/css/registro.css">

</head>

<body class="hidden">
    <!----------- LOAD ------------>
    <div class="centrado" id="onload">
        <section>
            <div class="loader">
                <div class="loader-inner"></div>
            </div>
            <h3>Loading...</h3>
        </section>
    </div>
  <!------- form ---------->
  <div class="container">
      <form id="form" method="POST" class="formulario">
        <a href="<?php echo $url ?>index.php"><img src="app/resources/img/logo.png" class="avatar" alt="Avatar Image"></a>
        <h1>Registro</h1>
        <p id="alerta" class="alerta"></p>
        <!--- Input nombres ----->
        <input type="text" class="input" name="nombres" id="name">
        <label>Nombres*</label>
        <!--- Input apellidos ----->
        <input type="text" class="input" name="apellidos" id="lastname">
        <label>Apellidos*</label>
        <!--- Input email ----->
        <input type="text" class="input" name="correo" id="email">
        <label>Correo*</label>
        <!--- Input password ----->
        <input type="password" class="input" name="contrasena" id="pw">
        <label>Contraseña*</label>
        <!--- Input password2 ----->
        <input type="password" class="input" name="contrasena2" id="pw2">
        <label>Confirmar contraseña</label>
        <!--- Nombre enviar ----->
        <button type="submit" class="input" name="registrar" id="boton">Registrar</button>
        <!--- Etiqueta para regresar al modulo de inicio de sesión --->
        <p>¿Ya tienes una cuenta? <a href="<?php echo $url ?>index.php?v=sesion">Iniciar sesión</a></p>
      </form>
  </div>

  <script type="text/javascript" src="app/resources/libjs/jquery.min.js"></script>
  <script src="app/resources/js/loader.js"></script>
  <script src="app/resources/js/funciones.js"></script>
  <script src="app/resources/js/registro.js"></script>
</body>
</html>