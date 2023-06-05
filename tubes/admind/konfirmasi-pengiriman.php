<?php

session_start();

if (!isset($_SESSION["login"]) || $_SESSION["role"] !== "admind") {
    header("location: admind-login.php");
    exit;
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
    <title>konfirmasi-pengiriman-halodek</title>
</head>

<body>
    <!-- Back arrow -->
    <div class="head d-flex bg-primary justify-content-between">
        <a class="ms-3 mt-2" href="status-pengiriman.php"><i class="fa-solid fa-arrow-left"></i></a>
        <p class="brand mt-2 me-3">
            <i class="fa-solid fa-user-doctor text-light me-1"></i>Halodek
        </p>
    </div>

    <h1 class="text-center mt-5 text-decoration-underline">
        KONFIRMASI PENGIRIMAN
    </h1>

    <form action="" class="d-flex flex-column">
        <div class="mb-3 data-input">
            <label for="exampleInputEmail1" class="form-label">Nama penerima</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" />
        </div>
        <!--  -->
        <div class="mb-3 data-input">
            <label for="exampleInputEmail1" class="form-label">Alamat penerima</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" />
        </div>
        <!--  -->
        <div class="mb-3 data-input">
            <label for="exampleInputEmail1" class="form-label">Bukti pengiriman</label>
            <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" />
        </div>
        <!--  -->
        <div class="mb-3 data-input">
            <label for="exampleInputEmail1" class="form-label">Kurir pengiriman</label>
            <select class="form-select form-control" aria-label="Default select example">
                <option selected>Pilih jenis kategori</option>
                <option value="1">J&T</option>
                <option value="2">JNE</option>
                <option value="3">Sicepat</option>
                <option value="4">GoSend</option>
            </select>
        </div>
        <!--  -->
        <a href="rincian-pengiriman.php">
            <button class="btn btn-primary">Kirim</button>
        </a>
    </form>

    <!-- Name brand -->
    <div class="name-brand text-center">
        <p>
            <span>Developed by : </span>
            <i class="fa-solid fa-user-doctor text-primary me-1"></i>Halodek
        </p>
    </div>

    <!-- Boostrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- Font awesome script -->
    <script src="https://kit.fontawesome.com/59f11d8874.js" crossorigin="anonymous"></script>
</body>

</html>