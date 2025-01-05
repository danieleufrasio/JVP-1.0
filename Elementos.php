<?php
require_once 'conexao.php'; // Arquivo de conexão com o banco de dados

// Adicionar novo elemento
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_elemento'])) {
    $sigla = $_POST['sigla'];
    $descricao = $_POST['descricao'];
    $tipos_projeto_id = $_POST['tipos_projeto_id'];

    $sql = "INSERT INTO elementos (sigla, descricao, tipos_projeto_id) VALUES (:sigla, :descricao, :tipos_projeto_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':sigla' => $sigla,
        ':descricao' => $descricao,
        ':tipos_projeto_id' => $tipos_projeto_id,
    ]);

    echo "Elemento adicionado com sucesso!";
    exit;
}

// Editar elemento
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_elemento'])) {
    $id = $_POST['id'];
    $sigla = $_POST['sigla'];
    $descricao = $_POST['descricao'];
    $tipos_projeto_id = $_POST['tipos_projeto_id'];

    $sql = "UPDATE elementos SET sigla = :sigla, descricao = :descricao, tipos_projeto_id = :tipos_projeto_id WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':sigla' => $sigla,
        ':descricao' => $descricao,
        ':tipos_projeto_id' => $tipos_projeto_id,
        ':id' => $id,
    ]);

    echo "Elemento atualizado com sucesso!";
    exit;
}

// Buscar elementos
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['get_elementos'])) {
    $sql = "SELECT e.id, e.sigla AS elemento_sigla, e.descricao, tp.sigla AS projeto_sigla 
            FROM elementos e
            INNER JOIN tipos_projetos tp ON e.tipos_projeto_id = tp.id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result);
    exit;
}

// Buscar siglas dos projetos para popular o <select>
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['get_projetos'])) {
    $sql = "SELECT id, sigla FROM tipos_projetos";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result);
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Elementos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1>Gerenciar Elementos</h1>
        <!-- Campo de Busca -->
        <div class="mb-3">
            <label for="search" class="form-label">Buscar Elemento</label>
            <input type="text" class="form-control" id="search" placeholder="Digite para buscar...">
        </div>

        <!-- Formulário de Adicionar Elemento -->
        <form id="addForm" class="mt-3">
            <div class="mb-3">
                <label for="sigla" class="form-label">Sigla do Elemento</label>
                <input type="text" class="form-control" id="sigla" name="sigla" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" required>
            </div>
            <div class="mb-3">
                <label for="tiposProjeto" class="form-label">Projeto</label>
                <select class="form-control" id="tiposProjeto" name="tipos_projeto_id" required></select>
            </div>
            <button type="submit" class="btn btn-success">Adicionar</button>
        </form>

        <!-- Formulário de Edição -->
        <form id="editForm" class="mt-5" style="display: none;">
            <input type="hidden" id="editId" name="id">
            <div class="mb-3">
                <label for="editSigla" class="form-label">Sigla do Elemento</label>
                <input type="text" class="form-control" id="editSigla" name="sigla" required>
            </div>
            <div class="mb-3">
                <label for="editDescricao" class="form-label">Descrição</label>
                <input type="text" class="form-control" id="editDescricao" name="descricao" required>
            </div>
            <div class="mb-3">
                <label for="editTiposProjeto" class="form-label">Projeto</label>
                <select class="form-control" id="editTiposProjeto" name="tipos_projeto_id" required></select>
            </div>
            <button type="submit" class="btn btn-warning">Salvar</button>
        </form>

        <!-- Tabela de Elementos -->
        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th>Sigla</th>
                    <th>Descrição</th>
                    <th>Projeto</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="elementosTable">
                <!-- Conteúdo será carregado via JavaScript -->
            </tbody>
        </table>
    </div>

    <script>
        // Função para carregar os projetos e popular o <select>
        function carregarProjetos() {
            $.get('elementos.php', { get_projetos: true }, function(data) {
                const projetos = JSON.parse(data);
                let options = '<option value="" disabled selected>Selecione um projeto</option>';
                projetos.forEach(projeto => {
                    options += `<option value="${projeto.id}">${projeto.sigla}</option>`;
                });
                $('#tiposProjeto').html(options);
                $('#editTiposProjeto').html(options);
            });
        }

        // Função para carregar elementos existentes
        function carregarElementos() {
            $.get('elementos.php', { get_elementos: true }, function(data) {
                const elementos = JSON.parse(data);
                let rows = '';
                elementos.forEach(elemento => {
                    rows += `
                        <tr>
                            <td>${elemento.elemento_sigla}</td>
                            <td>${elemento.descricao}</td>
                            <td>${elemento.projeto_sigla}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="editarElemento(${elemento.id}, '${elemento.elemento_sigla}', '${elemento.descricao}', ${elemento.tipos_projeto_id})">Editar</button>
                            </td>
                        </tr>
                    `;
                });
                $('#elementosTable').html(rows);
            });
        }

        // Função para preencher o formulário de edição
        function editarElemento(id, sigla, descricao, tiposProjetoId) {
            $('#editId').val(id);
            $('#editSigla').val(sigla);
            $('#editDescricao').val(descricao);
            $('#editTiposProjeto').val(tiposProjetoId);
            $('#editForm').show();
            $('html, body').animate({ scrollTop: $('#editForm').offset().top }, 'slow');
        }

        // Carregar projetos e elementos ao abrir a página
        $(document).ready(function() {
            carregarProjetos();
            carregarElementos();

                       // Adicionar elemento
                       $('#addForm').submit(function(e) {
                e.preventDefault();
                const formData = $(this).serialize();
                $.post('elementos.php', formData + '&add_elemento=true', function(response) {
                    alert(response);
                    $('#addForm')[0].reset();
                    carregarElementos(); // Atualiza a tabela de elementos
                });
            });

            // Editar elemento
            $('#editForm').submit(function(e) {
                e.preventDefault();
                const formData = $(this).serialize();
                $.post('elementos.php', formData + '&edit_elemento=true', function(response) {
                    alert(response);
                    $('#editForm')[0].reset();
                    $('#editForm').hide();
                    carregarElementos(); // Atualiza a tabela de elementos
                });
            });
        });
        $(document).ready(function() {
    carregarProjetos();
    carregarElementos();

    // Adicionar elemento
    $('#addForm').submit(function(e) {
        e.preventDefault();
        const formData = $(this).serialize();
        $.post('elementos.php', formData + '&add_elemento=true', function(response) {
            alert(response);
            $('#addForm')[0].reset();
            carregarElementos(); // Atualiza a tabela de elementos
        });
    });

    // Editar elemento
    $('#editForm').submit(function(e) {
        e.preventDefault();
        const formData = $(this).serialize();
        $.post('elementos.php', formData + '&edit_elemento=true', function(response) {
            alert(response);
            $('#editForm')[0].reset();
            $('#editForm').hide();
            carregarElementos(); // Atualiza a tabela de elementos
        });
    });

    // Função para filtrar elementos ao digitar no campo de busca
    $('#search').keyup(function() {
        const searchTerm = $(this).val().toLowerCase();
        $('#elementosTable tr').each(function() {
            const sigla = $(this).find('td').eq(0).text().toLowerCase();
            const descricao = $(this).find('td').eq(1).text().toLowerCase();
            const projeto = $(this).find('td').eq(2).text().toLowerCase();

            if (sigla.includes(searchTerm) || descricao.includes(searchTerm) || projeto.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});

    </script>
</body>
</html>

