<?php

/**
 * Notificacao.class [ MODEL ]
 * Modelar Tabela notificacao do BD
 * @copyright (c) 2016, Armando JR. ELFISERVICE
 */
class Notificacao {
    private $id;
    private $data_ult_visualizacao;
    private $id_colab;
    
    public function __construct($id = NULL, $data_ult_visualizacao = NULL, $id_colab = NULL) {
        $this->id = $id;
        $this->data_ult_visualizacao = $data_ult_visualizacao;
        $this->id_colab = $id_colab;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getData_ult_visualizacao() {
        return $this->data_ult_visualizacao;
    }

    public function getId_colab() {
        return $this->id_colab;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setData_ult_visualizacao($data_ult_visualizacao) {
        $this->data_ult_visualizacao = $data_ult_visualizacao;
    }

    public function setId_colab($id_colab) {
        $this->id_colab = $id_colab;
    }



}
