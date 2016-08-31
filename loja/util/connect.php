<?php
// nós conectamos com example.com na porta 3307
	function connect(){		
		$conexao = mysqli_connect('localhost', 'root', '');
		if (!$conexao) {
	    	return('Não foi possível conectar: ' . mysql_error());
	    }

	    if($conexao){
			$select = mysqli_select_db($conexao,"loja");
		}

		return $conexao;
	}
?>