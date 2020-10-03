<?php
require_once 'app/controllers/redirec_controller.php';

$controller = new redirec_controller();
if (!empty($_GET['v'])) {
    $metodo = $_GET['v'];
    if (method_exists($controller, $metodo)) {
        if (!empty($_GET['p'])) {
            $controller->$metodo($_GET['p']);
            return;
        }
        $controller->$metodo();
    } else {
        $controller->index();
    }
} else {
    $controller->index();
}

?>

