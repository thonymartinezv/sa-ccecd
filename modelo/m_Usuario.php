<?php
require_once("modelo/m_BD.php"); // Clase de Conexion de BD

class Usuario extends ConexionBD 
{
	//Atributos
	private $email_usu; // email (fk) string
	private $clave_usu; // string
	private $pri_usu; // int (DG 2, SAO 1, DIS 0)
	private $estado_usu; // int (Bloqueado 2, Activo 1, Inactivo 0)
	private $cbd; // conexion de la BD

	/**
	 * Constructor de la clase
	 * Ejecuta conexion_bd de la clase padre
	 */
	public function __construct() {
		$this->cbd = parent::conexion_bd();
		$this->cbd->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
	}

	/**
	 * Destructor de la clase
	 * Se invoca cuando se iguala a null el objeto
	 * Invoca al método desconexion_bd de la clase padre para eliminar la conexion con la BD
	 */
	public function __destruct() {
		parent::desconexion_bd();
	}

	/**
	 * Métodos Getters (consulta)
	 * Setter (asignación) de los atributos
	 */
	public function setEmail_usu($email_usu) 	//Email
	{
		$this->email_usu = $email_usu;
		return $this;   
	}
		
	public function getEmail_usu() {
		return $this->email_usu;
	}

	public function setClave_usu($clave_usu) //Clave
	{
		$this->clave_usu = $clave_usu;
		return $this;   
	}
		
	public function getClave_usu() {
		return $this->clave_usu;
	}

	public function setPri_usu($pri_usu) //Privilegio
	{
		$this->pri_usu = $pri_usu;
		return $this;   
	}
		
	public function getPri_usu() {
		return $this->pri_usu;
	}

	public function setEstado_usu($estado_usu) //Estado
	{
		$this->estado_usu = $estado_usu;
		return $this;   
	}	

	public function getEstado_usu() {
		return $this->estado_usu;
	}

	/**
	 * Iniciar sesión
	 * Autenticación en el sistema de bitácora del CCECD
	 */
	public function iniciar_sesion()
	{
		/**
		 * Estado del usuario debe ser 'Activo' (1)
		 */
		$est = 1;

		try
		{
			$stmt = $this->cbd->prepare("SELECT email_usu, pri_usu, estado_usu FROM usuario 
				WHERE email_usu = :email_usu AND clave_usu = :clave_usu AND estado_usu = :estado_usu");
			$pass = md5($this->clave_usu);
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->bindParam(':email_usu', $this->email_usu);
			$stmt->bindParam(':clave_usu', $pass);
			$stmt->bindParam(':estado_usu', $est);
			/**
			 * Se verifica si la consuta tiene éxito
			 */
			if ($stmt->execute()) { // 
				$exito = $stmt->fetchAll();
				/**
				 * Condición que determina si los datos ingresados son correctos
				 * sí es así, se asignan los atributos de privilegio y estado, para generar la sesión en el sistema CCECD.
				 */
				if ($exito) {
					$this->setPri_usu($exito[0]["pri_usu"]);
					$this->setEstado_usu($exito[0]["estado_usu"]);
					$exito = true;
				}
			} else {
				
				$exito = false;
			}
			return $exito;		
		} catch (PDOException $error) {
			echo "Error: ejecutando consulta SQL.".$error->getMessage(); // Mostramos un mensaje genérico de error
			exit();
		}
	}

	public function existEmail($email)
	{
		try
		{
			$stmt = $this->cbd->prepare("SELECT * from usuario WHERE email_usu = :email_usu");

			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->bindParam(':email_usu', $email);
			/**
			 * Se verifica si la consuta tiene éxito
			 */
			if ($stmt->execute()) { 
				$exito = $stmt->fetchAll();
			} else {
				$exito = false;
			}
			return $exito;		
		} catch (PDOException $error) {
			echo "Error: ejecutando consulta SQL.".$error->getMessage(); // Mostramos un mensaje genérico de error
			exit();
		}
	}
}