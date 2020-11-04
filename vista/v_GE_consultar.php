<?php
	include_once("config/config_fh.php"); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
<?php
switch ($_POST['ele']) {
	case "CE": ?> <title>GE consultar empleados - CCECD</title> <?php break;
	case "CP": ?> <title>GE consultar perfil - CCECD</title> <?php break;
	case "A": ?> <title>GE actualizar - CCECD </title> <?php break;
	case "E": ?> <title>GE eliminar perfil - CCECD</title> <?php break;
	}
?>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/z2_GE_consultar.css">

<script type="text/javascript">
	
	function eliminar(valor) {
		if (valor == "Eliminar" && document.formE.email_usu.value != "") {
			if (confirm("¿Está seguro que quiere eliminar este empleado?")) {
				document.formE.action = "../controlador/c_GE_eliminar.php";
				document.formE.method = "POST";
				document.formE.submit();
				}
			}

		if (document.formE.email_usu.value == "") {
			alert("¡Debe seleccionar un empleado!");
			}
		}

</script>
</head>
<body>
<div align="center">
<img src="img/MPPCT_OTIC_CCECD.png" height="10%" width="100%">
<?php
switch ($_POST['ele']) {
	case 'CE': ?> <h1 align="center"> Administrador consultar empleados - CCECD</h1> <?php break;
	case 'CP': ?> <h1 align="center"> Administrador consultar perfil empleado - CCECD</h1> <?php break;
	case 'A': ?> <h1 align="center"> Administrador actualizar empleado - CCECD </h1> <?php break;
	case 'E': ?> <h1 align="center"> Administrador eliminar empleado - CCECD </h1> <?php break;
	}

$hoy = zh_vzla(); 
	echo "<p> Bienvenid@ <b>". $_SESSION['email_otic'] ."</b> al Sistema de Bitácora del CCECD. " . $hoy[3]. ", <b>". $hoy[0] . ' | '. 
		$hoy[1] ."</b> | Semana del año: <b>". $hoy[5] ."</b> | Día del año: <b>". $hoy[4] ."</b> </p>";
?>
</div>
<table border="1" align="center">
<tr>
<?php if ($_POST['ele'] != "CE") { ?> <th width="200px">SEL</th> <?php } ?>
	<th width="200px">ID</th>
	<th width="200px">CARGO</th>
	<th width="200px">ESTADO</th>
</tr>
<?php 
require_once("modelo/m_Empleado.php");
$emp = new Empleado();
$reg = $emp->consultar_emp();
$i = 0;

// El arreglo 'sao_epa' -> Obtiene usuarios con estado Activo (1) y Bloqueado (2), siempre y cuando, no sea un DG (pri_usu = 2)
// Con este arreglo se puede realizar: Consultar empleados, consultar perfil y actualizar empleado. Cuando el Administrador sea SAO
foreach ($reg as $r) {
	if (($r['estado_usu'] != 0) && ($r['pri_usu'] != 2)) {
		$sao_epa[$i] = $r;
		$i++;
		}
	}

$i = 0;
// El arreglo 'dg_a' -> Obtiene solo usuarios SAO y DIS con cualquier estado, siempre y cuando, no sea un DG (pri_usu = 2)
// Además de sólo el DG puede utilizar esta arreglo, y, cabe destacar que el mismo se incluye en la lista de actualización
// Con este arreglo DG puede actualizar a usuarios SAO, DIS y él mismo
foreach ($reg as $r) {
	if (($r['pri_usu'] != 2) || ($r['pri_usu'] == 2 && $r['email_usu'] == $_SESSION['email_otic'])) {
		$dg_a[$i] = $r;
		$i++;
		}
	}

$i = 0;
// El arreglo 'e' -> Obtiene solo usuarios SAO y DIS con cualquier estado, siempre y cuando, no sea un DG (pri_usu = 2)
// Además de Administrador DG y SAO pueden utilizar este arreglo
// Con este arreglo DG puede eliminar a usuarios SAO, DIS, pero nunca un DG, ni él mismo
foreach ($reg as $r) {
	if (($r['pri_usu'] != 2) && ($r['estado_usu'] == 1)) {
		$e[$i] = $r;
		$i++;
		}
	}

//Abstracción que determina consultar empleados, perfil, actualizar y eliminar empleado
function consulta($arreglo) {
	foreach ($arreglo as $usuario) {
		echo "<tr align='center' class='tr'>"; // Se genera una fila por cada usuario

	// Condición que permite insertar otra columna a la fila, con el fin, de seleccionar un usuario.
	//Dado que "CE" permite sólo mostrar los empleados mientras que los otros (CP,A,E) pueden realizar otra acción
	if ($_POST['ele'] != "CE") {
		switch ($_POST['ele']) { // El action contendra un destino diferente 
			case 'CP': echo "<form name='formCP' method='POST' action='../controlador/c_GE_consultar_perfil.php'>"; break;
			case 'A': echo "<form name='formA' method='POST' action='v_GE_actualizar.php'>"; break;
			case 'E': echo "<form name='formE'>"; echo "<input type='hidden' name='est_usu' value='0'>"; break;
			}
		echo "<td align='center'> <input type='radio' name='email_usu' value=".$usuario['email_usu']." required></td>";
		}
	
	echo "<td>".$usuario['email_usu'] . "</td>";
	switch ($usuario['pri_usu']) {// 2-> DG, 1-> SAO, 0-> DIS
		case 2: echo "<td> DG </td>"; break;
		case 1: echo "<td> SAO </td>"; break;
		case 0: echo "<td> DIS </td>"; break;		
		}

	switch ($usuario['estado_usu']) { // 2-> Bloqueado, 1-> Activo, 0-> Inactivo
		case 2: echo "<td> Bloqueado </td>"; break;		
		case 1: echo "<td> Activo </td>"; break;
		case 0: echo "<td> Inactivo </td>"; break;	
		}
	echo "</tr>";
	}
	echo "</table>";
	echo "<p align='center'>Se devolvieron:<b> ".count($arreglo)."</b> Registros</p>"; // Numero de Filas Afectadas
}
// DG puede consultar empleados y perfil de empleado con cualquier estado
if (($_SESSION['pri_otic'] == 2) && ($_POST['ele'] == "CP" || $_POST['ele'] == "CE")) {
	consulta($reg);

// DG puede actualizar a todos los usuarios a excepción de otro DG que no corresponda al DG que realiza la actualización
} elseif (($_SESSION['pri_otic'] == 2) && ($_POST['ele'] == "A")) {
	consulta($dg_a);

// SAO puede consultar y actualizar usuarios SAO y DIS con estado Activo o Bloqueado
} elseif(($_SESSION['pri_otic'] == 1) && ($_POST['ele'] != "E")) { 
	consulta($sao_epa); 

// DG y SAO pueden eliminar sólo usuarios Activos siempre y cuando no sea un DG
} elseif (($_POST['ele'] == "E") && ($_SESSION['pri_otic'] == 1 || $_SESSION['pri_otic'] == 2)) {
	consulta($e);
	}
?>
</body>
</html>
<?php if ($_POST['ele'] != "CE") {
	switch ($_POST['ele']){
		case "CP": ?> <p align="center"> <input type="submit"  name="GECP" value="Consultar perfil"> <?php break;
		case "A": ?> <p align="center"> <input type="submit" name="GEA" value="Actualizar"> <?php break;
		case "E": ?> <p align="center"> <input type="submit" name="GEE" value="Eliminar" onclick="eliminar(this.value)">  <?php break;
		} ?>
<a href="v_indexMadmin.php"><input type="button" name="GE" value="Volver"></a>
</p> </form>
<?php } else {
	echo "<p align='center'><a href='v_indexMadmin.php'><input type='button' name='GE' value='Volver'></a></p>";
	}
?>