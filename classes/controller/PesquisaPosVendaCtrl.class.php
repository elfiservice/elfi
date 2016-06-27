<?php

/**
 * PesquisaPosVendaCtrl.class [ Controller ]
 * Responsavel por fazer o Controle da View com o BDados
 * @copyright (c) 2016, Armando JR. ELFISERVICE
 */
class PesquisaPosVendaCtrl {

    /**  @var PesquisaPosVendaDAO   */
    private $OrcDao;

    public function __construct() {
        $this->OrcDao = new PesquisaPosVendaDAO();
    }

        /**
     * Fazer INSERT no BD na tabela = pesquisa_pos_venda
     * @param PesquisaPosVenda $pesquisaObj = passar uma Instancia deste tipo para inserir no BD
     * @return boolean = TRUE se Sucesso ao inserir dados no BD e FALSE se houver algum problema na INSERÇÃO ou se o OBJETO não foi passado corretamente
     */
    public function inserirPesquisa(PesquisaPosVenda $pesquisaObj) {
        if ($pesquisaObj instanceof PesquisaPosVenda) {

            foreach ((array) $pesquisaObj as $campo => $valor) {
                $campo = str_replace("\0PesquisaPosVenda\0", "", $campo);
                $campoArr[$campo] = $campo;
            }

            $campoArr = implode(', ', array_keys($campoArr));
            $valores = " '" . implode("','", array_values((array) $pesquisaObj)) . "' ";

            if ($this->OrcDao->insert($campoArr, $valores)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Fazer SELECT no BD na tabela = pesquisa_pos_venda
     * @param string $campos = Campos do BD a serem pesquisados
     * @param string $termos = Termos para Filtrar a Busca no BD (WHERE, etc)
     * @return Array de Objetos do tipo PesquisaPosVenda se encontrar resultados, são retorna NULL
     */
    public function buscarControleNOrc($campos, $termos) {
        $colabBD = $this->OrcDao->select($campos, $termos);
        if (!empty($colabBD)) {

            return $this->montarObjeto($colabBD);
        } else {
            return NULL;
        }
    }

    //--------------------------------------------------
    //----------------PRIVATES---------------------
    //--------------------------------------------------
    private function montarObjeto($colabBD) {
        $arrayObjColab = array();
        foreach ($colabBD as $colabBD0) {
            extract($colabBD0);
            $arrayObjColab[] = new PesquisaPosVenda($id, $id_orc, $id_cliente, $confiabilidade, $pontualidade, $disponibilide, $qualidade, $normasseguranca, $apresentacao, $envolvimento, $educacao, $organizacao, $competencia, $orcamento, $servico, $satisfeito, $outrosComentarios, $data);
        }

        return $arrayObjColab;
    }

}
