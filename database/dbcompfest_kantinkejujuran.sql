-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jul 2022 pada 19.48
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbcompfest_kantinkejujuran`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `saldo`
--

CREATE TABLE `saldo` (
  `id_saldo` int(11) NOT NULL,
  `saldo_toko` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `saldo`
--

INSERT INTO `saldo` (`id_saldo`, `saldo_toko`) VALUES
(10, 319000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(5) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nama_siswa`, `password`) VALUES
(12104, 'Ulfa', '$2y$10$lwH3Aiwov1gi.yzB/T1HJOim/mbz3OUS3Y0db30ZYS/doCviWaB3q'),
(12306, 'Yusuf', '$2y$10$jA7bCnsy8dNbTMYIFzMl1uk2p1FokhcNqfe1QM7DbqZN516SfgoIC');

-- --------------------------------------------------------

--
-- Struktur dari tabel `toko`
--

CREATE TABLE `toko` (
  `id_produk` int(11) NOT NULL,
  `id_siswa` int(5) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `gambar_produk` varchar(50) NOT NULL,
  `deskripsi_produk` varchar(255) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `waktu_produk_ditambahkan` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `toko`
--

INSERT INTO `toko` (`id_produk`, `id_siswa`, `nama_produk`, `gambar_produk`, `deskripsi_produk`, `harga_produk`, `waktu_produk_ditambahkan`, `status`) VALUES
(15, 12306, 'Brownies Tiramisu Marble', '1.jpg', 'Rasa manis, gurih dan pahit berpadu dengan aroma kopi krim yang kuat dari cokelatnya dan rasa gurih yang berasal dari kacang almond ditambah dengan rasa asam dari kismis. Membuat produk ini kaya akan rasa.', 56000, '2022-07-07 08:34:37', 'dijual'),
(17, 12104, 'Brownies Bakar', '2.jpg', 'Rasa unik dari Brownies ini tetap dominan cokelat, dipadukan dengan rasa keju bakar dan kacang almond yang gurih serta manisnya butiran cokelat chip dan ada rasa asam yang segar berasal dari kismis.', 50000, '2022-07-09 01:45:44', 'dijual'),
(19, 12306, 'Brownies Banana Cheese', '3.jpg', 'Rasa dominan dari brownies ini adalah rasa pisang bercampur dengan rasa biskuit yang berada diantara lapisan Brownies kukus Original dengan Topping pisang. Rasa manis juga dihasilkan dari buah cherry di atasnya.', 52000, '2022-07-07 13:31:09', 'dijual'),
(20, 12306, 'Brownies Blueberry', '4.jpg', 'Lapisan topping mempunyai rasa manis dan asam yang segar dengan aroma blueberry, rasa gurih dan pahit yang didapat dari lapisan Brownies kukus original. Toppingnya lebih padat dan terdapat butiran blueberry yang mana akan terlihat ketika dipotong.', 54000, '2022-07-08 05:32:04', 'dijual'),
(21, 12104, 'Brownies Choco Marble', '5.jpg', 'Rasa brownies ini cenderung lebih manis. Akan tetapi bagi yang sangat menggemari cokelat, brownies ini menyuguhkan rasa cokelat yang menyatu antara rasa manis, gurih dan pahit. Terdapat topping dengan motif marble berwarna cokelat dan putih.', 53000, '2022-07-10 09:33:08', 'dijual'),
(22, 12104, 'Brownies Pink Marble', '6.jpg', 'Rasa dari produk ini cenderung manis dan beraroma buah strawberry yang sangat kuat berpadu dengan rasa manis, gurih dan pahit dari lapisan originalnya. Terdapat topping cokelat berwarna pink dengan motif marble berwarna cokelat.', 54000, '2022-07-10 09:33:45', 'dijual');

--
-- Trigger `toko`
--
DELIMITER $$
CREATE TRIGGER `after_add_item` AFTER INSERT ON `toko` FOR EACH ROW BEGIN
	UPDATE saldo SET saldo_toko = saldo_toko + NEW.harga_produk WHERE 		id_saldo = 10;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_buy_item` AFTER UPDATE ON `toko` FOR EACH ROW BEGIN
    UPDATE saldo SET saldo_toko = saldo_toko - OLD.harga_produk
    WHERE id_saldo = 10;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_withdraw` AFTER DELETE ON `toko` FOR EACH ROW BEGIN
	UPDATE saldo SET saldo_toko = saldo_toko - OLD.harga_produk WHERE 		id_saldo = 10;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `saldo`
--
ALTER TABLE `saldo`
  ADD PRIMARY KEY (`id_saldo`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indeks untuk tabel `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `add_foreign_key` (`id_siswa`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `saldo`
--
ALTER TABLE `saldo`
  MODIFY `id_saldo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `toko`
--
ALTER TABLE `toko`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `toko`
--
ALTER TABLE `toko`
  ADD CONSTRAINT `add_foreign_key` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
