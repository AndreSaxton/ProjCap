<?php
    session_start();
    require_once('classes.php');
    $cdDemolay = $_SESSION['cd_demolay'];
    $demolay = new demolay($cdDemolay);
    $demolays = $demolay->verDemolays();
    $reunioes = $demolay->verReunioes();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <script src="openDivs.js"></script>
    <script>
        function validarReuniao(){
            let data = document.getElementById("iData").value;
            let pauta = document.getElementById("iPauta").value;
            
            if(data==""||pauta=="")
                return false;
            else
                return true;
        }
        function validarEditReuniao(){
            let cdReuniao = document.getElementById("iEditReuniao").value;
            let pauta = document.getElementById("iEditPauta").value;
            
            if(cdReuniao==""||pauta==""){
                return false;
            }
            else{
                let resultado = confirm("Deseja alterar a\npauta de reunião?");
                if(resultado)
                    return true;
                else
                    return false;
            }
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
    require_once('menu.php');//menu
    if(!empty($_REQUEST["salvarReuniao"])){
        $data = $_REQUEST["data"];
        $pauta = $_REQUEST["pauta"];
        $gestao = 1;

        $mestreConselheiro = new mestreConselheiro($cdDemolay);
        $mestreConselheiro->salvarReuniao($data,$pauta,$gestao);
    }
    if(!empty($_REQUEST["editarReuniao"])){
        $cdReuniao = $_REQUEST["nEditReuniao"];
        $pauta = $_REQUEST["nEditPauta"];
        $gestao = 1;

        $mestreConselheiro = new mestreConselheiro($cdDemolay);
        $mestreConselheiro->editarReuniao($cdReuniao, $pauta);
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
    <h3 onclick="show('divReunioes')">Salvar nova Reunião</h3>
    <div class="hide" id="divReunioes">
        <form action="#" method="post">
            <table>
                <tr><td>Data:</td><td><input type="date" name="data" id="iData"></td></tr>
                <tr><td>Pauta:</td><td><textarea name="pauta" id="iPauta" maxlength="100" class="pauta"></textarea></td></tr>
                <tr><td></td><td><input type="submit" onclick="return validarReuniao();" value="Salvar" name="salvarReuniao"></td></tr>
            </table>
        </form>
    </div>
</div>

<div class="reunioes">
    <h3 onclick="show('divEditReunioes')">Editar Reunião</h3>
    <div class="hide" id="divEditReunioes">
        <form action="#" method="post">
            <table>
                <tr>
                    <td>Reunião:</td>
                    <td>
                        <select name="nEditReuniao" id="iEditReuniao">
                            <?php
                                for ($index0=0; $index0 < sizeof($reunioes); $index0++) {
                                    echo "<option value=".$reunioes[$index0][0].">".$reunioes[$index0][1]."</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr><td>Pauta:</td><td><textarea name="nEditPauta" id="iEditPauta" maxlength="100" class="pauta"></textarea></td></tr>
                <tr><td></td><td><input type="submit" onclick="return validarEditReuniao();" value="Editar" name="editarReuniao"></td></tr>
            </table>
        </form>
    </div>
</div>

<div class="membros">
    <h3 onclick="show('divMembros')">Salvar novo Membro</h3>
    <div class="hide" id="divMembros">
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
    <h3 onclick="show('divComissoes')">Salvar nova Comissão</h3>
    <div class="hide" id="divComissoes">
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