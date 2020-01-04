<?php

require_once __DIR__ . '../../../vendor/mpdf/autoload.php';

$mpdf = new \Mpdf\Mpdf();

ob_start();
    include "faturaHtmlSUS.php?id=&start_date=2019-1-1&end_date=2019-4-30&filtroDataTipo=2&hospital=WILSON%20ROSADO";
//	include 'faturaHtmlSUS.php?id;
   $html1 = ob_get_clean();
    if (ob_get_length()) ob_end_clean();
	

$mpdf->WriteHTML($html1);
$mpdf->Output();
?>
