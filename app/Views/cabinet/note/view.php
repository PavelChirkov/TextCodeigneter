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
        <a href="/cabinet/note/add/">Добавить элемент</a>
        <a href="/cabinet/note/add/<?=$note['id'];?>">Добавить дочерний элемент</a>
        <?foreach($noteAll as $row){?>
            <div>
                <div><?=$row["title"];?></div>      
                <div><?=$row["text"];?></div>   
                <div><a href="/cabinet/note/view/<?=$row["id"];?>">Посмотреть</a><a href="/cabinet/note/add/<?=$row['id'];?>">Добавить дочерний элемент</a></div> 
            </div>
            <hr/>
        <?}?>
