<?php
session_start();
if (!isset($_SESSION['email_otic']) || $_SESSION['pri_otic'] == 0) {
	header("Location: v_R.html");
	die();
} else {
	require_once("../modelo/m_Empleado.php");
	// Capturar datos del formulario y asignarlo a la clase objeto Empleado
	$emp = new Empleado();
	$emp->setEmail_emp($_POST['email_emp']);
	$emp->setCI_emp($_POST['ci_emp']);
	$emp->setP_nomb($_POST['p_nomb']);
	$emp->setS_nomb($_POST['s_nomb']);
	$emp->setP_apel($_POST['p_apel']);
	$emp->setS_apel($_POST['s_apel']);
	$emp->setFcha_ing($_POST['fcha_ing']);
	$emp->setClave($_POST['clv_usu']);
	$emp->setPri($_POST['pri_usu']);
	$emp->setEst($_POST['est_usu']);
	
	if($emp->crear_emp()) {
		$msj = "Se ha completado con éxito el registro del empleado";
		$action = "../vista/v_GE_crear.php";
	} else{
		$msj = "Ha ocurrido un error al registrar el empleado";
		$action = "../vista/v_R.html";
		}
	?>
		<html>
		<head>
			<title></title>
			<style type="text/css"> body {
				background:#004565;
			} </style>
		</head>
		<body>
			<form name='GEC'> </form>
			<script type="text/javascript">
				alert("<?php echo $msj; ?>");
				document.GEC.action = "<?php echo $action; ?>";
				document.GEC.method = 'POST';
				document.GEC.submit();
			</script>
		</body>
		</html>
<?php
	}
?>