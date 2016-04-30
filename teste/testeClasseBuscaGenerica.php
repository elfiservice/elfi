<?php
require '../classes/model/Read.class.php';
//include '../classes/model/Conexao.class.php';

$read = new Read();

//$id=3;
//$var = 
//$read->ExecRead("*", "orcamentos","WHERE ano_orc=2015");
$var = $read->ExecRead("*", "orcamentos","WHERE ano_orc=2016");

$users = $read->getResultado();

foreach ($users as $user => $dados){
	echo "user: {$user} -> dado: {$dados["id"]} <br>";
}
//echo $users[0][1];

//$linha = $read->getResultado();
//var_dump($read->getResultado());
