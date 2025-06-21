<?php include_once __DIR__ . '/../../layouts/header.php'; ?>
<?php include_once __DIR__ . '/../../layouts/header.php'; ?>
<main class="main-content">
    <div class="main-inner" style="max-width:900px;margin:0 auto;">
        <h2 class="mb-3 mt-0 text-center">Alterar Prancha</h2>
        <form method="post" action="<?= BASE_URL ?>pranchas/atualizar/<?= $prancha['id'] ?>">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Cliente</label>
                    <select name="cliente_id" class="form-select" required>
                        <option value="">Selecione</option>
                        <?php foreach ($clientes as $c): ?>
                            <option value="<?= $c['id'] ?>" <?= $prancha['cliente_id'] == $c['id'] ? 'selected' : '' ?>><?= htmlspecialchars($c['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Obra</label>
                    <select name="obra_id" class="form-select" required>
                        <option value="">Selecione</option>
                        <?php foreach ($obras as $o): ?>
                            <option value="<?= $o['id'] ?>" <?= $prancha['obra_id'] == $o['id'] ? 'selected' : '' ?>><?= htmlspecialchars($o['obra']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Previsão de Conclusão</label>
                    <input type="date" name="previsao_conclusao" class="form-control" value="<?= htmlspecialchars($prancha['previsao_conclusao']) ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Conclusão</label>
                    <input type="date" name="conclusao" class="form-control" value="<?= htmlspecialchars($prancha['conclusao']) ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tipo de Projeto</label>
                    <select name="tipo_projeto_id" class="form-select" required>
                        <option value="">Selecione</option>
                        <?php foreach ($tiposProjeto as $tp): ?>
                            <option value="<?= $tp['id'] ?>" <?= $prancha['tipo_projeto_id'] == $tp['id'] ? 'selected' : '' ?>><?= htmlspecialchars($tp['sigla']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Número da Prancha</label>
                    <input type="text" name="numero_prancha" class="form-control" value="<?= htmlspecialchars($prancha['numero_prancha']) ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Elemento</label>
                    <select name="elemento_id" class="form-select" required>
                        <option value="">Selecione</option>
                        <?php foreach ($elementos as $el): ?>
                            <option value="<?= $el['id'] ?>" <?= $prancha['elemento_id'] == $el['id'] ? 'selected' : '' ?>><?= htmlspecialchars($el['sigla']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Pavimento</label>
                    <select name="pavimento_id" class="form-select" required>
                        <option value="">Selecione</option>
                        <?php foreach ($pavimentos as $pav): ?>
                            <option value="<?= $pav['id'] ?>" <?= $prancha['pavimento_id'] == $pav['id'] ? 'selected' : '' ?>><?= htmlspecialchars($pav['sigla']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Revisão</label>
                    <input type="text" name="revisao" class="form-control" value="<?= htmlspecialchars($prancha['revisao']) ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Tipo de Papel</label>
                    <select name="tipo_papel_id" class="form-select" required>
                        <option value="">Selecione</option>
                        <?php foreach ($tiposPapel as $tpap): ?>
                            <option value="<?= $tpap['id'] ?>" <?= $prancha['tipo_papel_id'] == $tpap['id'] ? 'selected' : '' ?>><?= htmlspecialchars($tpap['descricao']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="pendente" <?= $prancha['status'] == 'pendente' ? 'selected' : '' ?>>Pendente</option>
                        <option value="em aprovação" <?= $prancha['status'] == 'em aprovação' ? 'selected' : '' ?>>Em aprovação</option>
                        <option value="aprovado" <?= $prancha['status'] == 'aprovado' ? 'selected' : '' ?>>Aprovado</option>
                        <option value="em alteração" <?= $prancha['status'] == 'em alteração' ? 'selected' : '' ?>>Em alteração</option>
                        <option value="reprovado" <?= $prancha['status'] == 'reprovado' ? 'selected' : '' ?>>Reprovado</option>
                        <option value="cancelado" <?= $prancha['status'] == 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
                        <option value="todos" <?= $prancha['status'] == 'todos' ? 'selected' : '' ?>>Todos</option>
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Observação</label>
                    <textarea name="observacao" class="form-control"><?= htmlspecialchars($prancha['observacao']) ?></textarea>
                </div>
                <!-- Tela de escolha: Projetista, Verificador, Calculista -->
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-header">
                            Escolha
                        </div>
                        <div class="card-body row">
                            <div class="col-md-4">
                                <label class="form-label">Projetista</label>
                                <select name="projetado_id" class="form-select" required>
                                    <option value="">Selecione</option>
                                    <?php foreach ($colaboradores as $col): ?>
                                        <option value="<?= $col['id'] ?>" <?= $prancha['projetado_id'] == $col['id'] ? 'selected' : '' ?>><?= htmlspecialchars($col['nome']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Verificador</label>
                                <select name="verificado_id" class="form-select" required>
                                    <option value="">Selecione</option>
                                    <?php foreach ($colaboradores as $col): ?>
                                        <option value="<?= $col['id'] ?>" <?= $prancha['verificado_id'] == $col['id'] ? 'selected' : '' ?>><?= htmlspecialchars($col['nome']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Calculista</label>
                                <select name="calculado_id" class="form-select" required>
                                    <option value="">Selecione</option>
                                    <?php foreach ($colaboradores as $col): ?>
                                        <option value="<?= $col['id'] ?>" <?= $prancha['calculado_id'] == $col['id'] ? 'selected' : '' ?>><?= htmlspecialchars($col['nome']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="button" class="btn btn-primary" onclick="alert('Selecione os responsáveis e clique em OK para salvar!')">OK</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn btn-success">Salvar Alterações</button>
                <a href="<?= BASE_URL ?>pranchas" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</main>


<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>