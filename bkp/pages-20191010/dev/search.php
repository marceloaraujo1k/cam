<?php
include '../opendb.php';
include_once('../func.php');

if(isset($_POST['search'])){
 $search = $_POST['search'];

 $query = "SELECT * FROM pacientes WHERE nome like'%".$search."%'";
 $result = mysqli_query($mysql_conn,$query);

 $response = array();
 while($row = mysqli_fetch_array($result) ){
   $response[] = array("value"=>$row['idpaciente'],"label"=>$row['nome']);
 }

 echo json_encode($response);
}

exit;