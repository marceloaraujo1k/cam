<?php
session_start();
include '../opendb.php';

include_once('../func.php');

$form=null;

if(isset($_GET["add"]))
					{
						//$id = $_GET["id"];
					//	$query = mysqli_query($mysql_conn, "SELECT * FROM plantoes");
				//		$row = mysqli_fetch_assoc($query);
				//		$form = $row;
						$hospital = getItensTable($mysql_conn,"hospital");
						$medicos = getItensTable($mysql_conn,"medicos");
					//	$configuracaoplantoes = getItensTable ($mysql_conn, "configuracaoplantoes");
			}
if(isset($_GET["edit"]))
					{
						$id = $_GET["id"];
						$query = mysqli_query($mysql_conn, "SELECT * FROM plantoes WHERE idplantao='$id'");
						$row = mysqli_fetch_assoc($query);
						$form = $row;
						$hospital = getItensTable($mysql_conn,"hospital");
						$medicos = getItensTable($mysql_conn,"medicos");
					//	$configuracaoplantoes = getItensTable ($mysql_conn, "configuracaoplantoes");
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

			<div class="row">
			   <div class="col-lg-12">
             		<div class="panel panel-default">
                        <div class="panel-heading">
                            Plantões
                        </div>
                 		<div class="panel-body">
						 <div class="row">
						<div class="form-group col-md-3">
									<label for="hospital">Hospital</label>
									<select id="idhospital" name="idhospital" class="form-control">
											<option value=""></option>
											<?php
											for($i=0; $i<count($hospital); $i++)
											{
											if($form["idhospital"] == $hospital[$i]['idhospital'])
											{	
											?>
											<option value="<?=$hospital[$i]['idhospital']?>"><?=$hospital[$i]['hospital']?></option>
											<?php
											}
											else
											{
											?>
											<option value="<?=$hospital[$i]['idhospital']?>" ><?=$hospital[$i]['hospital']?></option>
											<?php
											}
											}
											?>
									</select>
							</div>
							<div class="form-group col-md-2"> 
								<label class="control-label">Mês/Ano</label>
									<div class='input-group date' id="mesAnoPlantao">
									<input type='text' id="dtMesAnoPlantao" name="mesAnoPlantao" class="form-control"/>
										<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
							<div class="form-group col-sm-2"> 
								<br>
								<p id="resultado"></p>
								<input type="button" name="search" id="search" value="Filtrar" class="btn btn-default" />
							</div>			
						</div>
						</div>		
					</div>
				</div>
			</div>
		    <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Gestão de Plantões
                        </div>
                       <!-- /.panel-heading -->
						<div class="panel-body">
						<!-- informacoes do paciente -->
						<form role="form" id="formPlantao" method="post">
				

						<div class="row">
						<input type="hidden" id="idplantao" name="idplantao" value="<?=$form["idplantao"]?>"> 

						<input type="hidden" id="cor" name="cor" value="<?=$form["cor"]?>">
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
						<div class="form-group col-md-2">
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
							  <label for="inputEstado">Subst. Plantão</label>
								<select id="configSubstituicaoPlantao" name="configSubstituicaoPlantao" class="form-control" onchange="substituicaoPlantao()"> 
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
							<label class="control-label">Horas(subs.)</label>
							<input type="text" id="horasSubstituicaoPlantao" name="horasSubstituicaoPlantao" class="form-control" disabled> 
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
											<option value=0></option>
											<option value=1>Faturar</option>
											<option value=2>Pago</option>
											<option value=4>Glosada</option>
											<option>Pendente</option>									
										</select>
									</div>

									
								<div class="form-group col-md-2"> 
													<label class="control-label">Data Pagamento</label>
													<div class='input-group date' id="dataPagamentoPlantao">
													 <input type='text' id="dataPagamento" name="dataPagamentoPlantao" class="form-control"/>
													 <span class="input-group-addon">
													 <span class="glyphicon glyphicon-calendar"></span>
													 </span>
												  </div>
								</div>
										
										<div class="form-group col-md-2"> 
													<label class="control-label">Data Repasse</label>
													<div class='input-group date' id="dataRepassePlantao">
													 <input type='text' id="dataRepasse" name="dataRepassePlantao" class="form-control"/>
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
							<div class="table-responsive"> 
							<table  class="table table-striped  table-bordered  table-hover dt-responsive display nowrap" cellspacing="0" id="tbl-plantoes">
							
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
										<th>Pagamento</th>
										<th>Repasse</th>
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
</div>
		<!-- Bootstrap Modal - To Add New Record -->
			<!-- Modal Relatorios -->
			<div class="modal fade" id="modalRelatorio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="myModalLabel">Relatório</h4>
									</div>
									<div class="modal-body">
								 <form role="form" action="./.php" method='post' enctype="multipart/form-data">
					
								<div class="row">
									<div class="form-group col-md-6">
									  <label for="tipoRelatorio">Tipo</label>
									  <select id="tipoRelatorio" name="tipoRelatorio" class="form-control"> 
											<option value="0">Escala Plantões</option>
											<option value="1">Escala/Hospital</option>
											<option value="2">Hospital/Médico</option>
											<option value="3">Gerencial</option>
									</select>
									</div>
										<div class="form-group col-md-6">
										<label for="medico">Médico</label>
											<select id="medico_report" name="idmedico" class="form-control">
											<option value=""></option>
											<?php
											for($i=0; $i<count($medicos); $i++)
											{
											if($form["idmedico"] == $medicos[$i]['idmedico'])
											{	
											?>
											<option value="<?=$medicos[$i]['idmedico']?>" selected><?=$medicos[$i]['nome']?></option>
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
								</div>

								<div class="row"> 
									<div class="form-group col-md-6">
										<label for="convenio">Convênio</label>
											<select id="convenio0" name="idconvenio" class="form-control"> 
											<option value=""></option>
											<?php
											for($i=0; $i<count($convenios); $i++)
											{
											if($form["idconvenio"] == $convenios[$i]['idconvenio'])
											{	
											?>
											<option value="<?=$convenios[$i]['idconvenio']?>" selected><?=$convenios[$i]['descricao']?></option>
											<?php
											}
											else
											{
											?>
											<option value="<?=$convenios[$i]['idconvenio']?>" ><?=$convenios[$i]['descricao']?></option>
											<?php
											}
											}
											?>
										</select>
									</div>
									<div class="form-group col-md-6">
										<label for="hospital">Hospital/Clínica</label>
											<select id="hospital_report" name="idhospital" class="form-control">
											<option value=""></option>
											<?php
											for($i=0; $i<count($hospital); $i++)
											{
											if($form["idhospital"] == $hospital[$i]['idhospital'])
											{	
											?>
											<option value="<?=$hospital[$i]['idhospital']?>" selected><?=$hospital[$i]['hospital']?></option>
											<?php
											}
											else
											{
											?>
											<option value="<?=$hospital[$i]['idhospital']?>" ><?=$hospital[$i]['hospital']?></option>
											<?php
											}
											}
											?>
										</select>
									</div>
								</div>

								<div class="row">
									<div class="form-group col-md-6">
									  <label for="inputStatusPagamento">Status</label>
										<select id="statusPagamento0" name="statusPagamento" class="form-control" required> 
												<option>Faturar</option>
												<option>Pago</option>
												<option>Glosada</option>
												<option>Pendente</option>									
										</select>
									</div>	
									<div class="form-group col-md-6">
										  <label for="filtroData">Filtrar por</label>
											<select id="filtroData0" name="filtroData" class="form-control"> 
												<option value="0">Data do Plantão</option>
												<option value="1">Data de Pagamento</option>
												<option value="2">Data de Repasse</option>
											</select>
									</div>
								</div>
								<div class="row">
									<div class="input-daterange">
										<div class="form-group col-md-6"> 
											<br>
											<label class="control-label">Data Inicial</label>
											<div class='input-group date' id="start_date_report">
											 <input type='text' name="start_date_report" class="form-control"/>
											 <span class="input-group-addon">
											 <span class="glyphicon glyphicon-calendar"></span>
											 </span>
										  </div>
										</div> 
										  <div class="form-group col-md-6"> 
											<br>
											<label class="control-label">Data Final</label>
											<div class='input-group date' id="end_date_report">
											 <input type='text' name="end_date_report" class="form-control"/>
											 <span class="input-group-addon">
											 <span class="glyphicon glyphicon-calendar"></span>
											 </span>
										  </div>
										</div>
									</div>
								
			
								</div>
									<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
									<button  type="button" id="btnRelatorio" class="btn btn-primary" title="Relatório" onclick="relatorios()">Imprimir </button>
								</form>
							</div>
						</div>
					</div>
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

	
	<!--  IMPORT PARA UTILIZACAO DOS BOTES DE IMPRIMIR, EXPORTAR EM CSV, PDF, EXCEL -->
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script> 
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>	
	

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
	
		<script>
   	$(document).ready(function() {
	
			});
	  </script>
	

	<script>
		$( document ).ready(function() {
			$('#mesAnoPlantao').datetimepicker({
			viewMode: 'years',
             format: 'MM/YYYY',
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

			
	//		document.getElementById("idhospital").value = result[0][5];
			document.getElementById("cor").value = result[0][6];
		}
	};
		xmlhttp.open("GET", "fetch_configuracaoPlantoes.php?id="+id, true);
		xmlhttp.send();
	
	}
</script>

<script>
	function substituicaoPlantao() {
		var id = document.getElementById("configSubstituicaoPlantao").value;
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		var result = JSON.parse(this.responseText);
		    document.getElementById("horasSubstituicaoPlantao").value = result[0][2];
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
				data: {
				submit : $("#inserirConta").val(),
				idplantao: $("#idplantao").val(), 
				idConfiguracaoPlantao: $("#configPlantao").find('option:selected').val(),
				horasPlantao : $("#horasPlantao").val(),				
				idmedico: $("#idmedico").find('option:selected').val(),
				idsubstituto: $("#idsubstituto").find('option:selected').val(),
				idConfiguracaoSubstituicaoPlantao: $("#configSubstituicaoPlantao").find('option:selected').val(),
				horasSubstituicaoPlantao : $("#horasSubstituicaoPlantao").val(),
				idhospital : $('#idhospital').val(),
				dataInicio : $("#dataInicio").val(),
				dataFim : $("#dataFim").val(),
				cor : $("#cor").val(),
				statusPagamento: $("#statusPagamento").find('option:selected').text(),
				dataPagamentoPlantao : $("#dataPagamento").val(),
				dataRepassePlantao : $("#dataRepasse").val()									
				},
				beforeSend:function(){ 
					},  
				success:function(data){  
					}  
			   });
			  	$('#formPlantao')[0].reset();  
			 	// window.parent.location.reload();
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
		document.getElementById('idmedico').selectedIndex = result[0][1];
		document.getElementById('configPlantao').selectedIndex = result[0][2];
		document.getElementById("horasPlantao").value = result[0][3];
		
		document.getElementById('idsubstituto').selectedIndex = result[0][4];
		document.getElementById('configSubstituicaoPlantao').selectedIndex = result[0][5];
		document.getElementById('horasSubstituicaoPlantao').value = result[0][6];

		$('#dataInicioPlantao').data('DateTimePicker').date(new Date(result[0][8]));
		$('#dataFimPlantao').data('DateTimePicker').date(new Date(result[0][9]));
		$('#dataRepassePlantao').data('DateTimePicker').date(new Date(result[0][10]));
		$('#dataPagamentoPlantao').data('DateTimePicker').date(new Date(result[0][11]));	
		document.getElementById('statusPagamento').options[document.getElementById('statusPagamento').selectedIndex].text =	 result[0][12];
		document.getElementById("cor").value = result[0][13];
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

<script>
// Acrescentar PAD 
	function month(d)
		{   
			d = ( d < 10 ? '0' : '') + d;
			return d;
		}
</script>

<script>
	var id;
	var mesAnoPlantao;
	$(document).ready(function(){
		$('#search').click(function(){	
//		$('#idhospital').change(function() {
			id = $("#idhospital").find('option:selected').val();
			var mesAnoPlantao = $('#mesAnoPlantao').data('DateTimePicker').date().toString();
			mesAnoPlantao = new Date(mesAnoPlantao);
			mes = month(mesAnoPlantao.getMonth() + 1)
			mesAnoPlantao = mesAnoPlantao.getFullYear()+'-'+mes;

	if (mesAnoPlantao == '') {
			alert('Preencher o período (mês/ano)');
		}

		$.ajax({
			type: 'POST',
			url: 'operacoesConfiguracaoPlantao.php',
			data: {
				id: id
			},
			dataType: 'json',
			beforeSend:function(){ 
				$('select[name=configuracaoplantoes]').empty();
				$('select[name=configuracaoplantoes]').append('<option value=""></option>');
				$('select[name=configSubstituicaoPlantao]').empty();
				$('select[name=configSubstituicaoPlantao]').append('<option value=""></option>');
				},  
			success: function(data){
				console.log(data);
				for(i = 0; i < data.qtd; i++){
					$('select[name=configuracaoplantoes]').append('<option value="'+data.id[i]+'">'+data.descricao[i]+'</option>');
					$('select[name=configSubstituicaoPlantao]').append('<option value="'+data.id[i]+'">'+data.descricao[i]+'</option>');
				}
			}
		});
		$('#tbl-plantoes').DataTable().destroy();
		var table = $('#tbl-plantoes').DataTable({
				"processing": true,
				"serverSide": true,
				'select': {
                 'style': 'multi'
     	         },
     			order : [[1, "asc"]],
			   extend: 'collection',
                text: 'Export',
				dom: 'lBfrtip',
                buttons: [
                     {
					 	extend: 'excelHtml5',
                     	exportOptions: {
						columns: [0,1,2,3,4,5,6,7,8,9,10,11,12]
				   		 }
					 },
					 {
                    extend: 'pdfHtml5',
                     	exportOptions: {
                    	columns: [0,1,2,3,4,5,6,7,8,9,10,11,12]
						}
					},
					 {
					 extend: 'print',
                     exportOptions: {
						columns: [0,1,2,3,4,5,6,7,8,9,10,11,12]
					 	}
					},
					{
						text: 'Relatório',
						action: function ( e, dt, node, config ) {
							$("#modalRelatorio").modal();
						}
					},
					{
						text: 'Email',
						action: function ( e, dt, node, config ) {
								//	$("#modalEmail").modal();
						}
					}
					
					],
				lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],

				ajax: {
					url: "proc_plantoes.php",
					data: {
						id: id,
						mesAnoPlantao : mesAnoPlantao,
					},
					dataType: 'json',
					type: "POST"
				},
				beforeSend:function(){
				},  
				success:function(data){
				 	$('#tbl-plantoes').DataTable().ajax.reload();
				},
				});
			});
		});
</script>

<script>
	$(document).ready(function(){
		 $('#start_date_report').datetimepicker({
			format:'DD/MM/YYYY'
		});
		
		 $('#end_date_report').datetimepicker({
			format:'DD/MM/YYYY'
		});
	});
</script>

<script>
		function relatorios() {
		$(document).on('click','#btnRelatorio',function(e){
			e.preventDefault();
					var start = $('#start_date_report').data('DateTimePicker').date().toString();
					var date = new Date(start);
					var start_date = date.getFullYear()+'-'+(date.getMonth() + 1) + '-' + date.getDate();
				
					var end = $('#end_date_report').data('DateTimePicker').date().toString();
					var date = new Date(end);
					var end_date = date.getFullYear()+'-'+(date.getMonth() + 1) + '-' + date.getDate();
			
					var idmedico = $("#medico_report").find('option:selected').val();
					var idhospital = $("#hospital_report").find('option:selected').val();
					var filtroDataTipo = $("#filtroData0").find('option:selected').val();
					
				   var id = document.getElementById("tipoRelatorio").value;
					switch (id) {
						case '0':
							window.open("relatorioEscalaPlantoes.php?start_date="+start_date+"&end_date="+end_date+"&filtroDataTipo="+filtroDataTipo+"&hospital="+idhospital);
							break;
						
						case '1':
							window.open("relatorioPlanodeSaude.php?id="+idmedico+"&start_date="+start_date+"&end_date="+end_date+"&filtroDataTipo="+filtroDataTipo+"&hospital="+idhospital);
							break;

						case '2':
							window.open("relatorioFaturaSUS.php?id="+idmedico+"&start_date="+start_date+"&end_date="+end_date+"&filtroDataTipo="+filtroDataTipo+"&hospital="+idhospital);
							break;	
							
						case '3':
							window.open("relatorioFaturaEletivas.php?id="+idmedico+"&start_date="+start_date+"&end_date="+end_date+"&filtroDataTipo="+filtroDataTipo+"&hospital="+idhospital);
							break;	

						case '4':
							window.open("relatorioParticular.php?id="+idmedico+"&start_date="+start_date+"&end_date="+end_date+"&filtroDataTipo="+filtroDataTipo+"&hospital="+idhospital);
							break;	
							
						default:
							text = "No value found";
							}
						});
				}
</script>

</body>
</html>
