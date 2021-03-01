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
        $pagina = isset($_GET["pag"])?intval($_GET["pag"]):1;
        $cantidad = (isset($_GET["num"])?intval($_GET["num"]):10);
        $accesos = $acceso->consultar_acc_by_all(
                (isset($_POST["fecha-inicio"])?$_POST["fecha-inicio"]:""),
                (isset($_POST["fecha-fin"])?$_POST["fecha-fin"]:""),
                (isset($_POST["estado"])?$_POST["estado"]:"-1"),
                (isset($_POST["prioridad"])?$_POST["prioridad"]:"-1"),
                (isset($_POST["administrador"])?$_POST["administrador"]:""),
                (isset($_POST["empleado"])?$_POST["empleado"]:""),
                (isset($_POST["institution"])?$_POST["institution"]:""),
                (($pagina-1)*$cantidad),
                $cantidad
        );
        $total = $acceso->consultar_acc_by_all_count(
            (isset($_POST["fecha-inicio"])?$_POST["fecha-inicio"]:""),
            (isset($_POST["fecha-fin"])?$_POST["fecha-fin"]:""),
            (isset($_POST["estado"])?$_POST["estado"]:"-1"),
            (isset($_POST["prioridad"])?$_POST["prioridad"]:"-1"),
            (isset($_POST["administrador"])?$_POST["administrador"]:""),
            (isset($_POST["empleado"])?$_POST["empleado"]:""),
            (isset($_POST["institution"])?$_POST["institution"]:"")
        )[0];
        $total = $total[array_keys($total)[0]];

        $paginas = ceil($total/$cantidad);
        $pagina_anterior = isset($_GET['pag'])?intval($_GET['pag'])-1:0;
        if (isset($_GET['pag'])) {
            if (intval($_GET['pag'])+1 <= $paginas) {
                $pagina_siguiente = intval($_GET['pag'])+1;
            }else{
                $pagina_siguiente = intval($_GET['pag']);
            }
        }else{
            if ($paginas > 1) {
                $pagina_siguiente = 2;
            }else{
                $pagina_siguiente = 0;
            }
        }
        include("vista/v_gestionar_estadisticas_form.php");
    }
?>