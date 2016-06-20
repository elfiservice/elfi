<?php
$id_orc = filter_input(INPUT_GET, 'id_orc', FILTER_VALIDATE_INT);
if ($id_orc) {

    $orcamentoCtrl = new OrcamentoCtrl();
    $orcObj = $orcamentoCtrl->buscarOrcamentoPorId("*", "WHERE id = $id_orc");
    if (!$orcObj) {

        WSErro("Orçamento não encontrado!", WS_ALERT);
        die();
    }
} else {
    WSErro("Erro na URL!", WS_ERROR);
    die();
}
?>

<div>
    <h2><a href="tecnico.php?id_menu=orcamento">Orçamento</a> -> Histórico Orçamento Completo</h2>
</div>
<hr>
<fieldset>
    <legend><b>Dados do Orçamento <span class="bt_vermelho"><?= $orcObj->getSituacaoOrc() ?></span></b></legend>
    <div >
        <h3> Orçamento Nº <?php echo $orcObj->getNOrc() . "." . $orcObj->getAnoOrc(); ?> - Cliente: <?= $orcObj->getRazaoSocialContrat(); ?></h3>

        <p>Nome de contato: <b><?= $orcObj->getContatoCliente() ?></b> </p>
        <p>Telefone de contato: <b><?= $orcObj->getTelContrat(); ?></b></p>
        <p>Data da Proposta: <b><?= Formatar::formatarDataSemHora($orcObj->getDataDoOrc()); ?></b></p>
        <p>Novo cliente? <b><?= $orcObj->getNovo_cliente(); ?></b></p>
        <?php
        //VERIFICA SE A PROPOSTA FOI CONCLUIDA OU PERDIDA OU CANCELADA
        if ($orcObj->getDataAprovada() != "0000-00-00") {
            ?>
            <p>Data Aprovado: <b><?= Formatar::formatarDataSemHora($orcObj->getDataAprovada()); ?></b></p>
            <p> Data Inicio: <b><?= Formatar::formatarDataSemHora($orcObj->getDataInicio()); ?></b></p>
            <p>Data Conclusão: <b><?= Formatar::formatarDataSemHora($orcObj->getDataConclusao()); ?></b></p>
            <p>Dias de execução: <b><?= $orcObj->getDiasDExecucao() ?> dia(s)</b></p>
            <p>Dias de atraso: <b><?= $orcObj->getDiasUltrapassado() ?> dia(s)</b></p>
            <p>Não conformidade? <b><?= $orcObj->getNaoConformidade() ?></b></p>
            <p>Obs. da Não conformidade: <b><?= $orcObj->getObsNConformidade() ?></b></p>

            <div>
                <h3>Pesquisa Pós entrega do serviço:</h3>
                <?php
                if ($orcObj->getFeitoPosEntrega() == 's') {
                $pesquisaCtrl = new PesquisaPosVendaCtrl();
                $pesquisa = $pesquisaCtrl->buscarControleNOrc("*", "WHERE id_orc = '$id_orc' ");
                foreach ($pesquisa as $itemPesquisa) {
                    ?>
                    <div>
                        <h4>1. Desempenho:</h4>
                        <p>
                            Confiabilidade: <b><?= ($itemPesquisa->getConfiabilidade() == 0 ? "<span class=\"bt_vermelho\">Ruim/Regular</span>" : "Bom/Ótimo") ?></b>
                            |
                            Pontualidade: <b><?= ($itemPesquisa->getPontualidade() == 0 ? "<span class=\"bt_vermelho\">Ruim/Regular</span>" : "Bom/Ótimo") ?></b>
                            |
                            Disponibilidade: <b><?= ($itemPesquisa->getDisponibilide() == 0 ? "<span class=\"bt_vermelho\">Ruim/Regular</span>" : "Bom/Ótimo") ?></b>
                            |
                            Qualidade: <b><?= ($itemPesquisa->getQualidade() == 0 ? "<span class=\"bt_vermelho\">Ruim/Regular</span>" : "Bom/Ótimo") ?></b>
                            |
                            Atendimento às normas de segurança: <b><?= ($itemPesquisa->getNormasseguranca() == 0 ? "<span class=\"bt_vermelho\">Ruim/Regular</span>" : "Bom/Ótimo") ?></b>                            
                            
                        </p>
                    </div>
                    <div>
                        <h4>2. Atendimento:</h4>
                        <p>
                            Apresentação: <b><?= ($itemPesquisa->getApresentacao() == 0 ? "<span class=\"bt_vermelho\">Ruim/Regular</span>" : "Bom/Ótimo") ?></b>
                            |
                            Envolvimento: <b><?= ($itemPesquisa->getEnvolvimento() == 0 ? "<span class=\"bt_vermelho\">Ruim/Regular</span>" : "Bom/Ótimo") ?></b>
                            |
                            Educação: <b><?= ($itemPesquisa->getEducacao() == 0 ? "<span class=\"bt_vermelho\">Ruim/Regular</span>" : "Bom/Ótimo") ?></b>

                        </p>
                    </div>
                    <div>
                        <h4>3. Andamento dos Serviços :</h4>
                        <p>
                            Organização: <b><?= ($itemPesquisa->getOrganizacao() == 0 ? "<span class=\"bt_vermelho\">Ruim/Regular</span>" : "Bom/Ótimo") ?></b>
                            |
                            Competência Técnica: <b><?= ($itemPesquisa->getCompetencia() == 0 ? "<span class=\"bt_vermelho\">Ruim/Regular</span>" : "Bom/Ótimo") ?></b>
                        </p>
                    </div>        
                    <div>
                        <h4>4. Atendimento aos prazos estabelecidos:</h4>
                        <p>
                            Entrega do Orçamento: <b><?= ($itemPesquisa->getOrcamento() == 0 ? "<span class=\"bt_vermelho\">Ruim/Regular</span>" : "Bom/Ótimo") ?></b>
                            |
                            Competência Técnica: <b><?= ($itemPesquisa->getServico() == 0 ? "<span class=\"bt_vermelho\">Ruim/Regular</span>" : "Bom/Ótimo") ?></b>
                        </p>
                    </div>     
                    <div>
                        <h4>5. Em geral, ficou satisfeito?</h4>
                        <p>
                            <b><?= ($itemPesquisa->getOrcamento() == 0 ? "<span class=\"bt_vermelho\">Não</span>" : "Sim") ?></b>

                        </p>
                    </div>           
                    <div>
                        <h4>6. Outros comentarios:</h4>
                        <p>
                            <b><?= ($itemPesquisa->getOutrosComentarios() == "" ? "<small><i>Não deixou</i></small>" : $itemPesquisa->getOutrosComentarios()) ?></b>

                        </p>
                    </div>                 



                    <?php
                 }
                } else {
                    echo"<p><i> Pesquisa ainda não respondida pelo Cliente </i></p>";
                }
                ?>
            </div>
            <?php
        }
        ?>
    </div>
</fieldset>	

<fieldset>
    <legend><b>Historico Antes da Aprovação</b></legend>
    <TABLE  class="display" id="example2">
        <thead>
            <TR>

                <TH>Data</TH>
                <TH>Colaborador ELFI</TH>
                <TH>Contato Cliente</TH>
                <TH>Telefone Cliente</TH>
                <TH>Conversa</TH>
            </TR>
        </thead>
        <tbody>

            <?php
            $hitorico_orc = $orcamentoCtrl->buscarHistoricoOrcamento("*", "WHERE id_orc = '$id_orc' ORDER BY id DESC", "historico_orc_n_aprovado");
            if ($hitorico_orc) {
                foreach ($hitorico_orc as $row) {
                    ?>
                    <TR>

                        <Td><?php echo date('d/m/Y à\s H:m', strtotime($row['dia_do_contato'])); ?></Td>
                        <TD><?php echo $row['colab_elfi']; ?></TD>
                        <TD><?php echo $row['contato_cliente']; ?></TD>
                        <TD><?php echo $row['tel_cliente']; ?></TD>
                        <TD><?php echo $row['conversa']; ?></TD>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </TABLE>
</fieldset>


<fieldset>
    <legend><b>Historico Depois da Aprovação</b></legend>
    <TABLE  class="display" id="example3">
        <thead>
            <TR>

                <TH>Data</TH>
                <TH>Descrição</TH>
                <TH>Colaborador</TH>

            </TR>
        </thead>
        <tbody>

            <?php
            $histoORc = $orcamentoCtrl->buscarHistoricoOrcamento("*", "WHERE id_acompanhamento = '$id_orc' AND mostrar= '0' ORDER BY id DESC", "historico_orc_aprovado");
            if ($histoORc) {
                foreach ($histoORc as $row) {
                    ?>
                    <tr>

                        <td><?= Formatar::formatarDataSemHora($row['data']); ?></td>
                        <td><?php echo $row['descricao']; ?></td>
                        <td><?php echo $row['colaborador']; ?></td>


                    </tr>


                    <?php
                }
            }
            ?>

        </tbody>
    </TABLE>		
</fieldset>


