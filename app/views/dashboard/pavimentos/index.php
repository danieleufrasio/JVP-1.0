<?php include_once __DIR__ . '/../../layouts/header.php'; ?>
<main class="main-content">
    <div class="main-inner" style="max-width:900px;margin:0 auto;">
        <h2 class="mb-3 mt-0 text-center">Pavimentos</h2>
        <div class="mb-3 d-flex justify-content-between align-items-center gap-2 flex-wrap">
            <a href="<?= BASE_URL ?>pavimentos/novo" class="btn btn-primary">Novo</a>
            <form class="d-flex" method="get" action="<?= BASE_URL ?>pavimentos/pesquisar">
                <input type="text" name="q" placeholder="Pesquisar..." class="form-control me-2" style="width:200px;">
                <button class="btn btn-outline-secondary" type="submit">Pesquisar</button>
            </form>
            <a href="<?= BASE_URL ?>dashboard" class="btn btn-secondary">Fechar</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Sigla</th>
                        <th>Pavimento</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($pavimentos as $pavimento): ?>
                    <tr>
                        <td><?= htmlspecialchars($pavimento['sigla']) ?></td>
                        <td><?= htmlspecialchars($pavimento['pavimento']) ?></td>
                        <td>
                            <a href="<?= BASE_URL ?>pavimentos/editar/<?= $pavimento['id'] ?>" class="btn btn-sm btn-warning">Alterar</a>
                            <a href="<?= BASE_URL ?>pavimentos/excluir/<?= $pavimento['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir este pavimento?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>