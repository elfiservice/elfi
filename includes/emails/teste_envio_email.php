<?php
include_once "../../Config/config_sistema.php";

$sql_user = mysql_query("SELECT * FROM orcamentos WHERE id='207'") or die (mysql_error());
$linha_orc = mysql_fetch_object($sql_user);
// enviar EMAIL

// ENVIAR EMAIL PRA ATIVA��O DA CONTA COM IMAGEM E EM HTML
$email1 = "junior@elfiservice.com.br";


$imagem_nome = "logo_elfi_email.jpg";
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
				<div style=\"text-align: center; padding: 10px 10px; font: 11px verdana, arial, helvetica, sans-serif; color: #332E88; border: 1px solid #DDD;\">
					<img src=\"$imagem_nome\">
					<h2>Orçamento aguardando sua aprovação</h2>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div style=\"padding: 10px 5px; font: 12px verdana, arial, helvetica, sans-serif; color: #000;\">
					Olá, <b>$linha_orc->razao_social_contr</b> hoje faz <b>$n_dias_orc_aprovado</b> dias
					que nos foi solicitado um orçamento cujo o número é <b>$linha_orc->n_orc/$linha_orc->ano_orc</b>.
				</div>
			</td>

		</tr>
		<tr>
			<td>
				<div style=\"padding: 10px 5px; font: 12px verdana, arial, helvetica, sans-serif; color: #000;\">
					Estamos a disposição para quais quer esclarecimentos, dúvidas ou
					negociações.</div>
			</td>
			<td></td>
		</tr>
		<tr>
			<td>
				<div style=\"padding: 10px 5px; font: 12px verdana, arial, helvetica, sans-serif; color: #000;\">
					Desde já adradecemos sua preferência. <br> Atenciosamente, equipe
					Elfi.<br>
					<br> <i>Email enviado de forma automática</i>
				</div>
			</td>
			<td></td>
		</tr>
		<tr>
			<td>
				<div style=\"border: 1px solid #DDD; padding: 10px 5px; font: 10px verdana, arial, helvetica, sans-serif; color: #332E88;\">
					<div style=\"text-align: center;\">
						Rua Capitão Vasconcelos, 645 - Fortaleza - CE <br> e-mail:
						elfi@elfiservice.com.br - Fone: (85) 3227-6307 - Fax(85) 3227-6068
					</div>
				</div>
			</td>
			<td></td>
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

mail ( $email1, "Propostas ELFI - sistema", $msg_body, $mailheaders );

echo $linha_orc->razao_social_contr;
?>