<?php
	include_once "../util/connect.php";

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
		case 'find':
			echo getAllPedido();
			break;
		case 'saveItemOrder':
			echo insertItem();
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

		foreach($_POST["elements"] as $k=>$arr){
			$sql = "INSERT INTO pedido (`cd-pedido`,`cd-item`,`qtd-item`,`cd-cliente`) VALUES (".$_POST['pedido'].",".$arr['cd-item'].",".$arr['qtd-item'].",1)";
			$result = mysqli_query($conexao,$sql) or die(mysqli_error($conexao));
		}
	}
	
?>