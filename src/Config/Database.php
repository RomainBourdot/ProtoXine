<?php

namespace ProtoXine\App\Config;

use PDO;
use PDOException;

class Database {
    private static ?PDO $instance = null;

    private function __construct() {}

    public static function getConnection(): PDO {
        if (self::$instance === null) {
            try {
                $host = $_ENV['DB_HOST'] ?? 'localhost';
                $db   = $_ENV['DB_NAME'] ?? 'protoxine';
                $user = $_ENV['DB_USER'] ?? 'root';
                $pass = $_ENV['DB_PASS'] ?? '';

                $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

                self::$instance = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);
            } catch (PDOException $e) {
                // On changera en prod
                die("Erreur de connexion SQL : " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}