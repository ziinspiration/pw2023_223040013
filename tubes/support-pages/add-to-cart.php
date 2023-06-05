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

// Memperoleh nilai barang_id dari permintaan POST
$barang_id = $_POST['barang_id'];

// Memeriksa apakah barang sudah ada di keranjang
$queryCheck = "SELECT * FROM keranjang_belanja WHERE user_id = $user_id AND barang_id = $barang_id AND isvisible = '1'";
$resultCheck = mysqli_query($conn, $queryCheck);

if (mysqli_num_rows($resultCheck) > 0) {
    $row = mysqli_fetch_assoc($resultCheck);
    $keranjangId = $row['id'];
    // Jika barang sudah ada di keranjang, tambahkan 1 ke jumlah barang
    $queryUpdate = "UPDATE keranjang_belanja SET jumlah = jumlah +1 WHERE keranjang_belanja.id = $keranjangId";
    mysqli_query($conn, $queryUpdate);
} else {
    // Jika barang belum ada di keranjang, tambahkan sebagai barang baru
    $queryInsert = "INSERT INTO keranjang_belanja (user_id, barang_id, jumlah) VALUES ($user_id, $barang_id, 1)";
    mysqli_query($conn, $queryInsert);
}

// Mengembalikan respon ke permintaan AJAX dengan status 200 (Sukses)
http_response_code(200);
