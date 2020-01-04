<?php

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
				$query1 = "INSERT INTO pacientes (idpaciente, nome, cod_carteira) VALUES (null, '$form[paciente]','$form[carteiraPaciente]' )";
				mysqli_query($mysql_conn, $query1);
				$lastid= mysqli_insert_id($mysql_conn);
				$form["idpaciente"]=$lastid;
			}
		
		$query	= "INSERT INTO producao (idempresa, dataRealizacao, idpaciente, paciente, carteiraPaciente, idmedico, medico, idconvenio,
				convenio, hospital, codigoProcedimento, descricaoProcedimento, valorProcedimento, quantidade, adicional, redutor, valorRecebido,
				glosa, saldo, dataPagamento, dataCobranca, dataPrevisaoPagamento, dataRepasse, formaPagamento, statusPagamento, notaFiscal, observacao) VALUES ( '$form[idempresa]', 
				STR_TO_DATE('$form[dataRealizacao]', '%d/%m/%Y %H:%i:%s'), '$form[idpaciente]', '$form[paciente]', '$form[carteiraPaciente]','$form[idmedico]',
				'$form[medico]','$form[idconvenio]','$form[convenio]','$form[hospital]', '$form[codigoProcedimento]','$form[descricaoProcedimento]', '$form[valorProcedimento]', 
				'$form[quantidade]', '$form[adicional]', '$form[redutor]', '$form[valorRecebido]', '$form[glosa]', '$form[saldo]', STR_TO_DATE('$form[dataPagamento]','%d/%m/%Y %H:%i:%s'), 
				STR_TO_DATE('$form[dataCobranca]','%d/%m/%Y %H:%i:%s'), STR_TO_DATE('$form[dataPrevisaoPagamento]','%d/%m/%Y %H:%i:%s'),
				STR_TO_DATE('$form[dataRepasse]',  '%d/%m/%Y %H:%i:%s'),'$form[formaPagamento]', '$form[statusPagamento]', '$form[notaFiscal]', '$form[observacao]')";
		mysqli_query($mysql_conn, $query);
		$response[] = array("idp"=>$form['idpaciente']);
		echo json_encode($response);

		} 
		else 
			{	
				if(!empty($form["idproducao"])) {
				$query	= "UPDATE producao SET dataRealizacao=STR_TO_DATE('$form[dataRealizacao]', '%d/%m/%Y %H:%i:%s'), idpaciente='$form[idpaciente]', paciente='$form[paciente]', carteiraPaciente='$form[carteiraPaciente]',
						idmedico='$form[idmedico]', medico='$form[medico]' , convenio='$form[convenio]', hospital='$form[hospital]',   
						valorRecebido='$form[valorRecebido]', 
						dataCobranca=STR_TO_DATE('$form[dataCobranca]', '%d/%m/%Y %H:%i:%s'), dataPagamento=STR_TO_DATE('$form[dataPagamento]', '%d/%m/%Y %H:%i:%s'), dataRepasse=STR_TO_DATE('$form[dataRepasse]', '%d/%m/%Y %H:%i:%s'),
						glosa='$form[glosa]', saldo='$form[saldo]', notaFiscal='$form[notaFiscal]', formaPagamento='$form[formaPagamento]', statusPagamento='$form[statusPagamento]', observacao='$form[observacao]'  where idproducao='$form[idproducao]'";	
				mysqli_query($mysql_conn,$query);
			}
		}		
	}		
	

?>