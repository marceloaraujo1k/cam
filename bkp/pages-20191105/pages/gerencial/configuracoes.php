<?php
session_start();
include '../opendb.php';
include_once('../func.php');

	$convenios = getItensTable($mysql_conn,"convenio");
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
                    <h1 class="page-header">Configurações</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
					
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                       <div class="panel panel-default">
                        
						<div class="panel-heading">
                            Geral
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#home" data-toggle="tab">Geral</a>
                                </li>
                                <li> <a href="#profile" data-toggle="tab">Convênio</a>
                                </li>
                                <li><a href="#messages" data-toggle="tab">Procedimentos</a>
                                </li>
                                <li><a href="#settings" data-toggle="tab">Usuários</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home">
                                    <br>
									<form role="form" action="./sqlConfiguracoes.php" method="post">
											<br>
											<h4> Email </h4>
												<div class="form-group col-md-4">
												 <label>Email</label>
												<input class="form-control" name="email" required>
												<p class="help-block"></p>
											</div>
											</div>

											<div class="row"> 
												<div class="form-group col-md-4">
												
												<input type="submit" name="submit" value="alterar" class="btn btn-success" />
												<input type="submit" name="submit" value="inserir" class="btn btn-success" />
												</div>				
											</div>
										</form>
								 </div>
                                <div class="tab-pane fade" id="profile">
											<br>
											<button class="btn btn-primary" data-toggle="modal" data-target="#modalInserirConvenio">
												Novo
											</button>
												<div class="row">	
													<div class="form-group col-md-12">
													<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-convenio">
													<thead>
														<tr>
															<th>XX</th>
															<th>XX</th>
														</tr>
													</thead>
													<tbody>
													   <?php
															// Exibe a tabela 
															$query = mysqli_query($mysql_conn, "SELECT * FROM  convenio");
															
															// Extrai cada linha da tabela clientes
															while ($form = mysqli_fetch_assoc($query))
														
															{
														?>
														<tr style="cursor:pointer">
															<td><?=$form["cnpj"]?></td>
															<td><?=$form["descricao"]?></td>
															<td><button type="button" id="btnAlterar" class="btn btn btn-primary" data-id=<?=$form["idconvenio"]?> > <i class="glyphicon glyphicon-pencil  ">&nbsp;</i>Alterar</button></td>
															<td><button type="button" id="btnExcluir" class="btn btn btn-primary" data-id=<?=$form["idconvenio"]?> > <i class="glyphicon glyphicon-trash  ">&nbsp;</i>Excluir</button></td>
														</tr>
														<?php
															}
															
														?>
												</tbody>
												</table>
												</div>
											</div>
										
									  </div>


									  
                                <div class="tab-pane fade" id="messages">
								<br>
					
								</div>
                                
								<div class="tab-pane fade" id="settings">
											<!-- ABA DISPONÍVEL -->
								</div>
                         </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

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
				<div class="modal fade" id="modalInserirConvenio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="myModalLabel"></h4>
									</div>
									<div class="modal-body">
								 <form role="form" action="./sqlConvenios.php" method='post' enctype="multipart/form-data">
									

									<div class="modal-footer">
										<input type="submit" name="submit" value="alterar" class="btn btn-success" />
										<input type="submit" name="submit" value="inserir" class="btn btn-success" />
										
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

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
		
    <script>
    $(document).ready(function() {
        $('#dataTables-convenio').DataTable({
            responsive: true
        });
    });
    </script>
	
		<script>
		$(document).on('click','#btnExcluir',function(e){
            e.preventDefault();
		var id = $(this).data('id');
		 confirm("Excluir o convenio ?" +id);
		location.assign("deletePacientes.php?id="+id);
		});
	</script>
	
	<script>
		$(document).on('click','#btnAlterar',function(e){
            e.preventDefault();
		var id = $(this).data('id');
		$('#modalInserirConvenio').modal('show');
		document.getElementById('cnpj').value=id;
		});
	</script>
	
	

</body>

</html>
