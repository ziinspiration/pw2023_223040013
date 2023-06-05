<?php
// Melakukan query
require '../php/function.php';
$kategori = "asmapernapasan"; // Mengganti $_GET["kategori"] dengan "promo"
$barang = query("SELECT * FROM barang WHERE kategori = '$kategori'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <!-- Default CSS -->
    <link rel="stylesheet" href="../css/support-pages/kategori/kategori.css" />
    <link rel="stylesheet" href="../css/responsive-style/index-responsive.css" />
    <link rel="icon" href="../assets/img/logo-halodek/halodek-logo.png" />
    <title>kategori-halodek</title>
</head>

<body>
    <!-- Header -->
    <div class="head d-flex bg-primary justify-content-between">
        <p class="brand mt-2 ms-4 me-3">
            <i class="fa-solid fa-user-doctor text-light me-1"></i>Halodek
        </p>
    </div>

    <div class="nama-kategori">
        <h5>Filter berdasarkan "Asma & Pernapasan"</h5>
    </div>

    <div class="promo-card mb-5">
        <!-- Card -->
        <?php foreach ($barang as $brg) : ?>
            <a class="text-decoration-none text-dark" href="detail-item.php?id=<?= $brg["id"] ?>">
                <div class="card card-promo border border-2 border-primary rounded-5 ms-2 me-2" style="width: 18rem">
                    <img class="img-card-promo" src="../assets/img/<?= $brg["gambar"]; ?>" class="card-img-top" alt="..." />
                    <!-- body card -->
                    <div class="card-body">
                        <!-- nama barang -->
                        <p class="card-title mb-5 text-center">
                            <?= $brg['nama'] ?>
                        </p>
                        <!-- harga barang -->
                        <div class="card-text mt-4">
                            <p class="price-item text-danger text-decoration-line-through">
                                Rp.<?= $brg['harga_normal'] ?>
                            </p>
                            <p class="price-promo text-primary">Rp.<?= $brg['harga_promo'] ?></p>
                        </div>
                        <!-- button -->
                        <div class="button-card">
                            <a href="../login-page/login-user.php" class="btn btn-primary me-1">Beli</a>
                            <a href="../login-page/login-user.php" class="btn btn-primary"><i class="fa-solid fa-cart-shopping"></i></a>
                        </div>
                        <!-- body card end -->
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
        <!-- Card end -->
    </div>

    <!-- Name brand -->
    <div class="name-brand-bottom text-center">
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