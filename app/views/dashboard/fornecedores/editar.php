<?php include_once __DIR__ . '/../../layouts/header.php'; ?>
<main class="main-content">
    <div class="main-inner" style="max-width:600px;margin:0 auto;">
        <h2 class="mb-3 mt-0 text-center">Alterar Fornecedor</h2>
        <form method="post" action="<?= BASE_URL ?>fornecedores/atualizar/<?= $fornecedor['id'] ?>">
            <div class="mb-3">
                <label class="form-label">Código</label>
                <input type="text" name="codigo" class="form-control" value="<?= htmlspecialchars($fornecedor['codigo']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Fornecedor</label>
                <input type="text" name="fornecedor" class="form-control" value="<?= htmlspecialchars($fornecedor['fornecedor']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="Ativo" <?= $fornecedor['status'] == 'Ativo' ? 'selected' : '' ?>>Ativo</option>
                    <option value="Inativo" <?= $fornecedor['status'] == 'Inativo' ? 'selected' : '' ?>>Inativo</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($fornecedor['email']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Categoria</label>
                <select name="categoria" class="form-select" required>
                    <option value="Nacional" <?= $fornecedor['categoria'] == 'Nacional' ? 'selected' : '' ?>>Nacional</option>
                    <option value="Internacional" <?= $fornecedor['categoria'] == 'Internacional' ? 'selected' : '' ?>>Internacional</option>
                </select>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Salvar Alterações</button>
                <a href="<?= BASE_URL ?>fornecedores" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</main>
<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>