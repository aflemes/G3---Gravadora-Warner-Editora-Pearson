<?php
	function getLastItem($conexao){
		$sql = "SELECT * FROM item order by 'cd-item' LIMIT 1";
		$result = mysqli_query($conexao,$sql) or die("houve uma falha no SQL");

		$row = mysqli_fetch_array($result);
		return $row["cd-item"];
	}
	
?>