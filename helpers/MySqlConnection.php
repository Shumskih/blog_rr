<?php
require_once ROOT . '/helpers/Connection.php';

class MySqlConnection extends Connection
{
    private static $connection;

    public static function getConnection()
    {
        $dbSettings = (new Connection)->getDbSettings();

        if (!isset(self::$connection)) {
            try {
                self::$connection = new PDO(
                    "mysql:host={$dbSettings['db_host']};port={$dbSettings['db_port']};", $dbSettings['root_user'], $dbSettings['root_password'],
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                );
            } catch (PDOException $e) {
                $e->getMessage();
            }
        }
        return self::$connection;
    }
}