<nav class="sidebar" style="width:250px; min-height:100vh; background:#f8f9fa; border-right:1px solid #dee2e6; position:fixed; top:0; left:0; z-index:1030;">
    <div class="position-sticky pt-3">
        <?php if (!empty($_SESSION['colaborador'])): ?>
            <div class="d-flex align-items-center p-3 mb-3 border-bottom bg-white rounded shadow-sm">
                <div class="flex-shrink-0">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width:44px; height:44px; font-size:1.5rem;">
                        <?= strtoupper(substr($_SESSION['colaborador']['nome'], 0, 1)) ?>
                    </div>
                </div>
                <div class="flex-grow-1 ms-3">
                    <strong><?= htmlspecialchars($_SESSION['colaborador']['nome']) ?></strong>
                    <div class="text-muted small"><?= htmlspecialchars(ucfirst($_SESSION['colaborador']['nivel_acesso'])) ?></div>
                    <div class="dropdown mt-1">
                        <a class="btn btn-link btn-sm dropdown-toggle p-0 text-decoration-none" href="#" role="button" id="dropdownProfile" data-bs-toggle="dropdown" aria-expanded="false">
                            Perfil
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownProfile">
                            <li><a class="dropdown-item" href="<?= BASE_URL ?>profile">Meu Perfil</a></li>
                            <li><a class="dropdown-item text-danger" href="<?= BASE_URL ?>logout">Sair</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a class="nav-link<?= (strpos($_SERVER['REQUEST_URI'], '/dashboard') !== false) ? ' active' : '' ?>" href="<?= BASE_URL ?>dashboard">
                    <i class="fas fa-home me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link<?= (strpos($_SERVER['REQUEST_URI'], '/clientes') !== false) ? ' active' : '' ?>" href="<?= BASE_URL ?>clientes">
                    <i class="fas fa-users me-2"></i> Clientes
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link<?= (strpos($_SERVER['REQUEST_URI'], '/obras') !== false) ? ' active' : '' ?>" href="<?= BASE_URL ?>obras">
                    <i class="fas fa-briefcase me-2"></i> Obras
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link<?= (strpos($_SERVER['REQUEST_URI'], '/tiposProjeto') !== false) ? ' active' : '' ?>" href="<?= BASE_URL ?>tiposProjeto">
                    <i class="fas fa-layer-group me-2"></i> Tipos de Projeto
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link<?= (strpos($_SERVER['REQUEST_URI'], '/elementos') !== false) ? ' active' : '' ?>" href="<?= BASE_URL ?>elementos">
                    <i class="fas fa-th me-2"></i> Elementos
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link<?= (strpos($_SERVER['REQUEST_URI'], '/tiposPapel') !== false) ? ' active' : '' ?>" href="<?= BASE_URL ?>tiposPapel">
                    <i class="fas fa-file-alt me-2"></i> Tipos de Papel
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link<?= (strpos($_SERVER['REQUEST_URI'], '/colaboradores') !== false) ? ' active' : '' ?>" href="<?= BASE_URL ?>colaboradores">
                    <i class="fas fa-user-check me-2"></i> Colaboradores
                </a>
            </li>
            
            <li class="nav-item mb-2">
                <a class="nav-link<?= (strpos($_SERVER['REQUEST_URI'], '/fornecedores') !== false) ? ' active' : '' ?>" href="<?= BASE_URL ?>fornecedores">
                    <i class="fas fa-truck me-2"></i> Fornecedores
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link<?= (strpos($_SERVER['REQUEST_URI'], '/pavimentos') !== false) ? ' active' : '' ?>" href="<?= BASE_URL ?>pavimentos">
                    <i class="fas fa-building me-2"></i> Pavimentos
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link<?= (strpos($_SERVER['REQUEST_URI'], '/pranchas') !== false) ? ' active' : '' ?>" href="<?= BASE_URL ?>pranchas">
                    <i class="fas fa-clone me-2"></i> Pranchas
                </a>
            </li>

            <li class="nav-item mb-2">
                <a class="nav-link text-danger" href="<?= BASE_URL ?>logout">
                    <i class="fas fa-sign-out-alt me-2"></i> Sair
                </a>
            </li>
        </ul>
    </div>
</nav>
