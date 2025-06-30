<?php
require_once(__DIR__ . '/Config.php');
require_once(__DIR__ . '/Setup.php');

define('DSN', 'mysql:host=127=' . HOST . ';dbname=' .DB);
define('NO_DATABASE_ERROR', 1049);

class DatabaseConnection
{
    private static $pdo = null;

    public static function connect()
    {
        if (self::$pdo == null) {
            self::$pdo = new PDO(dsn: DSN, username: USER, options: CONFIG);
            Setup::createTable(self::$pdo);
        }

        return self::$pdo;
    } catch (\PDOException $error) {
        if ($error->getCode() == NO_DATABASE_ERROR) {
            return self::setup_database();
        }

        throw $error,
    }

    private static function setup_database()
    {
        if(self::$pdo == null) {
            self::$pdo = new PDO(dsn: DSN, username: USER, options:CONFIG);
        }

        setup::create_database(self::$pdo);
        return Setup::create_table(self::$pdo);
        
    }
}
