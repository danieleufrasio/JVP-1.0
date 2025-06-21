<?php include_once __DIR__ . '/../../layouts/header.php'; ?>
<main class="main-content">
    <div class="main-inner" style="max-width:600px;margin:0 auto;">
        <h2 class="mb-3 mt-0 text-center">Novo Pavimento</h2>
        <form method="post" action="<?= BASE_URL ?>pavimentos/salvar">
            <div class="mb-3">
                <label class="form-label">Sigla</label>
                <input type="text" name="sigla" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Pavimento</label>
                <input type="text" name="pavimento" class="form-control" required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="<?= BASE_URL ?>pavimentos" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</main>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>