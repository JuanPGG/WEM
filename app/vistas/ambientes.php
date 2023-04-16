<?php
@session_start();
require_once "app/controllers/controller.php";
$controller = new controller();
$url = $controller->url();
if (!isset($_SESSION['user'])) {
    header("Location: {$url}index.php");
}
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
    <title>Horario Ambientes | WEM</title>
    <!--- Stylesheets --->
    <link rel="stylesheet" href="app/resources/css/horario.css">
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
                    <?php
                    if ($_SESSION['user'][6] == 1) {
                    ?>
                        <a href="<?php echo $url ?>index.php?v=adminFichas" id="enlace-fichas" class="btn-header">Mis Fichas</a>
                        <a href="<?php echo $url ?>index.php?v=adminForms" id="enlace-registros" class="btn-header">Registros</a>
                    <?php

                    } else if ($_SESSION['user'][6] == 2) {
                    ?>
                        <a href="<?php echo $url ?>index.php?v=fichas" id="enlace-fichas" class="btn-header">Fichas</a>
                    <?php } ?>
                    <a href="<?php echo $url ?>index.php?v=detallesInstructor" class="btn-header">Instructores</a>
                    <a id="enlace-atras" class="btn-header">Atrás</a>
                    <a href="<?php echo $url ?>index.php?v=perfil" id="iniciar-sesion"><?php echo $_SESSION['user'][1]; ?></a>
                    <a href="app/models/salir.php" id="salir">Cerrar Sesión</a>
                </div>
                <div class="icono" id="open">
                    <span>&#9776;</span>
                </div>
            </div>
        </nav>
    </header>
    <!---------- MAIN -------------->
    <main>
        <div class="table" data-id="<?php echo $_SESSION['user'][0]; ?>">
            <div class="thead">
                <div id="th_jornada"><b>Jornada: </b>
                    <select name="jornada" id="jornada">
                        <option value="mañana">Mañana</option>
                        <option value="tarde">Tarde</option>
                        <option value="noche">Noche</option>
                    </select>
                </div>
                <div id="fecha">Fecha:
                    <select id="select_fecha"></select>
                </div>
                <div id="ambiente">Ambiente:
                    <select id="select_ambiente"></select>
                </div>
                <div>
                    <p>Horas programadas:
                        <span id="horasp"></span>
                    </p>
                </div>
            </div>
            <div class="cont_table">
                <table>
                    <thead>
                        <tr>
                            <th colspan="2">Hora</th>
                            <th colspan="2">Lunes</th>
                            <th colspan="2">Martes</th>
                            <th colspan="2">Miercoles</th>
                            <th colspan="2">Jueves</th>
                            <th colspan="2">Viernes</th>
                            <th colspan="2">Sabado</th>
                        </tr>
                    </thead>
                    <tbody id="mañana">
                        <tr data-inicio="06:00:00" data-fin="07:00:00">
                            <th colspan="2" class="horas">6:00AM / 7:00AM</th>
                            <td colspan="2" class="drops" id="drop1" data-dia="Lunes"></td>
                            <td colspan="2" class="drops" id="drop2" data-dia="Martes"></td>
                            <td colspan="2" class="drops" id="drop3" data-dia="Miercoles"></td>
                            <td colspan="2" class="drops" id="drop4" data-dia="Jueves"></td>
                            <td colspan="2" class="drops" id="drop5" data-dia="Viernes"></td>
                            <td colspan="2" class="drops" id="drop6" data-dia="Sabado"></td>
                        </tr>
                        <tr data-inicio="07:00:00" data-fin="08:00:00">
                            <th colspan="2" class="horas">7:00AM / 8:00AM</th>
                            <td colspan="2" class="drops" id="drop7" data-dia="Lunes"></td>
                            <td colspan="2" class="drops" id="drop8" data-dia="Martes"></td>
                            <td colspan="2" class="drops" id="drop9" data-dia="Miercoles"></td>
                            <td colspan="2" class="drops" id="drop10" data-dia="Jueves"></td>
                            <td colspan="2" class="drops" id="drop11" data-dia="Viernes"></td>
                            <td colspan="2" class="drops" id="drop12" data-dia="Sabado"></td>
                        </tr>
                        <tr data-inicio="08:00:00" data-fin="09:00:00">
                            <th colspan="2" class="horas">8:00AM / 9:00AM</th>
                            <td colspan="2" class="drops" id="drop13" data-dia="Lunes"></td>
                            <td colspan="2" class="drops" id="drop14" data-dia="Martes"></td>
                            <td colspan="2" class="drops" id="drop15" data-dia="Miercoles"></td>
                            <td colspan="2" class="drops" id="drop16" data-dia="Jueves"></td>
                            <td colspan="2" class="drops" id="drop17" data-dia="Viernes"></td>
                            <td colspan="2" class="drops" id="drop18" data-dia="Sabado"></td>
                        </tr>
                        <tr data-inicio="09:00:00" data-fin="10:00:00">
                            <th colspan="2" class="horas">9:00AM / 10:00AM</th>
                            <td colspan="2" class="drops" id="drop19" data-dia="Lunes"></td>
                            <td colspan="2" class="drops" id="drop20" data-dia="Martes"></td>
                            <td colspan="2" class="drops" id="drop21" data-dia="Miercoles"></td>
                            <td colspan="2" class="drops" id="drop22" data-dia="Jueves"></td>
                            <td colspan="2" class="drops" id="drop23" data-dia="Viernes"></td>
                            <td colspan="2" class="drops" id="drop24" data-dia="Sabado"></td>
                        </tr>
                        <tr data-inicio="10:00:00" data-fin="11:00:00">
                            <th colspan="2" class="horas">10:00AM / 11:00AM</th>
                            <td colspan="2" class="drops" id="drop25" data-dia="Lunes"></td>
                            <td colspan="2" class="drops" id="drop26" data-dia="Martes"></td>
                            <td colspan="2" class="drops" id="drop27" data-dia="Miercoles"></td>
                            <td colspan="2" class="drops" id="drop28" data-dia="Jueves"></td>
                            <td colspan="2" class="drops" id="drop29" data-dia="Viernes"></td>
                            <td colspan="2" class="drops" id="drop30" data-dia="Sabado"></td>
                        </tr>
                        <tr data-inicio="11:00:00" data-fin="12:00:00">
                            <th colspan="2" class="horas">11:00AM / 12:00PM</th>
                            <td colspan="2" class="drops" id="drop31" data-dia="Lunes"></td>
                            <td colspan="2" class="drops" id="drop32" data-dia="Martes"></td>
                            <td colspan="2" class="drops" id="drop33" data-dia="Miercoles"></td>
                            <td colspan="2" class="drops" id="drop34" data-dia="Jueves"></td>
                            <td colspan="2" class="drops" id="drop35" data-dia="Viernes"></td>
                            <td colspan="2" class="drops" id="drop36" data-dia="Sabado"></td>
                        </tr>
                    </tbody>
                    <tbody id="tarde">
                        <tr data-inicio="12:00:00" data-fin="13:00:00">
                            <th colspan="2" class="horas">12:00PM / 1:00PM</th>
                            <td colspan="2" class="drops" id="drop37" data-dia="Lunes"></td>
                            <td colspan="2" class="drops" id="drop38" data-dia="Martes"></td>
                            <td colspan="2" class="drops" id="drop39" data-dia="Miercoles"></td>
                            <td colspan="2" class="drops" id="drop40" data-dia="Jueves"></td>
                            <td colspan="2" class="drops" id="drop41" data-dia="Viernes"></td>
                            <td colspan="2" class="drops" id="drop42" data-dia="Sabado"></td>
                        </tr>
                        <tr data-inicio="13:00:00" data-fin="14:00:00">
                            <th colspan="2" class="horas">1:00PM / 2:00PM</th>
                            <td colspan="2" class="drops" id="drop43" data-dia="Lunes"></td>
                            <td colspan="2" class="drops" id="drop44" data-dia="Martes"></td>
                            <td colspan="2" class="drops" id="drop45" data-dia="Miercoles"></td>
                            <td colspan="2" class="drops" id="drop46" data-dia="Jueves"></td>
                            <td colspan="2" class="drops" id="drop47" data-dia="Viernes"></td>
                            <td colspan="2" class="drops" id="drop48" data-dia="Sabado"></td>
                        </tr>
                        <tr data-inicio="14:00:00" data-fin="15:00:00">
                            <th colspan="2" class="horas">2:00PM / 3:00PM</th>
                            <td colspan="2" class="drops" id="drop49" data-dia="Lunes"></td>
                            <td colspan="2" class="drops" id="drop50" data-dia="Martes"></td>
                            <td colspan="2" class="drops" id="drop51" data-dia="Miercoles"></td>
                            <td colspan="2" class="drops" id="drop52" data-dia="Jueves"></td>
                            <td colspan="2" class="drops" id="drop53" data-dia="Viernes"></td>
                            <td colspan="2" class="drops" id="drop54" data-dia="Sabado"></td>
                        </tr>
                        <tr data-inicio="15:00:00" data-fin="16:00:00">
                            <th colspan="2" class="horas">3:00PM / 4:00PM</th>
                            <td colspan="2" class="drops" id="drop55" data-dia="Lunes"></td>
                            <td colspan="2" class="drops" id="drop56" data-dia="Martes"></td>
                            <td colspan="2" class="drops" id="drop57" data-dia="Miercoles"></td>
                            <td colspan="2" class="drops" id="drop58" data-dia="Jueves"></td>
                            <td colspan="2" class="drops" id="drop59" data-dia="Viernes"></td>
                            <td colspan="2" class="drops" id="drop60" data-dia="Sabado"></td>
                        </tr>
                        <tr data-inicio="16:00:00" data-fin="17:00:00">
                            <th colspan="2" class="horas">4:00PM / 5:00PM</th>
                            <td colspan="2" class="drops" id="drop61" data-dia="Lunes"></td>
                            <td colspan="2" class="drops" id="drop62" data-dia="Martes"></td>
                            <td colspan="2" class="drops" id="drop63" data-dia="Miercoles"></td>
                            <td colspan="2" class="drops" id="drop64" data-dia="Jueves"></td>
                            <td colspan="2" class="drops" id="drop65" data-dia="Viernes"></td>
                            <td colspan="2" class="drops" id="drop66" data-dia="Sabado"></td>
                        </tr>
                        <tr data-inicio="17:00:00" data-fin="18:00:00">
                            <th colspan="2" class="horas">5:00PM / 6:00PM</th>
                            <td colspan="2" class="drops" id="drop67" data-dia="Lunes"></td>
                            <td colspan="2" class="drops" id="drop68" data-dia="Martes"></td>
                            <td colspan="2" class="drops" id="drop69" data-dia="Miercoles"></td>
                            <td colspan="2" class="drops" id="drop70" data-dia="Jueves"></td>
                            <td colspan="2" class="drops" id="drop71" data-dia="Viernes"></td>
                            <td colspan="2" class="drops" id="drop72" data-dia="Sabado"></td>
                        </tr>
                    </tbody>
                    <tbody id="noche">
                        <tr data-inicio="18:00:00" data-fin="19:00:00">
                            <th colspan="2" class="horas">6:00PM / 7:00PM</th>
                            <td colspan="2" class="drops" id="drop73" data-dia="Lunes"></td>
                            <td colspan="2" class="drops" id="drop74" data-dia="Martes"></td>
                            <td colspan="2" class="drops" id="drop75" data-dia="Miercoles"></td>
                            <td colspan="2" class="drops" id="drop76" data-dia="Jueves"></td>
                            <td colspan="2" class="drops" id="drop77" data-dia="Viernes"></td>
                            <td colspan="2" class="drops" id="drop78" data-dia="Sabado"></td>
                        </tr>
                        <tr data-inicio="19:00:00" data-fin="20:00:00">
                            <th colspan="2" class="horas">7:00PM / 8:00PM</th>
                            <td colspan="2" class="drops" id="drop79" data-dia="Lunes"></td>
                            <td colspan="2" class="drops" id="drop80" data-dia="Martes"></td>
                            <td colspan="2" class="drops" id="drop81" data-dia="Miercoles"></td>
                            <td colspan="2" class="drops" id="drop82" data-dia="Jueves"></td>
                            <td colspan="2" class="drops" id="drop83" data-dia="Viernes"></td>
                            <td colspan="2" class="drops" id="drop84" data-dia="Sabado"></td>
                        </tr>
                        <tr data-inicio="20:00:00" data-fin="21:00:00">
                            <th colspan="2" class="horas">8:00PM / 9:00PM</th>
                            <td colspan="2" class="drops" id="drop85" data-dia="Lunes"></td>
                            <td colspan="2" class="drops" id="drop86" data-dia="Martes"></td>
                            <td colspan="2" class="drops" id="drop87" data-dia="Miercoles"></td>
                            <td colspan="2" class="drops" id="drop88" data-dia="Jueves"></td>
                            <td colspan="2" class="drops" id="drop89" data-dia="Viernes"></td>
                            <td colspan="2" class="drops" id="drop90" data-dia="Sabado"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button id="enlace-pdf" class="btn">Descargar pdf <i class="icon-file-pdf"></i></button>
        </div>
        </div>
    </main>
    <!--- Javascriprt ---->

    <script type="text/javascript" src="app/resources/libjs/jquery.min.js"></script>
    <script type="text/javascript" src="app/resources/libjs/jspdf.min.js"></script>
    <script src="app/resources/js/nav.js"></script>
    <script src="app/resources/js/loader.js"></script>
    <script src="app/resources/js/funciones.js"></script>
    <script src="app/resources/js/ambientes.js"></script>

</body>

</html>