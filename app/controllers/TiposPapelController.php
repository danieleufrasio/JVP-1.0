<?php
require_once __DIR__ . '/../models/TipoPapel.php';

class TiposPapelController {
    public function index() {
        $tipos = TipoPapel::all();
        require_once __DIR__ . '/../views/dashboard/tipos_papel/index.php';
    }

    public function novo() {
        $equivalencias = TipoPapel::equivalencias();
        require_once __DIR__ . '/../views/dashboard/tipos_papel/novo.php';
    }
    
    public function salvar() {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $equivalencias = TipoPapel::equivalencias();
                $siglaEquivalencia = $_POST['equivalencia'];
                $valorEquivalencia = isset($equivalencias[$siglaEquivalencia]) ? $equivalencias[$siglaEquivalencia] : null;
    
                if ($valorEquivalencia === null) {
                    $_SESSION['error'] = "Equivalência inválida!";
                    header('Location: ' . BASE_URL . 'tiposPapel/novo');
                    exit;
                }
    
                $dados = [
                    'sigla' => htmlspecialchars($_POST['sigla']),
                    'descricao' => htmlspecialchars($_POST['descricao']),
                    'equivalencia' => $siglaEquivalencia,
                    'valor_equivalencia' => $valorEquivalencia
                ];
                if (TipoPapel::create($dados)) {
                    $_SESSION['success'] = "Tipo de papel cadastrado com sucesso!";
                    header('Location: ' . BASE_URL . 'tiposPapel');
                    exit;
                } else {
                    $_SESSION['error'] = "Erro ao cadastrar tipo de papel!";
                }
            }
            $equivalencias = TipoPapel::equivalencias();
            require_once __DIR__ . '/../views/dashboard/tipos_papel/novo.php';
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            $equivalencias = TipoPapel::equivalencias();
            require_once __DIR__ . '/../views/dashboard/tipos_papel/novo.php';
        }
    }
    
    public function editar($id) {
        $tipo = TipoPapel::find($id);
        $equivalencias = TipoPapel::equivalencias();
        require_once __DIR__ . '/../views/dashboard/tipos_papel/editar.php';
    }
    
    public function atualizar($id) {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $equivalencias = TipoPapel::equivalencias();
                $siglaEquivalencia = $_POST['equivalencia'];
                $valorEquivalencia = isset($equivalencias[$siglaEquivalencia]) ? $equivalencias[$siglaEquivalencia] : null;
    
                if ($valorEquivalencia === null) {
                    $_SESSION['error'] = "Equivalência inválida!";
                    header('Location: ' . BASE_URL . 'tiposPapel/editar/' . $id);
                    exit;
                }
    
                $dados = [
                    'sigla' => htmlspecialchars($_POST['sigla']),
                    'descricao' => htmlspecialchars($_POST['descricao']),
                    'equivalencia' => $siglaEquivalencia,
                    'valor_equivalencia' => $valorEquivalencia
                ];
                if (TipoPapel::update($id, $dados)) {
                    $_SESSION['success'] = "Tipo de papel atualizado com sucesso!";
                    header('Location: ' . BASE_URL . 'tiposPapel');
                    exit;
                } else {
                    $_SESSION['error'] = "Erro ao atualizar tipo de papel!";
                }
            }
            $tipo = TipoPapel::find($id);
            $equivalencias = TipoPapel::equivalencias();
            require_once __DIR__ . '/../views/dashboard/tipos_papel/editar.php';
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            $tipo = TipoPapel::find($id);
            $equivalencias = TipoPapel::equivalencias();
            require_once __DIR__ . '/../views/dashboard/tipos_papel/editar.php';
        }
    }

    public function excluir($id) {
        if (TipoPapel::delete($id)) {
            $_SESSION['success'] = "Tipo de papel excluído com sucesso!";
        } else {
            $_SESSION['error'] = "Erro ao excluir tipo de papel!";
        }
        header('Location: ' . BASE_URL . 'tiposPapel');
        exit;
    }
}
