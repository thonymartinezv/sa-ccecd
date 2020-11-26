<?php

    require_once('modelo/m_Acceso.php');
    $acceso = new Acceso();
    $acceso->setID_acc($_GET['id']);
    if($acceso->cancelar_acceso()){
        header("location: ./?c=gestionar_acceso&ms=Se ha cancelado el acceso exitosamente");
    }else{
        header("location: ./?c=gestionar_acceso&mf=No se ha podido cancelar el acceso por algún fallo interno. Por favor, consulte con soporte.");
    }

?>