<?php
class Obra {
    public static function all() {
        $pdo = require __DIR__ . '/../config/db.php'; // Correto
        $stmt = $pdo->query('SELECT obras.*, clientes.nome AS cliente_nome FROM obras LEFT JOIN clientes ON obras.cliente_id = clientes.id');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $pdo = require __DIR__ . '/../config/db.php'; // Corrigido
        $stmt = $pdo->prepare('SELECT * FROM obras WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($dados) {
        $pdo = require __DIR__ . '/../config/db.php'; // Corrigido
        $stmt = $pdo->prepare('INSERT INTO obras (codigo, obra, cliente_id, ano, status, outros_campos) VALUES (?, ?, ?, ?, ?, ?)');
        return $stmt->execute([
            $dados['codigo'],
            $dados['obra'],
            $dados['cliente_id'],
            $dados['ano'],
            $dados['status'],
            $dados['outros_campos'] ?? ''
        ]);
    }

    public static function update($id, $dados) {
        $pdo = require __DIR__ . '/../config/db.php'; // Corrigido
        $stmt = $pdo->prepare('UPDATE obras SET codigo=?, obra=?, cliente_id=?, ano=?, status=?, outros_campos=? WHERE id=?');
        return $stmt->execute([
            $dados['codigo'],
            $dados['obra'],
            $dados['cliente_id'],
            $dados['ano'],
            $dados['status'],
            $dados['outros_campos'] ?? '',
            $id
        ]);
    }

    public static function delete($id) {
        $pdo = require __DIR__ . '/../config/db.php'; // Corrigido
        $stmt = $pdo->prepare('DELETE FROM obras WHERE id=?');
        return $stmt->execute([$id]);
    }

    public static function search($termo) {
        $pdo = require __DIR__ . '/../config/db.php'; // Corrigido
        $stmt = $pdo->prepare('SELECT obras.*, clientes.nome AS cliente_nome FROM obras LEFT JOIN clientes ON obras.cliente_id = clientes.id WHERE obras.codigo LIKE ? OR obras.obra LIKE ? OR clientes.nome LIKE ?');
        $like = "%$termo%";
        $stmt->execute([$like, $like, $like]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
