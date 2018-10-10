<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="estilo.css">
    <script src="openDivs.js"></script>
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
        var idAntigoPresenca;
        function showPresencas(id){
            if(idAntigoPresenca!=null){
                let elementoAntigo = document.getElementById(idAntigoPresenca);
                elementoAntigo.className = "hide";
            }
            let elemento = document.getElementById(id);
            elemento.className = "show";
            idAntigoPresenca = id;
        }
    </script>
</head>
<body>
    <?php
        session_start();
        require_once('classes.php');
        $cdDemolay = $_SESSION['cd_demolay'];
        $demolay = new demolay($cdDemolay);
        require_once('menu.php');
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
    
    <div class="presencas">
        <h3 onclick="show('divPresenca')">Presenças</h3>
        <div class="hide" id="divPresenca">
        <?php
            if($presencas!=null){
                for ($index0=0; $index0 < sizeof($presencas); $index0++) { ?>
                    <div class='container'>
                        <div class='item-a'>
                            <p><?php echo "Reunião: ".$presencas[$index0][0] ."<br>". $presencas[$index0][1];?></p>
                            <?php if(isset($presencas[$index0][2])){?>
                                <p onclick="showPresencas('reuniao<?php echo $presencas[$index0][0];?>')">Ver Presentes</p>
                            <?php }?>
                        </div>
                        <div class='item-b'>
                            <div class="hide" id='reuniao<?php echo $presencas[$index0][0];?>'>
                                <?php
                                    if(isset($presencas[$index0][2]))
                                        for ($index1=0; $index1 < sizeof($presencas[$index0][2]); $index1++)
                                            echo "<p>".$presencas[$index0][2][$index1]."</p>";
                                ?>
                            </div>
                        </div>
                    </div>
                <?php
                }
            }
        ?>
        </div>
    </div>

    <div class="ata">
        <h3 onclick="show('divAta')">Salvar Ata de Reunião</h3>
        <div class="hide" id="divAta">
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
        <h3 onclick="show('divSalvarPresenca')">Salvar Presença</h3>
        <div class="hide" id="divSalvarPresenca">
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