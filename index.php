<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <style>
    </style>
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
    if (!$_SESSION) {?>

    <form action="#" method="post">
        <table>
        <tr><td>Login:</td><td><input type="text" name="nLogin" id="iLogin"></td></tr>
        <tr><td>Senha:</td><td><input type="password" name="nPassword" id="iPassword"></td></tr>
        <tr><td></td><td><input type="submit" onclick="return validarLogin();" value="Logar" name="btnLogin"></td></tr>
        </table>
    </form>
    <?php }else{ ?>
    <form action="#" method="post">
    <input type="submit" onclick="" value="Deslogar" name="btnUnlogin">
    </form>
    <?php }
    ?>
    
    <?php
    print_r($_SESSION);
        if(!empty($_REQUEST["btnLogin"])){
            $login = $_REQUEST["nLogin"];
            $senha = $_REQUEST["nPassword"];
    
            require_once('classes.php');
            $usuario = new usuario();
            $login = $usuario->logar($login, $senha);
            if(!$login){//login nao existe
            }
            else{
                $demolay = new demolay($login[2]);//enviando o cd_demolay para o construtor
                echo "Codigo do Usuario: $login[0]";echo "<br>";
                echo "CID:".$demolay->cid;echo "<br>";
                echo "Nome:".$demolay->nome;echo "<br>";
                echo "Capitulo:".$demolay->capitulo;
                echo "<br>";
                print_r($_SESSION);
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