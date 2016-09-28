<!DOCTYPE html>
<html>
<head>
	<title>Pedido</title>
	
	<?php
		include "headFiles.php";
	?>		
	
	<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.min.css">	
	<link rel="stylesheet" type="text/css" href="../css/jquery-ui.min.css">			
	<link rel="stylesheet" type="text/css" href="../css/add_pedido.css">
	
	<script type="text/javascript" language="javascript" src="../js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="../js/jquery-ui.min.js"></script>
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
			<div class="wrapper_input_text"></div>
		</div>

		<div class="linha">
			<div class="wrapper_input_text"> 
				<label for="item">Item</label>			
				<input type="text" name="item" id="item" maxlength="40" onkeypress="getDescrItem()">
			</div>
			<div class="wrapper_input_text"> 
				<label for="item">Quantidade</label>			
				<input type="text" name="qtde-item" id="qtde-item" maxlength="40">
				<input type="button" class="button-add" id="button-add"/>
			</div>
		</div>
		
		<table id="example" class="display" cellspacing="0" width="100%">
			<thead>
				<th>Item</th>
				<th>Descrição</th>
				<th>Qtde.</th>
				<th>Valor</th>
			</thead>
		</table>
		
		<input type="button" value="Salvar" class="btn btn-salvar" id="btn-salvar">		
	</form>

	<script type="text/javascript" src="../js/add_pedido.js"></script>
</body>
</html>