<?php
require_once __DIR__ . '/Database.php';

class Cliente
{
    public static function all()
    {
        $db = Database::connect();
        return $db->query("SELECT * FROM clientes ORDER BY id DESC")->fetchAll();
    }

    public static function find($id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM clientes WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function create($dados)
    {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO clientes 
            (codigo, codigo_interno, nome, status) 
            VALUES 
            (:codigo, :codigo_interno, :nome, :status)");
            
        return $stmt->execute([
            ':codigo' => $dados['codigo'],
            ':codigo_interno' => $dados['codigo_interno'],
            ':nome' => $dados['nome'],
            ':status' => $dados['status']
        ]);
    }

    public static function update($id, $dados)
    {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE clientes SET 
            codigo = :codigo,
            codigo_interno = :codigo_interno,
            nome = :nome,
            status = :status 
            WHERE id = :id");
            
        return $stmt->execute([
            ':codigo' => $dados['codigo'],
            ':codigo_interno' => $dados['codigo_interno'],
            ':nome' => $dados['nome'],
            ':status' => $dados['status'],
            ':id' => $id
        ]);
    }

    public static function delete($id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM clientes WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function search($termo)
    {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM clientes 
            WHERE 
            codigo LIKE :termo OR 
            codigo_interno LIKE :termo OR 
            nome LIKE :termo");
            
        $likeTerm = '%' . $termo . '%';
        $stmt->bindParam(':termo', $likeTerm);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
