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
        $logCtrl = new LogCtrl();
        $logs = $logCtrl->buscarBD("*", "ORDER BY data DESC LIMIT 6");
        $count = 1;
        foreach ($logs as $key => $log) {
            //var_dump($log);
            if ($count % 2 == 0) {
                $class = " class=\"opposite-side\" ";
            } else {
                $class = "  ";
            }
            $count++;
            $userCtrl = new UsuarioCtrl();
            $id_colab = $log->getId_colab();
            $colab = $userCtrl->buscarBD("*", "WHERE id = '$id_colab' ");


            if ($colab == null) {
                $colab = "Sistema";
            } else {
                $colab = Formatar::prefixEmail($colab[0]->getLogin());
            }
            ?>
            <li <?= $class ?>>
                <div class="border-line"></div>
                <div class="timeline-description">
                    <p><?= $log->getAtividade() . ' - por <b>' . $colab . '</b> - <i>' . Formatar::dataTimeLine($log->getData()) . '</i>' ?></p>
                </div>
            </li>

            <?php
        }
        ?>
        <li class="j_insert">       </li>

    </ul>
    <!--    <div class="j_insert"></div>-->
    <div class="centro">
        <a rel="j_list" class="j_load loadmore">Carregar mais</a>
        <img class="form_load" src="../../imagens/load.gif" alt="[CARREGANDO...]" title="CARREGANDO..."/>
    </div>
</div>
<script src="../../js/jquery.js"></script>     
<script src="../../js/timeline.js"></script>    