<?php

include '../opendb.php';
include_once('../func.php');
	
$form = $_POST;
if (empty ($form["id"])){	
	$query	= "INSERT INTO configuracaoplantoes (idConfiguracaoPlantao, descricaoPlantao, idhospital, horarioInicioPlantao, 
    horarioFimPlantao, duracaoPlantao, legendaPlantao, valorPlantao, valorHoraPlantaoBruto,
    valorHoraPlantaoLiquido, pis, cofins, csll, irpj, iss, deducoes, aliquota, outros_encargos, cor)
     VALUES (null, '$form[descricaoPlantao]', '$form[idhospital]', '$form[horarioInicioPlantao]', '$form[horarioFimPlantao]', '$form[duracaoPlantao]',
      '$form[legendaPlantao]', '$form[valorPlantao]', '$form[valorHoraPlantaoBruto]', '$form[valorHoraPlantaoLiquido]', '$form[pis]', '$form[cofins]',
      '$form[csll]', '$form[irpj]', '$form[iss]', '$form[deducoes]', '$form[aliquota]', '$form[outros_encargos]', '$form[cor]')";
	mysqli_query($mysql_conn,$query);
    header ('location: configuracoes.php');
}
else {
	if(!empty($form["id"])) {
	$query	= "UPDATE configuracaoplantoes SET descricaoPlantao='$form[descricaoPlantao]', idhospital='$form[idhospital]', horarioInicioPlantao='$form[horarioInicioPlantao]', 
	horarioFimPlantao='$form[horarioFimPlantao]', duracaoPlantao='$form[duracaoPlantao]', legendaPlantao='$form[legendaPlantao]',
	valorPlantao='$form[valorPlantao]', valorHoraPlantaoBruto='$form[valorHoraPlantaoBruto]', valorHoraPlantaoLiquido='$form[valorHoraPlantaoLiquido]',
	pis='$form[pis]', cofins='$form[cofins]', csll='$form[csll]',  irpj='$form[irpj]', iss='$form[iss]', deducoes='$form[deducoes]',
	aliquota='$form[aliquota]', outros_encargos='$form[outros_encargos]', cor='$form[cor]' WHERE idConfiguracaoPlantao='$form[id]'";	
	mysqli_query($mysql_conn,$query);
	header('location: configuracoes.php' );
	}
}	
	
?>