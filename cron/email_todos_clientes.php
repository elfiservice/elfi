<?php

include '../classes/Config.inc.php';

$ano_orc = date('Y');

$clienteCtrl = new ClienteCtrl();
$clientes = $clienteCtrl->buscarBD("*", "WHERE mostrar = '1' ");

$count = 0;
$count2 = 0;
$countErro = 0;
$textoCorpoErro = "";
foreach ($clientes as $row) {

    if (!$row->getEmailTec() == null) {
                $count2++;
                if($count2 == 5){
                    sleep(3);
                    $count2 = 0;
                }
                

                //$emailTo = array();
                $emailTo = array($row->getEmailTec(), $row->getEmail_adm_fin());
                $assunto = "Estamos à disposição";
                $mensagem = "Que seja uma semana produtiva e com ótimos resultados.<br><br>"
                        . "Já conhece <b>nossos valores</b>? segue abaixo<br><br>"
                        . "<i>Qualidade, confiança, ética, responsabilidade socioambiental, respeito, segurança e trabalho de equipe.</i> <br>";

                $textoCorpo = "Olá, <b>{$row->getRazaoSocial()}</b>, lembramos de você. <br> {$mensagem}";

                $emailCopiaOculta = array();
                //$emailCopiaOculta = array(EMAIL_ADMIN);
                $email2 = new EmailGenerico($emailTo, $assunto, $textoCorpo, array(), $emailCopiaOculta);

                if ($email2->enviarEmailSMTP()) {
                    $count++;
                    echo "OK => {$count}<br>";
                   
                    $f = fopen("registro_email_pos_venda.txt", "a+", 0);
                    $linha = "Email enviado em: " . date('d/m/Y H:i') . " para " . $row->getRazaoSocial() . " Email: " . $row->getEmailTec() . "\r\n";
                    fwrite($f, $linha, strlen($linha));
                    fclose($f);
                } else {
                    $countErro++;
                    $textoCorpoErro .= "- {$row->getId()} == {$row->getRazaoSocial()} == {$row->getEmailTec()}<br>";
                    echo "ERROr => {$row->getId()} - {$row->getRazaoSocial()}<br>";
                }
                
             //   die;
          
  
       
    } else {
        $f = fopen("registro_email_pos_venda.txt", "a+", 0);
        $linha = "Email NÃO enviado em: " . date('d/m/Y H:i') . " para " . $row->getRazaoSocial() . " Email: " . $row->getEmailTec() . "\r\n";
        fwrite($f, $linha, strlen($linha));
        fclose($f);
    }
}


               $emailTo = array(EMAIL_ADMIN);
               $assunto = "Relatorio Envio Email Todos Clientes";

                $textoCorpo = "Enviado Email para <b>{$count}</b> clientes, com a seguinte mensagem: <br> <b>{$mensagem}</b> <br>";
                    if($countErro > 0){
                        $textoCorpo .= "Houve(ram) {$countErro} erro(s) ao tentar Enviar: <br> {$textoCorpoErro} <br>";
                    }
                

                $emailCopiaOculta = array($listaEmails);
                //$emailCopiaOculta = array(EMAIL_ADMIN);
                $email2 = new EmailGenerico($emailTo, $assunto, $textoCorpo, array(), $emailCopiaOculta);

                if ($email2->enviarEmailSMTP()) {
                        echo "OK => Envio Relatorio!<br>";
                        LogCtrl::inserirLog(0, $textoCorpo, "ad");
                    $f = fopen("registro_email_pos_venda.txt", "a+", 0);
                    $linha = "Email enviado em: " . date('d/m/Y H:i') . " para todos clientes: " . $textoCorpo . "\r\n";
                    fwrite($f, $linha, strlen($linha));
                    fclose($f);
                } else {
                    echo "ERROr => No Envio do Relatorio !<br>";
                }