<?php
	if (!isset($_SESSION['email_otic'])) {
		header("Location: ./");
		die();
	} else {
		if ($_SESSION['pri_otic']  < 1) {
			$msj = "Acción denegada por permisos insuficientes";
			header("Location: ./?md=".$msj);
			die();
		}
        
		require_once("modelo/m_Institucion.php");
		$inst = new Institucion();
		if ($inst->ver_inst_by_nombre($_POST['nombre']) > 0) {// comprobar si la institución ya fue registrada en el sistema

			$msj = "La institución ingresada ya fue registrada anteriormente en el sistema";
			header("Location: ./?c=gestionar_institucion&md=".$msj);
			die();
		}
		// Capturar datos del formulario y asignarlo a la clase objeto Empleado
		$inst->setNombre($_POST['nombre']);
		if($inst->crear_inst()) {
			$msj = "Se ha completado con éxito el registro de la institución";
			header("Location: ./?c=gestionar_institucion&ms=".$msj);
		} else{
			//var_dump($inst->crear_inst(true)->errorInfo());exit();
			$msj = "Ha ocurrido un error al registrar la institución";
			header("Location: ./?c=gestionar_institucion&md=".$msj);
		}
	}
?>