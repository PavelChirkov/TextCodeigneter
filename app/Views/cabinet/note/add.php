<?= $this->extend('layouts/main');
$this->section('title') ?> Posts <?= $this->endSection() ?>
<?= $this->section('content'); ?>
<div class="flex-grid">
  
    <div class="content">
        <h2>Добавить новый раздел</h2>
        <form action="<?= base_url('cabinet/note/save') ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="parent" value="<?=$id;?>">
                <div>
                    <label>Название</label>
                    <input type="text" name="title" placeholder="Название">
                </div>
                <div>
                    <label>Краткое описание</label>
                    <textarea name="description" placeholder="Тестовый текст"></textarea>
                </div>
                <div>
                    <label>Текст</label>
                    <textarea name="text" placeholder="Тестовый текст"></textarea>
                </div>
                <div>
                    <button type="submit">Добавить</button>
                </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>