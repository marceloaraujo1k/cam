	
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
	
<!--]\\\\	 <script src="../../dist/js/jquery.maskMoney.js" type="text/javascript"></script> -->

	
	<input type="text" id="currency" />
	
	
	<script>
	
	$(function() {

  $("#currency").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: true});
  var valor = -1101.01201;
 // valor = valor.toFixed(2);
 // valor = parseString(valor);
  $("#currency").val(valor);

  $("#currency").maskMoney('mask');
});


</script>
	
</body>

</html>
