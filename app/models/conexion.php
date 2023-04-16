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
    public static function conectar() {
        // return mysqli_connect("localhost", "id15516706_admin", "3ki*Bxa{|r#}fD%L", "id15516706_wem");
        return mysqli_connect("localhost", "root", "", "wem");
    }
}

?>