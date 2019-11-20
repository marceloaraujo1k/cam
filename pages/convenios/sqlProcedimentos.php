<?php

include '../opendb.php';
include_once('../func.php');
$form = $_POST;

if (empty($form["idprocedimentos"])){	
		global $mysql_conn;
		if(!empty($_POST["descricao"])) {
			print_r($form);
		$query	= "INSERT INTO procedimentos (idprocedimentos, idconvenio, idporte, codigo, descricao) VALUES (null, '$form[id]', '$form[idporte]',  '$form[codigo]', '$form[descricao]')";
		mysqli_query($mysql_conn,$query);
	 	header('location: procedimentos.php?id='.$form['id']);
	}
}
else {
	if(!empty($form["idprocedimentos"])) {
		$query	= "UPDATE procedimentos SET descricao='$form[descricao]' WHERE idprocedimentos='$form[idprocedimentos]'";	
		mysqli_query($mysql_conn,$query);
		header('location: procedimentos.php?id='.$form['id']);
	}
}


?>