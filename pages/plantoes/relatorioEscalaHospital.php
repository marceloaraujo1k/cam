<?php
header("Content-type: text/html; charset=utf-8");
require('../../dist/fpdf/mc_table.php');

include '../opendb.php';
include_once('../func.php');

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);


//Periodo 
$hospital = $_GET["hospital"];
$start_date = $_GET["start_date"];
$end_date = $_GET["end_date"];
// Essa variavel define o tipo de filtro de data  "0"=Data de Realização  | "1=Data de Cobrança  | "2"=Data de Pagamento | "3"=Data de Repasse
$filtroDataTipo = $_GET["filtroDataTipo"];

$diasemana = array("Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado");


$dataOpcao = null;

switch ($filtroDataTipo) {
	case '0':
    $dataOpcao = "dataInicio";
    break;
	}


$pdf=new PDF_MC_Table();

$pdf->AliasNbPages();
$pdf->AddPage("L");

{


	$sql = "SELECT dataInicio, medicos.nome, medicos.crm, medicos.especialidade, configuracaoplantoes.legendaPlantao, 
	(SELECT hospital FROM hospital subh where subh.idhospital =  configuracaoplantoes.idhospital) as hospital
	 FROM plantoes INNER join medicos on plantoes.idmedico = medicos.idmedico INNER JOIN configuracaoplantoes ON plantoes.idConfiguracaoPlantao = configuracaoplantoes.idConfiguracaoPlantao
	WHERE configuracaoplantoes.idhospital = '$hospital' and plantoes.dataInicio BETWEEN '".$start_date."' AND '".$end_date. "'";
	$result = mysqli_query($mysql_conn, $sql);

	$row = mysqli_fetch_assoc($result);

	setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
	//$base=strtotime(date($start_date,time()) . '-01 00:00:01');
	//$mesFatura = strftime('%B/%Y', strtotime('-1 month', $base));

	$mesFatura = strftime('%B/%Y', strtotime($start_date));

    $pdf->Image('../../pics/logo.png',10,6,30);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(280,-5,utf8_decode('MÊS/ANO: ').strtoupper($mesFatura),0,0,'R');
	$pdf->Ln(1);
    // Arial bold 15
    $pdf->SetFont('Arial','B',10);
    // Move to the right
   $pdf->Cell(40);
	// Title
	$pdf->Cell(100,10,utf8_decode('HOSPITAL ').$row['hospital'],0,0,'L');
	$pdf->Cell(100,10,utf8_decode('ESCALA DE PLANTÕES'),0,0,'L');
   // Line break
$pdf->Ln(10);
$pdf->SetFont('arial','',7);


$query_date = '2020-02-01';

$source_date = strtotime($query_date);
$dat_ini = new DateTime(date('Y-m-01', $source_date));
$dat_fin = new DateTime(date('Y-m-t', $source_date));

$NumeroSemanas = (int)$dat_fin->format('W') - (int)$dat_ini->format('W') + 1;

$diaAtual = $dat_ini->format('d');
$dat_fin = $dat_fin->format('d');

$diaSemanaInicial = $dat_ini->format('w');
$idSemana = 1;
$contadorDiasSemana =0;
$qtdDias = 0;

if ($diaSemanaInicial != 0) {
	$pdf->Cell(20,5,''.utf8_encode("SEMANA ".$idSemana),1,0,"L");
	for ($j=1; $j<$diaSemanaInicial; $j++) {
		$pdf->Cell(38,5,'',1,0,"C");
	}
}
	else {
		$pdf->Cell(20,5,''.utf8_encode("SEMANA ".$idSemana),1,0,"L");
	}

    for ($i=0; $i<$dat_fin; $i++) { 
       $dat_atual = new DateTime(date('d-m-Y', $source_date));
       $dat_atual->modify('+'.$i.' day');  
       $diasemanaAtual =  $dat_atual->format('w');
	     	
	   if ($diasemanaAtual == 1) {
           $pdf->Cell(38,5,$dat_atual->format('d-m-Y').'   '.utf8_decode($diasemana[$diasemanaAtual]),1,0,"C");
	   }

	   if ($diasemanaAtual == 2) {
		$pdf->Cell(38,5,$dat_atual->format('d-m-Y').'   '.utf8_decode($diasemana[$diasemanaAtual]),1,0,"C");
		}
		if ($diasemanaAtual == 3) {
		$pdf->Cell(38,5,$dat_atual->format('d-m-Y').'   '.utf8_decode($diasemana[$diasemanaAtual]),1,0,"C");
		}
		if ($diasemanaAtual == 4) {
			$pdf->Cell(38,5,$dat_atual->format('d-m-Y').'   '.utf8_decode($diasemana[$diasemanaAtual]),1,0,"C");
		}
		if ($diasemanaAtual == 5) {
			$pdf->Cell(38,5,$dat_atual->format('d-m-Y').'   '.utf8_decode($diasemana[$diasemanaAtual]),1,0,"C");
		}
		if ($diasemanaAtual == 6) {
			$pdf->Cell(38,5,$dat_atual->format('d-m-Y').'   '.utf8_decode($diasemana[$diasemanaAtual]),1,0,"C");
		}
		if ($diasemanaAtual == 0) {
				$pdf->Cell(38,5,$dat_atual->format('d-m-Y').'    '.utf8_decode($diasemana[$diasemanaAtual]),1,1,"C");
				$pdf->Cell(20,5,''.utf8_encode("07:00 as 13:00h "),1,0,"L");
				$katual=$dat_atual->format('d');
				for ($k=$katual; $k<=$katual; $k--) {
					$pdf->Cell(38,5, $k.' --- qtdDia'.$qtdDias,1,1,"L");
				}
				$qtdDias=0;
									
				$idSemana = $idSemana+1;
				$pdf->Cell(20,5,''.utf8_encode("SEMANA ".$idSemana),1,0,"L");
		}
		$qtdDias = $qtdDias+1;
	}


$pdf->ln(10);
		setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
		date_default_timezone_set('America/Sao_Paulo');
			
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
				for ($i=1; $i<=30;$i++) {

				if(substr($row['dataInicio'], 8, -9) == $i){
						$pdf->Cell(5,8,$row['nome'],1,0);
					} 
				else {
						$pdf->Cell(5,8,'',1,0);
					}
				}
				if (substr($row['dataInicio'], 8, -9) == 31) {
					$pdf->Cell(5,8,$row['legendaPlantao'],1,1);
				}
				else {
					$pdf->Cell(5,8,'',1,1);
				} 
		
			}			
			
		}
}
	$pdf->Output();
?>