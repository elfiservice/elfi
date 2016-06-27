<?php
session_start();

                   $id_orc = filter_input(INPUT_GET, 'ido', FILTER_VALIDATE_INT);
            $id_cliente= filter_input(INPUT_GET, 'idc', FILTER_VALIDATE_INT);
        if($id_orc && $id_cliente){

            $_SESSION['ido'] = $id_orc;
            $_SESSION['idc'] = $id_cliente;
            header("Location: pesquisa_pos_venda.php?ido={$id_orc}&idc={$id_cliente}");
        }else{
            WSErro("Erro na URL!", WS_ERROR);
            die();
        }
