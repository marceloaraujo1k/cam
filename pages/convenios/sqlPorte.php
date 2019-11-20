<?php

include '../opendb.php';
include_once('../func.php');
$form = $_POST;

if (empty($form["idporte"])){	
		global $mysql_conn;
		if(!empty($_POST["descricao"])) {
			
		$query	= "INSERT INTO porte (idporte, idconvenio, descricao, valor,data) VALUES (null, '$form[id]', '$form[descricao]', '$form[valor]', current_date())";
		mysqli_query($mysql_conn,$query);
		header('location: porte.php?id='.$form['id']);
	}
}
else {
	if(!empty($form["idporte"])) {
		$query	= "UPDATE porte SET descricao='$form[descricao]', valor='$form[valor]', data=current_date() WHERE idporte='$form[idporte]'";	
		mysqli_query($mysql_conn,$query);
		header('location: porte.php?id='.$form['id']);
	}
}


?>