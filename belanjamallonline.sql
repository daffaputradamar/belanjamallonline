-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2021 at 03:52 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `belanjamallonline`
--

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id`, `id_user`, `id_produk`, `jumlah`) VALUES
(40, 2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL DEFAULT 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nisl tortor, ultrices vel cursus vitae, viverra sit amet erat. Suspendisse libero mauris, vehicula non ante sed, porta pharetra leo. Cras nec justo ipsum. Nulla tempor nulla sit amet tincidunt aliquam. Fusce tempor odio eu eros egestas eleifend. Nam mattis finibus nibh cursus accumsan. Praesent quam urna, pulvinar sit amet ex quis, bibendum efficitur mi. Sed pulvinar sem eu arcu pharetra euismod.',
  `berat` decimal(10,2) NOT NULL DEFAULT 10.00,
  `kategori` varchar(50) NOT NULL DEFAULT 'kategori_produk',
  `merk` varchar(50) NOT NULL DEFAULT 'merk_produk',
  `is_promo` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `harga`, `gambar`, `deskripsi`, `berat`, `kategori`, `merk`, `is_promo`) VALUES
(1, 'Playstation 5', 14300000, 'gambar_1.jpg', '<h6>Box Content:</h6>\r\n            <ul>\r\n                <li class=\"mb-2\">1x PlayStation 5 Console Disc Version</li>\r\n                <li class=\"mb-2\">1x Dualsense Wireless Controller PS5</li>\r\n                <li class=\"mb-2\">1x USB Charging Cable</li>\r\n                <li class=\"mb-2\">1x HDMI Cable</li>\r\n                <li class=\"mb-2\">1x AC power cord</li>\r\n                <li class=\"mb-2\">1x Manual Book</li>\r\n            </ul>', '8.00', 'Elektronik', 'Sony', 1),
(2, 'Yyeezy 350 v2', 2300000, 'gambar_2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nisl tortor, ultrices vel cursus vitae, viverra sit amet erat. Suspendisse libero mauris, vehicula non ante sed, porta pharetra leo. Cras nec justo ipsum. Nulla tempor nulla sit amet tincidunt aliquam. Fusce tempor odio eu eros egestas eleifend. Nam mattis finibus nibh cursus accumsan. Praesent quam urna, pulvinar sit amet ex quis, bibendum efficitur mi. Sed pulvinar sem eu arcu pharetra euismod.', '10.00', 'kategori_produk', 'merk_produk', 1),
(3, 'Nike Airmax', 1850000, 'gambar_3.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nisl tortor, ultrices vel cursus vitae, viverra sit amet erat. Suspendisse libero mauris, vehicula non ante sed, porta pharetra leo. Cras nec justo ipsum. Nulla tempor nulla sit amet tincidunt aliquam. Fusce tempor odio eu eros egestas eleifend. Nam mattis finibus nibh cursus accumsan. Praesent quam urna, pulvinar sit amet ex quis, bibendum efficitur mi. Sed pulvinar sem eu arcu pharetra euismod.', '10.00', 'kategori_produk', 'merk_produk', 1),
(4, 'Blush On Maybelline', 300000, 'gambar_4.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nisl tortor, ultrices vel cursus vitae, viverra sit amet erat. Suspendisse libero mauris, vehicula non ante sed, porta pharetra leo. Cras nec justo ipsum. Nulla tempor nulla sit amet tincidunt aliquam. Fusce tempor odio eu eros egestas eleifend. Nam mattis finibus nibh cursus accumsan. Praesent quam urna, pulvinar sit amet ex quis, bibendum efficitur mi. Sed pulvinar sem eu arcu pharetra euismod.', '10.00', 'kategori_produk', 'merk_produk', 1),
(5, 'Tas Sekolah - Navy', 240000, 'gambar_5.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nisl tortor, ultrices vel cursus vitae, viverra sit amet erat. Suspendisse libero mauris, vehicula non ante sed, porta pharetra leo. Cras nec justo ipsum. Nulla tempor nulla sit amet tincidunt aliquam. Fusce tempor odio eu eros egestas eleifend. Nam mattis finibus nibh cursus accumsan. Praesent quam urna, pulvinar sit amet ex quis, bibendum efficitur mi. Sed pulvinar sem eu arcu pharetra euismod.', '10.00', 'kategori_produk', 'merk_produk', 0),
(6, 'Sepatu Tali Elizabeth', 560000, 'gambar_6.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nisl tortor, ultrices vel cursus vitae, viverra sit amet erat. Suspendisse libero mauris, vehicula non ante sed, porta pharetra leo. Cras nec justo ipsum. Nulla tempor nulla sit amet tincidunt aliquam. Fusce tempor odio eu eros egestas eleifend. Nam mattis finibus nibh cursus accumsan. Praesent quam urna, pulvinar sit amet ex quis, bibendum efficitur mi. Sed pulvinar sem eu arcu pharetra euismod.', '10.00', 'kategori_produk', 'merk_produk', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `produk_ongkos` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `tgl_pembelian` timestamp NOT NULL DEFAULT current_timestamp(),
  `kurir` varchar(255) NOT NULL,
  `kurir_ongkos` int(11) NOT NULL,
  `jenis_pembayaran` varchar(200) NOT NULL,
  `jumlah_produk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_produk`, `total_bayar`, `produk_ongkos`, `status`, `tgl_pembelian`, `kurir`, `kurir_ongkos`, `jenis_pembayaran`, `jumlah_produk`, `id_user`) VALUES
(5, 1, 28856000, 28600000, 3, '2021-08-13 13:41:58', 'JNE(Reguler)_2-3 hari kerja', 256000, 'bri', 2, 2),
(6, 2, 2516000, 2300000, 1, '2021-08-13 13:42:51', 'AnterAja_3-4 hari kerja', 216000, 'bri', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `nama` varchar(250) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `no_hp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `nama`, `tgl_lahir`, `jenis_kelamin`, `no_hp`) VALUES
(2, 'daffaputradamar@gmail.com', '123', 'Daffa Akbar Dwiputra Damarriyanto', '2021-08-04', 'Laki-laki', '085755557954');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
