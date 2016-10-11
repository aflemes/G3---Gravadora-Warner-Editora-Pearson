<!DOCTYPE html>
<html>
<head>
	<title>Adicionar item</title>
	<meta http-equiv="Cache-Control" content="no-store" />

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

		$nmItem    = "";
		$categItem = 0;
		$valItem   = 0;
		$obsItem   = "";

		if (isset($_SESSION["acao"])){
			if ($_SESSION["acao"] == "modify"){
				$codItem   = $_SESSION["codItem"];
				$nmItem    = $_SESSION["nmItem"];
				$categItem = $_SESSION["categItem"];
				$valItem   = $_SESSION["valItem"];
				$obsItem   = $_SESSION["obsItem"];
			}
		}
		else
			$codItem = intval(getLastItem()) + 1;

		session_destroy();
	?>

	<form id="ajax_form" method="POST" action="#">
		<input type="hidden" id="acao">

		<div class="linha">
			<div class="wrapper_input_text"> 
				<label for="cod-item">Código do Item</label>
				<input type="text" value=<?php echo $codItem; ?> disabled="true" name="cod-item" id="cod-item">
			</div>

			<div class="wrapper_input_text"> 
				<label for="des-item">Descrição do Item *</label>			
				<input type="text" value="<?php echo $nmItem; ?>" maxlength="40" name="des-item" id="des-item">
			</div>
		</div>

		<div class="linha">
			<div class="wrapper_input_select">
				<label for="cod-categ">Categoria do Item *</label>			
				<select name="cod-categ" id="cod-categ">
					<option <?php if ($categItem == 1) {echo 'selected';} ?> value="1">Livro</option>
					<option <?php if ($categItem == 2) {echo 'selected';} ?> value="2">CD</option>
				</select>
			</div>
			
			<div class="wrapper_input_text">
				<label for="val-item">Preço do Item *</label>			
				<input type="text" value=<?php echo $valItem; ?> name="val-item" id="val-item" maxlength="10">
			</div>
		</div>

		<div class="linha">
			<div class="wrapper_input_textarea">
				<label for="obs-item">Observacoes do Item</label>
				<textarea rows="4" cols="50" name="obs-item" id="obs-item" maxlength="255"><?php echo $obsItem;?></textarea>
			</div>
		</div>		
		
		<?php 
			if (!isset($_SESSION["acao"])){
		?>		
			<a id="btn-adicionar" class="btn btn-salvar">Adicionar Item</a>
		<?php 
			}
			else
			{
		?>	
			<a id="btn-modificar" class="btn btn-modificar">Modificar Item</a>
		<?php
			}
		?>
	</form>
	
	<script type="text/javascript" src="../js/add_item.js"></script>
</body>
</html>