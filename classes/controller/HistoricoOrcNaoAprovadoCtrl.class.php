<?php

/**
 * HistoricoOrcNaoAprovadoCtrl.class [ Controle ]
 * Responsavel por fazer o Controle entre a View e o BD para tabela historico_orc_n_aprovado
 * @copyright (c) 2016, Armando JR. ELFISERVICE
 */
class HistoricoOrcNaoAprovadoCtrl {

    private $historicoOrcNAprovadoDAO;

    public function __construct() {
        $this->historicoOrcNAprovadoDAO = new HistoricoOrcNaoAprovadoDAO();
    }

    /**
     * Fazer INSERT no BD na tabela = historico_orc_n_aprovado
     * @param HistoricoOrcNaoAprovado $obj = passar uma Instancia deste tipo para inserir no BD
     * @return boolean = TRUE se Sucesso ao inserir dados no BD e FALSE se houver algum problema na INSERÇÃO ou se o OBJETO não foi passado corretamente
     */
    public function inserirBD(HistoricoOrcNaoAprovado $obj) {
        if ($obj instanceof HistoricoOrcNaoAprovado) {

            foreach ((array) $obj as $campo => $valor) {
                $campo = str_replace("\0HistoricoOrcNaoAprovado\0", "", $campo);
                $campoArr[$campo] = $campo;
            }

            $campoArr = implode(', ', array_keys($campoArr));
            $valores = " '" . implode("','", array_values((array) $obj)) . "' ";

            if ($this->historicoOrcNAprovadoDAO->insert($campoArr, $valores)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
    
    
        /**
     * Fazer SELECT no BD na tabela = historico_orc_n_aprovado
     * @param string $campos = Campos do BD a serem pesquisados
     * @param string $termos = Termos para Filtrar a Busca no BD (WHERE, etc)
     * @return Array de Objetos do tipo --><b>HistoricoOrcNaoAprovado</b><-- se encontrar resultados, se não retorna NULL
     */
    public function buscarBD($campos, $termos) {
        $select = $this->historicoOrcNAprovadoDAO->select($campos, $termos);
        if (!empty($select)) {

            return $this->montarObjeto($select);
        } else {
            return NULL;
        }
    }
    
     //--------------------------------------------------
    //----------------PRIVATES---------------------
    //--------------------------------------------------
    private function montarObjeto($arrayDados) {
        $arrayObjColab = array();
        foreach ($arrayDados as $dado) {
            extract($dado);
            $arrayObjColab[] = new HistoricoOrcNaoAprovado($id, $id_orc, $dia_do_contato, $dia_da_edicao, $id_colab, $colab_elfi, $contato_cliente, $tel_cliente, $conversa);
        }

        return $arrayObjColab;
    }

}
