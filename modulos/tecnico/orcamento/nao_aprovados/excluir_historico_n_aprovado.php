<?php
require '../../../../classes/Config.inc.php';
?>

<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="pt"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="pt"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="pt"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="pt"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Sistema ELFI | Técnico</title>

        <meta name="description" content="">
        <meta name="author" content="Elfi Service">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="../../../../estilos.css">
    </head>
    <body>
        <div  style="background: url(../../../../imagens/topo1.png) repeat-x;  padding:5px 0px 30px 0px;"></div>
        <div>
            <h2><a href="javascript:window.history.go(-1)">Histórico Orçamento não Aprovado</a> -> Excluir</h2>
        </div>

        <?php
        session_start();
        $login = new Login();
        if (!$login->checkLogin()) {
            WSErro("VocÊ não esta Logado!", WS_ALERT);
            die();
        } else {
            $userlogin = $login->getSession();
        }

        $id_historico = filter_input(INPUT_GET, 'id_historico', FILTER_VALIDATE_INT);

        if (!$id_historico) {
            WSErro("Erro na URL!", WS_ALERT);
            die();
        }

        $histoNACtrl = new HistoricoOrcNaoAprovadoCtrl();
        $selectHistorico = $histoNACtrl->buscarBD("*", "WHERE id = '$id_historico' LIMIT 1");
        if ($selectHistorico) { //Verifica se Existe o ID 
            if ($selectHistorico[0]->getId_colab() == $_SESSION['id']) {

                $salvar = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                if (isset($salvar) && $salvar['excluir']) {

                    $selectHistorico[0]->setMostrar('0');


                    if ($histoNACtrl->atualizarBD($selectHistorico[0])) {
                        WSErro("Excluido com sucesso!", WS_ACCEPT);
                        echo"<a class=\"bt_link\" href=\"historico_acompanhamento.php?id_orc={$selectHistorico[0]->getId_orc()}\">Voltar</a>";
                        die();
                    } else {
                        WSErro("Ocorreu um Erro ao tentar excluir !", WS_ERROR);
                        echo"<a class=\"bt_link\" href=\"historico_acompanhamento.php?id_orc={$selectHistorico[0]->getId_orc()}\">Voltar</a>";
                        die();
                    }
                }
            } else {
                WSErro("Ocorreu um Erro: você não tem permissão para isso !", WS_ERROR);
                echo"<a class=\"bt_link\" href=\"historico_acompanhamento.php?id_orc={$selectHistorico[0]->getId_orc()}\">Voltar</a>";
                die();
            }
        } else {
            WSErro("Ocorreu um Erro: historico não encontrado !", WS_ERROR);

            die();
        }



        if ($selectHistorico) {
            foreach ($selectHistorico as $obj) {
                ?>
                <hr>
                <div >
                    <h3> Deseja realmente excluir esse historico?</h3>

                </div>

                <fieldset>
                    <legend><b>Dados</b></legend>
                    <form action="excluir_historico_n_aprovado.php?id_historico=<?= $id_historico ?>" method="post" enctype="multipart/form-data" name="formEditarOrcNAprovado">
                        <table>
                            <tr>
                                <td>Data do contato:</td>
                                <td><b><?= Formatar::formatarDataComHora($obj->getDia_do_contato()) ?></b></td>
                            </tr>
                            <tr>
                                <td>Conversado:</td>
                                <td><textarea  rows="3" cols="50" id="text" name="conversado" readonly="readonly" ><?= strip_tags($obj->getConversa()); ?></textarea></td>
                            </tr>
                        </table>			

                        <input  type="submit" name="excluir" value="Excluir" id="excluir"  />

                        <input type="hidden" name="id_usuario_BD" value="<?= $obj->getId_colab() ?>"  />
                        <input type="hidden" name="id_orc" value="<?= $obj->getId_orc() ?>" />			
                    </form >
                </fieldset>
            </body>
        </html>



        <?php
    }
}
