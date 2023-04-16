<?php 
    require_once 'app/controllers/controller.php';
    $controller = new controller();
    $url = $controller->url();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <!------ Required meta tags ------>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/ico" href="app/resources/img/logo.ico">
    <!------- SEO meta tags -------->
    <meta name="description" content="">
    <meta name="author" content="">
    <!-------- Title ------->
    <title>WEM</title>
    <!------ Stylesheets -------->
    <link rel="stylesheet" href="app/resources/css/index.css">
    <link rel="stylesheet" href="app/resources/iconos/icomoon/style.css">
</head>

<body class="hidden">
    <!----------- LOAD ------------>
    <div class="centrado" id="onload">
        <div class="loader">
            <div class="loader-inner"></div>
        </div>
    </div>
    <!------------ NAV--------------->
    <header id="enlace-inicio">
        <nav id="nav" class="nav1">
            <div class="contenedor-nav">
                <div class="logo">
                    <img src="app/resources/img/logo.png" alt="">
                </div>
                <div class="enlaces" id="enlaces">
                    <a data-enlace="#enlace-inicio" class="btn-header">Inicio</a>
                    <a data-enlace="#enlace-equipo" class="btn-header">Equipo</a>
                    <a data-enlace="#enlace-caracteristica" class="btn-header">Características</a>
                    <a data-enlace="#enlace-nosotros" class="btn-header">Nosotros</a>
                    <a data-enlace="#enlace-servicios" class="btn-header">Servicios</a>
                    <a data-enlace="#enlace-contacto" class="btn-header">Contacto</a>
                    <a href="<?php echo $url ?>index.php?v=sesion" id="iniciar-sesion">Iniciar Sesión</a>
                    <a href="<?php echo $url ?>index.php?v=registrar" id="registrarse">Registrarse</a>
                </div>
                <div class="icono" id="open">
                    <span>&#9776;</span>
                </div>
            </div>
        </nav>
        <div class="textos">
            <h1 class="title move">Work Environment Managment</h1>
            <h2 class="subtitle move2">Gestion de Ambientes de Trabajo</h2>
            <a href="<?php echo $url ?>index.php?v=sesion"><button class="btn">Crear Horario</button></a>
        </div>
    </header>
    <!---------- MAIN -------------->
    <main>
        <section class="team contenedor" id="enlace-equipo">
            <h3>Nuestro equipo</h3>
            <p class="after">Conoce a la gente asombrosa y creativa</p>
            <div class="card">
                <div class="content-card">
                    <div class="people">
                        <img src="app/resources/img/foto.png" alt="">
                    </div>
                    <div class="texto-team">
                        <h4>Juan Pablo Guevara González</h4>
                        <p>UX/UI designer</p>
                    </div>
                </div>
                <div class="content-card">
                    <div class="people">
                        <img src="app/resources/img/cristian.png" alt="">
                    </div>
                    <div class="texto-team">
                        <h4>Cristian Antonio Trujillo Grisales</h4>
                        <p>UX/UI designer</p>
                    </div>
                </div>
                <div class="content-card">
                    <div class="people">
                        <img src="app/resources/img/andres.png" alt="">
                    </div>
                    <div class="texto-team">
                        <h4>Pablo Andres Henao Franco</h4>
                        <p>UX/UI designer</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="features" id="enlace-caracteristica">
            <div class="contenedor">
                <h3>Características</h3>
                <p class="after">Nos caracterizámos por ser comprometidos con las dudas que se le puedan presentar a nuestros
                clientes, y estamos prestos a colaborar en su ambiente de trabajo.</p>
                <div class="caracteristicas">
                    <div class="caja-caracteristicas">
                        <img src="app/resources/img/sabiduria.png" alt="">
                        <h4>Sabiduría</h4>
                        <p>Sabemos lo importante que es para nuestros clientes la seguridad.</p>
                    </div>
                    <div class="caja-caracteristicas">
                        <img src="app/resources/img/rendimiento.png" alt="">
                        <h4>Gran rendimineto</h4>
                        <p>Queremos que su tiempo pueda ser utilizado en sus labores mas importantes.</p>
                    </div>
                    <div class="caja-caracteristicas">
                        <img src="app/resources/img/limpio.png" alt="">
                        <h4>Diseño limpio</h4>
                        <p>Queremos que nuentros clientes tengan la mejor experiencia de usuario.</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="about" id="enlace-nosotros">
            <div class="contenedor">
                <h3>Nosotros</h3>
                <div class="about-img">
                    <img src="app/resources/img/reloj.png" alt="">
                </div>
                <div class="about-text">
                    <p>
                        WEM (Work Environment Managment) es una página web realizada por un grupo de
                        deasarrolladores, para dar solución a la creación de horarios de los ambientes de
                        trabajo, inicialmente pensado para el servicio nacional de aprendizaje (SENA) para así
                        agilizar y disminuir el tiempo de creación del mismo y recortar al maximo el tiempo
                        empleado en dicha actividad.
                    </p>
                </div>
            </div>
        </section>
        <section class="service" id="enlace-servicios">
            <div class="contenedor">
                <h3>Nuestros Servicios</h3>
                <p class="after">Siempre mejorando para ti</p>
                <div class="servicios">
                    <div class="caja-servicios">
                        <img src="app/resources/img/idea.png" alt="">
                        <h4>Optimización</h4>
                        <p>Emplee menos tiempo en la elaboración del horario.</p>
                    </div>
                    <div class="caja-servicios">
                        <img src="app/resources/img/calendario.png" alt="">
                        <h4>Agendamiento</h4>
                        <p>Organice rápido y sin errores.</p>
                    </div>
                    <div class="caja-servicios">
                        <img src="app/resources/img/velocidad.png" alt="">
                        <h4>Agilidad</h4>
                        <p>Programe su horario de manera ágil.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!----------------- FOOTER ----------------->
    <footer id="enlace-contacto">
        <div class="footer">
            <div class="marca-logo">
                <img src="app/resources/img/logo.png" alt="">
            </div>
            <div id="frase">
                <p>La pasión e innovación es lo que nos distingue del resto.</p>
            </div>
            <div class="iconos">
                <ul>
                    <li><a href=""><i class="icon icon-facebook">Facebook</i></a></li>
                    <li><a href=""><i class="icon icon-github">GitHub</i></a></li>
                    <li><a href=""><i class="icon icon-youtube">Youtube</i></a></li>
                    <li><a href=""><i class="icon icon-instagram">Instagram</i></a></li>
                    <li><a href=""><i class="icon icon-linkedin">LinkedIn</i></a></li>
                </ul>
            </div>
        </div>
    </footer>
    <!--- Javascriprt ---->
    <script type="text/javascript" src="app/resources/libjs/jquery.min.js"></script>
    <script src="app/resources/js/index.js"></script>
    <script src="app/resources/js/loader.js"></script>
    <script src="app/resources/js/nav.js"></script>
</body>
</html>