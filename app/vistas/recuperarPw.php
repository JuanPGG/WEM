<?php
require_once "app/controllers/controller.php";
$login = new controller();
$array = [];
array_push($array, $_GET['token']);
$resultado = $login->Login(4, $array);
if ($resultado != null) {
    if (!empty($_POST['newpw']) && !empty($_POST['confirmpw'])) {
        $login = new controller();
        $array = [];
        array_push($array, $_POST['newpw'], $_GET['token']);
        $login->Login(3, $array);
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>WEM | Restablecer Contraseña</title>
  <link rel="stylesheet" href="app/resources/css/recuperarPw.css">
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
        <form id="form" method="POST" class="formulario">
          <a href="../../index.php"><img src="app/resources/img/Logo.png" alt="Avatar Image"></a>
          <h1>Recuperar Contraseña</h1>
          <p id="alerta" class="alerta"></p>
          <input class="input" type="password" id="newpw" name="newpw">
          <label>Nueva contraseña</label>
          <input class="input" type="password" id="confirmpw" name="confirmpw">
          <label>Confirmar nueva contraseña</label>
          <button type="submit" name="recuperar" id="resetPw">Recuperar Contraseña</button>
        </form>
    </div>

    <script type="text/javascript" src="app/resources/libjs/jquery.min.js"></script>
    <script src="app/resources/js/loader.js"></script>
    <script type="text/javascript"src="app/resources/js/funciones.js"></script>
    <script type="text/javascript" src="app/resources/js/recuperarPw.js"></script>
</body>
</html>
<?php
} else {
    echo "<script> alert('No existe un token'); </script>";
    echo "<script> window.location = 'index.php?v=sesion';</script>";
}

?>


