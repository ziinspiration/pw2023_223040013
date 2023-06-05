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

// Query tampil barang
$TampilBarang = query("SELECT keranjang_belanja.*, barang.nama, barang.gambar, barang.harga_normal, barang.harga_promo
FROM keranjang_belanja JOIN barang ON keranjang_belanja.barang_id = barang.id WHERE keranjang_belanja.user_id = $user_id AND keranjang_belanja.isvisible=true");


// Menghapus barang dari keranjang saat tombol hapus diklik
if (isset($_POST['hapus'])) {
    $keranjang_id = $_POST['hapus'];
    $queryDelete = "DELETE FROM keranjang_belanja WHERE id = ?";
    $stmt = mysqli_prepare($conn, $queryDelete);
    mysqli_stmt_bind_param($stmt, "i", $keranjang_id);
    mysqli_stmt_execute($stmt);
    // Redirect ke halaman cart setelah berhasil dihapus
    header("Location: cart-shop.php");
    exit;
}

// Mengubah jumlah barang saat tombol "+" atau "-" ditekan
if (isset($_POST['keranjang_id']) && isset($_POST['new_quantity'])) {
    $keranjang_id = $_POST['keranjang_id'];
    $new_quantity = (int) $_POST['new_quantity']; // Konversi ke tipe integer

    // Perbarui jumlah barang di database
    $queryUpdate = "UPDATE keranjang_belanja SET jumlah = ? WHERE id = ? AND isvisible = '1'";
    $stmt = mysqli_prepare($conn, $queryUpdate);
    mysqli_stmt_bind_param($stmt, "ii", $new_quantity, $keranjang_id);
    mysqli_stmt_execute($stmt);

    // Redirect kembali ke halaman keranjang setelah berhasil memperbarui jumlah
    header("Location: cart-shop.php");
    exit;
}

// Proses tambah ke keranjang saat tombol add_to_cart diklik
if (isset($_POST['add_to_cart'])) {
    $barang_id = $_POST['add_to_cart'];

    // Query untuk mengecek apakah barang sudah ada di keranjang user
    $queryCheck = "SELECT * FROM keranjang_belanja WHERE user_id = $user_id AND barang_id = $barang_id AND isvisible = '1'";
    $resultCheck = mysqli_query($conn, $queryCheck);

    // Jika barang belum ada di keranjang, tambahkan ke keranjang dengan jumlah 1
    if (mysqli_num_rows($resultCheck) == 0) {
        $queryInsert = "INSERT INTO keranjang_belanja (isvisible, user_id, barang_id, jumlah) VALUES ('1', $user_id, $barang_id, 1)";
        mysqli_query($conn, $queryInsert);
    } else {
        // Jika barang sudah ada di keranjang, periksa jumlah barang sebelum ditambah
        $row = mysqli_fetch_assoc($resultCheck);
        $jumlah = $row['jumlah'];
        if ($jumlah === null) {
            $jumlah = 0;
        }

        $keranjangId = $row['id'];

        // Jika jumlah barang kurang dari 1, tambahkan 1 ke jumlah
        if ($jumlah < 1) {
            $queryUpdate = "UPDATE keranjang_belanja SET jumlah = jumlah +1 WHERE keranjang_belanja.id = $keranjangId ";
            mysqli_query($conn, $queryUpdate);
        }
    }
}

// Proses tombol bayar diklik
if (isset($_GET['id'])) {
    // Mendapatkan id barang dari parameter URL
    $barang_id = $_GET['id'];

    // ...

    // Redirect ke halaman pembayaran
    header("Location: payment.php?id=$barang_id");
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Default CSS -->
    <link rel="stylesheet" href="../css/support-pages/cart-shop/cart-shop.css" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="icon" href="../assets/img/logo-halodek/halodek-logo.png" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha384-Ky+6Fe2lUisZlL+b0dfF0X6bvg15s1PIdrSvH7Gl9f2vOxgEe0EEtSpzIeK2hViZ" crossorigin="anonymous">
    </script>

    <title>cart-shop-halodek</title>
    <style>
    .card-cart {
        box-shadow: 0 0 4px grey !important;
        border-radius: 10px !important;
    }

    .cart-footer {
        background-color: lightgray;
    }

    .size {
        width: 50px !important;
        height: 35px !important;
        text-align: center !important;
        padding-right: 5px !important;
        font-weight: 600;
    }
    </style>
</head>

<body>
    <!-- Back arrow -->
    <div class="head d-flex bg-primary justify-content-between">
        <a class="ms-3 mt-2" href="../login-page/index-login.php"><i class="fa-solid fa-arrow-left"></i></a>
        <p class="brand mt-2 me-3">
            <i class="fa-solid fa-user-doctor text-light me-1"></i>Halodek
        </p>
    </div>


    <div class="container">

        <?php
        foreach ($TampilBarang as $brg) :
            $totalHarga = $brg['harga_promo'] * $brg['jumlah'];
        ?>
        <a class="text-decoration-none text-dark" href="#">
            <div class="card-cart bg-white shadow-sm rounded mb-3 mt-4 overflow-hidden">
                <!-- Card body -->
                <div class="cart-body d-flex">
                    <!-- gambar -->
                    <div class="gambar w-25">
                        <img src="../assets/img/<?= $brg['gambar'] ?>" alt="Product Image" class="product-img w-100">
                    </div>
                    <!-- nama / harga / jumlah -->
                    <div class="body-cart mt-4">
                        <h2><?= $brg['nama'] ?></h2>
                        <div class="price d-flex mt-1">
                            <p class="text-danger text-decoration-line-through me-1 mt-1">
                                Rp <?= $brg['harga_normal'] ?></p>
                            <p class="text-primary fs-5">Rp <?= $brg['harga_promo'] ?></p>
                        </div>
                    </div>
                </div>
                <!-- Card footer -->
                <div class="cart-footer p-3">

                    <div class="jumlah d-flex align-items-center mt-1 mb-3">
                        <button class="btn btn-jum btn-primary me-2" onclick="decrementQuantity(<?= $brg['id'] ?>)"><i
                                class="fa-solid fa-minus"></i></button>

                        <input id="jumlah-<?= $brg['id'] ?>" name="jumlah"
                            class="size border border-2 border-primary rounded" type="text"
                            value="<?= $brg['jumlah'] ?>" readonly />

                        <button class="btn btn-jum btn-primary ms-2" onclick="incrementQuantity(<?= $brg['id'] ?>)"><i
                                class="fa-solid fa-plus"></i></button>
                    </div>
                    <p name="total-harga ">Total harga : <span class="fw-bolder text-primary">Rp
                            <?= $totalHarga; ?>.000</span></p>

                    <div class="button-buy-del border-top border-secondary p-3 d-flex">


                        <a class="me-2" href="payment.php?id=<?= $brg["id"] ?>">
                            <button type="submit" name="bayar[]" value="<?= $brg['id'] ?>"
                                class="btn btn-primary btn-bayar">Bayar</button>
                        </a>



                        <form id="form-<?= $brg['id'] ?>" method="post" action="" onsubmit="return hapusData(event)">
                            <input type="hidden" name="keranjang_id" value="<?= $brg['id'] ?>">
                            <input type="hidden" name="new_quantity">
                            <button type="submit" name="hapus" value="<?= $brg['id'] ?>" class="btn btn-danger me-2"><i
                                    class="fa-solid fa-trash-can text-light"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </a>
        <?php endforeach; ?>
    </div>


    <!-- Name brand -->
    <div class="name-brand-bottom text-center mt-4">
        <p>
            <span>Developed by : </span>
            <i class="fa-solid fa-user-doctor text-primary me-1"></i>Halodek
        </p>
    </div>

    <!-- Boostrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- Font awesome script -->
    <script src="https://kit.fontawesome.com/59f11d8874.js" crossorigin="anonymous"></script>
    <script src="../js/dist/sweetalert2.all.min.js"></script>
    <script>
    function decrementQuantity(id) {
        const input = document.getElementById(`jumlah-${id}`);
        let quantity = parseInt(input.value);
        if (quantity > 1) {
            quantity--;
            input.value = quantity;
            updateQuantity(id, quantity);
        }
    }

    function incrementQuantity(id) {
        const input = document.getElementById(`jumlah-${id}`);
        let quantity = parseInt(input.value);
        quantity++;
        input.value = quantity;
        updateQuantity(id, quantity);
    }

    function updateQuantity(id, newQuantity) {
        const form = document.createElement('form');
        form.method = 'post';
        const inputId = document.createElement('input');
        inputId.type = 'hidden';
        inputId.name = 'keranjang_id';
        inputId.value = id;
        const inputQuantity = document.createElement('input');
        inputQuantity.type = 'hidden';
        inputQuantity.name = 'new_quantity';
        inputQuantity.value = newQuantity;
        form.appendChild(inputId);
        form.appendChild(inputQuantity);
        document.body.appendChild(form);
        form.submit();
    }

    function hapusData(event) {
        var id = event.target.value;

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'cart-delete.php',
                    method: 'POST',
                    data: {
                        hapus: id
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire(
                                'Terhapus!',
                                'Data telah dihapus.',
                                'success'
                            ).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                response.message,
                                'error'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan saat menghapus data.',
                            'error'
                        );
                    }
                });
            } else {
                // Tidak ada tindakan jika tombol Batal diklik
            }
        });
    }

    $(document).ready(function() {
        $("form[id^='form-']").submit(function(event) {
            event.preventDefault();
            hapusData(event);
        });
    });
    </script>

</body>

</html>