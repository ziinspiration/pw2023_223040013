<?php

require 'function.php';
$id = $_GET['id'];

if (hapus($id) > 0) {
    echo "<script>
            alert('Data Berhasil dihapus');
            document.location.href = '../admind/daftar-barang.php';
        </script>";
} else {
    echo "<script>
            alert('Data Gagal dihapus');
            document.location.href = '../admind/daftar-barang.php';
        </script>";
}
