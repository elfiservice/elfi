<?php
class Login extends Conexao{
	
	private $login;
	private $senha;
	
		
	public function getLogin(){
		return $this->login;
	}
	
	public function getSenha(){
		return $this->senha;
	}
	
	public function setLogin($pLogin){
		$this->login = $pLogin;
	}
	
	public function setSenha($pSenha){
		$this->senha = $pSenha;
	}
	
	public function logar(){
		
		parent::conectar();
		
		$email = $this->login;
		$senha = $this->senha;
		//$email = strip_tags($email);
		//$senha = strip_tags($senha);
		//$email = mysql_real_escape_string($email);
		
		//$senha = md5($senha);
		$sql = mysql_query("SELECT * FROM usuarios WHERE Email='$email' AND Senha='$senha' ") or die (mysql_error());
		$login_check = mysql_num_rows($sql);
		
		if($login_check > 0){
			while($row = mysql_fetch_array($sql)){

				//$id = $row["id"];
				//$_SESSION['id'] = $id;
				//$_SESSION['idx'] = base64_encode("g4p3h9xfn8sq03hs2234$id");
				//$username = $row["Nome"];
				//$_SESSION['Login'] = $username;
		
				//mysql_query("UPDATE colaboradores SET last_log_date=now() WHERE id_colaborador = '$id' LIMIT 1");
		
			} // close while
		
			$_SESSION['email'] = $email;
			$_SESSION['pass'] = $senha;
		
			parent::desconectar();
			
			return true;
				
		} else { // Run this code if login_check is equal to 0 meaning they do not exist
			return false;
		
		}
	}
	
	
	
}