<?php
// include '../classes/dao/UsuarioDAO.class.php';
// include '../classes/model/Usuario.class.php';
class UsuarioCtrl{
	
	private $usuarioDao;
	
	public function UsuarioCtrl() {
		$this->usuarioDao = new UsuarioDAO();
	}
	
	public function buscarUserPorId ($id){
		$linha_user = $this->usuarioDao->buscarUsuario($id);
		if ($linha_user <> "" || $linha_user <> null ){
			$usuario = new Usuario($linha_user->id_colaborador,
									$linha_user->Login,
									$linha_user->Senha, 
									$linha_user->cpf, 
									$linha_user->tipo, 
									$linha_user->last_log_date, 
									$linha_user->email_activated, 
									$linha_user->Email);
			return $usuario;
		}else {
			header("location: ../erro.php");
		}
		
		
	}
	
	public function buscarUserPorLogin ($login){
		$linha_user = $this->usuarioDao->buscarUsuarioLogin($login);
		if ($linha_user <> "" || $linha_user <> null ){
			$usuario = new Colaborador($linha_user->id_colaborador,
					$linha_user->Login,
					$linha_user->Senha,
					$linha_user->cpf,
					$linha_user->tipo,
					$linha_user->last_log_date,
					$linha_user->email_activated,
					$linha_user->Email);
			return $usuario;
		}else {
			//header("location: ../erro.php");
		}
	
	
	}
	
}