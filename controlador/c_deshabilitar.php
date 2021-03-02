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
		require_once("modelo/m_Empleado.php");
		$emp = new Empleado();
		$emp->setEmail($_GET['email_usu']);
		$emp->setEst(0);
		if($emp->eliminar_emp()) {
			$msj = "Se ha deshabilitado con éxito el usuario";
			header("Location: ./?ms=".$msj);
		} else{
			$msj = "Ha ocurrido un error al deshabilitar el usuario";
			header("Location: ./?md=".$msj);
		}
	}
?>