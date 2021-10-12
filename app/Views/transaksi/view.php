<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<h4>Transaksi</h4>

<table class="table">
    <tr>
        <td>Barang</td>
        <td><?= $data->nama; ?></td>
    </tr>
    <tr>
        <td>Pembeli</td>
        <td><?= $data->username; ?></td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td><?= $data->alamat; ?></td>
    </tr>
    <tr>
        <td>Jumlah</td>
        <td><?= $data->jumlah; ?></td>
    </tr>
    <tr>
        <td>Total_harga</td>
        <td><?= $data->total_harga; ?></td>
    </tr>

</table>
<?= $this->endSection(); ?>