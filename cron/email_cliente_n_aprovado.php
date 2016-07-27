<?php
include '../classes/Config.inc.php';

$ano_orc = date('Y');

$OrcCtrl = new OrcamentoCtrl();
$orcamentos = $OrcCtrl->buscarOrcamentos("*", "WHERE ano_orc = '$ano_orc' AND situacao_orc = 'Aguardando aprovação' ORDER BY id  DESC");

$count = 0;
$countErr = 0;
foreach ($orcamentos as $row) {

    $data_inicial = $row ['data_adicionado_orc'];
    $data_final = date('y-m-d');
    $dias = Formatar::diffDuasDatas($data_inicial, $data_final);

    if (!$row ['email_contr'] == null) {

        if ($dias == 10 || $dias == 20 || $dias == 30 || $dias == 40 || $dias == 50 || $dias == 60 || $dias == 80 || $dias == 100 || $dias == 120 || $dias == 150 || $dias == 180 || $dias == 210 || $dias == 240) {

            //$emailTo = array(EMAIL_ADMIN);
            $emailTo = array($row['email_contr'], $row['email_obra']);
            $assunto = "Orçamento aguardando sua aprovação";
            $textoCorpo = "Olá, <b>{$row ['razao_social_contr']}</b> hoje faz <b>{$dias} dias</b> que nos foi solicitado um orçamento cujo o número é <b>{$row ['n_orc']}.{$row ['ano_orc']}</b>. ";
            $emailCopiaOculta = array(EMAIL_ADMIN);
			//$emailCopiaOculta = array();
            $email2 = new EmailGenerico($emailTo, $assunto, $textoCorpo, array(), $emailCopiaOculta);

            if ($email2->enviarEmailSMTP()) {
                echo "OK - {$row ['razao_social_contr']}<br>";
                $count++;
                $f = fopen("registro_email_cliente_nao_aprovado.txt", "a+", 0);
                $linha = "Email enviado em: " . date('d/m/Y H:i') . " para " . $row ['razao_social_contr'] . " Orc N. " . $row ['n_orc'] . "/" . $row ['ano_orc'] . " Email: " . $row ['email_contr'] . "\r\n";
                fwrite($f, $linha, strlen($linha));
                fclose($f);
            } else {
                echo "ERROr - {$row ['razao_social_contr']} ORC {$row ['n_orc']}<br>";
                $countErr++;
            }
        }
    } else {
        $f = fopen("registro_email_cliente_nao_aprovado.txt", "a+", 0);
        $linha = "Email NÃO enviado em: " . date('d/m/Y H:i') . " para " . $row ['razao_social_contr'] . " Orc N. " . $row ['n_orc'] . "/" . $row ['ano_orc'] . "\r\n";
        fwrite($f, $linha, strlen($linha));
        fclose($f);
    }
}

LogCtrl::inserirLog(0, "Enviado email(s) para {$count} Cliente(s) com Orcamentos aguardando aprovação - ocorreram {$countErr} erros.", "tec");

