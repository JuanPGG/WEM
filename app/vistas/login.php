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
    <title>Inicio de sesión | WEM</title>
    <link rel="stylesheet" href="app/resources/css/login.css">
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
    <!------ form -------->
    <div class="container">
      <p id="alerta" class="alerta"></p>
        <form method="POST" class="formulario" id="containerRecuperar">
         <a href="<?php echo $url ?>index.php"><img src="app/resources/img/logo.png" alt="Avatar Image"></a>
          <h1>Recuperar Contraseña</h1>
          <input type="text" class="input" name="receptor" id="email2" required>
          <label>Ingrese su correo</label>
          <button type="submit" name="enviar" id="enviar">Recuperar Contraseña</button>
          <p>Volver a <a id="volver">Inicio de Sesion</a></p>
        </form>

        <form method="POST"  class="formulario" id="containerSesion">
          <a href="<?php echo $url ?>index.php"><img src="app/resources/img/logo.png" alt="Avatar Image"></a>
          <h1>Inicio de sesión</h1>
          <input type="text" class="input" name="correo" id="email1" required>
          <label>Correo*</label>
          <input type="password" class="input" name="pw" id="pw" required>
          <label>Contraseña</label>
          <button type="submit" name="ingresar" id="ingresar">Iniciar sesión</button>
          <p>¿Has olvidado tu contraseña? <a id="recuperar">Click aqui</a></p>
          <p>¿No tienes una cuenta? <a href="<?php echo $url ?>index.php?v=registrar">Registrate</a></p>
        </form>

    </div>

    <script type="text/javascript" src="app/resources/libjs/jquery.min.js"></script>
    <script src="app/resources/js/loader.js"></script>
    <script type="text/javascript" src="app/resources/js/funciones.js"></script>
    <script type="text/javascript" src="app/resources/js/login.js"></script>
  </body>
  </html>