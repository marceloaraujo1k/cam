<?php
include '../opendb.php';
include_once('../func.php');

$id = $_GET["id"];

$dados = array();

$query = mysqli_query($mysql_conn, "SELECT * FROM plantoes WHERE idplantao ='$id'");
$form = mysqli_fetch_assoc($query);

	$dado[]=$form["idplantao"];
	$dado[]=$form["idmedico"];
	$dado[]=$form["idConfiguracaoPlantao"];
	$dado[]=$form["horasPlantao"];
	$dado[]=$form["idsubstituto"];
	$dado[]=$form["idConfiguracaoSubstituicaoPlantao"];
	$dado[]=$form["horasSubstituicaoPlantao"];
	$dado[]=$form["idhospital"];
	$dado[]=$form["dataInicio"];
	$dado[]=$form["dataFim"];
	$dado[]=$form["dataRepassePlantao"];
	$dado[]=$form["dataPagamentoPlantao"];
	$dado[]=$form["statusPagamento"];
	$dado[]=$form["cor"];
	
	
$dados[] = $dado;

		
$json_data = array(
	"draw" => intval(1),//para cada requisição é enviado um número como parâmetro
	"recordsTotal" => intval(count($dados)),  //Quantidade de registros que há no banco de dados
	"recordsFiltered" => intval(count($dados)), //Total de registros quando houver pesquisa
	"data" => $dados   //Array de dados completo dos dados retornados da tabela 
);

echo json_encode($dados); 

?>	

