<?php
    session_start();
    include '../opendb.php';
    include_once('../func.php');
     // Include autoLoader
     ini_set('memory_limit', '-1');
    // ini_set('MAX_EXECUTION_TIME', 300);

    require_once "../../dist/dompdf/autoload.inc.php";


    
    // Reference the Dompdf namespace
    ob_start();
    include 'faturaHtmlSUS.php';
    $html1 = ob_get_clean();
    if (ob_get_length()) ob_end_clean();
    use Dompdf\Dompdf;

    
// Instantiate dompdf class

    $dompdf = new Dompdf();

    // Load HTML content
    //$dompdf->loadHtml("<h1>TESTE</h1>");

    //Load Content From HTML file
   // $html = file_get_contents("plantaoHtml.php");
    $dompdf->loadHtml($html1);



    // Setup paper size
    $dompdf->setPaper('A4', 'landscape');
  //  $papel = array(0,0,1500.00,866.20);
  //  $dompdf->set_paper($papel, 'portrait');
    //Render the HTML as PDF

    $dompdf->render();

    // Output the generated PDF
    $dompdf->stream("Fatura SUS", array("Attachment" => 0));


 ?>