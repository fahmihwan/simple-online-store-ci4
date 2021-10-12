<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>
<?php


?>

<?= form_open_multipart('barang/update/' . $barang->id); ?>
<?= form_input([
    'name' => 'id',
    'id' => 'id',
    'type' => 'hidden',
    'class' => 'form-control',
    'value' => $barang->id,
    'autocomplete' => 'off',
]); ?>
<div class="form-group">
    <?= form_label('Nama', 'nama'); ?>
    <?= form_input([
        'name' => 'nama',
        'id' => 'nama',
        'class' => 'form-control',
        'value' => $barang->nama,
        'autocomplete' => 'off',
    ]); ?>
</div>
<div class="form-group">
    <?= form_label('Harga', 'harga'); ?>
    <?= form_input([
        'type' => 'number',
        'name' => 'harga',
        'id' => 'harga',
        'value' => $barang->harga,
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
        'value' => $barang->stok,
        'class' => 'form-control',
        'autocomplete' => 'off',
        'min' => 0,
    ]); ?>
</div>
<img class="card-img-top" style="width: 7rem;" src="<?= base_url('uploads/' . $barang->gambar); ?>" alt="Card image cap">
<div class="form-group">
    <?= form_label('Gambar', 'gambar'); ?>
    <?= form_upload([
        'name' => 'gambar',
        'id' => 'gambar',
        'value' => null,
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