<?php 

session_start();
include '../opendb.php';
include_once('../func.php');


$conn = $mysql_conn;

//Receber a requisão da pesquisa 
$requestData= $_REQUEST;

$start_date = $_POST["start_date"];
$end_date = $_POST["end_date"];
$idmedico = $_POST["filterMedico"];

// Essa variavel define o tipo de filtro de data  "0"=Data de Realização  | "1=Data de Cobrança  | "2"=Data de Pagamento | "3"=Data de Repasse
$filtroDataTipo = $_POST["filterData"];

$dataOpcao = null;

switch ($filtroDataTipo) {
	case '0':
		$dataOpcao = "dataRealizacao";
		break;
	
	case '1':
		$dataOpcao = "dataCobranca";
		break;

	case '2':
		$dataOpcao = "dataPagamento";
			break;
	
	case '3':
		$dataOpcao = "dataRepasse";
		break;	
}
	



//Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
$columns = array( 
	0 =>'idproducao', 
	1 => 'notaFiscal',
	2 => 'convenio',
	3 => 'paciente',
	4 => 'codProcedimento',
	5 => 'descricaoProcedimento',
	6 => 'statusPagamento',
	7 => 'dataRepasse',
	8 => 'valoRecebido');

//Obtendo registros de número total sem qualquer pesquisa
$result_user = "SELECT * FROM producao  where idmedico='".$idmedico."' AND ".$dataOpcao."   
BETWEEN '".$start_date."' AND '".$end_date. "'";

$resultado_user =mysqli_query($conn, $result_user);

$qnt_linhas = mysqli_num_rows($resultado_user);

//Obter os dados a serem apresentados
$result_usuarios = "SELECT * FROM producao  where idmedico='".$idmedico."' AND ".$dataOpcao."   
BETWEEN '".$start_date."' AND '".$end_date. "'";

if( !empty($requestData['search']['value']) ) {   // se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
	$result_usuarios.=" AND ( idproducao LIKE '".$requestData['search']['value']."%' ";  
	$result_usuarios.=" OR dataRealizacao LIKE '".$requestData['search']['value']."%' ";
	$result_usuarios.=" OR notaFiscal LIKE '%".$requestData['search']['value']."%' ";
	$result_usuarios.=" OR convenio LIKE '%".$requestData['search']['value']."%' ";
	$result_usuarios.=" OR paciente LIKE '%".$requestData['search']['value']."%' ";
	$result_usuarios.=" OR codigoProcedimento LIKE '%".$requestData['search']['value']."%' ";
    $result_usuarios.=" OR descricaoProcedimento LIKE '%".$requestData['search']['value']."%' ";
	$result_usuarios.=" OR statusPagamento LIKE '".$requestData['search']['value']."%' ";
	$result_usuarios.=" OR dataRepasse LIKE '".$requestData['search']['value']."%' ";
	$result_usuarios.=" OR valorRecebido LIKE '".$requestData['search']['value']."%' )";
}

$resultado_usuarios=mysqli_query($conn, $result_usuarios);
$totalFiltered = mysqli_num_rows($resultado_usuarios);

//Ordenar o resultado
$result_usuarios.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']." ";

// das LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

if($requestData["length"] != -1)
{
	$result_usuarios.= 'LIMIT ' . $requestData['start'] . ', ' . $requestData['length']. " ";
}

$resultado_usuarios=mysqli_query($conn, $result_usuarios);

// Ler e criar o array de dados
$dados = array();
while( $row =mysqli_fetch_array($resultado_usuarios) ) {  
	$dado = array(); 
 	$dado[] =  $row["idproducao"];
	$dado[] = date('d/m/Y', strtotime($row["dataRealizacao"]));
	$dado[] =  $row["notaFiscal"];
	$dado[] =  $row["convenio"];
	$dado[] =  $row["paciente"];
	$dado[] =  $row["codigoProcedimento"];
	$dado[] =  $row["descricaoProcedimento"];
	$dado[] =  $row["statusPagamento"];
	//$dado[] = date('d/m/Y', strtotime($row["dataRepasse"]));
	$dado[] =  ((((($row["dataRepasse"])!="0000-00-00 00:00:00")) && (($row["dataRepasse"])!=NULL)) ? date('d/m/Y',strtotime($row["dataRepasse"])) : '');
	$dado [] = number_format($row["valorRecebido"],2,",",".");
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









           