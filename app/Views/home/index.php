<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>
<?php
$session = session();
?>

<p>selamat datang <?= $session->username; ?></p>

<?= $this->endSection(); ?>