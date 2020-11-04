<?php
// Comprobar si se ha iniciado sesión o validar el permiso para el acceso (Sólo tiene permiso Administrador)
if (!isset($_SESSION['email_otic']) || $_SESSION['pri_otic'] == 0){
	include("vista/v_R.html");
}else{
    include("vista/v_GE_crear.php");
}