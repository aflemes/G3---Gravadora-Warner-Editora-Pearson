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
			
		$i = 0;
		$arrItem = "";
		
		while($row = mysqli_fetch_array($result))
		{
			$i++;
			$arrItem[$i]['cd-item']  = $row['cd-item'];
			$arrItem[$i]['cd-categ'] = $row['cd-categ'];
			$arrItem[$i]['nm-item']  = $row['nm-item'];
			$arrItem[$i]['des-item'] = $row['des-item'];
			$arrItem[$i]['val-item'] = $row['val-item'];
		}
		
		return json_encode($arrItem);
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