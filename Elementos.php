<?php
require_once 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados

// Adicionar novo elemento
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_elemento'])) {
    $sigla = $_POST['sigla'];
    $descricao = $_POST['descricao']; // Nova coluna 'descricao'
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
    $descricao = $_POST['descricao']; // Nova coluna 'descricao'
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

// Buscar elementos ao vivo
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search'])) {
    $search = $_GET['search'];

    $sql = "SELECT e.id, e.sigla AS elemento_sigla, e.descricao, tp.sigla AS projeto_sigla 
            FROM elementos e
            INNER JOIN tipos_projetos tp ON e.tipos_projeto_id = tp.id
            WHERE e.sigla LIKE :search OR tp.sigla LIKE :search";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':search' => "%$search%"]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result);
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Elementos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="mb-4">Gerenciar Elementos</h1>

        <!-- Botão para adicionar novo elemento -->
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal">Adicionar Elemento</button>

        <!-- Campo de busca -->
        <input type="text" id="search" class="form-control mb-4" placeholder="Buscar elementos...">

        <!-- Tabela de elementos -->
        <table class="table table-bordered">
            <thead>
                <tr>
                <th>Tipo do projeto</th>
                    <th>Sigla</th>
                    <th>Descrição</th>
                  
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="elementosTable">
                <!-- Dados serão carregados via AJAX -->
            </tbody>
        </table>
    </div>

    <!-- Modal para adicionar elemento -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="addForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Adicionar Elemento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">

                    <div class="mb-3">
                            <label for="addTiposProjeto" class="form-label">Tipo de Projeto</label>
                            <select id="addTiposProjeto" name="tipos_projeto_id" class="form-control" required>
                        <div class="mb-3">
                            <label for="addSigla" class="form-label">Sigla</label>
                            <input type="text" id="addSigla" name="sigla" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="addDescricao" class="form-label">Descrição</label>
                            <input type="text" id="addDescricao" name="descricao" class="form-control" required>
                        </div>
                       
                                <?php
                                $stmt = $pdo->query("SELECT id, sigla FROM tipos_projetos");
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value='{$row['id']}'>{$row['sigla']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal para editar elemento -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Elemento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editId" name="id">

                        <div class="mb-3">
                            <label for="editTiposProjeto" class="form-label">Tipo de Projeto</label>
                            <select id="editTiposProjeto" name="tipos_projeto_id" class="form-control" required>
                        <div class="mb-3">
                            <label for="editSigla" class="form-label">Sigla</label>
                            <input type="text" id="editSigla" name="sigla" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDescricao" class="form-label">Descrição</label>
                            <input type="text" id="editDescricao" name="descricao" class="form-control" required>
                        </div>
                        
                                <?php
                                $stmt = $pdo->query("SELECT id, sigla FROM tipos_projetos");
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value='{$row['id']}'>{$row['sigla']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Função para buscar elementos ao vivo
        function fetchElementos(query = '') {
            $.get('Elementos.php', { search: query }, function(data) {
                const elementos = JSON.parse(data);
                let rows = '';
                elementos.forEach(elemento => {
                    rows += `
                        <tr>
                             <td>${elemento.projeto_sigla}</td>
                            <td>${elemento.elemento_sigla}</td>
                            <td>${elemento.descricao}</td>
                           
                            <td>
                                <button class="btn btn-warning btn-sm editBtn"  
                                    data-tipos_projeto_id="${elemento.projeto_sigla}
                                    data-sigla="${elemento.elemento_sigla}" 
                                    data-descricao="${elemento.descricao}" 
                                    ">
                                    Editar
                                </button>
                            </td>
                        </tr>
                    `;
                });
                $('#elementosTable').html(rows);
            });
        }

        // Carrega os elementos ao abrir a página
        fetchElementos();

        // Busca ao vivo
        $('#search').on('input', function() {
            fetchElementos($(this).val());
        });

        // Adicionar elemento
        $('#addForm').on('submit', function(e) {
            e.preventDefault();
            $.post('Elementos.php', $(this).serialize() + '&add_elemento=true', function(response) {
                alert(response);
                fetchElementos();
                $('#addModal').modal('hide');
            });
        });

        // Editar elemento
        $('#editForm').on('submit', function(e) {
            e.preventDefault();
            $.post('Elementos.php', $(this).serialize() + '&edit_elemento=true', function(response) {
                alert(response);
                fetchElementos();
                $('#editModal').modal('hide');
            });
        });

        // Preencher modal de edição
        $(document).on('click', '.editBtn', function() {
            $('#editId').val($(this).data('id'));
            $('#editTiposProjeto').val($(this).data('tipos_projeto_id'));
            $('#editSigla').val($(this).data('sigla'));
            $('#editDescricao').val($(this).data('descricao'));
        
            $('#editModal').modal('show');
        });
    </script>
</body>
</html>
