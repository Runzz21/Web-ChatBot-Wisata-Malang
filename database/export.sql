-- Database Export for Wisata Alam Malang
-- Generated: 2026-07-07 22:56:17

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warna_badge` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT '#2E7D32',
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'landscape',
  PRIMARY KEY (`id_kategori`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `slug`, `warna_badge`, `icon`) VALUES ('1', 'Wisata Alam', 'wisata-alam', '#2E7D32', 'trees');
INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `slug`, `warna_badge`, `icon`) VALUES ('2', 'Wisata Pantai', 'wisata-pantai', '#0288D1', 'waves');
INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `slug`, `warna_badge`, `icon`) VALUES ('3', 'Agrowisata', 'agrowisata', '#689F38', 'leaf');
INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `slug`, `warna_badge`, `icon`) VALUES ('4', 'Wisata Air Alami', 'wisata-air', '#0097A7', 'droplet');
INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `slug`, `warna_badge`, `icon`) VALUES ('5', 'Rekreasi Keluarga', 'rekreasi-keluarga', '#F57C00', 'smart-screen');
INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `slug`, `warna_badge`, `icon`) VALUES ('6', 'Spot Foto & Kampung Wisata', 'spot-foto', '#7B1FA2', 'camera');
INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `slug`, `warna_badge`, `icon`) VALUES ('7', 'Wisata Kota & Sejarah', 'wisata-kota', '#5D4037', 'compass');

DROP TABLE IF EXISTS `destinasi`;
CREATE TABLE `destinasi` (
  `id_destinasi` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kategori` int NOT NULL,
  `lokasi` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `ketinggian_mdpl` int DEFAULT NULL,
  `jarak_km` decimal(5,1) DEFAULT NULL,
  `harga_tiket` int DEFAULT '0',
  `jam_buka` time DEFAULT NULL,
  `jam_tutup` time DEFAULT NULL,
  `buka_24jam` tinyint(1) DEFAULT '0',
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `foto_utama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'default.jpg',
  `fasilitas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_aktif` tinyint(1) DEFAULT '1',
  `dibuat_pada` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_destinasi`),
  KEY `idx_chatbot_filter` (`id_kategori`,`jarak_km`,`harga_tiket`),
  CONSTRAINT `destinasi_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `destinasi` (`id_destinasi`, `nama`, `id_kategori`, `lokasi`, `latitude`, `longitude`, `ketinggian_mdpl`, `jarak_km`, `harga_tiket`, `jam_buka`, `jam_tutup`, `buka_24jam`, `deskripsi`, `foto_utama`, `fasilitas`, `status_aktif`, `dibuat_pada`) VALUES ('1', 'Jatim Park 1', '5', 'Kota Batu, Malang Raya', '-7.8841520', '112.5248269', '500', '18.5', '100000', '08:30:00', '16:30:00', '0', 'Taman hiburan keluarga dengan wahana edukasi dan permainan.', 'destinasi/RZ00dO0vTV37hkdsGl4XDgZPo52fJiaffN6KoAg1.jpg', 'wahana,toilet,foodcourt,parkir', '1', '2026-06-22 22:42:49');
INSERT INTO `destinasi` (`id_destinasi`, `nama`, `id_kategori`, `lokasi`, `latitude`, `longitude`, `ketinggian_mdpl`, `jarak_km`, `harga_tiket`, `jam_buka`, `jam_tutup`, `buka_24jam`, `deskripsi`, `foto_utama`, `fasilitas`, `status_aktif`, `dibuat_pada`) VALUES ('2', 'Jatim Park 2', '5', 'Kota Batu, Malang Raya', '-7.8880210', '112.5295442', '550', '19.0', '110000', '08:30:00', '16:30:00', '0', 'Kompleks wisata edukasi dengan museum dan kebun binatang.', 'destinasi/pZglIMD1zXux8hyybthlUlQOauWFTR31sSHxeKGN.jpg', 'kebun_binatang,museum,toilet,parkir', '1', '2026-06-22 22:42:49');
INSERT INTO `destinasi` (`id_destinasi`, `nama`, `id_kategori`, `lokasi`, `latitude`, `longitude`, `ketinggian_mdpl`, `jarak_km`, `harga_tiket`, `jam_buka`, `jam_tutup`, `buka_24jam`, `deskripsi`, `foto_utama`, `fasilitas`, `status_aktif`, `dibuat_pada`) VALUES ('3', 'Jatim Park 3', '5', 'Kota Batu, Malang Raya', '-7.8965576', '112.5527480', '450', '16.5', '120000', '11:00:00', '21:00:00', '0', 'Destinasi hiburan bertema modern dan interaktif.', 'destinasi/HuKd54hCMlWvZ1KKHLpaiJOq6KuZskWvmhcm7fbS.jpg', 'wahana,spot_foto,toilet,cafe', '1', '2026-06-22 22:42:49');
INSERT INTO `destinasi` (`id_destinasi`, `nama`, `id_kategori`, `lokasi`, `latitude`, `longitude`, `ketinggian_mdpl`, `jarak_km`, `harga_tiket`, `jam_buka`, `jam_tutup`, `buka_24jam`, `deskripsi`, `foto_utama`, `fasilitas`, `status_aktif`, `dibuat_pada`) VALUES ('4', 'Museum Angkut', '5', 'Kota Batu, Malang Raya', '-7.8790652', '112.5187151', '520', '18.2', '100000', '11:00:00', '20:00:00', '0', 'Museum transportasi populer dengan koleksi kendaraan lintas era.', 'destinasi/eVeHEKD9FESsn5qIgRE79Gti75zK7IbyThz81jaV.jpg', 'spot_foto,toilet,foodcourt,pasar_apung', '1', '2026-06-22 22:42:49');
INSERT INTO `destinasi` (`id_destinasi`, `nama`, `id_kategori`, `lokasi`, `latitude`, `longitude`, `ketinggian_mdpl`, `jarak_km`, `harga_tiket`, `jam_buka`, `jam_tutup`, `buka_24jam`, `deskripsi`, `foto_utama`, `fasilitas`, `status_aktif`, `dibuat_pada`) VALUES ('5', 'Kampung Warna-Warni Jodipan', '6', 'Jodipan, Kota Malang', '-7.9828797', '112.6372548', '420', '1.5', '5000', '07:00:00', '17:00:00', '0', 'Kampung ikonik dengan rumah-rumah warna-warni dan mural menarik.', 'destinasi/UOU3KJBBIsWnFmReIzPARaOFkmiRrK16QIRz4xtr.jpg', 'spot_foto,aksesindor,warung', '1', '2026-06-22 22:42:49');
INSERT INTO `destinasi` (`id_destinasi`, `nama`, `id_kategori`, `lokasi`, `latitude`, `longitude`, `ketinggian_mdpl`, `jarak_km`, `harga_tiket`, `jam_buka`, `jam_tutup`, `buka_24jam`, `deskripsi`, `foto_utama`, `fasilitas`, `status_aktif`, `dibuat_pada`) VALUES ('7', 'Kampung Biru Arema', '6', 'Kota Malang', '-7.9813051', '112.6376925', '420', '1.4', '5000', '08:00:00', '17:00:00', '0', 'Kampung bernuansa biru yang identik dengan arek Malang.', 'destinasi/tXdqeXyKIoQnHuBmYTKQBWJwVixfRxQnzYvnjOAv.jpg', 'spot_foto,sejarah_arema', '1', '2026-06-22 22:42:49');
INSERT INTO `destinasi` (`id_destinasi`, `nama`, `id_kategori`, `lokasi`, `latitude`, `longitude`, `ketinggian_mdpl`, `jarak_km`, `harga_tiket`, `jam_buka`, `jam_tutup`, `buka_24jam`, `deskripsi`, `foto_utama`, `fasilitas`, `status_aktif`, `dibuat_pada`) VALUES ('8', 'Alun-Alun Kota Malang', '7', 'Klojen, Kota Malang', '-7.9826145', '112.6308113', '440', '0.0', '0', NULL, NULL, '1', 'Ruang publik populer untuk bersantai, kuliner, dan aktivitas ringan.', 'destinasi/Fu1l48A2Ey97zJmm4N30jgrK30OLJIWBkoZffZRw.jpg', 'playground,masjid,wifi,kuliner', '1', '2026-06-22 22:42:49');
INSERT INTO `destinasi` (`id_destinasi`, `nama`, `id_kategori`, `lokasi`, `latitude`, `longitude`, `ketinggian_mdpl`, `jarak_km`, `harga_tiket`, `jam_buka`, `jam_tutup`, `buka_24jam`, `deskripsi`, `foto_utama`, `fasilitas`, `status_aktif`, `dibuat_pada`) VALUES ('9', 'Alun-Alun Tugu', '7', 'Kota Malang', '-7.9771430', '112.6340478', '441', '1.0', '0', NULL, NULL, '1', 'Landmark kota dengan taman dan suasana malam yang nyaman.', 'destinasi/aiSkgE3TnE73CWGwESuAXlBumD4c2Bl4cMzpfVuO.jpg', 'taman,kolam_teratai,spot_foto', '1', '2026-06-22 22:42:49');
INSERT INTO `destinasi` (`id_destinasi`, `nama`, `id_kategori`, `lokasi`, `latitude`, `longitude`, `ketinggian_mdpl`, `jarak_km`, `harga_tiket`, `jam_buka`, `jam_tutup`, `buka_24jam`, `deskripsi`, `foto_utama`, `fasilitas`, `status_aktif`, `dibuat_pada`) VALUES ('10', 'Malang Night Paradise', '5', 'Kota Malang', '-7.9235099', '112.6580123', '430', '7.5', '75000', '17:45:00', '23:00:00', '0', 'Destinasi malam dengan lampu hias dan wahana keluarga.', 'destinasi/1OiqW8KqUW9upyCzA1oVHTQCqc7t8UUBjbbKXECo.jpg', 'lampion,wahana_air,toilet,foodcourt', '1', '2026-06-22 22:42:49');
INSERT INTO `destinasi` (`id_destinasi`, `nama`, `id_kategori`, `lokasi`, `latitude`, `longitude`, `ketinggian_mdpl`, `jarak_km`, `harga_tiket`, `jam_buka`, `jam_tutup`, `buka_24jam`, `deskripsi`, `foto_utama`, `fasilitas`, `status_aktif`, `dibuat_pada`) VALUES ('11', 'Coban Rondo', '1', 'Pujon, Kabupaten Malang', '-7.8846458', '112.4768237', '1135', '32.1', '35000', '08:00:00', '17:00:00', '0', 'Air terjun populer dengan udara sejuk dan area rekreasi.', 'destinasi/U24pjVLL6Q4Xe604ThyRxxbJbiDDfEzvg3PxNsl6.jpg', 'air_terjun,outbound,camping,toilet', '1', '2026-06-22 22:42:49');
INSERT INTO `destinasi` (`id_destinasi`, `nama`, `id_kategori`, `lokasi`, `latitude`, `longitude`, `ketinggian_mdpl`, `jarak_km`, `harga_tiket`, `jam_buka`, `jam_tutup`, `buka_24jam`, `deskripsi`, `foto_utama`, `fasilitas`, `status_aktif`, `dibuat_pada`) VALUES ('12', 'Coban Jahe', '1', 'Kabupaten Malang', '-7.9705673', '112.8023017', '820', '23.5', '15000', '07:00:00', '17:00:00', '0', 'Air terjun alami yang cocok untuk wisata santai.', 'destinasi/JLYYf5vuBLDEekgRkmqVgrIJGEVYYGm1f7PCaGft.jpg', 'air_terjun,cafe,river_tubing,mushola', '1', '2026-06-22 22:42:49');
INSERT INTO `destinasi` (`id_destinasi`, `nama`, `id_kategori`, `lokasi`, `latitude`, `longitude`, `ketinggian_mdpl`, `jarak_km`, `harga_tiket`, `jam_buka`, `jam_tutup`, `buka_24jam`, `deskripsi`, `foto_utama`, `fasilitas`, `status_aktif`, `dibuat_pada`) VALUES ('13', 'Coban Rais', '1', 'Batu, Malang Raya', '-7.9116767', '112.5184342', '1025', '24.0', '25000', '07:00:00', '16:00:00', '0', 'Air terjun dan area rekreasi alam dengan spot foto.', 'destinasi/pBf6gpamrDJ8R0KTOfAXZaX34INCjrSsU1pMFhHr.jpg', 'air_terjun,batu_flower_garden,spot_foto', '1', '2026-06-22 22:42:49');
INSERT INTO `destinasi` (`id_destinasi`, `nama`, `id_kategori`, `lokasi`, `latitude`, `longitude`, `ketinggian_mdpl`, `jarak_km`, `harga_tiket`, `jam_buka`, `jam_tutup`, `buka_24jam`, `deskripsi`, `foto_utama`, `fasilitas`, `status_aktif`, `dibuat_pada`) VALUES ('14', 'Pantai Balekambang', '2', 'Malang Selatan', '-8.4034458', '112.5391259', '5', '61.2', '10000', NULL, NULL, '1', 'Pantai terkenal dengan pemandangan laut selatan dan akses mudah.', 'destinasi/tLkG6nJYNQcgFpk22uojQzc7hJPt3J5ekNZaAtpG.jpg', 'pantai,pura,camping,penginapan,warung', '1', '2026-06-22 22:42:49');
INSERT INTO `destinasi` (`id_destinasi`, `nama`, `id_kategori`, `lokasi`, `latitude`, `longitude`, `ketinggian_mdpl`, `jarak_km`, `harga_tiket`, `jam_buka`, `jam_tutup`, `buka_24jam`, `deskripsi`, `foto_utama`, `fasilitas`, `status_aktif`, `dibuat_pada`) VALUES ('15', 'Pantai Ngliyep', '2', 'Malang Selatan', '-8.3835873', '112.4242054', '4', '63.8', '15000', NULL, NULL, '1', 'Pantai dengan ombak besar, tebing, dan panorama alami.', 'destinasi/fnoWAVjnlkCzhRsmgQPayUY9IukHEWhv0SIft2Iz.jpg', 'pantai,pulau_kambang,warung,toilet', '1', '2026-06-22 22:42:49');
INSERT INTO `destinasi` (`id_destinasi`, `nama`, `id_kategori`, `lokasi`, `latitude`, `longitude`, `ketinggian_mdpl`, `jarak_km`, `harga_tiket`, `jam_buka`, `jam_tutup`, `buka_24jam`, `deskripsi`, `foto_utama`, `fasilitas`, `status_aktif`, `dibuat_pada`) VALUES ('16', 'Pantai Tiga Warna', '2', 'Malang Selatan', '-8.4391428', '112.6777942', '2', '72.0', '15000', '07:00:00', '15:00:00', '0', 'Pantai konservasi dengan gradasi warna air yang unik.', 'destinasi/Pcw4aoIP77QQeZMeiwfOhvDz0dw5yPr2oooadVux.jpg', 'snorkeling,tracking,guide,mangrove', '1', '2026-06-22 22:42:49');
INSERT INTO `destinasi` (`id_destinasi`, `nama`, `id_kategori`, `lokasi`, `latitude`, `longitude`, `ketinggian_mdpl`, `jarak_km`, `harga_tiket`, `jam_buka`, `jam_tutup`, `buka_24jam`, `deskripsi`, `foto_utama`, `fasilitas`, `status_aktif`, `dibuat_pada`) VALUES ('17', 'Pantai Teluk Asmara', '2', 'Malang Selatan', '-8.4429424', '112.6654655', '6', '68.5', '15000', NULL, NULL, '1', 'Teluk cantik dengan pulau-pulau kecil dan pemandangan indah.', 'destinasi/A5gk5ai34zJqehoiUncWBEKuBm4qye9DETymDz28.jpg', 'pantai,gazebo,camping_ground,spot_foto', '1', '2026-06-22 22:42:49');
INSERT INTO `destinasi` (`id_destinasi`, `nama`, `id_kategori`, `lokasi`, `latitude`, `longitude`, `ketinggian_mdpl`, `jarak_km`, `harga_tiket`, `jam_buka`, `jam_tutup`, `buka_24jam`, `deskripsi`, `foto_utama`, `fasilitas`, `status_aktif`, `dibuat_pada`) VALUES ('18', 'Pantai Goa Cina', '2', 'Malang Selatan', '-8.4471919', '112.6537097', '3', '67.2', '15000', NULL, NULL, '1', 'Pantai alami dengan ombak kuat dan batu karang.', 'destinasi/tFXSj7pcbtunuty9KA1EYRvfop5uDbLx3GFaZROH.jpg', 'pantai,goa,warung,mushola', '1', '2026-06-22 22:42:49');
INSERT INTO `destinasi` (`id_destinasi`, `nama`, `id_kategori`, `lokasi`, `latitude`, `longitude`, `ketinggian_mdpl`, `jarak_km`, `harga_tiket`, `jam_buka`, `jam_tutup`, `buka_24jam`, `deskripsi`, `foto_utama`, `fasilitas`, `status_aktif`, `dibuat_pada`) VALUES ('19', 'Selecta', '5', 'Kota Batu, Malang Raya', '-7.8220855', '112.5266120', '1100', '23.0', '40000', '07:00:00', '17:00:00', '0', 'Taman wisata keluarga dengan kebun bunga dan area bermain.', 'destinasi/lEtmo8kzsvLdnVop3GlZQyhz9hVU1wnNS5f0uXri.jpg', 'kolam_renang,taman_bunga,wahana,hotel', '1', '2026-06-22 22:42:49');
INSERT INTO `destinasi` (`id_destinasi`, `nama`, `id_kategori`, `lokasi`, `latitude`, `longitude`, `ketinggian_mdpl`, `jarak_km`, `harga_tiket`, `jam_buka`, `jam_tutup`, `buka_24jam`, `deskripsi`, `foto_utama`, `fasilitas`, `status_aktif`, `dibuat_pada`) VALUES ('20', 'Florawisata Santerra De Laponte', '6', 'Pujon, Malang Raya', '-7.8542907', '112.4857585', '1200', '29.5', '30000', '08:00:00', '17:00:00', '0', 'Taman bunga populer dengan banyak spot foto dan wahana.', 'destinasi/UpYeNXSKNeadA6h3oX1xG4KLMlgJAmFniJWFlZPG.jpg', 'taman_bunga,spot_foto,playground,cafe', '1', '2026-06-22 22:42:49');
INSERT INTO `destinasi` (`id_destinasi`, `nama`, `id_kategori`, `lokasi`, `latitude`, `longitude`, `ketinggian_mdpl`, `jarak_km`, `harga_tiket`, `jam_buka`, `jam_tutup`, `buka_24jam`, `deskripsi`, `foto_utama`, `fasilitas`, `status_aktif`, `dibuat_pada`) VALUES ('21', 'Kebun Teh Wonosari', '3', 'Lawang, Kabupaten Malang', '-7.8204902', '112.6431502', '1050', '22.0', '25000', '07:00:00', '17:00:00', '0', 'Perkebunan teh dengan udara sejuk dan pemandangan hijau.', 'destinasi/Rxssi1m6imGf1AVonsZbN1QsMxagUCgH2cAwEaFs.jpg', 'tea_walk,kolam_renang,penginapan,outbound', '1', '2026-06-22 22:42:49');
INSERT INTO `destinasi` (`id_destinasi`, `nama`, `id_kategori`, `lokasi`, `latitude`, `longitude`, `ketinggian_mdpl`, `jarak_km`, `harga_tiket`, `jam_buka`, `jam_tutup`, `buka_24jam`, `deskripsi`, `foto_utama`, `fasilitas`, `status_aktif`, `dibuat_pada`) VALUES ('22', 'Sumber Maron', '4', 'Kabupaten Malang', '-8.1656096', '112.5920333', '450', '26.0', '10000', '07:00:00', '17:00:00', '0', 'Sungai alami dengan air jernih dan aktivitas tubing.', 'destinasi/lAtSlsRx20XCnqZ8PUfTLQ8Y64EHFGZDmXufvr6b.jpg', 'river_tubing,air_terjun_kecil,warung', '1', '2026-06-22 22:42:49');
INSERT INTO `destinasi` (`id_destinasi`, `nama`, `id_kategori`, `lokasi`, `latitude`, `longitude`, `ketinggian_mdpl`, `jarak_km`, `harga_tiket`, `jam_buka`, `jam_tutup`, `buka_24jam`, `deskripsi`, `foto_utama`, `fasilitas`, `status_aktif`, `dibuat_pada`) VALUES ('23', 'Sumber Jenon', '4', 'Kabupaten Malang', '-8.0497030', '112.7164399', '460', '21.0', '10000', '08:00:00', '17:00:00', '0', 'Sumber air alami dengan suasana tenang dan jernih.', 'destinasi/g7IUUmijF2XlBQAbdb3ogGvkhub0vpr3PlCfiIu9.jpg', 'pemandian_alami,pohon_fosil,mushola', '1', '2026-06-22 22:42:49');
INSERT INTO `destinasi` (`id_destinasi`, `nama`, `id_kategori`, `lokasi`, `latitude`, `longitude`, `ketinggian_mdpl`, `jarak_km`, `harga_tiket`, `jam_buka`, `jam_tutup`, `buka_24jam`, `deskripsi`, `foto_utama`, `fasilitas`, `status_aktif`, `dibuat_pada`) VALUES ('24', 'Sumber Sirah', '4', 'Kabupaten Malang', '-8.1228293', '112.6206066', '435', '24.5', '10000', '08:00:00', '17:00:00', '0', 'Mata air alami yang terkenal jernih dan asri.', 'destinasi/wF0qsK7zWv8LtxtjWNcNCHbEPqMSk4AHt8m8PGV8.jpg', 'snorkeling_air_tawar,tanaman_air,ban_sewa', '1', '2026-06-22 22:42:49');
INSERT INTO `destinasi` (`id_destinasi`, `nama`, `id_kategori`, `lokasi`, `latitude`, `longitude`, `ketinggian_mdpl`, `jarak_km`, `harga_tiket`, `jam_buka`, `jam_tutup`, `buka_24jam`, `deskripsi`, `foto_utama`, `fasilitas`, `status_aktif`, `dibuat_pada`) VALUES ('25', 'Taman Wisata Air Wendit', '4', 'Kabupaten Malang', '-7.9524529', '112.6749379', '465', '8.2', '20000', '08:00:00', '17:00:00', '0', 'Pemandian wisata bersejarah sejak lama.', 'destinasi/3WMEqGgss4XeiS08nycakGeYYj3vD1TWZnnQWBii.jpg', 'kolam_renang,kera_jinak,perahu_dayung', '1', '2026-06-22 22:42:49');
INSERT INTO `destinasi` (`id_destinasi`, `nama`, `id_kategori`, `lokasi`, `latitude`, `longitude`, `ketinggian_mdpl`, `jarak_km`, `harga_tiket`, `jam_buka`, `jam_tutup`, `buka_24jam`, `deskripsi`, `foto_utama`, `fasilitas`, `status_aktif`, `dibuat_pada`) VALUES ('26', 'Taman Labirin Coban Rondo', '5', 'Pujon, Malang Raya', '-7.8682192', '112.4850916', '1135', '32.0', '20000', '08:00:00', '17:00:00', '0', 'Labirin seru yang dekat dengan kawasan Coban Rondo.', 'destinasi/SEmAxF9Gzut4wiwIj6GPluHkGTWS3h22e9frDdK9.jpg', 'labirin,spot_foto,wahana_bermain', '1', '2026-06-22 22:42:49');
INSERT INTO `destinasi` (`id_destinasi`, `nama`, `id_kategori`, `lokasi`, `latitude`, `longitude`, `ketinggian_mdpl`, `jarak_km`, `harga_tiket`, `jam_buka`, `jam_tutup`, `buka_24jam`, `deskripsi`, `foto_utama`, `fasilitas`, `status_aktif`, `dibuat_pada`) VALUES ('27', 'Batu Night Spectacular', '5', 'Kota Batu, Malang Raya', '-7.8965741', '112.5345361', '600', '19.5', '40000', '15:00:00', '23:00:00', '0', 'Wahana malam populer untuk keluarga dan remaja.', 'destinasi/91hqwx0sdU6pyW9SmpC6uxQa8bVoRcZkeb5QuDTC.jpg', 'wahana,lampion,gokart,foodcourt', '1', '2026-06-22 22:42:49');
INSERT INTO `destinasi` (`id_destinasi`, `nama`, `id_kategori`, `lokasi`, `latitude`, `longitude`, `ketinggian_mdpl`, `jarak_km`, `harga_tiket`, `jam_buka`, `jam_tutup`, `buka_24jam`, `deskripsi`, `foto_utama`, `fasilitas`, `status_aktif`, `dibuat_pada`) VALUES ('28', 'Hawai Waterpark Malang', '5', 'Kota Malang', '-7.9234101', '112.6578620', '415', '7.2', '85000', '10:00:00', '18:00:00', '0', 'Waterpark besar dengan banyak wahana air.', 'destinasi/JsjVjfF3Et5XK4IvmQefiACj0oa3axkGaDvZofSL.jpg', 'kolam_ombak,seluncuran,lazy_river,gazebo', '1', '2026-06-22 22:42:49');
INSERT INTO `destinasi` (`id_destinasi`, `nama`, `id_kategori`, `lokasi`, `latitude`, `longitude`, `ketinggian_mdpl`, `jarak_km`, `harga_tiket`, `jam_buka`, `jam_tutup`, `buka_24jam`, `deskripsi`, `foto_utama`, `fasilitas`, `status_aktif`, `dibuat_pada`) VALUES ('29', 'Candi Badut', '7', 'Kota Malang', '-7.9578376', '112.5985719', '460', '5.1', '5000', '08:00:00', '16:00:00', '0', 'Candi bersejarah yang menjadi peninggalan budaya penting.', 'destinasi/ZYg55XRQgrGTAUsLFqT93HBjM6qnMrkuhnHHaUgo.jpg', 'sejarah,taman,cagar_budaya', '1', '2026-06-22 22:42:49');
INSERT INTO `destinasi` (`id_destinasi`, `nama`, `id_kategori`, `lokasi`, `latitude`, `longitude`, `ketinggian_mdpl`, `jarak_km`, `harga_tiket`, `jam_buka`, `jam_tutup`, `buka_24jam`, `deskripsi`, `foto_utama`, `fasilitas`, `status_aktif`, `dibuat_pada`) VALUES ('30', 'Taman Rekreasi Sengkaling', '5', 'Kabupaten Malang', '-7.9153841', '112.5889089', '480', '9.4', '30000', '08:00:00', '16:00:00', '0', 'Taman rekreasi keluarga dengan wahana air dan area santai.', 'destinasi/X2AyvCf0K4Jq7OVNyLc2NWDPH2OYQeiyMDI40D4G.jpg', 'kolam_renang,satwa,playground,kuliner', '1', '2026-06-22 22:42:49');

DROP TABLE IF EXISTS `galeri_destinasi`;
CREATE TABLE `galeri_destinasi` (
  `id_galeri` int NOT NULL AUTO_INCREMENT,
  `id_destinasi` int NOT NULL,
  `url_foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urutan` int DEFAULT '0',
  PRIMARY KEY (`id_galeri`),
  KEY `id_destinasi` (`id_destinasi`),
  CONSTRAINT `galeri_destinasi_ibfk_1` FOREIGN KEY (`id_destinasi`) REFERENCES `destinasi` (`id_destinasi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id_admin` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dibuat_pada` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_admin`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admin` (`id_admin`, `username`, `password_hash`, `dibuat_pada`) VALUES ('2', 'admin_lereng', '$2y$10$5FI8jhTJX1A81FgnXrTcBOhu.8fZZNOTxe9JUvdooNGin.dzpcEmO', '2026-06-26 21:45:58');

DROP TABLE IF EXISTS `chatbot_log`;
CREATE TABLE `chatbot_log` (
  `id_log` int NOT NULL AUTO_INCREMENT,
  `sesi_id` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kategori` int DEFAULT NULL,
  `jarak_pilihan` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anggaran_pilihan` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_hasil` int DEFAULT '0',
  `dibuat_pada` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_log`),
  KEY `id_kategori` (`id_kategori`),
  CONSTRAINT `chatbot_log_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `chatbot_log` (`id_log`, `sesi_id`, `id_kategori`, `jarak_pilihan`, `anggaran_pilihan`, `jumlah_hasil`, `dibuat_pada`) VALUES ('1', 'bc2851cd-6834-4e81-82a8-df5a4c3f4cfb', '5', 'sedang', 'murah', '0', '2026-06-23 00:04:34');
INSERT INTO `chatbot_log` (`id_log`, `sesi_id`, `id_kategori`, `jarak_pilihan`, `anggaran_pilihan`, `jumlah_hasil`, `dibuat_pada`) VALUES ('2', '1f2ba7d8-19a2-4586-9129-9682bae2b478', '5', 'sedang', 'murah', '0', '2026-06-23 00:04:44');
INSERT INTO `chatbot_log` (`id_log`, `sesi_id`, `id_kategori`, `jarak_pilihan`, `anggaran_pilihan`, `jumlah_hasil`, `dibuat_pada`) VALUES ('3', 'SMA9DlzRP7PW1R0k3ZPcufcPbjJGQvEdXY7J1jnl', '1', '10-25', '10000-20000', '1', '2026-06-25 23:01:35');
INSERT INTO `chatbot_log` (`id_log`, `sesi_id`, `id_kategori`, `jarak_pilihan`, `anggaran_pilihan`, `jumlah_hasil`, `dibuat_pada`) VALUES ('4', 'SMA9DlzRP7PW1R0k3ZPcufcPbjJGQvEdXY7J1jnl', '2', '10-25', '<10000', '0', '2026-06-25 23:02:21');
INSERT INTO `chatbot_log` (`id_log`, `sesi_id`, `id_kategori`, `jarak_pilihan`, `anggaran_pilihan`, `jumlah_hasil`, `dibuat_pada`) VALUES ('5', 'SMA9DlzRP7PW1R0k3ZPcufcPbjJGQvEdXY7J1jnl', NULL, '<10', NULL, '5', '2026-06-25 23:02:35');
INSERT INTO `chatbot_log` (`id_log`, `sesi_id`, `id_kategori`, `jarak_pilihan`, `anggaran_pilihan`, `jumlah_hasil`, `dibuat_pada`) VALUES ('6', 'SMA9DlzRP7PW1R0k3ZPcufcPbjJGQvEdXY7J1jnl', NULL, '25-50', NULL, '4', '2026-06-25 23:09:34');
INSERT INTO `chatbot_log` (`id_log`, `sesi_id`, `id_kategori`, `jarak_pilihan`, `anggaran_pilihan`, `jumlah_hasil`, `dibuat_pada`) VALUES ('7', 'SMA9DlzRP7PW1R0k3ZPcufcPbjJGQvEdXY7J1jnl', '2', '10-25', NULL, '0', '2026-06-25 23:16:51');
INSERT INTO `chatbot_log` (`id_log`, `sesi_id`, `id_kategori`, `jarak_pilihan`, `anggaran_pilihan`, `jumlah_hasil`, `dibuat_pada`) VALUES ('8', 'SMA9DlzRP7PW1R0k3ZPcufcPbjJGQvEdXY7J1jnl', NULL, '>50', NULL, '5', '2026-06-25 23:17:00');
INSERT INTO `chatbot_log` (`id_log`, `sesi_id`, `id_kategori`, `jarak_pilihan`, `anggaran_pilihan`, `jumlah_hasil`, `dibuat_pada`) VALUES ('9', 'qI8qUYm179nHiabKfQFeeYuKEFpZx9NcDYYl45FM', '1', '10-25', 'gratis', '0', '2026-06-26 21:35:49');
INSERT INTO `chatbot_log` (`id_log`, `sesi_id`, `id_kategori`, `jarak_pilihan`, `anggaran_pilihan`, `jumlah_hasil`, `dibuat_pada`) VALUES ('10', 'pCnCNP2wA0qvOZpoTcPt56bVYTAmUXKlPUm2xuUm', '1', '10-25', 'gratis', '0', '2026-06-27 21:43:59');
INSERT INTO `chatbot_log` (`id_log`, `sesi_id`, `id_kategori`, `jarak_pilihan`, `anggaran_pilihan`, `jumlah_hasil`, `dibuat_pada`) VALUES ('11', 'pCnCNP2wA0qvOZpoTcPt56bVYTAmUXKlPUm2xuUm', NULL, '10-25', NULL, '5', '2026-06-27 21:44:11');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('1', '0001_01_01_000000_create_kategori_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('2', '0001_01_01_000001_create_destinasi_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('3', '0001_01_01_000002_create_galeri_destinasi_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('4', '0001_01_01_000003_create_chatbot_log_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('5', '0001_01_01_000004_create_admin_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('6', '2026_07_02_231734_add_lat_lng_to_destinasi_table', '2');

