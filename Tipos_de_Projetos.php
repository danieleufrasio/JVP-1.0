<?php
// Inclui a conexão com o banco de dados
require 'conexao.php';

// Adicionar ou editar tipo de projeto
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_cliente'])) {
    $sigla = $_POST['sigla'];
    $descricao = $_POST['descricao'];
    $id = isset($_POST['id']) ? $_POST['id'] : null;

    try {
        if ($id) {
            // Editar registro existente
            $query = "UPDATE tipos_projetos SET sigla = :sigla, descricao = :descricao WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id);
        } else {
            // Adicionar novo registro
            $query = "INSERT INTO tipos_projetos (sigla, descricao) VALUES (:sigla, :descricao)";
            $stmt = $pdo->prepare($query);
        }

        $stmt->bindParam(':sigla', $sigla);
        $stmt->bindParam(':descricao', $descricao);

        if ($stmt->execute()) {
            header("Location: tipos_de_projetos.php");
            exit;
        } else {
            $erro = "Erro ao salvar os dados.";
        }
    } catch (PDOException $e) {
        $erro = "Erro no banco de dados: " . $e->getMessage();
    }
}

// Excluir registro
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    try {
        $query = "DELETE FROM tipos_projetos WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            header("Location: tipos_de_projetos.php");
            exit;
        } else {
            $erro = "Erro ao excluir o registro.";
        }
    } catch (PDOException $e) {
        $erro = "Erro no banco de dados: " . $e->getMessage();
    }
}

// Buscar dados
if (isset($_GET['search'])) {
    $search = '%' . $_GET['search'] . '%';
    $sql = "SELECT * FROM tipos_projetos WHERE sigla LIKE :search OR descricao LIKE :search";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':search' => $search]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
    exit;
} else {
    $sql = "SELECT * FROM tipos_projetos";
    $stmt = $pdo->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Tipos de Projetos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Gerenciar Tipos de Projetos</h2>
    
    <?php if (isset($erro)): ?>
        <div class="alert alert-danger"><?= $erro; ?></div>
    <?php endif; ?>

    <!-- Formulário -->
    <form id="form-projeto" method="POST" class="mb-4">
        <input type="hidden" name="id" id="id">
        <div class="mb-3">
            <label for="sigla" class="form-label">Sigla</label>
            <input type="text" name="sigla" id="sigla" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" name="descricao" id="descricao" class="form-control" required>
        </div>
        <button type="submit" name="add_cliente" class="btn btn-primary">Salvar</button>
    </form>

    <!-- Campo de busca -->
    <input type="text" id="search" class="form-control mb-3" placeholder="Buscar sigla ou descrição">

    <!-- Tabela -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Sigla</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="table-body">
            <?php foreach ($result as $registro): ?>
                <tr>
                    <td><?= $registro['sigla'] ?></td>
                    <td><?= $registro['descricao'] ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm btn-edit" 
                                data-id="<?= $registro['id'] ?>" 
                                data-sigla="<?= $registro['sigla'] ?>" 
                                data-descricao="<?= $registro['descricao'] ?>">Editar</button>
                        <a href="?delete_id=<?= $registro['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Deseja excluir?');">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
$(document).ready(function () {
    // Buscar ao vivo
    $('#search').on('input', function () {
        let query = $(this).val();
        $.get('?search=' + query, function (data) {
            const registros = JSON.parse(data);
            let rows = '';
            registros.forEach(registro => {
                rows += `
                    <tr>
                        <td>${registro.sigla}</td>
                        <td>${registro.descricao}</td>
                        <td>
                            <button class="btn btn-warning btn-sm btn-edit" 
                                    data-id="${registro.id}" 
                                    data-sigla="${registro.sigla}" 
                                    data-descricao="${registro.descricao}">Editar</button>
                            <a href="?delete_id=${registro.id}" class="btn btn-danger btn-sm" onclick="return confirm('Deseja excluir?');">Excluir</a>
                        </td>
                    </tr>`;
            });
            $('#table-body').html(rows);
        });
    });

    // Editar registro
    $(document).on('click', '.btn-edit', function () {
        const id = $(this).data('id');
        const sigla = $(this).data('sigla');
        const descricao = $(this).data('descricao');
        $('#id').val(id);
        $('#sigla').val(sigla);
        $('#descricao').val(descricao);
    });
});
</script>
</body>
</html>
