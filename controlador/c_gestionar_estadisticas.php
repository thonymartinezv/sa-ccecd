<?php
    require_once('modelo/m_Acceso.php');
    $acceso = new Acceso();
    if (count($_POST) < 1) {
        $proceso = $acceso->est_pro()[0]['count'];
        $finalizado = $acceso->est_fin()[0]['count'];
        $cancelado = $acceso->est_can()[0]['count'];
    }else{
        $proceso = $acceso->est_pro_by_all(
            $_POST["fecha-inicio"],
            $_POST["fecha-fin"],
            $_POST["prioridad"],
            $_POST["administrador"],
            $_POST["empleado"]
        )[0]['count'];
        $finalizado = $acceso->est_fin_by_all(
            $_POST["fecha-inicio"],
            $_POST["fecha-fin"],
            $_POST["prioridad"],
            $_POST["administrador"],
            $_POST["empleado"]
        )[0]['count'];
        $cancelado = $acceso->est_can_by_all(
            $_POST["fecha-inicio"],
            $_POST["fecha-fin"],
            $_POST["prioridad"],
            $_POST["administrador"],
            $_POST["empleado"]
        )[0]['count'];
    }
    $total = $proceso + $finalizado + $cancelado;
    include("vista/v_gestionar_estadisticas.php");
?>