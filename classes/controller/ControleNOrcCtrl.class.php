<?php

/**
 * ControleNOrcCtrl.class [ Controller ]
 * Responsavel por fazer o Controle entre a View e o BD para tabela controle_n_orc
 * @copyright (c) 2016, Armando JR. ELFISERVICE
 */
class ControleNOrcCtrl {

    /**
     *
     * @var ControleNOrcDAO 
     */
    private $controleNOrcDAO;

    public function __construct() {
        $this->controleNOrcDAO = new ControleNOrcDAO();
    }

    /**
     * Fazer SELECT no BD na tabela = controle_n_orc
     * @param string $campos = Campos do BD a serem pesquisados
     * @param string $termos = Termos para Filtrar a Busca no BD (WHERE, etc)
     * @return Array de Objetos do tipo ControleNOrc se encontrar resultados, são retorna NULL
     */
    public function buscarControleNOrc($campos, $termos) {
        $colabBD = $this->controleNOrcDAO->select($campos, $termos);
        if (!empty($colabBD)) {

            return $this->montarObjeto($colabBD);
        } else {
            return NULL;
        }
    }

    /**
     * Fazer INSERT no BD na tabela = controle_n_orc
     * @param ControleNOrc $controleNOrcObj = passar uma Instancia deste tipo para inserir no BD
     * @return boolean = TRUE se Sucesso ao inserir dados no BD e FALSE se houver algum problema na INSERÇÃO ou se o OBJETO não foi passado corretamente
     */
    public function inserirControleNOrc(ControleNOrc $controleNOrcObj) {
        if ($controleNOrcObj instanceof ControleNOrc) {

            foreach ((array) $controleNOrcObj as $campo => $valor) {
                $campo = str_replace("\0ControleNOrc\0", "", $campo);
                $campoArr[$campo] = $campo;
            }

            $campoArr = implode(', ', array_keys($campoArr));
            $valores = " '" . implode("','", array_values((array) $controleNOrcObj)) . "' ";

            if ($this->controleNOrcDAO->insert($campoArr, $valores)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    /**
     * Fazer UPDATE no BD na tabela = controle_n_orc
     * @param ControleNOrc $controleNOrcObj =  passar uma Instancia deste tipo para inserir no BD
     * @return boolean = TRUE se Sucesso ao ATUALIZAR dados no BD e FALSE se houver algum problema na ATUALIZAÇÃO ou se o OBJETO não foi passado DO TIPO CORRETO
     */
    public function atualizarControleNOrc(ControleNOrc $controleNOrcObj) {
        if ($controleNOrcObj instanceof ControleNOrc) {
            $mes = $controleNOrcObj->getMes();
            $ano = $controleNOrcObj->getAno();

            foreach ((array) $controleNOrcObj as $campo => $valor) {
                if (!$valor == NULL || !$valor == "" || $valor == "0") {
                    $campo = str_replace("\0ControleNOrc\0", "", $campo);
                    $camposDados[] = $campo . ' = ' . $valor;
                }
            }

            $camposDados = implode(', ', $camposDados);

            if ($this->controleNOrcDAO->update($camposDados, "WHERE mes = '$mes' AND ano = '$ano'")) {
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
    private function montarObjeto($colabBD) {
        $arrayObjColab = array();
        foreach ($colabBD as $colabBD0) {
            extract($colabBD0);
            $arrayObjColab[] = new ControleNOrc($id, $mes, $ano, $n_orc_feitos, $produtividade, $pontual_entrega, $pos_entrega, $nao_conforme, $acompanh_proposta, $novos_clientes, $insatisfacao);
        }

        return $arrayObjColab;
    }

}
