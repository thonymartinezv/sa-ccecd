<?php
require_once("modelo/m_BD.php"); // Clase de Conexion de BD

class Institucion extends ConexionBD
{
    private $id; // Identificador acceso -> serial
	private	$nombre; // CI DIS -> int
	private $cbd; // conexion de la BD -> bool

    public function setNombre($valor) { 
		$this->nombre = $valor;   
	} 
	public function getNombre() {
		return $this->nombre;
	}	

    public function setId($valor) { 
		$this->id = $valor;   
	}

    public function __construct() 
	{
		$this->cbd = parent::conexion_bd();
		$this->cbd->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

	}

    public function __destruct()
	{
		parent::desconexion_bd();
	}

    public function crear_inst()
	{
		try 
		{
			$stmt = $this->cbd->prepare("INSERT INTO institution (nombre) VALUES (:nombre)");
			$stmt->bindParam(":nombre",$this->nombre);
			return $stmt->execute();
		} catch (Exception $e) {
			echo "Error: " . $e->getMessage();
		}
	}

    public function consultar_inst()
	{
		try 
		{
			$stmt = $this->cbd->prepare("SELECT * FROM institution");
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->FetchAll();
		} catch(Exception $e) {
			print "Error: ". $e->getMessage();
		}
	}

    public function editar_inst()
	{
		try 
		{
			$stmt = $this->cbd->prepare("UPDATE institution SET nombre = :nombre WHERE id = :id");
			$stmt->bindParam(":nombre",$this->nombre);
			$stmt->bindParam(":id",$this->id);
			return $stmt->execute();
		} catch(Exception $e) {
			print "Error: ". $e->getMessage();
		}
	}

    public function eliminar_inst()
	{
		try 
		{
			$stmt = $this->cbd->prepare("DELETE FROM institution WHERE id = :id");
			$stmt->bindParam(":id",$this->id);
			return $stmt->execute();
		} catch(Exception $e) {
			print "Error: ". $e->getMessage();
		}
	}

    public function ver_inst()
	{
		try 
		{
			$stmt = $this->cbd->prepare("SELECT * FROM institution WHERE id = :id");
			$stmt->execute([":id"=>$this->id]);
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->FetchAll();
		} catch(Exception $e) {
			print "Error: ". $e->getMessage();
		}
	}

    public function ver_inst_by_nombre()
	{
		try 
		{
			$stmt = $this->cbd->prepare("SELECT * FROM institution WHERE nombre = :nombre");
			$stmt->execute([":nombre"=>$this->nombre]);
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->FetchAll();
		} catch(Exception $e) {
			print "Error: ". $e->getMessage();
		}
	}
}