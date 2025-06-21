<?php include_once __DIR__ . '/../../layouts/header.php'; ?>

<main class="main-content">
    <h2>Tipos de Projeto</h2>
    <div class="mb-3">
        <a href="<?= BASE_URL ?>tiposProjeto/novo" class="btn btn-primary">Novo</a>
        <input type="text" id="buscaTipo" placeholder="Pesquisar..." class="form-control d-inline-block" style="width:200px;display:inline;">
        <a href="<?= BASE_URL ?>tiposProjeto" class="btn btn-secondary">Fechar</a>
    </div>
    <table class="table table-striped" id="tabelaTipos">
        <thead>
            <tr>
                <th>Sigla</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($tipos as $tipo): ?>
            <tr>
                <td><?= htmlspecialchars($tipo['sigla']) ?></td>
                <td><?= htmlspecialchars($tipo['descricao']) ?></td>
                <td>
                    <a href="<?= BASE_URL ?>tiposProjeto/editar/<?= $tipo['id'] ?>" class="btn btn-sm btn-warning">Alterar</a>
                    <a href="<?= BASE_URL ?>tiposProjeto/excluir/<?= $tipo['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir este tipo de projeto?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>

<script>
document.getElementById('buscaTipo').addEventListener('input', function() {
    var termo = this.value;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?= BASE_URL ?>tiposProjeto/pesquisarAjax?q=' + encodeURIComponent(termo), true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            var tipos = JSON.parse(xhr.responseText);
            var tbody = '';
            tipos.forEach(function(tipo) {
                tbody += '<tr>' +
                    '<td>' + tipo.sigla + '</td>' +
                    '<td>' + tipo.descricao + '</td>' +
                    '<td>' +
                        '<a href="<?= BASE_URL ?>tiposProjeto/editar/' + tipo.id + '" class="btn btn-sm btn-warning">Alterar</a> ' +
                        '<a href="<?= BASE_URL ?>tiposProjeto/excluir/' + tipo.id + '" class="btn btn-sm btn-danger" onclick="return confirm(\'Excluir este tipo de projeto?\')">Excluir</a>' +
                    '</td>' +
                '</tr>';
            });
            document.querySelector('#tabelaTipos tbody').innerHTML = tbody;
        }
    };
    xhr.send();
});
</script>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>
