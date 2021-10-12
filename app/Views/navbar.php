<?php $session = session(); ?>
<nav class="navbar navbar-expand-md navbar-dark bg-success fixed-top">
    <a class="navbar-brand" href="#"><b>Tokopidi</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">

        <ul class="navbar-nav mr-auto">

            <!-- <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
            </li> -->
            <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Barang</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="#">Tambah Barang</a>
                    <a class="dropdown-item" href="#">list arang</a>

                </div>
            </li> -->
            <?php if ($session->has('isLoggedIn')) : ?>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <?php if ($session->get('role') == 0) : ?>
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Barang</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown01">
                            <a class="dropdown-item" href="<?= site_url('barang/index'); ?>">list-barang</a>
                            <a class="dropdown-item" href="<?= site_url('barang/create'); ?>">Tambah barang</a>
                        </div>
                    </li>
                <?php endif; ?>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= site_url('etalase/index'); ?>">Etalase</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= site_url('transaksi/index'); ?>">Transaksi</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= site_url('user/index'); ?>">User</a>
                </li>
        </ul>
    <?php endif; ?>
    <div class="form-inline my-2 my-lg-0 float-right ">
        <ul class="navbar-nav ml-auto">
            <?php if (!$session->has('isLoggedIn')) : ?>
                <li class="nav-item">
                    <a href="<?= base_url('auth/login'); ?>" class="btn btn-success"> Login</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('auth/register'); ?>" class="btn btn-success"> Register</a>
                </li>
            <?php endif; ?>
            <?php if ($session->has('isLoggedIn')) : ?>
                <li class="nav-item">
                    <a href="<?= base_url('auth/logout'); ?>" class="btn btn-success"> logout</a>
                </li>
            <?php endif; ?>

        </ul>
        <!-- <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
    </div>
    </div>
</nav>