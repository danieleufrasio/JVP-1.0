<style>
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
</style>

<nav class="col-md-3 col-lg-2 d-md-block sidebar">
    <div class="position-sticky">
        <h5 class="text-white text-center my-3">JVP-Dashboard</h5>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="Sistema.php?num=<?php echo $_SESSION['numlogin']; ?>">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Clientes.php?num=<?php echo $_SESSION['numlogin']; ?>">
                    <i class="fas fa-users"></i> Clientes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Obras2.php?num=<?php echo $_SESSION['numlogin']; ?>">
                    <i class="fas fa-building"></i> Obras
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Tipos_de_Projeto.php?num=<?php echo $_SESSION['numlogin']; ?>">
                    <i class="fas fa-cogs"></i> Tipos de Projetos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-puzzle-piece"></i> Elementos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-layer-group"></i> Pavimentos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-file-alt"></i> Tipos de Papel
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Colaboradores2.php?num=<?php echo $_SESSION['numlogin']; ?>">
                    <i class="fas fa-users-cog"></i> Colaboradores
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-truck"></i> Fornecedores
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Bancos2.php?num=<?php echo $_SESSION['numlogin']; ?>">
                    <i class="fas fa-university"></i> Bancos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="ControledePranchas.php?num=<?php echo $_SESSION['numlogin']; ?>">
                    <i class="fas fa-file-excel"></i> Controle de Pranchas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger" href="logout.php">
                    <i class="fas fa-sign-out-alt"></i> Sair
                </a>
            </li>
        </ul>
    </div>
</nav>
