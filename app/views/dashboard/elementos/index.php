<?php include_once __DIR__ . '/../../layouts/header.php'; ?>

<main class="main-content">
    <h2>Elementos</h2>
    <div class="mb-3">
        <a href="<?= BASE_URL ?>elementos/novo" class="btn btn-primary">Novo</a>
        <input type="text" id="buscaElemento" placeholder="Pesquisar..." class="form-control d-inline-block" style="width:200px;display:inline;">
        <a href="<?= BASE_URL ?>elementos" class="btn btn-secondary">Fechar</a>
    </div>
    <table class="table table-striped" id="tabelaElementos">
        <thead>
            <tr>
                <th>Tipo de Projeto</th>
                <th>Sigla</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($elementos as $elemento): ?>
            <tr>
                <td><?= htmlspecialchars($elemento['tipo_sigla']) ?> - <?= htmlspecialchars($elemento['tipo_descricao']) ?></td>
                <td><?= htmlspecialchars($elemento['sigla']) ?></td>
                <td><?= htmlspecialchars($elemento['descricao']) ?></td>
                <td>
                    <a href="<?= BASE_URL ?>elementos/editar/<?= $elemento['id'] ?>" class="btn btn-sm btn-warning">Alterar</a>
                    <a href="<?= BASE_URL ?>elementos/excluir/<?= $elemento['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir este elemento?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>

<script>
document.getElementById('buscaElemento').addEventListener('input', function() {
    var termo = this.value;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?= BASE_URL ?>elementos/pesquisarAjax?q=' + encodeURIComponent(termo), true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            var elementos = JSON.parse(xhr.responseText);
            var tbody = '';
            elementos.forEach(function(elemento) {
                tbody += '<tr>' +
                    '<td>' + elemento.tipo_sigla + ' - ' + elemento.tipo_descricao + '</td>' +
                    '<td>' + elemento.sigla + '</td>' +
                    '<td>' + elemento.descricao + '</td>' +
                    '<td>' +
                        '<a href="<?= BASE_URL ?>elementos/editar/' + elemento.id + '" class="btn btn-sm btn-warning">Alterar</a> ' +
                        '<a href="<?= BASE_URL ?>elementos/excluir/' + elemento.id + '" class="btn btn-sm btn-danger" onclick="return confirm(\'Excluir este elemento?\')">Excluir</a>' +
                    '</td>' +
                '</tr>';
            });
            document.querySelector('#tabelaElementos tbody').innerHTML = tbody;
        }
    };
    xhr.send();
});
</script>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>
