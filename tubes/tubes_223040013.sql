-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 12 Jun 2023 pada 07.07
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tubes_223040013`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admind`
--

CREATE TABLE `admind` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `id_admind` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `admind`
--

INSERT INTO `admind` (`id`, `nama`, `id_admind`, `password`) VALUES
(1, 'Ilham ramadhana hartono', 'admind', 'admind');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `harga_normal` decimal(8,3) NOT NULL,
  `harga_promo` decimal(8,3) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `kegunaan` varchar(255) NOT NULL,
  `komposisi` varchar(255) NOT NULL,
  `perhatian` varchar(255) NOT NULL,
  `diproduksi` varchar(255) NOT NULL,
  `kategori_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `nama`, `kode`, `gambar`, `kategori`, `harga_normal`, `harga_promo`, `deskripsi`, `kegunaan`, `komposisi`, `perhatian`, `diproduksi`, `kategori_id`) VALUES
(1, 'Panadol biru tablet ', 'HD-P-001', '64797c483caf2.jpg', 'promo', 13.000, 11.000, 'Panadol biru bermanfaat untuk meredakan nyeri, seperti sakit kepala, sakit gigi, dan nyeri otot, serta menurunkan demam. Tiap kaplet Panadol Reguler mengandung 500 mg paracetamol.', 'Meringankan rasa sakit seperti sakit kepala, sakit gigi dan menurunkan demam.', 'Paracetamol 500g', 'Jangan mengonsumsi dan menggunakan paracetamol jika memiliki riwayat alergi dengan obat ini.', 'STERLING PRODUCTS INDONESIA', NULL),
(3, 'Kotak P3K Dinding', 'HD-P3K-001', '646614c9b50d7.png', 'p3k', 100.000, 100.000, 'KOTAK P3K DINDING merupakan kotak yang berisi obat-obatan dasar seperti obat merah, perban, obat pusing, dan ditujukan untuk di pasang di dinding rumah anda.', 'Membantu menangani keadaan darurat medis secepat mungkin.', 'Berisi obat-obatan dasar seperti obat merah, perban, obat pusing, dan ditujukan untuk di pasang di dinding rumah anda.', '-', 'ONEMED', NULL),
(5, 'Omomed Masker Earloop', 'HD-ALKES-002', '64661645d60f1.jpg', 'alatkesehatan', 70.000, 70.000, 'OMOMED MASKER EARLOOP 50S merupakan masker sekali pakai dengan 3 lapisan filter untuk menahan bakteri.', 'Menahan partikel debu serta menyaring udara.', '1 Dos isi 50 Pcs', '-', 'OMOMED', NULL),
(6, 'Stimuno Orange Berry Sirup 60ml (per Botol)', 'HD-P-002', '6466183280016.jpg', 'promo', 30.000, 28.000, 'STIMUNO ORANGE BERRY SYR 60ML merupakan produk herbal fitofarmaka, yang terbukti berkhasiat dan aman untuk meningkatkan kekebalan tubuh', 'Berkhasiat dan aman untuk meningkatkan kekebalan tubuh, berguna untuk mencegah sakit dan mempercepat penyembuhan.', 'Ekstrak Phyllanthus niruri 25mg', 'Sirup untuk anak-anak usia 1 tahun ke atas: 1 sendok takar (5 ml), 1-3 kali sehari.', 'Dexa Medica', NULL),
(8, 'Prenagen Esensis Moka 180gram ', 'HD-P-003', '64661a852e7d0.png', 'promo', 48.000, 45.000, 'Prenagen adalah susu ibu hamil dan menyusui yang bernutrisi lengkap, sangat baik untuk diminum oleh para wanita yang sedang merencanakan kehamilan', 'Nutrisi lengkap gizi yang diformulasikan untuk mempersiapkan kehamilan', 'Asam folat, kalsium, vitamin E, rendah lemak', '-', 'Kalbe Farma', NULL),
(11, 'Hepatin 750mg Tablet (per Strip)', 'HD-P-006', '64661c15c9870.jpg', 'promo', 45.000, 40.000, 'Suplemen alami untuk hati ini mengandung gabungan dari Curcuminoid, Silymarin phytosome, Echinacea extr, Choline bitartrate, Vit B6.', 'Untuk mengatasi gejala penyakit hati misalnya, hepatitis akut dan kronis, perlemakan hati, sirosis hati.', 'Curcuminoid 20mg, Silymarin phytosome 70mg, Echinacea extr 150mg, Choline bitartrate 150mg, Vit B6 2mg', 'Simpan di tempat kering san sejuk, serta terhindar dari panas sinar matahari langsung, jauhkan dari', 'Lapi', NULL),
(12, 'Ventolin Inh 100mcg/puff 200 Dose (per Pcs)', 'HD-AP-001', '646b7fccdfec9.jpg', 'asmapernapasan', 175.000, 175.000, 'Ventolin merupakan obat yang digunakan untuk meringankan gejala-gejala asma dengan cepat pada saat serangan asma berlangsung dan mampu mengobati Penyakit Paru ', 'untuk terapi rutin penyakit penyumbatan saluran nafas, termasuk asma', ' salbutamol sulfat 0,1 mg ', 'simpan di tempat sejuk dan kering, terhindar dari paparan sinar matahari langsung', 'glaxo smith kline', NULL),
(13, 'Gea Tensimeter Aneroid Mi-1001 (per Pcs)', 'HD-ALKES-002', '646b84f8b59af.jpg', 'alatkesehatan', 131.000, 128.000, 'Alat tensi jarum, untuk membantu mengukur tekanan dara.', 'Alat tensi', '-', '-', 'GEA', NULL),
(14, 'Obh Combi Anak Batuk Flu Rasa Jeruk 60ml (per Botol)', 'HD-FB-001', '646b85cdd4bfd.jpg', 'flubatuk', 20.000, 19.000, 'OBH COMBI ANAK BATUK FLU RASA JERUK 60ML merupakan obat batuk pilek dan demam untuk anak dengan rasa jeruk yang disukai anak-anak.', 'Meredakan batuk yang disertai gejala-gejala flu pada anak seperti demam, sakit kepala, hidung tersumbat dan bersin-bersin', 'succus Liquiritiae 100 mg, Paracetamol 120 mg, Ammonium Chloride 50 mg, Pseudoephedrine HCL 7,5 mg, Chlorpheniramine Maleate 1,0 mg', '-', 'COMBIPHAR', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang_belanja`
--

CREATE TABLE `keranjang_belanja` (
  `id` int NOT NULL,
  `isvisible` tinyint(1) NOT NULL,
  `user_id` int DEFAULT NULL,
  `barang_id` int DEFAULT NULL,
  `jumlah` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `keranjang_belanja`
--

INSERT INTO `keranjang_belanja` (`id`, `isvisible`, `user_id`, `barang_id`, `jumlah`) VALUES
(145, 0, 11, 1, 1),
(151, 0, 11, 6, 1),
(152, 0, 11, 3, 1),
(153, 0, 11, 3, 1),
(154, 0, 11, 5, 1),
(155, 0, 11, 5, 2),
(156, 0, 11, 1, 1),
(157, 0, 11, 6, 1),
(159, 0, 11, 3, 1),
(160, 0, 1, 3, 1),
(163, 1, 1, 1, 1),
(164, 1, 11, 3, 1),
(165, 1, 7, 3, 1),
(166, 1, 7, 14, 1),
(167, 1, 7, 5, 1),
(168, 1, 7, 11, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int NOT NULL,
  `nama_rekening` varchar(255) DEFAULT NULL,
  `nomor_rekening` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `bukti_transfer` varchar(255) DEFAULT NULL,
  `tanggal_bayar` date DEFAULT NULL,
  `jumlah_harga` decimal(10,3) DEFAULT NULL,
  `keranjang_id` int DEFAULT NULL,
  `barang_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `nama_rekening`, `nomor_rekening`, `bukti_transfer`, `tanggal_bayar`, `jumlah_harga`, `keranjang_id`, `barang_id`, `user_id`, `status`) VALUES
(41, 'Heryani', '169000000000', '4.png', '2023-05-31', 140.000, 155, 5, 11, 'Sukses'),
(42, 'heryani', '4131412414124', 'adidasMU.jpg', '2023-05-31', 11.000, 156, 1, 11, 'Sukses'),
(43, 'heryani', '4131412414124', 'adidasMU.jpg', '2023-05-31', 28.000, 157, 6, 11, 'Sukses'),
(44, 'ilham ramadhana hartono', '16900123456', 'rifki pic.jpg', '2023-06-01', 100.000, 160, 3, 1, 'Sukses'),
(45, 'sd', 'sd', 'BBL.jpg', '2023-06-01', 100.000, 159, 3, 11, 'Sukses');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nama_lengkap` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `no_handphone` varchar(15) NOT NULL,
  `alamat_lengkap` varchar(255) NOT NULL,
  `role` enum('admind','user') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `nama_lengkap`, `email`, `no_handphone`, `alamat_lengkap`, `role`) VALUES
(1, 'ziimpossible', '$2y$10$q5H.TY/0vnJWQ.lNeCmsg.DJvohpm6byg7jWKqLRKo8V0IrfYL2Sq', 'Ilham ramadhana hartono', 'ilham@mail.unpas.ac.id', '085355064514', 'Gg.Hj ridho II, No 24E, Gegerkalong, Bandung', 'user'),
(6, 'diewehimpunan', '$2y$10$fLZvYBtOrrI6eQNt61tmxussw7b4IfQDpq1CfcXYCBpFA98CTBuFu', 'fakih helmi maulana', 'fakih.223040056@mail.unpas.ac.id', '085813753769', 'Gg.Hj ridho II, No 24E, Gegerkalong, Bandung', NULL),
(7, 'lisvindanu', '$2y$10$3KUAaNsP0.NPleVGLHTwtOwCsT9JueCkAj/wTbyGvmI0gFIoq1CSm', 'Lisvindanu', 'Lisvindanu.223040038@mail.unpas.ac.id', '082254223714', 'Gg.Hj ridho II, No 24E, Gegerkalong, Bandung', NULL),
(10, 'mgways88', '$2y$10$C.4eehIW6KI3atkSmWzsheUBWWcve43681SXO25fzwaC8Dq1A30Dm', 'Meutuah dicco linge', 'meutuah.223040098@mail.unpas.ac.id', '082211092793', 'Gg.Hj ridho II, No 24E, Gegerkalong, Bandung', NULL),
(11, 'heryan00', '$2y$10$cMwESCiTcQEGRvuuuJfY5OeFAU4mP0lTYoi1jScQM5xGCI7h8GUnq', 'Heryani', '203040169@mail.unpas.ac.id', '0881081900348', 'Gg.Hj ridho II, No 24D, Gegerkalong, Bandung', NULL),
(12, 'afat-cabul', '$2y$10$I4498JKKfSQe6FnwfIoIcuWNo9sK3dBQxy.ugeV07WuGejZoZ6zPG', 'muhammad alfath septian', 'alfath.223040014@mail.unpas.ac.id', '082254223714', 'Dipati ukur', NULL),
(18, 'admind-halodek', '$2y$10$.ZeJt7Yt0dwGGfjJr1zIfeGuyhS1MlF5PTzsXmd68xrCSIZsCElXu', 'admind-halodek', 'admind-halodek@mail.unpas', 'admind-halodek', 'admind-halodek', 'admind'),
(19, 'perbaharui', '$2y$10$hi8JcAImIuWlovANAB3be.6RA0bQr2QBJg4k6SpYpyDpORwSVNYQ2', 'perbaharui', 'perbaharui@b.com', 'perbaharui', 'perbaharui', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admind`
--
ALTER TABLE `admind`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_barang_kategori` (`kategori_id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `keranjang_belanja`
--
ALTER TABLE `keranjang_belanja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `keranjang_belanja_ibfk_1` (`user_id`),
  ADD KEY `keranjang_belanja_ibfk_2` (`barang_id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `keranjang_id` (`keranjang_id`),
  ADD KEY `barang_id` (`barang_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admind`
--
ALTER TABLE `admind`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `keranjang_belanja`
--
ALTER TABLE `keranjang_belanja`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `fk_barang_kategori` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`);

--
-- Ketidakleluasaan untuk tabel `keranjang_belanja`
--
ALTER TABLE `keranjang_belanja`
  ADD CONSTRAINT `keranjang_belanja_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keranjang_belanja_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`keranjang_id`) REFERENCES `keranjang_belanja` (`id`),
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`),
  ADD CONSTRAINT `pembayaran_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
