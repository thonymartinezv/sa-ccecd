<?php
require_once("modelo/m_BD.php"); // Clase de Conexion de BD

class Acceso extends ConexionBD
{
	//Atributos acceso
	private $id_acc; // Identificador acceso -> serial
	private	$ci_mon; // CI DIS -> int
	private	$ci_adm; // CI administrador -> int
	private	$fh_c; // Fecha y hora inicial -> date
	private	$fh_f; // Fecha y hora final -> date
	private	$mot; // Motivo de ingreso a las instalaciones del CCECD -> varchar
	private	$avance; // Detalles y avances del acceso -> varchar
	private	$est_acc; // Estado del acceso -> int
	private	$pri_acc; // Prioridad de atención del acceso: Baja, Moderada, Alta -> int
	private $cbd; // conexion de la BD -> bool
	private $est_ami; // Estadistica año y mes de inicio
	private $est_amf; // Estadistica año, mes y día final

	/*
	 * Getters (consulta)
	 * Setters (asignación) de los atributos
	 */

	//CI Monitoreo del personal técnico del DIS
	public function setID_acc($valor) { 
		$this->id_acc = $valor;   
	} 
	public function getID_acc() {
		return $this->id_acc;
	}	

	//CI Monitoreo del personal técnico del DIS
	public function setCI_mon($valor) { 
		$this->ci_mon = $valor;   
	} 
	public function getCI_mon() {
		return $this->ci_mon;
	}	

	//CI Administrador del personal DG o SAO
	public function setCI_adm($valor) { 
		$this->ci_adm = $valor;   
	}
	public function getCI_adm() {
		return $this->ci_adm;
	}	

	//Fecha y hora inicial
	public function setFh_c($valor) { 
		$this->fh_c = $valor;   
	}
	public function getFh_c() {
		return $this->fh_c;
	}

	//Fecha y hora final
	public function setFh_f($valor) { 
		$this->fh_f = $valor;   
	}
	public function getFh_f() {
		return $this->fh_f;
	}

	//Motivo de acceso
	public function setMotivo($valor) { 
		$this->mot = $valor;   
	}
	public function getMotivo() {
		return $this->mot;
	}	

	//Avance de acceso
	public function setAvance($valor) { 
		$this->avance = $valor;   
	}
	public function getMot() {
		return $this->avance;
	}

	//Estado de acceso
	public function setEstado($valor) { 
		$this->est_acc = $valor;   
	}
	public function getEstado() {
		return $this->est_acc;
	}

	//Prioridad de atención del acceso
	public function setNivel($valor) { 
		$this->pri_acc = $valor;
	}
	public function getNivel() {
		return $this->pri_acc;
	}

	//Fecha de año y mes para estadistica inicio
	public function setEst_i($valor) { 
		$this->est_ami = $valor;
	}
	public function getEst_i() {
		return $this->est_ami;
	}

	//Fecha de año, mes y dia para estadistica final
	public function setEst_f($valor) { 
		$this->est_amf = $valor;
	}
	public function getEst_f() {
		return $this->est_amf;
	}

	/**
	 * Ejecuta conexion_bd de la clase padre
	 */
	public function __construct() 
	{
		$this->cbd = parent::conexion_bd();
	}

	/**
	 * Destructor de la clase, se invoca cuando se iguala a null el objeto
	 * Invoca al método desconexion_bd de la clase padre para eliminar la conexion con la BD
	 */
	public function __destruct()
	{
		parent::desconexion_bd();
	}

	// CRUD Acceso

	/**
	 * Consultar personal técnico Monitoreo (DIS) en estado activo o habilitado
	 */
	public function consultar_dis()
	{
		try {
			$stmt = $this->cbd->prepare("SELECT ci_emp, p_nomb, p_apel FROM empleado, usuario 
				WHERE email_emp = email_usu AND pri_usu = 0 AND estado_usu = 1");
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->execute();
			return $stmt->FetchAll();
		} catch (Exception $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	/**
	 * Crear acceso
	 */
	public function crear_acc()
	{
		try 
		{
			$stmt = $this->cbd->prepare("INSERT INTO acceso (ci_mon, ci_adm, fcha_inicio, motivo, estado_acc, prioridad,avance)
				VALUES (:cimon, :ciadm, now()::timestamp(0), :mot, :est, :pri,:avance)");
			$stmt->bindParam(":cimon",$this->ci_mon);//*
			$stmt->bindParam(":pri",$this->pri_acc);//*
			$stmt->bindParam(":mot",$this->mot);//*
			$stmt->bindParam(":est",$this->est_acc);//*
			$stmt->bindParam(":ciadm",$this->ci_adm);//*
			$stmt->bindParam(":avance",$this->avance);//*
			return $stmt->execute();
		} catch (Exception $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	/**
	 * Consultar accesos en cualquier estado
	public function consultar_acc()
	{
		try 
		{
			$stmt = $this->cbd->prepare("SELECT * FROM acceso ORDER BY id_acc");
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->FetchAll();
		} catch(Exception $e) {
			print "Error: ". $e->getMessage();
		}
	}
	*/

	public function consultar_acc()
	{
		try 
		{
			$stmt = $this->cbd->prepare("SELECT a.*,mon.p_nomb mon_nombre,adm.p_nomb adm_nombre FROM acceso a
										 INNER JOIN empleado mon ON mon.ci_emp = a.ci_mon
										 INNER JOIN empleado adm ON adm.ci_emp = a.ci_adm
										");
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->FetchAll();
		} catch(Exception $e) {
			print "Error: ". $e->getMessage();
		}
	}

	public function consultar_acc_by_all($desde,$hasta,$estado,$prioridad)
	{
		try 
		{
			$query = "SELECT a.*,mon.p_nomb mon_nombre,adm.p_nomb adm_nombre FROM acceso a
					  INNER JOIN empleado mon ON mon.ci_emp = a.ci_mon
					  INNER JOIN empleado adm ON adm.ci_emp = a.ci_adm WHERE"
					  .($desde!=""?" fcha_inicio >= :desde AND":"")
					  .($hasta!=""?" fcha_inicio <= :hasta AND":"")
					  .($estado!="-1"?" estado_acc = :estado AND":"")
					  .($prioridad!="-1"?" prioridad = :prioridad":"");

			if (substr($query,-3) == "AND") {
				$query = substr($query,0,-3);
			}
			if (substr($query,-5) == "WHERE") {
				$query = substr($query,0,-5);
			}
			$stmt = $this->cbd->prepare($query);
			if($desde != ""){$desde.=" 00:00:00";$stmt->bindParam(":desde",$desde);}
			if($hasta != ""){$hasta.=" 23:59:59";$stmt->bindParam(":hasta",$hasta);}
			if($estado !="-1"){$stmt->bindParam(":estado",$estado);}
			if($prioridad !="-1"){$stmt->bindParam(":prioridad",$prioridad);}
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->FetchAll();
		} catch(Exception $e) {
			print "Error: ". $e->getMessage();
		}
	}

	public function consultar_acc_proceso()
	{
		try 
		{
			$query = "SELECT a.*,mon.p_nomb mon_nombre,adm.p_nomb adm_nombre FROM acceso a
					  INNER JOIN empleado mon ON mon.ci_emp = a.ci_mon
					  INNER JOIN empleado adm ON adm.ci_emp = a.ci_adm WHERE estado_acc = 0";
			$stmt = $this->cbd->prepare($query);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->FetchAll();
		} catch(Exception $e) {
			print "Error: ". $e->getMessage();
		}
	}

	/**
	 * Ver acceso especifico
	 */
	public function ver_acc()
	{
		try 
		{
			$stmt = $this->cbd->prepare("SELECT * FROM acceso WHERE id_acc = :id_acc");
			$stmt->execute([":id_acc"=>$this->id_acc]);
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->FetchAll();
		} catch(Exception $e) {
			print "Error: ". $e->getMessage();
		}
	}

	/**
	 * Consultar accesos en estado 'Proceso'
	 */
	public function consulta_act()
	{
		try 
		{
			$stmt = $this->cbd->prepare("SELECT * FROM acceso WHERE estado_acc = 0");
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->FetchAll();
		} catch(Exception $e) {
			print "Error: ". $e->getMessage();
		}
	}

	/**
	 * Actualizar acceso
	 */
	public function acualizar_acc()
	{	
		try 
		{
			$stmt = $this->cbd->prepare("UPDATE acceso SET estado_acc = :est,  prioridad = :pri, motivo = :mot, avance = :ava
				WHERE id_acc = :id_acc");
			$stmt->bindParam(":id_acc",$this->id_acc);
			$stmt->bindParam(":est",$this->est_acc);
			$stmt->bindParam(":pri",$this->pri_acc);
			$stmt->bindParam(":mot",$this->mot);
			$stmt->bindParam(":ava",$this->avance);
			$stmt->execute();
			return $stmt->execute();
		} catch(Exception $e) {
			print "Error: ". $e->getMessage();
		}	
	}


	/**
	 * Finalizar acceso
	 */
	public function finalizar_acceso($debug = false)
	{	
		try 
		{
			$stmt = $this->cbd->prepare("UPDATE acceso SET estado_acc = 1 , fcha_final = now()::timestamp(0) WHERE id_acc = :id_acc");
			$stmt->bindParam(":id_acc",$this->id_acc);
			$stmt->execute();
			if ($debug) {
				return $stmt;
			}
			return $stmt->execute();
		} catch(Exception $e) {
			print "Error: ". $e->getMessage();
		}	
	}

	public function cancelar_acceso()
	{	
		try 
		{
			$stmt = $this->cbd->prepare("UPDATE acceso SET estado_acc = 2 , fcha_final = now()::timestamp(0) WHERE id_acc = :id_acc");
			$stmt->bindParam(":id_acc",$this->id_acc);
			$stmt->execute();
			return $stmt->execute();
		} catch(Exception $e) {
			print "Error: ". $e->getMessage();
		}	
	}


	/**
	 * Eliminar acceso
	 */
	public function eliminar_acc()
	{
		try 
		{
			$stmt = $this->cbd->prepare("UPDATE acceso SET estado_acc = :est, fcha_final = :fhf WHERE id_acc = :id_acc");
			$stmt->bindParam(":id_acc",$this->id_acc);
			$stmt->bindParam(":est",$this->est_acc);
			$stmt->bindParam(":fhf",$this->fh_f);
			return $stmt->execute();
		} catch(Exception $e) {
			print "Error: ". $e->getMessage();
		}
	}

	/**
	 * Estadística cantidad de accesos en estado 'proceso' o 0
	 */
	public function est_pro()
	{
		try 
		{
			$stmt = $this->cbd->prepare("SELECT count(*) FROM acceso WHERE estado_acc = 0;");
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->FetchAll();
		} catch(Exception $e) {
			print "Error: ". $e->getMessage();
		}
	}
	public function est_pro_by_all($desde,$hasta,$prioridad)
	{
		try 
		{
			$query = "SELECT count(*) FROM acceso WHERE estado_acc = 0 AND"
					  .($desde!=""?" fcha_inicio >= :desde AND":"")
					  .($hasta!=""?" fcha_inicio <= :hasta AND":"")
					  .($prioridad!="-1"?" prioridad = :prioridad":"");

			if (substr($query,-3) == "AND") {
				$query = substr($query,0,-3);
			}
			$stmt = $this->cbd->prepare($query);
			if($desde != ""){$desde.=" 00:00:00";$stmt->bindParam(":desde",$desde);}
			if($hasta != ""){$hasta.=" 23:59:59";$stmt->bindParam(":hasta",$hasta);}
			if($prioridad !="-1"){$stmt->bindParam(":prioridad",$prioridad);}
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->FetchAll();
		} catch(Exception $e) {
			print "Error: ". $e->getMessage();
		}
	}

	/**
	 * Estadística cantidad de accesos en estado 'finalizado' o 1
	 */
	public function est_fin()
	{
		try 
		{
			$stmt = $this->cbd->prepare("SELECT count(*) FROM acceso WHERE estado_acc = 1;");
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->FetchAll();
		} catch(Exception $e) {
			print "Error: ". $e->getMessage();
		}
	}

	public function est_fin_by_all($desde,$hasta,$prioridad)
	{
		try 
		{
			$query = "SELECT count(*) FROM acceso WHERE estado_acc = 1 AND"
					  .($desde!=""?" fcha_inicio >= :desde AND":"")
					  .($hasta!=""?" fcha_inicio <= :hasta AND":"")
					  .($prioridad!="-1"?" prioridad = :prioridad":"");

			if (substr($query,-3) == "AND") {
				$query = substr($query,0,-3);
			}
			$stmt = $this->cbd->prepare($query);
			if($desde != ""){$desde.=" 00:00:00";$stmt->bindParam(":desde",$desde);}
			if($hasta != ""){$hasta.=" 23:59:59";$stmt->bindParam(":hasta",$hasta);}
			if($prioridad !="-1"){$stmt->bindParam(":prioridad",$prioridad);}
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->FetchAll();
		} catch(Exception $e) {
			print "Error: ". $e->getMessage();
		}
	}

	/**
	 * Estadística cantidad de accesos en estado 'cancelado' o 2
	 */
	public function est_can()
	{
		try 
		{
			$stmt = $this->cbd->prepare("SELECT count(*) FROM acceso WHERE estado_acc = 2;");
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->FetchAll();
		} catch(Exception $e) {
			print "Error: ". $e->getMessage();
		}
	}

	public function est_can_by_all($desde,$hasta,$prioridad)
	{
		try 
		{
			$query = "SELECT count(*) FROM acceso WHERE estado_acc = 2 AND"
					  .($desde!=""?" fcha_inicio >= :desde AND":"")
					  .($hasta!=""?" fcha_inicio <= :hasta AND":"")
					  .($prioridad!="-1"?" prioridad = :prioridad":"");

			if (substr($query,-3) == "AND") {
				$query = substr($query,0,-3);
			}
			$stmt = $this->cbd->prepare($query);
			if($desde != ""){$desde.=" 00:00:00";$stmt->bindParam(":desde",$desde);}
			if($hasta != ""){$hasta.=" 23:59:59";$stmt->bindParam(":hasta",$hasta);}
			if($prioridad !="-1"){$stmt->bindParam(":prioridad",$prioridad);}
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->FetchAll();
		} catch(Exception $e) {
			print "Error: ". $e->getMessage();
		}
	}
}