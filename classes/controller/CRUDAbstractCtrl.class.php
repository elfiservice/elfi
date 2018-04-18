<?php

/**
 * CRUDAbstractCtrl.class [ ABSTRACT ]
 * Responsavel por Padronizar o CRUD do sistema para cada Controller
 * @copyright (c) 2018 
 * @author Armando JR. ELFISERVICE
 */
abstract class CRUDAbstractCtrl {
    
     /**
     * Fazer SELECT no BD na tabela
     * @param string $campos = Campos do BD a serem pesquisados
     * @param string $termos = Termos para Filtrar a Busca no BD (WHERE, etc)
     * @return Array do tipo --><b>Entidade (model)</b><-- se encontrar resultados, se não retorna NULL
     */
    public function buscarBD($campos, $termos, $dao) {
        return $dao->select($campos, $termos);
    }
    
     /**
     * Fazer INSERT no BD
     * @param Object $obj = passar uma Instancia de um Objeto para inserir no BD
     * @return boolean = TRUE se Sucesso ao inserir dados no BD e FALSE se houver algum problema na INSERÇÃO ou se o OBJETO não foi passado corretamente
     */
    public function inserirBD($obj, $dao) {
        $nomeDaClasse = get_class($obj);
        if ($obj instanceof $nomeDaClasse) {

            foreach ((array) $obj as $campo => $valor) {
                $campo = str_replace("\0{$nomeDaClasse}\0", "", $campo);
                $campoArr[$campo] = $campo;
            }

            $arrObj = array_values((array) $obj);

            $campoArr = implode(', ', array_keys($campoArr));
            $valores = " '" . implode("','", array_values($arrObj)) . "' ";

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
