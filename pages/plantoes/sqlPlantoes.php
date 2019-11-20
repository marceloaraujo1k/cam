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
			$query = "INSERT INTO plantoes (idmedico, idConfiguracaoPlantao, idhospital, horasPlantao,  dataInicio, dataFim, idsubstituto, idConfiguracaoSubstituicaoPlantao,
			horasSubstituicaoPlantao, cor, statusPagamento, dataRepassePlantao, dataPagamentoPlantao, 
			valorPlantaoBruto, valorPlantaoLiquido, valorSubstituicaoPlantaoBruto, valorSubstituicaoPlantaoLiquido) VALUES ('$form[idmedico]', '$form[idConfiguracaoPlantao]','$form[idhospital]',
			('$form[horasPlantao]'-'$form[horasSubstituicaoPlantao]'), STR_TO_DATE('$form[dataInicio]', '%d/%m/%Y %H:%i:%s'), 
			STR_TO_DATE('$form[dataFim]', '%d/%m/%Y %H:%i:%s'),'$form[idsubstituto]', '$form[idConfiguracaoSubstituicaoPlantao]', '$form[horasSubstituicaoPlantao]', '$form[cor]', '$form[statusPagamento]', 
			STR_TO_DATE('$form[dataRepassePlantao]', '%d/%m/%Y'),  STR_TO_DATE('$form[dataPagamentoPlantao]', '%d/%m/%Y'), 
			(SELECT valorHoraPlantaoBruto * ('$form[horasPlantao]'-'$form[horasSubstituicaoPlantao]') FROM configuracaoplantoes WHERE idConfiguracaoPlantao='$form[idConfiguracaoPlantao]'),
			(SELECT valorHoraPlantaoLiquido * ('$form[horasPlantao]'-'$form[horasSubstituicaoPlantao]') FROM configuracaoplantoes WHERE idConfiguracaoPlantao='$form[idConfiguracaoPlantao]'),
			(SELECT (valorHoraPlantaoBruto * '$form[horasSubstituicaoPlantao]') FROM configuracaoplantoes WHERE idConfiguracaoPlantao='$form[idConfiguracaoPlantao]'),
			(SELECT (valorHoraPlantaoLiquido * '$form[horasSubstituicaoPlantao]') FROM configuracaoplantoes WHERE idConfiguracaoPlantao='$form[idConfiguracaoPlantao]'))";
		mysqli_query($mysql_conn, $query);
		} 
		else 
			{	
				if(!empty($form["idplantao"])) {
				$query	= "UPDATE plantoes SET idmedico='$form[idmedico]',
				idConfiguracaoPlantao='$form[idConfiguracaoPlantao]', 
				idhospital='$form[idhospital]',
				horasPlantao='$form[horasPlantao]',
				dataInicio=STR_TO_DATE('$form[dataInicio]', '%d/%m/%Y %H:%i:%s'), 
				dataFim=STR_TO_DATE('$form[dataFim]', '%d/%m/%Y %H:%i:%s'), 
				idsubstituto='$form[idsubstituto]',
				idConfiguracaoSubstituicaoPlantao='$form[idConfiguracaoSubstituicaoPlantao]',
				horasSubstituicaoPlantao='$form[horasSubstituicaoPlantao]',
				cor='$form[cor]',
				statusPagamento='$form[statusPagamento]',
				dataRepassePlantao=STR_TO_DATE('$form[dataRepasse]', '%d/%m/%Y'),
				dataPagamentoPlantao=STR_TO_DATE('$form[dataPagamento]', '%d/%m/%Y'),
				valorPlantaoBruto = (SELECT valorHoraPlantaoBruto * ('$form[horasPlantao]'-'$form[horasSubstituicaoPlantao]') FROM configuracaoplantoes WHERE idConfiguracaoPlantao='$form[idConfiguracaoPlantao]'),
				valorPlantaoLiquido = (SELECT valorHoraPlantaoLiquido * ('$form[horasPlantao]'-'$form[horasSubstituicaoPlantao]') FROM configuracaoplantoes WHERE idConfiguracaoPlantao='$form[idConfiguracaoPlantao]'),
				valorSubstituicaoPlantaoBruto = (SELECT (valorHoraPlantaoBruto * '$form[horasSubstituicaoPlantao]') FROM configuracaoplantoes WHERE idConfiguracaoPlantao='$form[idConfiguracaoPlantao]'),
				valorSubstituicaoPlantaoLiquido = (SELECT (valorHoraPlantaoLiquido * '$form[horasSubstituicaoPlantao]') FROM configuracaoplantoes WHERE idConfiguracaoPlantao='$form[idConfiguracaoPlantao]')
				where idplantao='$form[idplantao]'";	
				mysqli_query($mysql_conn,$query);
				header ('location: ./gerenciarPlantoes.php?add');
			}
		}		
	}		
	
	
?>