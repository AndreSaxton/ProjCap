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
        function validarDeleteReuniao(){
            let cdReuniao = document.getElementById("iEditReuniao").value;
            if(cdReuniao==""){
                return false;
            }
            else{
                let resultado = confirm("Deseja apagar a\n reunião?");
                if(resultado)
                    return true;
                else
                    return false;
            }
        }
        function validarNominata(){
            let idsNominata = document.getElementsByName("idNominata");
            let repetido = false;
            let vazio = false;
            for (let index1 = 0; index1 < idsNominata.length; index1++) {
                if(idsNominata[index1].value != ""){//se o campo nao estiver vazio
                    //console.log(idsNominata[index1].value);
                    for (let index2 = 0; index2 < idsNominata.length; index2++) {
                        //ver se ninguem foi repetido
                        //console.log(idsNominata[index1].value);
                        if (idsNominata[index1] != idsNominata[index2]) {//se a linha nao for a mesma
                            if(idsNominata[index1].value == idsNominata[index2].value)
                                repetido = true;
                        }
                    }
                }
                else{
                    vazio = true;
                }
            }
            
            if (repetido||vazio) {
                if (repetido)
                    alert("Um DM não pode \nocupar 2 cargos");
                if (vazio)
                    alert("Preencha todos os cargos");
            }
            else{
                let resultado = confirm("Esta é a nominata para a proxima gestão?");
                if(resultado){
                    let inputJson = document.getElementById("iJsonIdsNominata");
                    inputJson.value = "";
                    let jsonNominata;
                    jsonNominata = "[";
                    for (index1 = 0; index1 < idsNominata.length; index1++){
                        jsonNominata += "{" +idsNominata[index1].value + "}";
                        if(index1 < idsNominata.length-1)
                            jsonNominata += ",";
                    }
                    jsonNominata += "]";
                    inputJson.value = jsonNominata;

                    return true;
                }
            }
            return false;
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
    if(!empty($_REQUEST["deletarReuniao"])){
        $cdReuniao = $_REQUEST["nEditReuniao"];
        $mestreConselheiro = new mestreConselheiro($cdDemolay);
        $resultado = $mestreConselheiro->deletarReuniao($cdReuniao);
        //mudar o que esta abaixo
        if($resultado==false)
            echo "<script>alert('nao foi');</script>";
        else
            echo "<script>alert('apagado');</script>";
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
    if(!empty($_REQUEST["mudarGestao"])){
        $nominata = $_REQUEST["idNominata"];


        $mestreConselheiro = new mestreConselheiro($cdDemolay);
        //$mestreConselheiro->mudarGestao($);
    }
    echo $nominata;
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
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" onclick="return validarEditReuniao();" value="Editar" name="editarReuniao">
                        <input type="submit" onclick="return validarDeleteReuniao();" value="Deletar" name="deletarReuniao">
                    </td>
                </tr>
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

<div class="gestao">
    <h3 onclick="show('divFimGestao')">Encerrar Gestão</h3>
    <div class="hide" id="divFimGestao">
        <form action="#" method="post">
            <table>
                <tr>
                    <td>Mestre Conselheiro</td>
                    <td>
                        <select name="idNominata">
                            <option value="" disabled selected style="display:none;"></option>
                            <?php
                                for ($index0=0; $index0 < sizeof($demolays); $index0++) {
                                    echo "<option value=".$demolays[$index0][0].">".$demolays[$index0][2]."</option>";
                                }
                            ?>
                        </select>
                    </td>
                    <td>Capelão</td>
                    <td>
                        <select name = "idNominata">
                            <option value="" disabled selected style="display:none;"></option>
                            <?php
                                for ($index0=0; $index0 < sizeof($demolays); $index0++) {
                                    echo "<option value=".$demolays[$index0][0].">".$demolays[$index0][2]."</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>1º Conselheiro</td>
                    <td>
                        <select name = "idNominata">
                            <option value="" disabled selected style="display:none;"></option>
                            <?php
                                for ($index0=0; $index0 < sizeof($demolays); $index0++) {
                                    echo "<option value=".$demolays[$index0][0].">".$demolays[$index0][2]."</option>";
                                }
                            ?>
                        </select>
                    </td>
                    <td>2º Conselheiro</td>
                    <td>
                        <select name="idNominata">
                            <option value="" disabled selected style="display:none;"></option>
                            <?php
                                for ($index0=0; $index0 < sizeof($demolays); $index0++) {
                                    echo "<option value=".$demolays[$index0][0].">".$demolays[$index0][2]."</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Escrivão</td>
                    <td>
                        <select name="idNominata">
                            <option value="" disabled selected style="display:none;"></option>
                            <?php
                                for ($index0=0; $index0 < sizeof($demolays); $index0++) {
                                    echo "<option value=".$demolays[$index0][0].">".$demolays[$index0][2]."</option>";
                                }
                            ?>
                        </select>
                    </td>
                    <td>Orador</td>
                    <td>
                        <select name="idNominata">
                            <option value="" disabled selected style="display:none;"></option>
                            <?php
                                for ($index0=0; $index0 < sizeof($demolays); $index0++) {
                                    echo "<option value=".$demolays[$index0][0].">".$demolays[$index0][2]."</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Tesoureiro</td>
                    <td>
                        <select name="idNominata">
                            <option value="" disabled selected style="display:none;"></option>
                            <?php
                                for ($index0=0; $index0 < sizeof($demolays); $index0++) {
                                    echo "<option value=".$demolays[$index0][0].">".$demolays[$index0][2]."</option>";
                                }
                            ?>
                        </select>
                    </td>
                    <td>Hospitaleiro</td>
                    <td>
                        <select name="idNominata">
                            <option value="" disabled selected style="display:none;"></option>
                            <?php
                                for ($index0=0; $index0 < sizeof($demolays); $index0++) {
                                    echo "<option value=".$demolays[$index0][0].">".$demolays[$index0][2]."</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Mestre de Cerimônias</td>
                    <td>
                        <select name="idNominata">
                            <option value="" disabled selected style="display:none;"></option>
                            <?php
                                for ($index0=0; $index0 < sizeof($demolays); $index0++) {
                                    echo "<option value=".$demolays[$index0][0].">".$demolays[$index0][2]."</option>";
                                }
                            ?>
                        </select>
                    </td>
                    <td>Porta Estandarte</td>
                    <td>
                        <select name="idNominata">
                            <option value="" disabled selected style="display:none;"></option>
                            <?php
                                for ($index0=0; $index0 < sizeof($demolays); $index0++) {
                                    echo "<option value=".$demolays[$index0][0].">".$demolays[$index0][2]."</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Organista</td>
                    <td>
                        <select name="idNominata">
                            <option value="" disabled selected style="display:none;"></option>
                            <?php
                                for ($index0=0; $index0 < sizeof($demolays); $index0++) {
                                    echo "<option value=".$demolays[$index0][0].">".$demolays[$index0][2]."</option>";
                                }
                            ?>
                        </select>
                    </td>
                    <td>Sentinela</td>
                    <td>
                        <select name="idNominata">
                            <option value="" disabled selected style="display:none;"></option>
                            <?php
                                for ($index0=0; $index0 < sizeof($demolays); $index0++) {
                                    echo "<option value=".$demolays[$index0][0].">".$demolays[$index0][2]."</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>1º Diácono</td>
                    <td>
                        <select name="idNominata">
                            <option value="" disabled selected style="display:none;"></option>
                            <?php
                                for ($index0=0; $index0 < sizeof($demolays); $index0++) {
                                    echo "<option value=".$demolays[$index0][0].">".$demolays[$index0][2]."</option>";
                                }
                            ?>
                        </select>
                    </td>
                    <td>2º Diácono</td>
                    <td>
                        <select name="idNominata">
                            <option value="" disabled selected style="display:none;"></option>
                            <?php
                                for ($index0=0; $index0 < sizeof($demolays); $index0++) {
                                    echo "<option value=".$demolays[$index0][0].">".$demolays[$index0][2]."</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>1º Mordomo</td>
                    <td>
                        <select name="idNominata">
                            <option value="" disabled selected style="display:none;"></option>
                            <?php
                                for ($index0=0; $index0 < sizeof($demolays); $index0++) {
                                    echo "<option value=".$demolays[$index0][0].">".$demolays[$index0][2]."</option>";
                                }
                            ?>
                        </select>
                    </td>
                    <td>2º Mordomo</td>
                    <td>
                        <select name="idNominata">
                            <option value="" disabled selected style="display:none;"></option>
                            <?php
                                for ($index0=0; $index0 < sizeof($demolays); $index0++) {
                                    echo "<option value=".$demolays[$index0][0].">".$demolays[$index0][2]."</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>1º Preceptor</td>
                    <td>
                        <select name="idNominata">
                            <option value="" disabled selected style="display:none;"></option>
                            <?php
                                for ($index0=0; $index0 < sizeof($demolays); $index0++) {
                                    echo "<option value=".$demolays[$index0][0].">".$demolays[$index0][2]."</option>";
                                }
                            ?>
                        </select>
                    </td>
                    <td>2º Preceptor</td>
                    <td>
                        <select name="idNominata">
                            <option value="" disabled selected style="display:none;"></option>
                            <?php
                                for ($index0=0; $index0 < sizeof($demolays); $index0++) {
                                    echo "<option value=".$demolays[$index0][0].">".$demolays[$index0][2]."</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>3º Preceptor</td>
                    <td>
                        <select name="idNominata">
                            <option value="" disabled selected style="display:none;"></option>
                            <?php
                                for ($index0=0; $index0 < sizeof($demolays); $index0++) {
                                    echo "<option value=".$demolays[$index0][0].">".$demolays[$index0][2]."</option>";
                                }
                            ?>
                        </select>
                    </td>
                    <td>4º Preceptor</td>
                    <td>
                        <select name="idNominata">
                            <option value="" disabled selected style="display:none;"></option>
                            <?php
                                for ($index0=0; $index0 < sizeof($demolays); $index0++) {
                                    echo "<option value=".$demolays[$index0][0].">".$demolays[$index0][2]."</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>5º Preceptor</td>
                    <td>
                        <select name="idNominata">
                            <option value="" disabled selected style="display:none;"></option>
                            <?php
                                for ($index0=0; $index0 < sizeof($demolays); $index0++) {
                                    echo "<option value=".$demolays[$index0][0].">".$demolays[$index0][2]."</option>";
                                }
                            ?>
                        </select>
                    </td>
                    <td>6º Preceptor</td>
                    <td>
                        <select name="idNominata">
                            <option value="" disabled selected style="display:none;"></option>
                            <?php
                                for ($index0=0; $index0 < sizeof($demolays); $index0++) {
                                    echo "<option value=".$demolays[$index0][0].">".$demolays[$index0][2]."</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>7º Preceptor</td>
                    <td>
                        <select name="idNominata">
                            <option value="" disabled selected style="display:none;"></option>
                            <?php
                                for ($index0=0; $index0 < sizeof($demolays); $index0++) {
                                    echo "<option value=".$demolays[$index0][0].">".$demolays[$index0][2]."</option>";
                                }
                            ?>
                        </select>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><input type="submit" onclick="return validarNominata();" value="Salvar" name="mudarGestao"></td>
                    <td><input type="text" name="nJsonIdsNominata" id="iJsonIdsNominata"></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </form>
    </div>
</div>

</body>
</html>