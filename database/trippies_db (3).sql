-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 09 Nov 2018 pada 01.58
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trippies_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` varchar(30) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `kota` varchar(10) NOT NULL,
  `foto_profil` varchar(50) NOT NULL,
  `foto_sampul` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama_admin`, `kota`, `foto_profil`, `foto_sampul`, `username`, `email`, `password`) VALUES
('ADM231020181', 'Rafi Fauzi', '23', 'admin.jpg', 'admin-sampul.jpg', 'admin', 'trippiesbdg@gmail.com', 'Trippies22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bank`
--

CREATE TABLE `tb_bank` (
  `id_bank` varchar(10) NOT NULL,
  `nama_bank` varchar(30) NOT NULL,
  `nama_pemilik` varchar(50) NOT NULL,
  `no_rek` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_bank`
--

INSERT INTO `tb_bank` (`id_bank`, `nama_bank`, `nama_pemilik`, `no_rek`) VALUES
('008', 'Bank BCA', 'Virna', '12345678910'),
('009', 'Bank BNI', 'Rafi', '12345678910');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` varchar(30) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `stok` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `kondisi` tinyint(1) NOT NULL,
  `dilihat` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `tgl_upload` date NOT NULL,
  `id_kategori` varchar(10) NOT NULL,
  `pemilik` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `nama_barang`, `stok`, `berat`, `harga_beli`, `harga_jual`, `kondisi`, `dilihat`, `deskripsi`, `tgl_upload`, `id_kategori`, `pemilik`) VALUES
('BR071120181', 'Gantungan Handphone / Gantungan Kunci Disney Cute Fashion Accesories', 22, 150, 15000, 15300, 1, 101, 'Gantungan Boneka \r\nBisa dijadikan Gantungan Kunci dan juga bisa dijadikan Gantungan Handphone\r\n\r\nItem yang sangat Imut \r\nHanya tersedia 3 model seperti digambar ya...\r\n\r\nHarap tanyakan stok terlebih dahulu sebelum memesan\r\n\r\nWajib cantumkan nama boneka di catatan atau random', '2018-11-07', 'KB2', 'S271020181'),
('BR071120182', 'Topi Baymax Eyes By Crion', 27, 150, 35000, 35700, 1, 10, 'Topi Jaring Tipe Trucker\r\n\r\nSablon mengunakan Sablon Flock Timbul (memberikan Effect Timbul cocok untuk penganti bordir dengan daya tahan tinggi)\r\n\r\nall size (Size dapat diatur)\r\n\r\nWarna sesuai gambar', '2018-11-07', 'KB2', 'S271020181'),
('BR081120181', 'Gantungan Kunci Baymax', 50, 120, 20000, 20400, 1, 5, 'Gantungan Kunci Baymax', '2018-11-08', 'KB2', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_blog`
--

CREATE TABLE `tb_blog` (
  `id_user` varchar(255) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `lokasi` text NOT NULL,
  `harga_max` int(10) NOT NULL,
  `harga_min` int(10) NOT NULL,
  `cerita` text NOT NULL,
  `tgl_upload` date NOT NULL,
  `gambar1` varchar(255) NOT NULL,
  `gambar2` varchar(255) NOT NULL,
  `gambar3` varchar(255) NOT NULL,
  `gambar4` varchar(255) NOT NULL,
  `id_kategori` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_blog`
--

INSERT INTO `tb_blog` (`id_user`, `judul`, `lokasi`, `harga_max`, `harga_min`, `cerita`, `tgl_upload`, `gambar1`, `gambar2`, `gambar3`, `gambar4`, `id_kategori`) VALUES
('S271020181', 'Ranca Upas', 'Bandung , Jawa Barat', 35000, 15000, 'Ranca Upas atau Kampung Cai Ranca Upas adalah salah satu bumi perkemahan di Bandung, Jawa Barat, Indonesia. Terletak di Jalan Raya Ciwidey Patenggang KM. 11, Alam Endah, Ciwidey Kabupaten Bandung, dengan jarak sekitar 50 km dari pusat Kota Bandung', '2018-11-03', 'S271020181-1.jpg', 'S271020181-2.jpg', 'S271020181-3.jpg', 'S271020181-4.jpg', 'KS4'),
('S271020181', 'Teman Yang Ngidam Pergi Ke Cililin', 'Cililin , Jawa Barat', 123, 123, 'Teman Yang Ngidam Pergi Ke CililinTeman Yang Ngidam Pergi Ke CililinTeman Yang Ngidam Pergi Ke CililinTeman Yang Ngidam Pergi Ke CililinTeman Yang Ngidam Pergi Ke Cililin', '2018-11-08', 'S27102018135-1.jpg', 'S27102018135-2.jpg', 'S27102018135-3.jpg', 'S27102018135-4.jpg', 'KS4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_booking`
--

CREATE TABLE `tb_booking` (
  `id_booking` varchar(255) NOT NULL,
  `id_trip` varchar(30) NOT NULL,
  `id_user` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `bukti_trf` varchar(30) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_booking`
--

INSERT INTO `tb_booking` (`id_booking`, `id_trip`, `id_user`, `harga`, `status`, `tgl_bayar`, `bukti_trf`, `keterangan`) VALUES
('BOOK291020181', 'TR291020181', 'S291020182', 2500000, 2, '2018-11-03', 'BOOK291020181-buktitrf.jpg', ''),
('BOOK291020182', 'TR291020181', 'S271020181', 2500000, 0, '2018-11-03', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail-keranjang`
--

CREATE TABLE `tb_detail-keranjang` (
  `id_keranjang` varchar(30) NOT NULL,
  `id_barang` varchar(30) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail-ngiklan`
--

CREATE TABLE `tb_detail-ngiklan` (
  `no_iklan` varchar(30) NOT NULL,
  `id_iklan` varchar(15) NOT NULL,
  `id_user` varchar(30) NOT NULL,
  `tgl_pasang` date NOT NULL,
  `tgl_habis` date NOT NULL,
  `lama_pasang` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `total_pasang` int(11) NOT NULL,
  `status_aktif` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_detail-ngiklan`
--

INSERT INTO `tb_detail-ngiklan` (`no_iklan`, `id_iklan`, `id_user`, `tgl_pasang`, `tgl_habis`, `lama_pasang`, `tgl_transaksi`, `total_pasang`, `status_aktif`) VALUES
('IK031120181', 'IK1', 'S291020182', '2018-11-03', '2018-11-05', 2, '0000-00-00', 40000, '1'),
('IK091120183', 'IK2A', 'S271020181', '2018-11-09', '2018-11-12', 3, '0000-00-00', 60000, '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail-transaksi`
--

CREATE TABLE `tb_detail-transaksi` (
  `no_invoice` varchar(255) NOT NULL,
  `id_barang` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_detail-transaksi`
--

INSERT INTO `tb_detail-transaksi` (`no_invoice`, `id_barang`, `qty`) VALUES
('INV081120181', 'BR071120181', 1),
('INV081120182', 'BR071120182', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_gambar_barang`
--

CREATE TABLE `tb_gambar_barang` (
  `id_barang` varchar(30) NOT NULL,
  `gambar` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_gambar_barang`
--

INSERT INTO `tb_gambar_barang` (`id_barang`, `gambar`) VALUES
('BR071120181', 'BR071120181-1.jpg'),
('BR071120181', 'BR071120181-2.jpg'),
('BR071120181', 'BR071120181-3.jpg'),
('BR071120182', 'BR071120182-1.png'),
('BR081120181', 'BR081120181-1.jpg'),
('BR081120181', 'BR081120181-2.jpg'),
('BR081120181', 'BR081120181-3.jpg'),
('BR081120181', 'BR081120181-4.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_gambar_penginapan`
--

CREATE TABLE `tb_gambar_penginapan` (
  `id_penginapan` varchar(30) NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_iklan`
--

CREATE TABLE `tb_iklan` (
  `id_iklan` varchar(5) NOT NULL,
  `nama_iklan` varchar(20) NOT NULL,
  `ukuran` varchar(16) NOT NULL,
  `size` varchar(2) NOT NULL,
  `harga` int(11) NOT NULL,
  `image_iklan` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_iklan`
--

INSERT INTO `tb_iklan` (`id_iklan`, `nama_iklan`, `ukuran`, `size`, `harga`, `image_iklan`) VALUES
('IK1', 'Iklan Pop Up', '2080 x 2080', '2', 20000, 'IK031120181-iklan.jpg'),
('IK2A', 'Iklan Slider Satu', '500 x 333', '2', 20000, 'IK091120183-iklan.jpg'),
('IK2B', 'Iklan Slider Dua', '500 x 333', '2', 18000, 'blank_iklan.jpg'),
('IK2C', 'Iklan Slider Tiga', '500 x 333', '2', 14000, 'blank_iklan.jpg'),
('IK2D', 'Iklan Slider Empat', '500 x 333', '2', 10000, 'blank_iklan.jpg'),
('IK3A', 'Iklan Footer Satu', '500 x 333', '1', 17000, 'blank_iklan.jpg'),
('IK3B', 'Iklan Footer Dua', '500 x 333', '1', 17000, 'blank_iklan.jpg'),
('IK3C', 'Iklan Footer Tiga', '500 x 333', '1', 17000, 'blank_iklan.jpg'),
('IK3D', 'Iklan Footer Empat', '500 x 333', '1', 17000, 'blank_iklan.jpg'),
('IK3E', 'Iklan Footer Lima', '500 x 333', '1', 17000, 'blank_iklan.jpg'),
('IK3F', 'Iklan Footer Enam', '500 x 333', '1', 17000, 'blank_iklan.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` varchar(10) NOT NULL,
  `nama_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `nama_kategori`) VALUES
('KB1', 'Makanan Kering'),
('KB2', 'Merchandise'),
('KB3', 'Peralatan Travelling'),
('KB4', 'Buku'),
('KS1', 'Penginapan'),
('KS2', 'Festival'),
('KS3', 'Transportasi'),
('KS4', 'Tempat Liburan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_keranjang`
--

CREATE TABLE `tb_keranjang` (
  `id_keranjang` varchar(30) NOT NULL,
  `id_user` varchar(255) NOT NULL,
  `total` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_keranjang`
--

INSERT INTO `tb_keranjang` (`id_keranjang`, `id_user`, `total`) VALUES
('K021120183', 'S021120183', 0),
('K031120184', 'S031120184', 0),
('K271020181', 'S271020181', 0),
('K291020182', 'S291020182', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kota`
--

CREATE TABLE `tb_kota` (
  `id_kota` varchar(10) NOT NULL,
  `nama_kota` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kota`
--

INSERT INTO `tb_kota` (`id_kota`, `nama_kota`) VALUES
('23', 'Bandung'),
('24', 'Bandung Barat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ngiklan`
--

CREATE TABLE `tb_ngiklan` (
  `no_iklan` varchar(30) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `bukti_trf` varchar(30) NOT NULL,
  `status` varchar(1) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_ngiklan`
--

INSERT INTO `tb_ngiklan` (`no_iklan`, `tgl_bayar`, `bukti_trf`, `status`, `keterangan`) VALUES
('IK031120181', '2018-11-03', 'IK031120181-buktitrf.png', '3', '-'),
('IK091120183', '2018-11-09', 'IK091120183-buktitrf.jpg', '3', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_opentrip`
--

CREATE TABLE `tb_opentrip` (
  `id_trip` varchar(20) NOT NULL,
  `nama_paket` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `periodeAwal` date NOT NULL,
  `periodeAkhir` date NOT NULL,
  `lokasi` text NOT NULL,
  `deskripsi` text NOT NULL,
  `rute` text NOT NULL,
  `include` text NOT NULL,
  `exclude` text NOT NULL,
  `donts` text NOT NULL,
  `currency` varchar(5) NOT NULL,
  `gambar1` varchar(255) NOT NULL,
  `tgl_upload` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_opentrip`
--

INSERT INTO `tb_opentrip` (`id_trip`, `nama_paket`, `harga`, `periodeAwal`, `periodeAkhir`, `lokasi`, `deskripsi`, `rute`, `include`, `exclude`, `donts`, `currency`, `gambar1`, `tgl_upload`) VALUES
('TR291020181', 'Trip Thailand', 2500000, '2018-03-15', '2018-03-20', 'Thailand', 'Thailand', 'Thailand', 'Thailand', 'Thailand', 'Thailand', 'Baht', 'TR291020181-1.jpg', '2018-10-29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penginapan`
--

CREATE TABLE `tb_penginapan` (
  `id_penginapan` varchar(30) NOT NULL,
  `nama_penginapan` varchar(100) NOT NULL,
  `alamat_penginapan` text NOT NULL,
  `minOrang` int(11) NOT NULL,
  `maxOrang` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `deskripsi_penginapan` text NOT NULL,
  `tanggal_upload` date NOT NULL,
  `booking` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `no_invoice` varchar(255) NOT NULL,
  `id_user` varchar(255) NOT NULL,
  `tgl_order` date NOT NULL,
  `tgl_bayar` date NOT NULL,
  `tgl_kirim` date NOT NULL,
  `sub_total` int(11) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `id_bank` varchar(10) NOT NULL,
  `bukti_trf` varchar(30) NOT NULL,
  `no_resi` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`no_invoice`, `id_user`, `tgl_order`, `tgl_bayar`, `tgl_kirim`, `sub_total`, `ongkir`, `total`, `id_bank`, `bukti_trf`, `no_resi`, `status`, `keterangan`) VALUES
('INV081120181', 'S291020182', '2018-11-08', '0000-00-00', '0000-00-00', 15300, 6000, 21300, '008', '#', '#', 0, '-'),
('INV081120182', 'S291020182', '2018-11-08', '0000-00-00', '0000-00-00', 35700, 9000, 44700, '008', '#', '#', 0, '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` varchar(255) NOT NULL,
  `username` varchar(25) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `birthday` varchar(10) NOT NULL,
  `jk` tinyint(1) NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(50) NOT NULL,
  `kodepos` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(12) NOT NULL,
  `jual` tinyint(1) NOT NULL,
  `foto_profil` varchar(255) NOT NULL,
  `foto_sampul` varchar(255) NOT NULL,
  `password` varchar(8) NOT NULL,
  `pertanyaan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `nama`, `birthday`, `jk`, `alamat`, `kota`, `kodepos`, `email`, `no_hp`, `jual`, `foto_profil`, `foto_sampul`, `password`, `pertanyaan`) VALUES
('S021120183', 'yangfauz', 'Yayang Fauzi Rahmatulah', '1996-8-13', 1, 'Karang Tineung Dalam', '22', '40162', 'yangfauz@gmail.com', '083821255557', 0, 'blank_dp.jpg', 'blank_sampul.jpg', '11223344', ''),
('S031120184', 'uuskasep', 'UUS WIDI', '1974-6-16', 0, 'bandung aja', '23', '40134', 'uus@gmail.com', '134568457841', 0, 'blank_dp.jpg', 'blank_sampul.jpg', '11223344', ''),
('S271020181', 'rafisf', 'Rafi Fauzi', '1996-10-14', 1, 'Jl sadang subur 2', '23', '40134', 'r.fauzix@gmail.com', '085795851996', 1, 'blank_dp.jpg', 'blank_sampul.jpg', '11223344', ''),
('S291020182', 'virnafl', 'Virna Fuji Lestari', '1996-09-22', 0, 'Cihaliwung wetan Rt.04/03 Des.Sukatani Kec.Ngamprah Kab. Bandung Barat                                                                                                                                                                                                                                                                                                                                                                                                            ', '24', '40552', 'virnaflestari@gmail.com', '088802001473', 0, 'S291020182-fp.jpg', 'S291020182-sampul.jpg', '11223344', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_bank`
--
ALTER TABLE `tb_bank`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `tb_blog`
--
ALTER TABLE `tb_blog`
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_user_2` (`id_user`),
  ADD KEY `id_kategori_2` (`id_kategori`);

--
-- Indexes for table `tb_booking`
--
ALTER TABLE `tb_booking`
  ADD PRIMARY KEY (`id_booking`);

--
-- Indexes for table `tb_detail-transaksi`
--
ALTER TABLE `tb_detail-transaksi`
  ADD KEY `no_invoice` (`no_invoice`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `tb_iklan`
--
ALTER TABLE `tb_iklan`
  ADD PRIMARY KEY (`id_iklan`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_kota`
--
ALTER TABLE `tb_kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `tb_ngiklan`
--
ALTER TABLE `tb_ngiklan`
  ADD PRIMARY KEY (`no_iklan`);

--
-- Indexes for table `tb_opentrip`
--
ALTER TABLE `tb_opentrip`
  ADD PRIMARY KEY (`id_trip`);

--
-- Indexes for table `tb_penginapan`
--
ALTER TABLE `tb_penginapan`
  ADD PRIMARY KEY (`id_penginapan`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`no_invoice`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
