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
			
$pdf->SetFont('arial','',9);

$pdf->Cell(10,5,''.utf8_encode("CRM"),1,0,"L");
$pdf->Cell(70,5,''.("NOME"),1,0,"C");
$pdf->Cell(40,5,''.("CARGO"),1,0,"C");

for ($i=1; $i<=31;$i++) {
	$pdf->Cell(5,5,$i,1,0,"C");
}

$pdf->ln();


		setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
		date_default_timezone_set('America/Sao_Paulo');
			
            if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
			$pdf->Cell(10,8,$row['crm'],1,0);
			$pdf->Cell(70,8,($row['nome']),1,0);
			$pdf->Cell(40,8,($row['especialidade']),1,0);
			for ($i=1; $i<=30;$i++) {

			if(substr($row['dataInicio'], 8, -9) == $i){
					$pdf->Cell(5,8,$row['legendaPlantao'],1,0);
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
		
		$pdf->SetY(145);
		// Arial italic 8
		$pdf->SetFont('Arial','I',7);
		$pdf->Cell(40,5,utf8_decode('LEGENDA'),1,0);
		$pdf->Cell(45,5,utf8_decode('HORÁRIO'),1,1);
		$pdf->Cell(40,5,utf8_decode('D = Diurno'),1,0);
		$pdf->Cell(45,5,utf8_decode('07:00 às 19:00 horas'),1,1);
		$pdf->Cell(40,5,utf8_decode('N = Noturno'),1,0);
		$pdf->Cell(45,5,utf8_decode('19:00 às 07:00 horas'),1,1);
		$pdf->Cell(40,5,utf8_decode('P = Plantão'),1,0);
		$pdf->Cell(45,5,utf8_decode('24 horas'),1,1);
		$pdf->Cell(40,5,utf8_decode('M = Manha'),1,0);
		$pdf->Cell(45,5,utf8_decode('07:00 às 13:00 horas'),1,1);
		$pdf->Cell(40,5,utf8_decode('T = Tarde'),1,0);
		$pdf->Cell(45,5,utf8_decode('13:00 às 19:00 horas'),1,0);
		$pdf->Cell(100,5,utf8_decode('___________________________________'),0,0,'R');
		$pdf->Cell(90,5,utf8_decode('___________________________________'),0,1,'R');
		$pdf->Cell(40,5,utf8_decode('T/N = Tarde e Noite'),1,0);
		$pdf->Cell(45,5,utf8_decode('13:00 às 07:00 horas'),1,0);
		$pdf->Cell(100,5,utf8_decode('  Diretor Técnico da CAM             '),0,0,'R');
		$pdf->Cell(90,5,utf8_decode('     Diretor Geral                  '),0,1,'R');
		$pdf->Cell(40,5,utf8_decode('M/N = Manha e Noite'),1,0);
		$pdf->Cell(45,5,utf8_decode('07:00 às 13:00 horas e 19:00 às 07:00'),1,0);
		$pdf->Cell(100,5,utf8_decode('      Ronaldo Fixina Barreto             '),0,1,'R');


	}
}
	$pdf->Output();
?>
