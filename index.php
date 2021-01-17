<?php
    session_start();
    if (isset($_GET["r"]) && file_exists("controlador/routes/r_".$_GET["r"].".php")){
        include("controlador/routes/r_".$_GET["r"].".php");
    }else{
        if (isset($_GET["c"]) && file_exists("controlador/c_".$_GET["c"].".php")){
            include("controlador/c_".$_GET["c"].".php");
        }else{
            if (isset($_SESSION['pri_otic'])){
                include("controlador/routes/r_admin_index.php");
            }else {
                include("controlador/routes/r_login.php");
            }
        }
    }
?>