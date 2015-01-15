<h1><?= $title; ?></h1>
<?= validation_errors(); ?>
<?= form_open_multipart(); ?>
    <input type="text" name="titulo" value="<?= $terreno->titulo; ?>" placeholder="Título"><br />
    <textarea name="descricao" placeholder="Descrição"><?= $terreno->descricao; ?></textarea><br />
    <input type="text" name="endereco" value="<?= $terreno->endereco; ?>" placeholder="Endereço" /><br />
    <input type="text" name="bairro" value="<?= $terreno->bairro; ?>" placeholder="Bairro" /><br />
    <select name="cidade">
        <option value="">Selecione algum</option>
        <?php foreach ($cidades as $cidade): ?>
        <option value="<?= $cidade->id; ?>" <?= $terreno->cidade_id == $cidade->id ? 'selected' : ''; ?>><?= $cidade->nome; ?></option>
        <?php endforeach; ?>
    </select><br />
    <input type="number" name="largura" value="<?= $terreno->largura; ?>" placeholder="Largura em metros" /><br />
    <input type="number" name="comprimento" value="<?= $terreno->comprimento; ?>" placeholder="Comprimento em metros" /><br />
    <input type="file" name="imagens[]" multiple /><br />
    <button type="submit" name="submit" value="submit">Enviar</button>
</form>

<div>
<?php
foreach ($terreno->imagens as $imagem):
?>
    <div id="img-<?=$imagem['id'];?>" style="display: inline-block;">
        <img class="terreno_imagem" src="/codeigniter/uploads/<?= $imagem['nome']; ?>" width="200" height="200" />
        <button class="remove" type="button" title="Remover">Remover</button>
    </div>
<?php
endforeach;
?>
</div>

<div class="confirm_dialog">
    <div>
        <p>Deseja remover a imagem?</p>
        <button data-foto-id="0" class="confirm_button" type="button" title="Confirmar">Confirmar</button>
        <button class="cancel_button" type="button" title="Cancelar">Cancelar</button>
    </div>
</div>