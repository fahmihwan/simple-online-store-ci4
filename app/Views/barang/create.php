<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<?php

$session = session();
$errors = $session->getFlashdata('errors');
?>

<h3>Create Barang</h3>
<?php if ($errors) : ?>
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Terjadi Kesalahan</h4>
        <hr class="mb-1 mt-1">
        <?php

        foreach ($errors as $er) {
            echo $er . '<br>';
        }

        ?>
    </div>
<?php endif; ?>
<?= form_open_multipart('barang/create'); ?>
<div class="form-group">
    <?= form_label('Nama', 'nama'); ?>
    <?= form_input([
        'name' => 'nama',
        'id' => 'nama',
        'class' => 'form-control',
        'value' => null,
        'autocomplete' => 'off',
    ]); ?>
</div>
<div class="form-group">
    <?= form_label('Harga', 'harga'); ?>
    <?= form_input([
        'type' => 'number',
        'name' => 'harga',
        'id' => 'harga',
        'class' => 'form-control',
        'autocomplete' => 'off',
        'min' => 0,
    ]); ?>
</div>
<div class="form-group">
    <?= form_label('Stok', 'stok'); ?>
    <?= form_input([
        'type' => 'number',
        'name' => 'stok',
        'id' => 'stok',
        'class' => 'form-control',
        'autocomplete' => 'off',
        'min' => 0,
    ]); ?>
</div>
<div class="form-group">
    <?= form_label('Gambar', 'gambar'); ?>
    <?= form_upload([
        'name' => 'gambar',
        'id' => 'gambar',
        'class' => 'form-control',
    ]); ?>
</div>
<div class="text-right">
    <?= form_submit([
        'id' => 'submit',
        'class' => 'btn btn-success',
        'role' => 'button',
        'value' => 'submit',
        'type' => 'submit'
    ]); ?>
</div>


<?= form_close(); ?>
<?= $this->endSection(); ?>