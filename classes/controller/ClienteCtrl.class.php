<?php

class ClienteCtrl {

    private $clienteDao;
    private $result;

    public function ClienteCtrl() {
        $this->clienteDao = new ClienteDAO();
    }

    public function getResult() {
        return $this->result;
    }

    /**
     * Fazer SELECT no BD na tabela = <b>clientes<b/>
     * @param string $campos = Campos do BD a serem pesquisados
     * @param string $termos = Termos para Filtrar a Busca no BD (WHERE, etc)
     * @return Array de Objetos do tipo --><b>Cliente</b><-- se encontrar resultados, se não retorna NULL
     */
    public function buscarBD($campos, $termos) {
        $select = $this->clienteDao->select($campos, $termos);
        //var_dump($select);
        if (!empty($select)) {

            return $this->montarObjeto($select);
        } else {
            return NULL;
        }
    }

    public function atualizarBD(Cliente $obj) {
        $filha = get_class($obj);
        if ($obj instanceof $filha) {
            $id = $obj->getId();

            foreach ((array) $obj as $campo => $valor) {
                if (!$valor == NULL || !$valor == "" || $valor == "0") {
                    $campo = str_replace("\0Cliente\0", "", $campo);
                    $campo = str_replace("\0{$filha}\0", "", $campo);
                    $camposDados[] = $campo . " = '" . $valor . "'";
                }
            }

            // unset($camposDados[0]);

            $camposDados = implode(', ', $camposDados);

            if ($this->clienteDao->update($camposDados, "WHERE id = '$id' ")) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function mediaSatisfacao($id_cliente) {
        $pesquisaCtrl = new PesquisaPosVendaCtrl();
        return $pesquisaCtrl->mediaSatisfacao($id_cliente);
    }

    public function buscarEstado($campos, $termos) {
        return $this->clienteDao->select($campos, $termos, "estados");
    }

    public function buscarCidade($campos, $termos) {
        return $this->clienteDao->select($campos, $termos, "cidades");
    }

    public function atualizarCliente(Array $dados) {
        $estad = $this->buscarEstado("*", "where cod_estados = '" . $dados['cod_estados'] . "'");
        $estado = $estad[0]['nome'];
        $cidad = $this->buscarCidade("*", "where cod_cidades = '" . $dados['cod_cidades'] . "'");
        $cidade = $cidad[0]['nome'];
        if ($dados["salvar_editar_cliente"]) {
            unset($dados["salvar_editar_cliente"]);
            if (empty($dados['tipo'])) { //se tipo esta embranco é PJ se existe é PF
                $obj = new ClientePJ($dados['id_cliente'], $dados['Login'], $dados['razao_social'], $dados['nome_fantasia'], "padrao", "PJ", "", Formatar::limpaCPF_CNPJ($dados['cnpj']), Formatar::limpaCPF_CNPJ($dados['ie']), $dados['endereco'], $dados['bairro'], $estado, $cidade, $dados['cep'], $dados['phone'], $dados['cel'], $dados['fax'], $dados['email_tec'], $dados['email_admin'], NULL);
                $flag_teste = $this->checkCNPJ($dados);
            } else {
                $obj = new ClientePF($dados['id_cliente'], $dados['Login'], $dados['razao_social'], $dados['nome_fantasia'], "padrao", "PF", "", Formatar::limpaCPF_CNPJ($dados['cpf']), $dados['endereco'], $dados['bairro'], $estado, $cidade, $dados['cep'], $dados['phone'], $dados['cel'], $dados['fax'], $dados['email_tec'], $dados['email_admin'], NULL);
                $flag_teste = $this->checkCPF($dados);
            }
            if ($flag_teste == FALSE && $this->checkRazaoFantasia($dados) == FALSE) {
                if ($this->atualizarBD($obj)) {
                    LogCtrl::inserirLog($dados['id_colab_logado'], "Cliente Cod <b>{$dados['id_cliente']}</b> <b><span>Alterado</span></b> no Sistema", "tec");
                    $this->result = array("<b>OK!</b> Cliente <b>Atualizado</b> com sucesso.", WS_ACCEPT);
                    return TRUE;
                }else{
                    $this->result = array("<b>Erro!</b> Ocorreu um erro interno ao tentar Atualizar o Cliente no sistema.", WS_ERROR);
                    return FALSE;
                }
            } else {
                return FALSE;
            }
        }
    }

    //--------------------------------------------------
    //----------------PRIVATES---------------------
    //--------------------------------------------------
    private function montarObjeto($arrayDados) {
        $arrayObjColab = array();
        foreach ($arrayDados as $dado) {
            extract($dado);
            if ($tipo == "PJ") {
                $arrayObjColab[] = new ClientePJ($id, $usuario, $razao_social, $nome_fantasia, $classificacao, $tipo, $data_inclusao, $cnpj_cpf, $ie, $endereco, $bairro, $estado, $cidade, $cep, $tel, $cel, $fax, $email_tec, $email_adm_fin, $mostrar);
            } else if ($tipo == "PF") {
                $arrayObjColab[] = new ClientePF($id, $usuario, $razao_social, $nome_fantasia, $classificacao, $tipo, $data_inclusao, $cpf, $endereco, $bairro, $estado, $cidade, $cep, $tel, $cel, $fax, $email_tec, $email_adm_fin, $mostrar);
            }
        }

        return $arrayObjColab;
    }

    private function checkCNPJ(Array $dados) {
        $cnpj = $this->buscarBD("*", "WHERE cnpj_cpf = '" . Formatar::limpaCPF_CNPJ($dados['cnpj']) . "' AND mostrar = '1'");
        if (!empty($cnpj)) {
            if (count($cnpj) > 0 && $dados['id_cliente'] <> (int) $cnpj[0]->getId()) {
                $this->result = array("<b>Ops!!</b> CNPJ <b>{$dados['cnpj']}</b> já cadastrado no Sistema.", WS_ERROR);
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    private function checkCPF(Array $dados) {
        $consulta = $this->buscarBD("*", "WHERE cpf = '" . Formatar::limpaCPF_CNPJ($dados['cpf']) . "' AND mostrar = '1'");
        if (!empty($consulta)) {
            if (count($consulta) > 0 && $dados['id_cliente'] <> (int) $consulta[0]->getId()) {
                $this->result = array("<b>Ops!!</b> CPF <b>{$dados['cpf']}</b> já cadastrado no Sistema.", WS_ERROR);
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    private function checkRazaoFantasia(Array $dados) {
        $razao_social = $this->buscarBD("*", "WHERE razao_social = '" . $dados['razao_social'] . "' AND mostrar = '1'");
        $nome_fantasia = $this->buscarBD("*", "WHERE nome_fantasia = '" . $dados['nome_fantasia'] . "' AND mostrar = '1'");

        if (!empty($razao_social)) {
            if (count($razao_social) > 0 && $dados['id_cliente'] <> (int) $razao_social[0]->getId()) {
                $this->result = array("<b>Ops!!</b> Razão Social <b>{$dados['razao_social']}</b> já cadastrado no Sistema.", WS_ERROR);
                return TRUE;
            }
        }

        if (!empty($nome_fantasia)) {
            if (count($nome_fantasia) > 0 && $dados['id_cliente'] <> (int) $nome_fantasia[0]->getId()) {
                $this->result = array("<b>Ops!!</b> Nome Fantasia <b>{$dados['nome_fantasia']}</b> já cadastrado no Sistema.", WS_ERROR);
                return TRUE;
            }
        } else {
            return FALSE;
        }
    }

}
