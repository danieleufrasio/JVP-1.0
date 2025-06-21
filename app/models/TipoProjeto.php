<?php
class TipoProjeto {
    public static function all() {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->query('SELECT * FROM tipos_projeto ORDER BY sigla');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare('SELECT * FROM tipos_projeto WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($dados) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare('INSERT INTO tipos_projeto (sigla, descricao) VALUES (?, ?)');
        return $stmt->execute([
            $dados['sigla'],
            $dados['descricao']
        ]);
    }

    public static function update($id, $dados) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare('UPDATE tipos_projeto SET sigla=?, descricao=? WHERE id=?');
        return $stmt->execute([
            $dados['sigla'],
            $dados['descricao'],
            $id
        ]);
    }

    public static function delete($id) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare('DELETE FROM tipos_projeto WHERE id=?');
        return $stmt->execute([$id]);
    }

    public static function search($termo) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare('SELECT * FROM tipos_projeto WHERE sigla LIKE ? OR descricao LIKE ? ORDER BY sigla');
        $like = "%$termo%";
        $stmt->execute([$like, $like]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
