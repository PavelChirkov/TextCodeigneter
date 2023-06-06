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
<a href="/cabinet/note/add/<?=$note['id'];?>">Добавить дочерний элемент</a>
