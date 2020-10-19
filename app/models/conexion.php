<?php
/**
 * conexion
 * En esta clase se conecta con la base de datos
 */
class Conexion {
	/**
	 * @__construct
	 */
    private function __construct() {}
    /**
     * @connection
	 * Se reañiza la conexión con la base de datos
	 * @return Retorna la conexion con la base de datos mysql
	 */
    public function conectar() {
        return mysqli_connect("localhost", "root", "", "wem");
    }
}

?>