<?php

@session_start();
require_once "app/controllers/controller.php";
$controller = new controller();
$url = $controller->url();
if (!isset($_SESSION['user'])) {
    header("Location: {$url}index.php");
}
if ($_SESSION['user'][6] == 1) {
    if (isset($_GET['n'])) {
        ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <!--- Required meta tags --->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/ico" href="app/resources/img/logo.ico">
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
                    <a href="<?php echo $url ?>index.php?v=adminForms" id="enlace" class="btn-header">Registros</a>
                    <a href="<?php echo $url ?>index.php?v=detallesInstructor" class="btn-header">Instructores</a>
                    <a href="<?php echo $url ?>index.php?v=detallesAmbiente" class="btn-header">Ambientes</a>
                    <a id="enlace-atras" class="btn-header">Atrás</a>
                    <a href="<?php echo $url ?>index.php?v=perfil" id="iniciar-sesion"><?php echo $_SESSION['user'][1]; ?></a>
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
            <!-- Contenedor con el evento click para agregar trimestres -->
            <div id="agregar">
                <i class="icon-plus"></i>
            </div>
        </div>
        <div id="cont_form">
            <div id="formTrimestre">
                <form method="POST" id="form_trimestre" class="formulario">
                <i class="icon-cross" id="cerrar"></i>
                    <h1>Trimestre</h1>
                    <p id="alerta" class="alerta"></p>
                    <input type="hidden" id="id_trimestre">
                    <input class="input" type="text" id="nombre_trimestre">
                    <label>Nombre del Trimestre</label>
                    <div>
                        <input class="input fecha" type="date" id="fecha_inicio">
                        <label>Fecha de inicio</label>
                    </div>
                    <div>
                        <input class="input fecha" type="date" id="fecha_fin">
                        <label>Fecha de fin</label>
                    </div>
                    <button type="submit" id="btn-trimestre">Guardar</button>
                </form>
            </div>
        </div>

    </main>
    <!--- Javascriprt ---->

    <script type="text/javascript" src="app/resources/libjs/jquery.min.js"></script>
    <script src="app/resources/js/nav.js"></script>
    <script src="app/resources/js/loader.js"></script>
    <script src="app/resources/js/funciones.js"></script>
    <script src="app/resources/js/trimestres.js"></script>

</body>
</html>
<?php
} else {
        header("location: {$url}index.php?v=adminFichas");
    }
} else if ($_SESSION['user'][6] == 2) {
    header("Location: {$url}index.php?v=trimestres");
}

?>