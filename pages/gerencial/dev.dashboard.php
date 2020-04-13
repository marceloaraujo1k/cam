<?php
session_start();
include '../opendb.php';
include_once('../func.php');


if((!isset ($_SESSION['user']) == true) and (!isset ($_SESSION['idempresa']) == true) and (!isset ($_SESSION['idfuncao']) == true))
{
  unset($_SESSION['user']);
  unset($_SESSION['idempresa']);
  unset($_SESSION['idfuncao']);
  
  session_destroy();
  header('location:../login.php');
  }


$usuarioLogado = $_SESSION['user'];
$usuarioFuncao = $_SESSION['idfuncao'];
  
//Zerar variaveis
$totalPacientes=0;
$totalAgendamentos=0;

$totalProntuarios=0;
$totalFaturamento=0;
$totalFaturamentoDia=0;
$totalDespesas=0;



$documentos=null;
$documentos = getItensTable($mysql_conn,"documentos");


$empresa = getItensTable($mysql_conn,"empresa");
$agendamentos = getItensTable($mysql_conn,"agendamentos");
$pacientes = getItensTable($mysql_conn,"pacientes");
$convenios = getItensTable($mysql_conn,"convenio");
$hospital = getItensTable($mysql_conn,"hospital");
$totalProducao = count(getItensTable($mysql_conn, "producao"));
$medicos = getItensTable($mysql_conn, "medicos");

$nomeUsuario = null;
$idmedico;
for($i=0; $i<count($medicos); $i++)
{
    if ($medicos[$i]['idusuario'] == $usuarioLogado) {
        $nomeUsuario = $medicos[$i]['nome'];
        $idmedico = $medicos[$i]['idmedico'];
    }
}

?>


<!-- LINKS UTEIS
 https://www.webslesson.info/2017/03/morrisjs-chart-with-php-mysql.html -->


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

	
	<!-- Calendário --> 
				<link href='../../css/fullcalendar.min.css' rel='stylesheet' />
				<link href='../../css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
				<script src='../../lib/jquery.min.js'></script>
			
                <script src='../../lib/moment.min.js'></script>
				<script src='../../js/fullcalendar.min.js'></script>
				<link href='../../css/personalizado.css' rel='stylesheet' />
		    	<script src='../../locale/pt-br.js'></script>
	
</head>



<style>
	<!-- Calendário --> 
  #calendar {
    max-width: 300px;
    margin: 0 auto;
  }

</style>
	
	<script>
	<!-- Calendário --> 
		$(document).ready(function() {
				$('#calendar').fullCalendar({
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'month,agendaWeek,agendaDay'
					},

					defaultDate: Date(),
					navLinks: true, // can click day/week names to navigate views
					editable: true,
					eventLimit: true, // allow "more" link when too many events
					events: [
						<?php
							for($i=0; $i<count($agendamentos); $i++)
								{
								?>
								{
								id: '<?php echo $agendamentos[$i]['idpaciente']; ?>',
								<?php for($j=0; $j<count($pacientes); $j++)
											{
												if($agendamentos[$i]['idpaciente'] == $pacientes[$j]['idpaciente'])
												{ 
											?>	
												 <?php $paciente =  $pacientes[$j]['nome']; ?>
										<?php	
												} 
											}
										?>
											<?php for($j=0; $j<count($medicos); $j++)
											{
												if($agendamentos[$i]['idmedico'] == $medicos[$j]['idmedico'])
												{ 
											?>	
												 <?php $medico =  $medicos[$j]['nome']; ?>
										<?php	
												} 
											}
										?>
										<?php for($j=0; $j<count($convenios); $j++)
											{
												if($agendamentos[$i]['idconvenio'] == $convenios[$j]['idconvenio'])
												{ 
											?>	
												
                                                <?php $convenio =  $convenios[$j]['descricao']; ?>
										<?php	
												} 
											}
										?>	
                                        		title: '<?php echo  $paciente . " - ".  $convenio . " - Dr(a)." . $medico;?>',	
												
								url: './inserirAgendamento.php?edit&id='+'<?php  echo $agendamentos[$i]['idconsultas']; ?>',
								start: '<?php echo $agendamentos[$i]['dataInicio']; ?>',
								end: '<?php echo $agendamentos[$i]['dataFim']; ?>',
								color: '<?php echo $agendamentos[$i]['cor']; ?>'
								},
								<?php
							}
						?>
					]
				});
			})

</script>
<body>

   <div id="wrapper">

             <!-- Navigation -->
    <!-- INCLUSÃO DO ARQUIVO MENU -->
		<?php include_once('../menu.php'); ?>


         <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard Administrativo</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
               <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                    <div class="panel-heading">
					<!-- /.panel-heading -->
					<!-- FILTRAR POR FILIAL - DATA  -->
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
									  <label for="filtroConvenico">Filtrar convênio</label>
									  <select id="filtroConvenio" name="filtroConvenio" class="form-control"> 
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
									
						<div class="form-group col-lg-2">
						<br>
									<label for="medico">Filtrar por médico</label>
											<select id="filtroMedico" name="idmedico" class="form-control">
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

                       <div class="form-group col-lg-2">
									<br>
									  <label for="filtroData">Filtrar por</label>
										<select id="filtroData" name="filtroData" class="form-control"> 
												<option value="0">Data de Realização</option>
												<option value="1">Data de Cobrança</option>
												<option value="2">Data de Pagamento</option>
												<option value="3">Data de Repasse</option>
										</select>
						</div>                     
                        <div class="form-group col-lg-2"> 
								<br>
								<p id="resultado"></p>
								<br>
								<input type="button" name="search" id="search" value="Filtrar" class="btn btn-default" />
						</div> 
                        <div class="form-group col-lg-2"> 
							 
								<p id="resultado"></p>
								 
								<input type="button"  name="relatorio" id="report" value="Relatório" class="btn btn-default" />
						</div>                           
					</div>
					</div>
					
					</div>
			    <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
							    <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge" id="totalProcedimentos">0</div>
                                    <div>TOTAL PROCEDIMENTOS</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left"></span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                               <div class="col-xs-3">
                                    <i class="fa fa-3x"><b> R$</b> </i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge" id="totalBruto">0,00</div>
                                    <div>TOTAL BRUTO</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left"></span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                               <div class="col-xs-3">
                                    <i class="fa fa-3x"><b> R$</b> </i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge" id=totalImpostos>0,00</div>
                                    <div>TOTAL IMPOSTOS</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left"></span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                             <div class="col-xs-3">
                                    <i class="fa fa-3x"><b> R$</b> </i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge" id="totalLiquido">0,00</div>
                                    <div>TOTAL LÍQUIDO</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left"></span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
			
			 <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
								<div class="col-xs-3">
                                    <i class="fa fa-3x"><b> R$</b> </i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge" id="totalPlanoSaude">0,00</div>
                                    <div>PLANO DE SAÚDE</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left"></span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                               <div class="col-xs-3">
                                    <i class="fa fa-3x"><b> R$</b> </i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge" id=totalSUS>0,00</div>
                                    <div>SUS</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left"></span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                               <div class="col-xs-3">
                                    <i class="fa fa-3x"><b> R$</b> </i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge" id="totalEletivas">0,00</div>
                                    <div>ELETIVAS</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left"></span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                             <div class="col-xs-3">
                                    <i class="fa fa-3x"><b> R$</b> </i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge" id="totalParticular">0,00</div>
                                    <div>PARTICULAR</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left"></span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa  fa-table fa-fw"></i> Produção médica no período
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Filtrar
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped" id="listar-producao">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Data</th>
                                                    <th>No. NF</th>
                                                    <th>Paciente</th>
                                                    <th>Cod.</th>
                                                    <th>Procedimento</th>
                                              		<th>Status</th>
													<th>Data Repasse</th>
                                                    <th>Valor</th>
                                                </tr>
                                            </thead>
                                          </table>
                                    </div>
                                    <!-- /.table-responsive -->
                            </div>
                         <!-- /.panel-body -->
                        </div>
                    </div>    
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Gráfico Produção Médica Mensal
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Filtrar
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                          
						
				    		</div>
				 <div class="row">
                                <!-- /.col-lg-4 (nested) -->
                          <div class="col-lg-8">
                                    <div id="morris-bar-chart"></div>
                                </div>
                                <!-- /.col-lg-8 (nested) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-clock-o fa-fw"></i> Linha do tempo
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <ul class="timeline">
                                <li>
                                    <div class="timeline-badge"><i class="fa fa-check"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title"></h4>
                                            <p><small class="text-muted"><i class="fa fa-clock-o"></i> 11 hours ago via Twitter</small>
                                            </p>
                                        </div>
                                        <div class="timeline-body">
                                        <p></p>
                                            
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-inverted">
                                    <div class="timeline-badge warning"><i class="fa fa-credit-card"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title"></h4>
                                        </div>
                                        <div class="timeline-body">
                                            <p></p>
                                            <p></p>
                                            
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-badge danger"><i class="fa fa-bomb"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title"></h4>
                                        </div>
                                        <div class="timeline-body">
                                        <p></p>
                                                </div>
                                    </div>
                                </li>
                                <li class="timeline-inverted">
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title"></h4>
                                        </div>
                                        <div class="timeline-body">
                                        <p></p>
                                                </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Notificações
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
								<?php
							
								if (!empty($documentos)) {
								for($i=0; $i<count($documentos); $i++)
								{
								?>
                                <a href="visualizarDocumentos.php?id=<?php echo $documentos[$i]['iddocumentos']?>" class="list-group-item">
                                    <i class="fa fa-comment fa-fw"></i><?=$documentos[$i]['descricao']?>
                                    <span class="pull-right text-muted small"><em><?=$documentos[$i]['data']?></em>
                                    </span>
                                </a>
								<?php
								}
								}
								else 
								{ 
								?>
								  <a href="#" class="list-group-item">
                                    <i class="fa fa-comment fa-fw"></i> SEM NOTIFICAÇÕES
                                    <span class="pull-right text-muted small"><em></em>
                                    </span>
                                </a>
								<?php
								}
								
								?>
                            </div>
                            <!-- /.list-group -->
                            <a href="documentos.php" class="btn btn-default btn-block">Ver Documentos</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-fw"></i> Agenda
							</div>
                        <div class="panel-body">
                                   <div id='calendar'>
                            <a href="#" class="btn btn-default btn-block">Detalhar</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                   
                        <!-- /.panel-heading -->
                        <div class="panel-body">
               
                        </div>
                        <!-- /.panel-body -->
                        <div class="panel-footer">
                            <div class="input-group">
                                <input id="btn-input" type="text" class="form-control input-sm" placeholder="Digite sua mensagem..." />
                                <span class="input-group-btn">
                                    <button class="btn btn-warning btn-sm" id="btn-chat">
                                        Enviar
                                    </button>
                                </span>
                            </div>
                        </div>
                        <!-- /.panel-footer -->
                    </div>
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    </div>
  <!-- AUTOCOMPLETE BOOTSTRAP -->
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
											<option value="0">Produção Médica</option>
											<option value="1">Plano de Saúde</option>
											<option value="2">SUS</option>
											<option value="3">Eletivas</option>
											<option value="4">Particular</option>
											<option value="5">Plantões</option>
																								
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
												<option value="0">Data de Realização</option>
												<option value="1">Data de Cobrança</option>
												<option value="2">Data de Pagamento</option>
												<option value="3">Data de Repasse</option>
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
										<button  type="button" id="btnVisualizar" class="btn btn-primary" title="Relatório" onclick="relatorios()">Imprimir </button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>		

    <!-- Bootstrap Core JavaScript -->
 
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
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>	
	
    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>
	<!-- TRABALIHAR COM MOEDAS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
	 <!-- Use with CHECKBOX selected  -->
	<script src="../../js/dataTables.checkboxes.min.js"></script>
	
	<script>
	$(document).ready(function() {
        $('#start_date').datetimepicker({
			format:'DD/MM/YYYY'
		});
		
		 $('#end_date').datetimepicker({
			format:'DD/MM/YYYY'
		});

		
	$('#search').click(function(){
	    var start = $('#start_date').data('DateTimePicker').date().toString();
		var date = new Date(start);
		var start_date = date.getFullYear()+'-'+(date.getMonth() + 1) + '-' + date.getDate();
		var end = $('#end_date').data('DateTimePicker').date().toString();
		var date = new Date(end);
		var end_date = date.getFullYear()+'-'+(date.getMonth() + 1) + '-' + date.getDate();
        $('#listar-producao').DataTable().destroy();
		if(start_date != '' && end_date !='')
		  {
		    $('#listar-producao').DataTable().destroy();
            filterData = document.getElementById("filtroData").value;
			filterConvenio = $("#filtroConvenio").find('option:selected').val();
			filterMedico  = $("#filtroMedico").find('option:selected').val();
            fetch_data('yes', start_date, end_date, filterData, filterConvenio, filterMedico);
		  }
		  else
		  {
		   alert("Obrigatório informar o período");
		  }
		 });


        function fetch_data(is_date_search, start_date='', end_date='', filterData, filterConvenio, filterMedico)
		{
        $.ajax({
			url:"proc_dashboard.php",
			type:"POST",
            dataType: "json",
			data:{
			 is_date_search:is_date_search, start_date:start_date, end_date:end_date, filterData:filterData, filterConvenio: filterConvenio, filterMedico: filterMedico
			},
            beforeSend:function(){ 
            },  
			success:function(result){ 
                //Retorna ARRAY dos JSON  
                  
                    // Retorna os valores totais por CONVENIO

                     document.getElementById("totalPlanoSaude").innerHTML = result.totalPlanoSaude;
                     document.getElementById("totalSUS").innerHTML = result.totalSUS;
                     document.getElementById("totalEletivas").innerHTML = result.totalEletivas;
                     document.getElementById("totalParticular").innerHTML = result.totalParticular;
                     var proc = result;
                     document.getElementById("totalProcedimentos").innerHTML =proc['data'][0][1];
                     document.getElementById("totalBruto").innerHTML = result.totalBruto;
                     document.getElementById("totalLiquido").innerHTML = result.totalLiquido;
                     document.getElementById("totalImpostos").innerHTML = result.totalImpostos;
				}  
		   });

             var table = $('#listar-producao').DataTable({
				"processing": true,
				"serverSide": true,
				"select": true,
                extend: 'collection',
                text: 'Export',
				     dom: 'lBfrtip',
                buttons: [
                     {
					 extend: 'excelHtml5',
                     exportOptions: {
						columns:  [1,2,3,4,5,6,7,8],
							format: {
              		 body: function ( data, row, column, node ) {
              		      //Strip $ column to make it numeric
             			     //return (column === 13)  ? //data.replace( /[$,]/g, '' ) :	 data;
							  if ((column ==8)) {
								data = data.replace(/[\D]+/g, "" );
								var tmp = parseInt(data);
								tmp=tmp/100;
								tmp = tmp.toFixed(2);
								$("#tmp").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: true});
								return data=tmp;
							  }
							  else 	
							 { 
								 return data;	
							}
						}	
		            }
					}
					 
					 },
					 {
                    extend: 'pdfHtml5',
                     exportOptions: {
						columns:  [1,2,3,4,5,6,7,8],
					}
					},
					 {
					 extend: 'print',
                     exportOptions: {
						columns:  [1,2,3,4,5,6,7,8],
							 }
					    },
					{
						text: 'Relatório',
						action: function ( e, dt, node, config ) {
                            var usuarioFuncao = <?php echo  $usuarioFuncao ?>;
                            var idmedico = <?php echo $idmedico?>;
                            if ((usuarioFuncao != 1) || (usuarioFuncao !=3)) { 
                                document.getElementById('medico_report').disabled = true;
                                document.getElementById('medico_report').value = idmedico;
                            }  
                            $("#modalRelatorio").modal("show");
						},
					}],
				"ajax": {
					"url": "proc_producao.php",
					"type": "POST",
                    "data":{
                        is_date_search:is_date_search, start_date:start_date, end_date:end_date, filterData:filterData, filterConvenio: filterConvenio, filterMedico: filterMedico
	                }
				}
			});
	      }
        });
 </script>
 
 <script>
     $("#report").click(function(){
        var usuarioFuncao = <?php echo  $usuarioFuncao ?>;
        var idmedico = <?php echo $idmedico?>;
        if ((usuarioFuncao != 1) || (usuarioFuncao !=3)) { 
             document.getElementById('medico_report').disabled = true;
            document.getElementById('medico_report').value = idmedico;
        }   
        $("#modalRelatorio").modal("show");
        });
</script>

<script>
	
</script>

 <script>
		$( document ).ready(function() {
			$('#start_date_report').datetimepicker({
			defaultDate: new Date(),
			format:'DD/MM/YYYY HH:mm'
			});
		});
 </script>
 
  <script>
		$( document ).ready(function() {
			$('#end_date_report').datetimepicker({
			defaultDate: new Date(),
			format:'DD/MM/YYYY HH:mm'
			});
		});
 </script>

<script>
		$( document ).ready(function() {
           var usuarioFuncao = <?php echo  $usuarioFuncao ?>;
            alert("<?php echo 'Bem vindo! '. $nomeUsuario ?>");
         if ((usuarioFuncao != 1) || (usuarioFuncao !=3)) { 
               document.getElementById('filtroMedico').disabled = true;
               document.getElementById('filtroMedico').value = <?php echo $idmedico;?>
        	  }    
		});
 </script>

<script>
	function relatorios() {
		$(document).on('click','#btnVisualizar',function(e){
			e.preventDefault();
					var start = $('#start_date_report').data('DateTimePicker').date().toString();
					var date = new Date(start);
					var start_date = date.getFullYear()+'-'+(date.getMonth() + 1) + '-' + date.getDate();
				
					var end = $('#end_date_report').data('DateTimePicker').date().toString();
					var date = new Date(end);
					var end_date = date.getFullYear()+'-'+(date.getMonth() + 1) + '-' + date.getDate();

                        
            		var idmedico = $("#medico_report").find('option:selected').val();
					
                    var idhospital = $("#hospital_report").find('option:selected').text();
					var filtroDataTipo = $("#filtroData0").find('option:selected').val();
					
				   var id = document.getElementById("tipoRelatorio").value;
					switch (id) {
						case '0':
							window.open("../financeiro/relatorioProducaoMedica.php?id="+idmedico+"&start_date="+start_date+"&end_date="+end_date+"&filtroDataTipo="+filtroDataTipo);
							break;
						
						case '1':
							window.open("../financeiro/relatorioPlanodeSaude.php?id="+idmedico+"&start_date="+start_date+"&end_date="+end_date+"&filtroDataTipo="+filtroDataTipo+"&hospital="+idhospital);
							break;

						case '2':
							window.open("../financeiro/relatorioFaturaSUS.php?id="+idmedico+"&start_date="+start_date+"&end_date="+end_date+"&filtroDataTipo="+filtroDataTipo+"&hospital="+idhospital);
							break;	
							
						case '3':
							window.open("../financeiro/relatorioFaturaEletivas.php?id="+idmedico+"&start_date="+start_date+"&end_date="+end_date+"&filtroDataTipo="+filtroDataTipo+"&hospital="+idhospital);
							break;	

						case '4':
							window.open("../financeiro/relatorioParticular.php?id="+idmedico+"&start_date="+start_date+"&end_date="+end_date+"&filtroDataTipo="+filtroDataTipo+"&hospital="+idhospital);
							break;	
							
						default:
							text = "No value found";
							}
						});
				}
</script>
</body>

</html>