<?php
    session_start();
    include '../opendb.php';
    include_once('../func.php');
    $medicos = getItensTable($mysql_conn,"medicos");
    


    
    // Include autoLoader

    require_once "../../dist/dompdf/autoload.inc.php";


    
    // Reference the Dompdf namespace
    ob_start();
    include 'plantaoHtml.php';
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

    //Render the HTML as PDF

    $dompdf->render();

    // Output the generated PDF
    $dompdf->stream("Relatorio Plantao", array("Attachment" => 0));


?>