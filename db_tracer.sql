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

insert  into `tbl_answer`(`id_answer`,`kode_users`,`kode_kuesioner`,`kode_quest`,`answer`) values 
(5,17,3,2,'Sangat Puas'),
(6,17,3,4,'asdasd'),
(7,17,3,5,'dddd'),
(8,17,3,6,'ssssssssssssssssss'),
(33,17,2,4,'Jakarta'),
(34,17,2,2,'Sangat Puas'),
(35,17,2,1,'Tidak Puas'),
(36,17,2,16,'S1'),
(41,18,3,2,'Sangat Puas'),
(42,18,3,4,'Surabaya'),
(43,18,3,5,'BUMN'),
(44,18,3,6,'PT KAI'),
(45,18,3,7,'Manager'),
(50,26,3,2,'Sangat Puas'),
(51,26,3,4,'Bandung'),
(52,26,3,5,'wwww'),
(53,26,3,6,'ssssssssssssssssss'),
(54,26,3,7,'Manager'),
(55,18,2,4,'Magelang'),
(56,18,2,2,'Sangat Puas'),
(57,18,2,1,'Tidak Puas'),
(58,18,2,16,'D3'),
(59,26,2,4,'Kalimantan'),
(60,26,2,2,'Sangat Puas'),
(61,26,2,1,'Tidak Puas'),
(62,26,2,16,'D3'),
(63,44,2,4,'Bandung'),
(64,44,2,2,'Sangat Puas'),
(65,44,2,1,'Tidak Puas'),
(66,44,2,16,'S3'),
(67,44,2,4,'Bandung'),
(68,44,2,2,'Sangat Puas'),
(69,44,2,1,'Tidak Puas'),
(70,44,2,16,'S3'),
(71,44,3,2,'Sangat Puas'),
(72,44,3,4,'DI TEMPAT KERJA'),
(73,44,3,5,'SALES PAKAIAN DALAM'),
(74,44,3,6,'CROCODILE'),
(75,44,3,7,'EKSEKUTIF MANAJER'),
(76,45,3,2,'Sangat Puas'),
(77,45,3,4,'tidak'),
(78,45,3,5,'tidak'),
(79,45,3,6,'tidak'),
(80,45,3,7,'tidak'),
(81,45,2,4,''),
(82,45,2,2,'Sangat Puas'),
(83,45,2,1,'Tidak Puas'),
(84,45,2,16,'S1'),
(85,46,3,2,'Sangat Puas'),
(86,46,3,4,'bandung'),
(87,46,3,5,'accounting'),
(88,46,3,6,'wwwwwwww'),
(89,46,3,7,'pekerja'),
(90,46,2,4,'Bandung'),
(91,46,2,2,'Sangat Puas'),
(92,46,2,1,'Tidak Puas'),
(93,46,2,16,'S1'),
(94,48,2,4,'Bandung'),
(95,48,2,2,'Sangat Puas'),
(96,48,2,1,'Tidak Puas'),
(97,48,2,16,'S1');

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

insert  into `tbl_group_kuesioner`(`id_grup`,`kode_kuesioner`,`kode_quest`) values 
(13,2,4),
(14,2,2),
(15,3,2),
(16,3,4),
(17,3,5),
(18,3,6),
(19,3,7),
(20,2,1),
(21,2,16),
(34,8,4),
(35,8,5),
(36,8,6),
(37,8,7);

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

insert  into `tbl_kuesioner`(`id_kuesioner`,`kd_kuesioner`,`nama_kuesioner`,`keterangan`,`created_at`,`status`,`update_at`) values 
(2,33,'Kuesioner Unnur','Kuesioner Universitas Nurtanio Bandung','2022-08-05 19:43:41','publish',''),
(3,2,'Kuesioner Pekerjaan','Kuesioner Ini tentang Pekerjaan','2022-08-05 19:42:54','publish',''),
(8,16,'Kuesioner Kepuasan ','Ini Tentang Kepuasan Terhadap Kampus','2022-09-27 16:22:36','reject',''),
(9,10,'Kuesioner Wisuda','Ini Tentang Kuesioner Wisuda','2022-09-27 16:20:32','reject','');

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

insert  into `tbl_option`(`id_select`,`kode_quest`,`nama`,`nilai`) values 
(1,2,'Sangat Puas',1),
(3,2,'Puas',2),
(4,1,'Tidak Puas',5),
(5,2,'Tidak Puas',5),
(6,2,'Sedang',3),
(7,1,'Puas',1),
(8,1,'Sangat Sangat Puas',3),
(10,20,'BUMN',1),
(11,20,'Swasta',2),
(12,20,'PNS',1);

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

insert  into `tbl_question`(`id_quest`,`kode_pertanyaan`,`nama_quest`,`tipe_pertanyaan`) values 
(1,'f44','   Identitas Mahasiswa?','multiple'),
(2,'f5',' Apakah anda telah mendapatkan pekerjaan <= 6 bulan/termasuk bekerja sebelum lulus?','multiple'),
(4,'f25',' Dimana lokasi tempat anda bekerja','essay'),
(5,'k2','Apa jenis perusahaan/instansi tempat anda bekerja sekarang?','essay'),
(6,'k6','apa nama perusahaan/tempat anda bekerja','essay'),
(7,'k7','Bila berwisata apa posisi/jabatan anda sekarang?','essay'),
(8,'99','Apa tingkat tempat kerja anda?','essay'),
(9,'90','Pertanyaan studi lanjut','essay'),
(10,'j8','Sebutkan sumber dana dalam pembiayaan kuliah','essay'),
(11,'00','Seberapa erat hubungan antara bidang studi dengan pekerjaan','essay'),
(15,'f3',' Apakah anda sudah Puas dengan pelayanan Di Universitas Nurtanio?','multiple'),
(16,'f22','Tingkat pendidikan apa yang paling tepat untuk pekerjaan anda saat ini','essay'),
(17,'f99','apakah kamu bekerja','essay'),
(20,'f32','Dimana Tempat anda bekerja','multiple');

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
(1,'55201118033',0,0,'admin','Admin','','0','',NULL,NULL,0,'deisfansha8082@gmail.com','2147483647','$2y$10$oJK8qUywDElgO6MfpDQ7VuqCJGo6TqEVjWq0LXHKMb18uexxvEb2a',1,'approved','settings.png',NULL),
(2,'55201118032',3,1,'deis','user','','0','',NULL,NULL,2016,'user@gmail.com','2147483647','$2y$10$iCQvvV62njItMatmuPCg5eU/5Aog63K16W8Djc9wB6xd.GiJuXUBe',2,NULL,NULL,NULL),
(3,'55201118040',3,1,'deis','deis','','0','',NULL,NULL,2020,'deisfansha8082@gmail.com','2147483647','$2y$10$iCQvvV62njItMatmuPCg5eU/5Aog63K16W8Djc9wB6xd.GiJuXUBe',2,NULL,NULL,NULL),
(4,'55201119033',3,1,'yanto','yanto','','0','',NULL,NULL,2014,'yanto@gmail.com','2147483647','$2y$10$8fy21WCNc7HXeI0RR.fvCemseXGDGp3L3g35KIZ2i8ZLCcGoEyiYW',2,'approved',NULL,NULL),
(8,'55201118031',3,1,'david','David','Laki-Laki','0','',NULL,NULL,2020,'deisdarif@gmail.com','2147483647','$2y$10$m8uq2jJ8mmGGEno3mWW/WuiXQryPze1/jSxxJM7W7fzXFZ6qxD/wG',2,'reject',NULL,NULL),
(11,'55201118035',3,1,'','Tiara','Laki-Laki','0','',NULL,NULL,2018,'tiaraairindya@gmail.com','2147483647','$2y$10$dwdvabJbMywyY5Zzdu3n1OW0XbW8hkINAsjW4.OLT7MC/2I.dREO6',2,'approved',NULL,NULL),
(12,'55201118036',3,1,'','Tiara','Perempuan','0','',NULL,NULL,2014,'tiaraairindya@gmail.com','2147483647','$2y$10$Gewqh9EPlgggkrzM2H8rSuWNg1SNzuPAmvKAmXvmdjadtoT0gQ7Te',2,'reject',NULL,NULL),
(14,'55201118037',3,1,'rega','Rega','Laki-Laki','0','',NULL,NULL,2022,'deisfansha8082@gmail.com','2147483647','$2y$10$3hO7KaZzRqNWoWyytJvcUer1JDKW1XnzaymRQ3ojQtfdJlXoTjDUu',2,'approved',NULL,NULL),
(15,'55201118038',2,2,'deis','Deis','Laki-Laki','0','',NULL,NULL,2022,'deisdarif@gmail.com','2147483647','$2y$10$aRopaQ9JTGZ44N1PaUKNm.dk4CHimaRo0PKbHhpQz4nHju1ezERhG',2,'approved',NULL,NULL),
(17,'55201118039',3,1,'ramdhani','deis','Laki-Laki','0','',NULL,NULL,2018,'deisfansha8082@gmail.com','2147483647','$2y$10$27VLCNw2T3OENnkGv6mMRuCmvhJlAnhK2qbPsTRxeDc5jajcFIUFq',2,'approved','settings.png',NULL),
(18,'55201118041',3,1,'tiarapuji','Tiara Puji Astuti','Perempuan','2147483647','18/08/2000','Jakarta','Jalan Wastukencana GG. Nangkasuni',2020,'deisfansha.if18@student.unnur.ac.id','08989079798','$2y$10$KLnUmY3aN5GGwxgxMacqfendyXjMN5DDb42P3Z0UF/Jd0jZL4Tyc.',2,'approved','1664360642_057c606be23db9a75c46.png',NULL),
(26,'55201118042',3,1,'yusman','yusman','Laki-Laki','3204390312190004','15/06/2000','Kendari',NULL,2020,'yusman@gmail.com','089692313810','$2y$10$0bojnRWHnr1CNOs9ksCxdOQCi/Z3IZ64ogwN/aI9SgoLQwSbkHZiS',2,'approved','1664974538_809bbf187fd96631ec47.png',NULL),
(30,'55201118043',4,12,'operator','Pradaffa','Laki-Laki','0','',NULL,NULL,2020,'deisfansha8082@gmail.com','2147483647','$2y$10$uBc/nasV/hYnrWjNL0cy.ucEj1A05Ju4VVsp86sGxN3z4woVCaIGS',2,'approved','1660532890_96050047b8077f629085.jpeg',NULL),
(31,'55201118044',3,1,'pian','Sopian','Laki-Laki','0','',NULL,NULL,2020,'deisfansha8082@gmail.com','2147483647','$2y$10$WqUlcGWrNbSb0Qk4QfZ3XOjXSZ2bAU8Md/sx1JLDo4o/rUskG16rK',2,'approved',NULL,NULL),
(32,'55201118045',2,2,'deva','Devani Alya','Perempuan','0','',NULL,NULL,2020,'deisfansha8082@gmail.com','2147483647','$2y$10$G2CRF8sYnvHQZJSLa2ZrlemUyLL2aBERZcl9GhnPgvlLNWnySWJL6',2,'approved',NULL,NULL),
(34,'55201118046',4,12,'krismayanti','Krismayanti','Perempuan','0','',NULL,NULL,2016,'krismayanti@gmail.com','2147483647','$2y$10$xjLgqivEXF6GhUaTCaXBfe.hjJ8TCVgrg5l7XV/Mto6yV5xmF/exW',2,'approved','1660967231_8a9c192c936e1e11f0d8.jpg',NULL),
(35,'55201118047',1,4,'mesa','Mesa Mustika','Perempuan','0','',NULL,NULL,2020,'syaiful.unnur@gmail.com','2147483647','$2y$10$WUTtUL9dQJOlL1Gq8hZWn.dQg447SDEe.Mt3BaqCoDO..cj6/MXte',2,'approved','1660967667_01eb2ccb90a04352edc8.jpg',NULL),
(36,'55201118048',2,2,'aldo','Aldo Yusna','Laki-Laki','0','',NULL,NULL,2020,'aldo123@gmail.com','2147483647','$2y$10$a9H0TDXl1XLysbaLUw26U.ssHmBrlfDZtfwlarUSn4ZscWQF7wHVm',2,'reject','1660968618_06b0f13261bfa645738c.jpg',NULL),
(37,'55201118049',4,13,'redza','Redza Saleh','Laki-Laki','0','',NULL,NULL,2020,'deisfansha.if18@student.unnur.ac.id','0','$2y$10$KLnUmY3aN5GGwxgxMacqfendyXjMN5DDb42P3Z0UF/Jd0jZL4Tyc.',2,'approved','1660968834_aa7aa07b8b7904d1d947.jpeg',NULL),
(39,'55201118051',2,2,'dhany','Dhany Syabana','Laki-Laki','0','',NULL,NULL,2020,'deisfansha.if18@student.unnur.ac.id','0','$2y$10$KLnUmY3aN5GGwxgxMacqfendyXjMN5DDb42P3Z0UF/Jd0jZL4Tyc.',2,'approved','1660970031_c8661dbf3bd933fed739.jpeg',NULL),
(40,'55201118052',4,13,'rahmat','Rahmat Sunjani','Laki-Laki','0','',NULL,NULL,2019,'deisfansha.if18@student.unnur.ac.id','089693871388','$2y$10$KLnUmY3aN5GGwxgxMacqfendyXjMN5DDb42P3Z0UF/Jd0jZL4Tyc.',2,'approved','avatar.png',NULL),
(41,'55201119000',3,1,'55201119000','user','Laki-Laki','0','',NULL,NULL,2016,'user@gmail.com','2147483647','$2y$10$KAR.kFcQO2yYKUket6Bh2eIEYzYwvyljxLrnD4Ntvx/JLuzN1O9ue',2,'approved',NULL,NULL),
(42,'55201130000',3,1,'55201130000','user','Laki-Laki','0','',NULL,NULL,2016,'user@gmail.com','2147483647','$2y$10$mwwhJ8D2Oe1B3zdv8RVDG.isQ/TThZpF34PHga5gFlNiFH6TfMTNK',2,'approved',NULL,NULL),
(43,'55201120052',3,1,'55201120052','deis','Laki-Laki','0','',NULL,NULL,2020,'deisfansha8082@gmail.com','2147483647','$2y$10$gp/urv36DL.XZYGUQETp5OF0qH4LrcOKqQtw9weamUnKvfutLPjxO',2,'approved',NULL,NULL),
(44,'61201118007',2,3,'pradaffa','Pradaffa Putra Aliansyah Nur','Laki-Laki','0','',NULL,NULL,2022,'putraanpradaffa@gmail.com','087718868412','$2y$10$LL4/5alZqTbQ6iY/fHSHNeElCsEE46d2nNugdlwVQSgzBtTexSNGe',2,'approved',NULL,NULL),
(45,'61201118037',2,3,'ilmadwir26','Ilma Dwi Rubiani','Perempuan','0','',NULL,NULL,2022,'ilmadwir53@gmail.com','088706360204','$2y$10$euczYX0QWbH2gfTfK2XgleGRX7QmBdldmg8uA4PC5YgsY0aNVwqnu',2,'approved',NULL,NULL),
(46,'61201118027',2,3,'devinsyf','Devi Nur Rohmah Syifa','Perempuan','0','',NULL,NULL,2022,'devinsyifa31@gmail.com','0881023102823','$2y$10$2yZDucWDSmTVbjQAqfaA8ul4BF5mnJ5C8FWgomb6vxNUVzMxrh5Ha',2,'approved',NULL,NULL),
(47,'55201118001',3,1,'tiaraairin_','Tiara Airindya','Perempuan','','',NULL,NULL,2022,'tiara.airindya21@gmail.com','089619172259','$2y$10$T5tFCba0ADqp08uvMPELbOBv223Kr8CW3XJBkakEnYTMbAGeneUYi',2,'approved',NULL,NULL),
(48,'55201118025',3,1,'55201118025','Mutia Maudya','Laki-Laki','','02/02/2000','Bandung','',2020,'deisfansha8082@gmail.com','2147483647','$2y$10$m847Qwn47J.tGz9e7zuDruk9HxjaaM7zyMDBV60NkxhV/sH4s.MaC',2,'approved',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
