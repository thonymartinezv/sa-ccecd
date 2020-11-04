<?php
session_start();
if (!isset($_SESSION['email_otic']) || $_SESSION['pri_otic'] == 0) {
	header("Location: ../vista/v_R.html");
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
	$emp->setEmail($_POST['email_usu']);
	$emp->setPri_emp($_SESSION['pri_otic']);
	if ($_SESSION['pri_otic'] == 2) {
		$emp->setPri($_POST['pri_usu']);
		$emp->setEst($_POST['est_usu']);
		}
	
	if($emp->actualizar_emp()) {
		$bool = true;
		$action = "../vista/v_GE_consultar.php";
		$msj = "Se ha completado con éxito la actualización del empleado";
	} else{
		$bool = false;
		$action = "../vista/v_R.html";
		$msj = "Ha ocurrido un error al actualizar el empleado";
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
			<form name='GEA'>
				<?php 
					/* Sólo en el caso de volver a actualizar empleado*/ 
					if ($bool) { ?> 
						<input type='hidden' name='ele' value='A'> 
				<?php } ?>
			</form>
			<script type="text/javascript">
				alert("<?php echo $msj; ?>");
				document.GEA.action = "<?php echo $action; ?>";
				document.GEA.method = 'POST';
				document.GEA.submit();
			</script>
		</body>
		</html>
<?php
	}
?>