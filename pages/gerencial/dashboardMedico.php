<?php
session_start();
include '../opendb.php';
include_once('../func.php');

//Zerar variaveis
$totalPacientes=0;
$totalAgendamentos=0;

$totalProntuarios=0;
$totalFaturamento=0;
$totalFaturamentoDia=0;
$totalDespesas=0;


//$totalPacientes=count(getItensTable($mysql_conn,"pacientes"));
//$totalAgendamentos=count(getItensTable($mysql_conn,"agendamentos"));

//$totalProntuarios = count(getItensTable($mysql_conn, "prontuarios"));

$documentos=null;
//$documentos=(getItensTable($mysql_conn,"documentos"));


//$query = mysqli_query($mysql_conn, "SELECT format(SUM(valorRecebido),2,'de_DE') AS total FROM financeiro WHERE tipo='RECEITA' AND statusPagamento='RECEBIDA' AND DAY(dataRecebimento)=DAY(NOW()) AND MONTH(dataRecebimento)=MONTH(NOW()) GROUP BY DAY(dataRecebimento);");
//$row = mysqli_fetch_assoc($query);
//$totalFaturamentoDia = $row['total'];

//$query = mysqli_query($mysql_conn, "SELECT format(SUM(valorRecebido),2,'de_DE') AS total FROM financeiro WHERE tipo='RECEITA' AND statusPagamento='RECEBIDA' AND MONTH(dataRecebimento)=MONTH(NOW()) GROUP BY MONTH(dataRecebimento);");
//$row = mysqli_fetch_assoc($query);
//$totalFaturamento = $row['total'];

//$query = mysqli_query($mysql_conn, "SELECT format(SUM(valorRecebido),2,'de_DE') AS total FROM financeiro WHERE tipo='DESPESA' AND statusPagamento='RECEBIDA' AND MONTH(dataRecebimento)=MONTH(NOW()) GROUP BY MONTH(dataRecebimento);");
//$row = mysqli_fetch_assoc($query);
//$totalDespesas = $row['total'];
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

</head>

<body>

   <div id="wrapper">

             <!-- Navigation -->
    <!-- INCLUSÃO DO ARQUIVO MENU -->
		<?php include_once('../menu.php'); ?>


         <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard Médico</h1>
                </div>
                <!-- /.col-lg-12 -->
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
                                    <div class="huge">120</div>
                                    <div>TOTAL PROCEDIMENTOS</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Detalhar</span>
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
                                    <div class="huge">47.222.20</div>
                                    <div>TOTAL BRUTO</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Detalhar</span>
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
                                    <div class="huge">11.561,71</div>
                                    <div>TOTAL IMPOSTOS</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Detalhar</span>
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
                                    <div class="huge">35.657,48</div>
                                    <div>TOTAL LÍQUIDO</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Detalhar</span>
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
                                    <div class="huge">26.000,00</div>
                                    <div>PLANO DE SAÚDE</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Detalhar</span>
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
                                    <div class="huge">5.230,00</div>
                                    <div>SUS</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Detalhar</span>
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
                                    <div class="huge">6.900,00</div>
                                    <div>ELETIVAS</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Detalhar</span>
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
                                    <div class="huge">9.092,20</div>
                                    <div>PARTICULAR</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Detalhar</span>
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
                            <i class="fa fa-bar-chart-o fa-fw"></i> Gráfico Produção/Anual
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
                            <div id="morris-area-chart"></div>
                        </div>
                        <!-- /.panel-body -->
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
                                <div class="col-lg-8">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
													<th>Mês</th>
                                                    <th>Total procedimentos</th>
                                                    <th>Plano de Saúde</th>
                                                    <th>SUS</th>
													<th>Eletivas</th>
													<th>Particular</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr> 
													<td>JUN/19</td>
                                                    <td>3.326</td>
                                                    <td>R$ 321,00</td>
                                                    <td>R$ 1292,00</td>
                                                    <td>R$ 99,33</td>
													<td>R$ 1.099,33</td>
                                                                                              
											   </tr>
                                                <tr>
                                                    <td>JUL/19</td>
                                                      <td>3.326</td>
                                                    <td>R$ 321,00</td>
                                                    <td>R$ 1292,00</td>
                                                    <td>R$ 99,33</td>
													<td>R$ 1.099,33</td>
                                                </tr>
                                                <tr>
                                                    <td>AGO/19</td>
                                                     <td>2102</td>
                                                    <td>R$ 26.000,00</td>
                                                    <td>R$ 5.230,00</td>
                                                    <td>R$ 6.900,00</td>
													<td>R$ 9.092,20</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
								
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
                                            <h4 class="timeline-title">Lorem ipsum dolor</h4>
                                            <p><small class="text-muted"><i class="fa fa-clock-o"></i> 11 hours ago via Twitter</small>
                                            </p>
                                        </div>
                                        <div class="timeline-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero laboriosam dolor perspiciatis omnis exercitationem. Beatae, officia pariatur? Est cum veniam excepturi. Maiores praesentium, porro voluptas suscipit facere rem dicta, debitis.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-inverted">
                                    <div class="timeline-badge warning"><i class="fa fa-credit-card"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Lorem ipsum dolor</h4>
                                        </div>
                                        <div class="timeline-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem dolorem quibusdam, tenetur commodi provident cumque magni voluptatem libero, quis rerum. Fugiat esse debitis optio, tempore. Animi officiis alias, officia repellendus.</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium maiores odit qui est tempora eos, nostrum provident explicabo dignissimos debitis vel! Adipisci eius voluptates, ad aut recusandae minus eaque facere.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-badge danger"><i class="fa fa-bomb"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Lorem ipsum dolor</h4>
                                        </div>
                                        <div class="timeline-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus numquam facilis enim eaque, tenetur nam id qui vel velit similique nihil iure molestias aliquam, voluptatem totam quaerat, magni commodi quisquam.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-inverted">
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Lorem ipsum dolor</h4>
                                        </div>
                                        <div class="timeline-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates est quaerat asperiores sapiente, eligendi, nihil. Itaque quos, alias sapiente rerum quas odit! Aperiam officiis quidem delectus libero, omnis ut debitis!</p>
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
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-comment fa-fw"></i> 3 consultas agendadas
                                    <span class="pull-right text-muted small"><em>17/07/2019</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Aguardando guias 
                                    <span class="pull-right text-muted small"><em>20/07/2019</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-envelope fa-fw"></i> Pagamento do Repasse 
                                    <span class="pull-right text-muted small"><em>31/07/2019</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-tasks fa-fw"></i> Escala plantões
                                    <span class="pull-right text-muted small"><em>02/08/2019</em>
                                    </span>
                                </a>
								    <a href="#" class="list-group-item">
                                    <i class="fa fa-tasks fa-fw"></i> Reunião dos sócios
                                    <span class="pull-right text-muted small"><em>04/08/2019</em>
                                    </span>
                                </a>
                            </div>
                            <!-- /.list-group -->
                            <a href="#" class="btn btn-default btn-block">Ler todas mensagens</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Gráfico Procedimentos / Convênio
                        </div>
                        <div class="panel-body">
                            <div id="morris-donut-chart"></div>
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
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="../../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../../vendor/raphael/raphael.min.js"></script>
    <script src="../../vendor/morrisjs/morris.min.js"></script>
    <script src="../../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>

	<script>
	$(document).ready(function() {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		var result = JSON.parse(this.responseText);
	//	document.getElementById("total2").innerHTML ="AAA";
		}
		
		};
		xmlhttp.open("GET", "proc_dashboard.php");
		xmlhttp.send();
		});
    </script>
	  
<script>
/*function loadXMLDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
		
	  var result = JSON.parse(this.responseText);
	  var a1 = result[1];
		Morris.Bar({
			element: 'bar-example',
			data: [<?php echo $chart_data; ?>],
			//barColors: ['#00a65a', '#f56954'],
			xkey:'mes',
			ykeys:['agendamento', 'purchase', 'sale'],
			labels:['Agendamentos', 'Purchase', 'Sale'],
			});

			document.getElementById("demo").innerHTML = result[1];
			}
		  };
  xhttp.open("GET", "proc_dashboard.php", true);
  xhttp.send();
  
  function loadXMLDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
		
	  var result = JSON.parse(this.responseText);
	  var a1 = result[1];
		Morris.Bar({
			element: 'bar-example',
			data: [{mes: 1, agendamento: a1, purchase: 1, sale: 1}],
			//barColors: ['#00a65a', '#f56954'],
			xkey:'mes',
			ykeys:['agendamento', 'purchase', 'sale'],
			labels:['Agendamentos', 'Purchase', 'Sale'],
			});

			document.getElementById("demo").innerHTML = result[1];
			}
		  };
  xhttp.open("GET", "proc_dashboard.php", true);
  xhttp.send();
}
} */
</script>
 
<script>
/*	Morris.Bar({
			element: 'bar-example',
			data: [<?php echo $chart_data; ?>],
			//barColors: ['#00a65a', '#f56954'],
			xkey:'mes',
			ykeys:['total'],
			labels:['Receita', 'Despesa'],
			}); 
*/
</script>
	
</body>

</html>