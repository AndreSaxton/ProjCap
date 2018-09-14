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
    if ($pressComissao->comissao!="nenhuma") {
        ?>
        <form action="#" method="post">
        <h2>Adicionar membros à <?php echo$pressComissao->comissao?></h2>
            <table>
                <tr>
                    <td><label for="iMembro">Nome:</label></td>
                    <td>
                        <select name="nMembro" id="iMembro">
                        <?php
                        for ($index0=0; $index0 < sizeof($demolays); $index0++) {
                            echo "<option value=".$demolays[$index0][2].">".$demolays[$index0][2]."</option>";
                        }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr><td></td><td><input type="submit" value="Adicionar" name="addMembroComissao"></td></tr>
                <tr><td></td><td></td></tr>
            </table>
        </form>        
        <?php
    }

    
    if(!empty($_REQUEST["addMembroComissao"])){
        $membro = $_REQUEST["nMembro"];
        $comissao = $pressComissao->comissao;

        $pressComissao = new presidenteComissao($demolay->cid);
        $pressComissao->adicionarMembro($membro ,$comissao);
    }
    ?>

    
</body>
</html>