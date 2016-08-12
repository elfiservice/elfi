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
        $logs = $logCtrl->buscarBD("*", "WHERE ( id_colab != '$id_colab_logado' ) AND (setor LIKE '%ad%' OR setor LIKE '%" . $setor . "%') ");

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

    public function visualizarNotif($id_colab_logado, $setor) {
        $logCtrl = new LogCtrl();
        $logs = $logCtrl->buscarBD("*", "WHERE ( id_colab != '$id_colab_logado' ) AND (setor LIKE '%ad%' OR setor LIKE '%" . $setor . "%')  ORDER BY data DESC ");

        //var_dump($logs);
        $arryLogs = array();
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
                $arryLogs[] = $campo;
                $countNotf++;
            }
        }

        return $arryLogs;
    }

    public function setarVisualizacao(Log $log, $id_colab_logado) {
        if ($log instanceof Log) {
            $arrIdsColabs = explode(',', $log->getVisualizado());
            $flag = TRUE;
            foreach ($arrIdsColabs as $key => $id_colab_visual) {

                if ($id_colab_visual == $id_colab_logado) {
                    $flag = FALSE;
                }
            }

            if ($flag == TRUE) {
                $arrIdsColabs[] = $id_colab_logado;
                $visualizado = implode(',', $arrIdsColabs);
                $log = new Log($log->getId(), "", "", "", "", $visualizado, "", "");
                $this->atualizarLog($log);
            }

                        
        } else {
            return FALSE;
        }
    }
    
    private function atualizarLog(Log $log) {
        $logCtrl = new LogCtrl();
        $logCtrl->atualizarBD($log);
    }

}
