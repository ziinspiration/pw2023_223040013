<?php
require '../php/function.php';
$conn = koneksi();

$response = array();

if (isset($_POST['hapus'])) {
    $keranjang_id = $_POST['hapus'];
    $queryDelete = "DELETE FROM keranjang_belanja WHERE id = ?";
    $stmt = mysqli_prepare($conn, $queryDelete);
    mysqli_stmt_bind_param($stmt, "i", $keranjang_id);
    mysqli_stmt_execute($stmt);

    // Memeriksa jumlah baris yang terpengaruh
    $rowsAffected = mysqli_stmt_affected_rows($stmt);

    // Mengisi respons berdasarkan jumlah baris yang terpengaruh
    if ($rowsAffected > 0) {
        $response['status'] = 'success';
        $response['message'] = 'Data berhasil dihapus.';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Terjadi kesalahan saat menghapus data.';
    }

    // Menutup statement
    mysqli_stmt_close($stmt);
} else {
    $response['status'] = 'error';
    $response['message'] = 'Parameter tidak valid.';
}

// Mengirimkan respons dalam format JSON
header('Content-Type: application/json');
echo json_encode($response);
