<?php include_once __DIR__ . '/../../layouts/header.php'; ?>

<main class="main-content">
    <h2>Editar Colaborador</h2>
    <form method="post" action="<?= BASE_URL ?>colaboradores/atualizar/<?= $colaborador['id'] ?>">
        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="text" name="codigo" id="codigo" class="form-control" required value="<?= htmlspecialchars($colaborador['codigo']) ?>">
        </div>
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" required value="<?= htmlspecialchars($colaborador['nome']) ?>">
        </div>
        <div class="mb-3">
            <label for="nivel_acesso" class="form-label">Nível de Acesso</label>
            <select name="nivel_acesso" id="nivel_acesso" class="form-select" required>
                <option value="">Selecione...</option>
                <?php foreach (\Colaborador::niveisAcesso() as $valor => $label): ?>
                    <option value="<?= $valor ?>" <?= ($colaborador['nivel_acesso'] == $valor) ? 'selected' : '' ?>><?= $label ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="ativo" <?= ($colaborador['status'] == 'ativo') ? 'selected' : '' ?>>Ativo</option>
                <option value="inativo" <?= ($colaborador['status'] == 'inativo') ? 'selected' : '' ?>>Inativo</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="cargo" class="form-label">Cargo</label>
            <input type="text" name="cargo" id="cargo" class="form-control" required value="<?= htmlspecialchars($colaborador['cargo']) ?>">
        </div>
        <div class="mb-3">
            <label for="usuario" class="form-label">Usuário</label>
            <input type="text" name="usuario" id="usuario" class="form-control" required value="<?= htmlspecialchars($colaborador['usuario']) ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" required value="<?= htmlspecialchars($colaborador['email']) ?>">
        </div>

        <div class="mb-3">
            <label for="senha" class="form-label">Nova Senha (deixe em branco para não alterar)</label>
            <input type="password" name="senha" id="senha" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Alterar</button>
        <a href="<?= BASE_URL ?>colaboradores" class="btn btn-secondary">Fechar</a>
    </form>
</main>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>
