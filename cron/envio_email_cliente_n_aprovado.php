<?php

include_once "../Config/config_sistema.php";
include '../classes/Config.inc.php';
include_once "../classes/model/EmailOrcamentoNaoAprovado.class.php";
//$row ['email_contr']
$ano_orc = date ( 'Y' );
//$email2 = "junior@elfiservice.com.br";

$consulta_usuarios = mysql_query ( "select * from orcamentos WHERE ano_orc = '$ano_orc' AND situacao_orc = 'Aguardando aprovação' ORDER BY id  DESC" );

while ( $row = mysql_fetch_array ( $consulta_usuarios ) ) 

{

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
	                                                     
	if (! $row ['email_contr'] == null) {
           
		if ($dias == 10 || $dias == 20 || $dias == 30 || $dias == 40 || $dias == 50 || $dias == 60 || $dias == 80|| $dias == 100 || $dias == 120 || $dias == 150 || $dias == 180) {
                   
			//$email = new EmailOrcNaoAprovado ( $row ['email_contr'], $row ['razao_social_contr'], $dias, $row ['n_orc'], $row ['ano_orc'] );
                        $email = new EmailOrcNaoAprovado ( "elfiservice@gmail.com", $row ['razao_social_contr'], $dias, $row ['n_orc'], $row ['ano_orc'] );
			$email->enviarEmailSMTP ();
			
                        
			$f = fopen ( "registro_email_cliente_nao_aprovado.txt", "a+", 0 );
			$linha = "Email enviado em: " . date ( 'd/m/Y H:i' ) . " para " . $row ['razao_social_contr'] . " Orc N. " . $row ['n_orc'] . "/" . $row ['ano_orc'] . " Email: ".$row ['email_contr']. "\r\n";
			fwrite ( $f, $linha, strlen ( $linha ) );
			fclose ( $f );
		
		}
	} else {
		$f = fopen ( "registro_email_cliente_nao_aprovado.txt", "a+", 0 );
		$linha = "Email NÃO (VAZIO) enviado em: " . date ( 'd/m/Y H:i' ) . " para " . $row ['razao_social_contr'] . " Orc N. " . $row ['n_orc'] . "/" . $row ['ano_orc'] . "\r\n";
		fwrite ( $f, $linha, strlen ( $linha ) );
		fclose ( $f );
	}
	
}
