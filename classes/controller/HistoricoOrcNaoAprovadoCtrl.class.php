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

            unset($campoArr['id']);
            $arrObj = array_values((array) $obj);
            unset($arrObj[0]);

            $campoArr = implode(', ', array_keys($campoArr));
            $valores = " '" . implode("','", array_values($arrObj)) . "' ";


            if ($this->historicoOrcNAprovadoDAO->insert($campoArr, $valores)) {

                $this->logSituacoes($arrObj[1], $arrObj[4]);
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

    /**
     * Fazer UPDATE no BD na tabela = historico_orc_n_aprovado
     * @param HistoricoOrcNaoAprovado $obj =  passar uma Instancia deste tipo para inserir no BD
     * @return boolean = TRUE se Sucesso ao ATUALIZAR dados no BD e FALSE se houver algum problema na ATUALIZAÇÃO ou se o OBJETO não foi passado DO TIPO CORRETO
     */
    public function atualizarBD(HistoricoOrcNaoAprovado $obj) {
        if ($obj instanceof HistoricoOrcNaoAprovado) {
            $id = $obj->getId();
            $idOrc = $obj->getId_orc();

            foreach ((array) $obj as $campo => $valor) {
                if (!$valor == NULL || !$valor == "" || $valor == "0") {
                    $campo = str_replace("\0HistoricoOrcNaoAprovado\0", "", $campo);
                    $camposDados[] = $campo . " = '" . $valor . "'";
                }
            }

            unset($camposDados[0]);
            unset($camposDados[3]);

            $camposDados = implode(', ', $camposDados);

            if ($this->historicoOrcNAprovadoDAO->update($camposDados, "WHERE id = '$id' AND id_orc = '$idOrc'")) {

                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    //--------------------------------------------------
    //----------------PRIVATES---------------------
    //--------------------------------------------------
    private function montarObjeto($arrayDados) {
        $arrayObjColab = array();
        foreach ($arrayDados as $dado) {
            extract($dado);
            $arrayObjColab[] = new HistoricoOrcNaoAprovado($id, $id_orc, $dia_do_contato, $id_colab, $colab_elfi, $contato_cliente, $tel_cliente, $conversa, $mostrar, $dia_da_edicao);
        }

        return $arrayObjColab;
    }

    private function logSituacoes($idOrc, $id_colab) {
        $orcCtrl = new OrcamentoCtrl();
        $orcOb = $orcCtrl->buscarOrcamentoPorId("*", "WHERE id = '$idOrc' ");
        $situacao = "";
        if ($orcOb->getSituacaoOrc() == "Aprovado") {
            $situacao = "- situacao <b>Aprovado</b>";
        }elseif($orcOb->getSituacaoOrc() == "Cancelado"){
            $situacao = "- situacao <b>Cancelado</b>";
        }elseif($orcOb->getSituacaoOrc() == "Perdido"){
             $situacao = "- situacao <b>Perdido</b>";
        }
        LogCtrl::inserirLog($id_colab, "Adicionado <b>Historico</b> no orçamento <b>não aprovado</b> <a  href=\"#\" onclick=\"window.open(\'orcamento/nao_aprovados/historico_acompanhamento.php?id_orc={$idOrc}\', \'Pagina\', \'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=yes, SCROLLBARS=YES, TOP=10, LEFT=10\');\"><b>{$orcOb->getNOrc()}.{$orcOb->getAnoOrc()}</b></a> {$situacao}", "tec");
    }

}
