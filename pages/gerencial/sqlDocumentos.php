<?php

include '../opendb.php';
include_once('../func.php');
	
$uploaddir = '../documentos/administrativos/';

$uploadfile = $uploaddir . $_FILES['userfile']['name'];

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)){
	
	echo "Arquivo Enviado";
	}
else {
	echo "Arquivo não enviado";
}		
	
	$form = $_POST;	  
	print_r($form);
	$query	= "INSERT INTO documentos (iddocumentos, descricao, arquivo, data) VALUES (null, '$form[descricao]','$uploadfile', STR_TO_DATE('$form[dataInicio]', '%Y-%m-%d 00:00:00'))";
	var_dump($query);
	mysqli_query($mysql_conn,$query);
	$id = $form["id"];
    header ('location: documentos.php');
	
?>