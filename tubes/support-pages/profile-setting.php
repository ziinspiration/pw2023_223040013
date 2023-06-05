<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../login-page/login-user.php");
    exit;
}

require '../php/function.php';

$conn = koneksi();

// Mendapatkan user_id dari session
$user_id = $_SESSION["user_id"];

//ambil data user berdasarkan user_id
$query = "SELECT * FROM user WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Default CSS -->
    <link rel="stylesheet" href="../css/support-pages/profile-settings/profile-settings.css" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="icon" href="../assets/img/logo-halodek/halodek-logo.png" />
    <title>profile-setting-halodek</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


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

    <div class="container">
        <div class="profile">

            <!-- username -->
            <div class="username">
                <label class="name-box text-primary">Username</label>
                <div class="card-master d-flex">
                    <div class="in-box d-flex align-items-center border border-3 border-primary">
                        <i class="line-border border-primary text-primary fa-solid fa-circle-user me-3"></i>
                        <input class="data-berubah form-control-caret" type="text" name="username" value="<?= $user['username']; ?>" readonly onclick="moveCursorToEnd(this)">
                    </div>
                    <i class="change text-primary fa-solid fa-pen ms-4" onclick="enableEdit('username')"></i>
                </div>
            </div>

            <!-- fullname -->
            <div class="name">
                <label class="name-box text-primary">Nama</label>
                <div class="card-master d-flex">
                    <div class="in-box d-flex align-items-center border border-3 border-primary">
                        <i class="line-border border-primary text-primary fa-solid fa-user me-3"></i>
                        <input class="data-berubah" type="text" name="nama_lengkap" value="<?= $user['nama_lengkap']; ?>" readonly>
                    </div>
                    <i class="change text-primary fa-solid fa-pen ms-4" onclick="enableEdit('nama_lengkap')"></i>
                </div>
            </div>

            <!-- email -->
            <div class="email">
                <label class="name-box text-primary">Email</label>
                <div class="card-master d-flex">
                    <div class="in-box d-flex align-items-center border border-3 border-primary">
                        <i class="line-border border-primary text-primary fa-solid fa-envelope me-3"></i>
                        <input class="data-berubah" type="text" name="email" value="<?= $user['email']; ?>" readonly>
                    </div>
                    <i class="change text-primary fa-solid fa-pen ms-4" onclick="enableEdit('email')"></i>
                </div>
            </div>

            <!-- no handphone -->
            <div class="handphone">
                <label class="name-box text-primary">Nomer Handphone</label>
                <div class="card-master d-flex">
                    <div class="in-box d-flex align-items-center border border-3 border-primary">
                        <i class="line-border border-primary text-primary fa-solid fa-phone me-3"></i>
                        <input class="data-berubah" type="text" name="no_handphone" value="<?= $user['no_handphone']; ?>" readonly>
                    </div>
                    <i class="change text-primary fa-solid fa-pen ms-4" onclick="enableEdit('no_handphone')"></i>
                </div>
            </div>

            <!-- address -->
            <div class="address">
                <label class="name-box text-primary">Alamat</label>
                <div class="card-master d-flex">
                    <div class="in-box d-flex align-items-center border border-3 border-primary">
                        <i class="line-border border-primary text-primary fa-solid fa-location-dot me-3"></i>
                        <input class="data-berubah" type="text" name="alamat_lengkap" value="<?= $user['alamat_lengkap']; ?>" readonly>
                    </div>
                    <i for="alamat_lengkap" class="change text-primary fa-solid fa-pen ms-4" onclick="enableEdit('alamat_lengkap')"></i>
                </div>
            </div>
        </div>

        <div class="button d-flex justify-content-end ">
            <button type="button" class="btn btn-primary btn-save me-3 rounded-pill" onclick="saveChanges()">Simpan</button>
            <a href="../login-page/logout.php"><button type="button" class="btn btn-danger btn-out rounded-pill">Keluar</button></a>
        </div>

    </div>


    <!-- NAVIGASI FOR PHONE -->
    <nav class="nav-phone fixed-bottom d-flex justify-content-around text-primary bg-light m-auto pt-3 d-none">
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
            <a href="../login-phone/after-login-phone.php" class="text-decoration-none">
                <i class="fa-regular fa-user"></i>
                <p style="font-size: 15px">Akun</p>
            </a>
        </div>
    </nav>
    <!-- NAVIGASI END -->

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzj2YFsdo5p/i3anfQb7y/UnCr4u9heq7Gk7p2iSr7xUzdF1P6cZchAKpXdgixXK" crossorigin="anonymous">
    </script>
    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Font awesome script -->
    <script src="https://kit.fontawesome.com/59f11d8874.js" crossorigin="anonymous"></script>
    <!-- Script Default -->
    <script>
        function moveCursorToEnd(input) {
            input.focus();
            input.setSelectionRange(input.value.length, input.value.length);
        }



        function enableEdit(field) {
            var inputField = document.getElementsByName(field)[0];
            inputField.removeAttribute("readonly");
            inputField.focus();
        }

        function saveChanges() {
            var username = document.getElementsByName("username")[0].value;
            var nama_lengkap = document.getElementsByName("nama_lengkap")[0].value;
            var email = document.getElementsByName("email")[0].value;
            var no_handphone = document.getElementsByName("no_handphone")[0].value;
            var alamat_lengkap = document.getElementsByName("alamat_lengkap")[0].value;

            $.ajax({
                url: "save-profile.php",
                type: "POST",
                data: {
                    username: username,
                    nama_lengkap: nama_lengkap,
                    email: email,
                    no_handphone: no_handphone,
                    alamat_lengkap: alamat_lengkap
                },
                success: function(response) {
                    Swal.fire({
                        position: 'center-center',
                        icon: 'success',
                        title: 'Selamat :)',
                        text: 'Perubahan anda berhasil tersimpan',
                        footer: ' <a class="navbar-brand ms-3 text-primary"><i class="fa-solid fa-user-doctor text-primary me-2"></i> <span class="text-primary">HaloDek</span></a>',
                        showConfirmButton: false,
                        timer: 3500
                    })

                },
                error: function(xhr, status, error) {
                    alert("Terjadi kesalahan saat menyimpan perubahan: " + xhr.status + " " + error);
                }
            });
        }
    </script>
</body>

</html>