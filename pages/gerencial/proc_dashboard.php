<?php

session_start();
include '../opendb.php';
include_once('../func.php');

$conn = $mysql_conn;

//Receber a requisão da pesquisa 
$requestData= $_REQUEST;

//Periodo 

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


$query1 = "SELECT count(producao.idproducao) as totalProcedimentos, producao.idconvenio, producao.medico,  sum(producao.valorProcedimento), 
		format(SUM(valorRecebido),2,'de_DE') as totalValorRcebido, convenio.pis, convenio.cofins, convenio.csll,
		 convenio.irpj, convenio.iss, convenio.outros_encargos, convenio.classificacao, convenio.idconvenio FROM producao inner join convenio 
		on producao.idconvenio = convenio.idconvenio  where  producao.idmedico='".$idmedico."'  AND
		producao.".$dataOpcao."  BETWEEN '".$start_date."' AND '".$end_date. "';";

// CONSULTA CLASSFICADO POR CONVENIO, MEDICO E POR UM PERIODO DE TEMPO			
$query2 =  "SELECT producao.idconvenio, producao.medico,  sum(producao.valorProcedimento) , 
	sum(producao.valorRecebido) as total, convenio.pis, convenio.cofins, convenio.csll, 
	convenio.irpj, convenio.iss, convenio.outros_encargos, convenio.classificacao, convenio.idconvenio FROM producao inner join convenio 
	on producao.idconvenio = convenio.idconvenio  where  producao.idmedico='".$idmedico."' AND
	producao.".$dataOpcao."  BETWEEN '".$start_date."' AND '".$end_date. "' group by convenio.classificacao;"; 



$result2 = mysqli_query($mysql_conn, $query2);
$totalPlanoSaude = 0;
$totalSUS = 0;
$totalEletivas = 0;
$totalParticular = 0;
$totalImpostosPlanoSaude = 0;
$totalImpostosSUS = 0;
$totalImpostosEletivas = 0;
$totalImpostosParticular = 0;

 
while ($row2 = mysqli_fetch_assoc($result2)) 
	{
		
		switch($row2["classificacao"]){
			case 'PLANO DE SAÚDE':
			$totalPlanoSaude =$row2["total"];
            $totalImpostosPlanoSaude = ($row2["pis"]+$row2["cofins"]+$row2["csll"]+$row2["irpj"]+$row2["iss"]+$row2["outros_encargos"]);
			break;
			
			case 'SUS':
			$totalSUS =$row2["total"];
			$totalImpostosSUS = ($row2["pis"]+$row2["cofins"]+$row2["csll"]+$row2["irpj"]+$row2["iss"]+$row2["outros_encargos"]);
			break;
		
			case 'ELETIVAS':
			$totalEletivas =$row2["total"];
			$totalImpostosEletivas = ($row2["pis"]+$row2["cofins"]+$row2["csll"]+$row2["irpj"]+$row2["iss"]+$row2["outros_encargos"]);
			break;
			
			case 'PARTICULAR':
			$totalParticular =$row2["total"];
			$totalImpostosParticular = ($row2["pis"]+$row2["cofins"]+$row2["csll"]+$row2["irpj"]+$row2["iss"]+$row2["outros_encargos"]);
			break;
        }
        	
}


//Zerar variaveis
$totalPacientes=0;
$totalAgendamentos=0;

$totalProntuarios=0;
$totalFaturamento=0;
$totalFaturamentoDia=0;
$totalDespesas=0; 

$resultado_user =mysqli_query($conn, $query1);
$qnt_linhas = mysqli_num_rows($resultado_user);


// Ler e criar o array de dados
$dados = array();
while( $row_usuarios =mysqli_fetch_array($resultado_user) ) {  
	$dado = array(); 
	$dado[] = utf8_decode($row_usuarios["totalValorRcebido"]);
	$dado[] = $row_usuarios["totalProcedimentos"];
	$dados[] = $dado;
}

$totalBruto = $totalPlanoSaude+$totalSUS+$totalEletivas+$totalParticular;
$totalImpostosPlanoSaude = ($totalPlanoSaude*($totalImpostosPlanoSaude/100));
$totalImpostosSUS = ($totalSUS*($totalImpostosSUS/100));
$totalImpostosEletivas = ($totalEletivas*($totalImpostosEletivas/100));
$totalImpostosParitcular = ($totalParticular*($totalImpostosParticular/100));

$totalImpostos = $totalImpostosPlanoSaude+$totalImpostosSUS+$totalImpostosEletivas+$totalImpostosParticular;
$totalLiquido = $totalBruto - $totalImpostosPlanoSaude - $totalImpostosSUS - $totalImpostosEletivas - $totalImpostosParitcular;


//Cria o array de informações a serem retornadas para o Javascript
$json_data = array(
	"draw" => intval( 1 ),//para cada requisição é enviado um número como parâmetro
	"recordsTotal" => intval( $qnt_linhas ),  //Quantidade de registros que há no banco de dados
	"recordsFiltered" => intval( $qnt_linhas ), //Total de registros quando houver pesquisa
	"totalBruto" => number_format($totalBruto,2,",","."),
	"totalImpostos" => number_format($totalImpostos,2,",","."),
	"totalLiquido" => number_format($totalLiquido,2,",","."),
	"totalPlanoSaude" =>  number_format($totalPlanoSaude,2,",","."),
	"totalSUS" => number_format($totalSUS,2,",","."),
	"totalEletivas" => number_format($totalEletivas,2,",","."),
	"totalParticular" => number_format($totalParticular,2,",","."),

	"data" => $dados   //Array de dados completo dos dados retornados da tabela 
);

echo json_encode($json_data);  //enviar dados como formato json



?>








           