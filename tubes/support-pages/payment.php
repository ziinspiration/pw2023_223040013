<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../login-page/login-user.php");
    exit;
}

require '../php/function.php';

$conn = koneksi();

// Mendapatkan keranjang dari session
$user_id = $_SESSION["user_id"];
$id = $_GET["id"];
$brg = query("SELECT kb.*, b.*, u.*
              FROM keranjang_belanja kb
              JOIN barang b ON kb.barang_id = b.id
              JOIN user u ON kb.user_id = u.user_id
              WHERE kb.id = $id")[0];

$query = "SELECT * FROM user WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if (isset($_POST['bayar'])) {
    $namaRekening = $_POST['nama_rekening'];
    $nomorRekening = $_POST['nomor_rekening'];
    $tanggal = date('Y-m-d');
    $totalHarga = $_POST['jumlah_harga'];
    $idPembeli = $_POST['user_id'];
    $idBarang = $_POST['barang_id'];
    $id = $_POST['keranjang_id'];

    // Mengunggah berkas bukti transfer
    $buktiTransfer = $_FILES['bukti_transfer']['name'];
    $tempFile = $_FILES['bukti_transfer']['tmp_name'];
    $targetPath = "../admind/assets/bukti-tf"; // Ganti dengan direktori tujuan penyimpanan bukti transfer
    $targetFile = $targetPath . '/' . $buktiTransfer;

    if (move_uploaded_file($tempFile, $targetFile)) {
        // Berkas berhasil diunggah, lakukan proses pembayaran
        $query = "INSERT INTO pembayaran (nama_rekening, nomor_rekening, bukti_transfer, tanggal_bayar, jumlah_harga, keranjang_id, barang_id, user_id, status) VALUES ('$namaRekening', '$nomorRekening', '$buktiTransfer', '$tanggal', '$totalHarga','$id', '$idBarang', '$idPembeli', 'Belum di konfirmasi')";


        $result = mysqli_query($conn, $query);

        $queryUpdate = "UPDATE keranjang_belanja SET isvisible = '0' WHERE keranjang_belanja.id = ? ";
        $stmt = mysqli_prepare($conn, $queryUpdate);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        if ($result) {
            // Pembayaran berhasil
            echo "Pembayaran berhasil";
            header("Location: ../login-page/index-login.php");
        } else {
            // Pembayaran gagal
            echo "Pembayaran gagal";
        }
    } else {
        // Gagal mengunggah berkas
        echo "Gagal mengunggah bukti transfer";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" href="../assets/img/logo-halodek/halodek-logo.png" />
    <title>Form Pembayaran</title>
    <style>
        body {
            background-color: rgb(234, 234, 234);
        }

        .preview-image {
            max-width: 200px;
            max-height: 200px;
            margin-top: 20px;
            display: none;
            border: 1px solid grey;
            border-radius: 2px;
        }

        .bg {
            background-color: Gainsboro;
            box-shadow: 0 0 6px black;
            border-radius: 15px;
            margin-bottom: 70px !important;
        }

        .header-navbar-dekstop {
            top: 0 !important;
        }

        .navbar-brand {
            color: white !important;
            font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
                "Lucida Sans Unicode", Geneva, Verdana, sans-serif !important;
            font-size: 35px !important;
        }

        .name-brand {
            font-size: 20px;
            font-weight: 500;
            margin: 50px;
        }

        .name-brand span {
            font-size: 12px;
            font-weight: 600;
        }

        /* HEADER & NAVBAR END */
    </style>
</head>

<body>
    <?php
    $totalHarga = $brg['harga_promo'] * $brg['jumlah'];
    $idPesanan = $brg['id'];
    $idPembeli = $brg['user_id'];
    $idBarang = $brg['barang_id'];
    ?>

    <!-- HEADER & NAVBAR PAGE -->
    <div class="header-navbar-dekstop">
        <nav class="navbar navbar-light bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand ms-3"><i class="fa-solid fa-user-doctor text-light me-"></i> HaloDek</a>
            </div>
        </nav>
    </div>
    <!-- HEADER & NAVBAR END -->
    <div class="container">
        <h4 class="text-center mt-4 mb-5">Total pembayaran: <span class="text-primary">Rp
                <?= $totalHarga; ?>.000</span></h4>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form class="bg p-5" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama_rekening">Nama Rekening</label>
                        <input type="text" class="form-control" name="nama_rekening" id="nama_rekening" placeholder="Masukkan nama pemilik rekening" required>
                    </div>
                    <div class="form-group">
                        <label for="nomor_rekening">Nomor Rekening</label>
                        <input type="text" class="form-control" name="nomor_rekening" id="nomor_rekening" placeholder="Masukkan nomor rekening" required>
                    </div>
                    <div class="form-group">
                        <label for="bukti_transfer">Bukti Transfer</label>
                        <input type="file" class="form-control-file bg-light p-1 rounded" name="bukti_transfer" id="bukti_transfer" accept="image/*" onchange="previewImage(event)">
                        <img src="" alt="Preview" id="preview" class="preview-image">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control-file" name="jumlah_harga" id="jumlah_harga" value="<?= $totalHarga; ?>.000">
                        <input type="hidden" class="form-control-file" name="keranjang_id" id="keranjang_id" value="<?= $id; ?>">
                        <input type="hidden" class="form-control-file" name="barang_id" id="barang_id" value="<?= $idBarang; ?>">
                        <input type="hidden" class="form-control-file" name="user_id" id="user_id" value="<?= $idPembeli; ?>">
                    </div>
                    <div class="mt-5">
                        <button type="submit" name="bayar" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Font awesome script -->
    <script src="https://kit.fontawesome.com/59f11d8874.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
    </script>
</body>

</html>