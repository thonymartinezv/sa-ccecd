<?php
    if (!isset($_SESSION['email_otic']) || $_SESSION['pri_otic']  < 1) {
        header("Location: ./");
        die();
    }else{
        if (isset($_POST) && count($_POST) > 2) {
            require_once('modelo/m_Acceso.php');
            require_once('modelo/m_Empleado.php');
            $acceso = new Acceso();
            $empleado = new Empleado();
            $administrador = $empleado->findByEmail($_SESSION["email_otic"]);
            if($empleado->searchByCi_count($_POST["ci_emp"])<1){
                header("location: ./?c=gestionar_acceso&mf=La cédula ingresada no pertenece a ningún empleado del sistema.");
                exit(); 
            }
            $acceso->setCI_mon($_POST["ci_emp"]);
            $acceso->setMotivo($_POST["motivo"]);
            $acceso->setAvance($_POST["avance"]);
            $acceso->setNivel($_POST["prioridad_acceso"]);
            $acceso->setEstado(0);
            $acceso->setCI_adm($administrador["ci_emp"]);
            if($acceso->crear_acc()){
                header("location: ./?c=gestionar_acceso&ms=Se ha creado el nuevo acceso exitosamente");
            }else{
                header("location: ./?c=gestionar_acceso&mf=No se ha podido crear el nuevo acceso por algún fallo interno. Por favor, consulte con soporte.");
            }
        }else{
            header("location: ./");
        }
    }

?>