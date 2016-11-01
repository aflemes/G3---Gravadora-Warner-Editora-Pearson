<?php
 
require 'vendor/autoload.php';
require '../loja/util/connect.php';
//require '../loja/controller/ctrl_item.php';

$app = new \Slim\Slim();
 
$app->get('/', function() {
    $app = \Slim\Slim::getInstance();
    $app->response->setStatus(200);
    echo "Bem-vindo ao WebSerive da G3 Gravadora Warner Editora Pearson";
});

// Como utilizar o webservice
// http://localhost:8080/G3---Gravadora-Warner-Editora-Pearson/api/index.php/setItem/10/1/1/1/1

/*
* [INFORMACOES REFERENTE AO ITEM]
*/

$app->get('/setItem/:id/:descr/:categ/:value/:obs', function ($id,$descr,$categ,$value,$obs) {
 
    $app = \Slim\Slim::getInstance();
    $app->response->setStatus(200);

	$conexao = connect();	
    $insert = "INSERT INTO item values('".$descr."',".$categ.",".$id.",'".$obs."','".$value."')";		
	$resultado = mysqli_query($conexao,$insert);

    if ($resultado)
    	echo json_encode("Item cadastrado com sucesso!");
    else
    	echo json_encode("Ocorreu um erro inesperado!");
});

$app->get('/getItem/:id', function ($id) {
 
    $app = \Slim\Slim::getInstance();
    $app->response->setStatus(200);
    $i=0;

	$conexao = connect();	
    $sql = "SELECT * from item where `cd-item` = ".$id;
    
	$resultado = mysqli_query($conexao,$sql);

	if ($resultado){
		$items  = array();

		while($row = mysqli_fetch_array($resultado)) {
	        $items[$i]["cd-item"]  = $row["cd-item"];
	        $items[$i]["nm-item"]  = $row["nm-item"];
	        $items[$i]["cd-categ"] = $row["cd-categ"];
	        $items[$i]["des-item"] = $row["des-item"];
	        $items[$i]["val-item"] = $row["val-item"];
	        $i=0;
		}
		$header = array("Produto" => $items);
		
		echo json_encode($header);
	}
	else
		echo json_encode("produto nao encontrado");
});

/*
* [INFORMACOES REFERENTE AO PEDIDO]
*/

$app->get('/setPedido/:pedido/:id/:qtde/:client', function ($pedido,$id,$qtde,$client) {
 
    $app = \Slim\Slim::getInstance();
    $app->response->setStatus(200);

    //$pedido = getLastPedido() + 1;
	
	$conexao = connect();

	$select   = " SELECT * FROM `pedido` WHERE `cd-pedido` = $pedido and `cd-item` = $id";
	$result   = mysqli_query($conexao,$select) or die(mysqli_error($conexao));
	$rowcount = mysqli_num_rows($result);

	if ($rowcount > 0){
		echo json_encode("Pedido com esse item ja cadastrado");
		return;
	}

	$sql = "INSERT INTO pedido (`cd-pedido`,`cd-item`,`qtd-item`,`cd-cliente`) VALUES (".$pedido.",".$id.",".$qtde.",".$client.")";
	$result = mysqli_query($conexao,$sql) or die(mysqli_error($conexao));

	if ($result){
		echo json_encode("Pedido cadastrado com sucesso");
	}
	else
		echo json_encode("Ocorreu um erro inesperado!");

});

$app->get('/getPedido/:pedido/:client', function ($pedido,$client) {
 
    $app = \Slim\Slim::getInstance();
    $app->response->setStatus(200);
    $i=0;	

    $conexao = connect();	
    $sql = "SELECT * from pedido where `cd-pedido` = $pedido and `cd-cliente` = $client";
    
	$resultado = mysqli_query($conexao,$sql);

	if ($resultado){
		$pedido  = array();

		while($row = mysqli_fetch_array($resultado)) {
	        $pedido[$i]["cd-pedido"]  = $row["cd-pedido"];
	        $pedido[$i]["cd-item"]    = $row["cd-item"];
	        $pedido[$i]["qtd-item"]   = $row["qtd-item"];
	        $pedido[$i]["cd-cliente"] = $row["cd-cliente"];
	        $i++;
		}
		$header = array("Pedido" => $pedido);
		
		echo json_encode($header);
	}
	else
		echo json_encode("produto nao encontrado");

});

/*function getLastPedido(){
	$conexao = connect();

	$sql = "SELECT MAX(`cd-pedido`) as value FROM pedido";
	$result = mysqli_query($conexao,$sql) or die("houve uma falha no SQL");

	$row = mysqli_fetch_array($result);
	return $row[0];
}*/

$app->run();