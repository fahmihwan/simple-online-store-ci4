<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<h4>Transaksi</h4>
<table class="table">
    <thead>
        <th>No</th>
        <th>Barang</th>
        <th>Pembeli</th>
        <th>Alamat</th>
        <th>Jumlah</th>
        <th>Harga</th>
        <th>Action</th>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($model as $transaksi) : ?>
            <tr>
                <td> <?= $i++; ?></td>
                <td><?= $transaksi->id_barang; ?></td>
                <td> <?= $transaksi->id_pembeli; ?></td>
                <td><?= $transaksi->alamat; ?></td>
                <td><?= $transaksi->jumlah; ?></td>
                <td> <?= $transaksi->total_harga; ?></td>
                <td>
                    <a href="<?= site_url('transaksi/view/' . $transaksi->id); ?>" class="btn btn-primary">View</a>
                    <a href="<?= site_url('transaksi/invoice/' . $transaksi->id); ?>" class="btn btn-info">print</a>
                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>

</table>
<?= $this->endSection(); ?>