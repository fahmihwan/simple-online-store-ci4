<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <?php foreach ($barang as $b) : ?>
            <div class="col-3 mb-3">
                <div class="card" style="max-width: 21rem;">
                    <div class="card-header bg-light text-center">
                        <b class="text-success"><?= $b->nama; ?></b>
                    </div>
                    <div class="card-body text-success text-center p-0 m-3 ">
                        <div class="mb-1">
                            <img class="card-img-top" src="<?= base_url('./uploads/' . $b->gambar); ?>" alt="Card image cap">
                        </div>
                        <h5 class="card-title mt-0 mb-0" style="font-size: 15px;"><?= 'Rp' . number_format($b->harga, '0', ',', '.'); ?></h5>
                        <p class="card-text mt-0 mb-0" style="font-size: 14px;">Stok: <?= $b->stok; ?></p>
                    </div>
                    <div class="card-footer bg-transparent p-2">
                        <a class="btn btn-success btn-block" href="<?= site_url('./etalase/beli/' . $b->id); ?>">Beli</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection(); ?>