<?php

require '../../../classes/Config.inc.php';

session_start();

$login = new Login();

if (!$login->checkLogin()) {
    WSErro("Você não esta Logado!", WS_ALERT);
} else {
    $userlogin = $login->getSession();
}

$id_orcamento = filter_input(INPUT_GET, 'id_orc', FILTER_VALIDATE_INT);
if (empty($id_orcamento)) {

    WSErro("Erro na URL!", WS_ALERT);
    die;
}

$empresaCtrl = new EmpresaCtrl();
$empresaDao = $empresaCtrl->buscarEmpresa("*", "WHERE id = 2");


$orcCtrl = new OrcamentoCtrl();
$orcamento = $orcCtrl->buscarOrcamentoPorId("*", "WHERE id = '$id_orcamento' LIMIT 1");
//   var_dump($orcamento);


$n_orc = $orcamento->getNOrc();
$ano_orc = $orcamento->getAnoOrc();
$descricao_orc = $orcamento->getDesciServicoObra();
$contato_contra = $orcamento->getContatoCliente();

//dados Contratante
$razao_contra = $orcamento->getRazaoSocialContrat();
$endereco_contr = $orcamento->getEnderecoContrat();
$bairro_contr = $orcamento->getBairroContrat();
$cidade_contr = $orcamento->getCidadeContrat();
$estado_contr = $orcamento->getEstadoContrat();
$cep_contrat = $orcamento->getCepContrat();
$tel_contr = $orcamento->getTelContrat();
$cel_contr = $orcamento->getCelContrat();
$email_contr = $orcamento->getEmailContrat();

$n_da_proposta = "$n_orc.$ano_orc";

$razao_reduzida = Formatar::limita_texto("$razao_contra", 30);
$descricao_reduzida = Formatar::limita_texto("$descricao_orc", 30);
$title = "ORC - $n_orc ( $razao_reduzida - $descricao_reduzida )";

$endereco_completo = "$endereco_contr - $bairro_contr - $cep_contrat - $cidade_contr-$estado_contr";


if ($cel_contr == "" && $email_contr == "") {
    $contato_completo = "$contato_contra - $tel_contr";
} else if ($cel_contr == "" && $email_contr <> "") {
    $contato_completo = "$contato_contra - $tel_contr - $email_contr";
} else if ($cel_contr <> "" && $email_contr == "") {
    $contato_completo = "$contato_contra - $tel_contr - $cel_contr";
} else {

    $contato_completo = "$contato_contra - $tel_contr - $cel_contr - $email_contr";
}

//dados Obra
$razao_obra = $orcamento->getRazaoSocialObra();
$endereco_obra = $orcamento->getEnderecoObra();
$bairro_obra = $orcamento->getBairroObra();
$cidade_obra = $orcamento->getCidadeObra();
$estado_obra = $orcamento->getEstadoObra();
$tel_obra = $orcamento->getTelObra();
$cel_obra = $orcamento->getCelObra();
$email_obra = $orcamento->getEmailObra();

$endereco_completo_obra = "$endereco_obra - $bairro_obra - $cidade_obra-$estado_obra";

if ($cel_obra == "" && $email_obra == "") {
    $contato_completo_obra = "  - $tel_obra";
} else if ($cel_obra == "" && $email_obra <> "") {
    $contato_completo_obra = "  - $tel_obra - $email_obra";
} else if ($cel_obra <> "" && $email_obra == "") {
    $contato_completo_obra = "  - $tel_obra - $cel_obra";
} else {

    $contato_completo_obra = "  - $tel_obra - $cel_obra - $email_obra";
}

//at5v5dade
$atividade = $orcamento->getAtividade();
$classificacao = $orcamento->getClassificacao();
$quantidade = $orcamento->getQuantidade();
$unidade = $orcamento->getUnidade();

$atividade_completo = "$atividade - $classificacao";

//valor da proposta
if (strpos($orcamento->getVrServico(), ',')) {     //VERIFICA SE TEM , NA NUMERAÇÃO
    $vr_servco_orc = $orcamento->getVrServico();
} else {
    $vr_servco_orc = number_format($orcamento->getVrServico(), '2', ',', '.');
}

if (strpos($orcamento->getVrMaterial(), ',')) {     //VERIFICA SE TEM , NA NUMERAÇÃO
    $vr_material_orc = $orcamento->getVrMaterial();
} else {
    $vr_material_orc = number_format($orcamento->getVrMaterial(), '2', ',', '.');
}

$desconto_orc = $orcamento->getDesconto();
$vr_total_orc = number_format($orcamento->getVrTotal(), '2', ',', '.');

if ($desconto_orc == "" || $desconto_orc == null) {


    $valor_completo_orc = "Valor do serviço: R$ $vr_servco_orc &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Valor do material: R$ $vr_material_orc &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Valor total: R$ $vr_total_orc";
} else {
    $valor_completo_orc = "Valor do serviço: R$ $vr_servco_orc  &nbsp;   Valor do material: R$ $vr_material_orc   &nbsp;  Valor do desconto: R$ $desconto_orc  &nbsp;   Valor total: R$ $vr_total_orc";
}


//condições
$prazo_exec_orc = $orcamento->getPrazoExec();
$validade_orc = $orcamento->getValidade();
$pagamento_orc = $orcamento->getPagamento();

$prazo_validade_completo_orc = "Prazo para execução: $prazo_exec_orc dias &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Validade da proposta: $validade_orc dias";
$pagamento_completo_orc = "Condições de pagamento: $pagamento_orc";

//Observações
$obs_orc = $orcamento->getObs();

//duvidas
$duvida_orc = $orcamento->getDuvida();



if ($orcamento->getDataUltimaAlteracao() == "0000-00-00 00:00:00") {
    $data_alterado = "Fortaleza, Ce em  " . Formatar::formatarDataComHora($orcamento->getDataDoOrc());
} else {
    $data_alterado = "Fortaleza, Ce em  " . Formatar::formatarDataComHora($orcamento->getDataUltimaAlteracao());
}

$cnpj_formatado = Formatar::formatTelCnpjCpf($empresaDao->getCnpj());
$cep_formatado = Formatar::formatTelCnpjCpf($empresaDao->getCep());
$tel_formatado = Formatar::formatTelCnpjCpf($empresaDao->getTel());


//Footer
$rodape_pg = "CNPJ {$cnpj_formatado} - {$empresaDao->getEndereco()} - {$empresaDao->getBairro()} - {$empresaDao->getCidade()} - {$empresaDao->getEstado()} - Fone: {$tel_formatado} - Fax: (85) 3227.6068"
        . " - CEP: {$cep_formatado} - {$empresaDao->getEmail_tec()} - www.elfiservice.com.br";



// #####  GENERATE PDF TO SCREEN  #####
$pdf = new PDF($rodape_pg);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Arial', '', 7);
$pdf->Cell(100, 5, $empresaDao->getRazao_social(), 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(90, 5, 'Proposta ' . $n_da_proposta, 0, 0, 'R');
$pdf->Ln(10);
//dados do contratante
$pdf->divisorHeader('Dados do Contratante');
//linha 1
$pdf->Cell(25, 5, 'Razao Social:', 0, 0, 'L');
$pdf->MultiCell(165, 5, utf8_decode($razao_contra), 0, 'L');
$pdf->Cell(25, 5, 'CNPJ:', 0, 0, 'L');
$pdf->Cell(28, 5, $orcamento->getCnpjContrat(), 0, 1, 'L');
//linha 2 endereco
$pdf->Cell(25, 5, 'Endereco:', 0, 0, 'L');
$pdf->Cell(165, 5, utf8_decode($endereco_completo), 0, 1, 'L');
//linha 3 contatos
$pdf->Cell(25, 5, 'Contato:', 0, 0, 'L');
$pdf->Cell(165, 5, utf8_decode($contato_completo), 0, 1, 'L');

//dados da OBRA
$pdf->divisorHeader('Dados da Obra');
if ($email_obra == "" && $razao_obra == "") {
    $pdf->Cell(0, 5, 'Dados da Obra iguais aos do Contratante', 0, 1, 'C');
} else {
    //linha 1
    $pdf->Cell(25, 5, 'Razao Social:', 0, 0, 'L');
    $pdf->Cell(120, 5, utf8_decode($razao_obra), 0, 0, 'L');
    $pdf->Cell(15, 5, 'CNPJ:', 0, 0, 'L');
    $pdf->Cell(30, 5, $orcamento->getCnpjObra(), 0, 1, 'L');
    //linha 2 endereco
    $pdf->Cell(25, 5, 'Endereco:', 0, 0, 'L');
    $pdf->Cell(165, 5, utf8_decode($endereco_completo_obra), 0, 1, 'L');
    //linha 3 contatos
    $pdf->Cell(25, 5, 'Contato:', 0, 0, 'L');
    $pdf->Cell(165, 5, utf8_decode($contato_completo_obra), 0, 1, 'L');
}

//Atividade / classificacao
$pdf->divisorHeader("Atividade / Classificacao");
$pdf->Cell(190, 5, utf8_decode($atividade_completo), 0, 1, 'L');

//descricao do servico
$pdf->divisorHeader("Descricao dos Servicos");
$pdf->MultiCell(190, 4, utf8_decode(strip_tags($descricao_orc)), 0, 'L');

//valor da propota
$pdf->divisorHeader('Valor da Proposta');
$pdf->Cell(190, 5, utf8_decode(str_replace("&nbsp;", " ", $valor_completo_orc)), 0, 1, 'L');

//condicoes
$pdf->divisorHeader('Condicoes');
$pdf->Cell(190, 5, utf8_decode(str_replace("&nbsp;", " ", $prazo_validade_completo_orc)), 0, 1, 'L');
$pdf->Cell(190, 5, utf8_decode(str_replace("&nbsp;", " ", $pagamento_completo_orc)), 0, 1, 'L');

//observao
if ($obs_orc != "") {
    $pdf->divisorHeader('Observacao');
    $pdf->MultiCell(190, 5, utf8_decode(strip_tags($obs_orc)), 0, 'L');
}

//duvidas e necogiacoes
$pdf->divisorHeader('Duvidas / Negociacoes');
$pdf->MultiCell(190, 5, utf8_decode(strip_tags($duvida_orc)), 0, 'L');

//assinaturas
$pdf->divisorHeader('Assinaturas');
$pdf->Ln(20);
$pdf->Cell(10, 1, '', 0, 0, 'C');
$pdf->Cell(80, 1, '', 'B', 0, 'C');
$pdf->Cell(10, 1, '', 0, 0, 'C');
$pdf->Cell(80, 1, '', 'B', 0, 'C');
$pdf->Cell(10, 1, '', 0, 0, 'C');
$pdf->Ln(5);
$pdf->Cell(100, 1, 'Elfi / Carimbo', 0, 0, 'C');
$pdf->Cell(90, 1, 'De acordo / Carimbo', 0, 0, 'C');

$pdf->Ln(15);
//Data
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(190, 5, utf8_decode(strip_tags($data_alterado)), 0, 'C');


$pdf->Output('I', utf8_decode(strip_tags($title)) . '.pdf');
