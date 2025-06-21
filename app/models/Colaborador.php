<?php
class Colaborador {
   public static function all() {
    $pdo = require __DIR__ . '/../config/db.php';
    $stmt = $pdo->query('SELECT * FROM colaboradores ORDER BY nome');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public static function create($dados) {
    $pdo = require __DIR__ . '/../config/db.php';
    $stmt = $pdo->prepare('INSERT INTO colaboradores (codigo, nome, email, nivel_acesso, status, cargo, usuario, senha) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    return $stmt->execute([
        $dados['codigo'],
        $dados['nome'],
        $dados['email'],
        $dados['nivel_acesso'],
        $dados['status'],
        $dados['cargo'],
        $dados['usuario'],
        password_hash($dados['senha'], PASSWORD_DEFAULT)
    ]);
}
    public static function find($id) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare('SELECT * FROM colaboradores WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
public static function update($id, $dados) {
    $pdo = require __DIR__ . '/../config/db.php';
    if (!empty($dados['senha'])) {
        $stmt = $pdo->prepare('UPDATE colaboradores SET codigo=?, nome=?, email=?, nivel_acesso=?, status=?, cargo=?, usuario=?, senha=? WHERE id=?');
        return $stmt->execute([
            $dados['codigo'],
            $dados['nome'],
            $dados['email'],
            $dados['nivel_acesso'],
            $dados['status'],
            $dados['cargo'],
            $dados['usuario'],
            password_hash($dados['senha'], PASSWORD_DEFAULT),
            $id
        ]);
    } else {
        $stmt = $pdo->prepare('UPDATE colaboradores SET codigo=?, nome=?, email=?, nivel_acesso=?, status=?, cargo=?, usuario=? WHERE id=?');
        return $stmt->execute([
            $dados['codigo'],
            $dados['nome'],
            $dados['email'],
            $dados['nivel_acesso'],
            $dados['status'],
            $dados['cargo'],
            $dados['usuario'],
            $id
        ]);
    }
}


    public static function delete($id) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare('DELETE FROM colaboradores WHERE id=?');
        return $stmt->execute([$id]);
    }

    public static function search($termo) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare('SELECT * FROM colaboradores WHERE nome LIKE ? OR codigo LIKE ? OR cargo LIKE ? ORDER BY nome');
        $like = "%$termo%";
        $stmt->execute([$like, $like, $like]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function autenticar($usuario, $senha) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare('SELECT * FROM colaboradores WHERE usuario=?');
        $stmt->execute([$usuario]);
        $colaborador = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($colaborador && password_verify($senha, $colaborador['senha'])) {
            return $colaborador;
        }
        return false;
    }

    public static function niveisAcesso() {
        return [
            'freelancer' => 'Freelancer',
            'projetista' => 'Projetista',
            'calculista' => 'Calculista',
            'verificador' => 'Verificador',
            'adm'        => 'Administrador',
            'estagiario' => 'Estagiário'
        ];
    }

    public static function autenticarPorEmail($email, $senha) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare('SELECT * FROM colaboradores WHERE email = ? AND status = "ativo"');
        $stmt->execute([$email]);
        $colaborador = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($colaborador && password_verify($senha, $colaborador['senha'])) {
            return $colaborador;
        }
        return false;
    }
    
    
    
}
