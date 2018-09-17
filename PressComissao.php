<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <style>
    
    </style>

    <script>
    
</script>
</head>
<body>



    <?php
    require_once('classes.php');
    $demolay = new demolay("Andre");
    $demolays = $demolay->verDemolays();
    $pressComissao = new presidenteComissao($demolay->cid);
    $membrosComissao = $pressComissao->verMembroComissao($pressComissao->comissao);

    if ($pressComissao->comissao!="nenhuma") {
        ?>
        <form action="#" method="post" id="formAddMembroComissao">
        <h2>Adicionar membros à <?php echo$pressComissao->comissao?></h2>
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

        <form action="#" method="post" id="formRetirarMembroComissao">
        <h2>Retirar membros da <?php echo$pressComissao->comissao?></h2>
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

        <h3>Membros da Comissao de <?php echo$pressComissao->comissao?></h3>
        <table id="comissao">
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
        <?php
    }

    
    if(!empty($_REQUEST["addMembroComissao"])){
        $membro = $_REQUEST["nMembro"];
        $comissao = $pressComissao->comissao;

        $pressComissao = new presidenteComissao($demolay->cid);
        $pressComissao->adicionarMembro($membro ,$comissao);
    }
    if(!empty($_REQUEST["retirarMembroComissao"])){
        $membro = $_REQUEST["nMembro"];
        $comissao = $pressComissao->comissao;

        $pressComissao = new presidenteComissao($demolay->cid);
        $pressComissao->retirarMembro($membro);
    }
    ?>

    
</body>
</html>