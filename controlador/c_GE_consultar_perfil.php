<?php
session_start();
if (!isset($_SESSION['email_otic']) || ($_SESSION['pri_otic'] == 0)|| !isset($_GET['email_usu'])) {
	header("Location: vista/v_R.html");
	die();
} else {
	require_once("modelo/m_Empleado.php"); // Clase Modelo de CRUD Empleado
	include_once("config/config_fh.php");
	$emp = new Empleado();
	$emp->setEmail($_GET['email_usu']); //contiene el email del empleado a consultar
	$perfil = $emp->find();
	$email = $perfil[0][0]['email_emp'];
?>

<!DOCTYPE html>
<html>
<head>
<title>GE consultar perfil - CCECD</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/z2_GE_consultar.css">
<script type="text/javascript">
	function reporte(valor) {
		if (valor == "Importar perfil") {
			document.FRpdf.action = "reporte.php";
			document.FRpdf.method = "POST";
			document.FRpdf.submit(); 
			}
		}
</script>
</head>
<body>
<div align="center">
<img src="img/MPPCT_OTIC_CCECD.png" height="10%" width="100%">
<h1> Administrador consultar perfil de empleado -  CCECD</h1>
<?php
//0-> fecha, 1-> hora, 2-> numero dia semana, 3-> nombre dia semana, 4-> dia del año, 5-> numero semana del año, 6-> fecha hoy en formato Y/m/d
$hoy = zh_vzla(); 
	echo "<p> Bienvenid@ <b>". $_SESSION['email_otic'] ."</b> al Sistema de Bitácora del CCECD. " . $hoy[3]. ", <b>". $hoy[0] . ' | '. 
		$hoy[1] ."</b> | Semana del año: <b>". $hoy[5] ."</b> | Día del año: <b>". $hoy[4] ."</b> </p>";
?>
<table border="2" bordercolor="669966">
<?php
	echo "<tr align='center' class='tr'><th class='th' width='250px' height='20px'>Primer nombre </th><td width='250px'>" . $perfil[0][0]['p_nomb'] . "</td></tr>";
	if ($perfil[0][0]['s_nomb'] != "") {
		echo "<tr align='center' class='tr'><th class='th' width='250px'height='20px'>Segundo nombre </th><td width='250px'>" . $perfil[0][0]['s_nomb'] . "</td></tr>";
		}
	echo "<tr align='center' class='tr'><th class='th' width='250px'height='20px'>Primer apellido </th><td width='250px'>" . $perfil[0][0]['p_apel'] . "</td></tr>";
	if ($perfil[0][0]['s_apel'] != "") {
		echo "<tr align='center' class='tr'><th class='th' width='250px'height='20px'>Segundo apellido </th><td width='250px'>" . $perfil[0][0]['s_apel'] . "</td></tr>";
		}
	echo "<tr align='center' class='tr'><th class='th' width='250px'height='20px'>Cédula de identidad </th><td width='250px'>" . $perfil[0][0]['ci_emp'] . "</td></tr>";
	echo "<tr align='center' class='tr'><th class='th' width='250px'height='20px'>Correo electrónico </th><td width='250px'>" . $perfil[0][0]['email_emp'] . "@mppct.gob.ve </td></tr>";
	echo "<tr align='center' class='tr'><th class='th' width='250px'height='20px'>Cargo </th><td width='250px'>";
	switch ($perfil[1][0]["pri_usu"]) {
		case 2: echo "DG" . "</tr>"; break;
		case 1: echo "SAO" . "</tr>"; break;
		case 0: echo "DIS" . "</tr>"; break;
		}
	$fdma = $perfil[0][0]['fcha_ing'];
	$perfil[0][0]['fcha_ing'] = $fdma[8]. $fdma[9] .'/'. $fdma[5].$fdma[6] .'/'. $fdma[0].$fdma[1].$fdma[2].$fdma[3];
	echo "<tr align='center' class='tr'><th class='th' width='250px'height='20px'>Fecha de ingreso </th><td width='250px'>" . $perfil[0][0]['fcha_ing'] . "</td></tr>";
	echo "<tr align='center' class='tr'><th class='th' width='250px'height='20px'>Estado </th><td width='250px'>";
	switch ($perfil[1][0]["estado_usu"]) {
		case 2: echo "Bloqueado" . "</td></tr>"; break;
		case 1: echo "Activo" . "</td></tr>"; break;
		case 0: echo "Inactivo" . "</td></tr>"; break;
		}
	}
?>
</table>
	<p>
		<!--Formulario que retorna a seleccionar empleado para su consulta-->
		<form name='GECP' method='POST' action='vista/v_GE_consultar.php'>
		<input type='hidden' name='ele' value='CP'>
		<input type='submit' name='submit' value='Volver'>
		<input type="button" form="FRpdf" name="rpdf" value="Importar perfil" onclick="reporte(this.value)">
	</p>
</div>
</form>

	<!-- Formulario que conlleva a la generación del reporte pdf -->
	<form name="FRpdf" id="FRpdf">
		<!--Valores ocultos para la generación del reporte pdf-->
		<input type="hidden" name="p_nomb" value="<?php echo $perfil[0][0]['p_nomb'];?>">
		<input type="hidden" name="s_nomb" value="<?php echo $perfil[0][0]['s_nomb'];?>">
		<input type="hidden" name="p_apel" value="<?php echo $perfil[0][0]['p_apel'];?>">
		<input type="hidden" name="s_apel" value="<?php echo $perfil[0][0]['s_apel'];?>">
		<input type="hidden" name="ci_emp" value="<?php echo $perfil[0][0]['ci_emp'];?>">
		<input type="hidden" name="email_emp" value="<?php echo $perfil[0][0]['email_emp'];?>">
		<input type="hidden" name="pri_usu" value="<?php echo $perfil[1][0]['pri_usu'];?>">
		<input type="hidden" name="fcha_ing" value="<?php echo $perfil[0][0]['fcha_ing'];?>">
		<input type="hidden" name="estado_usu" value="<?php echo $perfil[1][0]['estado_usu'];?>">
		<input type="hidden" name="email" value="<?php echo $email;?>">
	</form>
</body>
</html>