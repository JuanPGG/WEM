<?php
/**
 *Se inicia la sesión
 */
@session_start();
/**
 * Se detruye la sesión
 */
session_destroy();
/**
 * Se redirecciona al index.php
 */
header('Location: ../../index.php');
?>