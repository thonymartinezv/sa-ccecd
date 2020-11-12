<?php
require_once("config/config_bd.php"); // Valores de la conexion

class ConexionBD extends PDO
{
	/**
	 * Se asignan las constantes de "config_bd":
	 * Servidor (localhost o dirección IP)
	 * Usuario BD
	 * Clave BD
	 * Nombre BD
	 */
	private $ip_bd = SRV;
	private $usuario_bd = USR;
	private $clave_bd = PAS;
	private $nombre_bd = BDN;
	private $port = PORT;
	private $c_bd;	// Conexion BD

	/**
	 * Establacer conexión a la BD
	 */
	public function conexion_bd() 
	{
		try {
			/**
			 * Data Source Name (DSN)
			 * En el cual se han de especificar lo siguiente: 
			 * Tipo de BD (pgsql); Host del servidor; Nombre BD; Puerto BD (opcional)
			 */
			 $dsn = "pgsql:host=$this->ip_bd;port=$this->port;dbname=$this->nombre_bd";
			
			/**
			 * Database Handle (DBH)
			 * Es el nombre de variable que se suele utilizar para el objeto PDO
			 */
			$dbh = new PDO($dsn, $this->usuario_bd, $this->clave_bd);
		} catch (PDOException $e) {
			/**
			 * Permite manejar los errores
			 * Además de esconder datos que podrían ayudar a alguien a atacar tu aplicación.
			 */
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			echo "Error al Conectar con la Base de Datos: " . $e->getMessage();
		}
		$this->c_bd = $dbh;
		return $this->c_bd;
	}

	/**
	 * Desconexión de la BD
	 */
	public function desconexion_bd() {
		$this->c_bd = null;
	}
}
?>