<?php
session_start();

if (isset($_SESSION["login"])) {
    header("location: index-login.php");
    exit;
}

require '../php/function.php';

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $conn = koneksi();

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    // CEK USERNAME
    if (mysqli_num_rows($result) === 1) {
        // CEK PASSWORD
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            // set session
            $_SESSION["login"] = true;
            $_SESSION["user_id"] = $row["user_id"];

            // set cookie
            setcookie("username", $username, time() + 3600);

            header("location: index-login.php");
            exit;
        }
    }

    $error = true;
}

date_default_timezone_set('Asia/Jakarta'); // Mengatur zona waktu sesuai kebutuhan

$jam = date('H'); // Mendapatkan jam saat ini (format 24 jam)

if ($jam >= 3 && $jam < 10) {
    $salam = 'Selamat pagi';
} elseif ($jam >= 10 && $jam < 15) {
    $salam = 'Selamat siang';
} elseif ($jam >= 15 && $jam < 18) {
    $salam = 'Selamat sore';
} else {
    $salam = 'Selamat malam';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity=" sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <!-- Default CSS -->
    <link rel="stylesheet" href="../css/login-style/login-user.css" />
    <link rel="icon" href="../assets/img/logo-halodek/halodek-logo.png" />
    <title>login-halodek</title>
</head>

<body>
    <form method="post" class="login-card">
        <!-- Brand name -->
        <div class="name-brand text-center">
            <p><a href="../admind/admind-login.php"><i class="fa-solid fa-user-doctor text-primary me-1"></i></a>Halodek
            </p>
        </div>
        <h5 class="sayhi text-center">Hii, <?php echo $salam; ?>.. selamat datang di halodek</h5>
        <!-- Error notif -->
        <?php if (isset($error)) : ?>
            <p class="text-danger text-center error">*Username atau Password yang anda masukkan salah</p>
        <?php endif; ?>
        <!-- Username -->
        <div class="mb-3">
            <label for="username" class="form-label ms-3 user-label text-primary ps-1 pe-1">Username</label>
            <input required type="text" class="form-control username-input border border-3 border-primary" name="username" id="username" placeholder="Masukkan Username" />
        </div>
        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label password-label ms-3 text-primary ps-1 pe-1">Password</label>
            <input required type="password" class="form-control password-input border border-3 border-primary" name="password" id="password" placeholder="Masukkan Password" s />
        </div>
        <!-- Change Password -->
        <div class="change-password text-end mt-2 mb-4">
            <a href="#">Lupa Password ?</a>
        </div>
        <!-- Button -->
        <div class="button-login text-center">
            <button type="submit" name="login" class="btn-login btn btn-primary">Login</button>
        </div>
        <!-- Register -->
        <div class="register text-center mt-3">
            <p class="me-1">Belum punya akun ? <a class="text-decoration-none" href="register-user.php">Daftar</a></p>
        </div>
    </form>

    <!-- Bootstrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity=" sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- Font awesome script -->
    <script src="https://kit.fontawesome.com/59f11d8874.js" crossorigin="anonymous"></script>
</body>

</html>