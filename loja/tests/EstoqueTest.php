<?php
use PHPUnit\Framework\TestCase;
include_once "../controller/ctrl_estoque.php";

class EstoqueTest extends TestCase
{
    public function testAddEstoque()
    {
        $retorno = false;

        $_POST["item"] = 1;
        $_POST["qtde"] = 100;

        //insere a quantidade 100 
        $retorno = insertEstoque();

        //remove o estoque atualizado;
		removeEstoque();

        $this->assertEquals(true,$retorno);
    }

    // ...
}
