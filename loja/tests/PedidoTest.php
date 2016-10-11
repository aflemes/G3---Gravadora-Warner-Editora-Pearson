<?php
use PHPUnit\Framework\TestCase;
include_once "../controller/ctrl_pedido.php";

class PedidoTest extends TestCase
{
    public function testAddPedido()
    {
        $retorno = false;

        $retorno = insertUniquePedido(0,100);

        if (!$retorno){
			$this->assertEquals(true,$retorno);
        }

		$retorno = deletePedido(0);   

        $this->assertEquals(true,$retorno);
    }

    // ...
}
