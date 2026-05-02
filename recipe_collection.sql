-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2026 at 05:58 PM
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
-- Database: `recipe_collection`
--

-- --------------------------------------------------------

--
-- Table structure for table `recipies`
--

CREATE TABLE `recipies` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `difficulty` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `steps` text NOT NULL,
  `time` int(11) NOT NULL,
  `isPublic` int(11) NOT NULL DEFAULT 0,
  `savedCount` int(11) NOT NULL DEFAULT 0,
  `ownerName` varchar(30) NOT NULL,
  `ownerId` int(11) NOT NULL DEFAULT -1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipies`
--

INSERT INTO `recipies` (`id`, `title`, `difficulty`, `description`, `steps`, `time`, `isPublic`, `savedCount`, `ownerName`, `ownerId`) VALUES
(19, 'Pancake', 'easy', 'easy pancake', 'In a bowl, mix flour, sugar, baking powder, and a pinch of salt.\nIn another bowl, whisk milk, egg, and melted butter (or oil).\nPour the wet mixture into the dry ingredients.\nMix gently until smooth (a few lumps are okay).\nHeat a non-stick pan over medium heat and lightly grease it.\nPour a small amount of batter into the pan.\nCook until bubbles form on the surface (about 1–2 minutes).\nFlip the pancake and cook the other side until golden.\nRepeat with the remaining batter.\nServe warm with syrup, honey, or fruits.', 120, 1, 1, 'Oussaid Dridi', 32),
(20, 'Sope', 'medium', 'Traditional Mexican sopes topped with tender cochinita pibil', 'Prepare the cochinita pibil: marinate pork with achiote paste, orange juice, garlic, and spices, then slow-cook until tender and shredded.\r\nMake pickled onions: slice red onions and soak in lime juice, vinegar, salt, and oregano for at least 30 minutes.\r\nHeat refried beans in a pan until smooth and warm.\r\nPrepare sopes: shape masa dough into small thick rounds and cook on a hot griddle until golden. Pinch edges to form a rim.', 90, 1, 0, 'Admin', 28),
(21, 'Lasagne', 'medium', 'A traditional Italian baked dish made with layers of pasta, rich meat sauce, creamy béchamel, and melted cheese', 'Prepare the meat sauce: cook minced beef with onions, garlic, tomato sauce, and herbs. Simmer for 20–30 minutes.\r\nPrepare béchamel sauce: melt butter, add flour, then gradually whisk in milk until smooth and thick. Season with salt and nutmeg.\r\nBoil lasagne sheets (if not pre-cooked) until al dente.', 75, 1, 0, 'Admin', 28),
(22, 'Mloukhiya', 'hard', 'A traditional Tunisian dish made from finely ground jute leaves cooked slowly in olive oil with tender beef', 'In a large pot, heat olive oil on low heat.\r\nAdd mloukhiya powder gradually while stirring continuously to avoid lumps.\r\nKeep stirring until the mixture becomes smooth and slightly thick.\r\nAdd water slowly while mixing until you get a liquid consistency.\r\nAdd tomato paste, garlic, coriander, salt, pepper, and spices.\r\nAdd beef pieces into the pot.\r\nCover and let cook on very low heat for several hours (4–6 hours), stirring occasionally.\r\nAdd water if needed to maintain a smooth texture.\r\nOnce the meat is tender and the sauce is thick and dark, adjust seasoning.\r\nServe hot with fresh bread.', 360, 1, 0, 'Admin', 28),
(23, 'Shawarma Wrap', 'easy', 'A delicious Middle Eastern wrap made with marinated grilled chicken, garlic sauce, fresh vegetables, and soft flatbread. Quick, flavorful, and perfect for street-food lovers', 'Marinate chicken with yogurt, garlic, lemon juice, paprika, cumin, salt, and pepper for at least 1 hour.\r\nCook the chicken in a pan or grill until fully cooked and slightly charred.\r\nSlice the chicken into thin strips.\r\nPrepare garlic sauce (mix mayonnaise, garlic, lemon juice, and a pinch of salt).\r\nWarm the flatbread.\r\nSpread garlic sauce on the bread.\r\nAdd chicken slices.\r\nAdd vegetables (lettuce, tomatoes, pickles).\r\nRoll the wrap tightly.\r\nServe immediately.', 30, 1, 0, 'Admin', 28);

-- --------------------------------------------------------

--
-- Table structure for table `savedrecipies`
--

CREATE TABLE `savedrecipies` (
  `userid` int(11) NOT NULL,
  `recipeid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `savedrecipies`
--

INSERT INTO `savedrecipies` (`userid`, `recipeid`) VALUES
(28, 19);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT 0,
  `displayName` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `mail`, `password`, `admin`, `displayName`) VALUES
(28, 'root@gmail.com', '$2y$10$vZAvtJIRE.bTQJQrcHPa8.JoACeUFUEReV3VIZFCy1/YJ91kFNiFe', 1, 'Admin'),
(32, 'oussaid.dridi.0@gmail.com', '$2y$10$EsCgu5dToqsTges3pEygeuApQQ5zRYAo2Y3DMbLSiTCncWLkfReZO', 0, 'Oussaid Dridi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recipies`
--
ALTER TABLE `recipies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ownerName` (`ownerName`);

--
-- Indexes for table `savedrecipies`
--
ALTER TABLE `savedrecipies`
  ADD PRIMARY KEY (`userid`,`recipeid`),
  ADD KEY `recipeid` (`recipeid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `displayName` (`displayName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recipies`
--
ALTER TABLE `recipies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recipies`
--
ALTER TABLE `recipies`
  ADD CONSTRAINT `recipies_ibfk_1` FOREIGN KEY (`ownerName`) REFERENCES `user` (`displayName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `savedrecipies`
--
ALTER TABLE `savedrecipies`
  ADD CONSTRAINT `savedrecipies_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `savedrecipies_ibfk_2` FOREIGN KEY (`recipeid`) REFERENCES `recipies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
