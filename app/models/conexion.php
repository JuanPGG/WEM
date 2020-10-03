<?php

class Conexion {

    private function __construct() {}
    public function connection() {
        return mysqli_connect("localhost", "root", "", "proyecto");
    }
}

?>