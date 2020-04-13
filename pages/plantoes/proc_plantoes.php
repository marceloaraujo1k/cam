<?php

session_start();
include '../opendb.php';
include_once('../func.php');


$idhospital = $_POST['id'];
$mesAnoPlantao = $_POST['mesAnoPlantao'];

$conn = $mysql_conn;

//Receber a requisão da pesquisa 
$requestData= $_REQUEST;

//Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
$columns = array( 
	0 => 'idplantao', 
	1 => 'dataInicio',
	2 => 'dataFim',
	3 => 'idmedico',
	4 => 'idConfiguracaoPlantao',
	5 => 'statusPagamento'
);

//Obtendo registros de número total sem qualquer pesquisa
$result_user = "SELECT p.idhospital, p.idplantao, p.dataInicio, p.dataFim, p.idmedico, p.idConfiguracaoPlantao, p.horasPlantao,
p.idsubstituto, p.horasSubstituicaoPlantao, p.statusPagamento, c.idConfiguracaoPlantao, c.descricaoPlantao, p.valorPlantaoBruto,
p.valorPlantaoLiquido, p.valorSubstituicaoPlantaoBruto, p.valorSubstituicaoPlantaoLiquido, p.dataRepassePlantao, p.dataPagamentoPlantao, m.idmedico, m.nome, (SELECT nome FROM medicos subm where subm.idmedico = p.idsubstituto) as substituto FROM plantoes AS p, 
configuracaoplantoes AS c, medicos AS m WHERE  p.idConfiguracaoPlantao = c.idConfiguracaoPlantao AND p.idmedico = m.idmedico and p.idhospital = '$idhospital' and DATE_FORMAT(p.dataInicio, '%Y-%m') = '$mesAnoPlantao'";

$resultado_user =mysqli_query($conn, $result_user);
$qnt_linhas = mysqli_num_rows($resultado_user);


//Obter os dados a serem apresentados
$result_usuarios = "SELECT p.idhospital, p.idplantao, p.dataInicio, p.dataFim, p.idmedico, p.idConfiguracaoPlantao, p.horasPlantao,
p.idsubstituto, p.horasSubstituicaoPlantao, p.statusPagamento, c.idConfiguracaoPlantao, c.descricaoPlantao, p.valorPlantaoBruto,
p.valorPlantaoLiquido, p.valorSubstituicaoPlantaoBruto, p.valorSubstituicaoPlantaoLiquido, p.dataRepassePlantao, p.dataPagamentoPlantao, m.idmedico, m.nome, (SELECT nome FROM medicos subm where subm.idmedico = p.idsubstituto) as substituto FROM plantoes AS p, 
configuracaoplantoes AS c, medicos AS m WHERE  p.idConfiguracaoPlantao = c.idConfiguracaoPlantao AND p.idmedico = m.idmedico AND p.idhospital = '$idhospital' AND  DATE_FORMAT(p.dataInicio, '%Y-%m') = '$mesAnoPlantao' AND 1=1";

if( !empty($requestData['search']['value']) ) {   // se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
	$result_usuarios.=" AND ( idplantao LIKE '".$requestData['search']['value']."%' ";  
	$result_usuarios.=" OR p.idConfiguracaoPlantao LIKE '".$requestData['search']['value']."%') ";
//	$result_usuarios.=" OR idmedico LIKE '".$requestData['search']['value']."%' )";

	}

$resultado_usuarios=mysqli_query($conn, $result_usuarios);
$totalFiltered = mysqli_num_rows($resultado_usuarios);

//Ordenar o resultado
$result_usuarios.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
$resultado_usuarios=mysqli_query($conn, $result_usuarios);

// Ler e criar o array de dados
$dados = array();
while( $row =mysqli_fetch_array($resultado_usuarios) ) {  
	$dado = array(); 
	
	$dado[] =  $row["idplantao"];
	$dtInicio =  date('d/m/Y H:i', strtotime($row["dataInicio"]));
	$dado[] =  $dtInicio;
  	$dtFim =  date('d/m/Y H:i', strtotime($row["dataFim"]));
	$dado[] =  $dtFim;
	$dado[] =  $row["nome"];
	$dado[] =  $row["descricaoPlantao"];
	$dado[] =  $row["horasPlantao"];
	$dado[] =  number_format($row["valorPlantaoBruto"],2,",",".");
	$dado[] =  number_format($row["valorPlantaoLiquido"],2,",",".");
	$dado[] =  utf8_encode($row["substituto"]);
	$dado[] =  $row["horasSubstituicaoPlantao"];
	$dado[] =  number_format($row["valorSubstituicaoPlantaoBruto"],2,",",".");
	$dado[] =  number_format($row["valorSubstituicaoPlantaoLiquido"],2,",",".");
	$dado[] =  date('d/m/Y', strtotime($row["dataPagamentoPlantao"])); 
	$dado[] =  date('d/m/Y', strtotime($row["dataRepassePlantao"]));
	$dado[] =  utf8_encode($row["statusPagamento"]);	
	$dado [] = '<button type="button" id="btnEditar" class="btn btn btn-primary" data-id="'.$row["idplantao"].'"><i class="glyphicon glyphicon-pencil">&nbsp;</i>Editar</button>';
	$dado [] = '<button type="button" id="btnExcluir" class="btn btn btn-primary" data-id="'.$row["idplantao"].'"><i class="glyphicon glyphicon-trash  ">&nbsp;</i>Excluir</button>';
	$dados[] = $dado;
}


//Cria o array de informações a serem retornadas para o Javascript
$json_data = array(
	"draw" => intval( $requestData['draw'] ),//para cada requisição é enviado um número como parâmetro
	"recordsTotal" => intval( $qnt_linhas ),  //Quantidade de registros que há no banco de dados
	"recordsFiltered" => intval( $totalFiltered ), //Total de registros quando houver pesquisa
	"data" => $dados   //Array de dados completo dos dados retornados da tabela 
);

echo json_encode($json_data);  //enviar dados como formato json

?>
