<?php

include '../opendb.php';
include_once('../func.php');



ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);


if(isset($_REQUEST['submit'])){

	switch($_REQUEST['submit']){
			case 'inserir':
			inserir();
			break;
		case 'alterar':
			alterar();
			break;
		case 'deletar':
			deletar();
			break;
	}
}	



function inserir() {
		global $mysql_conn;
		if(!empty($_POST["descricao"])) {
		$form = $_POST;
		print_r($form);
		$query	= "INSERT INTO convenio (idconvenio, codigo, cnpj, descricao, endereco, bairro, municipio, 
										estado, complemento, cep, telefone, celular, email, login, senhaweb, prazoPagto, pis, cofins, csll, irpj,
										iss, deducoes, aliquota, outros_encargos, classificacao, observacoes) VALUES  (null, '$form[codigo]', '$form[cnpj]', '$form[descricao]',
										'$form[endereco]', '$form[bairro]', '$form[municipio]', '$form[estado]', '$form[complemento]', '$form[cep]', '$form[telefone]',
										'$form[celular]', '$form[email]', '$form[login]', '$form[senhaweb]', '$form[prazoPagto]',
										'$form[pis]' , '$form[cofins]' , '$form[csll]' , '$form[irpj]',
										'$form[iss]',  '$form[deducoes]',  '$form[aliquota]', '$form[outros_encargos]', '$form[classificacao]', '$form[observacoes]' )";
		mysqli_query($mysql_conn,$query);
		header('location: convenios.php' );
	}
}				
		
function alterar() 
{
	global $mysql_conn;
	if(!empty($_POST["descricao"])) {
		$form = $_POST;
		print_r($form);
		
		$query	= "UPDATE convenio SET codigo='$form[codigo]', cnpj='$form[cnpj]', descricao='$form[descricao]',
				endereco='$form[endereco]', bairro='$form[bairro]', municipio='$form[municipio]', estado='$form[estado]',
				complemento='$form[complemento]', cep='$form[cep]', telefone='$form[telefone]', celular='$form[celular]',
				email='$form[email]', login='$form[login]', senhaweb='$form[senhaweb]', prazoPagto='$form[prazoPagto]',
				pis='$form[pis]', cofins='$form[cofins]', csll='$form[csll]', irpj='$form[irpj]', iss='$form[iss]',
			   	deducoes='$form[deducoes]', aliquota='$form[aliquota]',	outros_encargos='$form[outros_encargos]',
				classificacao='$form[classificacao]',observacoes='$form[observacoes]' 
				WHERE idconvenio='$form[idconvenio]'";
		mysqli_query($mysql_conn,$query);
		header('location: convenios.php' );
	
	}
}

function deletar() 
{					
}
	
?>