<?php
    $ano_atual = date('Y');
    $orcCtrl = new OrcamentoCtrl();
    ?>				

    <div>
        <h2><a href="tecnico.php?id_menu=orcamento">Orcamentos</a> -> Aprovados</h2>
    </div>
    <hr>
    <div class="alinhamentoHorizontal">
        <ul>

            <li><a class="bt_link" href="tecnico.php?id_menu=relatorios_orc_aprovados" > Relatórios </a>
            </li>
            <li><a class="bt_link"  href="#" onclick="window.open('link_pesquisa_satisfacao.php?mes=fev&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
                    Link Pesquisa
                </a>
            </li>
            <li><a class="bt_link" href="#" onclick="window.open('email_situacao_orc.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
                    Enviar Situação Orc.
                </a>
            </li>
            <li><a href="#" onclick="window.open('acompanhamento.php?mes=jan&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
                    JAN
                </a>
            </li>
            <li><a href="#" onclick="window.open('acompanhamento.php?mes=fev&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
                    FEV
                </a>
            </li>
            <li><a href="#" onclick="window.open('acompanhamento.php?mes=mar&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
                    MAR
                </a>
            </li>
            <li><a href="#" onclick="window.open('acompanhamento.php?mes=abr&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
                    ABR
                </a>
            </li>
            <li><a href="#" onclick="window.open('acompanhamento.php?mes=mai&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
                    MAI
                </a>
            </li>

            <li><a href="#" onclick="window.open('acompanhamento.php?mes=jun&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
                    JUN
                </a>
            </li>

            <li><a href="#" onclick="window.open('acompanhamento.php?mes=jul&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
                    JUL
                </a>
            </li>

            <li><a href="#" onclick="window.open('acompanhamento.php?mes=ago&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
                    AGO
                </a>
            </li>

            <li><a href="#" onclick="window.open('acompanhamento.php?mes=set&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
                    SET
                </a>
            </li>

            <li><a href="#" onclick="window.open('acompanhamento.php?mes=out&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
                    OUT
                </a>
            </li>

            <li><a href="#" onclick="window.open('acompanhamento.php?mes=nov&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
                    NOV
                </a>
            </li>

            <li><a href="#" onclick="window.open('acompanhamento.php?mes=dez&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
                    DEZ
                </a>
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
            $orcHistorico = $orcCtrl->buscarHistoricoOrcamento("*", "WHERE id_acompanhamento = '$id_orc'", "historico_orc_aprovado");
            $n_orc_check = count($orcHistorico);
            ?>
                                <TR>
                                    <td><a href="#" onclick="window.open('editar_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">atualizar</a><br>
                                        <a href="#" onclick="window.open('hitorico_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">historico (<?php echo $n_orc_check; ?>)</a></td>
                                    <Td><?php echo $row['razao_social_contr']; ?></Td>
                                    <TD><?php echo $row['atividade']; ?></TD>
                                    <TD><?php echo $row['classificacao']; ?></TD>
                                    <TD><?php echo Formatar::limita_texto(strip_tags($row['descricao_servico_orc']), 200); ?></TD>
                                    <TD><?php //echo $row['novo_cliente'];   ?></TD>
                                    <TD><?php echo $row['n_orc'] . "." . $row['ano_orc']; ?></TD>
                                    <TD><?php echo $row['prazo_exec_orc']; ?></TD>
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
            $orcHistorico = $orcCtrl->buscarHistoricoOrcamento("*", "WHERE id_acompanhamento = '$id_orc'", "historico_orc_aprovado");
            $n_orc_check = count($orcHistorico);
            ?>
                                <TR>
                                    <td><a href="#" onclick="window.open('editar_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">atualizar</a><br>
                                        <a href="#" onclick="window.open('hitorico_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">historico (<?php echo $n_orc_check; ?>)</a></td>
                                    <Td><?php echo $row['razao_social_contr']; ?></Td>
                                    <TD><?php echo $row['atividade']; ?></TD>
                                    <TD><?php echo $row['classificacao']; ?></TD>
                                    <TD><?php echo Formatar::limita_texto(strip_tags($row['descricao_servico_orc']), 200); ?></TD>
                                    <TD><?php //echo $row['novo_cliente'];   ?></TD>
                                    <TD><?php echo $row['n_orc'] . "." . $row['ano_orc']; ?></TD>
                                    <TD><?php echo $row['prazo_exec_orc']; ?></TD>
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
    $orc = $orcCtrl->buscarOrcamentos("*", "WHERE data_inicio = '0000-00-00' AND data_conclusao = '0000-00-00' AND situacao_orc = 'Aprovado'  ORDER BY id");
    if ($orc && $orc[0] != false) {
        foreach ($orc as $row) {
            $id_orc = $row['id'];
            $orcHistorico = $orcCtrl->buscarHistoricoOrcamento("*", "WHERE id_acompanhamento = '$id_orc'", "historico_orc_aprovado");
            $n_orc_check = count($orcHistorico);
            ?>
                                <TR>
                                    <td><a href="#" onclick="window.open('editar_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">atualizar</a><br>
                                        <a href="#" onclick="window.open('hitorico_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">historico (<?php echo $n_orc_check; ?>)</a></td>
                                    <Td><?php echo $row['razao_social_contr']; ?></Td>
                                    <TD><?php echo $row['atividade']; ?></TD>
                                    <TD><?php echo $row['classificacao']; ?></TD>
                                    <TD><?php echo Formatar::limita_texto(strip_tags($row['descricao_servico_orc']), 200); ?></TD>
                                    <TD><?php //echo $row['novo_cliente'];  ?></TD>
                                    <TD><?php echo $row['n_orc'] . "." . $row['ano_orc']; ?></TD>
                                    <TD><?php echo $row['prazo_exec_orc']; ?></TD>
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




