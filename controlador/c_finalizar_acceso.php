<?php
    require_once('modelo/m_Acceso.php');
    $acceso = new Acceso();
    $acceso->setID_acc($_GET['id']);
    if($acceso->finalizar_acceso()){
        header("location: ./?c=gestionar_acceso&ms=Se ha finalizado el acceso exitosamente");
    }else{
        header("location: ./?c=gestionar_acceso&mf=No se ha podido finalizar el acceso por algún fallo interno. Por favor, consulte con soporte.");
    }
?>