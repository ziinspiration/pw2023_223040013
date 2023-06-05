<?php
session_start();

if (!isset($_SESSION["login"]) || $_SESSION["role"] !== "admind") {
    header("location: admind-login.php");
    exit;
}

require '../php/function.php';

$conn = koneksi();

$brg = query("SELECT p.*, kb.*, b.*, u.*, p.id as id_pembayaran
              FROM pembayaran p
              JOIN keranjang_belanja kb ON p.keranjang_id = kb.id
              JOIN user u ON p.user_id = u.user_id
              JOIN barang b ON p.barang_id = b.id
              WHERE p.id AND p.status = 'Sukses'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <!-- Default CSS -->
    <link rel="stylesheet" href="css/admind/dashboard-pages/verifikasi-pembayaran.css" />
    <link rel="icon" href="../assets/img/logo-halodek/halodek-logo.png" />
    <title>verifikasi-pembayaran-halodek</title>
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <!-- Back arrow -->
    <div class="head d-flex bg-primary justify-content-between no-print">
        <a class="ms-3 mt-2" href="dashboard-admind.php"><i class="fas fa-arrow-left"></i></a>
        <p class="brand mt-2 me-3">
            <i class="fas fa-user-doctor text-light me-1"></i>Halodek
        </p>
    </div>

    <button class="btn btn-danger ms-3 mt-3 no-print" onclick="window.print()"><i class="fa-solid fa-file-pdf"></i>
        Download</button>

    <!-- card 1 -->
    <?php foreach ($brg as $b) : ?>
        <form action="" method="post">
            <div class="card card-pesanan ps-3">
                <div class="foto-barang">
                    <img src="../assets/img/<?= $b['gambar']; ?>" alt="" />
                </div>
                <!--  -->
                <div class="deskripsi-barang">
                    <div class="nama-barang d-flex">
                        <p class="fw-bold"><?= $b['nama']; ?></p>
                    </div>

                    <div class="no-pesanan d-flex">
                        <p class="me-1">No pesanan :</p>
                        <p class="fw-bold"><?= $b['id_pembayaran']; ?></p>
                    </div>

                    <div class="no-pesanan d-flex flex-column">
                        <p class="me-1">Nama Pembeli : <span class="fw-bold"><?= $b['nama_lengkap']; ?></span></p>
                    </div>

                    <div class="no-pesanan d-flex flex-column">
                        <p class="me-1">Username : <span class="fw-bold"><?= $b['username']; ?></span></p>
                    </div>

                    <div class="status-pembayaran d-flex">
                        <p class="me-1">Status :</p>
                        <?php
                        if ($b['status'] == 'Belum di konfirmasi') :
                        ?>
                            <p class="text-danger status fw-bold"><?= $b['status']; ?></p>
                        <?php else :  ?>
                            <p class="text-success status fw-bold"><?= $b['status']; ?></p>
                        <?php endif ?>
                    </div>
                </div>
                <!--  -->
                <a class="mb-3 text-decoration-none rincian" href="rincian-sukses.php?id=<?= $b["id_pembayaran"] ?>">Rincian
                    pembayaran</a>
                <!--  -->
            </div>
        </form>
    <?php endforeach; ?>


    <!-- Name brand -->
    <div class="name-brand text-center">
        <p>
            <span>Developed by : </span>
            <i class="fas fa-user-doctor text-primary me-1"></i>Halodek
        </p>
    </div>

    <!-- Bootstrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- Font awesome script -->
    <script src="https://kit.fontawesome.com/59f11d8874.js" crossorigin="anonymous"></script>
</body>

</html>