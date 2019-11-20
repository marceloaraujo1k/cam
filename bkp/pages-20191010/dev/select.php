<?php
session_start();
include '../opendb.php';
include_once('../func.php');

$empresa = getItensTable($mysql_conn,"empresa");
?>

<style>
   .pink {
  background-color: pink !important;
}
</style>

<!DOCTYPE html>
<html lang="pt">

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
                    <h1 class="page-header">Médicos</h1>
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
                      	<div class="row">
							<div class="col-lg-2">
						
					    <button class="btn btn-primary" data-toggle="modal" data-target="#modalUsuario">Inserir Médico</button>
						</div>
						
						<div class="container" style="margin:15px auto">
						  <form id="frm-example" action="" method="POST">
						<div>
						
						<p><b>Selected rows data:</b></p>
							<pre id="example-console-rows"></pre>
							<p><b>Form data as submitted to the server:</b></p>
							<pre id="example-console-form"></pre>
							<p><button class="btn btn-danger">View Selected</button></p>
									
						</div>
			
                       </form>
						</div>
						</div>
						</div>
						  <div class="panel-body">
							<table width="100%" class="display table table-bordered table-striped table-hover" id="listar-medicos">
                                <thead>
                                    <tr>
									<!-- FILIAL CODIDGO DA UNIDADE - TIPO (RECEITA/DESPESA) - DESCRIÇÃO - CATEGORIA - DATA - VALOR - STATUS - BTN-DETALHES -->
										<th></th>
								 		<th>Nome</th>
										<th>RG</th>
										<th>CPF</th>
										<th>CRM</th>
										<th>Especialidade</th>
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
        <!-- /#page-wrapper -->

 
    <!-- /#wrapper -->

			<!-- Bootstrap Modal - To Add New Record -->
									<!-- Modal -->
				<div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="myModalLabel">Inserir Médico</h4>
									</div>
									<div class="modal-body">
								 <form role="form" action="./sqlMedicos.php" method='post' enctype="multipart/form-data">
									
									<input type="hidden" name="id" id="idmedico" />
									
									
									
									<div class="row">
									<div class="form-group col-md-12">
										<label for="nome">Nome</label>
										   <input class="form-control" name="nome" id="nome">
                        			</div>
									</div>
								
								<div class="row">
									<div class="form-group col-md-6">
										<label>RG</label>
										 <input class="form-control" name="rg" id="rg">
									</div>
									<div class="form-group col-md-6">
										<label>CPF</label>
										 <input class="form-control" name="cpf" id="cpf">
									</div>
							</div>
									
								<div class="row">
									<div class="form-group col-md-6">
										<label>CRM</label>
										 <input class="form-control" name="crm" id="crm">
									</div>
									<div class="form-group col-md-6">
										<label>Especialidade</label>
										 <input class="form-control" name="especialidade" id="especialidade">
									</div>
								
								</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" id="btn-close" data-dismiss="modal">Fechar</button>
										<button type="submit" class="btn btn-success">Enviar</button>
									</div>	
								</form>
							</div>
						</div>
					</div>
				</div>
									
	</div>
 
	
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
	 

    <!-- Use with CHECKBOX selected  -->
	<script src="../../js/dataTables.checkboxes.min.js"></script>
    
<!--	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
<!--		<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>  -->


    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>

	
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>

    </script>
	
	
	    <script>
        $(document).ready(function() {
           var table = $('#listar-medicos').DataTable({
              'ajax': 'proc_medicos.php',
              'columnDefs': [
                 {
                    'targets': 0,
                    'checkboxes': {
                       'selectRow': true
                    }
                 }
              ],
              'select': {
                 'style': 'multi'
              },
              'order': [[1, 'asc']]
           });
		   
           $('#frm-example').on('submit', function(e){
              var form = this;
              var rows_selected = table.column(0).checkboxes.selected();
              $.each(rows_selected, function(index, rowId){
				  alert(rows_selected);
                 $(form).append(
                     $('<input>')
                        .attr('type', 'hidden')
                        .attr('name', 'id[]')
                        .val(rowId)
                 );
              });    
              $('#example-console-rows').text(rows_selected.join(","));
              $('#example-console-form').text($(form).serialize());
              $('input[name="id\[\]"]', form).remove();
              e.preventDefault();
           });   
        });
    </script>
	  
	  

	  
	  
	

	
	<script>
		$(document).on('click','#btnExcluir',function(e){
            e.preventDefault();
		var id = $(this).data('id');
		 confirm("Excluir MÉDICO ? " +id);
		location.assign("deleteMedicos.php?id="+id);
		});
	</script>	
	
	
	<script>
		$(document).on('click','#btnEditar',function(e){
        e.preventDefault();
		var id = $(this).data('id');
		confirm("Editar MÉDICO ? " +id);
		
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		var result = JSON.parse(this.responseText);
		document.getElementById("idmedico").value = id;
		document.getElementById("nome").value = result[0][1];
		document.getElementById("rg").value = result[0][2];
		document.getElementById("cpf").value = result[0][3];
		document.getElementById("crm").value = result[0][4];
		document.getElementById("especialidade").value = result[0][5];
		
		}
		
		};
		xmlhttp.open("GET", "operacoes_medicos.php?id="+id, true);
		xmlhttp.send();
		$("#modalUsuario").modal();
		});

	</script>	
	
		<script>
		$('[data-dismiss=modal]').on('click', function (e) {
			$('#modalUsuario').on('hidden.bs.modal', function () {
			document.getElementById("idmedico").value = null;
			$(this).find('form').trigger('reset');
			});
		});
	</script>
</body>

</html>
