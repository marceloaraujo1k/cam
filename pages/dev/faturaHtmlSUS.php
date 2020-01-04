<?php 

header("Content-type: text/html; charset=utf-8");
include '../opendb.php';
include_once('../func.php');


ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

//Periodo 
$id = $_GET["id"];
$start_date = $_GET["start_date"];
$end_date = $_GET["end_date"];
// Essa variavel define o tipo de filtro de data  "0"=Data de Realização  | "1=Data de Cobrança  | "2"=Data de Pagamento | "3"=Data de Repasse
$filtroDataTipo = $_GET["filtroDataTipo"];

$dataOpcao = null;

switch ($filtroDataTipo) {
	case '0':
    $dataOpcao = "dataRealizacao";
    $status = "PENDENTE";
    break;
	
	case '1':
		$dataOpcao = "dataCobranca";
		break;

	case '2':
    $dataOpcao = "dataPagamento";
    $status = "PAGO";
			break;
	
	case '3':
		$dataOpcao = "dataRepasse";
		break;	
} 

$query=null;

if (!empty($id)){

  $query = "SELECT producao.idconvenio, producao.idmedico, producao.medico,  sum(producao.valorProcedimento) , producao.hospital, producao.dataPagamento,
  sum(producao.valorRecebido) as total, convenio.pis, convenio.cofins, convenio.csll, convenio.irpj, convenio.iss, convenio.outros_encargos, convenio.classificacao, convenio.idconvenio 
  FROM producao inner join convenio on producao.idconvenio = convenio.idconvenio  where  producao.idconvenio = 21 AND producao.hospital = '".$_GET["hospital"]."' 
  AND producao.idmedico='".$_GET["id"]."' AND producao.".$dataOpcao."  BETWEEN '.$start_date.' AND '.$end_date.' group by producao.idmedico;";
}
else {
  $query =  "SELECT producao.idconvenio, producao.idmedico, producao.medico,  sum(producao.valorProcedimento) , producao.hospital, 
  sum(producao.valorRecebido) as total, convenio.pis, convenio.cofins, convenio.csll, convenio.irpj, convenio.iss, convenio.outros_encargos, convenio.classificacao, convenio.idconvenio FROM producao inner join convenio 
  on producao.idconvenio = convenio.idconvenio  where  producao.idconvenio = 21 AND  producao.hospital = '".$_GET["hospital"]."' 
  AND producao.".$dataOpcao."  BETWEEN '.$start_date.' AND '.$end_date.' group by producao.idmedico;";
}

$result = mysqli_query($mysql_conn, $query);


$mesFatura = $start_date;

?>

<html>

<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=Generator content="Microsoft Word 15 (filtered)">
<style>

 /* Font Definitions */
 @font-face
	{font-family:"Cambria Math";
	panose-1:2 4 5 3 5 4 6 3 2 4;}
@font-face
	{font-family:Calibri;
	panose-1:2 15 5 2 2 2 4 3 2 4;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:8.0pt;
	margin-left:0cm;
	line-height:107%;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";}
a:link, span.MsoHyperlink
	{color:#0563C1;
	text-decoration:underline;}
a:visited, span.MsoHyperlinkFollowed
	{color:#954F72;
	text-decoration:underline;}
.MsoChpDefault
	{font-family:"Calibri","sans-serif";}
.MsoPapDefault
	{margin-bottom:8.0pt;
	line-height:107%;}
@page WordSection1
	{size:841.95pt 21.0cm;
	margin:36.0pt 36.0pt 36.0pt 36.0pt;}
div.WordSection1
	{page:WordSection1;}

</style>

</head>

<body lang="pt" link="#0563C1" vlink="#954F72">

<div class=WordSection1>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 align=left
 	width=107 style='width:770.45pt;border-collapse:collapse;margin-left:6.75pt;
 	margin-right:6.75pt'>
 <tr style='height:11.05pt'>
  <td width=783 nowrap colspan=4 valign=bottom style='width:586.9pt;border:
 	solid windowtext 1.0pt;border-right:none;background:#A6A6A6;padding:0cm 5.4pt 0cm 5.4pt;
 	height:11.05pt'>
 	<p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
 	text-align:center;line-height:normal'><b><span style='color:white'>
  	FATURA SUS</span></b></p>
  </td>
  <td width=129 style='width:97.1pt;border:solid windowtext 1.0pt;background:
	  #A6A6A6;padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
 	 <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
 		 text-align:center;line-height:normal'><b><span style='color:white'>PERÍODO</span></b></p>
  </td>
	<td width=115 nowrap style='width:86.45pt;border:solid windowtext 1.0pt;
		border-left:none;background:yellow;padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
		<p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
		text-align:center;line-height:normal'><b>
		<?php setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
		date_default_timezone_set('America/Sao_Paulo'); 
		echo strftime('%B %Y', strtotime($mesFatura));?>
		</b></p>
	</td>
 </tr>
 <tr style='height:3.7pt'>
  <td width=138 nowrap style='width:103.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=208 nowrap style='width:156.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=126 nowrap style='width:94.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=310 nowrap style='width:232.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=129 nowrap style='width:97.1pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=115 nowrap style='width:86.45pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
 </tr>
 <tr style='height:3.7pt'>
  <td width=138 nowrap style='width:103.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=208 nowrap style='width:156.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=126 nowrap style='width:94.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=310 nowrap style='width:232.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=129 nowrap style='width:97.1pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=115 nowrap style='width:86.45pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
 </tr>
 <tr style='height:22.2pt'>
  <td width=138 style='width:103.6pt;border:solid windowtext 1.0pt;background:
  #A6A6A6;padding:0cm 5.4pt 0cm 5.4pt;height:22.2pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='color:white'>PRESTADOR
  DE SERVIÇO</span></b></p>
  </td>
  <td width=208 style='width:156.15pt;border:solid windowtext 1.0pt;border-left:
  none;padding:0cm 5.4pt 0cm 5.4pt;height:22.2pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=PT-BR style='color:black'>Clínica
  de Anestesiologia de Mossoró - CAM</span></p>
  </td>
  <td width=126 style='width:94.55pt;border:solid windowtext 1.0pt;border-left:
  none;background:#A6A6A6;padding:0cm 5.4pt 0cm 5.4pt;height:22.2pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='color:white'>HOSPITAL/
  CONVÊNIO</span></b></p>
  </td>
  <td width=310 nowrap style='width:232.55pt;border:solid windowtext 1.0pt;
  border-left:none;background:yellow;padding:0cm 5.4pt 0cm 5.4pt;height:22.2pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;text-align:center;line-height:normal'><span style='color:black'>
  <?php echo $_GET["hospital"]; ?></span></p>
  </td>
  <td width=245 colspan=2 style='width:183.55pt;border:solid windowtext 1.0pt;
  border-left:none;background:#A6A6A6;padding:0cm 5.4pt 0cm 5.4pt;height:22.2pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='color:white'>INFORMAÇÕES
  PARA PAGAMENTO</span></b></p>
  </td>
 </tr>
 <tr style='height:11.05pt'>
  <td width=138 nowrap style='width:103.6pt;border:solid windowtext 1.0pt;
  border-top:none;background:#F2F2F2;padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>ENDEREÇO</p>
  </td>
  <td width=208 nowrap valign=bottom style='width:156.15pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=PT-BR>Rua 6 de janeiro,
  Santo Antônio</span></p>
  </td>
  <td width=126 nowrap style='width:94.55pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#F2F2F2;padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>ENDEREÇO</p>
  </td>
  <td width=310 nowrap valign=bottom style='width:232.55pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=PT-BR>Rua Doutor João
  Marcelino 429 A</span></p>
  </td>
  <td width=245 nowrap colspan=2 valign=bottom style='width:183.55pt;
  border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;
  border-right:solid black 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=PT-BR></span>BANCO </p>
  </td>
 </tr>
 <tr style='height:11.05pt'>
  <td width=138 nowrap valign=bottom style='width:103.6pt;border:solid windowtext 1.0pt;
  border-top:none;background:#F2F2F2;padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>CEP/CIDADE</p>
  </td>
  <td width=208 nowrap valign=bottom style='width:156.15pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>59.611-070  Mossor RN</p>
  </td>
  <td width=126 nowrap valign=bottom style='width:94.55pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#F2F2F2;padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>CEP/CIDADE</p>
  </td>
  <td width=310 nowrap valign=bottom style='width:232.55pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>59611-200 - Mossor/RN</p>
  </td>
  <td width=129 nowrap valign=bottom style='width:97.1pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#F2F2F2;padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>AGÊNCIA</p>
  </td>
  <td width=115 nowrap valign=bottom style='width:86.45pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>&nbsp;</p>
  </td>
 </tr>
 <tr style='height:11.05pt'>
  <td width=138 nowrap style='width:103.6pt;border:solid windowtext 1.0pt;
  border-top:none;background:#F2F2F2;padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>CNPJ</p>
  </td>
  <td width=208 nowrap style='width:156.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>CNPJ: 07.275.740/0001-80</p>
  </td>
  <td width=126 nowrap style='width:94.55pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#F2F2F2;padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>CNPJ</p>
  </td>
  <td width=310 nowrap style='width:232.55pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>07.303.701/0001-49</p>
  </td>
  <td width=129 nowrap style='width:97.1pt;border:none;border-right:solid windowtext 1.0pt;
  background:#F2F2F2;padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>CONTA CORRENTE</p>
  </td>
  <td width=115 nowrap style='width:86.45pt;border:none;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>&nbsp;</p>
  </td>
 </tr>
 <tr style='height:11.05pt'>
  <td width=138 style='width:103.6pt;border:solid windowtext 1.0pt;border-top:
  none;background:#F2F2F2;padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>TELEFONE</p>
  </td>
  <td width=208 nowrap style='width:156.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>Tel. 84 3314-1552</p>
  </td>
  <td width=126 style='width:94.55pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#F2F2F2;padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>TELEFONE</p>
  </td>
  <td width=310 nowrap style='width:232.55pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='color:white'>0</span></p>
  </td>
  <td width=129 nowrap style='width:97.1pt;border:solid windowtext 1.0pt;
  border-left:none;background:#A6A6A6;padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='color:white'>R$ FATURA</span></b></p>
  </td>
  <td width=115 nowrap style='width:86.45pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b>R$ 22.641,81 </b></p>
  </td>
 </tr>
 <tr style='height:11.05pt'>
  <td width=138 style='width:103.6pt;border:solid windowtext 1.0pt;border-top:
  none;background:#F2F2F2;padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>E-MAL</p>
  </td>
  <td width=208 nowrap style='width:156.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><u><span style='color:#0563C1'>cam.rn@bol.com.br</span></u></p>
  </td>
  <td width=126 nowrap style='width:94.55pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#A6A6A6;padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='color:white'>FILTRAR
  MÉDICO</span></b></p>
  </td>
  <td width=310 nowrap style='width:232.55pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:yellow;padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><?php echo $row["medico"]; ?></b></p>
  </td>
  <td width=129 nowrap style='width:97.1pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#A6A6A6;padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='color:white'>STATUS</span></b></p>
  </td>
  <td width=115 nowrap style='width:86.45pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:yellow;padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><?php echo $status; ?></b></p>
  </td>
 </tr>
 <tr style='height:3.7pt'>
  <td width=138 nowrap style='width:103.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=208 nowrap valign=bottom style='width:156.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=126 nowrap valign=bottom style='width:94.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=310 nowrap valign=bottom style='width:232.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=129 nowrap valign=bottom style='width:97.1pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=115 nowrap valign=bottom style='width:86.45pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
 </tr>
 
 <?php

// simple example query
$r=$result;

//starts the for loop, using mysql_num_rows() to count total
//amount of rows returned by $r



 $contador = 0;
 //    while($row = mysqli_fetch_assoc($result)){
   //     if ($contador <= 2) {
          for($i=0; $i<mysqli_num_rows($r); $i=$i+3){
            //advances the row in the mysql resource $r
         mysqli_data_seek($r,$i);
            //assigns the array keys, $users[row][field]
         $users[$i]=mysqli_fetch_row($r);
      
        echo "<tr style='height:10.4pt'>"
        . "<td width=126 nowrap valign=bottom style='width:94.55pt;border:solid windowtext 1.0pt;background:#F2F2F2;padding:0cm 5.4pt 0cm 5.4pt;height:10.4pt'>"
        . "<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:normal'><b><span style='color:black'>".$users[$i][2]."</span></b></p>"
        . "</td>"
        . " <td width=208 nowrap valign=bottom style='width:156.15pt;border:solid windowtext 1.0pt;border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:10.4pt'>"
        . "<p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;text-align:center;line-height:normal'><span style='color:black'>R$ ".$users[$i][3]."</span></p></td>"
        . "</td>";
        mysqli_data_seek($r,$i+1);
        $users[$i]=mysqli_fetch_row($r);
        echo "<td width=126 nowrap valign=bottom style='width:94.55pt;border:solid windowtext 1.0pt;background:#F2F2F2;padding:0cm 5.4pt 0cm 5.4pt;height:10.4pt'>"
        . "<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:normal'><b><span style='color:black'>".$users[$i][2]."</span></b></p>"
        . "</td>"
        . " <td width=208 nowrap valign=bottom style='width:156.15pt;border:solid windowtext 1.0pt;border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:10.4pt'>"
        . "<p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;text-align:center;line-height:normal'><span style='color:black'>R$ ".$users[$i][3]."</span></p></td>"
        . "</td>";
        mysqli_data_seek($r,$i+2);
        $users[$i]=mysqli_fetch_row($r);
        echo "<td width=126 nowrap valign=bottom style='width:94.55pt;border:solid windowtext 1.0pt;background:#F2F2F2;padding:0cm 5.4pt 0cm 5.4pt;height:10.4pt'>"
        . "<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:normal'><b><span style='color:black'>".$users[$i][2]."</span></b></p>"
        . "</td>"
        . " <td width=208 nowrap valign=bottom style='width:156.15pt;border:solid windowtext 1.0pt;border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:10.4pt'>"
        . "<p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;text-align:center;line-height:normal'><span style='color:black'>R$ ".$users[$i][3]."</span></p></td>"
        . "</td>";
          }
       //   $i=$i+2;

    
?>

<tr style='height:3.7pt'>
  <td width=138 nowrap style='width:103.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=208 nowrap valign=bottom style='width:156.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=126 nowrap valign=bottom style='width:94.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=310 nowrap valign=bottom style='width:232.55pt;padding:0cm 5.4pt 0cm 5.4pt; height:3.7pt'></td>
  <td width=129 nowrap valign=bottom style='width:97.1pt;padding:0cm 5.4pt 0cm 5.4pt;height:3.7pt'></td>
  <td width=115 nowrap valign=bottom style='width:86.45pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
 </tr>


 <tr style='height:11.05pt'>
  <td width=138 nowrap style='width:103.6pt;border:solid windowtext 1.0pt;
  border-bottom:none;background:#A6A6A6;padding:0cm 5.4pt 0cm 5.4pt;height:
  11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='color:white'>DATA DE</span></b></p>
  </td>
  <td width=208 nowrap valign=bottom style='width:156.15pt;border:none;
  border-top:solid windowtext 1.0pt;background:#A6A6A6;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='color:white'>NOME DO
  PACIENTE</span></b></p>
  </td>
  <td width=566 nowrap colspan=3 valign=bottom style='width:424.2pt;border:
  solid windowtext 1.0pt;border-right:solid black 1.0pt;background:#A6A6A6;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='color:white'>PROCEDIMENTO</span></b></p>
  </td>
  <td width=115 nowrap valign=bottom style='width:86.45pt;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:none;border-right:solid windowtext 1.0pt;
  background:#A6A6A6;padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='color:white'>R$ </span></b></p>
  </td>
 </tr>
 <tr style='height:11.05pt'>
  <td width=138 nowrap style='width:103.6pt;border-top:none;border-left:solid windowtext 1.0pt;
  border-bottom:none;border-right:solid windowtext 1.0pt;background:#A6A6A6;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='color:white'>REALIZAÇÃO</span></b></p>
  </td>
  <td width=208 nowrap valign=bottom style='width:156.15pt;background:#A6A6A6;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='color:white'>&nbsp;</span></b></p>
  </td>
  <td width=126 nowrap valign=bottom style='width:94.55pt;border-top:none;
  border-left:solid windowtext 1.0pt;border-bottom:none;border-right:solid windowtext 1.0pt;
  background:#A6A6A6;padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='color:white'>CÓD</span></b></p>
  </td>
  <td width=310 nowrap valign=bottom style='width:232.55pt;border:none;
  border-bottom:solid windowtext 1.0pt;background:#A6A6A6;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='color:white'>DESCRIÇÃO</span></b></p>
  </td>
  <td width=129 nowrap valign=bottom style='width:97.1pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#A6A6A6;padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='color:white'>ANESTESIOL.</span></b></p>
  </td>
  <td width=115 nowrap valign=bottom style='width:86.45pt;border:none;
  border-right:solid windowtext 1.0pt;background:#A6A6A6;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='color:white'>&nbsp;</span></b></p>
  </td>
 </tr>

 <?php // LISTAGEM DAS LINHAS DA FATURA // 

$query1=null;

  if(!empty($id)){
    $query1 =  "SELECT producao.dataRealizacao, producao.paciente, producao.idmedico, producao.medico, producao.codigoProcedimento, producao.descricaoProcedimento, 
    producao.dataPagamento, producao.valorProcedimento, producao.hospital, convenio.pis, convenio.cofins, convenio.csll, convenio.irpj, convenio.iss, convenio.outros_encargos, 
    convenio.classificacao, convenio.idconvenio FROM producao inner join convenio on producao.idconvenio = convenio.idconvenio  where  producao.idconvenio = 21 AND producao.idmedico='".$_GET["id"]."'
    AND producao.hospital = '".$_GET["hospital"]."' AND producao.".$dataOpcao."  BETWEEN '.$start_date.' AND '.$end_date.' ;"; 
      }
  else {
    $query1 =  "SELECT producao.dataRealizacao, producao.paciente, producao.idmedico, producao.medico, producao.codigoProcedimento, producao.descricaoProcedimento, 
     producao.valorProcedimento, producao.hospital, convenio.pis, convenio.cofins, convenio.csll, convenio.irpj, convenio.iss, convenio.outros_encargos, convenio.classificacao, convenio.idconvenio FROM producao inner join convenio 
    on producao.idconvenio = convenio.idconvenio  where  producao.idconvenio = 21 AND producao.hospital = '".$_GET["hospital"]."'  AND 
    producao.".$dataOpcao."  BETWEEN '.$start_date.' AND '.$end_date. ' order by producao.idmedico;";    
   }

$result1 = mysqli_query($mysql_conn, $query1);

if(mysqli_num_rows($result1) > 0){
    while($row1= mysqli_fetch_assoc($result1)){
?>

  <tr style='height:11.05pt'>
  <td width=138 nowrap style='width:103.6pt;border:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt; text-align:center;line-height:normal'>
  <span style='color:black'><?php echo strftime('%d/%m/%Y', strtotime($row1['dataRealizacao'])); ?> </span></p>
  </td>
 
  <td width=208 nowrap valign=bottom style='width:156.15pt;border:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:normal'><span style='color:black'><?php echo $row1['paciente']; ?></span></p>
  </td>
 
  <td width=126 nowrap valign=bottom style='width:94.55pt;border:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;text-align:center;line-height:normal'><span style='color:black'><?php echo $row1['codigoProcedimento']; ?></span></p>
  </td>

  <td width=310 nowrap valign=bottom style='width:232.55pt;border:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:normal'><span style='color:black'><?php echo $row1['descricaoProcedimento']; ?></span></p>
  </td>

  <td width=129 nowrap valign=bottom style='width:97.1pt;border:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='color:black'><?php echo $row1['medico']; ?></span></p>
  </td>
  <td width=115 nowrap style='width:86.45pt;border:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='color:black'>R$ <?php echo $row1['valorProcedimento']; ?> </span></p>
  </td>
 </tr>
<?php }
    }
?>


 </tr>
 </table>

 </div>
 </body>
 </html>