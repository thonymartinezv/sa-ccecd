<?php
require_once("modelo/m_Usuario.php");
$user = new Usuario();
$user->setEmail_usu($_POST['usu_otic']);
$user->setClave_usu($_POST['clv_otic']);

if ($user->iniciar_sesion()) { // Se verifica que el usuario exista en la BD 
	//Ahora se crea la sesion con los datos esenciales (correo electrónico, privilegio y estado)
	$_SESSION['email_otic'] = $user->getEmail_usu();
	$_SESSION['pri_otic'] = $user->getPri_usu();
	$_SESSION['est_otic'] = $user->getEstado_usu();
	header("Location:./");//se redirecciona al inicio
} else { //Se redirecciona al inicio de sesión
	header("Location:/?error");
	die();
}
?> 