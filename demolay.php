<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="estilo.css">
    <script src="openDivs.js"></script>
</head>
<body>
    <?php
        //require_once('index.php');//cabecalho
        session_start();
        require_once('menu.html');//menu
        require_once('classes.php');
        $cdDemolay = $_SESSION['cd_demolay'];
        $demolay = new demolay($cdDemolay);
        $reunioes = $demolay->verReunioes();
        $mensalidades = $demolay->verMensalidade();
        $demolays = $demolay->verDemolays();
        $comissoes = $demolay->verComissao();
        $nominata = $demolay->verNominata();
        $presencas = $demolay->verPresenca();
    ?>

    <div class="presencas">
        <h3 onclick="show('tbPresenca')">Presenças</h3>
        <table class="hide" id="tbPresenca">
        <tr><td>Gestão</td><td>cd reuniao</td><td>Reunião</td></tr>
        <?php
        if($presencas!=null){
            for ($index0=0; $index0 < sizeof($presencas); $index0++) { 
                echo "<tr>";
                for ($index1=0; $index1 < 3; $index1++) { 
                    echo "<td>".$presencas[$index0][$index1]."</td>";
                }
                echo "</tr>";
            }
        }
        ?>
        </table>
    </div>

    <div class="nominata">
        <h3 onclick="show('tbOficiais')">Nominata</h3>
        <table class="hide" id="tbOficiais">
        <tr><td>Gestão</td><td>Cargo</td><td>CID</td><td>Demolay</td></tr>
        <?php
        if($nominata!=null){
            for ($index0=0; $index0 < sizeof($nominata); $index0++) { 
                echo "<tr>";
                for ($index1=0; $index1 < 4; $index1++) { 
                    echo "<td>".$nominata[$index0][$index1]."</td>";
                }
                echo "</tr>";
            }
        }
        ?>
        </table>
    </div>

    <div class="mensalidades">
        <h3 onclick="show('tbMensalidades')">Mensalidades</h3>
        <table class="hide" id="tbMensalidades">
        <tr><td>N</td><td>Mes</td><td>Pagamento</td><td>Demolay</td></tr>
        <?php
        if($mensalidades!=null){
            for ($index0=0; $index0 < sizeof($mensalidades); $index0++) { 
                echo "<tr>";
                for ($index1=0; $index1 < 4; $index1++) { 
                    echo "<td>".$mensalidades[$index0][$index1]."</td>";
                }
                echo "</tr>";
            }
        }
        ?>
        </table>
    </div>

    <div class="membros">
        <h3 onclick="show('tbMembros')">Membros</h3>
        <table class="hide" id="tbMembros">
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

    <div class="comissoes">
        <h3 onclick="show('divComissao')">Comissões</h3>
        <div class="hide" id="divComissao">
            <?php for ($index0=0; $index0 < sizeof($comissoes) ; $index0++) { ?>
                <div class='container'>
                    <div class='item-a'>
                        <p>Comissão: <?php echo $comissoes[$index0][0]; ?>
                        <br>
                        <?php echo $comissoes[$index0][1]; ?></p>
                    </div>
                    <div class='item-b'>
                        <p>
                        <?php
                            if(isset($comissoes[$index0][4]))
                                for ($index1=0; $index1 < sizeof($comissoes[$index0][4]); $index1++) { 
                                    echo $comissoes[$index0][4][$index1]."<br>";
                                }
                        ?>
                        </p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    
    <div class="calendario">
        <h3 onclick="show('divCalendario')">Reuniões</h3>
        <div class="hide" id="divCalendario">
        <?php for ($index0=0; $index0 < sizeof($reunioes) ; $index0++) { ?>
                <div class='container'>
                    <div class='item-a'>
                        <p>Reunião: <?php echo $reunioes[$index0][0]; ?>
                        <br>
                        <?php echo $reunioes[$index0][1]; ?></p>
                    </div>
                    <div class='item-b'>
                        <p><?php echo $reunioes[$index0][2]; ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</body>
</html>