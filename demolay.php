<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <style>
    #calendario{
        height: auto;
    }
    #calendario div{
        float: left;
        width: auto;
        height: 60px;
        border: solid black 1px;
        border-collapse: separate;
        display: block;
    }
    #calendario div:hover #pauta{
        display: block;
    }
    #calendario div:hover{
        height: auto;
        width: 20%;
    }
    #pauta{
        display: none;
    }
    table#mensalidades td{
        border: solid black 1px;
    }
    #membros td{
        width: auto;
        border: solid black 1px;
    }
    #comissao td{
        width: auto;
        border: solid black 1px;
    }
    </style>
</head>
<body>
    <?php
    require_once('index.php');//cabecalho

    require_once('classes.php');
    $cdDemolay = $_SESSION['cd_demolay'];
    $demolay = new demolay($cdDemolay);
    $reunioes = $demolay->verReunioes();
    $mensalidades = $demolay->verMensalidade();
    $demolays = $demolay->verDemolays();
    $comissoes = $demolay->verComissao();
    ?>

    <div id="mensalidades">
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
    </div>

    <h3>Membros</h3>
    <table id="membros">
    <tr><td>N</td><td>CID</td><td>Nome</td><td>Capitulo</td></tr>
    <?php
    for ($index0=0; $index0 < sizeof($demolays); $index0++) { 
        echo "<tr>";
        for ($index1=0; $index1 < 4; $index1++) { 
            echo "<td>".$demolays[$index0][$index1]."</td>";
        }
        echo "</tr>";
    }
    ?>
    </table>

    <h3>Comissões</h3>
    <table id="comissao">
    <tr><td>N</td><td>Nome da Comissão</td><td>Presidente</td><td>Gestão</td><td>Membros</td></tr>
    <?php
    for ($index0=0; $index0 < sizeof($comissoes); $index0++) { 
        echo "<tr>";
        for ($index1=0; $index1 < 5; $index1++) {
            echo "<td>";
            if($index1==4){
                if(isset($comissoes[$index0][$index1]))
                    for ($index2=0; $index2 < sizeof($comissoes[$index0][$index1]); $index2++) { 
                        echo $comissoes[$index0][$index1][$index2]."<br>";
                    }
            }
            else
                echo $comissoes[$index0][$index1];
            echo "</td>";
        }
        echo "</tr>";
    }
    ?>
    </table>

    <div id="calendario">
    <h3>Reuniões</h3>
    <?php
    for ($index0=0; $index0 < sizeof($reunioes) ; $index0++) {
        echo "<div>";
        for ($index1=0; $index1 < 3; $index1++) {
            if ($index1==0) echo "Reunião: ";
            if ($index1==2) echo "Pauta:<text id='pauta'>";
            echo $reunioes[$index0][$index1];
            if ($index1==2) echo "</text>";
            echo "<br>";
        }
        echo "</div>";
    }
    ?>
    </div>
</body>
</html>