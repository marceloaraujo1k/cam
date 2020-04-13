<?php


// OS ARQUIVOS XML ESTAO LIMITADOS A NO MAX. 100  GUIAS POR ARQUIVO E CADA GUIA DEVE TER NO MAX. 5 PROCEDIMENTOS

include '../opendb.php';
session_start();
header('Content-Type: application/xml; charset=UTF-8');
date_default_timezone_set('America/Recife');


global $_XML;
//Dados Operadora:
//$_XML['versao_tiss'] = '030303';
$_XML['versao_padrao'] = '3.03.03';
// Registro ANS HAPVIDA - ANS 36.825-3
$_XML['registro_ans'] = '368253';

//Dados Prestador:
$_XML['codigo_credenciamento'] = '12345';
$_XML['cnpj'] = '07275740000180';
//$_XML['prestador'] = 'Hospital ABCD';
//Dados do atendimento e beneficiário
//$_XML['data_hora'] = '03/04/2018 22:15:00';
//$_XML['rn'] = 'N'; //Não
//$_XML['tipo_atd'] = 'Ambulatorial';
$_XML['carater'] = '1'; //1-Eletivo 2-Urgencia
//$_XML['guia'] = '1111';
//$_XML['senha'] = '1';
//Dados da Fatura / Lote 
// ##### coloquei o sequencial digitado no campo sequencial/lote  - Original => $_XML['numero_lote'] = '85681';
// Campo destinado ao número identificador de um lote de guia. Este número é de responsabilidade do Prestador e é utilizado para seu controle interno.
// Maximo de 20 Posições 
$_XML['numero_lote'] = substr($_GET['pdfff'], -12);
//$_XML['fatura_remessa'] = '123';
$_XML['tipoTransacao'] = 'ENVIO_LOTE_GUIAS';
// Sequencial da Transacao -  string 12 - YYYYMMDD+(ID_CONVENIO*100)+LOTE
$_XML['sequencialTransacao'] = '1';
// Data/Hora criação do arquivo XML
$_XML['dataRegistroTransacao'] = date("Y-m-d");
$_XML['horaRegistroTransacao'] = date("H:i:s");
$_XML['numero_guia_prestador'] = '9999999';
$_XML['numero_guia_operadora'] = '9999999';
$_XML['numero_carteira'] = '';
$_XML['atendimentoRN'] = 'N';
$_XML['nome_beneficiario'] = "";
$_XML['numeroCNS'] = '9999999';
$_XML['codigo_prestador_na_operadora'] = '07275740000180';
$_XML['nome_contratado'] = 'CLINICA DE ANESTESIOLOGIA DE MOSSORO LTDA.';
$_XML['cnes'] = '9999999';
$_XML['nomeProfissional'] = '';
// Tabela TUSS - Tabela de Dominio 26 - 
$_XML['conselhoProfissional'] = '06';
$_XML['numeroConselhoProfissional'] = '';
//Tabela TUSS - Tabela de Dominio 59 - UF - Rio Grande do Norte = 24
$_XML['uf'] = '24';
// CBOS = Anetesiologista 225151 ou 999999	CBO-S desconhecido ou não informado pelo solicitante
$_XML['cbos'] = '999999';
// 9 = Acidente
$_XML['indicacaoAcidente'] = '9';
$_XML['dataAtendimento'] = '';
$_XML['tipoConsulta'] = '';
// Codigo da TABELA para os exemplos observados = 22
$_XML['codigoTabela'] = '22';
$_XML['codigoProcedimento'] = '';
$_XML['valorProcedimento'] = '';
$_XML['observacao'] = '0';
// Codigo do hospital  ? Provavelmente CNPJ dos HOSPITAIS e CLINICAS onde são realizados os procedimentos
$_XML['cnpjLocalExecutante'] = '99999999999999';
// ? via de acesso de um determinado procedimento executado.
$_XML['viaAcesso'] = '2';
/// ? Videolaparoscopia--> <!--Convencional-->
$_XML['tecnicaUtilizada'] = '2';
// 06	Anestesista - TabelasDominio.doc 
$_XML['grauParticipacao'] = '06';
$_XML['cpfProfissional'] = '99999999999';



function cabecalhoXml($_XML){

global $xml;
global $mensagemTISS;
// Instancia objeto XML
$xml = new DOMDocument("1.0", "UTF-8");
// Remove os espacos em branco
$xml->preserveWhiteSpace = false;
// Realizar a quebra dos blocos do XML por linha
$xml->formatOutput = true;

$mensagemTISS = $xml->createElement("ans:mensagemTISS");
$xml->appendChild($mensagemTISS);


//VERSAO 3.04.00
//$xml->createAttributeNS('http://www.w3.org/2000/09/xmldsig#', 'ds:attr');
//$xml->createAttributeNS('http://www.w3.org/2001/XMLSchema-instance', 'xsi:attr');
//$xml->createAttributeNS('http://www.ans.gov.br/padroes/tiss/schemas/tissV3_04_00.xsd', 'schemaLocation:attr');
//*****ATENÇÂO***************************************************************************/
//Troque a linha acima pela linha abaixo, caso dê problemas na validação
//$xml->createAttributeNS('http://www.ans.gov.br/padroes/tiss/schemas http://www.ans.gov.br/padroes/tiss/schemas/tissV3_04_00.xsd', 'schemaLocation:attr');
//$xml->createAttributeNS('http://www.ans.gov.br/padroes/tiss/schemas', 'ans:attr');

//VERSAO 03.03.00
//$xml->createAttributeNS('http://www.w3.org/2000/09/xmldsig#', 'ds:attr');
$xml->createAttributeNS('http://www.ans.gov.br/padroes/tiss/schemas', 'ans:attr');
$xml->createAttributeNS('http://www.w3.org/2001/XMLSchema-instance', 'xsi:attr');
$xml->createAttributeNS('http://www.ans.gov.br/padroes/tiss/schemas/tissV3_03_03.xsd', 'schemaLocation:attr');
$xml->createAttributeNS( 'http://www.ans.gov.br/padroes/tiss/schemas', 'ans:attr' );
        
// ans:mensagemTISS / ans:cabecalho
$cabecalho = $xml->createElement("ans:cabecalho");
$mensagemTISS->appendChild($cabecalho);

// ans:mensagemTISS / ans:cabecalho / ans:identificacaoTransacao
$identificacaoTransacao = $xml->createElement("ans:identificacaoTransacao");
$cabecalho->appendChild($identificacaoTransacao);

# ans:tipoTransacao
$tipoTransacao = $xml->createElement("ans:tipoTransacao", $_XML['tipoTransacao']);
$identificacaoTransacao->appendChild($tipoTransacao);

#sequencialTransacao
$sequencialTransacao = $xml->createElement("ans:sequencialTransacao", $_XML['sequencialTransacao']);
$identificacaoTransacao->appendChild($sequencialTransacao);

#dataRegistroTransacao
$dataRegistroTransacao = $xml->createElement("ans:dataRegistroTransacao", $_XML['dataRegistroTransacao']);
$identificacaoTransacao->appendChild($dataRegistroTransacao);

#horaRegistroTransacao
$horaRegistroTransacao = $xml->createElement("ans:horaRegistroTransacao", $_XML['horaRegistroTransacao']);
$identificacaoTransacao->appendChild($horaRegistroTransacao);

// ans:mensagemTISS / ans:cabecalho / ans:origem
$origem = $xml->createElement("ans:origem");
$cabecalho->appendChild($origem);

// ans:mensagemTISS / ans:cabecalho / ans:origem / identificacaoPrestador
$identificacaoPrestador = $xml->createElement("ans:identificacaoPrestador");
$origem->appendChild($identificacaoPrestador);

$codigoPrestadorNaOperadora = $xml->createElement("ans:codigoPrestadorNaOperadora", $_XML['cnpj']);
$identificacaoPrestador->appendChild($codigoPrestadorNaOperadora);

// ans:mensagemTISS / ans:cabecalho / ans:destino
$destino = $xml->createElement("ans:destino");
$cabecalho->appendChild($destino);

// ans:mensagemTISS / ans:cabecalho / ans:registroANS
$registroANS = $xml->createElement("ans:registroANS", $_XML['registro_ans']);
$destino->appendChild($registroANS);

// ans:mensagemTISS / ans:cabecalho / ans:Padrao
$Padrao = $xml->createElement("ans:Padrao", $_XML['versao_padrao']);
$cabecalho->appendChild($Padrao);

/* segundo bloco */
// ans:mensagemTISS / ans:prestadorParaOperadora
$prestadorParaOperadora = $xml->createElement("ans:prestadorParaOperadora");
$mensagemTISS->appendChild($prestadorParaOperadora);

// ans:mensagemTISS / ans:prestadorParaOperadora / loteGuias
$loteGuias = $xml->createElement("ans:loteGuias");
$prestadorParaOperadora->appendChild($loteGuias);

// ans:mensagemTISS / ans:prestadorParaOperadora / loteGuias / numeroLote
$numeroLote = $xml->createElement("ans:numeroLote", $_XML['numero_lote']);
$loteGuias->appendChild($numeroLote);

// ans:mensagemTISS / ans:prestadorParaOperadora / loteGuias / guiasTISS
global $guiasTISS;
$guiasTISS = $xml->createElement("ans:guiasTISS");
$loteGuias->appendChild($guiasTISS);

 
}

//Início das Consultas e do Looping
cabecalhoXml($_XML);

global $nomeArquivo;
$nomeArquivo = intval($_XML['numero_lote'])-1;


$id = $_GET['id']; 
$dataStart = $_GET['start_date'];
$dataEnd = $_GET['end_date'];
$contadorGUIAS = 0;


$query = mysqli_query($mysql_conn, "SELECT P.idproducao, P.dataRealizacao, P.idpaciente, P.paciente,
P.carteiraPaciente,  P.hospital, P.idmedico, P.medico, (SELECT crm  FROM medicos M where M.idmedico = P.idmedico) as crmMedico,
P.codigoProcedimento, P.descricaoProcedimento, P.valorProcedimento, P.quantidade, P.adicional, P.redutor, 
P.numeroGuia, P.guiaPrincipal, P.dataAutorizacao, P.senhaAutorizacao, P.dataValidadeSenha, P.dataEmissaoGuia, P.tipoPlano, 
P.dataValidadeCarteira, P.numeroCartaoNacionalSaude, P.codigoContratado, P.nomeContratado, P.atendimentoRN, P.codCNES,
 P.codigoContratadoExecutante, P.nomeContratadoExecutante, P.grauParticipacao, P.dataAssinaturaPrestador, P.dataAssinaturaBeneficiario
FROM producao as P where  dataCobranca BETWEEN '$dataStart' and '$dataEnd'
and idconvenio = (SELECT idconvenio FROM convenio WHERE DESCRICAO='$id' LIMIT 1)");

//Array NUMERO DA GUIA
global $nGuia;
$nGuia = array();


while ($row = mysqli_fetch_assoc($query)){

// Hapvida orientou no caso de uma mesma guia possuir N senhas utlizar numero de GUIA aleatorio para os demais procedimentos
    $guiaAtual = in_array($row["numeroGuia"], $nGuia);

    if ($guiaAtual == null) {
        array_push($nGuia, $row["numeroGuia"]);
        //var_dump("guia nula");
    }
    else {
        $row["numeroGuia"] =  $row['idproducao'];
        array_push($nGuia, $row["numeroGuia"]);
       // var_dump($row["numeroGuia"]);
    }        
    

$guiaConsulta = $xml->createElement("ans:guiaHonorarios");
$guiasTISS->appendChild($guiaConsulta);

$cabecalhoConsulta = $xml->createElement("ans:cabecalhoGuia");
$guiaConsulta->appendChild($cabecalhoConsulta);

$registroANS = $xml->createElement("ans:registroANS", $_XML['registro_ans']);
$cabecalhoConsulta->appendChild($registroANS);

$numeroGuiaPrestador = $xml->createElement("ans:numeroGuiaPrestador",  ($row['numeroGuia'] != null ? $row['numeroGuia'] : $row['idproducao']));
$cabecalhoConsulta->appendChild($numeroGuiaPrestador);

//Guia solicitacao Internacao / Senha 

$guiaSolicInternacao = $xml->createElement("ans:guiaSolicInternacao", ($row['guiaPrincipal'] != null ? $row['guiaPrincipal'] : $row['idproducao']));
$guiaConsulta->appendChild($guiaSolicInternacao);

$senha = $xml->createElement("ans:senha", ($row['senhaAutorizacao'] != null ? $row['senhaAutorizacao'] : 0));
$guiaConsulta->appendChild($senha);

//$numeroGuiaOperadora = $xml->createElement("ans:numeroGuiaOperadora", $_XML['numero_guia_operadora']);
//$guiaConsulta->appendChild($numeroGuiaOperadora);

// Dados Beneficiario
$dadosBeneficiario = $xml->createElement("ans:beneficiario");
$guiaConsulta->appendChild($dadosBeneficiario);

$numeroCarteira = $xml->createElement("ans:numeroCarteira", $_XML['numero_carteira'] = $row['carteiraPaciente']);
$dadosBeneficiario->appendChild($numeroCarteira);

$nomeBeneficiario = $xml->createElement("ans:nomeBeneficiario", $_XML['nome_beneficiario'] = substr($row['paciente'],0,70));
$dadosBeneficiario->appendChild($nomeBeneficiario);

$atendimentoRN = $xml->createElement("ans:atendimentoRN", $_XML['atendimentoRN'] = ($row['atendimentoRN'])==0 ?'N':'S');
$dadosBeneficiario->appendChild($atendimentoRN);

/*$numeroCNS = $xml->createElement("ans:numeroCNS", $_XML['numeroCNS']);
$dadosBeneficiario->appendChild($numeroCNS);

$identificadorBeneficiario = $xml->createElement("ans:identificadorBeneficiario");
$dadosBeneficiario->appendChild($identificadorBeneficiario); */

// Local contratado
$localContratado = $xml->createElement("ans:localContratado");
$guiaConsulta->appendChild($localContratado);

$codigoContratado = $xml->createElement("ans:codigoContratado");
$localContratado->appendChild($codigoContratado);

$cnpjLocalExecutante = $xml->createElement("ans:cnpjLocalExecutante", preg_replace('/[^a-zA-Z0-9]/',  '', $row['codigoContratado']));
$codigoContratado->appendChild($cnpjLocalExecutante);

$nomeContratado = $xml->createElement("ans:nomeContratado", $row['nomeContratado']);
$localContratado->appendChild($nomeContratado);

$cnes = $xml->createElement("ans:cnes", $_XML['cnes']);
$localContratado->appendChild($cnes);

// Dados Contratado Executante
$dadosContratadoExecutante = $xml->createElement("ans:dadosContratadoExecutante");
$guiaConsulta->appendChild($dadosContratadoExecutante);

$codigoPrestadorNaOperadora = $xml->createElement("ans:codigonaOperadora", preg_replace('/[^a-zA-Z0-9]/',  '', $row['codigoContratadoExecutante']));
$dadosContratadoExecutante->appendChild($codigoPrestadorNaOperadora);

$nomeContratadoExecutante = $xml->createElement("ans:nomeContratadoExecutante",  $row['nomeContratadoExecutante']);
$dadosContratadoExecutante->appendChild($nomeContratadoExecutante);

$cnes = $xml->createElement("ans:cnesContratadoExecutante", $_XML['cnes']);
$dadosContratadoExecutante->appendChild($cnes);

// Dados Internacao
$dadosInternacao = $xml->createElement("ans:dadosInternacao");
$guiaConsulta->appendChild($dadosInternacao);

$dataInicioFaturamento = $xml->createElement("ans:dataInicioFaturamento", $_XML['dataAtendimento'] =   date('Y-m-d', strtotime($row["dataRealizacao"])) );
$dadosInternacao->appendChild($dataInicioFaturamento); 

$dataFimFaturamento = $xml->createElement("ans:dataFimFaturamento", $_XML['dataAtendimento'] =   date('Y-m-d', strtotime($row["dataRealizacao"])) );
$dadosInternacao->appendChild($dataFimFaturamento); 

// Procedimentos Realizados

$procedimentosRealizados = $xml->createElement("ans:procedimentosRealizados");
$guiaConsulta->appendChild($procedimentosRealizados);

$procedimentoRealizado = $xml->createElement("ans:procedimentoRealizado");
$procedimentosRealizados->appendChild($procedimentoRealizado);

$dataExecucao = $xml->createElement("ans:dataExecucao", $_XML['dataAtendimento'] =   date('Y-m-d', strtotime($row["dataRealizacao"])) );
$procedimentoRealizado->appendChild($dataExecucao); 

$horaInicial = $xml->createElement("ans:horaInicial", date('h:i:s', strtotime($row["dataRealizacao"])));
$procedimentoRealizado->appendChild($horaInicial); 

$horaFinal = $xml->createElement("ans:horaFinal", date('h:i:s', strtotime($row["dataRealizacao"])));
$procedimentoRealizado->appendChild($horaFinal); 

$procedimento = $xml->createElement("ans:procedimento");
$procedimentoRealizado->appendChild($procedimento);

$codigoTabela = $xml->createElement("ans:codigoTabela", $_XML['codigoTabela']);
$procedimento->appendChild($codigoTabela);

$codigoProcedimento = $xml->createElement("ans:codigoProcedimento",$_XML['codigoProcedimento'] = $row['codigoProcedimento']);
$procedimento->appendChild($codigoProcedimento);

$descricaoProcedimento = $xml->createElement("ans:descricaoProcedimento",$_XML['descricaoProcedimento'] = substr($row['descricaoProcedimento'],0,150));
$procedimento->appendChild($descricaoProcedimento);

$quantidadeExecutada = $xml->createElement("ans:quantidadeExecutada", ($row['quantidade']!=null ? $row['quantidade'] : '1'));
$procedimentoRealizado->appendChild($quantidadeExecutada); 

$viaAcesso = $xml->createElement("ans:viaAcesso", $_XML['viaAcesso']);
$procedimentoRealizado->appendChild($viaAcesso); 

$tecnicaUtilizada = $xml->createElement("ans:tecnicaUtilizada", $_XML['tecnicaUtilizada']);
$procedimentoRealizado->appendChild($tecnicaUtilizada); 

$reducaoAcrescimo = $xml->createElement("ans:reducaoAcrescimo", ($row['adicional'] != 0 ? ((($row['adicional'])/100)+1) : 1 ) *($row['redutor'] != 0 ? ((100-$row['redutor'])/100) : 1 ));
$procedimentoRealizado->appendChild($reducaoAcrescimo); 

$valorUnitario = $xml->createElement("ans:valorUnitario", $_XML['valorProcedimento'] = $row['valorProcedimento']);
$procedimentoRealizado->appendChild($valorUnitario);

$valorTotal = $xml->createElement("ans:valorTotal", number_format(($row['valorProcedimento']*$row['quantidade']),2,".",""));
$procedimentoRealizado->appendChild($valorTotal);

// Profissionais

$profissionais = $xml->createElement("ans:profissionais");
$procedimentoRealizado->appendChild($profissionais);

$grauParticipacao = $xml->createElement("ans:grauParticipacao", $_XML['grauParticipacao']);
$profissionais->appendChild($grauParticipacao);

$codProfissional = $xml->createElement("ans:codProfissional");
$profissionais->appendChild($codProfissional);

$cpfContratado = $xml->createElement("ans:cpfContratado",$_XML['cpfProfissional']);
$codProfissional->appendChild($cpfContratado);

$nomeProfissional = $xml->createElement("ans:nomeProfissional", $_XML['nomeProfissional'] = $row['medico']);
$profissionais->appendChild($nomeProfissional);

$conselhoProfissional = $xml->createElement("ans:conselhoProfissional", $_XML['conselhoProfissional']);
$profissionais->appendChild($conselhoProfissional);

$numeroConselhoProfissional = $xml->createElement("ans:numeroConselhoProfissional", $_XML['numeroConselhoProfissional'] =  $row['crmMedico']);
$profissionais->appendChild($numeroConselhoProfissional);

$uf = $xml->createElement("ans:UF", $_XML['uf']);
$profissionais->appendChild($uf);

$cbos = $xml->createElement("ans:CBO", $_XML['cbos']);
$profissionais->appendChild($cbos);

$observacao = $xml->createElement("ans:observacao", $_XML['observacao']);
$guiaConsulta->appendChild($observacao);

$valorTotalHonorarios = $xml->createElement("ans:valorTotalHonorarios", (number_format($row['quantidade']*$row['valorProcedimento'],2,".","")));
$guiaConsulta->appendChild($valorTotalHonorarios);

$dataEmissaoGuia = $xml->createElement("ans:dataEmissaoGuia", date('Y-m-d', strtotime($row["dataEmissaoGuia"])));
$guiaConsulta->appendChild($dataEmissaoGuia);

$contadorGUIAS=$contadorGUIAS+1;

if ($contadorGUIAS == 100) {
    
    $nomeArquivo = $nomeArquivo  +1;
    salvarGuia($nomeArquivo, $xml, $mensagemTISS);
    $contadorGUIAS = 0;
    cabecalhoXml($_XML);
}

}

salvarGuia($nomeArquivo+1, $xml, $mensagemTISS);
// Utilize a variável $_XML['hash_dados'] para concatenar os dados e calcular o HASH antes do terceiro bloco
//$_XML['hash_dados'] = '';

//A variável $_XML['hash'] está nula pois deve ser calculada com os dados dos elementos(tags) do XML
//$_XML['hash'] = 'calculo do HASH';

// Calculo o Hash - Você poderia gerar os dados, usar um (replace do PHP) para substituir as tags, e pegar apenas os dados

//$xml2 = new SimpleXMLElement($xml);
//$_XML['hash_dados'] = $xml2;
//$_XML['hash'] = md5($_XML['hash_dados']);
function salvarGUIA ($numeroLote, $xml, $mensagemTISS) {
$stripado = trim(preg_replace('/<[^>]*>/', '|', $xml->saveXML()));
$stripado = implode("", array_filter(array_map('trim', explode('|', $stripado))));
$hash = md5( $stripado );

$_XML['hash_dados'] = $hash;
$_XML['hash'] = $_XML['hash_dados'];


/* terceiro bloco */
// ans:mensagemTISS / ans:epilogo
$epilogo = $xml->createElement("ans:epilogo");
$mensagemTISS->appendChild($epilogo);

// ans:mensagemTISS / ans:epilogo / ans:hash
$hash = $xml->createElement("ans:hash", $_XML['hash']);
$epilogo->appendChild($hash);

//$nomeDocumento = $_GET['pdfff'];
$nomeDocumento = $numeroLote; 
$nomeDocumento = str_pad($nomeDocumento, 20, "0", STR_PAD_LEFT); 
$xml->save("../documentos/producaoXml/".$nomeDocumento."_".$_XML['hash'].".xml");

echo $xml->saveXML();
}
// Imprime o numero das guias
print_r($nGuia);

?>
