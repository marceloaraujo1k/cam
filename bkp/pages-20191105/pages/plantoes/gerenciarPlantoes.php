<?php
session_start();
include '../opendb.php';

include_once('../func.php');

$form=null;

if(isset($_GET["add"]))
					{
						//$id = $_GET["id"];
						$query = mysqli_query($mysql_conn, "SELECT * FROM plantoes");
						$row = mysqli_fetch_assoc($query);
						$form = $row;
						$hospital = getItensTable($mysql_conn,"hospital");
						$medicos = getItensTable($mysql_conn,"medicos");
						$configuracaoplantoes = getItensTable ($mysql_conn, "configuracaoplantoes");
			}
if(isset($_GET["edit"]))
					{
						$id = $_GET["id"];
						$query = mysqli_query($mysql_conn, "SELECT * FROM plantoes WHERE idplantao='$id'");
						$row = mysqli_fetch_assoc($query);
						$form = $row;
						$hospital = getItensTable($mysql_conn,"hospital");
						$medicos = getItensTable($mysql_conn,"medicos");
						$configuracaoplantoes = getItensTable ($mysql_conn, "configuracaoplantoes");
					}
			
				
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>CAM</title>

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
                    <h1 class="page-header">Gerenciamento Plantões</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
		    <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Plantões
                        </div>
                       <!-- /.panel-heading -->
						<div class="panel-body">
						<!-- informacoes do paciente -->
						<form role="form" id="formPlantao" method="post">
						<div class="row">
						<input type="hidden" name="idplantao" value="<?=$form["idplantao"]?>"> 
						<input type="hidden" id="idhospital" name="idhospital" value="<?=$form["idhospital"]?>"> 
					
					
							<div class="form-group col-md-2">
									<label for="convenio">Médico</label>
									<select id="idmedico" name="idmedico" class="form-control">
											<option value=""></option>
											<?php
											for($i=0; $i<count($medicos); $i++)
											{
											if($form["idmedico"] == $medicos[$i]['idmedico'])
											{	
											?>
											<option value="<?=$medicos[$i]['idmedico']?>"><?=$medicos[$i]['nome']?></option>
											<?php
											}
											else
											{
											?>
											<option value="<?=$medicos[$i]['idmedico']?>" ><?=$medicos[$i]['nome']?></option>
											<?php
											}
											}
											?>
									</select>
							</div>
							<div class="form-group col-md-2"> 
									<label class="control-label">Início Plantão</label>
									<div class='input-group date' id="dataInicioPlantao" required>
											 <input type='text' id="dataInicio"  name="dataInicioPlantao" class="form-control"/>
											 <span class="input-group-addon">
											 <span class="glyphicon glyphicon-calendar"></span>
											 </span>
										  </div>
									</div> 
						<div class="form-group col-md-3">
							  <label for="inputEstado">Tipo Plantão</label>
								<select id="configPlantao" name="configuracaoplantoes" class="form-control" onchange="tipoPlantao()"> 
									<option value=0>  </option>
									<?php
											for($i=0; $i<count($configuracaoplantoes); $i++)
											{
											if($form["idConfiguracaoPlantao"] == $configuracaoplantoes[$i]['idConfiguracaoPlantao'])
											{	
											?>
											<option value="<?=$configuracaoplantoes[$i]['idConfiguracaoPlantao']?>"><?=$configuracaoplantoes[$i]['descricaoPlantao']?></option>
											<?php
											
											}
											else
											{
											?>
											<option value="<?=$configuracaoplantoes[$i]['idConfiguracaoPlantao']?>" ><?=$configuracaoplantoes[$i]['descricaoPlantao']?></option>
										<?php
											}
											}
										?>
								</select>
						</div>
						<div class="form-group col-md-2">
										<label for="convenio">Médico Substituto</label>
											<select id="idsubstituto" name="idsubstituto" class="form-control">
											<option value=""></option>
											<?php
											for($i=0; $i<count($medicos); $i++)
											{
											if($form["idsubstituto"] == $medicos[$i]['idmedico'])
											{	
											?>
											<option value="<?=$medicos[$i]['idmedico']?>"><?=$medicos[$i]['nome']?></option>
											<?php
											}
											else
											{
											?>
											<option value="<?=$medicos[$i]['idmedico']?>" ><?=$medicos[$i]['nome']?></option>
											<?php
											}
											}
											?>
										</select>
								</div>
								<div class="form-group col-md-2"> 
									<label class="control-label">Horas(subs.)</label>
									<select id="horasSubstituicaoPlantao" name="horasSubstituicaoPlantao" class="form-control"> 
											<option value="0"></option> 
											<option value="6">Manhã 6 horas</option> 
											<option value="6">Tarde 6 horas</option> 
											<option value="12">Dia 12 horas</option> 
											<option value="12">Noite 12 horas</option>
											<option value="24">24 horas</option>
									</select>
								</div>
						
						
							</div>
							<div class="row">
								<div class="form-group col-md-2"> 
									<label class="control-label">Duração(plantão)</label>
									<input class="form-control" name="horasPlantao" id="horasPlantao" onchange="calculaFimPlantao(this.value)" required>
							  </div>
											
								 <div class="form-group col-md-2"> 
									<label class="control-label">Fim</label>
									<div class='input-group date' id="dataFimPlantao">
										 <input type='text' id="dataFim" name="dataFimPlantao" class="form-control"/>
										 <span class="input-group-addon">
										 <span class="glyphicon glyphicon-calendar"></span>
										 </span>
									</div>
								</div>
									
								<div class="form-group col-md-2">
										<label for="inputStatusPagamento">Status</label>
										<select id="statusPagamento" name="statusPagamento" class="form-control" required> 
											<option>Faturar</option>
											<option>Pago</option>
											<option>Glosada</option>
											<option>Pendente</option>									
										</select>
									</div>

									
									<div class="form-group col-md-2"> 
													<label class="control-label">Data Pagamento</label>
													<div class='input-group date' id="dataPagamentoPlantao">
													 <input type='text' id="dataPagamento" name="dataPagamento" class="form-control"/>
													 <span class="input-group-addon">
													 <span class="glyphicon glyphicon-calendar"></span>
													 </span>
												  </div>
												</div>

												
												<div class="form-group col-md-2"> 
													<label class="control-label">Data Repasse</label>
													<div class='input-group date' id="dataRepassePlantao">
													 <input type='text' id="dataRepasse" name="dataRepasse" class="form-control"/>
													 <span class="input-group-addon">
													 <span class="glyphicon glyphicon-calendar"></span>
													 </span>
												  </div>
												</div>
									<div class="form-group col-md-2">
										<br>
										<button type="submit" name="submit" id="inserirConta" value="inserirConta" class="btn btn-success">Salvar</button>
									</div>									
							</div>
						<div class="row"> 
										
						</div>
							</div>	
						</form>
					</div>
				<!-- /.panel-body -->
                </div>
		
		            <!-- /.panel -->
                </div>
				<!-- /.col-lg-12 -->
        
			<div class="row">
			   <div class="col-lg-12">
             
				<div class="panel panel-default">
                        <div class="panel-heading">
                            Plantões
                        </div>
                 
						<div class="panel-body">
							<table width="100%" class="table table-striped table-bordered table-hover table-responsive" id="tbl-plantoes">
                                <thead>
                                    <tr>
										<th>ID</th>
										<th>Inicio</th>
										<th>Fim</th>
										<th>Médico</th>
										<th>Plantão</th>
										<th>Qtd.Horas</th>
										<th>R$ Bruto</th>
										<th>R$ Líq.</th>
										<th>Substituto</th>
										<th>Subs.Horas</th>
										<th>R$ Subst. Bruto</th>
										<th>R$ Subst. Líq.</th>	
										<th>Status</th>
										<th></th>
										<th></th>
									   </tr>
                                </thead>
                            </table>
                                  <!-- /.table-responsive -->
                       
                        </div>
				</div>
				</div>
            <!-- /.row -->
        <!-- /#page-wrapper -->
		 </div>
    <!-- /#wrapper -->
	</div>
</div>
	
	
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
	
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script> 
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
		
    <!-- jQuery -->
    
	    <!-- <script src="../vendor/jquery/jquery.min.js"></script> -->

    <!-- Bootstrap Core JavaScript -->
    <!--  <script src="../vendor/bootstrap/js/bootstrap.min.js"></script> -->

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
			var table = $('#tbl-plantoes').DataTable({
				"processing": true,
				"serverSide": true,
				"ajax": {
					"url": "proc_plantoes.php",
					"type": "POST"
				}
				});
			});
	  </script>
	
	
<script>
		$( document ).ready(function() {
			$('#dataInicioPlantao').datetimepicker({
		//	defaultDate: new Date(),
			format:'DD/MM/YYYY HH:mm:ss'
		//	format:'DD/MM/YYYY '
			});
		});
 </script>
 
  <script>
		$( document ).ready(function() {
			$('#dataFimPlantao').datetimepicker({
			format:'DD/MM/YYYY HH:mm:ss'
			});
		});
 </script>
 
 <script>
		$( document ).ready(function() {
			$('#dataRepassePlantao').datetimepicker({
			format:'DD/MM/YYYY'
			});
		});
 </script>

<script>
		$( document ).ready(function() {
			$('#dataPagamentoPlantao').datetimepicker({
			format:'DD/MM/YYYY'
			});
		});
 </script>

 <script>
	function tipoPlantao() {
		var id = document.getElementById("configPlantao").value;
	
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		var result = JSON.parse(this.responseText);
			
			var dataPlantao = $('#dataInicioPlantao').data('DateTimePicker').date();
			dataPlantao = moment(dataPlantao).format('DD/MM/YYYY');
			var horaInicioPlantao = result[0][1];
			var dataHoraPlantao= moment(dataPlantao + ' ' + horaInicioPlantao, 'DD/MM/YYYY HH:mm:ss');
			dataHoraPlantao = new Date(dataHoraPlantao);
			$('#dataInicioPlantao').data('DateTimePicker').date(dataHoraPlantao);
			var duracao =  result[0][2];
		    document.getElementById("horasPlantao").value = duracao;
		
			var end_date = (moment(dataHoraPlantao).add(duracao, 'hours').format('DD/MM/YYYY HH:mm:ss'));
			
			$('#dataFimPlantao').data('DateTimePicker').date(end_date);
			alert(result[0][5]);
			document.getElementById("idhospital").value = result[0][5];

			}
		
		};
		xmlhttp.open("GET", "fetch_configuracaoPlantoes.php?id="+id, true);
		xmlhttp.send();
	
	}
</script>

 
 	<script>
	function calculaFimPlantao(val) {
	//Calcula a data de encerramento do contrato quantidade em meses
		var dataInicio =  $('#dataInicioPlantao').data('DateTimePicker').date();
	 	var end_date = (moment(dataInicio).add(val, 'hours').format('YYMM-DD HH:mm:ss'));
		$('#dataFimPlantao').data('DateTimePicker').date(new Date(end_date));
	}
	</script>
	
<script>
			$(document).ready(function(){
			 $('#formPlantao').on("submit", function(event){  
			 event.preventDefault();
			$.ajax({  
				url:"sqlPlantoes.php",  
				method:"POST",  
				data: {submit : $("#inserirConta").val(), idplantao: $("#idplantao").val(), 
				idConfiguracaoPlantao: $("#configPlantao").find('option:selected').val(),
				horasPlantao : $("#horasPlantao").val(),				
				idmedico: $("#idmedico").find('option:selected').val(),
				idsubstituto: $("#idsubstituto").find('option:selected').val(),
				horasSubstituicaoPlantao : $("#horasSubstituicaoPlantao").find('option:selected').val(),
				idhospital : $('#idhospital').val(),
				dataInicio : $("#dataInicio").val(),
				dataFim : $("#dataFim").val()	,
				statusPagamento: $("#statusPagamento").find('option:selected').text(),
				dataPagamento : $("#dataPagamento").val(),
				dataRepasse : $("#dataRepasse").val()									
				},
				beforeSend:function(){ 
					},  
				success:function(data){  
					}  
			   });
			   	$('#formPlantao')[0].reset();  
			 	 window.parent.location.reload();
				$('#tbl-plantoes').DataTable().ajax.reload();	
			});		
				
							
				
			});
</script>

	<script>
		$(document).on('click','#btnEditar',function(e){
        e.preventDefault();
		var id = $(this).data('id');
		confirm("Editar PLANTAO ? " +id);
		
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		var result = JSON.parse(this.responseText);
		
		document.getElementById("idplantao").value = id;
		}
		
		};
		xmlhttp.open("GET", "operacoes_plantoes.php?id="+id, true);
		xmlhttp.send();
		});

	</script>

<script>
		$(document).on('click','#btnExcluir',function(e){
            e.preventDefault();
		var id = $(this).data('id');
		 confirm("Excluir PLANTÃO ? " +id);
		location.assign("deletePlantoes.php?id="+id);
		});
	</script>	
		

</body>
</html>
