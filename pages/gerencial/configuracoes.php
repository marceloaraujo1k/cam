<?php
//session_start();
include '../opendb.php';
include_once('../func.php');

	$convenios = getItensTable($mysql_conn,"convenio");
	$hospital = getItensTable($mysql_conn,"hospital");
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
                                <li class="active"><a href="#geral" data-toggle="tab">Geral</a>
                                </li>
                                <li> <a href="#plantoes" data-toggle="tab">Plantões</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="geral">
								<div class="panel-heading">
								<div>
									<form role="form" action="./sqlConfiguracoes.php" method="post">
											<h4>Parâmetros Gerais</h4>
											<div class="row">
											<div class="form-group col-md-3	">
												 <label>Razão Social</label>
												<input class="form-control" name="email" required>
												<p class="help-block"></p>
												</div>
												<div class="form-group col-md-3">
													 <label>Email</label>
													<input class="form-control" name="email" required>
													<p class="help-block"></p>
												</div>
												<div class="form-group col-md-3">
												 <label>Usuário</label>
												<input class="form-control" name="userEmail" required>
												<p class="help-block"></p>
												</div>
												<div class="form-group col-md-3">
													 <label>Senha</label>							           
                               				    	 <input class="form-control" placeholder="Password" name="passwordEmail" id="passwordEmail" type="password" value="" required>
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
								</div>
								</div> 
                                <div class="tab-pane fade" id="plantoes">
										<div class="panel-heading">
                         
											<div class="row">	
											<div>
											<br>
											</div>
											<button class="btn btn-primary" data-toggle="modal" data-target="#modalInserirConfiguracaoPlantao">
												Configurar Plantão
											</button>
											</div>
											</div>
												<div class="row">	
													<div class="form-group col-md-12">
													<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-convenio">
													<thead>
														<tr>
															<th>Plantão</th>
															<th>Início</th>
															<th>Fim</th>
															<th>Duração</th>
															<th>Legenda</th>
															<th>R$ Plantão</th>
															<th>R$ Hr/Plantao Bruto</th>
															<th>R$ Hr/Plantao Liquido</th>
															<th>PIS</th>
															<th>COFINS</th>
															<th>CSLL</th>
															<th>IRPJ</th>
															<th>ISS</th>
															<th>Deduções</th>
															<th>Aliquota</th>
															<th>Encargos</th>
														
														</tr>
													</thead>
													<tbody>
													   <?php
															// Exibe a tabela 
															$query = mysqli_query($mysql_conn, "SELECT * FROM  configuracaoplantoes");
															// Extrai cada linha da tabela clientes
															while ($form = mysqli_fetch_assoc($query))
														
															{
														?>
														<tr style="cursor:pointer">
															<td><?=$form["descricaoPlantao"]?></td>
															<td><?=$form["horarioInicioPlantao"]?></td>
															<td><?=$form["horarioFimPlantao"]?></td>
															<td><?=$form["duracaoPlantao"]?></td>
															<td><?=$form["legendaPlantao"]?></td>
															<td><?=$form["valorPlantao"]?></td>
															<td><?=$form["valorHoraPlantaoBruto"]?></td>
															<td><?=$form["valorHoraPlantaoLiquido"]?></td>
															<td><?=$form["pis"]?></td>
															<td><?=$form["cofins"]?></td>
															<td><?=$form["csll"]?></td>
															<td><?=$form["irpj"]?></td>
															<td><?=$form["iss"]?></td>
															<td><?=$form["deducoes"]?></td>
															<td><?=$form["aliquota"]?></td>
															<td><?=$form["outros_encargos"]?></td>
															<td><?=$form["cor"]?></td>
															<td><button type="button" id="btnEditar" class="btn btn btn-primary" data-id=<?=$form["idConfiguracaoPlantao"]?> > <i class="glyphicon glyphicon-pencil  ">&nbsp;</i>Editar</button></td>
															<td><button type="button" id="btnExcluir" class="btn btn btn-primary" data-id=<?=$form["idConfiguracaoPlantao"]?> > <i class="glyphicon glyphicon-trash  ">&nbsp;</i>Excluir</button></td>
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
				<div class="modal fade" id="modalInserirConfiguracaoPlantao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="myModalLabel"></h4>
									</div>
									<div class="modal-body">
								<form role="form" action="./sqlConfiguracaoPlantoes.php" method='post' enctype="multipart/form-data">
								<input type="hidden" name="idConfiguracaoPlantao" id="idConfiguracaoPlantao" />
								<div class="row">
									<div class="form-group col-md-8">
										<label for="nome">Plantão</label>
										   <input class="form-control" name="descricaoPlantao" id="descricaoPlantao">
                        			</div>

									<div class="form-group col-md-4">
										<label for="convenio">Hosp./Clín.</label>
											<select id="idhospital" name="idhospital" class="form-control">
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
									<div class="form-group col-md-3">
										<label for="nome">Hora Início</label>
										   <input class="form-control" name="horarioInicioPlantao" id="horarioInicioPlantao">
                        			</div>
									
									<div class="form-group col-md-3">
										<label for="nome">Hora Fim</label>
										   <input class="form-control" name="horarioFimPlantao" id="horarioFimPlantao">
                        			</div>
									<div class="form-group col-md-3">
										<label for="nome">Duração</label>
										   <input class="form-control" name="duracaoPlantao" id="duracaoPlantao">
                        			</div>
									
									<div class="form-group col-md-3">
										<label for="nome">Legenda</label>
										   <input class="form-control" name="legendaPlantao" id="legendaPlantao">
                        			</div>
								</div>
							
								<div class="row">
								<div class="form-group col-md-3">
										<label for="nome">Cor</label>
										   <input class="form-control" name="cor" id="cor">
                        			</div>
									<div class="form-group col-md-3">
										<label for="nome">Valor Plantão</label>
										   <input class="form-control" name="valorPlantao" id="valorPlantao">
                        			</div>
									<div class="form-group col-md-3">
										<label for="nome">Hr/Plantão Bruto</label>
										   <input class="form-control" name="valorHoraPlantaoBruto" id="valorHoraPlantaoBruto">
                        			</div>
									<div class="form-group col-md-3">
										<label for="nome">Hr/Plantão Líq.</label>
										   <input class="form-control" name="valorHoraPlantaoLiquido" id="valorHoraPlantaoLiquido">
                        			</div>
									
								</div>

							<div class="row"> 
							<div class="form-group col-md-3">
								<label for="inputPIS">PIS</label>
								<input class="form-control" name="pis" id="pis" value="<?=$form["pis"]?>">
							</div>
							<div class="form-group col-md-3">
							  <label for="inputCOFINS">COFINS</label>
							 <input class="form-control" name="cofins" id="cofins" value="<?=$form["cofins"]?>">
							</div>
						
								<div class="form-group col-md-3">
									<label for="inputCEP">CSLL</label>
									<input class="form-control" name="csll" id="csll" value="<?=$form["csll"]?>">
								</div>
							
								<div class="form-group col-md-3">
									<label for="inputCEP">IRPJ</label>
									<input class="form-control" name="irpj" id="irpj" value="<?=$form["irpj"]?>">	
								</div>
						</div>	
						<div class="row"> 
									<div class="form-group col-md-3">
											<label for="inputCEP">ISS</label>
											<input class="form-control" id="iss" name="iss" value="<?=$form["iss"]?>">	
									</div>
									<div class="form-group col-md-3">
											<label for="inputCEP">Alíquota</label>
											<input class="form-control" name="aliquota" id="aliquota" value="<?=$form["aliquota"]?>">	
									</div>
									
									<div class="form-group col-md-3">
											<label for="inputCEP">Deduções</label>
											<input class="form-control" name="deducoes" id="deducoes" value="<?=$form["deducoes"]?>">	
									</div>
									
									<div class="form-group col-md-3">
											<label for="inputCEP">Outros Encargos</label>
											<input class="form-control" name="outros_encargos" id="outros_encargos" value="<?=$form["outros_encargos"]?>">	
									</div>
							</div>								
									<div class="modal-footer">
										<input type="submit" name="submit" value="Salvar" class="btn btn-success" />
										
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
    /*$(document).ready(function() {
        $('#dataTables-convenio').DataTable({
            responsive: true
        });
    }); */
    </script>
	
		<script>
		$(document).on('click','#btnExcluir',function(e){
            e.preventDefault();
		var id = $(this).data('id');
		 confirm("Excluir o conf. plantão ?" +id);
		location.assign("deleteConfiguracaoPlantaoes.php?id="+id);
		});
	</script>
	
	<script>
$(document).on('click','#btnEditar',function(e){
    e.preventDefault();
	var id = $(this).data('id');
		confirm("Editar CONFIGURAÇÃO DO PLANTÃO ? " +id);
		
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		var result = JSON.parse(this.responseText);

		document.getElementById("idConfiguracaoPlantao").value = id;
		document.getElementById("descricaoPlantao").value = result[0][1];
		document.getElementById("idhospital").selectedIndex = result[0][2];
		document.getElementById("horarioInicioPlantao").value = result[0][3];
		document.getElementById("horarioFimPlantao").value = result[0][4];
		document.getElementById("duracaoPlantao").value = result[0][5];
		document.getElementById("legendaPlantao").value = result[0][6];
		document.getElementById("valorPlantao").value = result[0][7];
		document.getElementById("valorHoraPlantaoBruto").value = result[0][8];
		document.getElementById("valorHoraPlantaoLiquido").value = result[0][9];
		document.getElementById("pis").value = result[0][10];
		document.getElementById("cofins").value = result[0][11];
		document.getElementById("csll").value = result[0][12];
		document.getElementById("irpj").value = result[0][13];
		document.getElementById("iss").value = result[0][14];
		document.getElementById("deducoes").value = result[0][15];
		document.getElementById("aliquota").value = result[0][16];
		document.getElementById("outros_encargos").value = result[0][17];
		document.getElementById("cor").value = result[0][18];

	
		}
		
		};
		xmlhttp.open("GET", "operacoes_configuracaoPlantoes.php?id="+id, true);
		xmlhttp.send();
		$("#modalInserirConfiguracaoPlantao").modal();
		});
	</script>
		
<script>
		$('[data-dismiss=modal]').on('click', function (e) {
			$('#modalInserirConfiguracaoPlantao').on('hidden.bs.modal', function () {
			document.getElementById("idmedico").value = null;
			$(this).find('form').trigger('reset');
			});
		});
</script>
	

</body>

</html>
