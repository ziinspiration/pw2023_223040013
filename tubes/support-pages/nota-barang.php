<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../login-page/login-user.php");
    exit;
}

require '../php/function.php';

$conn = koneksi();

$id = $_GET["id"];
$brg = query("SELECT p.*, b.*, u.*, kb.*, p.id as id_pembayaran
              FROM pembayaran p
              JOIN barang b ON p.barang_id = b.id
              JOIN user u ON p.user_id = u.user_id
              JOIN keranjang_belanja kb ON p.keranjang_id = kb.id
              WHERE p.id = $id")[0];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="icon" href="../assets/img/logo-halodek/halodek-logo.png" />
    <title>download-nota</title>
    <style>
    .bold {
        font-weight: 500 !important;
        margin-top: -15px !important;
    }

    .fs {
        font-size: 35px !important;
    }

    @media print {
        .no-print {
            display: none !important;
        }

        .btn-danger {
            display: none !important;
        }

        .container-fluid {
            margin-top: 200px !important;
        }
    }

    @media screen and (max-width:600px) {
        .no-print {
            margin-left: 10px !important;
            margin-top: 10px !important;
        }

        .btn-danger {
            margin-left: 0px !important;
            margin-top: 90px !important;
        }

    }
    </style>
</head>

<body>
    <a class=" mt-5 ms-5  text-primary fs no-print" href="pesanan-saya.php"><i class="fa-solid fa-arrow-left"></i></a>

    <button class="btn btn-danger mt-5 ms-5" onclick="window.print()"><i class="fa-solid fa-file-pdf"></i>
        Download</button>


    <div class="container-fluid mb-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4>Nota Pembelian
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_pembeli">Nama Pembeli</label>
                            <input type="text" class="form-control" id="_pembeli" value="<?= $brg['nama_lengkap']; ?>"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="no_pesanan">No Pesanan</label>
                            <input type="text" class="form-control" id="no_pesanan"
                                value="<?= $brg['id_pembayaran']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_bayar">Tanggal pembayaran</label>
                            <input type="date" class="form-control" id="tanggal_bayar"
                                value="<?= $brg['tanggal_bayar']; ?>" readonly>
                        </div>
                        <div class="form-group ">
                            <label for="nama">Nama Produk</label>
                            <input type="text" class="form-control" id="nama" value="<?= $brg['nama']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" value="<?= $brg['jumlah']; ?>"
                                readonly>
                        </div>
                        <div class="form-group ">
                            <label for="harga">Harga</label>
                            <input type="number" class="form-control" id="harga" value="<?= $brg['harga_promo']; ?>"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" class="form-control" id="status" value="<?= $brg['status']; ?>" readonly>
                        </div>
                    </div>
                    <div class="card-footer">
                        <h5>Total: Rp <?= $brg['jumlah_harga']; ?></h5>
                        <div class="name-brand text-center mt-5">
                            <p>Hormat kami,</p>
                            <p class="bold">
                                <i class="fa-solid fa-user-doctor text-primary me-2"></i>Halodek
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Boostrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- Font awesome script -->
    <script src="https://kit.fontawesome.com/59f11d8874.js" crossorigin="anonymous"></script>
</body>

</html>