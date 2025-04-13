<?php

class Database
{
    private static $db;
    public static function getConnection()
    {
        try
        {
            if(empty(self::$db))
            {
                $pdo = new PDO('mysql:host=' . _SERVER_DB_ . ';dbname=' . _DB_ . ';charset=utf8', _USER_DB_, _PASSWORD_DB_);
                $mitz="America/Lima";
                $tz = (new DateTime('now', new DateTimeZone($mitz)))->format('P');
                $pdo->exec("SET time_zone='$tz';");
                //Sirve para indicar al PDO que todo lo que retorne sean objetos
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                //Sirve para indicar que si encuentra error, los muestre
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$db = $pdo;
            }
            return self::$db;
        } 
        catch (Throwable $e)
        {
            require _VIEW_PATH_ . 'error/error_db.php';
            exit;
        }
    }
}