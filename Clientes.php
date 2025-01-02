<?php
include('conexao.php');

// Inserir novo cliente
if (isset($_POST['add_cliente'])) {
    $codigointerno = $_POST['codigointerno'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $categoria = $_POST['categoria'];
    $origem = $_POST['origem'];
    $status = $_POST['status'];

    $sql = "INSERT INTO clientes (codigointerno, nome, email, categoria, origem, status)
            VALUES (:codigointerno, :nome, :email, :categoria, :origem, :status)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':codigointerno', $codigointerno);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':origem', $origem);
    $stmt->bindParam(':status', $status);

    if ($stmt->execute()) {
        echo "Cliente adicionado com sucesso!";
    } else {
        echo "Erro ao adicionar cliente!";
    }
}

// Buscar clientes ativos
$sql_ativos = "SELECT * FROM clientes WHERE status = 'ativo'";
$stmt_ativos = $pdo->query($sql_ativos);
$clientes_ativos = $stmt_ativos->fetchAll(PDO::FETCH_ASSOC);

// Buscar clientes inativos
$sql_inativos = "SELECT * FROM clientes WHERE status = 'inativo'";
$stmt_inativos = $pdo->query($sql_inativos);
$clientes_inativos = $stmt_inativos->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h2>Clientes</h2>

    <!-- Formulário de Adicionar Cliente -->
    <form method="POST">
        <div class="form-group">
            <label for="codigointerno">Código Interno</label>
            <input type="text" class="form-control" name="codigointerno" required>
        </div>
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="nome" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
            <label for="categoria">Categoria</label>
            <select class="form-control" name="categoria" required>
                <option value="PJ">PJ</option>
                <option value="PF">PF</option>
            </select>
        </div>
        <div class="form-group">
            <label for="origem">Origem</label>
            <input type="text" class="form-control" name="origem" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" name="status" required>
                <option value="ativo">Ativo</option>
                <option value="inativo">Inativo</option>
            </select>
        </div>
        <button type="submit" name="add_cliente" class="btn btn-primary">Adicionar Cliente</button>
    </form>

    <!-- Busca ao Vivo -->
    <div class="mt-4">
        <label for="busca">Buscar Cliente:</label>
        <input type="text" id="busca" class="form-control" placeholder="Pesquise por nome ou código">
    </div>

    <!-- Tabela de Clientes Ativos -->
    <h3 class="mt-4">Clientes Ativos</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Código Interno</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Categoria</th>
                <th>Origem</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="clientesAtivos">
            <?php foreach ($clientes_ativos as $cliente): ?>
                <tr class="cliente" data-id="<?= $cliente['id'] ?>">
                    <td><?= $cliente['codigointerno'] ?></td>
                    <td><?= $cliente['nome'] ?></td>
                    <td><?= $cliente['email'] ?></td>
                    <td><?= $cliente['categoria'] ?></td>
                    <td><?= $cliente['origem'] ?></td>
                    <td><?= $cliente['status'] ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm editBtn" data-toggle="modal" data-target="#editModal" data-id="<?= $cliente['id'] ?>">Editar</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Botão para Mostrar Inativos -->
    <button id="showInativos" class="btn btn-secondary">Mostrar Inativos</button>

    <!-- Tabela de Clientes Inativos (inicialmente oculta) -->
    <h3 class="mt-4" id="inativosTitle" style="display:none;">Clientes Inativos</h3>
    <table class="table table-bordered" id="clientesInativos" style="display:none;">
        <thead>
            <tr>
                <th>Código Interno</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Categoria</th>
                <th>Origem</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes_inativos as $cliente): ?>
                <tr class="cliente" data-id="<?= $cliente['id'] ?>">
                    <td><?= $cliente['codigointerno'] ?></td>
                    <td><?= $cliente['nome'] ?></td>
                    <td><?= $cliente['email'] ?></td>
                    <td><?= $cliente['categoria'] ?></td>
                    <td><?= $cliente['origem'] ?></td>
                    <td><?= $cliente['status'] ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm editBtn" data-toggle="modal" data-target="#editModal" data-id="<?= $cliente['id'] ?>">Editar</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Modal de Edição -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulário de Edição -->
                    <form id="editForm">
                        <input type="hidden" name="id" id="editId">
                        <div class="form-group">
                            <label for="editCodigoInterno">Código Interno</label>
                            <input type="text" class="form-control" name="codigointerno" id="editCodigoInterno" required>
                        </div>
                        <div class="form-group">
                            <label for="editNome">Nome</label>
                            <input type="text" class="form-control" name="nome" id="editNome" required>
                        </div>
                        <div class="form-group">
                            <label for="editEmail">Email</label>
                            <input type="email" class="form-control" name="email" id="editEmail" required>
                        </div>
                        <div class="form-group">
                            <label for="editCategoria">Categoria</label>
                            <select class="form-control" name="categoria" id="editCategoria" required>
                                <option value="PJ">PJ</option>
                                <option value="PF">PF</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editOrigem">Origem</label>
                            <input type="text" class="form-control" name="origem" id="editOrigem" required>
                        </div>
                        <div class="form-group">
                            <label for="editStatus">Status</label>
                            <select class="form-control" name="status" id="editStatus" required>
                                <option value="ativo">Ativo</option>
                                <option value="inativo">Inativo</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Busca ao vivo
    $("#busca").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#clientesAtivos .cliente, #clientesInativos .cliente").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    // Mostrar/ocultar clientes inativos
    $("#showInativos").click(function() {
        $("#clientesInativos").toggle();
        $("#inativosTitle").toggle();
    });

    // Preencher o formulário de edição
    $(".editBtn").click(function() {
        var id = $(this).data('id');
        $.ajax({
            url: 'get_cliente.php',  // Arquivo PHP para buscar os dados do cliente
            method: 'GET',
            data: { id: id },
            success: function(response) {
                var cliente = JSON.parse(response);
                $("#editId").val(cliente.id);
                $("#editCodigoInterno").val(cliente.codigointerno);
                $("#editNome").val(cliente.nome);
                $("#editEmail").val(cliente.email);
                $("#editCategoria").val(cliente.categoria);
                $("#editOrigem").val(cliente.origem);
                $("#editStatus").val(cliente.status);
            }
        });
    });

    // Enviar o formulário de edição
    $("#editForm").submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: 'edit_cliente.php',  // Arquivo PHP para editar cliente
            method: 'POST',
            data: formData,
            success: function(response) {
                alert(response);
                location.reload();  // Recarregar a página para mostrar as edições
            }
        });
    });
});
</script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
