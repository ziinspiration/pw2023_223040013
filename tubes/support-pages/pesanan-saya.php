<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../login-page/login-user.php");
    exit;
}

require '../php/function.php';

$conn = koneksi();

$user_id = $_SESSION["user_id"];
$brg = query("SELECT p.*, b.*, u.*, p.id as id_pembayaran
              FROM pembayaran p
              JOIN barang b ON p.barang_id = b.id
              JOIN user u ON p.user_id = u.user_id
              WHERE p.user_id = $user_id");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <!-- Default CSS -->
    <link rel="stylesheet" href="../css/support-pages/pesanan/pesanan-saya.css" />
    <link rel="icon" href="../assets/img/logo-halodek/halodek-logo.png" />
    <title>pesanan-saya-halodek</title>
</head>

<body>
    <!-- Back arrow -->
    <div class="head d-flex bg-primary justify-content-between">
        <a class="ms-3 mt-2" href="../login-page/index-login.php"><i class="fa-solid fa-arrow-left"></i></a>
        <p class="brand mt-2 me-3">
            <i class="fa-solid fa-user-doctor text-light me-1"></i>Halodek
        </p>
    </div>

    <div class="container">
        <?php foreach ($brg as $t) : ?>
            <div class="card-pesanan bg-primary rounded-3 p-1 mt-3">
                <div class="left-card d-flex bg-light rounded p-2 mb-1">
                    <!-- foto barang -->
                    <div class="foto-barang">
                        <img class="rounded" src="../assets/img/<?= $t['gambar']; ?>" alt="" />
                    </div>
                    <!-- nama barang-->
                    <div class="nama-barang">
                        <p class="fw-bold ms-2"><?= $t['nama']; ?></p>
                    </div>
                </div>
                <!--  -->
                <div class="right-card bg-light rounded">
                    <div class="status-pengiriman d-flex ms-2 rounded">
                        <p class="head-status me-2">Status :</p>
                        <?php
                        if ($t['status'] == 'Belum di konfirmasi') :
                        ?>
                            <p class="status text-danger fw-bold"><?= $t['status']; ?></p>
                        <?php else :  ?>
                            <p class="status text-success fw-bold"><?= $t['status']; ?></p>
                        <?php endif ?>
                    </div>
                    <div class="rincian mt-1 mb-2">
                        <a class="btn btn-primary" href="nota-barang.php?id=<?= $t["id_pembayaran"] ?>"><i class="fa-solid fa-download me-1"></i> Nota pembelian</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Name brand -->
    <div class="name-brand-bottom text-center mt-4">
        <p>
            <span>Developed by : </span>
            <i class="fa-solid fa-user-doctor text-primary me-1"></i>Halodek
        </p>
    </div>

    <!-- Boostrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- Font awesome script -->
    <script src="https://kit.fontawesome.com/59f11d8874.js" crossorigin="anonymous"></script>
</body>

</html>