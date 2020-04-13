<?php

/* Valida usuário - empresa - função */
/*session_start();
if((!isset ($_SESSION['user']) == true) and (!isset ($_SESSION['idempresa']) == true))
{
  unset($_SESSION['user']);
  unset($_SESSION['idempresa']);
  session_destroy();
  header('location:../login.php');
  }

  global $usuarioLogado;

 $usuarioLogado = $_SESSION['user'];
*/

include '../opendb.php';
include_once('../func.php');

	switch($_POST['submit']){
		    case 'receberPagamento':
			receberPagamento();
			break;
			case 'inserirConta':
			inserirConta();
			break;
		
	}
	
function inserirConta() 
//Insere a conta médica 
	{
		global $mysql_conn;
		$form = $_POST;
	
		
		if (empty ($form["idproducao"])){
			if (empty ($form['idpaciente'] )) {
				$query1 = "INSERT INTO pacientes (nome, cod_carteira) VALUES ('$form[paciente]','$form[carteiraPaciente]' )";
				mysqli_query($mysql_conn, $query1);
				$lastid= mysqli_insert_id($mysql_conn);
				//$form["idpaciente"]=$lastid;
			}
		
		$query	= "INSERT IGNORE INTO producao (idempresa, dataRealizacao, idpaciente, paciente, carteiraPaciente, idmedico, medico, idconvenio,
				convenio, hospital, codigoProcedimento, descricaoProcedimento, valorProcedimento, quantidade, adicional, redutor, valorRecebido,
				glosa, saldo, dataPagamento, dataCobranca, dataPrevisaoPagamento, dataRepasse, formaPagamento, statusPagamento, notaFiscal, 
				observacao, medicoCirurgiao, tipoGuia, numeroGuia, guiaPrincipal, dataAutorizacao, senhaAutorizacao, dataValidadeSenha, dataEmissaoGuia, tipoPlano, 
				dataValidadeCarteira, numeroCartaoNacionalSaude, codigoContratado, nomeContratado, atendimentoRN, codCNES, codigoContratadoExecutante,
				nomeContratadoExecutante, grauParticipacao, dataAssinaturaPrestador, dataAssinaturaBeneficiario) VALUES ( '$form[idempresa]', 
				STR_TO_DATE('$form[dataRealizacao]', '%d/%m/%Y %H:%i:%s'), (SELECT idpaciente FROM pacientes WHERE nome = '$form[paciente]'), '$form[paciente]', '$form[carteiraPaciente]','$form[idmedico]',
				'$form[medico]','$form[idconvenio]','$form[convenio]','$form[hospital]', '$form[codigoProcedimento]','$form[descricaoProcedimento]', '$form[valorProcedimento]', 
				'$form[quantidade]', '$form[adicional]', '$form[redutor]', '$form[valorRecebido]', '$form[glosa]', '$form[saldo]', STR_TO_DATE('$form[dataPagamento]','%d/%m/%Y %H:%i:%s'), 
				STR_TO_DATE('$form[dataCobranca]','%d/%m/%Y %H:%i:%s'), STR_TO_DATE('$form[dataPrevisaoPagamento]','%d/%m/%Y %H:%i:%s'),
				STR_TO_DATE('$form[dataRepasse]',  '%d/%m/%Y %H:%i:%s'),'$form[formaPagamento]', '$form[statusPagamento]', '$form[notaFiscal]',
				 '$form[observacao]', '$form[medicoCirurgiao]', 
				 '$form[tipoGuia]', 
				 '$form[numeroGuia]',
				 '$form[guiaPrincipal]',
				 STR_TO_DATE('$form[dataAutorizacao]', '%d/%m/%Y %H:%i:%s'), 
				 '$form[senhaGuia]',
				 STR_TO_DATE('$form[dataValidadeSenha]', '%d/%m/%Y %H:%i:%s'),
				 STR_TO_DATE('$form[dataEmissaoGuia]', '%d/%m/%Y %H:%i:%s'),
				 '$form[tipoPlano]',
				 STR_TO_DATE('$form[dataValidadeCarteira]', '%d/%m/%Y %H:%i:%s'),
				 '$form[numeroCartaoNacionalSaude]',
				 '$form[codigoContratado]',
				 '$form[nomeContratado]', 
				 '$form[atendimentoRN]',
				 '$form[codCNES]',
				 '$form[codigoContratadoExecutante]',
				 '$form[nomeContratadoExecutante]',
				 '$form[grauParticipacao]',
				 STR_TO_DATE('$form[dataAssinaturaPrestador]', '%d/%m/%Y %H:%i:%s'),
				 STR_TO_DATE('$form[dataAssinaturaBeneficiario]', '%d/%m/%Y %H:%i:%s') )" ;
		mysqli_query($mysql_conn, $query);
		$response[] = array("idp"=>$form['idpaciente']);
		echo json_encode($response);
	
		// Log de eventos
/*		$registroID = mysqli_insert_id($mysql_conn);
		$query2 = "INSERT INTO log (dataEvento, operacaoEvento, idusuario) VALUES (now(),'INSERIDO REGISTRO', $usuarioLogado)";
		mysqli_query($mysql_conn, $query2);*/

		} 
		else 
			{	
				if(!empty($form["idproducao"])) {
				$query	= "UPDATE producao SET dataRealizacao=STR_TO_DATE('$form[dataRealizacao]', '%d/%m/%Y %H:%i:%s'), idpaciente=(SELECT idpaciente FROM pacientes WHERE nome = '$form[paciente]'), paciente='$form[paciente]', carteiraPaciente='$form[carteiraPaciente]',
						idmedico=(SELECT idmedico from medicos where nome = '$form[medico]'), medico='$form[medico]' , convenio='$form[convenio]', hospital='$form[hospital]',   
						adicional = '$form[adicional]', redutor='$form[redutor]',
						valorRecebido='$form[valorRecebido]', 
						dataCobranca=STR_TO_DATE('$form[dataCobranca]', '%d/%m/%Y %H:%i:%s'), dataPagamento=STR_TO_DATE('$form[dataPagamento]', '%d/%m/%Y %H:%i:%s'), dataRepasse=STR_TO_DATE('$form[dataRepasse]', '%d/%m/%Y %H:%i:%s'),
						glosa='$form[glosa]', saldo='$form[saldo]', notaFiscal='$form[notaFiscal]', formaPagamento='$form[formaPagamento]', statusPagamento='$form[statusPagamento]', observacao='$form[observacao]', medicoCirurgiao ='$form[medicoCirurgiao]', codigoProcedimento='$form[codigoProcedimento]', 
						descricaoProcedimento='$form[descricaoProcedimento]', valorProcedimento='$form[valorProcedimento]',
						tipoGuia ='$form[tipoGuia]', 
						numeroGuia ='$form[numeroGuia]',
						guiaPrincipal ='$form[guiaPrincipal]',
						dataAutorizacao =  STR_TO_DATE('$form[dataAutorizacao]', '%d/%m/%Y %H:%i:%s'), 
						senhaAutorizacao ='$form[senhaGuia]',
						dataValidadeSenha = STR_TO_DATE('$form[dataValidadeSenha]', '%d/%m/%Y %H:%i:%s'),
						dataEmissaoGuia =  STR_TO_DATE('$form[dataEmissaoGuia]', '%d/%m/%Y %H:%i:%s'),
						tipoPlano = '$form[tipoPlano]',
						dataValidadeCarteira = STR_TO_DATE('$form[dataValidadeCarteira]', '%d/%m/%Y %H:%i:%s'),
						numeroCartaoNacionalSaude = '$form[numeroCartaoNacionalSaude]',
						codigoContratado = '$form[codigoContratado]',
						nomeContratado = '$form[nomeContratado]', 
						atendimentoRN = '$form[atendimentoRN]',
						codCNES = '$form[codCNES]',
						codigoContratadoExecutante = '$form[codigoContratadoExecutante]',
						nomeContratadoExecutante = '$form[nomeContratadoExecutante]',
						grauParticipacao = '$form[grauParticipacao]',
						dataAssinaturaPrestador =  STR_TO_DATE('$form[dataAssinaturaPrestador]', '%d/%m/%Y %H:%i:%s'),
						dataAssinaturaBeneficiario = STR_TO_DATE('$form[dataAssinaturaBeneficiario]', '%d/%m/%Y %H:%i:%s')
					   where idproducao='$form[idproducao]'";	
				mysqli_query($mysql_conn,$query);

			}
		}		
	}		
	

?>