#!/usr/bin/php

<?php
include_once "../Config/config_sistema.php";
include_once "../classes/model/EmailOrcamentoNaoAprovado.class.php";
// include_once ("salvar_alteracao_orcamento.php");

$ano_orc = date ( 'Y' );
// $conut=0;
$consulta_usuarios = mysql_query ( "select * from orcamentos WHERE ano_orc = '$ano_orc' AND situacao_orc = 'Aguardando aprovação' ORDER BY id  DESC" );
// $linhaass = mysql_num_rows ( $consulta_usuarios );

while ( $row = mysql_fetch_array ( $consulta_usuarios ) ) 

{
	// echo "loop";
	// Define os valores a serem usados
	$data_inicial = $row ['data_adicionado_orc'];
	$data_final = date ( 'y-m-d' );
	// Usa a fun��o strtotime() e pega o timestamp das duas datas:
	$time_inicial = strtotime ( $data_inicial );
	$time_final = strtotime ( $data_final );
	// Calcula a diferen�a de segundos entre as duas datas:
	$diferenca = $time_final - $time_inicial; // 19522800 segundos
	                                          // Calcula a diferen�a de dias
	$dias = ( int ) floor ( $diferenca / (60 * 60 * 24) ); // 225 dias
	                                                       // echo $conut;
	if (! $row ['email_contr'] == null) {
		if ($dias == 5 || $dias == 10 || $dias == 15 || $dias == 25 || $dias == 30 || $dias == 45 || $dias == 60) {
			$email = new EmailOrcNaoAprovado ( $row ['email_contr'], $row ['razao_social_contr'], $dias, $row ['n_orc'], $row ['ano_orc'] );
			$email->enviarEmail ();
			// echo " Email enviado para " .$row ['razao_social_contr']." - tem ". $dias . " dias <br>";
			$f = fopen ( "registro_email_cliente_nao_aprovado.txt", "a+", 0 );
			$linha = "Email enviado em: " . date ( 'd/m/Y H:i' ) . " para " . $row ['razao_social_contr'] . " Orc N. " . $row ['n_orc'] . "/" . $row ['ano_orc'] . "\r\n";
			fwrite ( $f, $linha, strlen ( $linha ) );
			fclose ( $f );
			//file_put_contents ( "registro_email_cliente_nao_aprovado.txt", "Email enviado em: " . date ( 'd/m/Y H:i' ) . " para " . $row ['razao_social_contr'] . " Orc N. " . $row ['n_orc'] . "/" . $row ['ano_orc'] . "\r\n" );
		}
	} else {
		// echo " Email vazio!";
		//file_put_contents ( "registro_email_cliente_nao_aprovado.txt", "Email VAZIO: " . date ( 'd/m/Y H:i' ) . " para " . $row ['razao_social_contr'] . " Orc N. " . $row ['n_orc'] . "/" . $row ['ano_orc'] );
		$f = fopen ( "registro_email_cliente_nao_aprovado.txt", "a+", 0 );
		$linha = "Email NÃO (VAZIO) enviado em: " . date ( 'd/m/Y H:i' ) . " para " . $row ['razao_social_contr'] . " Orc N. " . $row ['n_orc'] . "/" . $row ['ano_orc'] . "\r\n";
		fwrite ( $f, $linha, strlen ( $linha ) );
		fclose ( $f );
	}
	// $conut++;
}
// echo "f";
?>
           
 



