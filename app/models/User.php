<?php
require_once __DIR__ . '/Database.php';

class User {
    public static function create($name, $email, $password) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        return $stmt->execute([$name, $email, $hashed]);
    }

    public static function authenticate($email, $password) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public static function all() {
        $db = Database::connect();
        $stmt = $db->query("SELECT id, name, email FROM users");
        return $stmt->fetchAll();
    }
}
