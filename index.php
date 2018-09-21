<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" text="text/css" href="estilo.css">
    <script>
        function validarLogin(){
        let login = document.getElementById("iLogin").value;
        let senha = document.getElementById("iPassword").value;
        if(login==""||senha=="")
            return false;
        else
            return true;
        }
    </script>
</head>
<body>
    <div id="menu">
        <p>MENU</p>
        <p class="opcao1"><a href="demolay.php">Demolay</a></p>
        <p class="opcao1"><a href="mestreCons.php">MC</a></p>
        <p class="opcao1"><a href="tesoureiro.php">Tes</a></p>
        <p class="opcao1"><a href="PressComissao.php">Press</a></p>
    </div>

    <?php
    session_start();
    require_once('classes.php');
    if (!$_SESSION) {?>

    <form action="#" method="post">
        <table>
        <tr><td>Login:</td><td><input type="text" name="nLogin" id="iLogin"></td></tr>
        <tr><td>Senha:</td><td><input type="password" name="nPassword" id="iPassword"></td></tr>
        <tr><td></td><td><input type="submit" onclick="return validarLogin();" value="Logar" name="btnLogin"></td></tr>
        </table>
    </form>
    <?php }else{
        //print_r($_SESSION);
        $cd_demolay = $_SESSION['cd_demolay'];
        $demolay = new demolay($cd_demolay);//enviando o cd_demolay para o construtor
    ?>
    <form action="#" method="post">
    <input type="submit" onclick="" value="Deslogar" name="btnUnlogin">
    </form>

    <table>
        <tr>
            <td>CID:</td><td><?php echo $demolay->cid;?></td>
            <td>Capitulo:</td><td><?php echo $demolay->capitulo;?></td>
        </tr>
        <tr>
            <td>Nome:</td><td><?php echo $demolay->nome;?></td>
            <td>Gestão:</td><td><?php echo $demolay->gestao;?></td>
        </tr>
        </table>
    <?php } ?>
    
    <?php
        if(!empty($_REQUEST["btnLogin"])){
            $login = $_REQUEST["nLogin"];
            $senha = $_REQUEST["nPassword"];
            $usuario = new usuario();
            $login = $usuario->logar($login, $senha);
            if(!$login){//login nao existe
            }
            else{
                //print_r($_SESSION);
                header("Location: index.php");
            }
        }
        if(!empty($_REQUEST["btnUnlogin"])){
            require_once('classes.php');
            $usuario = new usuario();
            $usuario->deslogar();
            header("Location: index.php");
        }
    ?>
</body>
</html>