<?php

// include '../classes/dao/ClienteDAO.class.php';
// include '../classes/model/Cliente_PF.class.php';
// include '../classes/model/Cliente_PJ.class.php';
class ClienteCtrl {

    private $clienteDao;

    public function ClienteCtrl() {
        $this->clienteDao = new ClienteDAO();
    }

    public function buscarClientePorRazaoSocial($razao_social) {
        $linha_cliente = $this->clienteDao->buscarClientePorRazaoSocial($razao_social);
        if ($linha_cliente <> "" || $linha_cliente <> null) {
            if ($linha_cliente->tipo == "PJ") {
                $clientePJ = new ClientePJ($linha_cliente->id, $linha_cliente->usuario, $linha_cliente->razao_social, $linha_cliente->nome_fantasia, $linha_cliente->classificacao, $linha_cliente->tipo, $linha_cliente->data_inclusao, $linha_cliente->cnpj_cpf, $linha_cliente->ie, $linha_cliente->endereco, $linha_cliente->bairro, $linha_cliente->estado, $linha_cliente->cidade, $linha_cliente->cep, $linha_cliente->tel, $linha_cliente->cel, $linha_cliente->fax, $linha_cliente->email_tec, $linha_cliente->email_adm_fin);
                return $clientePJ;
            } else if ($linha_cliente->tipo == "PF") {
                $clientePF = new ClientePF($linha_cliente->id, $linha_cliente->usuario, $linha_cliente->razao_social, $linha_cliente->nome_fantasia, $linha_cliente->classificacao, $linha_cliente->tipo, $linha_cliente->data_inclusao, $linha_cliente->cpf, $linha_cliente->endereco, $linha_cliente->bairro, $linha_cliente->estado, $linha_cliente->cidade, $linha_cliente->cep, $linha_cliente->tel, $linha_cliente->cel, $linha_cliente->email_tec);
                return $clientePF;
            }
        }
        return null;
    }

    public function selecionarCliente($id, $tipo) {

        $linha_cliente = $this->clienteDao->buscarCliente($id, $tipo);
        if ($linha_cliente <> "") {
            if ($linha_cliente->tipo == "PJ") {
                $clientePJ = new ClientePJ($linha_cliente->id, $linha_cliente->usuario, $linha_cliente->razao_social, $linha_cliente->nome_fantasia, $linha_cliente->classificacao, $linha_cliente->tipo, $linha_cliente->data_inclusao, $linha_cliente->cnpj_cpf, $linha_cliente->ie, $linha_cliente->endereco, $linha_cliente->bairro, $linha_cliente->estado, $linha_cliente->cidade, $linha_cliente->cep, $linha_cliente->tel, $linha_cliente->cel, $linha_cliente->fax, $linha_cliente->email_tec, $linha_cliente->email_adm_fin);
                return $clientePJ;
            } else if ($linha_cliente->tipo == "PF") {
                $clientePF = new ClientePF($linha_cliente->id, $linha_cliente->usuario, $linha_cliente->razao_social, $linha_cliente->nome_fantasia, $linha_cliente->classificacao, $linha_cliente->tipo, $linha_cliente->data_inclusao, $linha_cliente->cpf, $linha_cliente->endereco, $linha_cliente->bairro, $linha_cliente->estado, $linha_cliente->cidade, $linha_cliente->cep, $linha_cliente->tel, $linha_cliente->cel, $linha_cliente->email_tec);
                return $clientePF;
            }
        }
        return null;
    }

    /**
     * Buscar Lista de Clientes 
     * @param string $campos
     * @param string $termos
     * @return ARRAY de Clientes
     */
    public function buscarCliente($campo, $termos) {
        return $this->clienteDao->select($campo, $termos);
    }

    /**
     * BUSCA CLIENTE POR ID
     * @param string $campo
     * @param string $termos = sempre por pelo ID
     * @return Objeto Cliente Único
     */
    public function buscar($campo, $termos) {
        $clienteBD = $this->clienteDao->select($campo, $termos);
        $clienteBD = $clienteBD[0];
        $clienteMontado = $this->montarCliente($clienteBD);
        if ($clienteMontado) {

            return $clienteMontado;
        } else {
            return null;
        }
    }

    public function mediaSatisfacao($id_cliente) {
        $pesquisaCtrl = new PesquisaPosVendaCtrl();
        return $pesquisaCtrl->mediaSatisfacao($id_cliente);
        

    }

    private function montarCliente($clienteBD) {

        if ($clienteBD <> "" || $clienteBD <> null) {

            if ($clienteBD['tipo'] == "PJ") {
                // var_dump($clienteBD);
                $clientePJ = new ClientePJ($clienteBD['id'], $clienteBD['usuario'], $clienteBD['razao_social'], $clienteBD['nome_fantasia'], $clienteBD['classificacao'], $clienteBD['tipo'], $clienteBD['data_inclusao'], $clienteBD['cnpj_cpf'], $clienteBD['ie'], $clienteBD['endereco'], $clienteBD['bairro'], $clienteBD['estado'], $clienteBD['cidade'], $clienteBD['cep'], $clienteBD['tel'], $clienteBD['cel'], $clienteBD['fax'], $clienteBD['email_tec'], $clienteBD['email_adm_fin']);
                return $clientePJ;
            } else if ($clienteBD['tipo'] == "PF") {
                $clientePF = new ClientePF($clienteBD['id'], $clienteBD['usuario'], $clienteBD['razao_social'], $clienteBD['nome_fantasia'], $clienteBD['classificacao'], $clienteBD['tipo'], $clienteBD['data_inclusao'], $clienteBD['cpf'], $clienteBD['endereco'], $clienteBD['bairro'], $clienteBD['estado'], $clienteBD['cidade'], $clienteBD['cep'], $clienteBD['tel'], $clienteBD['cel'], $clienteBD['email_tec']);
                return $clientePF;
            }
        }
        return null;
    }

}
