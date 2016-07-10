<?php

/*
 * Gerar relatorios e estatisticas sobre os Orçamentos Aprovados do Sistema PARA CLIENTES
 * 
 */

$ano_orc_selec = date('Y');

if (filter_has_var(INPUT_POST, 'ano')) {

    $ano_orc_selec = filter_input(INPUT_POST, 'ano', FILTER_VALIDATE_INT); //pega o Ano ao selecionar o ANO
}

$orcCrtl = new OrcamentoCtrl();
?>
<div>
    <h2><a href="tecnico.php?id_menu=orcamento">Orcamentos</a> -> <a href="tecnico.php?id_menu=relatorios_orc"> Relatórios</a> -> Clientes</h2>
</div>
<hr>


<fieldset>
    <legend>Busca por ano</legend>
    <!-- form Trocar ANO -->
    <div><!-- form Trocar ANO -->
        <form action="tecnico.php?id_menu=relatorios_cliente" method="post" enctype="multipart/form-data" name="formAgenda">
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
        <legend>Principais Clientes Por Ano Selecionado: <span style="color: red;"><?= $ano_orc_selec ?></span></legend>	


        <TABLE class="display" id="example"  >
            <thead>
                <TR>

                    <TH>Cliente</TH>
                    <TH>Nº Propostas Feitas</TH>
                    <TH>Aprovadas</TH>
                   <TH>Canceladas</TH>
<TH>Perdidas</TH>
<TH>Concluidas</TH>


                </TR>
            </thead>
            <tbody>
                <?php
                $clienteCtrl = new ClienteCtrl();
                $clientes = $clienteCtrl->buscarCliente("*", "clientes");

                foreach ($clientes as $row) {
                    $id_cliente = $row['id'];
                    $tipo_cliente = $row['tipo'];
                    $nome_cliente = $row['razao_social'];

                    $orcPorCliente = $orcCrtl->buscarOrcamentos("*", "WHERE razao_social_contr = '$nome_cliente' AND ano_orc='$ano_orc_selec' ");
                    $total = count($orcPorCliente);
                    $orcPorClienteAprovados = $orcCrtl->buscarOrcamentos("*", "WHERE razao_social_contr = '$nome_cliente' AND ano_orc='$ano_orc_selec' AND situacao_orc = 'Aprovado' ");
                    $totalAprovados = count($orcPorClienteAprovados);

                    $orcPorClienteCancelado = $orcCrtl->buscarOrcamentos("*", "WHERE razao_social_contr = '$nome_cliente' AND ano_orc='$ano_orc_selec' AND situacao_orc = 'Cancelado' ");
                    $totalCancelado = count($orcPorClienteCancelado);
                    
                    $orcPorClientePerdido = $orcCrtl->buscarOrcamentos("*", "WHERE razao_social_contr = '$nome_cliente' AND ano_orc='$ano_orc_selec' AND situacao_orc = 'Perdido' ");
                    $totalPerdido = count($orcPorClientePerdido);                    
                  
                    $orcPorClienteConcluido = $orcCrtl->buscarOrcamentos("*", "WHERE razao_social_contr = '$nome_cliente' AND ano_orc='$ano_orc_selec' AND situacao_orc = 'concluido' ");
                    $totalConcluido = count($orcPorClienteConcluido);         
                    

                    if ($total == 0) {
                        $em_porcentagem_aprovados = 0;
                        $em_porcentagem_Can = 0;
                        $em_porcentagem_perd = 0;
                        $em_porcentagem_conc = 0;
                    } else {

                        $em_porcentagem_aprovados = ($totalAprovados / $total) * 100;
                        $em_porcentagem_Can = ($totalCancelado / $total) * 100;
                        $em_porcentagem_perd = ($totalPerdido / $total) * 100;
                        $em_porcentagem_conc = ($totalConcluido / $total) * 100;
                    }
?>
                    <tr align="center">
                        <td><a href="tecnico.php?id_menu=perfil_cliente&id_cliente=<?=$id_cliente?>&tipo_cliente=<?=$tipo_cliente?>"><?= $nome_cliente?></a></td>
                        <td> <?= $total ?></td>
                        <td> <?= $totalAprovados . " - (" . number_format($em_porcentagem_aprovados, 2, '.', '') . "%)" ?></td>
                        <td> <?= $totalCancelado . " - (" . number_format($em_porcentagem_Can, 2, '.', '') . "%)" ?></td>
                        <td> <?= $totalPerdido . " - (" . number_format($em_porcentagem_perd, 2, '.', '') . "%)" ?></td>
                        <td> <?= $totalConcluido . " - (" . number_format($em_porcentagem_conc, 2, '.', '') . "%)" ?></td>
                    </tr>
                    <?php

                }
                ?>  

            </tbody>
        </TABLE>
    </fieldset>


    <fieldset>
        <legend>Clientes Geral (Todos os Anos)</legend>	
        <TABLE class="display" id="example2"  >
            <thead>
                <TR>
                    <TH>Cliente</TH>
                    <TH>Nº Propostas Feitas</TH>
                    <TH>Nº Propostas Aprovadas</TH>
                    <TH>% de Aprovação</TH>

                </TR>
            </thead>
            <tbody>
                <?php
                foreach ($clientes as $row) {
                    $id_cliente = $row['id'];
                    $tipo_cliente = $row['tipo'];
                    $nome_cliente = $row['razao_social'];

                    $orcPorCliente = $orcCrtl->buscarOrcamentos("*", "WHERE razao_social_contr = '$nome_cliente' ");
                    $total = count($orcPorCliente);
                    $orcPorClienteAprovados = $orcCrtl->buscarOrcamentos("*", "WHERE razao_social_contr = '$nome_cliente' AND situacao_orc = 'Aprovado' ");
                    $totalAprovados = count($orcPorClienteAprovados);

                    if ($total == 0) {
                        $em_porcentagem_aprovados = 0;
                    } else {

                        $em_porcentagem_aprovados = ($totalAprovados / $total) * 100;
                    }
?>
                                    <tr align="center">
                        <td><a href="tecnico.php?id_menu=perfil_cliente&id_cliente=<?=$id_cliente?>&tipo_cliente=<?=$tipo_cliente?>"><?= $nome_cliente?></a></td>
                        <td> <?= $total ?></td>
                        <td> <?= $totalAprovados . " - (" . number_format($em_porcentagem_aprovados, 2, '.', '') . "%)" ?></td>
                        <td> <?= number_format($em_porcentagem_aprovados, 2, '.', '')  ?></td>

                    </tr>
                
                <?php

                }
                ?>  
            </tbody>
        </TABLE>
    </fieldset>	
