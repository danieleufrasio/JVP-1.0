<?php
require_once __DIR__ . '/../models/Prancha.php';
require_once __DIR__ . '/../models/Cliente.php';
require_once __DIR__ . '/../models/Obra.php';
require_once __DIR__ . '/../models/TipoProjeto.php';
require_once __DIR__ . '/../models/Elemento.php';
require_once __DIR__ . '/../models/Pavimento.php';
require_once __DIR__ . '/../models/TipoPapel.php';
require_once __DIR__ . '/../models/Colaborador.php';

class PranchasController {
    public function index() {
        $pranchas = Prancha::all();
        require __DIR__ . '/../views/dashboard/pranchas/index.php';
    }

    public function novo() {
        $clientes = Cliente::all();
        $obras = Obra::all();
        $tiposProjeto = TipoProjeto::all();
        $elementos = Elemento::all();
        $pavimentos = Pavimento::all();
        $tiposPapel = TipoPapel::all();
        $colaboradores = Colaborador::all();
        require __DIR__ . '/../views/dashboard/pranchas/novo.php';
    }

    public function salvar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'cliente_id' => $_POST['cliente_id'],
                'obra_id' => $_POST['obra_id'],
                'previsao_conclusao' => $_POST['previsao_conclusao'],
                'conclusao' => $_POST['conclusao'],
                'tipo_projeto_id' => $_POST['tipo_projeto_id'],
                'numero_prancha' => $_POST['numero_prancha'],
                'elemento_id' => $_POST['elemento_id'],
                'pavimento_id' => $_POST['pavimento_id'],
                'revisao' => $_POST['revisao'],
                'tipo_papel_id' => $_POST['tipo_papel_id'],
                'observacao' => $_POST['observacao'],
                'status' => $_POST['status'],
                'projetado_id' => $_POST['projetado_id'],
                'verificado_id' => $_POST['verificado_id'],
                'calculado_id' => $_POST['calculado_id'],
            ];
            Prancha::create($dados);
            header('Location: ' . BASE_URL . 'pranchas');
            exit;
        }
    }

    public function editar($id) {
        $prancha = Prancha::find($id);
        $clientes = Cliente::all();
        $obras = Obra::all();
        $tiposProjeto = TipoProjeto::all();
        $elementos = Elemento::all();
        $pavimentos = Pavimento::all();
        $tiposPapel = TipoPapel::all();
        $colaboradores = Colaborador::all();
        require __DIR__ . '/../views/pranchas/dashboard/editar.php';
    }

    public function atualizar($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'cliente_id' => $_POST['cliente_id'],
                'obra_id' => $_POST['obra_id'],
                'previsao_conclusao' => $_POST['previsao_conclusao'],
                'conclusao' => $_POST['conclusao'],
                'tipo_projeto_id' => $_POST['tipo_projeto_id'],
                'numero_prancha' => $_POST['numero_prancha'],
                'elemento_id' => $_POST['elemento_id'],
                'pavimento_id' => $_POST['pavimento_id'],
                'revisao' => $_POST['revisao'],
                'tipo_papel_id' => $_POST['tipo_papel_id'],
                'observacao' => $_POST['observacao'],
                'status' => $_POST['status'],
                'projetado_id' => $_POST['projetado_id'],
                'verificado_id' => $_POST['verificado_id'],
                'calculado_id' => $_POST['calculado_id'],
            ];
            Prancha::update($id, $dados);
            header('Location: ' . BASE_URL . 'pranchas');
            exit;
        }
    }

    public function excluir($id) {
        Prancha::delete($id);
        header('Location: ' . BASE_URL . 'pranchas');
        exit;
    }

    public function pesquisar() {
        $termo = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_SPECIAL_CHARS);
        $pranchas = $termo ? Prancha::search($termo) : Prancha::all();
        require __DIR__ . '/../views/dashboard/pranchas/index.php';
    }

    // Extra: replicar, imagem, escolha podem ser implementados como métodos adicionais
}
