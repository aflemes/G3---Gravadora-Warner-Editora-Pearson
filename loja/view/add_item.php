<!DOCTYPE html>
<html>
<head>
	<title>Adicionar item</title>
	
	<?php
		include "headFiles.php";
	?>

	<link rel="stylesheet" type="text/css" href="../css/add_item.css">		
</head>
<body>
	<?php
		session_start();
		$_SESSION["nomePagina"] = "Cadastro de Item";
		include "../controller/ctrl_item.php";
		include "header.php";	
		$codItem = intval(getLastItem()) + 1;
	?>

	<form id="ajax_form" method="POST" action="#">
		<input type="hidden" id="acao">

		<div class="linha">
			<div class="wrapper_input_text"> 
				<label for="cod-item">Código do Item</label>
				<input type="text" value=<?php echo $codItem?> disabled="true" name="cod-item" id="cod-item">
			</div>

			<div class="wrapper_input_text"> 
				<label for="des-item">Descrição do Item *</label>			
				<input type="text" maxlength="40" name="des-item" id="des-item">
			</div>
		</div>

		<div class="linha">
			<div class="wrapper_input_select">
				<label for="cod-categ">Categoria do Item *</label>			
				<select name="cod-categ" id="cod-categ">
					<option value="1">Livro</option>
					<option value="2">CD</option>
				</select>
			</div>
			
			<div class="wrapper_input_text">
				<label for="val-item">Preço do Item *</label>			
				<input type="text" name="val-item" id="val-item">
			</div>
		</div>

		<div class="linha">
			<div class="wrapper_input_textarea">
				<label for="obs-item">Observacoes do Item</label>
				<textarea rows="4" cols="50" name="obs-item" id="obs-item"></textarea>
			</div>
		</div>		
		
		<a id="btn-adicionar" class="btn btn-salvar">Adicionar Item</a>
	</form>
	
	<script type="text/javascript" src="../js/add_item.js"></script>
</body>
</html>