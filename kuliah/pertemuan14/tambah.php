<?php
require('functions.php');

$name = 'tambah data mahasiswa';

// ketika tombol submit di klik
if (isset($_POST['tambah'])) {
    // jalankan fungsi tambah
    if (tambah($_POST) > 0) {
        echo "<script>
    alert('Data berhasil ditambahkan !');
    document.location.href= 'index.php';
          </script>";
    }
}

require('views/tambah.view.php');
