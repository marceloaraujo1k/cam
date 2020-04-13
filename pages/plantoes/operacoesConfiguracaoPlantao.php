<?php
include '../opendb.php';
include_once('../func.php');

$id = $_POST["id"];
$dados = array();
$n = 0;
$query = mysqli_query($mysql_conn, "SELECT * FROM configuracaoplantoes WHERE idhospital ='$id'");

$dados['qtd'] =  mysqli_num_rows($query);
while( $form =mysqli_fetch_array($query) ) {  
	$dados['id'][$n]=$form["idConfiguracaoPlantao"];
	$dados['descricao'][$n]=$form["descricaoPlantao"];	
	$n++;
}

$json_data = array(
	"draw" => intval(1),//para cada requisição é enviado um número como parâmetro
	"recordsTotal" => intval(count($dados)),  //Quantidade de registros que há no banco de dados
	"recordsFiltered" => intval(count($dados)), //Total de registros quando houver pesquisa
	"data" => $dados   //Array de dados completo dos dados retornados da tabela 
);

die(json_encode($dados)); 

?>	

