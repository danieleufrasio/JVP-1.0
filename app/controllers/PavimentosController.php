<?php
require_once __DIR__ . '/../models/Pavimento.php';

class PavimentosController {
    public function index() {
        $pavimentos = Pavimento::all();
        require __DIR__ . '/../views/dashboard/pavimentos/index.php';
    }

    public function novo() {
        require __DIR__ . '/../views/dashboard/pavimentos/novo.php';
    }

    public function salvar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'sigla' => $_POST['sigla'],
                'pavimento' => $_POST['pavimento']
            ];
            Pavimento::create($dados);
            header('Location: ' . BASE_URL . 'pavimentos');
            exit;
        }
    }

    public function editar($id) {
        $pavimento = Pavimento::find($id);
        require __DIR__ . '/../views/dashboard/pavimentos/editar.php';
    }

    public function atualizar($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'sigla' => $_POST['sigla'],
                'pavimento' => $_POST['pavimento']
            ];
            Pavimento::update($id, $dados);
            header('Location: ' . BASE_URL . 'pavimentos');
            exit;
        }
    }

    public function excluir($id) {
        Pavimento::delete($id);
        header('Location: ' . BASE_URL . 'pavimentos');
        exit;
    }

    public function pesquisar() {
        $termo = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_SPECIAL_CHARS);
        $pavimentos = $termo ? Pavimento::search($termo) : Pavimento::all();
        require __DIR__ . '/../views/dashboard/pavimentos/index.php';
    }
}
