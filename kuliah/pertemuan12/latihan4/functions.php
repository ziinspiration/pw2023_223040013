<?php
define('BASE_URL', '/pw2023_223040013/kuliah/pertemuan12/');

function koneksi()
{
  // koneksi ke DB
  $conn = mysqli_connect('localhost', 'root', '', 'pw2023_223040013') or die('Koneksi gagal!');
  return $conn;
}

function query($query)
{
  $conn = koneksi();
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn)); // perintah sql
  $rows = []; // rows ini adalah container
  // cetak pengulangan
  while ($row = mysqli_fetch_assoc($result)) {
    // var_dump($row); // ini bisa cuma logic nya salah
    $rows[] = $row;
  }

  return $rows;
}

function tambah($data)
{
  $conn = koneksi();

  $nim = $data['nim'];
  $nama = $data['nama'];
  $email = $data['email'];
  $jurusan = $data['jurusan'];
  $gambar = $data['gambar'];


  $query = "INSERT INTO mahasiswa VALUES (null,'$nim','$nama','$email','$jurusan', '$gambar' )";

  mysqli_query($conn, $query) or die(mysqli_error($conn));

  return mysqli_affected_rows($conn);
}

function dd($value)
{
  echo "<pre>";
  var_dump($value);
  die;
  echo "</pre>";
}

function uriIS($uri)
{
  return ($_SERVER["REQUEST_URI"] === BASE_URL) ? 'active' : '';
}
