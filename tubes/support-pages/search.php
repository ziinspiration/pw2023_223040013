<?php
require '../php/function.php';

if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $barang = query("SELECT * FROM barang WHERE
                  nama LIKE '%$keyword%' OR
                  kategori LIKE '%$keyword%' OR
                  harga_normal LIKE '%$keyword%' OR
                  kode LIKE '%$keyword%' OR
                  diproduksi LIKE '%$keyword%' ");

    // Jika hasil pencarian kosong
    if (count($barang) == 0) {
        echo '<p class="pesan text-center">"Ooops, Barang yang anda cari tidak tersedia untuk sekarang"</p>';
    }
} ?>

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
                    <a href="../login-page/login-user.php" class="btn btn-primary"><i
                            class="fa-solid fa-cart-shopping"></i></a>
                </div>
                <!-- body card end -->
            </div>
        </div>
    </a>
    <?php endforeach; ?>
    <!-- Card end -->
</div>