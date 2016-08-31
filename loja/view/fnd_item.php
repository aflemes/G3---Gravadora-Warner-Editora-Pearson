<!DOCTYPE html>
<html>
<head>
	<title>Buscar item</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/main.css">	
	<script type="text/javascript" src="../js/jquery-3.1.0.min.js">
	</script>
</head>
<body>
	<form id="ajax_form" method="POST" action="#">
		<div>
			<input type="text" id="buscar" name="buscar" maxlength="50">
		</div>
		<div>
			<input type="button" style="btn-buscar" name="btn-buscar" value="Buscar" onClick="getAllInformation()">
		</div>
		<div id="data-grid">
			<table id="tb-data-grid">
			</table>
		</div>
	</form>

	<script type="text/javascript">
		
	function mountDataGrid(data){
		var js_array = [<?php echo '"'.implode('","',  $disabledDaysRange ).'"' ?>];
		//document.getElementById("tb-data-grid").innerHTML = "<tr><td>novo livro</td></tr>";
	}	
				
	function getAllInformation(){		
		jQuery.ajax({
			type: "POST",
			url: "../controller/ctrl_item.php",
			data:{
				desItem: $("#buscar").val(),
				action: 'find'
			},
			success: function( data )
			{
				mountDataGrid(data);				
			},
			error: function( data )
			{
				alert("Aconteceu um erro na aplicacao");
			}				
		});	
	}	
	</script>
</body>
</html>