<!DOCTYPE html>
<html>
<head>
	<title>Cadastrar item</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/main.css">	
	<script type="text/javascript" src="../js/jquery-3.1.0.min.js">
	</script>
</head>
<body>
<?php
	include "../controller/ctrl_item.php";
	$codItem = intval(getLastItem()) + 1;
?>
	<form id="ajax_form" method="POST" action="#">
		<input type="hidden" id="acao">

		<div> 
			Código do item
			<input type="text" value=<?php echo $codItem?> disabled="true" name="cod-item" id="cod-item">
		</div>

		<div> 
			Descrição do item
			<input type="text" maxlength="40" name="des-item" id="des-item">
		</div>

		<div>
			Categoria do Item
			<select name="cod-categ" id="cod-categ">
				<option value="1">Livro</option>
				<option value="2">CD</option>
			</select>
		</div>
		
		<div>
			Preço do Item
			<input type="text" name="val-item" id="val-item">
		</div>

		<div>
			Observacoes do item
			<textarea rows="4" cols="50" name="obs-item" id="obs-item">
				
			</textarea>
		</div>
		<div>
			<input type="submit" value="Salvar" class="btn-salvar">
		</div>
	</form>
</body>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('#ajax_form').submit(function(){
			var dados = jQuery( this ).serialize();

			jQuery.ajax({
				type: "POST",
				url: "../controller/ctrl_item.php",
				data:{
					data: dados,
					codItem: $("#cod-item").val(),
					desItem: $("#des-item").val(),
					codCateg: $("#cod-categ").val(),
					valItem: $("#val-item").val(),	
					obsItem: $("#obs-item").val(),					
					action: 'insert'
				},
				success: function( data )
				{
					alert(data);	
					$('#ajax_form')[0].reset();
				}	
			});
			
			 jQuery.ajax({
					type: "POST",
					url: "../controller/ctrl_item.php",
					data:{
						action: 'getSequence'	
					}, 
					success: function( data )
					{
						$("#cod-item").val(parseInt(data) + 1);
					}
				});
			return false;
		});
	});
	</script>
</html>