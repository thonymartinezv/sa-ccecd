<?php // Menú monitoreo
	include_once("config/config_fh.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>CCECD - Menú Monitoreo</title>
	<meta charset="utf-8">
</head>
<body>

<div align="center">
	<img src="img/MPPCT.jpeg" width="28%">
	<img src="img/UNEXCA.png" width="68%">
</div>

<?php
	$hoy = zh_vzla(); //0-> fecha, 1-> hora, 2-> numero dia semana, 3-> nombre dia semana, 4-> dia del año, 5-> numero semana del año
	echo "Bienvenid@ <b>". $_SESSION['email_otic'] ."</b> al Sistema de Bitácora del CCECD. " . $hoy[3]. ", <b>". $hoy[0] . ' | '. 
		$hoy[1] ."</b> | Semana del año: <b>". $hoy[5] ."</b> | Día del año: <b>". $hoy[4] ."</b> </p>";
?>

	<h1 align="center">Monitoreo</h1>

	<ul>
		<li>Gestionar Monitoreo</li>
		<li> <a href="?c=CS">Cerrar sesión</a></li>
	</ul>


</body>
</html>	