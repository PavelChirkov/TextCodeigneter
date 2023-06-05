<?= $this->extend('layouts/master');
$this->section('title') ?> Create Post <?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="container">
<?php $validation = \Config\Services::validation(); ?>

    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('notes') ?>" class="btn btn-primary">Back to Posts</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 m-auto">
            <form method="POST" action="<?= base_url('notes/'.$notes['id']) ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT"/>

                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="card-title">Update Post</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="form-group mb-3 has-validation">
                            <label class="form-label">Post Title</label>
                            <input type="text" class="form-control <?php if($validation->getError('title')): ?>is-invalid<?php endif ?>" name="title" placeholder="Post Title" value="<?php if($notes['title']): echo $notes['title']; else: set_value('title'); endif ?>"/>
                            <?php if ($validation->getError('title')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('title') ?>
                                </div>                                
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea class="form-control <?php if($validation->getError('description')): ?>is-invalid<?php endif ?>" name="description" placeholder="Description"><?php if($notes['description']): echo $notes['description']; else: set_value('description'); endif ?></textarea>
                                <?php if ($validation->getError('description')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('description') ?>
                                </div>                                
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>