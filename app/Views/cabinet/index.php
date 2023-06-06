<?= $this->extend('layouts/main');
$this->section('title') ?> Posts <?= $this->endSection() ?>
<?= $this->section('content'); ?>
    <a href="/cabinet/note/add">
            Добавить
    </a>
<?= $this->endSection(); ?>