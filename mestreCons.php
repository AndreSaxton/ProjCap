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
</head>
<body>

<?php
    require_once('classes.php');
    $demolay = new demolay("Andre");

    if(!empty($_REQUEST["salvarReuniao"])){
        $data = $_REQUEST["data"];
        $pauta = $_REQUEST["pauta"];
        $gestao = 1;

        $mestreConselheiro = new mestreConselheiro();
        $mestreConselheiro->salvarReuniao($data,$pauta,$gestao);
    }
    if(!empty($_REQUEST["adicionarDM"])){
        $cid = $_REQUEST["cid"];
        $nome = $_REQUEST["nome"];
        $capitulo = $_REQUEST["capitulo"];

        $mestreConselheiro = new mestreConselheiro($demolay->nome);
        $mestreConselheiro->adicionarDemolay($cid,$nome,$capitulo);
    }
    if(!empty($_REQUEST["salvarComissao"])){
        $comissao = $_REQUEST["nomeComissao"];
        $presidente = $_REQUEST["pressComissao"];
        $gestao = 1;

        $mestreConselheiro = new mestreConselheiro($demolay->nome);
        $mestreConselheiro->adicionarComissao($comissao,$presidente,$gestao);
    }
?>

<form action="#" method="post">
    <table>
        <tr><td>Data:</td><td><input type="date" name="data" id="iData"></td></tr>
        <tr><td>Pauta:</td><td><input type="text" name="pauta" id="iPauta"></td></tr>
        <tr><td></td><td><input type="submit" onclick="return validarReuniao();" value="Salvar" name="salvarReuniao"></td></tr>
    </table>
</form>

<form action="#" method="post">
    <table>
        <tr><td>CID:</td><td><input type="text" name="cid" id="iCid"></td></tr>
        <tr><td>Nome:</td><td><input type="text" name="nome" id="iNome"></td></tr>
        <tr><td>Capitulo:</td><td><input type="text" name="capitulo" id="iCapitulo" readonly="true" <?php echo "value='$demolay->capitulo'"; ?> > </td></tr>
        <tr><td></td><td><input type="submit" onclick="return validarMembro();" value="Salvar" name="adicionarDM"></td></tr>
    </table>
</form>

<form action="#" method="post">
    <table>
        <tr><td>Nome:</td><td><input type="text" name="nomeComissao" id="iComissao"></td></tr>
        <tr><td>Presidente:</td><td><input type="text" name="pressComissao" id="iPress"></td></tr>
        <tr><td></td><td><input type="submit" onclick="return validarComissao();" value="Salvar" name="salvarComissao"></td></tr>
    </table>
</form>

</body>
</html>