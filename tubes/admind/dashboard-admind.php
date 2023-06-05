<?php
session_start();

if (!isset($_SESSION["login"]) || $_SESSION["role"] !== "admind") {
    header("location: admind-login.php");
    exit;
}

require '../php/function.php';

// Ambil nama dari cookie
$username = $_COOKIE["username"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <!-- Default CSS -->
    <link rel="stylesheet" href="css/admind/dashboard-admind.css" />
    <link rel="icon" href="../assets/img/logo-halodek/halodek-logo.png" />
    <title>dashboard-admind-halodek</title>
    <style>
        .bold {
            font-weight: 500;
        }
    </style>
</head>

<body>
    <!-- HEADER & NAVBAR PAGE -->
    <div class="header-navbar-dekstop">
        <nav class="navbar navbar-light bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand ms-3"><i class="fa-solid fa-user-doctor text-light me-"></i> HaloDek</a>
            </div>
        </nav>
    </div>
    <!-- HEADER & NAVBAR END -->

    <div class="btn-group ms-3 mt-3">
        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-user"></i> <?= $username; ?>
        </button>
        <ul class="dropdown-menu mt-2">
            <li><a class="dropdown-item bold" href="../login-page/index-login.php"><i class="fa-solid fa-user-doctor text-primary ms-1"></i> Go Web</a></a></li>
            <li><a class="dropdown-item bold" href="report-download.php"><i class="fa-solid fa-file-pdf text-danger ms-1"></i>
                    Report</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item bold" href="log-out.php"><i class="fa-solid fa-right-from-bracket text-danger ms-1"></i>
                    Logout</a></li>
        </ul>
    </div>

    <div class="container">
        <div class="top-pages mt-5 d-flex justify-content-around">
            <!--  -->
            <a class="w-25 nav-link disabled" href="admind-profile.php">
                <div class="admind-profile card border border-2 border-primary">
                    <i class="fa-solid fa-user"></i>
                    <p>Profile admin</p>
                </div>
            </a>
            <!--  -->
            <a class="w-25" href="daftar-barang.php">
                <div class="daftar-barang card border border-2 border-primary">
                    <i class="fa-solid fa-table"></i>
                    <p>Daftar barang</p>
                </div>
            </a>
            <!--  -->
            <a class="w-25" href="tambah-barang.php">
                <div class="tambah-barang card border border-2 border-primary">
                    <i class="fa-solid fa-plus"></i>
                    <p>Tambah barang</p>
                </div>
            </a>
        </div>
        <!--  -->
        <div class="bottom-pages mt-4 d-flex justify-content-around">
            <!--  -->
            <a class="w-50" href="verifikasi-pembayaran.php">
                <div class="verifikasi-pembayaran me-2 card border border-2 border-primary">
                    <i class="fa-solid fa-money-bill"></i>
                    <p>Verifikasi pembayaran</p>
                </div>
            </a>
            <!--  -->
            <a class="w-50" href="riwayat-pembayaran.php">
                <div class="status-pengiriman ms-2 card border border-2 border-primary">
                    <i class="fa-solid fa-truck-fast"></i>
                    <p>Riwayat transaksi</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Name brand -->
    <div class="name-brand text-center">
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