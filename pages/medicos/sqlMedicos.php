<?php

include '../opendb.php';
include_once('../func.php');
	
$form = $_POST;
if (empty ($form["id"])){	
	$query	= "INSERT INTO medicos (nome, rg, cpf, crm, especialidade, email, ufCrm, nomeCompleto) VALUES ('$form[nome]', '$form[rg]', '$form[cpf]', '$form[crm]', '$form[especialidade]', '$form[email]', '$form[ufCrm]', '$form[nomeCompleto]')";
	mysqli_query($mysql_conn,$query);
    header ('location: medicos.php');
}
else {
	if(!empty($form["id"])) {
		print_r($form);
	$query	= "UPDATE medicos SET nome='$form[nome]', rg='$form[rg]', cpf='$form[cpf]', crm='$form[crm]', especialidade='$form[especialidade]', email='$form[email]', ufCrm='$form[ufCrm]', nomeCompleto='$form[nomeCompleto]' WHERE idmedico='$form[id]'";	
	mysqli_query($mysql_conn,$query);
	header('location: medicos.php' );
	}
}	
	
?>