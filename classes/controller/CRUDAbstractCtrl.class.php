<?php

/**
 * CRUDAbstractCtrl.class [ ABSTRACT ]
 * Responsavel por Padronizar o CRUD do sistema para cada Controller
 * @copyright (c) 2018 
 * @author Armando JR. ELFISERVICE
 */
abstract class CRUDAbstractCtrl {
    //put your code here
    
     /**
     * Fazer INSERT no BD na tabela = logs
     * @param Log $obj = passar uma Instancia deste tipo para inserir no BD
     * @return boolean = TRUE se Sucesso ao inserir dados no BD e FALSE se houver algum problema na INSERÇÃO ou se o OBJETO não foi passado corretamente
     */
    public function inserirBD($obj, $dao) {
        $nomeDaClasse = get_class($obj);
        if ($obj instanceof $nomeDaClasse) {

            foreach ((array) $obj as $campo => $valor) {
                $campo = str_replace("\0{$nomeDaClasse}\0", "", $campo);
                $campoArr[$campo] = $campo;
            }
            //  var_dump($campoArr);
            //unset($campoArr['id']);
            $arrObj = array_values((array) $obj);

            //unset($arrObj[0]);

            $campoArr = implode(', ', array_keys($campoArr));
            $valores = " '" . implode("','", array_values($arrObj)) . "' ";
            //var_dump($campoArr,$valores);
            //$logDao = new LogDAO();

            if ($dao->insert($campoArr, $valores)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
}
