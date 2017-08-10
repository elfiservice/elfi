
<div>
    <h2><?php include_once 'orcamento/includes/nav_wizard.php'; ?> -> Editar -> Salvando</h2>
</div>
<hr>
<?php
$username = Formatar::prefixEmail($_SESSION['Login']);
$orcObjInicial = $_SESSION['orcObjInicial'];

$arrOrcInicial = array_values($orcObjInicial[0]);
//echo $orcObjInicial[0]['n_orc'] . '<br>';
//echo $orcObjInicial[0]['ano_orc'] . '<br>';
//var_dump($orcObjInicial);
//die;


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

    $orcAlterado = array($_POST['id_orc_editado'], $id_cliente, $id_colab, "", "", $username, "", $_POST['razao_social'], $cnpj_contrato, $_POST['endereco'], $_POST['bairro'], $_POST['city'], $_POST['estado'], $_POST['cep'], $_POST['tel'], $_POST['cel'], $_POST['email_orc'], $_POST['contato_clint'], $razao_social_obra, $cnpj_obra, $endereco_obra, $bairro_obra, $cidade_obra, $estado_obra, $cep_obra, $tel_obra, $cel_obra, $email_orc_obra, $_POST['atividade1'], $_POST['classificacao1'], $_POST['quantidade1'], $_POST['unidade1'], $descricao_servicos, $_POST['execucao_orc'], $_POST['validade_orc'], $_POST['pagamento_orc'], $observacoes_servico, $_POST['duvida_orc'], $valor_do_servico, $valo_do_material, "", $total_orc, "", "", $data_ultima_alteracao, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "");
    $arr_dif = array_diff_assoc($arrOrcInicial, $orcAlterado);
    //  var_dump($arr_dif);
//foreach($arr_dif as $key => $value){
////  echo "antigo: ".$arrOrcInicial[$key]."<br />";
////  echo "novo: ".$orcAlterado[$key]."<br />";
//    
//    if($orcAlterado[$key] != ""){
//          echo "novo: ".$orcAlterado[$key]."<br />";
//           echo "<hr>";
//    }
// 
//}

    $orcamentoObj = new Orcamento(
            $_POST['id_orc_editado'], $id_cliente, $id_colab, $orcObjInicial[0]['n_orc'], $orcObjInicial[0]['ano_orc'], $username, "", $_POST['razao_social'], $cnpj_contrato, $_POST['endereco'], $_POST['bairro'], $_POST['city'], $_POST['estado'], $_POST['cep'], $_POST['tel'], $_POST['cel'], $_POST['email_orc'], $_POST['contato_clint'], $razao_social_obra, $cnpj_obra, $endereco_obra, $bairro_obra, $cidade_obra, $estado_obra, $cep_obra, $tel_obra, $cel_obra, $email_orc_obra, $_POST['atividade1'], $_POST['classificacao1'], $_POST['quantidade1'], $_POST['unidade1'], $descricao_servicos, $_POST['execucao_orc'], $_POST['validade_orc'], $_POST['pagamento_orc'], $observacoes_servico, $_POST['duvida_orc'], $valor_do_servico, $valo_do_material, "", $total_orc, "", "", $data_ultima_alteracao, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "");

    $orcSaveCtrl = new OrcamentoCtrl();
    $result = $orcSaveCtrl->atualizarOrcamento($orcamentoObj);
    // var_dump($result);
    if ($result[0]) {

        WSErro("Resultado desta operação: <b> {$result['resultado']}</b>", WS_ACCEPT);
        //Adiciona alteração no Historico Orc Não AProvado
        $historicoNAproCtrl = new HistoricoOrcNaoAprovadoCtrl();

        $conversa = "##### Atualização do Orcamento #####<br>";

        if ($orcAlterado[7] != $arrOrcInicial[7]) {
            $conversa.= "- Nome do Cliente de <b>{$arrOrcInicial[7]}</b> para <b> {$orcAlterado[7] }</b><br>";
        }
        if ($orcAlterado[17] != $arrOrcInicial[17]) {
            $conversa.= "- Nome do contato do Cliente de <b>{$arrOrcInicial[17]} </b>para <b> {$orcAlterado[17] }</b><br>";
        }

        if ($orcAlterado[18] != $arrOrcInicial[18]) {
            $conversa.= "- Dados da Obra de <b>{$arrOrcInicial[18]} </b>para <b> {$orcAlterado[18] }</b><br>";
        }

        if ($orcAlterado[20] != $arrOrcInicial[20]) {
            $conversa.= "- Edereço  da Obra de <b>{$arrOrcInicial[20]} </b>para <b> {$orcAlterado[20] }</b><br>";
        }

        if ($orcAlterado[28] != $arrOrcInicial[28]) {
            $conversa.= "- Tipo da Atividade de <b>{$arrOrcInicial[28]} </b>para <b> {$orcAlterado[28] }</b><br>";
        }

        if ($orcAlterado[32] != $arrOrcInicial[32]) {
            $conversa.= "- <b>Descricção dos serviços alterada, para visuzalizar vá ao orçamento.</b><br>";
        }

        if ($orcAlterado[33] != $arrOrcInicial[33]) {
            $conversa.= "- Prazo de Execução de <b>{$arrOrcInicial[33]} dia(s)</b> para <b> {$orcAlterado[33] }dia(s)</b><br>";
        }

        if ($orcAlterado[34] != $arrOrcInicial[34]) {
            $conversa.= "- Validade da Proposta de <b>{$arrOrcInicial[34]} dia(s) </b>para <b> {$orcAlterado[34] } dia(s)</b><br>";
        }

        if ($orcAlterado[35] != $arrOrcInicial[35]) {
            $conversa.= "- Condições de Pagamento de <b>{$arrOrcInicial[35]} </b>para <b> {$orcAlterado[35] }</b><br>";
        }

        if ($orcAlterado[36] != $arrOrcInicial[36]) {
            $conversa.= "- Observações de <b>{$arrOrcInicial[36]} </b>para <b> {$orcAlterado[36] }</b><br>";
        }

        if ($orcAlterado[38] != $arrOrcInicial[38]) {
            $arrOrcInicialBr = Formatar::moedaBR($arrOrcInicial[38]);
            $orcAlteradoBr = Formatar::moedaBR($orcAlterado[38]);
            $conversa.= "- Valor do Serviço de <b>R$ {$arrOrcInicialBr} </b>para <b>R$ {$orcAlteradoBr }</b><br>";
        }

        if ($orcAlterado[39] != $arrOrcInicial[39]) {
            $arrOrcInicialBr = Formatar::moedaBR($arrOrcInicial[39]);
            $orcAlteradoBr = Formatar::moedaBR($orcAlterado[39]);
            $conversa.= "- Valor do Material de <b>R$ {$arrOrcInicialBr} </b>para <b>R$ {$orcAlteradoBr}</b><br>";
        }
        if ($orcAlterado[41] != $arrOrcInicial[41]) {
            $arrOrcInicialBr = Formatar::moedaBR($arrOrcInicial[41]);
            $orcAlteradoBr = Formatar::moedaBR($orcAlterado[41]);
            $conversa.= "- Novo Valor do Orc. de <b>R$ {$arrOrcInicialBr} </b>para <b>R$ {$orcAlteradoBr }</b><br>";
        }

        if ($orcAlterado[44] != $arrOrcInicial[44]) {
            if($arrOrcInicial[44] == "0000-00-00 00:00:00"){
                $arrOrcInicialBr = Formatar::formatarDataComHora($arrOrcInicial[43]);
            }else{
                $arrOrcInicialBr = Formatar::formatarDataComHora($arrOrcInicial[44]);
            }
            
            $orcAlteradoBr = Formatar::formatarDataComHora($orcAlterado[44]);
            $conversa.= "- Nova Data do Orçamento de <b>{$arrOrcInicialBr} </b>para <b> {$orcAlteradoBr}</b><br>";
        }


        $histOrcNAproOb = new HistoricoOrcNaoAprovado("", $_POST['id_orc_editado'], $data_ultima_alteracao, $id_colab, $username, $_POST['contato_clint'], $_POST['tel'], $conversa);

        if ($historicoNAproCtrl->inserirBD($histOrcNAproOb)) {
            echo "atualizado no historico";
        }
        ?>
        <p>
            <a href="#" class="bt_imprimir" onclick="window.open('orcamento/imprimir_orc.php?id_orc=<?= $orcamentoObj->getId() ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=yes, SCROLLBARS=YES, TOP=10, LEFT=10');">
                Imprimir
            </a>
        </p>
        <a class="bt_link" href="?id_menu=orcamento/manterOrcamentos" target="_self">Voltar</a>

        <?php
    } else {
        WSErro("Resultado desta operação: <b> {$result['resultado']}</b>", WS_ERROR);
        ?>
        <a class="bt_link bt_azul" href="?id_menu=orcamento/editar_orcamento&id_orc=<?= $_POST['id_orc_editado'] ?>&msg_erro=" target="_self">Voltar</a>

        <?php
    }
} else {
    echo "Sem POST";
}

$_SESSION['orcObjInicial'] = "";
?>

