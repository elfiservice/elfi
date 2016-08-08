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

    public function mediaSatisfacao($id_cliente) {
        $pesquisaCtrl = new PesquisaPosVendaCtrl();
        return $pesquisaCtrl->mediaSatisfacao($id_cliente);
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
