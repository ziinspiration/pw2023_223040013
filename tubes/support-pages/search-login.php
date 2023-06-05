<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../login-page/login-user.php");
    exit;
}

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
}

// Mendapatkan user_id dari session
$user_id = $_SESSION["user_id"];

?>

<div class="promo-card mb-5">
    <!-- Card -->
    <?php foreach ($barang as $brg) : ?>
    <a class="text-decoration-none text-dark" href="detail-item-login.php?id=<?= $brg["id"] ?>">
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
                    <a class="btn btn-primary me-1" href="#"><i class="fa-solid fa-user-doctor"></i></a>
                    <button onclick="addToCart(<?= $brg['id'] ?>)" type="submit" name="add_to_cart"
                        value="<?= $brg["id"] ?>" class="btn cart-shop btn-primary"><i
                            class="fa-solid fa-cart-shopping"></i></button>
                </div>
                <!-- body card end -->
            </div>
        </div>
    </a>
    <?php endforeach; ?>
    <!-- Card end -->
</div>