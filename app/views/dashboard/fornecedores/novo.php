<?php include_once __DIR__ . '/../../layouts/header.php'; ?>
<main class="main-content">
    <div class="main-inner" style="max-width:600px;margin:0 auto;">
        <h2 class="mb-3 mt-0 text-center">Novo Fornecedor</h2>
        <form method="post" action="<?= BASE_URL ?>fornecedores/salvar">
            <div class="mb-3">
                <label class="form-label">Código</label>
                <input type="text" name="codigo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Fornecedor</label>
                <input type="text" name="fornecedor" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="Ativo">Ativo</option>
                    <option value="Inativo">Inativo</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Categoria</label>
                <select name="categoria" class="form-select" required>
                    <option value="Nacional">Nacional</option>
                    <option value="Internacional">Internacional</option>
                </select>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="<?= BASE_URL ?>fornecedores" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</main>
<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>