<?= $this->extend('layouts/main');
$this->section('title') ?> Posts <?= $this->endSection() ?>
<?= $this->section('content'); ?>    
    <div class="flex-grid">
        <div>
            <div>
                <label>Название</label><br>
                <input type="text" name="title" value="<?=$note['title'];?>" readonly>
            </div>
            <div>
                <label>Краткое описание</label><br>
                <textarea name="description" placeholder="Тестовый текст" readonly><?=$note['description'];?></textarea>
            </div>
            <div>
                <label>Текст</label><br>
                <textarea name="text" placeholder="Тестовый текст" readonly><?=$note['text'];?></textarea>
            </div>
        </div>
    </div>
    <div class="flex-grid">
        <a href="/cabinet/note/add/">Добавить элемент</a>
        <a href="/cabinet/note/add/<?=$note['id'];?>">Добавить дочерний элемент</a>
    </div>
        <?foreach($noteAll as $row){?>
            <div class="flex-grid">
                <div>
                    <h2><?=$row["title"];?></h2>    
                    <div><?=$row["text"];?></div>   
                    <div><a href="/cabinet/note/view/<?=$row["id"];?>">Посмотреть</a><a href="/cabinet/note/add/<?=$row['id'];?>">Добавить дочерний элемент</a></div> 
                </div>
            </div>
        <?}?>
        <?= $this->endSection(); ?>