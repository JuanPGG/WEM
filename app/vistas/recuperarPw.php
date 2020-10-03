<?php
require_once "app/controllers/controller.php";
$login = new controller();
$array = [];
array_push($array,$_GET['token']);
$resultado = $login->Login(4, $array);
if($resultado != null){
  if(isset($_POST['recuperar'])){
    $login = new controller();
    $array = [];
    array_push($array,$_POST['newpw'], $_GET['token']);
    $login->Login(3, $array);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
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
    <!------ fondo ------->
    <img src="app/resources/img/header3.jpg" alt="">
    <!------ form -------->
    <div class="container">
      <div class="login-box">
        <a href="../../index.php"><img src="app/resources/img/Logo.png" alt="Avatar Image"></a>
        <h1>Recuperar Contraseña</h1>
        <form method="POST">
          <input type="password" id="newpw" name="newpw" placeholder="Nueva Contraseña" required>
          <input type="password" id="confirmpw" name="confirmpw" placeholder="Confirmar nueva contraseña" required>
          <button type="submit" name="recuperar" id="resetPw">Recuperar Contraseña</button>
        </form>
      </div>
    </div>


    <script src="app/resources/js/loader.js"></script>
    <script type="text/javascript" src="app/resources/js/recuperar.js"></script>
</body>
</html>
<?php
}else{
	echo "<script> alert('No existe un token'); </script>";
  echo "<script> window.location = 'index.php?v=sesion';</script>";
}

?>


