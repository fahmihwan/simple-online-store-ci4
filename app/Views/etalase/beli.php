<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>
<?php
$id_barang = [
    'name'  => 'id_barang',
    'id' => 'id_barang',
    'value'   => $barang->id,
    'type'   => 'hidden',
];

$id_pembeli = [
    'name'  => 'id_pembeli',
    'id' => 'id_pembeli',
    'value'   => session()->get('id'),
    'type'   => 'hidden',
];

$jumlah = [
    'name'  => 'jumlah',
    'id' => 'jumlah',
    'type' => 'number',
    'class'   => 'form-control',
    'value'   => 1,
    'min'   => 1,
    'max' => $barang->stok,
    'autocomplete' => 'off',
];

$total_harga = [
    'name'  => 'total_harga',
    'id' => 'total_harga',
    'class' => 'form-control',
    'value' => null,
    'readonly' => true,
    'type' => 'number',
];

$ongkir = [
    'name'  => 'ongkir',
    'id' => 'ongkir',
    'class'   => 'form-control',
    'value'   => null,
    'readonly' => true,
];

$alamat = [
    'name' => 'alamat',
    'id' => 'alamat',
    'class' => 'form-control',
    'value' => null,
];

$submit = [
    'id' => 'submit',
    'type' => 'submit',
    'value' => 'Beli',
    'class' => 'btn btn-success',
];



?>
<div class="card">
    <div class="card-header">
        Pengiriman
    </div>
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-4">

                    <img class="" src="<?= base_url('./uploads/' . $barang->gambar); ?>" alt="Card image cap" style="width: 20rem;">

                </div>
                <div class="col-4">
                    <?= form_open('etalase/beli/' . $barang->id); ?>
                    <div class="form-group">
                        <label for="provinsi">Pilih Provinsi</label>
                        <select class="form-control" id="provinsi">
                            <option>Select Provinsi</option>
                            <?php foreach ($provinsi as $prov) : ?>
                                <option value="<?= $prov->province_id; ?>"><?= $prov->province ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kabupaten">Pilih Kabupaten Kota</label>
                        <select class="form-control" id="kabupaten">
                            <option>Select Kabupaten</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="service">Pilih Service</label>
                        <select class="form-control" id="service">
                            <option>Select Service</option>
                        </select>
                        <b class="text-secondary">Estimasi: <span id="estimasi"></span></b>
                    </div>

                </div>
                <div class="col-4">
                    <?= form_input($id_barang); ?>
                    <?= form_input($id_pembeli); ?>
                    <div class="form-group">
                        <?= form_label('Jumlah Pembelian', 'jumlah'); ?>
                        <?= form_input($jumlah); ?>
                    </div>
                    <div class="form-group">
                        <?= form_label('Ongkir', 'ongkir'); ?>
                        <?= form_input($ongkir); ?>
                    </div>
                    <div class="form-group">
                        <?= form_label('Total harga', 'total_harga'); ?>
                        <?= form_input($total_harga); ?>
                    </div>
                    <div class="form-group">
                        <?= form_label('Alamat', 'alamat'); ?>
                        <?= form_input($alamat); ?>
                    </div>
                    <div class="text-right">
                        <?= form_submit($submit); ?>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>

        </div>
    </div>
    <div class="row mb-3 mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>komentar</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="<?= site_url('komentar/create/' . $barang->id); ?>" class="btn btn-link">tinggalkan komentar</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php foreach ($komentar as $komen) : ?>
                                <strong><?= $komen->username; ?></strong>
                                <span style="font-size:12px" class="text-secondary float-right"><?= $komen->date_comment; ?></span>
                                <br>
                                <?= $komen->komentar; ?>
                                <hr>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
    $('document').ready(function() {
        let jumlah_pembelian = 1;
        let harga = "<?= $barang->harga ?>"
        let ongkir = 0;


        $('#provinsi').change(function() {
            $('#kabupaten').empty();
            const id_prov = $(this).val();
            $.ajax({
                url: "<?= site_url('Etalase/getCity') ?>",
                type: 'GET',
                data: {
                    'id_province': id_prov,
                },
                dataType: 'JSON',
                success: function(data) {
                    let provinsi = data['rajaongkir']['results'];
                    provinsi.forEach(prov => {
                        $('#kabupaten').append(`<option value=${prov['city_id']}> ${prov['city_name']} </option>`);
                    });
                }
            })
        })

        $('#kabupaten').change(function() {
            const id_kabupaten = $(this).val();
            $('#service').empty();
            $.ajax({
                url: "<?= site_url('etalase/getCost') ?>",
                type: "GET",
                data: {
                    origin: '251', //kota asal magetan
                    destination: id_kabupaten,
                    weight: '1700',
                    courier: 'jne',
                },
                dataType: "JSON",
                success: function(data) {
                    const results = data['rajaongkir']['results'][0]['costs']
                    for (let i = 0; i <= results.length; i++) {
                        const text = `${results[i]['description']} (${results[i]['service']})`;
                        const value = results[i]['cost'][0]['value']
                        const etd = results[i]['cost'][0]['etd'];

                        $('#service').append(`<option value=${value} etd=${etd}> ${text} </option>`);
                    }
                }
            })
        })

        $('#service').change(function() {
            const estimasi = $('option:selected', this).attr('etd');
            ongkir = parseInt($(this).val());
            $('#ongkir').val(ongkir);
            $('#estimasi').html(estimasi + " hari");
            let total_harga = (jumlah_pembelian * harga) + ongkir;
            $('#total_harga').val(total_harga);
        })

        $('#jumlah').change(function() {
            jumlah_pembelian = $(this).val();
            let total_harga = (jumlah_pembelian * harga) + ongkir;
            $('#total_harga').val(total_harga);
        })
    })
</script>
<?= $this->endSection(); ?>