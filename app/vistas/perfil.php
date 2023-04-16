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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/ico" href="app/resources/img/logo.ico">
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
                    <?php
if ($_SESSION['user'][6] == 1) {
    ?>
                    <a href="<?php echo $url ?>index.php?v=adminFichas" id="enlace-ambientes" class="btn-header">Mis Fichas</a>
                    <?php

} else if ($_SESSION['user'][6] == 2) {
    ?>
                    <a href="<?php echo $url ?>index.php?v=fichas" id="enlace-ambientes" class="btn-header">Fichas</a>
                <?php }?>
                    <a href="<?php echo $url ?>index.php?v=detallesInstructor" class="btn-header">Instructores</a>
                    <a href="<?php echo $url ?>index.php?v=detallesAmbiente" class="btn-header">Ambientes</a>
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
                <div id="form" class="formulario">
                    <form method="POST" id="usuario">
                        <input class="input" type="text" id="nombre">
                        <label>Nombres</label>
                        <input class="input" type="text" id="apellido">
                        <label>Apellidos</label>
                        <input class="input" type="text" id="correo" disabled>
                        <label>Correo</label>
                        <button type="submit" id="guardar" name="guardar">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

<script type="text/javascript" src="app/resources/libjs/jquery.min.js"></script>
<script src="app/resources/js/loader.js"></script>
<script src="app/resources/js/nav.js"></script>
<script src="app/resources/js/funciones.js"></script>
<script src="app/resources/js/perfil.js"></script>
</body>
</html>