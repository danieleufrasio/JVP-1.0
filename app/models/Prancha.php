<?php
class Prancha {
    public static function all() {
        $pdo = require __DIR__ . '/../config/db.php';
                $sql = "SELECT p.*, 
                c.nome AS cliente_nome, 
                o.obra AS obra_nome, 
                tp.sigla AS tipo_projeto_sigla, 
                e.sigla AS elemento_sigla, 
                pav.sigla AS pavimento_sigla, 
                tpapel.descricao AS tipo_papel_nome,
                col_proj.nome AS projetado_nome,
                col_ver.nome AS verificado_nome,
                col_calc.nome AS calculado_nome
        FROM pranchas p
        LEFT JOIN clientes c ON p.cliente_id = c.id
        LEFT JOIN obras o ON p.obra_id = o.id
        LEFT JOIN tipos_projeto tp ON p.tipo_projeto_id = tp.id
        LEFT JOIN elementos e ON p.elemento_id = e.id
        LEFT JOIN pavimentos pav ON p.pavimento_id = pav.id
        LEFT JOIN tipos_papel tpapel ON p.tipo_papel_id = tpapel.id
        LEFT JOIN colaboradores col_proj ON p.projetado_id = col_proj.id
        LEFT JOIN colaboradores col_ver ON p.verificado_id = col_ver.id
        LEFT JOIN colaboradores col_calc ON p.calculado_id = col_calc.id
        ORDER BY p.id DESC";


        return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("SELECT * FROM pranchas WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($dados) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("INSERT INTO pranchas 
            (cliente_id, obra_id, previsao_conclusao, conclusao, tipo_projeto_id, numero_prancha, elemento_id, pavimento_id, revisao, tipo_papel_id, observacao, status, projetado_id, verificado_id, calculado_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $dados['cliente_id'],
            $dados['obra_id'],
            $dados['previsao_conclusao'],
            $dados['conclusao'],
            $dados['tipo_projeto_id'],
            $dados['numero_prancha'],
            $dados['elemento_id'],
            $dados['pavimento_id'],
            $dados['revisao'],
            $dados['tipo_papel_id'],
            $dados['observacao'],
            $dados['status'],
            $dados['projetado_id'],
            $dados['verificado_id'],
            $dados['calculado_id']
        ]);
    }

    public static function update($id, $dados) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("UPDATE pranchas SET 
            cliente_id=?, obra_id=?, previsao_conclusao=?, conclusao=?, tipo_projeto_id=?, numero_prancha=?, elemento_id=?, pavimento_id=?, revisao=?, tipo_papel_id=?, observacao=?, status=?, projetado_id=?, verificado_id=?, calculado_id=?
            WHERE id=?");
        return $stmt->execute([
            $dados['cliente_id'],
            $dados['obra_id'],
            $dados['previsao_conclusao'],
            $dados['conclusao'],
            $dados['tipo_projeto_id'],
            $dados['numero_prancha'],
            $dados['elemento_id'],
            $dados['pavimento_id'],
            $dados['revisao'],
            $dados['tipo_papel_id'],
            $dados['observacao'],
            $dados['status'],
            $dados['projetado_id'],
            $dados['verificado_id'],
            $dados['calculado_id'],
            $id
        ]);
    }

    public static function delete($id) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("DELETE FROM pranchas WHERE id=?");
        return $stmt->execute([$id]);
    }

    public static function search($termo) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("SELECT * FROM pranchas WHERE numero_prancha LIKE ? OR observacao LIKE ?");
        $like = "%$termo%";
        $stmt->execute([$like, $like]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
