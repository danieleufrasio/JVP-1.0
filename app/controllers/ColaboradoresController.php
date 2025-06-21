<?php
require_once __DIR__ . '/../models/Colaborador.php';

class ColaboradoresController {
    public function index() {
        $colaboradores = Colaborador::all();
        require_once __DIR__ . '/../views/dashboard/colaboradores/index.php';
    }

    public function novo() {
        $niveis = Colaborador::niveisAcesso();
        require_once __DIR__ . '/../views/dashboard/colaboradores/novo.php';
    }

    public function salvar() {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $dados = [
                    'codigo'        => htmlspecialchars(trim($_POST['codigo'])),
                    'nome'          => htmlspecialchars(trim($_POST['nome'])),
                    'email'         => filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL),
                    'nivel_acesso'  => htmlspecialchars(trim($_POST['nivel_acesso'])),
                    'status'        => htmlspecialchars(trim($_POST['status'])),
                    'cargo'         => htmlspecialchars(trim($_POST['cargo'])),
                    'usuario'       => htmlspecialchars(trim($_POST['usuario'])),
                    'senha'         => $_POST['senha']
                ];
                if (!$dados['email']) {
                    $_SESSION['error'] = "E-mail inválido!";
                } elseif (empty($dados['senha'])) {
                    $_SESSION['error'] = "Senha não pode ser vazia!";
                } elseif (Colaborador::create($dados)) {
                    $_SESSION['success'] = "Colaborador cadastrado!";
                    header('Location: ' . BASE_URL . 'colaboradores');
                    exit;
                } else {
                    $_SESSION['error'] = "Erro ao cadastrar colaborador!";
                }
            }
            $niveis = Colaborador::niveisAcesso();
            require_once __DIR__ . '/../views/dashboard/colaboradores/novo.php';
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            $niveis = Colaborador::niveisAcesso();
            require_once __DIR__ . '/../views/dashboard/colaboradores/novo.php';
        }
    }

    public function editar($id) {
        $colaborador = Colaborador::find($id);
        $niveis = Colaborador::niveisAcesso();
        require_once __DIR__ . '/../views/dashboard/colaboradores/editar.php';
    }

    public function atualizar($id) {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $dados = [
                    'codigo'        => htmlspecialchars(trim($_POST['codigo'])),
                    'nome'          => htmlspecialchars(trim($_POST['nome'])),
                    'email'         => filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL),
                    'nivel_acesso'  => htmlspecialchars(trim($_POST['nivel_acesso'])),
                    'status'        => htmlspecialchars(trim($_POST['status'])),
                    'cargo'         => htmlspecialchars(trim($_POST['cargo'])),
                    'usuario'       => htmlspecialchars(trim($_POST['usuario'])),
                    'senha'         => $_POST['senha'] // pode estar vazio
                ];
                if (!$dados['email']) {
                    $_SESSION['error'] = "E-mail inválido!";
                } elseif (Colaborador::update($id, $dados)) {
                    $_SESSION['success'] = "Colaborador atualizado!";
                    header('Location: ' . BASE_URL . 'colaboradores');
                    exit;
                } else {
                    $_SESSION['error'] = "Erro ao atualizar colaborador!";
                }
            }
            $colaborador = Colaborador::find($id);
            $niveis = Colaborador::niveisAcesso();
            require_once __DIR__ . '/../views/dashboard/colaboradores/editar.php';
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            $colaborador = Colaborador::find($id);
            $niveis = Colaborador::niveisAcesso();
            require_once __DIR__ . '/../views/dashboard/colaboradores/editar.php';
        }
    }

    public function excluir($id) {
        if (Colaborador::delete($id)) {
            $_SESSION['success'] = "Colaborador excluído!";
        } else {
            $_SESSION['error'] = "Erro ao excluir colaborador!";
        }
        header('Location: ' . BASE_URL . 'colaboradores');
        exit;
    }

    public function pesquisarAjax() {
        header('Content-Type: application/json; charset=utf-8');
        $termo = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_SPECIAL_CHARS);
        $colaboradores = ($termo === null || $termo === '')
            ? Colaborador::all()
            : Colaborador::search($termo);
        echo json_encode($colaboradores);
        exit;
    }
}
