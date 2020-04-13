<?php
 // Array com os dias da semana
$diasemana = array("Domingo", "Segunda", "Terça", "Quarta");

$datas = new DateTime();
$query_date = '2010-02-04';

$source_date = strtotime($query_date);

$dat_ini = new DateTime(date('Y-m-01', $source_date));
$dat_fin = new DateTime(date('Y-m-t', $source_date));


echo $dat_fin->format('W');

$NumeroSemanas = (int)$dat_fin->format('W') - (int)$dat_ini->format('W') + 1;
echo $NumeroSemanas;

 // Aqui podemos usar a data atual ou qualquer outra data no formato Ano-mês-dia (2014-02-28)
 $data = date('2020-03-31');

 // Varivel que recebe o dia da semana (0 = Domingo, 1 = Segunda ...)
 $diasemana_numero = date('w', strtotime($data));

 // Exibe o dia da semana com o Array
 echo $diasemana[$diasemana_numero];
?>

