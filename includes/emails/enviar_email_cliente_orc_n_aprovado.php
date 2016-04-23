<?php

// enviar EMAIL

// ENVIAR EMAIL PRA ATIVAÇÃO DA CONTA COM IMAGEM E EM HTML
$email1 = "junior@elfiservice.com.br";
$email2 = "lana@elfiservice.com.br";

$imagem_nome = "";
$arquivo = fopen ( $imagem_nome, 'r' );
$contents = fread ( $arquivo, filesize ( $imagem_nome ) );
$encoded_attach = chunk_split ( base64_encode ( $contents ) );
fclose ( $arquivo );
$limitador = "_=======" . date ( 'YmdHms' ) . time () . "=======_";

$mailheaders = "From: junior@elfiservice.com.br\r\n";
$mailheaders .= "MIME-version: 1.0\r\n";
$mailheaders .= "Content-type: multipart/related; boundary=\"$limitador\"\r\n";
$cid = date ( 'YmdHms' ) . '.' . time ();

$texto = "
<html>
<body>

<table width=\"auto\" align=\"center\" style=\"margin: 0 auto;\">

<tr>

<td>
<div style=\" padding: 10px 10px; font: 11px verdana, arial, helvetica, sans-serif; color:#000;   border:1px solid #DDD;\">
<h2>Orçamento Aprovado</h2>
	
</div>
</td>
</tr>

<tr>

<td>
<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:#000;\">
Cliente:
<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:red;\">
$razao_social
</div>
</div>
</td>

</tr>
<tr>
<td>
<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:#000;\">
Atividade:
<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:red;\">
$atividade1
</div>
</div>
</td>
<td>

</td>
</tr>
<tr>
<td>
<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:#000;\">
Classificação:
<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:red;\">
$classificacao1
</div>
</div>
</td>
<td>

</td>
</tr>
<tr>
<td>
<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:#000;\">
Inf. de serviços:
<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:red;\">
$descricao_servicos
</div>
</div>
</td>
<td>

</td>
</tr>
<tr>
<td>
<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:#000;\">
Novo cliente?
<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:red;\">
$novo_cliente
</div>
</div>
</td>
<td>

</td>
</tr>
<tr>
<td>
<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:#000;\">
Nº do orçamento:
<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:red;\">
$n_orc
</div>
</div>
</td>
<td>

</td>
</tr>
<tr>
<td>
<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:#000;\">
Prazo de execução:
<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:red;\">
$prz_execucao dia(s)
</div>
</div>
</td>
<td>

</td>
</tr>
<tr>
<td>
<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:#000;\">
Data aprovado:
<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:red;\">
$data_aprovada
</div>
</div>
</td>
<td>

</td>

</tr>


</table>



</body>
</html>
";

$msg_body = "--$limitador\r\n";
$msg_body .= "Content-type: text/html; charset=utf-8\r\n";
$msg_body .= "$texto";
$msg_body .= "--$limitador\r\n";
$msg_body .= "Content-type: image/jpeg; name=\"$imagem_nome\"\r\n";
$msg_body .= "Content-Transfer-Encoding: base64\r\n";
$msg_body .= "Content-ID: <$cid>\r\n";
$msg_body .= "\n$encoded_attach\r\n";
$msg_body .= "--$limitador--\r\n";

mail ( $email1, "Aprovacao Propostas ELFI - sistema", $msg_body, $mailheaders );
mail ( $email2, "Aprovacao Propostas ELFI - sistema", $msg_body, $mailheaders );