<?php
class Pavimento {
    public static function all() {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->query("SELECT * FROM pavimentos ORDER BY pavimento");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("SELECT * FROM pavimentos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($dados) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("INSERT INTO pavimentos (sigla, pavimento) VALUES (?, ?)");
        return $stmt->execute([
            $dados['sigla'],
            $dados['pavimento']
        ]);
    }

    public static function update($id, $dados) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("UPDATE pavimentos SET sigla=?, pavimento=? WHERE id=?");
        return $stmt->execute([
            $dados['sigla'],
            $dados['pavimento'],
            $id
        ]);
    }

    public static function delete($id) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("DELETE FROM pavimentos WHERE id=?");
        return $stmt->execute([$id]);
    }

    public static function search($termo) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("SELECT * FROM pavimentos WHERE sigla LIKE ? OR pavimento LIKE ?");
        $like = "%$termo%";
        $stmt->execute([$like, $like]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
