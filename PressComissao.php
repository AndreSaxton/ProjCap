<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="estilo.css">
    <script src="openDivs.js"></script>
</head>
<body>

    <?php
    session_start();
    require_once('menu.html');
    require_once('classes.php');
    $cdDemolay = $_SESSION['cd_demolay'];
    $demolay = new demolay($cdDemolay);
    $demolays = $demolay->verDemolays();
    $pressComissao = new presidenteComissao($cdDemolay);
    $membrosComissao = $pressComissao->verMembroComissao($pressComissao->comissao);

    if ($pressComissao->comissao!="nenhuma") { ?>
        <div class="membros">
            <h3 onclick="show('DivAddMembros')">Adicionar membros à <?php echo$pressComissao->comissao ?></h3>
            <div class="hide" id="DivAddMembros">
                <form action="#" method="post" id="formAddMembroComissao">
                    <table>
                        <tr>
                            <td><label for="iMembro">Nome:</label></td>
                            <td>
                                <select name="nMembro" id="iMembro">
                                <?php
                                for ($index0=0; $index0 < sizeof($demolays); $index0++) {
                                    echo "<option value=".$demolays[$index0][0].">".$demolays[$index0][2]."</option>";
                                }
                                ?>
                                </select>
                            </td>
                        </tr>
                        <tr><td></td><td><input type="submit" value="Adicionar" name="addMembroComissao"></td></tr>
                    </table>
                </form>
            </div>
        </div>
        
        <div class="membros">
            <h3 onclick="show('DivTirarMembros')">Retirar membros da <?php echo$pressComissao->comissao?></h3>
            <div class="hide" id="DivTirarMembros">
                <form action="#" method="post" id="formRetirarMembroComissao">
                    <table>
                        <tr>
                            <td><label for="iMembro">Nome:</label></td>
                            <td>
                                <select name="nMembro" id="iMembro">
                                <?php
                                for ($index0=0; $index0 < sizeof($membrosComissao); $index0++) {
                                    echo "<option value=".$membrosComissao[$index0][0].">".$membrosComissao[$index0][1]."</option>";
                                }
                                ?>
                                </select>
                            </td>
                        </tr>
                        <tr><td></td><td><input type="submit" value="Retirar" name="retirarMembroComissao"></td></tr>
                    </table>
                </form>
            </div>
            
        </div>
        
        <div class="comissoes">
            <h3 onclick="show('comissao')">Membros da Comissao de <?php echo$pressComissao->comissao?></h3>
            <table class="hide" id="comissao">
                <tr><td>N</td><td>Membros</td></tr>
                <?php
                    for ($index0=0; $index0 < sizeof($membrosComissao); $index0++) { 
                        echo "<tr>";
                        for ($index1=0; $index1 < 2; $index1++) {
                            echo "<td>";
                                echo $membrosComissao[$index0][$index1];
                            echo "</td>";
                        }
                        echo "</tr>";
                    }
                ?>
            </table>
        </div>
    <?php
    }
    
    if(!empty($_REQUEST["addMembroComissao"])){
        $membro = $_REQUEST["nMembro"];
        $comissao = $pressComissao->comissao;

        $pressComissao = new presidenteComissao($cdDemolay);
        $pressComissao->adicionarMembro($membro ,$comissao);
    }
    if(!empty($_REQUEST["retirarMembroComissao"])){
        $membro = $_REQUEST["nMembro"];
        $comissao = $pressComissao->comissao;

        $pressComissao = new presidenteComissao($cdDemolay);
        $pressComissao->retirarMembro($membro);
    }
    ?>

    
</body>
</html>