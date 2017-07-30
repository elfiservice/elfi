<?php
//$ano_atual = date('Y');
$orcCtrl = new OrcamentoCtrl();
?>				

<div>
    <h2><?php include_once 'orcamento/includes/nav_wizard.php'; ?> -> Contratos</h2>
</div>
<hr>
<div class="alinhamentoHorizontal">
    <ul>

<!--                <a href="#" onclick="window.open('acompanhamento.php?mes=jan&ano_orc=<?php //echo $ano_atual;           ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
                    JAN
                </a>-->

        <!--        <li>        
                    <form name="orc_aprovado_por_mes" action="?id_menu=orcamento/aprovados/orc_aprovado_por_mes" method="POST" enctype="multipart/form-data">
                        <input class="bt_azul" type="submit" value="Ver por Mês" name="ir_orc_aprovado_por_mes" id="ir_orc_aprovado_por_mes"  />
                    </form>                
        
        
                </li>-->
    </ul>
</div>

<div id="situacao_orc">


    <fieldset  >
        <legend class="mypetsx">Acompanhamento</legend>
        <div class="thepetx" >
            <TABLE  class="display" id="example2">
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
                        <TH>Data Inicio / Assinatura</TH>
                        <TH>Data conclusão</TH>

                    </TR>
                </thead>
                <tbody>

                    <?php
                    $data_hj = date('Y-m-d');
                    $orc = $orcCtrl->buscarOrcamentos("*", "WHERE situacao_orc = 'Contrato' ORDER BY id");
                    if ($orc && $orc[0] != false) {
                        foreach ($orc as $row) {
                            $id_orc = $row['id'];
                            $orcHistorico = $orcCtrl->buscarHistoricoOrcamento("*", "WHERE id_acompanhamento = '$id_orc' AND mostrar = '0'", "historico_orc_aprovado");
                            $n_orc_check = count($orcHistorico);

                            $dias_d_aprovado = Formatar::diffDuasDatas($row['data_aprovada'], date('Y-m-d'));
                            $orcObj = new Orcamento();
                            $orcObj->setId($id_orc);
                            $orcObj->setDiasDAprovado($dias_d_aprovado);
                            if (!$orcCtrl->atualizarOrcamento($orcObj)) {
                                echo "Error";
                            }
                            $arrData = explode("-", $row['data_aprovada']);
                            ?>
                            <TR>
                                <td><a class="bt_link" href="?id_menu=orcamento/aprovados/editar_orc_aprovado&id_orc=<?= $row['id'] ?>" >atualizar</a><hr>
                                    <a class="bt_link" href="?id_menu=orcamento/aprovados/hitorico_orc_aprovado&id_orc=<?= $row['id'] ?>" >historico (<?php echo $n_orc_check; ?>)</a></td>
                                <Td><a href="#<?= $row['id'] ?>" onclick="window.open('orcamento/imprimir_orc.php?id_orc=<?= $row['id']; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
                                        <?= $row['razao_social_contr']; ?>
                                    </a> <br> <a href="?id_menu=orcamento/aprovados/orc_aprovado_por_mes&mes=<?= $arrData[1] ?>&ano=<?= $arrData[0] ?>#<?= $row['id'] ?>"><small>mais... </small> </a></Td>
                                <TD><?php echo $row['atividade']; ?></TD>
                                <TD><?php echo $row['classificacao']; ?></TD>
                                <TD><?php echo Formatar::limita_texto(strip_tags($row['descricao_servico_orc']), 200); ?></TD>
                                <TD><?php //echo $row['novo_cliente'];             ?></TD>
                                <TD ><div id="<?= $row['id'] ?>"><?php echo $row['n_orc'] . "." . $row['ano_orc']; ?></div></TD>
                                <TD><?php echo $row['prazo_exec_orc']; ?> dia(s)</TD>
                                <TD><?= ($row['data_aprovada'] == "0000-00-00" ? "--" : date('d/m/Y', strtotime($row['data_aprovada'])) ); ?></TD>
                                <TD><?= ($row['data_inicio'] == "0000-00-00" ? "--" : date('d/m/Y', strtotime($row['data_inicio'])) ); ?></TD>
                                <TD><?= ($row['data_inicio'] == "0000-00-00" ? "--" : date('d/m/Y', Formatar::addToDate($row['data_inicio'], "12", "m")) ); ?></TD>

                            </tr>


                            <?php
                        }
                    }
                    ?>

                </tbody>
            </TABLE>
        </div>
    </fieldset>	


</div>




