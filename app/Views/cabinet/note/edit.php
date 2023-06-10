<?= $this->extend('layouts/main');
$this->section('title') ?> Posts <?= $this->endSection() ?>
<?= $this->section('content'); ?>


<div class="flex-grid">

    <div class="content">
        <h2>Редактирование раздела</h2>
        <div class="flex-parent">
            <div class="flex-child">

                <form action="<?= base_url('cabinet/note/save') ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="parent" value="">
                    <div>
                        <label>Название</label>
                        <input type="text" name="title" value="<?=$note['title'];?>" placeholder="Название">
                    </div>
                    <div style="display:none">
                        <label>Краткое описание</label>
                        <textarea name="description" placeholder="Тестовый текст"><?=$note['description'];?></textarea>
                    </div>
                    <div class="cabinet-editor">
                        <label>Текст</label>
                        <textarea name="text" class="wsws" placeholder="Тестовый текст"><?=$note['text'];?></textarea>
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
            <div class="flex-child">
                <div class="tabs">
                    <div class="tabs__nav">
                        <button class="tabs__btn tabs__btn_active">Вкладка 1</button>
                        <button class="tabs__btn">Вкладка 2</button>
                        <button class="tabs__btn">Вкладка 3</button>
                    </div>
                    <div class="tabs__content">
                        <div class="tabs__pane tabs__pane_show">
                            Содержимое 1...
                        </div>
                        <div class="tabs__pane">
                            Содержимое 2...
                        </div>
                        <div class="tabs__pane" id="content-3">
                            Содержимое 3...
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>