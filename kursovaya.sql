-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 06, 2023 at 01:48 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kursovaya`
--

-- --------------------------------------------------------

--
-- Table structure for table `BoughtItem`
--

CREATE TABLE `BoughtItem` (
  `id` int UNSIGNED NOT NULL,
  `ownerId` int UNSIGNED NOT NULL,
  `nftId` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Discount`
--

CREATE TABLE `Discount` (
  `id` int UNSIGNED NOT NULL,
  `discountHash` varchar(255) NOT NULL,
  `ownerId` int UNSIGNED NOT NULL,
  `invitedUsersCount` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Discount`
--

INSERT INTO `Discount` (`id`, `discountHash`, `ownerId`, `invitedUsersCount`) VALUES
(10, 'Z_coh8evF1', 20, 0),
(11, 'cKToTFYtYD', 21, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Language`
--

CREATE TABLE `Language` (
  `id` int UNSIGNED NOT NULL,
  `language` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Language`
--

INSERT INTO `Language` (`id`, `language`) VALUES
(1, 'ru-RU'),
(2, 'en-US');

-- --------------------------------------------------------

--
-- Table structure for table `Nft`
--

CREATE TABLE `Nft` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `amount` int NOT NULL,
  `ownerId` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Nft`
--

INSERT INTO `Nft` (`id`, `title`, `image`, `description`, `price`, `amount`, `ownerId`) VALUES
(7, 'NFT 1', '9StaF0UBJfih.gif', 'NFT #1', 1000, 55, 20),
(8, 'NFT 2', 'appleB_map.gif', 'NFT #2', 500, 124, 20),
(9, 'NFT 3', 'cactus.gif', 'NFT #3', 500, 32, 20),
(10, 'NFT 4', 'dMqxHmPPA8fd.gif', 'NFT #3', 2000, 5, 20),
(11, 'NFT 5', 'doge.gif', 'NFT #5', 600, 33, 21),
(12, 'NFT 6', 'KITH_web.gif', 'NFT #6', 1000, 3, 21),
(13, 'NFT 7', 'non-fungible-token-3.gif', 'NFT #7', 1500, 12, 21),
(14, 'NFT 8', 'platy-punk-animated.gif', 'NFT #7', 100, 555, 21),
(15, 'NFT 8', 'unnamed.gif', 'NFT #8', 745, 22, 21),
(16, 'NFT 9', '02ba5e5eedbf48e993d37b288bc7aeb5.gif', 'NFT #9', 123, 55, 21),
(17, 'NFT 10', 'IMG_0519.gif', 'NFT 10', 545, 32, 21),
(18, 'NFT 11', 'non-fungible-token.gif', 'NFT #11', 867, 1234, 21),
(19, 'NFT 12', 'p1_3232540_725882d6.gif', 'NFT #12', 867, 99, 21),
(20, 'NFT 13', 'Paul-Rudd-Celery-Man-FIN.gif', 'NFT #13', 534, 123, 21),
(21, 'NFT 14', 'Pennywise_Pixel_gif_1626509130150.gif', 'NFT #14', 678, 33, 21),
(22, 'NFT 15', 'phazed-psychedelic-energy-hands-2-gif-1440.gif', 'NFT #15', 663, 123, 21),
(23, 'NFT 16', 'pixel-nft-monkey-x10a6irgrf9wypab.gif', 'NFT #16', 868, 123, 21),
(24, 'NFT 17', 'Sherlock+Toy+Face-high.gif', 'NFT #17', 774, 345, 21),
(25, 'NFT 18', 'tumblr_354e7abc631ce1dcee4c3445788f167f_f8065203_1280.gif', 'NFT #18', 657, 665, 21);

-- --------------------------------------------------------

--
-- Table structure for table `Profile`
--

CREATE TABLE `Profile` (
  `id` int UNSIGNED NOT NULL,
  `userId` int UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `website` varchar(255) NOT NULL,
  `languageId` int UNSIGNED NOT NULL,
  `wallet` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Profile`
--

INSERT INTO `Profile` (`id`, `userId`, `username`, `avatar`, `website`, `languageId`, `wallet`) VALUES
(11, 20, 'zaeba1sya', NULL, '', 1, '0xjDrxPQ-VtDsMZLWtegbrtTjhWgp_hwk1tyoj1A64'),
(12, 21, 'CryptoMan332', 'dreamy-beaver-jay-z.jpg', 'https://asdfa.com', 1, '0xBxxUnxv0z5yOmuX-TtktDlGOckj_GHgR74zYLEbl');

-- --------------------------------------------------------

--
-- Table structure for table `Purchases`
--

CREATE TABLE `Purchases` (
  `id` int UNSIGNED NOT NULL,
  `nftId` int UNSIGNED NOT NULL,
  `userId` int UNSIGNED NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Purchases`
--

INSERT INTO `Purchases` (`id`, `nftId`, `userId`, `timestamp`) VALUES
(5, 7, 20, '2023-03-05 22:28:24');

-- --------------------------------------------------------

--
-- Table structure for table `Role`
--

CREATE TABLE `Role` (
  `id` int UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Role`
--

INSERT INTO `Role` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'buyer'),
(3, 'merchant');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `id` int UNSIGNED NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `balance` int NOT NULL,
  `roleId` int UNSIGNED NOT NULL,
  `authKey` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `login`, `password`, `balance`, `roleId`, `authKey`) VALUES
(20, 'admin123', '$2y$13$kdoZY.u5/Xd0AMDZW6ngweebJ/0ITaEiQ0iIZ3zN7vs7QdXL7FFSK', 11000, 2, 'T921uDCvxDBsgM5QeSiMipXdgVIO9wFw'),
(21, 'crypto332', '$2y$13$Urjb0/aZZgZRWRt6gp.1hOH3gs8S8yaJzHw5rIR7F252UUFDXL.uy', 10000, 2, 'JLvZVjQ8dgLEFjXmAzfchfLnmAxDUbzJ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `BoughtItem`
--
ALTER TABLE `BoughtItem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nftId` (`nftId`),
  ADD KEY `ownerId` (`ownerId`);

--
-- Indexes for table `Discount`
--
ALTER TABLE `Discount`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ownerId` (`ownerId`);

--
-- Indexes for table `Language`
--
ALTER TABLE `Language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Nft`
--
ALTER TABLE `Nft`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ownerId` (`ownerId`);

--
-- Indexes for table `Profile`
--
ALTER TABLE `Profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `languageId` (`languageId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `Purchases`
--
ALTER TABLE `Purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nftId` (`nftId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `Role`
--
ALTER TABLE `Role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roleId` (`roleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `BoughtItem`
--
ALTER TABLE `BoughtItem`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Discount`
--
ALTER TABLE `Discount`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `Language`
--
ALTER TABLE `Language`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT for table `Nft`
--
ALTER TABLE `Nft`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `Profile`
--
ALTER TABLE `Profile`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `Purchases`
--
ALTER TABLE `Purchases`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Role`
--
ALTER TABLE `Role`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `BoughtItem`
--
ALTER TABLE `BoughtItem`
  ADD CONSTRAINT `boughtitem_ibfk_1` FOREIGN KEY (`nftId`) REFERENCES `Nft` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `boughtitem_ibfk_2` FOREIGN KEY (`ownerId`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Discount`
--
ALTER TABLE `Discount`
  ADD CONSTRAINT `discount_ibfk_1` FOREIGN KEY (`ownerId`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Nft`
--
ALTER TABLE `Nft`
  ADD CONSTRAINT `nft_ibfk_1` FOREIGN KEY (`ownerId`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Profile`
--
ALTER TABLE `Profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profile_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Purchases`
--
ALTER TABLE `Purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`nftId`) REFERENCES `Nft` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchases_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`roleId`) REFERENCES `Role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
