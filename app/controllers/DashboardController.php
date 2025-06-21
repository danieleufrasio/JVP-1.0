<?php
require_once __DIR__ . '/../models/Colaborador.php';
require_once __DIR__ . '/../models/Cliente.php';

class DashboardController {
    private function checkAuth() {
        if (!isset($_SESSION['colaborador']) || empty($_SESSION['colaborador']['id'])) {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
    }

    public function index() {
        $this->checkAuth();
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/dashboard/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function colaboradores() {
        $this->checkAuth();
        $colaboradores = Colaborador::all();
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/dashboard/colaboradores.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

}
