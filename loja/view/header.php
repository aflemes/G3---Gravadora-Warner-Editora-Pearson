<div id="master_menu">
    <div id="menu_logo">
        Loja Placeholder
    </div>
    <span id="pagina">
    <?php        
        echo $_SESSION ["nomePagina"];
    ?>
    </span>
    <div id="menu_navegacao">
        <a class="menu_botao" href="add_item.php">Cadastro de Item</a>
        <a class="menu_botao" href="fnd_item.php">Busca de Item</a>
        <a class="menu_botao" href="add_pedido.php">Pedido</a>
    </div>
</div>