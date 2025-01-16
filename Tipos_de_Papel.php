<?php
// Conexão com o banco de dados
include('conexao.php');

// Função para obter a equivalência do tipo de papel
function obterEquivalente($sigla) {
    switch($sigla) {
        case 'A0': return '2.00';
        case 'A1': return '1.00';
        case 'A2': return '0.50';
        case 'A3': return '0.25';
        case 'A4': return '0.125';
        default: return ''; // Caso não exista uma equivalência
    }
}

// Processar o formulário de inserção se ele for enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tipo = $_POST['tipo'];
    $descricao = $_POST['descricao'];

    // Verificação se os campos estão preenchidos
    if (!empty($tipo) && !empty($descricao)) {
        // Obter o valor de equivalência do tipo de papel
        $equivalente = obterEquivalente($tipo);

        // Lógica de inserção no banco de dados
        try {
            $stmt = $pdo->prepare("INSERT INTO tipos_de_papel (sigla, descricao, equivalente) VALUES (?, ?, ?)");
            $stmt->execute([$tipo, $descricao, $equivalente]);

            // Redirecionar de volta para a página de tipos_de_papel
            header('Location: Tipos_de_Papel.php');
            exit;
        } catch (PDOException $e) {
            $error_message = "Erro ao inserir o tipo de papel: " . $e->getMessage();
        }
    } else {
        $error_message = "Por favor, preencha todos os campos!";
    }
}

// Obter todos os tipos de papel do banco de dados
$stmt = $pdo->prepare("SELECT sigla, descricao, equivalente FROM tipos_de_papel");
$stmt->execute();
$tipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipos de Papel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJd2X+f2zIMd9pG1v99Mw6bM9c9eSTKHYvck2Wq8I4IoG1KKRjN6+Yr6e1BB" crossorigin="anonymous">
    <style>
        .paper-type-container {
            margin-top: 30px;
        }
        .container {
            max-width: 700px;
            margin-top: 50px;
        }
        .form-label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .form-control {
            font-size: 1.1rem;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Escolha o Tipo de Papel</h1>

        <!-- Exibir mensagem de erro, se houver -->
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger">
                <?= $error_message ?>
            </div>
        <?php endif; ?>

        <!-- Formulário para selecionar o tipo de papel -->
        <form method="POST" action="Tipos_de_Papel.php">
            <div class="mb-3">
                <label for="tipo" class="form-label">Selecione um Tipo de Papel:</label>
                <select name="tipo" id="tipo" class="form-select" onchange="mostrarEquivalencia()">
                    <option value="" disabled selected>Escolha...</option>
                    <option value="A0">A0</option>
                    <option value="A1">A1</option>
                    <option value="A2">A2</option>
                    <option value="A3">A3</option>
                    <option value="A4">A4</option>
                    <!-- Adicione mais opções conforme necessário -->
                </select>
            </div>

            <!-- Exibir a equivalência automaticamente ao selecionar o tipo -->
            <div class="mb-3 mt-3">
                <label for="equivalente" class="form-label">Equivalente</label>
                <input type="text" id="equivalente" class="form-control" value="" readonly>
            </div>

            <!-- Campo para inserir descrição -->
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição:</label>
                <textarea id="descricao" name="descricao" class="form-control" rows="4"></textarea>
            </div>

            <!-- Botão para adicionar -->
            <button type="submit" class="btn btn-primary w-100">Adicionar</button>
        </form>
        
        <!-- Exibir a listagem de tipos de papel -->
        <div class="mt-4">
            <h4 class="text-center">Lista de Tipos de Papel</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sigla</th>
                        <th>Descrição</th>
                        <th>Equivalente</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tipos as $tipo): ?>
                        <tr>
                            <td><?= $tipo['sigla'] ?></td>
                            <td><?= $tipo['descricao'] ?></td>
                            <td><?= obterEquivalente($tipo['sigla']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Script para atualizar a equivalência com JavaScript -->
    <script>
        function mostrarEquivalencia() {
            const tipoSelecionado = document.getElementById('tipo').value;
            const equivalenciaInput = document.getElementById('equivalente');

            let equivalencia = '';

            switch(tipoSelecionado) {
                case 'A0':
                    equivalencia = '2.00';
                    break;
                case 'A1':
                    equivalencia = '1.00';
                    break;
                case 'A2':
                    equivalencia = '0.50';
                    break;
                case 'A3':
                    equivalencia = '0.25';
                    break;
                case 'A4':
                    equivalencia = '0.125';
                    break;
                default:
                    equivalencia = '';
            }

            equivalenciaInput.value = equivalencia;
        }
    </script>
</body>
</html>
