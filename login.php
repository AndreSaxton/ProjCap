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
    <form action="#" method="post">
        <table>
        <tr><td>Login:</td><td><input type="text" name="nLogin" id="iLogin"></td></tr>
        <tr><td>Senha:</td><td><input type="password" name="nPassword" id="iPassword"></td></tr>
        <tr><td></td><td><input type="submit" onclick="return validarLogin();" value="Logar" name="btnLogin"></td></tr>
        </table>
    </form>
    <?php
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
            }
        }
    ?>
</body>
</html>