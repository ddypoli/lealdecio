<h1><?= $title; ?></h1>
<h2><?= $terreno->titulo; ?></h2>
<p><?= $terreno->descricao; ?></p>
<p>
    Bairro: <?= $terreno->bairro; ?><br />
    Cidade: <?= $terreno->cidade_id; ?><br />
    Largura: <?= $terreno->largura; ?><br />
    Comprimento: <?= $terreno->comprimento; ?>
</p>
<?php
    foreach ($terreno->imagens as $imagem):
?>
<img src="/codeigniter/uploads/<?= $imagem['nome']; ?>" width="200" height="200" />
<?php
    endforeach;