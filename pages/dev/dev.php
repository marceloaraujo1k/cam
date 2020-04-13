<?php
$diasemana = array("Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado");

// Data inicial
$query_date = '2020-02-01';

$source_date = strtotime($query_date);
$dat_ini = new DateTime(date('Y-m-01', $source_date));
$dat_fin = new DateTime(date('Y-m-t', $source_date));

$NumeroSemanas = (int)$dat_fin->format('W') - (int)$dat_ini->format('W') + 1;

$diaAtual = $dat_ini->format('d');
echo $diaAtual." <br>";

$dat_fin = $dat_fin->format('d');

//for ($j=1; $j<=$dat_fin; $j++) {
    for ($i=0; $i<$dat_fin; $i++) { 
       // $source_date = strtotime($query_date);
       $dat_atual = new DateTime(date('d-m-Y', $source_date));
       $dat_atual->modify('+'.$i.' day');  
       $diasemanaAtual =  $dat_atual->format('w');
       
       if ($diasemanaAtual == $i) {
            echo $dat_atual->format('d-m-Y').' '.$diasemana[$diasemanaAtual]." <br>"; 
       }

    }
 
 //echo $dat_ini->format('W'."<br>");
//echo $diasemana[$dat_ini->format('w')];

//echo $dat_fin->format('W'."<br>");

//echo $NumeroSemanas;

?>

