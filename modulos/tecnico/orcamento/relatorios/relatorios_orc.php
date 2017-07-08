<?php
/*
 * Gerar relatorios e estatisticas sobre os Orçamentos Aprovados do Sistema
 * 
 */

$ano_orc_selec = date('Y');

if (filter_has_var(INPUT_POST, 'ano')) {

    $ano_orc_selec = filter_input(INPUT_POST, 'ano', FILTER_VALIDATE_INT); //pega o Ano ao selecionar o ANO
}

$orcCrtl = new OrcamentoCtrl();
?>
<div>
    <h2><a href="tecnico.php?id_menu=orcamento">Orcamentos</a> ->  Relatórios </h2>
</div>
<hr>
<div class="alinhamentoHorizontal">
    <ul>
        <li>
            <form name="rel_pos_venda" action="tecnico.php?id_menu=relatorios_pos_venda" method="POST" enctype="multipart/form-data">
                <input class="bt_incluir"  type="submit" value="Pos-venda" name="nrel_pos_venda_btn" />
            </form>
        </li>
        <li>
            <form name="rel_cliente" action="tecnico.php?id_menu=relatorios_cliente" method="POST" enctype="multipart/form-data">
                <input class="bt_incluir"  type="submit" value="Cliente" name="rel_cliente_btn" />
            </form>
        </li>    
        <li>
            <form name="rel_atividade" action="tecnico.php?id_menu=relatorios_atividade" method="POST" enctype="multipart/form-data">
                <input class="bt_incluir"  type="submit" value="Atividade" name="rel_atividade_btn" />
            </form>
        </li>            

    </ul>

</div>
<hr>
<fieldset>
    <legend>Busca por ano</legend>
    <!-- form Trocar ANO -->
    <div><!-- form Trocar ANO -->
        <form action="tecnico.php?id_menu=relatorios_orc" method="post" enctype="multipart/form-data" name="formAgenda">
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



    <fieldset>
        <legend>Orçamentos Por Situação e Período</legend>

        <TABLE border="1" class="tableComum" >
            <thead>
                <TR>

                    <TH>MÊS</TH>
                    <TH>ORC FEITAS</TH>                    
                    <TH>ORC APROVADOS</TH>
                    <th>ORC CANCELADOS</th>
                    <th>ORC PERDIDOS</th>
                    <th>ORC CONCLUIDOS</th>                    

                </TR>
            </thead>
            <tbody>

                <?php
//$ano_orc = date('Y');

                $total = 0;
                $total_orc_feitos = 0;

                for ($i = 1; $i <= 12; $i++) {


//consulta Nºde ORC Feitos no mes 
                    $orcs_aguardando = $orcCrtl->buscarOrcamentos("*", "WHERE MONTH(data_adicionado_orc) = '$i' AND YEAR(data_adicionado_orc) = '$ano_orc_selec' AND situacao_orc LIKE 'Aguardando aprovação'  ");
                    $n_linhas_orc_aguardando = count($orcs_aguardando);

//consulta Nºde ORC aprovados no mes 
                    $orcs_aprovados = $orcCrtl->buscarOrcamentos("*", "WHERE MONTH(data_aprovada) = '$i' AND YEAR(data_aprovada) = '$ano_orc_selec' ");
                    $n_linhas_orc_aprovados = count($orcs_aprovados);
                    $vr_acumulado_orc_aprovado = 0;
                    if (!empty($orcs_aprovados)) {
                        foreach ($orcs_aprovados as $orcs) {
                            $vr_acumulado_orc_aprovado += (int) $orcs["vr_total_orc"];
//                            echo (int) $orcs["vr_total_orc"] . " <br>";
                        }
                    }

//consulta Nºde ORC cancelados no mes 
                    $orcs_cancelados = $orcCrtl->buscarOrcamentos("*", "WHERE MONTH(data_ultima_alteracao) = '$i' AND YEAR(data_ultima_alteracao) = '$ano_orc_selec' AND situacao_orc LIKE 'Cancelado' ");
                    $n_linhas_orc_cancelados = count($orcs_cancelados);
                    $vr_acumulado_orc_cancelados = 0;
                    if (!empty($orcs_cancelados)) {
                        foreach ($orcs_cancelados as $orcs) {
                            $vr_acumulado_orc_cancelados += (int) $orcs["vr_total_orc"];
                        }
                    }

//consulta Nºde ORC Perdidas no mes 
                    $orcs_Perdidas = $orcCrtl->buscarOrcamentos("*", "WHERE MONTH(data_ultima_alteracao) = '$i' AND YEAR(data_ultima_alteracao) = '$ano_orc_selec' AND situacao_orc LIKE 'Perdido' ");
                    $n_linhas_orc_Perdidas = count($orcs_Perdidas);
                    $vr_acumulado_orc_perdidos = 0;
                    if (!empty($orcs_Perdidas)) {
                        foreach ($orcs_Perdidas as $orcs) {
                            $vr_acumulado_orc_perdidos += (int) $orcs["vr_total_orc"];
                        }
                    }                    

//consulta Nºde ORC CONCLUIDOS no mes 
                    $orcs_concluidos = $orcCrtl->buscarOrcamentos("*", "WHERE MONTH(data_conclusao) = '$i' AND YEAR(data_conclusao) = '$ano_orc_selec' AND situacao_orc LIKE 'concluido' ");
                    $n_linhas_orc_concluidos = count($orcs_concluidos);
                    $vr_acumulado_orc_concluidos = 0;
                    if (!empty($orcs_concluidos)) {
                        foreach ($orcs_concluidos as $orcs) {
                            $vr_acumulado_orc_concluidos += (int) $orcs["vr_total_orc"];
                        }
                    }                     


                    $mes_atual = date('m');

                    if ($ano_orc_selec < date('Y')) {
                        $orc_por_mes = $orcCrtl->buscarOrcamentos("*", "WHERE MONTH(data_adicionado_orc)  = '$i' AND YEAR(data_adicionado_orc) = '$ano_orc_selec' ");
                        $n_orc_feitos_no_mes = count($orc_por_mes);
                    } else if ($i > $mes_atual) {

                        $n_orc_feitos_no_mes = 0;
                    } else {
//selecionar controles
                        $orc_por_mes = $orcCrtl->buscarOrcamentos("*", "WHERE MONTH(data_adicionado_orc)  = '$i' AND YEAR(data_adicionado_orc) = '$ano_orc_selec' ");
                        $n_orc_feitos_no_mes = count($orc_por_mes);
                    }

                    if ($n_orc_feitos_no_mes == 0) {
                        $em_porcentagem = 0;
                        $em_porcentagem_Can = 0;
                        $em_porcentagem_perd = 0;
                        $em_porcentagem_conc = 0;
                    } else {

                        $em_porcentagem = ($n_linhas_orc_aprovados / $n_orc_feitos_no_mes) * 100;
                        $em_porcentagem_Can = ($n_linhas_orc_cancelados / $n_orc_feitos_no_mes) * 100;
                        $em_porcentagem_perd = ($n_linhas_orc_Perdidas / $n_orc_feitos_no_mes) * 100;
                        $em_porcentagem_conc = ($n_linhas_orc_concluidos / $n_orc_feitos_no_mes) * 100;
                    }
                    ?>
                    <tr align="center">
                        <td  class="indiceTabelaComum"><?= $i ?></td>
                        <td> <?= $n_orc_feitos_no_mes ?></td>
                        <td> <?= $n_linhas_orc_aprovados . " - (" . number_format($em_porcentagem, 2, '.', '') . "%) - Total R$ " . number_format($vr_acumulado_orc_aprovado, '2','.',',') ?></td>
                        <td> <?= $n_linhas_orc_cancelados . " - (" . number_format($em_porcentagem_Can, 2, '.', '') . "%) - Total R$ " . number_format($vr_acumulado_orc_cancelados, '2','.',',')  ?></td>
                        <td> <?= $n_linhas_orc_Perdidas . " - (" . number_format($em_porcentagem_perd, 2, '.', '') . "%) - Total R$ " . number_format($vr_acumulado_orc_perdidos, '2','.',',')  ?></td>
                        <td> <?= $n_linhas_orc_concluidos . " - (" . number_format($em_porcentagem_conc, 2, '.', '') . "%) - Total R$ " . number_format($vr_acumulado_orc_concluidos, '2','.',',')  ?></td>
                    </tr>
                    <?php
                    $total = $total + $n_linhas_orc_aprovados;
                    $total_orc_feitos = $total_orc_feitos + $n_orc_feitos_no_mes;
                }
                ?>	



            </tbody>
        </TABLE>	
    </fieldset>

    <fieldset>
        <legend>Orçamentos Totais Por Ano: <span style="color: red;"><?= $ano_orc_selec ?></span></legend>
        <div class="col-md-3" >
            <?php
            $orcCtrl = new OrcamentoCtrl();
            $orcPorClienteSituacaoAguardando = $orcCtrl->buscarOrcamentos("situacao_orc", "WHERE YEAR(data_adicionado_orc) = '$ano_orc_selec' AND situacao_orc = 'Aguardando Aprovação' ");
            $orcPorClienteSituacaoAprovado = $orcCtrl->buscarOrcamentos("situacao_orc", "WHERE YEAR(data_adicionado_orc) = '$ano_orc_selec' AND situacao_orc = 'Aprovado' ");
            $orcPorClienteSituacaoConcluido = $orcCtrl->buscarOrcamentos("situacao_orc", "WHERE YEAR(data_adicionado_orc) = '$ano_orc_selec' AND situacao_orc = 'concluido' ");
            $orcPorClienteSituacaoCancelado = $orcCtrl->buscarOrcamentos("situacao_orc", "WHERE YEAR(data_adicionado_orc) = '$ano_orc_selec' AND situacao_orc = 'Cancelado' ");
            $orcPorClienteSituacaoPerdido = $orcCtrl->buscarOrcamentos("situacao_orc", "WHERE YEAR(data_adicionado_orc) = '$ano_orc_selec' AND situacao_orc = 'Perdido' ");

            $totalOrcCliente = count($orcPorClienteSituacaoPerdido) + count($orcPorClienteSituacaoCancelado) + count($orcPorClienteSituacaoConcluido) + count($orcPorClienteSituacaoAprovado) + count($orcPorClienteSituacaoAguardando);
            $aguardandoPercent = (count($orcPorClienteSituacaoAguardando) / $totalOrcCliente) * 100;
            $aprovadoPercent = (count($orcPorClienteSituacaoAprovado) / $totalOrcCliente) * 100;
            $concluidoPercent = (count($orcPorClienteSituacaoConcluido) / $totalOrcCliente) * 100;
            $canceladoPercent = (count($orcPorClienteSituacaoCancelado) / $totalOrcCliente) * 100;
            $perdidoPercent = (count($orcPorClienteSituacaoPerdido) / $totalOrcCliente) * 100;
            ?>

            <ul class="w3-ul w3-border w3-col l4 m5">
                <li><span class="w3-badge elfi_cor_fundo_tabela elfi_cor_padrao_texto w3-right"><?= Formatar::moedaBR($aguardandoPercent) . "%" ?></span><span class="w3-badge elfi_cor_fundo_tabela elfi_cor_padrao_texto w3-right"><?= count($orcPorClienteSituacaoAguardando) ?></span> Aguardando Aprovação</li>
                <li ><span class="w3-badge elfi_cor_fundo_tabela elfi_cor_padrao_texto  w3-right"><?= Formatar::moedaBR($aprovadoPercent) . "%" ?></span><span class="w3-badge elfi_cor_fundo_tabela elfi_cor_padrao_texto  w3-right"><?= count($orcPorClienteSituacaoAprovado) ?></span> Aprovados</li> 
                <li ><span class="w3-badge elfi_cor_fundo_tabela elfi_cor_padrao_texto w3-right"><?= Formatar::moedaBR($concluidoPercent) . "%" ?></span><span class="w3-badge elfi_cor_fundo_tabela elfi_cor_padrao_texto  w3-right"><?= count($orcPorClienteSituacaoConcluido) ?></span> Concluidos</li> 
                <li ><span class="w3-badge elfi_cor_fundo_tabela elfi_cor_padrao_texto w3-right"><?= Formatar::moedaBR($canceladoPercent) . "%" ?></span><span class="w3-badge  elfi_cor_fundo_tabela elfi_cor_padrao_texto  w3-right"><?= count($orcPorClienteSituacaoCancelado) ?></span> Cancelados</li> 
                <li ><span class="w3-badge elfi_cor_fundo_tabela elfi_cor_padrao_texto  w3-right"><?= Formatar::moedaBR($perdidoPercent) . "%" ?></span><span class="w3-badge elfi_cor_fundo_tabela elfi_cor_padrao_texto w3-right"><?= count($orcPorClienteSituacaoPerdido) ?></span> Perdidos</li> 
                <li class="elfi_cor_fundo_indice elfi_cor_padrao_texto"><span class="w3-badge elfi_cor_fundo_branco elfi_cor_padrao_texto w3-right">100%</span><span class="w3-badge w3-white elfi_cor_padrao_texto w3-right"><?= $totalOrcCliente ?></span> Total</li> 
            </ul>
        </div>
    </fieldset>    

