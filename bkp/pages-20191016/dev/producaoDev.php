<?php
/* Informa o nível dos erros que serão exibidos */
error_reporting(E_ALL);

/* Habilita a exibição de erros */
ini_set("display_errors", 1);

/* Valida usuário - empresa - função */
session_start();
if((!isset ($_SESSION['user']) == true) and (!isset ($_SESSION['idempresa']) == true))
{
  unset($_SESSION['user']);
  unset($_SESSION['idempresa']);
  session_destroy();
  header('location:../login.php');
  }
 
include '../opendb.php';
include_once('../func.php');

$form=null;
$empresa=null;
$pacientes=null;
$medicos=null;
$convenios=null;


$empresa = getItensTable($mysql_conn,"empresa");
$pacientes = getItensTable($mysql_conn,"pacientes");
$medicos = getItensTable($mysql_conn,"medicos");
$convenios = getItensTable($mysql_conn,"convenios");

$form["nome"]=null;
$form["descricao"]=null;
$form["dataRecebimento"]=null;
$form["valor"]=null;
$form["valorRecebido"]=null;
$form["desconto"]=null;
$form["saldoDevedor"]=null;


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

<style>
<!--.ui-autocomplete-input, .ui-menu, .ui-menu-item {  z-index: 2006; } -->
</style>

</head>

<body>

   <div id="wrapper">
     <!-- INCLUSÃO DO ARQUIVO MENU -->
		<?php include_once('../menu.php'); ?>

         <div id="page-wrapper">
			
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Produção Médica</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
					
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                                 <!-- /.panel-heading -->
							 
				
						<!-- FILTRAR POR FILIAL - DATA  -->

					<div class="row">
						<div class="col-lg-10 ">
						
					    <button class="btn btn-success" data-toggle="modal" data-target="#modalReceita">
										Inserir Produção
						</button>
					  	</div>
							<div class="col-lg-2">
							</div>
							</div>
					<div class="row">
						<div class="input-daterange">
							<div class="form-group col-lg-2"> 
								<br>
								<label class="control-label">Data Inicial</label>
								<div class='input-group date' id="start_date">
								 <input type='text' name="start_date" class="form-control"/>
								 <span class="input-group-addon">
								 <span class="glyphicon glyphicon-calendar"></span>
								 </span>
							  </div>
							</div> 
							  <div class="form-group col-lg-2"> 
								<br>
								<label class="control-label">Data Final</label>
								<div class='input-group date' id="end_date">
								 <input type='text' name="end_date" class="form-control"/>
								 <span class="input-group-addon">
								 <span class="glyphicon glyphicon-calendar"></span>
								 </span>
							  </div>
							</div>
						</div>
							<div class="form-group col-lg-2"> 
								<br>
								<br>
								<input type="button" name="search" id="search" value="Filtrar" class="btn btn-default" />
							</div>
							<div class="col-lg-8">
							</div>
					</div>
				</div>
				
						</div>	
					<div class="panel-body">

					     <!-- AS DUAS LINHAS SEGUINTES FAZEM O DATATABLE TRABALHAR CORRETAMENTE NA MUDANÇA DE ZOOM table table-striped table-bordered table-hover -->
							<div class="table-responsive"> 
								<table  class="table table-striped table-bordered  table-hover dt-responsive display nowrap" cellspacing="0" id="listar-producao">
								
                                   <thead>
								      <tr>
										<th rowspan="2">ID</th>
										<th rowspan="2">Data Realização</th>
										<th colspan="2"><center>Paciente</center></th>
										<th rowspan="2">Médico</th>
										<th rowspan="2">Convênio</th>
										<th rowspan="2">Hospital</th>
										<th colspan="4"><center>Procedimento</center></th>
										<th colspan="10"><center>Pagamento</center></th>
									</tr>
                                    <tr>
									<!--  -->
										<th>Nome</th>
										<th>No. Carteira</th> 
										<th>Descrição</th>
										<th>Qtd.</th>
										<th>% Ad.</th>
										<th>Valor R$</th>
										<th>Data Cobrança</th>
										<th>Protocolo Envio</th>
										<th>Data Prevista Pgto.</th>
										<th>Data Pagamento</th>
										<th>Data Repasse</th>
										<th>Valor Recebido R$</th>
										<th>Glosa R$</th>
										<th>Saldo R$</th>
										<th>Status</th>
										<th></th>
										<th></th>
									</tr>
                                </thead>
                               
                            </table>
                            <!-- /.table-responsive -->
					</div>
				    <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            </div>
		</div>
    
 
    <!-- /#wrapper -->

			<!-- Bootstrap Modal - To Add New Record -->
						<!-- Modal -->
				<div class="modal fade" id="modalReceita" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="myModalLabel">Inserir Produção Médica</h4>
									</div>
									<div class="modal-body">
									<form name="formDespesa" role="form" action="../financeiro/sqlProducao.php" method='post'>
									<?php
									$statusPagamento = array("EM ABERTO","RECEBIDA","SALDO DEVEDOR","CANCELADA");
									$saldoDevedorAnt = $form["saldoDevedor"];
									?>
									<input type="hidden" name="tipo" id="tipo" value="RECEITA">
									
									<div class="form-group">
										<label for="convenio">Filial</label>
											<select id="empresa" name="idempresa" class="form-control">
											<option value=""></option>
											<?php
											for($i=0; $i<count($empresa); $i++)
											{
											if($form["idempresa"] == $empresa[$i]['idempresa'])
											{	
											?>
											<option value="<?=$empresa[$i]['idempresa']?>" selected><?=$empresa[$i]['empresa']?></option>
											<?php
											}
											else
											{
											?>
											<option value="<?=$empresa[$i]['idempresa']?>" ><?=$empresa[$i]['empresa']?></option>
											<?php
											}
											}
											?>
										</select>
									</div>
						
									<div class="form-group">
										<label for="nome">Paciente</label>
										<input class="form-control"  id="searchPaciente" placeholder="Digite o nome do paciente" />
							
	                     			</div>
							
								
								<div class="form-group">
									<label for="medico">Médico</label>
										<select id="medico" name="medico" class="form-control">
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
								
								<div class="form-group">
										<label for="nome">Procedimento</label>
										   <input class="form-control"  name="descricao" id="descricao" value="<?=$form["descricao"]?>">
                        			</div>
								
								<input type="hidden" name="saldoDevedorAnt" id="saldoDevedorAnt" value="<?=$saldoDevedorAnt?>">
								
								<div class="row">
									<div class="form-group col-sm-3">
								
									<label for="nome">Valor R$ </label>
										   <input class="form-control" 	 name="valor" id="valor" onchange="getSaldoDevedor(this.value)">
                        			</div>	
																
									<div class="form-group col-sm-3 offset-md-1">
										<label for="nome">Recebido R$ </label>
										   <input class="form-control" type="text" name="valorRecebido" id="valorRecebido"  value="0" onchange="getSaldoDevedor(this.value)">
                        			</div>
							
									<div class="form-group col-sm-3">
										<label for="nome">Desconto R$ </label>
										   <input class="form-control" type="text" name="desconto" id="desconto"  value="0" onchange="getSaldoDevedor(this.value)" >
                        			</div>
									
									<div class="form-group col-sm-3">
										<label for="nome">Saldo R$ </label>
										   <input class="form-control" type="text" style="background-color:pink;" name="saldoDevedor" id="saldoDevedor">
                        			</div>
								</div>
								
								<div class="row">
										<div class="form-group col-md-6"> 
										<label class="control-label">Data Pagamento</label>
											<div class='input-group date' id='datetimepicker3'/>
											 <input type='text' class="form-control" name="dataRecebimento"/>
											<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
											</span>
										  </div>
										 </div>
										
										<div class="form-group col-md-6"> 
										<label class="control-label">Data Vencimento</label>
											<div class='input-group date' id='datetimepicker4'/>
											 <input type='text' class="form-control" name="dataVencimento"/>
											<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
											</span>
										  </div>
									 </div>  
								
								</div>
								<div class="row">
									<div class="form-group  col-md-6">
										<label for="nome">Forma de Pagamento</label>
									  <select id="formaPagamento" name="formaPagamento" class="form-control" required> 
											<option>DINHEIRO</option>
											<option>CARTÃO CRÉDITO</option>
											<option>CARTÃO DÉBITO</option>
											<option>CHEQUE</option>	
											<option>BOLETO</option>	
											<option>TRANSFERÊNCIA</option>												
									</select>
                        			</div>
									
									<div class="form-group col-md-6">
									  <label for="inputStatusPagamento">Status Pagamento</label>
									  <select id="inputStatusPagamento" name="statusPagamento" class="form-control" required> 
											<option>EM ABERTO</option>
											<option>RECEBIDA</option>
											<option>SALDO DEVEDOR</option>
											<option>CANCELADA</option>									
									</select>
									</div>
									
								</div>
										
									<div class="modal-footer">
										<button type="submit" name="submit" value="inserirConta" class="btn btn-success">Lançar</button>
									</form>
									</div>
									</div>
								</div>
			
			</div>	
		</div>
	<!-- /#page-wrapper -->
	<!-- AUTOCOMPLETE BOOTSTRAP -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

	 <!-- jQuery -->
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
	

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script> 
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
		
    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../../vendor/datatables-responsive/dataTables.responsive.js"></script>

	<!--  IMPORT PARA UTILIZACAO DOS BOTES DE IMPRIMIR, EXPORTAR EM CSV, PDF, EXCEL -->
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script> 
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
	
    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>


<script>
		$( document ).ready(function() {
			$('#datetimepicker3').datetimepicker({
			defaultDate: new Date(),
			format:'DD/MM/YYYY HH:mm'
			});
		});
	  </script>
	  
	    <script>
		$( document ).ready(function() {
			$('#datetimepicker4').datetimepicker({
			defaultDate: new Date(),
			format:'DD/MM/YYYY HH:mm'
			});
		});
	  </script>
	 	  
  	  
	    		<script>
		$( document ).ready(function() {
			$('#datetimepicker7').datetimepicker({
			defaultDate: new Date(),
			format:'DD/MM/YYYY HH:mm'
			});
		});
	  </script>	
	  	  
	    		<script>
		$( document ).ready(function() {
			$('#datetimepicker8').datetimepicker({
			defaultDate: new Date(),
			format:'DD/MM/YYYY HH:mm'
			});
		});
	  </script>	
	  
	<script>
		$(document).on('click','#btnEditar',function(e){
        e.preventDefault();
		var id = $(this).data('id');
		confirm("Editar conta ? " +id);
		
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		var result = JSON.parse(this.responseText);
		document.getElementById("idfinanceiro").value = result[0][0];
		document.getElementById("valor2").value = result[0][1];
		
		// VALOR RECEBIDO ANTERIOR
		document.getElementById("valorRecebidoAnt2").value = result[0][2];
		// DESCONTO ANTERIOR
		document.getElementById("descontoAnt2").value = result[0][3];
		
		//SALDO DEVEDOR
		document.getElementById("saldoDevedorAnt2").value = result[0][4];
		document.getElementById("saldoDevedor2").value = result[0][4];
		var saldo_devedor_anterior = result[0][4];
		
		document.getElementById("descricao2").value = result[0][5];
		document.getElementById("nome").value = result[0][7];
		document.getElementById("empresa").value = result[0][8];
		document.getElementById("convenio").value = result[0][10];
		}
		
		};
		xmlhttp.open("GET", "operacoes_financeiro.php?id="+id, true);
		xmlhttp.send();
		$("#modalAtualizaConta").modal();
		});

	</script>	
		
	<script>
		$(document).on('click','#btnExcluir',function(e){
            e.preventDefault();
		var id = $(this).data('id');
		 confirm("Excluir avaliação ? " +id);
		location.assign("deleteFinanceiro.php?id="+id);
		});
	</script>	
	
	
	<script>
		function getAtualizaSaldo(val) {
		var saldo_devedor = document.getElementById("saldoDevedorAnt2").value  - document.getElementById("valorRecebido2").value - document.getElementById("desconto2").value ;
		if (saldo_devedor > 0 ) {
			var txt;
			var r = confirm("Gerar SALDO DEVEDOR? "+saldo_devedor);
				if (r == true) {
				    document.getElementById("saldoDevedor2").value = saldo_devedor;
					document.getElementById('inputStatusPagamento2').selectedIndex = 2;
				} else {
					txt = "CANCELADA";
				}
			}
			else {
				document.getElementById("saldoDevedor2").value = saldo_devedor;
				document.getElementById('inputStatusPagamento2').selectedIndex = 1;
			}

		if (saldo_devedor < 0 ) {
			var txt;
			var r = confirm("Gerar SALDO CREDOR? "+saldo_devedor);
				if (r == true) {
					document.getElementById("saldoDevedor2").value = saldo_devedor;
					document.getElementById('inputStatusPagamento2').selectedIndex = 1;
				} else {
					txt = "CANCELADA";
				}
			}
			}		
	</script>
	
	
	<script>
		function getSaldoDevedor(val) {
		var saldo_devedor = document.getElementById("valor").value  - document.getElementById("valorRecebido").value - document.getElementById("desconto").value ;
		if (saldo_devedor > 0 ) {
			var txt;
			var r = confirm("Gerar SALDO DEVEDOR? "+saldo_devedor);
				if (r == true) {
				    document.getElementById("saldoDevedor").value = saldo_devedor;
					document.getElementById('inputStatusPagamento').selectedIndex = 2;
				} else {
					txt = "CANCELADA";
				}
			}
			else {
				document.getElementById("saldoDevedor").value = saldo_devedor;
				document.getElementById('inputStatusPagamento').selectedIndex = 1;
			}
		}
	</script>
	
		<script>
		function getDesconto(val) {
		var saldo_devedor = document.getElementById("saldo_devedor").value - val;
		if (saldo_devedor != 0 ) {
			var txt;
			var r = confirm("Gerar SALDO DEVEDOR? "+saldo_devedor);
				if (r == true) {
						document.getElementById("saldo_devedor").value = saldo_devedor;
						document.getElementById('inputStatusPagamento').selectedIndex = 2;
				} else {
					txt = "CANCELADA";
				}
			}
			else {
				
				document.getElementById('inputStatusPagamento').selectedIndex = 1;
			}
		}
	</script>
	
<script>
		$(document).ready(function(){
		 $('#start_date').datetimepicker({
			format:'DD/MM/YYYY'
		});
		
		 $('#end_date').datetimepicker({
			format:'DD/MM/YYYY'
		});
		
		 fetch_data('no');

		 function fetch_data(is_date_search, start_date='', end_date='')
		 {
		  var dataTable = $('#listar-financeiro').DataTable({
		   "processing" : true,
		   "serverSide" : true,
		   "order" : [],
			   extend: 'collection',
                text: 'Export',
				    dom: 'Bfrtip',
                buttons: [
                     {
					 extend: 'excel',
                     exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11 ]
					 }},
					 {
                    extend: 'pdf',
                     exportOptions: {
                    columns: [3,4,5,6,7,8,9,10,11 ]
					}
					},
					 {
					 extend: 'print',
                     exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11]
					 }
					}
                  	],
		   "ajax" : {
			url:"fetch_financeiro.php",
			type:"POST",
			data:{
			 is_date_search:is_date_search, start_date:start_date, end_date:end_date
			}
		   }
		  });
		 }

		 $('#search').click(function(){
			var start = $('#start_date').data('DateTimePicker').date().toString();
			var date = new Date(start);
			var start_date = date.getFullYear()+'-'+(date.getMonth() + 1) + '-' + date.getDate();
		
			var end = $('#end_date').data('DateTimePicker').date().toString();
			var date = new Date(end);
			var end_date = date.getFullYear()+'-'+(date.getMonth() + 1) + '-' + date.getDate();
			
		if(start_date != '' && end_date !='')
		  {
		   $('#listar-financeiro').DataTable().destroy();
		   fetch_data('yes', start_date, end_date);
		  }
		  else
		  {
		   alert("Obrigatório informar o período");
		  }
		 }); 
		 
		});
</script>


	
	
<script>
	 $( function() {
      $( "#searchPaciente" ).autocomplete({
            source: function( request, response ) {
                
                $.ajax({
                    url: "fetchData.php",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
			appendTo: "#modalReceita",
		
            select: function (event, ui) {
                $('#searchPaciente').val(ui.item.label); // display the selected text
                alert(ui.item.value);	
			   // $('#selectuser_id').val(ui.item.value); // save selected id to input
                return false;
            }
        });
    });
</script>



</body>

</html>
