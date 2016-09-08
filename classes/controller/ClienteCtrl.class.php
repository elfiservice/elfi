<?php

class ClienteCtrl {

    private $clienteDao;

    public function ClienteCtrl() {
        $this->clienteDao = new ClienteDAO();
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
            } else {
                $obj = new ClientePF($dados['id_cliente'], $dados['Login'], $dados['razao_social'], $dados['nome_fantasia'], "padrao", "PF", "", Formatar::limpaCPF_CNPJ($dados['cpf']), $dados['endereco'], $dados['bairro'], $estado, $cidade, $dados['cep'], $dados['phone'], $dados['cel'], $dados['fax'], $dados['email_tec'], $dados['email_admin'], NULL);
            }

            if ($this->atualizarBD($obj)) {
                LogCtrl::inserirLog($dados['id_colab_logado'], "Cliente Cod <b>{$dados['id_cliente']}</b> <b><span>Alterado</span></b> no Sistema", "tec");
                return TRUE;
                
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

}
