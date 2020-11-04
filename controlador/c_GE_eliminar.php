<?php
session_start();
if (!isset($_SESSION['email_otic']) || $_SESSION['pri_otic'] == 0) {
	header("Location: ../vista/v_R.html");
	die();
} else {
	require_once("../modelo/m_Empleado.php");
	// Capturar datos del formulario y asignarlo a la clase objeto Empleado
	$emp = new Empleado();
	$emp->setEmail($_POST['email_usu']);
	$emp->setEst($_POST['est_usu']);
	
	if($emp->eliminar_emp()) {
		$bool = true;
		$action = "../vista/v_GE_consultar.php";
		$msj = "Se ha completado con éxito la eliminación del empleado";
	} else{
		$bool = false;
		$action = "../vista/v_R.html";
		$msj = "Ha ocurrido un error al eliminar el empleado";
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
			<form name='GEE'>
				<?php 
					/* Sólo en el caso de volver a eliminar empleado*/ 
					if ($bool) { ?> 
						<input type='hidden' name='ele' value='E'> 
				<?php } ?>
			</form>
			<script type="text/javascript">
				alert("<?php echo $msj; ?>");
				document.GEE.action = "<?php echo $action; ?>";
				document.GEE.method = 'POST';
				document.GEE.submit();
			</script>
		</body>
		</html>


<?php
	}
?>