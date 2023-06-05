<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: admind-login.php");
    exit;
}

require '../php/function.php';
// koneksi ke dbms
$conn = koneksi();

// ambil data di url
$id = $_GET["id"];

// query data barang berdasarkan id
$barang = query("SELECT * FROM barang WHERE id = $id")[0];

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

    // ambil data dari form
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $kategori = $_POST["kategori"];
    $harga_normal = $_POST["harga_normal"];
    $harga_promo = $_POST["harga_promo"];
    $kode = $_POST["kode"];
    $diproduksi = $_POST["diproduksi"];
    $perhatian = $_POST["perhatian"];
    $deskripsi = $_POST["deskripsi"];
    $kegunaan = $_POST["kegunaan"];

    // periksa apakah ada file gambar yang diunggah
    if ($_FILES["gambar"]["error"] === 4) {
        // jika tidak ada gambar yang diunggah, gunakan gambar yang sudah ada
        $gambar = $barang["gambar"];
    } else {
        // jika ada gambar yang diunggah, upload gambar baru
        $gambar = uploadImage();
        if (!$gambar) {
            // jika upload gambar gagal, tampilkan pesan error
            echo "
                <script>
                    alert('Upload gambar gagal!');
                    document.location.href = 'ubah.php';
                </script>
            ";
            exit;
        }
    }

    // query update data barang
    $query = "UPDATE barang SET
                nama = '$nama',
                kategori = '$kategori',
                harga_normal = '$harga_normal',
                harga_promo = '$harga_promo',
                kode = '$kode',
                diproduksi = '$diproduksi',
                deskripsi = '$deskripsi',
                perhatian = '$perhatian',
                kegunaan = '$kegunaan',
                gambar = '$gambar'
              WHERE id = $id";

    // cek apakah data berhasil diubah atau tidak
    if (mysqli_query($conn, $query)) {
        echo "
           <script> 
            alert('Data berhasil diubah!');
            document.location.href = '../admind/daftar-barang.php';
           </script>
        ";
    } else {
        echo "
           <script>
            alert('Data gagal diubah!');
            document.location.href = 'ubah.php';
           </script>
        ";
    }
}

// Fungsi untuk upload gambar
function uploadImage()
{
    $namaFile = $_FILES["gambar"]["name"];
    $ukuranFile = $_FILES["gambar"]["size"];
    $error = $_FILES["gambar"]["error"];
    $tmpName = $_FILES["gambar"]["tmp_name"];

    // cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo "
            <script>
                alert('Pilih gambar terlebih dahulu!');
                document.location.href = 'ubah.php';
            </script>
        ";
        exit;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "
            <script>
                alert('Format gambar tidak valid! Hanya menerima format JPG, JPEG, dan PNG.');
                document.location.href = 'ubah.php';
            </script>
        ";
        exit;
    }

    // cek jika ukuran file terlalu besar (maksimal 2MB)
    if ($ukuranFile > 2097152) {
        echo "
            <script>
                alert('Ukuran gambar terlalu besar! Maksimal 2MB.');
                document.location.href = 'ubah.php';
            </script>
        ";
        exit;
    }

    // generate nama baru untuk gambar
    $namaFileBaru = uniqid() . '.' . $ekstensiGambar;

    // pindahkan gambar ke folder yang ditentukan
    move_uploaded_file($tmpName, '../assets/img/' . $namaFileBaru);

    return $namaFileBaru;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="../assets/img/logo-halodek/halodek-logo.png" />
    <title>Form Ubah</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
    <style>
        .form {
            border-radius: 15px !important;
            background-color: Gainsboro;
            width: 75% !important;
            box-shadow: 0 0 6px black !important;
        }

        label {
            font-weight: 600 !important;
        }

        @media screen and (max-width:900px) {
            .form {
                width: 100% !important;
                padding: 20px !important;
            }

            .img-preview {
                width: 100% !important;
            }
        }
    </style>
</head>

<body>
    <header class="bg-primary p-3">
        <h1 class="text-center text-light">FORM UBAH DATA</h1>
    </header>

    <div class="container mt-5 mb-3">
        <form class="form p-5 m-auto" action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $barang['id']; ?>" />

            <img class="img-preview w-25" src="../assets/img/<?= $barang["gambar"]; ?>" alt="Preview" id="preview" class="preview-image" />
            <div class="mb-3 mt-4">
                <label for="gambar" class="form-label">Gambar</label>
                <input type="file" onchange="previewImage(event)" class="form-control" id="gambar" name="gambar" />
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $barang['nama']; ?>" required />
            </div>

            <div class="mb-3">
                <label for="kode" class="form-label">Kode Barang</label>
                <input type="text" class="form-control" id="kode" name="kode" value="<?= $barang['kode']; ?>" required />
            </div>

            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <input type="text" class="form-control mb-1 w-25" id="kategoriInput" name="kategori" value="<?= $barang['kategori']; ?>" required />
                <select name="kategoriSelect" id="kategoriSelect" class="form-select form-control" aria-label="Default select example" onchange="changeKategori()">
                    <option selected disabled>Pilih jenis kategori</option>
                    <option value="promo">Promo</option>
                    <option value="flubatuk">Flu & Batuk</option>
                    <option value="asmapernapasan">Asma & Pernapasan</option>
                    <option value="p3k">P3K</option>
                    <option value="alatkesehatan">Alat kesehatan</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="harga_normal" class="form-label">Harga Normal</label>
                <input type="text" class="form-control" id="harga_normal" name="harga_normal" value="<?= $barang['harga_normal']; ?>" required />
            </div>

            <div class="mb-3">
                <label for="harga_promo" class="form-label">Harga Promo</label>
                <input type="text" class="form-control" id="harga_promo" name="harga_promo" value="<?= $barang['harga_promo']; ?>" required />
            </div>


            <div class="mb-3">
                <label for="perhatian" class="form-label">Perhatian Barang</label>
                <input type="text" class="form-control" id="perhatian" name="perhatian" value="<?= $barang['perhatian']; ?>" required />
            </div>

            <div class="mb-3">
                <label for="komposisi" class="form-label">Komposisi Barang</label>
                <input type="text" class="form-control" id="komposisi" name="komposisi" value="<?= $barang['komposisi']; ?>" required />
            </div>

            <div class="mb-3">
                <label for="kegunaan" class="form-label">Kegunaan Barang</label>
                <input type="text" class="form-control" id="kegunaan" name="kegunaan" value="<?= $barang['kegunaan']; ?>" required />
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi </label>
                <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?= $barang['deskripsi']; ?>" required />
            </div>

            <div class="mb-3">
                <label for="diproduksi" class="form-label">Diproduksi oleh</label>
                <input type="text" class="form-control" id="diproduksi" name="diproduksi" value="<?= $barang['diproduksi']; ?>" required />
            </div>

            <button type="submit" name="submit" class="btn btn-primary mt-3 mb-2"><i class="fa-solid fa-floppy-disk me-2"></i>Simpan</button>
        </form>
    </div>

    <!-- Name brand -->
    <div class="name-brand-bottom text-center mb-5">
        <p>
            <span>Developed by : </span>
            <i class="fa-solid fa-user-doctor text-primary me-1"></i>Halodek
        </p>
    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview');
                output.src = reader.result;
                output.style.display = 'block'; // Tampilkan gambar pratinjau
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        function changeKategori() {
            var select = document.getElementById("kategoriSelect");
            var input = document.getElementById("kategoriInput");
            var selectedValue = select.value;
            input.value = selectedValue;
        }
    </script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font awesome script -->
    <script src="https://kit.fontawesome.com/59f11d8874.js" crossorigin="anonymous"></script>
</body>

</html>