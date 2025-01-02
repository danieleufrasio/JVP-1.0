<?php
require 'conexao.php'; // Arquivo de conexão ao banco de dados

// Função para formatar datas para o padrão brasileiro
function defaultDateFormat($date) {
    return date('d/m/Y', strtotime($date));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['codigointerno'])) {
        // Adicionar uma nova obra
        $codigointerno = $_POST['codigointerno'];
        $cliente_id = $_POST['cliente_id'];
        $nome_obra = $_POST['nome_obra'];
        $endereco_obra = $_POST['endereco_obra'];
        $status_obra = $_POST['status_obra'];
        $data_inicio = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['data_inicio']))); 
        $data_fim = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['data_fim'])));
        $status = $_POST['status']; // Este é o status da obra (ativo ou inativo)

        $sql = "INSERT INTO obras (codigointerno, cliente_id, nome_obra, endereco_obra, status_obra, data_inicio, data_fim, status)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$codigointerno, $cliente_id, $nome_obra, $endereco_obra, $status_obra, $data_inicio, $data_fim, $status]);
    } elseif (isset($_POST['status_obras'])) {
        // Alterar o status de ativo/inativo da obra
        $status_obras = $_POST['status_obras']; // Status "ativo" ou "inativo"
        $id_obra = $_POST['id_obra'];

        $sql = "UPDATE obras SET status = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$status_obras, $id_obra]);
    }
}

// Recuperar obras ativas
$sql_ativas = "SELECT o.*, c.nome AS cliente_nome
               FROM obras o
               INNER JOIN clientes c ON o.cliente_id = c.id
               WHERE o.status = 'ativo'";
$stmt_ativas = $pdo->query($sql_ativas);
$obras_ativas = $stmt_ativas->fetchAll(PDO::FETCH_ASSOC);

// Recuperar obras inativas
$sql_inativas = "SELECT o.*, c.nome AS cliente_nome
                 FROM obras o
                 INNER JOIN clientes c ON o.cliente_id = c.id
                 WHERE o.status = 'inativo'";
$stmt_inativas = $pdo->query($sql_inativas);
$obras_inativas = $stmt_inativas->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <title>Obras</title>
</head>
<body>
<div class="container mt-5">
    <h1>Gerenciamento de Obras</h1>

    <!-- Formulário para adicionar obras -->
    <form method="POST" class="mb-4">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="codigointerno" class="form-label">Código Interno</label>
                <input type="text" class="form-control" name="codigointerno" id="codigointerno" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="cliente_id" class="form-label">Cliente</label>
                <select name="cliente_id" id="cliente_id" class="form-select" required>
                    <option value="">Selecione o Cliente</option>
                    <?php
                    $sql_clientes = "SELECT * FROM clientes";
                    $stmt_clientes = $pdo->query($sql_clientes);
                    $clientes = $stmt_clientes->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($clientes as $cliente) {
                        echo "<option value='" . $cliente['id'] . "'>" . $cliente['nome'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nome_obra" class="form-label">Nome da Obra</label>
                <input type="text" class="form-control" name="nome_obra" id="nome_obra" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="endereco_obra" class="form-label">Endereço da Obra</label>
                <input type="text" class="form-control" name="endereco_obra" id="endereco_obra" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="status_obra" class="form-label">Status da Obra</label>
                <select name="status_obra" id="status_obra" class="form-select" required>
                    <option value="em andamento">Em Andamento</option>
                    <option value="finalizada">Finalizada</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label for="data_inicio" class="form-label">Data de Início</label>
                <input type="text" class="form-control" name="data_inicio" id="data_inicio" placeholder="dd/mm/yyyy" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="data_fim" class="form-label">Data de Fim</label>
                <input type="text" class="form-control" name="data_fim" id="data_fim" placeholder="dd/mm/yyyy" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="ativo">Ativo</option>
                <option value="inativo">Inativo</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Adicionar Obra</button>
    </form>

    <!-- Buscador ao vivo -->
    <div class="mb-3">
        <input type="text" id="buscador" class="form-control" placeholder="Busque uma obra...">
    </div>

    <!-- Obras ativas -->
    <h2>Obras Ativas</h2>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Código Interno</th>
            <th>Cliente</th>
            <th>Nome da Obra</th>
            <th>Endereço</th>
            <th>Status</th>
            <th>Data de Início</th>
            <th>Data de Fim</th>
            <th>Alterar Status</th>
        </tr>
        </thead>
        <tbody id="tabela-obras">
        <?php foreach ($obras_ativas as $obra): ?>
            <tr>
                <td><?= $obra['codigointerno'] ?></td>
                <td><?= $obra['cliente_nome'] ?></td>
                <td><?= $obra['nome_obra'] ?></td>
                <td><?= $obra['endereco_obra'] ?></td>
                <td><?= $obra['status_obra'] ?></td>
                <td><?= defaultDateFormat($obra['data_inicio']) ?></td>
                <td><?= defaultDateFormat($obra['data_fim']) ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="id_obra" value="<?= $obra['id'] ?>">
                        <select name="status_obras" class="form-select">
                            <option value="ativo" <?= $obra['status'] == 'ativo' ? 'selected' : '' ?>>Ativo</option>
                            <option value="inativo" <?= $obra['status'] == 'inativo' ? 'selected' : '' ?>>Inativo</option>
                        </select>
                        <button type="submit" class="btn btn-success mt-2">Alterar Status</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Botão para mostrar/ocultar obras inativas -->
    <button id="mostrar-inativas" class="btn btn-secondary mb-3">Mostrar Obras Inativas</button>

    <!-- Obras inativas -->
    <div id="obras-inativas" style="display: none;">
        <h2>Obras Inativas</h2>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Código Interno</th>
                <th>Cliente</th>
                <th>Nome da Obra</th>
                <th>Endereço</th>
                <th>Status</th>
                <th>Data de Início</th>
                <th>Data de Fim</th>
                <th>Alterar Status</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($obras_inativas as $obra): ?>
                <tr>
                    <td><?= $obra['codigointerno'] ?></td>
                    <td><?= $obra['cliente_nome'] ?></td>
                    <td><?= $obra['nome_obra'] ?></td>
                    <td><?= $obra['endereco_obra'] ?></td>
                    <td><?= $obra['status_obra'] ?></td>
                    <td><?= defaultDateFormat($obra['data_inicio']) ?></td>
                    <td><?= defaultDateFormat($obra['data_fim']) ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="id_obra" value="<?= $obra['id'] ?>">
                            <select name="status_obras" class="form-select">
                                <option value="ativo" <?= $obra['status'] == 'ativo' ? 'selected' : '' ?>>Ativo</option>
                                <option value="inativo" <?= $obra['status'] == 'inativo' ? 'selected' : '' ?>>Inativo</option>
                            </select>
                            <button type="submit" class="btn btn-success mt-2">Alterar Status</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
document.getElementById('mostrar-inativas').addEventListener('click', function() {
    const obrasInativas = document.getElementById('obras-inativas');
    if (obrasInativas.style.display === 'none') {
        obrasInativas.style.display = 'block';
        this.textContent = 'Ocultar Obras Inativas';
    } else {
        obrasInativas.style.display = 'none';
        this.textContent = 'Mostrar Obras Inativas';
    }
});
</script>
</body>
</html>
