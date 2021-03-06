<div>
    <h2><?php include_once 'orcamento/includes/nav_wizard.php'; ?> -><a href="?id_menu=orcamento/aprovados/acompanhar_orcamentos">Aprovados</a> -> <a href="javascript:window.history.go(-1)">Historico</a> -> Excluir</h2>
</div>
<hr>
<?php
//------ CHECK IF THE USER IS LOGGED IN OR NOT AND GIVE APPROPRIATE OUTPUT -------
$login = (!empty($login) ? $login : $login = new Login());
if (!$login->checkLogin()) {
    WSErro("VocÊ não esta Logado!", WS_ALERT);
    die();
} else {
    $userlogin = $login->getSession();
}

$data_hj = date('Y-m-d');
if (filter_has_var(INPUT_POST, 'excluir_editar_historico_orc_apro')) {
    $id_historico = filter_input(INPUT_POST, 'id_historico', FILTER_DEFAULT);
    $id_orc_acomp = filter_input(INPUT_POST, 'id_orc_acomp', FILTER_DEFAULT);
    $descricao_historico = filter_input(INPUT_POST, 'descricao_historico', FILTER_DEFAULT);

    $id_colab = $userlogin->getId();
    $colab = Formatar::prefixEmail($userlogin->getLogin());
    $mostrar = '1'; //1 = a não mostrar no sistema

    $orcamentoCtrl = new OrcamentoCtrl();
    //$valores = array($id_orc, $data, $descricao_historico,  $id_colab, $colab ); //Por na seguencia CERTA da TAbela
    if ($orcamentoCtrl->atualizarHistoricoOrcAprovado(array($id_historico, $id_orc_acomp, $data_hj, nl2br($descricao_historico), $id_colab, $colab, $mostrar))) {
        WSErro("Atualizado com sucesso.", WS_ACCEPT);
    } else {
        WSErro("Ocorreu algum Erro ao tentar atualizar.", WS_ERROR);
    }

    echo"<a class=\"bt_link\" href=\"?id_menu=orcamento/aprovados/hitorico_orc_aprovado&id_orc={$id_orc_acomp}\">Voltar</a>";

    die();
}

$id_historico = filter_input(INPUT_GET, 'id_historico', FILTER_VALIDATE_INT);
if ($id_historico) {
    $orcamentoCtrl = new OrcamentoCtrl();
    $orcHistObj = $orcamentoCtrl->buscarHistoricoOrcamento("*", "WHERE id='$id_historico'", "historico_orc_aprovado");
    //var_dump($orcHistObj);
    if (!$orcHistObj) {

        WSErro("Historico não encontrado!", WS_ALERT);
        die();
    }
} else {
    WSErro("Erro na URL!", WS_ERROR);
    die();
}
?>
<div >
    <h3> <span style="color: red;">Tem certeza que deseja Exluir esse hisrorico? </span></h3>

</div>

<fieldset>
    <legend><b>Dados</b></legend>
    <form action="?id_menu=orcamento/aprovados/excluir_historico_orc_aprovado&id_historico=<?= $id_historico ?>" method="post" enctype="multipart/form-data" name="formAgenda">
        <div>
            Data: 	<b><?= Formatar::formatarDataSemHora($data_hj); ?></b>
        </div>
        <br>

        <div>
            <label>Descrição:</label></br>
            <p><?= strip_tags($orcHistObj[0]['descricao']); ?></p>

            <p>			    
                <input class="bt_vermelho"  type="submit" name="excluir_editar_historico_orc_apro" value="Exluir"  />
                <input type="hidden" value="<?= $data_hj; ?>" name="dia_hoje" hidden="hidden" />
                <input type="hidden" name="usuario" value="<?= $userlogin->getId(); ?>"  />
                <input type="hidden" name="descricao_historico" value="<?= strip_tags($orcHistObj[0]['descricao']); ?>"  />
                <input type="hidden" name="id_orc_acomp" value="<?= $orcHistObj[0]['id_acompanhamento']; ?>" />
                <input type="hidden" name="id_historico" value="<?= $orcHistObj[0]['id']; ?>" />
            </p>
        </div>

    </form>

</fieldset>
</body>
</html>
