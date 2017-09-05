<?php
include './classes/Config.inc.php';
if (!session_id()) {
    session_start();
}
$login = new Login();



$dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if (!empty($dataLogin['logar'])) {
    $login->exeLogin($dataLogin);

    if (!$login->getResult()) {
        WSErro($login->getError()[0], $login->getError()[1]);
    } else {
        header('Location: index.php');
    }
}

if ($login->checkLogin()) {
    header('Location: index.php');
}
?>

<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="pt"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="pt"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="pt"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="pt"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Sistema ELFI</title>

        <meta name="description" content="">
        <meta name="author" content="Elfi Service">

        <meta name="viewport" content="width=device-width,initial-scale=1">

        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="estilos.css">    

        <script src="js/jquery.min.js" type="text/javascript"></script>
    </head>
    <body>
        <div  style="background: url(imagens/topo1.png) repeat-x;  padding:5px 0px 30px 0px;">
        </div>        
        <div >
            <h2 style="text-align: center;" >Acesso ao Sistema Integrado da ELFI SERVICE para os Colaboradores  </h2>
        </div>




        <section class="w3-container">
            <div class="w3-content">       
                <form class="w3-container" name="AdminLoginForm" action="" method="post">
                    <div class="w3-row-padding">
                        <div class="w3-half">
                            <label>Email</label>
                            <input class="w3-input w3-border" name="login" type="email" id="login" maxlength="200" >
                        </div>
                        <div class="w3-half">
                            <label>Senha</label>
                            <input class="w3-input w3-border" name="senha" type="password" id="senha" maxlength="16" >
                        </div>
                        <div class="w3-col w3-center w3-margin-top">
                            <input class="w3-btn" type="submit" name="logar" value="Entrar" id="logar"   />
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <div class="w3-container w3-center w3-margin-top">
            <div class="w3-row-padding">
                <div class="w3-col">
                    <button onclick="document.getElementById('id01').style.display = 'block'" class="w3-button w3-black w3-small">Esqueceu a senha ?</button>

                    <div id="id01" class="w3-modal">
                        <div class="w3-modal-content">
                            <div class="w3-container">
                                <span onclick="document.getElementById('id01').style.display = 'none'" class="w3-button w3-display-topright">&times;</span>
                                <p>Some text. Some text. Some text.</p>
                                <p>Some text. Some text. Some text.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
