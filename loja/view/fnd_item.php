<!DOCTYPE html>
<html>
<head>
	<title>Buscar item</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
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
		<div id="wrapper_busca">
			<input type="text" id="buscar" name="buscar" maxlength="50" onkeypress="verifyEnterSearch(event)">
			<input type="button" class="btn btn-buscar" name="btn-buscar" value="Buscar" onClick="getAllInformation()">
		</div>

		<table id="tb-data-grid"></table>
	</form>

	<script type="text/javascript" src="../js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript" src="../js/fnd_item.js"></script>	
</body>
</html>