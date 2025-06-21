<?php
// app/models/Database.php

require_once __DIR__ . '/../config/constants.php';

class Database {
    private static $instance = null;

    public static function connect() {
        if (!self::$instance) {
            try {
                self::$instance = new PDO(
                    "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
                    DB_USER,
                    DB_PASS,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (PDOException $e) {
                die("Erro de conexão com o banco de dados: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}
