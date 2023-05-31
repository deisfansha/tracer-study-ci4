/*
SQLyog Ultimate v12.5.1 (32 bit)
MySQL - 10.4.24-MariaDB : Database - db_tc
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_tc` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_tc`;

/*Table structure for table `konten` */

DROP TABLE IF EXISTS `konten`;

CREATE TABLE `konten` (
  `id_konten` int(20) NOT NULL AUTO_INCREMENT,
  `isi_konten` longtext DEFAULT NULL,
  `no_telp` int(20) DEFAULT NULL,
  `nama_konten` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `alamat` longtext DEFAULT NULL,
  PRIMARY KEY (`id_konten`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `konten` */

insert  into `konten`(`id_konten`,`isi_konten`,`no_telp`,`nama_konten`,`email`,`alamat`) values 
(1,'<p style=\"box-sizing: inherit; border: 0px rgb(230, 230, 230); outline: 0px; vertical-align: baseline; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; line-height: 1.7; color: rgb(107, 107, 107); font-family: Poppins, sans-serif; text-align: justify;\"><em style=\"box-sizing: inherit; border: 0px rgb(230, 230, 230); outline: 0px; vertical-align: baseline; background: transparent; margin: 0px; padding: 0px;\">Tracer study</em>&nbsp;adalah studi pelacakan jejak lulusan/alumni yang dilakukan kepada alumni 2 tahun setelah lulus .&nbsp;<em style=\"box-sizing: inherit; border: 0px rgb(230, 230, 230); outline: 0px; vertical-align: baseline; background: transparent; margin: 0px; padding: 0px;\">Tracer study</em>&nbsp;bertujuan untuk mengetahui&nbsp;<em style=\"box-sizing: inherit; border: 0px rgb(230, 230, 230); outline: 0px; vertical-align: baseline; background: transparent; margin: 0px; padding: 0px;\">outcome</em>pendidikan dalam bentuk transisi dari dunia pendidikan tinggi ke dunia kerja,&nbsp;<em style=\"box-sizing: inherit; border: 0px rgb(230, 230, 230); outline: 0px; vertical-align: baseline; background: transparent; margin: 0px; padding: 0px;\">output&nbsp;</em>pendidikan yaitu penilaian diri terhadap penguasaan dan pemerolehan kompetensi, proses pendidikan berupa evaluasi proses pembelajaran dan kontribusi pendidikan tinggi terhadap pemerolehan kompetensi serta input pendidikan berupa penggalian lebih lanjut terhadap informasi sosiobiografis lulusan.</p><p style=\"box-sizing: inherit; border: 0px rgb(230, 230, 230); outline: 0px; vertical-align: baseline; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; line-height: 1.7; color: rgb(107, 107, 107); font-family: Poppins, sans-serif; text-align: justify;\">Di samping untuk keperluan akreditasi, Ditjen Dikti Kemdiknas juga sejak tahun 2011 menggunakan&nbsp;<em style=\"box-sizing: inherit; border: 0px rgb(230, 230, 230); outline: 0px; vertical-align: baseline; background: transparent; margin: 0px; padding: 0px;\">tracer study</em>&nbsp;sebagai alat monitoring adaptasi lulusan perguruan tinggi di Indonesia ketika memasuki dunia kerja.</p>',893912331,'TRACER STUDY','unnur@gmail.com','Jln. Padjajaran No.219 Husein Sastranegara Bandung');

/*Table structure for table `level` */

DROP TABLE IF EXISTS `level`;

CREATE TABLE `level` (
  `id_level` int(10) NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `level` */

insert  into `level`(`id_level`,`nama_level`) values 
(1,'Admin'),
(2,'Alumni');

/*Table structure for table `tbl_answer` */

DROP TABLE IF EXISTS `tbl_answer`;

CREATE TABLE `tbl_answer` (
  `id_answer` int(20) NOT NULL AUTO_INCREMENT,
  `kode_users` int(20) DEFAULT NULL,
  `kode_kuesioner` int(20) DEFAULT NULL,
  `kode_quest` int(20) DEFAULT NULL,
  `answer` longtext DEFAULT NULL,
  PRIMARY KEY (`id_answer`),
  KEY `kode_users` (`kode_users`),
  KEY `kode_kuesioner` (`kode_kuesioner`),
  KEY `kode_quest` (`kode_quest`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_answer` */

/*Table structure for table `tbl_fakultas` */

DROP TABLE IF EXISTS `tbl_fakultas`;

CREATE TABLE `tbl_fakultas` (
  `id_fakultas` int(20) NOT NULL AUTO_INCREMENT,
  `nama_fakultas` varchar(200) NOT NULL,
  PRIMARY KEY (`id_fakultas`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_fakultas` */

insert  into `tbl_fakultas`(`id_fakultas`,`nama_fakultas`) values 
(1,'Fakultas Teknik'),
(2,'Fakultas Ekonomi'),
(3,'Fakultas Ilmu Komputer & Informatika'),
(4,'Fakultas Ilmu Sosial & Ilmu Politik'),
(5,'Pascasarjana');

/*Table structure for table `tbl_group_kuesioner` */

DROP TABLE IF EXISTS `tbl_group_kuesioner`;

CREATE TABLE `tbl_group_kuesioner` (
  `id_grup` int(20) NOT NULL AUTO_INCREMENT,
  `kode_kuesioner` int(20) NOT NULL,
  `kode_quest` int(20) NOT NULL,
  PRIMARY KEY (`id_grup`),
  KEY `kode_kuesioner` (`kode_kuesioner`),
  KEY `kode_quest` (`kode_quest`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_group_kuesioner` */

/*Table structure for table `tbl_kuesioner` */

DROP TABLE IF EXISTS `tbl_kuesioner`;

CREATE TABLE `tbl_kuesioner` (
  `id_kuesioner` int(20) NOT NULL AUTO_INCREMENT,
  `kd_kuesioner` int(20) NOT NULL,
  `nama_kuesioner` varchar(200) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('publish','reject') NOT NULL,
  `update_at` varchar(200) NOT NULL,
  PRIMARY KEY (`id_kuesioner`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_kuesioner` */

/*Table structure for table `tbl_option` */

DROP TABLE IF EXISTS `tbl_option`;

CREATE TABLE `tbl_option` (
  `id_select` int(200) NOT NULL AUTO_INCREMENT,
  `kode_quest` int(20) DEFAULT NULL,
  `nama` text NOT NULL,
  `nilai` int(200) DEFAULT NULL,
  PRIMARY KEY (`id_select`),
  KEY `kode_quest` (`kode_quest`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_option` */

/*Table structure for table `tbl_prodi` */

DROP TABLE IF EXISTS `tbl_prodi`;

CREATE TABLE `tbl_prodi` (
  `id_prodi` int(20) NOT NULL AUTO_INCREMENT,
  `nama_prodi` varchar(200) NOT NULL,
  `gelar` varchar(200) NOT NULL,
  `kode_fakultas` int(20) NOT NULL,
  PRIMARY KEY (`id_prodi`),
  KEY `kode_fakultas` (`kode_fakultas`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_prodi` */

insert  into `tbl_prodi`(`id_prodi`,`nama_prodi`,`gelar`,`kode_fakultas`) values 
(1,'Teknik Informatika','S1',3),
(2,'Akuntansi','S1',2),
(3,'Manajemen','S1',2),
(4,'Teknik Penerbangan','S1',1),
(6,'Motor Pesawat','D3',1),
(7,'Rangka Pesawat','D3',1),
(8,'Avionika','D3',1),
(9,'Kelistrikan Pesawat','D3',1),
(10,'Teknik Industri','S1',1),
(11,'Teknik Logistik & Manajemen Pembekalan','D3',1),
(12,'Ilmu Administrasi Negara','S1',4),
(13,'Ilmu Administrasi Bisnis','S1',4),
(14,'Magister Ilmu Administrasi','S2',5),
(19,'Teknik Elektro','',1);

/*Table structure for table `tbl_question` */

DROP TABLE IF EXISTS `tbl_question`;

CREATE TABLE `tbl_question` (
  `id_quest` int(20) NOT NULL AUTO_INCREMENT,
  `kode_pertanyaan` varchar(20) NOT NULL,
  `nama_quest` varchar(200) NOT NULL,
  `tipe_pertanyaan` enum('essay','multiple') NOT NULL,
  PRIMARY KEY (`id_quest`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_question` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` int(10) NOT NULL AUTO_INCREMENT,
  `nim` varchar(15) NOT NULL,
  `kode_fakultas` int(10) NOT NULL,
  `kode_prodi` int(10) NOT NULL,
  `username` varchar(200) NOT NULL,
  `nama_lengkap` varchar(200) NOT NULL,
  `jenis_klm` varchar(200) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `tgl_lahir` varchar(200) NOT NULL,
  `tempat_lahir` varchar(200) DEFAULT NULL,
  `alamat_rmh` longtext DEFAULT NULL,
  `tahun_lulus` int(20) NOT NULL,
  `email` varchar(250) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `password` varchar(250) NOT NULL,
  `level` int(25) NOT NULL,
  `status` enum('approved','pending','reject') DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `level` (`level`),
  KEY `kode_prodi` (`kode_prodi`),
  KEY `kode_fakultas` (`kode_fakultas`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user` */

insert  into `user`(`id_user`,`nim`,`kode_fakultas`,`kode_prodi`,`username`,`nama_lengkap`,`jenis_klm`,`nik`,`tgl_lahir`,`tempat_lahir`,`alamat_rmh`,`tahun_lulus`,`email`,`no_hp`,`password`,`level`,`status`,`foto`,`created_at`) values 
(1,'',0,0,'admin','Admin','','0','',NULL,NULL,0,'deisfansha8082@gmail.com','2147483647','$2y$10$oJK8qUywDElgO6MfpDQ7VuqCJGo6TqEVjWq0LXHKMb18uexxvEb2a',1,'approved','settings.png',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
