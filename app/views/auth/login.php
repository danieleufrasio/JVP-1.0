<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JVP Engenharia - Login / Cadastro</title>
  <link rel="stylesheet" href="/JVP/public/css/auth.css">
</head>
<body>

  <div class="logo">
    <img src="/JVP/public/img/logo.jpg" alt="JVP Engenharia">
    <h1>JVP Engenharia</h1>
    <p>Excelência em Engenharia Civil</p>
  </div>

  <!-- Login Card -->
  <div id="loginCard" class="card visible">
    <h2>Fazer Login</h2>
    <p>Acesse sua conta para continuar</p>
    <form method="post" action="<?= BASE_URL ?>login">
      <div class="form-group">
        <label for="loginEmail">Email</label>
        <input type="email" id="loginEmail" name="email" placeholder="seu@email.com" required>
      </div>
      <div class="form-group">
        <label for="loginPassword">Senha</label>
        <input type="password" id="loginPassword" name="password" placeholder="******" required>
      </div>
      <button type="submit">Entrar</button>
    </form>
    <div class="switch">
      <a onclick="switchTo('forgot')">Esqueceu a senha?</a>
      <br>
    </div>
  </div>

  <!-- Register Card -->
  <div id="registerCard" class="card hidden">
    <h2>Criar Conta</h2>
    <p>Crie sua conta para começar</p>
    <form method="post" action="<?= BASE_URL ?>register">
      <div class="form-group">
        <label for="registerEmail">Email</label>
        <input type="email" id="registerEmail" name="email" placeholder="seu@email.com" required>
      </div>
      <div class="form-group">
        <label for="registerPassword">Senha</label>
        <input type="password" id="registerPassword" name="password" placeholder="******" required>
      </div>
      <div class="form-group">
        <label for="confirmPassword">Confirmar Senha</label>
        <input type="password" id="confirmPassword" name="confirm_password" placeholder="******" required>
      </div>
      <button type="submit">Criar Conta</button>
    </form>
    <div class="switch">
      Já tem uma conta? <a onclick="switchTo('login')">Fazer login</a>
    </div>
  </div>

  <!-- Forgot Password Card -->
  <div id="forgotCard" class="card hidden">
    <h2>Recuperar Senha</h2>
    <p>Informe seu e-mail para receber o link de redefinição de senha.</p>
    <form method="post" action="<?= BASE_URL ?>forgot">
      <div class="form-group">
        <label for="forgotEmail">Email</label>
        <input type="email" id="forgotEmail" name="email" placeholder="seu@email.com" required>
      </div>
      <button type="submit">Enviar link de redefinição</button>
    </form>
    <div class="switch">
      Lembrou a senha? <a onclick="switchTo('login')">Fazer login</a>
    </div>
  </div>

  <footer>
    © <?= date('Y') ?> JVP Engenharia. Todos os direitos reservados.
  </footer>

  <script>
    function switchTo(view) {
      const login = document.getElementById('loginCard');
      const register = document.getElementById('registerCard');
      const forgot = document.getElementById('forgotCard');
      login.classList.add('hidden');
      register.classList.add('hidden');
      forgot.classList.add('hidden');
      if (view === 'login') login.classList.remove('hidden');
      if (view === 'register') register.classList.remove('hidden');
      if (view === 'forgot') forgot.classList.remove('hidden');
    }
  </script>

</body>
</html>
