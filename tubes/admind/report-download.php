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

$i = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
</head>

<style>
    @media print {
        .no-print {
            display: none;
        }

        .btn-danger {
            display: none !important;
        }
    }
</style>

<body>
    <div class="name-brand text-center fw-bolder mt-5">
        <p>
            <span>Report by : </span>
            <i class="fa-solid fa-user-doctor text-primary me-1"></i>Halodek
        </p>
    </div>

    <button class="btn btn-danger ms-5 mt-5" onclick="window.print()"><i class="fa-solid fa-file-pdf"></i>
        Download</button>

    <div class="container mt-5">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Kode Barang</th>
                    <th>Harga Normal</th>
                    <th>Harga Promo</th>
                    <th>Kategori</th>
                    <th>Diproduksi oleh</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($barang as $brg) : ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $brg['nama'] ?></td>
                        <td><?= $brg['kode'] ?></td>
                        <td>Rp.<?= $brg['harga_normal'] ?></td>
                        <td>Rp.<?= $brg['harga_promo'] ?></td>
                        <td><?= $brg['kategori'] ?></td>
                        <td><?= $brg['diproduksi'] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

    </div>

    <!-- Boostrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- Font awesome script -->
    <script src="https://kit.fontawesome.com/59f11d8874.js" crossorigin="anonymous"></script>
</body>

</html>