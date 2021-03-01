<?php 
    if (!isset($_SESSION['email_otic']) || $_SESSION['pri_otic']  < 1) {
        header("Location: ./");
        die();
    }else{
        require_once("modelo/m_Institucion.php");
        $institucion = new Institucion();
        $inst = $institucion->consultar_inst();
        include("vista/v_gestionar_institucion.php");
    }
?>