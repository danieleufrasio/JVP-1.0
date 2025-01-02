<?php
require 'conexao.php'; // Certifique-se de que o arquivo conexao.php está configurado corretamente

// Adicionar banco
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adicionar_banco'])) {
    $nome = $_POST['nome'];
    $agencia = $_POST['agencia'];
    $chave_pix = $_POST['chave_pix'];
    $status = 'ativo'; // Status padrão ao adicionar um novo banco

    $stmt = $pdo->prepare("INSERT INTO bancos (nome, agencia, chave_pix, status) VALUES (:nome, :agencia, :chave_pix, :status)");
    $stmt->execute(['nome' => $nome, 'agencia' => $agencia, 'chave_pix' => $chave_pix, 'status' => $status]);
}

// Atualizar status do banco
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['atualizar_status'])) {
    $id = $_POST['id'];
    $novo_status = $_POST['status'] === 'ativo' ? 'inativo' : 'ativo';

    $stmt = $pdo->prepare("UPDATE bancos SET status = :status WHERE id = :id");
    $stmt->execute(['status' => $novo_status, 'id' => $id]);
}

// Obter os bancos
$bancosAtivos = $pdo->query("SELECT * FROM bancos WHERE status = 'ativo'")->fetchAll(PDO::FETCH_ASSOC);
$bancosInativos = $pdo->query("SELECT * FROM bancos WHERE status = 'inativo'")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bancos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .custom-select-styled {
    background-color: #f8f9fa; /* Cor de fundo suave */
    color: #495057; /* Cor do texto */
    border: 2px solid #007bff; /* Borda azul */
    border-radius: 8px; /* Bordas arredondadas */
    padding: 8px 12px; /* Espaçamento interno */
    font-size: 16px; /* Tamanho do texto */
    outline: none; /* Remove o contorno ao clicar */
    transition: all 0.3s ease-in-out; /* Animação ao focar */
}

.custom-select-styled:focus {
    border-color: #0056b3; /* Cor da borda ao focar */
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Sombra ao focar */
}

.custom-select-styled option {
    padding: 5px; /* Espaçamento nos itens */
    font-size: 14px; /* Ajuste do tamanho das opções */
}
    </style>
</head>
<body>
<div class="container mt-4">
    <h1 class="text-center">Gerenciamento de Bancos</h1>
    <div class="d-flex justify-content-between mb-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionarBanco">Adicionar Banco</button>
        <button class="btn btn-secondary" id="toggleInativos">Mostrar Bancos Inativos</button>
        <input type="text" id="search" class="form-control w-25" placeholder="Buscar banco...">
    </div>

    <!-- Tabela de Bancos Ativos -->
    <div id="ativosSection">
        <h4>Bancos Ativos</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Agência</th>
                    <th>Chave PIX</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="bancosAtivos">
                <?php foreach ($bancosAtivos as $banco): ?>
                    <tr>
                        <td><?= htmlspecialchars($banco['nome']) ?></td>
                        <td><?= htmlspecialchars($banco['agencia']) ?></td>
                        <td><?= htmlspecialchars($banco['chave_pix']) ?></td>
                        <td><?= htmlspecialchars($banco['status']) ?></td>
                        <td>
                            <form method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?= $banco['id'] ?>">
                                <input type="hidden" name="status" value="<?= $banco['status'] ?>">
                                <button type="submit" name="atualizar_status" class="btn btn-warning">Alterar Status</button>
                            </form>
                            <a href="api_banco.php?id=<?= $banco['id'] ?>" class="btn btn-success">Acessar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Tabela de Bancos Inativos -->
    <div id="inativosSection" style="display: none;">
        <h4>Bancos Inativos</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Agência</th>
                    <th>Chave PIX</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="bancosInativos">
                <?php foreach ($bancosInativos as $banco): ?>
                    <tr>
                        <td><?= htmlspecialchars($banco['nome']) ?></td>
                        <td><?= htmlspecialchars($banco['agencia']) ?></td>
                        <td><?= htmlspecialchars($banco['chave_pix']) ?></td>
                        <td><?= htmlspecialchars($banco['status']) ?></td>
                        <td>
                            <form method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?= $banco['id'] ?>">
                                <input type="hidden" name="status" value="<?= $banco['status'] ?>">
                                <button type="submit" name="atualizar_status" class="btn btn-warning">Alterar Status</button>
                            </form>
                            <a href="api_banco.php?id=<?= $banco['id'] ?>" class="btn btn-success">Acessar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal para Adicionar Banco -->
<div class="modal fade" id="modalAdicionarBanco" tabindex="-1" aria-labelledby="modalAdicionarBancoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAdicionarBancoLabel">Adicionar Novo Banco</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="agencia">Agência:</label>
                        <input type="text" class="form-control" id="agencia" name="agencia" required>
                    </div>
                    <div class="form-group">
                        <label for="chave_pix">Chave PIX:</label>
                        <input type="text" class="form-control" id="chave_pix" name="chave_pix" required>
                    </div>
                        <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select custom-select-styled" required>
                    <option value="ativo">Ativo</option>
                    <option value="inativo">Inativo</option>
                </select>
            </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" name="adicionar_banco" class="btn btn-primary">Adicionar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Alternar visibilidade de bancos inativos
    document.getElementById('toggleInativos').addEventListener('click', function () {
        const inativosSection = document.getElementById('inativosSection');
        if (inativosSection.style.display === 'none') {
            inativosSection.style.display = '';
            this.textContent = 'Ocultar Bancos Inativos';
        } else {
            inativosSection.style.display = 'none';
            this.textContent = 'Mostrar Bancos Inativos';
        }
    });

    // Buscador ao vivo
    document.getElementById('search').addEventListener('keyup', function () {
        const query = this.value.toLowerCase();
        const rowsAtivos = document.querySelectorAll('#bancosAtivos tr');
        const rowsInativos = document.querySelectorAll('#bancosInativos tr');
        [...rowsAtivos, ...rowsInativos].forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(query) ? '' : 'none';
        });
    });
</script>
</body>
</html>
