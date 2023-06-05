<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../index.php");
    exit;
}

require '../php/function.php';

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


// Query tampil barang
$barang = query("SELECT * FROM barang");

// Ambil nama dari cookie
$username = $_COOKIE["username"];

// Search
if (isset($_GET['cari'])) {
    $keyword = $_GET['keyword'];
    $barang = query("SELECT * FROM barang WHERE
                  nama LIKE '%$keyword%' OR
                  kategori LIKE '%$keyword%' OR
                  harga_normal LIKE '%$keyword%' OR
                  kode LIKE '%$keyword%' OR
                  diproduksi LIKE '%$keyword%' ");
} else {
    $barang = query("SELECT * FROM barang");
}

date_default_timezone_set('Asia/Jakarta'); // Mengatur zona waktu sesuai kebutuhan

$jam = date('H'); // Mendapatkan jam saat ini (format 24 jam)

if ($jam >= 3 && $jam < 10) {
    $salam = 'Selamat pagi';
} elseif ($jam >= 10 && $jam < 15) {
    $salam = 'Selamat siang';
} elseif ($jam >= 15 && $jam < 18) {
    $salam = 'Selamat sore';
} else {
    $salam = 'Selamat malam';
}

if (isset($_GET['cari'])) {
    header("Location: ../support-pages/live-searching-login.php?keyword=" . $_GET['keyword']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <!-- Default CSS -->
    <link rel="stylesheet" href="../css/index-login.css" />
    <link rel="stylesheet" href="../css/responsive-style/index-responsive.css" />
    <!-- ICON LINK -->
    <link rel="icon" href="../assets/img/logo-halodek/halodek-logo.png" />
    <title>halodek</title>
    <style>
    @media screen and (max-width:900px) {
        h1.category-head {
            font-size: 25px !important;
            text-align: center !important;
            margin-left: 0 !important;
        }
    }

    @media screen and (max-width:600px) {
        h1.category-head {
            font-size: 13px !important;
            text-align: center !important;
            margin-left: 0 !important;
        }

        .footers {
            margin-bottom: 50px !important;
        }

        .copyright {
            font-size: 11px !important;
        }
    }

    @media screen and (max-width:400px) {
        h1.category-head {
            font-size: 12px !important;
            text-align: center !important;
            margin-left: 0 !important;
        }
    }
    </style>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fa-solid fa-user-doctor text-light"></i>
                HaloDek
            </a>
            <button class="navbar-toggler border" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span><i class="fa-solid fa-bars text-light"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <form action="../support-pages/live-search-login.php" method="get" class="search d-flex ms-auto my-4"
                    role="search">
                    <input name="keyword" class="search-input form-control me-2 rounded-pill" type="search"
                        placeholder="Cari di Halodek" aria-label="Search" />
                    <button name="cari" class="search-btn btn btn-light rounded-pill" type="submit">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </form>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link d-flex text-light cart-shop" href="../support-pages/cart-shop.php"><i
                                class="fa-solid fa-cart-shopping"></i>
                            <label class="name-icon">Keranjang Belanja</label>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex text-light profile-header"
                            href="../support-pages/profile-setting.php"><i class="fa-solid fa-user ms-4 icon-user"></i>
                            <label class="name-icon">Profile anda</label>
                        </a>
                    </li>
                    <li class="nav-item ms-4">
                        <a class="nav-link d-flex text-light cart-shop" href="../support-pages/pesanan-saya.php"><i
                                class="fa-solid fa-truck-fast"></i>
                            <label class="name-icon">Pesanan anda</label>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- NAVBAR END -->

    <!-- WELCOME & HOME PAGE -->
    <div style="background-image: url(../assets/img/hero-image.jpg)" class="welcome-page d-flex mt-5" id="beranda">
        <!-- Left content -->
        <div class="welcome-left-page mt-5 ms-4">
            <h1 class="welcome-head">Hii, Selamat Datang <?php echo $username; ?></h1>
            <p>Di <span class="fw-bold">HaloDek</span> , Kami siap melayani anda</p>
        </div>
        <!-- Right content -->
        <div class="welcome-right-page"></div>
    </div>
    <!-- WELCOME & HOME END -->

    <!-- CATEGORY CARD PAGE -->
    <div class="category-page mb-5">
        <header class="category-head ms-4 mt-5 mb-2 rounded-pill p-3">
            <h1>Cari Berdasarkan Kategori</h1>
        </header>
        <!-- Card -->
        <div class="card-category d-flex justify-content-around">
            <!-- card 1 -->

            <div class="category-1 text-center" style="width: 15%">
                <a href="../support-pages/login-promo-kategori.php">
                    <i class="fa-solid fa-tag bg-primary text-light p-3 rounded-pill" style="width: 50px"></i>
                    <p>PROMO</p>
                </a>
            </div>
            <!-- card 2 -->
            <div class="category-2 text-center" style="width: 15%">
                <a href="../support-pages/login-flubatuk-kategori.php">
                    <i class="fa-sharp fa-solid fa-head-side-cough bg-primary text-light p-3 rounded-pill"
                        style="width: 50px"></i>
                    <p>FLU & BATUK</p>
                </a>
            </div>
            <!-- card 3 -->
            <div class="category-3 text-center" style="width: 15%">
                <a href="../support-pages/login-asmapernapasan-kategori.php"><i
                        class="fa-sharp fa-solid fa-lungs-virus bg-primary text-light p-3 rounded-pill"
                        style="width: 50px"></i>
                    <p>ASMA & PERNAPASAN</p>
                </a>
            </div>
            <!-- card 4 -->
            <div class="category-4 text-center" style="width: 15%">
                <a href="../support-pages/login-p3k-kategori.php"><i
                        class="fa-solid fa-kit-medical bg-primary text-light p-3 rounded-pill" style="width: 50px"></i>
                    <p>P3K</p>
                </a>
            </div>
            <!-- card 5 -->

            <div class="category-5 text-center" style="width: 15%">
                <a href="../support-pages/login-alatkesehatan-kategori.php"><i
                        class="fa-solid fa-microscope bg-primary text-light p-3 rounded-pill" style="width: 50px"></i>
                    <p>ALAT KESEHATAN</p>
                </a>
            </div>
        </div>
    </div>
    <!-- CATEGORY CARD END -->

    <!-- CAROUSEL FIRST PAGE -->
    <!-- carousel -->
    <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner carousel-first border border-2 border-primary">
            <div class="carousel-item active">
                <img src="../assets/img/contoh2.jpg" class="d-block w-100" alt="..." />
            </div>
            <div class="carousel-item">
                <img src="../assets/img/contoh.jpg" class="d-block w-100" alt="..." />
            </div>
            <div class="carousel-item">
                <img src="../assets/img/contoh3.jpg" class="d-block w-100" alt="..." />
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- CAROUSEL FIRST END -->

    <!-- SAY -->
    <h1 class="category-head ms-5">
        Hii, <?php echo $salam ?>
        <span class="text-primary call-name">
            <?php echo $username; ?></span>..
        Selamat
        Berbelanja <i class="fa-regular fa-face-smile-wink ms-1"></i>
    </h1>
    <!-- SAY END -->

    <!--CARD PAGE -->
    <form action="" method="post">
        <div class="promo-card mb-5" style="overflow-x: auto !important;">
            <!-- Card -->
            <?php foreach ($barang as $brg) : ?>
            <a class="text-decoration-none text-dark"
                href="../support-pages/detail-item-login.php?id=<?= $brg["id"] ?>">
                <div class="card card-promo border border-2 border-primary rounded-5 ms-2 me-2" style="width: 18rem">
                    <img class="img-card-promo" src="../assets/img/<?= $brg['gambar'] ?>" class="card-img-top"
                        alt="..." />
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
    </form>
    <!-- CARD END -->

    <!-- ARTIKEL PAGE -->
    <div class="artikel-pages">
        <h2 class="text-center mb-4">Tips & trick sehat.</h2>
        <div class="artikel-container d-flex justify-content-around">
            <!-- artikel 1 -->
            <div class="artikel-left artikel">
                <div class="card" style="width: 18rem">
                    <img src="../assets/img/logo-halodek/halodek-logo.png" class="card-img-top" alt="..." />
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Coming soon</h5>
                        <p class="card-text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Aperiam, sed?
                        </p>
                        <a href="#" class="btn btn-primary">Selengkapnya..</a>
                    </div>
                </div>
            </div>
            <!-- artikel 2 -->
            <div class="artikel-center artikel">
                <div class="card" style="width: 18rem">
                    <img src="../assets/img/logo-halodek/halodek-logo.png" class="card-img-top" alt="..." />
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Coming soon</h5>
                        <p class="card-text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Aperiam, sed?
                        </p>
                        <a href="#" class="btn btn-primary">Selengkapnya..</a>
                    </div>
                </div>
            </div>
            <!-- artikel 3 -->
            <div class="artikel-right artikel">
                <div class="card" style="width: 18rem">
                    <img src="../assets/img/logo-halodek/halodek-logo.png" class="card-img-top" alt="..." />
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Coming soon</h5>
                        <p class="card-text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Aperiam, sed?
                        </p>
                        <a href="#" class="btn btn-primary">Selengkapnya..</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ARTIKEL PAGE END -->


    <!-- ABOUT PAGE -->
    <h1 class="images-text mb-5 text-center">Kenapa halodek ?</h1>
    <div class="images-index d-flex justify-content-around px-3">
        <div class="images-in">
            <img src="../assets/img/index-assets/asli.png" class="img-fluid bg-primary p-3" alt="..." />
            <p class="text-center fw-bold">Asli</p>
        </div>
        <div class="images-in">
            <img src="../assets/img/index-assets/cepat.png" class="img-fluid bg-primary p-3" alt="..." />
            <p class="text-center fw-bold">Cepat</p>
        </div>
        <div class="images-in">
            <img src="../assets/img/index-assets/komplit.png" class="img-fluid bg-primary p-3" alt="..." />
            <p class="text-center fw-bold">Komplit</p>
        </div>
    </div>
    <p class="about ms-4 me-4">
        <b class="text-primary">Halodek -</b> adalah sebuah website apotek yang
        menyediakan berbagai macam kebutuhan obat dan kesehatan secara online.
        Halodek didirikan dengan tujuan untuk mempermudah masyarakat dalam
        memenuhi kebutuhan obat-obatan dan kesehatan tanpa harus pergi ke apotek
        secara langsung. <br />Pada website Halodek, pengguna dapat menemukan
        berbagai macam obat dan produk kesehatan dari berbagai merek dan jenis.
        Hal ini memungkinkan pengguna untuk memilih produk yang sesuai dengan
        kebutuhan dan preferensi mereka. <br />
        Halodek juga menjamin keamanan dan kualitas produk yang ditawarkan. Semua
        produk yang dijual di Halodek telah terdaftar dan diakui oleh Badan
        Pengawas Obat dan Makanan (BPOM) sehingga pengguna dapat membeli produk
        dengan aman dan nyaman.
    </p>
    <!-- ABOUT PAGE END -->

    <!-- FOOTER -->
    <div class="footers bg-light text-center pt-5 pb-5">
        <div class="medsos-footers">
            <p>Ikuti kami di :</p>
            <div class="icon-medsos text-primary d-flex justify-content-center">
                <a href="#"><i class="fa-brands fa-facebook"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
            </div>
        </div>
        <!--  -->
        <div class="supported mt-5">
            <p>
                Supported by
                <a class="text-decoration-none text-dark" href="https://instagram.com/ziimpossible_?igshid=YmMyMTA2M2Y="
                    target="_blank">@ziinspiration</a>
            </p>
        </div>
        <!--  -->
        <div class="copyright mt-5">
            <i class="fa-regular fa-copyright"></i> 2022
            <a href="#" class="text-decoration-none"><i class="fa-solid fa-user-doctor text-primary ms-1"></i><span>
                    Halodek</span></a>
            - Apotek online paling komplit All Rights Reserved
        </div>
    </div>
    <!-- FOOTER END -->


    <!-- NAVIGASI FOR PHONE -->
    <nav class="nav-phone fixed-bottom d-flex justify-content-around text-primary bg-light m-auto pt-3">
        <!-- Home -->
        <div class="nav-home text-center">
            <a href="#beranda" class="text-decoration-none">
                <i class="fa-solid fa-user-doctor"></i>
                <p style="font-size: 15px">Beranda</p>
            </a>
        </div>
        <!-- Service -->
        <div class="nav-service text-center">
            <a href="../service-page/after-login-service.php" class="text-decoration-none">
                <i class="fa-solid fa-headset"></i>
                <p style="font-size: 15px">Layanan Kami</p>
            </a>
        </div>
        <!-- Account -->
        <div class="nav-account text-center">
            <a href="../login-phone/after-login-phone.php" class="text-decoration-none">
                <i class="fa-regular fa-user"></i>
                <p style="font-size: 15px">Akun Saya</p>
            </a>
        </div>
    </nav>
    <!-- NAVIGASI FOR PHONE END -->


    <script src="../js/dist/sweetalert2.all.min.js"></script>
    <script>
    function addToCart(id) {
        // Buat objek XMLHTTPRequest
        var xhr = new XMLHttpRequest();

        // Tentukan metode, URL, dan keterangan asinkron
        xhr.open("POST", "../support-pages/add-to-cart.php", true);

        // Set header permintaan
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Kirim permintaan dengan data barang_id
        xhr.send("barang_id=" + id);

        // Tangani hasil respon
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Sukses, tampilkan alert SweetAlert
                    alert("Berhasil menambahkan barang ke keranjang!");
                } else {
                    // Gagal, tangani kesalahan jika diperlukan
                    alert("Gagal menambahkan barang ke keranjang!");
                }
            }
        };
    }
    </script>
    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Boostrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- Font awesome script -->
    <script src="https://kit.fontawesome.com/59f11d8874.js" crossorigin="anonymous"></script>
</body>

</html>