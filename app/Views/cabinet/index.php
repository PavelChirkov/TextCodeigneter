<?= $this->extend('layouts/main');
$this->section('title') ?> Posts
<?= $this->endSection() ?>
<?= $this->section('content'); ?>
<h1>Рукописи</h1>
<div class="net_grid_1">

    <?
    $i = 1;
    foreach ($notes as $row) { ?>
        <div class="div<?= $i ?> note">
            <div class="panel mm10">
                <img class="icon_big" src="/img/book.svg" alt="Книга">
                <h2>
                    <span class="circle_<?=$row["status"]; ?>"></span><?= $row['title']; ?>
                </h2>
                <div class="link"><a href="/cabinet/note/view/<?= $row['id']; ?>">Подробнее</a></div>
                <?//=$row["status"]; ?>
                <p><a href="/cabinet/map_node/<?= $row['id']; ?>">карта рукописи</a></p>
            </div>
        </div>
    <? $i++;
    }
    ?>
</div>
<a href="/cabinet/note/add">
    <img class="icon_small" src="/img/pencil.svg" alt="Книга"> Написать
</a>
<?= $this->endSection(); ?>