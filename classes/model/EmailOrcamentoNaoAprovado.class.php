<?php
include_once 'EmailModel.class.php';
class EmailOrcNaoAprovado extends EmailModel{
	
	private $texto;
	private $razao_social_cliente;
	private $dias_orc_feita;
	private $n_orc;
	private $ano_orc;
	private $email_from;
	
	
	public function EmailOrcNaoAprovado($email,$razaoSocialCliente, $diasOrcFeita, $nOrc, $anoOrc){
		$this->setEmail($email);
		$this->setAssuntoEmail("Propostas ELFI - sistema");
		$this->setEmailFrom("junior@elfiservice.com.br");
		$this->razao_social_cliente = $razaoSocialCliente;
		$this->dias_orc_feita = $diasOrcFeita;
		$this->n_orc = $nOrc;
		$this->ano_orc = $anoOrc;
		
	}
	

	public function enviarEmail(){
		
		try {
			$imagem_nome = $this->getImageName();
			$arquivo = fopen ( $imagem_nome, 'r' );
			$contents = fread ( $arquivo, filesize ( $imagem_nome ) );
			$encoded_attach = chunk_split ( base64_encode ( $contents ) );
			fclose ( $arquivo );
			$limitador = "_=======" . date ( 'YmdHms' ) . time () . "=======_";
			
			$mailheaders = "From: ".$this->getEmailFrom()."\r\n";
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
			Olá, <b>".$this->getRazaoSocialCliente()."</b> hoje faz <b>".$this->getDiasOrcFeito()."</b> dias
			que nos foi solicitado um orçamento cujo o número é <b>".$this->getNOrc()."/".$this->getAnoOrc()."</b>.
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
			// 		$msg_body .= "--$limitador\r\n";
			//  		$msg_body .= "Content-type: image/jpeg; name=\"$imagem_nome\"\r\n";
			//  		$msg_body .= "Content-Transfer-Encoding: base64\r\n";
			//  		$msg_body .= "Content-ID: <$cid>\r\n";
			// 		$msg_body .= "\n$encoded_attach\r\n";
			//  		$msg_body .= "--$limitador--\r\n";
			
			if(mail ($this->getEmail(), $this->getAssuntoEmail(), $msg_body, $mailheaders )){
				
			}else{
				throw new Exception('Erro ao tentar enviar o Email!');
			}
						
		} catch (Exception $e) {
			echo 'Exceção capturada: ', $e->getMessage(), "\n";
		}
		

		
	}
	
	public function getTextoCorpoEmail() {
	         return $this->texto;
	}
	
	public function setTextoCorpoEmail($texto) {
	         $this->texto = $texto;
	}
	
	public function getRazaoSocialCliente() {
	         return $this->razao_social_cliente;
	}
	
	public function setRazaoSocialCliente($razao_social_cliente) {
	         $this->razao_social_cliente = $razao_social_cliente;
	}
	
	public function getDiasOrcFeito() {
	         return $this->dias_orc_feita;
	}
	
	public function setDiasOrcFeito($dias_orc_feita) {
	         $this->dias_orc_feita = $dias_orc_feita;
	}
	
	public function getNOrc() {
	         return $this->n_orc;
	}
	
	public function setNOrc($n_orc) {
	         $this->n_orc = $n_orc;
	}
	
	public function getAnoOrc() {
	         return $this->ano_orc;
	}
	
	public function setAnoOrc($ano_orc) {
	         $this->ano_orc = $ano_orc;
	}
	
	public function getEmailFrom() {
	         return $this->email_from;
	}
	
	public function setEmailFrom($email_from) {
	         $this->email_from = $email_from;
	}
	
	
	
}

?>