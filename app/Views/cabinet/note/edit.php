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
                    <input type="hidden" name="parent" value="<?= $note['id']; ?>">
                    <input type="hidden" name="action" value="edit">
                    <div>
                        <label>Название</label>
                        <input type="text" name="title" value="<?= $note['title']; ?>" placeholder="Название">
                    </div>
                    <div style="display:none">
                        <label>Краткое описание</label>
                        <textarea name="description" placeholder="Тестовый текст"><?= $note['description']; ?></textarea>
                    </div>
                    <div class="cabinet-editor">
                        <label>Текст</label>
                        <textarea name="text" class="wsws" placeholder="Тестовый текст"><?= $note['text']; ?></textarea>
                    </div>
                    <div class="status">
                        <label>Статус:</label>
                        <span>
                            Черновик:<input type="radio" name="status" value="draft" <? if ($note["status"] == "draft") { ?>checked<? } ?> />
                        </span>
                        <span>
                            В написании:<input type="radio" name="status" value="pending" <? if ($note["status"] == "pending") { ?>checked<? } ?> />
                        </span>
                        <span>
                            Опубликовано:<input type="radio" name="status" value="publish" <? if ($note["status"] == "publish") { ?>checked<? } ?> />
                        </span>
                    </div>
                    <div>
                        <button type="submit">Изменить</button>
                    </div>
                </form>
            </div>
            <div class="flex-child">
                <div class="tabs">
                    <div class="tabs__nav">
                        <button style="width:30px;padding:8px 3px 3px 3px;" class="tabs__btn tabs__btn_active"><img src="/img/settings.svg" style="width:16px;height:16px;" alt=""></button>
                        <button class="tabs__btn">Пометки к данному тексту</button>
                        <button class="tabs__btn">Теги</button>
                        <button class="tabs__btn">Добавить пометку</button>
                    </div>
                    <div class="tabs__content">
                        <div class="tabs__pane tabs__pane_show">
                            <h2>Настройки: </h2>
                            <div class="border_panel">
                                <h3>Изображение:</h3>
                                <form action="<?= base_url('cabinet/note/save') ?>" method="POST">
                                    <input type="file" name="file">
                                    <button type="submit">Изменить изображение</button>
                                </form>
                            </div>
                        </div>
                        <div class="tabs__pane">
                            <div class="content-tag">
                                <h2>Пометки: </h2>
                                <?
                                foreach ($tag as $row) { ?>
                                    <div class="tag">
                                        <div class="bold-tag"><?= $row["title"]; ?></div>
                                        <div class="text-tag"><?= $row["text"]; ?></div>
                                    </div>
                                <? } ?>
                            </div>
                        </div>
                        <div class="tabs__pane">
                            <h2>Теги: </h2>
                        </div>
                        <div class="tabs__pane" id="content-3">
                            <h2>Добавить пометку: </h2>
                            <form method="POST" action="<?= base_url('cabinet/tagging/save/' . $note['id']) ?>">
                                <div>
                                    <label>Название</label>
                                    <input type="text" name="title" placeholder="Название">
                                </div>
                                <div class="cabinet-editor">
                                    <label>Текст</label>
                                    <textarea name="text" placeholder="Тестовый текст"></textarea>
                                </div>
                                <div>
                                    <button type="submit">Добавить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>