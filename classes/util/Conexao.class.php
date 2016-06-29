<?php
/**
 * Conexao.class [ Conexão ]
 * Classe conexão padrão Singleton
 * Retorna um OBJ mysqli pelo metodo estatico getConn();
 * 
 * @copyright (c) 2016, Armando JR. ELFISERVICE
 */
class Conexao {

    private static $host = HOST;
    private static $user = USER;
    private static $pass = PASS;
    private static $dbsa = DBSA;

    /**
     * @var mysqli
     */
    private static $connect = null; //só vai executar a conexão se o Connect estiver NULL 

    private static function conectarMysqli() {

        try {
            if (self::$connect == null) { //Padrão SINGLETON -> so se tem uma unica INSTANCIA deste tipo PDO no sistema
                self::$connect = new mysqli(self::$host, self::$user, self::$pass, self::$dbsa);
            }
        } catch (Exception $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), $ex->getLine());
            die();
        }

        return self::$connect;
    }

    public static function desconectar() {
        self::$connect->close();
    }

    
    public static function getConn() {
        return self::conectarMysqli();
    }

    
    public static function getCloseConn() {
        return self::desconectar();
    }
    
}
