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
.modal-fullscreen .modal-dialog {
  margin: 0;
  margin-right: auto;
  margin-left: auto;
  width: 100%;
}
@media (min-width: 768px) {
  .modal-fullscreen .modal-dialog {
    width: 750px;
  }
}
@media (min-width: 992px) {
  .modal-fullscreen .modal-dialog {
    width: 970px;
  }
}
@media (min-width: 1200px) {
  .modal-fullscreen .modal-dialog {
     width: 1170px;
  }
}

</style>

</head>

<body>

   <div id="wrapper">

            <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <a class="navbar-brand" href="login.php">CAM</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
               
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="../gerencial/configuracoes.php"><i class="fa fa-gear fa-fw"></i> Configurações</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../login.php"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

         <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
						 <li>
                            <a href="../gerencial/dashboard.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard </a>
                        </li>
						 <li>
                            <a href="../pacientes/pacientes.php"><i class="fa fa-user fa-fw"></i> Pacientes </a>
                        </li>
                        <li>
                            <a href="../agendamento/agendamento.php"><i class="fa fa-calendar fa-fw"></i> Agendamento </a>
                        </li>
						
						<li>
                            <a href="../financeiro/financeiro.php"><i class="fa fa-bar-chart-o fa-fw"></i> Financeiro </a>
						</li>
						<li>
                            <a href="#"><i class="fa fa-archive"></i> Administrativo<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="../usuarios/usuarios.php">Usuários</a>
                                </li>
                                <li>
                                    <a href="../gerencial/documentos.php">Documentos</a>
                                </li>
								<li>
                                    <a href="../medicos/medicos.php">Médicos</a>
								</li>
								<li>
                                    <a href="../empresa/empresa.php">Filial</a>
								</li>
                                <li>
                                    <a href="../convenios/convenios.php">Convênios</a>
								</li>
                            <li>
                                    <a href="../cid/cid.php">CID</a>
								</li>
							</ul>
                            <!-- /.nav-second-level -->
                        </li>
						
						
                    </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
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
							<button class="btn btn-lg btn-success text-center pull-right" data-toggle="modal" data-target="#modal-fullscreen">Create Invoice</button>
													
					  	</div>
							<div class="col-lg-4">
										
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
					    <table>
        <tr>
            <td>Single selection</td>
            <td><input type='text' id='autocomplete' ></td>
        </tr>

        <tr>
            <td>Selected User id</td>
            <td><input type='text' id='selectuser_id' /></td>
        </tr>
   </table>
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
						
									<div class="form-group ui-front">
										<label for="nome">Paciente</label>
										<input class="form-control"  id="autocomplete" placeholder="Digite o nome do paciente" />
							
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
					<!-- Modal UPDATE CONTA -->
				
				<div class="modal fade" id="modalAtualizaConta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="myModalLabel">Editar conta</h4>
									</div>
									<div class="modal-body">
									<form role="form" action="../financeiro/sqlFinanceiro.php" method='post'>
									<?php
									$statusPagamento = array("EM ABERTO","RECEBIDA","SALDO DEVEDOR","CANCELADA");
									?>
								<!-- PASSAGEM DE PARAMETROS -->
									<input type="hidden" name="idfinanceiro" id="idfinanceiro">
								
									<div class="form-group">
										<label for="nome">Cliente</label>
										   <input class="form-control"  name="nome" id="nome" value="<?=$form["nome"]?>">
                        			</div>
									
									<div class="form-group">
										<label for="nome">Descricao</label>
										   <input class="form-control" name="descricao" id="descricao2">
                        			</div>
									
									<div class="form-group">
										<label for="nome">Convênio</label>
										   <input class="form-control" name="convenio" id="convenio">
                        			</div>
									
									
									<div class="form-group">
										<label for="nome">Profissional</label>
										   <input class="form-control" id="nomeProfissional" name="nomeProfissional">
                        			</div>
											
							<input type="hidden" name="saldoDevedorAnt" id="saldoDevedorAnt2" value="<?=$saldoDevedorAnt?>">
							<input type="hidden" name="valorRecebidoAnt" id="valorRecebidoAnt2" value="<?=$valorRecebidoAnt?>">
							<input type="hidden" name="descontoAnt" id="descontoAnt2" value="<?=$descontoAnt?>">	
							
							<div class="row">
									<div class="form-group col-sm-3">
								
										<label for="nome">Valor R$ </label>
										   <input class="form-control" 	 name="valor" id="valor2" value="<?=$form["valor"]?>">
                        			</div>	
																
									<div class="form-group col-sm-3 offset-md-1">
										<label for="nome">Recebido R$ </label>
										   <input class="form-control" type="text" name="valorRecebido" id="valorRecebido2"  onchange="getAtualizaSaldo(this.value)">
                        			</div>
							
									<div class="form-group col-sm-3">
										<label for="nome">Desconto R$ </label>
										   <input class="form-control" type="text" name="desconto" id="desconto2"  onchange="getAtualizaSaldo(this.value)" >
                        			</div>
									
									<div class="form-group col-sm-3">
										<label for="nome">Saldo R$ </label>
										   <input class="form-control" type="text" style="background-color:pink;" name="saldoDevedor" id="saldoDevedor2">
                        			</div>
								</div>
								
									
								<div class="row">
										<div class="form-group col-md-6"> 
										<label class="control-label">Data Pagamento</label>
											<div class='input-group date' id='datetimepicker7'/>
											 <input type='text' class="form-control" name="dataRecebimento"/>
											<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
											</span>
										  </div>
										 </div>
										
										<div class="form-group col-md-6"> 
										<label class="control-label">Data Vencimento</label>
											<div class='input-group date' id='datetimepicker8'/>
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
									  <select id="inputStatusPagamento2" name="statusPagamento" class="form-control" required> 
											<option>EM ABERTO</option>
											<option>RECEBIDA</option>
											<option>SALDO DEVEDOR</option>
											<option>CANCELADA</option>									
									</select>
									</div>
									</div>
									<div class="modal-footer">
										<button type="submit" name="submit" value="atualizaConta" class="btn btn-success">Receber</button>
										
									</form>
									</div>
									</div>
								</div>
								
<div class="modal modal-fullscreen fade" id="modal-fullscreen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Create Invoice</h4>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<h2>From,</h2>
							<div class='row'>
								<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
									<div class="form-group">
										<input type="email" class="form-control" id="companyName" placeholder="Company Name">
									</div>
									<div class="form-group">
										<textarea class="form-control" rows='3' id="companyAddress" placeholder="Your Address"></textarea>
									</div>
								</div>
							</div>
							<h2>To,</h2>
							<div class='row'>
								<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
									<div class="form-group">
										<input type="email" class="form-control" id="clientCompanyName" placeholder="Company Name">
									</div>
									<div class="form-group">
										<textarea class="form-control" rows='3' id="clientAddress" placeholder="Your Address"></textarea>
									</div>
									
								</div>
								<div class='col-xs-12 col-sm-offset-3 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-4 col-lg-4'>
									<div class="form-group">
										<input type="number" class="form-control" id="invoiceNo" placeholder="Invoice No">
									</div>
									<div class="form-group">
										<input type="date" class="form-control" id="invoiceDate" placeholder="Invoice Date">
									</div>
									<div class="form-group">
										<input type="number" class="form-control amountDue" id="amountDueTop" placeholder="Amount Due">
									</div>
								</div>
							</div>
							<h2>&nbsp;</h2>
							<div class='row'>
								<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
									<table class="table table-bordered table-hover" id="table_auto">
										<thead>
											<tr>
												<th width="2%"><input id="check_all" class="formcontrol" type="checkbox"/></th>
												<th width="15%">Item No</th>
												<th width="38%">Item Name</th>
												<th width="15%">Price</th>
												<th width="15%">Quantity</th>
												<th width="15%">Total</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><input class="case" type="checkbox"/></td>
												<td><input type="text" data-type="productCode" name="itemNo[]" id="itemNo_1" class="form-control autocomplete_txt" autocomplete="off"></td>
												<td><input type="text" data-type="productName" name="itemName[]" id="itemName_1" class="form-control autocomplete_txt" autocomplete="off"></td>
												<td><input type="number" name="price[]" id="price_1" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
												<td><input type="number" name="quantity[]" id="quantity_1" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
												<td><input type="number" name="total[]" id="total_1" class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							
							<div class='row'>
								<div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
									<button class="btn btn-danger delete" type="button">- Delete</button>
									<button class="btn btn-success addmore" type="button">+ Add More</button>
								</div>
								<div class='col-xs-12 col-sm-offset-4 col-md-offset-4 col-lg-offset-4 col-sm-5 col-md-5 col-lg-5'>
									<form class="form-inline">
										<div class="form-group">
											<label>Subtotal: &nbsp;</label>
											<div class="input-group">
												<div class="input-group-addon">$</div>
												<input type="number" class="form-control" id="subTotal" placeholder="Subtotal" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
											</div>
										</div>
										<div class="form-group">
											<label>Tax: &nbsp;</label>
											<div class="input-group">
												<div class="input-group-addon">$</div>
												<input type="number" class="form-control" id="tax" placeholder="Tax" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
											</div>
										</div>
										<div class="form-group">
											<label>Tax Amount: &nbsp;</label>
											<div class="input-group">
												<input type="number" class="form-control" id="taxAmount" placeholder="Tax" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
												<div class="input-group-addon">%</div>
											</div>
										</div>
										<div class="form-group">
											<label>Total: &nbsp;</label>
											<div class="input-group">
												<div class="input-group-addon">$</div>
												<input type="number" class="form-control" id="totalAftertax" placeholder="Total" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
											</div>
										</div>
										<div class="form-group">
											<label>Amount Paid: &nbsp;</label>
											<div class="input-group">
												<div class="input-group-addon">$</div>
												<input type="number" class="form-control" id="amountPaid" placeholder="Amount Paid" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
											</div>
										</div>
										<div class="form-group">
											<label>Amount Due: &nbsp;</label>
											<div class="input-group">
												<div class="input-group-addon">$</div>
												<input type="number" class="form-control amountDue" id="amountDue" placeholder="Amount Due" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
											</div>
										</div>
									</form>
								</div>
							</div>
							
							<h2>Notes: </h2>
							<div class='row'>
								<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
									<div class="form-group">
										<textarea class="form-control" rows='5' id="notes" placeholder="Your Notes"></textarea>
									</div>
								</div>
							</div>
						
							<!-- End Here -->
						
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

			
	<!-- /#page-wrapper -->
	
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!--
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	-->	
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

    <!-- Script -->
    <script type='text/javascript' >
   
    </script>

	
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
      $( "#autocomplete" ).autocomplete({
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
		
            select: function (event, ui) {
                $('#autocomplete').val(ui.item.label); // display the selected text
                $('#selectuser_id').val(ui.item.value); // save selected id to input
                return false;
            }
        });

    });	
</script>

<script>
$(document).on('focus','.autocomplete_txt',function(){
	type = $(this).data('type');
	
	if(type =='productCode' )autoTypeNo=0;
	if(type =='productName' )autoTypeNo=1; 	
	
	$(this).autocomplete({
		source: function( request, response ) {
			$.ajax({
				url : 'ajax.php',
				dataType: "json",
				method: 'post',
				data: {
				   name_startsWith: request.term,
				   type: type
				},
				 success: function( data ) {
					 response( $.map( data, function( item ) {
					 	var code = item.split("|");
						return {
							label: code[autoTypeNo],
							value: code[autoTypeNo],
							data : item
						}
					}));
				}
			});
		},
		autoFocus: true,	      	
		minLength: 0,
		appendTo: "#modal-fullscreen",
		select: function( event, ui ) {
			var names = ui.item.data.split("|");
			id_arr = $(this).attr('id');
	  		id = id_arr.split("_");
	  		console.log(names, id);
	  		
			$('#itemNo_'+id[1]).val(names[0]);
			$('#itemName_'+id[1]).val(names[1]);
			$('#quantity_'+id[1]).val(1);
			$('#price_'+id[1]).val(names[2]);
			$('#total_'+id[1]).val( 1*names[2] );
			calculateTotal();
		}		      	
	});
});

</script> 

</body>

</html>
