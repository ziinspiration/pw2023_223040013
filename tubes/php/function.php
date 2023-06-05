<?php
// CONNECT TO DBMS
function koneksi()
{
    $conn = mysqli_connect("localhost", "root", "", "tubes_223040013");

    return $conn;
}

// ARRAY QUERY
function query($sql)
{
    $conn = koneksi();
    $result = mysqli_query($conn, "$sql");
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


// TAMBAH DATA 
function tambah($data)
{
    global $conn;
    // ambil data dari tiap elemen dalam form
    $nama = htmlspecialchars($data['nama']);
    $kode = htmlspecialchars($data['kode']);
    $kategori = htmlspecialchars($data['kategori']);
    $harga_normal = htmlspecialchars($data['harga_normal']);
    $harga_promo = htmlspecialchars($data['harga_promo']);
    $deskripsi = htmlspecialchars($data['deskripsi']);
    $kegunaan = htmlspecialchars($data['kegunaan']);
    $komposisi = htmlspecialchars($data['komposisi']);
    $perhatian = htmlspecialchars($data['perhatian']);
    $diproduksi = htmlspecialchars($data['diproduksi']);

    // UP GAMBAR
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    // INSERT DATA 
    $query = "INSERT INTO barang (nama, kode, gambar, kategori, harga_normal, harga_promo, deskripsi, kegunaan, komposisi, perhatian, diproduksi)
    VALUES ('$nama', '$kode', '$gambar', '$kategori', '$harga_normal', '$harga_promo', '$deskripsi', '$kegunaan', '$komposisi', '$perhatian', '$diproduksi')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload()
{
    $namafile = $_FILES['gambar']['name'];
    $ukuranfile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];


    //cek apakah tidak ada gambar yang di upload
    $error = $_FILES['gambar']['error'];

    // cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
    alert('Pilih gambar terlebih dahulu')
    </script>";
        return false;
    }

    // CEK VALIDASI GAMBAR
    $ekstensigambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensigambar = explode('.', $namafile);
    $ekstensigambar = strtolower(end($ekstensigambar));
    if (!in_array($ekstensigambar, $ekstensigambarValid)) {
        echo "<script>
        alert('yang anda upload bukan gambar')
        </script>";
        return false;
    }

    // CEK SIZE GAMBAR 
    if ($ukuranfile > 1000000) {
        echo "<script>
        alert('ukuran gambar terlalu besar')
        </script>";
        return false;
    }

    // LOLOS CEK, SIAP UPLOAD
    // GENERATE NEW NAME
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensigambar;

    move_uploaded_file($tmpName, '../assets/img/' . $namafilebaru);

    return $namafilebaru;
}



// REGISTRASI
function registrasi($data)
{
    $conn = koneksi();

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $nama_lengkap = mysqli_real_escape_string($conn, $data["nama_lengkap"]);
    $email_user = mysqli_real_escape_string($conn, $data["email"]);
    $no_hp_user = mysqli_real_escape_string($conn, $data["no_handphone"]);
    $alamat_lengkap = mysqli_real_escape_string($conn, $data["alamat_lengkap"]);

    // cek username sudah ada atau belum 
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('username sudah terdaftar')
              </script>";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
                alert('konfirmasi password tidak sesuai)
              </script>";
        return false;
    }

    // enkripsi password 
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO user VALUES(null,'$username', '$password', '$nama_lengkap','$email_user','$no_hp_user','$alamat_lengkap', 'user' )");

    return mysqli_affected_rows($conn);
}

// DELETE
function hapus($id)
{
    $conn = koneksi();
    mysqli_query($conn, "DELETE FROM barang WHERE id = $id");

    return mysqli_affected_rows($conn);
}




// SEARCH
function cari($keyword)
{
    $query = "SELECT * FROM barang
                WHERE 
            nama LIKE '%$keyword%' OR
            kategori LIkE '%$keyword%' OR
            harga_normal LIKE '%$keyword%' OR
            kode LIKE  '%$keyword%' OR
            diproduksi LIKE  '%$keyword%'
        ";
    return query($query);
}
