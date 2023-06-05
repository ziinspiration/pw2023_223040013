<?php
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
            <a class="text-decoration-none text-light" href="../index.php"><i
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

    <div id="search-results"></div>

    <!-- Name brand -->
    <div class="name-brand-bottom text-center">
        <p>
            <span>Developed by : </span>
            <i class="fa-solid fa-user-doctor text-primary me-1"></i>Halodek
        </p>
    </div>

    <script>
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
        xhr.open("GET", `search.php?keyword=${encodeURIComponent(keyword)}`, true);
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