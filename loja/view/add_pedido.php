<!DOCTYPE html>
<html>
<head>
	<title>Cadastrar novo pedido de compra</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/main.css">	
	<script type="text/javascript" src="../js/jquery-3.1.0.min.js">
	</script>
</head>
<body>
<?php
	include "../controller/ctrl_pedido.php";
	$codPedido = intval(getLastPedido()) + 1;
?>
	<form id="ajax_form" method="POST" action="#">
		<input type="hidden" id="acao">

		<div> 
			Código do Pedido
			<input type="text" value=<?php echo $codPedido?> disabled="true" name="cod-pedido" id="cod-pedido">
		</div>
		<div> 
			Item
			<input type="text" name="item" id="item" maxlength="40" onblur="getDescrItem()">
		</div>
		<div>

		</div>
		<div>
			<input type="submit" value="Salvar" class="btn-salvar">
		</div>
	</form>
</body>
<script type="text/javascript">
	function getDescrItem()`{
		jQuery.ajax({
				type: "POST",
				url: "../controller/ctrl_item.php",
				data:{
					item: $("#item").val(),
					action: 'findUnique'
				},
				success: function( data )
				{
					if (data != "NaN"){
						
					}
				}	
			});
	}



	jQuery(document).ready(function(){
		jQuery('#ajax_form').submit(function(){
			var dados = jQuery( this ).serialize();

			jQuery.ajax({
				type: "POST",
				url: "../controller/ctrl_pedido.php",
				data:{
					data: dados,
					action: 'insert'
				},
				success: function( data )
				{
					alert(data);
					$('#ajax_form')[0].reset();
					getNextSequence();
				}	
			});


			function getNextSequence(){			
				jQuery.ajax({
					type: "POST",
					url: "../controller/ctrl_pedido.php",
					data:{
						action: 'getSequence'
					}, 
					success: function( data )
					{
						$("#cod-pedido").val(parseInt(data) + 1);
					}
				});
			}
		});
	});
	</script>
</html>