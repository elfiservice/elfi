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

            unset($campoArr['id']);
            $arrObj = array_values((array) $pesquisaObj);
            unset($arrObj[0]);

            $campoArr = implode(', ', array_keys($campoArr));
            $valores = " '" . implode("','", array_values($arrObj)) . "' ";

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

    /**
     * Realiza o algoritimo para obter o valor da porcentagem de Satisfacao para 1 Orçamento com base na Pesquisa de Satisfação
     * @param int $orcId = ID do Orcamento
     * @param int $clienteId = ID do cliente
     * @return float = valor sem formatação representando o valor já em porcentagem
     */
    public function percentagemSatisfacao($orcId, $clienteId) {
        $itensPesquisa = $this->buscarControleNOrc("*", "WHERE id_orc = '$orcId' AND id_cliente = '$clienteId' ");

        if (!empty($itensPesquisa)) {
            $somaDos12 = $itensPesquisa[0]->getConfiabilidade() + $itensPesquisa[0]->getPontualidade() + $itensPesquisa[0]->getDisponibilide() + $itensPesquisa[0]->getQualidade() + $itensPesquisa[0]->getNormasseguranca() + $itensPesquisa[0]->getApresentacao() + $itensPesquisa[0]->getEnvolvimento() + $itensPesquisa[0]->getEducacao() + $itensPesquisa[0]->getOrganizacao() + $itensPesquisa[0]->getCompetencia() + $itensPesquisa[0]->getOrcamento() + $itensPesquisa[0]->getServico();
            $somaDos12emPerct = $somaDos12 * 8.33333334;
            if ($itensPesquisa[0]->getSatisfeito() == 1) {
                $somaDos12emPerct = $somaDos12emPerct + 100;
                $somaDos12emPerctResult = $somaDos12emPerct / 2;
            } else {
                $somaDos12emPerctResult = $somaDos12emPerct / 2;
            }
            return $somaDos12emPerctResult;
        }else{
            return NULL;
        }
    }

    public function mediaSatisfacao($id_cliente) {
        $orcCtrl = new OrcamentoCtrl();
        $orcamentos = $orcCtrl->buscarOrcamentos("*", "WHERE  id_cliente = '$id_cliente' AND situacao_orc = 'concluido' AND feito_pos_entreg = 's' ");

        $somaPesquisa = 0;
        if (!empty($orcamentos)) {
            foreach ($orcamentos as $row) {
                $id_orc = $row['id'];
                $resultPesquisaOrc = $this->percentagemSatisfacao($id_orc, $id_cliente);
                $somaPesquisa = $somaPesquisa + $resultPesquisaOrc;
            }
            
            return $somaPesquisa / count($orcamentos);
            //var_dump($mediaSatisfacaoCliente);
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
