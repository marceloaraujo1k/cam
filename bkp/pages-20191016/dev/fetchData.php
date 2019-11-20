<?php 

include "config.php";

if(isset($_POST['search'])){
    $search = $_POST['search'];

    $query = "SELECT * FROM pacientes WHERE nome like'%".$search."%'";
    $result = mysqli_query($con,$query);
    
    while($row = mysqli_fetch_array($result) ){
        $response[] = array("label"=>$row['nome'],"value"=>$row['idpaciente']);
    }

    echo json_encode($response);
}

exit;


