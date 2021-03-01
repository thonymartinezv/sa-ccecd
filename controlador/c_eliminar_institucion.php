<?php
    if (!isset($_SESSION['email_otic'])) {
        header("Location: ./");
        die();
    } else {
        if ($_SESSION['pri_otic']  < 1) {
            $msj = "Acción denegada por permisos insuficientes";
            header("Location: ./?md=".$msj);
            die();
        }
        require_once("modelo/m_Institucion.php");
        require_once("modelo/m_Empleado.php");
        $inst = new Institucion();
        $empleado = new Empleado();
        $inst->setId($_GET["id"]);
        if (!$inst->ver_inst()) {
            $msj = "La institución que quiere eliminar no existe";
            header("Location: ./?c=gestionar_institucion&md=".$msj);
            die();
        }
        if ($empleado->existByinst($_GET["id"])) {
            $msj = "La institución que quiere eliminar se encuentra en uso";
            header("Location: ./?c=gestionar_institucion&md=".$msj);
            die();
        }
        if ($empleado->existByinst($_GET["id"])) {
            $msj = "La institución que quiere eliminar se encuentra en uso";
            header("Location: ./?c=gestionar_institucion&md=".$msj);
            die();
        }

        if ($inst->eliminar_inst()) {
			$msj = "Se ha eliminado con éxito la institución";
			header("Location: ./?c=gestionar_institucion&ms=".$msj);
		} else{
			//var_dump($emp->crear_emp(true)->errorInfo());exit();
			$msj = "Ha ocurrido un error al eliminar la institución";
			header("Location: ./?c=gestionar_institucion&md=".$msj);
		}




    }


?>