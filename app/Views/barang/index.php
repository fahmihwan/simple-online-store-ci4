<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Barang</th>
            <th scope="col">Gambar</th>
            <th scope="col">Harga</th>
            <th scope="col">Stok</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $num = 1;
        foreach ($barangs as $brg) : ?>
            <tr>
                <th scope="row"><?= $num++; ?></th>
                <td><?= $brg->nama; ?></td>
                <td>
                    <img src="<?= base_url('uploads/' . $brg->gambar); ?>" class="img-fluid" width='160px'></div>
                </td>
                <td><?= 'Rp' . number_format($brg->harga, '0', ',', '.'); ?></td>
                <td><?= $brg->stok; ?></td>
                <td>
                    <a href="<?= site_url('barang/view/' . $brg->id); ?>" class="btn btn-primary">View</a>
                    <a href="<?= site_url('barang/update/' . $brg->id); ?>" class="btn btn-success">Update</a>
                    <a href="<?= site_url('barang/delete/' . $brg->id); ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>
<?= $this->endSection(); ?>