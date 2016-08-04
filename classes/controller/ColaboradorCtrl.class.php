<?php
/**
 * ColaboradorCtrl.class [ Controller ]
 * Responsavel por fazer o Controle entre a View e o BD para tabela <b>colaboradores</b>
 * @copyright (c) 2016, Armando JR. ELFISERVICE
 */
class ColaboradorCtrl {

    private $ColaboradorDao;

    public function __construct() {
        $this->ColaboradorDao = new ColaboradorDAO();
    }

    /**
     * Fazer SELECT no BD na tabela = <b>colaboradores</b>
     * @param string $campos = Campos do BD a serem pesquisados
     * @param string $termos = Termos para Filtrar a Busca no BD (WHERE, etc)
     * @return Array de Objetos do tipo --><b>Colaborador</b><-- se encontrar resultados, se não retorna NULL
     */
    public function buscarBD($campos, $termos) {
        $select = $this->ColaboradorDao->select($campos, $termos);
        if (!empty($select)) {

            return $this->montarObjeto($select);
        } else {
            return NULL;
        }
    }

    //--------------------------------------------------
    //----------------PRIVATES---------------------
    //--------------------------------------------------
    private function montarObjeto($arrayDados) {
        $arrayObjColab = array();
        foreach ($arrayDados as $dado) {
            extract($dado);
            $arrayObjColab[] = new Colaborador($id_colaborador, $Login, $Senha, $cpf, $tipo, $last_log_date, $Email, $email_activated);
        }

        return $arrayObjColab;
    }

}
