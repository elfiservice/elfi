<style>
    *{margin: 0; padding: 0; box-sizing: border-box;}
    .form_load{display: none; vertical-align: middle; margin-left: 15px; margin-top: -2px;}
    .trigger{display: none; padding: 15px; background: #ccc; color: #000; margin-bottom: 20px; font-size: 0.8em; font-weight: bolder}
    .trigger-error{background: #e4b4b4;}
    .trigger-success{background: #b4e4b9;}
    .loadmore{display: inline-block; margin-top: 25px; text-transform: uppercase; font-size: 0.7em; background: #555; color: #fff; padding: 10px; cursor: pointer;}
    .centro{
        text-align: center;
    }
</style>
<div class="j_list"> 
    <ul class="timeline-both-side">

        <?php
        //$id_colab_logado = filter_input(INPUT_GET, 'idc');
        $id_colab_logado = $userlogin->getId_colaborador();
        $setor = filter_input(INPUT_GET, 'setor');

        $notiCtrl = new NotificacaoCtrl();
        $notificacoes = $notiCtrl->visualizarNotif($id_colab_logado, $setor);

        $count = 1;
        foreach ($notificacoes as $key => $log) {
           // echo $log->getId();
            if ($count % 2 == 0) {
                $class = " class=\"opposite-side\" ";
            } else {
                $class = "  ";
            }
            $count++;
            $colabCtrl = new ColaboradorCtrl();
            $id_colab = $log->getId_colab();
            $colab = $colabCtrl->buscarBD("*", "WHERE id_colaborador = '$id_colab' ");
            //var_dump($colab[0]->getLogin());


            if ($colab == null) {
                $colab = "Sistema";
            } else {
                $colab = $colab[0]->getLogin();
            }
            ?>
            <li <?= $class ?>>
                <div class="border-line"></div>
                <div class="timeline-description">
                    <p><?= $log->getAtividade() . ' - por <b>' . $colab . '</b> - <i>' . Formatar::dataTimeLine($log->getData()) . '</i>' ?></p>
                </div>
            </li>

            <?php
            
            $notiCtrl->setarVisualizacao($log, $id_colab_logado);
        }
        ?>
<!--        <li class="j_insert">       </li>-->

    </ul>
    <!--    <div class="j_insert"></div>-->
<!--    <div class="centro">
        <a rel="j_list" class="j_load loadmore">Carregar mais</a>
        <img class="form_load" src="imagens/load.gif" alt="[CARREGANDO...]" title="CARREGANDO..."/>
    </div>-->
</div>
<script src="js/jquery.js"></script>     
<script src="js/timeline.js"></script>    