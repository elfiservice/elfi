<div>
    <h2><a href="tecnico.php?id_menu=cliente">Cliente</a> -> Perfil </h2>
</div>
<hr>        
<?php
if (filter_has_var(INPUT_GET, 'id_cliente')) {

    $id_cliente = filter_input(INPUT_GET, 'id_cliente', FILTER_VALIDATE_INT);
    if (!$id_cliente) {
        WSErro('Erro na URL', E_USER_WARNING);
        exit();
    }
} else {
    WSErro('Erro na URL', E_USER_WARNING);
    exit();
}

if (filter_has_var(INPUT_GET, 'tipo_cliente')) {

    $tipo_cliente = filter_input(INPUT_GET, 'tipo_cliente');
    //var_dump($tipo_cliente);

    if ($tipo_cliente <> 'PJ' && $tipo_cliente <> 'PF') {

        WSErro('Erro na URL', E_USER_WARNING);
        exit();
    }
} else {
    WSErro('Erro na URL', E_USER_WARNING);
    exit();
}

//$usuario_logado = new Usuario($logOptions_id);

$cliente = new ClienteCtrl();
$clienteFinal = $cliente->buscar("*", "WHERE id = $id_cliente AND tipo = '$tipo_cliente'");
//var_dump($clienteFinal);

if (!$clienteFinal) {
    WSErro('Cliente não encontrado: Erro na URL', E_USER_WARNING);
    exit();
}
?>
<section>
    <fieldset>
        <legend><b>Dados do Cliente: <?php echo $clienteFinal->getRazaoSocial(); ?></b></legend>
        <table>
            <tr>
                <td>Cod:</td>
                <td><?php echo $clienteFinal->getId() . " - TIPO: " . $clienteFinal->getClassificacao(); ?></td>
            </tr>
            <tr>
                <td>Razão Social:</td>
                <td><?php echo $clienteFinal->getRazaoSocial(); ?></td>
            </tr>
            <tr>
                <td>CNPJ/CPF:</td>
                <td><?php
                    if ($tipo_cliente == "PJ") {
                        echo $clienteFinal->getCnpj();
                    } else {
                        echo $clienteFinal->getCpf();
                    }
                    ?></td>
            </tr>     
            <tr>
                <td>IE:</td>
                <td><?php echo $clienteFinal->getIe(); ?></td>
            </tr>                    
            <tr>
                <td>Endereço:</td>
                <td><?php echo $clienteFinal->getEndereco() . ", " . $clienteFinal->getBairro() . ", CEP: " . $clienteFinal->getCep() . ", " . $clienteFinal->getCidade() . ", " . $clienteFinal->getEstado(); ?></td>
            </tr>

            <tr>
                <td>Email Técnico:</td>
                <td><?php echo $clienteFinal->getEmailTec(); ?></td>
            </tr>
            <tr>
                <td>Email Admin:</td>
                <td><?php echo $clienteFinal->getEmailAdmFin(); ?></td>
            </tr>
            <tr>
                <td>Tel:</td>
                <td><?php echo $clienteFinal->getTel(); ?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><?php echo $clienteFinal->getCel(); ?></td>
            </tr>
            <tr>
                <td>Data de inclusão:</td>
                <td><?php echo Formatar::formatarDataComHora($clienteFinal->getDataAdd()); ?></td>
            </tr>

            <tr>
                <td>Satisfação geral do cliente:</td>
                <td>implementar</td>
            </tr>        
        </table>
        <div>
            <section>
                <h4>Quantidade de Orçamentos:</h4>
                <div class="col-md-3" >
                    <?php
                    $orcCtrl = new OrcamentoCtrl();
                    $orcPorClienteSituacaoAguardando = $orcCtrl->buscarOrcamentos("situacao_orc", "WHERE id_cliente = '$id_cliente' AND situacao_orc = 'Aguardando Aprovação' ");
                    $orcPorClienteSituacaoAprovado = $orcCtrl->buscarOrcamentos("situacao_orc", "WHERE id_cliente = '$id_cliente' AND situacao_orc = 'Aprovado' ");
                    $orcPorClienteSituacaoConcluido = $orcCtrl->buscarOrcamentos("situacao_orc", "WHERE id_cliente = '$id_cliente' AND situacao_orc = 'concluido' ");
                    $orcPorClienteSituacaoCancelado = $orcCtrl->buscarOrcamentos("situacao_orc", "WHERE id_cliente = '$id_cliente' AND situacao_orc = 'Cancelado' ");
                    $orcPorClienteSituacaoPerdido = $orcCtrl->buscarOrcamentos("situacao_orc", "WHERE id_cliente = '$id_cliente' AND situacao_orc = 'Perdido' ");

                    $totalOrcCliente = count($orcPorClienteSituacaoPerdido) + count($orcPorClienteSituacaoCancelado) + count($orcPorClienteSituacaoConcluido) + count($orcPorClienteSituacaoAprovado) + count($orcPorClienteSituacaoAguardando);
                    $aguardandoPercent = (count($orcPorClienteSituacaoAguardando) / $totalOrcCliente) * 100;
                    $aprovadoPercent = (count($orcPorClienteSituacaoAprovado) / $totalOrcCliente) * 100;
                    $concluidoPercent = (count($orcPorClienteSituacaoConcluido) / $totalOrcCliente) * 100;
                    $canceladoPercent = (count($orcPorClienteSituacaoCancelado) / $totalOrcCliente) * 100;
                    $perdidoPercent = (count($orcPorClienteSituacaoPerdido) / $totalOrcCliente) * 100;
                    ?>

                    <ul class="w3-ul w3-border ">
                        <li><span class="w3-badge w3-blue-grey w3-right"><?= "{$aguardandoPercent}%" ?></span><span class="w3-badge w3-blue-grey w3-right"><?= count($orcPorClienteSituacaoAguardando) ?></span> Aguardando Aprovação</li>
                        <li ><span class="w3-badge w3-blue-grey w3-right"><?= "{$aprovadoPercent}%" ?></span><span class="w3-badge w3-blue-grey w3-right"><?= count($orcPorClienteSituacaoAprovado) ?></span> Aprovados</li> 
                        <li ><span class="w3-badge w3-blue-grey w3-right"><?= "{$concluidoPercent}%" ?></span><span class="w3-badge w3-blue-grey w3-right"><?= count($orcPorClienteSituacaoConcluido) ?></span> Concluidos</li> 
                        <li ><span class="w3-badge w3-blue-grey w3-right"><?= "{$canceladoPercent}%" ?></span><span class="w3-badge  w3-blue-grey w3-right"><?= count($orcPorClienteSituacaoCancelado) ?></span> Cancelados</li> 
                        <li ><span class="w3-badge w3-blue-grey w3-right"><?= "{$perdidoPercent}%" ?></span><span class="w3-badge w3-blue-grey w3-right"><?= count($orcPorClienteSituacaoPerdido) ?></span> Perdidos</li> 
                        <li class=""><span class="w3-badge w3-blue-grey w3-right">100%</span><span class="w3-badge w3-blue-grey w3-right"><?= $totalOrcCliente ?></span> Total</li> 
                    </ul>
                </div>
            </section>
        </div>


    </fieldset>

    <fieldset>
        <legend><b>Orçamentos (Todos os Anos) </b></legend>	



        <TABLE class="display" id="example"  >
            <thead>
                <TR>

                    <TH>Nº ORC</TH>
                    <TH>Situação</TH>
                    <TH>Atividade</TH>
                    <TH>Classificação</TH>
                    <TH>Valor</TH>
                    <TH>Pos-Venda e Historicos  (por se satisfeito ou nao e  Bt historico_completo_orc.php)</TH>




                </TR>
            </thead>
            <tbody>
<?php
$valor_total = 0;

$nome_cliente = $clienteFinal->getRazaoSocial();

$orcamentos = $orcCtrl->buscarOrcamentos("*", "WHERE  id_cliente = '$id_cliente'  ");
if ($orcamentos) {
    foreach ($orcamentos as $row) {
        // var_dump($row);
        $id_orc = $row['id'];
        $n_orc = $row['n_orc'];
        $ano_orc = $row['ano_orc'];
        $valor_orc = $row['vr_total_orc'];
        $inf_servicos = $row['descricao_servico_orc'];

        $valor_total = $valor_total + $valor_orc;

        echo "<TR><TD align=\"center\">" . $n_orc . "." . $ano_orc . "</TD><td> </td> <td>" . $row['atividade'] . "</td> <TD align=\"center\">" . $row['classificacao'] . "</TD><td>" . number_format($valor_orc, 2, ',', '.') . "</td><td>--</td></TR>";
    }
}
?>  
            </tbody>
        </TABLE>
                <?php echo "Valor Total dos Orçamentos Executados: <b>R$ " . number_format($valor_total, 2, ',', '.') . "</b>"; ?>
    </fieldset>	

</section>

