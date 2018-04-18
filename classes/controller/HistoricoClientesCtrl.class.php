<?php

/**
 * Description of HistoricoClientes
 *
 * @author armandojunior
 */
class HistoricoClientesCtrl extends CRUDAbstractCtrl {
    
    private $clienteDao;

    public function HistoricoClientesCtrl() {
        $this->clienteDao = new HistoricoClientesDAO();
    }
    
     /**
     * Fazer SELECT no BD na tabela
     * @param string $campos = Campos do BD a serem pesquisados
     * @param string $termos = Termos para Filtrar a Busca no BD (WHERE, etc)
     * @return Array do tipo --><b>HistoricoClientes</b><-- se encontrar resultados, se não retorna NULL
     */
    public function buscarBD($campos, $termos, $dao = null) {
        $daoResult = $this->testaSeExisteDAO($dao);
        $select = parent::buscarBD($campos, $termos, $daoResult);
        if (!empty($select)) {
            return $this->montarObjeto($select);
        } else {
            return NULL;
        }       
    }
    
    
     /**
     * Fazer INSERT no BD na tabela = historico_clientes
     * @param HistoricoClientes $obj = passar uma Instancia deste tipo para inserir no BD
     * @return boolean = TRUE se Sucesso ao inserir dados no BD e FALSE se houver algum problema na INSERÇÃO ou se o OBJETO não foi passado corretamente
     */
    public function inserirBD($obj, $dao = null) {
        $daoResult = $this->testaSeExisteDAO($dao);
        return parent::inserirBD($obj, $daoResult);
    }
    
    
    
    //--------------------------------------------------
    //----------------PRIVATES---------------------
    //--------------------------------------------------
    
    private function testaSeExisteDAO($dao) {
        $daoResult = $this->clienteDao;
        if($dao) {
            $daoResult = $dao;
        }
        return $daoResult;
    }

    private function montarObjeto($arrayDados) {
        $arrayObj = array();
        foreach ($arrayDados as $dado) {
            extract($dado);
            $arrayObj[] = new HistoricoClientes($id, $id_cliente, $alteracao, $data);
        }

        return $arrayObj;
    }

}
