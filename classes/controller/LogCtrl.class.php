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
     * Fazer o INSERT no BD na tabela = <b>logs</b>
     * @param int $id_colab = ID do colaborador Atuante
     * @param string $atividade = Texto da mensagem da Atividade do LOG
     * @param string $setor = setor ex.: tec, fin, com, rh, adm etc.
     * @return boolean = TRUE para sucesso ao Salvar e FALSE para erro ao salvar
     */
    public static function inserirLog($id_colab, $atividade, $setor) {
        $log = new Log(NULL, date('Y-m-d H:i:s'), $id_colab, $atividade, $setor, NULL, filter_input(INPUT_SERVER, 'REMOTE_ADDR'));
        $logCtrl = new LogCtrl();
        if($logCtrl->inserirBD($log)){
            return TRUE;
        }else{
            return FALSE;
        }
    }



    /**
     * Fazer INSERT no BD na tabela = logs
     * @param Log $obj = passar uma Instancia deste tipo para inserir no BD
     * @return boolean = TRUE se Sucesso ao inserir dados no BD e FALSE se houver algum problema na INSERÇÃO ou se o OBJETO não foi passado corretamente
     */
    private function inserirBD(Log $obj) {
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

                //$logDao = new LogDAO();
            
            if ($this->logDao->insert($campoArr, $valores)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

}
