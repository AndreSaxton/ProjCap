<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="estilo.css">
    <script>
        var cdDemolaysPresentes = [];
        var nmDemolaysPresentes = [];
        var cont = 0;
        var primeiroRegistro = true;
        
        function addPresenca(){
            let cdDemolay = document.getElementById("iDemolay").value;
            let nmDemolay = document.getElementById("iDemolay").options[document.getElementById("iDemolay").selectedIndex].text;
            
            if (cdDemolay) {
                cdDemolaysPresentes [cont] = cdDemolay;
                nmDemolaysPresentes [cont] = nmDemolay;
                
                console.log(cdDemolaysPresentes+" "+nmDemolaysPresentes);

                let para =  document.createElement("p");
                let text = document.createTextNode(nmDemolaysPresentes [cont]);
                let tb = document.getElementById("tbPresentes");
                //let tr = document.getElementById("trPresentes");
                let tr =  document.createElement("tr");
                let td = document.createElement("td");
                let td2 = document.createElement("td");
                para.appendChild(text);
                td.appendChild(para);
                tr.appendChild(td, td2);
                tb.appendChild(tr);
                
                tb.appendChild(tr);

                cont++;
            }
        }
    </script>
</head>
<body>
    <?php
        session_start();
        require_once('menu.html');//menu

        require_once('classes.php');
        $cdDemolay = $_SESSION['cd_demolay'];
        $demolay = new demolay($cdDemolay);
        $demolays = $demolay->verDemolays();
        $reunioes = $demolay->verReunioes();

        if(!empty($_REQUEST["salvarAta"])){
            $reuniao = $_REQUEST["nReuniao"];
            $ata = $_REQUEST["nAta"];
            $tipo = $_REQUEST["nTipo"];

            $escrivao = new escrivao($cdDemolay);
            $escrivao->salvarAta($reuniao, $ata, $tipo);
        }
        if(!empty($_REQUEST["salvarPresenca"])){
            $reuniao = $_REQUEST["nReuniao"];
            $demolaysPresentes = $_REQUEST["nDemolays"];

            $escrivao = new escrivao($cdDemolay);
            //$escrivao->salvarPresenca($reuniao, $demolaysPresentes);
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

    <div class="presenca">
        <label>Salvar Ata de Reunião</label>
        <div class="form">
            <form action="#" method="post">
                <table id="tbPresentes">
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
                    <tr><td colspan = 2>Presentes:</td></tr>
                    <tr>
                        <td>
                            <select name="nDemolay" id="iDemolay">
                                <option value="" disabled selected style="display:none;"></option>
                                <?php
                                    for ($index0=0; $index0 < sizeof($demolays); $index0++) {
                                        echo "<option value=".$demolays[$index0][0].">".$demolays[$index0][2]."</option>";
                                    }
                                ?>
                            </select>
                        </td>
                        <td>
                            <button type="button" onclick="addPresenca();">Adicionar</button>
                        </td>
                    </tr>
                    <tr><td></td><td><input type="submit" onclick="return validarAta();" value="Salvar" name="salvarAta"></td></tr>
                    <tr id="trPresentes"><td></td><td></td></tr>
                </table>
            </form>
        </div>
    </div>

</body>
</html>