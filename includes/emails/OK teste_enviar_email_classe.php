<?php
include_once "../../classes/model/EmailOrcamentoNaoAprovado.class.php";



$email = new EmailOrcNaoAprovado("junior@elfiservice.com.br", "Clinete 1", 2, "120", "2016");
$email->enviarEmail();
echo "ok";

?>