<?php include_once __DIR__ . '/../../layouts/header.php'; ?>

<main class="main-content">
    <h2>Novo Tipo de Papel</h2>
    <form method="post" action="<?= BASE_URL ?>tiposPapel/salvar">
        <div class="mb-3">
            <label for="sigla" class="form-label">Sigla</label>
            <input type="text" name="sigla" id="sigla" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" name="descricao" id="descricao" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="equivalencia" class="form-label">Equivalência</label>
            <select name="equivalencia" id="equivalencia" class="form-select" required>
                <option value="">Selecione...</option>
                <?php foreach ($equivalencias as $sigla => $valor): ?>
                    <option value="<?= $sigla ?>" <?= (isset($tipo) && $tipo['equivalencia'] == $sigla) ? 'selected' : '' ?>>
                        <?= $sigla ?> (<?= $valor ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>



        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="<?= BASE_URL ?>tiposPapel" class="btn btn-secondary">Fechar</a>
    </form>
</main>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>
