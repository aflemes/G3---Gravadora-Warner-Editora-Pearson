<div id="master_menu">
    <div id="menu_logo">
        <i class='fa fa-shopping-bag icon-logo'></i>
        <span id="menu_logo_texto">Loja Placeholder</span>
    </div>
    <span id="pagina">
    <?php        
        echo $_SESSION ["nomePagina"];
    ?>
    </span>
    <div id="menu_navegacao">
        <a class="menu_botao" href="add_item.php">
            <span>Cadastro de Item</span>
            <i class='fa fa-pencil-square-o icon-menu'></i>
        </a>
        <a class="menu_botao" href="fnd_item.php">
            <span>Busca de Item</span>
            <i class='fa fa-search icon-menu inverter-icon-horizontal'></i>
        </a>
        <a class="menu_botao" href="add_pedido.php">
            <span>Pedido</span>            
            <i class='fa fa-shopping-cart icon-menu'></i>
        </a>
    </div>
</div>