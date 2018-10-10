<div id="menu">
    <p id="pMenu"><a href="#opcoes">MENU</a></p>
    <div id="opcoes">
        <p class="opcao" class="opcao1"><a href="index.php">Inicio</a></p>
        <p class="opcao" class="opcao1"><a href="demolay.php">Demolay</a></p>
        <?php if ($demolay->ocupacao=="Mestre Conselheiro"){?>
        <p class="opcao" class="opcao1"><a href="mestreCons.php">MC</a></p>
        <?php }if ($demolay->ocupacao=="Tesoureiro"){?>
        <p class="opcao" class="opcao1"><a href="tesoureiro.php">Tes</a></p>
        <?php }if ($demolay->ocupacao=="Escrivão"){?>
        <p class="opcao" class="opcao1"><a href="escrivao.php">Esc</a></p><?php } ?>
        <?php if ($demolay->presidenteComissao!=""){ ?>
        <p class="opcao" class="opcao1"><a href="PressComissao.php">Press</a></p>

        <?php }?>
        <form action="#" method="post" class="opcao" class="opcao1">
            <input type="submit" onclick="" value="Deslogar" name="btnUnlogin" class="opcao">
        </form>
        <p id="pFechar" class="opcao" class="opcao1"><a href="#">Fechar</a></p>
    </div>
</div>