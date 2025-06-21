<?php
require_once __DIR__ . '/../models/Elemento.php';
require_once __DIR__ . '/../models/TipoProjeto.php';

class ElementosController {
    public function index() {
        $elementos = Elemento::all();
        require_once __DIR__ . '/../views/dashboard/elementos/index.php';
    }

    public function novo() {
        $tipos = TipoProjeto::all();
        require_once __DIR__ . '/../views/dashboard/elementos/novo.php';
    }

    public function salvar() {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $dados = [
                    'tipo_projeto_id' => (int)$_POST['tipo_projeto_id'],
                    'sigla' => htmlspecialchars($_POST['sigla']),
                    'descricao' => htmlspecialchars($_POST['descricao'])
                ];
                if (Elemento::create($dados)) {
                    $_SESSION['success'] = "Elemento cadastrado com sucesso!";
                    header('Location: ' . BASE_URL . 'elementos');
                    exit;
                } else {
                    $_SESSION['error'] = "Erro ao cadastrar elemento!";
                }
            }
            $tipos = TipoProjeto::all();
            require_once __DIR__ . '/../views/dashboard/elementos/novo.php';
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            $tipos = TipoProjeto::all();
            require_once __DIR__ . '/../views/dashboard/elementos/novo.php';
        }
    }

    public function editar($id) {
        $elemento = Elemento::find($id);
        $tipos = TipoProjeto::all();
        require_once __DIR__ . '/../views/dashboard/elementos/editar.php';
    }

    public function atualizar($id) {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $dados = [
                    'tipo_projeto_id' => (int)$_POST['tipo_projeto_id'],
                    'sigla' => htmlspecialchars($_POST['sigla']),
                    'descricao' => htmlspecialchars($_POST['descricao'])
                ];
                if (Elemento::update($id, $dados)) {
                    $_SESSION['success'] = "Elemento atualizado com sucesso!";
                    header('Location: ' . BASE_URL . 'elementos');
                    exit;
                } else {
                    $_SESSION['error'] = "Erro ao atualizar elemento!";
                }
            }
            $elemento = Elemento::find($id);
            $tipos = TipoProjeto::all();
            require_once __DIR__ . '/../views/dashboard/elementos/editar.php';
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            $elemento = Elemento::find($id);
            $tipos = TipoProjeto::all();
            require_once __DIR__ . '/../views/dashboard/elementos/editar.php';
        }
    }

    public function excluir($id) {
        if (Elemento::delete($id)) {
            $_SESSION['success'] = "Elemento excluído com sucesso!";
        } else {
            $_SESSION['error'] = "Erro ao excluir elemento!";
        }
        header('Location: ' . BASE_URL . 'elementos');
        exit;
    }

    public function pesquisarAjax() {
        header('Content-Type: application/json; charset=utf-8');
        $termo = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_SPECIAL_CHARS);
        $elementos = ($termo === null || $termo === '')
            ? Elemento::all()
            : Elemento::search($termo);
        echo json_encode($elementos);
        exit;
    }
}
