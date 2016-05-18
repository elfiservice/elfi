<?php

/**
 * EmpresaDAO.class [ DAO ]
 * Descricao: consultas no BD 
 * @copyright (c) year, Armando JR. ELFISERVICE
 */
class EmpresaDAO {
    
	public function select($campos, $termos, $tabela = "empresa") {
		$read = new Read();
		$read->ExecRead($campos, $tabela, $termos);
		return $read->getResultado();
	}
}
