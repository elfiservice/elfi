<?php
require './../classes/Config.inc.php';

$orc = new OrcamentoCtrl();

$orc->verificaSeNovoCliente('AFANTONIOA2');
echo $orc->getResult();

$orc->numeroDoOrc("2016");
echo $orc->getResult();