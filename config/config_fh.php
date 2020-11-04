<?php  
function zh_vzla() {
	date_default_timezone_set("America/Caracas");

	switch (date("m")) {
		case "01": $nmes = "enero"; break;		case "02": $nmes = "febrero"; break;	case "03": $nmes = "marzo"; break;
		case "04": $nmes = "abril"; break;		case "05": $nmes = "mayo"; break;		case "06": $nmes = "junio"; break;
		case "07": $nmes = "julio"; break;		case "08": $nmes = "agosto"; break;		case "09": $nmes = "septiembre"; break;
		case "10": $nmes = "octubre"; break;	case "11": $nmes = "noviembre"; break;	case "12": $nmes = "diciembre"; break;
	}

	$fecha = date("d").' de '.$nmes.' de '.date("Y");
	$fecha2 = date("Y") .'-'. date("m").'-'.date("d");
	$fecha3 = date("d").'/'. date("m").'/'.date("Y");
	$hora = date("h").':'.date("i").':'.date("s").date("a");
	$num_sem = date("N");
	$d_año = (date("z")+1);
	$s_año = date("W");
	switch (date("N")) {
		case 1: $nom_sem = "Lunes"; break;			case 2: $nom_sem = "Martes"; break;		case 3: $nom_sem = "Miércoles"; break;
		case 4: $nom_sem = "Jueves"; break;			case 5: $nom_sem = "Viernes"; break;	case 6: $nom_sem = "Sábado"; break;
		case 7: $nom_sem = "Domingo"; break;
		}
	$lt = [$fecha, $hora, $num_sem, $nom_sem, $d_año, $s_año, $fecha2,$nmes,$fecha3];
	return $lt;
	}
?>