<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>
<h1>Form Login</h1>
<?php
$username = [
    'name' => 'username',
    'id' => 'username',
    'value' => NULL,
    'class' => 'form-control',
];

$password = [
    'id' => 'password',
    'name' => 'password',
    'class' => 'form-control'
];

$submit = [
    'class' => 'btn btn-success w-100',
    'value' => 'Login',
];

$session = session();

$errors = $session->getFlashdata('errors');

?>

<?php if ($errors) : ?>
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">terjadi kesalahan</h4>
        <hr>
        <div class="mb-0">
            <?php foreach ($errors as $err) : ?>
                <?= $err . '<br>'; ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
<?= form_open('Auth/login'); ?>
<div class="col-md-5 ">
    <div class="form-group">
        <?= form_label('Username', 'username'); ?>
        <?= form_input($username); ?>
    </div>
    <div class="form-group">
        <?= form_label('Password', 'password'); ?>
        <?= form_password($password); ?>
    </div>
    <div class="text-right">
        <?= form_submit($submit); ?>
    </div>
</div>
<?= form_close(); ?>


<?= $this->endSection(); ?>