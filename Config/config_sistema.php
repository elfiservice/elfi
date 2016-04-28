<?php
// faz conexуo com o servidor MySQL
$local_serve = "localhost"; 	 // local do servidor
$usuario_serve = "root";		 // nome do usuario
$senha_serve = "";			 	 // senha
$banco_de_dados = "elfiserv_sistema_elfi"; 	 // nome do banco de dados

$conn = @mysql_connect($local_serve,$usuario_serve,$senha_serve) or die ("O servidor nуo responde!");

// conecta-se ao banco de dados
$db = @mysql_select_db($banco_de_dados,$conn) 
	or die ("Nуo foi possivel conectar-se ao banco de dados!");
	
// dados do administrador sуo de estrema importancia que sem eles
// o adminstrador nуo tera acesso as paginas de administraчуo
$login_admin = "";  			// nome do administrador
$senha_admin = "";						// senha administrador
$email_admin = "";  // email do administrador



