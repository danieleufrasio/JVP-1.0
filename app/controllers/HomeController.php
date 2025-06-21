<?php
class HomeController {
    public function index() {
        $pageTitle = "JVP Engenharia - Projetos Estruturais";
        require __DIR__ . '/../views/home/index.php';
    }
}

