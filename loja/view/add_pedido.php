<!DOCTYPE html>
<html>
<head>
	<title>Pedido</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/add_pedido.css">
	<script type="text/javascript" src="../js/jquery-3.1.0.min.js">
	</script>
</head>
<body>
<?php
	session_start();
	$_SESSION["nomePagina"] = "Pedido";
	include "header.php";	
	include "../controller/ctrl_pedido.php";
	$codPedido = intval(getLastPedido()) + 1;
?>
	<form id="ajax_form" method="POST" action="#">
		<input type="hidden" id="acao">

		<div class="linha">
			<div class="wrapper_input_text"> 
				<label for="cod-pedido">Código do pedido</label>
				<input type="text" value=<?php echo $codPedido?> disabled="true" name="cod-pedido" id="cod-pedido">
			</div>

			<div class="wrapper_input_text"> 
				<label for="item">Item</label>			
				<input type="text" name="item" id="item" maxlength="40" onblur="getDescrItem()">
			</div>
		</div>

		<input type="submit" value="Salvar" class="btn btn-salvar">
	</form>

	<script type="text/javascript" src="../js/add_pedido.js"></script>
</body>
</html>