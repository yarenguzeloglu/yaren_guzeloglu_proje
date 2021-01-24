-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 24 Oca 2021, 16:51:11
-- Sunucu sürümü: 10.4.16-MariaDB
-- PHP Sürümü: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `2018469034`
--

DELIMITER $$
--
-- Yordamlar
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `soru_1` (IN `isim` VARCHAR(50))  NO SQL
SELECT bolgeler.bolge_adi,iller.il_id
FROM bolgeler,iller
WHERE iller.bolge_id=bolgeler.bolge_id AND bolgeler.bolge_adi LIKE CONCAT('%',isim,'%')$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `soru_10` ()  NO SQL
SELECT SUBSTR(urunler.urun_adi, 1, 1) AS ilk_harf, COUNT(*) AS urun_sayisi
FROM urunler
GROUP BY SUBSTR(urunler.urun_adi, 1)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `soru_2` (IN `isim` VARCHAR(50))  NO SQL
SELECT kategoriler.kategori_adi, MAX(urunler.fiyat)
FROM urunler,kategoriler
WHERE kategoriler.kategori_id=urunler.kategori_id
and kategoriler.kategori_adi LIKE concat('%',isim,'%')$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `soru_3` (IN `isim` VARCHAR(50))  NO SQL
SELECT iller.il_adi, COUNT(magazalar.magaza_id) as magaza_sayisi
FROM iller LEFT JOIN magazalar ON iller.il_id=magazalar.il_id
WHERE iller.il_adi=isim$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `soru_4` (IN `id` INT(50))  NO SQL
SELECT kategoriler.kategori_id,urunler.urun_id,urunler.urun_adi,satis.adet
FROM kategoriler,urunler,satis
WHERE kategoriler.kategori_id=urunler.kategori_id AND urunler.urun_id=satis.urun_id AND kategoriler.kategori_id LIKE CONCAT('%',id,'%')$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `soru_5` (IN `ad` VARCHAR(50))  NO SQL
SELECT bolgeler.bolge_adi,COUNT(iller.il_id) AS il_sayisi
FROM iller LEFT JOIN bolgeler ON bolgeler.bolge_id=iller.bolge_id
WHERE bolgeler.bolge_adi LIKE concat('%',ad,'%')
GROUP BY bolgeler.bolge_id
ORDER BY il_sayisi$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `soru_6` ()  NO SQL
SELECT iller.il_adi as mağazası_olmayan_il FROM iller LEFT JOIN magazalar ON iller.il_id=magazalar.il_id WHERE magazalar.magaza_id IS NULL$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `soru_7` ()  NO SQL
SELECT kategoriler.kategori_adi as kategori_adi,
COUNT(urunler.urun_id) as urun_sayisi
FROM urunler,kategoriler
WHERE urunler.kategori_id=kategoriler.kategori_id
GROUP BY kategoriler.kategori_id
HAVING urun_sayisi=(SELECT max(toplam) from (select COUNT(urunler.urun_id)
as toplam FROM urunler,kategoriler WHERE urunler.kategori_id=kategoriler.kategori_id
GROUP BY kategoriler.kategori_id)as sonuc)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `soru_8` ()  NO SQL
SELECT urunler.urun_adi, (satis.adet) as satis_sayisi
FROM satis,urunler
WHERE satis.urun_id=urunler.urun_id
GROUP BY urunler.urun_id
HAVING satis_sayisi>50$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `soru_9` ()  NO SQL
SELECT iller.il_adi, COUNT(magazalar.magaza_id) as magaza_sayisi 
FROM iller,magazalar                                      
WHERE iller.il_id=magazalar.il_id AND iller.il_adi LIKE 'E%'
GROUP BY iller.il_id$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bolgeler`
--

CREATE TABLE `bolgeler` (
  `bolge_id` int(11) NOT NULL,
  `bolge_adi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `bolgeler`
--

INSERT INTO `bolgeler` (`bolge_id`, `bolge_adi`) VALUES
(1, 'Akdeniz'),
(3, 'Karadeniz'),
(5, 'Ege'),
(7, 'Marmara'),
(9, 'İç Anadolu');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `iller`
--

CREATE TABLE `iller` (
  `il_id` int(11) NOT NULL,
  `il_adi` varchar(50) NOT NULL,
  `bolge_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `iller`
--

INSERT INTO `iller` (`il_id`, `il_adi`, `bolge_id`) VALUES
(5, 'Amasya', 3),
(7, 'Antalya', 1),
(9, 'Aydın', 5),
(17, 'Çanakkale', 7),
(26, 'Eskişehir', 9),
(35, 'İzmir', 5);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategoriler`
--

CREATE TABLE `kategoriler` (
  `kategori_id` int(11) NOT NULL,
  `kategori_adi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `kategoriler`
--

INSERT INTO `kategoriler` (`kategori_id`, `kategori_adi`) VALUES
(44, 'Makyaj ve Makyaj Temizleme Ürünleri'),
(55, 'Koku Verici Ürünler'),
(66, 'Cilt Bakım Ürünleri'),
(77, 'Güneş Ürünleri'),
(88, 'Saç Bakım Ürünleri');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `magazalar`
--

CREATE TABLE `magazalar` (
  `magaza_id` int(11) NOT NULL,
  `magaza_adi` varchar(50) NOT NULL,
  `il_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `magazalar`
--

INSERT INTO `magazalar` (`magaza_id`, `magaza_adi`, `il_id`) VALUES
(123, 'Amasya Mağazası', 5),
(159, 'Çanakkale Mağazası', 17),
(234, 'Antalya Mağazası', 7),
(333, 'buca', 35),
(345, 'Eskişehir Mağazası', 26),
(951, 'İzmir Mağazası', 35);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `satis`
--

CREATE TABLE `satis` (
  `satis_id` int(11) NOT NULL,
  `urun_id` int(11) NOT NULL,
  `magaza_id` int(11) NOT NULL,
  `adet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `satis`
--

INSERT INTO `satis` (`satis_id`, `urun_id`, `magaza_id`, `adet`) VALUES
(101563, 6548, 345, 65),
(106589, 8452, 123, 168),
(106598, 2485, 159, 94),
(123456, 5409, 123, 55),
(130569, 6548, 234, 56),
(145236, 8955, 345, 65),
(195087, 3757, 951, 128),
(200035, 2654, 951, 55),
(201365, 8452, 951, 79),
(203654, 9025, 123, 65),
(204596, 8452, 159, 69),
(255695, 2654, 123, 49),
(302548, 8452, 345, 88),
(302569, 9025, 159, 100),
(321020, 6548, 123, 60),
(325498, 3568, 951, 83),
(325986, 2654, 234, 96),
(326575, 7412, 234, 62),
(330056, 7412, 951, 42),
(352689, 8788, 345, 56),
(356789, 2485, 123, 102),
(356985, 8955, 123, 15),
(360569, 2654, 345, 82),
(379185, 3568, 345, 68),
(426859, 2485, 951, 91),
(504785, 2654, 159, 56),
(526895, 3757, 123, 90),
(560239, 5409, 345, 78),
(562308, 7412, 345, 55),
(562389, 9025, 234, 158),
(568907, 9025, 951, 122),
(585694, 8788, 123, 23),
(605320, 6548, 951, 69),
(608957, 5409, 159, 68),
(659814, 2485, 234, 135),
(675687, 8955, 234, 297),
(745896, 8452, 234, 59),
(753645, 8788, 234, 140),
(759986, 3568, 123, 38),
(789056, 6548, 159, 68),
(852365, 8955, 951, 156),
(856974, 3568, 234, 165),
(856978, 3568, 159, 85),
(858855, 5409, 951, 68),
(897569, 3757, 159, 68),
(907583, 8788, 951, 199),
(908765, 3757, 345, 100),
(950236, 2485, 345, 126),
(958476, 5409, 234, 104),
(959585, 7412, 159, 50),
(966565, 7412, 123, 52),
(978676, 8955, 159, 89),
(985603, 8788, 159, 82),
(985674, 9025, 345, 78),
(987654, 3757, 234, 112);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

CREATE TABLE `urunler` (
  `urun_id` int(11) NOT NULL,
  `urun_adi` varchar(50) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `fiyat` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`urun_id`, `urun_adi`, `kategori_id`, `fiyat`) VALUES
(2485, 'Parfüm', 55, 76),
(2654, 'Saç Şekillendirici Sprey', 88, 59),
(3568, 'Makyaj Sabitleyici', 44, 17),
(3757, 'Deodorant', 55, 22),
(5409, 'Saç Köpüğü', 88, 23),
(6548, 'Saç Kremi', 88, 25),
(7412, 'Tonik', 66, 10),
(8452, 'Nemlendirici', 66, 6),
(8788, 'Güneş Sonrası Jel', 77, 27),
(8955, 'Güneş Öncesi Losyon', 77, 55),
(9025, 'Makyaj Malzemeleri Seti', 44, 110);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yonetici`
--

CREATE TABLE `yonetici` (
  `id` int(11) NOT NULL,
  `e_posta` text NOT NULL,
  `parola` text NOT NULL,
  `yonetici_adi` varchar(50) NOT NULL,
  `yonetici_soyadi` varchar(50) NOT NULL,
  `avatar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `yonetici`
--

INSERT INTO `yonetici` (`id`, `e_posta`, `parola`, `yonetici_adi`, `yonetici_soyadi`, `avatar`) VALUES
(1, 'yaren@gmail.com', '123456', 'Yaren', 'Güzeloğlu', 'img/fotograf.jpeg');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `bolgeler`
--
ALTER TABLE `bolgeler`
  ADD PRIMARY KEY (`bolge_id`);

--
-- Tablo için indeksler `iller`
--
ALTER TABLE `iller`
  ADD PRIMARY KEY (`il_id`),
  ADD KEY `bolge_id` (`bolge_id`);

--
-- Tablo için indeksler `kategoriler`
--
ALTER TABLE `kategoriler`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Tablo için indeksler `magazalar`
--
ALTER TABLE `magazalar`
  ADD PRIMARY KEY (`magaza_id`),
  ADD KEY `il_id` (`il_id`);

--
-- Tablo için indeksler `satis`
--
ALTER TABLE `satis`
  ADD PRIMARY KEY (`satis_id`),
  ADD KEY `urun_id` (`urun_id`),
  ADD KEY `magaza_id` (`magaza_id`);

--
-- Tablo için indeksler `urunler`
--
ALTER TABLE `urunler`
  ADD PRIMARY KEY (`urun_id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Tablo için indeksler `yonetici`
--
ALTER TABLE `yonetici`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `yonetici_adi` (`yonetici_adi`,`yonetici_soyadi`,`avatar`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `yonetici`
--
ALTER TABLE `yonetici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `iller`
--
ALTER TABLE `iller`
  ADD CONSTRAINT `iller_ibfk_1` FOREIGN KEY (`bolge_id`) REFERENCES `bolgeler` (`bolge_id`);

--
-- Tablo kısıtlamaları `magazalar`
--
ALTER TABLE `magazalar`
  ADD CONSTRAINT `magazalar_ibfk_1` FOREIGN KEY (`il_id`) REFERENCES `iller` (`il_id`);

--
-- Tablo kısıtlamaları `satis`
--
ALTER TABLE `satis`
  ADD CONSTRAINT `satis_ibfk_1` FOREIGN KEY (`magaza_id`) REFERENCES `magazalar` (`magaza_id`),
  ADD CONSTRAINT `satis_ibfk_2` FOREIGN KEY (`urun_id`) REFERENCES `urunler` (`urun_id`);

--
-- Tablo kısıtlamaları `urunler`
--
ALTER TABLE `urunler`
  ADD CONSTRAINT `urunler_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategoriler` (`kategori_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
