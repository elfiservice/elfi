<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require './../../classes/Config.inc.php';
            
            $textoCorpo = "Olá, a Proposta 34/2019 foi aprovada dia 31/05/2016.";
            
            $email = new EmailGenerico("elfiservice@hotmail.com", "Orçamento Aprovado", $textoCorpo);
            
            if($email->enviarEmailSMTP()){
                echo "Email Enviado com Sucesso!";
            }else{
                echo ":(";
            }
        ?>
    </body>
</html>
