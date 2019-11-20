<?php
include '../opendb.php';
include_once('../func.php');

$id = $_GET["id"];

$dados = array();
							
$query = mysqli_query($mysql_conn, "SELECT * FROM producao WHERE idproducao ='$id'");
$form = mysqli_fetch_assoc($query);

	$dado[]=$form["idproducao"];
	$dado[]=$form["paciente"];
	$dado[]=$form["valor"];
	$dado[]=$form["valorRecebido"];
	$dado[]=$form["glosa"];
	$dado[]=$form["saldo"];
	$dado[]=$form["descricao"];
	$dado[]= $form["idconsultas"];
	$idconsultas = $form["idconsultas"];
	
$json_data = array(
	"draw" => intval(1),//para cada requisição é enviado um número como parâmetro
	"recordsTotal" => intval(count($dados)),  //Quantidade de registros que há no banco de dados
	"recordsFiltered" => intval(count($dados)), //Total de registros quando houver pesquisa
	"data" => $dados   //Array de dados completo dos dados retornados da tabela 
);

echo json_encode($dados); 

?>	

