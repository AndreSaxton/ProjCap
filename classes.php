<?php
//adicionar session pra guardar a class demolay
    class usuario{
        function logar($login, $senha){
            $conexao = new mysqli('localhost', 'root','', 'projcap');
            $stmt = $conexao->prepare('SELECT * FROM usuario WHERE nm_usuario = ? AND nm_senha_usuario = ?');
            $stmt->bind_param('ss',$login, $senha);
            $stmt->execute();
            $busca = $stmt->get_result();
            if ($busca->num_rows) {
                while($info = $busca->fetch_assoc()){
                    $usuario[0] = $info['cd_usuario'];
                    $usuario[1] = $info['nm_usuario'];
                    $usuario[2] = $info['cd_demolay'];
                }
                $_SESSION['cd_usuario'] = $usuario[0];
                $_SESSION['nm_usuario'] = $usuario[1];
                $_SESSION['cd_demolay'] = $usuario[2];
                //print_r($busca);
                return $usuario;
            }
            //else //nao encontrado
        }
        function deslogar(){
            unset($_SESSION);
            session_destroy();
        }
    }
    class demolay{
        function __construct($cdDemolay){
            $this->conexao = new mysqli('localhost', 'root','', 'projcap');
            $conexao = $this->conexao;
            $consulta = "SELECT * FROM demolay 
            JOIN capitulo ON capitulo.cd_capitulo = demolay.cd_capitulo 
            JOIN gestao ON gestao.cd_capitulo = capitulo.cd_capitulo
            WHERE cd_demolay = $cdDemolay AND cd_gestao IN (SELECT MAX(gestao.cd_gestao) FROM gestao)";
            $busca = $conexao->query($consulta);
            $rows = $busca->num_rows;
            if($rows == 0){ //verifica se a informação chegou
                echo "falha ao buscar";
            }else{
                $demolay = array();
                $index0 = 0;
                while($info = $busca->fetch_assoc()){
                    $this->cid = $info['cd_cid_demolay'];
                    $this->nome = $info['nm_demolay'];
                    $this->capitulo = $info['nm_capitulo'];
                    $this->gestao = $info['nm_gestao'];
                }
            }
        }
        public $conexao;
        
        public $cid;
        public $nome;
        public $capitulo;
        public $gestao;

        function pagarMensalidade(){}
        function verMensalidade(){
            $conexao = $this->conexao;
            $consulta = "SELECT mensalidade.*, nm_demolay FROM mensalidade 
                JOIN demolay ON demolay.cd_demolay = mensalidade.cd_demolay
                WHERE cd_cid_demolay = $this->cid";
            $busca = $conexao->query($consulta);
            $rows = $busca->num_rows;
            if($rows == 0){ //verifica se a informação chegou
                echo "falha ao buscar";
            }else{
                $mensalidades = array();
                $index0 = 0;
                while($info = $busca->fetch_assoc()){
                    $mensalidades[$index0][0] = $info['cd_mensalidade'];
                    $mensalidades[$index0][1] = $info['dt_mensalidade'];
                    $mensalidades[$index0][2] = $info['dt_pagamento_mensalidade'];
                    $mensalidades[$index0][3] = $info['nm_demolay'];
                    $index0++;
                }
                return $mensalidades;
            }
        }
        function verReunioes(){
            $conexao = $this->conexao;
            $consulta = "SELECT * FROM reuniao";
            $busca = $conexao->query($consulta);
            $rows = $busca->num_rows;
            if($rows == 0){ //verifica se a informação chegou
                echo "falha ao buscar";
            }else{
                $reunioes = array();
                $index0 = 0;
                while($info = $busca->fetch_assoc()){
                    $reunioes[$index0][0] = $info['cd_reuniao'];
                    $reunioes[$index0][1] = $info['dt_reuniao'];
                    $reunioes[$index0][2] = $info['nm_pauta_reuniao'];
                    $reunioes[$index0][3] = $info['cd_gestao'];
                    $index0++;
                }
                return $reunioes;
            }
        }
        function verComissao(){
            $conexao = $this->conexao;
            $consulta = "SELECT comissao.*, nm_demolay FROM comissao
            JOIN demolay ON demolay.cd_demolay = comissao.cd_demolay";
            $busca = $conexao->query($consulta);
            $rows = $busca->num_rows;
            if($rows == 0){ //verifica se a informação chegou
                echo "falha ao buscar";
            }else{
                $comissoes = array();
                $index0 = 0;
                while($info = $busca->fetch_assoc()){
                    $comissoes[$index0][0] = $info['cd_comissao'];
                    $comissoes[$index0][1] = $info['nm_comissao'];
                    $comissoes[$index0][2] = $info['nm_demolay'];
                    $comissoes[$index0][3] = $info['cd_gestao'];
                    //colocar membros
                    
                    $comissao = $comissoes[$index0][1];
                    $consulta = "SELECT membro.*, demolay.nm_demolay FROM membro
                    JOIN comissao ON comissao.cd_comissao = membro.cd_comissao
                    JOIN demolay ON demolay.cd_demolay = membro.cd_demolay
                    WHERE nm_comissao = '".$comissao."'";

                    $busca2 = $conexao->query($consulta);
                    $rows = $busca2->num_rows;
                    if($rows == 0){ //verifica se a informação chegou
                        //echo "$comissao nao tem membros";
                    }else{
                        $membros = 0;
                        while($info = $busca2->fetch_assoc()){
                            $comissoes[$index0][4][$membros] = $info['nm_demolay'];
                            $membros++;
                        }
                    }
                    $index0++;
                }
                return $comissoes;
            }
        }
        function verDemolays(){
            $conexao = $this->conexao;
            $consulta = "SELECT * FROM demolay JOIN capitulo ON capitulo.cd_capitulo = demolay.cd_capitulo";
            $busca = $conexao->query($consulta);
            $rows = $busca->num_rows;
            if($rows == 0){ //verifica se a informação chegou
                echo "falha ao buscar";
            }else{
                $demolays = array();
                $index0 = 0;
                while($info = $busca->fetch_assoc()){
                    $demolays[$index0][0] = $info['cd_demolay'];
                    $demolays[$index0][1] = $info['cd_cid_demolay'];
                    $demolays[$index0][2] = $info['nm_demolay'];
                    $demolays[$index0][3] = $info['nm_capitulo'];
                    $index0++;
                }
                return $demolays;
            }
        }
        function verNominata(){
            $conexao = $this->conexao;
            $consulta = "SELECT * FROM nominata 
            JOIN demolay ON demolay.cd_demolay = nominata.cd_demolay
            JOIN oficial ON oficial.cd_oficial = nominata.cd_oficial
            JOIN gestao ON gestao.cd_gestao = nominata.cd_gestao";
            $busca = $conexao->query($consulta);
            $rows = $busca->num_rows;
            if($rows == 0){ //verifica se a informação chegou
                echo "falha ao buscar";
            }else{
                $nominata = array();
                $index0 = 0;
                while($info = $busca->fetch_assoc()){
                    $nominata[$index0][0] = $info['nm_gestao'];
                    $nominata[$index0][1] = $info['nm_oficial'];
                    $nominata[$index0][2] = $info['cd_cid_demolay'];
                    $nominata[$index0][3] = $info['nm_demolay'];
                    /*
                    $nominata[$index0][3] = $info['cd_demolay'];
                    $nominata[$index0][3] = $info['cd_oficial'];
                    $nominata[$index0][3] = $info['cd_nominata'];
                    $nominata[$index0][3] = $info['cd_capitulo'];
                    $nominata[$index0][3] = $info['cd_gestao'];
                    */
                    $index0++;
                }
                return $nominata;
            }
        }
    }
    class mestreConselheiro extends demolay{
        function adicionarDemolay($cid,$nome,$capitulo){
            $conexao = $this->conexao;
            $consulta = "INSERT INTO demolay 
                (cd_cid_demolay, nm_demolay, cd_capitulo) 
                VALUES (".$cid.", '".$nome."', 
                (SELECT cd_capitulo FROM capitulo WHERE nm_capitulo = '$capitulo'));";
            $conexao->query($consulta);
        }
        function adicionarComissao($comissao, $presidente, $gestao){
            $conexao = $this->conexao;
            $consulta = "INSERT INTO comissao (nm_comissao, cd_demolay, cd_gestao) 
                VALUES ('".$comissao."', 
                (SELECT cd_demolay FROM demolay WHERE cd_demolay = '$presidente'), 
                (SELECT cd_gestao FROM gestao WHERE cd_gestao = $gestao));";
            $conexao->query($consulta);
        }
        function salvarReuniao($data, $pauta, $gestao){
            $conexao = $this->conexao;
            $consulta = "INSERT INTO reuniao (dt_reuniao, nm_pauta_reuniao, cd_gestao) 
                VALUES ('".$data."', '".$pauta."', 
                (SELECT cd_gestao FROM gestao WHERE cd_gestao = $gestao));";
            $conexao->query($consulta);
        }
        function mudarReuniao(){}
        function apagarReuniao(){}
        function mudarGestao(){}
        function fazerNominata(){}
    }
    class tesoureiro extends demolay{
        function verMensalidades(){
            $conexao = $this->conexao;
            $consulta = "SELECT mensalidade.*, nm_demolay FROM mensalidade 
                JOIN demolay ON demolay.cd_demolay = mensalidade.cd_demolay";
            $busca = $conexao->query($consulta);
            $rows = $busca->num_rows;
            if($rows == 0){ //verifica se a informação chegou
                echo "falha ao buscar";
            }else{
                $mensalidades = array();
                $index0 = 0;
                while($info = $busca->fetch_assoc()){
                    $mensalidades[$index0][0] = $info['cd_mensalidade'];
                    $mensalidades[$index0][1] = $info['dt_mensalidade'];
                    $mensalidades[$index0][2] = $info['dt_pagamento_mensalidade'];
                    $mensalidades[$index0][3] = $info['nm_demolay'];
                    $index0++;
                }
                return $mensalidades;
            }
        }
        function darBaixaMensalidade(){}
        function adicionarGasto(){}
    }
    class escrivao extends demolay{
        function salvarAta($cdReuniao ,$ata, $tipo){
            //ver como salvar a ata
            $conexao = $this->conexao;
            $consulta = "INSERT INTO ata (nm_tipo_ata, cd_reuniao) 
            VALUES ('$tipo',(SELECT cd_reuniao FROM reuniao WHERE cd_reuniao = $cdReuniao));";
            $conexao->query($consulta);
        }
        function mudarAta(){}//saltarAta ja salva as resalvas
        function salvarPresenca($cdReuniao, $arrayDemolays){
            $conexao = $this->conexao;
            $consulta = "INSERT INTO presenca 
            (cd_reuniao, cd_demolay) 
            VALUES ";
            $arrayDemolays = (json_decode($arrayDemolays));
            for ($cont=0; $cont < sizeof($arrayDemolays); $cont++) {
                $cdDemolay = $arrayDemolays[$cont][0];
                $consulta .= "(
                    (SELECT cd_reuniao FROM reuniao WHERE cd_reuniao = $cdReuniao),
                    (SELECT cd_demolay FROM demolay WHERE cd_demolay = $cdDemolay)
                )";
                if ($cont < sizeof($arrayDemolays)-1)
                    $consulta.=", ";
            }
            $consulta.=";";
            $conexao->query($consulta);
        }
    }
    class presidenteComissao extends demolay{
        function __construct($cdDemolay){
            $this->conexao = new mysqli('localhost', 'root','', 'projcap');
            $conexao = $this->conexao;
            $consulta = "SELECT * FROM comissao 
            JOIN demolay ON demolay.cd_demolay = comissao.cd_demolay
            WHERE demolay.cd_demolay=$cdDemolay";
            $busca = $conexao->query($consulta);
            $rows = $busca->num_rows;
            if($rows == 0){ //verifica se a informação chegou
                //echo "Não preside comissão";
                $this->comissao = "nenhuma";
            }else{
                $comissao = array();
                $index0 = 0;
                while($info = $busca->fetch_assoc()){
                    $comissao[0] = $info['cd_cid_demolay'];
                    $comissao[1] = $info['nm_comissao'];
                    $comissao[2] = $info['nm_demolay'];
                    $this->comissao = $comissao[1];
                }
                //print_r($comissao);
                $this->comissao;
            }
        }
        public $comissao;
        function adicionarMembro($cdDemolay, $comissao){
            $conexao = $this->conexao;
            $consulta = "INSERT INTO membro (cd_demolay, cd_comissao) VALUES 
                ((SELECT demolay.cd_demolay FROM demolay WHERE cd_demolay = '$cdDemolay'), 
                (SELECT comissao.cd_comissao FROM comissao WHERE nm_comissao = '$comissao'));";
            $conexao->query($consulta);
            //echo $consulta;
        }
        function retirarMembro($cdMembro){
            $conexao = $this->conexao;
            $consulta = "DELETE FROM membro WHERE cd_membro = $cdMembro";
            $conexao->query($consulta);
        }
        function verMembroComissao($comissao){
            $conexao = $this->conexao;
            $consulta = "SELECT membro.*, nm_demolay FROM membro
            JOIN demolay ON demolay.cd_demolay = membro.cd_demolay
            WHERE cd_comissao = (SELECT cd_comissao FROM comissao WHERE nm_comissao = '$comissao')";
            $busca = $conexao->query($consulta);
            $rows = $busca->num_rows;
            if($rows == 0){ //verifica se a informação chegou
                echo "falha ao buscar";
            }else{
                $comissoes = array();
                $index0 = 0;
                while($info = $busca->fetch_assoc()){
                    $comissoes[$index0][0] = $info['cd_membro'];
                    $comissoes[$index0][1] = $info['nm_demolay'];
                    $index0++;
                }
                return $comissoes;
            }
        }
    }
?>