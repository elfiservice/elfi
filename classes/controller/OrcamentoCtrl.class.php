<?php

// include '../classes/dao/OrcamentoDAO.class.php';
// include '../classes/model/Orcamento.class.php';

class OrcamentoCtrl {

    private $OrcDao;
    private $result;

    function getResult() {
        return $this->result;
    }

    private function setResult($result) {
        $this->result = $result;
    }

    public function OrcamentoCtrl() {
        $this->OrcDao = new OrcamentoDAO();
    }

    public function nDeOrcPorUsuario($nomeUsuarioLogado) {

        return $this->OrcDao->buscarOrcamentosPorUsuario($nomeUsuarioLogado);
    }

    public function nOrcNAprovadoPorUsuarioAcompanhando($nomeUsuarioLogado) {
        return $this->OrcDao->buscarHistoricoOrcNAprovadosPorUser($nomeUsuarioLogado);
    }

    public function nOrcAprovadoPorUsuarioAcompanhando($nomeUsuarioLogado) {
        return $this->OrcDao->buscarHistoricoOrcAprovadoPorUser($nomeUsuarioLogado);
    }

    public function nOrcUsuarioAcompanhando($nomeUsuarioLogado) {
        return $this->OrcDao->burcarNOrcAcompanhando($nomeUsuarioLogado);
    }

    public function atualizarOrcamento($ocamentoObj) {
        $arrayResultAtualizacao = array();
        if ($ocamentoObj instanceof Orcamento) {

            $arrayItensOrc = array(
                "n_orc" => "",
                "id_cliente" => $ocamentoObj->getId_cliente(),
                "id_colab" => $ocamentoObj->getId_colab(),
                "ano_orc" => "",
                "colaborador_orc" => $ocamentoObj->getColabOrc(),
                "situacao_orc" => $ocamentoObj->getSituacaoOrc(),
                "razao_social_contr" => $ocamentoObj->getRazaoSocialContrat(),
                "cnpj_contr" => $ocamentoObj->getCnpjContrat(),
                "endereco_contr" => $ocamentoObj->getEnderecoContrat(),
                "bairro_contr" => $ocamentoObj->getBairroContrat(),
                "cidade_contr" => $ocamentoObj->getCidadeContrat(),
                "estado_contr" => $ocamentoObj->getEstadoContrat(),
                "cep_contr" => $ocamentoObj->getCepContrat(),
                "telefone_contr" => $ocamentoObj->getTelContrat(),
                "celular_contr" => $ocamentoObj->getCelContrat(),
                "email_contr" => $ocamentoObj->getEmailContrat(),
                "contato_clint" => $ocamentoObj->getContatoCliente(),
                "razao_social_obra" => $ocamentoObj->getRazaoSocialObra(),
                "cnpj_obra" => $ocamentoObj->getCnpjObra(),
                "endereco_obra" => $ocamentoObj->getEnderecoObra(),
                "bairro_obra" => $ocamentoObj->getBairroObra(),
                "cidade_obra" => $ocamentoObj->getCidadeObra(),
                "estado_obra" => $ocamentoObj->getEstadoObra(),
                "cep_obra" => $ocamentoObj->getCepObra(),
                "telefone_obra" => $ocamentoObj->getTelObra(),
                "celular_obra" => $ocamentoObj->getCelObra(),
                "email_obra" => $ocamentoObj->getEmailObra(),
                "atividade" => $ocamentoObj->getAtividade(),
                "classificacao" => $ocamentoObj->getClassificacao(),
                "quantidade" => $ocamentoObj->getQuantidade(),
                "unidade" => $ocamentoObj->getUnidade(),
                "descricao_servico_orc" => $ocamentoObj->getDesciServicoObra(),
                "prazo_exec_orc" => $ocamentoObj->getPrazoExec(),
                "validade_orc" => $ocamentoObj->getValidade(),
                "pagamento_orc" => $ocamentoObj->getPagamento(),
                "obs_orc" => $ocamentoObj->getObs(),
                "duvida_orc" => $ocamentoObj->getDuvida(),
                "vr_servco_orc" => $ocamentoObj->getVrServico(),
                "vr_material_orc" => $ocamentoObj->getVrMaterial(),
                "desconto_orc" => $ocamentoObj->getDesconto(),
                "vr_total_orc" => $ocamentoObj->getVrTotal(),
                "obra_igual_contrat" => $ocamentoObj->getObraIgualContrato(),
                "data_adicionado_orc" => $ocamentoObj->getDataDoOrc(),
                "data_ultima_alteracao" => $ocamentoObj->getDataUltimaAlteracao(),
                "colaborador_ultim_alteracao" => $ocamentoObj->getColabUltimaAlteracao(),
                "data_aprovada" => $ocamentoObj->getDataAprovada(),
                "data_inicio" => $ocamentoObj->getDataInicio(),
                "data_conclusao" => $ocamentoObj->getDataConclusao(),
                "dias_d_aprovado" => $ocamentoObj->getDiasDAprovado(),
                "dias_d_exec" => $ocamentoObj->getDiasDExecucao(),
                "dias_ultrapassad" => $ocamentoObj->getDiasUltrapassado(),
                "serv_concluido" => $ocamentoObj->getServConcluido(),
                "feito_pos_entreg" => $ocamentoObj->getFeitoPosEntrega(),
                "nao_conformidade" => $ocamentoObj->getNaoConformidade(),
                "obs_n_conformidad" => $ocamentoObj->getObsNConformidade(),
                "client_insatisfeito" => $ocamentoObj->getClienteInsatisfeito(),
                "data_ultimo_cont_cliente" => $ocamentoObj->getDataUltimContatoCliente(),
                "colab_ultimo_contato_client" => $ocamentoObj->getColabUltimContatoCliente(),
                "novo_cliente" => $ocamentoObj->getNovo_cliente()
            );


            $contador = 1;
            foreach ($arrayItensOrc as $campoDb => $itemOrc) {

                if (!$itemOrc == NULL || !$itemOrc == "" || $itemOrc == "0") {
                    //var_dump($itemOrc);
                    if ($contador == 1) {
                        $campoDados = "{$campoDb}='{$itemOrc}'";
                        $arrayResultAtualizacao[$campoDb] = "atualizado para {$itemOrc}";
                        $contador++;
                    } else {
                        $campoDados .= ",{$campoDb}='{$itemOrc}'";
                        $arrayResultAtualizacao[$campoDb] = "atualizado para {$itemOrc}";
                        $contador++;
                    }
                    //extract($itemArray);
                } else {
                    $arrayResultAtualizacao[$campoDb] = '';
                }
            }


            if ($this->OrcDao->update($ocamentoObj->getId(), $campoDados)) {
                $arrayResultAtualizacao[0] = true;
                $arrayResultAtualizacao["resultado"] = 'OK, atualizado!';

                $this->logAtualizarOrcAprovado($ocamentoObj);

                // $log = new Log(null, date('Y-m-d H:i:s'), $ocamentoObj->getId_colab(), "Atualizado Orcamento {$ocamentoObj->getNOrc()}.{$ocamentoObj->getAnoOrc()}", "tec", "", filter_input(INPUT_SERVER, 'REMOTE_ADDR'));
                //LogCtrl::inserirLog($ocamentoObj->getId_colab(), "Atualizado Orcamento {$ocamentoObj->getNOrc()}.{$ocamentoObj->getAnoOrc()}", "tec");
            } else {
                $arrayResultAtualizacao[0] = false;
                $arrayResultAtualizacao["resultado"] = 'Erro ao tentar atualizar!!';
            }
        } else {
            $arrayResultAtualizacao[0] = false;
            $arrayResultAtualizacao["resultado"] = 'Erro, Objeto nao e valido!';
        }

        return $arrayResultAtualizacao;
    }

    public function buscarOrcamentos($campos, $termos) {
        $orcamentosDao = $this->OrcDao->select($campos, $termos);
        return $orcamentosDao;
    }

    /**
     * 
     * @param type $campos
     * @param type $termos
     * @return \Orcamento|boolean => Objeto Orcamento ou False se nao foi encontrado nada
     */
    public function buscarOrcamentoPorId($campos, $termos) {


        $orcamentoDao2 = $this->OrcDao->select($campos, $termos);
        if (!$orcamentoDao2 == "" || !$orcamentoDao2 == null) {
            $orcamentoDao2 = $orcamentoDao2[0];
            extract($orcamentoDao2);

            return new Orcamento($id, $id_cliente, $id_colab, $n_orc, $ano_orc, $colaborador_orc, $situacao_orc, $razao_social_contr, $cnpj_contr, $endereco_contr, $bairro_contr, $cidade_contr, $estado_contr, $cep_contr, $telefone_contr, $celular_contr, $email_contr, $contato_clint, $razao_social_obra, $cnpj_obra, $endereco_obra, $bairro_obra, $cidade_obra, $estado_obra, $cep_obra, $telefone_obra, $celular_obra, $email_obra, $atividade, $classificacao, $quantidade, $unidade, $descricao_servico_orc, $prazo_exec_orc, $validade_orc, $pagamento_orc, $obs_orc, $duvida_orc, $vr_servco_orc, $vr_material_orc, $desconto_orc, $vr_total_orc, $obra_igual_contrat, $data_adicionado_orc, $data_ultima_alteracao, $colaborador_ultim_alteracao, $data_aprovada, $data_inicio, $data_conclusao, $dias_d_aprovado, $dias_d_exec, $dias_ultrapassad, $serv_concluido, $feito_pos_entreg, $nao_conformidade, $obs_n_conformidad, $client_insatisfeito, $data_ultimo_cont_cliente, $colab_ultimo_contato_client, $novo_cliente);
        } else {
            return false;
        }
    }

    public function inserirOrcamento($orcamentoObj) {
        $camposBd = "n_orc, id_cliente, id_colab, ano_orc, colaborador_orc, razao_social_contr, cnpj_contr, endereco_contr, bairro_contr, cidade_contr, estado_contr, cep_contr, telefone_contr, celular_contr, email_contr, atividade, classificacao, quantidade, unidade, descricao_servico_orc, prazo_exec_orc, validade_orc, pagamento_orc, obs_orc, duvida_orc, vr_servco_orc, vr_material_orc, vr_total_orc, data_adicionado_orc, razao_social_obra, cnpj_obra, endereco_obra, bairro_obra, estado_obra, cidade_obra, cep_obra, telefone_obra, celular_obra, email_obra, situacao_orc, contato_clint, novo_cliente";
        if ($orcamentoObj instanceof Orcamento) {
            $this->numeroDoOrc($orcamentoObj->getAnoOrc());
            $orcamentoObj->setNOrc($this->getResult());

            $this->verificaSeNovoCliente($orcamentoObj->getRazaoSocialContrat());
            $orcamentoObj->setNovo_cliente($this->getResult());


            $valores = "'{$orcamentoObj->getNOrc()}',"
                    . "'{$orcamentoObj->getId_cliente()}',"
                    . "'{$orcamentoObj->getId_colab()}',"
                    . "'{$orcamentoObj->getAnoOrc()}',"
                    . "'{$orcamentoObj->getColabOrc()}',"
                    . "'{$orcamentoObj->getRazaoSocialContrat()}',"
                    . "'{$orcamentoObj->getCnpjContrat()}',"
                    . "'{$orcamentoObj->getEnderecoContrat()}',"
                    . "'{$orcamentoObj->getBairroContrat()}',"
                    . "'{$orcamentoObj->getCidadeContrat()}',"
                    . " '{$orcamentoObj->getEstadoContrat()}',"
                    . " '{$orcamentoObj->getCepContrat()}',"
                    . " '{$orcamentoObj->getTelContrat()}',"
                    . " '{$orcamentoObj->getCelContrat()}',"
                    . " '{$orcamentoObj->getEmailContrat()}',"
                    . " '{$orcamentoObj->getAtividade()}', "
                    . "'{$orcamentoObj->getClassificacao()}',"
                    . " '{$orcamentoObj->getQuantidade()}',"
                    . " '{$orcamentoObj->getUnidade()}',"
                    . " '{$orcamentoObj->getDesciServicoObra()}',"
                    . " '{$orcamentoObj->getPrazoExec()}',"
                    . " '{$orcamentoObj->getValidade()}',"
                    . " '{$orcamentoObj->getPagamento()}',"
                    . " '{$orcamentoObj->getObs()}',"
                    . " '{$orcamentoObj->getDuvida()}', "
                    . "'{$orcamentoObj->getVrServico()}', "
                    . "'{$orcamentoObj->getVrMaterial()}',"
                    . "'{$orcamentoObj->getVrTotal()}',"
                    . "'{$orcamentoObj->getDataDoOrc()}', "
                    . "'{$orcamentoObj->getRazaoSocialObra()}',"
                    . "'{$orcamentoObj->getCnpjObra()}',"
                    . "'{$orcamentoObj->getEnderecoObra()}',"
                    . " '{$orcamentoObj->getBairroObra()}',"
                    . " '{$orcamentoObj->getEstadoObra()}',"
                    . " '{$orcamentoObj->getCidadeObra()}',"
                    . " '{$orcamentoObj->getCepObra()}',"
                    . " '{$orcamentoObj->getTelObra()}', "
                    . "'{$orcamentoObj->getCelObra()}',"
                    . " '{$orcamentoObj->getEmailObra()}',"
                    . "'Aguardando aprovação',"
                    . "'{$orcamentoObj->getContatoCliente()}',"
                    . "'{$orcamentoObj->getNovo_cliente()}'";

            //var_dump($camposBd);
            // var_dump($valores);
            // var_dump($this->OrcDao->insert($camposBd, $valores, "orcamentos"));

            if ($this->OrcDao->insert($camposBd, $valores)) {

                LogCtrl::inserirLog($orcamentoObj->getId_colab(), "Adicionado <b>novo</b> Orcamento <a href=\"#\" onclick=\"window.open(\'orcamento/imprimir_orc.php?id_orc={$this->OrcDao->lastID()}\', \'Pagina\', \'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=yes, SCROLLBARS=YES, TOP=10, LEFT=10\');\"><b>{$orcamentoObj->getNOrc()}.{$orcamentoObj->getAnoOrc()}</b></a>", "tec");

                $this->result = true;
            } else {
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }

    //HITORICO ORC
    public function buscarHistoricoOrcamento($campos, $termos, $tabela) {
        $orcamentoDao = $this->OrcDao->select($campos, $termos, $tabela);
        return $orcamentoDao;
    }

    public function inserirHistoricoOrcAprovado(array $valores, $tabela = "historico_orc_aprovado") {
        $camposBd = "id_acompanhamento, data, descricao, id_colab, colaborador";
        $valoresUser = " '{$valores[0]}','{$valores[1]}', '{$valores[2]}', '{$valores[3]}', '{$valores[4]}' ";


        if ($this->OrcDao->insert($camposBd, $valoresUser, $tabela)) {
            
            $orc = $this->buscarOrcamentoPorId("*", "WHERE id = '$valores[0]' ");
            LogCtrl::inserirLog($valores[3], "Adicionado <b>Historico</b> no orcamento <b>aprovado</b> <a href=\"?id_menu=orcamento/aprovados/hitorico_orc_aprovado&id_orc={$orc->getId()}#{$this->OrcDao->lastID()}\"<b>{$orc->getNOrc()}.{$orc->getAnoOrc()}</b></a>", "tec");
            //LogCtrl::inserirLog($valores[3], "Adicionado <b>Historico</b> no orcamento <b>aprovado</b> <a  href=\"#\" onclick=\"window.open(\'orcamento/aprovados/hitorico_orc_aprovado.php?id_orc={$orc->getId()}#{$this->OrcDao->lastID()}\', \'Pagina\', \'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=yes, SCROLLBARS=YES, TOP=10, LEFT=10\');\"><b>{$orc->getNOrc()}.{$orc->getAnoOrc()}</b></a>", "tec");
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function atualizarHistoricoOrcAprovado(array $valores, $tabela = "historico_orc_aprovado") {
        // $camposBd = "id_acompanhamento, data, descricao, id_colab, colaborador";
        // var_dump($valores);
        //die;
        $valoresUser = "id_acompanhamento='{$valores[1]}', data='{$valores[2]}', descricao= '{$valores[3]}', id_colab= '{$valores[4]}', colaborador= '{$valores[5]}', mostrar= '{$valores[6]}'";


        if ($this->OrcDao->update($valores[0], $valoresUser, $tabela = "historico_orc_aprovado")) {

            $orc = $this->buscarOrcamentoPorId("*", "WHERE id = '$valores[1]' ");
            LogCtrl::inserirLog($valores[4], "Atualizado <b>Historico</b> no orcamento <b>aprovado</b> <b>{$orc->getNOrc()}.{$orc->getAnoOrc()}</b>", "tec");
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function listaAtividades() {
        return $this->OrcDao->selectAtividades();
    }

    public function listarClassificacao() {
        return $this->OrcDao->selectClassificacao();
    }

    public function listarUnidades() {
        return $this->OrcDao->selectUnidade();
    }

    public function satisfacaoOrc($id_orc, $id_cliente) {
        $pesquisaCtrl = new PesquisaPosVendaCtrl();
        return $pesquisaCtrl->percentagemSatisfacao($id_orc, $id_cliente);
    }

    //////PRIVATES ////////////////////

    private function numeroDoOrc($ano_orc) {

        $consulta_ORC = $this->OrcDao->select("n_orc", "WHERE ano_orc = $ano_orc", "orcamentos");
        //var_dump($consulta_ORC);

        if ($consulta_ORC == false || $consulta_ORC == null) {
            $numero_ORC = "1";
        } else {
            //$quant_orc = count($consulta_ORC);
            //$numero_ORC = $quant_orc + 1;
            $ultimaPos = end($consulta_ORC);
            $numero_ORC = $ultimaPos['n_orc'] + 1;
        }

        $this->result = $numero_ORC;
    }

    private function verificaSeNovoCliente($razao_social_contr) {
        //echo $razao_social_contr;
        $razaobd = $this->OrcDao->select("razao_social_contr", "WHERE razao_social_contr = '$razao_social_contr'", "orcamentos");
        //var_dump($razaobd);
        // echo $razaobd[0]['razao_social_contr'];
        if (!$razaobd[0]['razao_social_contr'] == null) {
            $this->result = 'n';
        } else {
            $this->result = 's';
        }
    }

    private function logAtualizarOrcAprovado(Orcamento $objOrc) {
        if ($objOrc->getSituacaoOrc() == "concluido" && $objOrc->getServConcluido() == 's') {
            LogCtrl::inserirLog($objOrc->getColabUltimaAlteracao(), "Orcamento <b>{$objOrc->getNOrc()}.{$objOrc->getAnoOrc()}</b> marcado como <b>concluido</b>", "tec");
        }

        if ($objOrc->getSituacaoOrc() == "Aprovado" && $objOrc->getServConcluido() == 'n' && $objOrc->getDataInicio() != "0000-00-00") {
            $dataInicio = Formatar::formatarDataSemHora($objOrc->getDataInicio());
            LogCtrl::inserirLog($objOrc->getColabUltimaAlteracao(), "Orcamento <b>{$objOrc->getNOrc()}.{$objOrc->getAnoOrc()}</b> marcado com <b>data de inicio {$dataInicio}</b>", "tec");
        }


    }

}
