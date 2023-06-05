<?= $this->extend('layouts/master');
$this->section('title') ?> Show Post <?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('notes') ?>" class="btn btn-primary">Back to Posts</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 m-auto">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="card-title">Show Post</h5>
                </div>
                <div class="card-body p-4">
                    <div class="form-group mb-3 has-validation">
                        <label class="form-label">Post Title</label>
                        <input type="text" class="form-control" disabled placeholder="Post Title" value="<?php echo trim($notes['title']);?>"/>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" disabled name="description" placeholder="Description"><?php echo trim($notes['description']);?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>