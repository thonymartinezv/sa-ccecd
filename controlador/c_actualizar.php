<?php
$_SESSION['pri_otic'] = 2;
if (!isset($_SESSION['email_otic']) || $_SESSION['pri_otic'] == 0) {
    header("Location: ./");
    die();
} else {
    require_once("modelo/m_Empleado.php");
    $emp = new Empleado();
    $emp->setEmail_emp($_POST['email_emp']);
    $emp->setCI_emp($_POST['ci_emp']);
    $emp->setP_nomb($_POST['p_nomb']);
    $emp->setS_nomb($_POST['s_nomb']);
    $emp->setP_apel($_POST['p_apel']);
    $emp->setS_apel($_POST['s_apel']);
    $emp->setEmail($_POST['id']);
    $emp->setPri_emp($_SESSION['pri_otic']);
    if ($_SESSION['pri_otic'] == 2) {
        $emp->setPri($_POST['pri_usu']);
    }
    if($emp->actualizar_emp()) {
        $msj = "Se ha completado con éxito la actualización del empleado";
        header("Location: ./?ms=".$msj);
    } else{
        $msj = "Ha ocurrido un error al actualizar el empleado";
        header("Location: ./?md=".$msj);
    }
}