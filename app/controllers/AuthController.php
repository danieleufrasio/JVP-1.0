<?php

require_once __DIR__ . '/../models/Colaborador.php';

class AuthController {
    public function login() {
        // Redireciona se já estiver logado
        if (isset($_SESSION['colaborador']) && !empty($_SESSION['colaborador']['id'])) {
            header('Location: ' . BASE_URL . 'dashboard');
            exit;
        }
        

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $senha = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

            if ($email && $senha) {
                // Chama o método de autenticação do Model
                $colaborador = Colaborador::autenticarPorEmail($email, $senha);

                if ($colaborador) {
                    session_regenerate_id(true);
                    $_SESSION['colaborador'] = [
                        'id'           => $colaborador['id'],
                        'nome'         => $colaborador['nome'],
                        'email'        => $colaborador['email'],
                        'nivel_acesso' => $colaborador['nivel_acesso'],
                        'status'       => $colaborador['status']
                    ];
                    // Redireciona para o dashboard
                    header('Location: ' . BASE_URL . 'dashboard');
                    exit;
                } else {
                    $error = "Credenciais inválidas";
                }
            } else {
                $error = "Dados do formulário inválidos";
            }
        }

        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function logout() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $_SESSION = [];
        session_unset();
        session_destroy();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        header('Location: ' . BASE_URL . 'login');
        exit;
    }
}
