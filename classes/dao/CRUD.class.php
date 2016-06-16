<?php

/**
 * CRUD.class [ INTERFACE ]
 * Responsavel por Padronizar o CRUD do sistema para cada Entidade
 * @copyright (c) 2016, Armando JR. ELFISERVICE
 */
interface CRUD {
    
                   public function insert($camposBd, $valores, $tabela);
	public function update($camposDados, $termos, $tabela);
	public function select($campos, $termos, $tabela);
                    public function delete($termos, $tabela);
        
}
