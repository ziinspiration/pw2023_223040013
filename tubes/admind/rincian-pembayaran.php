<?php
session_start();

if (!isset($_SESSION["login"]) || $_SESSION["role"] !== "admind") {
    header("location: admind-login.php");
    exit;
}

require '../php/function.php';

$conn = koneksi();

$id = $_GET["id"];
$brg = query("SELECT p.*, b.*, u.*, kb.*
              FROM pembayaran p
              JOIN barang b ON p.barang_id = b.id
              JOIN user u ON p.user_id = u.user_id
              JOIN keranjang_belanja kb ON p.keranjang_id = kb.id
              WHERE p.id = $id")[0];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <!-- Default CSS -->
    <link rel="stylesheet" href="css/admind/dashboard-pages/rincian-pembayaran.css" />
    <link rel="icon" href="../assets/img/logo-halodek/halodek-logo.png" />
    <title>rincian-pembayaran-halodek</title>
    <style>
        @media screen and (max-width:700px) {
            .geser {
                margin-top: 5px !important;
            }
        }
    </style>
</head>

<body>
    <!-- Back arrow -->
    <div class="head d-flex bg-primary justify-content-between">
        <a class="ms-3 mt-2" href="verifikasi-pembayaran.php"><i class="fa-solid fa-arrow-left"></i></a>
        <p class="brand mt-2 me-3">
            <i class="fa-solid fa-user-doctor text-light me-2"></i>Halodek
        </p>
    </div>

    <div class="container mt-5">
        <div class="barang mb-5 text-secondary">
            <div class="header">
                <h3 class="mb-3 text-dark">Barang :</h3>
            </div>
            <div class="nama-barang d d-flex">
                <p class="text-bold me-1">Nama barang :</p>
                <p class="geser"><?= $brg['nama']; ?></p>
            </div>
            <div class="kode-barang d d-flex">
                <p class="text-bold me-1">Kode barang :</p>
                <p class="geser"><?= $brg['kode']; ?></p>
            </div>
            <div class="jumlah-pembelian d d-flex">
                <p class="text-bold me-1">Jumlah pembelian :</p>
                <p class="geser"><?= $brg['jumlah']; ?></p>
            </div>
            <div class="total-harga d d-flex">
                <p class="text-bold me-1">Total harga :</p>
                <p class="geser">Rp. <?= $brg['jumlah_harga']; ?></p>
            </div>
        </div>
        <!--  -->
        <div class="pembeli text-secondary">
            <div class="header">
                <h3 class="mb-3 text-dark">Pembayaran :</h3>
            </div>
            <div class="nama-pembeli d d-flex">
                <p class="text-bold me-1">Nama pembeli :</p>
                <p class="geser"><?= $brg['nama_lengkap']; ?></p>
            </div>
            <div class="alamat-pembeli d d-flex">
                <p class="text-bold me-1">Alamat pembeli :</p>
                <p class="geser"><?= $brg['alamat_lengkap']; ?></p>
            </div>
            <div class="nama-rekening d d-flex">
                <p class="text-bold me-1">Nama rekening :</p>
                <p class="geser"><?= $brg['nama_rekening']; ?></p>
            </div>
            <div class="nomer-rekening d d-flex">
                <p class="text-bold me-1">Nomer rekening :</p>
                <p class="geser"><?= $brg['nomor_rekening']; ?></p>
            </div>
            <div class="bukti-transfer d d-flex flex-column">
                <p class="text-bold bukti me-1 w-50">Bukti pembayaran :</p>
                <img class="w-25" src="assets/bukti-tf/<?= $brg['bukti_transfer']; ?>" alt="">
            </div>
        </div>
    </div>

    <!-- Name brand -->
    <div class="name-brand text-center">
        <p>
            <span>Developed by : </span>
            <i class="fa-solid fa-user-doctor text-primary ms-1 me-2"></i>Halodek
        </p>
    </div>

    <!-- Boostrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- Font awesome script -->
    <script src="https://kit.fontawesome.com/59f11d8874.js" crossorigin="anonymous"></script>
</body>

</html>