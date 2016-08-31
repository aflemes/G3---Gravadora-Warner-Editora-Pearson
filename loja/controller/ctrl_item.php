<?php
	include "../util/connect.php";

	$acao = "";

	if (isset($_POST["action"])){
		$acao = $_POST["action"];
	}

	switch ($acao) {
		case 'insert':
			echo insertItem();
			break;
		case 'getSequence';
			echo getLastItem();
			break;
		case 'find';
			echo getAllItem();
			break;
	}
	
	function getAllItem(){
		$conexao = connect();
		
		$sql = "SELECT * from item where `nm-item` like '%".$_POST['desItem']."%'";
				
		$result = mysqli_query($conexao,$sql) or die(mysqli_error($conexao));
			
		$arr = mysqli_fetch_array($result);
		print_r($arr);		
	}

	function getLastItem(){
		$conexao = connect();

		$sql = "SELECT MAX(`cd-item`) as value FROM item";
		$result = mysqli_query($conexao,$sql) or die("houve uma falha no SQL");

		$row = mysqli_fetch_array($result);
		return $row[0];
	}

	function insertItem(){
		$conexao = connect();

		$codItem  = $_POST["codItem"];
		$desItem  = $_POST["desItem"];
		$codCateg = $_POST["codCateg"];
		$valItem  = $_POST["valItem"];
		$obsItem  = $_POST["obsItem"];

		$insert = "INSERT INTO item values('".$desItem."',".$codCateg.",".$codItem.",'".$obsItem."',".$valItem.")";
		$resultado = mysqli_query($conexao,$insert);

		if ($resultado){
			return "Registro foi salvo com sucesso!";
		}
		else return mysqli_error($conexao); //return "Ocorreu uma falha na inclusão do registro, tente novamente!";
	}
	
?>