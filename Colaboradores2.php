<?php


// Inclui a conexão com o banco de dados
include 'conexao.php';

// Verifica se o botão de "Mostrar Desativados" foi clicado
$mostrar_desativados = isset($_GET['mostrar_desativados']) && $_GET['mostrar_desativados'] == '1';

// Obtém o termo de busca, se houver
$termo_busca = isset($_GET['busca']) ? $_GET['busca'] : '';

// Verifica se o formulário foi enviado para adicionar um novo colaborador
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adicionar_colaborador'])) {
    $codigo_interno = $_POST['codigo_interno'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografa a senha
    $tipo_pessoa = $_POST['tipo_pessoa'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $acesso = $_POST['acesso'];
    $status = $_POST['status'];
    $cargo = $_POST['cargo'];

    // Insere o novo colaborador no banco de dados
    $sql_insert = "INSERT INTO tb_colaboradores (codigo_interno, nome, email, senha, tipo_pessoa, cidade, estado, acesso, status, cargo) 
                   VALUES (:codigo_interno, :nome, :email, :senha, :tipo_pessoa, :cidade, :estado, :acesso, :status, :cargo)";
    $stmt_insert = $pdo->prepare($sql_insert);
    $stmt_insert->execute([
        ':codigo_interno' => $codigo_interno,
        ':nome' => $nome,
        ':email' => $email,
        ':senha' => $senha,
        ':tipo_pessoa' => $tipo_pessoa,
        ':cidade' => $cidade,
        ':estado' => $estado,
        ':acesso' => $acesso,
        ':status' => $status,
        ':cargo' => $cargo
    ]);
}

// Define a consulta SQL com base no filtro de busca
if ($mostrar_desativados) {
    // Mostrar colaboradores desativados com filtro de busca
    $sql = "SELECT id, codigo_interno, nome, email, tipo_pessoa, cidade, estado, acesso, status, cargo
            FROM tb_colaboradores
            WHERE status = 'desativado' AND (nome LIKE :termo_busca OR cargo LIKE :termo_busca OR email LIKE :termo_busca 
            OR tipo_pessoa LIKE :termo_busca OR cidade LIKE :termo_busca)";
} else {
    // Mostrar colaboradores ativos com filtro de busca
    $sql = "SELECT id, codigo_interno, nome, email, tipo_pessoa, cidade, estado, acesso, status, cargo
            FROM tb_colaboradores
            WHERE status = 'ativo' AND (nome LIKE :termo_busca OR cargo LIKE :termo_busca OR email LIKE :termo_busca 
            OR tipo_pessoa LIKE :termo_busca OR cidade LIKE :termo_busca)";
}

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':termo_busca' => '%' . $termo_busca . '%' // Adiciona o filtro de busca
]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colaboradores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   <script>
        // Função para realizar a busca ao vivo
        function liveSearch() {
            var search = document.getElementById('search').value;
            window.location.href = '?busca=' + search;
        }
    </script>
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Lista de Colaboradores</h1>

        <!-- Campo de busca ao vivo -->
        <div class="mb-3">
            <input type="text" id="search" class="form-control" placeholder="Buscar por nome, cargo, email, tipo de pessoa, cidade" onkeyup="liveSearch()" value="<?php echo htmlspecialchars($termo_busca); ?>">
        </div>

        <!-- Botão para mostrar colaboradores desativados -->
        <?php if (!$mostrar_desativados): ?>
            <a href="?mostrar_desativados=1" class="btn btn-warning mb-3">Mostrar Desativados</a>
        <?php else: ?>
            <!-- Botão para voltar à lista ativa -->
            <a href="?" class="btn btn-secondary mb-3">Voltar à Lista Ativa</a>
        <?php endif; ?>

        <!-- Tabela de colaboradores -->
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Código Interno</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Tipo de Pessoa</th>
                    <th>Cidade</th>
                    <th>Cargo</th>
                    <th>Acesso</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $colaborador) { ?>
                    <tr>
                        <td><?php echo $colaborador['codigo_interno']; ?></td>
                        <td><?php echo $colaborador['nome']; ?></td>
                        <td><?php echo $colaborador['email']; ?></td>
                        <td><?php echo $colaborador['tipo_pessoa']; ?></td>
                        <td><?php echo $colaborador['cidade']; ?></td>
                        <td><?php echo $colaborador['cargo']; ?></td>
                        <td><?php echo $colaborador['acesso']; ?></td>
                        <td><?php echo $colaborador['status'] == 'ativo' ? 'Ativo' : 'Desativado'; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Formulário para adicionar novo colaborador -->
        <h2 class="mt-5 mb-4">Adicionar Novo Colaborador</h2>
        <form method="POST" class="row g-3">
            <div class="col-md-6">
                <label for="codigo_interno" class="form-label">Código Interno</label>
                <input type="text" name="codigo_interno" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" name="senha" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="tipo_pessoa" class="form-label">Tipo de Pessoa</label>
                <select name="tipo_pessoa" class="form-select">
                    <option value="PF">Pessoa Física</option>
                    <option value="PJ">Pessoa Jurídica</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="cidade" class="form-label">Cidade</label>
                <input type="text" name="cidade" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="estado" class="form-label">Estado</label>
                <input type="text" name="estado" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="acesso" class="form-label">Acesso</label>
                <select name="acesso" class="form-select">
                    <option value="administrador">Administrador</option>
                    <option value="calculista">Calculista</option>
                    <option value="diretor">Diretor</option>
                    <option value="free lancer">Free Lance</option>
                    <option value="gerente">Gerente</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="ativo">Ativo</option>
                    <option value="desativado">Desativado</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="acesso" class="form-label">Cargo</label>
                <select name="cargo" class="form-select">
                    <option value="administrador">Administrador</option>
                    <option value="calculista">Calculista</option>
                    <option value="diretor">Diretor</option>
                    <option value="free lancer">Free Lance</option>
                    <option value="gerente">Gerente</option>
                </select>
            </div>
            <div class="col-md-12">
                <button type="submit" name="adicionar_colaborador" class="btn btn-primary">Adicionar Colaborador</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
