<?php

//DEFINE A BASE DO SITE ###################
$www = "https://localhost/elfi";
//$www = "http://elfiservice.eco.br/colaboradores";
define('WWW', 'https://localhost/elfi');
//define('WWW', 'http://elfiservice.eco.br/colaboradores');
//CONFIG. DO SITE ##########################
//Banco de DADOS
define('HOST', 'localhost');  //via RunTime = em tempo de execução
define('USER', 'root');
define('PASS', '');
define('DBSA', 'sistema_elfi');
//Dados do ADMIN
define('NOME_ADMIN', 'Armando Jr.');
define('EMAIL_ADMIN', 'junior@elfiservice.com.br');

//DEFINE SERVIDOR DE EMAILS###################
define('MAILUSER', 'elfi@elfiservice.com.br');
define('MAILPASS', '');
define('MAILPORT', '587');
define('MAILHOST', 'smtp.elfiservice.com.br');

//DEFINE IDENTIDADE DO SITE ###################
define('SITENAME', 'Sistema ELFI');    //SEO titulo do SITE
define('SITEDESCRICAO', ' Sistema de gestão da empresa ELFI  ');    // SEO descriçao do SITE
//AUTO LOAD DE CALSSES ###################
spl_autoload_register(function ($pClass) {

    $cDir = array('model', 'controller', 'dao', 'util', 'util/fpdf');
    $iDir = null;   //se houve a inclusao do diretorio caso não, lança um ERRO
//__DIR__ => pega o nome do diretorio deste Arquivo Config.inc.php no caso _app

    foreach ($cDir as $dirName) {
//    if(!$iDir && file_exists(__DIR__ . "\\{$dirName}\\{$pClass}.class.php") && !is_dir(__DIR__ . "\\{$dirName}\\{$pClass}.class.php")){  //  \ -> para incluir como Arquivo(mas ele quebra o codigo, então poe a segunda ->  \
//        include_once (__DIR__ . "\\{$dirName}\\{$pClass}.class.php");
//        $iDir = true;
//        
//    }

        if (!$iDir && file_exists(__DIR__ . "/{$dirName}/{$pClass}.class.php") && !is_dir(__DIR__ . "/{$dirName}/{$pClass}.class.php")) {  //  MODELO DO SERVIDOR
            include_once (__DIR__ . "/{$dirName}/{$pClass}.class.php");
            $iDir = true;
        }
    }

    if (!$iDir) {
        trigger_error("Não foi possivel incluir {$pClass}.class.php", E_USER_ERROR); //pra garantir em TRAVAR o CODIGO
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

    if ($errDie) {
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

    if ($errNo == E_USER_ERROR) {
        die;
    }
}

set_error_handler('PHPErro');   //informar para p PHP q essa sera a Mensagem responsavel pelos ERROS
//Lista EMAILS da Empresa ###################
//seram copiados quando um Email for enviado para o Cliente.
$listaEmails = array(
    'elfiservice@hotmail.com');

$usuario = new UsuarioCtrl();
$usuarios = $usuario->buscarBD("*", "WHERE ativo = '1'");

if (!empty($usuarios)) {
    foreach ($usuarios as $user) {
        $listaEmails[] = $user->getLogin();
    }
}

