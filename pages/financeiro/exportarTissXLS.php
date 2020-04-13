<?php
/*
* Criando e exportando planilhas do Excel
* /
*/

ini_set('display_errors', false);
include '../opendb.php';
include_once('../func.php');
// Definimos o nome do arquivo que será exportado
$arquivo = 'planilhaTISS'.date(Ymd).'.xls';
// Criamos uma tabela HTML com o formato da planilha

// Exibe a tabela 
$id = $_GET['id']; 
$dataStart = $_GET['start_date'];
$dataEnd = $_GET['end_date'];

$query = mysqli_query($mysql_conn, "SELECT *, P.idproducao, P.dataRealizacao, P.idpaciente, P.paciente,
P.carteiraPaciente,  P.hospital, P.idmedico, P.medico, (SELECT crm  FROM medicos M where M.idmedico = P.idmedico) as crmMedico,
P.codigoProcedimento, P.descricaoProcedimento, P.valorProcedimento, P.quantidade, P.adicional, P.redutor FROM producao as P where  dataCobranca BETWEEN '$dataStart' and '$dataEnd'
and idconvenio = (SELECT idconvenio FROM convenio WHERE DESCRICAO='$id' LIMIT 1)");

// Extrai cada linha da tabela clientes

$dadosXls  = "";
$dadosXls .= "  <table border='1' >";
$dadosXls .= "          <tr>";
$dadosXls .= "<th><b>idproducao</b></th>";
$dadosXls .= "<th><b>dataRealizacao</b></th>";
$dadosXls .= "<th><b>idpaciente</b></th>";
$dadosXls .= "<th><b>idmedico</b></th>";
$dadosXls .= "<th><b>idprocedimentos</b></th>";
$dadosXls .= "<th><b>paciente</b></th>";
$dadosXls .= "<th><b>carteiraPaciente</b></th>";
$dadosXls .= "<th><b>medico</b></th>";
$dadosXls .= "<th><b>convenio</b></th>";
$dadosXls .= "<th><b>hospital</b></th>";
$dadosXls .= "<th><b>codigoProcedimento</b></th>";
$dadosXls .= "<th><b>descricaoProcedimento</b></th>";
//12
$dadosXls .= "<th><b>valorProcedimento</b></th>";
$dadosXls .= "<th><b>quantidade</b></th>";
$dadosXls .= "<th><b>adicional</b></th>";
$dadosXls .= "<th><b>redutor</b></th>";
$dadosXls .= "<th><b>valorRecebido</b></th>";
$dadosXls .= "<th><b>glosa</b></th>";
$dadosXls .= "<th><b>saldo</b></th>";
//19
$dadosXls .= "<th><b>dataPagamento</b></th>";
$dadosXls .= "<th><b>dataCobranca</b></th>";
$dadosXls .= "<th><b>dataRepasse</b></th>";
$dadosXls .= "<th><b>dataPrevisaoPagamento</b></th>";
$dadosXls .= "<th><b>notaFiscal</b></th>";
$dadosXls .= "<th><b>protocolo</b></th>";
$dadosXls .= "<th><b>formaPagamento</b></th>";
$dadosXls .= "<th><b>statusPagamento</b></th>";
$dadosXls .= "<th><b>observacao</b></th>";
$dadosXls .= "<th><b>medicoCirurgiao</b></th>";
//29
$dadosXls .= "<th><b>tipoGuia</b></th>";
$dadosXls .= "<th><b>numeroGuia</b></th>";
$dadosXls .= "<th><b>guiaPrincipal</b></th>";
$dadosXls .= "<th><b>dataAutorizacao</b></th>";
$dadosXls .= "<th><b>senhaAutorizacao</b></th>";
$dadosXls .= "<th><b>dataValidadeSenha</b></th>";
$dadosXls .= "<th><b>dataEmissaoGuia</b></th>";
$dadosXls .= "<th><b>tipoPlano</b></th>";
$dadosXls .= "<th><b>dataValidadeCarteira</b></th>";
$dadosXls .= "<th><b>numeroCartaoNacionalSaude</b></th>";
$dadosXls .= "<th><b>codigoContratado</b></th>";
$dadosXls .= "<th><b>nomeContratado</b></th>";
$dadosXls .= "<th><b>atendimentoRN</b></th>";
$dadosXls .= "<th><b>codCNES</b></th>";
$dadosXls .= "<th><b>codigoContratadoExecutante</b></th>";
$dadosXls .= "<th><b>nomeContratadoExecutante</b></th>";
$dadosXls .= "<th><b>grauParticipacao</b></th>";
$dadosXls .= "<th><b>dataAssinaturaPrestador</b></th>";
$dadosXls .= "<th><b>dataAssinaturaBeneficiario</b></th>";
$dadosXls .= "</tr>";
while ($form = mysqli_fetch_assoc($query))

{
    $dadosXls .= "<tr>";
    $dadosXls .= "<td>".$form["idproducao"]."</td>";
	$dadosXls .= "<td>".$form["dataRealizacao"]."</td>";
	$dadosXls .= "<td>".$form["idpaciente"]."</td>";
	$dadosXls .= "<td>".$form["idmedico"]."</td>";
	$dadosXls .= "<td>".$form["idprocedimentos"]."</td>";
	$dadosXls .= "<td>".utf8_decode($form["paciente"])."</td>";
	$dadosXls .= "<td>&quot;".$form["carteiraPaciente"]."&quot;</td>";
	$dadosXls .= "<td>".utf8_decode($form["medico"])."</td>";
	$dadosXls .= "<td>".utf8_decode($form["convenio"])."</td>";
	$dadosXls .= "<td>".utf8_decode($form["hospital"])."</td>";
	$dadosXls .= "<td>".$form["codigoProcedimento"]."</td>";
	$dadosXls .= "<td>".utf8_decode($form["descricaoProcedimento"])."</td>";
	//12
	$dadosXls .= "<td>". number_format($form["valorProcedimento"],2,",",".")."</td>";
	$dadosXls .= "<td>".$form["quantidade"]."</td>";
	$dadosXls .= "<td>".$form["adicional"]."</td>";
	$dadosXls .= "<td>".$form["redutor"]."</td>";
	$dadosXls .= "<td>".number_format($form["valorRecebido"],2,",",".")."</td>";
	$dadosXls .= "<td>".number_format($form["glosa"],2,",",".")."</td>";
	$dadosXls .= "<td>".$form["saldo"]."</td>";
	//19
	$dadosXls .= "<td>".$form["dataPagamento"]."</td>";
	$dadosXls .= "<td>".$form["dataCobranca"]."</td>";
	$dadosXls .= "<td>".$form["dataRepasse"]."</td>";
	$dadosXls .= "<td>".$form["dataPrevisaoPagamento"]."</td>";
	$dadosXls .= "<td>".$form["notaFiscal"]."</td>";
	$dadosXls .= "<td>".$form["protocolo"]."</td>";
	$dadosXls .= "<td>".$form["formaPagamento"]."</td>";
	$dadosXls .= "<td>".$form["statusPagamento"]."</td>";
	$dadosXls .= "<td>".utf8_decode($form["observacao"])."</td>";
	$dadosXls .= "<td>".utf8_decode($form["medicoCirurgiao"])."</td>";
   //29
	$dadosXls .= "<td>".$form["tipoGuia"]."</td>";
	$dadosXls .= "<td>".$form["numeroGuia"]."</td>";
	$dadosXls .= "<td>".$form["guiaPrincipal"]."</td>";
	$dadosXls .= "<td>".$form["dataAutorizacao"]."</td>";
	$dadosXls .= "<td>".$form["senhaAutorizacao"]."</td>";
	$dadosXls .= "<td>".$form["dataValidadeSenha"]."</td>";
	$dadosXls .= "<td>".$form["dataEmissaoGuia"]."</td>";
	$dadosXls .= "<td>".utf8_decode($form["tipoPlano"])."</td>";
	$dadosXls .= "<td>".$form["dataValidadeCarteira"]."</td>";
	$dadosXls .= "<td>".$form["numeroCartaoNacionalSaude"]."</td>";
	$dadosXls .= "<td>&quot;".$form["codigoContratado"]."&quot;</td>";
	$dadosXls .= "<td>".utf8_decode($form["nomeContratado"])."</td>";
	$dadosXls .= "<td>".$form["atendimentoRN"]."</td>";
	$dadosXls .= "<td>".$form["codCNES"]."</td>";
	$dadosXls .= "<td>&quot;".$form["codigoContratadoExecutante"]."&quot;</td>";
	$dadosXls .= "<td>".utf8_decode($form["nomeContratadoExecutante"])."</td>";
	$dadosXls .= "<td>".$form["grauParticipacao"]."</td>";
	$dadosXls .= "<td>".$form["dataAssinaturaPrestador"]."</td>";
	$dadosXls .= "<td>".$form["dataAssinaturaBeneficiario"]."</td>";
    $dadosXls .= "      </tr>";

}

$dadosXls .= "</table>";

    // Configurações header para forçar o download  
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$arquivo.'"');
    header('Cache-Control: max-age=0');
    // Se for o IE9, isso talvez seja necessário
    header('Cache-Control: max-age=1');


// Envia o conteúdo do arquivo
echo $dadosXls;
exit;

?>