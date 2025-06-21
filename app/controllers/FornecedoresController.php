<?php
require_once __DIR__ . '/../models/Fornecedor.php';

class FornecedoresController {
    public function index() {
        $fornecedores = Fornecedor::all();
        require __DIR__ . '/../views/dashboard/fornecedores/index.php';
    }

    public function novo() {
        require __DIR__ . '/../views/dashboard/fornecedores/novo.php';
    }

    public function salvar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'codigo' => $_POST['codigo'],
                'fornecedor' => $_POST['fornecedor'],
                'status' => $_POST['status'],
                'email' => $_POST['email'],
                'categoria' => $_POST['categoria']
            ];
            Fornecedor::create($dados);
            header('Location: ' . BASE_URL . 'fornecedores');
            exit;
        }
    }

    public function editar($id) {
        $fornecedor = Fornecedor::find($id);
        require __DIR__ . '/../views/fornecedores/dashboard/editar.php';
    }

    public function atualizar($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'codigo' => $_POST['codigo'],
                'fornecedor' => $_POST['fornecedor'],
                'status' => $_POST['status'],
                'email' => $_POST['email'],
                'categoria' => $_POST['categoria']
            ];
            Fornecedor::update($id, $dados);
            header('Location: ' . BASE_URL . 'fornecedores');
            exit;
        }
    }

    public function excluir($id) {
        Fornecedor::delete($id);
        header('Location: ' . BASE_URL . 'fornecedores');
        exit;
    }

    public function pesquisar() {
        $termo = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_SPECIAL_CHARS);
        $fornecedores = $termo ? Fornecedor::search($termo) : Fornecedor::all();
        require __DIR__ . '/../views/dashboard/fornecedores/index.php';
    }
}
