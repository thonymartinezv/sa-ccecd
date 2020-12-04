<?php 

require_once 'vendor/autoload.php';

function generatePdf($html)
{
    $mpdf = new \Mpdf\Mpdf();
    $stylesheet = file_get_contents('css/tabla-pdf.css');
    $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
    return $mpdf;
}

?>