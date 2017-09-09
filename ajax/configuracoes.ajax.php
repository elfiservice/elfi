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
        $ativo = 0;
        $userId = $ActionArr[1];
        $dados = ["id" => $userId, "ativo" => $ativo];
        
        $userCtrl = new UsuarioCtrl();
        if ( $userCtrl->ativarDesativarEmail($dados) ) {
            //$jSon['result'] = "";
            $jSon['result'] = 'ok id-> ' . $userId;
        }

        
        break;

    default :
        $jSon['erro'] = "Erro ao selecionar Ação! Se persistir, favor contactar o Suporte (Administrador).";
}

echo json_encode($jSon);
