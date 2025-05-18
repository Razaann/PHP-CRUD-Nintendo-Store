-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2025 at 05:18 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nintendo1`
--

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `name`, `description`, `price`, `img`, `user_id`) VALUES
(22, 'NARUTO X BORUTO Ultimate Ninja STORM CONNECTIONS', 'NARUTO X BORUTO Ultimate Ninja STORM CONNECTIONS hadir sebagai permainan aksi dan pertarungan yang mendebarkan di Nintendo Switch. Dalam entri terbaru dari seri STORM ini, ninja-ninja legendaris dari dunia Naruto dan Boruto bersatu kembali untuk pertempuran epik!', 499000, 'uploads/6813e6394480d.jpg', 0),
(23, 'Hogwarts Legacy', 'Hogwarts Legacy membawa pengalaman sihir yang mendalam dan penuh petualangan ke genggaman Anda. Dalam game ini, Anda akan menjelajahi Hogwarts dan daerah sekitarnya dalam dunia Harry Potter yang terkenal, menghadapi makhluk sihir, memecahkan teka-teki, dan mengembangkan kemampuan sihir Anda.', 799000, 'uploads/6813ebaec29af.webp', 0),
(25, 'EA SPORTS FC 25', 'EA SPORTS FC 25 menghadirkan pengalaman sepak bola yang mendalam dengan gameplay yang disempurnakan dan beragam fitur baru. Sebagai bagian dari waralaba sepak bola terkenal, game ini menawarkan simulasi sepak bola yang realistis dengan grafis yang ditingkatkan, animasi yang lebih halus, serta kontrol yang responsif.', 599000, 'uploads/6814164ac3ded.avif', 0),
(28, 'LEGO DC Super-Villains', 'LEGO DC Super-Villains adalah game petualangan dan puzzle yang dikembangkan oleh TT Games dan diterbitkan oleh Warner Bros. Interactive Entertainment. Game ini pertama kali dirilis pada tahun 2018 dan sekarang telah tersedia di Nintendo Switch. Game ini mengambil setting dari dunia fiksi DC Comics yang terkenal dengan karakter-karakter superhero dan supervillainnya.', 349000, 'uploads/681daa51ba917.jpg', 0),
(29, 'LEGO Marvel Super Heroes 2', 'LEGO Marvel Super Heroes 2 mengikuti petualangan para superhero Marvel dalam cerita asli yang terinspirasi dari buku komik Marvel. Pemain mengambil peran sebagai Guardians of the Galaxy, Spider-Man, Thor, Hulk, dan banyak lagi karakter populer dalam alam semesta Marvel. Setiap karakter memiliki kemampuan dan kekuatan unik, yang memungkinkan pemain untuk mengatasi berbagai rintangan dan musuh.', 459000, 'uploads/681daa85bedfd.jpg', 0),
(30, 'MotoGP 25', 'MotoGP™25 menghadirkan pengalaman balap motor realistis dengan grafis memukau, suara autentik, dan mode karier dinamis. Tersedia dua gaya bermain—Arcade dan Pro—serta fitur kustomisasi lengkap dan multiplayer lokal. Cocok untuk semua pecinta kecepatan di lintasan MotoGP.', 399000, 'uploads/6826e9f83a905.jpg', 0),
(31, 'Animal Crossing: New Horizons', 'Animal Crossing: New Horizons adalah game simulasi kehidupan yang dikembangkan oleh Nintendo dan dirilis pada 20 Maret 2020 untuk konsol Nintendo Switch. Game ini menjadi sangat populer karena memberikan pengalaman yang menyenangkan dalam membuat dan mengelola pulau yang indah.', 899000, 'uploads/6826ea5e7aac3.jpg', 0),
(32, 'The Legend of Zelda : Breath of the Wild', 'The Legend of Zelda: Breath of the Wild adalah game petualangan yang dikembangkan dan diterbitkan oleh Nintendo untuk konsol Nintendo Switch. Game ini adalah game terbaru dalam seri The Legend of Zelda dan dirilis pada tanggal 3 Maret 2017. Game ini diakui sebagai salah satu game terbaik sepanjang masa dan memenangkan banyak penghargaan, termasuk “Game of the Year” di The Game Awards 2017.', 799000, 'uploads/6826eacb3e066.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `created_at`) VALUES
(1, 'Ran', 'ozexo11@gmail.com', '$2y$10$2.TH206T8tRU6jWHhks0xuQbffmF4rDl8vAkHb2q03filIke1TUZm', '2025-05-01 21:21:22'),
(4, 'Mas Raffi', 'MasRaffi@gmail.com', '$2y$10$qWwNxNxJBncbLAhbBFuopuE3o/TgKjS7XUB0NJy0C.ED5vQ0EQeSu', '2025-05-02 08:11:36'),
(5, 'Admin1', 'admin123@gmail.com', '$2y$10$90c4VwzAUcYnmRGX0tN9u.YcQvVijehM6xc42tpd6zctSoS0GE3o2', '2025-05-16 06:14:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
