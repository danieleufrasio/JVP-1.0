<?php
include 'conexao.php';
session_start(); // Inicie a sessão para armazenar variáveis de sessão
$errorMessage = ''; // Variável para armazenar mensagens de erro

if (isset($_POST['f_nome']) && isset($_POST['f_senha'])) {
    $user = $_POST['f_nome'];
    $senha = $_POST['f_senha'];

    if (strlen($user) == 0) {
        $errorMessage = "Preencha com seu nome";
    } else if (strlen($senha) == 0) {
        $errorMessage = "Preencha sua senha";
    } else {
        try {
            // Preparar a consulta SQL para buscar o colaborador
            $logar = $pdo->prepare("SELECT * FROM tb_colaboradores WHERE nome = :nome AND senha = :senha");
            $logar->bindParam(':nome', $user);
            $logar->bindParam(':senha', $senha);
            $logar->execute();

            // Verificar se há algum resultado
            if ($logar->rowCount() > 0) {
                // Buscar os dados do colaborador
                $colaborador = $logar->fetch(PDO::FETCH_ASSOC);

                // Armazenar o valor de acesso na sessão
                $_SESSION['numlogin'] = uniqid(); // Define um valor único para numlogin
                $_SESSION['acesso'] = $colaborador['acesso']; // Armazenar o acesso na sessão

                // Redirecionar para a página de gerenciamento
                header("Location: Sistema.php?num=" . $_SESSION['numlogin']);
                exit();
            } else {
                $errorMessage = "Nome ou senha incorretos!";
            }
        } catch (PDOException $e) {
            $errorMessage = "Erro: " . $e->getMessage();
        }
    }
}
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" href="img/Gemini_Generated_Image_vk9tycvk9tycvk9t-removebg-preview.png" type="image/x-icon">
    <style>
        body {
            height: 100vh;
            background-image: url("img/Gemini_Generated_Image_j0hespj0hespj0he.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        form {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            backdrop-filter: blur(5px);
        }
        .input {
            border: none;
            background-color: transparent; /* Fundo transparente */
            outline: none;
            border-bottom: 2px solid #0Dcefd; /* Cor da borda */
            width: 100%;
            padding-left: 15px;
            color: rgb(227, 225, 225); /* Cor do texto */
        }
        .input::placeholder {
            color: rgb(227, 225, 225); /* Cor do placeholder */
        }
        .input:focus {
            background-color: transparent; /* Mantém fundo transparente ao focar */
        }
        #constructionAnimation {
            position: fixed;
            top: 10px;
            right: 10px;
            width: 200px;
            height: 200px;
            z-index: 1000;
        }
        .logo {
            position: absolute;
            bottom: 20px;
            left: 20px;
            width: 350px;
            height: auto;
        }
    </style>
</head>
<body>
    <form action="login.php" method="post" name="f_login" id="f_login">
        <!-- Exibir mensagem de erro, se houver -->
        <?php if ($errorMessage): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>
        
        <div class="mb-3">
            <input type="text" class="input" name="f_nome" id="f_nome" placeholder="Usuário" required>
        </div>
        <div class="mb-3">
            <input type="password" class="input" name="f_senha" id="f_senha" placeholder="Senha" required>
        </div>
        <button type="submit" class="btn btn-primary w-100" name="f_logar">Login</button>
    </form>

    <!-- Logo image -->
    <img src="img/Gemini_Generated_Image_vk9tycvk9tycvk9t-removebg-preview.png" alt="Logo" class="logo">

    <!-- Placeholder for p5.js sketch -->
    <div id="constructionAnimation"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.4.0/p5.js"></script>
    <script>
      let constructionStep = 0;

      function setup() {
        let canvas = createCanvas(200, 200);
        canvas.parent('constructionAnimation');
        frameRate(1);
      }

      function draw() {
        clear();

        stroke(0, 255, 255);
        strokeWeight(2);
        noFill();

        if (constructionStep === 0) {
          drawFoundation();
        } else if (constructionStep === 1) {
          drawWalls();
        } else if (constructionStep === 2) {
          drawRoof();
        } else if (constructionStep === 3) {
          drawCompleteHouse();
        }

        constructionStep++;
        if (constructionStep > 3) {
          constructionStep = 0;
        }
      }

      function drawFoundation() {
        rect(50, 150, 100, 10);
      }

      function drawWalls() {
        rect(50, 100, 10, 50);  
        rect(140, 100, 10, 50); 
        rect(60, 100, 80, 10);  
      }

      function drawRoof() {
        triangle(50, 100, 100, 50, 150, 100);
      }

      function drawCompleteHouse() {
        rect(50, 150, 100, 10);
        rect(50, 100, 10, 50);  
        rect(140, 100, 10, 50); 
        rect(60, 100, 80, 10);
        triangle(50, 100, 100, 50, 150, 100);
        strokeWeight(1);
        line(80, 150, 80, 130);
        line(120, 150, 120, 130);
        line(50, 120, 150, 120);
      }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>
