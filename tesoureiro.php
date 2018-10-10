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
    require_once('classes.php');
    $cdDemolay = $_SESSION['cd_demolay'];
    $tesoureiro = new tesoureiro($cdDemolay);
    $mensalidades = $tesoureiro->verMensalidades();
    require_once('menu.php');
    ?>

    <div class="mensalidades">
        <h3 onclick="show('mensalidades')">Mensalidades</h3>
            <table class="hide" id="mensalidades">
                <tr><td>N</td><td>Mes</td><td>Pagamento</td><td>Demolay</td></tr>
                <?php
                for ($index0=0; $index0 < sizeof($mensalidades); $index0++) { 
                    echo "<tr>";
                    for ($index1=0; $index1 < 4; $index1++) { 
                        echo "<td>".$mensalidades[$index0][$index1]."</td>";
                    }
                    echo "</tr>";
                } ?>
            </table>
    </div>
    
</body>
</html>