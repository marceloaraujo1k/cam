<?php		
	$keyword = strval($_POST['query']);
	$search_param = "%{$keyword}%";
	$conn =new mysqli('localhost', 'root', '' , 'cam');

	$sql = $conn->prepare("SELECT * FROM pacientes WHERE nome LIKE ?");
	$sql->bind_param("s",$search_param);			
	$sql->execute();
	$result = $sql->get_result();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
		    $response[] = array($row['nome']);
		}
		echo json_encode($response);
	}
	$conn->close();
?>

