<?php include_once __DIR__ . '/../../layouts/header.php'; ?>

<main class="main-content">
    <h2>Editar Tipo de Projeto</h2>
    <form method="post" action="<?= BASE_URL ?>tiposProjeto/atualizar/<?= $tipo['id'] ?>">
        <div class="mb-3">
            <label for="sigla" class="form-label">Sigla</label>
            <input type="text" name="sigla" id="sigla" class="form-control" required value="<?= htmlspecialchars($tipo['sigla']) ?>">
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" name="descricao" id="descricao" class="form-control" required value="<?= htmlspecialchars($tipo['descricao']) ?>">
        </div>
        <button type="submit" class="btn btn-success">Alterar</button>
        <a href="<?= BASE_URL ?>tiposProjeto" class="btn btn-secondary">Fechar</a>
    </form>
</main>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>
