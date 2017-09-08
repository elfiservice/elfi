<?php

$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//$setPost = array_map('strip_tags', $getPost);
//$Post = array_map('trim', $setPost);
//var_dump($getPost);

$ActionBtn = $getPost['callback_action'];
$jSon = array();

$ActionArr = explode("-", $ActionBtn);
$Action = $ActionArr[0];

//unset($getPost['enviar-senha-temp']);
sleep(1);
if ($Action):
    require '../classes/Config.inc.php';
endif;

switch ($Action) {



    case 'desativar':
            $jSon['result'] = 'ok id-> ' . $ActionArr[1];
        break;

    default :
        $jSon['erro'] = "Erro ao selecionar Ação! Se persistir, favor contactar o Suporte (Administrador).";
}

echo json_encode($jSon);
