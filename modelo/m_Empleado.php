<?php
require_once("modelo/m_BD.php"); // Clase de Conexion de BD

class Empleado extends ConexionBD
{
	//Atributos empleado
	private $email_emp; // string
	private $ci_emp; // int
	private $p_nomb; // string
	private $s_nomb; // string
	private $p_apel; // string
	private $s_apel; // string
	private $fcha_ing; // date
	private $institution; // institución
	private $tlf; // teléfono
	private $cbd; // conexion de la BD

	// Datos necesarios para la creación de usuario
	private $email;
	private $clv; // string
	private $pri; // int
	private $est; // int

	// Privilegio de usuario actual (es quién manipula el CRUD)
	private $pri_emp; // int

	/**
	 * Ejecuta conexion_bd de la clase padre
	 */
	public function __construct() 
	{
		$this->cbd = parent::conexion_bd();
		$this->cbd->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
	}

	/**
	 * Destructor de la clase, se invoca cuando se iguala a null el objeto
	 * Invoca al método desconexion_bd de la clase padre para eliminar la conexion con la BD
	 */
	public function __destruct()
	{
		parent::desconexion_bd();
	}

	/*
	 * Getters (consulta)
	 * Setters (asignación) de los atributos
	 */

	public function setEmail_emp($email_emp) 	//Email
	{ 
		$this->email_emp = $email_emp;
		return $this;   
	}

	public function getEmail_emp() 
	{
		return $this->email_emp;
	}
	
	public function setCI_emp($ci_emp) 	//CI
	{
		$this->ci_emp = $ci_emp;
		return $this;   
	}

	public function getCI_emp()
	{
		return $this->ci_emp;
	}

	public function setP_nomb($p_nomb) 	//Primer nombre
	{
		$this->p_nomb = $p_nomb;
		return $this;   
	}

	public function getP_nomb() 
	{
		return $this->p_nomb;
	}

	public function setS_nomb($s_nomb) 	//Segundo nombre
	{
		$this->s_nomb = $s_nomb;
		return $this;   
	}

	public function getS_nomb()
	{
		return $this->s_nomb;
	}

	public function setP_apel($p_apel) 	//Primer apellido
	{
		$this->p_apel = $p_apel;
		return $this;   
	}

	public function getP_apel() 
	{
		return $this->p_apel;
	}

	public function setS_apel($s_apel) 	//Segundo apellido
	{
		$this->s_apel = $s_apel;
		return $this;   
	}

	public function getS_apel()
	{
		return $this->s_apel;
	}
	
	public function setFcha_ing($fcha_ing) 	//Fecha de ingreso
	{
		$this->fcha_ing = $fcha_ing;
		return $this;   
	}

	public function getFcha_ing()
	{
		return $this->fcha_ing;
	}

	public function setEmail($email) // Email de usuario
	{
		$this->email = $email;
		return $this;
	}

	public function getEmail()  	// No creo que sea necesario PENDIENTE para eliminar en tal caso.
	{ 
		return $this->email;
	}

	public function setClave($clv) 	// Clave de usuario
	{
		$this->clv = $clv;
	}

	public function setPri($pri)	// Privilegio de usuario
	{
		$this->pri = $pri;
	}

	public function getPri()
	{
		return $this->pri;
	}

	public function setEst($est) 	// Estado de usuario
	{
		$this->est = $est;
	}

	public function setInstitution($institution) 	// Institución
	{
		$this->institution = $institution;
	}

	public function setTlf($tlf) 	// teléfono
	{
		$this->tlf = $tlf;
	}


	public function getEst()
	{
		return $this->est;
	}

	public function setPri_emp($pri_emp) // Privilegio de usuario actual
	{
		$this->pri_emp = $pri_emp;
	}

	// CRUD Empleado

	/**
	 * Crear empleado
	 * Crear usuario
	 */
	public function crear_emp($debug = false) 
	{
		try
		{
			$stmt = $this->cbd->prepare("INSERT INTO empleado (email_emp, ci_emp, p_nomb, s_nomb, p_apel, s_apel, fcha_ing, id_institution,tlf)
				VALUES (:Email_emp, :CI_emp, :P_nomb, :S_nomb, :P_apel, :S_apel, now() , :institution, :tlf)");
			$institution = intval($this->institution);
			// Asignamos valores a los parámetros con $stmt->bindParam
			$stmt->bindParam(':Email_emp', $this->email_emp);
			$stmt->bindParam(':CI_emp', $this->ci_emp);
			$stmt->bindParam(':P_nomb', $this->p_nomb);
			$stmt->bindParam(':S_nomb', $this->s_nomb);
			$stmt->bindParam(':P_apel', $this->p_apel);
			$stmt->bindParam(':S_apel', $this->s_apel);
			$stmt->bindParam(':institution', $institution);
			$stmt->bindParam(':tlf', $this->tlf);
			if ($debug) {
				return $stmt;
			}
			
			// $exito es verdadero el empleado fue registrado, entonces, ahora se registra su usuario
			if ($stmt->execute()) {
				$stmt = $this->cbd->prepare("INSERT INTO usuario (email_usu, clave_usu, pri_usu, estado_usu) 
				VALUES (:Email_usu, :Clave_usu, :Pri_usu, 1)");
				$stmt->bindParam(':Email_usu', $this->email_emp); // Se asigna el mismo 'email' para TABLA usuario
				$stmt->bindParam(':Clave_usu', md5($this->clv)); // Asignación de clave
				$stmt->bindParam(':Pri_usu', $this->pri); // Asignación de privilegio (es el CARGO de OTIC)
				$exito = $stmt->execute();
				return $exito; // Retorna verdadero si se registra el usuario, caso contrario, devuelve falso
			}
		} catch(PDOException $error) {
			echo "Error: ejecutando consulta SQL." .$error->getMessage();// Mostramos un mensame genérico de error.
			exit();
		}
	}

	/**
	 * Consultar empleados
	 */
	public function all($cantidad,$primero)
	{
		try 
		{
			$stmt = $this->cbd->prepare(
				"	SELECT empleado.*, usuario.estado_usu , usuario.pri_usu ,
					institution.nombre as institution
					FROM empleado
					INNER JOIN usuario
					ON empleado.email_emp = usuario.email_usu
					INNER JOIN institution
					ON empleado.id_institution = institution.id
					LIMIT :cantidad OFFSET :primero
			");
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->bindParam(':cantidad', $cantidad);
			$stmt->bindParam(':primero', $primero);
			$stmt->execute();
			return $stmt->fetchAll();
		} catch(PDOException $error) {
			echo "Error: ejecutando consulta SQL.".$error->getMessage();
			exit();
		}
	}

	public function all_count()
	{
		try 
		{
			$stmt = $this->cbd->prepare(
				"	SELECT count(*)
					FROM empleado
					INNER JOIN usuario
					ON empleado.email_emp = usuario.email_usu
			");
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->execute();
			$result = $stmt->fetchAll()[0];
			return $result[array_keys($result)[0]];
		} catch(PDOException $error) {
			echo "Error: ejecutando consulta SQL.".$error->getMessage();
			exit();
		}
	}

	public function searchByEmail($search,$cantidad = 1,$primero = 0)
	{
		try 
		{
			$stmt = $this->cbd->prepare(
				"	SELECT empleado.*, usuario.estado_usu , usuario.pri_usu ,
					institution.nombre as institution
					FROM empleado
					INNER JOIN usuario
					ON empleado.email_emp = usuario.email_usu 
					INNER JOIN institution
					ON empleado.id_institution = institution.id
					where empleado.email_emp like :email
					LIMIT :cantidad OFFSET :primero
			");
			$search = "%$search%";
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->bindParam(':email', $search);
			$stmt->bindParam(':cantidad', $cantidad);
			$stmt->bindParam(':primero', $primero);
			$stmt->execute();
			return $stmt->fetchAll();
		} catch(PDOException $error) {
			echo "Error: ejecutando consulta SQL.".$error->getMessage();
			exit();
		}
	}

	public function searchByEmail_count($search)
	{
		try 
		{
			$stmt = $this->cbd->prepare(
				"	SELECT count(*)
					FROM empleado
					INNER JOIN usuario
					ON empleado.email_emp = usuario.email_usu
					where empleado.email_emp like :email
			");
			$search = "%$search%";
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->bindParam(':email', $search);
			$stmt->execute();
			$result = $stmt->fetchAll()[0];
			return $result[array_keys($result)[0]];
		} catch(PDOException $error) {
			echo "Error: ejecutando consulta SQL.".$error->getMessage();
			exit();
		}
	}

	public function findByEmail($email)
	{
		return $this->searchByEmail($email)[0];
	}

	public function searchByCi($ci,$cantidad,$primero)
	{
		try 
		{
			$stmt = $this->cbd->prepare(
				"	SELECT empleado.*, usuario.estado_usu , usuario.pri_usu , 
					institution.nombre as institution
					FROM empleado
					INNER JOIN usuario
					ON empleado.email_emp = usuario.email_usu 
					INNER JOIN institution
					ON empleado.id_institution = institution.id
					where empleado.ci_emp = :ci
					LIMIT :cantidad OFFSET :primero
			");
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->bindParam(':ci', $ci);
			$stmt->bindParam(':cantidad', $cantidad);
			$stmt->bindParam(':primero', $primero);
			$stmt->execute();
			return $stmt->fetchAll();
		} catch(PDOException $error) {
			echo "Error: ejecutando consulta SQL.".$error->getMessage();
			exit();
		}
	}

	public function searchByCi_count($ci)
	{
		try 
		{
			$stmt = $this->cbd->prepare(
				"	SELECT count(*)
					FROM empleado
					INNER JOIN usuario
					ON empleado.email_emp = usuario.email_usu 
					where empleado.ci_emp = :ci
			");
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->bindParam(':ci', $ci);
			$stmt->execute();
			$result = $stmt->fetchAll()[0];
			return $result[array_keys($result)[0]];
		} catch(PDOException $error) {
			echo "Error: ejecutando consulta SQL.".$error->getMessage();
			exit();
		}
	}

	/**
	 * Consultar perfil de un empleado
	 * Para ello, se debe saber cuál es su email o correo electrónico
	 */
	public function find()
	{
		try
		{
			$stmt = $this->cbd->prepare("SELECT * FROM empleado WHERE email_emp = :email_usu");
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->bindParam(':email_usu', $this->email);
			$stmt->execute();
			$consulta[0] = $stmt->fetchAll();
			$stmt = $this->cbd->prepare("SELECT pri_usu, estado_usu FROM usuario WHERE email_usu = :email_usu");
			$stmt->bindParam(':email_usu', $this->email);
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->execute();
			$consulta[1] = $stmt->fetchAll();
			return $consulta; // Devuelve los resultados obtenidos de las dos tablas
		} catch(PDOException $error) {		    
			echo "Error: ejecutando consulta SQL.".$error->getMessage();
			exit();
		}
	}
	public function existCi($ci)
	{
		try
		{
			$stmt = $this->cbd->prepare("SELECT * from empleado WHERE ci_emp = :ci_emp");

			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->bindParam(':ci_emp', $ci);
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

	public function existByinst($inst)
	{
		try
		{
			$stmt = $this->cbd->prepare("SELECT * from empleado WHERE id_institution = :id_institution");

			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->bindParam(':id_institution', $inst);
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

	/**
	 * Actualizar empleado
	 * Parámetros: 
	 * Email viejo (anterior al cambio)
	 * Estado (opcional)
	 * Privilegio del usuario (opcional)
	 * Privilegio del empleado que hace la actualización (necesario)
	 */
	public function actualizar_emp()
	{
		/** 
		 * El Administrador (DG y SAO) pueden actualizar información personal SAO, DIS y ellos mismos.
		 * En ningún caso se puede cambiar información personal de ningún DG excepto por él mismo
		 */
		try 
		{
			$stmt = $this->cbd->prepare("UPDATE empleado SET email_emp = :email_emp, ci_emp = :ci_emp, p_nomb = :p_nomb, 
				s_nomb = :s_nomb, p_apel = :p_apel, s_apel = :s_apel, id_institution = :institution, tlf = :tlf  WHERE email_emp = :email_usu");
			$institution = intval($this->institution);
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->bindParam(':email_emp', $this->email_emp);
			$stmt->bindParam(':ci_emp', $this->ci_emp);
			$stmt->bindParam(':p_nomb', $this->p_nomb);
			$stmt->bindParam(':s_nomb', $this->s_nomb);
			$stmt->bindParam(':p_apel', $this->p_apel);
			$stmt->bindParam(':s_apel', $this->s_apel);
			$stmt->bindParam(':email_usu', $this->email);
			$stmt->bindParam(':institution', $institution);
			$stmt->bindParam(':tlf', $this->tlf);
			$exito = $stmt->execute();
			/**
			 * Sólo se permite sí es DG. Puede cambiar estado y privilegio de DG anteriores, SAO, DIS
			 */
			if ( $this->pri_emp != null && $this->pri_emp > 0) {
				$stmt = $this->cbd->prepare("UPDATE usuario SET email_usu = :email_emp ,pri_usu = :pri_usu WHERE email_usu = :email_usu");
				$stmt->setFetchMode(PDO::FETCH_ASSOC);
				$stmt->bindParam(':pri_usu', $this->pri);
				$stmt->bindParam(':email_emp', $this->email_emp);
				$stmt->bindParam(':email_usu', $this->email);
				$stmt->execute();
			}
			if ($_SESSION['email_otic'] == $this->email) {
				$_SESSION['email_otic'] = $this->email_emp;
			}
		} catch (PDOException $error) {
			echo "Error: ejecutando consulta SQL.".$error->getMessage(); // Mostramos un mensame genérico de error.
			exit();			
		}
		return $exito;
	}

	public function actualizar_pass()
	{
		try 
		{
			if ( $this->pri_emp != null && $this->pri_emp > 0 || $this->email_emp == $_SESSION['email_otic']) {
				$stmt = $this->cbd->prepare("UPDATE usuario SET clave_usu = :clave_usu WHERE email_usu = :email_usu");
				$stmt->setFetchMode(PDO::FETCH_ASSOC);
				$stmt->bindParam(':clave_usu', md5($this->clv));
				$stmt->bindParam(':email_usu', $this->email_emp);
				$exito = $stmt->execute();
			}
		} catch (PDOException $error) {
			echo "Error: ejecutando consulta SQL.".$error->getMessage(); // Mostramos un mensame genérico de error.
			exit();			
		}
		return $exito;
	}



	/**
	 * Eliminar empleado
	 */
	public function eliminar_emp()
	{
		try 
		{
			$stmt = $this->cbd->prepare("UPDATE usuario SET estado_usu = :estado_usu WHERE email_usu = :email_usu");
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->bindParam(':estado_usu', $this->est);
			$stmt->bindParam(':email_usu', $this->email);
			$exito = $stmt->execute();
			return $exito;
		} catch (PDOException $error) {
			echo "Error: ejecutando consulta SQL.".$error->getMessage(); // Mostramos un mensame genérico de error.
			exit();
			}
	}
}
?>