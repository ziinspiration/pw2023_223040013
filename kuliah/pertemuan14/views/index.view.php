<?php require('partials/header.php'); ?>
<?php require('partials/nav.php'); ?>

<div class="container mt-3">
    <h1>Halaman Home</h1>

    <h3>Daftar Mahasiswa</h3>

    <a class="mt-2 mb-5 btn text-bg-primary text-decoration-none" href="tambah.php">Tambah data mahasiswa</a>

    <div class="row mb-5">
        <div class="col-md-6">
            <form action="" method="get">
                <div class="input-group">
                    <input type="search" class="form-control" name="keyword" id="keyword" form-control" placeholder="Search students" autofocus autocomplete="off">
                    <button class="btn btn-primary" name="search" id="search-button" type="submit" id="button-addon2">Search</button>
                </div>
            </form>
        </div>
    </div>

    <div id="search-container">
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
                                <a class="badge text-bg-warning text-decoration-none" href="ubah.php?id=<?= $student['id']; ?>">Ubah</a> |
                                <a class="badge text-bg-danger text-decoration-none" onclick="return confirm('Yakin ?');" href="hapus.php?id=<?= $student['id']; ?>">Hapus</a>
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
    </div>
</div>

<?php require('partials/footer.php'); ?>