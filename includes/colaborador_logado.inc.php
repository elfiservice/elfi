<?php


if ($userlogin) {

    //$colabObjt = $_SESSION['userlogin'];
    //var_dump($userlogin);
    $colab = new ColaboradorCtrl();
    $colabObj = $colab->buscarBD("*", "WHERE id_colaborador = '". $userlogin->getId_colaborador() ."' ");
foreach ($colabObj as $colaborador){
    echo 'Colaborador: <b>' . $userlogin->getLogin() . '</b> em ' . date(' j \d\e F \d\e Y, \a\s H:i', strtotime($colaborador->getLast_log_date()));
}
} else {

    echo ' Ocorreu algum problema. Por favor <a href="logout.php">Refazer Login</a>';
}
