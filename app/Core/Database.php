<?php

class Database
{
    private static $connection = null;

    public static function getConnection()
    {
        if (self::$connection == null) {
            self::$connection = new PDO('mysql:host=localhost;dbname=webqual_db', 'root', '');
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$connection;
    }
}
