<!DOCTYPE html>
<html>
<head>
	<title>Estoque</title>	

	<?php
		include "headFiles.php";
	?>
	
	<link rel="stylesheet" type="text/css" href="../css/jquery-ui.min.css">
	<link rel="stylesheet" type="text/css" href="../css/add_estoque.css">					
	
	<script type="text/javascript" src="../js/jquery-ui.min.js"></script>	
</head>
<body>
	<?php
		session_start();
		$_SESSION["nomePagina"] = "Estoque";
		include "../util/connect.php";
		include "../controller/ctrl_estoque.php";
		include "header.php";
	?>

	<form id="ajax_form" method="POST" action="#">
		<input type="hidden" id="acao">

		<div class="linha">
			<div class="wrapper_input_text"> 
				<label for="item">Item</label>			
				<input type="text" name="item" id="item" maxlength="40" onkeypress="getDescrItem()">
			</div>
		</div>
		<div class="linha">
			<div class="wrapper_input_text"> 
				<label for="item">Quantidade</label>			
				<input type="text" name="qtde-item" id="qtde-item" maxlength="40">
			</div>
		</div>
		
		<input type="button" value="Adicionar Estoque" class="btn btn-salvar" id="btn-salvar">
	</form>

	<script type="text/javascript" src="../js/add_estoque.js"></script>
</body>
</html>