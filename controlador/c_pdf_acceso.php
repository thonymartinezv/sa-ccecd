<?php

    if (!isset($_SESSION['email_otic'])) {
        header("Location: ./");
        die();
    }else{
        include_once('funciones/generate_pdf.php');
        require_once('modelo/m_Acceso.php');
        $acceso = new Acceso();
        $accesos = $acceso->consultar_acc_pdf_by_id($_GET['id']);
        $html = '
        <img src="img/mppct.jpg" width="1560" height="144">
        <div id="main-container">
            <table>
                <thead>
                    <tr>
                        <th scope="col" style="color:white;" colspan="2">Datos de acceso</th>
                    </tr>
                </thead>
                <tbody>
        ';
            $html .="<tr>";
            $html .='<td>Nombre del usuario:</td>';
            $html .='<td>'.$accesos["mon_nombre"].'</td>';
            $html .="</tr>";

            $html .="<tr>";
            $html .='<td>cédula del usuario:</td>';
            $html .='<td>'.$accesos["ci_mon"].'</td>';
            $html .="</tr>";

            $html .="<tr>";
            $html .='<td>Institución del usuario:</td>';
            $html .='<td>'.$accesos["institution"].'</td>';
            $html .="</tr>";
            
            $html .="<tr>";
            $html .='<td>Nombre del administrador:</td>';
            $html .='<td>'.$accesos["adm_nombre"].'</td>';
            $html .="</tr>";

            $html .="<tr>";
            $html .='<td>cédula del administrador:</td>';
            $html .='<td>'.$accesos["ci_adm"].'</td>';
            $html .="</tr>";

            $html .="<tr>";
            $html .='<td>Prioridad de acceso:</td>';
            $html .='<td>'.($accesos["prioridad"]>0?($accesos["prioridad"]>1?"Alta":"Moderada"):"Baja").'</td>';
            $html .="</tr>";

            $html .="<tr>";
            $html .='<td>Estatus de acceso:</td>';
            $html .='<td>'.($accesos["estado_acc"]>0?($accesos["estado_acc"]>1?"Cancelado":"Finalizado"):"En proceso").'</td>';
            $html .="</tr>";

            $html .="<tr>";
            $html .='<td>Motivo:</td>';
            $html .='<td>'.($accesos["motivo"]).'</td>';
            $html .="</tr>";

            $html .="<tr>";
            $html .='<td>Fecha y hora de acceso:</td>';
            $html .='<td>'.$accesos["fcha_inicio"].'</td>';
            $html .="</tr>";

            $html .="<tr>";
            $html .='<td>Fecha y hora de salida:</td>';
            $html .='<td>'.$accesos["fcha_final"].'</td>';
            $html .="</tr>";

            $html .="<tr>";
            $html .='<td>Avance:</td>';
            $html .='<td>'.$accesos["avance"].'</td>';
            $html .="</tr>";

            $html .="<tr>";
            $html .='<td>Reporte Final:</td>';
            $html .='<td>'.$accesos["reporte"].'</td>';
            $html .="</tr>";

        $html.= "</tbody></table></div>";
        $mpdf = generatePdf($html);

        $mpdf->Output();
    }
?>