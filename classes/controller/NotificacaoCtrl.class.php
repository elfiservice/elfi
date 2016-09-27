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

    /**
     * Fazer SELECT no BD na tabela = notificacoes
     * @param string $campos = Campos do BD a serem pesquisados
     * @param string $termos = Termos para Filtrar a Busca no BD (WHERE, etc)
     * @return Array de Objetos do tipo --><b>Notificacao</b><-- se encontrar resultados, se não retorna NULL
     */
    public function buscarBD($campos, $termos) {
        $select = $this->NotificacaoDao->select($campos, $termos);
        if (!empty($select)) {

            return $this->montarObjeto($select);
        } else {
            return NULL;
        }
    }

    /**
     * Fazer INSERT no BD na tabela = notificação
     * @param Notificacao $obj = passar uma Instancia deste tipo para inserir no BD
     * @return boolean = TRUE se Sucesso ao inserir dados no BD e FALSE se houver algum problema na INSERÇÃO ou se o OBJETO não foi passado corretamente
     */
    public function inserirBD(Notificacao $obj) {
        if ($obj instanceof Notificacao) {
            foreach ((array) $obj as $campo => $valor) {
                $campo = str_replace("\0Notificacao\0", "", $campo);
                $campoArr[$campo] = $campo;
            }

            unset($campoArr['id']);
            $arrObj = array_values((array) $obj);
            unset($arrObj[0]);

            $campoArr = implode(', ', array_keys($campoArr));
            $valores = " '" . implode("','", array_values($arrObj)) . "' ";

            if ($this->NotificacaoDao->insert($campoArr, $valores)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    /**
     * Fazer UPDATE no BD na tabela = notificacao
     * @param Notificacao $obj =  passar uma Instancia deste tipo para inserir no BD
     * @return boolean = TRUE se Sucesso ao ATUALIZAR dados no BD e FALSE se houver algum problema na ATUALIZAÇÃO ou se o OBJETO não foi passado DO TIPO CORRETO
     */
    public function atualizarBD(Notificacao $obj) {
        if ($obj instanceof Notificacao) {
            $id = $obj->getId();
            $idColab = $obj->getId_colab();

            foreach ((array) $obj as $campo => $valor) {
                if (!$valor == NULL || !$valor == "" || $valor == "0") {
                    $campo = str_replace("\0Notificacao\0", "", $campo);
                    $camposDados[] = $campo . " = '" . $valor . "'";
                }
            }

            unset($camposDados[0]);
            unset($camposDados[2]);

            $camposDados = implode(', ', $camposDados);

            if ($this->NotificacaoDao->update($camposDados, "WHERE id = '$id' AND id_colab = '$idColab'")) {

                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function notificar($id_colab_logado, $setor) {
        $dataUltimaVisualizacao = $this->getUltimaDataNotif($id_colab_logado);

        $logCtrl = new LogCtrl();
        $logs = $logCtrl->buscarBD("*", "WHERE ( id_colab != '$id_colab_logado' ) AND (setor LIKE '%ad%' OR setor LIKE '%" . $setor . "%') AND (data > '$dataUltimaVisualizacao') ");
     
        $countNotf = 0;
        if (!empty($logs)) {
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
        }
        return $countNotf;
    }

    public function visualizarNotif($id_colab_logado, $setor) {

        $dataUltimaVisualizacao = $this->getUltimaDataNotif($id_colab_logado);

        $logCtrl = new LogCtrl();
        $logs = $logCtrl->buscarBD("*", "WHERE ( id_colab != '$id_colab_logado' ) AND (setor LIKE '%ad%' OR setor LIKE '%" . $setor . "%') AND (data > '$dataUltimaVisualizacao')  ORDER BY data DESC ");

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

            $this->setDataAtual($id_colab_logado); //joga a Data de Hj no BD tabela notificacoes  
        } else {
            return FALSE;
        }
    }

    public function setDataAtual($id_colab_logado) {
        $result = $this->NotificacaoDao->select("*", "WHERE id_colab = '$id_colab_logado'");
        if (!empty($result)) {
            extract($result[0]);
            $notifObj = new Notificacao($id, date('Y-m-d H:i:s'), $id_colab);
            $this->atualizarBD($notifObj);
        } else {
            $notifObj = new Notificacao("", date('Y-m-d H:i:s'), $id_colab_logado);
            $this->inserirBD($notifObj);
        }
    }

    //--------------------------------------------------
    //----------------PRIVATES---------------------
    //--------------------------------------------------
    private function montarObjeto($arrayDados) {
        $arrayObjColab = array();
        foreach ($arrayDados as $dado) {
            extract($dado);
            $arrayObjColab[] = new Notificacao($id, $data_ult_visualizacao, $id_colab);
        }

        return $arrayObjColab;
    }

    private function atualizarLog(Log $log) {
        $logCtrl = new LogCtrl();
        $logCtrl->atualizarBD($log);
    }

    private function getUltimaDataNotif($id_colab_logado) {
        $result = $this->buscarBD("*", "WHERE id_colab = '$id_colab_logado'");
        if (!empty($result)) {
            return $result[0]->getData_ult_visualizacao();
        } else {
            return "0000-00-00 00:00:00";
        }
    }

}
