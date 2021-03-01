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

		require_once("modelo/m_Usuario.php");
		$user = new Usuario();
		if ($user->existEmail($_POST['email_emp'])) {// comprobar si el correo ya fue registrado
			$msj = "El email ingresado ya fue registrado anteriormente en el sistema";
			header("Location: ./?md=".$msj);
			die();
		}
		require_once("modelo/m_Empleado.php");
		$emp = new Empleado();
		if ($emp->existCi($_POST['ci_emp'])) {// comprobar si la cédula ya fue registrada en el sistema
			$msj = "La cédula ingresada ya fue registrada anteriormente en el sistema";
			header("Location: ./?md=".$msj);
			die();
		}
		// Capturar datos del formulario y asignarlo a la clase objeto Empleado
		$emp->setEmail_emp($_POST['email_emp']);
		$emp->setCI_emp($_POST['ci_emp']);
		$emp->setP_nomb($_POST['p_nomb']);
		$emp->setS_nomb($_POST['s_nomb']);
		$emp->setP_apel($_POST['p_apel']);
		$emp->setS_apel($_POST['s_apel']);
		$emp->setClave($_POST['clv_usu']);
		$emp->setInstitution($_POST['institution']);
		$emp->setTlf($_POST['tlf']);
		$emp->setPri($_POST['pri_usu']);
		if($emp->crear_emp()) {
			$msj = "Se ha completado con éxito el registro del empleado";
			header("Location: ./?ms=".$msj);
		} else{
			var_dump($emp->crear_emp(true)->errorInfo());exit();
			$msj = "Ha ocurrido un error al registrar el empleado";
			header("Location: ./?md=".$msj);
		}
	}
?>