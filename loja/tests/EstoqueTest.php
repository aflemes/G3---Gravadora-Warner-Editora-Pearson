<?php
use PHPUnit\Framework\TestCase;
include_once "../controller/ctrl_estoque.php";

class EstoqueTest extends TestCase
{
    public function testAddEstoque()
    {
        $retorno = false;

        $_POST["item"] = "PHPUnit";
        $_POST["qtde"] = 100;

        //insere a quantidade 100 
        $retorno = insertEstoque();

        //remove o estoque atualizado;
		removeEstoque(0);

        $this->assertEquals(true,$retorno);
    }

    // ...
}
