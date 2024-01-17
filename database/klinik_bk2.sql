-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 07, 2024 at 06:42 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: klinik_bk
--

-- --------------------------------------------------------

--
-- Table structure for table daftar_poli
--

DROP TABLE IF EXISTS daftar_poli;
CREATE TABLE IF NOT EXISTS daftar_poli (
  id int(11) NOT NULL AUTO_INCREMENT,
  id_pasien int(11) NOT NULL,
  id_jadwal int(11) NOT NULL,
  keluhan text NOT NULL,
  no_antrian int(11) NOT NULL,
  PRIMARY KEY (id),
  KEY fk_daftar_poli_pasien (id_pasien),
  KEY fk_daftar_poli_jadwal (id_jadwal)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table detail_periksa
--

DROP TABLE IF EXISTS detail_periksa;
CREATE TABLE IF NOT EXISTS detail_periksa (
  id int(11) NOT NULL AUTO_INCREMENT,
  id_periksa int(11) NOT NULL,
  id_obat int(11) NOT NULL,
  PRIMARY KEY (id),
  KEY fk_detail_periksa_idperiksa (id_periksa),
  KEY fk_detail_periksa_obat (id_obat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table dokter
--

DROP TABLE IF EXISTS dokter;
CREATE TABLE IF NOT EXISTS dokter (
  id int(50) NOT NULL AUTO_INCREMENT,
  nip int(50) NOT NULL,
  nama varchar(255) NOT NULL,
  alamat varchar(255) NOT NULL,
  no_hp varchar(50) NOT NULL,
  id_poli int(11) NOT NULL,
  password_dok varchar(75) NOT NULL,
  PRIMARY KEY (id),
  KEY fk_dokter_poli (id_poli)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table dokter
--

INSERT INTO dokter (id, nip, nama, alamat, no_hp, id_poli, password_dok) VALUES
(2, 22222, 'Selma', 'Smg', '089765432', 1, 'selma'),
(3, 0, 'sasa', 'jl hamka', '0213131312', 2, ''),
(5, 0, 'jinjii', 'surabaya', '0864453', 6, ''),
(10, 444433, 'kaka', 'sby', '09272732', 6, 'kaka'),
(11, 9876, 'Bian', 'surabaya', '0864453999', 2, 'bian'),
(12, 12121, 'nopal', 'semarang', '085875213', 4, 'nopal'),
(13, 121211, 'didi', 'smg', '0876546', 3, 'didi');

-- --------------------------------------------------------

--
-- Table structure for table jadwal_periksa
--

DROP TABLE IF EXISTS jadwal_periksa;
CREATE TABLE IF NOT EXISTS jadwal_periksa (
  id int(11) NOT NULL AUTO_INCREMENT,
  id_dokter int(11) NOT NULL,
  hari enum('Senin','Selasa','Rabu','Kamis','Jumat') NOT NULL,
  jam_mulai time NOT NULL,
  jam_selesai time NOT NULL,
  PRIMARY KEY (id),
  KEY fj_jadwal_periksa_dokter (id_dokter)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table obat
--

DROP TABLE IF EXISTS obat;
CREATE TABLE IF NOT EXISTS obat (
  id int(11) NOT NULL AUTO_INCREMENT,
  nama_obat varchar(50) NOT NULL,
  kemasan varchar(35) NOT NULL,
  harga int(11) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table obat
--

INSERT INTO obat (id, nama_obat, kemasan, harga) VALUES
(1, 'proris', 'tablet', 9000),
(2, 'Panama', 'tablet', 6000),
(3, 'Panama', 'tablet', 10000),
(10, 'Neoralgine', 'tablet', 17000);

-- --------------------------------------------------------

--
-- Table structure for table pasien
--

DROP TABLE IF EXISTS pasien;
CREATE TABLE IF NOT EXISTS pasien (
  id int(11) NOT NULL AUTO_INCREMENT,
  nama varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  alamat varchar(255) NOT NULL,
  no_ktp varchar(255) NOT NULL,
  no_hp varchar(50) NOT NULL,
  no_rm varchar(25) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table pasien
--

INSERT INTO pasien (id, nama, password, alamat, no_ktp, no_hp, no_rm) VALUES
(1, 'wawan', '12345678', 'jakarta', '876482423', '278348723', '1'),
(2, 'wiwin', '12345678', 'jerakah', '827482642', '08326872122', '2'),
(3, 'Budi', '12345678', 'Semarang', '7823682', '085894483', '3'),
(4, 'biyanvv', '12345678', 'ngaliyan', '02842348726', '28738126312', '4');

-- --------------------------------------------------------

--
-- Table structure for table periksa
--

DROP TABLE IF EXISTS periksa;
CREATE TABLE IF NOT EXISTS periksa (
  id int(11) NOT NULL AUTO_INCREMENT,
  id_daftar_poli int(11) NOT NULL,
  tgl_periksa datetime NOT NULL,
  catatan text NOT NULL,
  biaya_periksa int(11) NOT NULL,
  PRIMARY KEY (id),
  KEY fk_periksa_daftar_poli (id_daftar_poli)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table poli
--

DROP TABLE IF EXISTS poli;
CREATE TABLE IF NOT EXISTS poli (
  id int(11) NOT NULL AUTO_INCREMENT,
  nama_poli varchar(25) NOT NULL,
  keterangan text NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table poli
--

INSERT INTO poli (id, nama_poli, keterangan) VALUES
(1, 'Poli Gigi', 'langsung\r\n'),
(2, 'Poli Mata', 'gass ges gos'),
(3, 'Poli THT', 'jaga kesehatan tenggorokan'),
(4, 'Poli Jantung', 'Jaga jantungmu'),
(6, 'Poli Umum', 'Jaga Kesehatan Badanmu');

-- --------------------------------------------------------

--
-- Table structure for table user
--

DROP TABLE IF EXISTS user;
CREATE TABLE IF NOT EXISTS user (
  id_user int(50) NOT NULL AUTO_INCREMENT,
  nama_user varchar(255) NOT NULL,
  username varchar(255) NOT NULL,
  password varchar(50) NOT NULL,
  PRIMARY KEY (id_user)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table user
--

INSERT INTO user (id_user, nama_user, username, password) VALUES
(1, 'kiyya', 'kiyya', 'f0c846bb76ecf5043bfa247daa35340a363c1fee'),
(2, 'nopal', 'nopal', '40bb6a0711def0926782a09be58a11c4cf68c698'),
(3, 'Susanti Avian', 'susan', 'd8f68c1ab79ab971a3835f2c0315c34f8214a113'),
(4, 'upik', 'upik', 'd761976b1dbb416c45072f6f9485dc46d30983d0'),
(5, 'admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

--
-- Constraints for dumped tables
--

--
-- Constraints for table daftar_poli
--
ALTER TABLE daftar_poli
  ADD CONSTRAINT fk_jadwal FOREIGN KEY (id_jadwal) REFERENCES jadwal_periksa (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT fk_pasien FOREIGN KEY (id_pasien) REFERENCES pasien (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table detail_periksa
--
ALTER TABLE detail_periksa
  ADD CONSTRAINT fk_obat FOREIGN KEY (id_obat) REFERENCES obat (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT fk_periksa FOREIGN KEY (id_periksa) REFERENCES periksa (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table dokter
--
ALTER TABLE dokter
  ADD CONSTRAINT fk_poli FOREIGN KEY (id_poli) REFERENCES poli (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table jadwal_periksa
--
ALTER TABLE jadwal_periksa
  ADD CONSTRAINT fk_dokter FOREIGN KEY (id_dokter) REFERENCES dokter (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table periksa
--
ALTER TABLE periksa
  ADD CONSTRAINT fk_daftar_poli FOREIGN KEY (id_daftar_poli) REFERENCES daftar_poli (id) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;