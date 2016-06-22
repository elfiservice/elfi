<?php
include "./../../checkuserlog.php";
require './../../classes/Config.inc.php';
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
        <link rel="stylesheet" href="../../estilos.css">
    </head>
    <body>
        <div  style="background: url(../../imagens/topo1.png) repeat-x;  padding:5px 0px 30px 0px;"></div>
        <!--<a href="javascript:window.history.go(-1)" target="_self">Voltar</a>-->
        <div>
            <h2><a href="javascript:window.history.go(-1)">Histórico Orçamento não Aprovado</a> -> Editar</h2>
        </div>

        <?php
        if (!isset($_SESSION['idx'])) { //testa se a sess�o existe
            if (!isset($_COOKIE['idCookie'])) {

                echo "Você não esta logado!";
            }
        } else {

            $ano_atual = date('Y');

            $id_historico = filter_input(INPUT_GET, 'id_historico', FILTER_VALIDATE_INT);

            if (!$id_historico) {
                WSErro("Erro na URL!", WS_ALERT);
                die();
            }

            $histoNACtrl = new HistoricoOrcNaoAprovadoCtrl();

            $selectHistorico = $histoNACtrl->buscarBD("*", "WHERE id = '$id_historico' ORDER BY id DESC");
          
            if ($selectHistorico) {
                foreach ($selectHistorico as $obj) {
                    ?>

                    <hr>


                    <fieldset>
                        <legend><b>Dados</b></legend>
                        <form action="salvar/historico_editado.php" method="post" enctype="multipart/form-data" name="formEditarOrcNAprovado">
                            <table>
                                <tr>
                                    <td>Data do contato:</td>
                                    <td><b><?= Formatar::formatarDataComHora($obj->getDia_do_contato())?></b></td>
                                </tr>
                                <tr>
                                    <td>Colaborador ELFI: </td>
                                    <td><input type="text" value="<?= $obj->getColab_elfi() ?>" name="colab_elfi" readonly="readonly" /></td>
                                </tr>
                                <tr>
                                    <td>Contato no Cliente:</td>
                                    <td><input type="text" value="<?= $obj->getContato_cliente() ?>" name="contato_cliente"  /></td>
                                </tr>
                                <tr>
                                    <td>Telefone do Cliente:</td>
                                    <td><input type="text" value="<?=$obj->getTel_cliente()?>" name="tel_cliente"  /></td>
                                </tr>
                                <tr>
                                    <td>Conversado:</td>
                                    <td><textarea  rows="3" cols="50" id="text" name="conversado"><?php echo strip_tags($obj->getConversa()); ?></textarea></td>
                                </tr>
                            </table>			

                            <input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="salvar" value="Salvar" id="salvar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />

                            <input type="hidden" name="id_usuario_BD" value="<?=$obj->getId_colab() ?>"  />
                            <input type="hidden" name="id_orc" value="<?= $obj->getId_orc() ?>" />
                         			
                        </form >
                    </fieldset>

                    <?php
                }
            }
                ?>
            </body>
        </html>



        <?php } ?>
