<?php
if (!isset($_SESSION['email_otic']) || $_SESSION['pri_otic'] == 0) {
	header("Location: ./");
	die();
} else {
	require_once("modelo/m_Empleado.php");
	// Capturar datos del formulario y asignarlo a la clase objeto Empleado
	$emp = new Empleado();
	$emp->setEmail_emp($_POST['email_emp']);
	$emp->setCI_emp($_POST['ci_emp']);
	$emp->setP_nomb($_POST['p_nomb']);
	$emp->setS_nomb($_POST['s_nomb']);
	$emp->setP_apel($_POST['p_apel']);
	$emp->setS_apel($_POST['s_apel']);
	$emp->setClave($_POST['clv_usu']);
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