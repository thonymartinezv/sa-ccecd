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

    public function crear_inst($debug = false)
	{
		try 
		{
			$stmt = $this->cbd->prepare("INSERT INTO institution (nombre) VALUES (:nombre)");
			$stmt->bindParam(":nombre",$this->nombre);
			if($debug){
				return $stmt;
			}
			return $stmt->execute();
		} catch (Exception $e) {
			echo "Error: " . $e->getMessage();
		}
	}

    public function consultar_inst($cantidad = 1,$primero = 0)
	{
		try 
		{
			$stmt = $this->cbd->prepare("SELECT * FROM institution LIMIT :cantidad OFFSET :primero");
			$stmt->bindParam(':cantidad', $cantidad);
			$stmt->bindParam(':primero', $primero);
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->execute();
			return $stmt->FetchAll();
		} catch(Exception $e) {
			print "Error: ". $e->getMessage();
		}
	}

	public function inst_count()
	{
		try 
		{
			$stmt = $this->cbd->prepare("SELECT count(*) FROM institution");
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->execute();
			$result = $stmt->fetchAll()[0];
			return $result[array_keys($result)[0]];
		} catch(PDOException $error) {
			echo "Error: ejecutando consulta SQL.".$error->getMessage();
			exit();
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

    public function ver_inst_by_nombre($nombre)
	{
		try 
		{
			$operador = MANEJADOR=="pgsql"?"ILIKE":"LIKE";
			$stmt = $this->cbd->prepare("SELECT count(*) FROM institution WHERE nombre $operador :nombre");
			$stmt->bindParam(":nombre",$nombre);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$result = $stmt->fetchAll()[0];
			return $result[array_keys($result)[0]];
		} catch(Exception $e) {
			print "Error: ". $e->getMessage();
		}
	}
}