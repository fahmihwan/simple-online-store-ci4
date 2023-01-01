<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>
<h3>register</h3>
<?php

use phpDocumentor\Reflection\Types\Null_;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;

$username = [
    'name' => 'username',
    'id' => 'username',
    'value' => NULL,
    'class' => 'form-control'
];

$password = [
    'name' => 'password',
    'id' => 'password',
    'class' => 'form-control',
];
$repeatPassword = [
    'name' => 'repeatPassword',
    'id' => 'repeatPassword',
    'class' => 'form-control',
];
$submit = [
    'class' => 'btn btn-success w-100',
    'value' => 'registerasi',
];
$session = \Config\Services::session();
$errors = $session->getFlashdata('errors');

?>

<?php if ($errors) : ?>
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">terjadi kesalahan</h4>
        <hr>
        <div class="mb-0">
            <?php foreach ($errors as $er) : ?>
                <?= $er . '<br>' ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<?= form_open('Auth/register'); ?>
<div class="w-50">
    <div class="form-group">
        <?= form_label('Username', 'username'); ?>
        <?= form_input($username); ?>
    </div>
    <div class="form-group">
        <?= form_label('Password', 'password'); ?>
        <?= form_password($password); ?>
    </div>
    <div class="form-group">
        <?= form_label('Repeat Password', 'repeatPassword'); ?>
        <?= form_password($repeatPassword); ?>
    </div>
    <div class="text-right">
        <?= form_submit($submit); ?>
    </div>
</div>

<?= form_close() ?>
<?= $this->endSection(); ?>