
<?= $this->extend('layouts/main');
$this->section('title') ?> Posts <?= $this->endSection() ?>
<?= $this->section('content'); ?>
<?=$message;?>
<h1>Профиль</h1>
    <div class="flex-grid">
        <div class="content">
            <h2>Профиль пользователя</h2>
            <form action="<?= base_url('cabinet/user/update') ?>" method="POST">
                    <?= csrf_field() ?>
                    <div>
                        <label>Логине</label>
                        <input type="text" name="login" value="<?=$user["login"]; ?>" placeholder="Название">
                    </div>
                    <div>
                        <label>Краткое описание</label>
                        <textarea name="description" placeholder="Тестовый текст"><?=$user["description"]; ?></textarea>
                    </div>
                    <div>
                        <button type="submit">Изменить</button>
                    </div>
            </form>
        </div>
    </div>

<?= $this->endSection(); ?>