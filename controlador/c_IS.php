<?php
define("RECAPTCHA_V3_SECRET_KEY", '6LeBgWwaAAAAAKMh4FwoRB574oCMuLCxjOy9lyPF');

$token = $_POST['token'];
$action = $_POST['action'];
 
// call curl to POST request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => RECAPTCHA_V3_SECRET_KEY, 'response' => $token)));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$arrResponse = json_decode($response, true);
 
// verificar la respuesta
if($arrResponse["success"] == '1' && $arrResponse["action"] == $action && $arrResponse["score"] >= 0.5) {
    // Si entra aqui, es un humano, puedes procesar el formulario
} else {
    header("Location:./?error");
	die();
}



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
	header("Location:./?error");
	die();
}
?> 