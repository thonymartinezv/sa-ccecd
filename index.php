<?php
    session_start();
    if (isset($_GET["c"]) && file_exists("controlador/c_".$_GET["c"].".php")){
        include("controlador/c_".$_GET["c"].".php");
    }else{
        if (isset($_SESSION['pri_otic'])){
            include("controlador/c_admin_index.php");
        }else {
            include("controlador/c_login.php");
        }
    }
?>