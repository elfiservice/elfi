<?php
echo 'aqui';

/**
 * HistoricoClientes.class [ MODEL ]
 * Modelar dados da Tablea historico_clientes
 * @copyright (c) 2018, Armando JR. ELFISERVICE
 */
class HistoricoClientes {
    private $id;
    private $id_cliente;
    private $alteracao;
    private $data;
    
    public function __construct($id, $id_cliente, $alteracao, $data) {
        $this->id = $id;
        $this->id_cliente = $id_cliente;
        $this->alteracao = $alteracao;
        $this->data = $data;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getId_cliente() {
        return $this->id_cliente;
    }

    public function getAlteracao() {
        return $this->alteracao;
    }

    public function getData() {
        return $this->data;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setId_cliente($id_cliente) {
        $this->id_cliente = $id_cliente;
    }

    public function setAlteracao($alteracao) {
        $this->alteracao = $alteracao;
    }

    public function setData($data) {
        $this->data = $data;
    }


    
}
