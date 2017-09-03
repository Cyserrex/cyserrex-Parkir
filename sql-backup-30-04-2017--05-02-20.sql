-- Database: `parkir` --
-- Table `admin` --
CREATE TABLE `admin` (
  `id_user` int(3) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` int(1) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `admin` (`id_user`, `nama`, `username`, `password`, `level`) VALUES
(1, 'Adny Nizomi', 'adny', '123456', 1),
(2, 'Admin', 'admin', 'admin', 0),
(3, 'Agus', 'agus', '123456', 1),
(4, 'Dani', 'dani', '123456', 2);

-- Table `data_parkir` --
CREATE TABLE `data_parkir` (
  `id_parkir` varchar(16) NOT NULL,
  `id_user_m` int(2) NOT NULL,
  `id_user_k` int(2) NOT NULL,
  `plat` varchar(12) NOT NULL,
  `tipe` char(15) NOT NULL,
  `tanggal` date NOT NULL,
  `masuk` time NOT NULL,
  `keluar` time NOT NULL,
  `tarif` int(6) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  PRIMARY KEY (`id_parkir`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table `data_plat` --
CREATE TABLE `data_plat` (
  `id` int(2) NOT NULL,
  `plat_depan` char(3) NOT NULL,
  `daerah` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_plat` (`id`, `plat_depan`, `daerah`) VALUES
(1, 'DA', 'Banjarmasin');

-- Table `level_jabatan` --
CREATE TABLE `level_jabatan` (
  `level` int(2) NOT NULL,
  `nama_jabatan` varchar(25) NOT NULL,
  PRIMARY KEY (`level`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `level_jabatan` (`level`, `nama_jabatan`) VALUES
(0, 'Admin'),
(1, 'Parkir Masuk'),
(2, 'Parkir Keluar');

