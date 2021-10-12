<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Username</th>
            <th scope="col">Created By</th>
            <th scope="col">Created Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($data['users'] as $b) : ?>
            <tr>
                <td><?= $b->id; ?></td>
                <td><?= $b->username; ?></td>
                <td><?= $b->created_by; ?></td>
                <td><?= $b->created_date; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="float-right">
    <?= $data['pager']->links('default', 'custome_pagination'); ?>
</div>
<?= $this->endSection(); ?>