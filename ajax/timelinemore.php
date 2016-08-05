<?php

$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$setPost = array_map('strip_tags', $getPost);
$Post = array_map('trim', $setPost);

$Action = $Post['action'];
$jSon = array();
//$jSon = array('result' => '<i >ola</i>');
unset($Post['action']);
sleep(1);
//echo json_encode($jSon);
//die;

if ($Action):
    require '../classes/Config.inc.php';
//    $Read = new Read;
//    $Create = new Create;
//    $Update = new Update;
//    $Delete = new Delete;
endif;

switch ($Action) {



    case 'loadmore':
        $jSon['result'] = null;
        $logCtrl = new LogCtrl();
        $logs = $logCtrl->buscarBD("*", "ORDER BY data DESC LIMIT 4 OFFSET {$Post['offset']} ");
        $count = 1;
        if (!empty($logs)) {
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
                $colab = $colabCtrl->buscarBD("*", "WHERE id_colaborador = '$id_colab' ");
                //var_dump($colab[0]->getLogin());


                if ($colab == null) {
                    $colab = "Sistema";
                } else {
                    $colab = $colab[0]->getLogin();
                }
                $data = Formatar::dataTimeLine($log->getData());

                $jSon['result'] .= "<li {$class} style=\"display: none;\"><div class=\"border-line\"></div>"
                        . "<div class=\"timeline-description\"> "
                        . "<p>{$log->getAtividade()} - por <b>{$colab}</b> - <i>{$data}</i> </p>"
                        . "    </div>"
                        . "</li>";
            }
        } else {
            $jSon['result'] = "<li style=\"display: none;\"><div class=\"border-line trigger-error\"></div>"
                    . "<div class=\"timeline-description\"> "
                    . "<p><i>não há mais resultados</i> </p>"
                    . "    </div>"
                    . "</li>";

            $jSon['final'] = FALSE;
//            $jSon['result'] = "<div style='margin: 15px 0 0 0;' class='trigger trigger-error'>Não existem Mais Resultados!</div>";
        }
//
//
//
//        $Read->exeRead('ws_users', "ORDER BY user_id DESC LIMIT :limit OFFSET :offset", "limit=2&offset={$Post['offset']}");
//        if ($Read->getResult()):
//            foreach ($Read->getResult() as $Users):
//                extract($Users);
//                $jSon['result'] .= "<article style='display:none' class='user_box' id='{$user_id}'><h1>{$user_name} {$user_lastname}</h1><p>{$user_email} (Nível {$user_level})</p><a class='action edit j_edit' rel='{$user_id}'>Editar</a><a class='action del j_delete' rel='{$user_id}'>Deletar</a></article>";
//            endforeach;
//        else:
//            $jSon['result'] = "<div style='margin: 15px 0 0 0;' class='trigger trigger-error'>Não existem Mais Resultados!</div>";
//        endif;
        break;



    default :
        $jSon['result'] = "Erro ao selecionar Ação";
}

echo json_encode($jSon);
