-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 01, 2017 at 05:35 PM
-- Server version: 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wtj`
--

-- --------------------------------------------------------

--
-- Table structure for table `files_directory`
--

CREATE TABLE `files_directory` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_name` varchar(500) NOT NULL,
  `file_path` varchar(500) NOT NULL,
  `upload_path` varchar(500) NOT NULL,
  `pdf_name` varchar(500) DEFAULT NULL,
  `flip_book_name` varchar(500) DEFAULT NULL,
  `map_image` varchar(500) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files_directory`
--

INSERT INTO `files_directory` (`id`, `user_id`, `file_name`, `file_path`, `upload_path`, `pdf_name`, `flip_book_name`, `map_image`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 'WTJ- test.xlsx', '/home/kenhike/Downloads/test/', 'uploads/', NULL, NULL, NULL, 1, '2017-05-01 12:04:32', '2017-05-01 12:04:36');

-- --------------------------------------------------------

--
-- Table structure for table `pdf_common_fields`
--

CREATE TABLE `pdf_common_fields` (
  `id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `distinguished_guests` varchar(500) DEFAULT NULL,
  `agency` varchar(500) DEFAULT NULL,
  `agent` varchar(500) DEFAULT NULL,
  `duration_day` smallint(4) DEFAULT NULL,
  `duration_night` smallint(4) DEFAULT NULL,
  `no_of_persons` smallint(4) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `place` varchar(500) DEFAULT NULL,
  `country` varchar(500) DEFAULT NULL,
  `signature` varchar(500) DEFAULT NULL,
  `logo` varchar(500) DEFAULT NULL,
  `front_page_image` varchar(500) NOT NULL,
  `date_of_release` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pdf_common_fields`
--

INSERT INTO `pdf_common_fields` (`id`, `file_id`, `user_id`, `distinguished_guests`, `agency`, `agent`, `duration_day`, `duration_night`, `no_of_persons`, `start_date`, `end_date`, `place`, `country`, `signature`, `logo`, `front_page_image`, `date_of_release`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 'Families names ', 'Agency Name', 'Agent Name', 2, 1, 5, '0000-00-00', '0000-00-00', 'Japan', 'Tel-Aviv', 'Signature_image.jpg', 'logo_image.png', 'front_page_image.jpg', '2017-01-04', '2017-05-01 12:04:34', '2017-05-01 12:04:34');

-- --------------------------------------------------------

--
-- Table structure for table `pdf_content`
--

CREATE TABLE `pdf_content` (
  `id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `template_id` int(11) NOT NULL,
  `title` varchar(500) DEFAULT NULL,
  `show_summery` tinyint(1) DEFAULT NULL,
  `full_page_image` varchar(500) DEFAULT NULL,
  `image_alignment` varchar(100) DEFAULT NULL,
  `content` text,
  `empty_page_color` varchar(500) DEFAULT NULL,
  `itinerary_date_with_title` varchar(500) DEFAULT NULL,
  `content_order` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pdf_content`
--

INSERT INTO `pdf_content` (`id`, `file_id`, `user_id`, `template_id`, `title`, `show_summery`, `full_page_image`, `image_alignment`, `content`, `empty_page_color`, `itinerary_date_with_title`, `content_order`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2017-05-01 12:04:34', '2017-05-01 12:04:34'),
(2, 1, 5, 4, 'Itinerary title', 0, NULL, 'R', NULL, NULL, NULL, 2, '2017-05-01 12:04:34', '2017-05-01 12:04:34'),
(3, 1, 5, 7, 'Detailed itinerary title', 0, NULL, 'R', NULL, NULL, NULL, 3, '2017-05-01 12:04:34', '2017-05-01 12:04:34'),
(4, 1, 5, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, '2017-05-01 12:04:35', '2017-05-01 12:04:35'),
(5, 1, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, '2017-05-01 12:04:35', '2017-05-01 12:04:35'),
(6, 1, 5, 10, 'Mars Title', NULL, NULL, 'L', 'Mars is the fourth planet from the Sun and the second-smallest planet in the Solar System, after Mercury. Named after the Roman god of war, it is often referred to as the "Red Planet"[13][14] because the iron oxide prevalent on its surface gives it a reddish appearance.Mars is a terrestrial planet with a thin atmosphere, having surface features reminiscent both of the impact craters of the Moon and the valleys, deserts, and polar ice caps of Earth.', NULL, 'APR 08, 2532 - GOOOOOOD MORNING MARS', 6, '2017-05-01 12:04:35', '2017-05-01 12:04:35'),
(7, 1, 5, 8, 'Cancellation policy', NULL, NULL, NULL, 'Mars is an extremely popular destination right now. Putting people on the Red Planet has been the big goal for NASA since 2010, and SpaceX CEO Elon Musk has made it very clear that his company is going to try to start a Martian colony as early as 2024. Mars One has managed to find hundreds of hopefuls who say they are willing to live out their last remaining days on Mars. Even Buzz Aldrin is encouraging us to get our asses there.\n\n"A Martian colony is going to be more complicated than people realize"\n\nBut a Martian colony is going to be more complicated than people realize. We still haven’t invented many of the technologies needed to keep people alive — both during the journey to Mars and when we get there. Some tech has already been created, but we don’t know how it’ll hold up in space or even on another planet. That’s why we need to shift our gaze from Mars to a much closer neighbor: the Moon.', NULL, NULL, 7, '2017-05-01 12:04:35', '2017-05-01 12:04:35'),
(8, 1, 5, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, '2017-05-01 12:04:35', '2017-05-01 12:04:35'),
(9, 1, 5, 2, NULL, NULL, NULL, NULL, NULL, 'RED', NULL, 9, '2017-05-01 12:04:35', '2017-05-01 12:04:35'),
(10, 1, 5, 6, 'ARMAGEDDON IS COMING', NULL, NULL, NULL, NULL, NULL, NULL, 10, '2017-05-01 12:04:35', '2017-05-01 12:04:35');

-- --------------------------------------------------------

--
-- Table structure for table `pdf_content_images`
--

CREATE TABLE `pdf_content_images` (
  `id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  `image` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pdf_content_images`
--

INSERT INTO `pdf_content_images` (`id`, `content_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'front_page_image.jpg', '2017-05-01 12:04:34', '2017-05-01 12:04:34'),
(2, 2, 'im1.jpg ', '2017-05-01 12:04:34', '2017-05-01 12:04:34'),
(3, 2, ' im2.jpg ', '2017-05-01 12:04:34', '2017-05-01 12:04:34'),
(4, 2, ' im3.jpg ', '2017-05-01 12:04:34', '2017-05-01 12:04:34'),
(5, 2, ' im4.jpg', '2017-05-01 12:04:34', '2017-05-01 12:04:34'),
(6, 3, 'im1.jpg ', '2017-05-01 12:04:34', '2017-05-01 12:04:34'),
(7, 3, ' im2.jpg ', '2017-05-01 12:04:34', '2017-05-01 12:04:34'),
(8, 3, ' im3.jpg ', '2017-05-01 12:04:35', '2017-05-01 12:04:35'),
(9, 3, ' im4.jpg', '2017-05-01 12:04:35', '2017-05-01 12:04:35'),
(10, 6, 'im1.jpg ', '2017-05-01 12:04:35', '2017-05-01 12:04:35'),
(11, 6, ' im2.jpg ', '2017-05-01 12:04:35', '2017-05-01 12:04:35'),
(12, 8, 'mars.jpg', '2017-05-01 12:04:35', '2017-05-01 12:04:35');

-- --------------------------------------------------------

--
-- Table structure for table `pdf_itinenary`
--

CREATE TABLE `pdf_itinenary` (
  `id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pdf_itinenary`
--

INSERT INTO `pdf_itinenary` (`id`, `file_id`, `content_id`, `event_date`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2017-04-28', 'Arrival in Tokyo ', '2017-05-01 12:04:34', '2017-05-01 12:04:34'),
(2, 1, 2, '2017-04-29', ' Hakone ', '2017-05-01 12:04:34', '2017-05-01 12:04:34'),
(3, 1, 2, '2017-04-30', ' Departure', '2017-05-01 12:04:34', '2017-05-01 12:04:34');

-- --------------------------------------------------------

--
-- Table structure for table `pdf_itinenary_details`
--

CREATE TABLE `pdf_itinenary_details` (
  `id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pdf_itinenary_details`
--

INSERT INTO `pdf_itinenary_details` (`id`, `file_id`, `content_id`, `event_date`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '1970-01-01', 'Arrive at Narita/Haneda Airport independently\nAfter entry procedures, meeting English speaking greeting service, and Japanese speaking driver\nDrive to Tokyo\nTransfer to the hotel (accommodation arranged directly by Tauck, not included in tour fare)\n\nTransfers will be arranged and invoiced as supplements (not included in base tour fare) according to flight schedule.\nGuests arriving on different flights cannot share greeting service or driver in case of delays. \n\nEvening Cocktail Reception and Dinner (arranged directly by Tauck, not included in tour fare)', '2017-05-01 12:04:35', '2017-05-01 12:04:35');

-- --------------------------------------------------------

--
-- Table structure for table `pdf_map`
--

CREATE TABLE `pdf_map` (
  `id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  `address` varchar(500) NOT NULL,
  `lat` varchar(500) NOT NULL,
  `lon` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pdf_map`
--

INSERT INTO `pdf_map` (`id`, `file_id`, `content_id`, `address`, `lat`, `lon`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'Jerusalem ', '31.520605 ', '35.127777 ', '2017-05-01 12:04:35', '2017-05-01 12:04:35'),
(2, 1, 4, ' Hebron ', ' 31.791804 ', ' 35.229401 ', '2017-05-01 12:04:35', '2017-05-01 12:04:35'),
(3, 1, 4, ' Amman', ' 31.924775', ' 35.949005', '2017-05-01 12:04:35', '2017-05-01 12:04:35');

-- --------------------------------------------------------

--
-- Table structure for table `pdf_templates`
--

CREATE TABLE `pdf_templates` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pdf_templates`
--

INSERT INTO `pdf_templates` (`id`, `name`, `created_at`, `updated_at`, `status`) VALUES
(1, 'front_page', '2017-04-26 00:00:00', '2017-04-26 07:28:48', 1),
(2, 'empty_page', '2017-04-26 00:00:00', '2017-04-26 07:28:48', 1),
(3, 'full_image_page', '2017-04-26 00:00:00', '2017-04-26 07:31:21', 1),
(4, 'itinerary', '2017-04-26 00:00:00', '2017-04-26 07:31:21', 1),
(5, 'map', '2017-04-26 00:00:00', '2017-04-26 07:31:21', 1),
(6, 'empty_page_with_title', '2017-04-26 00:00:00', '2017-04-26 07:31:21', 1),
(7, 'detail_itinerary', '2017-04-26 00:00:00', '2017-04-26 07:31:21', 1),
(8, 'content_only', '2017-04-26 00:00:00', '2017-04-26 07:31:21', 1),
(9, 'travel_agent', '2017-04-26 00:00:00', '2017-04-26 07:31:21', 1),
(10, 'image_with_content', '2017-04-26 00:00:00', '2017-04-26 07:31:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pdf_travel_agent`
--

CREATE TABLE `pdf_travel_agent` (
  `id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `profile_image` varchar(500) NOT NULL,
  `logo` varchar(500) NOT NULL,
  `place` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pdf_travel_agent`
--

INSERT INTO `pdf_travel_agent` (`id`, `file_id`, `content_id`, `name`, `profile_image`, `logo`, `place`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 'Obama ', 'agg1.jpg ', 'ag1.jpg ', 'Netherlands ', '2017-05-01 12:04:35', '2017-05-01 12:04:35'),
(2, 1, 5, ' Tramp', ' agg2.jpg', ' ag2.jpg', ' Israel', '2017-05-01 12:04:35', '2017-05-01 12:04:35');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` text,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `firstName`, `lastName`, `phone`, `image`, `address`, `city`, `country`, `status`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'jagannathan.p@kenhike.com', '$2y$10$h54HLFbB6Ih4VvjPlxbgCuWxZVju8fywt79zK9VYXrQxTF8TaYe9C', 'jagan', 'palani', '1234567890', NULL, '11, Main School Street', 'chennai', 'India', 1, 2, '2017-04-28 13:52:11', '2017-04-28 09:50:58'),
(4, 'kalimuthu.l@kenhike.com', '$2y$10$hrHKwfDpBpx3lcR5eZsa1OwkgWqb5vKjyhzylojDXSYMpy/ic6UWK', 'kalimuthu', 'muthu', '1234567890', NULL, '11, Main School Street', 'chennai', 'India', 1, 2, '2017-04-28 18:42:20', '2017-04-28 07:42:20'),
(5, 'visvanathan.s@kenhike.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '2017-05-01 15:03:09', '2017-05-01 09:33:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files_directory`
--
ALTER TABLE `files_directory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_common_fields`
--
ALTER TABLE `pdf_common_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_content`
--
ALTER TABLE `pdf_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_content_images`
--
ALTER TABLE `pdf_content_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_itinenary`
--
ALTER TABLE `pdf_itinenary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_itinenary_details`
--
ALTER TABLE `pdf_itinenary_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_map`
--
ALTER TABLE `pdf_map`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_templates`
--
ALTER TABLE `pdf_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_travel_agent`
--
ALTER TABLE `pdf_travel_agent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files_directory`
--
ALTER TABLE `files_directory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pdf_common_fields`
--
ALTER TABLE `pdf_common_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pdf_content`
--
ALTER TABLE `pdf_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `pdf_content_images`
--
ALTER TABLE `pdf_content_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `pdf_itinenary`
--
ALTER TABLE `pdf_itinenary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pdf_itinenary_details`
--
ALTER TABLE `pdf_itinenary_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pdf_map`
--
ALTER TABLE `pdf_map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pdf_templates`
--
ALTER TABLE `pdf_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `pdf_travel_agent`
--
ALTER TABLE `pdf_travel_agent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
