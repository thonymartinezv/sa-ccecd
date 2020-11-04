<?php
    session_start();
    if (isset($_GET["r"]) && file_exists("controlador/routes/r_".$_GET["r"].".php")){
        include("controlador/routes/r_".$_GET["r"].".php");
    }else{
        if (isset($_GET["c"]) && file_exists("controlador/c_".$_GET["c"].".php")){
            include("controlador/c_".$_GET["c"].".php");
        }else{
            if (isset($_SESSION['pri_otic'])){
                switch ($_SESSION['pri_otic']){ // Dependiendo del privilegio o cargo se redirecciona a un determinado menú
                    case 1: case 2: include("controlador/routes/r_admin_index.php");	break; // DG y SAO (Administrador)
                    case 0: include("controlador/routes/r_monitor_index.php");	break; // DIS (Monitoreo)
                }
            }else {
                include("controlador/routes/r_login.php");
            }
        }
    }
?>