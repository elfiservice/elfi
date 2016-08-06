<?php

// include '../classes/dao/ClienteDAO.class.php';
// include '../classes/model/Cliente_PF.class.php';
// include '../classes/model/Cliente_PJ.class.php';
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

    /**
     * Buscar Lista de Clientes 
     * @param string $campos
     * @param string $termos
     * @return ARRAY de Clientes
     */
//    public function buscarCliente($campo, $termos) {
//        return $this->clienteDao->select($campo, $termos);
//    }

    /**
     * BUSCA CLIENTE POR ID
     * @param string $campo
     * @param string $termos = sempre por pelo ID
     * @return Objeto Cliente Único
     */
//    public function buscar($campo, $termos) {
//        $clienteBD = $this->clienteDao->select($campo, $termos);
//        $clienteBD = $clienteBD[0];
//        $clienteMontado = $this->montarCliente($clienteBD);
//        if ($clienteMontado) {
//
//            return $clienteMontado;
//        } else {
//            return null;
//        }
//    }
}
