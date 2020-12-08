<?php

    include_once('funciones/generate_pdf.php');
    require_once('modelo/m_Acceso.php');
    $acceso = new Acceso();
    $accesos = $acceso->consultar_acc_pdf(
        (isset($_POST["fecha-inicio"])?$_POST["fecha-inicio"]:""),
        (isset($_POST["fecha-fin"])?$_POST["fecha-fin"]:""),
        (isset($_POST["estado"])?$_POST["estado"]:"-1"),
        (isset($_POST["prioridad"])?$_POST["prioridad"]:"-1"),
        (isset($_POST["administrador"])?$_POST["administrador"]:""),
        (isset($_POST["empleado"])?$_POST["empleado"]:"")
    );
    $html = '
    <img src="img/mppct.jpg" width="1560" height="144">
    <div id="main-container">
        <table>
            <thead>
                <tr>
                    <td scope="col">Empleado</td>
                    <td scope="col">Administrador</td>
                    <td scope="col">C.I Empleado</td>
                    <td scope="col">C.I Administrador</td>
                    <td scope="col">Prioridad</td>
                    <td scope="col">Estado</td>
                    <td scope="col">Motivo</td>
                    <td scope="col">Fecha</td>
                </tr>
            </thead>
            <tbody>
    ';
    for ($i=0; $i < count($accesos); $i++) { 
        $html .="<tr>";
        $html .='<td>'.$accesos[$i]["mon_nombre"].'</td>';
        $html .='<td>'.$accesos[$i]["adm_nombre"].'</td>';
        $html .='<td>'.$accesos[$i]["ci_mon"].'</td>';
        $html .='<td>'.$accesos[$i]["ci_adm"].'</td>';
        $html .='<td>'.($accesos[$i]["prioridad"]>0?($accesos[$i]["prioridad"]>1?"Alta":"Moderada"):"Baja").'</td>';
        $html .='<td>'.($accesos[$i]["estado_acc"]>0?($accesos[$i]["estado_acc"]>1?"Cancelado":"Finalizado"):"En proceso").'</td>';
        $html .='<td>'.($accesos[$i]["motivo"]).'</td>';
        $html .='<td><div class="cuadro">'.($accesos[$i]["fcha_inicio"].'</div><br><div class="cuadro">'.$accesos[$i]["fcha_final"]).'</div></td>';
        $html .="</tr>";
    }
    $html.= "</tbody></table></div>";
    $mpdf = generatePdf($html);

    $mpdf->Output();

?>

