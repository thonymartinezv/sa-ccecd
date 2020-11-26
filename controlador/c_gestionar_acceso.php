<?php 
    require_once('modelo/m_Acceso.php');
    $acceso = new Acceso();

    $accesos = $acceso->consultar_acc_proceso();
        
    include("vista/v_gestionar_acceso.php");
?>