<?php

include '../opendb.php';
include_once('../func.php');

$id = $_GET["id"];
    mysqli_query($mysql_conn, "DELETE FROM hospital WHERE idhospital='$id'");
   header ('location: hospital.php');
?>