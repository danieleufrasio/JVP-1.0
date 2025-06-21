<?php include_once __DIR__ . '/../../layouts/header.php'; ?>

<main class="main-content">
    <h2>Editar Obra</h2>
    <form method="post" action="<?= BASE_URL ?>obras/atualizar/<?= $obra['id'] ?>">
        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="text" name="codigo" id="codigo" class="form-control" required value="<?= htmlspecialchars($obra['codigo']) ?>">
        </div>
        <div class="mb-3">
            <label for="obra" class="form-label">Obra</label>
            <input type="text" name="obra" id="obra" class="form-control" required value="<?= htmlspecialchars($obra['obra']) ?>">
        </div>
        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente</label>
            <select name="cliente_id" id="cliente_id" class="form-select" required>
                <?php foreach ($clientes as $cliente): ?>
                <option value="<?= $cliente['id'] ?>" <?= $cliente['id'] == $obra['cliente_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cliente['nome']) ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="ano" class="form-label">Ano</label>
            <input type="number" name="ano" id="ano" class="form-control" required value="<?= htmlspecialchars($obra['ano']) ?>">
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="Ativo" <?= $obra['status'] === 'Ativo' ? 'selected' : '' ?>>Ativo</option>
                <option value="Inativo" <?= $obra['status'] === 'Inativo' ? 'selected' : '' ?>>Inativo</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="outros_campos" class="form-label">Outros Campos</label>
            <input type="text" name="outros_campos" id="outros_campos" class="form-control" value="<?= htmlspecialchars($obra['outros_campos']) ?>">
        </div>
        <button type="submit" class="btn btn-success">Alterar</button>
        <a href="<?= BASE_URL ?>obras" class="btn btn-secondary">Fechar</a>
    </form>
</main>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>
