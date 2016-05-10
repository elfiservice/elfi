<?php
//require '../Config/SistemConfig.php';
$tree = $_SERVER['DOCUMENT_ROOT'].'/site ELFI/colaboradores/';
//$tree = $_SERVER['DOCUMENT_ROOT'].'/colaboradores/'; //servidor
//echo $tree;

//require $tree.'teste/teste.php';
require $tree.'classes/controller/ClienteCtrl.class.php';
require $tree.'classes/controller/OrcamentosCtrl.class.php';
require $tree.'classes/controller/UsuarioCtrl.class.php';
require $tree.'classes/controller/ColaboradorCtrl.class.php';

require $tree.'classes/dao/ClienteDAO.class.php';
require $tree.'classes/dao/OrcamentoDAO.class.php';
require $tree.'classes/dao/UsuarioDAO.class.php';
require $tree.'classes/dao/ColaboradorDAO.class.php';

require $tree.'classes/model/Cliente.class.php';
require $tree.'classes/model/Cliente_PF.class.php';
require $tree.'classes/model/Cliente_PJ.class.php';
require $tree.'classes/model/EmailModel.class.php';
require $tree.'classes/model/EmailOrcamentoNaoAprovado.class.php';
require $tree.'classes/model/Orcamento.class.php';
require $tree.'classes/model/Usuario.class.php';
require $tree.'classes/model/Colaborador.class.php';

require $tree.'classes/util/Conexao.class.php';
require $tree.'classes/util/Formatar.class.php';
require $tree.'classes/util/Read.class.php';
require $tree.'classes/util/Update.class.php';
require $tree.'classes/util/Login.class.php';
require $tree.'classes/util/Insert.class.php';