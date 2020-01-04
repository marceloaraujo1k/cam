<?php
header("Content-type: text/html; charset=utf-8");
require('../../dist/fpdf/mc_table.php');

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

  $query = "SELECT producao.idconvenio, producao.idmedico, producao.medico,  sum(producao.valorProcedimento) as totalCobrado , 
 			 sum(producao.valorRecebido) as totalRecebido, convenio.pis, convenio.cofins, convenio.csll, convenio.irpj, convenio.iss, convenio.outros_encargos, convenio.classificacao, convenio.idconvenio, convenio.descricao FROM producao inner join convenio 
		  on producao.idconvenio = convenio.idconvenio where convenio.classificacao='PLANO DE SAÚDE' AND  producao.dataPagamento  BETWEEN '2019-01-01' AND '2019-01-31' group by convenio.idconvenio, producao.medico;";
}
else {
  $query =  "SELECT producao.idconvenio,  producao.idmedico, producao.medico,  sum(producao.valorProcedimento) as totalCobrado, 
  sum(producao.valorRecebido) as totalRecebido, convenio.pis, convenio.cofins, convenio.csll, convenio.irpj, convenio.iss, convenio.outros_encargos, convenio.classificacao, convenio.idconvenio, convenio.descricao FROM producao inner join convenio 
  on producao.idconvenio = convenio.idconvenio where convenio.classificacao='PLANO DE SAÚDE' AND  producao.dataPagamento  BETWEEN '2019-01-01' AND '2019-01-31' group by convenio.idconvenio, producao.medico;";
}

$result = mysqli_query($mysql_conn, $query);
$mesFatura = $start_date;

$query1 = "SELECT * from convenio where convenio.classificacao='PLANO DE SAÚDE';";
$result1 = mysqli_query($mysql_conn, $query1);

//$pdf=new P('L','mm',);
$pdf=new PDF_MC_Table();

$pdf->AliasNbPages();
$pdf->AddPage("P");

{
// Page header{
    // Arial bold 15
    $pdf->SetFont('Arial','B',8);
	// Move to the right   
	$pdf->SetFillColor(166,166,166);
	$pdf->SetTextColor(255,255,255);
	$pdf->Cell(140,5,utf8_decode('RELATÓRIO GERENCIAL DE REALIZAÇÃO DE PROCEDIMENTOS PLANO DE SAÚDE'),1,1,'C',true);
	$pdf->Cell(30,5,utf8_decode("PERÍODO:"),1,0,'C',true);
	setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
	date_default_timezone_set('America/Sao_Paulo');
	$pdf->SetFillColor(255,255,0);
	$pdf->SetTextColor(0,0,0);

	$pdf->Cell(30,5,strftime('%B %Y', strtotime($mesFatura)),1,1,'C',true);
	
	$pdf->SetFillColor(0,176,240);
	$pdf->SetTextColor(255,255,255);
	$pdf->ln();


//	$pdf->Cell(50,5,utf8_decode('PLANO DE SAÚDE'),'LRT',0,'C',true);
//	$pdf->SetFillColor(166,166,166);
	//$pdf->Cell(50,5,utf8_decode('NORDCLINICAS'),'LRTB',0,'C',true);

	while ($row1=mysqli_fetch_assoc($result1)) { 
//		$pdf->Cell(50,5,utf8_decode($row1["descricao"]),'LRTB',0,'C',true);
	}
	
	//$pdf->Cell(50,5,'','LRTB',1,'C',true);

	$pdf->ln();
	$pdf->SetTextColor(0,0,0);

/*	while($row= mysqli_fetch_assoc($result)){
		$pdf->SetX(2);	
	//	while ($row1=mysqli_fetch_assoc($result1)) {
///		$convenio=$row1["idconvenio"];
		$convenio=1;
		$pdf->Cell(50,5,utf8_decode('NEI NOGUEIRA'),'LRTB',0,'C',true);
		if ($row["idmedico"]==21 and $row["idconvenio"]==$convenio) {
				$pdf->Cell(30,5,$row["totalCobrado"],0,0,'C');
			}
		if ($row["idmedico"]==21 and $row["idconvenio"]==$convenio) {
			$pdf->Cell(50,5,'teste',0,0,'C');
		}
		if ($row["idmedico"]==21 and $row["idconvenio"]==$convenio) {
		$pdf->Cell(50,5,$row["totalCobrado"],0,1,'C');
		}
		else {
			$pdf->ln();
		}

		$pdf->Cell(50,5,utf8_decode('EDILSON SILVA'),'LRTB',0,'C',true);
		
		if ($row["idmedico"]==21 and $row["idconvenio"]==$convenio) {
				$pdf->Cell(30,5,$row["totalCobrado"],0,0,'C',true);
			}
		if ($row["idmedico"]==21 and $row["idconvenio"]==$convenio) {
			$pdf->Cell(50,5,'teste',1,'C',true);
		}
		if ($row["idmedico"]==21 and $row["idconvenio"]==$convenio) {
		$pdf->Cell(50,5,$row["totalCobrado"],1,'C',true);
		}
	//}
} */

	//$pdf->Cell(50,5,utf8_decode('TOTAL'),'LRB',1,'C',true);
	
	$pdf->SetFillColor(242,242,242);
	$pdf->SetFillColor(255,255,0);
    // Line break
    $pdf->Ln(10);
	$pdf->SetFont('Arial','',8);
	$pdf->SetTextColor(0,0,0);


// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Página '.$this->PageNo().'/{nb}',0,0,'C');
}



$pdf->SetWidths(array(70,50,30,30));
	$pdf->Cell(70,5,''.utf8_decode("PLANO DE SAÚDE"),1,0,"L");
	$pdf->Cell(50,5,''.utf8_decode("MÉDICO"),1,0,"L");
	$pdf->Cell(30,5,''.utf8_decode("TOTAL COBRADO"),1,0,"L");
	$pdf->Cell(30,5,''.utf8_decode("TOTAL PAGO"),1,1,"L");
if(mysqli_num_rows($result) > 0){
    while($row= mysqli_fetch_assoc($result)){
	
		$pdf->Row(array(utf8_decode($row["descricao"]), utf8_decode($row["medico"]), number_format($row["totalCobrado"],2,",","."), number_format($row["totalRecebido"],2,",",".")));
		}
	 }

	
	}

	 $pdf->Output();
?>