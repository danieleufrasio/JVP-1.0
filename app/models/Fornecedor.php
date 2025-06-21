<?php
class Fornecedor {
    public static function all() {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->query("SELECT * FROM fornecedores ORDER BY fornecedor");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("SELECT * FROM fornecedores WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($dados) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("INSERT INTO fornecedores (codigo, fornecedor, status, email, categoria) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([
            $dados['codigo'],
            $dados['fornecedor'],
            $dados['status'],
            $dados['email'],
            $dados['categoria']
        ]);
    }

    public static function update($id, $dados) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("UPDATE fornecedores SET codigo=?, fornecedor=?, status=?, email=?, categoria=? WHERE id=?");
        return $stmt->execute([
            $dados['codigo'],
            $dados['fornecedor'],
            $dados['status'],
            $dados['email'],
            $dados['categoria'],
            $id
        ]);
    }

    public static function delete($id) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("DELETE FROM fornecedores WHERE id=?");
        return $stmt->execute([$id]);
    }

    public static function search($termo) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("SELECT * FROM fornecedores WHERE fornecedor LIKE ? OR codigo LIKE ? OR email LIKE ?");
        $like = "%$termo%";
        $stmt->execute([$like, $like, $like]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
