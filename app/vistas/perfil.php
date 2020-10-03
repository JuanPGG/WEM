<?php

@session_start();
require_once "app/controllers/controller.php";
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['user'][1] . " " . $_SESSION['user'][2]; ?></title>
    <link rel="stylesheet" href="app/resources/css/perfil.css">
    <link rel="stylesheet" href="app/resources/iconos/icomoon/style.css">
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
    <!------------ NAV--------------->
    <header>
        <nav id="nav" class="nav1">
            <div class="contenedor-nav">
                <div class="logo">
                    <img src="app/resources/img/logo.png" alt="">
                </div>
                <div id="enlaces" class="enlaces">
                    <a href="index.php?v=fichas" id="enlace-ambientes" class="btn-header">Mis Fichas</a>
                    <a id="enlace-atras" class="btn-header">Atrás</a>
                    <a href="app/models/salir.php" id="salir">Cerrar Sesión</a>
                </div>
                <div class="icono" id="open">
                    <span>&#9776;</span>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container" id="perfil" data-id=<?php echo $_SESSION['user'][0]; ?>>
            <div id="titulo">
                <h1>Mis datos</h1>
            </div>
            <div class="perfil">
                <div class="user">
                    <i class="icon-user-tie"></i>
                </div>
                <div id="form">
                    <form method="POST" id="usuario">
                        <div class="cont-input">
                            <label for="">Nombres:</label><br>
                            <input type="text" id="nombre">
                        </div>
                        <div class="cont-input">
                            <label for="">Apellidos:</label><br>
                            <input type="text" id="apellido">
                        </div>
                        <div class="cont-input">
                            <label for="">Correo:</label><br>
                            <input type="text" id="correo" disabled>
                        </div>
                        <button type="submit" id="guardar" name="guardar">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

<script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
<script src="app/resources/js/loader.js"></script>
<script src="app/resources/js/nav.js"></script>
<script src="app/resources/js/perfil.js"></script>
</body>
</html>