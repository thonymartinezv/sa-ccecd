<?php
session_start();
if (!isset($_SESSION['email_otic']) || ($_SESSION['pri_otic'] == 0) || !isset($_POST['email_emp'])) {
	header("Location: ../vista/v_R.html");
	die();
} else {
	require_once("dompdf/dompdf_config.inc.php");
	require_once("../config/config_fh.php");
	$_POST['email_emp'] = $_POST['email_emp'] . "@mppct.gob.ve";
	
	switch ($_POST["pri_usu"])
	{
		case 2: $_POST["pri_usu"] = "DG"; break;
		case 1: $_POST["pri_usu"] = "SAO"; break;
		case 0: $_POST["pri_usu"] = "DIS"; break;
	}

	switch ($_POST["estado_usu"])
	{
	case 2: $_POST["estado_usu"] = "Bloqueado"; break;
	case 1: $_POST["estado_usu"] = "Activo"; break;
	case 0: $_POST["estado_usu"] = "Inactivo"; break;
	} 

	function validar($cadena) {
		if ($cadena != "")
			return true;	
	}

	//var_dump(validar($_POST['s_apel']));

	$hoy = zh_vzla();
	$html =
'<html>
	<head> <meta charset="utf-8"> 
		<style rel="stylesheet"> 

			table { 
				border-collapse:collapse;
			} 

			table td, th {
				padding:10px 0px;
			} 

			p {
			  	font-size:18px;
			}
		<style>
	</head>
	<body>'.
	  '<b>Fecha: '. $hoy[8] . '</b>'.
	  '<p align="center"><b>Información de empleado del CCECD</b></<p>'.
		'<table border="2" align="center">'.
			'<tr align="center"><th width="250px" height="20px">Primer nombre </th><td width="250px">'. $_POST['p_nomb'] .'</td></tr>';
			
			if (validar($_POST['s_nomb'])) {
				$html .= '<tr align="center"><th width="250px" height="20px">Segundo nombre </th><td width="250px">'. $_POST['s_nomb'] .'</td></tr>';
				}

			$html .= '<tr align="center"><th width="250px" height="20px">Primer apellido </th><td width="250px">'. $_POST['p_apel'] .'</td></tr>';

			if (validar($_POST['s_apel'])) {
				$html .= '<tr align="center"><th width="250px" height="20px">Segundo apellido </th><td width="250px">'. $_POST['s_apel'] .'</td></tr>';
				}

			$html .= 

			'<tr align="center"><th width="250px" height="20px">Cédula de identidad </th><td width="250px">'. $_POST['ci_emp'] .'</td></tr>'.

			'<tr align="center"><th width="250px" height="20px">Correo electrónico </th><td width="250px">'. $_POST['email_emp'] .'</td></tr>'.

			'<tr align="center"><th width="250px" height="20px">Cargo </th><td width="250px">'. $_POST['pri_usu'] .'</td></tr>'.

			'<tr align="center"><th width="250px" height="20px">Fecha de ingreso </th><td width="250px"> '. $_POST['fcha_ing'] .'</td></tr>'.

			'<tr align="center"><th width="250px" height="20px">Estado </th><td width="250px"> '. $_POST['estado_usu'] .'</td></tr>'.
		'</table>
	</body>
</html>';

	$dompdf = new DOMPDF();
	$dompdf->load_html($html);
	$dompdf->set_paper('A4', 'landscape');
	$dompdf->render();
	$dompdf->stream('Empleado_'.$_POST['email'].'_'.$hoy[8].'_CCECD.pdf');
	}
?>