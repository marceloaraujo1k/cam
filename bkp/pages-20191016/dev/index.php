<html>
<head>
	<title>Exemplo Autocomplete com AJAX + PHP + MySQL</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
</head>
<body>
	<div class='container'>
		<header class="row">
			<h1 class='text-center text-primary'>Autocomplete com jQuery UI + PHP + MySQL</h1>
		</header>	
 
		<br>
		<div class="row">
			<div class="form-group col-md-6 col-md-offset-3">
			    <input type="text" class="form-control" id="busca" placeholder="Informe o Título do Livro">
			</div>
		</div>
 
		<header class="row">
			<h2 class='text-center text-danger'>Detalhes do Livro</h2>
		</header>
 
		<br>
		<div class="row">
			<form>
				<div class="form-group col-md-3">
			        <label for="titulo">Código de Barra</label>
			        <input type="text" class="form-control" id="codigo_barra">
			    </div>
			    <div class="form-group col-md-6">
			        <label for="titulo">Título do Livro</label>
			        <input type="text" class="form-control" id="titulo_livro">
			    </div>
			    <div class="form-group col-md-3">
			        <label for="exampleInputPassword1">Categoria</label>
			        <input type="text" class="form-control" id="categoria">
			    </div>
			    <div class="form-group col-md-3">
			    	<label for="valor_compra">Valor de Compra</label>
			        <input type="text" class="form-control" id="valor_compra">
			    </div>
			    <div class="form-group col-md-3">
			        <label for="valor_venda">Valor de Venda</label>
			        <input type="text" class="form-control" id="valor_venda">
			    </div>
			    <div class="form-group col-md-3">
			        <label for="status">Status</label>
			        <input type="text" class="form-control" id="status">
			    </div>
			    <div class="form-group col-md-3">
			        <label for="data_cadastro">Data de Cadastro</label>
			        <input type="text" class="form-control" id="data_cadastro">
			    </div>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>