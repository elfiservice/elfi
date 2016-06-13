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


<!--            <li><a class="bt_link" href="#" onclick="window.open('email_situacao_orc.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
                    Enviar Situação Orc.
                </a>
            </li>-->
            <li>
<!--                <a href="#" onclick="window.open('acompanhamento.php?mes=jan&ano_orc=<?php //echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
                    JAN
                </a>-->
                <
               
            <form name="orc_aprovado_por_mes" action="tecnico.php" method="POST" enctype="multipart/form-data">
                Selecionar por Mês:
                <select name="mes_orc_aprovado" id="mes_orc_aprovado" >
                    <option id="opcao" value=""></option>
                        ﻿<option value="1">Jan</option>
                        <option value="2">Fev  </option>
                        <option value="3">  Mar </option>
                        <option value="4">  Abr </option>
                        <option value="5">  Mai </option>
                        <option value="6">  Jun </option>
                        <option value="7">  Jul </option>
                        <option value="8">  Ago </option>
                        <option value="9">  Set </option>
                        <option value="10">  Out </option>
                        <option value="11">  Nov </option>
                        <option value="12">  Dez </option>
                </select>
                <input type="submit" value="Pesquisar" name="ir_orc_aprovado_por_mes" id="ir_orc_aprovado_por_mes"  />

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
            ?>
                                <TR>
                                    <td><a class="bt_link" href="tecnico.php?id_menu=editar_orc_aprovado&id_orc=<?=$row['id']?>" >atualizar</a><br>
                                       <a class="bt_link" href="tecnico.php?id_menu=hitorico_orc_aprovado&id_orc=<?=$row['id']?>" >historico (<?php echo $n_orc_check; ?>)</a></td>
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
            $orcHistorico = $orcCtrl->buscarHistoricoOrcamento("*", "WHERE id_acompanhamento = '$id_orc' AND mostrar = '0'", "historico_orc_aprovado");
            $n_orc_check = count($orcHistorico);
            ?>
                                <TR>
                                    <td><a class="bt_link" href="tecnico.php?id_menu=editar_orc_aprovado&id_orc=<?=$row['id']?>" >atualizar</a><hr>
                                        <a class="bt_link" href="tecnico.php?id_menu=hitorico_orc_aprovado&id_orc=<?=$row['id']?>" >historico (<?php echo $n_orc_check; ?>)</a></td>
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
            $orcHistorico = $orcCtrl->buscarHistoricoOrcamento("*", "WHERE id_acompanhamento = '$id_orc' AND mostrar = '0'", "historico_orc_aprovado");
            $n_orc_check = count($orcHistorico);
            ?>
                                <TR>
                                    <td><a class="bt_link" href="tecnico.php?id_menu=editar_orc_aprovado&id_orc=<?=$row['id']?>" >atualizar</a><br>
                                        <a class="bt_link" href="tecnico.php?id_menu=hitorico_orc_aprovado&id_orc=<?=$row['id']?>" >historico (<?php echo $n_orc_check; ?>)</a></td>
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




