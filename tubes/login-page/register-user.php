<?php

require '../php/function.php';

if (isset($_POST["register"])) {

    if (registrasi($_POST) > 0) {
        echo "<script>
            alert('Berhasil ditambahkan');
            window.location = 'login-user.php';
          </script>";
    } else {
        echo mysqli_error($conn);
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
    <link rel="stylesheet" href="../css/login-style/register-login.css" />
    <link rel="icon" href="../assets/img/logo-halodek/halodek-logo.png" />
    <title>register-halodek</title>
</head>

<body>
    <form action="" method="post" class="login-card">
        <!-- Brand name -->
        <div class="name-brand text-center">
            <p>
                <i class="fa-solid fa-user-doctor text-primary me-1"></i>Halodek
            </p>
        </div>
        <!-- Username -->
        <div class="mb-3">
            <label for="username" class="form-label ms-3 user-label text-primary ps-1 pe-1">Username</label>
            <input type="text" name="username" class="form-control username-input border border-3 border-primary" id="username" placeholder="Masukkan Username" />
        </div>
        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label password-label ms-3 text-primary ps-1 pe-1">Password</label>
            <input type="password" name="password" class="form-control password-input border border-3 border-primary" id="password" placeholder="Masukkan Password" />
        </div>
        <!-- Repeat Password -->
        <div class="mb-3">
            <label for="password2" class="form-label password-label ms-3 text-primary ps-1 pe-1">Ulangi
                Password</label>
            <input type="text" name="password2" class="form-control password-input border border-3 border-primary" id="password2" placeholder="Masukkan Password" />
        </div>
        <!-- Nama -->
        <div class="mb-3">
            <label for="exampleFormControlInput1 nama_lengkap" class="form-label ms-3 user-label text-primary ps-1 pe-1">Nama
                Lengkap</label>
            <input name="nama_lengkap" type="text" class="form-control username-input border border-primary border-3" id="exampleFormControlInput1" placeholder="Masukkan nama lengkap" />
        </div>
        <!-- Email -->
        <div class="mb-3">
            <label for="exampleFormControlInput1 email" class="form-label ms-3 user-label text-primary ps-1 pe-1">Email</label>
            <input name="email" type="email" class="form-control username-input border border-primary border-3" id="exampleFormControlInput1" placeholder="Masukkan email" />
        </div>
        <!-- No Handphone -->
        <div class="mb-3">
            <label for="exampleFormControlInput1 no_handphone" class="form-label ms-3 user-label text-primary ps-1 pe-1">No
                HP</label>
            <input name="no_handphone" type="text" class="form-control username-input border border-primary border-3" id="exampleFormControlInput1" placeholder="Masukkan no handphone" />
        </div>
        <!-- Alamat  -->
        <div class="mb-3">
            <label for="exampleFormControlInput1 alamat_lengkap" class="form-label ms-3 user-label text-primary ps-1 pe-1">Alamat</label>
            <input name="alamat_lengkap" type="text" class="form-control username-input border border-primary border-3" id="exampleFormControlInput1" placeholder="Masukkan alamat" />
        </div>
        <!-- Button register -->
        <div class="button-login mb-3 mt-4">
            <button type="submit" name="register" class="btn btn-login btn-primary">
                Daftar
            </button>
        </div>
        <!-- To Register -->
        <div class="to-register text-center">
            <p>
                Sudah memiliki akun ?
                <a href="login-user.php" class="text-decoration-none">Login disini</a>
            </p>
        </div>
    </form>
    <!--  -->
    <div class="name-brand-bottom text-center">
        <p>
            <span>Developed by : </span>
            <i class="fa-solid fa-user-doctor text-primary me-1"></i>Halodek
        </p>
    </div>

    <!-- Sweetalert -->
    <script src="../js/dist/sweetalert2.all.min.js"></script>
    <!-- Boostrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- Font awesome script -->
    <script src="https://kit.fontawesome.com/59f11d8874.js" crossorigin="anonymous"></script>
</body>

</html>