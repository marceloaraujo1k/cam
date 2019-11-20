<?php
header("Content-type: text/html; charset=utf-8");
require('../../dist/fpdf/mc_table.php');

include '../opendb.php';
include_once('../func.php');




ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);


$start_date = $_GET["start_date"];
$end_date = $_GET["end_date"];

//id = $_GET["id"];
//$querymeidi

$query =  "select * from producao where idmedico='".$_GET["id"]."' AND dataRealizacao BETWEEN '".$start_date."' AND '".$end_date. "' order by convenio, dataRealizacao"; 


$result = mysqli_query($mysql_conn, $query);

$row = mysqli_fetch_assoc($result);
//mysqli_fetch_assoc($result);
//class PDF extends FPDF
$pdf=new PDF_MC_Table();

$pdf->AliasNbPages();
$pdf->AddPage();

{
// Page header{
    // Logo
    $pdf->Image('../../pics/logo.png',10,6,30);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(200,-5,date('d/m/y'),0,0,'R');
	$pdf->Ln(1);
    // Arial bold 15
    $pdf->SetFont('Arial','B',15);
    // Move to the right
   $pdf->Cell(70);
    // Title
	$pdf->Cell(50,10,utf8_decode('Demonstrativo Plano de Saúde'),0,0,'C');

    // Line break
    $pdf->Ln(10);
	


$pdf->SetFont('arial','',10);
$pdf->Cell(0,5,''.utf8_decode("Médico: ").' '.utf8_decode($row["medico"]).'',0,1,'L');
$pdf->Cell(0,5,utf8_decode("Período:").' '.date_format(date_create($start_date), 'd/m/y').utf8_decode(' à ').date_format(date_create($end_date), 'd/m/y') ,0,1,'L');
$pdf->Ln(5);
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



}

// Instanciation of inherited class


//$pdf->Cell(0,5,"","B",1,'C');


$pdf->SetFont('arial','',9);
// Extrai cada linha da tabela dados

// configura a quantidade de colunas a serem impressas esse número deve ser igual a quantidade de celulas

$pdf->SetWidths(array(18,60,20,45,25,15,15));
$result1 = mysqli_query($mysql_conn, $query);

$current_convenio = null;
$total = 0;

while ($row = mysqli_fetch_assoc($result1)) 
		{
			if ($row["convenio"] != $current_convenio) {
			if ($current_convenio != null ){
			$pdf->Cell(198,5,' Total R$ '. number_format($total,2,",",".").'', 1,1,"L");
			}
			$current_convenio = $row["convenio"];
			$total=0;
			
			$pdf->Ln(5);
			$pdf->SetFont('arial','B',9);
			$pdf->Cell(198,5,''.utf8_decode($row["convenio"]).'',1,1,"L");
					
			//cabeçalho da tabela 
			$pdf->SetFont('arial','',9);

			$pdf->Cell(18,10,''.utf8_decode("Data"),1,0,"L");
			$pdf->Cell(60,10,''.utf8_decode("Paciente"),1,0,"L");
			$pdf->Cell(20,10,''.utf8_decode("Cód."),1,0,"L");

			$pdf->Cell(45,10,''.utf8_decode("Procedimento"),1,0,"L");
			
			$pdf->Cell(25,10,''.utf8_decode("Data Repasse"),1,0,"L");
			$pdf->Cell(15,10,''.utf8_decode("Valor"),1,0,"L");
			$pdf->Cell(15,10,''.utf8_decode("Glosa"),1,0,"L");
			//$pdf->Cell(15,10,'Valor',1,0,"L");
			$pdf->Ln(10);
			 $pdf->Row(array(date('d/m/Y', strtotime($row["dataRealizacao"])), utf8_decode($row["paciente"]), utf8_decode($row["codigoProcedimento"]), utf8_decode($row["descricaoProcedimento"]), date('d/m/Y', strtotime($row["dataRepasse"])), number_format($row["valorRecebido"],2,",","."),number_format($row["glosa"],2,",",".")  ));	
			 $total=$total+$row["valorRecebido"];
			}
			else
			{	
				  $pdf->SetFont('arial','',9);
				 $pdf->Row(array(date('d/m/Y', strtotime($row["dataRealizacao"])), utf8_decode($row["paciente"]), utf8_decode($row["codigoProcedimento"]), utf8_decode($row["descricaoProcedimento"]), date('d/m/Y', strtotime($row["dataRepasse"])), number_format($row["valorRecebido"],2,",","."),number_format($row["glosa"],2,",",".")  ));	
			  $total=$total+$row["valorRecebido"];
			}
		
		}	
			if ($current_convenio != null ){
			$pdf->Cell(198,5,' Total R$ '. number_format($total,2,",",".").'', 1,1,"L");	
			}		
$pdf->Output();
?>