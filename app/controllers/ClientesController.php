<?php
require_once __DIR__ . '/../models/Cliente.php';

class ClientesController {
    public function index() {
        try {
            $clientes = Cliente::all();
            require_once __DIR__ . '/../views/dashboard/clientes/index.php';
        } catch (Exception $e) {
            $this->handleError($e);
        }
    }

    public function novo() {
        require_once __DIR__ . '/../views/dashboard/clientes/novo.php';
    }

    public function salvar() {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->validateFormData();
                $dados = [
                    'codigo' => htmlspecialchars($_POST['codigo']),
                    'codigo_interno' => htmlspecialchars($_POST['codigo_interno']),
                    'nome' => htmlspecialchars($_POST['nome']),
                    'status' => htmlspecialchars($_POST['status'] ?? 'Ativo')
                ];

                if (Cliente::create($dados)) {
                    $_SESSION['success'] = "Cliente cadastrado com sucesso!";
                    header('Location: ' . BASE_URL . 'clientes');
                    exit;
                } else {
                    $_SESSION['error'] = "Erro ao cadastrar cliente!";
                    require_once __DIR__ . '/../views/dashboard/clientes/novo.php';
                }
            }
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            require_once __DIR__ . '/../views/dashboard/clientes/novo.php';
        }
    }

    public function editar($id) {
        try {
            $cliente = Cliente::find((int)$id);
            if (!$cliente) {
                throw new Exception("Cliente não encontrado!");
            }
            require_once __DIR__ . '/../views/dashboard/clientes/editar.php';
        } catch (Exception $e) {
            $this->handleError($e);
        }
    }

    public function atualizar($id) {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->validateFormData();
                $dados = [
                    'codigo' => htmlspecialchars($_POST['codigo']),
                    'codigo_interno' => htmlspecialchars($_POST['codigo_interno']),
                    'nome' => htmlspecialchars($_POST['nome']),
                    'status' => htmlspecialchars($_POST['status'] ?? 'Ativo')
                ];

                if (Cliente::update((int)$id, $dados)) {
                    $_SESSION['success'] = "Cliente atualizado com sucesso!";
                    header('Location: ' . BASE_URL . 'clientes');
                    exit;
                } else {
                    $_SESSION['error'] = "Erro ao atualizar cliente!";
                    $cliente = Cliente::find((int)$id);
                    require_once __DIR__ . '/../views/dashboard/clientes/editar.php';
                }
            }
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            $cliente = Cliente::find((int)$id);
            require_once __DIR__ . '/../views/dashboard/clientes/editar.php';
        }
    }

    public function excluir($id) {
        try {
            if (Cliente::delete((int)$id)) {
                $_SESSION['success'] = "Cliente excluído com sucesso!";
            } else {
                $_SESSION['error'] = "Erro ao excluir cliente!";
            }
            header('Location: ' . BASE_URL . 'clientes');
            exit;
        } catch (Exception $e) {
            $this->handleError($e);
        }
    }

    public function pesquisar() {
        try {
            $termo = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_SPECIAL_CHARS);
            $clientes = $termo ? Cliente::search($termo) : [];
            require_once __DIR__ . '/../views/dashboard/clientes/index.php';
        } catch (Exception $e) {
            $this->handleError($e);
        }
    }

    public function pesquisarAjax() {
        header('Content-Type: application/json; charset=utf-8');
        $termo = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_SPECIAL_CHARS);
        // Se não houver termo, retorna todos
        $clientes = $termo === null || $termo === ''
            ? Cliente::all()
            : Cliente::search($termo);
        echo json_encode($clientes);
        exit;
    }
    
    

    private function validateFormData() {
        $required = ['codigo', 'codigo_interno', 'nome'];
        foreach ($required as $field) {
            if (empty($_POST[$field])) {
                throw new Exception("O campo " . ucfirst($field) . " é obrigatório!");
            }
        }
    }

    private function handleError($e) {
        $_SESSION['error'] = $e->getMessage();
        header('Location: ' . BASE_URL . 'clientes');
        exit;
    }
}
