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
		
  
  
  /*LOAD DATA INFILE 'C:/temp/receipt.dat'    
    INTO TABLE mbc.receipts
    FIELDS
        TERMINATED BY X'1F'
    LINES
        TERMINATED BY X'1E'
    (@var1,@var2,@var3,amount,notes)
    SET receiptDate = STR_TO_DATE(@var1,'%m/%d/%Y'),
    addressId = (select max(id) from addresses where name = @var2),
    designationId = (select max(id) from designations where name = @var3); */