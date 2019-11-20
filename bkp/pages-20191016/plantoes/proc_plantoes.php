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
		
		if (empty ($form["idplantao"])){
			
		$query	= "INSERT INTO plantoes (idmedico, idConfiguracaoPlantao, idhospital, dataInicio, dataFim) VALUES ('$form[idmedico]', '$form[idConfiguracaoPlantao]', '$form[idhospital]',
		STR_TO_DATE('$form[dataInicio]', '%d/%m/%Y %H:%i:%s'), STR_TO_DATE('$form[dataFim]', '%d/%m/%Y %H:%i:%s') )";
		mysqli_query($mysql_conn, $query);
		} 
		else 
			{	
				if(!empty($form["idplantao"])) {
				$query	= "UPDATE producao SET dataRealizacao=STR_TO_DATE('$form[dataRealizacao]', '%d/%m/%Y %H:%i:%s'), idpaciente='$form[idpaciente]', paciente='$form[paciente]', carteiraPaciente='$form[carteiraPaciente]',
						idmedico='$form[idmedico]', medico='$form[medico]' , convenio='$form[convenio]', hospital='$form[hospital]',   valorRecebido='$form[valorRecebido]'+'$form[valorRecebidoAnt]', 
						dataCobranca=STR_TO_DATE('$form[dataCobranca]', '%d/%m/%Y %H:%i:%s'), dataPagamento=STR_TO_DATE('$form[dataPagamento]', '%d/%m/%Y %H:%i:%s'), dataRepasse=STR_TO_DATE('$form[dataRepasse]', '%d/%m/%Y %H:%i:%s'),
						glosa='$form[glosa]', saldo='$form[saldo]', notaFiscal='$form[notaFiscal]', formaPagamento='$form[formaPagamento]', statusPagamento='$form[statusPagamento]', observacao='$form[observacao]'  where idproducao='$form[idproducao]'";	
				mysqli_query($mysql_conn,$query);
			}
		}		
	}		
	
	
?>