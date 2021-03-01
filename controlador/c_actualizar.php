<?php
if (!isset($_SESSION['email_otic'])) {
    header("Location: ./");
    die();
} else {
    if ($_SESSION['pri_otic']  < 1 && $_SESSION['email_otic'] != $_POST['id']) {
        $msj = "Acción denegada por permisos insuficientes";
        header("Location: ./?md=".$msj);
        die();
    }

    require_once("modelo/m_Usuario.php");
    $user = new Usuario();

    if ($_POST['id'] != $_POST['email_emp'] && $user->existEmail($_POST['email_emp'])) {// comprobar si el correo ya fue registrado
        $msj = "El email ingresado ya fue registrado anteriormente en el sistema";
        header("Location: ./?md=".$msj);
        die();
    }

    require_once("modelo/m_Empleado.php");
    $emp = new Empleado();
    if (!isset($_GET['pass'])) {
        $emp->setEmail_emp($_POST['email_emp']);
        $emp->setCI_emp($_POST['ci_emp']);
        $emp->setP_nomb($_POST['p_nomb']);
        $emp->setS_nomb($_POST['s_nomb']);
        $emp->setP_apel($_POST['p_apel']);
        $emp->setS_apel($_POST['s_apel']);
        $emp->setEmail($_POST['id']);
        $emp->setPri_emp($_SESSION['pri_otic']);
        $emp->setPri($_POST['pri_usu']);
        $emp->setInstitution($_POST['institution']);
		$emp->setTlf($_POST['tlf']);
        if($emp->actualizar_emp()) {
            $msj = "Se ha completado con éxito la actualización del empleado";
            header("Location: ./?ms=".$msj);
        } else{
            $msj = "Ha ocurrido un error al actualizar el empleado";
            header("Location: ./?md=".$msj);
        }
    }else{
        $emp->setPri_emp($_SESSION['pri_otic']);
        $emp->setEmail_emp($_POST['id']);
        $emp->setClave($_POST['password']);
        if($emp->actualizar_pass()) {
            $msj = "Se ha completado con éxito la actualización de la contraseña del empleado";
            header("Location: ./?ms=".$msj);
        } else{
            $msj = "Ha ocurrido un error al actualizar la contraseña del empleado";
            header("Location: ./?md=".$msj);
        }
    }
}