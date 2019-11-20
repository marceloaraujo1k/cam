<?php

include '../opendb.php';
include_once('../func.php');
	
$form = $_POST;
if (empty ($form["id"])){	
	$query	= "INSERT INTO hospital (hospital, cnpj, endereco) VALUES ('$form[hospital]', '$form[cnpj]', '$form[endereco]')";
	mysqli_query($mysql_conn,$query);
    header ('location: hospital.php');
}
else {
	if(!empty($form["id"])) {
		print_r($form);
	$query	= "UPDATE hospital SET hospital='$form[hospital]', cnpj='$form[cnpj]', endereco='$form[endereco]' WHERE idhospital='$form[id]'";	
	mysqli_query($mysql_conn,$query);
	header('location: hospital.php' );
	}
}	
	
?>