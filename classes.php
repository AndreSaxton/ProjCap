<?php
    class demolay{
        function __construct($nome){
            $this->conexao = new mysqli('localhost', 'root','', 'projcap');
            
            $conexao = $this->conexao;
            $consulta = "SELECT * FROM demolay 
            JOIN capitulo ON capitulo.cd_capitulo = demolay.cd_capitulo 
            WHERE nm_demolay='$nome'";
            $verifica = $conexao->query($consulta);
            $rows = $verifica->num_rows;
            if($rows == 0){ //verifica se a informação chegou
                echo "falha ao buscar";
            }else{
                $busca = $conexao->query($consulta);
                $demolay = array();
                $index0 = 0;
                while($info = $busca->fetch_assoc()){
                    $this->cid = $info['cd_cid_demolay'];
                    $this->nome = $info['nm_demolay'];
                    $this->capitulo = $info['nm_capitulo'];
                }
            }
        }
        public $conexao;
        
        public $cid;
        public $nome;
        public $cargo;
        public $capitulo;

        function pagarMensalidade(){}
        function verMensalidade(){
            $conexao = $this->conexao;
            $consulta = "SELECT mensalidade.*, nm_demolay FROM mensalidade 
                JOIN demolay ON demolay.cd_demolay = mensalidade.cd_demolay
                WHERE cd_cid_demolay = $this->cid";
            $verifica = $conexao->query($consulta);
            $rows = $verifica->num_rows;
            if($rows == 0){ //verifica se a informação chegou
                echo "falha ao buscar";
            }else{
                $busca = $conexao->query($consulta);
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
            $verifica = $conexao->query($consulta);
            $rows = $verifica->num_rows;
            if($rows == 0){ //verifica se a informação chegou
                echo "falha ao buscar";
            }else{
                $busca = $conexao->query($consulta);
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
            $verifica = $conexao->query($consulta);
            $rows = $verifica->num_rows;
            if($rows == 0){ //verifica se a informação chegou
                echo "falha ao buscar";
            }else{
                $busca = $conexao->query($consulta);
                $comissoes = array();
                $index0 = 0;
                while($info = $busca->fetch_assoc()){
                    $comissoes[$index0][0] = $info['cd_comissao'];
                    $comissoes[$index0][1] = $info['nm_comissao'];
                    $comissoes[$index0][2] = $info['nm_demolay'];
                    $comissoes[$index0][3] = $info['cd_gestao'];//colocar membros
                    
                    $comissao = $comissoes[$index0][1];
                    $consulta = "SELECT membro.*, demolay.nm_demolay FROM membro
                    JOIN comissao ON comissao.cd_comissao = membro.cd_comissao
                    JOIN demolay ON demolay.cd_demolay = membro.cd_demolay
                    WHERE nm_comissao = '".$comissao."'";
                    $verifica = $conexao->query($consulta);
                    $rows = $verifica->num_rows;
                    if($rows == 0){ //verifica se a informação chegou
                        //echo "$comissao nao tem membros";
                    }else{
                        $membros = 0;
                        while($info = $verifica->fetch_assoc()){
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
            $verifica = $conexao->query($consulta);
            $rows = $verifica->num_rows;
            if($rows == 0){ //verifica se a informação chegou
                echo "falha ao buscar";
            }else{
                $busca = $conexao->query($consulta);
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
                (SELECT cd_demolay FROM demolay WHERE nm_demolay = '$presidente'), 
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
    }
    class tesoureiro extends demolay{
        function verMensalidades(){
            $conexao = $this->conexao;
            $consulta = "SELECT mensalidade.*, nm_demolay FROM mensalidade 
                JOIN demolay ON demolay.cd_demolay = mensalidade.cd_demolay";
            $verifica = $conexao->query($consulta);
            $rows = $verifica->num_rows;
            if($rows == 0){ //verifica se a informação chegou
                echo "falha ao buscar";
            }else{
                $busca = $conexao->query($consulta);
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
        function salvarAta(){}
        function mudarAta(){}
        function salvarPresenca(){}
    }
    class presidenteComissao extends demolay{
        function __construct($cid){
            $this->conexao = new mysqli('localhost', 'root','', 'projcap');
            $conexao = $this->conexao;
            $consulta = "SELECT * FROM comissao 
            JOIN demolay ON demolay.cd_demolay = comissao.cd_demolay
            WHERE cd_cid_demolay=$cid";
            $verifica = $conexao->query($consulta);
            $rows = $verifica->num_rows;
            if($rows == 0){ //verifica se a informação chegou
                //echo "Não preside comissão";
                $this->comissao = "nenhuma";
            }else{
                $busca = $conexao->query($consulta);
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
        function adicionarMembro($nome, $comissao){
            $conexao = $this->conexao;
            $consulta = "INSERT INTO membro (cd_demolay, cd_comissao) VALUES 
                ((SELECT demolay.cd_demolay FROM demolay WHERE nm_demolay = '$nome'), 
                (SELECT comissao.cd_comissao FROM comissao WHERE nm_comissao = '$comissao'));";
            $conexao->query($consulta);
            echo $consulta;
        }
        function retirarMembro(){}
    }
?>