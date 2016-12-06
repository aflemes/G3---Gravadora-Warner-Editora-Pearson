<?php
 
require 'vendor/autoload.php';
require '../loja/util/connect.php';
//require '../loja/controller/ctrl_item.php';

$app = new \Slim\Slim();
 
$app->get('/', function() {
    $app = \Slim\Slim::getInstance();
    $app->response->setStatus(200);
    echo "Bem-vindo ao WebSerive da G3 Gravadora Warner Editora Pearson";
    echo "<br>";	
    echo "<br>"."<li>setItem (inclui um item na tabela) - SET - PARAM | ID (codigo do item) - DESCR (descricao do item) - CATEGORIA (1 - Livro, 2 - CD) - VALOR (valor do Item) - OBS. (observacao do item)"."</li><br>";
    echo "<li>";
    echo "getItem  (retorna o item cfe o codigo enviado)- GET - PARAM | ID (codigo do item)";
    echo "</li><br>	";
    echo "<li>";
    echo "getAllItem (retorna todos itens cadastrados na base) - PARAM | <none>";
    echo "</li><br>	";
    echo "<li>";
    echo "setPedido (inclui pedido) - SET - PARAM | ";
    echo "</li><br>	";
    echo "<li>";
    echo "getPedido (retorna os dados do pedido) - GET - PARAM | PEDIDO (codigo do pedido) - CLIENTE (cnpj do cliente)";
    echo "</li><br>	";
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
    	$app->response->setStatus(200);
    else
    	$app->response->setStatus(500);
});

$app->post('/getItem/', function () {
 
    $app = \Slim\Slim::getInstance();
    $i=0;

    $body = $app->request->getBody();
	$data = json_decode($body, true);

	if ($data["id"] == null){
		$app->response->setStatus(500);
	}
	else $id = $data["id"];

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

	        $getEstoque = "SELECT * FROM `estoque` WHERE `cd-item` = ".$row["cd-item"];
	        $resEstoque = mysqli_query($conexao,$getEstoque);

	        if (mysqli_num_rows($resEstoque) > 0){
	        	$items[$i]["qtd-estoque"] = mysqli_fetch_array($resEstoque);
	        }
	        else $items[$i]["qtd-estoque"] = 0;

	        $i++;
		}
		
		if ($i > 0){
			$header = array("Produto" => $items);		
		
			$app->response->setStatus(200);	
			echo json_encode($header);
		}
		else
			$app->response->setStatus(500);
	}
	else{
		$app->response->setStatus(500);
	}
});

$app->get('/getItem/', function () {
 
    $app = \Slim\Slim::getInstance();
    $i=0;

	$conexao = connect();	
    $sql = "SELECT * from item";
    
	$resultado = mysqli_query($conexao,$sql);

	if ($resultado){
		$items  = array();

		while($row = mysqli_fetch_array($resultado)) {
	        $items[$i]["item"]  = $row["cd-item"];
	        $items[$i]["descricao"]  = $row["nm-item"];
	        $items[$i]["categoria"] = $row["cd-categ"];
	        $items[$i]["preco"] = $row["val-item"];
	        //$items[$i]["des-item"] = $row["des-item"];

	        $getEstoque = "SELECT `qtd-estoque` FROM `estoque` WHERE `cd-item` = ".$row["cd-item"];
	        $resEstoque = mysqli_query($conexao,$getEstoque);

	        if (mysqli_num_rows($resEstoque) > 0){
	        	$items[$i]["quantidade_estoque"] = mysqli_fetch_array($resEstoque)["qtd-estoque"];
	        }
	        else $items[$i]["quantidade_estoque"] = 0;

	        $i++;
		}
		
		if ($i > 0){
			//$header = array("Produto" => $items);		
		
			$app->response->setStatus(200);	
			echo json_encode($items);
		}
		else
			$app->response->setStatus(500);
	}
	else{
		$app->response->setStatus(500);
	}
});

/*
* [INFORMACOES REFERENTE AO PEDIDO]
*/

$app->post('/setPedido/', function () {
 
    $app = \Slim\Slim::getInstance();
    //$app->response->setStatus(200);

    $body = $app->request->getBody();
    print_r($body);
	$data = json_decode($body, true);

	if ($data["cnpj"] == null){
		$app->response->setStatus(500);
	}
	
	$pedido = getLastPedido() + 1;
	$conexao = connect();
	
	//CONSISTE CLIENTE
	$cod_cli = getCliente($data["cnpj"]);
	if ($cod_cli == null){
		$app->response->setStatus(406);	
	}

	$inclusao = false;

	for ($i = 0;$i < sizeof($data["item"]); $i++){
		$id = $data["item"][$i]["id"];
		$qtde = $data["item"][$i]["qtde"];
		
		$sql = "INSERT INTO pedido (`cd-pedido`,`cd-item`,`qtd-item`,`cd-cliente`) VALUES (".$pedido.",".$id.",".$qtde.",".$cod_cli.")";
		$result = mysqli_query($conexao,$sql) or die(mysqli_error($conexao));

		if ($result)
			$inclusao = true;
		else
			$inclusao = false;
	}

	if ($inclusao){
		$app->response->setStatus(200);
	}
	else
		$app->response->setStatus(500);
});


$app->get('/getPedido/:pedido/:client', function ($pedido,$client) {
    $sql = "SELECT * from pedido where `cd-pedido` = $pedido and `cd-cliente` = $client";
    
	$resultado = mysqli_query($conexao,$sql);

	if ($resultado){
		$pedido  = array();

		while($row = mysqli_fetch_array($resultado)) {
	        $pedido[$i]["cd-pedido"]   = $row["cd-pedido"];
	        $pedido[$i]["cd-item"]     = $row["cd-item"];
	        $pedido[$i]["qtd-item"]    = $row["qtd-item"];
	        $pedido[$i]["cd-cliente"]  = $row["cd-cliente"];
	        $i++;
		}
		
		if ($i > 0){
			$app->response->setStatus(200);

			$header = array("Pedido" => $pedido);
			echo json_encode($header);
		}
		else
			$app->response->setStatus(500);
	}
	else
		$app->response->setStatus(500);

});
function getLastPedido(){
	$conexao = connect();

	$sql = "SELECT MAX(`cd-pedido`) as value FROM pedido";
	$result = mysqli_query($conexao,$sql) or die("houve uma falha no SQL");

	$row = mysqli_fetch_array($result);
	return $row[0];
}

function getCliente($cnpj){
	$conexao = connect();

	$sql = "SELECT `cd-cliente` FROM `cliente` WHERE `cd-cnpj` = ".$cnpj;
	$result = mysqli_query($conexao,$sql) or die("houve uma falha no SQL");

	if (mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_array($result);
		return $row[0];
	}
	else
		return insertCliente($cnpj);
}

function insertCliente($cnpj){
	$conexao = connect();

	$sql = "INSERT INTO `cliente`(`cd-cnpj`) VALUES ('".$cnpj."')";
	$result = mysqli_query($conexao,$sql) or die("houve uma falha no SQL");

	return getCliente($cnpj);	

}

$app->run();