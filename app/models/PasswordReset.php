<?php
class PasswordReset {
    public static function create($email, $token, $expires) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)");
        $stmt->execute([$email, $token, $expires]);
    }

    public static function findValid($token) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM password_resets WHERE token = ? AND expires_at > NOW()");
        $stmt->execute([$token]);
        return $stmt->fetch();
    }

    public static function delete($email) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM password_resets WHERE email = ?");
        $stmt->execute([$email]);
    }
}
