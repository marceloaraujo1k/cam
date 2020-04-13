<?php
ini_set('MAX_EXECUTION_TIME', 3600);
session_start();
include '../../opendb.php';


/*
LOAD DATA INFILE 'c:/dev/testeReduce.txt'  INTO TABLE tabteste
CHARACTER SET UTF8 
FIELDS TERMINATED BY ';'  ENCLOSED BY ''
  LINES TERMINATED BY '\n' 
  IGNORE 1 LINES
 (@dataRealizacao, @paciente) 
  SET   dataRealizacao = STR_TO_DATE(@dataRealizacao, '%d/%m/%Y %H:%i:%s'),
  		idempresa = 4,
		paciente = @paciente,
        idpaciente = (select idpaciente from pacientes where nome = @paciente);


        LOAD DATA INFILE 'c:/dev/testeReduce.txt'  INTO TABLE tabteste
CHARACTER SET UTF8 
FIELDS TERMINATED BY ';'  ENCLOSED BY ''
  LINES TERMINATED BY '\n' 
  IGNORE 1 LINES
 (@dataRealizacao, @paciente) 
  SET   dataRealizacao = STR_TO_DATE(@dataRealizacao, '%d/%m/%Y %H:%i:%s'),
  		idempresa = 4,
		paciente = @paciente,
		idpaciente = (select idpaciente from pacientes where nome = @paciente);
   */
  
  // $nome = "SUS-CSV-20191122.csv";
  // $nome = "PARTICULAR-CSV-20191122.csv";
  // $nome = "SUS-CSV-20200123.csv";
  // $nome = "PARTICULAR-CSV-20200123.csv";
   $nome = "ELETIVAS-CSV-20200123.csv";


 $objeto = fopen($nome, 'r');
 while(($dados = fgetcsv($objeto , 100000, ";","'")) !== FALSE){
  set_time_limit(0);
  
  #Instruções    
  #Buscar Nomes Duplicados
  //SELECT nome,COUNT(nome) FROM pacientes GROUP BY nome HAVING COUNT(nome) >1
 # Deletar todos os nomes duplicados
//DELETE t1 FROM pacientes t1, pacientes t2 WHERE t1.idpaciente < t2.idpaciente AND t1.nome = t2.nome     

#Inserir um nome duplicado
//INSERT IGNORE INTO pacientes (nome) VALUES ("Fulano"),("Maria")("Mariana");


     /**************************** INSERIR PRODUÇÃO CONVENIO 

     $sql1 = "INSERT IGNORE INTO pacientes (nome) VALUES ('$dados[1]')";
s

     $sql2 = "INSERT IGNORE INTO producao (idempresa, dataRealizacao,idpaciente, idmedico, paciente, 
    carteiraPaciente, medico,idconvenio, convenio, 
    hospital,codigoProcedimento, descricaoProcedimento, valorProcedimento, 
    quantidade, adicional, redutor,valorRecebido, glosa, saldo, dataPagamento, dataCobranca,dataRepasse, statusPagamento) 
    VALUES (99, STR_TO_DATE('$dados[0]', '%m/%d/%Y %H:%i:%s'), (SELECT idpaciente FROM pacientes WHERE nome='$dados[1]' LIMIT 1),
    (SELECT idmedico FROM medicos WHERE nome='$dados[4]' LIMIT 1),
    '$dados[1]', '$dados[2]', '$dados[4]', (SELECT idconvenio FROM convenio WHERE descricao='$dados[6]' LIMIT 1), '$dados[6]', '$dados[8]', '$dados[9]', '$dados[10]', '$dados[14]',
    '$dados[11]',REPLACE('$dados[12]', '%' ,'') , REPLACE('$dados[13]', '%' ,''),'$dados[15]','$dados[20]', '$dados[15]-$dados[20]', STR_TO_DATE('$dados[18]', '%m/%d/%Y %H:%i:%s'), 
    STR_TO_DATE('$dados[16]', '%m/%d/%Y %H:%i:%s'),STR_TO_DATE('$dados[19]', '%m/%d/%Y %H:%i:%s'), '$dados[21]')";
    */
    
  
     /********************************************************** INSERIR PRODUÇÃO SUS  ************************************** */

   /*$sql1 = "INSERT IGNORE INTO pacientes (nome) VALUES ('$dados[6]')";
    mysqli_query($mysql_conn, $sql1) or die(mysqli_error($mysql_conn));  */
           
  /*
    $sql2 = "INSERT IGNORE INTO producao (idempresa, dataRealizacao,idpaciente, idmedico, paciente, 
    carteiraPaciente, medico,idconvenio, convenio, 
    hospital,codigoProcedimento, descricaoProcedimento, valorProcedimento, 
    quantidade, adicional, redutor,valorRecebido, glosa, saldo, dataPagamento, dataCobranca,dataRepasse, statusPagamento, observacao, dataFatura) 
    VALUES (99, STR_TO_DATE('$dados[5]', '%d/%m/%Y %H:%i:%s'), (SELECT idpaciente FROM pacientes WHERE nome='$dados[6]' LIMIT 1),
    (SELECT idmedico FROM medicos WHERE nome='$dados[8]' LIMIT 1),
    '$dados[6]', null, '$dados[8]', (SELECT idconvenio FROM convenio WHERE descricao='SUS - SISTEMA ÚNICO DE SAÚDE' LIMIT 1), 
    'SUS - SISTEMA ÚNICO DE SAÚDE',
    '$dados[10]', '$dados[11]', '$dados[12]', REPLACE(REPLACE(REPLACE ('$dados[15]', 'R$', ''), '.', ''), ',', '.'), null, 
    REPLACE('$dados[14]', '%' ,'') , REPLACE('$dados[13]', '%' ,''), REPLACE(REPLACE(REPLACE ('$dados[16]', 'R$', ''), '.', ''), ',', '.'), REPLACE(REPLACE(REPLACE ('$dados[21]', 'R$', ''), '.', ''), ',', '.'), '$dados[16]'-'$dados[15]',
    STR_TO_DATE('$dados[19]', '%d/%m/%Y %H:%i:%s'), STR_TO_DATE('$dados[18]', '%d/%m/%Y %H:%i:%s'), STR_TO_DATE('$dados[20]', '%d/%m/%Y %H:%i:%s'), '$dados[22]', '$dados[23]', '$dados[24]')";
    
    mysqli_query($mysql_conn, $sql2) or die(mysqli_error($mysql_conn));   */
      
      
    /********************************************************** INSERIR PRODUÇÃO PARTICULAR ***********************************/

   /* $sql1 = "INSERT IGNORE INTO pacientes (nome) VALUES ('$dados[4]')";
    mysqli_query($mysql_conn, $sql1) or die(mysqli_error($mysql_conn)); */
           
  
 /* $sql2 = "INSERT IGNORE INTO producao (idempresa, dataRealizacao,idpaciente, idmedico, paciente, 
               medico,idconvenio, convenio, hospital, descricaoProcedimento, valorProcedimento, 
               valorRecebido,  dataPagamento, dataRepasse, statusPagamento, notaFiscal, observacao) 
          VALUES (99, STR_TO_DATE('$dados[2]', '%d/%m/%Y %H:%i:%s'), (SELECT idpaciente FROM pacientes WHERE nome='$dados[4]' LIMIT 1), (SELECT idmedico FROM medicos WHERE nome='$dados[6]' LIMIT 1),'$dados[4]',
          '$dados[6]', (SELECT idconvenio FROM convenio WHERE descricao='PARTICULAR CAM' LIMIT 1),  'PARTICULAR CAM', '$dados[12]', '$dados[7]',
          REPLACE(REPLACE(REPLACE ('$dados[8]', 'R$', ''), '.', ''), ',', '.'), REPLACE(REPLACE(REPLACE ('$dados[8]', 'R$', ''), '.', ''), ',', '.'),
           STR_TO_DATE('$dados[2]', '%d/%m/%Y %H:%i:%s'), STR_TO_DATE('$dados[2]', '%d/%m/%Y %H:%i:%s'),  null,  '$dados[3]', '$dados[9]')"; 
   echo $sql2 ."<br>";

  mysqli_query($mysql_conn, $sql2) or die(mysqli_error($mysql_conn));
 */
  
     
   
     /********************************************************** INSERIR PRODUÇÃO ELETIVAS ***************************************************************************/

/*   $sql1 = "INSERT IGNORE INTO pacientes (nome) VALUES ('$dados[7]')";
    mysqli_query($mysql_conn, $sql1) or die(mysqli_error($mysql_conn));  */
             
 $sql2 = "INSERT IGNORE INTO producao (idempresa, dataRealizacao,idpaciente, idmedico, paciente, 
  medico,idconvenio, convenio, hospital, descricaoProcedimento, valorProcedimento, 
  valorRecebido, dataPagamento, dataRepasse, statusPagamento, medicoCirurgiao)
  VALUES (99, STR_TO_DATE('$dados[6]', '%d/%m/%Y %H:%i:%s'), (SELECT idpaciente FROM pacientes WHERE nome='$dados[7]' LIMIT 1), (SELECT idmedico FROM medicos WHERE nome='$dados[10]' LIMIT 1), '$dados[7]',
  '$dados[10]', (SELECT idconvenio FROM convenio WHERE descricao='$dados[12]' LIMIT 1),  '$dados[12]', '$dados[12]', '$dados[14]', REPLACE(REPLACE(REPLACE ('$dados[15]', 'R$', ''), '.', ''), ',', '.'),
  (IF(STRCMP('$dados[17]', 'PAGO')=0, REPLACE(REPLACE(REPLACE('$dados[15]', 'R$', ''), '.', ''), ',', '.'), 0.00 )), STR_TO_DATE('$dados[16]', '%d/%m/%Y %H:%i:%s'),
  STR_TO_DATE('$dados[16]', '%d/%m/%Y %H:%i:%s'), '$dados[17]', '$dados[8]')";  

  mysqli_query($mysql_conn, $sql2) or die(mysqli_error($mysql_conn));  


  // **********************************************************

  // **********************************************************
   // IMPRIMIR O ARRRAY LIDO DO ARQUIVO CSV
        echo '<pre>';
        print_r($dados);
        echo '</pre>';
   // **********************************************************       
        //SELECT LAST_INSERT_ID()
        //$lastid= mysqli_insert_id($mysql_conn);
 }

 fclose($objeto);
 echo "Processo Finalizado";
?>