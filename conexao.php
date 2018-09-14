<?php
$conexao = new mysqli('localhost', 'root','', 'projcap'); 
//$conexao = new mysqli('tcp:serverpresentacao1309.database.windows.net,1433', 'saxton','apresentac@0', 'bdtrabalho'); 
//Variavel = new mysqli("servidor", "usuario", "senha", "banco") or die("Erro ao conectar");
	if (!$conexao)
	{ 
	 	die('problema na conexão');
	}
?>