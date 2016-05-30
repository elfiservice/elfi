<?php
require '../util/PHPMailerAutoload.php/';
abstract class EmailModel{
	
	private $email;
	private $image_name = "http://elfiservice.eco.br/colaboradores/includes/email/logo_elfi_email.jpg";
	private $assunto_email;
        /**
         *
         * @var PHPMailer
         */    
        private $phpMailer;

        
        public function configEmailSmtp() {
//            $this->phpMailer = new PHPMailer();
//            $this->phpMailer->CharSet = "UTF-8";
            $this->setPhpMailer(new PHPMailer);
            $this->getPhpMailer()->CharSet = "UTF-8";
            $this->getPhpMailer()->IsSMTP();
            $this->getPhpMailer()->Host = 'smtp.elfiservice.com.br';
            $this->getPhpMailer()->SMTPAuth = true;
            $this->getPhpMailer()->Username = 'elfi@elfiservice.com.br';
            $this->getPhpMailer()->Password = 'Sapato44';
            $this->getPhpMailer()->Port = 587;
            $this->getPhpMailer()->AddAttachment($this->getImageName());
            $this->getPhpMailer()->IsHTML(true);
                           
            
        }
	
        public function getPhpMailer() {
            return $this->phpMailer;
        }

        public function setPhpMailer(PHPMailer $phpMailer) {
            $this->phpMailer = $phpMailer;
        }

        	public function getEmail() {
	         return $this->email;
	}
	
	public function setEmail($email) {
	         $this->email = $email;
	}
	
	public function getImageName() {
	         return $this->image_name;
	}
	
	public function setImageName($image_name) {
	         $this->image_name = $image_name;
	}
	
	public function getAssuntoEmail() {
	         return $this->assunto_email;
	}
	
	public function setAssuntoEmail($assunto_email) {
	         $this->assunto_email = $assunto_email;
	}
	

	
	
}

