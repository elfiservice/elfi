
<div>
    <h2><a href="tecnico.php?id_menu=orcamento">Orcamentos</a> -> Editar -> Salvando</h2>
</div>
<hr>
<?php
if (filter_has_var(INPUT_POST, "razao_social")) {

    $cnpj_contrato = Formatar::limpaCPF_CNPJ($_POST['cnpj']);

    if (filter_has_var(INPUT_POST, "razao_social2")) {

        $razao_social_obra = $_POST['razao_social2'];
        $cnpj_obra = $_POST['cnpj2'];
        $endereco_obra = $_POST['endereco2'];
        $bairro_obra = $_POST['bairro2'];
        $cidade_obra = $_POST['city2'];
        $cep_obra = $_POST['cep2'];
        $estado_obra = $_POST['estado2'];
        $tel_obra = $_POST['tel2'];
        $cel_obra = $_POST['cel2'];
        $email_orc_obra = $_POST['email_orc2'];
    } else {
        $razao_social_obra = "";
        $cnpj_obra = "";
        $endereco_obra = "";
        $bairro_obra = "";
        $cidade_obra = "";
        $cep_obra = "";
        $estado_obra = "";
        $tel_obra = "";
        $cel_obra = "";
        $email_orc_obra = "";
    }

    $id_colab = $_SESSION['id'];
    $id_cliente = filter_input(INPUT_POST, 'id_cliente');
    //dados Descrição do Orçamento
    $descricao_servicos = $_POST['descricao_servicos'];
    $descricao_servicos = nl2br($descricao_servicos);

    //dados Observações
    $observacoes_servico = nl2br($_POST['observacoes_servico']);

    $total_orc = $_POST['totalSum'];

    $valor_do_servico = Formatar::moedaBD($_POST['sum_vr_servico_orc']);
    $valo_do_material = Formatar::moedaBD($_POST['sum_vr_material_orc']);

    $data_ultima_alteracao = date('Y-m-d H:i:s');

    $orcamentoObj = new Orcamento(
            $_POST['id_orc_editado'], $id_cliente, $id_colab, "", "", $_SESSION['Login'], "", $_POST['razao_social'], $cnpj_contrato, $_POST['endereco'], $_POST['bairro'], $_POST['city'], $_POST['estado'], $_POST['cep'], $_POST['tel'], $_POST['cel'], $_POST['email_orc'], $_POST['contato_clint'], $razao_social_obra, $cnpj_obra, $endereco_obra, $bairro_obra, $cidade_obra, $estado_obra, $cep_obra, $tel_obra, $cel_obra, $email_orc_obra, $_POST['atividade1'], $_POST['classificacao1'], $_POST['quantidade1'], $_POST['unidade1'], $descricao_servicos, $_POST['execucao_orc'], $_POST['validade_orc'], $_POST['pagamento_orc'], $observacoes_servico, $_POST['duvida_orc'], $valor_do_servico, $valo_do_material, "", $total_orc, "", "", $data_ultima_alteracao, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "");

    $orcSaveCtrl = new OrcamentoCtrl();
    $result = $orcSaveCtrl->atualizarOrcamento($orcamentoObj);

    if ($result[0]) {

        WSErro("Resultado desta operação: <b> {$result['resultado']}</b>", WS_ACCEPT);
        ?>
        <p>
            <a href="#" class="bt_imprimir" onclick="window.open('orcamento/imprimir_orc.php?id_orc=<?= $orcamentoObj->getId() ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=yes, SCROLLBARS=YES, TOP=10, LEFT=10');">
                Imprimir
            </a>
        </p>
        <a class="bt_link" href="tecnico.php?id_menu=orcamento" target="_self">Voltar</a>

        <?php
    } else {
        WSErro("Resultado desta operação: <b> {$result['resultado']}</b>", WS_ERROR);
        ?>
        <a class="bt_link bt_azul" href="tecnico.php?id_menu=editar_orcamento&id_orc=<?= $_POST['id_orc_editado'] ?>&msg_erro=" target="_self">Voltar</a>

        <?php
    }
} else {
    echo "Sem POST";
}
?>

