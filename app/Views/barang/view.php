<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<h4>View</h4>

<?php
foreach ($barang as $br) :
?>
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="<?= base_url('uploads/' . $br->gambar); ?>" alt="Card image cap">

        <ul class="list-group list-group-flush ">
            <li class="list-group-item text-center bg-secondary text-light">
                <b><?= $br->nama; ?></b>
            </li>
            <li class="list-group-item"> <b>harga </b><?= "Rp " . number_format($br->harga, '0', ',', '.'); ?></li>
            <li class="list-group-item"> <b>stok</b> <?= $br->stok; ?> item</li>
        </ul>

    </div>
<?php
endforeach;
?>


<?= $this->endSection(); ?>