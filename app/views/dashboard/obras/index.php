<?php include_once __DIR__ . '/../../layouts/header.php'; ?>

<main class="main-content">
    <h2>Obras</h2>
    <div class="mb-3">
        <a href="<?= BASE_URL ?>obras/novo" class="btn btn-primary">Novo</a>
        <input type="text" id="buscaObra" placeholder="Pesquisar..." class="form-control d-inline-block" style="width:200px;display:inline;">
        <a href="<?= BASE_URL ?>obras" class="btn btn-secondary">Fechar</a>
    </div>
    <table class="table table-striped" id="tabelaObras">
        <thead>
            <tr>
                <th>Código</th>
                <th>Obra</th>
                <th>Cliente</th>
                <th>Ano</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($obras as $obra): ?>
            <tr>
                <td><?= htmlspecialchars($obra['codigo']) ?></td>
                <td><?= htmlspecialchars($obra['obra']) ?></td>
                <td><?= htmlspecialchars($obra['cliente_nome']) ?></td>
                <td><?= htmlspecialchars($obra['ano']) ?></td>
                <td><?= htmlspecialchars($obra['status']) ?></td>
                <td>
                    <a href="<?= BASE_URL ?>obras/editar/<?= $obra['id'] ?>" class="btn btn-sm btn-warning">Alterar</a>
                    <a href="<?= BASE_URL ?>obras/excluir/<?= $obra['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir esta obra?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>

<script>
document.getElementById('buscaObra').addEventListener('input', function() {
    var termo = this.value;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?= BASE_URL ?>obras/pesquisarAjax?q=' + encodeURIComponent(termo), true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            var obras = JSON.parse(xhr.responseText);
            var tbody = '';
            obras.forEach(function(obra) {
                tbody += '<tr>' +
                    '<td>' + obra.codigo + '</td>' +
                    '<td>' + obra.obra + '</td>' +
                    '<td>' + obra.cliente_nome + '</td>' +
                    '<td>' + obra.ano + '</td>' +
                    '<td>' + obra.status + '</td>' +
                    '<td>' +
                        '<a href="<?= BASE_URL ?>obras/editar/' + obra.id + '" class="btn btn-sm btn-warning">Alterar</a> ' +
                        '<a href="<?= BASE_URL ?>obras/excluir/' + obra.id + '" class="btn btn-sm btn-danger" onclick="return confirm(\'Excluir esta obra?\')">Excluir</a>' +
                    '</td>' +
                '</tr>';
            });
            document.querySelector('#tabelaObras tbody').innerHTML = tbody;
        }
    };
    xhr.send();
});
</script>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>
