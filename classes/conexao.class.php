<?php

class  Conexao {
	
	private $servidor = "localhost";
	private $usuario_servidor = "root";
	private $senha_servidor = "";
	private $bando_de_dados = "test";
	 
/*	public function __construct($pServidor, $pUsuario_servidor, $pSenha_servidor, $pBanco_de_dados){
		$this->servidor = $pServidor;
		$this->usuario_servidor = $pUsuario_servidor;
		$this->senha_servidor = $pSenha_servidor;
		$this->bando_de_dados = $pBanco_de_dados;
	}
*/	

	public function conectar(){
		$conn = @mysql_connect($this->servidor,$this->usuario_servidor,$this->senha_servidor) or die ("O servidor não responde!");
		
		// conecta-se ao banco de dados
		$db = @mysql_select_db($this->bando_de_dados,$conn)
		or die ("Não foi possivel conectar-se ao banco de dados!");
		
	}
	
	public function desconectar(){
		mysql_close(mysql_connect($this->servidor,$this->usuario_servidor,$this->senha_servidor)) or die ("Não foi possivel DESconectar-se ao banco de dados!");;
	}
	
}