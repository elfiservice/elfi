<?php

class ColaboradorCtrl{
	private $ColaboradorDao;
	
	public function __construct(){
	$this->ColaboradorDao = new ColaboradorDAO();
		
	}
	
	public function buscarColaborador($campos, $termos) {
		//return $this->ColaboradorDao->select($campos, $termos);
       
                               $colabBD = $this->ColaboradorDao->select($campos, $termos);
                               if(!empty($colabBD) ){
                                  
                                   return $this->montarObjeto($colabBD);
                               }else{
                                   return null;
                                   
                               }
                               
	}
        
        public function montarObjeto($colabBD){
                $colabBD0 = $colabBD[0];
            return new Colaborador($colabBD0['id_colaborador'], $colabBD0['Login'], $colabBD0['Senha'], $colabBD0['cpf'], $colabBD0['tipo'], $colabBD0['Email'], $colabBD0['last_log_date'], $colabBD0['email_activated']);
        }
}