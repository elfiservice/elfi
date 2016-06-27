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
$orc_ctrl = new OrcamentoCtrl();
$cliente = new ClienteCtrl();
$clienteFinal = $cliente->buscar("*", "WHERE id = $id_cliente AND tipo = '$tipo_cliente'");
//var_dump($clienteFinal);

if (!$clienteFinal) {
    WSErro('Cliente não encontrado: Erro na URL', E_USER_WARNING);
    exit();
}
?>
<div  style="background: url(../imagens/topo1.png) repeat-x;  padding:5px 0px 30px 0px;"></div>
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
    </table>
</fieldset>

<fieldset>
    <legend><h3>Orçamentos Aprovados (todos os Anos)</h3></legend>	



    <TABLE class="display" id="example"  >
        <thead>
            <TR>

                <TH>Nº ORC</TH>

                <TH>Serviço</TH>
                <TH>Valor</TH>



            </TR>
        </thead>
        <tbody>
<?php
$valor_total = 0;
$nome_cliente = $clienteFinal->getRazaoSocial();

$orcCtrl = new OrcamentoCtrl();
$orcamentos = $orcCtrl->buscarOrcamentos("*", "WHERE razao_social_contr = '$nome_cliente' AND situacao_orc = 'Aprovado'");
if ($orcamentos) {
    foreach ($orcamentos as $row) {
        // var_dump($row);
        $id_orc = $row['id'];
        $n_orc = $row['n_orc'];
        $ano_orc = $row['ano_orc'];
        $valor_orc = $row['vr_total_orc'];
        $inf_servicos = $row['descricao_servico_orc'];

        $valor_total = $valor_total + $valor_orc;

        echo "<TR><TD align=\"center\">" . $n_orc . "." . $ano_orc . "</TD> <td>" . Formatar::limita_texto($inf_servicos, 200) . "</td> <TD align=\"center\">" . number_format($valor_orc, 2, ',', '.') . "</TD></TR>";
    }
}
?>  
        </tbody>
    </TABLE>
<?php echo "Valor Total dos Orçamentos Executados: <b>R$ " . number_format($valor_total, 2, ',', '.') . "</b>"; ?>
</fieldset>	




