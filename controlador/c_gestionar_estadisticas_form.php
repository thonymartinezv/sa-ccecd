<?php 
    require_once('modelo/m_Acceso.php');
    $acceso = new Acceso();
    if (count($_POST) < 1) {
        $accesos = $acceso->consultar_acc();
    }else{

        $accesos = $acceso->consultar_acc_by_all($_POST["fecha-inicio"],$_POST["fecha-fin"],$_POST["estado"],$_POST["prioridad"]);
        
    }
    include("vista/v_gestionar_estadisticas_form.php");
?>