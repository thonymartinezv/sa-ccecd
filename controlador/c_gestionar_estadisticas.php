<?php
    if (!isset($_SESSION['email_otic'])) {
        header("Location: ./");
        die();
    }else{
        require_once('modelo/m_Acceso.php');
        require_once("modelo/m_institucion.php"); // Clase Modelo de CRUD institución
        $institucion = new Institucion();
        $inst = $institucion->consultar_inst();
        $acceso = new Acceso();
        if (count($_POST) < 1) {
            $proceso = $acceso->est_pro()[0];
            $proceso = $proceso[array_keys($proceso)[0]];
            $finalizado = $acceso->est_fin()[0];
            $finalizado = $finalizado[array_keys($finalizado)[0]];
            $cancelado = $acceso->est_can()[0];
            $cancelado = $cancelado[array_keys($cancelado)[0]];
        }else{
            $proceso = $acceso->est_pro_by_all(
                $_POST["fecha-inicio"],
                $_POST["fecha-fin"],
                $_POST["prioridad"],
                $_POST["administrador"],
                $_POST["empleado"],
                $_POST["institution"]
            )[0];
            $proceso = $proceso[array_keys($proceso)[0]];
            $finalizado = $acceso->est_fin_by_all(
                $_POST["fecha-inicio"],
                $_POST["fecha-fin"],
                $_POST["prioridad"],
                $_POST["administrador"],
                $_POST["empleado"],
                $_POST["institution"]
            )[0];
            $finalizado = $finalizado[array_keys($finalizado)[0]];
            $cancelado = $acceso->est_can_by_all(
                $_POST["fecha-inicio"],
                $_POST["fecha-fin"],
                $_POST["prioridad"],
                $_POST["administrador"],
                $_POST["empleado"],
                $_POST["institution"]
            )[0];
            $cancelado = $cancelado[array_keys($cancelado)[0]];
        }
        $total = $proceso + $finalizado + $cancelado;
        include("vista/v_gestionar_estadisticas.php");
    }
?>