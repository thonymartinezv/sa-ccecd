<?php
    if (!isset($_SESSION['email_otic']) || ($_SESSION['pri_otic'] == 0)) {
        header("Location: ./");
        die();
    }
    require_once("modelo/m_Empleado.php"); // Clase Modelo de CRUD Empleado
    $empleado_instancia = new Empleado();
    if (isset($_GET["search"])) {

        if (strlen(str_replace(' ', '',$_GET["search"])) > 0) {
            $search = $_GET["search"];
            if (!(strpos($search, "@") === false)) {
                if (count(explode("@", $search))>1 && explode("@", $search)[1] == "mppct.gob.ve" ) {
                    $search = explode("@", $search)[0];
                }
            }

            $empleados = $empleado_instancia->searchByEmail($search);
            if (count($empleados) < 1) {
                $empleados = $empleado_instancia->searchByCi($search);
            }
        }else{
            $empleados = $empleado_instancia->all();
        }
    }else{
        $empleados = $empleado_instancia->all();
    }

    include("vista/v_index_admin.php");

?>