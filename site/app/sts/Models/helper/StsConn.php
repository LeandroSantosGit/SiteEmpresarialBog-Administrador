<?php

namespace Sts\Models\helper;

use PDO;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsConn
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsConn
{
    
    public static $host = HOST;
    public static $Uuser = USER;
    public static $pass = PASS;
    public static $dbname = DBNAME;
    private static $connect = null;
    
    private static function connect()
    {
        try {
            if (self::$connect == null) {
                self::$connect = new PDO('mysql:host=' .self::$host . ';dbname='
                . self::$dbname, self::$Uuser, self::$pass);
            }
        } catch (Exception $exc) {
            echo 'mensagem: ' . $exc->getMessage();
            die;
        }
        return self::$connect;
    }
    
    public function getConn()
    {
        return self::connect();
    }
}
