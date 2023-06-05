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
    <link rel="stylesheet" href="css/admind/dashboard-pages/admind-profile.css" />
    <link rel="icon" href="../assets/img/logo-halodek/halodek-logo.png" />
    <title>profile-admind-halodek</title>
</head>

<body>
    <!-- Back arrow -->
    <div class="head d-flex bg-primary justify-content-between">
        <a class="ms-3 mt-2" href="dashboard-admind.html"><i class="fa-solid fa-arrow-left"></i></a>
        <p class="brand mt-2 me-3">
            <i class="fa-solid fa-user-doctor text-light me-1"></i>Halodek
        </p>
    </div>



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