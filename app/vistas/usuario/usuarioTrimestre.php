<?php

@session_start();
require_once "app/controllers/controller.php";
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}
if ($_SESSION['user'][6] == 2) {
    if (isset($_GET['n'])) {
        ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!--- Required meta tags --->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--- SEO meta tags --->
    <meta name="description" content="">
    <meta name="author" content="">
    <!--- Title --->
    <title>WEM</title>
    <!--- Stylesheets --->
    <link rel="stylesheet" href="app/resources/css/trimestres.css">
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
                <!-- Contenedor del LOGO -->
                <div class="logo">
                    <img src="app/resources/img/logo.png" alt="">
                </div>
                <!-- Contenedor de los enlaces del nav -->
                <div id="enlaces" class="enlaces">
                    <a id="enlace-atras" class="btn-header">Atrás</a>
                    <a href="index.php?v=perfil" id="usuario"><?php echo $_SESSION['user'][1]; ?></a>
                    <a href="app/models/salir.php" id="salir">Cerrar Sesión</a>
                </div>
                <!-- Icono para la pantalla responsive -->
                <div class="icono" id="open">
                    <span>&#9776;</span>
                </div>
            </div>
        </nav>
    </header>
    <!---------- MAIN -------------->
    <main>
        <div class="container" id="<?php echo $_GET['n']; ?>">
            <div id="titulo">
                <h1>Trimestres de la ficha <span id="num_ficha"></span></h1>
            </div>
            <!-- Contenedor donde se insertarán los ambientes encontrado en la BD -->
            <div id="cont_trimestres">

            </div>
        </div>

    </main>
    <!--- Javascriprt ---->

    <script type="text/javascript" src="app/resources/libjs/jquery.min.js"></script>
    <script src="app/resources/js/nav.js"></script>
    <script src="app/resources/js/loader.js"></script>
    <script src="app/resources/js/usuarioTrimestre.js"></script>

</body>
</html>
<?php
} else if ($_SESSION['user'][6] == 1) {
        header("location: index.php?v=adminTrimestre");
    }
}

?>