<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../login-page/login-user.php");
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
    <link rel="stylesheet" href="../css/login-style/login-phone/after-login-phone.css" />
    <link rel="icon" href="../assets/img/logo-halodek/halodek-logo.png" />
    <title>my-account-halodek</title>
</head>

<body>
    <!-- HEADER & NAVBAR PAGE -->
    <div class="header-navbar-dekstop fixed-top">
        <nav class="navbar navbar-light bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand ms-3"><i class="fa-solid fa-user-doctor text-light me-2"></i> HaloDek</a>
            </div>
        </nav>
    </div>
    <!-- HEADER & NAVBAR END -->

    <div class="container mt-5">
        <div class="profile-set">
            <a href="../support-pages/profile-setting.php" class="text-decoration-none">
                <div class="login d-flex bg-light mt-5 pt-3 pb-3 ps-4">
                    <div class="text">
                        <h1>
                            <i class="fa-solid fa-user border-primary line-bord"></i>
                            <span class="text-span">Pengaturan profile</span>
                        </h1>
                    </div>
                </div>
            </a>
        </div>
        <!--  -->
        <div class="pesanan-anda">
            <a href="../support-pages/pesanan-saya.php" class="text-decoration-none">
                <div class="login d-flex bg-light mt-5 pt-3 pb-3 ps-4">
                    <div class="text">
                        <h1>
                            <i class="fa-solid fa-truck-fast border-primary line-bord"></i>
                            <span class="text-span">Pesanan anda</span>
                        </h1>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="name-brand-bottom text-center mt-4">
        <p>
            <span>Developed by : </span>
            <i class="fa-solid fa-user-doctor text-primary me-1"></i>Halodek
        </p>
    </div>

    <!-- NAVIGASI FOR PHONE -->
    <nav class="nav-phone fixed-bottom d-flex justify-content-around text-primary bg-light m-auto pt-3">
        <!-- Home -->
        <div class="nav-home text-center">
            <a href="../login-page/index-login.php" class="text-decoration-none">
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
            <a href="#" class="text-decoration-none">
                <i class="fa-regular fa-user"></i>
                <p style="font-size: 15px">Akun Saya</p>
            </a>
        </div>
    </nav>
    <!-- NAVIGASI FOR PHONE END -->

    <!-- Boostrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- Font awesome script -->
    <script src="https://kit.fontawesome.com/59f11d8874.js" crossorigin="anonymous"></script>
</body>

</html>