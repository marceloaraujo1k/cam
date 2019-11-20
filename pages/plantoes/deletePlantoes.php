<?php

include '../opendb.php';
include_once('../func.php');

$id = $_GET["id"];
    mysqli_query($mysql_conn, "DELETE FROM plantoes WHERE idplantao='$id'");
    header ('location: gerenciarPlantoes.php?add')
?>