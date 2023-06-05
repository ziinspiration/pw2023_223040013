<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../login-page/login-user.php");
    exit;
}

require '../php/function.php';
$id = $_GET["id"];
$brg = query("SELECT * FROM barang WHERE id = $id")[0];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <!-- Default CSS -->
    <link rel="stylesheet" href="../css/support-pages/detail-item/detail-item-login.css" />
    <link rel="icon" href="../assets/img/logo-halodek/halodek-logo.png" />
    <title>detail-item-halodek</title>
    <style>
        .text {
            margin-top: -7px !important;
        }


        h6 {
            font-weight: 700 !important;
        }

        @media screen and (max-width:600) {
            .nama-barang h1 {
                font-size: 12px !important;
            }

            .container {
                margin-top: 10px !important;
            }
        }
    </style>
</head>

<body>
    <!-- HEADER & NAVBAR PAGE -->
    <div class="header-navbar-dekstop fixed-top">
        <nav class="navbar navbar-light bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand ms-3"><i class="fa-solid fa-user-doctor text-light me-2"></i> HaloDek</a>
            </div>
        </nav>
    </div>
    <!-- HEADER & NAVBAR END -->

    <div class="arrow-back">
        <a class="ms-4" href="../login-page/index-login.php"><i class="fa-solid fa-arrow-left"></i></a>
    </div>

    <div class="container d-flex p-3 mt-4 mb-5 rounded">
        <div class="left d-flex flex-column bg-light p-3 rounded-3">
            <div class="image">
                <img src="../assets/img/<?= $brg["gambar"]; ?>" alt="" />
            </div>
            <!--  -->
            <div class="price">
                <p class="price-normal text-danger text-decoration-line-through">
                    Rp.<?= $brg['harga_normal'] ?>
                </p>
                <p class="price-promo text-primary">Rp.<?= $brg['harga_promo'] ?></p>
            </div>
            <!--  -->
        </div>
        <!-- Kanan -->
        <div class="right ms-3 tet">
            <div class="nama-barang mb-4">
                <h1 class="namabrg"><?= $brg['nama'] ?></h1>
            </div>
            <!--  -->
            <div class="deskripsi-barang">
                <h6>Deskripsi :</h6>
                <p class="text">
                    <?= $brg['deskripsi'] ?>
                </p>
            </div>
            <!--  -->
            <div class="fungsi d-flex flex-column"">
                <h6 class=" me-2">Kegunaan :</h6>
                <p class="text">
                    <?= $brg['kegunaan'] ?>
                </p>
            </div>
            <!--  -->
            <div class="komposisi d-flex flex-column"">
                <h6 class=" me-2">Komposisi :</h6>
                <p class="text"><?= $brg['komposisi'] ?></p>
            </div>
            <!--  -->
            <div class="warning d-flex flex-column"">
                <h6 class=" me-2">Perhatian :</h6>
                <p class="text">
                    <?= $brg['perhatian'] ?>
                </p>
            </div>
            <!--  -->
            <div class="produksi d-flex flex-column">
                <h6 class="me-2">Diproduksi oleh :</h6>
                <p class="text"><?= $brg['diproduksi'] ?></p>
            </div>
        </div>
    </div>

    <!-- Boostrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- Font awesome script -->
    <script src="https://kit.fontawesome.com/59f11d8874.js" crossorigin="anonymous"></script>
</body>

</html>