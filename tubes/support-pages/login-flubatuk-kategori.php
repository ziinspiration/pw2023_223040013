<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../login-page/login-user.php");
    exit;
}
// Melakukan query
require '../php/function.php';
$kategori = "flubatuk"; // Mengganti $_GET["kategori"] dengan "promo"
$barang = query("SELECT * FROM barang WHERE kategori = '$kategori'");

// Set Judul Halaman
$title = 'flubatuk-kategori';

$conn = koneksi();

// Mendapatkan user_id dari session
$user_id = $_SESSION["user_id"];

// Proses tambah ke keranjang saat tombol add_to_cart diklik
if (isset($_POST['add_to_cart'])) {
    $barang_id = $_POST['add_to_cart'];

    // Query untuk mengecek apakah barang sudah ada di keranjang user
    $queryCheck = "SELECT * FROM keranjang_belanja WHERE user_id = $user_id AND barang_id = $barang_id AND isvisible = '1'";
    $resultCheck = mysqli_query($conn, $queryCheck);

    // Jika barang belum ada di keranjang, tambahkan ke keranjang dengan jumlah 1
    if (mysqli_num_rows($resultCheck) == 0) {
        $queryInsert = "INSERT INTO keranjang_belanja (isvisible, user_id, barang_id, jumlah) VALUES ('1', $user_id, $barang_id, 1)";
        mysqli_query($conn, $queryInsert);
    } else {
        // Jika barang sudah ada di keranjang, periksa jumlah barang sebelum ditambah
        $row = mysqli_fetch_assoc($resultCheck);
        $jumlah = $row['jumlah'];
        if ($jumlah === null) {
            $jumlah = 0;
        }

        $keranjangId = $row['id'];
        // Jika jumlah barang kurang dari 1, tambahkan 1 ke jumlah
        if ($jumlah < 1) {
            $queryUpdate = "UPDATE keranjang_belanja SET jumlah = jumlah +1 WHERE keranjang_belanja.id = $keranjangId";
            mysqli_query($conn, $queryUpdate);
        }
    }
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
        <h5>Filter berdasarkan "Flu & Batuk"</h5>
    </div>


    <form action="" method="post">
        <div class="promo-card mb-5" style="overflow-x: auto !important;">
            <!-- Card -->
            <?php foreach ($barang as $brg) : ?>
                <a class="text-decoration-none text-dark" href="../support-pages/detail-item-login.php?id=<?= $brg["id"] ?>">
                    <div class="card card-promo border border-2 border-primary rounded-5 ms-2 me-2" style="width: 18rem">
                        <img class="img-card-promo" src="../assets/img/<?= $brg['gambar'] ?>" class="card-img-top" alt="..." />
                        <!-- body card -->
                        <div class="card-body">
                            <!-- nama barang -->
                            <p class="card-title mb-5 text-center">
                                <?= $brg['nama'] ?>
                            </p>
                            <!-- harga barang -->
                            <div class="card-text mt-4">
                                <p class="price-item text-danger text-decoration-line-through">
                                    <?= $brg['harga_normal'] ?>
                                </p>
                                <p class="price-promo text-primary"><?= $brg['harga_promo'] ?></p>
                            </div>
                            <!-- button -->
                            <div class="button-card">
                                <a class="btn btn-primary me-1" href="#"><i class="fa-solid fa-user-doctor"></i></a>
                                <button onclick="addToCart(<?= $brg['id'] ?>)" type="submit" name="add_to_cart" value="<?= $brg["id"] ?>" class="btn cart-shop btn-primary"><i class="fa-solid fa-cart-shopping"></i></button>
                            </div>
                            <!-- body card end -->
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
            <!-- Card end -->
        </div>
    </form>

    <!-- Name brand -->
    <div class="name-brand-bottom text-center">
        <p>
            <span>Developed by : </span>
            <i class="fa-solid fa-user-doctor text-primary me-1"></i>Halodek
        </p>
    </div>

    <script>
        function addToCart(id) {
            // Buat objek XMLHTTPRequest
            var xhr = new XMLHttpRequest();

            // Tentukan metode, URL, dan keterangan asinkron
            xhr.open("POST", "add-to-cart.php", true);

            // Set header permintaan
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            // Kirim permintaan dengan data barang_id
            xhr.send("barang_id=" + id);

            // Tangani hasil respon
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Sukses, lakukan tindakan yang diinginkan (misalnya, tampilkan notifikasi atau perbarui tampilan)
                        alert("Barang telah ditambahkan ke keranjang!");
                    } else {
                        // Gagal, tangani kesalahan jika diperlukan
                        alert("Gagal menambahkan barang ke keranjang!");
                    }
                }
            };
        }
    </script>
    <!-- Boostrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- Font awesome script -->
    <script src="https://kit.fontawesome.com/59f11d8874.js" crossorigin="anonymous"></script>
</body>

</html>