<?php
class PasswordController {
    public function forgotPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            
            if ($email) {
                $token = bin2hex(random_bytes(50));
                $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));
                
                // Salva no banco
                PasswordReset::create($email, $token, $expires);
                
                // Envia e-mail (implementação abaixo)
                $this->sendPasswordResetEmail($email, $token);
                
                $_SESSION['success'] = "Instruções enviadas para seu e-mail";
                header('Location: '.BASE_URL.'login');
            }
        }
        require_once 'app/views/auth/forgot-password.php';
    }

    public function resetPassword($token) {
        $reset = PasswordReset::findValid($token);
        
        if (!$reset) {
            $_SESSION['error'] = "Link inválido ou expirado";
            header('Location: '.BASE_URL.'login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $confirm = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_STRING);
            
            if ($password === $confirm) {
                User::updatePassword($reset['email'], $password);
                PasswordReset::delete($reset['email']);
                
                $_SESSION['success'] = "Senha alterada com sucesso!";
                header('Location: '.BASE_URL.'login');
            }
        }
        
        require_once 'app/views/auth/reset-password.php';
    }

    private function sendPasswordResetEmail($email, $token) {
        $subject = "Redefinição de Senha";
        $resetLink = BASE_URL . "reset-password/" . $token;
        
        $message = "Clique no link para redefinir sua senha: \n\n";
        $message .= $resetLink . "\n\n";
        $message .= "O link expira em 1 hora.";
        
        // Implemente o envio real usando PHPMailer ou mail()
        mail($email, $subject, $message);
    }
}
