<style>
   *{margin: 0; padding: 0; box-sizing: border-box;}
 /*    .timeline-both-side{
        float: left; 
        width: 96%; 
        margin: 20px 2% 50px; 
        position: relative; 
        box-sizing: border-box;
    }
    .timeline-both-side:before{
        background-color: #ccc; 
        bottom: 0; 
        content: " "; 
        left: 50%; 
        position: absolute; 
        top: 0; 
        width: 1px;
    }
    .timeline-both-side:after{
        border-radius: 50%; 
        bottom: -22px; 
        content: ""; 
        height: 18px; 
        left: 50%; 
        margin-left: -11px; 
        position: absolute; 
        width: 18px; 
        border: 2px solid #ccc;
    }
    .timeline-both-side li {
        position: relative; 
        float: left; 
        width: 100%;
    }
    .timeline-both-side li .border-line{
        background-color: #ccc; 
        font-size: 1.4em; 
        height: 1px; 
        left: 50%; 
        margin-left: -8%; 
        position: absolute; 
        text-align: center; 
        top: 50%; 
        width: 8%; 
        z-index: 100;
    }
    .timeline-both-side li.opposite-side .border-line{
        left: auto; 
        right: 50%; 
        margin-left: 0; 
        margin-right: -8%;
    }
    .timeline-both-side li .border-line:before {
        background-color: #ccc; 
        content: ""; 
        height: 7px; 
        position: absolute; 
        right: -4px; 
        top: -3px; 
        width: 7px;
    }
    .timeline-both-side li.opposite-side .border-line:before{
        left: -4px; 
        right: auto;
    }
    .timeline-both-side li .timeline-description{
        border-radius: 2px; 
        background-color: #f1f1f1; 
        border: 1px solid #ccc; 
        float: left; 
        font-size: 13px; 
        padding: 10px; 
        position: relative; 
        width: 42%;
    }
    .timeline-both-side li.opposite-side .timeline-description{
        float: right;
    }

    .timeline-both-side li{
        list-style: none;
    }*/

</style>

<ul class="timeline-both-side">

    <?php

    $logCtrl = new LogCtrl();
    $logs = $logCtrl->buscarBD("*", "ORDER BY data DESC LIMIT 10");
    $count = 1;
    foreach ($logs as $key => $log) {
        //var_dump($log);
        if ($count % 2 == 0) {
            $class = " class=\"opposite-side\" ";
        } else {
            $class = "  ";
        }
        $count++;
        $colabCtrl = new ColaboradorCtrl();
        $id_colab = $log->getId_colab();
        $colab = $colabCtrl->buscarColaborador("*", "WHERE id_colaborador = '$id_colab' ");
        //var_dump($colab[0]->getLogin());
        ?>
        <li <?= $class ?>>
            <div class="border-line"></div>
            <div class="timeline-description">
                <p><?= $log->getAtividade() . ' - por <b>' . $colab[0]->getLogin() . '</b> - <i>' . Formatar::dataTimeLine($log->getData()) . '</i>' ?></p>
            </div>
        </li>

        <?php
    }
    ?>
</ul>