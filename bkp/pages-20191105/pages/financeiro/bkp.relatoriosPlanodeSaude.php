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


$query =  "SELECT * FROM producao inner join convenio on producao.idconvenio = convenio.idconvenio where idmedico='".$_GET["id"]."' AND dataRealizacao BETWEEN '".$start_date."' AND '".$end_date. "' order by convenio, dataRealizacao"; 


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
	$pdf->Cell(195,-5,'Data: '.date('d/m/y'),0,0,'R');
	$pdf->Ln(1);
    // Arial bold 15
    $pdf->SetFont('Arial','B',15);
    // Move to the right
   $pdf->Cell(70);
    // Title
	$pdf->Cell(50,10,utf8_decode('Detalhamento Produção Médica'),0,0,'C');

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
$pdf->SetFont('arial','',9);

// Extrai cada linha da tabela dados
// configura a quantidade de colunas a serem impressas esse número deve ser igual a quantidade de celulas

$pdf->SetWidths(array(18,60,20,45,25,15,15));
$result1 = mysqli_query($mysql_conn, $query);

$current_convenio = null;
global $row;

while ($row = mysqli_fetch_assoc($result1)) 
		{
			if ($row["idconvenio"] != $current_convenio) {
			if ($current_convenio != null ){
				$pdf->Cell(50,10,'Valor Total: R$ '. number_format($totalProcedimento,2,",",".").'',"L",0,"L");
				$pdf->Cell(49,10,'Valor Glosa: R$ '. number_format($totalGlosa,2,",",".").'',"",0,"L");
				$pdf->Cell(49,10,'Valor Bruto: R$ '. number_format($total,2,",",".").'',"",0,"L");
				$pdf->Cell(50,10,utf8_decode('Valor Líquido: R$ '). number_format($totalBruto-($totalBruto*$totalImpostos),2,",",".").'',"R",1,"L");
				
				$pdf->Cell(30,10,'PIS R$: '. number_format($totalBruto*$pis,2,",",".").'',"LB",0,"L");
				$pdf->Cell(36,10,'COFINS R$: '. number_format($totalBruto*$cofins,2,",",".").'',"B",0,"L");
				$pdf->Cell(30,10,'CSLL R$: '. number_format($totalBruto*$csll,2,",",".").'',"B",0,"L");
				$pdf->Cell(30,10,'IRPJ R$: '. number_format($totalBruto*$irpj,2,",",".").'',"B",0,"L");
				$pdf->Cell(30,10,'ISS R$: '. number_format($totalBruto*$iss,2,",",".").'',"B",0,"L");
				$pdf->Cell(42,10,'Tx./Encargos R$: '. number_format($totalBruto*$outros_encargos,2,",",".").'',"BR",1,"L");
			}
			$current_convenio = $row["idconvenio"];
			
			$total=0;
			$totalProcedimento = 0;
			$totalGlosa = 0;
			$totalBruto = 0;
			$totalValorLiquido = 0;
		
			
			$pdf->Ln(5);
			$pdf->SetFont('arial','B',9);
			$pdf->Cell(198,5,''.utf8_decode($row["convenio"]).'',1,1,"L");
			
			
			// Declaração dos percentuais dos impostos
			$pis = $row["pis"]/100;
			$cofins = $row["cofins"]/100;
			$csll = $row["csll"]/100;
			$irpj = $row["irpj"]/100;
			$iss = $row["iss"]/100;
			$outros_encargos = $row["outros_encargos"]/100;
			$totalImpostos = $pis+$cofins+$csll+$irpj+$iss+$outros_encargos;
			
		
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
			 $totalProcedimento=$totalProcedimento+$row["valorProcedimento"];
			 $totalGlosa=$totalGlosa+$row["glosa"];
			 $totalBruto = $totalProcedimento-$totalGlosa;
			 $total=$total+$row["valorRecebido"];
		
			}
			else
			{	
				$pdf->SetFont('arial','',9);
				$pdf->Row(array(date('d/m/Y', strtotime($row["dataRealizacao"])), utf8_decode($row["paciente"]), utf8_decode($row["codigoProcedimento"]), utf8_decode($row["descricaoProcedimento"]), date('d/m/Y', strtotime($row["dataRepasse"])), number_format($row["valorRecebido"],2,",","."),number_format($row["glosa"],2,",",".")  ));	
				$totalProcedimento=$totalProcedimento+$row["valorProcedimento"];
				$totalGlosa=$totalGlosa+$row["glosa"];
				$totalBruto = $totalProcedimento-$totalGlosa;
				$total=$total+$row["valorRecebido"];
				
				
				}
			}
			if ($current_convenio != null){
				$pdf->Cell(50,10,'Valor Total: R$ '. number_format($totalProcedimento,2,",",".").'',"L",0,"L");
				$pdf->Cell(49,10,'Valor Glosa: R$ '. number_format($totalGlosa,2,",",".").'',"",0,"L");
				$pdf->Cell(49,10,'Valor Bruto: R$ '. number_format($total,2,",",".").'',"",0,"L");
				$pdf->Cell(50,10,utf8_decode('Valor Líquido: R$ '). number_format($totalBruto-($totalBruto*$totalImpostos),2,",",".").'',"R",1,"L");
					
				$pdf->Cell(30,10,'PIS R$: '. number_format($totalBruto*$pis,2,",",".").'',"LB",0,"L");
				$pdf->Cell(36,10,'COFINS R$: '. number_format($totalBruto*$cofins,2,",",".").'',"B",0,"L");
				$pdf->Cell(30,10,'CSLL R$: '. number_format($totalBruto*$csll,2,",",".").'',"B",0,"L");
				$pdf->Cell(30,10,'IRPJ R$: '. number_format($totalBruto*$irpj,2,",",".").'',"B",0,"L");
				$pdf->Cell(30,10,'ISS R$: '. number_format($totalBruto*$iss,2,",",".").'',"B",0,"L");
				$pdf->Cell(42,10,'Tx./Encargos R$: '. number_format($totalBruto*$outros_encargos,2,",",".").'',"BR",1,"L");
			}
			
	$pdf->Output();
?>		
