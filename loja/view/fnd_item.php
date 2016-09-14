<!DOCTYPE html>
<html>
<head>
	<title>Buscar item</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/fnd_item.css">	
</head>
<body>
	<?php
		session_start();
		$_SESSION["nomePagina"] = "Busca de Item";
		include "header.php";
	?>
	<form id="ajax_form" method="POST" action="#">
		<div>
			<input type="text" id="buscar" name="buscar" maxlength="50">
		</div>
		<div>
			<input type="button" style="btn-buscar" name="btn-buscar" value="Buscar" onClick="getAllInformation()">
		</div>
		<div id="data-grid" class="cons-item">
			<table id="tb-data-grid" border="2px">				
			</table>
		</div>
	</form>

	<script type="text/javascript" src="../js/jquery-3.1.0.min.js"></script>
	<!--<script type="text/javascript" src="../js/fnd_item.js"></script>-->
	<script type="text/javascript">		
		function mountDataGrid(data){
			var obj = jQuery.parseJSON(data);
			
			//convert an objet to array
			var array = $.map(obj, function(value, index) {
				return [value];
			});
			
			document.getElementById("tb-data-grid").innerHTML = "";
			
			if (array.length > 0){
				document.getElementById("tb-data-grid").innerHTML = "<tr>";
				document.getElementById("tb-data-grid").innerHTML +=    "<th>Código do item</th>" + 
																		"<th>Nome do item</th>"   +
																		"<th>Valor do item</th>"  +
																		"<th>Categoria</th>" +
																	"</tr>";
			}
						
			for(i = 0;i < array.length; i++){
				document.getElementById("tb-data-grid").innerHTML += "<tr>";
				
				if (array[i]['cod-categ'] == 1){
					document.getElementById("tb-data-grid").innerHTML +="	<td>" + array[i]['cd-item'] + "</td>"  +
																			"<td>" + array[i]['nm-item'] + "</td>"  +
																			"<td>" + array[i]['val-item'] + "</td>" +				
																			"<td>Livro</td>" +
																			"<td><img class='ico-rm'></img></td>" + 
																		"</tr>";
				}else{
					document.getElementById("tb-data-grid").innerHTML +="	<td>" + array[i]['cd-item'] + "</td>"  +
																			"<td>" + array[i]['nm-item'] + "</td>"  +
																			"<td>" + array[i]['val-item'] + "</td>" +				
																			"<td>CD</td>" +
																			"<td><img class='ico-rm'></img></td>" + 
																		"</tr>";					
				}
			}
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