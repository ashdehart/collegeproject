-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 27, 2025 at 07:53 PM
-- Server version: 5.7.23-23
-- PHP Version: 8.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `REDACTED`
--
CREATE DATABASE IF NOT EXISTS `REDACTED` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `REDACTED`;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `image`, `price`) VALUES
(1, 'Anvil', 'A timeless hunk of hyper-forged alloy, ideal for shaping your interstellar gadgets into perfection. Handy for blacksmithing on Mars or Jupiter’s moon colonies!', 'anvil.jpg', 50),
(2, 'Axle Grease', 'Specially formulated from cosmic whale oil and nano-slick compounds, this grease keeps your rocket-car axles friction-free. Perfect for smooth rides on dusty asteroid highways!', 'axle_grease.jpg', 15),
(3, 'Atom Re-Arranger', 'A dazzling chrome handheld device that lets you rearrange atoms like cosmic puzzle pieces. Turn scrap metal into luxury alloys—just don’t cross the molecular streams!', 'atom_rearranger.jpg', 999),
(4, 'Bed Springs', 'Spring into slumber on these zero-G compatible coil wonders, crafted from lunar steel and stardust for bounce even in microgravity dream rooms.', 'bed_springs.jpg', 20),
(5, 'Bird Seed', 'Engineered from space millet and photon-infused corn, these seeds attract robo-birds and biotic avians. Perfect for extraterrestrial songbird gardens.', 'bird_seed.jpg', 5),
(6, 'Blasting Powder', 'A volatile mix of neutron fizz and Martian sulfur, great for cosmic construction or festive stardust fireworks. Handle with gravity gloves!', 'blasting_powder.jpg', 35),
(7, 'Cork', 'Seemingly old-fashioned, these zero-oxygen arboretum-grown corks seal quantum wine bottles or plug pesky wormhole leaks.', 'cork.jpg', 2),
(8, 'Disintegration Pistol', 'Sleek, atomic-age styling meets null-entropy rays. Vaporize space debris or impress friends at gravity-free garden parties. Minimal collateral damage…usually.', 'disintegration_pistol.jpg', 299),
(9, 'Earthquake Pills', 'Pop a neon capsule and watch planetary crusts rumble. Perfect for terraforming or surprising neighbors who never return hover-tools.', 'earthquake_pills.jpg', 15),
(10, 'Female Roadrunner costume', 'A holo-plume ensemble to dazzle desert foes and speed past cosmic speed traps. Beep-beep across galaxies in retro style!', 'female_roadrunner_costume.jpg', 75),
(11, 'Giant Rubber Band', 'Crafted from elastic asteroid sap and carbon nanotubes. Ideal for launching miniature rocket-sleds or bundling interstellar cargo.', 'giant_rubber_band.jpg', 8),
(12, 'Instant Girl', 'Just add water (or hydrogen fluid) and watch her materialize from stardust code. Sometimes friendly, sometimes sassy—always intriguing.', 'instant_girl.jpg', 25),
(13, 'Iron Carrot', 'A gravity-forged carrot made of solid iron. Perfect for tricking robo-rabbits or impressing culinary androids.', 'iron_carrot.jpg', 12),
(14, 'Jet Propelled Unicycle', 'Roll through Martian caverns with one wheel and jet-powered thrust. Ideal for show-offs and speed fiends.', 'jet_propelled_unicycle.jpg', 199),
(15, 'Out-Board Motor', 'Hover-boat propulsion from ionized fish oil and cosmic currents. Glide across methane seas or zero-g water bubbles.', 'outboard_motor.jpg', 150),
(16, 'Railroad Track', 'Vacuum-forged steel rails for old-timey space trains. Lay them across asteroid fields and watch holographic cowboys pop up!', 'railroad_track.jpg', 100),
(17, 'Rocket Sled', 'Nostalgic ’50s design with quantum thrust. Zip over lunar dunes at dizzying speeds. Just remember to strap on that oxygen helmet!', 'rocket_sled.jpg', 249),
(18, 'Super Outfit', 'A sleek suit lined with gravitonic fibers. Leap hover-buildings and look positively atomic doing it. Capes sold separately.', 'super_outfit.jpg', 89),
(19, 'Time Space Gun', 'Bend minutes, twist hours, and punch through alternate timelines. Perfect for rewriting cosmic history or skipping dull Tuesdays.', 'time_space_gun.jpg', 9999),
(20, 'X-Ray', 'Peer through stardust, crates, or meteorites. Spot hidden treasures and photon squirrels—an interstellar spy’s best friend.', 'x_ray.jpg', 300);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(512) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'REDACTED', 'REDACTED'),


--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
