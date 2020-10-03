<?php
  require_once "app/controllers/controller.php";
  $regE = "";
  if(!empty($_POST['nombres']) && !empty($_POST['apellidos'])){
    $array = [];
    array_push($array, $_POST['nombres'], $_POST['apellidos'], $_POST['correo'], $_POST['contrasena']);
    $registro = new controller();
    $result = $registro->Login(1,$array);
    if($result== null){
      $regE = "Correo ya registrado!";
    }else{
      $regE = "";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
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
    <!-------- fondo ----------->
  <img src="app/resources/img/header3.jpg" alt="">
  <!------- form ---------->
  <div class="container">
    <div class="login-box">
      <a href="index.php"><img src="app/resources/img/Logo.png" class="avatar" alt="Avatar Image"></a>
      <h1>Registro</h1>
      <p><?php echo $regE; ?></p>
      <p id="alerta" class="alerta"></p>
      <form id="form" method="POST">
        <!--- Input nombres ----->
        <input type="text" name="nombres" id="name" placeholder="Nombres*">
        <!--- Input apellidos ----->
        <input type="text" name="apellidos" id="lastname" placeholder="Apellidos*">
        <!--- Input email ----->
        <input type="text" name="correo" id="email" placeholder="ejemplo@misena.edu.co*">
        <!--- Input password ----->
        <input type="password" name="contrasena" id="pw" placeholder="Contraseña*">
        <!--- Input password2 ----->
        <input type="password" name="contrasena2" id="pw2" placeholder="Confirmar contraseña">
        <!--- Nombre enviar ----->
        <button type="submit" name="registrar" id="boton">Registrar</button>
        <!--- Etiqueta para regresar al modulo de inicio de sesión --->
        <p>¿Ya tienes una cuenta? <a href="index.php?v=sesion">Iniciar sesión</a></p>
      </form>
    </div>
  </div>
  
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="app/resources/js/loader.js"></script>
  <script src="app/resources/js/registro.js"></script>
</body>
</html>