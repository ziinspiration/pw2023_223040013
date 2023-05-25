<?php
require('functions.php');
$name = 'Home';

// koneksi ke DB
$conn = mysqli_connect('localhost', 'root', '', 'pw2023_223040013') or die('Koneksi gagal!');

// Query ke tabel mahasiswa
$result = mysqli_query($conn, "SELECT * FROM mahasiswa") or die(mysqli_error($conn)); // perintah sql

$rows = []; // rows ini adalah container

// cetak pengulangan
while ($row = mysqli_fetch_assoc($result)) {
  // var_dump($row); // ini bisa cuma logic nya salah
  $rows[] = $row;
}

// menampilkan
// var_dump($rows) masukan ke container di website = $students


// Siapkan data student
$students = $rows;









// $students = [
//   [
//     "nama" => "Sandhika Galih",
//     "npm" => "043040023",
//     "email" => "sandhikagalih@unpas.ac.id"
//   ],
//   [
//     "nama" => "Doddy Ferdiansyah",
//     "npm" => "133040003",
//     "email" => "doddy@gmail.com"
//   ]
// ];

// dd(BASE_URL === $_SERVER["REQUEST_URI"]);
require('views/index.view.php');
