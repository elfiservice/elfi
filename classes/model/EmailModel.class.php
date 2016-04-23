<?php

abstract class EmailModel{
	
	private $email;
	private $image_name = "http://elfiservice.eco.br/colaboradores/includes/email/logo_elfi_email.jpg";
	private $assunto_email;

	public function enviarEmail();
	

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



?>