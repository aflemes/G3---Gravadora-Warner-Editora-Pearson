<?php
	include_once "../util/connect.php";
	include_once "ctrl_item.php";
	
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


			$sql = "INSERT INTO pedido (`cd-pedido`,`cd-item`,`qtd-item`,`cd-cliente`) VALUES (".$_POST['pedido'].",".$arr['cd-item'].",".$arr['qtd-item'].",1)";
			$result = mysqli_query($conexao,$sql) or die(mysqli_error($conexao));

			if ($result)
				$regAtualizado++;
		}

		if ($regAtualizado > 0)
			return 1;
		else
			return 2;

	}

	function insertUniquePedido($item,$qtdeItem){
		$conexao = connect();

		$pedido = getLastPedido();

		$sql = "INSERT INTO pedido (`cd-pedido`,`cd-item`,`qtde-item`,`cd-cliente`) VALUES (".$pedido.",".$item.",".$qtdeItem.",1)";
		$result = mysqli_query($conexao,$sql) or die(mysqli_error($conexao));


		if ($result)
			return true;
		else
			return false;
	}

	function deletePedido($item){
		$conexao = connect();

		$sql = "DELETE from `pedido` where `cd-item` =".$item;
		$result = mysqli_query($conexao,$sql) or die(mysqli_error($conexao));

		if ($result)		
			return true;
		else
			return false;

	}
	
	function verificaEstoque($item,$qtde){
		$conexao = connect();

		$sql = "SELECT * FROM `estoque` WHERE `cd-item` = ".$item;
		$result = mysqli_query($conexao,$sql) or die(mysqli_error($conexao));

		$rowcount=mysqli_num_rows($result);

		if ($rowcount > 0){
			 $qtdeEstoq = mysqli_fetch_array($result)["qtd-estoque"];

			 if ($qtdeEstoq >= $qtde)
			 	return true;
			 else
			 	return false;
		}
		else return false;	
	}
	
?>