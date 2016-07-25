<?php

include '../classes/Config.inc.php';

$ano_orc = date('Y');

$clienteCtrl = new ClienteCtrl();
$clientes = $clienteCtrl->buscarCliente("*", "");

//var_dump($clientes);
//die;

foreach ($clientes as $row) {


    if (!$row ['email_tec'] == null) {

        for ($dia = 10; $dia <= 365; $dia = $dia + 10) {
           // echo $dia . ' == ' . $dias . '<br>';
            if ($dia == $dias) {
                echo $dia . ' == ' . $dias . " enviar - ";

                //$emailTo = array(EMAIL_ADMIN);
                $emailTo = array($row['email_contr'], $row['email_obra']);
                $assunto = "Lembrete preenchimento Pesquisa :)";

                $textoCorpo = "Olá, <b>{$row ['razao_social_contr']}</b> a proposta de Nº <b>{$row ['n_orc']}.{$row ['ano_orc']}</b> foi <b>concluida</b> à <b>{$dias} dias.</b> <br>"
                        . "Por favor, nos dê seu parecer sobre nosso atendimento, será de grande ajuda para o desenvolvimento de nossa parceria.<br><br>"
                        . "Apenas acesse o Link abaixo ou copie e cole no navegar:<br>"
                        . "<a href=\"{$www}/orcamento/aprovados/pesquisa_pos_venda.php?ido={$row ['id']}&idc={$row ['id_cliente']}\" >"
                        . "{$www}/orcamento/aprovados/pesquisa_pos_venda.php?ido={$row ['id']}&idc={$row ['id_cliente']} </a> <br>";

                //$emailCopiaOculta = array();
                $emailCopiaOculta = array(EMAIL_ADMIN);
                $email2 = new EmailGenerico($emailTo, $assunto, $textoCorpo, array(), $emailCopiaOculta);

                if ($email2->enviarEmailSMTP()) {
                    echo "OK<br>";
                    $f = fopen("registro_email_pos_venda.txt", "a+", 0);
                    $linha = "Email enviado em: " . date('d/m/Y H:i') . " para " . $row ['razao_social_contr'] . " Orc N. " . $row ['n_orc'] . "/" . $row ['ano_orc'] . " Email: " . $row ['email_contr'] . "\r\n";
                    fwrite($f, $linha, strlen($linha));
                    fclose($f);
                } else {
                    echo "ERROr <br>";
                }
            }
        }
       
    } else {
        $f = fopen("registro_email_pos_venda.txt", "a+", 0);
        $linha = "Email NÃO enviado em: " . date('d/m/Y H:i') . " para " . $row ['razao_social_contr'] . " Orc N. " . $row ['n_orc'] . "/" . $row ['ano_orc'] . "\r\n";
        fwrite($f, $linha, strlen($linha));
        fclose($f);
    }
}
