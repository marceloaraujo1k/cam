<?php

//session_start();
include '../opendb.php';
include_once('../func.php');

$conn = $mysql_conn;

$columns = array( 
	0 =>'idproducao', 
	1 =>'dataRealizacao', 
	2 => 'paciente',
	3 => 'carteiraPaciente',
	4 => 'medico',
	5 => 'convenio',
	6 => 'hospital',
	7 => 'codigoProcedimento',
	8 => 'descricaoProcedimento',
	9 => 'quantidade',
	10 => 'adicional',
	11 => 'redutor',
	12 => 'valoRecebido',
	13 => 'dataCobranca',
	14 => 'protocoloEnvio',
	15 => 'notaFiscal',
	16 => 'observacao'
);

$query = "SELECT * FROM producao WHERE ";


if($_POST["is_date_search"] == "yes")
{
				switch ($_POST["filterData"]) {
						case '0':
							 $query .= 'dataRealizacao BETWEEN "'.$_POST["start_date"].'" AND "'.$_POST["end_date"].'" AND ';
						break;
						case '1':
							 $query .= 'dataCobranca BETWEEN "'.$_POST["start_date"].'" AND "'.$_POST["end_date"].'" AND ';

						break;
						default:
				}
}

if(isset($_POST["search"]["value"]))
{
 $query .= '
  (idproducao LIKE "%'.$_POST["search"]["value"].'%" 
  OR dataRealizacao LIKE "%'.$_POST["search"]["value"].'%" 
  OR paciente LIKE "%'.$_POST["search"]["value"].'%" 
  OR carteiraPaciente LIKE "%'.$_POST["search"]["value"].'%" 
  OR medico LIKE "%'.$_POST["search"]["value"].'%" 
  OR convenio LIKE "%'.$_POST["search"]["value"].'%" 
  OR hospital LIKE "%'.$_POST["search"]["value"].'%"
  OR notaFiscal LIKE "%'.$_POST["search"]["value"].'%" 
  OR descricaoProcedimento LIKE "%'.$_POST["search"]["value"].'%"    
  OR observacao LIKE "%'.$_POST["search"]["value"].'%")';
	}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
';
}
else
{
 $query .= 'ORDER BY idproducao DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($conn, $query));

$result = mysqli_query($conn, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
	$sub_array[] = $row["idproducao"];
	$sub_array[] = date('d/m/Y', strtotime($row["dataRealizacao"]));
	$sub_array[] = $row["paciente"];
	$sub_array[] = $row["carteiraPaciente"];
	$sub_array[] = $row["medico"];
	$sub_array[] = $row["convenio"];
	$sub_array[] = $row["hospital"];
	$sub_array[] = $row["codigoProcedimento"];
	$sub_array[] = $row["descricaoProcedimento"];
	$sub_array[] = $row["quantidade"];
	$sub_array[] = $row["adicional"];
	$sub_array[] = $row["redutor"];
	$sub_array[] = number_format($row["valorProcedimento"],2,",",".");
	$sub_array[] = date('d/m/Y', strtotime($row["dataCobranca"])); 
	$sub_array[] = null;
	$sub_array[] = date('d/m/Y', strtotime($row["dataPrevisaoPagamento"]));  
	$sub_array[] = date('d/m/Y', strtotime($row["dataPagamento"]));  
	$sub_array[] = date('d/m/Y', strtotime($row["dataRepasse"]));   
	$sub_array[] = number_format($row["valorRecebido"],2,",",".");
	$sub_array[] = number_format($row["glosa"],2,",",".");
	$sub_array[] = number_format($row["saldo"],2,",",".");
	$sub_array[] = $row["statusPagamento"];	
	$sub_array[] = $row["notaFiscal"];	
	$sub_array[] = $row["observacao"];
	$sub_array [] = '<button type="button" id="btnEditar" class="btn btn btn-primary" data-id="'.$row["idproducao"].'"><i class="glyphicon glyphicon-pencil">&nbsp;</i>Editar</button>';
	$sub_array [] = '<button type="button" id="btnExcluir" class="btn btn btn-primary" data-id="'.$row["idproducao"].'"><i class="glyphicon glyphicon-trash  ">&nbsp;</i>Excluir</button>';

 $data[] = $sub_array;
}

function get_all_data($conn)
{
 $query = "SELECT idproducao, dataRealizacao, paciente, carteiraPaciente, medico, convenio, hospital, notaFiscal, descricaoProcedimento, adicional, redutor, observacao FROM producao";
 $result = mysqli_query($conn, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($conn),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>
