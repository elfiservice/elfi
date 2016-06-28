<?php
/**
 * EmailModel.class [ MODEL ]
 * Modelo Resp por configurar a PHPMailer e validar os dados e disparar emails do sistema
 * @copyright (c) 2016, Armando JR. ELFISERVICE
 */
abstract class EmailModel {

    private $emailFrom = MAILUSER;
    private $emailTo = array();
    private $emailCopia = array();
    private $emailCopiaOculta = array();
    private $assunto_email;
    private $corpoEmail;
    private $altCorpoEmail; //quando nao tem formato HTML, pow so texto aqui
    private $image_name;
    

    /**
     *
     * @var PHPMailer
     */
    private $phpMailer;

    protected function configEmailSmtp() {
        $this->setImage_name(WWW . "/imagens/logo_elfi_email.jpg");
        $this->setPhpMailer(new PHPMailer);
        $this->getPhpMailer()->CharSet = "UTF-8";
        $this->getPhpMailer()->IsSMTP();
        $this->getPhpMailer()->Host = MAILHOST;
        $this->getPhpMailer()->SMTPAuth = true;
        $this->getPhpMailer()->Username = MAILUSER;
        $this->getPhpMailer()->Password = MAILPASS;
        $this->getPhpMailer()->Port = MAILPORT;
        $this->getPhpMailer()->AddAttachment($this->getImage_name());
        $this->getPhpMailer()->IsHTML(true);
    }

    public function getEmailFrom() {
        return $this->emailFrom;
    }

    public function getEmailTo() {
        return $this->emailTo;
    }

    public function getAssunto_email() {
        return $this->assunto_email;
    }

    public function getCorpoEmail() {
        return $this->corpoEmail;
    }

    public function getAltCorpoEmail() {
        return $this->altCorpoEmail;
    }

    public function getImage_name() {
        return $this->image_name;
    }

    public function getPhpMailer() {
        return $this->phpMailer;
    }

    public function setEmailFrom($emailFrom) {
        $this->emailFrom = $emailFrom;
    }

    public function setEmailTo($emailTo) {
        $this->emailTo = $emailTo;
    }

    public function setAssunto_email($assunto_email) {
        $this->assunto_email = $assunto_email;
    }

    public function setCorpoEmail($corpoEmail) {
        $this->corpoEmail = $corpoEmail;
    }

    public function setAltCorpoEmail($altCorpoEmail) {
        $this->altCorpoEmail = $altCorpoEmail;
    }

    public function setImage_name($image_name) {
        $this->image_name = $image_name;
    }

    public function setPhpMailer(PHPMailer $phpMailer) {
        $this->phpMailer = $phpMailer;
    }


    public function getEmailCopia() {
        return $this->emailCopia;
    }

    public function setEmailCopia($emailCopia) {
        $this->emailCopia = $emailCopia;
    }

    public function getEmailCopiaOculta() {
        return $this->emailCopiaOculta;
    }

    public function setEmailCopiaOculta($emailCopiaOculta) {
        $this->emailCopiaOculta = $emailCopiaOculta;
    }




}
