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
    <?php
    session_start();
    require_once('classes.php');
    if (!$_SESSION) {?>

    <div class="login">
        <form action="#" method="post">
            <table>
            <tr><td>Login:</td><td><input type="text" name="nLogin" id="iLogin" value="andrelfs"></td></tr>
            <tr><td>Senha:</td><td><input type="password" name="nPassword" id="iPassword" value="forna"></td></tr>
            <tr><td></td><td><input type="submit" onclick="return validarLogin();" value="Logar" name="btnLogin"></td></tr>
            </table>
        </form>
    </div>
    
    <?php }else{
        $cd_demolay = $_SESSION['cd_demolay'];
        $demolay = new demolay($cd_demolay);//enviando o cd_demolay para o construtor

        require_once('menu.html');//menu
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