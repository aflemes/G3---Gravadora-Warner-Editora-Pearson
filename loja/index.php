<!DOCTYPE html>
<html>
<head>
	<title>Loja Placeholder</title>
	
	<?php
		include "view/headFiles.php";
	?>

	<link rel="stylesheet" type="text/css" href="css/index.css">	
</head>
<body>
	<div id="wrapper-index">
		<div id="cima">
			<div id="faixa-cima">
				<h2 class="loja-nome">Loja Placeholder</h2>
				<h6 class="loja-frase">A melhor loja de livros e CDs</h6>
			</div>	
		</div>
		<div id="baixo">
			<a href="view/add_item.php" class="retangulo cadastro">
				<div class="faixa">
					<i class='fa fa-pencil-square-o icon'></i>
					<span class="frase">Cadastro de Item</span>
				</div>
			</a>
			<a href="view/fnd_item.php" class="retangulo busca">
				<div class="faixa">
					<i class='fa fa-search icon inverter-icon-horizontal'></i>
					<span class="frase">Busca de Item</span>
				</div>
			</a>
			<a href="view/add_estoque.php" class="retangulo estoque">
				<div class="faixa">
					<i class='fa fa-archive icon'></i>
					<span class="frase">Estoque</span>
				</div>
			</a>
			<a href="view/add_pedido.php" class="retangulo pedido">
				<div class="faixa">
					<i class='fa fa-shopping-cart icon'></i>
					<span class="frase">Pedido</span>
				</div>
			</a>
		</div>
	</div>
	
	<!--<script type="text/javascript" src="../js/fnd_item.js"></script><-->	
</body>
</html>