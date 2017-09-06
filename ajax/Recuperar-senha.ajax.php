<?php

$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//$setPost = array_map('strip_tags', $getPost);
//$Post = array_map('trim', $setPost);
//var_dump($getPost);

$Action = $getPost['callback_action'];
$jSon = array();

unset($getPost['enviar-senha-temp']);
sleep(1);
if ($Action):
    require '../classes/Config.inc.php';
endif;

switch ($Action) {



    case 'enviar-senha-temp':
        $email = $getPost['email'];
        $usuarioCtrl = new UsuarioCtrl();
        $usuario = $usuarioCtrl->buscarBD("*", "WHERE Login = '" . $email . "'");

        if (!empty($usuario)) {

            $senhaTemporaria = Formatar::geraSenha(6);
            $usuario[0]->setSenha(md5($senhaTemporaria));

            if ($usuarioCtrl->atualizarBD($usuario[0])) {
                $assunto = "Senha Temporaria - Sistema ELFI";
                $textoCorpo = "<p> Segue sua nova senha temporaria:</p> <p> senha: <b>{$senhaTemporaria}</b> </p> <p> Nota: Realizar a troca desta senha em Configuracoes. </p>";
                $enviarEmail = new EmailGenerico(array($email), $assunto, $textoCorpo, array(), array(), 1);
                if ($enviarEmail->enviarEmailSMTP()) {
                    $jSon['result'] = "Sucesso, senha temporaria enviada para seu Email!";
                } else {
                    $jSon['erro'] = "Tivemos problemas ao tentar ENVIAR por Email sua Senha Temporaria, favor tentar novamente ou contacte o Suporte.";
                }
            } else {
                $jSon['erro'] = "Tivemos problemas ao tentar salvar sua Senha Temporaria, favor tentar novamente.";
            }
        } else {
            $jSon['erro'] = "Opa! Nao conseguimos encontrar seu Email.";
        }
        break;

    default :
        $jSon['erro'] = "Erro ao selecionar Ação! Se persistir, favor contactar o Suporte (Administrador).";
}

echo json_encode($jSon);
