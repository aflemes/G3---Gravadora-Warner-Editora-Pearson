<?php
	include "../util/connect.php";

	$acao = "";

	if (isset($_POST["action"])){
		$acao = $_POST["action"];
	}

	switch ($acao) {
		case 'getSequence':
			echo getLastPedido();
			break;
		case 'insert':
			echo insertPedido();
			break;
		case 'find';
			echo getAllPedido();
			break;
	}
	
	function getLastPedido(){
		$conexao = connect();

		$sql = "SELECT MAX(`cd-pedido`) as value FROM pedido";
		$result = mysqli_query($conexao,$sql) or die("houve uma falha no SQL");

		$row = mysqli_fetch_array($result);
		return $row[0];
	}

	function insertItem(){
		$conexao = connect();
	}
	
?>