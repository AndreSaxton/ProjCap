<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="estilo.css">
    <script>
        var cont = 0;
        var demolays = new Array();
        
        function validarAta(){
            // a fazer
            //return false;
        }
        function addPresenca(){
            let cdDemolay = document.getElementById("iDemolay").value;
            let nmDemolay = document.getElementById("iDemolay").options[document.getElementById("iDemolay").selectedIndex].text;

            if (cdDemolay) {
                demolays[cont] = new Array();
                demolays [cont][0] = cdDemolay;
                demolays [cont][1] = nmDemolay;

                let text1 = document.createTextNode(demolays[cont][1]);
                let text2 = document.createTextNode(demolays[cont][1]);
                let para1 =  document.createElement("input");
                let para2 =  document.createElement("p");
                let tb = document.getElementById("tbPresentes");
                let tr =  document.createElement("tr");
                let td1 = document.createElement("td");
                let td2 = document.createElement("td");

                para1.setAttribute("type", "button");
                para1.setAttribute("value", "Excluir");
                para1.setAttribute("onclick", "excluirLinha(linha"+cont+", "+cont+")");
                tr.setAttribute("id", "linha"+cont);

                //para1.appendChild(text1);
                para2.appendChild(text2);
                td1.appendChild(para1);
                td2.appendChild(para2);
                tr.appendChild(td1);
                tr.appendChild(td2);
                tb.appendChild(tr);
                
                console.log("criado");
                console.log(demolays);
                cont++;
            }
        }
        function excluirLinha(linha, id){
            //console.log(linha);
            linha.parentNode.removeChild(linha);
            demolays.splice(id, 1);
            console.log("retirado");
            console.log(demolays);
        }
        function salvarPresencas(){
            var jsonDemolay = JSON.stringify(this.demolays);
            document.getElementById("arrayDemolays").value = jsonDemolay;
            console.log(jsonDemolay);
            if (document.getElementById("arrayDemolays").value=="[]") {
                return false;
            }
            else{
                return true;
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
        $escrivao = new escrivao($cdDemolay);
        $presencas = $escrivao->verPresencas();
        //echo "<pre>";
        //var_dump($presencas);

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
            $escrivao->salvarPresenca($reuniao, $demolaysPresentes);
            header("location: escrivao.php?");
        }
    ?>

    alterar layout das presenças
    <div class="presencas">
        <h3>Presenças</h3>
        <table class="presenca">
        <tr><td>cd reuniao</td><td>Reunião</td></tr>
        <?php
        if($presencas!=null){
            for ($index0=0; $index0 < sizeof($presencas); $index0++) { 
                echo "<tr>";
                for ($index1=0; $index1 < 3; $index1++) { 
                    echo "<td>";
                    if($index1==2){
                        if(isset($presencas[$index0][$index1]))
                            for ($index2=0; $index2 < sizeof($presencas[$index0][$index1]); $index2++) { 
                                echo $presencas[$index0][$index1][$index2]."<br>";
                            }
                    }
                    else
                        echo $presencas[$index0][$index1];
                    echo"</td>";
                }
                echo "</tr>";
            }
        }
        ?>
        </table>
    </div>

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
        <label>Salvar Presença</label>
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
                    <tr><td><input type="hidden" id="arrayDemolays" name="nDemolays"></td><td><input type="submit" onclick="return salvarPresencas();" value="Salvar" name="salvarPresenca"></td></tr>
                </table>
            </form>
        </div>
    </div>

</body>
</html>