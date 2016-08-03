<?php

/**
 * NotificacaoCtrl.class [ Controler ]
 * Responsavel por fazer o Controle entre a View e o BD para tabela notificacao
 * @copyright (c) 2016, Armando JR. ELFISERVICE
 */
class NotificacaoCtrl {

    private $NotificacaoDao;

    public function __construct() {
        $this->NotificacaoDao = new NotificacaoDAO();
    }

    public function notificar($id_colab_logado, $setor) {
        $logCtrl = new LogCtrl();
        $logs = $logCtrl->buscarBD("*", "WHERE ( id_colab != '$id_colab_logado' ) AND (setor LIKE '%ad%' OR setor LIKE '%".$setor."%') ");

        //var_dump($logs);
        $countNotf = 0;
        foreach ($logs as $key => $campo) {

            $arrIdsColabs = explode(',', $campo->getVisualizado());
            $flag = TRUE;
            foreach ($arrIdsColabs as $key => $id_colab_visual) {

                if ($id_colab_visual == $id_colab_logado) {
                    $flag = FALSE;
                }
            }

            if ($flag == TRUE) {
                $countNotf++;
            }
        }
        
        return $countNotf;
    }

}
