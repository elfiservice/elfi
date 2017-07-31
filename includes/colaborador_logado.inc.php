<?php


if ($userlogin) {

    //$colabObjt = $_SESSION['userlogin'];
    //var_dump($userlogin);
    $user = new UsuarioCtrl();
    $colabObj = $user->buscarBD("*", "WHERE id = '". $userlogin->getId() ."' ");
foreach ($colabObj as $usuario){
    echo 'Colaborador: <b>' . $userlogin->getLogin() . '</b> em ' . date(' j \d\e F \d\e Y, \a\s H:i', strtotime($usuario->getLast_log_date()));
}
} else {

    echo ' Ocorreu algum problema. Por favor <a href="logout.php">Refazer Login</a>';
}
