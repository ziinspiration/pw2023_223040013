<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <!-- Default CSS -->
    <link rel="stylesheet" href="../css/service-style/after-login-service.css" />
    <link rel="icon" href="../assets/img/logo-halodek/halodek-logo.png" />
    <title>service-halodek</title>
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

    <div class="container d-flex flex-column mt-5">
        <a href="#" class="text-decoration-none">
            <div class="card-service d-flex bg-light mt-5 pt-3 pb-3 ps-4">
                <div class="text">
                    <h1 class="text-card">
                        <i class="icon-call fa-solid fa-phone-volume me-3 border-primary"></i>Call center
                        <span class="call-center-num">( 1200-822-25 ) </span>
                    </h1>
                </div>
            </div>
        </a>
        <!--  -->
        <a href="#" class="text-decoration-none">
            <div class="card-service d-flex bg-light mt-3 pt-3 pb-3 ps-4">
                <div class="text">
                    <h1 class="text-card">
                        <i class="icon-mail fa-solid fa-envelope me-3 border-primary"></i>Email :
                        <span class="email-service">halodekservice@gmail.com</span>
                    </h1>
                </div>
            </div>
        </a>
        <!--  -->
        <div class="card-service d-flex bg-light mt-3 pt-3 pb-2 ps-4">
            <div class="text">
                <h1 class="text-card d-flex align-items-center">
                    <i class="icon-wa fa-brands fa-whatsapp fw-bold text-success me-3 border-primary"></i>
                    <p class="wa-desc d-flex flex-column text-decoration-none">
                        0877-2573-9961
                        <a href="#" class="go-wa text-decoration-none text-primary">Click for go whatsapp</a>
                    </p>
                </h1>
            </div>
        </div>
    </div>

    <!-- NAVIGASI FOR PHONE -->
    <nav class="nav-phone fixed-bottom d-flex justify-content-around text-primary bg-light m-auto pt-3">
        <!-- Home -->
        <div class="nav-home text-center">
            <a href="../index.php" class="text-decoration-none">
                <i class="fa-solid fa-user-doctor"></i>
                <p style="font-size: 15px">Beranda</p>
            </a>
        </div>
        <!-- Service -->
        <div class="nav-service text-center">
            <a href="#" class="text-decoration-none">
                <i class="fa-solid fa-headset"></i>
                <p style="font-size: 15px">Layanan Kami</p>
            </a>
        </div>
        <!-- Account -->
        <div class="nav-account text-center">
            <a href="../login-phone/before-login-phone.php" class="text-decoration-none">
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