<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <style>
    #mensalidades td{
        width: auto;
        border: solid black 1px;
    }
    </style>
</head>
<body>
    <?php
    require_once('index.php');
    require_once('classes.php');
    $cdDemolay = $_SESSION['cd_demolay'];
    $tesoureiro = new tesoureiro($cdDemolay);
    $mensalidades = $tesoureiro->verMensalidades();
    ?>

    <h3>mensalidades</h3>
    <table id="mensalidades">
    <tr><td>N</td><td>Mes</td><td>Pagamento</td><td>Demolay</td></tr>
    <?php
    for ($index0=0; $index0 < sizeof($mensalidades); $index0++) { 
        echo "<tr>";
        for ($index1=0; $index1 < 4; $index1++) { 
            echo "<td>".$mensalidades[$index0][$index1]."</td>";
        }
        echo "</tr>";
    }
    ?>
    </table>
</body>
</html>