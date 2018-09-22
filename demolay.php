<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <style>
    table#mensalidades td{
        border: solid black 1px;
    }
    #mensalidades table{
        display: none;
    }
    #mensalidades:hover table{
        display: block;
    }

    #membros td{
        width: auto;
        border: solid black 1px;
    }
    #membros table{
        display: none;
    }
    #membros:hover table{
        display: block;
    }

    #comissao td{
        width: auto;
        border: solid black 1px;
    }
    #comissoes table{
        display: none;
    }
    #comissoes:hover table{
        display: block;
    }

    #calendario div div{
    }
    .item-a {
        grid-area: header;
    }
    .item-b {
        grid-area: main;
    }
    .container {
        /*width: 30%;*/
        margin: 5px;
        background-color: rgb(167, 72, 72);

        display: grid;
        grid-template-columns: 30% 70%;
        grid-template-rows: auto;
        grid-template-areas: 
            "header main";
    }
    .containers{
        display: grid;
        width: 100%;
        grid-template-columns: repeat(3, 1fr);
    }
    </style>
    <link rel="stylesheet" href="estilo.css">
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
        <h3>Mensalidades</h3>
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

    <div id="membros">
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
    </div>

    <div id="comissoes">
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
    </div>

    <!--div id="calendario">
        <h3>Reuniões</h3>
        <div class="containers">
            <div class='container'>
                <div class='item-a'>
                    <p>Reunião: 1 <br> 2018/12/12</p>
                </div>
                <div class='item-b'>
                    pauta
                </div>
            </div>
            <div class='container'>
                <div class='item-a'>
                    <p>Reunião: 1 <br> 2018/12/12</p>
                </div>
                <div class='item-b'>
                    pauta
                </div>
            </div>
            <div class='container'>
                <div class='item-a'>
                    <p>Reunião: 1 <br> 2018/12/12</p>
                </div>
                <div class='item-b'>
                    pauta
                </div>
            </div>
        </div>
    </div-->

    <div id="calendario">
        <h3>Reuniões</h3>
        <div class="containers">
            <?php for ($index0=0; $index0 < sizeof($reunioes) ; $index0++) { ?>
                <div class='container'>
                    <div class='item-a'>
                        <p>Reunião: <?php echo $reunioes[$index0][0]; ?>
                        <?php echo $reunioes[$index0][1]; ?></p>
                    </div>
                    <div class='item-b'>
                        <?php echo $reunioes[$index0][2]; ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</body>
</html>