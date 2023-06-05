<?php
session_start();

require '../php/function.php';

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $conn = koneksi();

    // Cek apakah username dan password valid untuk peran "admind"
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"]) && $row["role"] === "admind") {
            // set session
            $_SESSION["login"] = true;
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["role"] = $row["role"];

            // set cookie
            setcookie("username", $username, time() + 3600);

            header("location: ../admind/dashboard-admind.php");
            exit;
        }
    }

    $error = true;
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
    <link rel="stylesheet" href="css/login-style/admind-login.css" />
    <link rel="icon" href="../assets/img/logo-halodek/halodek-logo.png" />
    <title>admind-login-halodek</title>
</head>

<body>
    <form class="login-card" method="post" action="">
        <!-- Brand name -->
        <div class="name-brand text-center">
            <p><a href="../login-page/login-user.php"><i class="fa-solid fa-user-doctor text-primary me-1"></i></a>Halodek</p>
        </div>
        <!-- id_admind -->
        <div class="mb-3">
            <label for="username" class="form-label ms-3 user-label text-primary ps-1 pe-1">ID Admin</label>
            <input type="text" name="username" class="form-control username-input border-3 border-primary" id="username" placeholder="Masukkan ID Admin" required />
        </div>
        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label password-label ms-3 text-primary ps-1 pe-1">Password</label>
            <input type="password" name="password" class="form-control password-input border-3 border-primary" id="password" placeholder="Masukkan Password" required />
        </div>
        <!-- Button login -->
        <div class="button-login mb-3 mt-4">
            <button type="submit" name="login" class="btn btn-login btn-primary">
                Masuk
            </button>
        </div>
        <?php if (isset($error) && $error) : ?>
            <p style="color: red; font-style: italic;">Username atau password salah.</p>
        <?php endif; ?>
    </form>
    <!-- Boostrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- Font awesome script -->
    <script src="https://kit.fontawesome.com/59f11d8874.js" crossorigin="anonymous"></script>
</body>

</html>