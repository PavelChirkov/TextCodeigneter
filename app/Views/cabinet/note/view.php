<?= $this->extend('layouts/main');
$this->section('title') ?> Posts <?= $this->endSection() ?>
<?= $this->section('content'); ?>   
<div class="flex-grid">
    <div class="content"><a href="/cabinet/note/add/">Добавить элемент</a></div>
</div> 
    <div class="flex-grid action-open-close">
        <div class="name-element"><?=$note['title'];?></div>
        <div class="content">
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
        <div class="button">Открыть</div>
    </div>
    <div class="flex-grid">
        <div class="content"><a href="/cabinet/note/add/<?=$note['id'];?>">Добавить дочерний элемент</a></div>
    </div>
    <div id="cabinet-paper">
        <?foreach($noteAll as $row){?>
            <div class="flex-grid <?=$row["status"];?>">
                <div class="content">
                    <?$count = strlen($row["text"]); ?>
                    <h2><?=$row["title"];?></h2>    
                    <div class="text">
                        <div class="edit-text">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg>
                        </div>
                        <div class="inner"><?=$row["text"];?></div>
                        <div class="edit-form">
                            <form action="/cabinet/note/update/<?=$row["id"];?>" class="ajaxForm" method="POST">
                                <textarea name="text" class="wsws"><?=$row["text"];?></textarea>
                                <button type="submit">Сохранить</button>
                            </form>
                        </div>
                    </div>   
                    <div>

                    <div class="panel-note">    
                        <a href="/cabinet/note/view/<?=$row["id"];?>"><img src="/img/eye.svg" alt="Посмотреть" style="width:16px;height:16px;" class="icon_note_param" /></a>
                        <a href="/cabinet/note/add/<?=$row['id'];?>"><img src="/img/category.svg" alt="Дочерний элемент" style="width:16px;height:16px;" class="icon_note_param" /></a>
                        <span class="setting">
                            <span class="status">Статус: <?=$row["status"];?></span>
                            <span class="visible">Видимость: <?=$row["visible"];?></span>
                        </span>
                        <div class="text-value"><?=$count;?></div>
                    </div> 
                     
                    
                    </div>
                </div>
                <div class="bline"></div>
            </div>
        <?}?>
    </div>
        <div id="cabinet-note-add">
        <div class="flex-grid">
            <div class="content">
                <h2>Дочерний элемент</h2>
                    <form action="<?= base_url('cabinet/note/save') ?>" method="POST">
                                <?= csrf_field() ?>
                                <input type="hidden" name="parent" value="<?=$note['id'];?>">
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
                                    <textarea class="wsws" name="text" placeholder="Тестовый текст"></textarea>
                                </div>
                                <div class="status">
                                    <label>Статус:</label>
                                    <span>
                                        Черновик:<input type="radio" name="status" value="draft" checked />
                                    </span>
                                    <span>
                                    В написании:<input type="radio" name="status" value="pending" />
                                    </span>
                                    <span>
                                    Опубликовано:<input type="radio" name="status" value="publish" />
                                    </span>
                                </div>
                                <div>
                                    <button type="submit">Добавить</button>
                                </div>
                        </form>
            </div>
        </div>
    </div>
    <?= $this->endSection(); ?>