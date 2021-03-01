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
    $inst = new Institucion();

    if ($inst->ver_inst_by_nombre($_POST['nombre'])) {// comprobar si la institución ya fue registrada en el sistema
        $msj = "El nombre de la institución ingresado ya existe en el sistema";
        header("Location: ./?c=gestionar_institucion&md=".$msj);
        die();
    }

    $inst->setNombre($_POST['nombre']);
    $inst->setId($_POST['id']);
    if($inst->editar_inst()) {
        $msj = "Se ha completado con éxito la edición de la institución";
        header("Location: ./?c=gestionar_institucion&ms=".$msj);
    } else{
        //var_dump($emp->crear_emp(true)->errorInfo());exit();
        $msj = "Ha ocurrido un error al editar la institución";
        header("Location: ./?c=gestionar_institucion&md=".$msj);
    }
}