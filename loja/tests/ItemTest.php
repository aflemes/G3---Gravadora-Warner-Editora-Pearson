<?php
use PHPUnit\Framework\TestCase;
include_once "../controller/ctrl_item.php";

class ItemTest extends TestCase
{
    public function testAddItem()
    {
        $retorno = false;

        $_POST["codItem"]  = 999;
        $_POST["desItem"]  = "lorem ipsum";
        $_POST["codCateg"] = 1;
        $_POST["valItem"]  = 99;
        $_POST["obsItem"]  = "lorem ipsum dolore sit amet consectur";
        $_POST["acao"]     = 'insert';

        // insert 
        $retorno = insertItem();

        if (!$retorno)
        	$this->assertEquals(true,$retorno);

        deleteItem(999);

        $this->assertEquals(true,$retorno);
    }

    public function testFndItem()
    {
        $retorno = false;

        // busca
        $retorno = getItem(999);

        $this->assertEquals(true,$retorno);
    }

    // ...
}
