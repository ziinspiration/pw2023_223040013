<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../login-page/login-user.php");
    exit;
}

require '../php/function.php';

$conn = koneksi();
$user_id = $_SESSION["user_id"]; // Mendapatkan user_id dari session

// Mengambil data user berdasarkan user_id
$query = "SELECT * FROM user WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Mendapatkan data yang dikirim melalui permintaan POST
$username = $_POST['username'];
$nama_lengkap = $_POST['nama_lengkap'];
$email = $_POST['email'];
$no_handphone = $_POST['no_handphone'];
$alamat_lengkap = $_POST['alamat_lengkap'];

// Menyimpan perubahan data pengguna ke dalam database
$query = "UPDATE user SET username = '$username', nama_lengkap = '$nama_lengkap', email = '$email', no_handphone = '$no_handphone', alamat_lengkap = '$alamat_lengkap' WHERE user_id = $user_id";
mysqli_query($conn, $query);

mysqli_close($conn);
