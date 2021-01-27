<?php 
    if (!isset($_SESSION['email_otic']) || $_SESSION['pri_otic']  < 1) {
        header("Location: ./");
        die();
    }else{
        require_once('modelo/m_Acceso.php');
        $acceso = new Acceso();
        $accesos = $acceso->consultar_acc_proceso();
        include("vista/v_gestionar_acceso.php");
    }
?>