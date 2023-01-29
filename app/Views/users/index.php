<?= $this->extend('layouts/master');
$this->section('title') ?> Posts <?= $this->endSection() ?>
<?= $this->section('content'); ?>
   
   <div class="container">
        <div class="row py-4">
            <div class="col-xl-12 text-end">
                <a href="<?= base_url('posts/new') ?>" class="btn btn-primary">Add Post</a>
            </div>
        </div>

            <div class="row py-2">
                <div class="col-xl-12">
                    <?php
                        if(session()->getFlashdata('success')):?>
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="btn-close" data-bs-dismiss="alert">&times;</button>
                                <?php echo session()->getFlashdata('success') ?>
                            </div>
                        <?php elseif(session()->getFlashdata('failed')):?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="btn-close" data-bs-dismiss="alert">&times;</button>
                                <?php echo session()->getFlashdata('failed') ?>
                            </div>
                    <?php endif; ?>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Posts</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if (count($users) > 0):
                                            foreach ($users as $post): ?>
                                                <tr>
                                                    <td><?= $post['id'] ?></td>
                                                    <td><?= $post['name'] ?></td>
                                                    <td><?= $post['description'] ?></td>
                                                    <td class="d-flex">
                                                        <a href="<?= base_url('posts/'.$post['id']) ?>" class="btn btn-sm btn-info mx-1" title="Show"><i class="bi bi-info-square"></i></a>
                                                        <a href="<?= base_url('posts/edit/'.$post['id']) ?>" class="btn btn-sm btn-success mx-1" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                                        <form class="display-none" method="post" action="<?= base_url('posts/'.$post['id'])?>" id="postDeleteForm<?=$post['id']?>">
                                                        <input type="hidden" name="_method" value="DELETE"/>
                                                            <a href="jаvascript:void(0)" onclick="deletePost('postDeleteForm<?=$post['id']?>')" class="btn btn-sm btn-danger" title="Delete"><i class="bi bi-trash"></i></a>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach;
                                        else: ?>
                                            <tr rowspan="1">
                                                <td colspan="4">
                                                    <h6 class="text-danger text-center">No post found</h6>
                                                </td>
                                            </tr>
                                        <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
   </div>

   <script>
    function deletePost(formId) {
        var confirm = window.confirm('Do you want to delete this post?');
        if(confirm == true) {
            document.getElementById(formId).submit();
        }
    }
</script>
<?= $this->endSection(); ?>