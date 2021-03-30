<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


require_once "./lib/dompdf/autoload.inc.php";
use Dompdf\Dompdf;


class pdf{

    function loadInvoicePDF(){
        ob_start();
        include 'invoicepdf.php';
        $rawHtml = ob_get_clean();

        $html = "<link rel='stylesheet' href='../css/bootstrap.css'> . $rawHtml";

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        $dompdf->render();
        return $dompdf->output();
    }
}



//
//// (Optional) Setup the paper size and orientation
//$dompdf->setPaper('A4', 'landscape');
//
//// Render the HTML as PDF
//$dompdf->render();
//
//// Output the generated PDF to Browser
//$dompdf->stream();
?>


