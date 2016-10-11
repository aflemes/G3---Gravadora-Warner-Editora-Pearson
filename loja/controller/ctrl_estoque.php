<?php
	include_once "../util/connect.php";
	
	$acao = "";

	if (isset($_POST["action"])){
		$acao = $_POST["action"];
	}

	switch ($acao) {
		case 'insert':
			echo insertEstoque();
			break;
		case 'remove':
			echo refreshEstoque();
			break;
	}

	function insertEstoque(){		
		$conexao = connect();
		
		$item = $_POST["item"];
		$item = getCodItem($item);

		if ($item == "NaN")
			return false;

		$qtde = $_POST["qtde"];

		$sql = "SELECT * from estoque where `cd-item` = ".$item;
		$result = mysqli_query($conexao,$sql) or die("houve uma falha no SQL");

		$rowcount=mysqli_num_rows($result);

		if ($rowcount > 0){
			$qtde += intval(mysqli_fetch_array($result)["qtd-estoque"]);

			$sql = "UPDATE `estoque` SET `qtd-estoque`=".$qtde." WHERE `cd-item`=".$item;
			$result = mysqli_query($conexao,$sql) or die("houve uma falha no SQL");
		}
		else{
			$sql = "INSERT INTO `estoque`(`cd-item`, `qtd-estoque`) VALUES (".$item.",".$qtde.")";
			$result = mysqli_query($conexao,$sql) or die("houve uma falha no SQL");
		}

		if ($result)
			return true;
		else
			return false;
	}

	function refreshEstoque(){
		$conexao = connect();
		
		$item = $_POST["item"];
		$item = getCodItem($item);

		if ($item == "NaN")
			return "Ocorreu um erro inesperado!";

		$sql = "SELECT * from estoque where `cd-item` = ".$item;
		$result = mysqli_query($conexao,$sql) or die("houve uma falha no SQL");

		$rowcount=mysqli_num_rows($result);

		if ($rowcount > 0){
			$qtde = mysqli_fetch_array($result)["qtd-estoque"];
			$qtde -= $_POST["qtde"];

			$sql = "UPDATE `estoque` SET `qtd-estoque`=".$qtde." WHERE `cd-item`=".$item;
			$result = mysqli_query($conexao,$sql) or die("houve uma falha no SQL");						

			if ($result)
				return true;
			else
				return false;
		}
		else return false;
	}


	function getCodItem($nmItem){
		$conexao = connect();

		$nmItem  = addslashes($nmItem);

		$sql = "SELECT * from item where `nm-item` like '%".$nmItem."%'";
		$result = mysqli_query($conexao,$sql) or die(mysqli_error($conexao));

		$rowcount=mysqli_num_rows($result);

		if ($rowcount > 0){
			return mysqli_fetch_array($result)["cd-item"];
		}
		else return 'NaN';
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

	function removeEstoque($item){
		$conexao = connect();

		$sql = "DELETE FROM `estoque` WHERE `cd-item` = ".$item;
		$result = mysqli_query($conexao,$sql) or die(mysqli_error($conexao));	

		if ($result)
			return true;
		else 
			return false;
	}
?>