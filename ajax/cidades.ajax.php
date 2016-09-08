<?php
include_once "../classes/Config.inc.php";
header('Cache-Control: no-cache');
header('Content-type: application/xml; charset="utf-8"', true);



$cod_estados = $_REQUEST['cod_estados'];
//$cod_estados = filter_input(INPUT_REQUEST, "cod_estados", FILTER_VALIDATE_INT);

$cidades = array();
$clienteCtrl = new ClienteCtrl();
$cidadesArr = $clienteCtrl->buscarCidade("cod_cidades, nome", "WHERE estados_cod_estados = '$cod_estados' ORDER BY nome");

foreach ($cidadesArr as $row) {
    $cidades[] = array(
        'cod_cidades' => $row['cod_cidades'],
        'nome' => utf8_encode($row['nome']),
    );
}

echo( json_encode($cidades) );
