<?php
	if (!isset($_SESSION['email_otic']) || $_SESSION['pri_otic'] == 0) {
		header("Location: ./");
		die();
	} else {
		require_once("modelo/m_Empleado.php");
		$emp = new Empleado();
		$emp->setEmail($_GET['email_usu']);
		$emp->setEst(1);
		if($emp->eliminar_emp()) {
			$msj = "Se ha habilitado con éxito el empleado";
			header("Location: ./?ms=".$msj);
		} else{
			$msj = "Ha ocurrido un error al habilitar el empleado";
			header("Location: ./?md=".$msj);
		}
		echo $msj;
	}
?>