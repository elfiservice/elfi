<?php

$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$ActionBtn = $getPost['callback_action'];
$jSon = array();

$ActionArr = explode("-", $ActionBtn);
$Action = $ActionArr[0];

sleep(1);
if ($Action):
    require '../classes/Config.inc.php';
endif;

switch ($Action) {

    case 'desativar':
        $ativo = 0;
        $userId = $ActionArr[1];
        
        $userCtrl = new UsuarioCtrl();
        if ( $userCtrl->ativarDesativarEmail($userId, $ativo) ) {
            $jSon['ativo'] = 'ativar';
            $jSon['id'] = $userId;
            $jSon['result'] = 'Email desativado com Sucesso!';
        }
     
        break;
    case 'ativar':
        $ativo = 1;
        $userId = $ActionArr[1];
        
        $userCtrl = new UsuarioCtrl();
        if ( $userCtrl->ativarDesativarEmail($userId, $ativo) ) {
            $jSon['ativo'] = 'desativar';
            $jSon['id'] = $userId;
            $jSon['result'] = 'Email ativado com Sucesso!';
        }
        break;

    default :
        $jSon['erro'] = "Erro ao selecionar Ação! Se persistir, favor contactar o Suporte (Administrador).";
}

echo json_encode($jSon);
