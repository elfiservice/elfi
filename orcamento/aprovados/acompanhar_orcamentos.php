<?php
//$ano_atual = date('Y');
$orcCtrl = new OrcamentoCtrl();
?>				

<div>
    <h2><a href="tecnico.php?id_menu=orcamento">Orcamentos</a> -> Aprovados</h2>
</div>
<hr>
<div class="alinhamentoHorizontal">
    <ul>

<!--                <a href="#" onclick="window.open('acompanhamento.php?mes=jan&ano_orc=<?php //echo $ano_atual;        ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
                    JAN
                </a>-->

        <li>        
            <form name="orc_aprovado_por_mes" action="tecnico.php?id_menu=orc_aprovado_por_mes" method="POST" enctype="multipart/form-data">
                <input class="bt_azul" type="submit" value="Ver por Mês" name="ir_orc_aprovado_por_mes" id="ir_orc_aprovado_por_mes"  />
            </form>                


        </li>
    </ul>
</div>

<div id="situacao_orc">


    <fieldset  >
        <legend class="mypets">Programados</legend>
        <div class="thepet" >
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
                        <TH>Data Inicio</TH>
                        <TH>Data conclusão</TH>

                    </TR>
                </thead>
                <tbody>

                    <?php
                    $data_hj = date('Y-m-d');
                    $orc = $orcCtrl->buscarOrcamentos("*", "WHERE data_inicio > '$data_hj' AND data_conclusao = '0000-00-00' AND situacao_orc = 'Aprovado' ORDER BY id");
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
                                <td><a class="bt_link" href="tecnico.php?id_menu=editar_orc_aprovado&id_orc=<?= $row['id'] ?>" >atualizar</a><hr>
                                    <a class="bt_link" href="tecnico.php?id_menu=hitorico_orc_aprovado&id_orc=<?= $row['id'] ?>" >historico (<?php echo $n_orc_check; ?>)</a></td>
                                <Td><?php echo $row['razao_social_contr']; ?> <br> <a href="tecnico.php?id_menu=orc_aprovado_por_mes&mes=<?= $arrData[1] ?>&ano=<?= $arrData[0] ?>#<?= $row['id'] ?>"><small>mais... </small> </a></Td>
                                <TD><?php echo $row['atividade']; ?></TD>
                                <TD><?php echo $row['classificacao']; ?></TD>
                                <TD><?php echo Formatar::limita_texto(strip_tags($row['descricao_servico_orc']), 200); ?></TD>
                                <TD><?php //echo $row['novo_cliente'];          ?></TD>
                                <TD><?php echo $row['n_orc'] . "." . $row['ano_orc']; ?></TD>
                                <TD><?php echo $row['prazo_exec_orc']; ?> dia(s)</TD>
                                <TD><?php echo date('d/m/Y', strtotime($row['data_aprovada'])); ?></TD>
                                <TD><?php echo date('d/m/Y', strtotime($row['data_inicio'])); ?></TD>
                                <TD><?php echo "--"; ?></TD>

                            </tr>


                            <?php
                        }
                    }
                    ?>

                </tbody>
            </TABLE>
        </div>
    </fieldset>	


    <fieldset>
        <legend class="mypets">Em Execução</legend>
        <div class="thepet" >
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

                    </TR>
                </thead>
                <tbody>

                    <?php
                    $orc = $orcCtrl->buscarOrcamentos("*", "WHERE data_inicio <= '$data_hj' AND data_inicio <> '0000-00-00' AND data_conclusao = '0000-00-00' AND situacao_orc = 'Aprovado' ORDER BY id");
                    if ($orc && $orc[0] != false) {
                        foreach ($orc as $row) {
                            $id_orc = $row['id'];
                            $orcHistorico = $orcCtrl->buscarHistoricoOrcamento("*", "WHERE id_acompanhamento = '$id_orc' AND mostrar = '0'", "historico_orc_aprovado");
                            $n_orc_check = count($orcHistorico);

                            $dias_d_aprovado = Formatar::diffDuasDatas($row['data_aprovada'], date('Y-m-d'));
                            $dias_d_exec = Formatar::diffDuasDatas($row['data_inicio'], date('Y-m-d'));
                            if (($dias_d_exec - $row['prazo_exec_orc']) > 0) {
                                $dias_ultrapassad = $dias_d_exec - $row['prazo_exec_orc'];
                            } else {
                                $dias_ultrapassad = "0";
                            }
                            $orcObj = new Orcamento();
                            $orcObj->setId($id_orc);
                            $orcObj->setDiasDAprovado($dias_d_aprovado);
                            $orcObj->setDiasDExecucao($dias_d_exec);
                            $orcObj->setDiasUltrapassado($dias_ultrapassad);
                            if (!$orcCtrl->atualizarOrcamento($orcObj)) {
                                echo "Error";
                            }
                            $arrData = explode("-", $row['data_aprovada']);
                            ?>
                            <TR>
                                <td><a class="bt_link" href="tecnico.php?id_menu=editar_orc_aprovado&id_orc=<?= $row['id'] ?>" >atualizar</a><hr>
                                    <a class="bt_link" href="tecnico.php?id_menu=hitorico_orc_aprovado&id_orc=<?= $row['id'] ?>" >historico (<?php echo $n_orc_check; ?>)</a></td>
                                <Td><?php echo $row['razao_social_contr']; ?> <br> <a href="tecnico.php?id_menu=orc_aprovado_por_mes&mes=<?= $arrData[1] ?>&ano=<?= $arrData[0] ?>#<?= $row['id'] ?>"><small>mais... </small> </a></Td>
                                <TD><?php echo $row['atividade']; ?></TD>
                                <TD><?php echo $row['classificacao']; ?></TD>
                                <TD><?php echo Formatar::limita_texto(strip_tags($row['descricao_servico_orc']), 200); ?></TD>
                                <TD><?php //echo $row['novo_cliente'];          ?></TD>
                                <TD><?php echo $row['n_orc'] . "." . $row['ano_orc']; ?></TD>
                                <TD><?php echo $row['prazo_exec_orc']; ?> dia(s)</TD>
                                <TD><?php echo date('d/m/Y', strtotime($row['data_aprovada'])); ?></TD>
                                <TD><?php echo date('d/m/Y', strtotime($row['data_inicio'])); ?></TD>
                                <TD><?php echo "--"; ?></TD>

                            </tr>


                            <?php
                        }
                    }
                    ?>

                </tbody>
            </TABLE>
        </div>
    </fieldset>


    <fieldset>
        <legend class="mypets">Aguardando Programação</legend>
        <div class="thepet" >
            <TABLE  class="display" id="example3">

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

                    </TR>
                </thead>
                <tbody>

                    <?php
                    $orc3 = $orcCtrl->buscarOrcamentos("*", "WHERE data_inicio = '0000-00-00' AND data_conclusao = '0000-00-00' AND situacao_orc = 'Aprovado'  ORDER BY id");
                    if ($orc3 && $orc3[0] != false) {
                        foreach ($orc3 as $row) {
                            $id_orc = $row['id'];
                            $orcHistorico = $orcCtrl->buscarHistoricoOrcamento("*", "WHERE id_acompanhamento = '$id_orc' AND mostrar = '0'", "historico_orc_aprovado");
                            $n_orc_check = count($orcHistorico);

                            $dias_d_aprovado = Formatar::diffDuasDatas($row['data_aprovada'], date('Y-m-d'));
                            $orcObj = new Orcamento();
                            $orcObj->setId($id_orc);
                            $orcObj->setDiasDAprovado($dias_d_aprovado);
                            //  var_dump($orcObj);
                            if (!$orcCtrl->atualizarOrcamento($orcObj)) {
                                echo "Error";
                            }

                            $arrData = explode("-", $row['data_aprovada']);
                            //var_dump($arrData[1]);
                            ?>
                            <TR>
                                <td><a class="bt_link" href="tecnico.php?id_menu=editar_orc_aprovado&id_orc=<?= $row['id'] ?>" >atualizar</a>
                                    <hr>
                                    <a class="bt_link" href="tecnico.php?id_menu=hitorico_orc_aprovado&id_orc=<?= $row['id'] ?>" >historico (<?php echo $n_orc_check; ?>)</a></td>
                                <Td><?php echo $row['razao_social_contr']; ?> <br> <a href="tecnico.php?id_menu=orc_aprovado_por_mes&mes=<?= $arrData[1] ?>&ano=<?= $arrData[0] ?>#<?= $row['id'] ?>"><small>mais... </small> </a></Td>
                                <TD><?php echo $row['atividade']; ?></TD>
                                <TD><?php echo $row['classificacao']; ?></TD>
                                <TD><?php echo Formatar::limita_texto(strip_tags($row['descricao_servico_orc']), 200); ?></TD>
                                <TD><?php //echo $row['novo_cliente'];         ?></TD>
                                <TD><?php echo $row['n_orc'] . "." . $row['ano_orc']; ?></TD>
                                <TD><?php echo $row['prazo_exec_orc']; ?> dia(s) </TD>
                                <TD><?php echo date('d/m/Y', strtotime($row['data_aprovada'])); ?></TD>
                                <TD><?php echo "--"; ?></TD>
                                <TD><?php echo "--"; ?></TD>

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




