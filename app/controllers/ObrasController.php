<?php
require_once __DIR__ . '/../models/Obra.php';
require_once __DIR__ . '/../models/Cliente.php';

class ObrasController
{
    // Exibe a lista de obras
    public function index()
    {
        $obras = Obra::all();
        require_once __DIR__ . '/../views/dashboard/obras/index.php';
    }

    // Exibe o formulário de nova obra
    public function novo()
    {
        $clientes = Cliente::all();
        require_once __DIR__ . '/../views/dashboard/obras/novo.php';
    }

    // Salva uma nova obra
    public function salvar()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $dados = [
                    'codigo'        => htmlspecialchars($_POST['codigo']),
                    'obra'          => htmlspecialchars($_POST['obra']),
                    'cliente_id'    => (int)$_POST['cliente_id'],
                    'ano'           => htmlspecialchars($_POST['ano']),
                    'status'        => htmlspecialchars($_POST['status']),
                    'outros_campos' => htmlspecialchars($_POST['outros_campos'] ?? '')
                ];
                if (Obra::create($dados)) {
                    $_SESSION['success'] = "Obra cadastrada com sucesso!";
                    header('Location: ' . BASE_URL . 'obras');
                    exit;
                } else {
                    $_SESSION['error'] = "Erro ao cadastrar obra!";
                }
            }
            // Se não for POST ou houve erro, exibe o formulário novamente
            $clientes = Cliente::all();
            require_once __DIR__ . '/../views/dashboard/obras/novo.php';
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            $clientes = Cliente::all();
            require_once __DIR__ . '/../views/dashboard/obras/novo.php';
        }
    }

    // Exibe o formulário de edição de obra
    public function editar($id)
    {
        $obra = Obra::find($id);
        $clientes = Cliente::all();
        require_once __DIR__ . '/../views/dashboard/obras/editar.php';
    }

    // Atualiza uma obra existente
    public function atualizar($id)
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $dados = [
                    'codigo'        => htmlspecialchars($_POST['codigo']),
                    'obra'          => htmlspecialchars($_POST['obra']),
                    'cliente_id'    => (int)$_POST['cliente_id'],
                    'ano'           => htmlspecialchars($_POST['ano']),
                    'status'        => htmlspecialchars($_POST['status']),
                    'outros_campos' => htmlspecialchars($_POST['outros_campos'] ?? '')
                ];
                if (Obra::update($id, $dados)) {
                    $_SESSION['success'] = "Obra atualizada com sucesso!";
                    header('Location: ' . BASE_URL . 'obras');
                    exit;
                } else {
                    $_SESSION['error'] = "Erro ao atualizar obra!";
                }
            }
            // Se não for POST ou houve erro, exibe o formulário novamente
            $obra = Obra::find($id);
            $clientes = Cliente::all();
            require_once __DIR__ . '/../views/dashboard/obras/editar.php';
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            $obra = Obra::find($id);
            $clientes = Cliente::all();
            require_once __DIR__ . '/../views/dashboard/obras/editar.php';
        }
    }

    // Exclui uma obra
    public function excluir($id)
    {
        if (Obra::delete($id)) {
            $_SESSION['success'] = "Obra excluída com sucesso!";
        } else {
            $_SESSION['error'] = "Erro ao excluir obra!";
        }
        header('Location: ' . BASE_URL . 'obras');
        exit;
    }

    // Busca ao vivo (AJAX)
    public function pesquisarAjax()
    {
        header('Content-Type: application/json; charset=utf-8');
        $termo = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_SPECIAL_CHARS);
        $obras = ($termo === null || $termo === '')
            ? Obra::all()
            : Obra::search($termo);
        echo json_encode($obras);
        exit;
    }
}
