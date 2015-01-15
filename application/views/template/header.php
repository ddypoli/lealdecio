<!html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>CodeIgniter | <?= $title ?></title>
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>css/style.css" />
        <script type="text/javascript" src="<?= base_url(); ?>js/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>js/script.js"></script>
    </head>
    <body>
        <ul class="nav">
            <?php foreach ($menu as $item): ?>
            <li><?= $item ?></li>
            <?php endforeach; ?>
        </ul>