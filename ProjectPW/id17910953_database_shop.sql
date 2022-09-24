-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 24, 2021 at 06:52 AM
-- Server version: 10.5.12-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id17910953_database_shop`
--
-- CREATE DATABASE IF NOT EXISTS `id17910953_database_shop` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `id17999938_coba`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id_cart`, `id_user`, `id_item`, `qty`, `subtotal`) VALUES
(36, 4, 210, 2, 360000),
(38, 4, 212, 1, 195000);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID`, `Name`) VALUES
(1, 'Skincare'),
(2, 'Makeup'),
(3, 'Body & Hair');

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id_contactus` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `id_htrans` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `d_trans`
--

CREATE TABLE `d_trans` (
  `id_dtrans` int(11) NOT NULL,
  `id_htrans` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `d_trans`
--

INSERT INTO `d_trans` (`id_dtrans`, `id_htrans`, `id_item`, `qty`) VALUES
(1, 15801, 148, 1),
(2, 15802, 4, 1),
(3, 15802, 73, 1),
(4, 15802, 293, 2),
(5, 15870, 3, 1),
(6, 15871, 166, 1),
(7, 15872, 1, 1),
(8, 15872, 220, 2),
(9, 15873, 16, 1),
(10, 15873, 17, 2),
(11, 15876, 178, 1),
(12, 15876, 2, 1),
(13, 15877, 2, 1),
(14, 15878, 173, 1),
(15, 15879, 69, 1),
(16, 15880, 54, 1),
(17, 15881, 16, 1),
(18, 15931, 192, 2),
(19, 15931, 193, 1),
(20, 15931, 1, 4),
(21, 15931, 17, 1),
(22, 15931, 16, 1),
(23, 15932, 18, 2),
(24, 15932, 54, 1),
(25, 15932, 58, 1),
(26, 15932, 59, 1),
(27, 15933, 16, 1),
(28, 15933, 149, 1),
(29, 15933, 151, 1),
(30, 15934, 192, 1),
(31, 15934, 191, 1),
(32, 15934, 193, 1);

-- --------------------------------------------------------

--
-- Table structure for table `h_trans`
--

CREATE TABLE `h_trans` (
  `id_htrans` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `trans_date` date NOT NULL DEFAULT current_timestamp(),
  `points_received` int(11) NOT NULL,
  `points_used` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `h_trans`
--

INSERT INTO `h_trans` (`id_htrans`, `id_user`, `total`, `qty`, `trans_date`, `points_received`, `points_used`, `status`) VALUES
(15801, 2, 295000, 1, '2021-10-31', 29, 0, 'Shipping'),
(15802, 2, 662000, 4, '2021-11-21', 66, 0, 'In Process'),
(15870, 2, 330000, 1, '2021-11-21', 33, 0, 'In Process'),
(15871, 2, 195000, 1, '2021-11-21', 19, 0, 'In Process'),
(15876, 2, 673000, 3, '2021-11-21', 67, 0, 'In Process'),
(15877, 2, 370000, 1, '2021-11-21', 37, 0, 'Pending'),
(15878, 2, 175000, 1, '2021-11-21', 17, 0, 'In Process'),
(15879, 2, 430000, 1, '2021-11-21', 43, 0, 'In Process'),
(15880, 2, 650000, 1, '2021-11-21', 65, 0, 'In Process'),
(15930, 2, 330000, 1, '2021-11-21', 33, 0, 'Pending'),
(15931, 2, 2821000, 9, '2021-11-24', 0, 0, 'Pending'),
(15932, 2, 2060000, 5, '2021-11-24', 0, 0, 'In Process'),
(15933, 2, 945000, 3, '2021-11-24', 0, 0, 'Pending'),
(15934, 2, 179000, 3, '2021-11-24', 0, 0, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `Title` text NOT NULL,
  `Description` text NOT NULL,
  `Price` int(11) NOT NULL,
  `Image` text NOT NULL,
  `Weight` double NOT NULL,
  `Category` varchar(255) NOT NULL,
  `Sub_Category` varchar(255) NOT NULL,
  `Rating` double NOT NULL,
  `Brand` varchar(255) NOT NULL,
  `Stock` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `total_buy` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`Title`, `Description`, `Price`, `Image`, `Weight`, `Category`, `Sub_Category`, `Rating`, `Brand`, `Stock`, `ID`, `total_buy`) VALUES
('Green Tea Seed Serum 160 mL', 'A daily moisture-barrier strengthening serum, formulated with Green tea Tri-biotics, that helps to care dehydrated, pH-unbalanced skin due to loss of hydration every day by moisturizing, soothing and nourishing for a healthy-looking complexio', 495000, 'https://www.innisfree.com/id/en/resources/upload/product/35835_l.png', 160, '1', '1', 0, 'innisfree', 95, 1, 5),
('Brightening Pore Skin 150 mL', 'Daily brightening toner that helps to soothe skin and hydrate for a softer skin with a fresh feel.', 370000, 'https://www.innisfree.com/id/en/resources/upload/product/32831_l.png', 150, '1', '1', 5, 'innisfree', 98, 2, 2),
('Jeju Lava Seawater Skin EX 200 mL', 'Intense moisture bouncy water skin helps to replenish skins moisture for a hydrated, replenished and clearer skin', 330000, 'https://www.innisfree.com/id/en/resources/upload/product/32165_l.png', 200, '1', '1', 4, 'innisfree', 100, 3, 0),
('Jeju Orchid Skin 200ml', 'Early-action, multi-tasking daily gel skin with Orchidelixir 2.0 helps strengthen, firm, smooth, nourish and brighten the look of skin', 300000, 'https://www.innisfree.com/id/en/resources/upload/product/31668_l.png', 200, '1', '1', 5, 'innisfree', 99, 4, 1),
('Olive Real Skin 200ml', 'A deep hydrating skin with Olive Power Activator - vitamin E, tocopherol, and oleic acid - that provides powerful moisturization for dry skin to improve skin suppleness and create a moisture barrie', 240000, 'https://www.innisfree.com/id/en/resources/upload/product/31659_l.png', 200, '1', '1', 5, 'innisfree', 100, 5, 0),
('Aloe Revital Skin Mist 120ml', 'This mist-type toner is formulated with Jeju aloe extract to provide moisture for revitalised-looking skin.', 150000, 'https://www.innisfree.com/id/en/resources/upload/product/31641_l.png', 120, '1', '1', 5, 'innisfree', 100, 6, 0),
('Green Barley Peeling Toner 250ml', 'Peeling toner that gives a crisp and refreshing feeling just like after cleansing', 220000, 'https://www.innisfree.com/id/en/resources/upload/product/31629_l.png', 250, '1', '1', 4, 'innisfree', 95, 7, 0),
('Soybean Energy Skin EX 200ml', 'This toner formulated with antioxidant-rich fermented soybean extract and oil from Jeju Island helps to improve skin texture for a firmer, healthier looking skin', 350000, 'https://www.innisfree.com/id/en/resources/upload/product/31126_l.png', 200, '1', '1', 4, 'innisfree', 100, 8, 0),
('Bija Trouble Skin 200ml', 'This wipe-off astringent toner, formulated with bija seed oil, helps exfoliate flaky skin and remove impurities for a clear skin.', 220000, 'https://www.innisfree.com/id/en/resources/upload/product/31094_l.png', 200, '1', '1', 5, 'innisfree', 100, 9, 0),
('Bija Cica Skin 200ml', 'This daily cica toner is formulated with bija seed oil and centella asiatica 4X which is suitable for oily, parched skin', 260000, 'https://www.innisfree.com/id/en/resources/upload/product/31090_l.png', 200, '1', '1', 4, 'innisfree', 100, 10, 0),
('Jeju Cherry Blossom Skin 200ml', 'Whether used as a wipe-off toner or layering toner, it makes the skin clear and vibrant like beautifully blooming cherry blossoms.', 290000, 'https://www.innisfree.com/id/en/resources/upload/product/30598_l.png', 200, '1', '1', 5, 'innisfree', 100, 11, 0),
('Jeju Volcanic Pore Toner 2X 200ml', 'This wipe-off toner is formulated with Jeju Volcanic Clusters & Spheres to intensively absorb excess oil and cleanse the pore', 250000, 'https://www.innisfree.com/id/en/resources/upload/product/29887_l.png', 200, '1', '1', 5, 'innisfree', 100, 12, 0),
('Jeju Pomegranate Revitalizing Toner 200ml', 'This toner, formulated with freshly squeezed Jeju pomegranate and pomegranate seed oil, gives you an illuminating glow of a pomegranate.', 290000, 'https://www.innisfree.com/id/en/resources/upload/product/29870_l.png', 200, '1', '1', 4, 'innisfree', 100, 13, 0),
('Green Tea Seed Skin 200ml', 'Watery toner with a balanced blend of Jeju Green Tea Extract to deliver intense hydration to the skin', 290000, 'https://www.innisfree.com/id/en/resources/upload/product/27863_l.png', 200, '1', '1', 5, 'innisfree', 100, 14, 0),
('Green Tea Balancing Skin EX 200ml', 'A refreshing watery-gel toner that replenishes skin with lightweight hydration from Jeju green tea.', 240000, 'https://www.innisfree.com/id/en/resources/upload/product/27850_l.png', 200, '1', '1', 5, 'innisfree', 100, 15, 0),
('Jeju Cherry Blossom Jelly Cream 50 mL', 'Bouncy gel-type cream infused with Jeju Cherry Blossom that absorbs instantly into skin to hydrate and boost radiance, leaving it soft and visibly glowing.', 330000, 'https://www.innisfree.com/id/en/resources/upload/product/35483_l.png', 50, '1', '2', 4, 'innisfree', 96, 16, 4),
('Green Tea Seed Cream 50ml', 'A daily moisturizer infused with a blend of Jeju green tea and green tea seed oil to leave skin feeling quenched with intense hydration.', 340000, 'https://www.innisfree.com/id/en/resources/upload/product/27859_l.png', 50, '1', '2', 4, 'innisfree', 97, 17, 3),
('Jeju Cherry Blossom Tone-up Cream 50ml', 'A lightweight cream formulated with Jeju Cherry Blossom leaf extracts and naturally-derived Betaine which leaves you with a natural, glowing finish after application.', 330000, 'https://www.innisfree.com/id/en/resources/upload/product/30601_13.png', 50, '1', '2', 5, 'innisfree', 98, 18, 2),
('Black Tea Youth Enhancing Ampoule Mist 120 mL', 'This mist with micro particles creates an instant moisture barrier as if you have applied a hydrating toner', 310000, 'https://www.innisfree.com/id/en/resources/upload/product/35159_l.png', 120, '1', '2', 5, 'innisfree', 100, 19, 0),
('Bija Cica Mist 80mL', 'A cica mist that helps to soothe tired, stressed skin from outside environment with high purity cica moisture.', 260000, 'https://www.innisfree.com/id/en/resources/upload/product/34344_l.png', 80, '1', '2', 5, 'innisfree', 100, 20, 0),
('Jeju Cherry Blossom Tone-up Cream SPF30/PA++ 50 mL', 'Multi tone-up cream that cares various skin concerns by improving dull skin tone + hydrating + blocking UV', 330000, 'https://www.innisfree.com/id/en/resources/upload/product/34229_l.png', 50, '1', '2', 4, 'innisfree', 100, 21, 0),
('Jeju Cherry Blossom Mist 120 mL', 'Refreshing mist that brightens skin and instantly replenishes moisture for a glowing, hydrated complexion.', 235000, 'https://www.innisfree.com/id/en/resources/upload/product/34228_l.png', 120, '1', '2', 5, 'innisfree', 100, 22, 0),
('Brightening Pore Priming Cream 50mL', 'Daily brightening cream that smooths skin with hydration and pore blurring effect for a softer skin.', 420000, 'https://www.innisfree.com/id/en/resources/upload/product/32833_l.png', 50, '1', '2', 4, 'innisfree', 100, 23, 0),
('Jeju Lava Seawater Mist EX 100 mL', 'This moisturizing and anti-aging mist formulated with mineral-rich Jeju lava seawater provides moisture for the firmer and smoother looking skin glowing with visibly youthful radiance', 220000, 'https://www.innisfree.com/id/en/resources/upload/product/32164_l.png', 100, '1', '2', 5, 'innisfree', 100, 24, 0),
('Jeju Lava Seawater Lotion 160 mL', 'Milky lotion helps to replenish skin\'s moisture and gently balances moisture-oil level with hydration.', 330000, 'https://www.innisfree.com/id/en/resources/upload/product/32163_l.png', 160, '1', '2', 3.5, 'innisfree', 100, 25, 0),
('Jeju Orchid Day Cream SPF30 PA++ 50ml', 'Early-action, multi-tasking day cream with Orchidelixir 2.0 helps strengthen, firm, smooth and brighten the look of skin with sunscree', 380000, 'https://www.innisfree.com/id/en/resources/upload/product/31671_l.png', 50, '1', '2', 4, 'innisfree', 100, 26, 0),
('Jeju Orchid Lotion 160ml', 'Early-action, multi-tasking milky lotion with Orchidelixir 2.0 helps to strengthen, firm, smooth, nourish and brighten the look of ski', 300000, 'https://www.innisfree.com/id/en/resources/upload/product/31667_l.png', 160, '1', '2', 4.5, 'innisfree', 100, 27, 0),
('Jeju Orchid Intense Cream 50ml', 'Early-action, multi-tasking daily intense cream with Orchidelixir 2.0, hyaluronic acid and argan oil helps strengthen, firm, smooth, nourish and brighten the look of ski', 420000, 'https://www.innisfree.com/id/en/resources/upload/product/31666_l.png', 50, '1', '2', 4, 'innisfree', 100, 28, 0),
('Jeju Orchid Gel Cream 50ml', 'Early-action, multi-tasking daily gel cream with Orchidelixir 2.0, hyaluronic acid helps strengthen, firm, smooth, nourish and brighten the look of ski', 380000, 'https://www.innisfree.com/id/en/resources/upload/product/31665_l.png', 50, '1', '2', 5, 'innisfree', 100, 29, 0),
('Olive Real Oil Mist 80ml', 'A two-layered, deep hydrating oil mist with Olive Power Activator (tocopherol and vitamin E) that provides powerful moisturisation for dry skin to improve skin suppleness and create a moisture barrier.', 150000, 'https://www.innisfree.com/id/en/resources/upload/product/31658_l.png', 80, '1', '2', 0, 'innisfree', 100, 30, 0),
('Olive Real Power Cream 50ml', 'A moisturizing cream with Olive Power Activator - vitamin E, tocopherol, and oleic acid - that provides powerful moisturization for dry skin to improve skin suppleness and create a moisture barrie', 300000, 'https://www.innisfree.com/id/en/resources/upload/product/31656_l.png', 50, '1', '2', 5, 'innisfree', 100, 31, 0),
('Olive Real Lotion 160ml', 'A deep hydrating lotion with Olive Power Activator - vitamin E, tocopherol, and oleic acid - that provides powerful moisturization for dry skin to improve skin suppleness and create a moisture barrie', 240000, 'https://www.innisfree.com/id/en/resources/upload/product/31654_l.png', 160, '1', '2', 5, 'innisfree', 100, 32, 0),
('Olive Real Essential Oil 30ml', 'A 100% naturally derived, deep hydrating oil with Olive Power Activator (tocopherol, vitamin E, and oleic acid) that provides powerful moisturisation for dry skin to improve skin suppleness and create a moisture barrier.', 370000, 'https://www.innisfree.com/id/en/resources/upload/product/31651_l.png', 30, '1', '2', 5, 'innisfree', 100, 33, 0),
('Aloe Revital Soothing Gel 300ml', 'This soothing gel for face and body is formulated with Jeju aloe extract which hydrates tired-looking skin with moisture for a healthy look.', 100000, 'https://www.innisfree.com/id/en/resources/upload/product/31642_13.png', 300, '1', '2', 5, 'innisfree', 100, 34, 0),
('Wrinkle Science Spot Treatment 40ml', 'Rejuvenating spot treatment for improved look of deep fine lines and firmer looking skin around targeted areas of concern.', 560000, 'https://www.innisfree.com/id/en/resources/upload/product/31132_l.png', 40, '1', '2', 5, 'innisfree', 100, 35, 0),
('Soybean Energy Oil EX 30ml', 'This oil formulated with antioxidant-rich fermented soybean extract and oil from Jeju Island helps to improve skin texture for a firmer, healthier looking skin', 420000, 'https://www.innisfree.com/id/en/resources/upload/product/31125_l.png', 30, '1', '2', 4.5, 'innisfree', 100, 36, 0),
('Soybean Energy Neck Cream EX 80ml', 'This neck cream formulated with antioxidant-rich fermented soybean extract and oil from Jeju Island helps to improve skin texture for a firmer, healthier looking skin', 270000, 'https://www.innisfree.com/id/en/resources/upload/product/31124_l.png', 80, '1', '2', 5, 'innisfree', 100, 37, 0),
('Soybean Energy Lotion EX 160ml', 'This lotion formulated with antioxidant-rich fermented soybean extract and oil from Jeju Island helps to improve skin texture for a firmer, healthier looking skin', 350000, 'https://www.innisfree.com/id/en/resources/upload/product/31123_l.png', 160, '1', '2', 0, 'innisfree', 100, 38, 0),
('Soybean Energy Cream EX 50ml', 'This cream formulated with antioxidant-rich fermented soybean extract and oil from Jeju Island helps to improve skin texture for a firmer, healthier looking skin\n', 420000, 'https://www.innisfree.com/id/en/resources/upload/product/31121_l.png', 50, '1', '2', 2.5, 'innisfree', 100, 39, 0),
('Bija Cica Gel EX 40ml', 'This cica gel is formulated with bija seed oil and centella asiatica 4X to help soothe and provide gentle skincare', 330000, 'https://www.innisfree.com/id/en/resources/upload/product/31089_l.png', 40, '1', '2', 4, 'innisfree', 100, 40, 0),
('Bija Trouble Gel Cream 40ml', 'This gel cream is formulated with bija seed oil and high salicylic acid content (2%) to relieve tired skin while delivering abundant moisture into your skin', 220000, 'https://www.innisfree.com/id/en/resources/upload/product/31086_l.png', 40, '1', '2', 4, 'innisfree', 100, 41, 0),
('Jeju Cherry Blossom Lotion 100ml', 'A lotion that delivers abundant hydration to dry and dull skin for a moist and revitalised look.', 230000, 'https://www.innisfree.com/id/en/resources/upload/product/30599_l.png', 100, '1', '2', 4, 'innisfree', 100, 42, 0),
('Jeju Pomegranate Revitalizing Emulsion 160ml', 'This emulsion, formulated with freshly squeezed Jeju pomegranate and pomegranate seed oil, gives you an illuminating glow of a pomegranate.', 290000, 'https://www.innisfree.com/id/en/resources/upload/product/29869_l.png', 160, '1', '2', 3, 'innisfree', 100, 43, 0),
('Jeju Pomegranate Revitalizing Capsule Cream 50ml', 'This capsule cream, formulated with freshly squeezed Jeju pomegranate and pomegranate seed oil, gives you an illuminating glow of a pomegranate.', 390000, 'https://www.innisfree.com/id/en/resources/upload/product/29866_l.png', 50, '1', '2', 4, 'innisfree', 100, 44, 0),
('Green Tea Seed Essence-In-Lotion 100ml', 'Unique serum-in-lotion blends the actives of a serum and the hydration of a lotion with Jeju green tea extract and green tea seed for hydrated, healthy-looking skin.', 330000, 'https://www.innisfree.com/id/en/resources/upload/product/27865_l.png', 100, '1', '2', 4, 'innisfree', 100, 45, 0),
('Green Tea Seed Eye Cream 30ml', 'A silky eye cream infused with Jeju green tea extract and green tea seed oil to target dryness around the eyes with intense hydration', 350000, 'https://www.innisfree.com/id/en/resources/upload/product/27862_l.png', 30, '1', '2', 4, 'innisfree', 100, 46, 0),
('Green Tea Seed Deep Cream 50ml', 'Moisture-locking cream that helps with long-lasting hydration by retaining moisture in the skin', 360000, 'https://www.innisfree.com/id/en/resources/upload/product/27861_l.png', 50, '1', '2', 4, 'innisfree', 100, 47, 0),
('Green Tea Mist 150ml', 'A refreshing facial mist made from 100% fresh Green Tea Water to provide instant hydration and a healthy glow', 190000, 'https://www.innisfree.com/id/en/resources/upload/product/27854_l.png', 150, '1', '2', 5, 'innisfree', 100, 48, 0),
('Green Tea Mist 50ml', 'A refreshing facial mist made from 100% fresh Green Tea Water to provide instant hydration and a healthy glow', 86000, 'https://www.innisfree.com/id/en/resources/upload/product/27853_l.png', 50, '1', '2', 5, 'innisfree', 100, 49, 0),
('Green Tea Balancing Cream EX 50ml', 'A lightweight gel-cream with a non-greasy feel that helps lock in refreshing hydration from Jeju green tea', 260000, 'https://www.innisfree.com/id/en/resources/upload/product/27852_l.png', 50, '1', '2', 5, 'innisfree', 100, 50, 0),
('Jeju Orchid Enriched Cream 50ml', 'Early-action, multi-tasking daily cream with Orchidelixir 2.0, hyaluronic acid derived from Jeju green beans and peptides helps strengthen, firm, smooth, nourish and brighten the look of ski', 380000, 'https://www.innisfree.com/id/en/resources/upload/product/31660_13.png', 50, '1', '2', 4, 'innisfree', 100, 51, 0),
('Derma Green Tea Probiotics Cream 50 mL', 'Formulated with fermented probiotics dissolution from green tea, this moisture cream helps to replenish skins moisture barrier against external aggressor', 380000, 'https://www.innisfree.com/id/en/resources/upload/product/35272_l.png', 50, '1', '2', 4, 'innisfree', 100, 52, 0),
('Green Tea Balancing Lotion EX 160ml', 'A lightweight lotion that delivers refreshing, non-greasy hydration from Jeju green tea grown specifically for skincare', 240000, 'https://www.innisfree.com/id/en/resources/upload/product/27851_l.png', 160, '1', '2', 5, 'innisfree', 100, 53, 0),
('Black Tea Youth Enhancing Ampoule 50ml', 'Intensive night care ampoule, formulated with Reset concentrate, that helps to enhance well slept-like, firm, vibrant and healthy-looking ski', 650000, 'https://www.innisfree.com/id/en/resources/upload/product/35847_l.png', 50, '1', '3', 0, 'innisfree', 98, 54, 2),
('Jeju Cherry Blossom Jelly Cream Set 110ml', 'Jeju Cherry Blossom Jelly Cream Set formulated with Jeju cherry blossom leaf extract helps skin have a clear and bright complexion.', 330000, 'https://www.innisfree.com/id/en/resources/upload/product/35502_l.png', 110, '1', '3', 5, 'innisfree', 100, 55, 0),
('Brightening Pore Serum 30 mL', 'Daily brightening serum formulated with Hallabong peel extract and vitamin derivatives helps with hydration, brightening careand pores for a softer feeling skin.', 560000, 'https://www.innisfree.com/id/en/resources/upload/product/32783_13.png', 30, '1', '3', 4, 'innisfree', 100, 56, 0),
('Black Tea Youth Enhancing Ampoule 30 mL', '\"The ampoule provides intensive anti-aging care with Reset Concentrate that relieves signs of skin fatigue after a long, tiring day and boosts the skins vitality and radiance as if you\'d had a good night\"', 540000, 'https://www.innisfree.com/id/en/resources/upload/product/35160_l.png', 30, '1', '3', 4, 'innisfree', 100, 57, 0),
('Bija Cica Balm EX 40ml', 'This gel-balm is formulated with bija seed oil and centella asiatica extract to help strengthen skin\'s moisture barrier while helping to soften skin', 330000, 'https://www.innisfree.com/id/en/resources/upload/product/31088_13.png', 40, '1', '3', 4, 'innisfree', 99, 58, 1),
('Brightening Pore Spot Treatment 30 mL', 'Daily brightening spot treatment that visibly reduces the look of dark spots for a clearer skin.', 420000, 'https://www.innisfree.com/id/en/resources/upload/product/32832_l.png', 30, '1', '3', 4, 'innisfree', 99, 59, 1),
('Jeju Lava Seawater Essence 50 mL', 'Intense moisture bouncy essence helps to replenish skins moisture and hydrated, replenished and firmer ski', 430000, 'https://www.innisfree.com/id/en/resources/upload/product/32161_l.png', 50, '1', '3', 5, 'innisfree', 100, 60, 0),
('Jeju Orchid Fluid 100ml', 'Early-action, multi-tasking fluid (skin+lotion) with Orchidelixir 2.0 helps strengthen, firm, smooth, nourish and brighten the look of s', 300000, 'https://www.innisfree.com/id/en/resources/upload/product/31670_l.png', 100, '1', '3', 5, 'innisfree', 100, 61, 0),
('Jeju Orchid Enriched Essence 50ml', 'Early-action, multi-tasking essence with Orchidelixir 2.0 and oat extract helps strengthen, firm, smooth, nourish and brighten the look of ski', 420000, 'https://www.innisfree.com/id/en/resources/upload/product/31663_l.png', 50, '1', '3', 4, 'innisfree', 100, 62, 0),
('Olive Real Serum 50ml', 'A deep hydrating serum with Olive Power Activator - vitamin E, tocopherol, and oleic acid - that provides powerful moisturization for dry skin to improve skin suppleness and create a moisture barrier', 330000, 'https://www.innisfree.com/id/en/resources/upload/product/31655_l.png', 50, '1', '3', 0, 'innisfree', 100, 63, 0),
('Green Barley Daily Peeling Essence 50ml', 'This daily use essence, formulated with green barley vinegar, exfoliates flaky skin and removes impurities for smooth and clear look.', 300000, 'https://www.innisfree.com/id/en/resources/upload/product/31645_l.png', 50, '1', '3', 4, 'innisfree', 100, 64, 0),
('Wrinkle Science Oil Serum 30ml', 'Intense moisturizing oil serum with omega oil, to help improve the looks of fine lines created due to dryness, providing a smoother & younger looking skin.', 490000, 'https://www.innisfree.com/id/en/resources/upload/product/31131_l.png', 30, '1', '3', 0, 'innisfree', 100, 65, 0),
('Soybean Energy Essence 150ml', 'This essence formulated with antioxidant-rich fermented soybean extract and oil from Jeju Island helps to improve skin texture for a firmer, healthier looking skin.', 520000, 'https://www.innisfree.com/id/en/resources/upload/product/31122_l.png', 150, '1', '3', 5, 'innisfree', 100, 66, 0),
('Jeju Pomegranate Revitalizing Serum 50ml', 'This serum, formulated with freshly squeezed Jeju pomegranate and pomegranate seed oil, gives you an illuminating glow of a pomegranate.', 430000, 'https://www.innisfree.com/id/en/resources/upload/product/29867_13.png', 50, '1', '3', 4, 'innisfree', 100, 67, 0),
('Black Tea Youth Enhancing Eye Serum 15 mL', '\"Intensive nourishing eye serum containing Reset Concentrate that whisks away traces of fatigue around the eye\"', 435000, 'https://www.innisfree.com/id/en/resources/upload/product/35161_l.png', 15, '1', '4', 5, 'innisfree', 100, 68, 0),
('Jeju Lava Seawater Eye Serum EX 20 mL', 'This moisturizing and anti-aging eye serum formulated with mineral-rich Jeju lava seawater provides moisture within the thin and delicate skin around the eye area for the firmer and healthier looking skin.', 430000, 'https://www.innisfree.com/id/en/resources/upload/product/32162_l.png', 20, '1', '4', 3, 'innisfree', 99, 69, 1),
('Jeju Orchid Eye Cream 30ml', 'Early-action, multi-tasking eye cream with Orchidelixir 2.0, helps strengthen, firm, smooth, nourish and brighten the look of the delicate skin around the eye', 380000, 'https://www.innisfree.com/id/en/resources/upload/product/31664_l.png', 30, '1', '4', 5, 'innisfree', 100, 70, 0),
('Wrinkle Science Eye Cream 30ml', 'Light feel, intense moisturizing eye cream that improves the look of deep fine lines around the eye area.', 490000, 'https://www.innisfree.com/id/en/resources/upload/product/31130_l.png', 30, '1', '4', 5, 'innisfree', 100, 71, 0),
('Jeju Pomegranate Revitalizing Eye Essence 15ml', 'This eye essence, formulated with freshly squeezed Jeju pomegranate and pomegranate seed oil, gives you an illuminating glow of a pomegranate.', 370000, 'https://www.innisfree.com/id/en/resources/upload/product/29868_l.png', 15, '1', '4', 4, 'innisfree', 100, 72, 0),
('Green Tea Seed Eye & Face Ball 10ml', 'An eye serum infused with Jeju green tea and green tea seed oil that delivers intense hydration with a cooling roll-on massage-tip applicator.', 290000, 'https://www.innisfree.com/id/en/resources/upload/product/27864_l.png', 10, '1', '4', 4, 'innisfree', 99, 73, 1),
('Black Tea Youth Enhancing Ampoule Mask 28 mL', 'Firming hydrating mask formulated with Reset concentrateTM, rich in antioxidant benefits, to deliver instant firming effect, radiance, and hydration to dry skin that lost vitality for healthy-looking and glowing complexion. ', 58000, 'https://www.innisfree.com/id/en/resources/upload/product/35834_l.png', 28, '1', '5', 0, 'innisfree', 100, 74, 0),
('PEELING MOMENT for skin mask - PHA 25 mL', 'Mild facial mask with cashmere-like soft microfeel sheet, infused with PHA to help care rough texture into soft and smooth complexion.', 45000, 'https://www.innisfree.com/id/en/resources/upload/product/35778_l.png', 25, '1', '5', 0, 'innisfree', 100, 75, 0),
('BRIGHTENING MOMENT for skin mask - Vita C 25 mL', 'Mild facial mask with cashmere-like soft microfeel sheet, infused with vitamin C derivative and niacinamide to help turn dull complexion into bright and clear skin.', 45000, 'https://www.innisfree.com/id/en/resources/upload/product/35777_l.png', 25, '1', '5', 0, 'innisfree', 100, 76, 0),
('HYDRATING MOMENT for skin mask - Hyaluronic Acid 25 mL', 'Mild facial mask with cashmere-like soft microfeel sheet, infused with eight hyaluronic acids to hydrate dry and rough skin.', 45000, 'https://www.innisfree.com/id/en/resources/upload/product/35776_l.png', 25, '1', '5', 4, 'innisfree', 100, 77, 0),
('SOOTHING MOMENT for skin mask - Madecassoside 25 mL', 'Mild facial mask with cashmere-like soft microfeel sheet, infused with madecassoside to soothe the skin and protect the skin\'s barrier.', 45000, 'https://www.innisfree.com/id/en/resources/upload/product/35775_l.png', 25, '1', '5', 0, 'innisfree', 100, 78, 0),
('Volcanic Calming Pore Clay Mask 100 mL', 'Mild peeling clay mask helps remove excess sebum and cleanse pore concerns for a smoother, hydrated complexion.', 260000, 'https://www.innisfree.com/id/en/resources/upload/product/35769_l.png', 100, '1', '5', 5, 'innisfree', 100, 79, 0),
('Super Volcanic Pore Clay Mask 2X 100ml', 'A multi-action, rinse-off clay mask formulated with Jeju Volcanic Clusters & Spheres cools skin upon contact, absorbs excess oil for visibly smaller pores, all while helping to improve the overall look and texture of the ski', 190000, 'https://www.innisfree.com/id/en/resources/upload/product/29888_13.png', 100, '1', '5', 5, 'innisfree', 100, 80, 0),
('Jeju Lava Seawater Cream Mask 60 mL', 'A mask that can be used as a cream helps to replenish skin\'s moisture for a hydrated, replenished and bouncy skin.', 330000, 'https://www.innisfree.com/id/en/resources/upload/product/33951_l.png', 60, '1', '5', 4, 'innisfree', 100, 81, 0),
('Jeju Root Energy mask [Carrot] 25 ml', 'Hydrating, energizing mask with carrot extract from the pure nature of Jeju & five kinds of hyaluronic acid complex - for hydrated, clearer look to the dry skin.', 21000, 'https://www.innisfree.com/id/en/resources/upload/product/33847_l.png', 25, '1', '5', 5, 'innisfree', 100, 82, 0),
('Brightening Pore Sleeping Mask 100 mL', 'Daily brightening sleeping mask that forms moisture barrier throughout the night with hydration, brightening and tighter pores for a softer skin without stickiness.', 300000, 'https://www.innisfree.com/id/en/resources/upload/product/32834_13.png', 100, '1', '5', 5, 'innisfree', 100, 83, 0),
('Jeju Volcanic Blackhead 3-Step Program 3 mL/1 patch/3 Ml', 'This 3-step program, formulated with Jeju volcanic clusters, effectively removes impurities from pores.', 37000, 'https://www.innisfree.com/id/en/resources/upload/product/31834_l.png', 3, '1', '5', 4, 'innisfree', 100, 84, 0),
('Jeju Orchid Sleeping Mask 80ml', 'Early-action, multi-tasking sleeping mask with Orchidelixir 2.0 and lavender oil helps strengthen, firm, smooth, nourish and brighten the look of skin while you slee', 240000, 'https://www.innisfree.com/id/en/resources/upload/product/31669_l.png', 80, '1', '5', 4, 'innisfree', 100, 85, 0),
('Jeju Orchid Enriched Cream Mask 16g', 'Early-action, multi-tasking cream mask with Orchidelixir 2.0, hyaluronic acid and Jeju soy bean peptides helps strengthen, firm, smooth, nourish and brighten the look of ski', 75000, 'https://www.innisfree.com/id/en/resources/upload/product/31661_l.png', 16, '1', '5', 3, 'innisfree', 100, 86, 0),
('Green Barley Gommage Peeling Mask 120ml', 'This gommage-type mask formulated with green barley vinegar and cellulose optimises exfoliation effect by providing chemical and physical exfoliation', 150000, 'https://www.innisfree.com/id/en/resources/upload/product/31644_l.png', 120, '1', '5', 4, 'innisfree', 100, 87, 0),
('Aloe Revital Sleeping Pack 100ml', 'This leave-on mask is formulated with Jeju aloe extract to hydrate skin overnight for a revitalised look.', 180000, 'https://www.innisfree.com/id/en/resources/upload/product/31634_l.png', 100, '1', '5', 5, 'innisfree', 100, 88, 0),
('Bija Trouble Mask 120ml', 'This wash-off mask is formulated with bija seed oil and high salicylic acid content (2%) to help improve areas of concern', 180000, 'https://www.innisfree.com/id/en/resources/upload/product/31087_l.png', 120, '1', '5', 5, 'innisfree', 100, 89, 0),
('Jeju Volcanic Color Clay Mask 70ml', 'Multi-masking color clay packs in different colors to address different skin concerns!', 120000, 'https://www.innisfree.com/id/en/resources/upload/product/29894_l.png', 70, '1', '5', 4, 'innisfree', 100, 90, 0),
('Super Volcanic Peel Off Mask 2X 100ml', 'Peel-off gel-clay mask formulated with oil-absorbing Jeju Volcanic Clusters & Spheres helps remove dead skin cells and impurities for a refreshing feel of improved skin textur', 180000, 'https://www.innisfree.com/id/en/resources/upload/product/29893_13.png', 100, '1', '5', 4, 'innisfree', 100, 91, 0),
('Super Volcanic Clay Mousse Mask 2X 100ml', 'This mousse-type clay mask, formulated with fine clay mousse formula which contains Jeju Volcanic Clusters & Spheres, helps remove excess oil and cleanse the por', 270000, 'https://www.innisfree.com/id/en/resources/upload/product/29890_13.png', 100, '1', '5', 4, 'innisfree', 100, 92, 0),
('Super Volcanic Stick Mask 2X 27g', 'Quick & easy rinse-off clay mask stick with Jeju Volcanic Clusters & Spheres absorbs excess oil and impurities to help minimise pore', 190000, 'https://www.innisfree.com/id/en/resources/upload/product/29889_l.png', 27, '1', '5', 5, 'innisfree', 100, 93, 0),
('Jeju Volcanic Clay Mousse Mask EX [Original] 100ml', 'This mousse-type clay mask, formulated with fine clay mousse formula which contains Jeju volcanic clusters, helps remove excess oil and cleanse the pores.', 270000, 'https://www.innisfree.com/id/en/resources/upload/product/29886_l.png', 100, '1', '5', 5, 'innisfree', 100, 94, 0),
('Special Care Mask [Foot] 20ml', 'This special care mask makes feet look healthy by moisturizing and nourishing the skin.', 42000, 'https://www.innisfree.com/id/en/resources/upload/product/29857_l.png', 20, '1', '5', 4, 'innisfree', 100, 95, 0),
('Special Care Mask [Hand] 20ml', 'This special care mask makes hands look healthy by moisturizing and nourishing the skin.', 42000, 'https://www.innisfree.com/id/en/resources/upload/product/29856_l.png', 20, '1', '5', 5, 'innisfree', 100, 96, 0),
('Bija Cica Mask 20ml', 'This sheet mask is formulated with bija seed oil and centella asiatica 4X to help soothe and provide gentle skincare', 58000, 'https://www.innisfree.com/id/en/resources/upload/product/29854_l.png', 20, '1', '5', 3.5, 'innisfree', 100, 97, 0),
('Jeju Pomegranate Revitalizing Capsule Sleeping Pack 70ml', 'This capsule sleeping pack, formulated with freshly squeezed Jeju pomegranate and pomegranate seed oil, gives you an illuminating glow of a pomegranate.', 230000, 'https://www.innisfree.com/id/en/resources/upload/product/29847_l.png', 70, '1', '5', 3, 'innisfree', 100, 98, 0),
('Green Tea Sleeping Mask 80ml', 'A hydration-boosting overnight mask infused with Jeju green tea that quenches skin while you snooze.', 220000, 'https://www.innisfree.com/id/en/resources/upload/product/27867_l.png', 80, '1', '5', 5, 'innisfree', 100, 99, 0),
('3-Minute Green Tea Skin Pack 70 mL (100 sheets)', 'A 3-in-1 moisture replenishing Skin Pack that solves various skin concerns with its instant hydration, smoothing and cooling benefits', 290000, 'https://www.innisfree.com/id/en/resources/upload/product/27866_l.png', 70, '1', '5', 5, 'innisfree', 100, 100, 0),
('Jeju Volcanic Pore Clay Mask 100 mL', 'A clay mask formulated with Jeju volcanic clusters to intensively absorb excess oil and cleanse the pores.', 180000, 'https://www.innisfree.com/id/en/resources/upload/product/31673_l.png', 100, '1', '5', 5, 'innisfree', 100, 101, 0),
('Olive Real Cleansing Foam 150 g', 'With its rich moisturizing ingredients and vitamin nutrients from the finest grown olives, this enriched hydrating cleansing foam thoroughly removes makeup residues and pore-clogging impurities with its soft and rich lather.', 150000, 'https://www.innisfree.com/id/en/resources/upload/product/35572_l.png', 150, '1', '6', 3, 'innisfree', 100, 102, 0),
('Super Volcanic Pore Cleansing Oil 150 mL', '[deep cleansing+removes blackhead+removes excessive sebum+gentle cleansing] Gentle pore cleansing oil that removes from heavy makeup to even impurities in pores.', 290000, 'https://www.innisfree.com/id/en/resources/upload/product/35770_l.png', 150, '1', '6', 0, 'innisfree', 100, 103, 0),
('Jeju Volcanic Pore Cleansing Foam EX 300mL', 'This pore-clearing foam, formulated with Jeju volcanic clusters, helps remove oil and cleanse the pores', 180000, 'https://www.innisfree.com/id/en/resources/upload/product/35639_l.png', 300, '1', '6', 5, 'innisfree', 100, 104, 0),
('Jeju Cherry Blossom Jam Cleanser 150g', 'Moisturizing, weakly acidic cleanser in jam-like texture provides a pleasant feeling as the clear jam-like texture rolls on skin. It leaves skin feeling moisturized even after washing the face and by absorbing impurities from skin.', 170000, 'https://www.innisfree.com/id/en/resources/upload/product/35628_l.png', 150, '1', '6', 0, 'innisfree', 100, 105, 0),
('Super Volcanic Pore Micellar Cleansing Foam 2X 150ml', 'Micellar foam that is formulated with Jeju Volcanic Sphere with twice the sebum cleaning effect delivers a hydrated finish after cleaning fine dust in pore', 150000, 'https://www.innisfree.com/id/en/resources/upload/product/34231_l.png', 150, '1', '6', 5, 'innisfree', 100, 106, 0),
('Sea Salt Jelly Cleanser 130 Ml', 'This soft, delicate foam cleanser formulated with sea salt, removes impurities on the skin, leaving it feeling supple and hydrated.', 150000, 'https://www.innisfree.com/id/en/resources/upload/product/33073_l.png', 130, '1', '6', 4, 'innisfree', 100, 107, 0),
('My Makeup Cleanser - Mascara Remover (Online Exclusive) 9g', 'A waterproof mascara remover that melts thoroughly and quickly to remove mascara from each eyelash strand.', 115000, 'https://www.innisfree.com/id/en/resources/upload/product/33049_l.png', 9, '1', '6', 5, 'innisfree', 100, 108, 0),
('Sea Salt Whipping Cleanser 130 Ml', 'This rich, whipped cream texture foam cleanser formulated with sea salt, gently removes impurities and excess oil.', 260000, 'https://www.innisfree.com/id/en/resources/upload/product/32841_l.png', 130, '1', '6', 5, 'innisfree', 100, 109, 0),
('Sea Salt Perfect Cleanser 130 Ml', 'This cleansing foam formulated with sea salt, removes impurities and exfoliates skin for a smooth and dewy feel.', 260000, 'https://www.innisfree.com/id/en/resources/upload/product/32840_l.png', 130, '1', '6', 5, 'innisfree', 100, 110, 0),
('Brightening Pore Facial Cleanser 150 Ml', 'Fresh, hydrating feel cleansing foam that visibly removes impurities around the pores with soft bubbles for a clear skin.', 180000, 'https://www.innisfree.com/id/en/resources/upload/product/32835_l.png', 150, '1', '6', 4, 'innisfree', 100, 111, 0),
('Apple Seed Soft Cleansing Foam 150 mL', 'This refreshing cleansing foam formulated with apple seed oil, removes impurities with a soft and dense lather to leave skin feeling fresh and clear.', 120000, 'https://www.innisfree.com/id/en/resources/upload/product/32598_l.png', 150, '1', '6', 4, 'innisfree', 100, 112, 0),
('Green Barley Multi Cleansing Tissue 50 Sheets', 'These cleansing wipes formulated with green barley vinegar conveniently remove makeup and gently exfoliate flaky skin.', 108000, 'https://www.innisfree.com/id/en/resources/upload/product/32152_l.png', 250, '1', '6', 3, 'innisfree', 100, 113, 0),
('Olive Real Cleansing Oil 150ml', 'Formulated with rich moisturising ingredients and vitamin nutrients from the finest grown olives to remove and cleanse makeup and impurities from inside the pores while moisturising and softening the skin.', 240000, 'https://www.innisfree.com/id/en/resources/upload/product/31653_l.png', 150, '1', '6', 5, 'innisfree', 100, 114, 0),
('Olive Real Cleansing Tissue 150 g (30 sheets)', 'Formulated with rich moisturising ingredients and vitamin nutrients from the finest grown olives for easy removal and cleansing of makeup residue and impurities while also moisturising the skin.', 70000, 'https://www.innisfree.com/id/en/resources/upload/product/31652_l.png', 150, '1', '6', 4.5, 'innisfree', 100, 115, 0),
('Green Barley Cleansing Cream 150ml', 'This washable cleansing cream is formulated with green barley vinegar to help exfoliate flaky skin for smooth and clear look.', 130000, 'https://www.innisfree.com/id/en/resources/upload/product/31647_l.png', 150, '1', '6', 5, 'innisfree', 100, 116, 0),
('Green Barley Bubble Cleanser 150ml', 'This foaming cleanser is formulated with green barley vinegar to help exfoliate flaky skin for smooth and clear look.', 150000, 'https://www.innisfree.com/id/en/resources/upload/product/31646_l.png', 150, '1', '6', 4, 'innisfree', 100, 117, 0),
('Jeju Volcanic Pore Scrub Foam 150ml', 'This cleansing foam with scrub particles is formulated with Jeju volcanic clusters to help cleanse pores while providing exfoliation', 120000, 'https://www.innisfree.com/id/en/resources/upload/product/29892_l.png', 150, '1', '6', 5, 'innisfree', 100, 118, 0),
('Jeju Pomegranate Revitalizing Foam Cleanser 150ml', 'This foam cleanser, formulated with freshly squeezed Jeju pomegranate and pomegranate seed oil, gives you an illuminating glow of a pomegranate.', 180000, 'https://www.innisfree.com/id/en/resources/upload/product/29846_l.png', 150, '1', '6', 5, 'innisfree', 100, 119, 0),
('Green Tea Cleansing Gel-To-Foam 150ml', 'A multi-tasking cleansing gel which foams with water to cleanse skin and whisk away impurities', 240000, 'https://www.innisfree.com/id/en/resources/upload/product/27871_l.png', 150, '1', '6', 4, 'innisfree', 100, 120, 0),
('Green Tea Cleansing Oil 150ml', 'A lightweight cleansing oil with Jeju green tea that hydrates while dissolving makeup, dirt and impurities.', 270000, 'https://www.innisfree.com/id/en/resources/upload/product/27870_l.png', 150, '1', '6', 4, 'innisfree', 100, 121, 0),
('Green Tea Cleansing Water 300ml', 'Gentle cleansing water formulated with freshly double-squeezed Jeju green tea extract lift away dirt, oil and make-up in just one swipe.', 195000, 'https://www.innisfree.com/id/en/resources/upload/product/27869_l.png', 300, '1', '6', 4, 'innisfree', 100, 122, 0),
('Green Tea Morning Cleanser 150ml', 'A mild sub-acidic, non-foaming cleanser which gently massages skin to remove sebum and skin waste produced overnight, while restoring healthy pH levels', 160000, 'https://www.innisfree.com/id/en/resources/upload/product/27868_l.png', 150, '1', '6', 5, 'innisfree', 100, 123, 0),
('My Makeup Cleanser - Melting Balm 80 Ml', 'A paste-type cleansing balm that gently removes makeup, and leaves the skin moisturised.', 195000, 'https://www.innisfree.com/id/en/resources/upload/product/26513_l.png', 80, '1', '6', 5, 'innisfree', 100, 124, 0),
('My Makeup Cleanser - Micellar Oil Water 200 mL', 'A cleansing water that allows for quick and thorough removal of waterproof makeup.', 165000, 'https://www.innisfree.com/id/en/resources/upload/product/26377_l.png', 200, '1', '6', 5, 'innisfree', 100, 125, 0),
('My Makeup Cleanser - Creamy Foam 175 mL', 'A foam with rich, creamy lather thoroughly that removes face makeup and keeps skin moisturised.', 150000, 'https://www.innisfree.com/id/en/resources/upload/product/26375_l.png', 175, '1', '6', 5, 'innisfree', 100, 126, 0),
('Apple Seed Bubble Cleanser 150 Ml', 'Bubble cleanser with apple-seed oil cleanses the face with its cloud-like bubbly foam and leaves skin feeling soft and silky-smooth.', 225000, 'https://www.innisfree.com/id/en/resources/upload/product/35207_l.png', 150, '1', '6', 5, 'innisfree', 100, 127, 0),
('Jeju Volcanic Pore Cleansing Foam EX 150ml', 'This pore-clearing foam, formulated with Jeju volcanic clusters, helps remove oil and cleanse the pores.', 120000, 'https://www.innisfree.com/id/en/resources/upload/product/29891_13.png', 150, '1', '6', 4, 'innisfree', 100, 128, 0),
('Green Tea Foam Cleanser 150ml', 'A creamy cleansing foam with Jeju green tea that hydrates skin while whisking away dirt and impurities, leaving skin feeling refreshed.', 135000, 'https://www.innisfree.com/id/en/resources/upload/product/29860_13.png', 150, '1', '6', 4, 'innisfree', 100, 129, 0),
('Apple Seed Lip & Eye Makeup Remover Tissue 27 g (30 sheets)', 'These convenient lip and eye makeup remover wipes formulated with apple seed oil, gently remove point makeup around sensitive eyes and lips.', 60000, 'https://www.innisfree.com/id/en/resources/upload/product/32600_l.png', 27, '1', '6', 0, 'innisfree', 100, 130, 0),
('Intensive Leisure Sun Stick SPF50+ PA++++ 18 g', 'An easy-to-apply water resistant sunscreen stick for intense outdoor activities.', 290000, 'https://www.innisfree.com/id/en/resources/upload/product/34859_l.png', 18, '1', '6', 0, 'innisfree', 100, 131, 0),
('daily mild sunscreen 50 Ml', 'A lightweight sunscreen for daily use.', 140000, 'https://www.innisfree.com/id/en/resources/upload/product/34605_l.png', 50, '1', '6', 5, 'innisfree', 100, 132, 0),
('daily soft sunscreen stick 18 g', 'An easy-to-apply mineral sunscreen stick for children.', 270000, 'https://www.innisfree.com/id/en/resources/upload/product/34604_l.png', 18, '1', '6', 4, 'innisfree', 100, 133, 0),
('Daily Sensitive Sunscreen SPF50+ PA++++ 50 mL', 'A mineral sunscreen for sensitive skin easily washable with just cleansing foam.', 210000, 'https://www.innisfree.com/id/en/resources/upload/product/34348_l.png', 50, '1', '6', 4.5, 'innisfree', 100, 134, 0),
('Intensive Long-lasting Sunscreen EX SPF50+ PA++++ 50ml', 'A sheer water-resistant sunscreen for combination to oily skin.', 240000, 'https://www.innisfree.com/id/en/resources/upload/product/34764_l.png', 50, '1', '6', 0, 'innisfree', 100, 135, 0),
('Intensive Triple-shield Sunscreen SPF50+ PA++++ 50ml', 'A sunscreen that is waterproof and provides protection against blue light and UV rays.', 240000, 'https://www.innisfree.com/id/en/resources/upload/product/34763_l.png', 50, '1', '6', 4.5, 'innisfree', 100, 136, 0),
('Tone Up Calamine Sunscreen Stick SPF50+ PA++++ 8g', 'This Sunscreen stick is formulated with calamine, and it brightens and revitalizes the look of skin.', 240000, 'https://www.innisfree.com/id/en/resources/upload/product/30627_l.png', 8, '1', '6', 4, 'innisfree', 100, 137, 0),
('Aqua Water Drop Sunscreen SPF50+ PA++++ 50ml', 'A sunscreen with an ultra-light, soft texture. Spreads easily and absorbed quickly.', 270000, 'https://www.innisfree.com/id/en/resources/upload/product/30626_l.png', 50, '1', '6', 4, 'innisfree', 100, 138, 0),
('Forest for Men Shaving & Cleansing Foam 150 Ml', 'A two-in-one cleansing foam formulated with black yeast - smooth shaving cream and cleansing foam with a fresh finish.', 150000, 'https://www.innisfree.com/id/en/resources/upload/product/32168_l.png', 150, '1', '7', 0, 'innisfree', 100, 139, 0),
('Forest for Men Fresh Skin 180 Ml', 'A toner formulated with black yeast to provide moisture to skin.', 280000, 'https://www.innisfree.com/id/en/resources/upload/product/32167_l.png', 180, '1', '7', 5, 'innisfree', 100, 140, 0),
('Forest for Men Bubble Cleanser 150 mL', 'A bubble cleanser formulated with black yeast to remove impurities from the skin and offer gentle exfoliation with a mild formula.', 200000, 'https://www.innisfree.com/id/en/resources/upload/product/32139_l.png', 150, '1', '7', 5, 'innisfree', 100, 141, 0),
('Forest for Men All-in-one Essence 100 mL', 'An all-in-one essence formulated with black yeast to address oily skin and the appearance of pores to leave skin feeling refreshed.', 400000, 'https://www.innisfree.com/id/en/resources/upload/product/32138_l.png', 100, '1', '7', 4, 'innisfree', 100, 142, 0),
('Creamy Bubble Maker 1P', 'The cleansing tool to form rich and dense foam as whipped cream.', 30000, 'https://www.innisfree.com/id/en/resources/upload/product/33071_l.png', 0, '1', '8', 5, 'innisfree', 100, 143, 0),
('Jeju Volcanic Konjac Cleansing Sponge 1p', 'The 100% pure plant-based volcanic ash and konjac cleansing sponge from the clean island of jeju.', 60000, 'https://www.innisfree.com/id/en/resources/upload/product/30624_l.png', 0, '1', '8', 4, 'innisfree', 100, 144, 0),
('Pack Brush 1p', 'The mask brush for powder mask.', 30000, 'https://www.innisfree.com/id/en/resources/upload/product/22683_l.png', 0, '1', '8', 5, 'innisfree', 100, 145, 0),
('Blackhead Goodbye Finger Tip Silicone 2p', 'A finger silicon tip for exfoliating blackheads', 35000, 'https://www.innisfree.com/id/en/resources/upload/product/22682_l.png', 0, '1', '8', 4, 'innisfree', 100, 146, 0),
('Soft Pack Spatula 1ea', 'The pack spatula for smooth and even application of pack or mask.', 18000, 'https://www.innisfree.com/id/en/resources/upload/product/22679_l.png', 0, '1', '8', 4.5, 'innisfree', 100, 147, 0),
('My Foundation All day-Longwear SPF25 PA++ 30 mL', 'Semi-Matte foundation that lasts all day with perfect tone, smooth texture and clear finish.', 295000, 'https://www.innisfree.com/id/en/resources/upload/product/35275_l.png', 30, '2', '9', 0, 'innisfree', 100, 148, 0),
('Skin Fit Glow Cushion SPF34 PA++ 0', 'Glow cushion that creates vibrant looking skin tone by dressing up skin with a luminous glow', 325000, 'https://www.innisfree.com/id/en/resources/upload/product/35274_l.png', 0, '2', '9', 5, 'innisfree', 99, 149, 1),
('Skin Fit Glow Cushion SPF34 PA++ Refill 14 g', 'Glow cushion that creates vibrant looking skin tone by dressing up skin with a luminous glow', 180000, 'https://www.innisfree.com/id/en/resources/upload/product/35273_l.png', 14, '2', '9', 0, 'innisfree', 100, 150, 0),
('Pore Blur Makeup Cover Cream 40 mL', 'This makeup cover cream with a fresh and hydrating texture hides the look of pores and lines while comforting skin', 290000, 'https://www.innisfree.com/id/en/resources/upload/product/34849_l.png', 40, '2', '9', 0, 'innisfree', 99, 151, 1),
('Simplelabel Tinted Moisturizer 40 mL', 'A tinted moisturizer with soft and hydrating formula that is less-irritant makes it suitable for daily use', 290000, 'https://www.innisfree.com/id/en/resources/upload/product/34607_l.png', 40, '2', '9', 4.5, 'innisfree', 100, 152, 0),
('Light Cotton Cover Pact 12 g', 'Velvet Finish Pact that smoothly covers skin with cotton-like light and fresh feel', 245000, 'https://www.innisfree.com/id/en/resources/upload/product/34232_l.png', 12, '2', '9', 5, 'innisfree', 100, 153, 0),
('My To Go Cushion Refill 3.1 13g', 'The customized cushion foundation for just the right level of moisture, coverage, and shade for your skin.', 275000, 'https://www.innisfree.com/id/en/resources/upload/product/33081_l.png', 13, '2', '9', 5, 'innisfree', 100, 154, 0),
('My To Go Cushion Refill 2.2 13g', 'The customized cushion foundation for just the right level of moisture, coverage, and shade for your skin.', 275000, 'https://www.innisfree.com/id/en/resources/upload/product/33080_l.png', 13, '2', '9', 2, 'innisfree', 100, 155, 0),
('My To Go Cushion Refill 1.3 13g', 'The customized cushion foundation for just the right level of moisture, coverage, and shade for your skin.', 275000, 'https://www.innisfree.com/id/en/resources/upload/product/33079_l.png', 13, '2', '9', 0, 'innisfree', 100, 156, 0),
('My To Go Cushion 3.1 13g', 'The customized cushion foundation for just the right level of moisture, coverage, and shade for your skin.', 410000, 'https://www.innisfree.com/id/en/resources/upload/product/33078_l.png', 13, '2', '9', 3, 'innisfree', 100, 157, 0),
('My To Go Cushion 2.2 13g', 'The customized cushion foundation for just the right level of moisture, coverage, and shade for your skin.', 410000, 'https://www.innisfree.com/id/en/resources/upload/product/33077_l.png', 13, '2', '9', 5, 'innisfree', 100, 158, 0),
('My To Go Cushion 1.3 13g', 'The customized cushion foundation for just the right level of moisture, coverage, and shade for your skin.', 410000, 'https://www.innisfree.com/id/en/resources/upload/product/33076_l.png', 13, '2', '9', 4, 'innisfree', 100, 159, 0),
('My Highlighter (Cream) 2.6g', 'Customized cream highlighter with different options for your needs', 105000, 'https://www.innisfree.com/id/en/resources/upload/product/33057_l.png', 2.6, '2', '9', 0, 'innisfree', 100, 160, 0),
('My Foundation 3.4 30ml', 'The personalized foundation for just the right level of moisture, coverage, and shade for your skin.', 325000, 'https://www.innisfree.com/id/en/resources/upload/product/33055_l.png', 30, '2', '9', 0, 'innisfree', 100, 161, 0),
('Mineral Moisture Fitting Base 40 mL', 'A makeup primer formulated with green tea extract that helps to improve skin texture with moisture', 180000, 'https://www.innisfree.com/id/en/resources/upload/product/31832_l.png', 40, '2', '9', 4, 'innisfree', 100, 162, 0),
('Mineral Makeup Base SPF30 PA++ 40 mL', 'A makeup primer that expresses clear, bright and moisturised skin', 180000, 'https://www.innisfree.com/id/en/resources/upload/product/31831_l.png', 40, '2', '9', 4, 'innisfree', 100, 163, 0),
('No-Sebum Mineral Powder 5g', 'A loose powder for soft and shine-free skin', 90000, 'https://www.innisfree.com/id/en/resources/upload/product/31120_13.png', 5, '2', '9', 5, 'innisfree', 100, 164, 0),
('My Contouring 4g', 'Customized contouring with different options for your needs', 105000, 'https://www.innisfree.com/id/en/resources/upload/product/31116_l.png', 4, '2', '9', 3.5, 'innisfree', 100, 165, 0),
('My Concealer Spot Cover 5.5g', 'Creamy solid type concealer that covers small dark spots.', 195000, 'https://www.innisfree.com/id/en/resources/upload/product/31081_l.png', 5.5, '2', '9', 2, 'innisfree', 99, 166, 1),
('My Concealer Dark Circle Cover 7g', 'Moist liquid type concealer that covers dark circles', 165000, 'https://www.innisfree.com/id/en/resources/upload/product/31079_l.png', 7, '2', '9', 5, 'innisfree', 100, 167, 0),
('Pore Blur Primer 25ml', 'This primer is formulated with mild ingredients to create a silky smooth makeup finish with its pore-blurring effect suitable even for acne-prone skin', 198000, 'https://www.innisfree.com/id/en/resources/upload/product/29849_l.png', 25, '2', '9', 5, 'innisfree', 100, 168, 0),
('Pore Blur Powder 11g', 'This powder is formulated with mild ingredients to create a silky smooth makeup finish with its pore-blurring effect suitable even for acne-prone skin', 245000, 'https://www.innisfree.com/id/en/resources/upload/product/29848_l.png', 11, '2', '9', 3, 'innisfree', 100, 169, 0),
('Skinny Coverfit Cushion SPF41 PA++ (Refill) 14g', 'A lightweight cushion formulated with Jeju Green Tea Extract that offers great coverage and a natural-looking skin finish.', 180000, 'https://www.innisfree.com/id/en/resources/upload/product/29844_l.png', 14, '2', '9', 4.5, 'innisfree', 100, 170, 0);
INSERT INTO `items` (`Title`, `Description`, `Price`, `Image`, `Weight`, `Category`, `Sub_Category`, `Rating`, `Brand`, `Stock`, `ID`, `total_buy`) VALUES
('Water Fit Cushion SPF45 PA++ (Refill) 14g', 'A lightweight cushion formulated with Jeju Green Tea Extract that offers fresh feel and a dewy finish.', 180000, 'https://www.innisfree.com/id/en/resources/upload/product/29842_l.png', 14, '2', '9', 4, 'innisfree', 100, 171, 0),
('No-Sebum Primer 25 mL', 'Hydrating, soft feeling primer that adds moisture to skin and smooths out the look of pores and wrinkles', 163000, 'https://www.innisfree.com/id/en/resources/upload/product/34245_l.png', 25, '2', '9', 4.5, 'innisfree', 100, 172, 0),
('Simplelabel Lip color balm 3.2 g', 'Mild and moist daily colored lip balm formulated with low-irritant formula for healthy lips', 175000, 'https://www.innisfree.com/id/en/resources/upload/product/34608_l.png', 3.2, '2', '10', 4, 'innisfree', 99, 173, 1),
('Green Tea Lip Balm 3.6 g', 'Gently moisturizing lip balm formulated with Jeju green tea powder and other naturally-derived ingredients.', 130000, 'https://www.innisfree.com/id/en/resources/upload/product/33954_l.png', 3.6, '2', '10', 5, 'innisfree', 100, 174, 0),
('Fruity Squeeze Tint 4 mL', 'Hydrating water glow with clear and vivid color texture that creates glossy lips', 165000, 'https://www.innisfree.com/id/en/resources/upload/product/33952_l.png', 4, '2', '10', 4, 'innisfree', 100, 175, 0),
('Real Fit Lipstick 3.1g', 'A lipstick that glides onto your lips as light as air and colours lips naturally', 215000, 'https://www.innisfree.com/id/en/resources/upload/product/32145_l.png', 3.1, '2', '10', 5, 'innisfree', 100, 176, 0),
('My Lip Balm 15 g', 'My Lip Balm selectable from various colors and tea scents', 150000, 'https://www.innisfree.com/id/en/resources/upload/product/31833_l.png', 15, '2', '10', 4, 'innisfree', 100, 177, 0),
('Lip Sleeping Mask with Canola Oil 17 g', 'Formulated with naturally-derived ingredients including canola oil, to gently moisturise and care for your lips while you sleep.', 200000, 'https://www.innisfree.com/id/en/resources/upload/product/31824_l.png', 17, '2', '10', 5, 'innisfree', 99, 178, 1),
('Glow Tint Lip Balm 3.5 g', 'A lip balm that adds colour to your lips while providing rich nourishment.', 115000, 'https://www.innisfree.com/id/en/resources/upload/product/30614_l.png', 3.5, '2', '10', 5, 'innisfree', 100, 179, 0),
('Vivid Cotton Ink 4g', 'Light & soft cotton-like texture! Moisturizes, with velvety finish tint', 135000, 'https://www.innisfree.com/id/en/resources/upload/product/29097_13.png', 4, '2', '10', 5, 'innisfree', 100, 180, 0),
('Canola Honey Lip Balm 3.5 g', 'A moisturising lip balm formulated with canola honey to nourish and soften dry lips', 90000, 'https://www.innisfree.com/id/en/resources/upload/product/23391_l.png', 3.5, '2', '10', 5, 'innisfree', 100, 181, 0),
('Lip Peeling Booster 15 mL', 'Lip peeling booster that exfoliates by rolling the product gently with fingertips, creating smooth lips.', 98000, 'https://www.innisfree.com/id/en/resources/upload/product/31102_l.png', 15, '2', '10', 5, 'innisfree', 100, 182, 0),
('Twotone Eyebrow Kit 3.5g', 'Brow kit with two-tone colours for natural looking brows', 125000, 'https://www.innisfree.com/id/en/resources/upload/product/35157_l.png', 3.5, '2', '15', 0, 'innisfree', 100, 183, 0),
('Simple Label Volume & Curl Mascara 7.5 g', 'Hypoallergenic mascara with clean formula that keeps C-curled lashes comfortably for long without smudging', 225000, 'https://www.innisfree.com/id/en/resources/upload/product/34858_l.png', 7.5, '2', '15', 0, 'innisfree', 100, 184, 0),
('My Eyeshadow (Primer) 2.1g', 'Customized eye shadow with different options for your needs [Matte texture applied smoothly like silk]', 75000, 'https://www.innisfree.com/id/en/resources/upload/product/33137_l.png', 2.1, '2', '15', 5, 'innisfree', 100, 185, 0),
('Super Volumecara 10g', 'Super volume mascara with a wide, spoon-shaped brush that perfectly coats in between lashes, creating faux-lash effect', 180000, 'https://www.innisfree.com/id/en/resources/upload/product/31108_l.png', 10, '2', '15', 5, 'innisfree', 100, 186, 0),
('Skinny Micro Liner 0.14g', '2mm slim auto pencil liner that makes the eyes look elaborate and sharp by thoroughly filling the space between the lashes', 110000, 'https://www.innisfree.com/id/en/resources/upload/product/33050_l.png', 0.14, '2', '15', 5, 'innisfree', 100, 187, 0),
('Skinny Microcara 3.5g', 'A mascara with a slim, skinny brush that coats lashes for a natural and defined look', 160000, 'https://www.innisfree.com/id/en/resources/upload/product/31105_l.png', 3.5, '2', '15', 4, 'innisfree', 100, 188, 0),
('Always New Auto Liner 0.3g', 'An auto liner that self-sharpens every time you press and turn the cap, giving it an appearance of a new product.', 135000, 'https://www.innisfree.com/id/en/resources/upload/product/25329_l.png', 0.3, '2', '15', 3, 'innisfree', 100, 189, 0),
('Easy Stamping Brow 1ea', 'Choose desired brow angle, stamp, and done!', 130000, 'https://www.innisfree.com/id/en/resources/upload/product/29840_l.png', 0, '2', '15', 0, 'innisfree', 100, 190, 0),
('Nail Serum 6 mL', 'A two-layer (water-oil) serum that provides water-oil balance and makes the dry and splited finger healthy again', 65000, 'https://www.innisfree.com/id/en/resources/upload/product/34230_l.png', 6, '2', '11', 5, 'innisfree', 98, 191, 2),
('Nail Top Coat 6mL', 'A top coat that adds shine and consistency to nail colours.', 57000, 'https://www.innisfree.com/id/en/resources/upload/product/26107_l.png', 6, '2', '11', 4, 'innisfree', 97, 192, 3),
('Nail Gel Top Coat 6mL', 'Gel top coat that creates gel nail-like thick and shiny nails', 57000, 'https://www.innisfree.com/id/en/resources/upload/product/34243_l.png', 6, '2', '11', 5, 'innisfree', 98, 193, 2),
('Real Color Nail - Spring 6mL', 'High shine nail colour with vivid colours inspired by the beautiful nature.', 49000, 'https://www.innisfree.com/id/en/resources/upload/product/33045_l.png', 6, '2', '11', 5, 'innisfree', 100, 194, 0),
('Skin Fit Glow Cushion Puff 1EA', 'Sharp water drop shaped puff that helps apply makeup on the eye, nose and lip area thoroughly and micro cell structure creates glowing complexion', 30000, 'https://www.innisfree.com/id/en/resources/upload/product/35269_l.png', 0, '2', '8', 0, 'innisfree', 100, 195, 0),
('Green Tea Lip Conditioning Oil 4.5 g', 'Green Tea Lip Conditioning Oil formulated with naturally-derived oil complex including Green Tea Seed Oil from Jeju helps for a quick lip conditioning.', 180000, 'https://www.innisfree.com/id/en/resources/upload/product/34346_l.png', 4.5, '2', '8', 5, 'innisfree', 100, 196, 0),
('Nail Remover Dispenser 200 mL', 'Easy to use pump-type nail remover container', 45000, 'https://www.innisfree.com/id/en/resources/upload/product/33874_l.png', 200, '2', '8', 5, 'innisfree', 100, 197, 0),
('My To Go Cushion Puff 1p', 'Naturally derived bio material puff with soft usage that helps create delicate face makeup.', 30000, 'https://www.innisfree.com/id/en/resources/upload/product/26486_l.png', 0, '2', '8', 5, 'innisfree', 100, 198, 0),
('Restay Comforting Body Lotion 480 mL', 'innisfree re-stay comforting body lotion Clean beauty body lotion that calmly hugs my space with rich scent of juniper green woody scent and soft texture that hugs my body without leaving stickiness', 300000, 'https://www.innisfree.com/id/en/resources/upload/product/35371_l.png', 480, '3', '12', 0, 'innisfree', 100, 199, 0),
('My Essential Body Soft Green Creamy Body Scrub 150 mL', 'A moisturising creamy body scrub with the cozy scent of cedar trees and the fresh, pure scent of grass from a quiet stroll through a forest', 150000, 'https://www.innisfree.com/id/en/resources/upload/product/33052_l.png', 150, '3', '12', 0, 'innisfree', 100, 200, 0),
('Green Tea Pure Body Lotion 300ml', 'Enriched with Jeju green tea extract to provide hydration to the skin', 170000, 'https://www.innisfree.com/id/en/resources/upload/product/31830_l.png', 300, '3', '12', 5, 'innisfree', 100, 201, 0),
('Green Tea Pure Body Gel Scrub 150ml', 'Enriched with Jeju green tea extract to deliver hydration to the skin while providing exfoliating benefits', 120000, 'https://www.innisfree.com/id/en/resources/upload/product/31829_l.png', 150, '3', '12', 5, 'innisfree', 100, 202, 0),
('Green Tea Pure Body Cleanser 300ml', 'Enriched with Jeju green tea extract to softly cleanse the body with refined and foamy lather for clean and clear skin while providing moisture', 130000, 'https://www.innisfree.com/id/en/resources/upload/product/31828_l.png', 300, '3', '12', 4, 'innisfree', 100, 203, 0),
('Olive Real Body Lotion 300ml', 'This body lotion is enriched with extra virgin olive oil from the Crete Island to provide hydration to the skin.', 170000, 'https://www.innisfree.com/id/en/resources/upload/product/30622_l.png', 300, '3', '12', 5, 'innisfree', 100, 204, 0),
('My Essential Body Soft Green Body Lotion 330ml', 'A moisturizing body lotion with the cozy scent of cedar trees and the fresh, pure scent of grass that come from a quiet stroll through a forest.', 210000, 'https://www.innisfree.com/id/en/resources/upload/product/30619_l.png', 330, '3', '12', 3, 'innisfree', 100, 205, 0),
('My Essential Body Soft Green Body Cleanser 330ml', 'A moisturizing body cleanser with the cozy scent of cedar trees and the fresh, pure scent of grass that come from a quiet stroll through a forest.', 180000, 'https://www.innisfree.com/id/en/resources/upload/product/30618_l.png', 330, '3', '12', 5, 'innisfree', 100, 206, 0),
('My Perfumed Body Cleanser 330ml', '[Grapefruit] This perfume body cleanser is filled with a zesty and bittersweet scent of the peeled pink grapefruit that has just been picked. [Green Tangerine] This perfume body cleanser is filled with a sparkling scent of the tasteful green tangerines that provide a sweet rest from Jeju Island trip. [Water Lily] This perfume body cleanser is filled with a pure and elegant scent of Jeju Island water lilies that shyly sway to the gentle wind. [Pink Muhly Grass] This perfume body cleanser is filled with a mellow scent that reflects Jeju Island pink muhly grass which creates pink waves in the blue sky. [Cotton Flower] This perfume body cleanser is filled with a cozy scent of cotton flowers that warmly comforts the heart.', 180000, 'https://www.innisfree.com/id/en/resources/upload/product/29864_l.png', 330, '3', '12', 5, 'innisfree', 100, 207, 0),
('My Perfumed Body Cleanser TO GO 20ml', 'Body cleanser with a perfume-like fragrance that offers a pleasant body care experience like wearing the freedom felt in Jeju', 25000, 'https://www.innisfree.com/id/en/resources/upload/product/29862_l.png', 20, '3', '12', 5, 'innisfree', 100, 208, 0),
('Restay Calming Shampoo 480 Ml', 'Clean beauty shampoo, formulated with plant energy ingredients found in the nature, that cares fatigued scalp and hair and fills up the space with fresh aromatic green woody scent', 270000, 'https://www.innisfree.com/id/en/resources/upload/product/35369_l.png', 480, '3', '13', 0, 'innisfree', 100, 209, 0),
('My Hair Recipe Repairing Hair Sleeping Pack 100ml', 'This leave-on hair mask with a rich nourishment recipe delivers nourishment to damaged hair overnight for a healthy shine.', 180000, 'https://www.innisfree.com/id/en/resources/upload/product/33058_l.png', 100, '3', '13', 5, 'innisfree', 100, 210, 0),
('Camellia Essential Hair Oil Serum 100ml', 'This hair oil serum is formulated with Camellia Complex from Jeju island to provide healthy shine to damaged hair.', 150000, 'https://www.innisfree.com/id/en/resources/upload/product/31643_l.png', 100, '3', '13', 5, 'innisfree', 100, 211, 0),
('My Hair Recipe Moisturizing Hair Mist [for Dry Hair] 150ml', 'This styling hair mist with a moisturising and lustrous recipe delivers hydration and nutrition to dry hair for a softer feel.', 195000, 'https://www.innisfree.com/id/en/resources/upload/product/31638_l.png', 150, '3', '13', 4, 'innisfree', 100, 212, 0),
('My Hair Recipe Repairing Oil Serum [for Damaged Hair] 70ml', 'A highly-enriched oil serum with a rich nourishing recipe that delivers nourishment to damaged hair for a softer feel.', 180000, 'https://www.innisfree.com/id/en/resources/upload/product/23405_l.png', 70, '3', '13', 4, 'innisfree', 100, 213, 0),
('My Hair Recipe Repairing Shampoo [for Damaged Hair] 330ml', 'This shampoo is made with a rich nourishment recipe and it delivers nourishment to damaged hair for a softer feel.', 150000, 'https://www.innisfree.com/id/en/resources/upload/product/23403_l.png', 330, '3', '13', 5, 'innisfree', 100, 214, 0),
('My Hair Recipe Moisturizing Oil Serum [for Dry Hair] 70ml', 'A non-sticky, refreshing oil serum with a moisturising and lustrous recipe to deliver hydration and nutrition to dry hair for a softer feel.', 180000, 'https://www.innisfree.com/id/en/resources/upload/product/23402_l.png', 70, '3', '13', 5, 'innisfree', 100, 215, 0),
('My Hair Recipe Refreshing Shampoo for Oily Scalp 330ml', 'Made with a refreshing recipe containing naturally-derived surfactants to deliver refreshing feel to oily scalp.', 150000, 'https://www.innisfree.com/id/en/resources/upload/product/23397_l.png', 330, '3', '13', 5, 'innisfree', 100, 216, 0),
('Green Tea Mint Fresh Shampoo 300ml', 'This shampoo is formulated with green tea from Jeju Island and mint, and is designed to cleanse the scalp with a refreshing sensation.', 100000, 'https://www.innisfree.com/id/en/resources/upload/product/31110_l.png', 300, '3', '13', 5, 'innisfree', 100, 217, 0),
('Orchid Hand Cream SPF15/PA+ 50ml', 'A hand cream formulated from Jeju Orchid to provide sun protection for soft and moisturised hands', 99000, 'https://www.innisfree.com/id/en/resources/upload/product/33090_l.png', 50, '3', '14', 5, 'innisfree', 100, 218, 0),
('Canola Honey Hand Butter EX 50ml', 'High nutritious hand butter made from Jeju Canola honey builds moisture layer on your hand for well moisturized hands.', 99000, 'https://www.innisfree.com/id/en/resources/upload/product/31648_l.png', 50, '3', '14', 4.5, 'innisfree', 100, 219, 0),
('Green Tea Pure Gel Hand Cream EX 50ml', 'Fresh gel-type hand cream enriched with Jeju green tea ingredient that provides deep hydration for softening skin', 89000, 'https://www.innisfree.com/id/en/resources/upload/product/22703_l.png', 50, '3', '14', 4, 'innisfree', 98, 220, 2),
('Olive Real Moisture Hand Cream EX 50ml', 'Hand cream made from olive oil with soft texture like whipped cream is easily absorbed for moisturizing.', 89000, 'https://www.innisfree.com/id/en/resources/upload/product/22702_l.png', 50, '3', '14', 3.5, 'innisfree', 100, 221, 0),
('Ribbon Hair Band 1p', 'Hair band for keeping hair out of your face during cleansing or applying makeup.', 45000, 'https://www.innisfree.com/id/en/resources/upload/product/33070_l.png', 0, '3', '8', 5, 'innisfree', 100, 222, 0),
('Paddle Hair Brush 1P', 'Hair brush for hair styling and scalp massage.', 83000, 'https://www.innisfree.com/id/en/resources/upload/product/29853_l.png', 0, '3', '8', 5, 'innisfree', 100, 223, 0),
('Shower Ball 1p', 'A shower towel made of cotton and nylon to create a lather for deep cleansing.', 30000, 'https://www.innisfree.com/id/en/resources/upload/product/22690_l.png', 0, '3', '8', 5, 'innisfree', 100, 224, 0),
('Dual Pore Cleansing Brush 1P', 'Dual cleansing brush that gently exfoliates and removes blackheads without irritating the skin.', 245000, 'https://www.innisfree.com/id/en/resources/upload/product/27554_l.png', 0, '3', '8', 4, 'innisfree', 100, 225, 0),
('Artistry Exact Fit Beauty Balm Perfecting Primer', 'ONE SHADE FITS ALL Our skin-transforming Elasto-Network primes and instantly improves the look of skins texture. Use under your foundation for easier makeup application and blending or alone for ultra-sheer coverage with SPF.', 66000, 'https://www.amway.com/medias/118209-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzODczOHxpbWFnZS9qcGVnfGltYWdlcy9oMTgvaGNjLzg4MzgxNzc1ODcyMzAuanBnfDdiZTA0MDcwNWRkMmI5YmE4YWI0MjQ3ZTkyZWE4MzgwN2M3MTk0ZWI5OGI2NGZkODQzZWMyNWU5NjhlM2E1YWY', 30, '2', '9', 4.5, 'amway', 100, 226, 0),
('Artistry Ideal Radiance Illuminating CC Cream ', 'COLOR-CORRECT AND PROTECT Made with custom Pearl Protein Extract to give you bright, natural-looking coverage. Our Multi-Dimensional Finishing Complex perfects the look of skin and SPF 50 shields your face from harmful UV ray.', 66000, 'https://www.amway.com/medias/120561-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w0MDYwMHxpbWFnZS9qcGVnfGltYWdlcy9oNGUvaDkzLzg4MzgyMzI3Njg1NDIuanBnfGJhMDMwOTljOGY0NDI1YTZiNTI0NzkzOGEyZjBhZmFmZDlmYTNhYWJlODQzOWNmNzg5NzRjOGFmYzZlOWJjN2M', 30, '2', '9', 0, 'amway', 100, 227, 0),
('Artistry Ideal Radiance Illuminating CC Cream Light', 'COLOR-CORRECT AND PROTECT Made with custom Pearl Protein Extract to give you bright, natural-looking coverage. Our Multi-Dimensional Finishing Complex perfects the look of skin and SPF 50 shields your face from harmful UV ray.', 66000, 'https://www.amway.com/medias/118208-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w0MDc4MnxpbWFnZS9qcGVnfGltYWdlcy9oYzIvaDU2Lzg4MzgyMDAzNjA5OTAuanBnfDc4NTJlYjUwYzc5ZmQzMGQ5MGMyZmFjYTkwYmYyNDZlMjE1Y2NjNDBkYTQ3Y2UwZmFhY2U4MzE1NzA1YjE5ZTI', 30, '2', '9', 5, 'amway', 100, 228, 0),
('Artistry Ideal Radiance Illuminating CC Cream Light Me', 'COLOR-CORRECT AND PROTECT Made with custom Pearl Protein Extract to give you bright, natural-looking coverage. Our Multi-Dimensional Finishing Complex perfects the look of skin and SPF 50 shields your face from harmful UV ray.', 66000, 'https://www.amway.com/medias/118207-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w0MDkxNXxpbWFnZS9qcGVnfGltYWdlcy9oM2UvaGRhLzg4MzgxODM2MTY1NDIuanBnfDdkNWJmMDQxNGUxODNhOGE5MDExOWZmN2IwZGVkMGYyNjU4MmYxNTVmYTQyNzRlZjkzNWU2MjNjYTBjMGM4MTA', 30, '2', '9', 4.5, 'amway', 100, 229, 0),
('Artistry Ideal Radiance Illuminating CC Cream  Me', 'COLOR-CORRECT AND PROTECT Made with custom Pearl Protein Extract to give you bright, natural-looking coverage. Our Multi-Dimensional Finishing Complex perfects the look of skin and SPF 50 shields your face from harmful UV ray.', 66000, 'https://www.amway.com/medias/119336-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w0MDgwMHxpbWFnZS9qcGVnfGltYWdlcy9oNDYvaDNmLzg4MzgxOTU2NzUxNjYuanBnfGQxYjlmZTM1YzMwNjJlNzY5ODc4ODQ4YzVkZDdlMWMyNDMxMzkzYjMyN2E1NzgwYjZlOGY5MjAwYjc0M2E1Mjg', 30, '2', '9', 5, 'amway', 100, 230, 0),
('Artistry Ideal Radiance UV Protect SPF 5', 'ALL-DAY SPF PROTECTION Broad spectrum sunscreen to protect your skin from damaging effects of environmental aggressors and UVB/UVA rays, even during the peak of sun exposure.', 100000, 'https://www.amway.com/medias/117809-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzNjI5N3xpbWFnZS9qcGVnfGltYWdlcy9oYWUvaGU2Lzg4MzgxODEyNTcyNDYuanBnfDdhODAxNDY2YWY3OTIyZjNiZjI3ZjY4YTJmZjlkZWNiOGU5ZmY3YjY3YTdkMzJmNzBkZTEzZWUwOWNlNjRhOTg', 30, '1', '2', 5, 'amway', 100, 231, 0),
('Artistry Signature Select Brightening Body Cream', 'Show off skins glow and reveal your inner Goddess!', 70000, 'https://www.amway.com/medias/123862V-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w2MzU0MHxpbWFnZS9qcGVnfGltYWdlcy9oY2YvaDhiLzg5MjA4MzcyNTkyOTQuanBnfDNmNGVhOTAyZWMzNGNmZTI4M2UxMWZiZmMwMTExNjg4YjI2ZGUwMzM0YmEyOGJiODQ2OTIyZDJmMjkzNmYxNGM', 200, '1', '2', 5, 'amway', 100, 232, 0),
('Artistry Signature Select Firming Body Lotion', 'Firm. Tighten. Smooth. Renew.', 80000, 'https://www.amway.com/medias/123861V-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w2NDQ5NXxpbWFnZS9qcGVnfGltYWdlcy9oOGUvaDk1Lzg5MjA4MzgxNDQwMzAuanBnfGM5YzM0MThmNTI0YWVlMjgzNDljZDQyNGViMmI1MjU1MGJlMDkxOTZkNjU3N2QyYTZmMDg5ZTAwOWYyODI5NDA', 200, '1', '2', 5, 'amway', 100, 233, 0),
('Artistry Signature Select Hydrating Body Green', 'Deeply Hydrate. Protect. Strengthen.\n\nQuench dry, thirsty skin with deep hydration for up to 48 hours! This amazing hydro-gel formula self-adjusts to fit your custom needs and deliver moisture when and where skin needs it most. Formulated with Nutrilite-sourced green tea and peach flower extracts that help deliver antioxidant protection from free radicals, pollutants and impurities to help keep your skin looking and feeling nourished and healthy.', 50000, 'https://www.amway.com/medias/123858V-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w0OTY3MHxpbWFnZS9qcGVnfGltYWdlcy9oZmQvaGY4Lzg5MjA4MzkzMjM2NzguanBnfGZkNmUxMTllYjliYTI5MzA3ZDdkNjUzZWNlMDk2NzU0ZTg5NTlhZmIwMzA5MGJmMGZiYWY0NjQyNDgyZjUyODg', 200, '1', '2', 5, 'amway', 100, 234, 0),
('Artistry Skin Nutrition Balancing Matte Day Lotion SPF ', 'PROTECTION BEYOND SPF WITH A MATTE FINISH. This lightweight lotion floods over skin then quickly absorbs, leaving a soft matte look.', 70000, 'https://www.amway.com/medias/123799-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzMzMyNnxpbWFnZS9qcGVnfGltYWdlcy9oMWIvaDY0LzkwODQ0Nzg3MTc5ODIuanBnfGViYjk4OTMwOGEwZTg5MzQ0ZTA0YjgyNjNmY2E3ZDhiNDYxNWNiNWI1NWUwOTQ4M2Y4MDgyMmUzOTdmZmViZjA', 50, '1', '2', 5, 'amway', 100, 235, 0),
('Artistry Skin Nutrition Firming Ultra Lifting Cream', 'REBUILD, MOISTURIZE, PROTECT. Experience the richest, most comprehensive anti-aging moisturizer in the Artistry Skin Nutrition collection. This intensively nourishing, luxuriously rich multi-action cream is bursting with high-powered anti-aging benefits.', 142000, 'https://www.amway.com/medias/123786V-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w1MjMyN3xpbWFnZS9qcGVnfGltYWdlcy9oNTEvaGZlLzkyNDM3MzM5MTc3MjYuanBnfDhjZWYyYzdhZTk4M2ExYzM4MjI1OWNmMWRhY2RlMGQ0YjA4YmVjZDg4ZmM1NmYxN2NiMWViYmM3ZTNkZTY4ZjY', 50, '1', '2', 5, 'amway', 100, 236, 0),
('Artistry Skin Nutrition Hydrating Day Lotion SPF ', 'PROTECTION BEYOND SPF WITH ALL-DAY HYDRATION. Lightweight, invisible lotion is supercharged with full light and pollution protection to restore and plump skin with moisture.', 75000, 'https://www.amway.com/medias/123800-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzMzA5NnxpbWFnZS9qcGVnfGltYWdlcy9oZTQvaGY4LzkwODQ1MjAxMzY3MzQuanBnfDRkZmMwNmIzNGY5NWJlNzY3ZGM3MGEzYTk2ZGYyYWU3M2U4MThlZmU1NDM2NDMzODgyNGVhYWMyOGIxM2U1OTY', 50, '1', '2', 5, 'amway', 100, 237, 0),
('Artistry Skin Nutrition Renewing Reactivation Cream', 'REPAIR, FIRM, STRENGTHEN. Experience the rush of supercharged skin with this glossy cream that visibly reduces signs of aging.', 140000, 'https://www.amway.com/medias/123785V-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w1Mzc2NXxpbWFnZS9qcGVnfGltYWdlcy9oMTQvaDFkLzkyNDM3MzM0OTE3NDIuanBnfGM3MjNlNzRiZmUwYjM0NzFiNmQ4ZDdiZTRlMmFmNjI2MWI3YmMyMDQxNGMwODJmZmQxOTMyZWY2MTkyYzdjNzk', 50, '1', '2', 5, 'amway', 100, 238, 0),
('Artistry Studio Hydro-Prime Light Hydrator + Primer', 'MEET MAKEUPS BFF Be ready for prime time, anytime. This cool, refreshing gelato gel instantly hydrates, blurs, mattifies and primes your skin for makeup.', 60000, 'https://www.amway.com/medias/124814-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w1MzcxNXxpbWFnZS9qcGVnfGltYWdlcy9oNTcvaGExLzg4OTc2NTAxOTY1MTAuanBnfDNhODI5MzA4ZDllODhlYjEzNWQ0NzM4Mzc5ZDE2YTMzMzk2NzNmMzk1NDJlYTZhYjMyMzc2MDA2OWJkNjkwYTQ', 50, '1', '2', 5, 'amway', 100, 239, 0),
('Artistry Supreme LX Regenerating Cream', 'LEAVES SKIN LOOKING VISIBLY LIFTED Get your skin to act up to 15 years younger! Our most luxurious and technologically advanced anti-aging cream helps transform and regenerate your skins youthful appearance.', 800000, 'https://www.amway.com/medias/118184V-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w3MDk2M3xpbWFnZS9qcGVnfGltYWdlcy9oYmYvaDYwLzg4MzgxOTM4MDczOTAuanBnfGJmYTJiMzc2ZWI4NGM0ZDBlZGZjOTY2MGE5ODA1N2RjYTU0OGZlYmY3NDI0YTEyYjAyM2M3YzQ0NTU3NDJiODc', 50, '1', '2', 5, 'amway', 100, 240, 0),
('Artistry Supreme LX Regenerating Eye Cream', 'REDUCE THE LOOK OF VISIBLE DARK CIRCLES This rich emollient cream offers full-circle anti-aging benefits for your entire eye area to awaken younger-looking, more radiant eyes. Reduces the look of visible dark under-eye circle.', 350000, 'https://www.amway.com/medias/118185V-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzOTgzNXxpbWFnZS9qcGVnfGltYWdlcy9oNWUvaDdlLzg4MzgxOTY2OTA5NzQuanBnfGUyYjdkZTI2YTdmMTg2MTRlNmFhMTljODllMWM3NGNjZDNhMzcwMjg4NjEwY2Q5YjYzNWYwZGY5NzNmMzdjMjY', 15, '1', '2', 5, 'amway', 100, 241, 0),
('Artistry Men Facial Moisturizer', 'MINIMIZE MOISTURE LOSS Promote oil control and deep hydration with this lightweight, fast-absorbing formula that leaves your skin looking and feeling healthy and smooth.', 75000, 'https://www.amway.com/medias/111228V-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzMDEwOXxpbWFnZS9qcGVnfGltYWdlcy9oNGQvaDFiLzg4MzgxNjM1OTUyOTQuanBnfDZmYWQyZjNhODViYzhlY2EyMWIzNDRjMDQxN2MyNGI1ZmJmMTNlYjE1ZmRmOTA0ODQ5YmJiMzMxZTZjZmM1MDU', 150, '1', '2', 5, 'amway', 100, 242, 0),
('Artistry Hydra V Replenishing Moisture Cream for Dry Skin', 'RESCUE SKIN FROM DRYNESS Deeply moisturize dry, stressed skin with soothing ingredients to boost hydration.', 80000, 'https://www.amway.com/medias/117646V-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w1ODA4MnxpbWFnZS9qcGVnfGltYWdlcy9oOWEvaGU1Lzg4MzgxOTA1OTYxMjYuanBnfDNjN2RhMmQ0OWY4YzVjZjQ2NzIzOWViZWI2ODM0ZjlhYjhmMzE4NTMwNTRlNTA5ZjhiMDlhNjMxM2YxMTcxYjE', 50, '1', '2', 5, 'amway', 100, 243, 0),
('Artistry Ideal Radiance Illuminating Milky Emulsion (Moisturizer for Combination-to-Oily Skin)', 'CUSTOMIZED HYDRATION Made with a patented blend of White Chia Seed and Pomegranate Extract for antioxidant protection, and Pearl Protein Extract to even skin tone and treat visible dark spot.', 150000, 'https://www.amway.com/medias/119621V-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzMzI4M3xpbWFnZS9qcGVnfGltYWdlcy9oODMvaGZhLzg4MzgxOTU5NzAwNzguanBnfDYzMmQ3YTdkZWFjMGVhZjAxYTcxMDMwNmQyOWM3Yjk5NzY2MjUzNWNjZTM3OWQxMTI5YWQzOTQ4YjcxNjdjMWU', 100, '1', '2', 5, 'amway', 100, 244, 0),
('Artistry Skin Nutrition Balancing Fresh Shake Toner', 'SHAKE, SHAKE, SHAKE! Sweeps away oil and shine in an instant!', 50000, 'https://www.amway.com/medias/123794V-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzMzIwNXxpbWFnZS9qcGVnfGltYWdlcy9oZTEvaGRlLzkwODQ0ODIwNjAzMTguanBnfDJlOTVhY2NhM2QzZjgyNDBhYzBmNzVjMzMzNmFmMDhlNDFkYmE5YWU0MzdhMGJhMWVjOTBlNGFhYzE1ZTIzZmI', 200, '1', '1', 5, 'amway', 100, 245, 0),
('Artistry Skin Nutrition Hydrating Smoothing Toner', 'PROVIDES A FRESH BURST OF HYDRATION! Leaves skin with a smooth, silky-soft feel and a vibrant healthy-looking complexion.', 50000, 'https://www.amway.com/medias/123795V-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzMzE0M3xpbWFnZS9qcGVnfGltYWdlcy9oMGYvaGJjLzkwODQ0ODE5NjIwMTQuanBnfDg4YTQ4NTVkYjdmNzQ1YTU2YjBjYmY1N2Q3NTg5MGMwMjVjNDg2Y2NkOTczNjFmYWFiMjE1ZmE2YjZiYmUxODE', 200, '1', '1', 5, 'amway', 100, 246, 0),
('Artistry Skin Nutrition Renewing Softening Toner', 'SOOTHING AND SMOOTHING This luscious, milky liquid emulsion surges into skin with soothing, smoothing moisture, absorbing easily to leave a dewy-drenched and soft, oh-so-comforting feeling.', 80000, 'https://www.amway.com/medias/123783V-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzNTIzMXxpbWFnZS9qcGVnfGltYWdlcy9oNmYvaGM3LzkyNDM3MzQ0NzQ3ODIuanBnfGM5MWNjZDY1NDQ5YzMwNWRiZjBlYTVmYWZiMmEyODgyOTA2MDk3NTFhYzgxYjgwNTgzMGNjMGNiNDgwOGQ4MTU', 200, '1', '1', 5, 'amway', 100, 247, 0),
('Artistry Signature Select Polishing Body Scrub', 'Exfoliate. Polish. Refresh. Re-energize.\n\nIs your skin ready for a refresh? This instant-action exfoliating scrub is made with extra-fine bamboo grains that gently work to sweep away the buildup of dull, dry surface cells and reveal fresh, smooth, glowing skin underneath. Nutrilite -sourced black currant extract plus a blend of essential oils help nourish skin so it stays baby-soft for days.', 75000, 'https://www.amway.com/medias/123860V-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w0MzQ0OHxpbWFnZS9qcGVnfGltYWdlcy9oYzUvaDRiLzg5MjA4MzkwMjg3NjYuanBnfGRiNjM2ZGZhOWNjM2EzYjFlYmRlOGU4NjRlNGRiNzdmMDIwZjlkZjY3MTA3OWY1ZTc2NmQyNjU4NGRlNGE1OGM', 197, '1', '6', 4.5, 'amway', 100, 248, 0),
('Artistry Signature Select Purifying Body Cleanser', 'Everyone deserves a clean start even your skin!\n\nPurify. Cleanse. Soften. Strengthen.\n\nGently cleanse skin from impurities including sweat, dirt and pollution micro-dust. This daily cleansers formula is infused with Nutrilite sourced citrus extract, perilla and evening primrose oils to proactively helps strengthen skins barrier and help defend against dryness to leave it feeling soft, smooth, moisturized and prepped to receive all the benefits from your full body care routine.', 50000, 'https://www.amway.com/medias/123859V-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w2MDU3MHxpbWFnZS9qcGVnfGltYWdlcy9oYTQvaGMzLzg5MjA4Mzc5NDc0MjIuanBnfGI5MDVmYTI1ZjI5NmM5OTJmZWM1MGY4MjUyZmVkZjNjZTk5NTdmMzgxYTcyYWNmYjJhYWIyMTYxMWQ3ZTRlNzM', 200, '1', '6', 4.5, 'amway', 100, 249, 0),
('Artistry Skin Nutrition Balancing Jelly Cleanser', 'DIVES DEEP INTO PORES! Soothing, iridescent gel transforms into an abundant, cooling lather that cleans pores and removes excess oil, pollution and impurities.', 50000, 'https://www.amway.com/medias/123792V-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzMzc2MXxpbWFnZS9qcGVnfGltYWdlcy9oZGEvaDVlLzkwODQ0NzYwNjM3NzQuanBnfGJlMzI5MDZjMmQ4NjY0NDlhZDliYWIxNjZkZDA0YzI1ZjZkYTY0ZWJkN2NmMTAwNDRkYTU0ODQxNmVmNDAzYTQ', 125, '1', '6', 4, 'amway', 100, 250, 0),
('Artistry Skin Nutrition Hydrating Mousse Cleanser', 'DELIGHTFULLY HYDRATING AND CLEAN! Aerated, cushiony cleansing mousse sweeps away dirt, debris and other impurities from the skin quickly and easily.', 50000, 'https://www.amway.com/medias/123793V-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzMzMwMXxpbWFnZS9qcGVnfGltYWdlcy9oZTAvaDgxLzkwODQ1MjIwMDQ1MTAuanBnfDRiYWNhNTM1M2IyNGZiNjY2ODgxN2EyZjZmZWQyZGE3ZjYwOGQ3MzFjNTg4ZWU4ZjdmZmM4ZDIzY2M3NGY4Yzk', 145, '1', '6', 4, 'amway', 100, 251, 0),
('Artistry Skin Nutrition Micellar Makeup Remover + Cleans', 'MAKES MAKEUP DISAPPEAR! Enjoy your micellar moment and the amazing way your skin will feel.', 46000, 'https://www.amway.com/medias/123791V-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzNDE5MnxpbWFnZS9qcGVnfGltYWdlcy9oMjkvaGQ0LzkwODQ0NzAyNjM4MzguanBnfDc4OTQ3NWEyNGQ2MGMxZDRiNDcyMjYzZjNhZTZlOWViNzE0YTk4OWQ5ZTFiMjRmNzhkZGIzYzYzZTcxNDBiNTU', 200, '1', '6', 4, 'amway', 100, 252, 0),
('Artistry Skin Nutrition Renewing Foaming Cleanser', 'PURIFY, CONDITION, RENEW. Experience a rich, creamy foam that quickly and gently cleans your skin. This cushiony lather removes impurities and leaves your skin feeling soothed and supple.', 52000, 'https://www.amway.com/medias/123781V-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzNjAxN3xpbWFnZS9qcGVnfGltYWdlcy9oOTYvaGYyLzkyNDM3MzQ0MDkyNDYuanBnfDBlMGNjNzNhMzAzNDkzNGY2NmEyMTU1ZDY0OWU4MDNkMjhlZDFjMjRkNjBmZjVmZWIxYmIyNTY0MDUwOTJiNDU', 125, '1', '6', 3, 'amway', 100, 253, 0),
('Artistry Studio Clean Start Micellar Makeup Remover + Cleans', 'SWIPE LEFT, SWIPE RIGHT These no-rinse towelettes clean fabulously even when you\'re too tired to do more. ', 25000, 'https://www.amway.com/medias/124811-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w0NDU1OHxpbWFnZS9qcGVnfGltYWdlcy9oMTAvaGQ5Lzg4OTc2NTI0NTc1MDIuanBnfDYyOTBmYjYzMDcwMTZlMDFiZGIyNzA5YzE4N2YyMTBjZjA2ZTA5NWNmN2U2NDBiMjliODg3YjA3ODNjNmM0ZTg', 0, '1', '6', 5, 'amway', 100, 254, 0),
('Artistry Studio Every Day Im Bubblin Cleanser + Skin Invigorator', 'FEEL THE FIZZ Me times about to get poppin. Indulge in these ahhh-mazing scented sheet masks and fizz away built-up impurities, cleanse pores and energize your skin and senses. Its like a bubble bath for you!', 30000, 'https://www.amway.com/medias/124817-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w0MzQxMXxpbWFnZS9qcGVnfGltYWdlcy9oNWYvaGNlLzg4OTc2NTIwNjQyODYuanBnfGVhOTQ1NzgyNmI2MjVjMWI1YjE3OGJjZGFlMjAwOTViMjY5MTY2MDFjZjczMjEzZWYxMDY5MjMwZTI3NzA4Njc', 0, '1', '6', 5, 'amway', 100, 255, 0),
('Artistry Studio Glow Boss Cleanser + Exfoliator', 'GLOW GET IT, GIRL Take on the day with a fresh start for your skin. This daily cleanser and scrub in one exfoliates as it cleans, sweeps away impurities and buildup so skin feels soft and smooth. Say hello, glow!', 35000, 'https://www.amway.com/medias/124812-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzMjQ3M3xpbWFnZS9qcGVnfGltYWdlcy9oMzYvaDg0Lzg4OTc2NTMyNDM5MzQuanBnfDZjY2U1NWEwZmM3NjQyYWU5MTc5NmYzODlhNTRmZjgwNDc4MWYxZWEzZWU5ZmVjNzY2MzczZDMxYTUwMTkyMTY', 125, '1', '6', 5, 'amway', 100, 256, 0),
('Artistry Men Gentle Face Wash', 'CLEANSE AND SCRUB IN ONE STEP Removes daily dirt and excess oil with moisturizing jojoba and mannan beads to leave skin feeling clean, refreshed and conditioned, never tight or dry.', 50000, 'https://www.amway.com/medias/111225V-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzMTE2MnxpbWFnZS9qcGVnfGltYWdlcy9oZTAvaDA1Lzg4MzgxNDI0MjcxNjYuanBnfDZkNDZjZjI2OWNkOTZiNmM0ZjFmNTczNjI4Nzc1YWYyMWZlODdkYTllMWIwNjA4MWZiYzUyZWJiOGNlNTFmMmE', 115, '1', '6', 5, 'amway', 100, 257, 0),
('Artistry Signature Select Anti-Spot Amplifier', 'SPOT-TARGETING VITAMIN C TECHNOLOGY For dark spots and uneven complexion. Brightens and evens skin tone while reducing the formation of visible dark spot.', 65000, 'https://www.amway.com/medias/121560V-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w0MjIwMHxpbWFnZS9qcGVnfGltYWdlcy9oYzMvaDBjLzg4MzgyMjY5MDMwNzAuanBnfDEyNTM3NzhiN2ViMWY1YThmMDFmM2ZkMjllOTNiZjM5MjZlMjAwMTkzMThmMTY4Njk3YzMwYzg3ZjVkMDIzMWI', 24, '1', '3', 4, 'amway', 100, 258, 0),
('Artistry Signature Select Anti-Spot Amplifier and Base Serum', 'SPOT-TARGETING VITAMIN C TECHNOLOGY For dark spots and uneven complexion. Brightens and evens skin tone while reducing the formation of visible dark spot.', 150000, 'https://www.amway.com/medias/282717-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzNDg5MnxpbWFnZS9qcGVnfGltYWdlcy9oMDYvaDdmLzg4MzgyODc1NTY2MzguanBnfDNiMzg4MDNlM2Y0YWEyZDRlMDFjMjZiZDRiYjZhMTEyOWM4ZGU0MGJhNjU4MDQ1ZDIzNmM2ZGZhNzRlZjE3MGM', 24, '1', '3', 4, 'amway', 100, 259, 0),
('Artistry Signature Select Anti-Wrinkle Amplifier', 'LINE-DIMINISHING TECHNOLOGY For fine lines and wrinkles. Strengthens skins support network, diminishing the appearance of fine lines and even deep-set wrinkles.', 75000, 'https://www.amway.com/medias/121558V-en-US-690px-01?context=bWFzdGVyfHJvb3R8NDM5NTh8aW1hZ2UvanBlZ3xoODkvaDcyLzg4MzgyMjk2MjI4MTQuanBnfDRlNjg0NDg3OThmMTQ0YWNlYTY3YTRlMDA3ZTE2MmZhMzAxZjAwNzA3YmZhYjViZThhNDA3NjQ2YmZiZTJkZTE', 24, '1', '3', 4, 'amway', 100, 260, 0),
('Artistry Signature Select Anti-Wrinkle Amplifier and Base Serum', 'LINE-DIMINISHING TECHNOLOGY For fine lines and wrinkles. Strengthens skins support network, diminishing the appearance of fine lines and even deep-set wrinkles.', 165000, 'https://www.amway.com/medias/282718-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzNzUxNnxpbWFnZS9qcGVnfGltYWdlcy9oNWQvaDhmLzg4MzgyNTIwMzYxMjYuanBnfGY5NmFlYzAxNTdiMGUwNWUwMzZkYzU3NWNkMjg1NDE4MDQ5YTI0ZWQ3Njk3NmFkOTA0NGEzNGI5ODRkMzdkZmE', 24, '1', '3', 3.5, 'amway', 100, 261, 0),
('Artistry Signature Select Firming Amplifier', 'SKIN-TIGHTENING TECHNOLOGY For sagging skin Clinically improves the building blocks of skins firmness, elasticity and resilience.', 81000, 'https://www.amway.com/medias/121559V-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w0MjkwNHxpbWFnZS9qcGVnfGltYWdlcy9oNDgvaDFkLzg4MzgyNDY0MzI3OTguanBnfDhkODJkMTNhZmQzNWRlNzMwY2UxY2EyNjk3YWUxMGFiMzU0OTYzMTc3Njg4MzI0ODgwYjk4MmQzY2Q2YTExYjI', 24, '1', '3', 4, 'amway', 100, 262, 0),
('Artistry Signature Select Firming Amplifier and Base Serum', 'SKIN-TIGHTENING TECHNOLOGY For sagging skin. Clinically improves the building blocks of skins firmness, elasticity and resilience.', 150000, 'https://www.amway.com/medias/282719-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzNDMwNXxpbWFnZS9qcGVnfGltYWdlcy9oYjUvaDQyLzg4MzgyNzEyMDU0MDYuanBnfDEzZjg5MzhlNmI4NTViZmVlZmI3NzBjYWM3OTliYjcxYzhjNzYxMzU5MjJhMDEyMzgwMDYxNTQ2Zjg2Nzc2NGE', 24, '1', '3', 4, 'amway', 100, 263, 0),
('Artistry Studio Eye Look Rested De-Puffer + Brighten', 'PUFF BE GONE No sleep? No worries. These serum-infused pillow masks cool down puffiness and recharge skin so that your eyes appear brighter and rested.', 65000, 'https://www.amway.com/medias/124818-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w0MDE4MHxpbWFnZS9qcGVnfGltYWdlcy9oNWMvaGZhLzg4OTc2NTM4MzM3NTguanBnfGE2OTc5YTQxM2EzYTkwYTVkZjg2MDI1MDQ2ZTllODc1ZmE2ZmJkYjkzNDA1MDQyZDM0NDhjYWFjYzlhZjE2ZjM', 30, '1', '3', 4, 'amway', 100, 264, 0),
('Artistry Men Facial Moisturizer', 'MINIMIZE MOISTURE LOSS Promote oil control and deep hydration with this lightweight, fast-absorbing formula that leaves your skin looking and feeling healthy and smooth.', 75000, 'https://www.amway.com/medias/111228V-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzMDEwOXxpbWFnZS9qcGVnfGltYWdlcy9oNGQvaDFiLzg4MzgxNjM1OTUyOTQuanBnfDZmYWQyZjNhODViYzhlY2EyMWIzNDRjMDQxN2MyNGI1ZmJmMTNlYjE1ZmRmOTA0ODQ5YmJiMzMxZTZjZmM1MDU', 150, '1', '7', 4, 'amway', 100, 265, 0),
('Artistry Men Gentle Face Wash', 'CLEANSE AND SCRUB IN ONE STEP Removes daily dirt and excess oil with moisturizing jojoba and mannan beads to leave skin feeling clean, refreshed and conditioned, never tight or dry.', 50000, 'https://www.amway.com/medias/111225V-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzMTE2MnxpbWFnZS9qcGVnfGltYWdlcy9oZTAvaDA1Lzg4MzgxNDI0MjcxNjYuanBnfDZkNDZjZjI2OWNkOTZiNmM0ZjFmNTczNjI4Nzc1YWYyMWZlODdkYTllMWIwNjA4MWZiYzUyZWJiOGNlNTFmMmE', 115, '1', '7', 4, 'amway', 100, 266, 0),
('Artistry Men Serum Concentrate', 'LOOK AS FRESH AS YOU FEEL Improve your overall skin firmness with our anti-aging concentrate. Made with oat extract that naturally exfoliates for smoother-looking skin.', 115000, 'https://www.amway.com/medias/119024V-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzMzAxM3xpbWFnZS9qcGVnfGltYWdlcy9oODIvaDAyLzg4MzgxODA1NjkxMTguanBnfDk4OWQ2OTZmNDgxZGFmZjgxYzUzYTJhZDg5NGQ5NTBjZjk5YjJhNzRiMDRiMTg1MGI2NmIyYzI4YmQwNmRlYTY', 30, '1', '7', 3, 'amway', 100, 267, 0),
('G&H Soothe+ For Men After Shave Balm', 'SOOTHE IRRITATION G&H Soothe+ For Men After Shave Balm This moisturizing, non-greasy formula is made with aloe vera extract, vitamin E and chamomile to calm and soothe skin.', 50000, 'https://www.amway.com/medias/123747-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w0MzE4MXxpbWFnZS9qcGVnfGltYWdlcy9oMTQvaGEwLzg4NTY4Nzg5NzI5NTguanBnfGIxMDhkOTI0ODM1ODU0YmFiOGJhZWU0ZWE4MjJkM2JiNjc4ZTQ2MzU4MWVkOTVjN2UwMjc4OWI4ZjI2NmZlY2Q', 100, '1', '7', 3, 'amway', 100, 268, 0),
('G&H Soothe+ For Men Foaming Shave Gel', 'SHIELD FROM RAZOR BURN Rich, foaming texture increases razor glide and softens beard hair for an easy shave from start to finish. Made with Licorice Root extract to help soothe skin.', 25000, 'https://www.amway.com/medias/123746-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w0MDE3NHxpbWFnZS9qcGVnfGltYWdlcy9oM2EvaDVjLzg4NTY4NzkxMzY3OTguanBnfDM5ODI0M2ViYmE3NjA2ZDNlZTFmMzk1ZTFiM2EzMWEwZmMwYzNiNjE2MTkyNGRlNjVmNWZkZjc1NzI0OWI2NDE', 100, '1', '7', 5, 'amway', 100, 269, 0),
('Artistry Exact Fit Pressed Powder', 'LOCK IN GORGEOUS SKIN Our silky smooth formula mimics the look of your skin with a single universal shade for a natural-looking finish that helps control shine.', 50000, 'https://www.amway.com/medias/116744D-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w5NDAxMHxpbWFnZS9qcGVnfGltYWdlcy9oN2EvaGE0Lzg4MzgxNDE0NDQxMjYuanBnfDAyNzFiYzc4NmI2MWI0M2RkYWMyOTYxMjY5MzkzZjAzZTkyYjY0OTdlZDI5ODM0MTZhYTZjOWNjM2YyZjY1NjU', 12, '2', '9', 5, 'amway', 100, 270, 0),
('Artistry Exact Fit Beauty Balm Perfecting Primer', 'ONE SHADE FITS ALL Our skin-transforming Elasto-Network primes and instantly improves the look of skins texture. Use under your foundation for easier makeup application and blending or alone for ultra-sheer coverage with SPF.', 70000, 'https://www.amway.com/medias/118209-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzODczOHxpbWFnZS9qcGVnfGltYWdlcy9oMTgvaGNjLzg4MzgxNzc1ODcyMzAuanBnfDdiZTA0MDcwNWRkMmI5YmE4YWI0MjQ3ZTkyZWE4MzgwN2M3MTk0ZWI5OGI2NGZkODQzZWMyNWU5NjhlM2E1YWY', 30, '2', '9', 4.5, 'amway', 100, 271, 0),
('Artistry Exact Fit Compact', 'TOUCH-UP IN STYLE Refillable compact with mirror fits Powder Foundation and Pressed Powder.', 30000, 'https://www.amway.com/medias/116745D-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w1Njc2OXxpbWFnZS9qcGVnfGltYWdlcy9oNWYvaGUwLzg4MzgxNjkwNjc1NTAuanBnfDczYTg4YzhlYWJmZDg3YTc1ZTlmMzM1NjZkM2RmYzdkZjM3MmJjOTc5YWEzZjljMzUwNTdjN2I2YjE2Zjk3Nzc', 0, '2', '9', 4, 'amway', 100, 272, 0),
('Artistry Exact Fit Longwearing Foundation Bisque', 'COVERAGE THAT STAYS PUT This lightweight, transfer-resistant formula features Color Lock technology to hold pigments in place for up to 24 hours. Made with Tahitian pearls and optical prisms to softly reflect light and help minimize appearance of imperfection.', 75000, 'https://www.amway.com/medias/117688-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wyODU2OXxpbWFnZS9qcGVnfGltYWdlcy9oYzcvaDlkLzg4MzgxNzk0MjIyMzguanBnfDE2MGQ1NjFiMzg4ODRhZDYxODE3Yjc0NWQ5ZTZmYjA3NWMxNWZhOTAzY2EwN2I0YmJkZmJhZGU2YTJkMWIwZDA', 30, '2', '9', 4.5, 'amway', 100, 273, 0),
('Artistry Exact Fit Longwearing Foundation Brulee ', 'COVERAGE THAT STAYS PUT This lightweight, transfer-resistant formula features Color Lock technology to hold pigments in place for up to 24 hours. Made with Tahitian pearls and optical prisms to softly reflect light and help minimize appearance of imperfection.', 75000, 'https://www.amway.com/medias/117700-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzNjgzM3xpbWFnZS9qcGVnfGltYWdlcy9oNjgvaGUzLzg4MzgxOTgxMzI3NjYuanBnfGE0NzllOTRmNDk2MTBiMzE5MzVhMzI5NmEyZjgyODQ5NTg0ZWU4MjgyNzY1MDU0YmI0ZGZiYTBiYmU1OTE3Njc', 30, '2', '9', 4.5, 'amway', 100, 274, 0),
('Artistry Exact Fit Longwearing Foundation Chablis ', 'COVERAGE THAT STAYS PUT This lightweight, transfer-resistant formula features Color Lock technology to hold pigments in place for up to 24 hours. Made with Tahitian pearls and optical prisms to softly reflect light and help minimize appearance of imperfection.', 75000, 'https://www.amway.com/medias/117687-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wyNzg5MnxpbWFnZS9qcGVnfGltYWdlcy9oOGMvaDE3Lzg4MzgxODYxNzI0NDYuanBnfDM4OTQ5MGQ0Y2Q4OWU4YjQwNjJmYjI5MWUwNDVkNWNmMzQ4NDEyYjdjZDc1ZTk5YjA2N2NlNDljODkzMWI1ZWE', 30, '2', '9', 4.5, 'amway', 100, 275, 0),
('Artistry Exact Fit Longwearing Foundation Chiffon', 'COVERAGE THAT STAYS PUT This lightweight, transfer-resistant formula features Color Lock technology to hold pigments in place for up to 24 hours. Made with Tahitian pearls and optical prisms to softly reflect light and help minimize appearance of imperfection.', 75000, 'https://www.amway.com/medias/117691-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzNjc0M3xpbWFnZS9qcGVnfGltYWdlcy9oNDQvaDQ4Lzg4MzgxODYwMDg2MDYuanBnfGU5NjA5NGY4OTQxMjZmMmRjZjJlY2ZkMWI2YWU2M2M5YWY2M2JjYjJhMDY3NWUxY2RjZmE4ZTAzNWUxMzMwZjk', 30, '2', '9', 4.5, 'amway', 100, 276, 0),
('Artistry Exact Fit Longwearing Foundation Golden ', 'COVERAGE THAT STAYS PUT This lightweight, transfer-resistant formula features Color Lock technology to hold pigments in place for up to 24 hours. Made with Tahitian pearls and optical prisms to softly reflect light and help minimize appearance of imperfection.', 75000, 'https://www.amway.com/medias/117699-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzNzI2M3xpbWFnZS9qcGVnfGltYWdlcy9oYjgvaDY0Lzg4MzgxODY5NTg4NzguanBnfDdjMDgwYmQ0ZjY5ODFiYjY4MmIxZjk4MTdjOTRmZjU5YmM2ZTdlZGE3OGQzMWIwNWQ4NmUyMTMzYTFjYjRkOTA', 30, '2', '9', 4.5, 'amway', 100, 277, 0),
('Artistry Exact Fit Perfecting Concealer  Bright', 'LONG-LASTING, 8-HOUR HOLD This creamy, weightless formula mimics the look of your own skin to camouflage imperfections, fine lines and wrinkles. Brightens dark circles for a finish as flawless as you.', 55000, 'https://www.amway.com/medias/120365D-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wyOTQyNXxpbWFnZS9qcGVnfGltYWdlcy9oODUvaGE0Lzg4MzgyNDIyNzEyNjIuanBnfDgyMzg3NWFmODFkMmM1M2NjZTAwNDdjMzlkNWU0MmM4NWUxNjkwMzg4YjljZjlhMjk5YjdjNGVlOWQxZjNiOTc', 7.2, '2', '9', 4.5, 'amway', 100, 278, 0),
('Artistry Exact Fit Perfecting Concealer Deep/Very ', 'LONG-LASTING, 8-HOUR HOLD This creamy, weightless formula mimics the look of your own skin to camouflage imperfections, fine lines and wrinkles. Brightens dark circles for a finish as flawless as you.', 55000, 'https://www.amway.com/medias/120364D-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzMDYyNHxpbWFnZS9qcGVnfGltYWdlcy9oMzYvaDkzLzg4MzgyMzE2ODcxOTguanBnfDQwMzIxOGZmOGZiZDc5M2JmNzQxZWYzYjVhMTRjMzcyZGU4ZmQ1NTEyMDA0ZTc1ZGZhZWU4OGZiYTZkNjhjNGM', 7.2, '2', '9', 4, 'amway', 100, 279, 0),
('Artistry Exact Fit Perfecting Concealer Light', 'LONG-LASTING, 8-HOUR HOLD This creamy, weightless formula mimics the look of your own skin to camouflage imperfections, fine lines and wrinkles. Brightens dark circles for a finish as flawless as you.', 55000, 'https://www.amway.com/medias/120360D-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wyOTMyMnxpbWFnZS9qcGVnfGltYWdlcy9oMWEvaDYzLzg4MzgyMzYyNzQ3MTguanBnfDY4MDc1YzJlODYwZjk5MDdmYzg3MDU0NDcyOWI2MDljODEwOTFhZjNkYzIyM2YyMTQzNDdhZDQzYzM4MWE0YmE', 7.2, '2', '9', 4, 'amway', 100, 280, 0),
('Artistry Exact Fit Perfecting Loose Powder', 'FINISH BEAUTIFULLY This luxe powder combines Tahitian pearls and optical prisms for luminous skin. It helps minimize visible imperfections without settling into fine lines or wrinkles and extends your foundation wear.', 72000, 'https://www.amway.com/medias/116696D-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w0MjgxNnxpbWFnZS9qcGVnfGltYWdlcy9oZTkvaDlhLzg4MzgxNTYwNTg2NTQuanBnfGM1YTJlYTcyZTZlNDFiOWY4NTdiZDk4YzFkOTZhOGRmMzYwN2RkZGQxZDhjZDQ5ODYyNDMyMWQ0ODI3N2JmOGQ', 25, '2', '9', 4, 'amway', 100, 281, 0),
('Artistry Exact Fit Perfecting Loose Powder Light', 'FINISH BEAUTIFULLY This luxe powder combines Tahitian pearls and optical prisms for luminous skin. It helps minimize visible imperfections without settling into fine lines or wrinkles and extends your foundation wear.', 72000, 'https://www.amway.com/medias/116694D-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w0MDU4NXxpbWFnZS9qcGVnfGltYWdlcy9oOGYvaDE2Lzg4MzgxNDg5MTUyMzAuanBnfDA0YTM5N2Q0NGRkZGMzYTZkMTZmMTQzYjMyMjdjYzk1NTJmNmNlYjQzYjBmYTNhMTFlM2M1ZDQ0MzI5MTNkMTg', 25, '2', '9', 4, 'amway', 100, 282, 0),
('Artistry Exact Fit Perfecting Loose Powder Me', 'FINISH BEAUTIFULLY This luxe powder combines Tahitian pearls and optical prisms for luminous skin. It helps minimize visible imperfections without settling into fine lines or wrinkles and extends your foundation wear.', 72000, 'https://www.amway.com/medias/116695D-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w0MTkyMnxpbWFnZS9qcGVnfGltYWdlcy9oNjUvaDBjLzg4MzgxNTU3MzA5NzQuanBnfDA3M2Q3YzY3YTJiYjQzYWUxY2E2N2M4MzdjZjMzNDlhYjczZThmMzkwMjM5ZDNhYjdjMjgxYWNhMjYwOGQ0YTA', 25, '2', '9', 5, 'amway', 100, 283, 0),
('Artistry Exact Fit Powder Applicator', 'Flawless application\n\nDual-sided sponge offers two application options for light-to-heavy coverage, buffing, and polishing. For use with Artistry Exact Fit Powder Foundation and Pressed Powder.', 5000, 'https://www.amway.com/medias/116104-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w2Mjg3OXxpbWFnZS9qcGVnfGltYWdlcy9oYzEvaDZkLzg4MzgxNjI3NzYwOTQuanBnfGNlNWRkMmQ3OGVjMzA5MTkzMTAyMzBmNmE4MzBmZGJiYjI5NDQ3ODk0YmRjOWQ5Mzk5NDhmZjVkYWVhMjZlN2I', 0, '2', '9', 1, 'amway', 100, 284, 0),
('Artistry Exact Fit Powder Foundation  Bisque', 'INSTANTLY PERFECTING Get skin-perfecting coverage that blends easy and looks natural. Made with a combination of Tahitian pearls, optical prisms and rare Amazonian minerals to help control shine for a beautiful matte finish that lasts.', 48000, 'https://www.amway.com/medias/116725-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w1NzQwOHxpbWFnZS9qcGVnfGltYWdlcy9oODEvaDg1Lzg4MzgxNTU2MzI2NzAuanBnfGU2YmFjN2Y1OGU5NmIzY2M5ODZhNjcxYjY2ZTBiZDg2MzY4MWFmODk1YTFkYjM5NjdiMDc4ZTY1Y2I2N2JlZmM', 12, '2', '9', 5, 'amway', 100, 285, 0),
('Artistry Exact Fit Powder Foundation Chablis ', 'INSTANTLY PERFECTING Get skin-perfecting coverage that blends easy and looks natural. Made with a combination of Tahitian pearls, optical prisms and rare Amazonian minerals to help control shine for a beautiful matte finish that lasts.', 48000, 'https://www.amway.com/medias/116724-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w1ODMxNnxpbWFnZS9qcGVnfGltYWdlcy9oZmEvaDA4Lzg4MzgxNjU3MjUyMTQuanBnfDcyY2JiZDAxYmRhNzVjMWVlODk5YjYwMDE4MWYzMzFjYzlhZGM4N2VkODA2N2YwM2ExNjA1NGIzMTRlNjFiMzU', 12, '2', '9', 5, 'amway', 100, 286, 0),
('Artistry Hydra V Sheer Weightless Foundation SPF 15  Soleil ', 'PHOTO-READY SKIN  Easy coverage that protects from UV rays, hides imperfections and evens skin tone. Made with Norwegian fjord water and Hawaiian acai berries to give your skin a fresh, dewy glow and shine enhancers to help create a luminous finishing touch.', 72000, 'https://www.amway.com/medias/121141-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzMzI2NHxpbWFnZS9qcGVnfGltYWdlcy9oZDkvaGViLzg4NDA5ODY5NTE3MTAuanBnfGU5MTFkZjljNzE5MjJlM2MzMDhmNjM4NmEyNjI3ZWQ2NGM0MzY4ZWU4MGRhZDM1NjRhNzhiOTcxY2U0NDBhOWQ', 30, '2', '9', 5, 'amway', 100, 287, 0),
('Artistry Ideal Radiance Illuminating CC Cream Light', 'COLOR-CORRECT AND PROTECT Made with custom Pearl Protein Extract to give you bright, natural-looking coverage. Our Multi-Dimensional Finishing Complex perfects the look of skin and SPF 50 shields your face from harmful UV rays.', 64000, 'https://www.amway.com/medias/118208-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w0MDc4MnxpbWFnZS9qcGVnfGltYWdlcy9oYzIvaDU2Lzg4MzgyMDAzNjA5OTAuanBnfDc4NTJlYjUwYzc5ZmQzMGQ5MGMyZmFjYTkwYmYyNDZlMjE1Y2NjNDBkYTQ3Y2UwZmFhY2U4MzE1NzA1YjE5ZTI', 30, '2', '9', 5, 'amway', 100, 288, 0),
('Artistry Signature Color Lipstick Primrose ', 'DRENCH YOUR LIPS IN FULL-ON COLOR Soften, moisturize and rejuvenate the appearance of lips with bright, bold color. Infused with a mix of natural oils that helps lock in 36% more moisture. ', 50000, 'https://www.amway.com/medias/115389D-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w0MDY1MHxpbWFnZS9qcGVnfGltYWdlcy9oMjEvaDFhLzg4MzgxNjg0MTIxOTAuanBnfDcxNTYxZjhhOGJlNTA2ZmI2MmQ3MzFmYTQ2MTM3NWQyNzk0MmZjZTQzNTljZGU4MWQyMTNjNmEyMjFmYmUxYzQ', 3.8, '2', '10', 5, 'amway', 100, 289, 0),
('Artistry Signature Color Light Up Lip Gloss - Juicy Peach', 'LIGHT UP YOUR LIPS, ANYTIME, ANYWHERE Our soft, creamy formula with jojoba and avocado oils moisturizes and conditions to keep your lips looking luscious for hours.', 36000, 'https://www.amway.com/medias/118567U-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w0MDg5N3xpbWFnZS9qcGVnfGltYWdlcy9oZDcvaDRmLzg5MzAwMzA0ODU1MzQuanBnfDU4MGNlMWJiMzY3NmVlNjNiOTZiOGU0YzAxNTA5OTY3NTJhNjA1NWNmYTAxZDFhMThlZmE1ZTIyM2FiMTI3NmE', 6, '2', '10', 5, 'amway', 100, 290, 0);
INSERT INTO `items` (`Title`, `Description`, `Price`, `Image`, `Weight`, `Category`, `Sub_Category`, `Rating`, `Brand`, `Stock`, `ID`, `total_buy`) VALUES
('Artistry Signature Color Light Up Lip Gloss - Misty Mauve', 'LIGHT UP YOUR LIPS, ANYTIME, ANYWHERE Our soft, creamy formula with jojoba and avocado oils moisturizes and conditions to keep your lips looking luscious for hours.', 36000, 'https://www.amway.com/medias/118572U-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzOTE0MHxpbWFnZS9qcGVnfGltYWdlcy9oOWQvaDU2Lzg5MzAwMzQwOTAwMTQuanBnfDVmZDM5Mzg1YTlmOTUxMTlhODA4NjlmODhkYTdmZWYwOTYyYjlmNzE1MTQ0ZjlkNWEyZGZkZTQyY2M1Yzc1NWY', 6, '2', '10', 5, 'amway', 100, 291, 0),
('Artistry Signature Color Light Up Lip Gloss - Pink Nude', 'LIGHT UP YOUR LIPS, ANYTIME, ANYWHERE Our soft, creamy formula with jojoba and avocado oils moisturizes and conditions to keep your lips looking luscious for hours.', 36000, 'https://www.amway.com/medias/118566-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzOTkwNHxpbWFnZS9qcGVnfGltYWdlcy9oOGEvaDIwLzkyODA4ODk5NDYxNDIuanBnfGRmNDgxZWRiYzU4ZWE3NzlhMWVmMGQ3ZDAyZDFiYzk3MTFhYjk1ODAwMzMzNzRkNWQ3NjE1MGYxNmI4YzQ4Yzg', 6, '2', '10', 5, 'amway', 100, 292, 0),
('Artistry Signature Color Light Up Lip Gloss - Real Red', 'LIGHT UP YOUR LIPS, ANYTIME, ANYWHERE Our soft, creamy formula with jojoba and avocado oils moisturizes and conditions to keep your lips looking luscious for hours.', 36000, 'https://www.amway.com/medias/118569U-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzOTI0NHxpbWFnZS9qcGVnfGltYWdlcy9oNTUvaDc3Lzg5MzAwMzY1MTQ4NDYuanBnfDJhNTU0NmNjOTFmNTQ3NGZlNzE2NTVmZThiZTc2MDAxNzk3MjM5ZmMzZTZjYjNjM2QyNTVlNmJhNzYwOTU4M2M', 6, '2', '10', 5, 'amway', 98, 293, 2),
('Artistry Signature Color Lipstick Ballet Pink ', 'DRENCH YOUR LIPS IN FULL-ON COLOR Soften, moisturize and rejuvenate the appearance of lips with bright, bold color. Infused with a mix of natural oils that helps lock in 36% more moisture. Choose from 15 stunning shades that wont feather or bleed.', 55000, 'https://www.amway.com/medias/115384D-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w0MDc1NXxpbWFnZS9qcGVnfGltYWdlcy9oMzQvaDY0Lzg4MzgxNjk2MjQ2MDYuanBnfGQzYmIyMTIwMDliNjU3OTExMTVkNjdiM2RiZGQyODgzZDIxYTc2YTFiZmNiYzZkM2FmMjYzMDljODRlNDdkNzU', 3.8, '2', '10', 5, 'amway', 100, 294, 0),
('Artistry Signature Color Lipstick Daring Red ', 'DRENCH YOUR LIPS IN FULL-ON COLOR Soften, moisturize and rejuvenate the appearance of lips with bright, bold color. Infused with a mix of natural oils that helps lock in 36% more moisture. Choose from 15 stunning shades that wont feather or bleed.', 55000, 'https://www.amway.com/medias/115383D-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w0MTExMHxpbWFnZS9qcGVnfGltYWdlcy9oODQvaDAzLzg4MzgxNTEyNzQ1MjYuanBnfGZjNTU0NDExM2RlYzRjMjA3ZGQ5NzBjMjk0NGQ0MGM4ZWZlZDhkN2Y1MGU4OGM4OThkNmM3MGJhNTFkNWFkODY', 3.8, '2', '10', 5, 'amway', 100, 295, 0),
('Artistry Studio Light Up Silky Matte Lip Color Cherry', 'PAINT THE TOWN RED Play up your pout with high-coverage color that lasts all day. Silky, liquid formula goes on matte for a modern look.', 35000, 'https://www.amway.com/medias/124359U-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzOTMxNnxpbWFnZS9qcGVnfGltYWdlcy9oZGIvaDM1Lzg5MjA4MTIxOTE3NzQuanBnfGVjYTA4OGJmYTMwMzdmODU2ODZmZTljYjg0N2ZmYjZjYzI3MjRhN2UwZmRiNmY5NDlhNTBiY2I3YjdjZTI3YmQ', 4.4, '2', '10', 5, 'amway', 100, 296, 0),
('G&H Protect+Concentrated Hand Soap', '450 WASHES IN ONE 250 mL BOTTLE Exclusive technology helps neutralize strong odors and goes beyond cleansing to hydrate your hand.', 20000, 'https://www.amway.com/medias/118117-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w1MDY0MXxpbWFnZS9qcGVnfGltYWdlcy9oNGYvaGMwLzg4MzgxOTMxODQ3OTguanBnfDQ4MWQ4MDFiYWY2Y2YxNjM0NTNiMDVhNmI0ZDZkYmI1NWY5MmVhZGRiOGI4NThlY2UzOTk4MzNmMGUxMGE5NTE', 250, '3', '15', 5, 'amway', 100, 297, 0),
('Artistry Signature Select Hydrating Body Green', 'Self-adjusting hydration? Yes, please.\n\nDeeply Hydrate. Protect. Strengthen.\n\nQuench dry, thirsty skin with deep hydration for up to 48 hours! This amazing hydro-gel formula self-adjusts to fit your custom needs and deliver moisture when and where skin needs it most. Formulated with Nutrilite-sourced green tea and peach flower extracts that help deliver antioxidant protection from free radicals, pollutants and impurities to help keep your skin looking and feeling nourished and healthy.', 46000, 'https://www.amway.com/medias/123858V-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w0OTY3MHxpbWFnZS9qcGVnfGltYWdlcy9oZmQvaGY4Lzg5MjA4MzkzMjM2NzguanBnfGZkNmUxMTllYjliYTI5MzA3ZDdkNjUzZWNlMDk2NzU0ZTg5NTlhZmIwMzA5MGJmMGZiYWY0NjQyNDgyZjUyODg', 200, '3', '12', 5, 'amway', 100, 298, 0),
('Satinique 2 in 1 Shampoo and Conditioner 28', 'TWO STEPS IN ONE Cleanse and condition with a blend of borage seed oil and vitamin E to help moisturize, smooth and protect hair.', 20000, 'https://www.amway.com/medias/115304-en-US-690px-01?context=bWFzdGVyfGltYWdlc3w0MDcwNHxpbWFnZS9qcGVnfGltYWdlcy9oZDgvaDljLzg4MzgxNDMyMTM1OTguanBnfDQ3NzU0ZmI3MzMyZDgyYTFhOWU0OGY4MzRmMzAxNGRmMDRkZWNiZGMzMWYwZDhjNDA2YzU2ZWIwZGZiNzFjMTA', 280, '3', '13', 5, 'amway', 100, 299, 0),
('Satinique Anti Dandruff Shampoo  ', 'DITCH ITCH AND FLAKES Soothe dry scalp and diminish dandruff while your hair regains its natural, healthy-looking beauty.', 20000, 'https://www.amway.com/medias/110670-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzNDQ5MHxpbWFnZS9qcGVnfGltYWdlcy9oZjUvaGEzLzg5ODkyNzI2NzAyMzguanBnfGIyYTBlYWNkZDAwYWZlOGE4YjBkN2YxNzFmYzk0NmFiMmU3ZGZkMWI3Nzg4OWJlMDRkODQzYTQ4NmE3MzJhZmQ', 280, '3', '13', 5, 'amway', 100, 300, 0),
('Satinique Extra Volume Shampoo 75', 'LIFT AND ENLIVEN* Infused with a blend of macadamia nut oil and soy protein to help amplify your hairs strength and dimension while enhancing its softness and shine.', 50000, 'https://www.amway.com/medias/114944-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzNzU2N3xpbWFnZS9qcGVnfGltYWdlcy9oMjEvaGUwLzg4MzgxNDI2ODkzMTAuanBnfDY4Yzc3ZGMzYjUyODA0MGNlYmZlNzMyNzEwZGFhZDI0ZjljYjFmNTU5MWZiOTk5ODYxMGQ2Y2UxYjQ4Zjg0ODU', 750, '3', '13', 4.5, 'amway', 100, 301, 0),
('Satinique Overnight Repair Treatme', 'MEND SPLIT ENDS Help repair damaged hair and increase its resistance to breakage with this leave-in treatment.', 40000, 'https://www.amway.com/medias/110677-en-US-690px-01?context=bWFzdGVyfGltYWdlc3wzMjU5M3xpbWFnZS9qcGVnfGltYWdlcy9oMDAvaGQ1Lzg4MzgxMzY2NTk5OTguanBnfDkxMmJmYmVlMzQzMTEwZWY5Y2NiOGQ1NTg0MTEyM2QxOTM5MTY3OGI3YThiNjU5Nzg5YjZiMjIxMDEzMWFiNmQ', 100, '3', '13', 4, 'amway', 100, 302, 0),
('CBD Replenishing Moisture Cream', 'Rich but fast-absorbing, our CBD Replenishing Moisture Cream helps to restore your skins moisture levels. A day cream with an indulgent texture and velvety feel, its enriched with a blend of naturally derived CBD, hemp seed oil and squalane. It instantly soothes dry areas of the skin and leaves it with a lasting soft feel. Skin looks more luminous and is left feeling less stressed.', 80000, 'https://media.thebodyshop.com/i/thebodyshop/CBD_REPLENISHING_MOISTURE_CREAM_50ML_1_INCHRPS314.jpg?$product-zoom$', 30, '1', '2', 5, 'bodyshop', 100, 303, 0),
('Vitamin C Glow Boosting Moisturizer', 'Our Vitamin C Glow Boosting Moisturiser gives you a helping hit of skin-revitalising and joy-giving radiance.\n\nFor skin that needs a little va-va-voom, it helps your face to feel more refreshed and energised. Who doesnt need that from time to time? And if youre faced with dull or tired skin then this luxurious vitamin C cream will never leave your side.', 50000, 'https://media.thebodyshop.com/i/thebodyshop/VITAMIN_C_GLOW_BOOSTING_MOISTURISER_50ML_1_INRSDPS118.jpg?$product-zoom$', 30, '1', '2', 5, 'bodyshop', 100, 304, 0),
('Aloe Soothing Night Cream', 'Our gentle Aloe Soothing Night Cream is sensitive skins BFF, especially when its having a bit of a hard time. It might be feeling a little stressed-out, dry or rough. And if thats the case, then its time to get back to basics. The Body Shops Aloe Night Cream is just the place to start. Enriched with Community Fair Trade Aloe, our kind-to-skin formula helps to soothe and hydrate overnight.', 50000, 'https://media.thebodyshop.com/i/thebodyshop/ALOE_SOOTHING_NIGHT_CREAM_50ML_1_INRSDPS097.jpg?$product-zoom$', 30, '1', '2', 5, 'bodyshop', 100, 305, 0),
('Tea Tree All-In-One Stick', 'Refresh congested complexions in one swipe and live fearlessly all day with our Tea Tree All-In-One Stick.\n\nThis convenient, multi-tasking tool leaves skin looking clarified, mattified and feeling purified and hydrated. Our solid balm glides on and melts effortlessly into a weightless, cooling formula that absorbs in an instant to help comfort and refresh skin. This vegan, multi-functional stick can be used as part of your Tea Tree daily routine, as a base for makeup or as a top-up to keep your skin in check. It\'s perfect for travel, festivals, weekends away or as a convenient gym bag essential.', 60000, 'https://media.thebodyshop.com/i/thebodyshop/TEA_TREE_ALL_IN_ONE_STICK_25g_1_INECOPS357.jpg?$product-zoom$&layer1=[src=/i/thebodyshop/EN_new_roundel_final&top=50&left=50]', 25, '1', '3', 4, 'bodyshop', 100, 306, 0),
('Tea Tree Purifying Soap', 'Cleanse away dirt and impurities with our Tea Tree Soap.\n\nLather up with our purifying vegetable-based bar cleanser. Made with purifying tea tree oil, it leaves skin feeling soft, refreshed and thoroughly cleansed.', 25000, 'https://media.thebodyshop.com/i/thebodyshop/TEA_TREE_PURIFYING_SOAP_100G_1_INCHRPS320.jpg?$product-zoom$', 100, '1', '3', 5, 'bodyshop', 100, 307, 0),
('Tea Tree Anti-imperfection Daily Solution', 'Meet blemished skins guardian angel: our Tea Tree Anti-Imperfection Daily Solution. It\'s here to help back you in the battle with blemished skin. ', 60000, 'https://media.thebodyshop.com/i/thebodyshop/TEA_TREE_ANTI-IMPERFECTION_DAILY_SOLUTION_50ML_1_INRSDPS177_2.jpg?$product-zoom$', 200, '1', '3', 5, 'bodyshop', 100, 308, 0),
('Tea Tree Skin Clearing Clay Mask', 'Blemishes. They\'re pesky little things, aren\'t they? Popping up out of nowhere like unwanted party guests. Well, the party ends here with our Tea Tree Skin Clearing Clay Mask. It helps your blemished skin feel purified, refreshed and ready to get back out there!', 54000, 'https://media.thebodyshop.com/i/thebodyshop/TEA_TREE_SKIN_CLEARING_CLAY_MASK_100ML_1_INRSDPS193.jpg?$product-zoom$', 110, '1', '3', 5, 'bodyshop', 100, 309, 0),
('Love & Plums Shower Gel', 'Make every shower feel extra festive with our Love & Plums Christmas Shower Gel.\n\nA special edition fragrance, our body-loving Christmas cleanser is enriched with plum extract from Turkey and notes of plum sorbet, peony and comforting musk. This rich, bright, fruity-floral scent is guaranteed to give you the festive feels.', 30000, 'https://media.thebodyshop.com/i/thebodyshop/LOVE_&_PLUMS_SHOWER_GEL_250ml_1_INABCPS020.jpg?$product-zoom$&layer1=[src=/i/thebodyshop/EN_new_roundel_final&top=50&left=50]', 250, '3', '12', 5, 'bodyshop', 100, 310, 0),
('Joy & Jasmine Sugar Body Scrub', 'Scrub up a treat this Christmas with our Joy & Jasmine Sugar Body Scrub.\n\nA special edition fragrance, this joyful, body-buffing treat is enriched with jasmine extract from India and notes of orange flower, rose and sensual jasmine. This fresh, light and floral scent is guaranteed to give you the festive feels.', 60000, 'https://media.thebodyshop.com/i/thebodyshop/JOY_&_JASMINE_SUGAR_BODY_SCRUB_250ml_1_INABCPS038.jpg?$product-zoom$&layer1=[src=/i/thebodyshop/EN_new_roundel_final&top=50&left=50]', 250, '3', '12', 5, 'bodyshop', 100, 311, 0),
('Vanilla Pumpkin Whipped Body Butter', 'Give skin some nourishing moisture with our special edition whipped Vanilla Pumpkin Body Butter.\n\n\nSlather on a dollop of our whipped up Body Butter. Lighter and fluffier than our classic Body Butter, it sinks straight in and leaves skin feeling softer, smoother and nourished with 72hr moisture. Rich but non-greasy, it gives skin a healthy-looking glow.', 50000, 'https://media.thebodyshop.com/i/thebodyshop/VANILLA_PUMPKIN_WHIPPED_BODY_BUTTER_200ml_1_INAAUPS130.jpg?$product-zoom$&layer1=[src=/i/thebodyshop/EN_new_roundel_final&top=50&left=50]', 200, '3', '12', 4.5, 'bodyshop', 100, 312, 0),
('Coconut Body Butter', 'Love and nourish very dry skin like never before with our best ever Coconut Body Butter.\n\nNow made with 96% ingredients of natural origin, including Community Fair Trade organic virgin coconut oil from Samoa, handcrafted Community Fair Trade shea butter from Ghana and Community Fair Trade organic babassu oil from Brazil, our body moisturiser leaves seriously dry skin feeling softer, smoother and intensely nourished with 96hr moisture. It even gives you a natural-looking glow.', 50000, 'https://media.thebodyshop.com/i/thebodyshop/COCONUT_BODY_BUTTER_200ml_1_INECMPS084.jpg?$product-zoom$&layer1=[src=/i/thebodyshop/EN_new_roundel_final&top=50&left=50]', 200, '3', '12', 4.5, 'bodyshop', 100, 313, 0),
('Avocado Body Butter', 'Love and nourish dry skin like never before with our Avocado Body Butter.\n\nMade with 96% ingredients of natural origin, including sustainably sourced Hass avocado oil from South Africa, handcrafted Community Fair Trade shea butter from Ghana and Community Fair Trade Brazil nut oil from Peru, our body moisturiser leaves dry skin feeling softer, smoother and nourished with 96hr moisture. It even gives you a natural-looking glow.', 50000, 'https://media.thebodyshop.com/i/thebodyshop/AVOCADO_BODY_BUTTER_200ml_1_INECMPS032.jpg?$product-zoom$&layer1=[src=/i/thebodyshop/EN_new_roundel_final&top=50&left=50]', 200, '3', '12', 4.5, 'bodyshop', 100, 314, 0),
('Almond Milk Body Butter', 'Love, soothe and nourish dry, sensitive skin like never before with our best ever Almond Milk Body Butter.\n\nNow made with 95% ingredients of natural origin, including Community Fair Trade almond milk and oil from Spain, handcrafted Community Fair Trade shea butter from Ghana and Community Fair Trade sesame seed oil from Nicaragua, our soothing body moisturiser leaves dry, sensitive skin feeling softer, smoother and nourished with 96hr moisture. It even gives you a natural-looking glow.', 50000, 'https://media.thebodyshop.com/i/thebodyshop/ALMOND_MILK_BODY_BUTTER_200ml_1_INECMPS059.jpg?$product-zoom$&layer1=[src=/i/thebodyshop/EN_new_roundel_final&top=50&left=50]', 200, '3', '12', 4.5, 'bodyshop', 100, 315, 0),
('Argan Body Butter', 'Love and nourish very dry skin like never before with our best ever Argan Body Butter.\n\nNow made with 95% ingredients of natural origin, including argan oil, handcrafted Community Fair Trade shea butter from Ghana and Community Fair Trade organic babassu oil from Brazil, our body moisturiser leaves seriously dry skin feeling softer, smoother and intensely nourished with 96hr moisture. It even gives you a natural-looking glow.', 50000, 'https://media.thebodyshop.com/i/thebodyshop/ARGAN_BODY_BUTTER_200ml_1_INECMPS100.jpg?$product-zoom$&layer1=[src=/i/thebodyshop/EN_new_roundel_final&top=50&left=50]', 200, '3', '12', 4.5, 'bodyshop', 100, 316, 0),
('Drops of Youth Eye Concentrate', 'Refresh and awaken your eye area with our innovative eye concentrate. Enriched with edelweiss plant stem cells, our unique applicator instantly refreshes the eye contour and smoothes the appearance of lines, bags and fatigue for younger-looking eyes.', 70000, 'https://media.thebodyshop.com/i/thebodyshop/DROPS_OF_YOUTH_YOUTH_EYE_CONCENTRATE_10ML_1_INRSDPS661.jpg?$product-zoom$', 15, '1', '4', 4.5, 'bodyshop', 100, 317, 0),
('Vitamin E Eye Cream', 'This refreshing, hydrating tube of nourishment leaves your peepers feeling perfectly pampered.\n\nWhen you think about it, the eyes have a pretty tough job. Constantly blinking, helping us snooze and even helping us express emotions - a smile wouldn\'t be a smile without them! And since the skin around our eyes is uber-delicate, theres even more reason to give them some extra special moisturising care. Enter the Body Shops Vitamin E Eye Cream.', 50000, 'https://media.thebodyshop.com/i/thebodyshop/VITAMIN_E_EYE_CREAM_15ML_1_INRSDPS299.jpg?$product-zoom$', 15, '1', '4', 4.5, 'bodyshop', 100, 318, 0),
('Chamomile Waterproof Eye and Lip Makeup Remover', 'Our Camomile Waterproof Eye & Lip Make-Up Remover helps you wave goodbye to those loaded up lashes, disco ball eyelids and bright red lips, leaving your skin feeling cleansed and happy.', 45000, 'https://media.thebodyshop.com/i/thebodyshop/CAMOMILE_WATERPROOF_EYE_&_LIP_MAKE-UP_REMOVER_160ML_1_INRSDPS413.jpg?$product-zoom$', 160, '1', '4', 5, 'bodyshop', 100, 319, 0),
('Oils of Life Eye Cream Gel', 'The ultra-light and smoothing eye cream-gel feels fresh upon application and melts onto skin. Infused with three precious seed oils, eye contours are visibly revitalized and look more radiant. Signs of ageing appear reduced, wrinkles appear smoothed, dark circles look visibly faded and bags appear depuffed.', 79000, 'https://media.thebodyshop.com/i/thebodyshop/OILS_OF_LIFE_INTENSELY_REVITALISING_EYE_CREAM-GEL_20ML_1_INRSDPS746.jpg?$product-zoom$', 100, '1', '4', 5, 'bodyshop', 100, 320, 0),
('Facial Mask Brush', 'Our Facial Mask Brush features long tapered bristles to ensure an even application over the whole face, and the slanted tip allows application in all the corners and niches of the face.', 32000, 'https://media.thebodyshop.com/i/thebodyshop/FACIAL_MASK_BRUSH_1_INRSAPS153.jpg?$product-zoom$', 0, '2', '8', 5, 'bodyshop', 100, 321, 0),
('Lash Sport Waterproof Mascara', 'Finally, waterproof mascara that really does see you through the day. Lash Sport is high-performing mascara that volumises, lengthens and lasts. Formulated with marula oil, it\'s splashproof and sweatproof while also being easy to remove with a waterproof make-up remover. Expect no flaking, no smudging and no fading and benefit from defined lashes that last all day long.', 30000, 'https://media.thebodyshop.com/i/thebodyshop/LASH_SPORT_WATERPROOF_MASCARA_9.5ML_2_INRSAPS174.jpg?$product-zoom$', 0, '2', '9', 5, 'bodyshop', 100, 322, 0),
('Satinique Shine Spray', 'SHINE IN AN INSTANT – Tame flyaways and control frizz with this lightweight, argan oil-infused spray.', 40000, 'https://www.amway.ca/medias/110685-en-CA-690px-01?context=bWFzdGVyfGltYWdlc3wzMDI5MHxpbWFnZS9qcGVnfGltYWdlcy9oZmQvaDU1Lzg4NDAzNjQzNTk3MTAuanBnfDU2ZjI5YTJlNDAxNGFkNjVhMjBlMzUxYTNhZTMwMzQ0YzQ4OWU0NzIzZDBhNWVmMjgwZjliMmFkYzUxOTY5Njc', 100, '3', '13', 5, 'amway', 100, 325, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `id_shipping` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `postcode` varchar(15) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`id_shipping`, `id_user`, `address`, `city`, `province`, `postcode`, `phone`) VALUES
(1, 2, 'Jl. Ngagel Jaya Tengah No.73-77', 'Surabaya', 'East Java', '60284', '0123456789'),
(2, 3, '', '', '', '', ''),
(3, 4, '', '', '', '', ''),
(4, 5, '', '', '', '', ''),
(5, 6, '', '', '', '', ''),
(6, 7, '', '', '', '', ''),
(7, 11, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `ID` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`ID`, `id_category`, `Name`) VALUES
(1, 1, 'Toner'),
(2, 1, 'Moisturizer'),
(3, 1, 'Serum & Essence'),
(4, 1, 'Eye Care'),
(5, 1, 'Mask'),
(6, 1, 'Cleanser'),
(7, 1, 'Men'),
(8, 0, 'Tools'),
(9, 2, 'Face'),
(10, 2, 'Lips'),
(11, 2, 'Nail'),
(12, 3, 'Body Care'),
(13, 3, 'Hair Care'),
(14, 3, 'Hand Care'),
(15, 3, 'Eye');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `member` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `name`, `email`, `birthdate`, `member`, `point`, `status`) VALUES
(2, 'a', '202cb962ac59075b964b07152d234b70', 'a', 'a@email.com', '2021-11-11', 2, 0, 1),
(3, '123', '202cb962ac59075b964b07152d234b70', 'bona', 'bona@gmail.com', '0000-00-00', 0, 0, 1),
(4, 'b', '202cb962ac59075b964b07152d234b70', 'b', 'budi@gmail.com', '0000-00-00', 0, 0, 1),
(8, 'c', '202cb962ac59075b964b07152d234b70', 'c', 'c@email.com', '2002-11-24', 0, 0, 1),
(9, 'd', '202cb962ac59075b964b07152d234b70', 'd', 'd@email.com', NULL, 0, 0, 1),
(10, 'livanca liv', '202cb962ac59075b964b07152d234b70', 'Elizabeth Livanca', 'livanca@gmail.com', NULL, 0, 0, 1),
(11, 'e', '202cb962ac59075b964b07152d234b70', 'e', 'e@email.com', NULL, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_review`
--

CREATE TABLE `user_review` (
  `id_review` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `review` text NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id_contactus`);

--
-- Indexes for table `d_trans`
--
ALTER TABLE `d_trans`
  ADD PRIMARY KEY (`id_dtrans`);

--
-- Indexes for table `h_trans`
--
ALTER TABLE `h_trans`
  ADD PRIMARY KEY (`id_htrans`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id_shipping`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_review`
--
ALTER TABLE `user_review`
  ADD PRIMARY KEY (`id_review`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id_contactus` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `d_trans`
--
ALTER TABLE `d_trans`
  MODIFY `id_dtrans` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=328;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id_shipping` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_review`
--
ALTER TABLE `user_review`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
