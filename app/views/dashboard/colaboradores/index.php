<?php include_once __DIR__ . '/../../layouts/header.php'; ?>

<main class="main-content">
    <h2>Colaboradores</h2>
    <div class="mb-3">
        <a href="<?= BASE_URL ?>colaboradores/novo" class="btn btn-primary">Novo</a>
        <input type="text" id="buscaColaborador" placeholder="Pesquisar..." class="form-control d-inline-block" style="width:200px;display:inline;">
        <a href="<?= BASE_URL ?>colaboradores/cargos" class="btn btn-secondary">Cargos</a>
        <a href="<?= BASE_URL ?>colaboradores/comissoes" class="btn btn-secondary">Comissões</a>
        <a href="<?= BASE_URL ?>colaboradores/parametros" class="btn btn-secondary">Parâmetros</a>
        <a href="<?= BASE_URL ?>colaboradores/intervaloErros" class="btn btn-secondary">Intervalo de Erros</a>
        <a href="<?= BASE_URL ?>colaboradores" class="btn btn-secondary">Fechar</a>
    </div>
    <table class="table table-striped" id="tabelaColaboradores">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Nível de Acesso</th>
                <th>Status</th>
                <th>Cargo</th>
                <th>E-mail</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($colaboradores as $colaborador): ?>
            <tr>
                <td><?= htmlspecialchars($colaborador['codigo']) ?></td>
                <td><?= htmlspecialchars($colaborador['nome']) ?></td>
                <td><?= htmlspecialchars(ucfirst($colaborador['nivel_acesso'])) ?></td>
                <td><?= htmlspecialchars(ucfirst($colaborador['status'])) ?></td>
                <td><?= htmlspecialchars($colaborador['cargo']) ?></td>
                <td><?= htmlspecialchars($colaborador['email']) ?></td>
                <td>
                    <a href="<?= BASE_URL ?>colaboradores/editar/<?= $colaborador['id'] ?>" class="btn btn-sm btn-warning">Alterar</a>
                    <a href="<?= BASE_URL ?>colaboradores/excluir/<?= $colaborador['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir este colaborador?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>

<script>
document.getElementById('buscaColaborador').addEventListener('input', function() {
    var termo = this.value;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?= BASE_URL ?>colaboradores/pesquisarAjax?q=' + encodeURIComponent(termo), true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            var colaboradores = JSON.parse(xhr.responseText);
            var tbody = '';
            colaboradores.forEach(function(colaborador) {
                tbody += '<tr>' +
                    '<td>' + colaborador.codigo + '</td>' +
                    '<td>' + colaborador.nome + '</td>' +
                    '<td>' + colaborador.nivel_acesso.charAt(0).toUpperCase() + colaborador.nivel_acesso.slice(1) + '</td>' +
                    '<td>' + colaborador.status.charAt(0).toUpperCase() + colaborador.status.slice(1) + '</td>' +
                    '<td>' + colaborador.cargo + '</td>' +
                    '<td>' +
                        '<a href="<?= BASE_URL ?>colaboradores/editar/' + colaborador.id + '" class="btn btn-sm btn-warning">Alterar</a> ' +
                        '<a href="<?= BASE_URL ?>colaboradores/excluir/' + colaborador.id + '" class="btn btn-sm btn-danger" onclick="return confirm(\'Excluir este colaborador?\')">Excluir</a>' +
                    '</td>' +
                '</tr>';
            });
            document.querySelector('#tabelaColaboradores tbody').innerHTML = tbody;
        }
    };
    xhr.send();
});
</script>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>
