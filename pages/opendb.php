<?php
$hostname = 'localhost';
$username = 'root';
$password = '';

// conection with database
$mysql_conn	= mysqli_connect($hostname, $username, $password, 'cam');

if($mysql_conn == FALSE)
{
	echo("Unable to establish connection with the mysql server");
	exit;
}

?>