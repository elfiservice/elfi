<?php
//http://elfiservice.eco.br/colaboradores/imagens/
/**
 * EmailGenerico.class [ utilitario ]
 * Enviar Email de forma generica, qualquer tipo de Email
 * @copyright (c) 2016, Armando JR. ELFISERVICE
 */
require 'PHPMailerAutoload.php';
class EmailGenerico extends EmailModel {

    private $textoCorpo;

    public function __construct($emailTo, $assunto, $textoCorpo, $emailCopia = null, $emailCopiaOculta=null) {
        $this->setEmailTo($emailTo);
        $this->setAssunto_email($assunto);
        $this->setTextoCorpo($textoCorpo);
        $this->setEmailCopia($emailCopia);
        $this->setEmailCopiaOculta($emailCopiaOculta);
    }

    private function enviar() {
        // echo 'ar';
        if (!$this->getPhpMailer()->Send()) {
            //echo 'NAO';
            return false;
        } else {
            //echo 'ok';
            return true;
        }
    }

    public function enviarEmailSMTP() {

        $this->montrCorpoEmail();
        $this->configEmailSmtp();
        $this->getPhpMailer()->SetFrom($this->getEmailFrom(), 'Sistema Elfi');
        $this->getPhpMailer()->AddAddress($this->getEmailTo());
        $this->getPhpMailer()->AddCC($this->getEmailCopia());
        $this->getPhpMailer()->AddBCC($this->getEmailCopiaOculta());
        $this->getPhpMailer()->Subject = $this->getAssunto_email();
        $this->getPhpMailer()->Body = $this->getCorpoEmail();
        //var_dump($this->getPhpMailer());
        return $this->enviar();
    }

    private function montrCorpoEmail() {
        $corpo = "
			<html>
			<body>
			<table width=\"auto\" align=\"center\" style=\"margin: 0 auto;\">
			<tr>
			<td>
			<div style=\"text-align: center; padding: 10px 10px; font: 11px verdana, arial, helvetica, sans-serif; color: #332E88; border: 1px solid #DDD;\">
			<img src=\"{$this->getImage_name()}\">
			<h2>{$this->getAssunto_email()}</h2>
			</div>
			</td>
			</tr>
			<tr>
			<td>
			<div style=\"padding: 15px 5px; font: 12px verdana, arial, helvetica, sans-serif; color: #000;\">
                                                        {$this->getTextoCorpo()}
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
        $this->setCorpoEmail($corpo);
    }

    public function getTextoCorpo() {
        return $this->textoCorpo;
    }

    public function setTextoCorpo($textoCorpo) {
        $this->textoCorpo = $textoCorpo;
    }

}
