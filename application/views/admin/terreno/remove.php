<h1><?php $title; ?></h1>
<p>Você está prestes a excluir o seguinte registro:</p>
<p>
    Título: <?= $terreno->titulo; ?><br />
    Descrição: <?= $terreno->descricao; ?>
</p>
<p>
    <?= anchor('admin/terreno/remove/' . $this->uri->segment(4) . '/true', 'Confirmar'); ?>
    <?= anchor('admin/terreno', 'Cancelar'); ?>
</p>