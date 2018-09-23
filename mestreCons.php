<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />

    <script>
    function validarReuniao(){
        let data = document.getElementById("iData").value;
        let pauta = document.getElementById("iPauta").value;
        
        if(data==""||pauta=="")
            return false;
        else
            return true;
    }
    function validarMembro(){
        let cid = document.getElementById("iCid").value;
        let nome = document.getElementById("iNome").value;
        let capitulo = document.getElementById("iCapitulo").value;
        
        if(cid==""||nome==""||capitulo=="")
            return false;
        else
            return true;
    }
    function validarComissao(){
        let comissao = document.getElementById("iComissao").value;
        let presidente = document.getElementById("iPress").value;
        
        if(comissao==""||presidente=="")
            return false;
        else
            return true;
    }
    </script>

    <link rel="stylesheet" href="estilo.css">
</head>
<body>

<?php
    session_start();
    require_once('menu.html');//menu

    require_once('classes.php');
    $cdDemolay = $_SESSION['cd_demolay'];
    $demolay = new demolay($cdDemolay);
    $demolays = $demolay->verDemolays();

    if(!empty($_REQUEST["salvarReuniao"])){
        $data = $_REQUEST["data"];
        $pauta = $_REQUEST["pauta"];
        $gestao = 1;

        $mestreConselheiro = new mestreConselheiro($cdDemolay);
        $mestreConselheiro->salvarReuniao($data,$pauta,$gestao);
    }
    if(!empty($_REQUEST["adicionarDM"])){
        $cid = $_REQUEST["cid"];
        $nome = $_REQUEST["nome"];
        $capitulo = $_REQUEST["capitulo"];

        $mestreConselheiro = new mestreConselheiro($cdDemolay);
        $mestreConselheiro->adicionarDemolay($cid,$nome,$capitulo);
    }
    if(!empty($_REQUEST["salvarComissao"])){
        $comissao = $_REQUEST["nomeComissao"];
        $presidente = $_REQUEST["pressComissao"];
        $gestao = 1;

        $mestreConselheiro = new mestreConselheiro($cdDemolay);
        $mestreConselheiro->adicionarComissao($comissao,$presidente,$gestao);
    }
?>

<div class="reunioes">
    <label>Salvar nova Reunião</label>
    <div class="form">
        <form action="#" method="post">
            <table>
                <tr><td>Data:</td><td><input type="date" name="data" id="iData"></td></tr>
                <tr><td>Pauta:</td><td><textarea name="pauta" id="iPauta" maxlength="100"></textarea></td></tr>
                <tr><td></td><td><input type="submit" onclick="return validarReuniao();" value="Salvar" name="salvarReuniao"></td></tr>
            </table>
        </form>
    </div>
</div>

<div class="membros">
    <label>Salvar novo Membro</label>
    <div class="form">
    <form action="#" method="post">
        <table>
            <tr><td>CID:</td><td><input type="number" name="cid" id="iCid"></td></tr>
            <tr><td>Nome:</td><td><input type="text" name="nome" id="iNome"></td></tr>
            <tr><td>Capitulo:</td><td><input type="text" name="capitulo" id="iCapitulo" readonly="true" <?php echo "value='$demolay->capitulo'"; ?> > </td></tr>
            <tr><td></td><td><input type="submit" onclick="return validarMembro();" value="Salvar" name="adicionarDM"></td></tr>
        </table>
    </form>
    </div>
</div>

<div class="comissoes">
    <label>Salvar nova Comissão</label>
    <div class="form">
    <form action="#" method="post">
        <table>
            <tr><td>Nome:</td><td><input type="text" name="nomeComissao" id="iComissao"></td></tr>
            <tr><td>Presidente:</td>
            <td>
                <!--input type="text" name="pressComissao" id="iPress"-->
                <select name="pressComissao" id="iPress">
                    <?php
                        for ($index0=0; $index0 < sizeof($demolays); $index0++) {
                            echo "<option value=".$demolays[$index0][0].">".$demolays[$index0][2]."</option>";
                        }
                    ?>
                </select>
            </td></tr>
            <tr><td></td><td><input type="submit" onclick="return validarComissao();" value="Salvar" name="salvarComissao"></td></tr>
        </table>
    </form>
    </div>
</div>

</body>
</html>