<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}

if (!isset($_SESSION['numlogin']) || !isset($_GET['num']) || $_GET['num'] != $_SESSION['numlogin']) {
    echo '<div class="alert alert-danger" role="alert">Diretório privado. Faça login para acessar.</div>';
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            color: #fff;
            padding: 1rem;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            border-right: 1px solid #dee2e6;
        }
        .sidebar .nav-link {
            color: #adb5bd;
            text-decoration: none;
            padding: 10px 15px;
            font-size: 1rem;
            border-radius: 0.375rem;
            transition: background-color 0.3s ease;
        }
        .sidebar .nav-link:hover {
            background-color: #495057;
            color: #fff;
        }
        .sidebar .nav-link.active {
            background-color: #007bff;
            color: #fff;
        }
        .sidebar .nav-item {
            margin-bottom: 10px;
        }
        .sidebar h5 {
            font-size: 1.2rem;
            font-weight: bold;
            color: #fff;
            margin-top: 10px;
            text-align: center;
        }
        .content {
            padding: 2rem;
            background-color: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            flex-grow: 1;
            margin-left: 250px;
            transition: margin-left 0.3s ease;
        }
        .card {
            border-radius: 0.375rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card .card-body {
            padding: 1.5rem;
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
        }
        .card-text {
            font-size: 1rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
        <?php include('sidebar.php'); ?>
            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="content mt-4">
                    <h2 class="mb-4">Bem-vindo ao Dashboard</h2>
                    <p>Aqui você pode gerenciar seus dados e monitorar as atividades.</p>
                    <div class="row">
                        <!-- Cliente Card -->
                        <div class="col-md-4">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Clientes</h5>
                                    <p class="card-text">Gerencie clientes cadastrados.</p>
                                    <a href="Clientes.php?num=<?php echo $_SESSION['numlogin']; ?>" class="btn btn-light">Acessar Clientes</a>
                                </div>
                            </div>
                        </div>

                        <!-- Outros cards -->
                        <div class="col-md-4">
                            <div class="card text-white bg-success mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Obras</h5>
                                    <p class="card-text">Acompanhe o progresso das obras.</p>
                                    <a href="Obras.php?num=<?php echo $_SESSION['numlogin']; ?>" class="btn btn-light">Acessar Obras</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-warning mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Financeiro</h5>
                                    <p class="card-text">Veja o status financeiro do seu negócio.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
