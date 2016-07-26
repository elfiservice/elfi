<?php

/**
 * LogCtrl.class [ Controller ]
 * Responsavel por fazer o Controle entre a View e o BD para tabela logs
 * @copyright (c) 2016, Armando JR. ELFISERVICE
 */
class LogCtrl {

    private $logDao;

    public function __construct() {
        $this->logDao = new LogDAO();
    }

    /**
     * Fazer INSERT no BD na tabela = logs
     * @param Log $obj = passar uma Instancia deste tipo para inserir no BD
     * @return boolean = TRUE se Sucesso ao inserir dados no BD e FALSE se houver algum problema na INSERÇÃO ou se o OBJETO não foi passado corretamente
     */
    public static function inserirBD(Log $obj) {
        if ($obj instanceof Log) {

            foreach ((array) $obj as $campo => $valor) {
                $campo = str_replace("\0Log\0", "", $campo);
                $campoArr[$campo] = $campo;
            }

            unset($campoArr['id']);
            $arrObj = array_values((array) $obj);
            unset($arrObj[0]);

            $campoArr = implode(', ', array_keys($campoArr));
            $valores = " '" . implode("','", array_values($arrObj)) . "' ";

                $logDao = new LogDAO();
            
            if ($logDao->insert($campoArr, $valores)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

}
