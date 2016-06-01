<?php

class  Conexao {
	
	private $servidor = "localhost";
	private $usuario_servidor = "root";
	private $senha_servidor = "";
	private $bando_de_dados = "elfiserv_sistema_elfi";
	 
/*	public function __construct($pServidor, $pUsuario_servidor, $pSenha_servidor, $pBanco_de_dados){
		$this->servidor = $pServidor;
		$this->usuario_servidor = $pUsuario_servidor;
		$this->senha_servidor = $pSenha_servidor;
		$this->bando_de_dados = $pBanco_de_dados;
	}
*/	

	
	
	public function conectar(){
		//$conn = @mysql_connect("localhost","root","") or die ("O servidor nao responde!");
		
		//conecta-se ao banco de dados
		//$db = @mysql_select_db("elfiserv_sistema_elfi",$conn)
		//or die ("Nao foi possivel conectar-se ao banco de dados!");
		new mysqli('localhost','root','','elfiserv_sistema_elfi');
		//$mysqli = new mysqli($this->servidor,$this->usuario_servidor,'','elfiserv_sistema_elfi');
		// = $mysqli->query('SELECT * FROM colaboradores');
		//$query->num_rows;
	}
	
	public static function desconectar(){
		mysql_close(mysql_connect($this->servidor,$this->usuario_servidor,$this->senha_servidor)) or die ("N�o foi possivel DESconectar-se ao banco de dados!");;
	}

	
}