<?php

if (isset($_SESSION['id'])) {

    $id_colab = $_SESSION['id'];
    $colab = new ColaboradorCtrl();
    $colabObj = $colab->buscarColaborador("*", "WHERE id_colaborador = '$id_colab'");
foreach ($colabObj as $colaborador){
    echo 'Colaborador: <b>' . $_SESSION['Login'] . '</b> em ' . date(' j \d\e F \d\e Y, \à\s H:i', strtotime($colaborador->getUltDataLogado()));
}
} else {

    echo ' Ocorreu algum problema. Por favor <a href="logout.php">Refazer Login</a>';
}
