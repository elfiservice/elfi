<?php

require '../classes/Config.inc.php';


if (isset($_GET['getClientId'])) {
    $clienteCtrl = new ClienteCtrl();
    $cliente = $clienteCtrl->buscar("*", "WHERE razao_social='" . $_GET['getClientId'] . "' ");

    if ($cliente != null) {

        echo "formObj.razao_social.value = '" . $cliente->getRazaoSocial() . "';\n";
        //echo "formObj.cnpj.value = '".Formatar::formatTelCnpjCpf($inf["cnpj_cpf"])."';\n";    
        echo "formObj.cnpj.value = '" . ($cliente->getTipo() == "PJ" ? $cliente->getCnpj() : $cliente->getCpf()) . "';\n";
        echo "formObj.endereco.value = '" . $cliente->getEndereco() . "';\n";
        echo "formObj.bairro.value = '" . $cliente->getBairro() . "';\n";
        echo "formObj.cep.value = '" . $cliente->getCep() . "';\n";
        echo "formObj.tel.value = '" . $cliente->getTel() . "';\n";
        echo "formObj.cel.value = '" . $cliente->getCel() . "';\n";
        echo "formObj.email_orc.value = '" . $cliente->getEmailTec() . "';\n";
        echo utf8_encode("formObj.city.value = '" . $cliente->getCidade() . "';\n");
        echo utf8_encode("formObj.estado.value = '" . $cliente->getEstado() . "';\n");
    } else {
        echo "formObj.razao_social.value = 'ERRO';\n";
        echo "formObj.cnpj.value = '';\n";
        echo "formObj.endereco.value = '';\n";
        echo "formObj.bairro.value = '';\n";
        echo "formObj.cep.value = '';\n";
        echo "formObj.city.value = '';\n";
        echo "formObj.estado.value = '';\n";
        echo "formObj.tel.value = '';\n";
        echo "formObj.cel.value = '';\n";
        echo "formObj.email_orc.value = '';\n";
    }
}
