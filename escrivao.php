<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <?php
    session_start();
    require_once('menu.html');//menu

    require_once('classes.php');
    $cdDemolay = $_SESSION['cd_demolay'];
    $demolay = new demolay($cdDemolay);
    $reunioes = $demolay->verReunioes();

    if(!empty($_REQUEST["salvarAta"])){
        $reuniao = $_REQUEST["nReuniao"];
        $ata = $_REQUEST["nAta"];
        $tipo = $_REQUEST["nTipo"];

        $escrivao = new escrivao($cdDemolay);
        $escrivao->salvarAta($reuniao, $ata, $tipo);
    }
    ?>
<div class="ata">
    <label>Salvar Ata de Reunião</label>
    <div class="form">
        <form action="#" method="post">
            <table>
                <tr>
                    <td>Reunião:</td>
                    <td>
                        <select name="nReuniao" id="iReuniao">
                            <?php
                                for ($index0=0; $index0 < sizeof($reunioes); $index0++) {
                                    echo "<option value=".$reunioes[$index0][0].">".$reunioes[$index0][1]."</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Tipo:</td>
                    <td>
                        <select name="nTipo" id="iTipo">
                            <option value="Nova">Nova</option>
                            <option value="Resalva">Resalva</option>
                        </select>
                    </td>
                </tr>
                <tr><td>Ata:</td>
                    <td>
                        <textarea name="nAta" id="iAta" maxlength="100">ver como vou upar o arquivo da ata</textarea>
                    </td>
                </tr>
                <tr><td></td><td><input type="submit" onclick="return validarAta();" value="Salvar" name="salvarAta"></td></tr>
            </table>
        </form>
    </div>
</div>

</body>
</html>