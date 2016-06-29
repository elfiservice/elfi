    <div>
        <h2><a href="tecnico.php?id_menu=orcamento">Orcamentos</a> -> <a href="tecnico.php?id_menu=acompanhar_orcamentos">Aprovados</a> -> Por Mês</h2>
    </div>
    <hr>

<?php
$mes_orc_selec = date('m');
$ano_orc_selec = date('Y');

if (filter_has_var(INPUT_GET, 'ano') && filter_has_var(INPUT_GET, 'mes')) {
    $mes_orc_selec = filter_input(INPUT_GET, 'mes');
$ano_orc_selec = filter_input(INPUT_GET, 'ano');
}

if (filter_has_var(INPUT_POST, 'ano')) {

    $ano_orc_selec = filter_input(INPUT_POST, 'ano'); //pega o Ano ao selecionar o ANO
}

if (filter_has_var(INPUT_POST, 'mes')) {

    $mes_orc_selec = filter_input(INPUT_POST, 'mes'); //pega o Ano ao selecionar o ANO
}

$orcCtrl = new OrcamentoCtrl();

//VErificar na TABELA controle_n_orc se já existe a Linha com o MES e ANO selecionados, se não tem, adiciona, se ja tem não faz nada
$controleCtrl = new ControleNOrcCtrl();
$controles = $controleCtrl->buscarControleNOrc("*", "WHERE mes = '$mes_orc_selec' AND ano = '$ano_orc_selec'");
//var_dump($controles);
if(!$controles){
    //echo "nao tem";
    $controleObj = new ControleNOrc("", $mes_orc_selec, $ano_orc_selec, "", "", "", "", "", "", "", "");
    if(!$controleCtrl->inserirControleNOrc($controleObj)){
        WSErro("Ocorreu um Erro ao inserir Mes e Ano na tabela controle_n_orc! Porfavor informar ao Admin., grato.", WS_ERROR);
        die();
    }
    
}


?>



<fieldset>
    <legend><b>Filtrar</b></legend>

    <div class="alinhamentoHorizontal">
        <ul >
            <li>
                <form name="orc_aprovado_por_mes" action="tecnico.php?id_menu=orc_aprovado_por_mes" method="POST" enctype="multipart/form-data">
                 Mês:
                    <select name="mes" id="mes" >
                        <option id="opcao" value="<?= $mes_orc_selec ?>"><?= $mes_orc_selec ?></option>
                        ﻿<option value="01">1</option>
                        <option value="02">2  </option>
                        <option value="03">  3 </option>
                        <option value="04">  4 </option>
                        <option value="05">  5 </option>
                        <option value="06">  6 </option>
                        <option value="07">  7 </option>
                        <option value="08">  8 </option>
                        <option value="09">  9 </option>
                        <option value="10">  10 </option>
                        <option value="11">  11 </option>
                        <option value="12">  12 </option>
                    </select>

                    Ano:	
                    <select name="ano" id="ano" >
                        <option value="<?php echo $ano_orc_selec; ?>"><?php echo $ano_orc_selec; ?></option>
<?php
$orcBd = $orcCtrl->buscarOrcamentos("DISTINCT ano_orc", "ORDER BY ano_orc DESC");
foreach ($orcBd as $l) {
    ?>
                            <option value="<?php echo $l['ano_orc']; ?>"><?php echo $l['ano_orc']; ?></option>
<?php
  }
?>
                    </select>
                    <input  type="submit" name="ano_orc" value="Buscar" id="ano_orc"   />
                </form>   
            </li>

        </ul>
    </div>
</fieldset>
<fieldset>
    <legend><b>Indicadores e Dados</b></legend>

<?php
//consulta Nº de ORC APROVADOS no mes e ANO Selecionado
$n_orc_total = $orcCtrl->buscarOrcamentos("*", "WHERE YEAR(data_aprovada)='$ano_orc_selec' AND MONTH(data_aprovada)='$mes_orc_selec'");
if ($n_orc_total) {
    $total_orc_mes_ano_selec_aprovados = count($n_orc_total);
?>
    <div>
        <?php

//Numero de Orçamentos FEITO no MES e ANO Selecionados
        $orcBd = $orcCtrl->buscarOrcamentos("*", "WHERE YEAR(data_adicionado_orc)='$ano_orc_selec' AND MONTH(data_adicionado_orc)='$mes_orc_selec'");
        $total_orc_feitos = count($orcBd);

 echo"<p><b> {$total_orc_mes_ano_selec_aprovados}</b> orçamneto(s) aprovado(s) de um Total de <b>{$total_orc_feitos}</b> feitos neste periodo.</p>";

//consulta Nº de ORC aprovados CONCLUIDOS no mes 
        $sql_n_orc = $orcCtrl->buscarOrcamentos("*", "WHERE MONTH(data_aprovada) = '$mes_orc_selec' AND YEAR(data_aprovada) = '$ano_orc_selec' AND data_conclusao <> '0000-00-00'");
        $n_linhas_orc_concluidos = count($sql_n_orc);

        $produtividade_bd = ($n_linhas_orc_concluidos / $total_orc_mes_ano_selec_aprovados ) * 100;
        $produtividade = $produtividade_bd . ' %';

//consulta Nº de ORC aprovados CONCLUIDOS com ATRASO NA CONCLUSAO no mes 
        $sql_n_orc = $orcCtrl->buscarOrcamentos("*", "WHERE MONTH(data_aprovada) = '$mes_orc_selec' AND YEAR(data_aprovada) = '$ano_orc_selec' AND dias_ultrapassad <> '0'");
        $n_linhas_orc_ultrap = count($sql_n_orc);

        $pontualidade_entrega_bd = (1 - ($n_linhas_orc_ultrap / $total_orc_mes_ano_selec_aprovados)) * 100;
        $pontualidade_entrega = $pontualidade_entrega_bd . ' %';

//consulta Nº de ORC aprovados CONCLUIDOS com POS-entrega no mes 
        $sql_n_orc = $orcCtrl->buscarOrcamentos("*", "WHERE MONTH(data_aprovada) = '$mes_orc_selec' AND YEAR(data_aprovada) = '$ano_orc_selec' AND feito_pos_entreg = 's'");
        $n_linhas_orc_pos_entrg = count($sql_n_orc);

        $pos_entrega_bd = ($n_linhas_orc_pos_entrg / $total_orc_mes_ano_selec_aprovados ) * 100;
        $pos_entrega = $pos_entrega_bd . ' %';
  
//consulta Nº de ORC aprovados CONCLUIDOS com nao-conformidades no mes 
        $sql_n_orc = $orcCtrl->buscarOrcamentos("*", "WHERE MONTH(data_aprovada) = '$mes_orc_selec' AND YEAR(data_aprovada) = '$ano_orc_selec' AND nao_conformidade = 's'");        
        $n_linhas_orc_n_conforme = count($sql_n_orc);

        $n_conforme_bd = ($n_linhas_orc_n_conforme / $total_orc_mes_ano_selec_aprovados ) * 100;
        $n_conforme = $n_conforme_bd . ' %';

//consulta total ORC feitos no mes 
        $acompanhamento_orc_bd = ($total_orc_mes_ano_selec_aprovados / $total_orc_feitos ) * 100;
        $acompanhamento_orc = $acompanhamento_orc_bd . ' %';

//consulta Nº de novos clientes  no mes 
        $sql_n_orc = $orcCtrl->buscarOrcamentos("*", "WHERE MONTH(data_aprovada) = '$mes_orc_selec' AND YEAR(data_aprovada) = '$ano_orc_selec' AND novo_cliente = 's'");        
        $n_linhas_novo_cliente = count($sql_n_orc);
				
//consulta Nº de ORC aprovados CONCLUIDOS com INSATISFAÇÃO no mes 
        $sql_n_orc = $orcCtrl->buscarOrcamentos("*", "WHERE MONTH(data_aprovada) = '$mes_orc_selec' AND YEAR(data_aprovada) = '$ano_orc_selec' AND client_insatisfeito = 's'");        
        $n_linhas_orc_insatisfeito = count($sql_n_orc);

        $n_insatisfeito_bd = ($n_linhas_orc_insatisfeito / $total_orc_mes_ano_selec_aprovados ) * 100;
        $n_insatisfeito = $n_insatisfeito_bd . ' %';
        

        $controleObj = new ControleNOrc("", $mes_orc_selec, $ano_orc_selec, $total_orc_feitos, $produtividade_bd, $pontualidade_entrega_bd, $pos_entrega_bd, $n_conforme_bd, $acompanhamento_orc_bd, $n_linhas_novo_cliente, $n_insatisfeito_bd);
         if(!$controleCtrl->atualizarControleNOrc($controleObj)){
             WSErro("Ocorreu um Erro ao inserir Mes e Ano na tabela controle_n_orc! Porfavor informar ao Admin., grato.", WS_ALERT);
         }
        ?>

        <table  class="tableComum">
            <thead>
                <TR>
                    <TH>Indicadores</TH>
                    <TH></TH>
                </tr>
            </thead>
            <tbody class="text-left">
                <tr>
                    <td>
                        Produtividade
                    </td>
                    <td>
<?php echo "<b>".number_format($produtividade_bd, 2, '.', '') . " %</b>"; ?> dos serviços foram executados conforme foi planejado
                    </td>
                </tr>
                <tr>
                    <td>
                        Pontualidade Entrega
                    </td>
                    <td>
                        <?php echo "<b>".number_format($pontualidade_entrega_bd, 2, '.', '') . " %</b>"; ?> dos serviços foram entregues dentro do prazo estabelecido na proposta
                    </td>
                </tr>
                <tr>
                    <td>
                        Nível de atendimento (Pós-entrega)
                    </td>
                    <td>
                        <?php echo "<b>".number_format($pos_entrega_bd, 2, '.', '') . " %</b>"; ?> dos serviços foram realizados um acompanhamento após a conclusão dos serviços
                    </td>
                </tr>
                <tr>
                    <td>
                        Padrão Qualidade (serviços não conformes)
                    </td>
                    <td>
                        <?php echo "<b>".number_format($n_conforme_bd, 2, '.', '') . " %</b>"; ?> de serviços não conformes ou que apresentaram problemas e retrabalhos
                    </td>
                </tr>
                <tr>
                    <td>
                        Acompanhamento Propostas
                    </td>
                    <td>
                        <?php echo "<b>".number_format($acompanhamento_orc_bd, 2, '.', '') . " %</b>"; ?> de propostas aprovadas no mês
                    </td>
                </tr>
                <tr>
                    <td>
                        Novos Clientes
                    </td>
                    <td>
                        <?php echo "<b>".$n_linhas_novo_cliente . "</b>"; ?> cliente(s) novo(s) no mês
                    </td>
                </tr>
                <tr>
                    <td>
                        Insatisfação do Cliente
                    </td>
                    <td>
                        <?php echo "<b>".number_format($n_insatisfeito_bd, 2, '.', '') . " %</b>"; ?> de clientes insatisfeitos no Mês
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
<?php
        }else{
echo "<p><h3> Sem orçamentos aprovados!</h3></p>";
}
?>

</fieldset>

<fieldset>
    <legend><b>Orçamentos Aprovados</b></legend>   
    <TABLE  class="display" id="example">
        <thead>
            <TR>
                <TH></TH>
                <TH>Cliente</TH>
                <TH>Atividade</TH>
                <TH>Classificação</TH>
                <TH>Inf. dos serviços</TH>
                <TH>Novo Cliente</TH>
                <TH>Nº do Orçamento</TH>
                <TH>Prazo de Execução</TH>
                <TH>Data Aprovada</TH>
                <TH>Data Inicio</TH>
                <TH>Data conclusão</TH>
                <TH>Dias de aprovado</TH>
                <TH>Dias de Execução</TH>
                <TH>Dias ultrapassados na Execução</TH>	
                <TH>Serviço Concluido?</TH>
                <TH>Feito Pos-entrega?</TH>
                <TH>Não Conformidade?</TH>
                <TH>OBS não conformidade</TH>
                <TH>Cliente insatisfeito?</TH>
            </TR>
        </thead>
        <tbody>

<?php
if($n_orc_total){
foreach ($n_orc_total as $row){
    $id_orc = $row['id'];
    $praz_exec = $row['prazo_exec_orc'];
    $data_aprovada = $row['data_aprovada'];

    $data_hoje = date('Y-m-d');
    $diff = strtotime($data_hoje) - strtotime($data_aprovada);
    // 24 horas * 60 Min * 60 seg = 86400
    $days = ceil($diff / 86400);
    $data_inicio = $row['data_inicio'];
    $data_conclusao = $row['data_conclusao'];
    if ($data_inicio <> "0000-00-00") {
        if ($data_conclusao == "0000-00-00") {
            $diff = strtotime($data_hoje) - strtotime($data_inicio);
            // 24 horas * 60 Min * 60 seg = 86400
            $days_em_exec = ceil($diff / 86400);
            $days_em_exec = $days_em_exec . ' dia(s)';
        } else {
            $diff = strtotime($data_conclusao) - strtotime($data_inicio);
            // 24 horas * 60 Min * 60 seg = 86400
            $days_em_exec = ceil($diff / 86400);
            $days_em_exec = $days_em_exec . ' dia(s)';
        }
    } else {
        $days_em_exec = "-";
    }

    if ($data_conclusao == "0000-00-00") {
//dias de execução - prazo de execu.

        $days_de_atraso = "-";
    } else if (($days_em_exec - $praz_exec ) > 0) {

        $days_de_atraso_bd = ($days_em_exec - $praz_exec);
        $days_de_atraso = $days_de_atraso_bd . ' dia(s)';
        //var_dump($days_de_atraso_bd);
        $orc =  new Orcamento($id_orc, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", $days_de_atraso_bd, "", "", "", "", "", "", "", "");
        $orcCtrl->atualizarOrcamento($orc);

    } else {
        $days_de_atraso_bd ="0";
        $days_de_atraso = $days_de_atraso_bd . ' dias';
        $orc =  new Orcamento($id_orc, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", $days_de_atraso_bd, "", "", "", "", "", "", "", "");
      $orcCtrl->atualizarOrcamento($orc);
        
    }

    $serv_concluido = $row['serv_concluido'];
    $feito_pos_entreg = $row['feito_pos_entreg'];
    if ($serv_concluido == "s" && $feito_pos_entreg == "n") {

        $feito_pos_entreg = $row['feito_pos_entreg'] . " <br><a href=\"pos_entrega.php?id_orc=" . $row['id'] . "&msg_erro=#\" target=\"_self\">enviar Pos-Entrega</a>";
    } else {
        $feito_pos_entreg = $row['feito_pos_entreg'];
    }

                $orcHistorico = $orcCtrl->buscarHistoricoOrcamento("*", "WHERE id_acompanhamento = '$id_orc' AND mostrar = '0'", "historico_orc_aprovado");
            $n_orc_check = count($orcHistorico);
    ?>
                <TR>
                                    <td><a class="bt_link" href="tecnico.php?id_menu=editar_orc_aprovado&id_orc=<?=$row['id']?>" >atualizar</a><hr>
                                       <a class="bt_link" href="tecnico.php?id_menu=hitorico_orc_aprovado&id_orc=<?=$row['id']?>" >historico (<?php echo $n_orc_check; ?>)</a></td>
                    <Td><?php echo $row['razao_social_contr']; ?></Td>
                    <TD><?php echo $row['atividade']; ?></TD>
                    <TD><?php echo $row['classificacao']; ?></TD>
                    <TD><?php echo $row['descricao_servico_orc']; ?></TD>
                    <TD><?php echo $row['novo_cliente']; ?></TD>
                    <TD><div id="<?=$row['id']?>"><?php echo $row['n_orc']; ?></div></TD>
                    <TD><?php echo $row['prazo_exec_orc']; ?> dia(s)</TD>
                    <TD><?php echo date('d/m/Y', strtotime($data_aprovada)); ?></TD>
                    <TD><?php if ($row['data_inicio'] == "0000-00-00") {
                echo "--";
            } else {
                echo date('d/m/Y', strtotime($row['data_inicio']));
            }; ?></TD>
                    <TD><?php if ($row['data_conclusao'] == "0000-00-00") {
                echo "--";
            } else {
                echo date('d/m/Y', strtotime($row['data_conclusao']));
            }; ?></TD>
                    <TD><?php echo $days . ' dia(s)'; ?></TD>
                    <TD><?php echo $days_em_exec; ?> </TD>
                    <TD><?php echo $days_de_atraso; ?></TD>
                    <TD><?php echo $row['serv_concluido']; ?></TD>
                    <TD><?php echo $feito_pos_entreg; ?></TD>
                    <TD><?php echo $row['nao_conformidade']; ?></TD>
                    <TD><?php echo $row['obs_n_conformidad']; ?></TD>
                    <TD><?php echo $row['client_insatisfeito']; ?></TD>
                </TR>
    <?php
}

}
?>
        </tbody>
    </TABLE>
</fieldset>
