<?php
 
require 'vendor/autoload.php';
require '../loja/util/connect.php';
//require '../loja/controller/ctrl_item.php';

$app = new \Slim\Slim();
 
$app->get('/', function() {
    $app = \Slim\Slim::getInstance();
    $app->response->setStatus(200);
    echo "Welcome to Slim 3.0 based API";
});

// Como utilizar o webservice
// http://localhost:8080/G3---Gravadora-Warner-Editora-Pearson/api/index.php/setItem/10/1/1/1/1


$app->get('/setItem/:id/:descr/:categ/:value/:obs', function ($id,$descr,$categ,$value,$obs) {
 
    $app = \Slim\Slim::getInstance();
    $app->response->setStatus(200);

	$conexao = connect();	
    $insert = "INSERT INTO item values('".$descr."',".$categ.",".$id.",'".$obs."','".$value."')";		
	$resultado = mysqli_query($conexao,$insert);

    if ($resultado)
    	echo "Item cadastrado com sucesso!";
    else
    	echo "Ocorreu um erro inesperado!";
});

$app->run();