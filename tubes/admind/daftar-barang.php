<?php
session_start();

if (!isset($_SESSION["login"]) || $_SESSION["role"] !== "admind") {
    header("location: admind-login.php");
    exit;
}


// Melakukan query
require '../php/function.php';

$barang = query("SELECT * FROM barang ");

// Search
if (isset($_GET['cari'])) {
    $keyword = $_GET['keyword'];
    $barang = query("SELECT * FROM barang WHERE
                  nama LIKE '%$keyword%' OR
                kategori LIkE '%$keyword%' OR
                harga_normal LIKE '%$keyword%' OR
                kode LIKE  '%$keyword%' OR
                diproduksi LIKE  '%$keyword%' ");
} else {
    $barang = query("SELECT * FROM barang");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <!-- Default CSS -->
    <link rel="stylesheet" href="css/admind/dashboard-pages/daftar-barang.css" />
    <link rel="icon" href="../assets/img/logo-halodek/halodek-logo.png" />
    <title>daftar-barang-halodek</title>
    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            background-color: rgb(240, 240, 240) !important;
            scroll-behavior: smooth;
        }

        /*  */

        .head {
            color: white;
            padding: 20px 5px;
        }

        .brand {
            font-weight: 500;
        }

        .name-brand {
            font-size: 20px;
            font-weight: 500;
            margin: 50px;
        }

        .name-brand span {
            font-size: 12px;
            font-weight: 600;
        }

        .head i {
            font-size: 30px;
            color: white;
        }

        .image img {
            width: 100%;
        }

        .container {
            box-shadow: 2px 2px 5px grey;
            border-radius: 10px !important;
        }

        .komposisi h6 {
            margin-top: 2px;
        }

        .warning h6 {
            margin-top: 2px;
        }

        .produksi h6 {
            margin-top: 2px;

        }

        .fungsi h6 {
            margin-top: 2px;
        }

        .nama-barang h1 {
            font-size: 45px !important;
            border-bottom: 3px solid #cacaca;
            padding-bottom: 10px;
        }

        .price-normal {
            font-size: 15px !important;
        }

        .price-promo {
            font-size: 25px;
            margin-top: -27px;
            font-weight: 550;
        }

        .ubah-hapus {
            font-size: 20px !important;
        }

        .fungsi {
            display: flex;
            flex-direction: column;
        }


        .warning {
            display: flex;
            flex-direction: column;
        }

        .produksi {
            display: flex;
            flex-direction: column;
        }

        .komposisi {
            display: flex;
            flex-direction: column;
        }

        @media screen and (max-width: 500px) {
            .container {
                flex-direction: column;
                transform: scale(0.8);
                margin-top: -30px !important;
            }

            .right {
                margin-top: 20px;
            }

            .w-50 {
                width: 90% !important;
            }
        }
    </style>
</head>

<body>
    <!-- Back arrow -->
    <div class="head d-flex bg-primary justify-content-between">
        <a class="ms-3 mt-2" href="dashboard-admind.php"><i class="fa-solid fa-arrow-left"></i></a>

        <p class="brand mt-2 me-3">
            <i class="fa-solid fa-user-doctor text-light me-1"></i>Halodek
        </p>
    </div>

    <div class="searching bg-primary pt-2 pb-2 mt-2">
        <form class="w-50 m-auto d-flex" action="" method="get" class="search d-flex ms-auto my-4" role="search">
            <input name="keyword" class="search-input form-control me-2 rounded-pill" type="search" placeholder="Cari di Halodek" aria-label="Search" />
            <button name="cari" class="search-btn btn btn-light rounded-pill" type="submit">
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
        </form>
    </div>

    <?php foreach ($barang as $brg) : ?>
        <?php $i = 1 ?>
        <div class="container d-flex p-3 mt-5 mb-5 rounded">
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
            <div class="right ms-3 tet ">
                <div class="nama-barang mb-4">
                    <h1><?= $brg['nama'] ?></h1>
                </div>
                <!--  -->
                <div class="kode-barang d-flex">
                    <h6 class="me-1">Kode barang :</h6>
                    <p>
                        <?= $brg['kode'] ?>
                    </p>
                </div>
                <div class="kategori-barang d-flex">
                    <h6 class="me-1">Kategori :</h6>
                    <p>
                        <?= $brg['kategori'] ?>
                    </p>
                </div>
                <div class="deskripsi-barang">
                    <h6>Deskripsi :</h6>
                    <p>
                        <?= $brg['deskripsi'] ?>
                    </p>
                </div>
                <!--  -->
                <div class="fungsi d-flex">
                    <h6 class="me-2">Kegunaan :</h6>
                    <p>
                        <?= $brg['kegunaan'] ?>
                    </p>
                </div>
                <!--  -->
                <div class="komposisi d-flex">
                    <h6 class="me-2">Komposisi :</h6>
                    <p><?= $brg['komposisi'] ?></p>
                </div>
                <!--  -->
                <div class="warning d-flex">
                    <h6 class="me-2">Perhatian :</h6>
                    <p>
                        <?= $brg['perhatian'] ?>
                    </p>
                </div>
                <!--  -->
                <div class="produksi d-flex">
                    <h6 class="me-2">Diproduksi oleh :</h6>
                    <p><?= $brg['diproduksi'] ?></p>
                </div>
                <div class="ubah-hapus d-flex mt-4">
                    <a class=" text-decoration-none me-3" href="../php/ubah.php?id=<?= $brg["id"]; ?>"><i class="fa-solid fa-pen-to-square me-1"></i>Ubah</a>
                    <b>|</b>
                    <a class="text-decoration-none ms-3 text-danger" href="../php/hapus.php?id=<?= $brg["id"]; ?>" onclick="return confirm('Hapus Data??')"><i class="fa-solid fa-trash-can me-1"></i>Hapus</a>
                </div>
            </div>
        </div>
        <?php $i++ ?>
    <?php endforeach ?>



    <!-- Name brand -->
    <div class="name-brand text-center">
        <p>
            <span>Developed by : </span>
            <i class="fa-solid fa-user-doctor text-primary me-1"></i>Halodek
        </p>
    </div>

    <div class="container">
        <div class="card-item">
            <div class="image"></div>
            <div class="deskripsi">
                <div class="nama-barang"></div>
                <div class="detail-barang"></div>
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