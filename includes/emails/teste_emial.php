<?php
$imagem_nome = "../../imagens/logo_elfi_email.jpg";
$arquivo = fopen ( $imagem_nome, 'r' );
$contents = fread ( $arquivo, filesize ( $imagem_nome ) );
$encoded_attach = chunk_split ( base64_encode ( $contents ) );
fclose ( $arquivo );


echo phpversion();
?>

<html>
<body>
	<table width="auto" align="center" style="margin: 0 auto;">
		<tr>
			<td>
				<div style="text-align: center; padding: 10px 10px; font: 11px verdana, arial, helvetica, sans-serif; color: #332E88; border: 1px solid #DDD;">
					<img src="<?php echo $imagem_nome; ?>">
					<h2>Or�amento aguardando sua aprova��o</h2>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div style="padding: 10px 5px; font: 12px verdana, arial, helvetica, sans-serif; color: #000;">
					Ol�, <b>$razao_social</b> hoje faz <b>$n_dias_orc_aprovado</b> dias
					que nos foi solicitado um or�amento cujo o n�mero � <b>$n_orc</b>.
				</div>
			</td>

		</tr>
		<tr>
			<td>
				<div style="padding: 10px 5px; font: 12px verdana, arial, helvetica, sans-serif; color: #000;">
					Estamos a disposi��o para quais quer esclarecimentos, d�vidas ou
					negocia��es.</div>
			</td>
			<td></td>
		</tr>
		<tr>
			<td>
				<div style="padding: 10px 5px; font: 12px verdana, arial, helvetica, sans-serif; color: #000;">
					Desde j� adradecemos sua prefer�ncia. <br> Atenciosamente, equipe
					Elfi.<br>
					<br> <i>Email enviado de forma autom�tica</i>
				</div>
			</td>
			<td></td>
		</tr>
		<tr>
			<td>
				<div style="border: 1px solid #DDD; padding: 10px 5px; font: 10px verdana, arial, helvetica, sans-serif; color: #332E88;">
					<div style="text-align: center;">
						Rua Capit�o Vasconcelos, 645 - Fortaleza - CE <br> e-mail:
						elfi@elfiservice.com.br - Fone: (85) 3227-6307 - Fax(85) 3227-6068
					</div>
				</div>
			</td>
			<td></td>
		</tr>
	</table>
</body>
</html>