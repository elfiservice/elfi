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

        <?php include_once '../../includes/javascripts/tabela_no_head.php'; ?>

    </head>
    <body>
        <div  style="background: url(../../imagens/topo1.png) repeat-x;  padding:5px 0px 30px 0px;"></div>
        <div>
            <h2><a href="javascript:window.close()">Orçamento</a> -> Histórico Orçamento não Aprovado</h2>
        </div>
        <?php
        if (!isset($_SESSION['idx'])) { //testa se a sessão existe
            if (!isset($_COOKIE['idCookie'])) {
                echo "Você não esta logado!";
            }
        } else {

            $id_orc = filter_input(INPUT_GET, 'id_orc', FILTER_VALIDATE_INT);
            if (!$id_orc) {
                WSErro("Erro na URL!", WS_ALERT);
                die();
            }

            $orcamentoCtrl = new OrcamentoCtrl();
            $histoNACtrl = new HistoricoOrcNaoAprovadoCtrl();
            $orcObj = $orcamentoCtrl->buscarOrcamentoPorId("*", "WHERE id = $id_orc LIMIT 1");
            //var_dump($orcObj);

            $salvar = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (isset($salvar) && $salvar['salvar']) {
                $dia_do_contato = date('Y-m-d H:i:s');
                $colab_elfi = $salvar['colab_elfi'];
                $contato_cliente = $salvar['contato_cliente'];
                $tel_cliente = $salvar['tel_cliente'];
                $conversado = $salvar['conversado'];
                $conversa = nl2br($conversado);
                $id_colab = $_SESSION['id'];
                $id_orc = $salvar['id_orc'];

                $historicoObj = new HistoricoOrcNaoAprovado("", $id_orc, $dia_do_contato, $id_colab, $colab_elfi, $contato_cliente, $tel_cliente, $conversa, 1);

                $orcObj->setDataUltimContatoCliente($dia_do_contato);
                $orcObj->setColabUltimContatoCliente($colab_elfi);

                if ($orcamentoCtrl->atualizarOrcamento($orcObj) && $histoNACtrl->inserirBD($historicoObj)) {
                    $textoCorpo = "A proposta N. <b>{$orcObj->getNOrc()}.{$orcObj->getAnoOrc()}</b>, cliente <b>{$orcObj->getRazaoSocialContrat()}</b>, teve historico atualizado:"
                            . "<p> O colaborador <b>{$colab_elfi}</b> falou com <b>{$contato_cliente}</b> no tel/cel <b>{$tel_cliente}</b> o seguinte: <br> <b>{$conversa}</b> </p>";
                    
                    $emailHistAcomNAprov = new EmailGenerico($listaEmails, "Adicionado Historico Orc Aguardando Aprovação", $textoCorpo, array(), array(), 1);
                    if(!$emailHistAcomNAprov->enviarEmailSMTP()){
                        WSErro("Ocorreu um erro ao tentar enviar o Email!", WS_ERROR);
                    }
                    
                    //LogCtrl::inserirLog($id_colab, $textoCorpo, $_SESSION['tipo_user']);
                    
                    WSErro("Inserido com sucesso!", WS_ACCEPT);
                    echo"<a class=\"bt_link\" href=\"historico_acompanhamento.php?id_orc={$id_orc}\">Voltar</a>";
                    die();
                } else {
                    WSErro("Ocorreu um Erro ao tentar inserir !", WS_ERROR);
                    echo"<a class=\"bt_link\" href=\"historico_acompanhamento.php?id_orc={$id_orc}\">Voltar</a>";
                    die();
                }
            }
            ?>




            <hr>
            <fieldset>
                <legend><b>Dados do Orçamento</b></legend>
                <div>
                    <h3> Acompanhamento Orçamento Nº <?= $orcObj->getNOrc() ?> - Cliente: <?= $orcObj->getRazaoSocialContrat() ?></h3>

                    Nome de contato: <b><?= $orcObj->getContatoCliente() ?></b> 
                    <br>
                    Telefone de contato: <b><?= $orcObj->getTelContrat() ?> - Telefone Obra: <?= $orcObj->getTelObra() ?></b>
                </div>
            </fieldset>	
            <fieldset>
                <legend><b>Dados do Contato de hoje</b></legend>
                <form action="historico_acompanhamento.php?id_orc=<?= $id_orc ?>" method="post" enctype="multipart/form-data" name="formH_acomp_n_aprovados">
                    <table>
                        <tr>
                            <td>Data do contato:</td>
                            <td><b><?php echo date('d/m/Y'); ?></b></td>
                        </tr>
                        <tr>
                            <td>Colaborador ELFI: </td>
                            <td><input type="text" value="<?= $_SESSION['Login'] ?>" name="colab_elfi" readonly="readonly" /></td>
                        </tr>
                        <tr>
                            <td>Nome do contato:</td>
                            <td><input type="text" value="" name="contato_cliente"  /></td>
                        </tr>
                        <tr>
                            <td>Telefone do contato:</td>
                            <td><input type="text" value="" name="tel_cliente"  /></td>
                        </tr>
                        <tr>
                            <td>Conversado:</td>
                            <td><textarea  style="height: 5em; width: 100%;" id="text" name="conversado"></textarea></td>
                        </tr>
                        <tr>
                            <td><input  type="submit" name="salvar" value="Salvar" id="salvar"   />

                                <input type="hidden" name="id_orc" value="<?= $id_orc ?>"  />
                            </td>
                        </tr>
                    </table>
                </form>				
            </fieldset>
            <fieldset>
                <legend><b>Historico de Contato com Cliente</b></legend>
                <TABLE  class="display" id="example2">
                    <thead>
                        <TR>
                            <TH></TH>
                            <TH>Data</TH>
                            <TH>Colaborador ELFI</TH>
                            <TH>Contato Cliente</TH>
                            <TH>Telefone Cliente</TH>
                            <TH>Conversa</TH>
                        </TR>
                    </thead>
                    <tbody>

                        <?php
                        $selectHistorico = $histoNACtrl->buscarBD("*", "WHERE id_orc = '$id_orc' AND mostrar = '1' ORDER BY id DESC");

                        if ($selectHistorico) {
                            foreach ($selectHistorico as $obj) {
                                ?>
                                <TR>
                                    <td><?php
                                                            
                                    if(strpos($obj->getConversa(), '##### Atualização do Orcamento #####') !== false){
                                        echo "Sistema";
                                    }
                                    
                                        if ($obj->getId_colab() == $_SESSION['id'] && strpos($obj->getConversa(), '##### Atualização do Orcamento #####') === false) {
                                            ?>
                                            <a class="bt_link bt_verde" href="editar_historico_n_aprovado.php?id_historico=<?= $obj->getId() ?>" >editar</a>
                                            <br>
                                            <a class="bt_link bt_vermelho" href="excluir_historico_n_aprovado.php?id_historico=<?= $obj->getId() ?>">excluir</a>
                                        <?php } ?>
                                    </td>
                                    <Td><?= Formatar::formatarDataComHora($obj->getDia_do_contato()); ?></Td>
                                    <TD><?= $obj->getColab_elfi() ?></TD>
                                    <TD><?= $obj->getContato_cliente() ?></TD>
                                    <TD><?= $obj->getTel_cliente() ?></TD>
                                    <TD><?= $obj->getConversa() ?></TD>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </TABLE>
            </fieldset>

        </body>
    </html>
    <?php
}?>