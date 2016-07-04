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
    <h2><a href="tecnico.php?id_menu=orcamento">Orcamentos</a> ->  Relatórios</h2>
</div>
<hr>
<div class="alinhamentoHorizontal">
    <ul>
        <li>
            <form name="rel_pos_venda" action="tecnico.php?id_menu=relatorio_pos_venda" method="POST" enctype="multipart/form-data">
                <input class="bt_incluir"  type="submit" value="Pos-venda" name="nrel_pos_venda_btn" />
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
        <legend>Orçamentos Aprovados</legend>

        <TABLE border="1" class="tableComum" >
            <thead>
                <TR>

                    <TH>MÊS</TH>
                    <TH>ORC APROVADOS</TH>
                    <TH>TOTAL ORC NO MêS</TH>
                    <TH>% ORC APROVADOS NO MêS</TH>

                </TR>
            </thead>
            <tbody>

                <?php
//$ano_orc = date('Y');

                $total = 0;
                $total_orc_feitos = 0;

                for ($i = 1; $i <= 12; $i++) {

//consulta Nºde ORC aprovados no mes 
                    $orcs_aprovados = $orcCrtl->buscarOrcamentos("*", "WHERE MONTH(data_aprovada) = '$i' AND YEAR(data_aprovada) = '$ano_orc_selec' ");
                    $n_linhas_orc_aprovados = count($orcs_aprovados);

                    $mes_atual = date('m');

                    if ($i > $mes_atual) {

                        $n_orc_feitos_no_mes = 0;
                    } else {
//selecionar controles
                        $orc_por_mes = $orcCrtl->buscarOrcamentos("*", "WHERE MONTH(data_adicionado_orc)  = '$i' AND YEAR(data_adicionado_orc) = '$ano_orc_selec' ");
                        $n_orc_feitos_no_mes = count($orc_por_mes);
                    }

                    if ($n_orc_feitos_no_mes == 0) {
                        $em_porcentagem = 0;
                    } else {

                        $em_porcentagem = ($n_linhas_orc_aprovados / $n_orc_feitos_no_mes) * 100;
                    }

                    echo "<TR align=\"center\"><TD class=\"indiceTabelaComum \">" . $i . "</TD> <TD>" . $n_linhas_orc_aprovados . "</TD> <TD>" . $n_orc_feitos_no_mes . "</TD> <TD>" . number_format($em_porcentagem, 2, '.', '') . "%</TD> </TR>";

                    $total = $total + $n_linhas_orc_aprovados;
                    $total_orc_feitos = $total_orc_feitos + $n_orc_feitos_no_mes;
                }
                ?>	



            </tbody>
        </TABLE>	

        <?php
        echo "<br>Total propostas Aprovadas: " . $total . " de " . $total_orc_feitos . " feitas<br>";
        ?>	
    </fieldset>
    <fieldset>
        <legend>Principais Clientes Por Ano Selecionado: <span style="color: red;"><?= $ano_orc_selec ?></span></legend>	


        <TABLE class="display" id="example"  >
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

                    if ($total == 0) {
                        $em_porcentagem_aprovados = 0;
                    } else {

                        $em_porcentagem_aprovados = ($totalAprovados / $total) * 100;
                    }


                    echo "<TR align=\"center\"><TD><a href=\"tecnico.php?id_menu=perfil_cliente&id_cliente={$id_cliente}&tipo_cliente={$tipo_cliente}\">" . $nome_cliente . "</a></TD> <td>" . $total . "</td><td>{$totalAprovados} </td><td> {$em_porcentagem_aprovados}% </td></TR>";
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


                    echo "<TR align=\"center\"><TD><a href=\"tecnico.php?id_menu=perfil_cliente&id_cliente={$id_cliente}&tipo_cliente={$tipo_cliente}\">" . $nome_cliente . "</a></TD> <td>" . $total . "</td><td>{$totalAprovados} </td><td> {$em_porcentagem_aprovados}% </td></TR>";
                }
                ?>  
            </tbody>
        </TABLE>
    </fieldset>	
