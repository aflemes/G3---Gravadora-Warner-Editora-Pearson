<?php
	include_once "../util/connect.php";
	include_once "ctrl_item.php";
	include_once "ctrl_estoque.php";

	$acao = "";

	if (isset($_POST["action"])){
		$acao = $_POST["action"];
	}

	switch ($acao) {
		case 'getSequence':
			echo getLastPedido();
			break;
		case 'find':
			echo getAllPedido();
			break;
		case 'saveItemOrder':
			echo insertPedido();
			break;
	}

	function getLastPedido(){
		$conexao = connect();

		$sql = "SELECT MAX(`cd-pedido`) as value FROM pedido";
		$result = mysqli_query($conexao,$sql) or die("houve uma falha no SQL");

		$row = mysqli_fetch_array($result);
		return $row[0];
	}

	function insertPedido(){
		$conexao = connect();
		$regAtualizado = 0;

		foreach($_POST["elements"] as $k=>$arr){
			$item = getItem($arr['cd-item']);

			if (!$item){
				continue;
			}

			if (!verificaEstoque($arr['cd-item'],$arr['qtd-item']))
				return 3;


			$sql = "INSERT INTO pedido (`cd-pedido`,`cd-item`,`qtde-item`,`cd-cliente`) VALUES (".$_POST['pedido'].",".$arr['cd-item'].",".$arr['qtd-item'].",1)";
			$result = mysqli_query($conexao,$sql) or die(mysqli_error($conexao));


			if ($result)
				$regAtualizado++;
		}

		if ($regAtualizado > 0)
			return 1;
		else
			return 2;

	}
	
?>