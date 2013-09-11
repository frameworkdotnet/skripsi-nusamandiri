-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 26, 2013 at 07:11 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_starkonveksi`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE IF NOT EXISTS `administrator` (
  `user_id` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`nama`,`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`user_id`, `nama`, `email`, `password`, `status`) VALUES
(1, 'George Harrison', 'setoelkahfi@gmail.com', '93279e3308bdbbeed946fc965017f67a', 1),
(2, 'Sir Seto El Kahfi', 'setoelkahfi@yahoo.co.id', 'e10adc3949ba59abbe56e057f20f883e', 0);

-- --------------------------------------------------------

--
-- Table structure for table `informasi`
--

CREATE TABLE IF NOT EXISTS `informasi` (
  `informasi_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `isi` text NOT NULL,
  PRIMARY KEY (`informasi_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `informasi`
--

INSERT INTO `informasi` (`informasi_id`, `nama`, `slug`, `isi`) VALUES
(1, 'Tentang Kami', 'tentang-kami', 'INilah tentang kami'),
(2, 'FAQ', 'faq', 'Ini adalah isi dari slug.'),
(3, 'Cara Pengiriman', 'cara-pengiriman', 'Ini adalah cara pengiriman untuk transaksi di toko online kami.'),
(4, 'Kebijakan Privasi', 'kebijakan-privasi', 'Kebijakan privasi anda saat menggunakan layanan di toko online kami.');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `kategori_id` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(250) NOT NULL,
  `deskripsi` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`kategori_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `nama`, `deskripsi`, `status`) VALUES
(1, 'Sprei', 'sdsdsdsds', 1),
(2, 'Sarung Bantal', 'Segalanya tentang kategori sarung bantal', 1);

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi`
--

CREATE TABLE IF NOT EXISTS `konfirmasi` (
  `pesanan_id` int(5) NOT NULL,
  `metode_pembayaran` varchar(30) NOT NULL,
  `no_rekening` int(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_bayar` int(20) NOT NULL,
  `cek` tinyint(1) NOT NULL,
  UNIQUE KEY `pesanan_id` (`pesanan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konfirmasi`
--

INSERT INTO `konfirmasi` (`pesanan_id`, `metode_pembayaran`, `no_rekening`, `nama`, `tanggal`, `jumlah_bayar`, `cek`) VALUES
(1, 'Transfer e-banking', 2147483647, 'Gatot Subroto', '2013-06-12', 200000, 1),
(2, 'Transfer ATM', 0, 'Gaston Castano', '0000-00-00', 0, 0),
(23, 'Transfer ATM', 11111111, 'Andy Murray', '2013-07-04', 12000000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE IF NOT EXISTS `kota` (
  `provinsi_id` int(2) NOT NULL,
  `kota_id` int(3) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `ongkos_kirim` int(10) NOT NULL,
  PRIMARY KEY (`kota_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`provinsi_id`, `kota_id`, `nama`, `ongkos_kirim`) VALUES
(1, 1, 'Jakarta Pusat', 13000),
(3, 2, 'Bandung', 13500),
(4, 3, 'Semarang', 10000),
(1, 4, 'Jakarta Barat', 20000),
(1, 5, 'Jakarta Utara', 25000),
(1, 6, 'Jakarta Selatan', 17500),
(1, 7, 'Jakarta Timur', 18500),
(2, 8, 'Tangerang', 19500),
(3, 9, 'Bekasi', 10000),
(3, 10, 'Bogor', 23000),
(6, 11, 'Surabaya', 13000),
(5, 12, 'Bantul', 10000),
(5, 13, 'Sleman', 12000),
(7, 14, 'Denpasar', 20000),
(7, 15, 'Kuta', 25000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `pelanggan_id` int(5) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kota_id` int(5) NOT NULL,
  `provinsi_id` int(2) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `key` varchar(50) NOT NULL,
  PRIMARY KEY (`pelanggan_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`pelanggan_id`, `email`, `password`, `nama`, `alamat`, `kota_id`, `provinsi_id`, `status`, `key`) VALUES
(2, 'setoelkahfi@yahoo.co.id', '96e79218965eb72c92a549dd5a330112', 'John Winston Lennon', 'Jl. Sudirman Kav. 7 No. 3\r\nKuningan', 1, 1, 1, ''),
(3, 'setoelkahfi@propanraya.com', 'e10adc3949ba59abbe56e057f20f883e', 'Paul Mc. Cartney', 'Abbey Road avenue, 657', 3, 4, 1, ''),
(6, 'setoelkahfi@gmail.com', '', 'Seto El Kahfi', '', 8, 2, 0, ''),
(7, 'seto.elkahfi@propanraya.com', '', 'Muhammad Ramdhani', '', 1, 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE IF NOT EXISTS `pesanan` (
  `pesanan_id` int(5) NOT NULL AUTO_INCREMENT,
  `pelanggan_id` int(5) NOT NULL,
  `alamat` varchar(250) COLLATE latin1_general_ci NOT NULL,
  `kode_pos` int(6) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT 'Baru',
  `tgl` date NOT NULL,
  `jam` time NOT NULL,
  `kota_id` int(3) NOT NULL,
  `provinsi_id` int(2) NOT NULL,
  PRIMARY KEY (`pesanan_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=35 ;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`pesanan_id`, `pelanggan_id`, `alamat`, `kode_pos`, `total`, `status`, `tgl`, `jam`, `kota_id`, `provinsi_id`) VALUES
(1, 2, 'Jl. Tengiri Raya No.1 Yogyakarta 55581', 15810, 200000, 'Dikirim', '2013-06-01', '09:17:17', 6, 1),
(2, 2, 'Jl. Tengiri Raya No.1 Yogyakarta 55581', 43220, 500000, 'Lunas', '2013-06-07', '09:18:24', 4, 1),
(18, 2, 'Jl. S. Parman No. 3', 15834, 100000, 'Baru', '2013-06-28', '21:38:09', 6, 1),
(23, 3, 'Jl Gatot Subroto Km 2', 23330, 150000, 'Ditutup', '2013-07-02', '22:19:43', 12, 5),
(22, 2, 'Jl. S. Parman No. 3', 15334, 30000, 'Baru', '2013-07-04', '22:15:02', 6, 1),
(33, 7, 'ssdasdasd', 121212, 212740, 'Baru', '2013-07-16', '00:30:03', 1, 1),
(34, 7, 'ttest', 13213, 424610, 'Baru', '2013-07-17', '13:37:50', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_detail`
--

CREATE TABLE IF NOT EXISTS `pesanan_detail` (
  `pesanan_id` int(5) NOT NULL,
  `produk_id` int(5) NOT NULL,
  `jumlah` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan_detail`
--

INSERT INTO `pesanan_detail` (`pesanan_id`, `produk_id`, `jumlah`) VALUES
(1, 1, 90),
(1, 4, 2),
(1, 2, 3),
(2, 6, 1),
(2, 1, 1),
(7, 1, 6),
(9, 5, 1),
(9, 11, 1),
(9, 9, 1),
(12, 11, 1),
(13, 8, 1),
(18, 14, 1),
(18, 11, 1),
(19, 14, 1),
(19, 11, 1),
(20, 14, 1),
(20, 11, 1),
(21, 14, 1),
(21, 11, 1),
(22, 14, 1),
(22, 11, 1),
(23, 10, 1),
(24, 10, 2),
(34, 8, 1),
(34, 10, 1),
(33, 10, 1),
(32, 12, 1),
(31, 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
  `produk_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `feature` tinyint(1) NOT NULL,
  `harga` float NOT NULL,
  `berat` float NOT NULL,
  `stok` int(5) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`produk_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`produk_id`, `nama`, `deskripsi`, `gambar`, `kategori_id`, `feature`, `harga`, `berat`, `stok`, `status`) VALUES
(1, 'Sprei Star Green Apple', 'Bekas dari kelurahan. Dulu dipakai oleh gubernur Jenderal Van Hottman.', '1.-Green-Apple_STR-96115.G.jpg', 1, 1, 250000, 0.5, 10, 1),
(2, 'Sprei Star Lighting Mc-Queen', 'Deskripsi panjang untuk kemeja santai, ini adalah kemeja santai Deskripsi panjang untuk kemeja santai, ini adalah kemeja santai Deskripsi panjang untuk kemeja santai, ini adalah kemeja santai Deskripsi panjang untuk kemeja santai, ini adalah kemeja santai Deskripsi panjang untuk kemeja santai, ini adalah kemeja santai Deskripsi panjang untuk kemeja santai, ini adalah kemeja santai Deskripsi panjang untuk kemeja santai, ini adalah kemeja santai Deskripsi panjang untuk kemeja santai, ini adalah kemeja santai ', 'Jual-Sprei-Cars-Mc-Queen-indonesia.jpg', 1, 1, 255000, 0.75, 10, 1),
(3, 'RUmah idaman', '																																								<p>Deskripsi singkat Blouse POutihDeskripsi singkat Blouse POutihDeskripsi singkat Blouse POutihDeskripsi singkat Blouse POutihDeskripsi singkat Blouse POutihDeskripsi singkat Blouse POutihDeskripsi singkat Blouse POutihDeskripsi singkat Blouse POutihDeskripsi singkat Blouse POutihDeskripsi singkat Blouse POutihDeskripsi singkat Blouse POutihDeskripsi singkat Blouse POutihDeskripsi singkat Blouse POutihDeskripsi singkat Blouse POutihDeskripsi singkat Blouse POutihDeskripsi singkat Blouse POutihDeskripsi singkat Blouse POutih																																																																																										', 'Rumah_idaman_Type_300.jpg', 1, 0, 180000, 0.56, 10, 1),
(4, 'Sprei Star Motif Warna Coklat', 'Deskripsi lengkap Celana Boxer Deskripsi lengkap Celana Boxer Deskripsi lengkap Celana Boxer Deskripsi lengkap Celana Boxer Deskripsi lengkap Celana Boxer Deskripsi lengkap Celana Boxer Deskripsi lengkap Celana Boxer Deskripsi lengkap Celana Boxer Deskripsi lengkap Celana Boxer Deskripsi lengkap Celana Boxer Deskripsi lengkap Celana Boxer ', 'brown-sprei-star.jpg', 2, 0, 200000, 0.9, 10, 1),
(5, 'My Star Sprei Spongebob Kuning', 'Deskripsi panjang Celana Jeans Deskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana Jeans', 'mystarspongebobbigactionpanel.jpg', 1, 0, 180000, 1.2, 10, 1),
(6, 'Sprei Star Model Rosetta', 'Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey ', 'Rosetta_221112061150_ll.jpg', 2, 0, 180000, 0.45, 10, 1),
(7, 'Sprei Star Vanity Rose', 'Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux  Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux  Deskripsi singkat Kaos Linux  Deskripsi singkat Kaos Linux  Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux ', 'VanityRose_221112081155_ll.jpg', 0, 0, 220000, 0.78, 10, 1),
(8, 'Hello Kitty Sprei Star', 'Deskripsi panjang Celana Jeans Deskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana Jeans', 'HK-Balerina-hello-kity-ungu.jpg', 1, 0, 199000, 0.99, 10, 1),
(9, 'Sprei Star My Star Spongebob', 'Deskripsi panjang Celana Jeans Deskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana JeansDeskripsi panjang Celana Jeans', 'mystarspongebobbigactionpanel.jpg', 1, 0, 210000, 0.68, 10, 1),
(10, 'Sprei Star Edisi Lebaran Manchester United', 'Sprei Star kembali hadir dengan motif desain terbaru dengan tema tim sepakbola, Manchester United. Dengan bahan yang nyaman untuk tidur.', 'MURenette-manchester-united-merah.jpg', 1, 1, 200000, 0.98, 10, 1),
(11, 'Sprei Star MU Merah', 'Deskripsi panjang untuk kemeja santai, ini adalah kemeja santai Deskripsi panjang untuk kemeja santai, ini adalah kemeja santai Deskripsi panjang untuk kemeja santai, ini adalah kemeja santai Deskripsi panjang untuk kemeja santai, ini adalah kemeja santai Deskripsi panjang untuk kemeja santai, ini adalah kemeja santai Deskripsi panjang untuk kemeja santai, ini adalah kemeja santai Deskripsi panjang untuk kemeja santai, ini adalah kemeja santai Deskripsi panjang untuk kemeja santai, ini adalah kemeja santai ', 'MURenette-manchester-united-merah-darah.jpg', 1, 1, 200000, 0.55, 10, 1),
(12, 'Sprei Star Shaun The Sheep Kuning', 'Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey Deskripsi singkat Kaos Jersey ', 'shaun-the-sheep-kuning.jpg', 2, 0, 185000, 0.67, 10, 1),
(13, 'Sprei Star Shaun The Sheep Biru', 'Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux  Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux  Deskripsi singkat Kaos Linux  Deskripsi singkat Kaos Linux  Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux ', 'shaun-the-sheep-biru.jpg', 1, 0, 185000, 0.34, 10, 1),
(14, 'Sprei Star Edisi Liverpool Merah Biru', 'Bekas dari kelurahan. Dulu dipakai oleh gubernur Jenderal Van Hottman.', 'Liverpool-merah-biru.jpg', 1, 1, 190000, 0.24, 10, 1),
(15, 'Sprei Star Juventus Hitam Putih', 'Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux  Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux  Deskripsi singkat Kaos Linux  Deskripsi singkat Kaos Linux  Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux Deskripsi singkat Kaos Linux ', 'Juventus-putih-hitam.jpg', 1, 0, 190000, 0.45, 10, 1),
(16, 'Sarung Bantal Ungu Motif Bunga', 'Sarung bantal ini adalah sarung bantal unik berwarna ungu dengan desain bunga yang menarik', 'sarung-bantal-ungu-bunga.jpg', 2, 1, 90000, 0.5, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk_review`
--

CREATE TABLE IF NOT EXISTS `produk_review` (
  `review_id` int(3) NOT NULL AUTO_INCREMENT,
  `pelanggan_id` int(5) NOT NULL,
  `isi` longtext NOT NULL,
  `produk_id` int(3) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `produk_review`
--

INSERT INTO `produk_review` (`review_id`, `pelanggan_id`, `isi`, `produk_id`, `status`, `tanggal`, `jam`) VALUES
(1, 2, 'Ting ting ting', 16, 0, '2013-06-19', '14:17:35'),
(2, 3, 'Agak lama sih proses pengiriminannya, tapi bagus kok barangnya', 16, 1, '2013-06-23', '14:18:33');

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE IF NOT EXISTS `provinsi` (
  `provinsi_id` int(2) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  PRIMARY KEY (`provinsi_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`provinsi_id`, `nama`) VALUES
(1, 'DKI Jakarta'),
(2, 'Banten'),
(3, 'Jawa Barat'),
(4, 'Jawa Tengah'),
(5, 'DI Yogyakarta'),
(6, 'Jawa Timur'),
(7, 'Bali');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('445100f2afe9c2dc8e58a9b55669d429', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', 1374042158, 'a:3:{s:12:"pelanggan_id";s:1:"6";s:5:"email";s:21:"setoelkahfi@gmail.com";s:4:"nama";s:13:"Seto El Kahfi";}'),
('99d04e8ae6ba25160709b2098b939dd7', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:22.0) Gecko/20100101 Firefox/22.0', 1374042810, 'a:4:{s:9:"user_data";s:0:"";s:12:"pelanggan_id";s:1:"7";s:5:"email";s:27:"seto.elkahfi@propanraya.com";s:4:"nama";s:17:"Muhammad Ramdhani";}');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
