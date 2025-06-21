<?php
require_once __DIR__ . '/../models/TipoProjeto.php';

class TiposProjetoController {
    public function index() {
        $tipos = TipoProjeto::all();
        require_once __DIR__ . '/../views/dashboard/tipos_projeto/index.php';
    }

    public function novo() {
        require_once __DIR__ . '/../views/dashboard/tipos_projeto/novo.php';
    }

    public function salvar() {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $dados = [
                    'sigla' => htmlspecialchars($_POST['sigla']),
                    'descricao' => htmlspecialchars($_POST['descricao'])
                ];
                if (TipoProjeto::create($dados)) {
                    $_SESSION['success'] = "Tipo de projeto cadastrado com sucesso!";
                    header('Location: ' . BASE_URL . 'tiposProjeto');
                    exit;
                } else {
                    $_SESSION['error'] = "Erro ao cadastrar tipo de projeto!";
                }
            }
            require_once __DIR__ . '/../views/dashboard/tipos_projeto/novo.php';
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            require_once __DIR__ . '/../views/dashboard/tipos_projeto/novo.php';
        }
    }

    public function editar($id) {
        $tipo = TipoProjeto::find($id);
        require_once __DIR__ . '/../views/dashboard/tipos_projeto/editar.php';
    }

    public function atualizar($id) {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $dados = [
                    'sigla' => htmlspecialchars($_POST['sigla']),
                    'descricao' => htmlspecialchars($_POST['descricao'])
                ];
                if (TipoProjeto::update($id, $dados)) {
                    $_SESSION['success'] = "Tipo de projeto atualizado com sucesso!";
                    header('Location: ' . BASE_URL . 'tiposProjeto');
                    exit;
                } else {
                    $_SESSION['error'] = "Erro ao atualizar tipo de projeto!";
                }
            }
            $tipo = TipoProjeto::find($id);
            require_once __DIR__ . '/../views/dashboard/tipos_projeto/editar.php';
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            $tipo = TipoProjeto::find($id);
            require_once __DIR__ . '/../views/dashboard/tipos_projeto/editar.php';
        }
    }

    public function excluir($id) {
        if (TipoProjeto::delete($id)) {
            $_SESSION['success'] = "Tipo de projeto excluído com sucesso!";
        } else {
            $_SESSION['error'] = "Erro ao excluir tipo de projeto!";
        }
        header('Location: ' . BASE_URL . 'tiposProjeto');
        exit;
    }

    public function pesquisarAjax() {
        header('Content-Type: application/json; charset=utf-8');
        $termo = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_SPECIAL_CHARS);
        $tipos = ($termo === null || $termo === '')
            ? TipoProjeto::all()
            : TipoProjeto::search($termo);
        echo json_encode($tipos);
        exit;
    }
}
