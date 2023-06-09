<?php
require '../functions.php';
$keyword = $_GET['keyword'];
$query = "SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%' OR jurusan LIKE '%$keyword%'  OR email LIKE '%$keyword%'";
$students = query($query);
?>

<?php if ($students) : ?>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Gambar</th>
            <th scope="col">NIM</th>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>
            <th scope="col">Jurusan</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($students as $student) : ?>
        <tr>
            <th scope="row"><?= $i++; ?></th>
            <td><img width="50" src="img/<?= $student['gambar']; ?>"></td>
            <td><?= $student['nim']; ?></td>
            <td><?= $student['nama']; ?></td>
            <td><?= $student['email']; ?></td>
            <td><?= $student['jurusan']; ?></td>
            <td>
                <a class="badge text-bg-warning text-decoration-none" href="ubah.php?id=<?= $student['id']; ?>">Ubah</a>
                |
                <a class="badge text-bg-danger text-decoration-none" onclick="return confirm('Yakin ?');"
                    href="hapus.php?id=<?= $student['id']; ?>">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else :  ?>
<div class="row">
    <div class="col-md-6">
        <div class="alert alert-danger" role="alert">
            Student not found!
        </div>
    </div>
</div>
<?php endif; ?>