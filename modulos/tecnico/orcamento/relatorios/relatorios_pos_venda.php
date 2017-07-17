<?php
/*
 * Gerar relatorios e estatisticas sobre os Orçamentos Aprovados do Sistema PARA POS VENDA
 * 
 */

$ano_orc_selec = date('Y');

if (filter_has_var(INPUT_POST, 'ano')) {

    $ano_orc_selec = filter_input(INPUT_POST, 'ano', FILTER_VALIDATE_INT); //pega o Ano ao selecionar o ANO
}

$orcCrtl = new OrcamentoCtrl();
?>
<div>
    <h2><?php include_once 'orcamento/includes/nav_wizard.php'; ?> -> <a href="?id_menu=orcamento/relatorios/relatorios_orc"> Relatórios</a> -> Pós-venda</h2>
</div>
<hr>


<fieldset>
    <legend>Busca por ano</legend>
    <!-- form Trocar ANO -->
    <div><!-- form Trocar ANO -->
        <form action="?id_menu=orcamento/relatorios/relatorios_pos_venda" method="post" enctype="multipart/form-data" name="formAgenda">
            Selecione o ANO:	
            <select name="ano" id="ano" class="formFieldsAno">
                <option value="<?php echo $ano_orc_selec; ?>"><?php echo $ano_orc_selec; ?></option>
                <?php
                $anos = $orcCrtl->buscarOrcamentos("DISTINCT ano_orc", "ORDER BY ano_orc DESC");
                foreach ($anos as $l) {
                    ?>
                    <option value="<?php echo $l['ano_orc']; ?>"><?php echo $l['ano_orc']; ?></option>
                    <?php
                }
                ?>
            </select>
            <input  type="submit" name="logar" value="Buscar" id="logar"   />
        </form>
    </div>

</fieldset>


<fieldset>
    <legend>Pesquisas Respondidas em <span style="color: red;"><?= $ano_orc_selec ?></span></legend>	

    <?php
    $pesquisaCtrl = new PesquisaPosVendaCtrl();
    $pesquisasRespondidas = $pesquisaCtrl->buscarControleNOrc("*", "WHERE YEAR(data) = '$ano_orc_selec' ");
    $totalPesquisasRespondidas = count($pesquisasRespondidas);

    $orcConcluidos = $orcCrtl->buscarOrcamentos("*", "WHERE YEAR(data_adicionado_orc) = '$ano_orc_selec' AND serv_concluido = 's' ");
    $totalOrcConcluidos = count($orcConcluidos);
    ?>

    <div class="col-md-3" >
        <ul class="w3-ul w3-border w3-col l4 m5">
            <li><span class="w3-badge elfi_cor_fundo_tabela elfi_cor_padrao_texto w3-right"><?= $totalOrcConcluidos ?></span> Orçamentos Concluidos</li>
            <li ><span class="w3-badge elfi_cor_fundo_tabela elfi_cor_padrao_texto  w3-right"><?= $totalPesquisasRespondidas ?></span> Pesquisas Respondidas</li> 
            <li class="elfi_cor_fundo_indice elfi_cor_padrao_texto"><span class="w3-badge elfi_cor_fundo_branco elfi_cor_padrao_texto w3-right"><?= Formatar::moedaBR(($totalPesquisasRespondidas / ($totalOrcConcluidos == 0 ? 1 : $totalOrcConcluidos)) * 100) . "%" ?></span> Total</li> 
        </ul>
    </div>

</fieldset>


<fieldset>
    <legend>Indices de Satisfação dos Clientes em <span style="color: red;"><?= $ano_orc_selec ?></span></legend>	

    <?php
    //$totalPesquisasRespondidas = count($pesquisasRespondidas);
    $nDeConfiabilidade = $pesquisaCtrl->buscarControleNOrc("*", "WHERE confiabilidade = '1' AND YEAR(data) = '$ano_orc_selec' ");
    $nDepontualidade = $pesquisaCtrl->buscarControleNOrc("*", "WHERE pontualidade = '1'  AND YEAR(data) = '$ano_orc_selec'  ");
    $nDedisponibilide = $pesquisaCtrl->buscarControleNOrc("*", "WHERE disponibilide = '1'  AND YEAR(data) = '$ano_orc_selec'  ");
    $nDequalidade = $pesquisaCtrl->buscarControleNOrc("*", "WHERE qualidade = '1'  AND YEAR(data) = '$ano_orc_selec'  ");
    $nDenormasseguranca = $pesquisaCtrl->buscarControleNOrc("*", "WHERE normasseguranca = '1'  AND YEAR(data) = '$ano_orc_selec'  ");
    $nDeapresentacao = $pesquisaCtrl->buscarControleNOrc("*", "WHERE apresentacao = '1'  AND YEAR(data) = '$ano_orc_selec'  ");
    $nDeenvolvimento = $pesquisaCtrl->buscarControleNOrc("*", "WHERE envolvimento = '1'  AND YEAR(data) = '$ano_orc_selec'  ");
    $nDeeducacao = $pesquisaCtrl->buscarControleNOrc("*", "WHERE educacao = '1'  AND YEAR(data) = '$ano_orc_selec'  ");
    $nDeorganizacao = $pesquisaCtrl->buscarControleNOrc("*", "WHERE organizacao = '1'  AND YEAR(data) = '$ano_orc_selec'  ");
    $nDecompetencia = $pesquisaCtrl->buscarControleNOrc("*", "WHERE competencia = '1'  AND YEAR(data) = '$ano_orc_selec'  ");
    $nDeorcamento = $pesquisaCtrl->buscarControleNOrc("*", "WHERE orcamento = '1'  AND YEAR(data) = '$ano_orc_selec'  ");
    $nDeservico = $pesquisaCtrl->buscarControleNOrc("*", "WHERE servico = '1'  AND YEAR(data) = '$ano_orc_selec'  ");
    $nDesatisfeito = $pesquisaCtrl->buscarControleNOrc("*", "WHERE satisfeito = '1'  AND YEAR(data) = '$ano_orc_selec'  ");
    //var_dump($nDeConfiabilidade);
    ?>

    <div class="col-md-3" >
        <ul class="w3-ul w3-border w3-col l4 m5">
            <li><span class="w3-badge elfi_cor_fundo_tabela elfi_cor_padrao_texto w3-right"><?= Formatar::moedaBR((count($nDeConfiabilidade) / ($totalPesquisasRespondidas == 0 ? 1 : $totalPesquisasRespondidas)) * 100) . "%" ?></span> Confiabilidade </li>
            <li><span class="w3-badge elfi_cor_fundo_tabela elfi_cor_padrao_texto w3-right"><?= Formatar::moedaBR((count($nDepontualidade) / ($totalPesquisasRespondidas == 0 ? 1 : $totalPesquisasRespondidas)) * 100) . "%" ?></span> Pontualidade </li>
            <li><span class="w3-badge elfi_cor_fundo_tabela elfi_cor_padrao_texto w3-right"><?= Formatar::moedaBR((count($nDedisponibilide) / ($totalPesquisasRespondidas == 0 ? 1 : $totalPesquisasRespondidas)) * 100) . "%" ?></span> Disponibilidade </li>
            <li><span class="w3-badge elfi_cor_fundo_tabela elfi_cor_padrao_texto w3-right"><?= Formatar::moedaBR((count($nDequalidade) / ($totalPesquisasRespondidas == 0 ? 1 : $totalPesquisasRespondidas)) * 100) . "%" ?></span> Qualidade </li>
            <li><span class="w3-badge elfi_cor_fundo_tabela elfi_cor_padrao_texto w3-right"><?= Formatar::moedaBR((count($nDeapresentacao) / ($totalPesquisasRespondidas == 0 ? 1 : $totalPesquisasRespondidas)) * 100) . "%" ?></span> Apresentação </li>
            <li><span class="w3-badge elfi_cor_fundo_tabela elfi_cor_padrao_texto w3-right"><?= Formatar::moedaBR((count($nDeenvolvimento) / ($totalPesquisasRespondidas == 0 ? 1 : $totalPesquisasRespondidas)) * 100) . "%" ?></span> Envolvimento </li>
            <li><span class="w3-badge elfi_cor_fundo_tabela elfi_cor_padrao_texto w3-right"><?= Formatar::moedaBR((count($nDeeducacao) / ($totalPesquisasRespondidas == 0 ? 1 : $totalPesquisasRespondidas)) * 100) . "%" ?></span> Educação </li>
            <li><span class="w3-badge elfi_cor_fundo_tabela elfi_cor_padrao_texto w3-right"><?= Formatar::moedaBR((count($nDeorganizacao) / ($totalPesquisasRespondidas == 0 ? 1 : $totalPesquisasRespondidas)) * 100) . "%" ?></span> Organização </li>
            <li><span class="w3-badge elfi_cor_fundo_tabela elfi_cor_padrao_texto w3-right"><?= Formatar::moedaBR((count($nDecompetencia) / ($totalPesquisasRespondidas == 0 ? 1 : $totalPesquisasRespondidas)) * 100) . "%" ?></span> Competencia </li>
            <li><span class="w3-badge elfi_cor_fundo_tabela elfi_cor_padrao_texto w3-right"><?= Formatar::moedaBR((count($nDeorcamento) / ($totalPesquisasRespondidas == 0 ? 1 : $totalPesquisasRespondidas)) * 100) . "%" ?></span> Prazo entrega do Orçamento </li>
            <li><span class="w3-badge elfi_cor_fundo_tabela elfi_cor_padrao_texto w3-right"><?= Formatar::moedaBR((count($nDeservico) / ($totalPesquisasRespondidas == 0 ? 1 : $totalPesquisasRespondidas)) * 100) . "%" ?></span> Prazo entrega do Serviço </li>



            <li class="elfi_cor_fundo_indice elfi_cor_padrao_texto"><span class="w3-badge elfi_cor_fundo_branco elfi_cor_padrao_texto w3-right"><?= Formatar::moedaBR((count($nDesatisfeito) / ($totalPesquisasRespondidas == 0 ? 1 : $totalPesquisasRespondidas)) * 100) . "%" ?></span> Satisfação no Geral</li> 
        </ul>
    </div>

</fieldset>



