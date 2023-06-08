<?= $this->extend('layouts/main');
$this->section('title') ?> Posts
<?= $this->endSection() ?>
<?= $this->section('content'); ?>

<?
foreach ($notes as $row) { ?>
    <div class="note">
        <h2>
            <?= $row['title']; ?>
        </h2>
        <div class="link"><a href="/cabinet/note/view/<?=$row['id'];?>">Подробнее</a></div>
    </div>
<? }
?>
<a href="/cabinet/note/add">
    Добавить
</a>
<?= $this->endSection(); ?>