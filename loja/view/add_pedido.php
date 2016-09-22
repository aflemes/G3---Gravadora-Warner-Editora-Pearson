<!DOCTYPE html>
<html>
<head>
	<title>Pedido</title>
	<meta charset="UTF-8">

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/add_pedido.css">
	
	<script type="text/javascript" src="../js/jquery-3.1.0.min.js"></script>	
	<!--><script type="text/javascript" src="http://code.jquery.com/jquery-1.12.3.min.js"></script><!-->

	<!-->DATATABLE<!--> 
	<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.min.css">
	<script type="text/javascript" language="javascript" src="../js/jquery.dataTables.min.js"></script>

	<link rel="stylesheet" type="text/css" href="../css/main.css">	
	<link rel="stylesheet" type="text/css" href="../css/jquery-ui.min.css">	
	<link rel="stylesheet" type="text/css" href="../css/add_pedido.css">	
	
	<script type="text/javascript" src="../js/jquery-ui.min.js"></script>
	
	<script type="text/javascript" language="javascript" class="init">
		$(document).ready(function() {
			$('#example').DataTable({
				"sDom": "rt",
				"oLanguage": {
					"sEmptyTable": "Sem registro"
				}
			});
		});
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
				<input type="button" class="button-add"/>
			</div>
		</div>

		<div>
			<table id="example" class="display" cellspacing="0" width="100%">
				<thead>
					<th>Item</th>
					<th>Descrição</th>
					<th>Qtde.</th>
					<th>Valor</th>
				</thead>
			</table>
		</div>
		
		<input type="submit" value="Salvar" class="btn btn-salvar">
	</form>
</body>
<script type="text/javascript">
	function getDescrItem(){
		jQuery.ajax({
				type: "POST",
				url: "../controller/ctrl_item.php",
				data:{
					item: $("#item").val(),
					action: 'findUniqueByReference'
				},
				success: function( data )
				{
					if (data != "NaN"){
						var obj = jQuery.parseJSON(data);
						var elements = new Array();

						for(i=1;;i++){
							if (obj[i] != null)
								elements.push(obj[i]);
							else break;
						}
						$("#item").autocomplete({                        
							source: elements
						}); 
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
		})
	});
</script>
<script type="text/javascript" src="../js/add_pedido.js"></script>
</body>
</html>