<?php require('partials/header.php'); ?>
<?php require('partials/nav.php'); ?>

<div class="container mt-3">
    <h1>Halaman Home</h1>

    <h3>Daftar Mahasiswa</h3>


    <a class="mt-2 mb-5 btn text-bg-primary text-decoration-none" href="tambah.php">Tambah data mahasiswa</a>

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
                        <a class="badge text-bg-warning text-decoration-none" href="ubah.php?id=<?= $student['id']; ?>">Ubah</a> |
                        <a class="badge text-bg-danger text-decoration-none" onclick="return confirm('Yakin ?');" href="hapus.php?id=<?= $student['id']; ?>">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?php require('partials/footer.php'); ?>