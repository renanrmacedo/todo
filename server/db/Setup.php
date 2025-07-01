<?php
require_once(__DIR__ . '/Config.php');

class Setup
{
    public static function create_database($pdo)
    {
        $sql = "CREATE DATABASE IF NOT EXISTS " . DB;
        $pdo->exec($sql);
    }
        
    public static function create_table($pdo)
    {
        $sql = "CREATE TABLE IF NOT EXISTS tasks (
        id INT AUTO_INCREMENT PRIMARY KEY,
        description VARCHAR(500) NOT NULL,
        done BOOLEAN NOT NULL DEFAULT 0
        )";
        $pdo->exec($sql);

        return $pdo;
    }    
}