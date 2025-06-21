<?php include_once __DIR__ . '/../../layouts/header.php'; ?>

<main class="main-content">
    <h2>Nova Obra</h2>
    <form method="post" action="<?= BASE_URL ?>obras/salvar">
        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="text" name="codigo" id="codigo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="obra" class="form-label">Obra</label>
            <input type="text" name="obra" id="obra" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente</label>
            <select name="cliente_id" id="cliente_id" class="form-select" required>
                <option value="">Selecione...</option>
                <?php foreach ($clientes as $cliente): ?>
                    <option value="<?= $cliente['id'] ?>"><?= htmlspecialchars($cliente['nome']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="ano" class="form-label">Data</label>
            <input
                type="date"
                name="ano"
                id="ano"
                class="form-control"
                required
                value="<?= date('Y-m-d') ?>"
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="Ativo">Ativo</option>
                <option value="Inativo">Inativo</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="outros_campos" class="form-label">Outros Campos</label>
            <input type="text" name="outros_campos" id="outros_campos" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="<?= BASE_URL ?>obras" class="btn btn-secondary">Fechar</a>
    </form>
</main>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>
