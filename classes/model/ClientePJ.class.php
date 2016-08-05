<?php
/**
 * ClientePJ [ MODEL ]
 * Modelar a entidade de <b>CLIENTES's Pessoa Juridica</b>, TABELA <b>clientes</b>
 * @copyright (c) 2016, Armando JR. ELFISERVICE
 */

class ClientePJ extends Cliente {

    private $cnpj_cpf;
    private $ie;


    public function __construct($id = NULL, $usuario = NULL, $razao_social = NULL, $nome_fantasia = NULL, $classificacao = NULL, $tipo = NULL, $data_inclusao = NULL, $cnpj_cpf = NULL, $ie = NULL, $endereco = NULL, $bairro = NULL, $estado = NULL, $cidade = NULL, $cep = NULL, $tel = NULL, $cel = NULL, $fax = NULL, $email_tec = NULL, $email_adm_fin = NULL, $mostrar = NULL) {
        $this->setId($id);
        $this->setUsuario($usuario);
        $this->setRazaoSocial($razao_social);
        $this->setNomeFantasia($nome_fantasia);
        $this->setClassificacao($classificacao);
        $this->setTipo($tipo);
        $this->setDataAdd($data_inclusao);
        $this->cnpj_cpf = $cnpj_cpf;
        $this->ie = $ie;
        $this->setEndereco($endereco);
        $this->setBairro($bairro);
        $this->setEstado($estado);
        $this->setCidade($cidade);
        $this->setCep($cep);
        $this->setTel($tel);
        $this->setCel($cel);
        $this->setFax($fax);
        $this->setEmailTec($email_tec);
        $this->setEmail_adm_fin($email_adm_fin);
        $this->setMostrar($mostrar);
    }

    public function getCnpj() {
        return $this->cnpj_cpf;
    }

    public function setCnpj($cnpj_cpf) {
        $this->cnpj_cpf = $cnpj_cpf;
    }

    public function getIe() {
        return $this->ie;
    }

    public function setIe($ie) {
        $this->ie = $ie;
    }


}
