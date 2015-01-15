<h1><?= $title; ?></h1>
<?= validation_errors(); ?>
<?= $error; ?>
<?= form_open_multipart(); ?>
    <input type="text" name="titulo" placeholder="Título" /><br />
    <textarea name="descricao" placeholder="Descrição"></textarea><br />
    <input type="text" name="endereco" placeholder="Endereço" /><br />
    <input type="text" name="bairro" placeholder="Bairro" /><br />
    <select name="cidade">
        <option value="">Selecione algum</option>
        <?php foreach ($cidades as $cidade): ?>
        <option value="<?= $cidade->id; ?>"><?= $cidade->nome; ?></option>
        <?php endforeach; ?>
    </select><br />
    <input type="number" name="largura" placeholder="Largura em metros" /><br />
    <input type="number" name="comprimento" placeholder="Comprimento em metros" /><br />
    <input type="file" name="imagens[]" multiple /><br />
    <button type="submit" name="submit" value="submit">Enviar</button>
</form>