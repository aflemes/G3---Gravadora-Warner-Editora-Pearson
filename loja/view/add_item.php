<!DOCTYPE html>
<html>
<head>
	<title>Cadastrar item</title>
</head>
<link rel="stylesheet" type="text/css" href="../css/main.css">
<body>
<?php
	include "../util/connect.php";
	$conexao = connect();
	include "../controller/ctrl_item.php";

	$codItem = intval(getLastItem($conexao)) + 1;
?>
	<form name="formulario" action="POST" action="#">
		<div> 
			Código do item
			<input type="text" value=<?php echo $codItem?> disabled="true" name="cod-item">
		</div>

		<div> 
			Descrição do item
			<input type="text" maxlength="40" name="des-item">
		</div>

		<div>
			Categoria do Item
			<select name="cod-categ">
				<option value="1">Livro</option>
				<option value="2">CD</option>
			</select>
		</div>
		
		<div>
			Preço do Item
			<input type="text" name="val-item">
		</div>

		<div>
			Descrição do item
			<textarea rows="4" cols="50" name="des-item">
				
			</textarea>
		</div>
		<div>
			<input type="submit" value="Salvar" class="btn-salvar">
		</div>
	</form>

</body>
</html>