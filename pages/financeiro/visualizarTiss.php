
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


   <div class="modal fade" id="modalGuiaProducaoMedica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="myModalLabel">Guia Produção Médica</h4>
									</div>
									<div class="modal-body">
								 <form role="form" action="" method='post' enctype="multipart/form-data">
						<!--		<input type="hidden" name="id" id="idproducao1" /> -->
                                <div class="row">
     
<?php
/*
* Criando e exportando planilhas do Excel
* /
*/



ini_set('display_errors', false);
include '../opendb.php';
include_once('../func.php');
// Definimos o nome do arquivo que será exportado
$arquivo = 'planilhaTISS'.date(Ymd).'.xls';
// Criamos uma tabela HTML com o formato da planilha

// Exibe a tabela 


$id = $_GET['id']; 
$dataStart = $_GET['start_date'];
$dataEnd = $_GET['end_date'];

/*$query = mysqli_query($mysql_conn, "SELECT P.idproducao, P.dataRealizacao, P.idpaciente, P.paciente,
P.carteiraPaciente,  P.hospital, P.idmedico, P.medico, (SELECT crm  FROM medicos M where M.idmedico = P.idmedico) as crmMedico,
P.codigoProcedimento, P.descricaoProcedimento, P.valorProcedimento, P.quantidade, P.adicional, P.redutor FROM producao as P where  dataCobranca BETWEEN '$dataStart' and '$dataEnd'
and idconvenio = (SELECT idconvenio FROM convenio WHERE DESCRICAO='$id' LIMIT 1)");
*/



$query = mysqli_query($mysql_conn, "SELECT *, P.idproducao, P.dataRealizacao, P.idpaciente, P.paciente,
P.carteiraPaciente,  P.hospital, P.idmedico, P.medico, (SELECT crm  FROM medicos M where M.idmedico = P.idmedico) as crmMedico,
P.codigoProcedimento, P.descricaoProcedimento, P.valorProcedimento, P.quantidade, P.adicional, P.redutor FROM producao as P where  dataCobranca BETWEEN '$dataStart' and '$dataEnd'
and idconvenio = (SELECT idconvenio FROM convenio WHERE DESCRICAO='$id' LIMIT 1)");

// Extrai cada linha da tabela clientes

$dadosXls  = "";
$dadosXls .= "  <table id='example' border='1' >";
$dadosXls .= "          <tr>";
$dadosXls .= "<th><b>idproducao</b></th>";
$dadosXls .= "<th><b>dataRealizacao</b></th>";
$dadosXls .= "<th><b>idpaciente</b></th>";
$dadosXls .= "<th><b>idmedico</b></th>";
$dadosXls .= "<th><b>idprocedimentos</b></th>";
$dadosXls .= "<th><b>paciente</b></th>";
$dadosXls .= "<th><b>carteiraPaciente</b></th>";
$dadosXls .= "<th><b>medico</b></th>";
$dadosXls .= "<th><b>convenio</b></th>";
$dadosXls .= "<th><b>hospital</b></th>";
$dadosXls .= "<th><b>codigoProcedimento</b></th>";
$dadosXls .= "<th><b>descricaoProcedimento</b></th>";
//12
$dadosXls .= "<th><b>valorProcedimento</b></th>";
$dadosXls .= "<th><b>quantidade</b></th>";
$dadosXls .= "<th><b>adicional</b></th>";
$dadosXls .= "<th><b>redutor</b></th>";
$dadosXls .= "<th><b>valorRecebido</b></th>";
$dadosXls .= "<th><b>glosa</b></th>";
$dadosXls .= "<th><b>saldo</b></th>";
//19
$dadosXls .= "<th><b>dataPagamento</b></th>";
$dadosXls .= "<th><b>dataCobranca</b></th>";
$dadosXls .= "<th><b>dataRepasse</b></th>";
$dadosXls .= "<th><b>dataPrevisaoPagamento</b></th>";
$dadosXls .= "<th><b>notaFiscal</b></th>";
$dadosXls .= "<th><b>protocolo</b></th>";
$dadosXls .= "<th><b>formaPagamento</b></th>";
$dadosXls .= "<th><b>statusPagamento</b></th>";
$dadosXls .= "<th><b>observacao</b></th>";
$dadosXls .= "<th><b>medicoCirurgiao</b></th>";
//29
$dadosXls .= "<th><b>tipoGuia</b></th>";
$dadosXls .= "<th><b>numeroGuia</b></th>";
$dadosXls .= "<th><b>guiaPrincipal</b></th>";
$dadosXls .= "<th><b>dataAutorizacao</b></th>";
$dadosXls .= "<th><b>senhaAutorizacao</b></th>";
$dadosXls .= "<th><b>dataValidadeSenha</b></th>";
$dadosXls .= "<th><b>dataEmissaoGuia</b></th>";
$dadosXls .= "<th><b>tipoPlano</b></th>";
$dadosXls .= "<th><b>dataValidadeCarteira</b></th>";
$dadosXls .= "<th><b>numeroCartaoNacionalSaude</b></th>";
$dadosXls .= "<th><b>codigoContratado</b></th>";
$dadosXls .= "<th><b>nomeContratado</b></th>";
$dadosXls .= "<th><b>atendimentoRN</b></th>";
$dadosXls .= "<th><b>codCNES</b></th>";
$dadosXls .= "<th><b>codigoContratadoExecutante</b></th>";
$dadosXls .= "<th><b>nomeContratadoExecutante</b></th>";
$dadosXls .= "<th><b>grauParticipacao</b></th>";
$dadosXls .= "<th><b>dataAssinaturaPrestador</b></th>";
$dadosXls .= "<th><b>dataAssinaturaBeneficiario</b></th>";
$dadosXls .= "</tr>";
while ($form = mysqli_fetch_assoc($query))

{
    $dadosXls .= "<tr>";
    $dadosXls .= "<td>".$form["idproducao"]."</td>";
	$dadosXls .= "<td>".$form["dataRealizacao"]."</td>";
	$dadosXls .= "<td>".$form["idpaciente"]."</td>";
	$dadosXls .= "<td>".$form["idmedico"]."</td>";
	$dadosXls .= "<td>".$form["idprocedimentos"]."</td>";
	$dadosXls .= "<td>".utf8_decode($form["paciente"])."</td>";
	$dadosXls .= "<td>&quot;".$form["carteiraPaciente"]."&quot;</td>";
	$dadosXls .= "<td>".utf8_decode($form["medico"])."</td>";
	$dadosXls .= "<td>".utf8_decode($form["convenio"])."</td>";
	$dadosXls .= "<td>".utf8_decode($form["hospital"])."</td>";
	$dadosXls .= "<td>".$form["codigoProcedimento"]."</td>";
	$dadosXls .= "<td>".utf8_decode($form["descricaoProcedimento"])."</td>";
	//12
	$dadosXls .= "<td>". number_format($row["valorProcedimento"],2,",",".")."</td>";
	$dadosXls .= "<td>".$form["quantidade"]."</td>";
	$dadosXls .= "<td>".$form["adicional"]."</td>";
	$dadosXls .= "<td>".$form["redutor"]."</td>";
	$dadosXls .= "<td>".number_format($row["valorRecebido"],2,",",".")."</td>";
	$dadosXls .= "<td>".number_format($row["glosa"],2,",",".")."</td>";
	$dadosXls .= "<td>".$form["saldo"]."</td>";
	//19
	$dadosXls .= "<td>".$form["dataPagamento"]."</td>";
	$dadosXls .= "<td>".$form["dataCobranca"]."</td>";
	$dadosXls .= "<td>".$form["dataRepasse"]."</td>";
	$dadosXls .= "<td>".$form["dataPrevisaoPagamento"]."</td>";
	$dadosXls .= "<td>".$form["notaFiscal"]."</td>";
	$dadosXls .= "<td>".$form["protocolo"]."</td>";
	$dadosXls .= "<td>".$form["formaPagamento"]."</td>";
	$dadosXls .= "<td>".$form["statusPagamento"]."</td>";
	$dadosXls .= "<td>".utf8_decode($form["observacao"])."</td>";
	$dadosXls .= "<td>".utf8_decode($form["medicoCirurgiao"])."</td>";
   //29
	$dadosXls .= "<td>".$form["tipoGuia"]."</td>";
	$dadosXls .= "<td>".$form["numeroGuia"]."</td>";
	$dadosXls .= "<td>".$form["guiaPrincipal"]."</td>";
	$dadosXls .= "<td>".$form["dataAutorizacao"]."</td>";
	$dadosXls .= "<td>".$form["senhaAutorizacao"]."</td>";
	$dadosXls .= "<td>".$form["dataValidadeSenha"]."</td>";
	$dadosXls .= "<td>".$form["dataEmissaoGuia"]."</td>";
	$dadosXls .= "<td>".utf8_decode($form["tipoPlano"])."</td>";
	$dadosXls .= "<td>".$form["dataValidadeCarteira"]."</td>";
	$dadosXls .= "<td>".$form["numeroCartaoNacionalSaude"]."</td>";
	$dadosXls .= "<td>&quot;".$form["codigoContratado"]."&quot;</td>";
	$dadosXls .= "<td>".utf8_decode($form["nomeContratado"])."</td>";
	$dadosXls .= "<td>".$form["atendimentoRN"]."</td>";
	$dadosXls .= "<td>".$form["codCNES"]."</td>";
	$dadosXls .= "<td>&quot;".$form["codigoContratadoExecutante"]."&quot;</td>";
	$dadosXls .= "<td>".utf8_decode($form["nomeContratadoExecutante"])."</td>";
	$dadosXls .= "<td>".$form["grauParticipacao"]."</td>";
	$dadosXls .= "<td>".$form["dataAssinaturaPrestador"]."</td>";
	$dadosXls .= "<td>".$form["dataAssinaturaBeneficiario"]."</td>";
    $dadosXls .= "      </tr>";

}

$dadosXls .= "</table>";
echo $dadosXls;


/*    // Configurações header para forçar o download  
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$arquivo.'"');
    header('Cache-Control: max-age=0');
    // Se for o IE9, isso talvez seja necessário
    header('Cache-Control: max-age=1');


// Envia o conteúdo do arquivo

exit; */

?>
								<div class="modal-footer">
										<button type="button" class="btn btn-default" id="btn-close-modalGuia" data-dismiss="modal">Fechar</button>
										<button  type="button" id="btnGuia" class="btn btn-primary" title="Inserir Guia">Salvar</button>
									
									<!--	<button type="submit" class="btn btn-success">Salvar</button>-->
									</div>	
								</form>
							</div>
						</div>
					</div>
				</div>


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

<!--	<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.19/api/sum().js"></script> -->
	
	
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

    <!-- Script -->
    <script type='text/javascript'></script>
	
	<!-- TRABALIHAR COM MOEDAS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
	 

	 <!-- Use with CHECKBOX selected  -->
	<script src="../../js/dataTables.checkboxes.min.js"></script>
<script>

$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>