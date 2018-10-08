-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2018 at 02:59 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apotik`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `no_primary` int(4) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `alamat` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`no_primary`, `nama`, `no_telp`, `jenis_kelamin`, `alamat`) VALUES
(1, 'H. Loki', '088218000084', 'laki - laki', 'jalan dimana ya'),
(2, 'Koli Lintang', '081234567890', 'laki - laki', 'Jalan di bandung nomor 192029'),
(12, 'H. Lulung', '082131312212', 'laki - laki', 'Jalan lulung');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `no_primary` int(4) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `alamat` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`no_primary`, `nama`, `no_telp`, `jenis_kelamin`, `alamat`) VALUES
(1, 'Karyawan Baik', '082121212121', 'laki - laki', 'Jalan di apotik'),
(6, 'Karyawan Jahat', '082137121739', 'laki - laki', 'Jalan di rumah sakit');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `no_obat` int(4) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `jenis_obat` varchar(50) NOT NULL,
  `harga` int(10) NOT NULL,
  `stok` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`no_obat`, `nama_obat`, `jenis_obat`, `harga`, `stok`) VALUES
(1, 'Anti Maag', 'Pereda Nyeri', 5400, 53),
(4, 'Paracet', 'Pereda Nyeri', 2345, 490);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `no_primary` int(4) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `alamat` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`no_primary`, `nama`, `no_telp`, `jenis_kelamin`, `alamat`) VALUES
(1, 'Komeng', '085822333459', 'laki - laki', 'Jalan jalan, Bandung, Jawa Barat'),
(3, 'Ahmad Albabe', '089887652188', 'laki - laki', 'Jalan babik kecil dirumah');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `no_transaksi` int(4) NOT NULL,
  `tanggal_transaksi` varchar(20) NOT NULL,
  `no_pelanggan` int(4) NOT NULL,
  `no_karyawan` int(4) NOT NULL,
  `no_dokter` int(4) NOT NULL,
  `no_obat` int(4) NOT NULL,
  `jumlah_obat` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`no_transaksi`, `tanggal_transaksi`, `no_pelanggan`, `no_karyawan`, `no_dokter`, `no_obat`, `jumlah_obat`) VALUES
(1, '27/9/2018', 1, 1, 1, 1, 3),
(6, '06/10/2018', 3, 1, 2, 4, 13),
(8, '06/10/2018', 3, 1, 1, 1, 2),
(10, '08/10/2018', 1, 6, 12, 4, 53);

--
-- Triggers `transaksi`
--
DELIMITER $$
CREATE TRIGGER `UpdateStokAfterDeleteTransaksi` AFTER DELETE ON `transaksi` FOR EACH ROW BEGIN
    UPDATE obat o 
	SET o.stok = o.stok + OLD.jumlah_obat
	WHERE o.no_obat = OLD.no_obat;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UpdateStokAfterInsertTransaksi` AFTER INSERT ON `transaksi` FOR EACH ROW BEGIN
    UPDATE obat o 
	SET o.stok = o.stok - NEW.jumlah_obat
	WHERE o.no_obat = NEW.no_obat;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`no_primary`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`no_primary`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`no_obat`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`no_primary`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`no_transaksi`),
  ADD KEY `foreign_dokter` (`no_dokter`),
  ADD KEY `foreign_karyawan` (`no_karyawan`),
  ADD KEY `foreign_obat` (`no_obat`),
  ADD KEY `foreign_pelanggan` (`no_pelanggan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `no_primary` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `no_primary` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `no_obat` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `no_primary` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `no_transaksi` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `foreign_dokter` FOREIGN KEY (`no_dokter`) REFERENCES `dokter` (`no_primary`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_karyawan` FOREIGN KEY (`no_karyawan`) REFERENCES `karyawan` (`no_primary`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_obat` FOREIGN KEY (`no_obat`) REFERENCES `obat` (`no_obat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_pelanggan` FOREIGN KEY (`no_pelanggan`) REFERENCES `pelanggan` (`no_primary`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
