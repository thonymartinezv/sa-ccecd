<?php
	if (!isset($_SESSION['email_otic']) || $_SESSION['pri_otic'] == 0) {
		header("Location: ./");
		die();
	} else {
		require_once("modelo/m_Empleado.php");
		$emp = new Empleado();
		$emp->setEmail($_GET['email_usu']);
		$emp->setEst(0);
		if($emp->eliminar_emp()) {
			$msj = "Se ha deshabilitado con éxito el empleado";
			header("Location: ./?ms=".$msj);
		} else{
			$msj = "Ha ocurrido un error al deshabilitar el empleado";
			header("Location: ./?md=".$msj);
		}
	}
?>