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
    
        /**
     * Fazer UPDATE no BD na tabela = colaborador
     * @param Colaborador $obj =  passar uma Instancia deste tipo para inserir no BD
     * @return boolean = TRUE se Sucesso ao ATUALIZAR dados no BD e FALSE se houver algum problema na ATUALIZAÇÃO ou se o OBJETO não foi passado DO TIPO CORRETO
     */
    public function atualizarBD(Colaborador $obj) {
        if ($obj instanceof Colaborador) {
            $id = $obj->getId_colaborador();
            
            foreach ((array) $obj as $campo => $valor) {
                if (!$valor == NULL || !$valor == "" || $valor == "0") {
                    $campo = str_replace("\0Colaborador\0", "", $campo);
                    $campo = str_replace("\0Usuario\0", "", $campo);
                    $camposDados[] = $campo . " = '" . $valor . "'";
                }
            }

            unset($camposDados[0]);
            $camposDados = implode(', ', $camposDados);
            
            if ($this->ColaboradorDao->update($camposDados, "WHERE id_colaborador = '$id' ")) {
                
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
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
