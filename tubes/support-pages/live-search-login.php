<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../login-page/login-user.php");
    exit;
}

require '../php/function.php';

// Mendapatkan nilai keyword dari input pencarian
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

// Query tampil barang
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

    // Jika hasil pencarian kosong
    if (count($barang) == 0) {
        $pesan = '"Ooops, Barang yang anda cari tidak tersedia untuk sekarang"';
    }
} else if (empty($keyword)) {
    $barang = query("SELECT * FROM barang");
}

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <!-- Default CSS -->
    <link rel="stylesheet" href="../css/support-pages/kategori/kategori.css" />
    <link rel="stylesheet" href="../css/responsive-style/index-responsive.css" />
    <link rel="icon" href="../assets/img/logo-halodek/halodek-logo.png" />
    <title>searching-halodek</title>

    <style>
    .pesan {
        margin-top: 150px !important;
        margin-bottom: 200px !important;
        font-size: 25px;
        font-family: monospace;
    }

    .search-input {
        box-shadow: 0 0 2px black;
    }

    .search-btn {
        box-shadow: 0 0 2px black;
    }

    @media screen and (max-width: 500px) {
        .search-phone {
            display: flex !important;
            width: 90%;
            margin: auto;
            margin-top: 20px !important;
        }

        .pesan {
            font-size: 17px;
        }

        .nama-kategori h5 {
            font-size: 15px !important;
        }

        .d {
            display: none !important;
        }
    }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="head d-flex bg-primary justify-content-between">
        <p class="brand mt-2 ms-4 ">
            <a class="text-decoration-none text-light" href="../login-page/index-login.php"><i
                    class="fa-solid fa-user-doctor text-light me-1"></i><span class="d">Halodek</span></a>
        </p>
        <form class="w-75 m-auto d-flex " method="get" class="search d-flex ms-auto my-4" role="search">
            <input name="keyword" class="search-input form-control me-2 rounded-pill" type="search" placeholder="Search"
                aria-label="Search" value="<?php echo $keyword; ?>" autofocus />
            <button name="Cari di Halodek" class="search-btn btn btn-light rounded-pill d-none" type="submit">
                <i class="fa fa-search text-dark" aria-hidden="true"></i>
            </button>
        </form>
    </div>

    <div class="nama-kategori">
        <h5>Filter berdasarkan "<span id="keyword-placeholder" class="text-primary"><?php echo $keyword; ?></span>"</h5>
    </div>

    <form action="" method="post">
        <div id="search-results"></div>
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

    // Ambil elemen input pencarian
    const searchInput = document.querySelector('input[name="keyword"]');
    const keywordPlaceholder = document.getElementById("keyword-placeholder");

    // Tambahkan event listener untuk input pencarian
    searchInput.addEventListener("input", function() {
        // Ambil nilai input pencarian
        const keyword = this.value;

        // Perbarui teks pada elemen nama kategori
        keywordPlaceholder.textContent = keyword;

        // Buat request AJAX ke server untuk mendapatkan hasil pencarian
        const xhr = new XMLHttpRequest();
        xhr.open("GET", `search-login.php?keyword=${encodeURIComponent(keyword)}`, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Tangkap hasil pencarian dari server
                const searchResults = xhr.responseText;

                // Tampilkan hasil pencarian di elemen search-results
                const searchResultsContainer = document.getElementById("search-results");
                searchResultsContainer.innerHTML = searchResults;
            }
        };
        xhr.send();
    });
    </script>
    <!-- Bootstrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- Font awesome script -->
    <script src="https://kit.fontawesome.com/59f11d8874.js" crossorigin="anonymous"></script>

</body>

</html>