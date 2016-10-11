<?php
	if(!isset($_SESSION)){
    	session_start();
	}

	include_once "../util/connect.php";
	include_once "ctrl_estoque.php";
	
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
		case 'findUniqueByReference';
			echo getNameItem();
			break;
		case 'removeUniqueItem';
			echo deleteItem($_POST["codItem"]);
			break;
		case 'beforeModify';
			echo beforeModify($_POST["codItem"]);
			break;
		case 'modifyItem';
			echo modifyItem();
			break;
	}

	function getNameItem(){
		$conexao = connect();
		$desItem  = addslashes($_POST["item"]);
		
		$sql = "SELECT * from item where `nm-item` like '%".$desItem."%'";
						
		$result = mysqli_query($conexao,$sql) or die(mysqli_error($conexao));

		$arrItem = "";
		$i = 0;

		while($row = mysqli_fetch_array($result))
		{
			$i++;
			$arrItem[$i]["cd-item"] = $row['cd-item'];
			$arrItem[$i]["nm-item"] = $row['nm-item'];
			$arrItem[$i]["val-item"] = $row['val-item'];
		}

		if ($i == 0)
			return false;
		else return json_encode($arrItem);
	}
	
	function getAllItem(){
		$conexao = connect();
		
		$sql = "SELECT * from item where `nm-item` like '%".$_POST['desItem']."%'";
						
		$result = mysqli_query($conexao,$sql) or die(mysqli_error($conexao));
			
		$i = 0;
		$arrItem = "";
		
		while($row = mysqli_fetch_array($result))
		{
			if (intval($row['cd-item']) == 0)
				continue;
			
			$i++;
			$arrItem[$i]['cd-item']  = $row['cd-item'];
			$arrItem[$i]['cd-categ'] = $row['cd-categ'];
			$arrItem[$i]['nm-item']  = $row['nm-item'];
			$arrItem[$i]['des-item'] = $row['des-item'];
			$arrItem[$i]['val-item'] = $row['val-item'];

			$sqlEstoque = "SELECT * from estoque where `cd-item` = ".$row['cd-item'];
						
			$resultEstoque = mysqli_query($conexao,$sqlEstoque) or die(mysqli_error($conexao));

			if ($result){
				$estoqueRow = mysqli_fetch_array($resultEstoque);
				$arrItem[$i]['qtde-item'] =	$estoqueRow[1];			
			}
			else $arrItem[$i]['qtde-item'] = 0;
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
		$desItem  = addslashes($_POST["desItem"]);
		$codCateg = $_POST["codCateg"];
		$valItem  = $_POST["valItem"];
		$obsItem  = addslashes($_POST["obsItem"]);

		$insert = "INSERT INTO item values('".$desItem."',".$codCateg.",".$codItem.",'".$obsItem."','".$valItem."')";		
		$resultado = mysqli_query($conexao,$insert);

		if ($resultado) return true;
		else return false; //return "Ocorreu uma falha na inclusão do registro, tente novamente!";
	}

	function deleteItem($codItem){
		$conexao = connect();

		$delete = "DELETE FROM `item` WHERE `cd-item` = ".$codItem;
		$resultado = mysqli_query($conexao,$delete);

		if ($resultado){
			removeEstoque($codItem);
			return true;
		}
		else return false; //return "Ocorreu uma falha na inclusão do registro, tente novamente!";	
	}
	
	function beforeModify($codItem){
		$conexao = connect();
		
		$sql = "SELECT * from item where `cd-item` = ".$codItem;
						
		$result = mysqli_query($conexao,$sql) or die(mysqli_error($conexao));

		$rowcount=mysqli_num_rows($result);

		if ($rowcount > 0){
			$_SESSION["acao"] = "modify";

			$row = mysqli_fetch_array($result);
			$_SESSION["nmItem"]    = $row[0];
			$_SESSION["categItem"] = $row[1];
			$_SESSION["codItem"]   = $row[2];
			$_SESSION["obsItem"]   = $row[3];
			$_SESSION["valItem"]   = $row[4];
		}
		else return mysqli_erro($conexao);
	}

	function getItem($codItem){
		$conexao = connect();
		
		$sqlGET = "SELECT * FROM `item` WHERE `cd-item` = ".$codItem;
		$result = mysqli_query($conexao,$sqlGET) or die(mysqli_error($conexao));
		
		if ($result)
			return true;
		else
			return false;		
	}
	
	function modifyItem(){
		$conexao = connect();

		$codItem  = $_POST["codItem"];
		$desItem  = addslashes($_POST["desItem"]);
		$codCateg = $_POST["codCateg"];
		$valItem  = $_POST["valItem"];
		$obsItem  = addslashes($_POST["obsItem"]);
		
	    $updateSQL = "UPDATE `item` SET `nm-item`='".$desItem."',`cd-categ`=".$codCateg.",`des-item`='".$obsItem."',`val-item`='".$valItem."'
	    			WHERE `cd-item` = ".$codItem;
						
		$result = mysqli_query($conexao,$updateSQL) or die(mysqli_error($conexao));

		if ($result) return "Registro modificado com sucesso!";		
		else return mysqli_error($conexao); //return "Ocorreu uma falha na inclusão do registro, tente novamente!";
	}
?>