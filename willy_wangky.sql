-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Okt 2020 pada 12.35
-- Versi server: 8.0.17
-- Versi PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `willy_wangky`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `account`
--

CREATE TABLE `account` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `authorization` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `account`
--

INSERT INTO `account` (`username`, `password`, `email`, `authorization`) VALUES
('kite', 'kite123', 'kite@gmail.com', 'user'),
('lina', 'lina123', 'lina@gmail.com', 'user'),
('lionnarta', 'lio123', 'lio123@gmail.com', 'superuser'),
('lionnartas', 'lios123', 'lios123@gmail.com', 'user'),
('rinne', 'rin123', 'rinne@gmail.com', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `coklat`
--

CREATE TABLE `coklat` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sold` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `coklat`
--

INSERT INTO `coklat` (`id`, `name`, `sold`, `price`, `amount`, `description`, `image`) VALUES
(1, 'choco', 20, 40000, 190, 'Cokelat dengan rasa seperti cokelat.', 'img/choco.jpeg'),
(2, 'coklat', 100, 30000, 342, 'Cokelat. cokelat. ya cokelat.', 'img/coklat.jpg'),
(3, 'bittersweat chocolate', 94, 76000, 143, 'Sweet dan semisweet mengandung sejumlah 15% hingga 35% cairan cokelat.', 'img/bittersweat_chocolate.jpg'),
(4, 'chocochip', 301, 25000, 681, 'Cokelat dengan bentuk butiran kecil.', 'img/chocochip.jpg'),
(5, 'cocoa powder', 49, 20000, 250, 'serbuk cokelat dengan rasa cokelat.', 'img/cocoa_powder.jpg'),
(6, 'compound chocolate', 15, 65000, 97, 'cokelat yang dapat digunakan sebagai pelapis makanan lainnya.', 'img/compound_chocolate.jpg'),
(7, 'dark chocolate', 343, 100000, 503, 'dark chocolate adalah cokelat yang mengandung cocoa solids, cocoa butter, tanpa susu.', 'img/dark_chocolate.jpg'),
(8, 'milk chocolate', 234, 89000, 124, 'Milk chocolate adalah cokelat padat yang mengandung cocoa, gula dan susu.', 'img/milk_chocolate.jpg'),
(9, 'modeling chocolate', 5, 76000, 43, 'cokelat yang bisa dibentuk sesuka hati.', 'img/modeling_chocolate.jpg'),
(10, 'raw chocolate', 86, 35000, 70, 'cokelat yang tebuat dari cocoa beans yang tidak dipanggang.', 'img/raw_chocolate.jpg'),
(11, 'ruby chocolate', 43, 90000, 78, 'variasi cokelat unik yang bikin ketagian.', 'img/ruby_chocolate.jpg'),
(12, 'valrhona chocolate', 24, 58000, 36, 'cokelat ekslusif buatan prancis yang tebuat dari cocoa beans murni.', 'img/valrhona_chocolate.jpg'),
(13, 'white chocolate', 100, 45000, 319, 'white chocolate adalah cokelat buatam, terbuat dari cocoa butter, gula, susu dan terkadang vanila.', 'img/white_chocolate.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `address` text NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `history`
--

INSERT INTO `history` (`id`, `name`, `amount`, `total_price`, `date`, `time`, `address`, `username`) VALUES
(1, 'milk chocolate', 3, 267000, '2020-10-25', '11:40:50', 'indonesia', 'lionnartas'),
(2, 'white chocolate', 2, 90000, '2020-10-25', '11:53:48', 'Jakarta', 'lionnartas');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `coklat`
--
ALTER TABLE `coklat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `coklat`
--
ALTER TABLE `coklat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`username`) REFERENCES `account` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
