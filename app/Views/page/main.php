<?=$this->extend('layouts/master');
$this->section('title') ?> Create Post <?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="container">
<?php $validation = \Config\Services::validation(); ?>
    <div class="row">
        <div class="col-xl-6 m-auto">
            <form method="POST" action="/login/on" >
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="POST"/>
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="card-title">Форма входа</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="form-group mb-3 has-validation">
                            <label class="form-label">Логин пользователя:</label>
                            <input type="text" class="form-control <?php if($validation->getError('login')): ?>is-invalid<?php endif ?>" name="login" placeholder="Логин пользователя" />
                            <?php if ($validation->getError('login')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('login') ?>
                                </div>                                
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Пароль пользователя:</label>
                            <input type="text" class="form-control <?php if($validation->getError('password')): ?>is-invalid<?php endif ?>" name="password" placeholder="Пароль пользователя" />
                                <?php if ($validation->getError('password')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('password') ?>
                                </div>                                
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Вход</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>