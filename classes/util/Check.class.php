<?php

/**
 * Check.class [ HELPER ]
 * Classe responsavel por manipular e validar dados do Sistema
 * @copyright (c) 2016, Armando JR. ELFISERVICE
 */
class Check {
    private static $data;
    private static $format;
    
    public static function email($pEmail) {
        self::$data = (string) $pEmail;
        self::$format = '/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/';
        
        if(preg_match(self::$format, self::$data)){
            return true;
        }else{
            return false;
        }
        
    }
    
    public static function nome($pNome) {
        self::$format = array();
        self::$format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
        self::$format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';
        
        self::$data = strtr(utf8_decode($pNome), utf8_decode(self::$format['a']), self::$format['b']);
        self::$data = strip_tags(trim(self::$data));
        self::$data = str_replace(' ', '-', self::$data);
        self::$data = str_replace(array('-----','----','---','--',',-',','), '-', self::$data);
        
        return strtolower(utf8_encode(self::$data));
    }
    
    public static function data($pData) {
        self::$format = explode(' ', $pData);
        self::$data = explode('/', self::$format[0]);
        
        if(empty(self::$format[1])){
            self::$format[1] = date('H:i:s');
        }
        
        self::$data = self::$data[2] . '-' . self::$data[1] .'-'. self::$data[0] . ' ' . self::$format[1];
        return self::$data;
    }
    
    public static function palavras($pString, $pLimite, $pPointer = null) {
        self::$data = strip_tags($pString);
        self::$format = (int) $pLimite;
        
        $arrPalavras = explode(' ', self::$data);
        $numPalavras = count($arrPalavras);
        $novaPalavra = implode(' ', array_slice($arrPalavras, 0, self::$format));
        
        $pointer = (empty($pPointer) ? '...' : ' ' . $pPointer);
        $resultado = ( self::$format < $numPalavras ? $novaPalavra . $pointer : self::$data);
        return $resultado;
    }
    
    public static function categoriaPorNome($pCategoriaPorNome) {
        $read = new Read();
        $read->exeRead('ws_categories', "WHERE category_name = :name", "name={$pCategoriaPorNome}");
        if($read->getRowCount()){
            return $read->getResult()[0]['category_id'];
        }else{
            echo "A categoria {$pCategoriaPorNome} não foi encontrada!";
            die();
        }
    }
        
    public static function userOnLine() {
        $now = date('Y-m-d H:i:s');
        $deleteUserOnLine = new Delete();
        $deleteUserOnLine->exeDelete('ws_siteviews_online', "WHERE online_endview < :now", "now={$now}");
        
        $readUserOnLine = new Read();
        $readUserOnLine->exeRead('ws_siteviews_online');
        return $readUserOnLine->getRowCount();
        
    }
    
    /**
     * 
     * @param type $pImagemUrl = passa URL completa ex. ../uploads/ + $imagem
     * @param type $pImagemDesc
     * @param type $pImagemW
     * @param type $pImagemH
     * @return boolean
     */
    public static function imagem($pImagemUrl, $pImagemDesc, $pImagemW = null, $pImagemH = NULL, $pClass = null) {
        self::$data = $pImagemUrl;
        
        if(file_exists(self::$data) && !is_dir(self::$data)){
            $patch = HOME;
            $imagem = self::$data;
            return "<img class=\"{$pClass}\" src=\"{$patch}/tim.php?src={$patch}/{$imagem}&w={$pImagemW}&h={$pImagemH}\" alt=\"{$pImagemDesc}\" title=\"{$pImagemDesc}\" />";
        }else{
            return false;
        }
        
    }
}
