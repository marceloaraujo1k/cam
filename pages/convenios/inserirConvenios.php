<?php
/*  CADASTRO DE CONVENIO 
*/
 
session_start();
include '../opendb.php';

include_once('../func.php');


$form=null;

if(isset($_GET["edit"]))
					{
						$id = $_GET["id"];
						$query = mysqli_query($mysql_conn, "SELECT * FROM convenio WHERE idconvenio='$id'");
						$row = mysqli_fetch_assoc($query);
						$form = $row;
						
			}		

$convenios = getItensTable($mysql_conn,"convenio");
$sexo = array("","MASCULINO","FEMININO");
$estado_civil = array("","SOLTEIRO(A)","CASADO(A)","SEPARADO(A)","DIVORCIADO(A)","VÍUVO(A)");
$estados = array("","ACRE","ALAGOAS","AMAPÁ","AMAZONAS","BAHIA","CEARÁ","DISTRITO FEDERAL","ESPIRITO SANTO","GOIÁS",
				"MARANHÃO","MATO GROSSO DO SUL","MATO GROSSO","MINAS GERAIS","PARÁ","PARAÍBA","PARANÁ","PERNAMBUCO",
				"PIAUÍ","RIO DE JANEIRO","RIO GRANDE DO NORTE","RIO GRANDE DO SUL","RONDÔNIA","RORAIMA","SANTA CATARINA",
				"SÃO PAULO","SERGIPE","TOCANTINS");
$classificacao = array("","PLANO DE SAÚDE","SUS","ELETIVAS","PARTICULAR");				
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap Core CSS -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

   <div id="wrapper">

    <!-- Navigation -->
    <!-- INCLUSÃO DO ARQUIVO MENU -->
		<?php include_once('../menu.php'); ?>

		<div id="page-wrapper">
		       <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Convênio</h1>
                </div>
                <!-- /.col-lg-12 -->
				</div>
		
		          <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Convênio
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						
						<!-- informacoes do paciente -->
                        <form role="form" action="./sqlConvenios.php" method='post'>
						<div class="row">
						<input type="hidden" name="idconvenio" value="<?=$form["idconvenio"]?>"> 
											
						<div class="form-group col-md-2">
							  <label for="inputCity">Código</label>
							 <input class="form-control" name="codigo" value="<?=$form["codigo"]?>">
						</div>
						
						<div class="form-group col-md-2">
							  <label for="inputCity">CNPJ</label>
							 <input type="text" class="form-control" name="cnpj" value="<?=$form["cnpj"]?>">
							</div>
						<div class="form-group col-md-3">
							  <label for="inputCity">Descrição</label>
							 <input class="form-control" name="descricao" value="<?=$form["descricao"]?>">
							</div>

						<div class="form-group col-md-2">
							  <label for="inputRegistroANS">Registro ANS</label>
							 <input class="form-control" name="codigo" value="<?=$form["codigo"]?>">
						</div>
						
						</div>
								
						<div class="row">
						   <div class="form-group col-md-3">
							  <label for="inputCity">Endereço</label>
							 <input class="form-control" name="endereco" value="<?=$form["endereco"]?>">
							</div>
							 <div class="form-group col-md-2">
							  <label for="inputCity">Bairro</label> 
							  <input class="form-control" name="bairro" value="<?=$form["bairro"]?>">
							</div>
						    <div class="form-group col-md-2">
							  <label for="inputCity">Munícipio</label>
							  <input class="form-control" name="municipio" value="<?=$form["municipio"]?>">
							</div>
						
						<div class="form-group col-md-2">
							  <label for="inputEstado">Estado</label>
							  <select id="inputEstado"  name="estado" class="form-control">
									<?php
									for($i=0; $i<count($estados); $i++)
									{		
									if($form["estado"] == $estados[$i])
									{
									?>
									<option value="<?=$estados[$i]?>" selected><?=$estados[$i]?></option>
									<?php
									}
									else
									{
									?>
									<option value="<?=$estados[$i]?>"><?=$estados[$i]?></option>
									<?php
									}
									}
									?>		
							</select>
							</div>
								
					</div>
					<div class="row"> 
							<div class="form-group col-md-3">
								<label for="inputCity">Complemento</label>
								<input class="form-control" name="complemento" value="<?=$form["complemento"]?>">
							</div>
							<div class="form-group col-md-2">
							  <label for="inputCEP">CEP</label>
							 <input class="form-control" name="cep" value="<?=$form["cep"]?>">
							</div>
						
								<div class="form-group col-md-2">
									<label for="inputCEP">Telefone</label>
									<input class="form-control" name="telefone" value="<?=$form["telefone"]?>">
								</div>
							
								<div class="form-group col-md-2">
									<label for="inputCEP">Celular</label>
									<input class="form-control" name="celular" value="<?=$form["celular"]?>">	
							</div>
							
					</div>
						
					<div class="row"> 	
		
						<div class="form-group col-md-3">
									<label for="inputCEP">Email</label>
									<input class="form-control" name="email" value="<?=$form["email"]?>">	
							</div>
						 <div class="form-group col-md-2">
							  <label for="inputCity">Login</label>
							 <input class="form-control" name="login" value="<?=$form["login"]?>">
							</div>
							
						
						 <div class="form-group col-md-2">
							  <label for="inputCity">Senha</label>
							 <input class="form-control" name="senhaweb" value="<?=$form["senhaweb"]?>">
							</div>
						
						<div class="form-group col-md-2">
							  <label for="data_cadastro">Prazo pagto.</label>
							 <input class="form-control" name="prazoPagto" value="<?=$form["prazoPagto"]?>">
						</div>

					</div>
					
					<div class="row"> 
							<div class="form-group col-md-1">
								<label for="inputPIS">PIS</label>
								<input class="form-control" name="pis" id="pis" value="<?=$form["pis"]?>">
							</div>
							<div class="form-group col-md-1">
							  <label for="inputCOFINS">COFINS</label>
							 <input class="form-control" name="cofins" id="cofins" value="<?=$form["cofins"]?>">
							</div>
						
								<div class="form-group col-md-1">
									<label for="inputCEP">CSLL</label>
									<input class="form-control" name="csll" id="csll" value="<?=$form["csll"]?>">
								</div>
							
								<div class="form-group col-md-1">
									<label for="inputCEP">IRPJ</label>
									<input class="form-control" name="irpj" id="irpj" value="<?=$form["irpj"]?>">	
							</div>
							
							
								<div class="form-group col-md-1">
									<label for="inputCEP">ISS</label>
									<input class="form-control" name="iss" value="<?=$form["iss"]?>">	
							</div>
							
							
							<div class="form-group col-md-1">
									<label for="inputCEP">Alíquota</label>
									<input class="form-control" name="aliquota" id="aliquota" value="<?=$form["aliquota"]?>">	
							</div>
							
							<div class="form-group col-md-1">
									<label for="inputCEP">Deduções</label>
									<input class="form-control" name="deducoes" id="deducoes" value="<?=$form["deducoes"]?>">	
							</div>
							
							<div class="form-group col-md-1">
									<label for="inputCEP">Outros Encargos</label>
									<input class="form-control" name="outros_encargos" id="outros_encargos" value="<?=$form["outros_encargos"]?>">	
							</div>
							<div class="form-group col-md-1">
							  <label for="inputEstado">Classificação</label>
							  <select id="inputEstado"  name="classificacao" class="form-control">
									<?php
									for($i=0; $i<count($classificacao); $i++)
									{		
									if($form["classificacao"] == $classificacao[$i])
									{
									?>
									<option value="<?=$classificacao[$i]?>" selected><?=$classificacao[$i]?></option>
									<?php
									}
									else
									{
									?>
									<option value="<?=$classificacao[$i]?>"><?=$classificacao[$i]?></option>
									<?php
									}
									}
									?>		
							</select>
						</div>
					</div>
						
					<div class="row">
						   <div class="form-group col-md-9">
                                <label>Observações</label>
                                <textarea class="form-control" name="observacoes" rows="2" ><?=$form["observacoes"]?></textarea>
                            </div>
					</div>
						
						 <div class="row"> 
							<div class="form-group col-md-6">
								<input type="submit" name="submit" value="alterar" class="btn btn-success" />
								<input type="submit" name="submit" value="inserir" class="btn btn-success" />
							</div>				
						</div>
					</form>
						</div>
                       
                        </div>
                        <!-- /.panel-body -->
                    </div>
		
		            <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			 <!-- /.row -->
            
			
        </div>
        <!-- /#page-wrapper -->

 
    <!-- /#wrapper -->

	
    <!-- jQuery -->
    <script src="../../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
	
</body>

</html>
