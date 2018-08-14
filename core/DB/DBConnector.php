<?php

namespace core\DB;

class DBConnector
{
    private static $db;

    public static function getPDO($host = 'localhost', $datebase = 'blog', $user = 'root', $password = '')
    {
        if(self::$db === null){
            self::$db  = new \PDO("mysql:host={$host};dbname={$datebase}", $user, $password);
            self::$db ->exec('SET NAMES UTF8');
        }

        return self::$db;
    }

}