<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="estilo.css">
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
            <h2>Adicionar membros à <?php echo$pressComissao->comissao ?></h2>
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
                    <tr><td></td><td></td></tr>
                </table>
            </form>
        </div>
        
        <div class="membros">
            <h2>Retirar membros da <?php echo$pressComissao->comissao?></h2>
            <div class="form">
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
                        <tr><td></td><td></td></tr>
                    </table>
                </form>
            </div>
            
        </div>
        
        <div class="comissoes">
            <h2>Membros da Comissao de <?php echo$pressComissao->comissao?></h2>
            <table class="comissao">
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