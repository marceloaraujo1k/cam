<?php 
/*
* Criando e exportando planilhas do Excel
* /
*/


$doc = new DOMDocument();

ob_start();
//    include "relatorioFaturaSUS.php?id=&start_date=2019-1-1&end_date=2019-4-30&filtroDataTipo=2&hospital=WILSON%20ROSADO";
//	include 'faturaHtmlSUS.php?id;
   //$html1 = ob_get_clean();
   // if (ob_get_length()) ob_end_clean();
  $html1 = '<body>';
  $html1 .= '<div id="mydiv"></div>';
  $html1 .= '</body>';


$doc->loadHTMLFile($html1);
$arquivo = 'FATURA_SUS.xls';
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
header ("Content-Description: PHP Generated Data" );
// Envia o conteúdo do arquivo
echo $doc->saveHTML();


exit;


// Definimos o nome do arquivo que será exportado
/*$arquivo = 'planilha.xls';
// Criamos uma tabela HTML com o formato da planilha
$html = '';
$html .= '<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 align=left width=107 style="width:770.45pt;border-collapse:collapse;margin-left:6.75pt;margin-right:6.75pt">';
$html .= '<tr style="height:11.05pt">';
$html .= '<td width=783 nowrap colspan=4 valign=bottom style="width:586.9pt;border:solid windowtext 1.0pt;border-right:none;background:#A6A6A6;padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt">';
$html .= '<p class=MsoNormal align=center style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:center;line-height:normal"><b><span style="color:white">FATURA SUS</span></b></p>';
$html .=  '</td>';
$html .=  '<td width=129 style="width:97.1pt;border:solid windowtext 1.0pt;background:#A6A6A6;padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt"><td width=129 style="width:97.1pt;border:solid windowtext 1.0pt;background:#A6A6A6;padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt">';
$html .= '<p class=MsoNormal align=center style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:center;line-height:normal"><b><span style="color:white">PERÍODO</span></b></p>';
$html .= '</td>';
$html .= '<td width=115 nowrap style="width:86.45pt;border:solid windowtext 1.0pt;border-left:none;background:yellow;padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt">';
$html .= '<p class=MsoNormal align=center style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:center;line-height:normal"><b></b></p>';
$html .= '</td>';
$html .= '</tr>';
$html .= '</table>';
// Configurações header para forçar o download
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
header ("Content-Description: PHP Generated Data" );
// Envia o conteúdo do arquivo
echo $html;
exit; */


?>

<script>
$(document).ready(function() {
   $.get("http://localhost/cam/pages/financeiro/relatorioPlanodeSaude.php?id=1&start_date=2019-1-1&end_date=2019-4-30&filtroDataTipo=2&hospital=WILSON%20ROSADO.php",function(data){
      $('.mydiv').html(data);
  });
});
</script>
