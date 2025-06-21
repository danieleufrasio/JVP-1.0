<?php include_once __DIR__ . '/../../layouts/header.php'; ?>
<main class="main-content">
    <div class="main-inner" style="max-width:1400px;margin:0 auto;">
        <h2 class="mb-3 mt-0 text-center">Pranchas</h2>
        <div class="mb-3 d-flex justify-content-between align-items-center gap-2 flex-wrap">
            <a href="<?= BASE_URL ?>pranchas/novo" class="btn btn-primary">Novo</a>
            <form class="d-flex" method="get" action="<?= BASE_URL ?>pranchas/pesquisar">
                <input type="text" name="q" placeholder="Pesquisar..." class="form-control me-2" style="width:200px;">
                <button class="btn btn-outline-secondary" type="submit">Pesquisar</button>
            </form>
            <a href="<?= BASE_URL ?>dashboard" class="btn btn-secondary">Fechar</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Obra</th>
                        <th>Previsão</th>
                        <th>Conclusão</th>
                        <th>Tipo Projeto</th>
                        <th>Nº Prancha</th>
                        <th>Elemento</th>
                        <th>Pavimento</th>
                        <th>Revisão</th>
                        <th>Tipo Papel</th>
                        <th>Status</th>
                        <th>Projetado</th>
                        <th>Verificado</th>
                        <th>Calculado</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($pranchas as $prancha): ?>
                    <tr>
                        <td><?= htmlspecialchars($prancha['cliente_nome']) ?></td>
                        <td><?= htmlspecialchars($prancha['obra_nome']) ?></td>
                        <td><?= htmlspecialchars($prancha['previsao_conclusao']) ?></td>
                        <td><?= htmlspecialchars($prancha['conclusao']) ?></td>
                        <td><?= htmlspecialchars($prancha['tipo_projeto_sigla']) ?></td>
                        <td><?= htmlspecialchars($prancha['numero_prancha']) ?></td>
                        <td><?= htmlspecialchars($prancha['elemento_sigla']) ?></td>
                        <td><?= htmlspecialchars($prancha['pavimento_sigla']) ?></td>
                        <td><?= htmlspecialchars($prancha['revisao']) ?></td>
                        <td><?= htmlspecialchars($prancha['tipo_papel_nome']) ?></td>
                        <td><?= htmlspecialchars($prancha['status']) ?></td>
                        <td><?= htmlspecialchars($prancha['projetado_nome']) ?></td>
                        <td><?= htmlspecialchars($prancha['verificado_nome']) ?></td>
                        <td><?= htmlspecialchars($prancha['calculado_nome']) ?></td>
                        <td>
                            <a href="<?= BASE_URL ?>pranchas/editar/<?= $prancha['id'] ?>" class="btn btn-sm btn-warning">Alterar</a>
                            <a href="<?= BASE_URL ?>pranchas/excluir/<?= $prancha['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir esta prancha?')">Excluir</a>
                            <a href="<?= BASE_URL ?>pranchas/replicar/<?= $prancha['id'] ?>" class="btn btn-sm btn-info">Replicar</a>
                            <a href="<?= BASE_URL ?>pranchas/imagem/<?= $prancha['id'] ?>" class="btn btn-sm btn-secondary">Imagem</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>