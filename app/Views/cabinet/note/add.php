<? 
    print_r($user);
?>
<form action="<?= base_url('cabinet/note/save') ?>" method="POST">
        <?= csrf_field() ?>
        <input type="hidden" name="parent" value="<?=$id;?>">
        <div>
            <label>Название</label><br>
            <input type="text" name="title" placeholder="Название">
        </div>
        <div>
            <label>Краткое описание</label><br>
            <textarea name="description" placeholder="Тестовый текст"></textarea>
        </div>
        <div>
            <label>Текст</label><br>
            <textarea name="text" placeholder="Тестовый текст"></textarea>
        </div>
        <div>
            <button type="submit">Добавить</button>
        </div>
</form>
