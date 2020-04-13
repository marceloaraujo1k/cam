<?php


// OS ARQUIVOS XML ESTAO LIMITADOS A NO MAX. 100  GUIAS POR ARQUIVO E CADA GUIA DEVE TER NO MAX. 5 PROCEDIMENTOS

include '../opendb.php';
session_start();
header('Content-Type: application/xml; charset=UTF-8');
date_default_timezone_set('America/Recife');

//Dados Operadora:
//$_XML['versao_tiss'] = '030303';
$_XML['versao_padrao'] = '3.04.00';
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
//$_XML['senha'] = '2222';
//$_XML['medico'] = 'Dr. Fabiano';
//$_XML['crm'] = '0000';
//$_XML['cbos'] = '';
//Dados do beneficiário
//$_XML['nome'] = 'Fulano de Tal';
//$_XML['dt_nascimento'] = '01/01/1980';
//$_XML['carteira'] = '4444444444444444';
//$_XML['validade'] = '31/12/2030';

//Dados da Fatura / Lote 
// ##### coloquei o sequencial digitado no campo sequencial/lote  - Original => $_XML['numero_lote'] = '85681';
// Campo destinado ao número identificador de um lote de guia. Este número é de responsabilidade do Prestador e é utilizado para seu controle interno.
// Maximo de 20 Posições 
$_XML['numero_lote'] = $_GET['pdfff'];

//$_XML['fatura_remessa'] = '123';

//Dados do procedimento realizado
//$_XML['tabela'] = '22';
//$_XML['procedimento_tuss'] = '10101012';
//$_XML['descricao_proced'] = 'Consulta em consultório';
//$_XML['valor_unitario'] = '500,00';
//$_XML['qtde'] = '1';
//$_XML['valor_total'] = '500,00';

$_XML['tipoTransacao'] = 'ENVIO_LOTE_GUIAS';
// Sequencial da Transacao -  string 12 - YYYYMMDD+(ID_CONVENIO*100)+LOTE
$_XML['sequencialTransacao'] = date("Ymd");
// Data/Hora criação do arquivo XML
$_XML['dataRegistroTransacao'] = date("Y-m-d");
$_XML['horaRegistroTransacao'] = date("H:i:s");

$_XML['numero_guia_prestador'] = '9999999';
$_XML['numero_guia_operadora'] = '9999999';
$_XML['numero_carteira'] = '';
$_XML['atendimentoRN'] = 'N';
$_XML['nome_beneficiario'] = "";
$_XML['numeroCNS'] = '';
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
$_XML['observacao'] = '';
$_XML['cnpjLocalExcecutante'] = '99999999999999';


$xml = new DOMDocument("1.0", "UTF-8");
// Remove os espacos em branco
$xml->preserveWhiteSpace = false;
// Realizar a quebra dos blocos do XML por linha
$xml->formatOutput = true;

$mensagemTISS = $xml->createElement("ans:mensagemTISS");
$xml->appendChild($mensagemTISS);

$xml->createAttributeNS('http://www.w3.org/2000/09/xmldsig#', 'ds:attr');
$xml->createAttributeNS('http://www.w3.org/2001/XMLSchema-instance', 'xsi:attr');
$xml->createAttributeNS('http://www.ans.gov.br/padroes/tiss/schemas/tissV3_04_00.xsd', 'schemaLocation:attr');
//*****ATENÇÂO***************************************************************************/
//Troque a linha acima pela linha abaixo, caso dê problemas na validação
//$xml->createAttributeNS('http://www.ans.gov.br/padroes/tiss/schemas http://www.ans.gov.br/padroes/tiss/schemas/tissV3_04_00.xsd', 'schemaLocation:attr');

$xml->createAttributeNS('http://www.ans.gov.br/padroes/tiss/schemas', 'ans:attr');

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
$guiasTISS = $xml->createElement("ans:guiasTISS");
$loteGuias->appendChild($guiasTISS);


//Início das Consultas e do Looping

$id = $_GET['id']; 
$dataStart = $_GET['start_date'];
$dataEnd = $_GET['end_date'];
$geradorNumeroGuia = 0;

$query = mysqli_query($mysql_conn, "SELECT P.idproducao, P.dataRealizacao, P.idpaciente, P.paciente,
P.carteiraPaciente, P.idmedico, P.medico, (SELECT crm  FROM medicos M where M.idmedico = P.idmedico) as crmMedico,
P.codigoProcedimento, P.descricaoProcedimento, P.valorProcedimento, P.quantidade FROM producao as P where  dataCobranca BETWEEN '$dataStart' and '$dataEnd'
and idconvenio = (SELECT idconvenio FROM convenio WHERE DESCRICAO='$id' LIMIT 1)");
while ($row = mysqli_fetch_assoc($query)){

$guiaConsulta = $xml->createElement("ans:guiaSP-SADT");
$guiasTISS->appendChild($guiaConsulta);

$cabecalhoConsulta = $xml->createElement("ans:cabecalhoGuia");
$guiaConsulta->appendChild($cabecalhoConsulta);

$registroANS = $xml->createElement("ans:registroANS", $_XML['registro_ans']);
$cabecalhoConsulta->appendChild($registroANS);

$numeroGuiaPrestador = $xml->createElement("ans:numeroGuiaPrestador", $row["idproducao"]);
$cabecalhoConsulta->appendChild($numeroGuiaPrestador);

$guiaPrincipal = $xml->createElement("ans:guiaPrincipal", $_XML['numero_guia_prestador'] = $row["idproducao"]);
$cabecalhoConsulta->appendChild($guiaPrincipal);

$dadosAutorizacao = $xml->createElement("ans:dadosAutorizacao");
$guiaConsulta->appendChild($dadosAutorizacao);

$numeroGuiaOperadora = $xml->createElement("ans:numeroGuiaOperadora", $_XML['numero_guia_operadora']);
$dadosAutorizacao->appendChild($numeroGuiaOperadora);

$dataAutorizacao = $xml->createElement("ans:dataAutorizacao");
$dadosAutorizacao->appendChild($dataAutorizacao);

$senha = $xml->createElement("ans:senha");
$dadosAutorizacao->appendChild($senha);

$dataValidadeSenha = $xml->createElement("ans:dataValidadeSenha");
$dadosAutorizacao->appendChild($dataValidadeSenha);

$dadosBeneficiario = $xml->createElement("ans:dadosBeneficiario");
$guiaConsulta->appendChild($dadosBeneficiario);

$numeroCarteira = $xml->createElement("ans:numeroCarteira", $_XML['numero_carteira'] = $row['carteiraPaciente']);
$dadosBeneficiario->appendChild($numeroCarteira);

$atendimentoRN = $xml->createElement("ans:atendimentoRN", $_XML['atendimentoRN']);
$dadosBeneficiario->appendChild($atendimentoRN);

$nomeBeneficiario = $xml->createElement("ans:nomeBeneficiario", $_XML['nome_beneficiario'] = substr($row['paciente'],0,70));
$dadosBeneficiario->appendChild($nomeBeneficiario);

$numeroCNS = $xml->createElement("ans:numeroCNS", $_XML['numeroCNS']);
$dadosBeneficiario->appendChild($numeroCNS);

$identificadorBeneficiario = $xml->createElement("ans:identificadorBeneficiario");
$dadosBeneficiario->appendChild($identificadorBeneficiario);


// Dados Solicitantes
$dadosSolicitante = $xml->createElement("ans:dadosSolicitante");
$guiaConsulta->appendChild($dadosSolicitante);

$contratadoSolicitante = $xml->createElement("ans:contratadoSolicitante");
$dadosSolicitante->appendChild($contratadoSolicitante);

$codigoPrestadorNaOperadora = $xml->createElement("ans:codigoPrestadorNaOperadora");
$contratadoSolicitante->appendChild($codigoPrestadorNaOperadora);

$nomeContratado = $xml->createElement("ans:nomeContratado");
$contratadoSolicitante->appendChild($nomeContratado);

$contratadoExecutante = $xml->createElement("ans:contratadoExecutante");
$guiaConsulta->appendChild($contratadoExecutante);

$codigoPrestadorNaOperadora = $xml->createElement("ans:codigoPrestadorNaOperadora",$_XML['codigo_prestador_na_operadora'] = $_XML['cnpj']);
$contratadoExecutante->appendChild($codigoPrestadorNaOperadora);

$nomeContratado = $xml->createElement("ans:nomeContratado", $_XML['nome_contratado']);
$contratadoExecutante->appendChild($nomeContratado);

$cnes = $xml->createElement("ans:CNES", $_XML['cnes']);
$contratadoExecutante->appendChild($cnes);

$profissionalExecutante = $xml->createElement("ans:profissionalExecutante");
$guiaConsulta->appendChild($profissionalExecutante);

$nomeProfissional = $xml->createElement("ans:nomeProfissional", $_XML['nomeProfissional'] = $row['medico']);
$profissionalExecutante->appendChild($nomeProfissional);

$conselhoProfissional = $xml->createElement("ans:conselhoProfissional", $_XML['conselhoProfissional']);
$profissionalExecutante->appendChild($conselhoProfissional);

$numeroConselhoProfissional = $xml->createElement("ans:numeroConselhoProfissional", $_XML['numeroConselhoProfissional'] =  $row['crmMedico']);
$profissionalExecutante->appendChild($numeroConselhoProfissional);

$uf = $xml->createElement("ans:UF", $_XML['uf']);
$profissionalExecutante->appendChild($uf);

$cbos = $xml->createElement("ans:CBOS", $_XML['cbos']);
$profissionalExecutante->appendChild($cbos);

$indicacaoAcidente = $xml->createElement("ans:indicacaoAcidente", $_XML['indicacaoAcidente']);
$guiaConsulta->appendChild($indicacaoAcidente);

$dadosAtendimento = $xml->createElement("ans:dadosAtendimento");
$guiaConsulta->appendChild($dadosAtendimento);

$dataAtendimento = $xml->createElement("ans:dataAtendimento", $_XML['dataAtendimento'] =   date('Y-m-d', strtotime($row["dataRealizacao"])) );
$dadosAtendimento->appendChild($dataAtendimento);

$tipoConsulta = $xml->createElement("ans:tipoConsulta", $_XML['tipoConsulta']);
$dadosAtendimento->appendChild($tipoConsulta);

$procedimento = $xml->createElement("ans:procedimento");
$dadosAtendimento->appendChild($procedimento);

$codigoTabela = $xml->createElement("ans:codigoTabela", $_XML['codigoTabela']);
$procedimento->appendChild($codigoTabela);

$codigoProcedimento = $xml->createElement("ans:codigoProcedimento",$_XML['codigoProcedimento'] = $row['codigoProcedimento']);
$procedimento->appendChild($codigoProcedimento);

$descricaoProcedimento = $xml->createElement("ans:descricaoProcedimento",$_XML['descricaoProcedimento'] = $row['descricaoProcedimento']);
$procedimento->appendChild($descricaoProcedimento);

$valorProcedimento = $xml->createElement("ans:valorProcedimento", $_XML['valorProcedimento'] = $row['valorProcedimento']);
$procedimento->appendChild($valorProcedimento);

$observacao = $xml->createElement("ans:observacao", $_XML['observacao']);
$guiaConsulta->appendChild($observacao);
}

// Utilize a variável $_XML['hash_dados'] para concatenar os dados e calcular o HASH antes do terceiro bloco
//$_XML['hash_dados'] = '';

//A variável $_XML['hash'] está nula pois deve ser calculada com os dados dos elementos(tags) do XML
//$_XML['hash'] = 'calculo do HASH';

// Calculo o Hash - Você poderia gerar os dados, usar um (replace do PHP) para substituir as tags, e pegar apenas os dados

//$xml2 = new SimpleXMLElement($xml);
//$_XML['hash_dados'] = $xml2;
//$_XML['hash'] = md5($_XML['hash_dados']);

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

$nomeDocumento = $_GET['pdfff'];


$xml->save("../documentos/producaoXml/".$nomeDocumento."_".$_XML['hash'].".xml");

echo $xml->saveXML();
?>
