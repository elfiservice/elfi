<?php
//require '../Config/SistemConfig.php';
//$tree = $_SERVER['DOCUMENT_ROOT'].'/site ELFI/colaboradores/';
//$tree = $_SERVER['DOCUMENT_ROOT'].'/colaboradores/'; //servidor
//echo $tree;

//require $tree.'teste/teste.php';
//require $tree.'classes/controller/ClienteCtrl.class.php';
//require $tree.'classes/controller/OrcamentosCtrl.class.php';
//require $tree.'classes/controller/UsuarioCtrl.class.php';
//require $tree.'classes/controller/ColaboradorCtrl.class.php';
//require $tree.'classes/controller/EmpresaCtrl.class.php';
//
//require $tree.'classes/dao/ClienteDAO.class.php';
//require $tree.'classes/dao/OrcamentoDAO.class.php';
//require $tree.'classes/dao/UsuarioDAO.class.php';
//require $tree.'classes/dao/ColaboradorDAO.class.php';
//require $tree.'classes/dao/EmpresaDAO.class.php';
//
////require $tree.'classes/model/Cliente.class.php';
////require $tree.'classes/model/Cliente_PF.class.php';
////require $tree.'classes/model/Cliente_PJ.class.php';
////require $tree.'classes/model/EmailModel.class.php';
////require $tree.'classes/model/EmailOrcamentoNaoAprovado.class.php';
////require $tree.'classes/model/Orcamento.class.php';
////require $tree.'classes/model/Usuario.class.php';
////require $tree.'classes/model/Colaborador.class.php';
////require $tree.'classes/model/Empresa.class.php';
//
//require $tree.'classes/util/Conexao.class.php';
//require $tree.'classes/util/Formatar.class.php';
//require $tree.'classes/util/Read.class.php';
//require $tree.'classes/util/Update.class.php';
//require $tree.'classes/util/Login.class.php';
//require $tree.'classes/util/Insert.class.php';

spl_autoload_register(function ($pClass) {
    $tree = $_SERVER['DOCUMENT_ROOT'].'/site ELFI/colaboradores/classes';
    
      if(file_exists("{$tree}/model/{$pClass}.class.php")){
        //echo "tem Arquivo!";
        require_once "{$tree}/model/{$pClass}.class.php";
        
        }else if(file_exists("{$tree}/controller/{$pClass}.class.php")){
        //echo "tem Arquivo!";
        require_once "{$tree}/controller/{$pClass}.class.php";
        
        }else if(file_exists("{$tree}/dao/{$pClass}.class.php")){
        //echo "tem Arquivo!";
        require_once "{$tree}/dao/{$pClass}.class.php";
        
        }else if(file_exists("{$tree}/util/{$pClass}.class.php")){
        //echo "tem Arquivo!";
        require_once "{$tree}/util/{$pClass}.class.php";
        
        } else {
            die ("Erro ao incluir {$pClass}.class.php<hr>");
        }
});

//    $dirName = array('model', 'controller', 'dao', 'util');
//   
//    foreach ($dirName as $pasta){
//        
//        $pastaFinal = $tree.$pasta;
//        
//        if(file_exists("{$pastaFinal}/{$pClass}.class.php")){
//        //echo "tem Arquivo!";
//        require_once "{$pastaFinal}/{$pClass}.class.php";
//        
//        }else{
//           // die ("Erro ao incluir {$pastaFinal}/{$pClass}.class.php<hr>");
//        }
        
 //   }
    
//TRATAMENTO DE ERROS ###################
//CSS constantes :: Mensagens de Erro
define('WS_ACCEPT', 'accept');
define('WS_INFOR', 'infor');
define('WS_ALERT', 'alert');
define('WS_ERROR', 'error');

//WSErro :: Exibe erros lançados :: Front
function WSErro($errMsg, $errNo, $errDie = null) { //$No = Numero do ERRO (tipo do Erro)
    $cssClass = ($errNo == E_USER_NOTICE ? WS_INFOR : ($errNo == E_USER_WARNING ? WS_ALERT : ($errNo == E_USER_ERROR ? WS_ERROR : $errNo)));
    echo "<p class=\"trigger {$cssClass}\">{$errMsg}<span class\"ajax_close\"> </span></p>";
    
    if($errDie){
        die;
    }
}


//PHPErro :: personaliza o gatilho do PHP
function PHPErro($errNo, $errMsg, $errFile, $errLine) {
    $cssClass = ($errNo == E_USER_NOTICE ? WS_INFOR : ($errNo == E_USER_WARNING ? WS_ALERT : ($errNo == E_USER_ERROR ? WS_ERROR : $errNo))); //Passar manualmente Erro personalizado pelo  $errNo
    echo "<p class=\"trigger {$cssClass}\">";
    echo"<b> Erro na Linha: {$errLine} ::</b> {$errMsg} <br>";
    echo"<small>{$errFile}</small>";
    echo"<span class\"ajax_close\"></span></p>";
    
    if($errNo == E_USER_ERROR){
        die;
    }
}

set_error_handler('PHPErro');   //informar para p PHP q essa sera a Mensagem responsavel pelos ERROS

echo"";



