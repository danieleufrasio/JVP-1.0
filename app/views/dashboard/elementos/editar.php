<?php include_once __DIR__ . '/../../layouts/header.php'; ?>

<main class="main-content">
    <h2>Editar Elemento</h2>
    <form method="post" action="<?= BASE_URL ?>elementos/atualizar/<?= $elemento['id'] ?>">
        <div class="mb-3">
            <label for="tipo_projeto_id" class="form-label">Tipo de Projeto</label>
            <select name="tipo_projeto_id" id="tipo_projeto_id" class="form-select" required>
                <option value="">Selecione...</option>
                <?php foreach ($tipos as $tipo): ?>
                    <option value="<?= $tipo['id'] ?>" <?= $tipo['id'] == $elemento['tipo_projeto_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($tipo['sigla']) ?> - <?= htmlspecialchars($tipo['descricao']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="sigla" class="form-label">Sigla</label>
            <input type="text" name="sigla" id="sigla" class="form-control" required value="<?= htmlspecialchars($elemento['sigla']) ?>">
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" name="descricao" id="descricao" class="form-control" required value="<?= htmlspecialchars($elemento['descricao']) ?>">
        </div>
        <button type="submit" class="btn btn-success">Alterar</button>
        <a href="<?= BASE_URL ?>elementos" class="btn btn-secondary">Fechar</a>
    </form>
</main>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>
