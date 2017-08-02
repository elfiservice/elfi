<?php
require '../classes/Config.inc.php';
session_start();
$login = new Login();

?>
<!doctype html>
<html class="no-js" lang="pt"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Sistema ELFI | Perfil Usuario</title>

        <meta name="description" content="">
        <meta name="author" content="Elfi Service">

        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="../estilos.css">

        <?php include_once '../includes/javascripts/tabela_no_head.php'; ?>

    </head>
    <body>
        <div  style="background: url(../imagens/topo1.png) repeat-x;  padding:5px 0px 30px 0px;"></div>
        <div>            <h2>Colaborador</h2>        </div>
        <hr>
        <?php
        if (!$login->checkLogin()) {
            WSErro("Você não esta conectado!", WS_ALERT);
            die;
        } else {
            $userlogin = $login->getSession();
        }


        $id_user = filter_input(INPUT_GET, 'id_user', FILTER_VALIDATE_INT);
        if (!$id_user) {

            WSErro("Erro na URL!", WS_ERROR);
            die();
        }

        $orc_ctrl = new OrcamentoCtrl();
        $histOrcNACtrl = new HistoricoOrcNaoAprovadoCtrl();

        $colabCtrl = new UsuarioCtrl();
        $user = $colabCtrl->buscarBD("*", "WHERE id = '$id_user' ");


        if ($user) {
            foreach ($user as $usuario) {
                ?>

                <fieldset>
                    <legend><b>Dados do Usuario: <?= Formatar::prefixEmail($usuario->getLogin()); ?></b></legend>
                    <table>
                        <tr>
                            <td>Email:</td>
                            <td><?php echo $usuario->getLogin(); ?></td>
                        </tr>
                        <tr>
                            <td>CPF:</td>
                            <td><?php
                                if ($_SESSION['id'] == $id_user) {
                                    //ToDo: pegar dos Dados do Colaborador
                                    //echo $usuario->getCpf();
                                }
                                ?></td>
                        </tr>
                        <tr>
                            <td>Ultimo Log:</td>
                            <td><?php echo date('d/m/Y \á\s H:m', strtotime($usuario->getLast_log_date())); ?></td>
                        </tr>
                        <tr>
                            <td>Nº de Orçamentos feitos:</td>
                            <td><?php echo count($orc_ctrl->buscarOrcamentos("*", "WHERE id_colab = '" . $usuario->getId() . "'")); ?></td>
                        </tr>
                        <tr>
                            <td>Nº de Orçamentos que esta acompanhando:</td>
                            <td><?php echo count($orc_ctrl->buscarOrcamentos("*", "WHERE colab_ultimo_contato_client = '" . $usuario->getLogin() . "'")); ?></td>
                        </tr>
                        <tr>
                            <td>Nº de Hitoricos em Orçamentos Não Aprovados:</td>
                            <td><?php echo count($histOrcNACtrl->buscarBD("*", "WHERE id_colab = '" . $usuario->getId_colaborador() . "'")); ?></td>
                        </tr>
                        <tr>
                            <td>Nº de Historicos em Orçamentos Aprovados:</td>
                            <td><?php echo count($orc_ctrl->buscarHistoricoOrcamento("*", "WHERE id_colab = '" . $usuario->getId_colaborador() . "'", "historico_orc_aprovado")); ?></td>
                        </tr>

                    </table>




                </fieldset>
            </body>
        </html>



        <?php
    }
} else {
    echo "Usuario não encontrado.";
}

