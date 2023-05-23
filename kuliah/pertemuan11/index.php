<?php
//konekasi ke database
$conn = mysqli_connect("localhost", "root", "", "pw2023_223040013");

// ambil data dari tabel mahasiswa / query data mahasiswa
$result = mysqli_query($conn . "SELECT * FROM mahasiswa");

// ambil data (fetch) mahasiswa dari objek result 

// mysqli_fetch_row()  // mengembalikan array numerik
// mysqli_fetch_array() // mengembalikan array associative
// mysqli_fetch_assoc() // mengembalikan keduanya
// mysqli_fetch_objek()
while ($mhs = mysqli_fetch_assoc($result)) {
    var_dump($mhs);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman admind</title>
</head>

<body>
    <table border="1" cellpadding="10" cellspacing="10">

        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>NRP</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jurusan</th>
        </tr>

        <tr>
            <td>1</td>
            <td>
                <a href="">Ubah</a> |
                <a href="">Hapus</a>
            </td>
            <td><img src="" alt=""></td>
        </tr>

    </table>
</body>

</html>