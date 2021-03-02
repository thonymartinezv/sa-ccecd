<?php 
    if (!isset($_SESSION['email_otic']) || $_SESSION['pri_otic']  < 1) {
        header("Location: ./");
        die();
    }else{
        $pagina = isset($_GET["pag"])?intval($_GET["pag"]):1;
        $cantidad = (isset($_GET["num"])?intval($_GET["num"]):10);
        require_once("modelo/m_Institucion.php");
        $institucion = new Institucion();
        $inst = $institucion->consultar_inst($cantidad, (($pagina-1)*$cantidad) );
        $total = $institucion->inst_count();
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

        include("vista/v_gestionar_institucion.php");
    }
?>