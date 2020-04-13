<?php
include 'opendb.php';
// session_start inicia a sessão
session_start();

error_reporting(E_ALL & ~E_NOTICE);
$user 		= $_POST["user"];	
$password 	= $_POST["password"];
$idempresa 	= $_POST["idempresa"];

// goes back to login page if no data were found
if (($user=='') || ($password=='')) 
{
	header('location: login.php');
}
else if ($user && $password)
{
	// verify if the user and password are corrects
	$queryUser = mysqli_query($mysql_conn,"SELECT * FROM usuarios WHERE login='$user' AND senha='$password' AND idempresa='$idempresa'");
	
	// if the data is correct, proceed	
	if (mysqli_num_rows($queryUser) > 0) 
	{
		$auth = mysqli_fetch_array($queryUser);
		$_SESSION['user'] = $auth['idusuario'];
		$_SESSION['idempresa'] = $auth['idempresa'];
		$_SESSION['idfuncao'] = $auth['idfuncao'];

		mysqli_free_result($queryUser);
		header('location: ./gerencial/dashboard.php' );
	}
	else
		{
		unset ($_SESSION['user']);
		unset ($_SESSION['password']);
		unset ($_SESSION['idempresa']);
	
		header('location: login.php');	
		
	}	
	echo "<script>alert('Usuario ou senha incorretos!');</script>";
}
 
?>

