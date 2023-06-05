<?php
session_start();

if (!isset($_SESSION["login"]) || $_SESSION["role"] !== "admind") {
    header("location: admind-login.php");
    exit;
}


require '../php/function.php';
$conn = koneksi();
// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
    // cek apakah data berhasil di tambahkan atau tidak
    if (tambah($_POST) > 0) {
        echo "
            <script> 
            alert('Data berhasil ditambahkan!');
                document.location.href = 'tambah-barang.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal ditambahkan!');
                document.location.href = 'tambah-barang.php';
            </script>
        ";
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
    <link rel="stylesheet" href="css/admind/dashboard-pages/tambah-barang.css" />
    <link rel="icon" href="../assets/img/logo-halodek/halodek-logo.png" />
    <title>tambah-barang-halodek</title>
</head>

<body>
    <!-- Back arrow -->
    <div class="head d-flex bg-primary justify-content-between">
        <a class="ms-3 mt-2" href="dashboard-admind.php"><i class="fa-solid fa-arrow-left"></i></a>
        <p class="brand mt-2 me-3">
            <i class="fa-solid fa-user-doctor text-light me-1"></i>Halodek
        </p>
    </div>

    <h1 class="text-center mt-5 text-decoration-underline">
        FORM TAMBAH BARANG
    </h1>

    <form action="" method="post" enctype="multipart/form-data" class="d-flex flex-column mb-5">
        <div class="mb-3 data-input">
            <label for="nama" class="form-label">Nama barang</label>
            <input name="nama" type="text" class="form-control" id="nama" aria-describedby="emailHelp" />
        </div>
        <!--  -->
        <div class="mb-3 data-input">
            <label for="kode" class="form-label">Kode barang</label>
            <input name="kode" type="text" class="form-control" id="kode" aria-describedby="emailHelp" />
        </div>
        <!--  -->
        <div class="mb-3 data-input">
            <label for="gambar" class="form-label">Foto barang</label>
            <input name="gambar" type="file" class="form-control" aria-describedby="emailHelp" />
        </div>
        <!--  -->
        <div class="mb-3 data-input">
            <label for="kategori" class="form-label">kategori</label>
            <select name="kategori" id="kategori" class="form-select form-control" aria-label="Default select example">
                <option selected>Pilih jenis kategori</option>
                <option value="promo">Promo</option>
                <option value="flubatuk">Flu & Batuk</option>
                <option value="asmapernapasan">Asma & Pernapasan</option>
                <option value="p3k">P3K</option>
                <option value="alatkesehatan">Alat kesehatan</option>
            </select>
        </div>
        <!--  -->
        <div class="mb-3 data-input">
            <label for="harga_normal" class="form-label">Harga normal</label>
            <input name="harga_normal" type="text" class="form-control" id="harga_normal" aria-describedby="emailHelp" />
        </div>
        <!--  -->
        <div class="mb-3 data-input">
            <label for="harga_promo" class="form-label">Harga promo</label>
            <input name="harga_promo" type="text" class="form-control" id="harga_promo" aria-describedby="emailHelp" />
        </div>
        <!--  -->
        <div class="mb-3 data-input">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <input name="deskripsi" type="text" class="form-control" id="deskripsi" aria-describedby="emailHelp" />
        </div>
        <!--  -->
        <div class="mb-3 data-input">
            <label for="kegunaan" class="form-label">Kegunaan</label>
            <input name="kegunaan" type="text" class="form-control" id="kegunaan" aria-describedby="emailHelp" />
        </div>
        <!--  -->
        <div class="mb-3 data-input">
            <label for="komposisi" class="form-label">Komposisi</label>
            <input name="komposisi" type="text" class="form-control" id="komposisi" aria-describedby="emailHelp" />
        </div>
        <!--  -->
        <div class="mb-3 data-input">
            <label for="perhatian" class="form-label">Perhatian</label>
            <input name="perhatian" type="text" class="form-control" id="perhatian" aria-describedby="emailHelp" />
        </div>
        <!--  -->
        <div class="mb-3 data-input">
            <label for="diproduksi" class="form-label">Diproduksi oleh</label>
            <input name="diproduksi" type="text" class="form-control" id="diproduksi" aria-describedby="emailHelp" />
        </div>
        <!--  -->
        <button type="submit" name="submit" onclick="" class="btn btn-primary">Kirim</button>
    </form>



    <script></script>
    <!-- Boostrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- Font awesome script -->
    <script src="https://kit.fontawesome.com/59f11d8874.js" crossorigin="anonymous"></script>
</body>

</html>