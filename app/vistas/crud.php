<?php
@session_start();
require_once "app/controllers/controller.php";

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}

if (isset($_GET["n"]) && isset($_GET['t'])) {
    ?>
<!DOCTYPE html>
<html lang="es">

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
    <link rel="stylesheet" href="app/resources/css/crud.css">
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
                    <a href="index.php?v=forms" id="enlace-registros" class="btn-header">Registros</a>
                    <a id="enlace-atras" class="btn-header">Atrás</a>
                    <a href="index.php?v=perfil" id="usuario"><?php echo $_SESSION['user'][1]; ?></a>
                    <a href="app/models/salir.php" id="salir">Cerrar Sesión</a>
                </div>
                <div class="icono" id="open">
                    <span>&#9776;</span>
                </div>
            </div>
        </nav>
    </header>
    <!---------- MAIN -------------->
    <main data-user="<?php echo $_SESSION['user'][0]; ?>">
        <div id="cont_form">
            <div id="form">
                <i class="icon-cross" id="cerrar"></i>
                <form method="POST" id="formulario">
                    <h1>Seleccionar</h1>
                    <div class="select">
                        <label for="">Instructor:</label>
                        <select id="select_instructor">
                            <option selected disabled>Seleccione alguno</option>
                        </select>
                    </div>

                    <div class="select">
                        <label for="">Competencia:</label>
                        <select id="select_competencia">
                            <option selected disabled>Seleccione alguno</option>
                        </select>
                    </div>

                    <div class="select">
                        <label for="">Ambiente:</label>
                        <select id="select_ambiente">
                            <option selected disabled>Seleccione alguno</option>
                        </select>
                    </div>

                    <button type="submit">Guardar</button>
                </form>
            </div>
        </div>
        <div class="table" id="<?php echo $_GET['n']; ?>">

            <table id="<?php echo $_GET['t']; ?>">
                <tr>
                    <th colspan="6" id="num_ficha"></th>
                    <th colspan="6" id="trimestre"></th>
                </tr>
                <tr>
                    <th colspan="12" id="fecha"></th>
                </tr>
                <tr>
                    <th colspan="2">Hora Inicio / Fin</th>
                    <th colspan="2">Lunes</th>
                    <th colspan="2">Martes</th>
                    <th colspan="2">Miercoles</th>
                    <th colspan="2">Jueves</th>
                    <th colspan="2">Viernes</th>
                </tr>
                <tr data-inicio="06:00:00" data-fin="09:00:00">
                    <th colspan="2" class="horas">6:00AM / 9:00AM</th>
                    <td colspan="2" class="drops" id="drop1" data-dia="Lunes"></td>
                    <td colspan="2" class="drops" id="drop2" data-dia="Martes"></td>
                    <td colspan="2" class="drops" id="drop3" data-dia="Miercoles"></td>
                    <td colspan="2" class="drops" id="drop4" data-dia="Jueves"></td>
                    <td colspan="2" class="drops" id="drop5" data-dia="Viernes"></td>
                </tr>
                <tr data-inicio="09:00:00" data-fin="12:00:00">
                    <th colspan="2" class="horas">9:00AM / 12:00PM</th>
                    <td colspan="2" class="drops" id="drop6" data-dia="Lunes"></td>
                    <td colspan="2" class="drops" id="drop7" data-dia="Martes"></td>
                    <td colspan="2" class="drops" id="drop8" data-dia="Miercoles"></td>
                    <td colspan="2" class="drops" id="drop9" data-dia="Jueves"></td>
                    <td colspan="2" class="drops" id="drop10" data-dia="Viernes"></td>
                </tr>
                <tr data-inicio="12:00:00" data-fin="15:00:00">
                    <th colspan="2" class="horas">12:00PM / 3:00PM</th>
                    <td colspan="2" class="drops" id="drop11" data-dia="Lunes"></td>
                    <td colspan="2" class="drops" id="drop12" data-dia="Martes"></td>
                    <td colspan="2" class="drops" id="drop13" data-dia="Miercoles"></td>
                    <td colspan="2" class="drops" id="drop14" data-dia="Jueves"></td>
                    <td colspan="2" class="drops" id="drop15" data-dia="Viernes"></td>
                </tr>
                <tr data-inicio="15:00:00" data-fin="18:00:00">
                    <th colspan="2" class="horas">3:00PM / 6:00PM</th>
                    <td colspan="2" class="drops" id="drop16" data-dia="Lunes"></td>
                    <td colspan="2" class="drops" id="drop17" data-dia="Martes"></td>
                    <td colspan="2" class="drops" id="drop18" data-dia="Miercoles"></td>
                    <td colspan="2" class="drops" id="drop19" data-dia="Jueves"></td>
                    <td colspan="2" class="drops" id="drop20" data-dia="Viernes"></td>
                </tr>
                <tr data-inicio="18:00:00" data-fin="21:00:00">
                    <th colspan="2" class="horas">6:00PM / 9:00PM</th>
                    <td colspan="2" class="drops" id="drop21" data-dia="Lunes"></td>
                    <td colspan="2" class="drops" id="drop22" data-dia="Martes"></td>
                    <td colspan="2" class="drops" id="drop23" data-dia="Miercoles"></td>
                    <td colspan="2" class="drops" id="drop24" data-dia="Jueves"></td>
                    <td colspan="2" class="drops" id="drop25" data-dia="Viernes"></td>
                </tr>
            </table>
            <button id="enlace-pdf" class="btn-header">Descargar pdf <i class="icon-file-pdf"></i></button>
        </div>
    </div>
</main>
<!--- Javascriprt ---->

<script
src="https://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>
<script type="text/javascript" src="app/resources/libjs/jspdf.min.js"></script>
<script src="app/resources/js/nav.js"></script>
<script src="app/resources/js/loader.js"></script>
<script src="app/resources/js/crud.js"></script>

</body>
</html>
<?php
} else {
    header("Location: index.php?v=fichas");
}
?>