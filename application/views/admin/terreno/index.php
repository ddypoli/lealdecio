<div><?= anchor('admin/terreno/create', 'Adicionar novo'); ?></div>
<table>
    <thead>
        <tr>
            <td>Título</td>
            <td>Descrição</td>
            <td colspan="3">Ações</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($terrenos as $item): ?>
        <?php $item = (object) $item; ?>
        <tr>
            <td><?= $item->titulo ?></td>
            <td><?= $item->descricao ?></td>
            <td><?= anchor("admin/terreno/view/{$item->id}", 'Visualizar'); ?></td>
            <td><?= anchor("admin/terreno/edit/{$item->id}", 'Editar'); ?></td>
            <td><?= anchor("admin/terreno/remove/{$item->id}", 'Remover'); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>