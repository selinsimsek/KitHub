-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 15 Ara 2024, 21:47:19
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `kithub`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `rating` decimal(3,2) DEFAULT 0.00,
  `thumbnail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `genre`, `rating`, `thumbnail`) VALUES
(5, 'Tutunamayanlar', 'Oğuz Atay', 'Roman', 4.00, 'tutunamayanlar.jpg'),
(6, 'Masumiyet Müzesi', 'Orhan Pamuk', 'Roman', 3.00, 'masumiyetmuzesi.jpeg'),
(7, 'Bir Ömür Nasıl Yaşanır', 'İlber Ortaylı', 'Yaratıcı Kurgu Dışı', 0.00, 'biromurnasilyasanir.jpg'),
(8, 'Gece Yarısı Kütüphanesi', 'Matt Haig', 'Bilim Kurgu', 0.00, 'geceyarisikutuphanesi.jpeg'),
(9, 'Körlük', 'Jose SARAMAGO', 'Roman', 5.00, 'Saramago_Körlük_(kitap).jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `reading_list_books`
--

CREATE TABLE `reading_list_books` (
  `id` int(11) NOT NULL,
  `reading_list_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `reading_list_books`
--

INSERT INTO `reading_list_books` (`id`, `reading_list_id`, `book_id`) VALUES
(1, 1, 5),
(2, 1, 6),
(3, 1, 8);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `review_text` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `rating` decimal(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `book_id`, `review_text`, `created_at`, `rating`) VALUES
(20, 1, 5, 'Çok güzel kitap', '2024-11-20 22:02:00', 5.00),
(21, 6, 5, ' Mutlaka okuyun', '2024-11-20 22:03:30', 3.00),
(22, 6, 6, 'akıcı değil', '2024-11-20 22:17:51', 3.00),
(23, 6, 9, ' bir tek metaforla su anda yaşadığımız gerçekliği bu kadar iyi anlattığı için takdire şayandır.', '2024-11-30 18:41:00', 5.00);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `username`, `email`, `password`, `profile_picture`) VALUES
(1, 'Eren', 'Bakır', 'eren0b', 'eren@gmail.com', '$2y$10$JfeDBL2GlSMBGPATyZ8uIepu0tKJYSlbFSEuvy1cgbU96RkWtjofW', NULL),
(5, 'Selin', 'Eren', 'selineren', 'selineneren@gmail.com', '$2y$10$tLxWJHYY3lNrG3NSGoNsz.YD3eG1eRpc85nobf/FAx0vDcHuMZW9i', NULL),
(6, 'Selin', 'Simsek', 'A.selinsimsek', 'selinsimsek@gmail.com', '$2y$10$YhlWwbSOrQjSjPnoR4VxtOFOaJH/wFB/PI9A9b956ln3QCL84o0yq', 'uploads/pexels-pengwhan-1767434 (1).jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_books`
--

CREATE TABLE `user_books` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `is_favorite` tinyint(1) DEFAULT 0,
  `to_read` tinyint(1) DEFAULT 0,
  `rating` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_reading_lists`
--

CREATE TABLE `user_reading_lists` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `list_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `user_reading_lists`
--

INSERT INTO `user_reading_lists` (`id`, `user_id`, `list_name`) VALUES
(1, 6, 'en sevdiklerim');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `reading_list_books`
--
ALTER TABLE `reading_list_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reading_list_id` (`reading_list_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Tablo için indeksler `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Tablo için indeksler `user_books`
--
ALTER TABLE `user_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Tablo için indeksler `user_reading_lists`
--
ALTER TABLE `user_reading_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `reading_list_books`
--
ALTER TABLE `reading_list_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `user_books`
--
ALTER TABLE `user_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `user_reading_lists`
--
ALTER TABLE `user_reading_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `reading_list_books`
--
ALTER TABLE `reading_list_books`
  ADD CONSTRAINT `reading_list_books_ibfk_1` FOREIGN KEY (`reading_list_id`) REFERENCES `user_reading_lists` (`id`),
  ADD CONSTRAINT `reading_list_books_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);

--
-- Tablo kısıtlamaları `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `user_books`
--
ALTER TABLE `user_books`
  ADD CONSTRAINT `user_books_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_books_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `user_reading_lists`
--
ALTER TABLE `user_reading_lists`
  ADD CONSTRAINT `user_reading_lists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
