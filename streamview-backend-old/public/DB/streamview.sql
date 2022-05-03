-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 05, 2021 at 03:17 PM
-- Server version: 5.7.26-0ubuntu0.16.04.1
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `streamview-production`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_activated` int(11) NOT NULL DEFAULT '1',
  `gender` enum('male','female','others') COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paypal_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `status` int(11) NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'sub_admin',
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token_expiry` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timezone` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'America/Los_Angeles',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin_type` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `picture`, `description`, `is_activated`, `gender`, `mobile`, `paypal_email`, `address`, `status`, `role`, `token`, `token_expiry`, `remember_token`, `timezone`, `created_at`, `updated_at`, `admin_type`) VALUES
(17, 'Admin', 'developer@streamview.com', '$2y$10$qFsUSViUNvs.sY.OifQbiOiw.auOkSid5pAUtkbO7SHUp1kZqvr/i', 'https://adminview.streamhash.com/uploads/images/78de2a7223ab8bda2351575b7cddc966107ecc8c.jpg', '', 1, 'male', '2667276272', '', 'Bangalore', 1, 'admin', '2y10vg42UncbTdFcAiqy4JluhYc7yDJN9YcJVNH0zQEq3L3SbzIXFgW', '1524898819', '8czJo8qY2R6TdGs0ippW4StKnYsuF34FRo5sZf6mlPoPNKQd2kOHpY0DulXF', 'Asia/Kolkata', '2017-11-09 07:59:34', '2018-04-28 06:45:42', 0),
(29, 'Admin', 'test@streamview.com', '$2y$10$bHpZZmrF2I.TgbwTNdrVyOahOZnEJ/w8jZKv53ZG6wxbKZEdjFqV.', 'https://adminview.streamhash.com/uploads/images/78de2a7223ab8bda2351575b7cddc966107ecc8c.jpg', '', 1, 'male', '2667276272', '', 'Bangalore', 1, 'admin', '2y10kuiR0M6P1OFqSGVWtgH8zWlox4Kr8AEU5LdKFBiFmC1CmM1bG8q', '1612791406', 'hlSF4JZGXt3UODbvHIDoH6CQLmiu2pi72YruR2mrQ7F1w2WHSiD1XzQ7d3Mg', 'Asia/Kolkata', '2017-11-09 07:59:34', '2021-02-08 09:36:46', 1),
(50, 'Admin', 'admin@streamview.com', '$2y$10$iCX8ZR/eBVQklQFmUZ7cPedDSuR3GT8.HG57W4eL31DJuW7lnqFl.', 'http://adminview.streamhash.com/placeholder.png', '', 1, 'male', NULL, '', '', 0, 'admin', '2y10L8YMDnjaDmAOldsOcHWvOU47QaXvWFtaOLFZBz7fpsPVkfEW6i', '1982898042', NULL, 'Asia/Kolkata', '2021-03-29 00:00:02', '2021-06-05 13:00:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_videos`
--

CREATE TABLE `admin_videos` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `download_status` tinyint(4) NOT NULL,
  `age` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `details` text COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `is_kids_video` tinyint(4) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `video` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `video_subtitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `trailer_video` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `trailer_subtitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `default_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'http://adminview.streamhash.com/images/default.png',
  `video_gif_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `video_image_mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `banner_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_banner_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ratings` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reviews` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_original_video` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `is_approved` int(11) NOT NULL,
  `is_home_slider` int(11) NOT NULL DEFAULT '0',
  `is_banner` int(11) NOT NULL,
  `uploaded_by` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `publish_time` datetime NOT NULL,
  `duration` time NOT NULL,
  `trailer_duration` time NOT NULL,
  `video_resolutions` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trailer_video_resolutions` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `compress_status` int(11) NOT NULL DEFAULT '0',
  `main_video_compress_status` tinyint(4) NOT NULL,
  `trailer_compress_status` int(11) NOT NULL DEFAULT '0',
  `video_resize_path` longtext COLLATE utf8_unicode_ci,
  `trailer_resize_path` longtext COLLATE utf8_unicode_ci,
  `edited_by` enum('admin','moderator','user','other') COLLATE utf8_unicode_ci NOT NULL,
  `ppv_created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `watch_count` int(11) NOT NULL,
  `is_pay_per_view` tinyint(4) NOT NULL,
  `type_of_user` int(11) NOT NULL DEFAULT '0',
  `type_of_subscription` int(11) NOT NULL DEFAULT '0',
  `amount` float NOT NULL DEFAULT '0',
  `redeem_amount` double(8,2) NOT NULL,
  `admin_amount` double(8,2) NOT NULL,
  `user_amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `video_type` int(11) NOT NULL,
  `video_upload_type` int(11) NOT NULL,
  `position` smallint(6) NOT NULL,
  `player_json` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `hls_main_video` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `video_subtitle_vtt` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `trailer_subtitle_vtt` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_videos`
--

INSERT INTO `admin_videos` (`id`, `unique_id`, `title`, `description`, `download_status`, `age`, `details`, `category_id`, `sub_category_id`, `is_kids_video`, `genre_id`, `video`, `video_subtitle`, `trailer_video`, `trailer_subtitle`, `default_image`, `mobile_image`, `video_gif_image`, `video_image_mobile`, `banner_image`, `mobile_banner_image`, `ratings`, `reviews`, `status`, `is_original_video`, `is_approved`, `is_home_slider`, `is_banner`, `uploaded_by`, `publish_time`, `duration`, `trailer_duration`, `video_resolutions`, `trailer_video_resolutions`, `compress_status`, `main_video_compress_status`, `trailer_compress_status`, `video_resize_path`, `trailer_resize_path`, `edited_by`, `ppv_created_by`, `watch_count`, `is_pay_per_view`, `type_of_user`, `type_of_subscription`, `amount`, `redeem_amount`, `admin_amount`, `user_amount`, `created_at`, `updated_at`, `video_type`, `video_upload_type`, `position`, `player_json`, `hls_main_video`, `video_subtitle_vtt`, `trailer_subtitle_vtt`) VALUES
(1030, 'superhero-movie6082be1181a83', 'Superhero Movie', 'The team behind Scary Movie takes on the comic book genre in this tale of Rick Riker, a nerdy teen imbued with superpowers by a radioactive dragonfly. And because every hero needs a nemesis, enter Lou Landers, aka the villainously goofy Hourglass.', 0, '16', 'The greatest Superhero movie of all time! (not counting all the others)', 176, 245, 0, 0, 'https://www.youtube.com/watch?v=GLItPN8HTbs', '', 'https://www.youtube.com/watch?v=xV2rUbNVC7w', '', 'http://adminview.streamhash.com/uploads/images/video_1030_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1030_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1030_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-04-23 18:01:13', '01:22:29', '00:02:15', '', '', 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-23 10:12:10', '2021-06-04 18:00:31', 2, 0, 0, '', '', '', ''),
(1033, 'a-recipe-for-seduction6082bdde13bae', 'A Recipe for Seduction', 'As the holidays draw near, a young heiress contends with the affections of a suitor handpicked by her mother. When the handsome chef, Harland Sanders, arrives with his secret fried chicken recipe and a dream, he sets in motion a series of events that unravels the mother’s devious plans. Will our plucky heiress escape to her wintry happily ever after with Harland at her side, or will she cave to the demands of family and duty?', 0, '12', 'We all have our secrets, his just happens to be...', 177, 246, 0, 0, 'https://www.youtube.com/watch?v=j0e7Bj_7T3k', '', 'https://www.youtube.com/watch?v=QiLqJscbCSI', '', 'http://adminview.streamhash.com/uploads/images/video_1033_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1033_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1033_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-04-23 18:00:22', '00:16:18', '00:01:14', '', '', 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-23 12:05:16', '2021-06-04 18:00:06', 3, 0, 0, '', '', '', ''),
(1034, 'raya-and-the-last-dragon6084d2d76add2', 'Raya and the Last Dragon', 'Long ago, in the fantasy world of Kumandra, humans and dragons lived together in harmony. But when an evil force threatened the land, the dragons sacrificed themselves to save humanity. Now, 500 years later, that same evil has returned and it’s up to a lone warrior, Raya, to track down the legendary last dragon to restore the fractured land and its divided people.', 0, '12', 'A quest to save her world.', 184, 244, 1, 0, 'http://103.133.135.242/Data/movies/ANIMATION/2021/Raya%20and%20the%20Last%20Dragon%20%282021%29/Raya.And.The.Last.Dragon.2021.1080p.WEBRip.x264.AAC5.1-%5BYTS.MX%5D.mp4', '', 'https://www.youtube.com/watch?v=1VIZ89FEjYI', '', 'http://adminview.streamhash.com/uploads/images/video_1034_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1034_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1034_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-04-25 03:24:23', '01:27:28', '00:02:29', '426x240,640x360,854x480,1280x720', '426x240,640x360,854x480,1280x720,1920x1080', 6, 6, 6, 'http://adminview.streamhash.com/uploads/videos/original/426x240SV-2021-04-23-08-59-11-9273e8cfeb211af79fb64f422b52e4c99241d8bd.mp4,http://adminview.streamhash.com/uploads/videos/original/640x360SV-2021-04-23-08-59-11-9273e8cfeb211af79fb64f422b52e4c99241d8bd.mp4,http://adminview.streamhash.com/uploads/videos/original/854x480SV-2021-04-23-08-59-11-9273e8cfeb211af79fb64f422b52e4c99241d8bd.mp4,http://adminview.streamhash.com/uploads/videos/original/1280x720SV-2021-04-23-08-59-11-9273e8cfeb211af79fb64f422b52e4c99241d8bd.mp4', 'http://adminview.streamhash.com/uploads/videos/original/426x240SV-2021-04-23-12-08-35-d2240edc6b723d93f64d6a047b4261e628806cd2.mp4,http://adminview.streamhash.com/uploads/videos/original/640x360SV-2021-04-23-12-08-35-d2240edc6b723d93f64d6a047b4261e628806cd2.mp4,http://adminview.streamhash.com/uploads/videos/original/854x480SV-2021-04-23-12-08-35-d2240edc6b723d93f64d6a047b4261e628806cd2.mp4,http://adminview.streamhash.com/uploads/videos/original/1280x720SV-2021-04-23-12-08-35-d2240edc6b723d93f64d6a047b4261e628806cd2.mp4,http://adminview.streamhash.com/uploads/videos/original/1920x1080SV-2021-04-23-12-08-35-d2240edc6b723d93f64d6a047b4261e628806cd2.mp4', 'admin', 'Admin', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-23 12:08:35', '2021-06-04 17:59:48', 3, 0, 0, 'http://adminview.streamhash.com/uploads/video-json/player-data-1034.json', 'http://demo.streamhash.com/assets/hls/1034/1034.m3u8', '', ''),
(1035, 'scary-movie-46082bd3a9c471', 'Scary Movie 4', 'Cindy finds out the house she lives in is haunted by a little boy and goes on a quest to find out who killed him and why. Also, Alien "Tr-iPods" are invading the world and she has to uncover the secret in order to stop them.', 0, '16', 'Bury the grudge. Burn the village. See the saw.', 176, 247, 0, 0, 'https://www.youtube.com/watch?v=yJM9FMRo9Ig', '', 'https://www.youtube.com/watch?v=h0zAlXr1UOs', '', 'http://adminview.streamhash.com/uploads/images/video_1035_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1035_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1035_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-04-23 17:57:38', '01:29:35', '00:02:11', '', '', 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-23 12:23:18', '2021-06-04 18:00:31', 2, 0, 0, '', '', '', ''),
(1036, 'click6083799ec077b', 'Click', 'A married workaholic, Michael Newman doesn\'t have time for his wife and children, not if he\'s to impress his ungrateful boss and earn a well-deserved promotion. So when he meets Morty, a loopy sales clerk, he gets the answer to his prayers: a magical remote that allows him to bypass life\'s little distractions with increasingly hysterical results.', 0, '16', 'What If You Had A Remote... That Controlled Your Universe?', 176, 243, 1, 0, 'https://www.youtube.com/watch?v=TTK_Xc8pAIo', '', 'https://www.youtube.com/watch?v=3-VfwPpbNg4', '', 'http://adminview.streamhash.com/uploads/images/video_1036_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1036_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1036_001.jpeg', '', 'http://adminview.streamhash.com/uploads/images/SV-2021-04-23-12-43-09-2a8bd58cd89fbc40589dafbbdf2e34dffa231b36.jpeg', 'http://adminview.streamhash.com/uploads/images/SV-2021-04-23-12-44-11-9aa484c1b1f9c2f23b43f39f517570a516874ecd.jpeg', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-04-23 22:51:26', '01:47:31', '00:02:31', '', '', 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-23 12:41:47', '2021-06-04 18:00:31', 2, 0, 0, '', '', '', ''),
(1040, 'the-map-of-tiny-perfect-things60b1a55bb2d42', 'The Map of Tiny Perfect Things', 'The film tells the story of quick-witted teen Mark, contentedly living the same day in an endless loop whose world is turned upside-down when he meets mysterious Margaret also stuck in the time loop. Mark and Margaret form a magnetic partnership, setting out to find all the tiny things that make that one day perfect. What follows is a love story with a fantastical twist, as the two struggle to figure out how -- and whether -- to escape their never-ending day.', 0, '16', 'One day. Infinite possibilities.', 177, 249, 0, 0, 'https://www.dropbox.com/s/id4aesrtijjekst/The%20Map%20Of%20Tiny%20Perfect%20Things.mp4?dl=1', '', 'https://www.youtube.com/watch?v=ZOxsfKQWrUg', '', 'http://adminview.streamhash.com/uploads/images/video_1040_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1040_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1040_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-05-29 12:22:19', '01:39:02', '00:02:41', '', '1920x1080', 6, 6, 6, '', 'http://adminview.streamhash.com/uploads/videos/original/1920x1080SV-2021-04-23-20-59-49-24654b3a928ab8761bdc39cdc56d9b2c7e794335.mp4', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-23 20:59:49', '2021-06-04 18:00:06', 3, 0, 0, 'http://adminview.streamhash.com/uploads/video-json/player-data-1040.json', 'http://demo.streamhash.com/assets/hls/1040/1040.m3u8', '', ''),
(1053, 'hercules-in-new-york6084c5069d87a', 'Hercules in New York', 'Hercules has grown tired of his life on Mount Olympus, and wishes to visit Earth. His father Zeus forbids such a voyage, but a misdirected thunderbolt sends Hercules tumbling down the mountain and into New York City, where he\'s befriended by Pretzie, who runs a pretzel cart in the park. As Hercules tries to make his way in the big city with Pretzie\'s help, he runs afoul of a crooked wresling promoter, gets mixed up with gangsters, rides his chariot through Times Square, descends into Hell, and dines at the Automat. Just as Hercules is getting used to life on Earth, his angry father decides it\'s time the boy came home, and Zeus sends Nemesis and a handful of other gods to retrieve him.', 0, '12', 'Hercules has grown tired of his life on Mount Olympus, and wishes to visit Earth. His father Zeus forbids such a voyage, but a misdirected thunderbolt sends Hercules tumbling down the mountain and into New York City, where he\'s befriended by Pretzie, who runs a pretzel cart in the park. As Hercules tries to make his way in the big city with Pretzie\'s help, he runs afoul of a crooked wresling promoter, gets mixed up with gangsters, rides his chariot through Times Square, descends into Hell, and dines at the Automat. Just as Hercules is getting used to life on Earth, his angry father decides it\'s time the boy came home, and Zeus sends Nemesis and a handful of other gods to retrieve him.', 176, 258, 0, 0, 'https://ia600706.us.archive.org/24/items/hercules.in.new.york.1969.1080p.bluray.x264.yify/hercules.in.new.york.1969.1080p.bluray.x264.yify.mp4', '', 'https://www.youtube.com/watch?v=X9qAR-Jnbug', '', 'http://adminview.streamhash.com/uploads/images/video_1053_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1053_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1053_001.jpeg', '', 'http://adminview.streamhash.com/uploads/images/SV-2021-04-25-01-20-25-8b89414bc2e04f8452d52797b732eba1fbee879a.jpeg', 'http://adminview.streamhash.com/uploads/images/SV-2021-04-25-01-20-25-9da9ec9163f86f1b246adf89f674a95f27eeb9ae.jpeg', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-04-25 11:25:26', '01:32:00', '00:02:40', '', '', 6, 6, 6, '', '', 'admin', 'Admin', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-25 01:18:10', '2021-06-04 18:00:31', 3, 0, 0, '', '', '', ''),
(1061, 'soul6084cf343d257', 'Soul', 'Joe Gardner is a middle school teacher with a love for jazz music. After a successful gig at the Half Note Club, he suddenly gets into an accident that separates his soul from his body and is transported to the You Seminar, a center in which souls develop and gain passions before being transported to a newborn child. Joe must enlist help from the other souls-in-training, like 22, a soul who has spent eons in the You Seminar, in order to get back to Earth.', 0, '12', 'Joe Gardner is a middle school teacher with a love for jazz music. After a successful gig at the Half Note Club, he suddenly gets into an accident that separates his soul from his body and is transported to the You Seminar, a center in which souls develop and gain passions before being transported to a newborn child. Joe must enlist help from the other souls-in-training, like 22, a soul who has spent eons in the You Seminar, in order to get back to Earth.', 184, 261, 1, 0, 'http://103.133.135.242/Data/movies/ANIMATION/2020/Soul%20%282020%29/Soul.2020.720p.WEBRip.x264.AAC-%5BYTS.MX%5D.mp4', '', 'https://www.youtube.com/watch?v=xOsLIiBStEs', '', 'http://adminview.streamhash.com/uploads/images/video_1061_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1061_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1061_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-04-25 03:08:52', '01:40:31', '00:02:19', '', '', 6, 6, 6, '', '', 'admin', 'Admin', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-25 02:08:34', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1062, 'onward6084d016b1631', 'Onward', 'In a suburban fantasy world, two teenage elf brothers embark on an extraordinary quest to discover if there is still a little magic left out there.', 0, '12', 'In a suburban fantasy world, two teenage elf brothers embark on an extraordinary quest to discover if there is still a little magic left out there.', 184, 262, 1, 0, 'http://103.133.135.242/Data/movies/ANIMATION/2020/Onward%20%282020%29/Onward.2020.1080p.BluRay.x264.AAC5.1-%5BYTS.MX%5D.mp4', '', 'https://www.youtube.com/watch?v=gn5QmllRCn4', '', 'http://adminview.streamhash.com/uploads/images/video_1062_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1062_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1062_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-04-25 03:12:38', '01:42:21', '00:22:00', '', '', 6, 6, 6, '', '', 'admin', 'Admin', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-25 02:12:21', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1063, 'mortal-kombat60b2d1c1e3a29', 'Mortal Kombat', 'Washed-up MMA fighter Cole Young, unaware of his heritage, and hunted by Emperor Shang Tsung\'s best warrior, Sub-Zero, seeks out and trains with Earth\'s greatest champions as he prepares to stand against the enemies of Outworld in a high stakes battle for the universe.', 0, '18', 'Washed-up MMA fighter Cole Young, unaware of his heritage, and hunted by Emperor Shang Tsung\'s best warrior, Sub-Zero, seeks out and trains with Earth\'s greatest champions as he prepares to stand against the enemies of Outworld in a high stakes battle for the universe.', 172, 263, 0, 0, 'https://www.dropbox.com/s/lsvhu7vbvszt80x/Mortal%20Kombat%20%282021%29.mp4?dl=1', '', 'https://www.youtube.com/watch?v=QJHY4ggYCk4', '', 'http://adminview.streamhash.com/uploads/images/video_1063_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1063_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1063_001.jpeg', '', 'http://adminview.streamhash.com/uploads/images/SV-2021-04-25-02-43-09-43f34044d9e1ed1cf1157cbad705aef54b4c61d1.jpeg', 'http://adminview.streamhash.com/uploads/images/SV-2021-04-25-02-43-09-075ef07d9e9821237de605e18a0e7674c3527241.jpeg', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-05-30 09:44:01', '01:50:00', '00:02:42', '', '', 6, 6, 6, '', '', 'admin', 'Admin', 9, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-25 02:41:20', '2021-06-04 18:00:27', 3, 0, 0, '', '', '', ''),
(1064, 'an-american-pickle6085198f300ab', 'An American Pickle', 'An immigrant worker at a pickle factory is accidentally preserved for 100 years and wakes up in modern day Brooklyn. He learns his only surviving relative is his great grandson, a computer coder who he can’t connect with.', 0, '12', 'An immigrant worker at a pickle factory is accidentally preserved for 100 years and wakes up in modern day Brooklyn. He learns his only surviving relative is his great grandson, a computer coder who he can’t connect with.', 176, 257, 0, 0, 'http://103.133.135.242/Data/movies/hollywood/2020/An%20American%20Pickle%20%282020%29/An.American.Pickle.2020.1080p.WEBRip.x264.AAC5.1-%5BYTS.MX%5D.mp4', '', 'https://www.youtube.com/watch?v=nQjlMFLldto', '', 'http://adminview.streamhash.com/uploads/images/video_1064_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1064_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1064_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-04-25 17:26:07', '01:28:25', '00:02:49', '', '', 6, 6, 6, '', '', 'admin', 'Admin', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-25 07:25:52', '2021-06-04 18:00:31', 3, 0, 0, '', '', '', ''),
(1065, 'phineas-and-ferb-the-movie-candace-against-the-universe60851bee3a241', 'Phineas and Ferb the Movie: Candace Against the Universe', 'Phineas and Ferb travel across the galaxy to rescue their older sister Candace, who has been abducted by aliens and taken to a utopia in a far-off planet, free of her pesky little brothers.', 0, '12', 'Phineas and Ferb travel across the galaxy to rescue their older sister Candace, who has been abducted by aliens and taken to a utopia in a far-off planet, free of her pesky little brothers.', 184, 264, 1, 0, 'http://103.133.135.242/Data/movies/ANIMATION/2020/Phineas%20and%20Ferb%20the%20Movie%3A%20Candace%20Against%20the%20Universe%20%282020%29/Phineas.And.Ferb.The.Movie.Candace.Against.The.Universe.2020.1080p.WEBRip.x264.AAC5.1-%5BYTS.MX%5D.mp4', '', 'https://www.youtube.com/watch?v=jcqziqIcJ_g', '', 'http://adminview.streamhash.com/uploads/images/video_1065_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1065_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1065_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-04-25 17:36:14', '01:24:43', '00:01:36', '', '', 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-25 07:30:34', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1066, 'secret-magic-control-agency60851bd595023', 'Secret Magic Control Agency', 'The Secret Magic Control Agency sends its two best agents, Hansel and Gretel, to fight against the witch of the Gingerbread House.', 0, '12', 'The Secret Magic Control Agency sends its two best agents, Hansel and Gretel, to fight against the witch of the Gingerbread House.', 184, 265, 1, 0, 'http://103.133.135.242/Data/movies/ANIMATION/2021/Secret%20Magic%20Control%20Agency%20%282021%29/Secret.Magic.Control.Agency.2021.720p.WEBRip.x264.AAC-%5BYTS.MX%5D.mp4', '', 'https://www.youtube.com/watch?v=OESJJ2vZn9M', '', 'http://adminview.streamhash.com/uploads/images/video_1066_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1066_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1066_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-04-25 17:35:49', '01:45:14', '00:02:28', '', '', 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-25 07:35:36', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1067, 'tom-jerry60851cec24290', 'Tom & Jerry', 'Tom the cat and Jerry the mouse get kicked out of their home and relocate to a fancy New York hotel, where a scrappy employee named Kayla will lose her job if she can’t evict Jerry before a high-class wedding at the hotel. Her solution? Hiring Tom to get rid of the pesky mouse.', 0, '12', 'Tom the cat and Jerry the mouse get kicked out of their home and relocate to a fancy New York hotel, where a scrappy employee named Kayla will lose her job if she can’t evict Jerry before a high-class wedding at the hotel. Her solution? Hiring Tom to get rid of the pesky mouse.', 176, 266, 1, 0, 'http://103.133.135.242/Data/movies/hollywood/2021/Tom%20and%20Jerry%20%282021%29/Tom.and.Jerry.2021.1080p.WEBRip.x264-RARBG.mp4', '', 'https://www.youtube.com/watch?v=kP9TfCWaQT4', '', 'http://adminview.streamhash.com/uploads/images/video_1067_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1067_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1067_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-04-25 17:40:28', '01:41:01', '00:02:24', '', NULL, 6, 6, 6, '', '', 'admin', 'Admin', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-25 07:40:28', '2021-06-04 18:00:31', 3, 0, 0, '', '', '', ''),
(1068, 'sonic-the-hedgehog60851dc0ea3ae', 'Sonic the Hedgehog', 'Based on the global blockbuster videogame franchise from Sega, Sonic the Hedgehog tells the story of the world’s speediest hedgehog as he embraces his new home on Earth. In this live-action adventure comedy, Sonic and his new best friend team up to defend the planet from the evil genius Dr. Robotnik and his plans for world domination.', 0, '12', 'Based on the global blockbuster videogame franchise from Sega, Sonic the Hedgehog tells the story of the world’s speediest hedgehog as he embraces his new home on Earth. In this live-action adventure comedy, Sonic and his new best friend team up to defend the planet from the evil genius Dr. Robotnik and his plans for world domination.', 172, 267, 1, 0, 'http://103.133.135.242/Data/movies/hollywood/2020/Sonic%20the%20Hedgehog%20%282020%29/Sonic.The.Hedgehog.2020.1080p.BluRay.x264.AAC5.1-%5BYTS.MX%5D.mp4', '', 'https://www.youtube.com/watch?v=szby7ZHLnkA', '', 'http://adminview.streamhash.com/uploads/images/video_1068_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1068_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1068_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-04-25 17:44:00', '01:38:53', '00:02:51', '', NULL, 6, 6, 6, '', '', 'admin', 'Admin', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-25 07:44:00', '2021-06-04 18:00:27', 3, 0, 0, '', '', '', ''),
(1069, 'boss-level60855394b8c09', 'Boss Level', 'A retired special forces officer is trapped in a never-ending time loop on the day of his death.', 0, '16', 'A retired special forces officer is trapped in a never-ending time loop on the day of his death.', 172, 268, 0, 0, 'http://103.133.135.242/Data/movies/hollywood/2020/Boss%20Level%20%282020%29/Boss.Level.2020.720p.WEBRip.x264.AAC-%5BYTS.MX%5D.mp4', '', 'https://www.youtube.com/watch?v=9mkiY-37OG4', '', 'http://adminview.streamhash.com/uploads/images/video_1069_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1069_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1069_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-04-25 21:33:40', '01:40:37', '00:02:16', '', NULL, 6, 6, 6, '', '', 'admin', 'Admin', 1, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-25 11:33:40', '2021-06-04 18:00:27', 3, 0, 0, '', '', '', ''),
(1070, 'shrek-the-musical6085f5f0e11d3', 'Shrek the Musical', 'Shrek The Musical is a musical with music by Jeanine Tesori and book and lyrics by David Lindsay-Abaire. It is based on the 2001 DreamWorks Animation\'s film Shrek and William Steig\'s 1990 book Shrek! It was nominated for 8 Tony Awards including Best Musical.', 0, '12', 'Shrek The Musical is a musical with music by Jeanine Tesori and book and lyrics by David Lindsay-Abaire. It is based on the 2001 DreamWorks Animation\'s film Shrek and William Steig\'s 1990 book Shrek! It was nominated for 8 Tony Awards including Best Musical.', 176, 269, 1, 0, 'https://www.youtube.com/watch?v=vk-JRG5lE2U', '', 'https://www.youtube.com/watch?v=g2VQ2pfXbyI', '', 'http://adminview.streamhash.com/uploads/images/video_1070_001.jpg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1070_001.jpg', 'http://adminview.streamhash.com/uploads/images/video_1070_001.jpg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-04-26 09:06:24', '02:10:15', '00:01:39', '', NULL, 6, 6, 6, '', '', 'admin', 'Admin', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-25 23:06:24', '2021-06-04 18:00:31', 2, 0, 0, '', '', '', ''),
(1071, 'bill-ted-face-the-music60865dce28aa2', 'Bill & Ted Face the Music', 'Yet to fulfill their rock and roll destiny, the now middle-aged best friends Bill and Ted set out on a new adventure when a visitor from the future warns them that only their song can save life as we know it. Along the way, they are helped by their daughters, a new batch of historical figures and a few music legends—to seek the song that will set their world right and bring harmony to the universe.', 0, '12', 'The future awaits', 178, 271, 0, 0, 'http://103.133.135.242/Data/movies/hollywood/2020/Bill%20%26%20Ted%20Face%20the%20Music%20%282020%29/Bill.Ted.Face.The.Music.2020.1080p.WEBRip.x264.AAC5.1-%5BYTS.MX%5D.mp4', '', 'https://www.youtube.com/watch?v=1gPGeAYo3yU', '', 'http://adminview.streamhash.com/uploads/images/video_1071_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1071_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1071_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-04-26 11:59:34', '01:31:54', '00:02:39', '', NULL, 6, 6, 6, '', '', 'admin', 'Admin', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-26 06:29:34', '2021-06-04 18:00:11', 3, 0, 0, '', '', '', ''),
(1072, 'hamilton60865f3189b89', 'Hamilton', 'Presenting the tale of American founding father Alexander Hamilton, this filmed version of the original Broadway smash hit is the story of America then, told by America now.', 0, '16', 'Presenting the tale of American founding father Alexander Hamilton, this filmed version of the original Broadway smash hit is the story of America then, told by America now.', 222, 272, 0, 0, 'http://103.133.135.242/Data/movies/hollywood/2020/Hamilton%20%282020%29/Hamilton.2020.720p.WEBRip.x264.AAC-%5BYTS.MX%5D.mp4', '', 'https://www.youtube.com/watch?v=DSCKfXpAGHc', '', 'http://adminview.streamhash.com/uploads/images/video_1072_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1072_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1072_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-04-26 12:05:29', '02:40:15', '00:01:00', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-26 06:35:29', '2021-06-04 18:00:52', 3, 0, 0, '', '', '', ''),
(1073, 'mulan-202060865fcb7df42', 'Mulan (2020)', 'When the Emperor of China issues a decree that one man per family must serve in the Imperial Chinese Army to defend the country from Huns, Hua Mulan, the eldest daughter of an honored warrior, steps in to take the place of her ailing father. She is spirited, determined and quick on her feet. Disguised as a man by the name of Hua Jun, she is tested every step of the way and must harness her innermost strength and embrace her true potential.', 0, '12', 'When the Emperor of China issues a decree that one man per family must serve in the Imperial Chinese Army to defend the country from Huns, Hua Mulan, the eldest daughter of an honored warrior, steps in to take the place of her ailing father. She is spirited, determined and quick on her feet. Disguised as a man by the name of Hua Jun, she is tested every step of the way and must harness her innermost strength and embrace her true potential.', 172, 273, 1, 0, 'http://103.133.135.242/Data/movies/hollywood/2020/Mulan%20%282020%29/Mulan.2020.720p.WEBRip.x264.AAC-%5BYTS.MX%5D.mp4', '', 'https://www.youtube.com/watch?v=KK8FHdFluOQ', '', 'http://adminview.streamhash.com/uploads/images/video_1073_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1073_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1073_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-04-26 12:08:03', '01:55:08', '00:02:24', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-26 06:38:03', '2021-06-04 18:00:27', 3, 0, 0, '', '', '', ''),
(1074, 'dolittle-2020608660aab54d2', 'Dolittle (2020)', 'After losing his wife seven years earlier, the eccentric Dr. John Dolittle, famed doctor and veterinarian of Queen Victoria’s England, hermits himself away behind the high walls of Dolittle Manor with only his menagerie of exotic animals for company. But when the young queen falls gravely ill, a reluctant Dolittle is forced to set sail on an epic adventure to a mythical island in search of a cure, regaining his wit and courage as he crosses old adversaries and discovers wondrous creatures.', 0, '12', 'He\'s just not a people person.', 180, 274, 1, 0, 'https://www.youtube.com/watch?v=zjm6rDgKNMY', '', 'https://www.youtube.com/watch?v=zjm6rDgKNMY', '', 'http://adminview.streamhash.com/uploads/images/video_1074_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1074_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1074_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-04-26 12:11:46', '01:41:23', '00:02:22', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-26 06:41:46', '2021-06-04 18:00:17', 3, 0, 0, '', '', '', ''),
(1075, 'get-smart60866e54adef0', 'Get Smart', 'When the identities of secret agents from Control are compromised, the Chief promotes hapless but eager analyst Maxwell Smart and teams him with stylish, capable Agent 99, the only spy whose cover remains intact. Can they work together to thwart the evil plans of KAOS and its crafty operative?', 0, '12', 'Saving The World...And Loving It!', 172, 275, 0, 0, 'http://103.133.135.242/Data/movies/hollywood/2008/Get%20Smart%20%282008%29/Get.Smart.2008.mp4', '', 'https://www.youtube.com/watch?v=xbf9AWiJDBI', '', 'http://adminview.streamhash.com/uploads/images/video_1075_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1075_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1075_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-04-26 13:10:04', '01:49:58', '00:01:25', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-26 07:40:04', '2021-06-04 18:00:27', 3, 0, 0, '', '', '', ''),
(1076, 'halloween-201860867309607fd', 'Halloween (2018)', 'Jamie Lee Curtis returns to her iconic role as Laurie Strode, who comes to her final confrontation with Michael Myers, the masked figure who has haunted her since she narrowly escaped his killing spree on Halloween night four decades ago.', 0, '16', 'Face your fate', 223, 276, 0, 0, 'http://103.133.135.242/Data/movies/hollywood/2018/Halloween%20%282018%29%20%5B1080p%5D/Halloween%20%282018%29%20%5B1080p%5D.mp4', '', 'https://www.youtube.com/watch?v=ek1ePFp-nBI', '', 'http://adminview.streamhash.com/uploads/images/video_1076_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1076_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1076_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-04-26 13:30:09', '01:45:47', '00:02:44', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-26 08:00:09', '2021-06-04 18:00:47', 3, 0, 0, '', '', '', ''),
(1079, 'shazam608b6cf4111f5', 'Shazam!', 'A boy is given the ability to become an adult superhero in times of need with a single magic word.', 0, '16', 'Just say the word.', 172, 282, 0, 0, 'http://103.133.135.242/Data/movies/hollywood/2019/Shazam%21%20%282019%29/Shazam%21.2019.1080p.BluRay.x264-%5BYTS.LT%5D.mp4', '', 'https://www.youtube.com/watch?v=go6GEIrcvFY', '', 'http://adminview.streamhash.com/uploads/images/video_1079_001.jpg', 'http://adminview.streamhash.com/uploads/images/video_1079_001.jpg', 'http://adminview.streamhash.com/uploads/images/video_1079_001.jpg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-04-30 05:35:32', '02:11:43', '00:02:53', '', '', 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-28 04:31:18', '2021-06-04 18:00:27', 3, 0, 0, '', '', '', ''),
(1080, 'black-panther60890df19b474', 'Black Panther', 'King T\'Challa returns home to the reclusive, technologically advanced African nation of Wakanda to serve as his country\'s new leader. However, T\'Challa soon finds that he is challenged for the throne by factions within his own country as well as without. Using powers reserved to Wakandan kings, T\'Challa assumes the Black Panther mantle to join with ex-girlfriend Nakia, the queen-mother, his princess-kid sister, members of the Dora Milaje (the Wakandan \'special forces\') and an American secret agent, to prevent Wakanda from being dragged into a world war.', 0, '16', 'Long live the king.', 172, 280, 0, 0, 'http://103.133.135.242/Data/movies/hollywood/2018/Black%20Panther%20%282018%29%20%5B1080p%5D/Black%20Panther%20%282018%29%20%5B1080p%5D.mp4', '', 'https://www.youtube.com/watch?v=dxWvtMOGAhw', '', 'http://adminview.streamhash.com/uploads/images/video_1080_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1080_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1080_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-04-28 17:25:37', '02:14:33', '00:01:52', '', NULL, 6, 6, 6, '', '', 'admin', 'Admin', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-28 07:25:37', '2021-06-04 18:00:27', 3, 0, 0, '', '', '', ''),
(1081, '400-bullets608934efd9c05', '400 Bullets', 'One cold winter night in Afghanistan is about to get a whole lot worse for Rana Rae, a Gurkha soldier left to guard a British military outpost, when Captain Noah Brandt arrives looking for refuge from a group of rogue special ops and a cell of heavily armed Taliban. The two soldiers must fight for their lives as they attempt to call for backup before the rogue squad, led by the backstabbing Sergeant Bartlett, can hunt them down to retrieve a case of missile guidance chips that Noah intercepted. But Bartlett and his men do not count on Rana, whose ferocious Gurkha training makes him a force to be reckoned with.', 0, '16', 'Only one way out', 172, 281, 0, 0, 'http://103.133.135.242/Data/movies/hollywood/2021/400%20Bullets%20%282021%29/400.Bullets.2021.720p.BluRay.x264.AAC-%5BYTS.MX%5D.mp4', '', 'https://www.youtube.com/watch?v=4ZZZiG13Dhg', '', 'http://adminview.streamhash.com/uploads/images/video_1081_001.jpg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1081_001.jpg', 'http://adminview.streamhash.com/uploads/images/video_1081_001.jpg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-04-28 13:11:59', '01:30:00', '00:01:43', '', '', 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-28 10:06:07', '2021-06-04 18:00:27', 3, 0, 0, '', '', '', ''),
(1083, 'barb-and-star-go-to-vista-del-mar6089386c31574', 'Barb And Star Go to Vista Del Mar', 'The story of best friends Barb and Star, who leave their small midwestern town for the first time to go on vacation in Vista Del Mar, Florida, where they soon find themselves tangled up in adventure, love, and a villain’s evil plot to kill everyone in town.', 0, '16', 'The friendship we all want. The vacation we all need', 176, 284, 0, 0, 'http://103.133.135.242/Data/movies/hollywood/2021/Barb%20and%20Star%20Go%20to%20Vista%20Del%20Mar%20%282021%29/Barb.And.Star.Go.To.Vista.Del.Mar.2021.720p.WEBRip.x264.AAC-%5BYTS.MX%5D.mp4', '', 'https://www.youtube.com/watch?v=yvmDgXfYPbA', '', 'http://adminview.streamhash.com/uploads/images/video_1083_001.jpg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1083_001.jpg', 'http://adminview.streamhash.com/uploads/images/video_1083_001.jpg', '', '', '', '5', '', '1', '0', 0, 0, 0, '378', '2021-04-28 03:26:52', '01:46:58', '00:01:47', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-28 10:26:52', '2021-05-14 16:51:03', 3, 0, 0, '', '', '', ''),
(1084, 'ratatouille6089397aba22a', 'Ratatouille', 'Remy, a resident of Paris, appreciates good food and has quite a sophisticated palate. He would love to become a chef so he can create and enjoy culinary masterpieces to his heart\'s delight. The only problem is, Remy is a rat. When he winds up in the sewer beneath one of Paris\' finest restaurants, the rodent gourmet finds himself ideally placed to realize his dream.', 0, '12', 'He\'s dying to become a chef.', 184, 285, 1, 0, 'http://103.133.135.242/Data/movies/hollywood/2007/Ratatouille%20%282007%29%20%5B1080p%5D/Ratatouille.2007.1080p.BrRip.x264.YIFY.mp4', '', 'https://www.youtube.com/watch?v=jOGDozdW9Yo', '', 'http://adminview.streamhash.com/uploads/images/video_1084_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1084_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1084_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-04-28 13:31:22', '01:50:33', '00:02:29', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-28 10:31:22', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1085, 'the-emoji-movie60893ab3a4212', 'The Emoji Movie', 'Gene, a multi-expressional emoji, sets out on a journey to become a normal emoji.', 0, '12', 'Not easy being meh', 184, 286, 1, 0, 'http://103.133.135.242/Data/movies/ANIMATION/2017/The%20Emoji%20Movie%20%282017%29%20%5B1080p%5D/The%20Emoji%20Movie%20%282017%29%20%5B1080p%5D.mp4', '', 'https://www.youtube.com/watch?v=r8pJt4dK_s4', '', 'http://adminview.streamhash.com/uploads/images/video_1085_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1085_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1085_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-04-28 13:36:35', '01:17:18', '00:02:37', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-28 10:36:35', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1086, 'the-boss-baby60893b74b97db', 'The Boss Baby', 'A story about how a new baby\'s arrival impacts a family, told from the point of view of a delightfully unreliable narrator, a wildly imaginative 7 year old named Tim.', 0, '12', 'Born leader', 184, 287, 1, 0, 'http://103.133.135.242/Data/movies/ANIMATION/2017/The%20Boss%20Baby%20%282017%29%20%5B1080p%5D/The%20Boss%20Baby%20%282017%29%20%5B1080p%5D.mp4', '', 'https://www.youtube.com/watch?v=k397HRbTtWI', '', 'http://adminview.streamhash.com/uploads/images/video_1086_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1086_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1086_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-04-28 13:39:48', '01:37:30', '00:02:22', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-28 10:39:48', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1087, 'the-lego-batman-movie60893cdc88dce', 'The Lego Batman Movie', 'A cooler-than-ever Bruce Wayne must deal with the usual suspects as they plan to rule Gotham City, while discovering that he has accidentally adopted a teenage orphan who wishes to become his sidekick.', 0, '12', 'Always be yourself. Unless you can be Batman.', 184, 289, 1, 0, 'http://103.133.135.242/Data/movies/ANIMATION/2017/The%20LEGO%20Batman%20Movie%20%282017%29%20%5B1080p%5D/The%20LEGO%20Batman%20Movie%20%282017%29%20%5B1080p%5D.mp4', '', 'https://www.youtube.com/watch?v=aBJyp2LFHgk', '', 'http://adminview.streamhash.com/uploads/images/video_1087_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1087_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1087_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-04-28 13:45:48', '01:44:30', '00:02:17', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-28 10:45:48', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1088, 'the-lego-ninjago-movie60893da9cf954', 'The Lego Ninjago Movie', 'Six young ninjas are tasked with defending their island home of Ninjago. By night, they’re gifted warriors using their skill and awesome fleet of vehicles to fight villains and monsters. By day, they’re ordinary teens struggling against their greatest enemy....high school.', 0, '12', 'Find your inner piece.', 184, 290, 1, 0, 'http://103.133.135.242/Data/movies/ANIMATION/2017/The%20LEGO%20Ninjago%20Movie%20%282017%29%20%5B1080p%5D/The%20LEGO%20Ninjago%20Movie%20%282017%29%20%5B1080p%5D.mp4', '', 'https://www.youtube.com/watch?v=F5JV3nVOLMA', '', 'http://adminview.streamhash.com/uploads/images/video_1088_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1088_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1088_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-04-28 12:49:13', '01:41:26', '00:02:39', '', NULL, 6, 6, 6, '', '', 'admin', 'Admin', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-28 10:49:13', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1100, 'baby-driver608b691688125', 'Baby Driver', 'After being coerced into working for a crime boss, a young getaway driver finds himself taking part in a heist doomed to fail.', 0, '18', 'All you need is one killer track.', 172, 302, 0, 0, 'http://103.133.135.242/Data/movies/hollywood/2017/Baby%20Driver%20%282017%29/Baby.Driver.2017.720p.BluRay.x264-%5BYTS.AG%5D.mp4', '', 'https://www.youtube.com/watch?v=z2z857RSfhk', '', 'http://adminview.streamhash.com/uploads/images/video_1100_001.jpg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1100_001.jpg', 'http://adminview.streamhash.com/uploads/images/video_1100_001.jpg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-04-30 05:19:02', '01:55:00', '00:02:40', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-30 02:19:02', '2021-06-04 18:00:27', 3, 0, 0, '', '', '', ''),
(1102, 'born-a-champion608ba40ed792e', 'Born a Champion', 'After a blood- soaked jujitsu match in Dubai, fighting legend Mickey Kelley falls to superstar Blaine. But years later, an online video proves that Blaine cheated, and the world demands a rematch. Can the aging underdog get back into shape in time to vanquish his foe, get revenge, and claim his prize?', 0, '18', 'After a blood- soaked jujitsu match in Dubai, fighting legend Mickey Kelley falls to superstar Blaine. But years later, an online video proves that Blaine cheated, and the world demands a rematch. Can the aging underdog get back into shape in time to vanquish his foe, get revenge, and claim his prize?', 172, 304, 0, 0, 'http://103.133.135.242/Data/movies/hollywood/2021/Born%20a%20Champion%20%282021%29/Born.A.Champion.2021.720p.BluRay.x264.AAC-%5BYTS.MX%5D.mp4', '', 'https://www.youtube.com/watch?v=JHEU8myNazc', '', 'http://adminview.streamhash.com/uploads/images/video_1102_001.jpg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1102_001.jpg', 'http://adminview.streamhash.com/uploads/images/video_1102_001.jpg', '', '', '', '5', '', '1', '0', 0, 0, 0, '378', '2021-04-29 23:30:38', '01:51:36', '00:02:32', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-30 06:30:38', '2021-06-04 18:00:27', 3, 0, 0, '', '', '', ''),
(1103, 'luca608c91f75d7b0', 'Luca', 'In a beautiful seaside town on the Italian Riviera, two young boys experience an unforgettable summer filled with gelato, pasta and endless scooter rides. But all the fun is threatened by a deeply-held secret: they are sea monsters from another world just below the water’s surface.', 0, '12', 'Prepare for an unforgettable trip.', 184, 305, 1, 0, 'https://www.youtube.com/watch?v=mYfJxlgR2jw', '', 'https://www.youtube.com/watch?v=mYfJxlgR2jw', '', 'http://adminview.streamhash.com/uploads/images/video_1103_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1103_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1103_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-05-01 09:25:43', '00:02:25', '00:02:25', '', NULL, 6, 6, 6, '', '', 'admin', '', 3, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-04-30 23:25:43', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1104, 'crisis608d1ae642553', 'Crisis', 'Three stories about the world of opioids collide: a drug trafficker arranges a multi-cartel Fentanyl smuggling operation between Canada and the U.S., an architect recovering from an OxyContin addiction tracks down the truth behind her son\'s involvement with narcotics, and a university professor battles unexpected revelations about his research employer, a drug company with deep government influence bringing a new "non-addictive" painkiller to market.', 0, '18', 'Addiction is an industry.', 221, 306, 0, 0, 'http://103.133.135.242/Data/movies/hollywood/2021/Crisis%20%282021%29/Crisis.2021.720p.WEBRip.x264.AAC-%5BYTS.MX%5D.mp4', '', 'https://www.youtube.com/watch?v=6IY5-IALivk', '', 'http://adminview.streamhash.com/uploads/images/video_1104_001.jpg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1104_001.jpg', 'http://adminview.streamhash.com/uploads/images/video_1104_001.jpg', '', '', '', '5', '', '1', '0', 0, 0, 0, '378', '2021-05-01 02:09:58', '01:58:37', '00:02:35', '', NULL, 6, 6, 6, '', '', 'admin', '', 2, 0, 0, 0, 0, 100.00, 0.00, 0.00, '2021-05-01 09:09:58', '2021-06-04 18:00:57', 3, 0, 0, '', '', '', ''),
(1109, '1-vegetables608e6e0f897b1', '1. Vegetables', 'Someone stole the vegetable of Miss and Mister Bunny.', 0, '18', 'Someone stole the vegetable of Miss and Mister Bunny.', 235, 309, 0, 0, 'https://tubenow.bytecollar.com/uploads/videos/ad4cd336688cad841114037a2e0c7d8b29d1f972.mp4', '', 'https://tubenow.bytecollar.com/uploads/videos/ad4cd336688cad841114037a2e0c7d8b29d1f972.mp4', '', 'http://adminview.streamhash.com/uploads/images/video_1109_001.png', 'http://adminview.streamhash.com/uploads/images/video_mobile_1109_001.png', 'http://adminview.streamhash.com/uploads/images/video_1109_001.png', '', '', '', '5', '', '1', '1', 0, 0, 0, 'admin', '2021-05-02 19:17:03', '00:04:05', '00:00:00', '', NULL, 6, 6, 6, '', '', 'admin', 'Admin', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-02 09:17:03', '2021-06-04 17:59:42', 3, 0, 0, '', '', '', ''),
(1110, '2-basketball608e6e80654e1', '2. Basketball', 'Lilifan’s sad to be so bad at basketball. Peepoodoo will try to help her.', 0, '18', 'Lilifan’s sad to be so bad at basketball. Peepoodoo will try to help her.', 235, 309, 0, 0, 'https://tubenow.bytecollar.com/uploads/videos/cac614c25406a90f9daf9e55e0cfe5e138eef2b0.mp4', '', 'https://tubenow.bytecollar.com/uploads/videos/cac614c25406a90f9daf9e55e0cfe5e138eef2b0.mp4', '', 'http://adminview.streamhash.com/uploads/images/video_1110_001.png', 'http://adminview.streamhash.com/uploads/images/video_mobile_1110_001.png', 'http://adminview.streamhash.com/uploads/images/video_1110_001.png', '', '', '', '5', '', '1', '1', 0, 0, 0, 'admin', '2021-05-02 19:18:56', '00:04:37', '00:00:00', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-02 09:18:56', '2021-06-04 17:59:42', 3, 0, 0, '', '', '', ''),
(1111, '3-oktoberfist608e6ee497b46', '3. Oktoberfist', 'Peepoodoo Invites His German\'s Pen Friend To The Pretty Forest.', 0, '18', 'Peepoodoo Invites His German\'s Pen Friend To The Pretty Forest.', 235, 309, 0, 0, 'https://tubenow.bytecollar.com/uploads/videos/a477c0360d74871a917b1c51bcbcb7f7b734762a.mp4', '', 'https://tubenow.bytecollar.com/uploads/videos/a477c0360d74871a917b1c51bcbcb7f7b734762a.mp4', '', 'http://adminview.streamhash.com/uploads/images/video_1111_001.png', 'http://adminview.streamhash.com/uploads/images/video_mobile_1111_001.png', 'http://adminview.streamhash.com/uploads/images/video_1111_001.png', '', '', '', '5', '', '1', '1', 0, 0, 0, 'admin', '2021-05-02 19:20:36', '00:04:25', '00:00:00', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-02 09:20:36', '2021-06-04 17:59:42', 3, 0, 0, '', '', '', ''),
(1121, 'fist-of-the-north-star609b1b88ed122', 'Fist of the North Star', 'From the immensely popular FIST OF THE NORTH STAR comic book series, comes a new hero. The fate of mankind rests with superhuman warrior Kenshiro who roams the wastelands of the future waging a battle against overwhelming evil. With the spiritual guidance of his dead father, Kenshiro fights to free his stolen love from the brutal tyrant Lord Shin. Through his struggle he must confront his destiny.', 0, '16', 'A Legendary Warrior Battles Against The Forces Of Evil.', 172, 312, 0, 0, 'https://www.youtube.com/watch?v=XUdd5nvKswk', '', 'https://www.youtube.com/watch?v=-HtWj2ibRHw', '', 'http://adminview.streamhash.com/uploads/images/video_1121_001.jpg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1121_001.jpg', 'http://adminview.streamhash.com/uploads/images/video_1121_001.jpg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-05-12 10:04:24', '01:23:12', '00:01:35', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-12 00:04:24', '2021-06-04 18:00:27', 2, 0, 0, '', '', '', ''),
(1122, 'the-man-who-knew-too-little609bba92123ad', 'The Man Who Knew Too Little', 'An American gets a ticket for an audience participation game in London, then gets involved in a case of mistaken identity. As an international plot unravels around him, he thinks it\'s all part of the act.', 0, '16', 'He’s on a mission so secret, even he doesn’t know about it.', 176, 248, 0, 0, 'https://tubenow.bytecollar.com/uploads/videos/d3f681143e8df2b0f38f93bf1cd0c3bb154a9663.mp4', '', 'https://www.youtube.com/watch?v=hP-u6XWclKQ', '', 'http://adminview.streamhash.com/uploads/images/video_1122_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1122_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1122_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-05-12 21:22:58', '01:33:43', '00:03:53', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-12 11:22:58', '2021-06-04 18:00:31', 3, 0, 0, '', '', '', '');
INSERT INTO `admin_videos` (`id`, `unique_id`, `title`, `description`, `download_status`, `age`, `details`, `category_id`, `sub_category_id`, `is_kids_video`, `genre_id`, `video`, `video_subtitle`, `trailer_video`, `trailer_subtitle`, `default_image`, `mobile_image`, `video_gif_image`, `video_image_mobile`, `banner_image`, `mobile_banner_image`, `ratings`, `reviews`, `status`, `is_original_video`, `is_approved`, `is_home_slider`, `is_banner`, `uploaded_by`, `publish_time`, `duration`, `trailer_duration`, `video_resolutions`, `trailer_video_resolutions`, `compress_status`, `main_video_compress_status`, `trailer_compress_status`, `video_resize_path`, `trailer_resize_path`, `edited_by`, `ppv_created_by`, `watch_count`, `is_pay_per_view`, `type_of_user`, `type_of_subscription`, `amount`, `redeem_amount`, `admin_amount`, `user_amount`, `created_at`, `updated_at`, `video_type`, `video_upload_type`, `position`, `player_json`, `hls_main_video`, `video_subtitle_vtt`, `trailer_subtitle_vtt`) VALUES
(1128, 'bionicle-the-legend-reborn60a726349d633', 'Bionicle: The Legend Reborn', 'Once the ruler of an entire universe, the Great Spirit Mata Nui finds himself cast out of his own body, his spirit trapped inside the fabled Mask of Life, hurtling through space. After landing on the far-away planet of Bara Magna, the mask creates a new body for Mata Nui, who unwillingly gets caught up in the furious battles of the nearly barren and dangerous planet.', 0, '12', 'Once the ruler of an entire universe, the Great Spirit Mata Nui finds himself cast out of his own body, his spirit trapped inside the fabled Mask of Life, hurtling through space. After landing on the far-away planet of Bara Magna, the mask creates a new body for Mata Nui, who unwillingly gets caught up in the furious battles of the nearly barren and dangerous planet.', 172, 317, 0, 0, 'https://www.dropbox.com/s/3gym1p6htpdj5f2/Bionicle%20The%20Legend%20Reborn.mp4?dl=1', '', 'https://www.youtube.com/watch?v=93w7yh4v3oM', '', 'http://adminview.streamhash.com/uploads/images/video_1128_001.jpg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1128_001.jpg', 'http://adminview.streamhash.com/uploads/images/video_1128_001.jpg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-05-21 13:17:08', '01:17:20', '00:01:59', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-21 03:17:08', '2021-06-04 18:00:27', 3, 0, 0, '', '', '', ''),
(1129, '1-a-lying-witch-and-a-warden60a74b162a859', '1. A Lying Witch and a Warden', 'Luz, a self-assured teenage girl, accidentally stumbles upon a portal to a magical world where she befriends a rebellious witch, Eda, and an adorably tiny warrior, King. In order to get home, Luz must help them with a mission.', 0, '12', 'Luz, a self-assured teenage girl, accidentally stumbles upon a portal to a magical world where she befriends a rebellious witch, Eda, and an adorably tiny warrior, King. In order to get home, Luz must help them with a mission.', 184, 316, 1, 0, 'https://www.dropbox.com/s/8lt9vuyytb0bryn/S1E01.mp4?dl=1', '', 'https://www.dropbox.com/s/8lt9vuyytb0bryn/S1E01.mp4?dl=1', '', 'http://adminview.streamhash.com/uploads/images/video_1129_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1129_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1129_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-05-21 15:54:30', '00:22:06', '00:00:00', '', '', 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-21 05:53:18', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1130, '2-witches-before-wizards60a74d0c5550d', '2. Witches Before Wizards', 'When an ancient wizard gives Luz a map for a mystical quest, she wonders if she is actually a Chosen One.', 0, '12', 'When an ancient wizard gives Luz a map for a mystical quest, she wonders if she is actually a Chosen One.', 184, 316, 1, 0, 'https://www.dropbox.com/s/zhkrbylj5rrysrk/S1E02.mp4?dl=1', '', 'https://www.dropbox.com/s/zhkrbylj5rrysrk/S1E02.mp4?dl=1', '', 'http://adminview.streamhash.com/uploads/images/video_1130_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1130_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1130_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-05-21 16:02:52', '00:22:06', '00:00:00', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-21 06:02:52', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1131, '3-i-was-a-teenage-abomination60a74e43b0b47', '3. I Was a Teenage Abomination', 'Luz sneaks into the local magic school to help a friend and makes a new enemy in the process.', 0, '12', 'Luz sneaks into the local magic school to help a friend and makes a new enemy in the process.', 184, 316, 1, 0, 'https://www.dropbox.com/s/mzuk4vaambdhr2d/S1E03.mp4?dl=1', '', 'https://www.dropbox.com/s/mzuk4vaambdhr2d/S1E03.mp4?dl=1', '', 'http://adminview.streamhash.com/uploads/images/video_1131_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1131_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1131_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-05-21 16:08:03', '00:22:06', '00:00:00', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-21 06:08:03', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1132, '4-the-intruder60a751ef365da', '4. The Intruder', 'Luz and King have to defend the Owl House from a mysterious intruder.', 0, '12', 'Luz and King have to defend the Owl House from a mysterious intruder.', 184, 316, 1, 0, 'https://www.dropbox.com/s/pjl518e2yovhugw/S1E04.mp4?dl=1', '', 'https://www.dropbox.com/s/pjl518e2yovhugw/S1E04.mp4?dl=1', '', 'http://adminview.streamhash.com/uploads/images/video_1132_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1132_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1132_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-05-21 16:23:43', '00:21:21', '00:00:00', '', '', 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-21 06:10:27', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1133, '5-covention60a74f3fee27d', '5. Covention', 'Luz\'s lesson about witch covens goes awry when she finds herself thrust into a witch\'s duel.', 0, '12', 'Luz\'s lesson about witch covens goes awry when she finds herself thrust into a witch\'s duel.', 184, 316, 1, 0, 'https://www.dropbox.com/s/gmgxz1p53t0cdxx/S1E05.mp4?dl=1', '', 'https://www.dropbox.com/s/gmgxz1p53t0cdxx/S1E05.mp4?dl=1', '', 'http://adminview.streamhash.com/uploads/images/video_1133_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1133_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1133_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-05-21 16:12:15', '00:22:06', '00:00:00', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-21 06:12:15', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1134, '6-hootys-moving-hassle60a74fbc348fd', '6. Hooty\'s Moving Hassle', 'When Luz, Willow and Gus accidentally animate the Owl House, the house runs amok around Bonesborough.', 0, '12', 'When Luz, Willow and Gus accidentally animate the Owl House, the house runs amok around Bonesborough.', 184, 316, 1, 0, 'https://www.dropbox.com/s/9hz70owmd1a0zsy/S1E06.mp4?dl=1', '', 'https://www.dropbox.com/s/9hz70owmd1a0zsy/S1E06.mp4?dl=1', '', 'http://adminview.streamhash.com/uploads/images/video_1134_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1134_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1134_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-05-21 16:14:20', '00:22:06', '00:00:00', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-21 06:14:20', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1135, '7-lost-in-language60a750354331f', '7. Lost in Language', 'While checking out the library, Luz\'s pranks lead to unintended consequences.', 0, '12', 'While checking out the library, Luz\'s pranks lead to unintended consequences.', 184, 316, 1, 0, 'https://www.dropbox.com/s/g5re8wkuni1xq24/S1E07.mp4?dl=0', '', 'https://www.dropbox.com/s/g5re8wkuni1xq24/S1E07.mp4?dl=0', '', 'http://adminview.streamhash.com/uploads/images/video_1135_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1135_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1135_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-05-21 16:16:21', '00:22:06', '00:00:00', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-21 06:16:21', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1136, '8-once-upon-a-swap60a752f233a3d', '8. Once Upon a Swap', 'A simple disagreement leads to a complex situation when Eda, King, and Luz triple-down on a wager.', 0, '12', 'A simple disagreement leads to a complex situation when Eda, King, and Luz triple-down on a wager.', 184, 316, 0, 0, 'https://www.dropbox.com/s/jzlmrk3kpv4q7sf/S1E08.mp4?dl=1', '', 'https://www.dropbox.com/s/jzlmrk3kpv4q7sf/S1E08.mp4?dl=1', '', 'http://adminview.streamhash.com/uploads/images/video_1136_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1136_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1136_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-05-21 16:28:02', '00:21:51', '00:00:00', '', '', 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-21 06:18:01', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1137, '9-something-ventured-someone-framed60ac47ab8aefe', '9. Something Ventured, Someone Framed', 'When Gus sneaks Luz into Hexside School to present at the Human Appreciation Society, Luz sees a side of the school she didn\'t expect.', 0, '12', 'When Gus sneaks Luz into Hexside School to present at the Human Appreciation Society, Luz sees a side of the school she didn\'t expect.', 184, 316, 1, 0, 'https://www.dropbox.com/s/53m1f9asgpuxhqh/S1E09.mp4?dl=1', '', 'https://www.dropbox.com/s/53m1f9asgpuxhqh/S1E09.mp4?dl=1', '', 'http://adminview.streamhash.com/uploads/images/video_1137_001.jpg', 'http://adminview.streamhash.com/uploads/images/video_1137_001.jpg', 'http://adminview.streamhash.com/uploads/images/video_1137_001.jpg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-05-25 10:41:15', '00:21:36', '00:00:00', '', '', 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-21 06:28:12', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1138, '10-escape-of-the-palisman60a7543bc6888', '10. Escape of the Palisman', 'When an adventure with Eda\'s staff goes awry, Luz and her friends have to earn the staff back from a mysterious forest creature, or lose the staff forever.', 0, '12', 'When an adventure with Eda\'s staff goes awry, Luz and her friends have to earn the staff back from a mysterious forest creature, or lose the staff forever.', 184, 316, 1, 0, 'https://www.dropbox.com/s/zber2fwas5dj99o/S1E10.mp4?dl=1', '', 'https://www.dropbox.com/s/zber2fwas5dj99o/S1E10.mp4?dl=1', '', 'http://adminview.streamhash.com/uploads/images/video_1138_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1138_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1138_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-05-21 16:33:31', '00:21:48', '00:00:00', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-21 06:33:31', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1139, '11-sense-and-insensitivity60a754a499828', '11. Sense and Insensitivity', 'When King becomes a bestselling author, he learns a valuable lesson in reading the fine print.', 0, '12', 'When King becomes a bestselling author, he learns a valuable lesson in reading the fine print.', 184, 316, 1, 0, 'https://www.dropbox.com/s/dxeq8kswlr1hx65/S1E11.mp4?dl=1', '', 'https://www.dropbox.com/s/dxeq8kswlr1hx65/S1E11.mp4?dl=1', '', 'http://adminview.streamhash.com/uploads/images/video_1139_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1139_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1139_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-05-21 16:35:16', '00:22:20', '00:00:00', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-21 06:35:16', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1140, '12-adventures-in-the-elements60a75518937eb', '12. Adventures in the Elements', 'Luz needs to learn a new spell, so Eda takes her to the most magical place on the island to train.', 0, '12', 'Luz needs to learn a new spell, so Eda takes her to the most magical place on the island to train.', 184, 316, 1, 0, 'https://www.dropbox.com/s/elqa072z4htn1db/S1E12.mp4?dl=1', '', 'https://www.dropbox.com/s/elqa072z4htn1db/S1E12.mp4?dl=1', '', 'http://adminview.streamhash.com/uploads/images/video_1140_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1140_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1140_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-05-21 16:37:12', '00:22:05', '00:00:00', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-21 06:37:12', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1141, '13-the-first-day60a755928792a', '13. The First Day', 'During Luz’s first day of Magic School, curiosity gets the best of her, and she finds herself thrown into the Delinquent Track, where she’s not allowed to learn magic.', 0, '12', 'During Luz’s first day of Magic School, curiosity gets the best of her, and she finds herself thrown into the Delinquent Track, where she’s not allowed to learn magic.', 184, 316, 1, 0, 'https://www.dropbox.com/s/kxeqdbsxeowr16o/S1E13.mp4?dl=1', '', 'https://www.dropbox.com/s/kxeqdbsxeowr16o/S1E13.mp4?dl=1', '', 'http://adminview.streamhash.com/uploads/images/video_1141_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1141_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1141_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-05-21 16:39:14', '00:21:50', '00:00:00', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-21 06:39:14', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1142, '14-really-small-problems60a755f4ae8e6', '14. Really Small Problems', 'King confides in a carnival fortuneteller who makes his dream come true, but it comes at a cost.', 0, '12', 'King confides in a carnival fortuneteller who makes his dream come true, but it comes at a cost.', 184, 316, 1, 0, 'https://www.dropbox.com/s/439bj1ya6nmt3jw/S1E14.mp4?dl=1', '', 'https://www.dropbox.com/s/439bj1ya6nmt3jw/S1E14.mp4?dl=1', '', 'http://adminview.streamhash.com/uploads/images/video_1142_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1142_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1142_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-05-21 16:40:52', '00:21:35', '00:00:00', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-21 06:40:52', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1143, '15-understanding-willow60a75684e211b', '15. Understanding Willow', 'Luz, Willow and Amity take a trip down memory lane.', 0, '12', 'Luz, Willow and Amity take a trip down memory lane.', 184, 316, 1, 0, 'https://www.dropbox.com/s/a2juuead6rb4fg4/S1E15.mp4?dl=1', '', 'https://www.dropbox.com/s/a2juuead6rb4fg4/S1E15.mp4?dl=1', '', 'http://adminview.streamhash.com/uploads/images/video_1143_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1143_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1143_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-05-21 16:43:16', '00:21:50', '00:00:00', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-21 06:43:16', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1144, '16-enchanting-grom-fright60a756f1b45dd', '16. Enchanting Grom Fright', 'Luz experiences Grom, Hexside’s version of Prom, and it’s not what she expects.', 0, '12', 'Luz experiences Grom, Hexside’s version of Prom, and it’s not what she expects.', 184, 316, 1, 0, 'https://www.dropbox.com/s/2ucpy05y49lgsuk/S1E16.mp4?dl=1', '', 'https://www.dropbox.com/s/2ucpy05y49lgsuk/S1E16.mp4?dl=1', '', 'http://adminview.streamhash.com/uploads/images/video_1144_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1144_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1144_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-05-21 16:45:05', '00:21:35', '00:00:00', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-21 06:45:05', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1145, '17-wing-it-like-witches60a7576c92dea', '17. Wing It Like Witches', 'Not your average underdog story.', 0, '12', 'Not your average underdog story.', 184, 316, 1, 0, 'https://www.dropbox.com/s/h5cqs93yvszk859/S1E17.mp4?dl=1', '', 'https://www.dropbox.com/s/h5cqs93yvszk859/S1E17.mp4?dl=1', '', 'http://adminview.streamhash.com/uploads/images/video_1145_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1145_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1145_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-05-21 16:47:08', '00:22:05', '00:00:00', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-21 06:47:08', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1146, '18-agony-of-a-witch60a757e15d9a5', '18. Agony of a Witch', 'On a school field trip to the mysterious Emperor’s Castle, Luz strays from the group and into danger.', 0, '12', 'On a school field trip to the mysterious Emperor’s Castle, Luz strays from the group and into danger.', 184, 316, 1, 0, 'https://www.dropbox.com/s/344sn69e0f7t5e7/S1E18.mp4?dl=1', '', 'https://www.dropbox.com/s/344sn69e0f7t5e7/S1E18.mp4?dl=1', '', 'http://adminview.streamhash.com/uploads/images/video_1146_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1146_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1146_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-05-21 16:49:05', '00:21:05', '00:00:00', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-21 06:49:05', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1147, '19-young-blood-old-souls60a7584f23ead', '19. Young Blood, Old Souls', 'Luz’s skills as a witch are put to the test when she attempts the impossible.', 0, '12', 'Luz’s skills as a witch are put to the test when she attempts the impossible.', 184, 316, 1, 0, 'https://www.dropbox.com/s/7ur435ret7k1qn6/S1E19.mp4?dl=1', '', 'https://www.dropbox.com/s/7ur435ret7k1qn6/S1E19.mp4?dl=1', '', 'http://adminview.streamhash.com/uploads/images/video_1147_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1147_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1147_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-05-21 16:50:55', '00:21:50', '00:00:00', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-21 06:50:55', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1150, '1-pilot60ae2aa660ea4', '1. Pilot', 'The Pilot Episode Of Our Second Series "Meru The Succubus" Features The Demon Succubus, Meru, Who Is Thirsting For Revenge Towards The Priest Who Took Away Her Powers! She Has Swore To Find The Perfect Host To Permanently Possess!', 0, '18', 'Meru the Succubus hunts for her first victim!', 235, 319, 0, 0, 'https://www.dropbox.com/s/30c8w4d3jeauyw8/Pilot.mp4?dl=1', '', 'https://www.dropbox.com/s/30c8w4d3jeauyw8/Pilot.mp4?dl=1', '', 'http://adminview.streamhash.com/uploads/images/video_1150_001.png', 'http://adminview.streamhash.com/uploads/images/video_mobile_1150_001.png', 'http://adminview.streamhash.com/uploads/images/video_1150_001.png', '', '', '', '5', '', '1', '1', 0, 0, 0, 'admin', '2021-05-26 21:01:58', '00:09:03', '00:00:00', '', '', 6, 6, 6, '', '', 'admin', 'Admin', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-26 10:59:35', '2021-06-04 17:59:42', 3, 0, 0, '', '', '', ''),
(1151, 'troopers-vs-social-media60aed54254dad', 'Troopers vs. Social Media', 'Rich And Larry Explore Parallelogram, The Galaxy\'s Hottest New Social Media App.', 0, '12', 'Rich And Larry Explore Parallelogram, The Galaxy\'s Hottest New Social Media App.', 184, 320, 0, 0, 'https://www.dropbox.com/s/9s2hk1t9fmwtgrl/Troopers%20vs.%20Social%20Media.mp4?dl=1', '', 'https://www.dropbox.com/s/9s2hk1t9fmwtgrl/Troopers%20vs.%20Social%20Media.mp4?dl=1', '', 'http://adminview.streamhash.com/uploads/images/video_1151_001.jpg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1151_001.jpg', 'http://adminview.streamhash.com/uploads/images/video_1151_001.jpg', '', '', '', '5', '', '1', '1', 0, 0, 0, 'admin', '2021-05-27 09:09:54', '00:02:33', '00:00:00', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-26 23:09:54', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1152, 'the-founder60af580237eb0', 'The Founder', 'The true story of how Ray Kroc, a salesman from Illinois, met Mac and Dick McDonald, who were running a burger operation in 1950s Southern California. Kroc was impressed by the brothers’ speedy system of making the food and saw franchise potential. He maneuvered himself into a position to be able to pull the company from the brothers and create a billion-dollar empire.', 0, '16', 'Risk taker. Rule breaker. Game changer.', 221, 321, 0, 0, 'https://www.dropbox.com/s/9cypuxa3jxa6su3/The%20Founder%20%282016%29.mp4?dl=1', '', 'https://www.youtube.com/watch?v=oprJX5BomEc', '', 'http://adminview.streamhash.com/uploads/images/video_1152_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1152_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1152_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-05-27 18:27:46', '01:55:19', '00:02:05', '', NULL, 6, 6, 6, '', '', 'admin', 'Admin', 0, 0, 0, 0, 0, 0.00, 5.00, 0.00, '2021-05-27 08:27:46', '2021-06-04 18:00:57', 3, 0, 0, '', '', '', ''),
(1153, 'troopers-vs-teleporter60b1a16c67109', 'Troopers vs. Teleporter', 'UberEats in space doesn\'t work quite as nicely.', 0, '12', 'UberEats in space doesn\'t work quite as nicely.', 184, 320, 0, 0, 'https://www.youtube.com/watch?v=4crycL-H1yY', '', 'https://www.youtube.com/watch?v=4crycL-H1yY', '', 'http://adminview.streamhash.com/uploads/images/video_1153_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1153_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1153_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-05-29 12:05:32', '00:02:47', '00:00:00', '', NULL, 6, 6, 6, '', '', 'admin', '', 1, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-29 02:05:32', '2021-06-04 17:59:48', 3, 0, 0, '', '', '', ''),
(1156, 'cruella60b3045db9b69', 'Cruella', 'In 1970s London amidst the punk rock revolution, a young grifter named Estella is determined to make a name for herself with her designs. She befriends a pair of young thieves who appreciate her appetite for mischief, and together they are able to build a life for themselves on the London streets. One day, Estella’s flair for fashion catches the eye of the Baroness von Hellman, a fashion legend who is devastatingly chic and terrifyingly haute. But their relationship sets in motion a course of events and revelations that will cause Estella to embrace her wicked side and become the raucous, fashionable and revenge-bent Cruella.', 0, '16', 'Hello Cruel World', 176, 323, 0, 0, 'https://www.dropbox.com/s/akcn3gs31z9ulpp/Cruella%202021.mp4?dl=1', '', 'https://www.youtube.com/watch?v=gmRKv7n2If8', '', 'http://adminview.streamhash.com/uploads/images/video_1156_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1156_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1156_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-05-30 13:19:57', '02:13:55', '00:01:32', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-30 03:19:57', '2021-06-04 18:00:31', 3, 0, 0, '', '', '', ''),
(1158, 'friends-the-reunion60b30d9fae0c7', 'Friends: The Reunion', 'The cast of Friends reunites for a once-in-a-lifetime celebration of the hit series, an unforgettable evening filled with iconic memories, uncontrollable laughter, happy tears, and special guests.', 0, '12', 'The One Where They Get Back Together', 176, 324, 0, 0, 'https://www.dropbox.com/s/uixiyx2r3nimyiz/Friends%20the%20Reunion.mp4?dl=1', '', 'https://www.youtube.com/watch?v=HRXVQ77ehRQ', '', 'http://adminview.streamhash.com/uploads/images/video_1158_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1158_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1158_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-05-30 13:59:27', '01:43:50', '00:02:10', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-30 03:59:27', '2021-06-04 18:00:31', 3, 0, 0, '', '', '', ''),
(1159, 'class-action-park60b3122d10f98', 'Class Action Park', 'Class Action Park explores the legend, legacy, and truth behind the 1980\'s water park in Vernon, New Jersey that long ago entered the realm of myth. Known for its dangerous, unsupervised rides and lack of regulation, guests of Action Park expected to walk away with injuries and were lucky if they made it out alive. Shirking the trappings of nostalgia, the film uses investigative journalism, original animations, recordings, and interviews with the people who lived it to reveal the true story of Action Park.', 0, '16', 'Class Action Park explores the legend, legacy, and truth behind the 1980\'s water park in Vernon, New Jersey that long ago entered the realm of myth. Known for its dangerous, unsupervised rides and lack of regulation, guests of Action Park expected to walk away with injuries and were lucky if they made it out alive. Shirking the trappings of nostalgia, the film uses investigative journalism, original animations, recordings, and interviews with the people who lived it to reveal the true story of Action Park.', 238, 325, 0, 0, 'https://www.dropbox.com/s/i1c6jnpk08ninti/Class%20Action%20Park.mp4?dl=1', '', 'https://www.youtube.com/watch?v=c9TACAdTiCc', '', 'http://adminview.streamhash.com/uploads/images/video_1159_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1159_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1159_001.jpeg', '', '', '', '5', '', '1', '0', 0, 0, 0, 'admin', '2021-05-30 14:18:53', '01:29:10', '00:02:33', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-05-30 04:18:53', '2021-06-04 17:59:36', 3, 0, 0, '', '', '', ''),
(1167, 'dynoman-and-the-volt60b7350d473a0', 'Dynoman and the Volt', 'An awkward young boy and his grandfather are transformed by the arrival of a mysterious ring ordered from a comic book 60 years ago.', 0, '16', 'One tale. Infinite imagination.', 172, 332, 0, 0, 'https://www.dropbox.com/s/uk72bzh7enjian6/Dynoman%20and%20The%20Volt.mp4?dl=1', '', 'https://www.dropbox.com/s/uk72bzh7enjian6/Dynoman%20and%20The%20Volt.mp4?dl=1', '', 'http://adminview.streamhash.com/uploads/images/video_1167_001.jpg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1167_001.png', 'http://adminview.streamhash.com/uploads/images/video_1167_001.jpg', '', 'http://adminview.streamhash.com/uploads/images/SV-2021-06-02-12-48-09-44d22290f3df26cc20f8c748ea1a3339d64fccb0.png', 'http://adminview.streamhash.com/uploads/images/SV-2021-06-02-12-48-09-9a76ccbb6894f943bf0964bc9aef5c1926ab927b.png', '4', '', '1', '1', 0, 0, 1, 'admin', '2021-06-02 17:36:45', '00:45:16', '00:00:00', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-06-02 07:36:45', '2021-06-04 18:00:27', 3, 0, 0, '', '', '', ''),
(1168, '2-episode-260b9d40d735ec', '2. Episode 2', 'Meru attends her host\'s school and finds the perfect boy needed for her to maintain a permanent possession! Unfortunately, other students aren\'t going to make it so easy for her!!', 0, '18', 'the second episode "Meru the Succubus"!', 235, 319, 0, 0, 'https://www.dropbox.com/s/dhrtfqxugjyif4j/2.%20Episode%202.mp4?dl=1', '', 'https://www.dropbox.com/s/dhrtfqxugjyif4j/2.%20Episode%202.mp4?dl=1', '', 'http://adminview.streamhash.com/uploads/images/video_1168_001.png', 'http://adminview.streamhash.com/uploads/images/video_mobile_1168_001.png', 'http://adminview.streamhash.com/uploads/images/video_1168_001.png', '', '', '', '5', '', '1', '1', 0, 0, 0, 'admin', '2021-06-04 17:19:41', '00:11:47', '00:00:00', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-06-04 07:19:41', '2021-06-04 17:59:42', 3, 0, 0, '', '', '', ''),
(1169, 'queen-of-hearts-dronningen-201960ba6c2562e52', 'Queen of hearts (Dronningen) 2019', 'Queen of hearts (Dronningen) 2019', 0, '10', 'Queen of hearts (Dronningen) 2019', 237, 330, 0, 0, 'https://www.youtube.com/watch?v=YISLlurF2GA', '', 'https://www.youtube.com/watch?v=YISLlurF2GA', '', 'http://adminview.streamhash.com/uploads/images/video_1169_001.jpg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1169_001.jpg', 'http://adminview.streamhash.com/uploads/images/video_1169_001.jpg', '', '', '', '5', '', '1', '0', 1, 0, 0, 'admin', '2021-06-04 23:38:37', '01:01:01', '00:00:10', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-06-04 18:08:37', '2021-06-04 18:08:37', 2, 0, 0, '', '', '', ''),
(1170, 'alita-battle-angel-2-2021-movie-trailer-concept60ba6d14319c0', 'Alita: Battle Angel 2 | (2021) Movie Trailer Concept', 'Alita: Battle Angel 2 | (2021) Movie Trailer Concept', 0, '10', 'Alita: Battle Angel 2 | (2021) Movie Trailer Concept', 239, 333, 0, 0, 'https://www.youtube.com/watch?v=XGNwUD02gAA', '', 'https://www.youtube.com/watch?v=XGNwUD02gAA', '', 'http://adminview.streamhash.com/uploads/images/video_1170_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1170_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1170_001.jpeg', '', '', '', '5', '', '1', '0', 1, 0, 0, 'admin', '2021-06-04 23:42:36', '01:01:01', '00:10:01', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-06-04 18:12:36', '2021-06-04 18:12:36', 2, 0, 0, '', '', '', ''),
(1171, 'the-superdeep-2020-russian-movie-trailer60ba6d801b7a3', 'The Superdeep 2020 | Russian movie trailer', 'The Superdeep 2020 | Russian movie trailer', 0, '16', 'The Superdeep 2020 | Russian movie trailer', 239, 333, 0, 0, 'https://www.youtube.com/watch?v=ZPlaCcty0-k', '', 'https://www.youtube.com/watch?v=ZPlaCcty0-k', '', 'http://adminview.streamhash.com/uploads/images/video_1171_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1171_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1171_001.jpeg', '', 'http://adminview.streamhash.com/uploads/images/SV-2021-06-04-18-14-41-5df5b27b6c55796e26ca1ec1ac1f493cd29809a3.jpeg', 'http://adminview.streamhash.com/uploads/images/SV-2021-06-04-18-14-41-41c086eb33b24cc9e41f646cb7fcf968db9ae56d.jpeg', '5', '', '1', '0', 1, 0, 1, 'admin', '2021-06-04 23:44:24', '00:10:20', '00:01:01', '', NULL, 6, 6, 6, '', '', 'admin', '', 1, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-06-04 18:14:24', '2021-06-05 01:57:32', 2, 0, 0, '', '', '', ''),
(1172, 'sanju-official-trailer-in-cinemas-june-2860ba6df38deb5', 'Sanju | Official Trailer | In Cinemas June 28', 'Sanju | Official Trailer | In Cinemas June 28', 0, '10', 'Sanju | Official Trailer | In Cinemas June 28', 239, 333, 0, 0, 'https://www.youtube.com/watch?v=jHuZloiiNE4', '', 'https://www.youtube.com/watch?v=jHuZloiiNE4', '', 'http://adminview.streamhash.com/uploads/images/video_1172_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1172_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1172_001.jpeg', '', '', '', '5', '', '1', '0', 1, 0, 0, 'admin', '2021-06-04 23:46:19', '02:02:00', '00:00:10', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-06-04 18:16:19', '2021-06-04 18:16:19', 2, 0, 0, '', '', '', ''),
(1173, '5th-passenger-official-trailer60ba6e8536473', '5th Passenger | Official Trailer', 'The year: 2151. In the aftermath of an oppressive class war, Miller, a pregnant officer aboard an escape pod must struggle to survive with her remaining crew when a mysterious and vicious life form attacks, determined to become the dominant species. Don’t miss 5th Passenger, Available On Demand July 10th.', 0, '10', 'The year: 2151. In the aftermath of an oppressive class war, Miller, a pregnant officer aboard an escape pod must struggle to survive with her remaining crew when a mysterious and vicious life form attacks, determined to become the dominant species. Don’t miss 5th Passenger, Available On Demand July 10th.', 239, 333, 0, 0, 'https://www.youtube.com/watch?v=vEZGWQSApak', '', 'https://www.youtube.com/watch?v=vEZGWQSApak', '', 'http://adminview.streamhash.com/uploads/images/video_1173_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_mobile_1173_001.jpeg', 'http://adminview.streamhash.com/uploads/images/video_1173_001.jpeg', '', '', '', '5', '', '1', '0', 1, 0, 0, 'admin', '2021-06-04 23:48:45', '01:00:00', '00:10:00', '', NULL, 6, 6, 6, '', '', 'admin', '', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, '2021-06-04 18:18:45', '2021-06-04 18:18:45', 2, 0, 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `admin_video_images`
--

CREATE TABLE `admin_video_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_video_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_default` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_video_images`
--

INSERT INTO `admin_video_images` (`id`, `admin_video_id`, `image`, `is_default`, `position`, `created_at`, `updated_at`) VALUES
(199, 100, 'http://adminview.streamhash.com/uploads/images/b8478f23a43d403b156fd58407bf1062f521a177.JPG', 0, 2, '2018-05-17 12:30:06', '2018-05-17 12:30:06'),
(200, 100, 'http://adminview.streamhash.com/uploads/images/2f789e7995f5cc297023193e4887befca4397aec.JPG', 0, 3, '2018-05-17 12:30:06', '2018-05-17 12:30:06'),
(211, 106, 'http://adminview.streamhash.com/uploads/images/e34ac26a6d34748cc9eccc5b63c197f08dfc713a.jpg', 0, 2, '2018-05-22 04:55:02', '2018-05-22 04:55:02'),
(212, 106, 'http://adminview.streamhash.com/uploads/images/08e4004d7db35971ce9fad9158a901a9b05bfdfc.jpg', 0, 3, '2018-05-22 04:55:02', '2018-05-22 04:55:02'),
(277, 139, 'http://adminview.streamhash.com/uploads/images/c83eca04a48c41502a2d69d0a52d12cbb6b008d6.png', 0, 2, '2018-06-09 21:02:05', '2018-06-09 21:02:05'),
(278, 139, 'http://adminview.streamhash.com/uploads/images/a4b74357492630269ae5f18e3cf87a17b25dc783.jpg', 0, 3, '2018-06-09 21:02:06', '2018-06-09 21:02:06'),
(279, 140, 'http://adminview.streamhash.com/uploads/images/5e8fcc5ac66b8687a288964c059cbedd83afe2fe.jpg', 0, 2, '2018-06-10 07:45:28', '2018-06-10 07:45:28'),
(280, 140, 'http://adminview.streamhash.com/uploads/images/74c6e79b63b4b9ef1820177295196a23161524eb.jpg', 0, 3, '2018-06-10 07:45:28', '2018-06-10 07:45:28'),
(281, 141, 'http://adminview.streamhash.com/uploads/images/d8be3a12933c616670bb2d6f83b89dd4b51e185f.png', 0, 2, '2018-06-10 12:45:33', '2018-06-10 12:45:33'),
(282, 141, 'http://adminview.streamhash.com/uploads/images/cb843261fda51a41cef5c19848af806b357ccfd5.png', 0, 3, '2018-06-10 12:45:33', '2018-06-10 12:45:33'),
(285, 143, 'http://adminview.streamhash.com/uploads/images/ba510c8822f165124be5ecabacc755c60dfba4c0.jpg', 0, 2, '2018-06-13 11:18:41', '2018-06-13 11:18:41'),
(286, 143, 'http://adminview.streamhash.com/uploads/images/2ad2cc411cd615daadfee406a112289a57124a59.jpg', 0, 3, '2018-06-13 11:18:41', '2018-06-13 11:18:41'),
(343, 176, 'http://adminview.streamhash.com/uploads/images/-2018-07-17-10-59-08-f1bb55a980569b20dbd7f6d13ae6256f08a02ae0.png', 0, 2, '2018-07-17 10:59:08', '2018-07-17 10:59:08'),
(344, 176, 'http://adminview.streamhash.com/uploads/images/-2018-07-17-10-59-08-30160cf07a91af7a66db01be0a5fc7ff7c723440.png', 0, 3, '2018-07-17 10:59:08', '2018-07-17 10:59:08'),
(347, 178, 'http://adminview.streamhash.com/uploads/images/-2018-07-19-17-34-34-ad8ceea6dec79ae0bc4c5138584f324e4d975e6d.png', 0, 2, '2018-07-19 17:34:34', '2018-07-19 17:34:34'),
(348, 178, 'http://adminview.streamhash.com/uploads/images/-2018-07-19-17-34-34-2e69cb9d528b03531c1c7341962d9be8626306f8.png', 0, 3, '2018-07-19 17:34:34', '2018-07-19 17:34:34'),
(351, 180, 'http://adminview.streamhash.com/uploads/images/-2018-07-21-06-54-18-442218dd3aca84ce723587588189e069fa4d820b.png', 0, 2, '2018-07-21 06:54:18', '2018-07-21 06:54:18'),
(352, 180, 'http://adminview.streamhash.com/uploads/images/-2018-07-21-06-54-18-a22a0fd17f5a2ff3f75c5e3d72c9db4a4bdc52ee.png', 0, 3, '2018-07-21 06:54:18', '2018-07-21 06:54:18'),
(353, 183, 'http://adminview.streamhash.com/uploads/images/-2018-07-24-05-28-46-2d023db72939a2ef7ba653423873e505a61f077f.png', 0, 2, '2018-07-24 05:28:46', '2018-07-24 05:28:46'),
(354, 183, 'http://adminview.streamhash.com/uploads/images/-2018-07-24-05-28-46-1d631c943701091cb35bb67e8299957490b783f2.png', 0, 3, '2018-07-24 05:28:46', '2018-07-24 05:28:46'),
(367, 190, 'http://adminview.streamhash.com/uploads/images/-2018-07-30-22-03-35-c9144b55b45da504bc191bd44c5cfdffff5e10b6.png', 0, 2, '2018-07-30 22:03:35', '2018-07-30 22:03:35'),
(368, 190, 'http://adminview.streamhash.com/uploads/images/-2018-07-30-22-03-35-667e63bef82ac3fb4b8189b0e3f55132058ac1f6.png', 0, 3, '2018-07-30 22:03:35', '2018-07-30 22:03:35'),
(371, 192, 'http://adminview.streamhash.com/uploads/images/-2018-07-31-12-36-57-8bbd6000434b9d53fed54c251cd2f98f795232d9.png', 0, 2, '2018-07-31 12:36:57', '2018-07-31 12:36:57'),
(372, 192, 'http://adminview.streamhash.com/uploads/images/-2018-07-31-12-36-57-24f3fcab8fc918a51c68c39a034f54610c7b22aa.png', 0, 3, '2018-07-31 12:36:57', '2018-07-31 12:36:57'),
(399, 206, 'http://adminview.streamhash.com/uploads/images/video_206_002.jpg', 0, 2, '2018-08-10 04:45:37', '2018-08-10 04:45:37'),
(400, 206, 'http://adminview.streamhash.com/uploads/images/video_206_003.jpg', 0, 3, '2018-08-10 04:45:37', '2018-08-10 04:45:37'),
(733, 373, 'http://adminview.streamhash.com/uploads/images/video_373_002.png', 0, 2, '2019-02-12 13:43:07', '2019-02-12 13:43:07'),
(734, 373, 'http://adminview.streamhash.com/uploads/images/video_373_003.png', 0, 3, '2019-02-12 13:43:07', '2019-02-12 13:43:07'),
(993, 504, 'http://adminview.streamhash.com/uploads/images/video_504_002.png', 0, 2, '2019-12-13 10:13:23', '2019-12-13 10:13:23'),
(994, 504, 'http://adminview.streamhash.com/uploads/images/video_504_003.png', 0, 3, '2019-12-13 10:13:23', '2019-12-13 10:13:23'),
(995, 505, 'http://adminview.streamhash.com/uploads/images/video_505_002.png', 0, 2, '2019-12-13 10:18:37', '2019-12-13 10:18:37'),
(996, 505, 'http://adminview.streamhash.com/uploads/images/video_505_003.png', 0, 3, '2019-12-13 10:18:37', '2019-12-13 10:18:37'),
(997, 506, 'http://adminview.streamhash.com/uploads/images/video_506_002.png', 0, 2, '2019-12-13 10:22:10', '2019-12-13 10:22:10'),
(998, 506, 'http://adminview.streamhash.com/uploads/images/video_506_003.png', 0, 3, '2019-12-13 10:22:10', '2019-12-13 10:22:10'),
(999, 507, 'http://adminview.streamhash.com/uploads/images/video_507_002.png', 0, 2, '2019-12-13 10:33:58', '2019-12-13 10:33:58'),
(1000, 507, 'http://adminview.streamhash.com/uploads/images/video_507_003.png', 0, 3, '2019-12-13 10:33:58', '2019-12-13 10:33:58'),
(1065, 540, 'http://adminview.streamhash.com/uploads/images/video_540_002.png', 0, 2, '2020-02-06 06:25:49', '2020-02-06 06:25:49'),
(1066, 540, 'http://adminview.streamhash.com/uploads/images/video_540_003.png', 0, 3, '2020-02-06 06:25:49', '2020-02-06 06:25:49'),
(1067, 541, 'http://adminview.streamhash.com/uploads/images/video_541_002.png', 0, 2, '2020-02-06 06:40:48', '2020-02-06 06:40:48'),
(1068, 541, 'http://adminview.streamhash.com/uploads/images/video_541_003.png', 0, 3, '2020-02-06 06:40:48', '2020-02-06 06:40:48'),
(1071, 543, 'http://adminview.streamhash.com/uploads/images/video_543_002.png', 0, 2, '2020-02-06 06:46:15', '2020-02-06 06:46:15'),
(1072, 543, 'http://adminview.streamhash.com/uploads/images/video_543_003.png', 0, 3, '2020-02-06 06:46:15', '2020-02-06 06:46:15'),
(1073, 544, 'http://adminview.streamhash.com/uploads/images/video_544_002.png', 0, 2, '2020-02-06 07:40:43', '2020-02-06 07:40:43'),
(1074, 544, 'http://adminview.streamhash.com/uploads/images/video_544_003.png', 0, 3, '2020-02-06 07:40:43', '2020-02-06 07:40:43'),
(1075, 545, 'http://adminview.streamhash.com/uploads/images/video_545_002.png', 0, 2, '2020-02-06 07:48:59', '2020-02-06 07:48:59'),
(1076, 545, 'http://adminview.streamhash.com/uploads/images/video_545_003.png', 0, 3, '2020-02-06 07:48:59', '2020-02-06 07:48:59'),
(1077, 546, 'http://adminview.streamhash.com/uploads/images/video_546_002.png', 0, 2, '2020-02-06 09:00:53', '2020-02-06 09:00:53'),
(1078, 546, 'http://adminview.streamhash.com/uploads/images/video_546_003.png', 0, 3, '2020-02-06 09:00:53', '2020-02-06 09:00:53'),
(1079, 547, 'http://adminview.streamhash.com/uploads/images/video_547_002.png', 0, 2, '2020-02-06 09:23:12', '2020-02-06 09:23:12'),
(1080, 547, 'http://adminview.streamhash.com/uploads/images/video_547_003.png', 0, 3, '2020-02-06 09:23:12', '2020-02-06 09:23:12'),
(1081, 548, 'http://adminview.streamhash.com/uploads/images/video_548_002.png', 0, 2, '2020-02-06 09:30:21', '2020-02-06 09:30:21'),
(1082, 548, 'http://adminview.streamhash.com/uploads/images/video_548_003.png', 0, 3, '2020-02-06 09:30:21', '2020-02-06 09:30:21'),
(1083, 549, 'http://adminview.streamhash.com/uploads/images/video_549_002.png', 0, 2, '2020-02-06 09:35:00', '2020-02-06 09:35:00'),
(1084, 549, 'http://adminview.streamhash.com/uploads/images/video_549_003.png', 0, 3, '2020-02-06 09:35:00', '2020-02-06 09:35:00'),
(1085, 550, 'http://adminview.streamhash.com/uploads/images/video_550_002.png', 0, 2, '2020-02-06 09:43:54', '2020-02-06 09:43:54'),
(1086, 550, 'http://adminview.streamhash.com/uploads/images/video_550_003.png', 0, 3, '2020-02-06 09:43:54', '2020-02-06 09:43:54'),
(1087, 551, 'http://adminview.streamhash.com/uploads/images/video_551_002.jpg', 0, 2, '2020-02-06 09:48:27', '2020-02-06 09:48:27'),
(1088, 551, 'http://adminview.streamhash.com/uploads/images/video_551_003.jpg', 0, 3, '2020-02-06 09:48:27', '2020-02-06 09:48:27'),
(1089, 552, 'http://adminview.streamhash.com/uploads/images/video_552_002.png', 0, 2, '2020-02-06 09:49:46', '2020-02-06 09:49:46'),
(1090, 552, 'http://adminview.streamhash.com/uploads/images/video_552_003.png', 0, 3, '2020-02-06 09:49:46', '2020-02-06 09:49:46'),
(1091, 553, 'http://adminview.streamhash.com/uploads/images/video_553_002.png', 0, 2, '2020-02-06 10:00:24', '2020-02-06 10:00:24'),
(1092, 553, 'http://adminview.streamhash.com/uploads/images/video_553_003.png', 0, 3, '2020-02-06 10:00:24', '2020-02-06 10:00:24'),
(1093, 554, 'http://adminview.streamhash.com/uploads/images/video_554_002.png', 0, 2, '2020-02-06 10:37:51', '2020-02-06 10:37:51'),
(1094, 554, 'http://adminview.streamhash.com/uploads/images/video_554_003.png', 0, 3, '2020-02-06 10:37:51', '2020-02-06 10:37:51'),
(1095, 555, 'http://adminview.streamhash.com/uploads/images/video_555_002.png', 0, 2, '2020-02-06 10:43:28', '2020-02-06 10:43:28'),
(1096, 555, 'http://adminview.streamhash.com/uploads/images/video_555_003.png', 0, 3, '2020-02-06 10:43:28', '2020-02-06 10:43:28'),
(1097, 556, 'http://adminview.streamhash.com/uploads/images/video_556_002.png', 0, 2, '2020-02-06 10:50:28', '2020-02-06 10:50:28'),
(1098, 556, 'http://adminview.streamhash.com/uploads/images/video_556_003.png', 0, 3, '2020-02-06 10:50:28', '2020-02-06 10:50:28'),
(1099, 557, 'http://adminview.streamhash.com/uploads/images/video_557_002.png', 0, 2, '2020-02-06 10:58:23', '2020-02-06 10:58:23'),
(1100, 557, 'http://adminview.streamhash.com/uploads/images/video_557_003.png', 0, 3, '2020-02-06 10:58:23', '2020-02-06 10:58:23'),
(1101, 558, 'http://adminview.streamhash.com/uploads/images/video_558_002.png', 0, 2, '2020-02-06 11:14:59', '2020-02-06 11:14:59'),
(1102, 558, 'http://adminview.streamhash.com/uploads/images/video_558_003.png', 0, 3, '2020-02-06 11:14:59', '2020-02-06 11:14:59'),
(1103, 559, 'http://adminview.streamhash.com/uploads/images/video_559_002.png', 0, 2, '2020-02-06 13:10:46', '2020-02-06 13:10:46'),
(1104, 559, 'http://adminview.streamhash.com/uploads/images/video_559_003.png', 0, 3, '2020-02-06 13:10:46', '2020-02-06 13:10:46');

-- --------------------------------------------------------

--
-- Table structure for table `admin_video_subtitles`
--

CREATE TABLE `admin_video_subtitles` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_video_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_four` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `month` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `card_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_default` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `user_id`, `customer_id`, `last_four`, `month`, `year`, `card_token`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 1, 'cus_JcDQMg1t3a41jl', '4242', '4', '2024', 'card_1IyyzGK3Y96PKCCvLwjVdkzu', 1, '2021-06-05 12:52:28', '2021-06-05 12:53:08'),
(2, 1, 'cus_JcDQRWVS3JSBKC', '5556', '12', '2033', 'card_1IyyzgK3Y96PKCCvr0Ee8O08', 0, '2021-06-05 12:52:54', '2021-06-05 12:52:54'),
(3, 1, 'cus_JcDQJnhqijbh4H', '3222', '1', '2052', 'card_1IyyzsK3Y96PKCCvwjKI5Gy1', 0, '2021-06-05 12:53:05', '2021-06-05 12:53:05'),
(4, 2, 'cus_JcDS6gjxTX7orz', '4242', '4', '2024', 'card_1Iyz19K3Y96PKCCvVZL8QYPe', 1, '2021-06-05 12:54:25', '2021-06-05 12:54:25'),
(5, 4, 'cus_JcDTizIgDCX8OD', '4242', '4', '2025', 'card_1Iyz2TK3Y96PKCCvvgqKaie4', 1, '2021-06-05 12:55:47', '2021-06-05 12:55:47'),
(6, 5, 'cus_JcDUpinOE2jqR5', '4242', '4', '2027', 'card_1Iyz3dK3Y96PKCCvpVB0qUpO', 1, '2021-06-05 12:56:58', '2021-06-05 12:56:58'),
(7, 7, 'cus_JcDWim2RcLSgaV', '4242', '4', '2027', 'card_1Iyz4xK3Y96PKCCvstMlUTFl', 1, '2021-06-05 12:58:21', '2021-06-05 12:58:21');

-- --------------------------------------------------------

--
-- Table structure for table `cast_crews`
--

CREATE TABLE `cast_crews` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cast_crews`
--

INSERT INTO `cast_crews` (`id`, `unique_id`, `name`, `image`, `description`, `status`, `created_at`, `updated_at`) VALUES
(21, 'Chris-Hemsworth5eaf2377e1abd', 'Chris Hemsworth', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-05-03-20-03-03-d0fefc3f86eff3aad6bcd4141aa35a201e77d369.jpg', '<p>Chris Hemsworth was born in Melbourne, Australia, to Leonie (van Os), a teacher of English, and Craig Hemsworth, a social-services counselor. His brothers are actors <a href="https://www.imdb.com/name/nm2955013?ref_=nmbio_mbio">Liam Hemsworth</a> and <a href="https://www.imdb.com/name/nm1292661?ref_=nmbio_mbio">Luke Hemsworth</a>. He is of Dutch (from his immigrant maternal grandfather), Irish, English, Scottish, and German ancestry. His uncle, by marriage, was Rod Ansell, the bushman who inspired the film <a href="https://www.imdb.com/title/tt0090555?ref_=nmbio_mbio">Crocodile Dundee</a> (1986).<br />\r\n<br />\r\nChris saw quite a bit of the country in his youth, after his family moved to the Northern Territory before finally settling on Phillip Island, to the south of Melbourne. In 2004, he unsuccessfully auditioned for the role of Robbie Hunter in the Australian soap opera <a href="https://www.imdb.com/title/tt0094481?ref_=nmbio_mbio">Home and Away</a> (1988) but was recalled for the role of Kim Hyde which he played until 2007. In 2006, he entered the Australian version of <a href="https://www.imdb.com/title/tt0434676?ref_=nmbio_mbio">Dancing with the Stars</a> (2004) and his popularity in the soap enabled him to hang on until show 7 (<a href="https://www.imdb.com/title/tt0899610?ref_=nmbio_mbio">Dancing with the Stars: Episode #5.7</a> (2006) when he became the fifth contestant to be eliminated.<br />\r\n<br />\r\nHis first Hollywood appearance was in <a href="https://www.imdb.com/title/tt0796366?ref_=nmbio_mbio">Star Trek</a> (2009), but it was his titular role in <a href="https://www.imdb.com/title/tt0800369?ref_=nmbio_mbio">Thor</a> (2011) which propelled him to prominence worldwide. He reprised the character in the science fiction blockbuster <a href="https://www.imdb.com/title/tt0848228?ref_=nmbio_mbio">The Avengers</a> (2012).<br />\r\n<br />\r\nChris&#39;s American representative, management company ROAR, also manages actress <a href="https://www.imdb.com/name/nm0665235?ref_=nmbio_mbio">Elsa Pataky</a>, and it was through them that the two met, marrying in 2010. The couple have a daughter and twin sons.</p>\r\n', 0, '2020-05-03 20:02:21', '2020-07-08 12:08:56'),
(22, 'Randeep-Hooda5eaf2391c2827', 'Randeep Hooda', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-05-03-20-03-29-7fa2a4ec9628f511cd465932dbf9b86c11fdae90.jpg', '<p>Randeep Hooda was born in a small village called Daseya in the Rohtak district of Haryana. His mother, Asha Hooda, is a BJP politician and his father is a surgeon by profession. He did schooling from Delhi Public School before moving to Australia for higher studies. He is Bachelors in Marketing &amp; Human Resource Management.<br />\r\n<br />\r\nHe made his film debut in Monsoon Wedding (2001) where he plays NRI (Non Resident Indian). He got the role in Monsoon Wedding primarily because of his Australian accent rather then his acting skills or good looks.<br />\r\n<br />\r\nHowever even after a powerful performance in Monsoon Wedding he had to wait for 4 years to get a second project. He finally got lucky and Ramgopal Verma cast him as lead in a gangster flick &quot;D&quot; (2005). &quot;D&quot; was a turning point in his career and he suddenly became a household name across the country. The &quot;D&quot; which supposedly portrays Dawood Ibrahim&#39;s real life gave Randeep Hooda a grand entry into tinsel town.<br />\r\n<br />\r\nRecently he got the lead role in &quot;Karma, Confessions and Holi&quot; (2006) produced by Drena De Niro.</p>\r\n\r\n<p><em>- IMDb Mini Biography By: <a href="https://www.imdb.com/search/name?bio_author=Atul%20Jhajhria&amp;view=simple&amp;sort=alpha" name="ba"> Atul Jhajhria </a> </em></p>\r\n\r\n<p>Randeep Hooda is an actor based out of Mumbai, India. He made his debut with Mira Nair&#39;s &quot;Monsoon Wedding,&quot; and subsequently went on to become a relevant player in the Hindi film industry with an interesting body of work.<br />\r\n<br />\r\nAfter his initial success with &quot;Monsoon Wedding,&quot; Randeep was cast as the male lead in Ram Gopal Varma&#39;s gritty gangster film D, allegedly based on the life of Dawood Ibrahim. His performance in the film received positive reviews.<br />\r\n<br />\r\nSoon after, Randeep&#39;s career expanded with lead roles in films such as Darna Zaroori Hain, Risk, Ru Ba Ru, Mere Khwabon Mein Jo Aaye, and Love Khichdi. He has also starred in an international production titled, Karma Aur Holi, which revealed his universal appeal on a global scale. Outside films, Randeep is actively involved with the leading theatre group - Motley, founded by noteworthy Indian actor - Naseerudin Shah, his mentor.<br />\r\n<br />\r\nMost recently, his performance was highlighted in the partially fictionalized 2010 blockbuster film, &quot;Once Upon A Time in Mumbai,&quot; in which he played an honest cop who inadvertently gives rise to Dawood Ibrahim, one of India&#39;s most infamous underworld crime lords. His performance in the film was appreciated by critics and proved to be a turning point in his career. The film emerged as a critical and commercial success, earning over 78 crore (US$14.2 million) in India. Hooda later attributed his success to the film. The film went on to receive nominations for Best Picture at all major award functions.<br />\r\n<br />\r\nThe following year, Hooda featured in Tigmanshu Dhulia&#39;s romantic thriller Saheb, Biwi Aur Gangster with Jimmy Shergill and Mahie Gill. Upon release, the film and his portrayal of a gangster who falls in love with a married woman while working for her as a driver, earned rave reviews from critics.<br />\r\n<br />\r\nHooda&#39;s first film in 2012 was Kunal Deshmukh&#39;s crime thriller Jannat 2, a follow-up film to Jannat (2008). While the film received mixed reviews from critics, Hooda was applauded for his performance. Taran Adarsh wrote that &quot;the actor delivers yet another knockout performance. He dominates in several sequences, making you realize that if given an opportunity, the guy can steal the thunder from the best of actors.&quot; Sonia Chopra of Sify said, &quot;Randeep Hooda is the best thing about the film.&quot; The film was a commercial success, with a domestic revenue of over 41 crore (US$7.46 million). His next appearance was in Pooja Bhatt&#39;s erotic thriller Jism 2 opposite Sunny Leone. The film and Hooda&#39;s performance garnered mixed reviews from critics. Lisa Tsering of The Hollywood Reporter said that Hooda &quot;smolders to the best of his ability in the role of a violent criminal.&quot; Jism 2 was a moderate commercial success, earning 35 crore (US$6.37 million) in India.<br />\r\n<br />\r\nHooda&#39;s final film in 2012 was Madhur Bhandarkar&#39;s drama Heroine featuring Kareena Kapoor as the protagonist. He was cast by the director to essay the role of a cricketer named Angad Paul. Prior to the start of principal photography, actor Arunoday Singh was chosen to play the role, but was later dropped from the film due to unknown reasons. Media reports began speculating the name of several actors (such as Ranbir Kapoor, Imran Khan and Prateik Babbar) though Bhandarkar later confirmed that he had selected Hooda after seeing his performance in Saheb, Biwi Aur Gangster (2011). Upon release, the film received mixed to negative reviews but Hooda&#39;s performance was appreciated by critics. The film was eventually declared a below average grosser as it failed at the domestic and international box office.<br />\r\n<br />\r\nAs of February 2013, Hooda stars opposite Aditi Rao Hydari and Sara Loren in Mahesh Bhatt&#39;s Murder 3 and the anthology film Bombay Talkies, in the segment directed by Karan Johar, alongside Rani Mukerji and Saqib Saleem. He has also been signed on for several other projects including Vishram Sawant&#39;s Shooter, John Day, Rensil D&#39;Silva&#39;s Ungli and Pooja Bhatt&#39;s Cabaret.</p>\r\n', 0, '2020-05-03 20:03:29', '2020-07-08 12:09:13'),
(23, 'Salman-Khan5eccba9a96493', 'Salman Khan', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-05-26-06-43-38-7a35ae382d7eb9af0eb234b8c81432ef85cf21a6.jpg', '<p>Bhai</p>\r\n', 1, '2020-05-26 06:43:38', '2020-05-26 06:43:38'),
(24, 'Aamir-Khan5ed0b2efb87ea', 'Aamir Khan', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-05-29-06-59-59-777f1291adb05578c446174b00777bb44dc21161.jpg', '<p>He is a versatile actor</p>\r\n', 1, '2020-05-29 06:59:59', '2020-05-29 06:59:59'),
(25, 'Akshay-Kumar5ed0bdd55f49d', 'Akshay Kumar', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-05-29-07-46-29-3c04cad9b02bb7c0747047edf98dc62e700f5416.jpg', '<p>He is the action king of bollywood</p>\r\n', 1, '2020-05-29 07:46:29', '2020-05-29 07:46:29'),
(26, 'Amitabh-Bachchan5ed0c37be017a', 'Amitabh Bachchan', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-05-29-08-10-35-362bc14da1b033802a7aaf683102e64aee4a6cc5.png', '<p>Big B of bollywood</p>\r\n', 0, '2020-05-29 08:10:35', '2020-08-24 02:42:22'),
(27, 'Raj-Kapoor5ed0c4ad60aeb', 'Raj Kapoor', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-05-29-08-15-41-6a2a139f5b4abb4e632490eea8f97f7ad69eb829.jpg', '<p>Classic actor</p>\r\n', 1, '2020-05-29 08:15:41', '2020-05-29 08:15:41'),
(28, 'Nawazuddin-Siddiqui5ed0c664628a1', 'Nawazuddin Siddiqui', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-05-29-08-23-00-63c4c13a34ac3df86fc360baeaa684ebba81cf25.jpg', '<p>Awesome actor</p>\r\n', 1, '2020-05-29 08:23:00', '2020-05-29 08:23:00'),
(29, 'Manoj-Bajpai5ed0c693f3755', 'Manoj Bajpai', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-05-29-08-23-47-255afc94c42259e4ef580a33106b599faaa8be86.jpg', '<p>Brillliant actor</p>\r\n', 1, '2020-05-29 08:23:47', '2020-05-29 08:23:47'),
(31, 'Butterfly5efb30c5742f4', 'Butterfly', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-06-26-06-35-30-a35195ede366ad20e83b103f74a925e56bfec350.jpg', '<p><strong>Lepidopterology</strong></p>\r\n', 1, '2020-06-26 06:35:30', '2020-06-30 12:32:05'),
(33, 'Wjjwjwjw5efc6de36a50d', 'Wjjwjwjw', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-07-01-11-05-07-678c87c6907cf3ef86eedd3f3eb8f0e505420935.jpg', '<p>Nsnsjdjdjjdndjdd</p>\r\n', 1, '2020-07-01 11:05:07', '2020-07-01 11:05:07'),
(35, 'Prophet-Uebert-Angel5f4acf5eb6be6', 'Prophet Uebert Angel', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-07-14-13-22-56-6666fd388f1b68a5bb3100e62845fecf0944a1a0.jpeg', '<p>Enjoy the wealth series by Prophet Uebert Angel</p>\r\n', 1, '2020-07-14 13:22:56', '2020-08-29 21:57:50'),
(36, 'Developer5f508b7ea062c', 'Developer', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-09-03-06-21-50-d211f5bd0bbce20779bbf3d82e1bd21c64ddfe58.png', '<p>jkhhgf</p>', 1, '2020-09-03 06:21:50', '2020-09-03 06:21:50'),
(38, 'Director:-Christopher-Nolan------Stars:-John-David-Washington,-Robert-Pattinson,-Elizabeth-Debicki5f6303bdc58a3', 'Director: Christopher Nolan      Stars: John David Washington, Robert Pattinson, Elizabeth Debicki', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-09-17-06-21-15-adfa21cc076ab5291fedc7f818418725fd78da84.jpg', '<p>Director:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0634240/?ref_=tt_ov_dr">Christopher Nolan</a></p>\r\n\r\n<p>Writer:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0634240/?ref_=tt_ov_wr">Christopher Nolan</a></p>\r\n\r\n<p>Stars:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0913475/?ref_=tt_ov_st_sm">John David Washington</a>,&nbsp;<a href="https://www.imdb.com/name/nm1500155/?ref_=tt_ov_st_sm">Robert Pattinson</a>,&nbsp;<a href="https://www.imdb.com/name/nm4456120/?ref_=tt_ov_st_sm">Elizabeth Debicki</a></p>', 1, '2020-09-17 06:21:15', '2020-09-17 06:35:41'),
(39, 'Leonardo-DiCaprio,-Joseph-Gordon-Levitt,-Ellen-Page5f6304c501fd6', 'Leonardo DiCaprio, Joseph Gordon-Levitt, Ellen Page', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-09-17-06-40-05-43ec324fd3dedd39a6aff210b29f8703d1cd50a8.jpg', '<p>Director:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0634240/?ref_=tt_ov_dr">Christopher Nolan</a></p>\r\n\r\n<p>Writer:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0634240/?ref_=tt_ov_wr">Christopher Nolan</a></p>\r\n\r\n<p>Stars:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0000138/?ref_=tt_ov_st_sm">Leonardo DiCaprio</a>,&nbsp;<a href="https://www.imdb.com/name/nm0330687/?ref_=tt_ov_st_sm">Joseph Gordon-Levitt</a>,&nbsp;<a href="https://www.imdb.com/name/nm0680983/?ref_=tt_ov_st_sm">Ellen Page</a></p>', 1, '2020-09-17 06:40:05', '2020-09-17 06:40:05'),
(40, 'Matthew-McConaughey,-Charlie-Hunnam,-Michelle-Dockery5f6af9e395c86', 'Matthew McConaughey, Charlie Hunnam, Michelle Dockery', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-09-23-07-31-47-5b82c22d5f6a0ec390559a02265bb3c051134805.jpg', '<p>Director:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0005363/?ref_=tt_ov_dr">Guy Ritchie</a></p>\r\n\r\n<p>Writers:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0005363/?ref_=tt_ov_wr">Guy Ritchie</a>&nbsp;(story by),&nbsp;<a href="https://www.imdb.com/name/nm6842463/?ref_=tt_ov_wr">Ivan Atkinson</a>&nbsp;(story by)</p>\r\n\r\n<p>Stars:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0000190/?ref_=tt_ov_st_sm">Matthew McConaughey</a>,&nbsp;<a href="https://www.imdb.com/name/nm0402271/?ref_=tt_ov_st_sm">Charlie Hunnam</a>,&nbsp;<a href="https://www.imdb.com/name/nm1890784/?ref_=tt_ov_st_sm">Michelle Dockery</a>&nbsp;</p>', 1, '2020-09-23 07:31:47', '2020-09-23 07:31:47'),
(41, 'Christian-Bale,-Heath-Ledger,-Aaron-Eckhart5f6afd2c183a7', 'Christian Bale, Heath Ledger, Aaron Eckhart', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-09-23-07-45-48-f4f778d650d56d58f227efb313ae8e7f1749177f.jpg', '<p>Director:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0634240/?ref_=tt_ov_dr">Christopher Nolan</a></p>\r\n\r\n<p>Writers:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0634300/?ref_=tt_ov_wr">Jonathan Nolan</a>&nbsp;(screenplay),&nbsp;<a href="https://www.imdb.com/name/nm0634240/?ref_=tt_ov_wr">Christopher Nolan</a>&nbsp;(screenplay)&nbsp;</p>\r\n\r\n<p>Stars:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0000288/?ref_=tt_ov_st_sm">Christian Bale</a>,&nbsp;<a href="https://www.imdb.com/name/nm0005132/?ref_=tt_ov_st_sm">Heath Ledger</a>,&nbsp;<a href="https://www.imdb.com/name/nm0001173/?ref_=tt_ov_st_sm">Aaron Eckhart</a>&nbsp;</p>', 1, '2020-09-23 07:40:41', '2020-09-23 07:45:48'),
(42, 'Daniel-Craig,-Chris-Evans,-Ana-de-Armas5f6b1338be2c8', 'Daniel Craig, Chris Evans, Ana de Armas', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-09-23-09-19-52-047adaf055af135cdea5b83f91a1f8ea9f8ac5c0.jpg', '<p>Director:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0426059/?ref_=tt_ov_dr">Rian Johnson</a></p>\r\n\r\n<p>Writer:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0426059/?ref_=tt_ov_wr">Rian Johnson</a></p>\r\n\r\n<p>Stars:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0185819/?ref_=tt_ov_st_sm">Daniel Craig</a>,&nbsp;<a href="https://www.imdb.com/name/nm0262635/?ref_=tt_ov_st_sm">Chris Evans</a>,&nbsp;<a href="https://www.imdb.com/name/nm1869101/?ref_=tt_ov_st_sm">Ana de Armas</a></p>', 1, '2020-09-23 09:19:52', '2020-09-23 09:19:52'),
(43, 'Stars:-Anna-Kendrick,-Justin-Timberlake,-Rachel-Bloom5f6b18caca370', 'Stars: Anna Kendrick, Justin Timberlake, Rachel Bloom', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-09-23-09-43-38-415ff9be9df00929810bdc0b1930cbb640abcc22.jpg', '<p>Directors:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0230666/?ref_=tt_ov_dr">Walt Dohrn</a>,&nbsp;<a href="https://www.imdb.com/name/nm1019583/?ref_=tt_ov_dr">David P. Smith</a>&nbsp;(co-director)</p>\r\n\r\n<p>Writers:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0008743/?ref_=tt_ov_wr">Jonathan Aibel</a>&nbsp;(screenplay by),&nbsp;<a href="https://www.imdb.com/name/nm0074184/?ref_=tt_ov_wr">Glenn Berger</a>&nbsp;(screenplay by)&nbsp;</p>\r\n\r\n<p>Stars:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0447695/?ref_=tt_ov_st_sm">Anna Kendrick</a>,&nbsp;<a href="https://www.imdb.com/name/nm0005493/?ref_=tt_ov_st_sm">Justin Timberlake</a>,&nbsp;<a href="https://www.imdb.com/name/nm3417385/?ref_=tt_ov_st_sm">Rachel Bloom</a>&nbsp;</p>', 1, '2020-09-23 09:43:38', '2020-09-23 09:43:38'),
(44, 'Stars:-Michael-J.-Fox,-Christopher-Lloyd,-Lea-Thompson5f6b1b3bc5510', 'Stars: Michael J. Fox, Christopher Lloyd, Lea Thompson', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-09-23-09-54-03-12d75c22396aa04c142b404535d805145a53fe6e.jpg', '<p>Director:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0000709/?ref_=tt_ov_dr">Robert Zemeckis</a></p>\r\n\r\n<p>Writers:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0000709/?ref_=tt_ov_wr">Robert Zemeckis</a>,&nbsp;<a href="https://www.imdb.com/name/nm0301826/?ref_=tt_ov_wr">Bob Gale</a></p>\r\n\r\n<p>Stars:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0000150/?ref_=tt_ov_st_sm">Michael J. Fox</a>,&nbsp;<a href="https://www.imdb.com/name/nm0000502/?ref_=tt_ov_st_sm">Christopher Lloyd</a>,&nbsp;<a href="https://www.imdb.com/name/nm0000670/?ref_=tt_ov_st_sm">Lea Thompson</a></p>', 1, '2020-09-23 09:54:03', '2020-09-23 09:54:03'),
(45, 'Stars:-Dwayne-Johnson,-Jack-Black,-Kevin-Hart5f6b1cbe989fb', 'Stars: Dwayne Johnson, Jack Black, Kevin Hart', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-09-23-10-00-30-3d06c8fefd3768d787c6178210fcd3ade19b0db0.jpg', '<p>Director:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0440458/?ref_=tt_ov_dr">Jake Kasdan</a></p>\r\n\r\n<p>Writers:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0440458/?ref_=tt_ov_wr">Jake Kasdan</a>,&nbsp;<a href="https://www.imdb.com/name/nm0684374/?ref_=tt_ov_wr">Jeff Pinkner</a>&nbsp;</p>\r\n\r\n<p>Stars:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0425005/?ref_=tt_ov_st_sm">Dwayne Johnson</a>,&nbsp;<a href="https://www.imdb.com/name/nm0085312/?ref_=tt_ov_st_sm">Jack Black</a>,&nbsp;<a href="https://www.imdb.com/name/nm0366389/?ref_=tt_ov_st_sm">Kevin Hart</a></p>', 1, '2020-09-23 10:00:30', '2020-09-23 10:00:30'),
(46, 'Stars:-Will-Ferrell,-Rachel-McAdams,-Dan-Stevens5f6b1e00d66e7', 'Stars: Will Ferrell, Rachel McAdams, Dan Stevens', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-09-23-10-05-52-e22577dd572bfba40de3c6b0237ec3ff8f8c4b2b.jpg', '<p>Director:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0229694/?ref_=tt_ov_dr">David Dobkin</a></p>\r\n\r\n<p>Writers:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0002071/?ref_=tt_ov_wr">Will Ferrell</a>,&nbsp;<a href="https://www.imdb.com/name/nm0824482/?ref_=tt_ov_wr">Andrew Steele</a></p>\r\n\r\n<p>Stars:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0002071/?ref_=tt_ov_st_sm">Will Ferrell</a>,&nbsp;<a href="https://www.imdb.com/name/nm1046097/?ref_=tt_ov_st_sm">Rachel McAdams</a>,&nbsp;<a href="https://www.imdb.com/name/nm1405398/?ref_=tt_ov_st_sm">Dan Stevens</a>&nbsp;</p>', 1, '2020-09-23 10:05:52', '2020-09-23 10:05:52'),
(47, 'Stars:-Anna-Maria-Sieklucka,-Michele-Morrone,-Bronislaw-Wroclawski5f6b1f51594e6', 'Stars: Anna Maria Sieklucka, Michele Morrone, Bronislaw Wroclawski', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-09-23-10-11-29-f48c43b952e32bc817afb461974d055861d7429e.jpg', '<p>Directors:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm1705578/?ref_=tt_ov_dr">Barbara Bialowas</a>,&nbsp;<a href="https://www.imdb.com/name/nm1372836/?ref_=tt_ov_dr">Tomasz Mandes</a></p>\r\n\r\n<p>Writers:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm11183123/?ref_=tt_ov_wr">Tomasz Klimala</a>&nbsp;(screenplay by),&nbsp;<a href="https://www.imdb.com/name/nm1372836/?ref_=tt_ov_wr">Tomasz Mandes</a>&nbsp;(screen story by)&nbsp;</p>\r\n\r\n<p>Stars:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm11110971/?ref_=tt_ov_st_sm">Anna Maria Sieklucka</a>,&nbsp;<a href="https://www.imdb.com/name/nm9016108/?ref_=tt_ov_st_sm">Michele Morrone</a>,&nbsp;<a href="https://www.imdb.com/name/nm0943002/?ref_=tt_ov_st_sm">Bronislaw Wroclawski</a>&nbsp;</p>', 1, '2020-09-23 10:11:29', '2020-09-23 10:11:29'),
(48, 'Director:-James-Cameron5f6b21ea8582b', 'Director: James Cameron', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-09-23-10-22-34-1d5410a1db62779e8c229db64a033aabd7769361.jpg', '<p>Director:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0000116/?ref_=tt_ov_dr">James Cameron</a></p>\r\n\r\n<p>Writer:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0000116/?ref_=tt_ov_wr">James Cameron</a></p>\r\n\r\n<p>Stars:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0000138/?ref_=tt_ov_st_sm">Leonardo DiCaprio</a>,&nbsp;<a href="https://www.imdb.com/name/nm0000701/?ref_=tt_ov_st_sm">Kate Winslet</a>,&nbsp;<a href="https://www.imdb.com/name/nm0000708/?ref_=tt_ov_st_sm">Billy Zane</a></p>', 1, '2020-09-23 10:22:34', '2020-09-23 10:22:34'),
(49, 'Stars:-Andy-Samberg,-Cristin-Milioti,-J.K.-Simmons5f6b23b0012dd', 'Stars: Andy Samberg, Cristin Milioti, J.K. Simmons', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-09-23-10-30-08-45e8a9fa4904b3baf6edbfee8ae400a42810425e.jpg', '<p>Director:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm3817317/?ref_=tt_ov_dr">Max Barbakow</a></p>\r\n\r\n<p>Writer:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm4460791/?ref_=tt_ov_wr">Andy Siara</a>&nbsp;(screenplay)</p>\r\n\r\n<p>Stars:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm1676221/?ref_=tt_ov_st_sm">Andy Samberg</a>,&nbsp;<a href="https://www.imdb.com/name/nm2129662/?ref_=tt_ov_st_sm">Cristin Milioti</a>,&nbsp;<a href="https://www.imdb.com/name/nm0799777/?ref_=tt_ov_st_sm">J.K. Simmons</a></p>', 1, '2020-09-23 10:30:08', '2020-09-23 10:30:08'),
(50, 'Stars:-Tom-Hanks,-Robin-Wright,-Gary-Sinise5f6b25b522771', 'Stars: Tom Hanks, Robin Wright, Gary Sinise', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-09-23-10-38-45-e9c60c4bacd8f853abe47eccaa8144b3574112b2.jpg', '<p>Director:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0000709/?ref_=tt_ov_dr">Robert Zemeckis</a></p>\r\n\r\n<p>Writers:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0343165/?ref_=tt_ov_wr">Winston Groom</a>&nbsp;(novel),&nbsp;<a href="https://www.imdb.com/name/nm0744839/?ref_=tt_ov_wr">Eric Roth</a>&nbsp;(screenplay)</p>\r\n\r\n<p>Stars:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0000158/?ref_=tt_ov_st_sm">Tom Hanks</a>,&nbsp;<a href="https://www.imdb.com/name/nm0000705/?ref_=tt_ov_st_sm">Robin Wright</a>,&nbsp;<a href="https://www.imdb.com/name/nm0000641/?ref_=tt_ov_st_sm">Gary Sinise</a></p>', 1, '2020-09-23 10:38:45', '2020-09-23 10:38:45'),
(51, 'Stars:-Emma-Watson,-Dan-Stevens,-Luke-Evans5f6b27f63fb97', 'Stars: Emma Watson, Dan Stevens, Luke Evans', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-09-23-10-48-22-ceeb569b34485266f538e90d6430e6a5f80a834d.jpg', '<p>Director:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0174374/?ref_=tt_ov_dr">Bill Condon</a></p>\r\n\r\n<p>Writers:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0154716/?ref_=tt_ov_wr">Stephen Chbosky</a>&nbsp;(screenplay by),&nbsp;<a href="https://www.imdb.com/name/nm0818746/?ref_=tt_ov_wr">Evan Spiliotopoulos</a>&nbsp;(screenplay by)&nbsp;</p>\r\n\r\n<p>Stars:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0914612/?ref_=tt_ov_st_sm">Emma Watson</a>,&nbsp;<a href="https://www.imdb.com/name/nm1405398/?ref_=tt_ov_st_sm">Dan Stevens</a>,&nbsp;<a href="https://www.imdb.com/name/nm1812656/?ref_=tt_ov_st_sm">Luke Evans</a></p>', 1, '2020-09-23 10:48:22', '2020-09-23 10:48:22'),
(52, 'Stars:-Matthew-McConaughey,-Anne-Hathaway,-Jessica-Chastain5f6b39e95ea83', 'Stars: Matthew McConaughey, Anne Hathaway, Jessica Chastain', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-09-23-12-04-57-af3fff3739226e7e99af9b158d161f111f5f9032.jpg', '<p>Director:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0634240/?ref_=tt_ov_dr">Christopher Nolan</a></p>\r\n\r\n<p>Writers:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0634300/?ref_=tt_ov_wr">Jonathan Nolan</a>,&nbsp;<a href="https://www.imdb.com/name/nm0634240/?ref_=tt_ov_wr">Christopher Nolan</a></p>\r\n\r\n<p>Stars:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0000190/?ref_=tt_ov_st_sm">Matthew McConaughey</a>,&nbsp;<a href="https://www.imdb.com/name/nm0004266/?ref_=tt_ov_st_sm">Anne Hathaway</a>,&nbsp;<a href="https://www.imdb.com/name/nm1567113/?ref_=tt_ov_st_sm">Jessica Chastain</a></p>', 1, '2020-09-23 12:04:57', '2020-09-23 12:04:57'),
(53, 'Stars:-Zendaya,-Timothée-Chalamet,-Rebecca-Ferguson5f6b3be8a922e', 'Stars: Zendaya, Timothée Chalamet, Rebecca Ferguson', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-09-23-12-13-28-b26ebc7070175da01be872aaf1f8f35454ab395a.jpg', '<p>Director:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0898288/?ref_=tt_ov_dr">Denis Villeneuve</a></p>\r\n\r\n<p>Writers:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0378541/?ref_=tt_ov_wr">Frank Herbert</a>&nbsp;(novel),&nbsp;<a href="https://www.imdb.com/name/nm3123612/?ref_=tt_ov_wr">Jon Spaihts</a>&nbsp;(screenplay by)&nbsp;</p>\r\n\r\n<p>Stars:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm3918035/?ref_=tt_ov_st_sm">Zendaya</a>,&nbsp;<a href="https://www.imdb.com/name/nm3154303/?ref_=tt_ov_st_sm">Timoth&eacute;e Chalamet</a>,&nbsp;<a href="https://www.imdb.com/name/nm0272581/?ref_=tt_ov_st_sm">Rebecca Ferguson</a>&nbsp;</p>', 1, '2020-09-23 12:13:28', '2020-09-23 12:13:28'),
(54, 'Stars:-Christian-Bale,-Hugh-Jackman,-Scarlett-Johansson5f6b3f31f36fd', 'Stars: Christian Bale, Hugh Jackman, Scarlett Johansson', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-09-23-12-27-29-1571fc21ec735a2c57e90dd195f2f827b64b8e7a.jpg', '<p>Director:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0634240/?ref_=tt_ov_dr">Christopher Nolan</a></p>\r\n\r\n<p>Writers:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0634300/?ref_=tt_ov_wr">Jonathan Nolan</a>&nbsp;(screenplay),&nbsp;<a href="https://www.imdb.com/name/nm0634240/?ref_=tt_ov_wr">Christopher Nolan</a>&nbsp;(screenplay)</p>\r\n\r\n<p>Stars:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0000288/?ref_=tt_ov_st_sm">Christian Bale</a>,&nbsp;<a href="https://www.imdb.com/name/nm0413168/?ref_=tt_ov_st_sm">Hugh Jackman</a>,&nbsp;<a href="https://www.imdb.com/name/nm0424060/?ref_=tt_ov_st_sm">Scarlett Johansson</a></p>', 1, '2020-09-23 12:20:54', '2020-09-23 12:27:29'),
(55, 'Stars:-Keanu-Reeves,-Laurence-Fishburne,-Carrie-Anne-Moss5f6b41383223b', 'Stars: Keanu Reeves, Laurence Fishburne, Carrie-Anne Moss', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-09-23-12-36-08-54ebaa62db931e39e764f0f9fd4879a83ff0d8d4.jpg', '<p>Directors:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0905154/?ref_=tt_ov_dr">Lana Wachowski</a>&nbsp;(as The Wachowski Brothers),&nbsp;<a href="https://www.imdb.com/name/nm0905152/?ref_=tt_ov_dr">Lilly Wachowski</a>&nbsp;(as The Wachowski Brothers)</p>\r\n\r\n<p>Writers:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0905152/?ref_=tt_ov_wr">Lilly Wachowski</a>&nbsp;(as The Wachowski Brothers),&nbsp;<a href="https://www.imdb.com/name/nm0905154/?ref_=tt_ov_wr">Lana Wachowski</a>&nbsp;(as The Wachowski Brothers)</p>\r\n\r\n<p>Stars:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0000206/?ref_=tt_ov_st_sm">Keanu Reeves</a>,&nbsp;<a href="https://www.imdb.com/name/nm0000401/?ref_=tt_ov_st_sm">Laurence Fishburne</a>,&nbsp;<a href="https://www.imdb.com/name/nm0005251/?ref_=tt_ov_st_sm">Carrie-Anne Moss</a>&nbsp;</p>', 1, '2020-09-23 12:36:08', '2020-09-23 12:36:08'),
(56, 'Stars:-Elisabeth-Moss,-Oliver-Jackson-Cohen,-Harriet-Dyer5f6b4284dca74', 'Stars: Elisabeth Moss, Oliver Jackson-Cohen, Harriet Dyer', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-09-23-12-41-40-d2a9acd980b8e83f1c99c11bf742238669ebd587.jpg', '<p>Director:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm1191481/?ref_=tt_ov_dr">Leigh Whannell</a></p>\r\n\r\n<p>Writers:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm1191481/?ref_=tt_ov_wr">Leigh Whannell</a>&nbsp;(screenplay),&nbsp;<a href="https://www.imdb.com/name/nm1191481/?ref_=tt_ov_wr">Leigh Whannell</a>&nbsp;(screen story)</p>\r\n\r\n<p>Stars:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0005253/?ref_=tt_ov_st_sm">Elisabeth Moss</a>,&nbsp;<a href="https://www.imdb.com/name/nm2719825/?ref_=tt_ov_st_sm">Oliver Jackson-Cohen</a>,&nbsp;<a href="https://www.imdb.com/name/nm2976830/?ref_=tt_ov_st_sm">Harriet Dyer</a>&nbsp;</p>', 1, '2020-09-23 12:41:40', '2020-09-23 12:41:40'),
(57, 'Stars:-Charlize-Theron,-KiKi-Layne,-Matthias-Schoenaerts5f6c371686183', 'Stars: Charlize Theron, KiKi Layne, Matthias Schoenaerts', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-09-24-06-05-10-0792e20dcd222be61a36cee7b654035664f4997f.jpg', '<p>Director:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0697656/?ref_=tt_ov_dr">Gina Prince-Bythewood</a></p>\r\n\r\n<p>Writers:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm1421638/?ref_=tt_ov_wr">Greg Rucka</a>&nbsp;(screenplay by),&nbsp;<a href="https://www.imdb.com/name/nm1421638/?ref_=tt_ov_wr">Greg Rucka</a>&nbsp;(based on the graphic novel series by)&nbsp;</p>\r\n\r\n<p>Stars:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0000234/?ref_=tt_ov_st_sm">Charlize Theron</a>,&nbsp;<a href="https://www.imdb.com/name/nm8460487/?ref_=tt_ov_st_sm">KiKi Layne</a>,&nbsp;<a href="https://www.imdb.com/name/nm0774386/?ref_=tt_ov_st_sm">Matthias Schoenaerts</a>&nbsp;</p>', 1, '2020-09-24 06:05:10', '2020-09-24 06:05:10'),
(58, 'Stars:-Sean-Astin,-Josh-Brolin,-Jeff-Cohen5f6c38d15f750', 'Stars: Sean Astin, Josh Brolin, Jeff Cohen', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-09-24-06-12-33-b3b70c3e873282ca0e90225b08c729464a9df4f5.jpg', '<p>Director:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0001149/?ref_=tt_ov_dr">Richard Donner</a></p>\r\n\r\n<p>Writers:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0001060/?ref_=tt_ov_wr">Chris Columbus</a>&nbsp;(screenplay by),&nbsp;<a href="https://www.imdb.com/name/nm0000229/?ref_=tt_ov_wr">Steven Spielberg</a>&nbsp;(story by)</p>\r\n\r\n<p>Stars:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0000276/?ref_=tt_ov_st_sm">Sean Astin</a>,&nbsp;<a href="https://www.imdb.com/name/nm0000982/?ref_=tt_ov_st_sm">Josh Brolin</a>,&nbsp;<a href="https://www.imdb.com/name/nm0169480/?ref_=tt_ov_st_sm">Jeff Cohen</a></p>', 1, '2020-09-24 06:12:33', '2020-09-24 06:12:33'),
(59, 'Stars:-Billy-Crudup,-Patrick-Fugit,-Kate-Hudson5f6c3b98cd14f', 'Stars: Billy Crudup, Patrick Fugit, Kate Hudson', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-09-24-06-24-24-0011869b8ea06eec7b4125f2d75b67f1c644ecb0.jpg', '<p>Director:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0001081/?ref_=tt_ov_dr">Cameron Crowe</a></p>\r\n\r\n<p>Writer:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0001081/?ref_=tt_ov_wr">Cameron Crowe</a></p>\r\n\r\n<p>Stars:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0001082/?ref_=tt_ov_st_sm">Billy Crudup</a>,&nbsp;<a href="https://www.imdb.com/name/nm0297578/?ref_=tt_ov_st_sm">Patrick Fugit</a>,&nbsp;<a href="https://www.imdb.com/name/nm0005028/?ref_=tt_ov_st_sm">Kate Hudson</a></p>', 1, '2020-09-24 06:24:24', '2020-09-24 06:24:24'),
(60, 'Stars:-Ed-Skrein,-Patrick-Wilson,-Woody-Harrelson5f6c3d16defb6', 'Stars: Ed Skrein, Patrick Wilson, Woody Harrelson', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-09-24-06-30-46-7f9f95a2dea1baca52f71add31e256c9f647be1e.jpg', '<p>The story of the Battle of Midway, told by the leaders and the sailors who fought it.</p>\r\n\r\n<p>Director:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0000386/?ref_=tt_ov_dr">Roland Emmerich</a></p>\r\n\r\n<p>Writer:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm7873659/?ref_=tt_ov_wr">Wes Tooke</a></p>\r\n\r\n<p>Stars:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm4534098/?ref_=tt_ov_st_sm">Ed Skrein</a>,&nbsp;<a href="https://www.imdb.com/name/nm0933940/?ref_=tt_ov_st_sm">Patrick Wilson</a>,&nbsp;<a href="https://www.imdb.com/name/nm0000437/?ref_=tt_ov_st_sm">Woody Harrelson</a></p>', 1, '2020-09-24 06:30:46', '2020-09-24 06:30:46'),
(61, 'Stars:-Daniel-Craig,-Eva-Green,-Judi-Dench5f6c40e5d4c13', 'Stars: Daniel Craig, Eva Green, Judi Dench', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-09-24-06-47-01-865d88f89db044884602601183d5a30869136d84.jpg', '<p>Director:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0132709/?ref_=tt_ov_dr">Martin Campbell</a></p>\r\n\r\n<p>Writers:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0701031/?ref_=tt_ov_wr">Neal Purvis</a>&nbsp;(screenplay),&nbsp;<a href="https://www.imdb.com/name/nm0905498/?ref_=tt_ov_wr">Robert Wade</a>&nbsp;(screenplay)&nbsp;</p>\r\n\r\n<p>Stars:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0185819/?ref_=tt_ov_st_sm">Daniel Craig</a>,&nbsp;<a href="https://www.imdb.com/name/nm1200692/?ref_=tt_ov_st_sm">Eva Green</a>,&nbsp;<a href="https://www.imdb.com/name/nm0001132/?ref_=tt_ov_st_sm">Judi Dench</a></p>', 1, '2020-09-24 06:47:01', '2020-09-24 06:47:01');
INSERT INTO `cast_crews` (`id`, `unique_id`, `name`, `image`, `description`, `status`, `created_at`, `updated_at`) VALUES
(62, 'Stars:-Tom-Ellis,-Lauren-German,-Kevin-Alejandro5f6c51f250f26', 'Stars: Tom Ellis, Lauren German, Kevin Alejandro', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-09-24-07-59-46-a97e7124285aac3b6c64b2321bd0a6191f7a62b6.jpg', '<p>Creator:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm1093513/?ref_=tt_ov_wr">Tom Kapinos</a></p>\r\n\r\n<p>Stars:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0255124/?ref_=tt_ov_st_sm">Tom Ellis</a>,&nbsp;<a href="https://www.imdb.com/name/nm0314514/?ref_=tt_ov_st_sm">Lauren German</a>,&nbsp;<a href="https://www.imdb.com/name/nm1204760/?ref_=tt_ov_st_sm">Kevin Alejandro</a></p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0255124/?ref_=ttfc_fc_cl_t1">Tom Ellis</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm0255124?ref_=ttfc_fc_cl_t1">Lucifer Morningstar</a>&nbsp;/ ...<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0255124\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i1\',0,0,\'#episodes-tt4052886-nm0255124-actor\', toggleSpan); return false;">78 episodes, 2016-2020&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0314514/?ref_=ttfc_fc_cl_i2"><img alt="Lauren German" src="https://m.media-amazon.com/images/M/MV5BMTUzNjY0NTA0Ml5BMl5BanBnXkFtZTgwMTUxMTMyNjE@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0314514/?ref_=ttfc_fc_cl_t2">Lauren German</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm0314514?ref_=ttfc_fc_cl_t2">Chloe Decker</a>&nbsp;/ ...<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0314514\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i2\',0,0,\'#episodes-tt4052886-nm0314514-actress\', toggleSpan); return false;">77 episodes, 2016-2020&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm1204760/?ref_=ttfc_fc_cl_i3"><img alt="Kevin Alejandro" src="https://m.media-amazon.com/images/M/MV5BMTA0NDkyNzI0MTBeQTJeQWpwZ15BbWU4MDI4ODUxODUx._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm1204760/?ref_=ttfc_fc_cl_t3">Kevin Alejandro</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm1204760?ref_=ttfc_fc_cl_t3">Dan Espinoza</a>&nbsp;/ ...<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm1204760\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i3\',0,0,\'#episodes-tt4052886-nm1204760-actor\', toggleSpan); return false;">77 episodes, 2016-2020&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0940851/?ref_=ttfc_fc_cl_i4"><img alt="D.B. Woodside" src="https://m.media-amazon.com/images/M/MV5BMzAyMTA3OTQ3NF5BMl5BanBnXkFtZTcwODA0NTM5Nw@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0940851/?ref_=ttfc_fc_cl_t4">D.B. Woodside</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm0940851?ref_=ttfc_fc_cl_t4">Amenadiel</a>&nbsp;/ ...<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0940851\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i4\',0,0,\'#episodes-tt4052886-nm0940851-actor\', toggleSpan); return false;">77 episodes, 2016-2020&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm2788229/?ref_=ttfc_fc_cl_i5"><img alt="Lesley-Ann Brandt" src="https://m.media-amazon.com/images/M/MV5BOWVjZTZjZjktYjhjMS00Y2ZkLWFmYjMtMmE1NjU3YWI4MTIxXkEyXkFqcGdeQXVyMTg0NjgyODA@._V1_UY44_CR9,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm2788229/?ref_=ttfc_fc_cl_t5">Lesley-Ann Brandt</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm2788229?ref_=ttfc_fc_cl_t5">Mazikeen</a>&nbsp;/ ...<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm2788229\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i5\',0,0,\'#episodes-tt4052886-nm2788229-actress\', toggleSpan); return false;">77 episodes, 2016-2020&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0006713/?ref_=ttfc_fc_cl_i6"><img alt="Rachael Harris" src="https://m.media-amazon.com/images/M/MV5BZWExMGViNzktOTM2ZS00ZTIyLWI5YjEtY2YzZWMwNDMxMTJiXkEyXkFqcGdeQXVyNDk4NzYxOA@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0006713/?ref_=ttfc_fc_cl_t6">Rachael Harris</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm0006713?ref_=ttfc_fc_cl_t6">Linda Martin</a>&nbsp;/ ...<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0006713\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i6\',0,0,\'#episodes-tt4052886-nm0006713-actress\', toggleSpan); return false;">77 episodes, 2016-2020&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm5411494/?ref_=ttfc_fc_cl_i7"><img alt="Scarlett Estevez" src="https://m.media-amazon.com/images/M/MV5BZTAzMGVlNGMtOTUxNy00MTgxLTlkMTEtMGU5Mzk3ZGNlOTI0XkEyXkFqcGdeQXVyMTY0MTA3OA@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm5411494/?ref_=ttfc_fc_cl_t7">Scarlett Estevez</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm5411494?ref_=ttfc_fc_cl_t7">Trixie Espinoza</a><a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm5411494\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i7\',0,0,\'#episodes-tt4052886-nm5411494-actress\', toggleSpan); return false;">72 episodes, 2016-2020&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0305083/?ref_=ttfc_fc_cl_i8"><img alt="Aimee Garcia" src="https://m.media-amazon.com/images/M/MV5BMTQ0NDQ2NzUyN15BMl5BanBnXkFtZTcwODA3MjUwOA@@._V1_UY44_CR2,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0305083/?ref_=ttfc_fc_cl_t8">Aimee Garcia</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm0305083?ref_=ttfc_fc_cl_t8">Ella Lopez</a>&nbsp;/ ...<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0305083\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i8\',0,0,\'#episodes-tt4052886-nm0305083-actress\', toggleSpan); return false;">64 episodes, 2016-2020&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm1065454/?ref_=ttfc_fc_cl_i9"><img alt="Tricia Helfer" src="https://m.media-amazon.com/images/M/MV5BMjEzNTI4MzAzNl5BMl5BanBnXkFtZTcwNTEyNzQ1NA@@._V1_UY44_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm1065454/?ref_=ttfc_fc_cl_t9">Tricia Helfer</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm1065454?ref_=ttfc_fc_cl_t9">Charlotte</a>&nbsp;/ ...<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm1065454\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i9\',0,0,\'#episodes-tt4052886-nm1065454-actress\', toggleSpan); return false;">45 episodes, 2016-2020&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0919991/?ref_=ttfc_fc_cl_i10"><img alt="Tom Welling" src="https://m.media-amazon.com/images/M/MV5BOTc4ODA0NzA4OF5BMl5BanBnXkFtZTcwNDA4NTc4Mg@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0919991/?ref_=ttfc_fc_cl_t10">Tom Welling</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm0919991?ref_=ttfc_fc_cl_t10">Marcus Pierce</a><a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0919991\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i10\',0,0,\'#episodes-tt4052886-nm0919991-actor\', toggleSpan); return false;">22 episodes, 2017-2018&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm2819413/?ref_=ttfc_fc_cl_i11"><img alt="Inbar Lavi" src="https://m.media-amazon.com/images/M/MV5BOTZiNDc5ZmEtODQzOC00Nzk1LWIzZTctZjAxYTI2N2UxYTQ3XkEyXkFqcGdeQXVyMTcyODYzOTg@._V1_UY44_CR3,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm2819413/?ref_=ttfc_fc_cl_t11">Inbar Lavi</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm2819413?ref_=ttfc_fc_cl_t11">Eve</a><a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm2819413\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i11\',0,0,\'#episodes-tt4052886-nm2819413-actress\', toggleSpan); return false;">8 episodes, 2019&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0710271/?ref_=ttfc_fc_cl_i12"><img alt="Kevin Rankin" src="https://m.media-amazon.com/images/M/MV5BZDczNWZiYzAtY2I4NS00ZDgwLTk0YjItYmU2ZDVhNmM3NjExXkEyXkFqcGdeQXVyMjQwMDg0Ng@@._V1_UY44_CR2,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0710271/?ref_=ttfc_fc_cl_t12">Kevin Rankin</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm0710271?ref_=ttfc_fc_cl_t12">Malcolm Graham</a><a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0710271\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i12\',0,0,\'#episodes-tt4052886-nm0710271-actor\', toggleSpan); return false;">7 episodes, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0574615/?ref_=ttfc_fc_cl_i13"><img alt="Graham McTavish" src="https://m.media-amazon.com/images/M/MV5BMTg0NDUwNTgyOV5BMl5BanBnXkFtZTgwNzk0MzU3MjE@._V1_UY44_CR6,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0574615/?ref_=ttfc_fc_cl_t13">Graham McTavish</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm0574615?ref_=ttfc_fc_cl_t13">Father Kinley</a><a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0574615\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i13\',0,0,\'#episodes-tt4052886-nm0574615-actor\', toggleSpan); return false;">6 episodes, 2019&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0083586/?ref_=ttfc_fc_cl_i14"><img alt="Jeremiah Birkett" src="https://m.media-amazon.com/images/M/MV5BOGI1NjY2NWEtMzZlZS00NzQ4LTljNDktNGUxZWYwNDQyMmI0XkEyXkFqcGdeQXVyMjQwMDg0Ng@@._V1_UY44_CR1,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0083586/?ref_=ttfc_fc_cl_t14">Jeremiah Birkett</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm0083586?ref_=ttfc_fc_cl_t14">Lee</a>&nbsp;/ ...<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0083586\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i14\',0,0,\'#episodes-tt4052886-nm0083586-actor\', toggleSpan); return false;">5 episodes, 2016-2020&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm10669208/?ref_=ttfc_fc_cl_i15"><img alt="Cailan Robinson" src="https://m.media-amazon.com/images/M/MV5BYjUzZGUwOGUtNDkxMS00MTI3LWI3NzktNWZhYTQ5ZmZjMThlXkEyXkFqcGdeQXVyMTAyNTU0MjA0._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm10669208/?ref_=ttfc_fc_cl_t15">Cailan Robinson</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Cop<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm10669208\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i15\',0,0,\'#episodes-tt4052886-nm10669208-actor\', toggleSpan); return false;">5 episodes, 2019&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm9668701/?ref_=ttfc_fc_cl_i16"><img alt="Genevieve Gauss" src="https://m.media-amazon.com/images/M/MV5BNGJmMGMwYWMtYmRiYS00ZTc2LTljMmMtNmJiMTk4OGUzOWZiXkEyXkFqcGdeQXVyODYwOTYwMzM@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm9668701/?ref_=ttfc_fc_cl_t16">Genevieve Gauss</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Officer Cacuzza<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm9668701\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i16\',0,0,\'#episodes-tt4052886-nm9668701-actress\', toggleSpan); return false;">4 episodes, 2019-2020&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm4337039/?ref_=ttfc_fc_cl_i17"><img alt="Alexander Koch" src="https://m.media-amazon.com/images/M/MV5BMTcwNzY2OTE5OF5BMl5BanBnXkFtZTgwMDQzODcwMDI@._V1_UY44_CR17,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm4337039/?ref_=ttfc_fc_cl_t17">Alexander Koch</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Pete Daily<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm4337039\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i17\',0,0,\'#episodes-tt4052886-nm4337039-actor\', toggleSpan); return false;">3 episodes, 2020&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0613147/?ref_=ttfc_fc_cl_i18"><img alt="Lochlyn Munro" src="https://m.media-amazon.com/images/M/MV5BMTM4NTY0NjAxMV5BMl5BanBnXkFtZTcwNTI2MzM1OQ@@._V1_UY44_CR17,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0613147/?ref_=ttfc_fc_cl_t18">Lochlyn Munro</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Anthony Paolucci<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0613147\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i18\',0,0,\'#episodes-tt4052886-nm0613147-actor\', toggleSpan); return false;">3 episodes, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm5718996/?ref_=ttfc_fc_cl_i19"><img alt="Jorden Birch" src="https://m.media-amazon.com/images/M/MV5BNjNkNGVjOGMtNzE0ZS00ZDk1LWJjYzgtZmMzOGRlOTk0MmYzXkEyXkFqcGdeQXVyMzQyMTg2NjA@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm5718996/?ref_=ttfc_fc_cl_t19">Jorden Birch</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Uni #2 / ...<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm5718996\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i19\',0,0,\'#episodes-tt4052886-nm5718996-actor\', toggleSpan); return false;">3 episodes, 2016-2017&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0036439/?ref_=ttfc_fc_cl_i20"><img alt="Evan Arnold" src="https://m.media-amazon.com/images/M/MV5BMjFlYWMwNWYtMTg2My00Mzk0LWIxMzEtODhmNjJmNDBiMzRmXkEyXkFqcGdeQXVyMjAwMDkzNTM@._V1_UY44_CR2,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0036439/?ref_=ttfc_fc_cl_t20">Evan Arnold</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm0036439?ref_=ttfc_fc_cl_t20">Jacob Williams</a><a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0036439\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i20\',0,0,\'#episodes-tt4052886-nm0036439-actor\', toggleSpan); return false;">3 episodes, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm1685408/?ref_=ttfc_fc_cl_i21"><img alt="Dawn Olivieri" src="https://m.media-amazon.com/images/M/MV5BODc0ZTdmNDMtN2I4MS00MzdlLTgxNTItNmRhNWMzMDQ5YjMzXkEyXkFqcGdeQXVyMjQwMDg0Ng@@._V1_UY44_CR2,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm1685408/?ref_=ttfc_fc_cl_t21">Dawn Olivieri</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm1685408?ref_=ttfc_fc_cl_t21">Lt. Olivia Monroe</a>&nbsp;/ ...<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm1685408\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i21\',0,0,\'#episodes-tt4052886-nm1685408-actress\', toggleSpan); return false;">2 episodes, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0005496/?ref_=ttfc_fc_cl_i22"><img alt="Heather Tom" src="https://m.media-amazon.com/images/M/MV5BMTkyOTA1MjAwOF5BMl5BanBnXkFtZTcwMDk2MjQ3Mw@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0005496/?ref_=ttfc_fc_cl_t22">Heather Tom</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Malcolm&#39;s Wife / ...<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0005496\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i22\',0,0,\'#episodes-tt4052886-nm0005496-actress\', toggleSpan); return false;">2 episodes, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0000360/?ref_=ttfc_fc_cl_i23"><img alt="Rebecca De Mornay" src="https://m.media-amazon.com/images/M/MV5BMTYzMjk0MzE1OV5BMl5BanBnXkFtZTYwODU3ODgz._V1_UY44_CR2,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0000360/?ref_=ttfc_fc_cl_t23">Rebecca De Mornay</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm0000360?ref_=ttfc_fc_cl_t23">Penelope</a><a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0000360\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i23\',0,0,\'#episodes-tt4052886-nm0000360-actress\', toggleSpan); return false;">2 episodes, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm1447142/?ref_=ttfc_fc_cl_i24"><img alt="Stephen Schneider" src="https://m.media-amazon.com/images/M/MV5BMTUyNjMyODQ1OV5BMl5BanBnXkFtZTgwMzA4MTc1NDE@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm1447142/?ref_=ttfc_fc_cl_t24">Stephen Schneider</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm1447142?ref_=ttfc_fc_cl_t24">Anders Brody</a><a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm1447142\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i24\',0,0,\'#episodes-tt4052886-nm1447142-actor\', toggleSpan); return false;">2 episodes, 2019-2020&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0408284/?ref_=ttfc_fc_cl_i25"><img alt="Michael Imperioli" src="https://m.media-amazon.com/images/M/MV5BMTQ1Nzk2MDg2OV5BMl5BanBnXkFtZTcwNTk4NzQwMw@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0408284/?ref_=ttfc_fc_cl_t25">Michael Imperioli</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm0408284?ref_=ttfc_fc_cl_t25">Uriel</a><a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0408284\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i25\',0,0,\'#episodes-tt4052886-nm0408284-actor\', toggleSpan); return false;">2 episodes, 2016-2017&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm2789953/?ref_=ttfc_fc_cl_i26"><img alt="Lindsey Gort" src="https://m.media-amazon.com/images/M/MV5BYzI5YmFkMzktYjY3Yy00NDJjLWFmMWYtYWY1MjA2MjVkZWI4XkEyXkFqcGdeQXVyMTY4NTk0ODU@._V1_UY44_CR2,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm2789953/?ref_=ttfc_fc_cl_t26">Lindsey Gort</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm2789953?ref_=ttfc_fc_cl_t26">Candy Morningstar</a><a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm2789953\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i26\',0,0,\'#episodes-tt4052886-nm2789953-actress\', toggleSpan); return false;">2 episodes, 2017&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0273371/?ref_=ttfc_fc_cl_i27"><img alt="Alex Fernandez" src="https://m.media-amazon.com/images/M/MV5BMTgzNTQxMDQ3Ml5BMl5BanBnXkFtZTgwMzI4Mzc4NzE@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0273371/?ref_=ttfc_fc_cl_t27">Alex Fernandez</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Perry Smith<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0273371\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i27\',0,0,\'#episodes-tt4052886-nm0273371-actor\', toggleSpan); return false;">2 episodes, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0215229/?ref_=ttfc_fc_cl_i28"><img alt="Tim DeKay" src="https://m.media-amazon.com/images/M/MV5BNzU1MjA1MDQyMl5BMl5BanBnXkFtZTcwMjYwMTIzMQ@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0215229/?ref_=ttfc_fc_cl_t28">Tim DeKay</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Professor Carlisle<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0215229\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i28\',0,0,\'#episodes-tt4052886-nm0215229-actor\', toggleSpan); return false;">2 episodes, 2017&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm1148573/?ref_=ttfc_fc_cl_i29"><img alt="Colin Egglesfield" src="https://m.media-amazon.com/images/M/MV5BMTI5MzEyNzA4Nl5BMl5BanBnXkFtZTcwMTIyOTkyMQ@@._V1_UY44_CR1,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm1148573/?ref_=ttfc_fc_cl_t29">Colin Egglesfield</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Ben Wheeler<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm1148573\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i29\',0,0,\'#episodes-tt4052886-nm1148573-actor\', toggleSpan); return false;">2 episodes, 2016-2018&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0140887/?ref_=ttfc_fc_cl_i30"><img alt="Kevin Carroll" src="https://m.media-amazon.com/images/M/MV5BMDA1ZjJmM2ItNzU4Yi00MzY2LWE0NjYtNjg4NmNmYmMyYWU3XkEyXkFqcGdeQXVyNjAwNjY0NzY@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0140887/?ref_=ttfc_fc_cl_t30">Kevin Carroll</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm0140887?ref_=ttfc_fc_cl_t30">Sinnerman</a><a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0140887\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i30\',0,0,\'#episodes-tt4052886-nm0140887-actor\', toggleSpan); return false;">2 episodes, 2017&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm8154576/?ref_=ttfc_fc_cl_i31"><img alt="Vinessa Vidotto" src="https://m.media-amazon.com/images/M/MV5BNzBkOTUwMDItZGMwNC00YzNiLThiMTctZGI1ZjI2NDY3ZWE4XkEyXkFqcGdeQXVyODQyNzM3MjQ@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm8154576/?ref_=ttfc_fc_cl_t31">Vinessa Vidotto</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm8154576?ref_=ttfc_fc_cl_t31">Remiel</a><a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm8154576\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i31\',0,0,\'#episodes-tt4052886-nm8154576-actress\', toggleSpan); return false;">2 episodes, 2019&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm2006513/?ref_=ttfc_fc_cl_i32"><img alt="Joe Williamson" src="https://m.media-amazon.com/images/M/MV5BOTIyZjJiMzEtYmQxMi00ZjQ4LWI2NTMtMmRhYzcxZDA1M2RlXkEyXkFqcGdeQXVyNzY0MDUxNw@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm2006513/?ref_=ttfc_fc_cl_t32">Joe Williamson</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Burt<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm2006513\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i32\',0,0,\'#episodes-tt4052886-nm2006513-actor\', toggleSpan); return false;">2 episodes, 2017&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm3857399/?ref_=ttfc_fc_cl_i33"><img alt="Erik Stocklin" src="https://m.media-amazon.com/images/M/MV5BYTIwZGY4ZDgtMjJmMC00NzQyLTg3YzAtOGJiNGZlNGEzNmExXkEyXkFqcGdeQXVyMjMxMDI4NDU@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm3857399/?ref_=ttfc_fc_cl_t33">Erik Stocklin</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Julian McCaffrey<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm3857399\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i33\',0,0,\'#episodes-tt4052886-nm3857399-actor\', toggleSpan); return false;">2 episodes, 2019&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0659601/?ref_=ttfc_fc_cl_i34"><img alt="John Pankow" src="https://m.media-amazon.com/images/M/MV5BMjIyMDgyMzQ4OV5BMl5BanBnXkFtZTcwMjE3NzcyNA@@._V1_UY44_CR15,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0659601/?ref_=ttfc_fc_cl_t34">John Pankow</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Jimmy Barnes<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0659601\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i34\',0,0,\'#episodes-tt4052886-nm0659601-actor\', toggleSpan); return false;">2 episodes, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm1058318/?ref_=ttfc_fc_cl_i35"><img alt="David Figlioli" src="https://m.media-amazon.com/images/M/MV5BOTg5Yjc1MjAtYTljMC00NWZkLThjZWQtMTIxMjc0NjdlNjg3XkEyXkFqcGdeQXVyMjQwMDg0Ng@@._V1_UY44_CR1,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm1058318/?ref_=ttfc_fc_cl_t35">David Figlioli</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Les Klumpsky<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm1058318\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i35\',0,0,\'#episodes-tt4052886-nm1058318-actor\', toggleSpan); return false;">2 episodes, 2020&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm5276569/?ref_=ttfc_fc_cl_i36"><img alt="Andrew Baker" src="https://m.media-amazon.com/images/M/MV5BNGM3ZDM4MGUtOTVlNS00ZWQ4LWJiMjAtNzVkODZlZDBkY2YxXkEyXkFqcGdeQXVyNDY5NjIxNDE@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm5276569/?ref_=ttfc_fc_cl_t36">Andrew Baker</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Nervous Uni #1 / ...<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm5276569\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i36\',0,0,\'#episodes-tt4052886-nm5276569-actor\', toggleSpan); return false;">2 episodes, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm3833531/?ref_=ttfc_fc_cl_i37"><img alt="Antonio Cayonne" src="https://m.media-amazon.com/images/M/MV5BMjI1MDMwNTMwM15BMl5BanBnXkFtZTgwNjYwNDI5NTE@._V1_UY44_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm3833531/?ref_=ttfc_fc_cl_t37">Antonio Cayonne</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Uni Cop / ...<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm3833531\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i37\',0,0,\'#episodes-tt4052886-nm3833531-actor\', toggleSpan); return false;">2 episodes, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm1900659/?ref_=ttfc_fc_cl_i38"><img alt="Nelson Wong" src="https://m.media-amazon.com/images/M/MV5BYjc2MzBkN2MtOGQyNS00YjM3LWE0NWYtMTE2N2VmNzBjY2JmXkEyXkFqcGdeQXVyNzY4MzEwNQ@@._V1_UY44_CR6,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm1900659/?ref_=ttfc_fc_cl_t38">Nelson Wong</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Coroner<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm1900659\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i38\',0,0,\'#episodes-tt4052886-nm1900659-actor\', toggleSpan); return false;">2 episodes, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm1820951/?ref_=ttfc_fc_cl_i39"><img alt="Americus Abesamis" src="https://m.media-amazon.com/images/G/01/imdb/images/nopicture/32x44/name-2138558783._CB468460248_.png" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm1820951/?ref_=ttfc_fc_cl_t39">Americus Abesamis</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm1820951?ref_=ttfc_fc_cl_t39">Uni</a><a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm1820951\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i39\',0,0,\'#episodes-tt4052886-nm1820951-actor\', toggleSpan); return false;">2 episodes, 2017-2019&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm6228949/?ref_=ttfc_fc_cl_i40"><img alt="Marcus Anderson Jr." src="https://m.media-amazon.com/images/M/MV5BZGM4NTViNDctOTUyMi00ZThiLTk0NDQtN2Y0NWY4ZDMxMzMzXkEyXkFqcGdeQXVyOTg3MjczODA@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm6228949/?ref_=ttfc_fc_cl_t40">Marcus Anderson Jr.</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Bartender / ...<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm6228949\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i40\',0,0,\'#episodes-tt4052886-nm6228949-actor\', toggleSpan); return false;">2 episodes, 2018-2019&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm2565334/?ref_=ttfc_fc_cl_i41"><img alt="Devielle Johnson" src="https://m.media-amazon.com/images/M/MV5BYzE1OGUyNGQtMGY3Ni00ZjYyLWFlYjgtZDUyMmE3MjY4ZGE4XkEyXkFqcGdeQXVyODg0ODU1MA@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm2565334/?ref_=ttfc_fc_cl_t41">Devielle Johnson</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Officer / ...<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm2565334\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i41\',0,0,\'#episodes-tt4052886-nm2565334-actor\', toggleSpan); return false;">2 episodes, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm4352546/?ref_=ttfc_fc_cl_i42"><img alt="LaFonda Baker" src="https://m.media-amazon.com/images/M/MV5BZWRlYzc0ZDMtYWIxNC00NDFiLTgyNjYtMTQzZDg3NGE1MjQ5XkEyXkFqcGdeQXVyMTUwNzI0NzA@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm4352546/?ref_=ttfc_fc_cl_t42">LaFonda Baker</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Uni<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm4352546\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i42\',0,0,\'#episodes-tt4052886-nm4352546-actress\', toggleSpan); return false;">2 episodes, 2017-2019&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm2979804/?ref_=ttfc_fc_cl_i43"><img alt="Emily Maddison" src="https://m.media-amazon.com/images/M/MV5BMTI1NzVkZGItNDEyMy00ODE0LWEwOTctZmExZWU2MjI2MGRmXkEyXkFqcGdeQXVyNDQ2NDc2MDQ@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm2979804/?ref_=ttfc_fc_cl_t43">Emily Maddison</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Brittanie #2 / ...<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm2979804\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i43\',0,0,\'#episodes-tt4052886-nm2979804-actress\', toggleSpan); return false;">2 episodes, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm3302324/?ref_=ttfc_fc_cl_i44"><img alt="Anthony Pierre Christopher" src="https://m.media-amazon.com/images/M/MV5BMjI5NjMyODY4OV5BMl5BanBnXkFtZTgwMDYxNzMxMjE@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm3302324/?ref_=ttfc_fc_cl_t44">Anthony Pierre Christopher</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm3302324?ref_=ttfc_fc_cl_t44">Raymond</a><a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm3302324\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i44\',0,0,\'#episodes-tt4052886-nm3302324-actor\', toggleSpan); return false;">2 episodes, 2018&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm3517267/?ref_=ttfc_fc_cl_i45"><img alt="Sonia Beeksma" src="https://m.media-amazon.com/images/G/01/imdb/images/nopicture/32x44/name-2138558783._CB468460248_.png" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm3517267/?ref_=ttfc_fc_cl_t45">Sonia Beeksma</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;News Anchor / ...<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm3517267\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i45\',0,0,\'#episodes-tt4052886-nm3517267-actress\', toggleSpan); return false;">2 episodes, 2016-2018&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm7588001/?ref_=ttfc_fc_cl_i46"><img alt="Tina Pham" src="https://m.media-amazon.com/images/G/01/imdb/images/nopicture/32x44/name-2138558783._CB468460248_.png" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm7588001/?ref_=ttfc_fc_cl_t46">Tina Pham</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Brittanie #1 / ...<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm7588001\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i46\',0,0,\'#episodes-tt4052886-nm7588001-actress\', toggleSpan); return false;">2 episodes, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm3265571/?ref_=ttfc_fc_cl_i47"><img alt="Phil Kruse" src="https://m.media-amazon.com/images/M/MV5BYzRmZjFlNzAtYzMwMy00Nzk5LWEwYzItMWJhYjhkMzliN2JmXkEyXkFqcGdeQXVyNTg1MDQzNzQ@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm3265571/?ref_=ttfc_fc_cl_t47">Phil Kruse</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Lucifer / ...<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm3265571\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i47\',0,0,\'#episodes-tt4052886-nm3265571-actor\', toggleSpan); return false;">2 episodes, 2020&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm7071706/?ref_=ttfc_fc_cl_i48"><img alt="Caroline Kwan" src="https://m.media-amazon.com/images/M/MV5BYzViYTU2MWUtNDgxMi00OGFiLWEwNzUtNGVhODczNDBlYzMwXkEyXkFqcGdeQXVyNTY2Mzc0NjM@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm7071706/?ref_=ttfc_fc_cl_t48">Caroline Kwan</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm7071706?ref_=ttfc_fc_cl_t48">Top Hat Lady</a>&nbsp;/ ...<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm7071706\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i48\',0,0,\'#episodes-tt4052886-nm7071706-actress\', toggleSpan); return false;">2 episodes, 2017-2018&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0799918/?ref_=ttfc_fc_cl_i49"><img alt="Todd Simmons" src="https://m.media-amazon.com/images/G/01/imdb/images/nopicture/32x44/name-2138558783._CB468460248_.png" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0799918/?ref_=ttfc_fc_cl_t49">Todd Simmons</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Uni / ...<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0799918\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i49\',0,0,\'#episodes-tt4052886-nm0799918-actor\', toggleSpan); return false;">2 episodes, 2016-2017&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm1190373/?ref_=ttfc_fc_cl_i50"><img alt="Ashton Moio" src="https://m.media-amazon.com/images/M/MV5BOGI2YWE5ZGItMDI5Zi00NzZkLThjN2QtMjczMjVhMzNiYjVhXkEyXkFqcGdeQXVyMjIzNzAwMzE@._V1_UY44_CR15,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm1190373/?ref_=ttfc_fc_cl_t50">Ashton Moio</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Driver<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm1190373\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i50\',0,0,\'#episodes-tt4052886-nm1190373-actor\', toggleSpan); return false;">2 episodes, 2017&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm7258626/?ref_=ttfc_fc_cl_i51"><img alt="Victoria Katongo" src="https://m.media-amazon.com/images/G/01/imdb/images/nopicture/32x44/name-2138558783._CB468460248_.png" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm7258626/?ref_=ttfc_fc_cl_t51">Victoria Katongo</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Cute Female Uni Cop / ...<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm7258626\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i51\',0,0,\'#episodes-tt4052886-nm7258626-actress\', toggleSpan); return false;">2 episodes, 2016-2017&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm3599152/?ref_=ttfc_fc_cl_i52"><img alt="Teana-Marie Smith" src="https://m.media-amazon.com/images/M/MV5BMTc5NDUxNDM2OV5BMl5BanBnXkFtZTgwODIzMjI0MDE@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm3599152/?ref_=ttfc_fc_cl_t52">Teana-Marie Smith</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Tech / ...<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm3599152\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i52\',0,0,\'#episodes-tt4052886-nm3599152-actress\', toggleSpan); return false;">2 episodes, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0371660/?ref_=ttfc_fc_cl_i53"><img alt="Dennis Haysbert" src="https://m.media-amazon.com/images/M/MV5BMTQxNjgyNjE4NV5BMl5BanBnXkFtZTcwNzI1MjQ4Ng@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0371660/?ref_=ttfc_fc_cl_t53">Dennis Haysbert</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm0371660?ref_=ttfc_fc_cl_t53">God</a><a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0371660\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i53\',0,0,\'#episodes-tt4052886-nm0371660-actor\', toggleSpan); return false;">2 episodes, 2020&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm1930228/?ref_=ttfc_fc_cl_i54"><img alt="Joy Osmanski" src="https://m.media-amazon.com/images/M/MV5BM2MyNzRlNjUtY2M5MS00YmI2LTg5ZWItNWMyMGU1YjNkZTJmXkEyXkFqcGdeQXVyMTM4ODMyMDE@._V1_UY44_CR17,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm1930228/?ref_=ttfc_fc_cl_t54">Joy Osmanski</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm1930228?ref_=ttfc_fc_cl_t54">Alexandra Shaw</a>&nbsp;/ ...<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm1930228\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i54\',0,0,\'#episodes-tt4052886-nm1930228-actress\', toggleSpan); return false;">2 episodes, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0668283/?ref_=ttfc_fc_cl_i55"><img alt="Chris Payne Gilbert" src="https://m.media-amazon.com/images/M/MV5BMTQ1NTgyMjE1M15BMl5BanBnXkFtZTgwMDY5NjYyNzE@._V1_UY44_CR7,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0668283/?ref_=ttfc_fc_cl_t55">Chris Payne Gilbert</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;John Decker<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0668283\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i55\',0,0,\'#episodes-tt4052886-nm0668283-actor\', toggleSpan); return false;">2 episodes, 2016-2020&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm5636094/?ref_=ttfc_fc_cl_i56"><img alt="Ese Atawo" src="https://m.media-amazon.com/images/M/MV5BZTk2NzhkN2MtNjcwNS00YjgyLWExZDAtNzcyNjk0YTFlMGI2XkEyXkFqcGdeQXVyMjQwMDg0Ng@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm5636094/?ref_=ttfc_fc_cl_t56">Ese Atawo</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Bystander<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm5636094\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i56\',0,0,\'#episodes-tt4052886-nm5636094-actress\', toggleSpan); return false;">2 episodes, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm5615567/?ref_=ttfc_fc_cl_i57"><img alt="Eddie Flake" src="https://m.media-amazon.com/images/M/MV5BMDI3Y2U4NjUtMzQ2Ni00YjEwLTk1NjMtMWQwNDE0ODkyNjhmXkEyXkFqcGdeQXVyMjQwMDg0Ng@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm5615567/?ref_=ttfc_fc_cl_t57">Eddie Flake</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Uni / ...<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm5615567\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i57\',0,0,\'#episodes-tt4052886-nm5615567-actor\', toggleSpan); return false;">2 episodes, 2020&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm5147862/?ref_=ttfc_fc_cl_i58"><img alt="James Paladino" src="https://m.media-amazon.com/images/M/MV5BZWMzMjFhYzAtMWIwZS00YzVjLTg2NjMtNDRlOTIzNzZmYzNjXkEyXkFqcGdeQXVyMjcyOTM2MTQ@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm5147862/?ref_=ttfc_fc_cl_t58">James Paladino</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Hipster<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm5147862\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i58\',0,0,\'#episodes-tt4052886-nm5147862-actor\', toggleSpan); return false;">2 episodes, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm4368020/?ref_=ttfc_fc_cl_i59"><img alt="Alexandra Grossi" src="https://m.media-amazon.com/images/M/MV5BYjZmNDZlZDktZTkwMC00ZmU0LWFkZmQtNmQwNTMxYmJmNzdjXkEyXkFqcGdeQXVyMTg1NTA5MDE@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm4368020/?ref_=ttfc_fc_cl_t59">Alexandra Grossi</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Adriana Nassar<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm4368020\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i59\',0,0,\'#episodes-tt4052886-nm4368020-actress\', toggleSpan); return false;">2 episodes, 2020&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm3725752/?ref_=ttfc_fc_cl_i60"><img alt="Marisa Emma Smith" src="https://m.media-amazon.com/images/G/01/imdb/images/nopicture/32x44/name-2138558783._CB468460248_.png" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm3725752/?ref_=ttfc_fc_cl_t60">Marisa Emma Smith</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Tiffany<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm3725752\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i60\',0,0,\'#episodes-tt4052886-nm3725752-actress\', toggleSpan); return false;">2 episodes, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm5329944/?ref_=ttfc_fc_cl_i61"><img alt="Adil Zaidi" src="https://m.media-amazon.com/images/M/MV5BMzg5Mzc4MTYtOGYyZC00Y2E2LTliMTUtM2I5ZTU5NTVjMjhlXkEyXkFqcGdeQXVyMjQwMDg0Ng@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm5329944/?ref_=ttfc_fc_cl_t61">Adil Zaidi</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Grieving Man<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm5329944\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i61\',0,0,\'#episodes-tt4052886-nm5329944-actor\', toggleSpan); return false;">2 episodes, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm7732099/?ref_=ttfc_fc_cl_i62"><img alt="Myrasol Martinez" src="https://m.media-amazon.com/images/M/MV5BOWUxNzhjYWQtNDg0ZC00MTVhLTllZjctNmJiZWE3MDA3ZWYyXkEyXkFqcGdeQXVyMjQwMDg0Ng@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm7732099/?ref_=ttfc_fc_cl_t62">Myrasol Martinez</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Front Desk Girl / ...<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm7732099\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i62\',0,0,\'#episodes-tt4052886-nm7732099-actress\', toggleSpan); return false;">2 episodes, 2017-2018&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm10832107/?ref_=ttfc_fc_cl_i63"><img alt="Paloma Alvarez" src="https://m.media-amazon.com/images/M/MV5BMDE2MDliYWEtNTg4ZC00YTg5LThiY2YtZWNjZTg2MWI3ZTkwXkEyXkFqcGdeQXVyMzA2NzEwNzM@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm10832107/?ref_=ttfc_fc_cl_t63">Paloma Alvarez</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Joan<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm10832107\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i63\',0,0,\'#episodes-tt4052886-nm10832107-actress\', toggleSpan); return false;">2 episodes, 2019&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm10720409/?ref_=ttfc_fc_cl_i64"><img alt="Amor Doomes" src="https://m.media-amazon.com/images/G/01/imdb/images/nopicture/32x44/name-2138558783._CB468460248_.png" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm10720409/?ref_=ttfc_fc_cl_t64">Amor Doomes</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Charlie<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm10720409\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i64\',0,0,\'#episodes-tt4052886-nm10720409-actor\', toggleSpan); return false;">2 episodes, 2019&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm10720408/?ref_=ttfc_fc_cl_i65"><img alt="Tyson Pickens" src="https://m.media-amazon.com/images/G/01/imdb/images/nopicture/32x44/name-2138558783._CB468460248_.png" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm10720408/?ref_=ttfc_fc_cl_t65">Tyson Pickens</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Charlie<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm10720408\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i65\',0,0,\'#episodes-tt4052886-nm10720408-actor\', toggleSpan); return false;">2 episodes, 2019&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm10720410/?ref_=ttfc_fc_cl_i66"><img alt="Ryla Taylor" src="https://m.media-amazon.com/images/G/01/imdb/images/nopicture/32x44/name-2138558783._CB468460248_.png" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm10720410/?ref_=ttfc_fc_cl_t66">Ryla Taylor</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Charlie<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm10720410\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i66\',0,0,\'#episodes-tt4052886-nm10720410-actress\', toggleSpan); return false;">2 episodes, 2019&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0010486/?ref_=ttfc_fc_cl_i67"><img alt="Mark Adair-Rios" src="https://m.media-amazon.com/images/M/MV5BNjlmZmZiZTctNmUzMS00ZDYzLWE1OTMtNDA2ZTBlMDBkMWQ4XkEyXkFqcGdeQXVyMjQwMDg0Ng@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0010486/?ref_=ttfc_fc_cl_t67">Mark Adair-Rios</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Juan Perez<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0010486\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i67\',0,0,\'#episodes-tt4052886-nm0010486-actor\', toggleSpan); return false;">2 episodes, 2020&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm4924024/?ref_=ttfc_fc_cl_i68"><img alt="Elena Dizon" src="https://m.media-amazon.com/images/M/MV5BYjk3NDU4ZmQtYTZkMi00ZDE5LTgxMGUtYzllMzJlZGYwOGQwXkEyXkFqcGdeQXVyMzE3ODA0OTQ@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm4924024/?ref_=ttfc_fc_cl_t68">Elena Dizon</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Flag Girl<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm4924024\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i68\',0,0,\'#episodes-tt4052886-nm4924024-actress\', toggleSpan); return false;">2 episodes, 2020&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm4495094/?ref_=ttfc_fc_cl_i69"><img alt="Jenny Tran" src="https://m.media-amazon.com/images/M/MV5BMmQ2OTBiMWItY2M1MC00NTU2LWFkYTgtYzM2YmViMzhmZTk2XkEyXkFqcGdeQXVyMjQwMDg0Ng@@._V1_UY44_CR17,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm4495094/?ref_=ttfc_fc_cl_t69">Jenny Tran</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Larper Kim<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm4495094\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i69\',0,0,\'#episodes-tt4052886-nm4495094-actress\', toggleSpan); return false;">1 episode, 2020&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0001111/?ref_=ttfc_fc_cl_i70"><img alt="Jeremy Davies" src="https://m.media-amazon.com/images/M/MV5BMTg4MDMwOTQyMF5BMl5BanBnXkFtZTcwNDQxMzc0Mw@@._V1_UY44_CR1,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0001111/?ref_=ttfc_fc_cl_t70">Jeremy Davies</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm0001111?ref_=ttfc_fc_cl_t70">Nick Hofmeister</a><a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0001111\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i70\',0,0,\'#episodes-tt4052886-nm0001111-actor\', toggleSpan); return false;">1 episode, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0429114/?ref_=ttfc_fc_cl_i71"><img alt="Richard T. Jones" src="https://m.media-amazon.com/images/M/MV5BMTIwNTk3MzU0Ml5BMl5BanBnXkFtZTYwMDIwMzIz._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0429114/?ref_=ttfc_fc_cl_t71">Richard T. Jones</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Joe Hanson<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0429114\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i71\',0,0,\'#episodes-tt4052886-nm0429114-actor\', toggleSpan); return false;">1 episode, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm1715118/?ref_=ttfc_fc_cl_i72"><img alt="AnnaLynne McCord" src="https://m.media-amazon.com/images/M/MV5BZWVjNzEyZGYtYTZhMi00NjA5LTgxYmQtNTc1NDMzMzg2NzBjXkEyXkFqcGdeQXVyNDY5Njg3NTQ@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm1715118/?ref_=ttfc_fc_cl_t72">AnnaLynne McCord</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Delilah<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm1715118\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i72\',0,0,\'#episodes-tt4052886-nm1715118-actress\', toggleSpan); return false;">1 episode, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0001744/?ref_=ttfc_fc_cl_i73"><img alt="Tom Sizemore" src="https://m.media-amazon.com/images/M/MV5BMTUyMzQ3NDg5N15BMl5BanBnXkFtZTYwMzc0Mjk2._V1_UY44_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0001744/?ref_=ttfc_fc_cl_t73">Tom Sizemore</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm0001744?ref_=ttfc_fc_cl_t73">Hank Cutter</a><a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0001744\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i73\',0,0,\'#episodes-tt4052886-nm0001744-actor\', toggleSpan); return false;">1 episode, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm1472010/?ref_=ttfc_fc_cl_i74"><img alt="Justin Bruening" src="https://m.media-amazon.com/images/M/MV5BYmY5MmY1ODgtMGFjMC00Nzk5LWFhOWItMDA3NzllNDQyYjYwXkEyXkFqcGdeQXVyMTcyMjU3Njc@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm1472010/?ref_=ttfc_fc_cl_t74">Justin Bruening</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm1472010?ref_=ttfc_fc_cl_t74">Jed Carnal</a><a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm1472010\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i74\',0,0,\'#episodes-tt4052886-nm1472010-actor\', toggleSpan); return false;">1 episode, 2020&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0171583/?ref_=ttfc_fc_cl_i75"><img alt="Ivonne Coll" src="https://m.media-amazon.com/images/M/MV5BMTIyODY1NjM3OV5BMl5BanBnXkFtZTcwMzQwMzk5MQ@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0171583/?ref_=ttfc_fc_cl_t75">Ivonne Coll</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Sister Angelica<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0171583\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i75\',0,0,\'#episodes-tt4052886-nm0171583-actress\', toggleSpan); return false;">1 episode, 2020&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm1752212/?ref_=ttfc_fc_cl_i76"><img alt="Alex Quijano" src="https://m.media-amazon.com/images/M/MV5BMzBkNGNmY2UtOTc4OS00ODI5LTk0OGItMDk0YzAxZGQ5NmQ1XkEyXkFqcGdeQXVyMjM0Nzc0NzE@._V1_UY44_CR1,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm1752212/?ref_=ttfc_fc_cl_t76">Alex Quijano</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm1752212?ref_=ttfc_fc_cl_t76">Lieutenant Diablo</a><a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm1752212\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i76\',0,0,\'#episodes-tt4052886-nm1752212-actor\', toggleSpan); return false;">1 episode, 2020&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0151668/?ref_=ttfc_fc_cl_i77"><img alt="Christina Chang" src="https://m.media-amazon.com/images/M/MV5BZDhiNjg3ZTctYWE1MS00OGVjLThhMGQtZDVkMTc4NDAyNDMxXkEyXkFqcGdeQXVyMTQ5NjA5NzY@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0151668/?ref_=ttfc_fc_cl_t77">Christina Chang</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm0151668?ref_=ttfc_fc_cl_t77">Vanessa Dunlear</a><a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0151668\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i77\',0,0,\'#episodes-tt4052886-nm0151668-actress\', toggleSpan); return false;">1 episode, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0003082/?ref_=ttfc_fc_cl_i78"><img alt="Bailey Chase" src="https://m.media-amazon.com/images/M/MV5BMzU1NDM2MzAxNF5BMl5BanBnXkFtZTgwMDcxMzkzNzE@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0003082/?ref_=ttfc_fc_cl_t78">Bailey Chase</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Grey Cooper<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0003082\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i78\',0,0,\'#episodes-tt4052886-nm0003082-actor\', toggleSpan); return false;">1 episode, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0231458/?ref_=ttfc_fc_cl_i79"><img alt="Colman Domingo" src="https://m.media-amazon.com/images/M/MV5BMmNmNDljMGYtZmI4Yi00ZGRkLWE3ZWMtZmEyOTE3OGM2MzY1XkEyXkFqcGdeQXVyMzE2ODE2NQ@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0231458/?ref_=ttfc_fc_cl_t79">Colman Domingo</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm0231458?ref_=ttfc_fc_cl_t79">Father Frank Lawrence</a><a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0231458\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i79\',0,0,\'#episodes-tt4052886-nm0231458-actor\', toggleSpan); return false;">1 episode, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0335242/?ref_=ttfc_fc_cl_i80"><img alt="Teach Grant" src="https://m.media-amazon.com/images/M/MV5BMGJiMGUzMTgtNTVjMC00OGUyLWI1NDQtNDExNTU0ODQyNTgxXkEyXkFqcGdeQXVyMjQwMDg0Ng@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0335242/?ref_=ttfc_fc_cl_t80">Teach Grant</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Renny<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0335242\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i80\',0,0,\'#episodes-tt4052886-nm0335242-actor\', toggleSpan); return false;">1 episode, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0549815/?ref_=ttfc_fc_cl_i81"><img alt="Chris Marquette" src="https://m.media-amazon.com/images/M/MV5BYTllZGE5MzQtMmE1OS00MzcxLWEwMWItZmMxYWQ2Mjk1MTliXkEyXkFqcGdeQXVyMjQwMDg0Ng@@._V1_UY44_CR14,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0549815/?ref_=ttfc_fc_cl_t81">Chris Marquette</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Carver Cruz<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0549815\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i81\',0,0,\'#episodes-tt4052886-nm0549815-actor\', toggleSpan); return false;">1 episode, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0005281/?ref_=ttfc_fc_cl_i82"><img alt="Jodi Lyn O\'Keefe" src="https://m.media-amazon.com/images/M/MV5BODgxMDUwMzczMV5BMl5BanBnXkFtZTgwNjc3MzYyMDE@._V1_UY44_CR1,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0005281/?ref_=ttfc_fc_cl_t82">Jodi Lyn O&#39;Keefe</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Ronnie Hillman<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0005281\',\'tt4052886\',\'actress\',\'ttfc_fc_cl_i82\',0,0,\'#episodes-tt4052886-nm0005281-actress\', toggleSpan); return false;">1 episode, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0711110/?ref_=ttfc_fc_cl_i83"><img alt="Jim Rash" src="https://m.media-amazon.com/images/M/MV5BMTg2MzU2NjMzMV5BMl5BanBnXkFtZTcwMjU5NTMwNw@@._V1_UY44_CR17,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0711110/?ref_=ttfc_fc_cl_t83">Jim Rash</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm0711110?ref_=ttfc_fc_cl_t83">Richard Kester</a><a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0711110\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i83\',0,0,\'#episodes-tt4052886-nm0711110-actor\', toggleSpan); return false;">1 episode, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0722647/?ref_=ttfc_fc_cl_i84"><img alt="Robert Ri\'chard" src="https://m.media-amazon.com/images/M/MV5BMTc4Njc5NDc4Nl5BMl5BanBnXkFtZTYwNzU2NTM1._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0722647/?ref_=ttfc_fc_cl_t84">Robert Ri&#39;chard</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt4052886/characters/nm0722647?ref_=ttfc_fc_cl_t84">Josh Bryant</a><a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0722647\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i84\',0,0,\'#episodes-tt4052886-nm0722647-actor\', toggleSpan); return false;">1 episode, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm1102244/?ref_=ttfc_fc_cl_i85"><img alt="Eddie Shin" src="https://m.media-amazon.com/images/M/MV5BMTkxMDQ2MzQ1Ml5BMl5BanBnXkFtZTgwNzY0MTY3MTE@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm1102244/?ref_=ttfc_fc_cl_t85">Eddie Shin</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Benny Choi<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm1102244\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i85\',0,0,\'#episodes-tt4052886-nm1102244-actor\', toggleSpan); return false;">1 episode, 2016&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm2159326/?ref_=ttfc_fc_cl_i86"><img alt="Giovanni Bejarano" src="https://m.media-amazon.com/images/M/MV5BYzVlOTA1YTEtZjk3My00MzNjLThhYTUtYzk2MWJjMDhjNTYwXkEyXkFqcGdeQXVyMjQwMDg0Ng@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm2159326/?ref_=ttfc_fc_cl_t86">Giovanni Bejarano</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Mario Canales<a href="https://www.imdb.com/title/tt4052886/fullcredits?ref_=tt_cl_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm2159326\',\'tt4052886\',\'actor\',\'ttfc_fc_cl_i86\',0,0,\'#episodes-tt4052886-nm2159326-actor\', toggleSpan); return false;">1 episode, 2020&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0129749/?ref_=ttfc_fc_cl_i87"><img alt="L. Scott Caldwell" src="https://m.', 1, '2020-09-24 07:59:46', '2020-09-24 07:59:46');
INSERT INTO `cast_crews` (`id`, `unique_id`, `name`, `image`, `description`, `status`, `created_at`, `updated_at`) VALUES
(63, 'Creators:-David-Benioff,-D.B.-Weiss-Stars:-Emilia-Clarke,-Peter-Dinklage,-Kit-Harington5f6c8fd6ad1ca', 'Creators: David Benioff, D.B. Weiss Stars: Emilia Clarke, Peter Dinklage, Kit Harington', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-09-24-12-23-50-1009b8f881b35b250156be18e29814a952f1d268.jpg', '<p>Creators:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm1125275/?ref_=tt_ov_wr">David Benioff</a>,&nbsp;<a href="https://www.imdb.com/name/nm1888967/?ref_=tt_ov_wr">D.B. Weiss</a></p>\r\n\r\n<p>Stars:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm3592338/?ref_=tt_ov_st_sm">Emilia Clarke</a>,&nbsp;<a href="https://www.imdb.com/name/nm0227759/?ref_=tt_ov_st_sm">Peter Dinklage</a>,&nbsp;<a href="https://www.imdb.com/name/nm3229685/?ref_=tt_ov_st_sm">Kit Harington</a></p>', 1, '2020-09-24 12:23:50', '2021-04-27 23:48:24'),
(64, 'Creators:-Greg-Daniels,-Ricky-Gervais,-Stephen-Merchant-:--Stars:-Steve-Carell,-Jenna-Fischer,-John-Krasinski5fad2516a8780', 'Creators: Greg Daniels, Ricky Gervais, Stephen Merchant :  Stars: Steve Carell, Jenna Fischer, John Krasinski', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-09-24-12-40-37-71f2c23507e21e0a1af0b5b909ddef8de33d79d3.jpg', '<p>Creators:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0199948/?ref_=tt_ov_wr">Greg Daniels</a>,&nbsp;<a href="https://www.imdb.com/name/nm0315041/?ref_=tt_ov_wr">Ricky Gervais</a>,&nbsp;<a href="https://www.imdb.com/name/nm0580351/?ref_=tt_ov_wr">Stephen Merchant</a></p>\r\n\r\n<p>Stars:</p>\r\n\r\n<p>&nbsp;<a href="https://www.imdb.com/name/nm0136797/?ref_=tt_ov_st_sm">Steve Carell</a>,&nbsp;<a href="https://www.imdb.com/name/nm0278979/?ref_=tt_ov_st_sm">Jenna Fischer</a>,&nbsp;<a href="https://www.imdb.com/name/nm1024677/?ref_=tt_ov_st_sm">John Krasinski</a></p>', 1, '2020-09-24 12:40:37', '2021-02-20 14:35:54');
INSERT INTO `cast_crews` (`id`, `unique_id`, `name`, `image`, `description`, `status`, `created_at`, `updated_at`) VALUES
(65, 'Stars:-Bryan-Cranston,-Aaron-Paul,-Anna-Gunn5f70078b8b985', 'Stars: Bryan Cranston, Aaron Paul, Anna Gunn', 'http://adminview.streamhash.com/uploads/images/cast_crews/SV-2020-09-27-03-31-23-9d86ed5ec4475963605401cd98550a18a24da9ad.jpg', '<table>\r\n	<tbody>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0186505/?ref_=ttfc_fc_cl_i1"><img alt="Bryan Cranston" src="https://m.media-amazon.com/images/M/MV5BMTA2NjEyMTY4MTVeQTJeQWpwZ15BbWU3MDQ5NDAzNDc@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0186505/?ref_=ttfc_fc_cl_t1">Bryan Cranston</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0186505?ref_=ttfc_fc_cl_t1">Walter White</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0186505\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i1\',0,0,\'#episodes-tt0903747-nm0186505-actor\', toggleSpan); return false;">62 episodes, 2008-2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0348152/?ref_=ttfc_fc_cl_i2"><img alt="Anna Gunn" src="https://m.media-amazon.com/images/M/MV5BMTU0NTk3MDQ3OV5BMl5BanBnXkFtZTcwNDY3NzQ4Mg@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0348152/?ref_=ttfc_fc_cl_t2">Anna Gunn</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0348152?ref_=ttfc_fc_cl_t2">Skyler White</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0348152\',\'tt0903747\',\'actress\',\'ttfc_fc_cl_i2\',0,0,\'#episodes-tt0903747-nm0348152-actress\', toggleSpan); return false;">62 episodes, 2008-2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0666739/?ref_=ttfc_fc_cl_i3"><img alt="Aaron Paul" src="https://m.media-amazon.com/images/M/MV5BMTY1OTY5NjI5NV5BMl5BanBnXkFtZTcwODA4MjM0OA@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0666739/?ref_=ttfc_fc_cl_t3">Aaron Paul</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0666739?ref_=ttfc_fc_cl_t3">Jesse Pinkman</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0666739\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i3\',0,0,\'#episodes-tt0903747-nm0666739-actor\', toggleSpan); return false;">62 episodes, 2008-2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm1336827/?ref_=ttfc_fc_cl_i4"><img alt="Betsy Brandt" src="https://m.media-amazon.com/images/M/MV5BMTU2OTQ3MzcxMV5BMl5BanBnXkFtZTcwMTk2MTk3Mw@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm1336827/?ref_=ttfc_fc_cl_t4">Betsy Brandt</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm1336827?ref_=ttfc_fc_cl_t4">Marie Schrader</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm1336827\',\'tt0903747\',\'actress\',\'ttfc_fc_cl_i4\',0,0,\'#episodes-tt0903747-nm1336827-actress\', toggleSpan); return false;">62 episodes, 2008-2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm2666409/?ref_=ttfc_fc_cl_i5"><img alt="RJ Mitte" src="https://m.media-amazon.com/images/M/MV5BMTgxNDc1OTEwN15BMl5BanBnXkFtZTcwOTQyMTIwOQ@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm2666409/?ref_=ttfc_fc_cl_t5">RJ Mitte</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm2666409?ref_=ttfc_fc_cl_t5">Walter White, Jr.</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm2666409\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i5\',0,0,\'#episodes-tt0903747-nm2666409-actor\', toggleSpan); return false;">62 episodes, 2008-2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0606487/?ref_=ttfc_fc_cl_i6"><img alt="Dean Norris" src="https://m.media-amazon.com/images/M/MV5BMTUzOTQ2NDIzOF5BMl5BanBnXkFtZTcwMTE0OTYwOQ@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0606487/?ref_=ttfc_fc_cl_t6">Dean Norris</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0606487?ref_=ttfc_fc_cl_t6">Hank Schrader</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0606487\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i6\',0,0,\'#episodes-tt0903747-nm0606487-actor\', toggleSpan); return false;">62 episodes, 2008-2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0644022/?ref_=ttfc_fc_cl_i7"><img alt="Bob Odenkirk" src="https://m.media-amazon.com/images/M/MV5BOWM5MDJjYTItMTRkNC00NTQ4LThkNjUtNDY3Mzk0YWMwMTBhXkEyXkFqcGdeQXVyNzQzNDYwMA@@._V1_UY44_CR1,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0644022/?ref_=ttfc_fc_cl_t7">Bob Odenkirk</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0644022?ref_=ttfc_fc_cl_t7">Saul Goodman</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0644022\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i7\',0,0,\'#episodes-tt0903747-nm0644022-actor\', toggleSpan); return false;">43 episodes, 2009-2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm2366374/?ref_=ttfc_fc_cl_i8"><img alt="Steven Michael Quezada" src="https://m.media-amazon.com/images/M/MV5BZmRlYjBkNzctZjg5MC00MGQyLTg4MmQtMmIzMzYwMWYxYTMzXkEyXkFqcGdeQXVyNzU1MzA1Ng@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm2366374/?ref_=ttfc_fc_cl_t8">Steven Michael Quezada</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm2366374?ref_=ttfc_fc_cl_t8">Steven Gomez</a>&nbsp;/ ...<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm2366374\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i8\',0,0,\'#episodes-tt0903747-nm2366374-actor\', toggleSpan); return false;">34 episodes, 2008-2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0052186/?ref_=ttfc_fc_cl_i9"><img alt="Jonathan Banks" src="https://m.media-amazon.com/images/M/MV5BMjI3MTE0OTI0MF5BMl5BanBnXkFtZTcwMzc2MzU3NQ@@._V1_UY44_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0052186/?ref_=ttfc_fc_cl_t9">Jonathan Banks</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0052186?ref_=ttfc_fc_cl_t9">Mike Ehrmantraut</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0052186\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i9\',0,0,\'#episodes-tt0903747-nm0052186-actor\', toggleSpan); return false;">28 episodes, 2009-2012&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0002064/?ref_=ttfc_fc_cl_i10"><img alt="Giancarlo Esposito" src="https://m.media-amazon.com/images/M/MV5BMjEyODM1NjI0OF5BMl5BanBnXkFtZTcwMTE0OTA1Mg@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0002064/?ref_=ttfc_fc_cl_t10">Giancarlo Esposito</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0002064?ref_=ttfc_fc_cl_t10">Gus Fring</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0002064\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i10\',0,0,\'#episodes-tt0903747-nm0002064-actor\', toggleSpan); return false;">26 episodes, 2009-2011&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm1889973/?ref_=ttfc_fc_cl_i11"><img alt="Charles Baker" src="https://m.media-amazon.com/images/M/MV5BMTcyODQwNzkxNl5BMl5BanBnXkFtZTgwNjYzOTY0MzE@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm1889973/?ref_=ttfc_fc_cl_t11">Charles Baker</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm1889973?ref_=ttfc_fc_cl_t11">Skinny Pete</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm1889973\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i11\',0,0,\'#episodes-tt0903747-nm1889973-actor\', toggleSpan); return false;">15 episodes, 2008-2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0687146/?ref_=ttfc_fc_cl_i12"><img alt="Jesse Plemons" src="https://m.media-amazon.com/images/M/MV5BMTQ3NjM1NjM0N15BMl5BanBnXkFtZTcwMDUxNjk3Nw@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0687146/?ref_=ttfc_fc_cl_t12">Jesse Plemons</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0687146?ref_=ttfc_fc_cl_t12">Todd</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0687146\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i12\',0,0,\'#episodes-tt0903747-nm0687146-actor\', toggleSpan); return false;">13 episodes, 2012-2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0184086/?ref_=ttfc_fc_cl_i13"><img alt="Christopher Cousins" src="https://m.media-amazon.com/images/M/MV5BMTYyMTAwMzE4Ml5BMl5BanBnXkFtZTgwOTQ5MDk3MTE@._V1_UY44_CR3,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0184086/?ref_=ttfc_fc_cl_t13">Christopher Cousins</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0184086?ref_=ttfc_fc_cl_t13">Ted Beneke</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0184086\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i13\',0,0,\'#episodes-tt0903747-nm0184086-actor\', toggleSpan); return false;">13 episodes, 2009-2012&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0292182/?ref_=ttfc_fc_cl_i14"><img alt="Laura Fraser" src="https://m.media-amazon.com/images/M/MV5BMTIzMjc0MzgxMl5BMl5BanBnXkFtZTcwNTY5NjQ2MQ@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0292182/?ref_=ttfc_fc_cl_t14">Laura Fraser</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0292182?ref_=ttfc_fc_cl_t14">Lydia Rodarte-Quayle</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0292182\',\'tt0903747\',\'actress\',\'ttfc_fc_cl_i14\',0,0,\'#episodes-tt0903747-nm0292182-actress\', toggleSpan); return false;">12 episodes, 2012-2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm2804503/?ref_=ttfc_fc_cl_i15"><img alt="Matt Jones" src="https://m.media-amazon.com/images/M/MV5BNTNiMTRhYWItYWU3Ni00OGVlLWE4NGEtYmUyMjJjNGM0NWQ1XkEyXkFqcGdeQXVyMjM0NDQ2MTQ@._V1_UY44_CR17,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm2804503/?ref_=ttfc_fc_cl_t15">Matt Jones</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm2804503?ref_=ttfc_fc_cl_t15">Badger</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm2804503\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i15\',0,0,\'#episodes-tt0903747-nm2804503-actor\', toggleSpan); return false;">12 episodes, 2008-2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0928795/?ref_=ttfc_fc_cl_i16"><img alt="Michael Shamus Wiles" src="https://m.media-amazon.com/images/M/MV5BMTkwMTkxNjUzM15BMl5BanBnXkFtZTgwMTg5MTczMTE@._V1_UY44_CR23,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0928795/?ref_=ttfc_fc_cl_t16">Michael Shamus Wiles</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;ASAC George Merkert<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0928795\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i16\',0,0,\'#episodes-tt0903747-nm0928795-actor\', toggleSpan); return false;">11 episodes, 2009-2012&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm1089417/?ref_=ttfc_fc_cl_i17"><img alt="Lavell Crawford" src="https://m.media-amazon.com/images/M/MV5BMjExNzkyNDYxM15BMl5BanBnXkFtZTgwNjM3NzEyMjE@._V1_UY44_CR13,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm1089417/?ref_=ttfc_fc_cl_t17">Lavell Crawford</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm1089417?ref_=ttfc_fc_cl_t17">Huell</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm1089417\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i17\',0,0,\'#episodes-tt0903747-nm1089417-actor\', toggleSpan); return false;">11 episodes, 2011-2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm1530474/?ref_=ttfc_fc_cl_i18"><img alt="Ray Campbell" src="https://m.media-amazon.com/images/M/MV5BZTVhM2RmODEtNjkwMi00OGE4LWJiM2ItMTEwM2Y0YTA1Yjc0XkEyXkFqcGdeQXVyMTk3NzM5NjI@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm1530474/?ref_=ttfc_fc_cl_t18">Ray Campbell</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm1530474?ref_=ttfc_fc_cl_t18">Tyrus Kitt</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm1530474\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i18\',0,0,\'#episodes-tt0903747-nm1530474-actor\', toggleSpan); return false;">10 episodes, 2011&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm1269983/?ref_=ttfc_fc_cl_i19"><img alt="Krysten Ritter" src="https://m.media-amazon.com/images/M/MV5BYzkyMmRiOTgtNDI5ZS00NzRhLWE2YTUtZjRkMDA4ODZmOWMzXkEyXkFqcGdeQXVyMjU2NzY4MQ@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm1269983/?ref_=ttfc_fc_cl_t19">Krysten Ritter</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm1269983?ref_=ttfc_fc_cl_t19">Jane Margolis</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm1269983\',\'tt0903747\',\'actress\',\'ttfc_fc_cl_i19\',0,0,\'#episodes-tt0903747-nm1269983-actress\', toggleSpan); return false;">10 episodes, 2009-2010&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0784831/?ref_=ttfc_fc_cl_i20"><img alt="Carmen Serano" src="https://m.media-amazon.com/images/M/MV5BMTc4OTQwNDM0MV5BMl5BanBnXkFtZTcwNTkyNTIzMQ@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0784831/?ref_=ttfc_fc_cl_t20">Carmen Serano</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0784831?ref_=ttfc_fc_cl_t20">Carmen Molina</a>&nbsp;/ ...<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0784831\',\'tt0903747\',\'actress\',\'ttfc_fc_cl_i20\',0,0,\'#episodes-tt0903747-nm0784831-actress\', toggleSpan); return false;">9 episodes, 2008-2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm1986960/?ref_=ttfc_fc_cl_i21"><img alt="Emily Rios" src="https://m.media-amazon.com/images/M/MV5BMTQ4ODc5Njc4Nl5BMl5BanBnXkFtZTYwNTkyODA3._V1_UY44_CR17,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm1986960/?ref_=ttfc_fc_cl_t21">Emily Rios</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm1986960?ref_=ttfc_fc_cl_t21">Andrea Cantillo</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm1986960\',\'tt0903747\',\'actress\',\'ttfc_fc_cl_i21\',0,0,\'#episodes-tt0903747-nm1986960-actress\', toggleSpan); return false;">9 episodes, 2010-2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0662669/?ref_=ttfc_fc_cl_i22"><img alt="Tina Parker" src="https://m.media-amazon.com/images/M/MV5BYjAxNWRkMmUtYzhiOS00NTllLWJjZTMtOTEzMzgzNTY1ODdlXkEyXkFqcGdeQXVyMjM0NDMxOA@@._V1_UY44_CR1,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0662669/?ref_=ttfc_fc_cl_t22">Tina Parker</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Francesca<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0662669\',\'tt0903747\',\'actress\',\'ttfc_fc_cl_i22\',0,0,\'#episodes-tt0903747-nm0662669-actress\', toggleSpan); return false;">9 episodes, 2009-2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0546797/?ref_=ttfc_fc_cl_i23"><img alt="Mark Margolis" src="https://m.media-amazon.com/images/M/MV5BZmRmNjM4NDQtZGI3Mi00YmY4LWJhNDUtOTllZDY5NWNmNThiXkEyXkFqcGdeQXVyMTEzMDQ5NjE@._V1_UY44_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0546797/?ref_=ttfc_fc_cl_t23">Mark Margolis</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0546797?ref_=ttfc_fc_cl_t23">Tio Salamanca</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0546797\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i23\',0,0,\'#episodes-tt0903747-nm0546797-actor\', toggleSpan); return false;">8 episodes, 2009-2011&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0084497/?ref_=ttfc_fc_cl_i24"><img alt="Jeremiah Bitsui" src="https://m.media-amazon.com/images/M/MV5BNWY2OTY2NjAtZjYxYi00ZmMzLTgxMTQtZGE1MzMxNmE0NGQzXkEyXkFqcGdeQXVyNTQ3MzY1NA@@._V1_UY44_CR17,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0084497/?ref_=ttfc_fc_cl_t24">Jeremiah Bitsui</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0084497?ref_=ttfc_fc_cl_t24">Victor</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0084497\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i24\',0,0,\'#episodes-tt0903747-nm0084497-actor\', toggleSpan); return false;">8 episodes, 2009-2011&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm3970678/?ref_=ttfc_fc_cl_i25"><img alt="Ian Posada" src="https://m.media-amazon.com/images/G/01/imdb/images/nopicture/32x44/name-2138558783._CB468460248_.png" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm3970678/?ref_=ttfc_fc_cl_t25">Ian Posada</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm3970678?ref_=ttfc_fc_cl_t25">Brock Cantillo</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm3970678\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i25\',0,0,\'#episodes-tt0903747-nm3970678-actor\', toggleSpan); return false;">8 episodes, 2010-2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0182345/?ref_=ttfc_fc_cl_i26"><img alt="David Costabile" src="https://m.media-amazon.com/images/M/MV5BMTU2NTg3MjE0OV5BMl5BanBnXkFtZTcwNDE4NDE1Mg@@._V1_UY44_CR1,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0182345/?ref_=ttfc_fc_cl_t26">David Costabile</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0182345?ref_=ttfc_fc_cl_t26">Gale Boetticher</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0182345\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i26\',0,0,\'#episodes-tt0903747-nm0182345-actor\', toggleSpan); return false;">7 episodes, 2010-2011&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0100889/?ref_=ttfc_fc_cl_i27"><img alt="Michael Bowen" src="https://m.media-amazon.com/images/M/MV5BNTk0MTA2MjI3OF5BMl5BanBnXkFtZTcwNDAyMDYzOA@@._V1_UY44_CR1,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0100889/?ref_=ttfc_fc_cl_t27">Michael Bowen</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0100889?ref_=ttfc_fc_cl_t27">Uncle Jack</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0100889\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i27\',0,0,\'#episodes-tt0903747-nm0100889-actor\', toggleSpan); return false;">7 episodes, 2012-2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm1450145/?ref_=ttfc_fc_cl_i28"><img alt="David House" src="https://m.media-amazon.com/images/G/01/imdb/images/nopicture/32x44/name-2138558783._CB468460248_.png" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm1450145/?ref_=ttfc_fc_cl_t28">David House</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Dr. Delcavoli<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm1450145\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i28\',0,0,\'#episodes-tt0903747-nm1450145-actor\', toggleSpan); return false;">7 episodes, 2008-2009&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0710271/?ref_=ttfc_fc_cl_i29"><img alt="Kevin Rankin" src="https://m.media-amazon.com/images/M/MV5BZDczNWZiYzAtY2I4NS00ZDgwLTk0YjItYmU2ZDVhNmM3NjExXkEyXkFqcGdeQXVyMjQwMDg0Ng@@._V1_UY44_CR2,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0710271/?ref_=ttfc_fc_cl_t29">Kevin Rankin</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0710271?ref_=ttfc_fc_cl_t29">Kenny</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0710271\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i29\',0,0,\'#episodes-tt0903747-nm0710271-actor\', toggleSpan); return false;">7 episodes, 2012-2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm3718379/?ref_=ttfc_fc_cl_i30"><img alt="Daniel Moncada" src="https://m.media-amazon.com/images/M/MV5BYTc4YjRlMjUtZDQyNC00MTBkLTliM2ItMDMyOTg2YzhmOWE1XkEyXkFqcGdeQXVyMjI0ODQxODM@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm3718379/?ref_=ttfc_fc_cl_t30">Daniel Moncada</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm3718379?ref_=ttfc_fc_cl_t30">Leonel Salamanca</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm3718379\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i30\',0,0,\'#episodes-tt0903747-nm3718379-actor\', toggleSpan); return false;">7 episodes, 2010-2011&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm4577760/?ref_=ttfc_fc_cl_i31"><img alt="Patrick Sane" src="https://m.media-amazon.com/images/G/01/imdb/images/nopicture/32x44/name-2138558783._CB468460248_.png" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm4577760/?ref_=ttfc_fc_cl_t31">Patrick Sane</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Frankie<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm4577760\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i31\',0,0,\'#episodes-tt0903747-nm4577760-actor\', toggleSpan); return false;">6 episodes, 2012-2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm5987281/?ref_=ttfc_fc_cl_i32"><img alt="Moira Bryg MacDonald" src="https://m.media-amazon.com/images/G/01/imdb/images/nopicture/32x44/name-2138558783._CB468460248_.png" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm5987281/?ref_=ttfc_fc_cl_t32">Moira Bryg MacDonald</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm5987281?ref_=ttfc_fc_cl_t32">Holly White</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm5987281\',\'tt0903747\',\'actress\',\'ttfc_fc_cl_i32\',0,0,\'#episodes-tt0903747-nm5987281-actress\', toggleSpan); return false;">6 episodes, 2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0372961/?ref_=ttfc_fc_cl_i33"><img alt="Jessica Hecht" src="https://m.media-amazon.com/images/M/MV5BMTUyNDA3MzUxM15BMl5BanBnXkFtZTcwOTM1NTQ0NA@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0372961/?ref_=ttfc_fc_cl_t33">Jessica Hecht</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0372961?ref_=ttfc_fc_cl_t33">Gretchen Schwartz</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0372961\',\'tt0903747\',\'actress\',\'ttfc_fc_cl_i33\',0,0,\'#episodes-tt0903747-nm0372961-actress\', toggleSpan); return false;">5 episodes, 2008-2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0122987/?ref_=ttfc_fc_cl_i34"><img alt="Bill Burr" src="https://m.media-amazon.com/images/M/MV5BMTQwNDgwODg3NV5BMl5BanBnXkFtZTcwMTY5OTM3MQ@@._V1_UY44_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0122987/?ref_=ttfc_fc_cl_t34">Bill Burr</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0122987?ref_=ttfc_fc_cl_t34">Kuby</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0122987\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i34\',0,0,\'#episodes-tt0903747-nm0122987-actor\', toggleSpan); return false;">5 episodes, 2011-2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm2256387/?ref_=ttfc_fc_cl_i35"><img alt="Marius Stan" src="https://m.media-amazon.com/images/M/MV5BZWQ5MTNjMDgtNjFlYy00ODBhLWEyMmItYTk5MTVmZmU1NWE1XkEyXkFqcGdeQXVyMjMwNzkxMjc@._V1_UY44_CR6,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm2256387/?ref_=ttfc_fc_cl_t35">Marius Stan</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm2256387?ref_=ttfc_fc_cl_t35">Bogdan Wolynetz</a>&nbsp;/ ...<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm2256387\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i35\',0,0,\'#episodes-tt0903747-nm2256387-actor\', toggleSpan); return false;">5 episodes, 2008-2011&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm2968788/?ref_=ttfc_fc_cl_i36"><img alt="Rodney Rush" src="https://m.media-amazon.com/images/M/MV5BNzI3MTkyMjY5MV5BMl5BanBnXkFtZTgwMjA2ODE4NTM@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm2968788/?ref_=ttfc_fc_cl_t36">Rodney Rush</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm2968788?ref_=ttfc_fc_cl_t36">Combo</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm2968788\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i36\',0,0,\'#episodes-tt0903747-nm2968788-actor\', toggleSpan); return false;">5 episodes, 2008-2010&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0856086/?ref_=ttfc_fc_cl_i37"><img alt="Todd Terry" src="https://m.media-amazon.com/images/M/MV5BNzk1YTAyOWEtZGJiOC00MjE3LWFjZjktZDgwNjBlZjI5NzY5XkEyXkFqcGdeQXVyMTEwNTUzMA@@._V1_UY44_CR10,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0856086/?ref_=ttfc_fc_cl_t37">Todd Terry</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;SAC Ramey / ...<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0856086\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i37\',0,0,\'#episodes-tt0903747-nm0856086-actor\', toggleSpan); return false;">5 episodes, 2009-2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm1616991/?ref_=ttfc_fc_cl_i38"><img alt="Luis Moncada" src="https://m.media-amazon.com/images/M/MV5BZmRhY2MxYzEtMjM4NC00ZjAwLTg2MjYtMmZhNjcwOTNjZTE4XkEyXkFqcGdeQXVyMjQwMDg0Ng@@._V1_UY44_CR6,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm1616991/?ref_=ttfc_fc_cl_t38">Luis Moncada</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm1616991?ref_=ttfc_fc_cl_t38">Marco Salamanca</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm1616991\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i38\',0,0,\'#episodes-tt0903747-nm1616991-actor\', toggleSpan); return false;">5 episodes, 2010&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm3979839/?ref_=ttfc_fc_cl_i39"><img alt="Kaija Bales" src="https://m.media-amazon.com/images/M/MV5BMTUzNzE0Mzg3OF5BMl5BanBnXkFtZTgwNzg3MjIxMzE@._V1_UY44_CR1,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm3979839/?ref_=ttfc_fc_cl_t39">Kaija Bales</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Kaylee Ehrmantraut<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm3979839\',\'tt0903747\',\'actress\',\'ttfc_fc_cl_i39\',0,0,\'#episodes-tt0903747-nm3979839-actress\', toggleSpan); return false;">5 episodes, 2010-2012&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm1324884/?ref_=ttfc_fc_cl_i40"><img alt="Tait Fletcher" src="https://m.media-amazon.com/images/M/MV5BNDFkZTAzZjMtMjYwYi00MWU3LThjMDItN2RmMjEwNmQwYTc1XkEyXkFqcGdeQXVyNDc4MzM5Nzk@._V1_UY44_CR6,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm1324884/?ref_=ttfc_fc_cl_t40">Tait Fletcher</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm1324884?ref_=ttfc_fc_cl_t40">Lester</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm1324884\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i40\',0,0,\'#episodes-tt0903747-nm1324884-actor\', toggleSpan); return false;">5 episodes, 2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm5597998/?ref_=ttfc_fc_cl_i41"><img alt="Matthew T. Metzler" src="https://m.media-amazon.com/images/G/01/imdb/images/nopicture/32x44/name-2138558783._CB468460248_.png" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm5597998/?ref_=ttfc_fc_cl_t41">Matthew T. Metzler</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Matt<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm5597998\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i41\',0,0,\'#episodes-tt0903747-nm5597998-actor\', toggleSpan); return false;">5 episodes, 2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0190441/?ref_=ttfc_fc_cl_i42"><img alt="Raymond Cruz" src="https://m.media-amazon.com/images/M/MV5BMTY3ODMxMzg4OV5BMl5BanBnXkFtZTcwMDA3NjA2NQ@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0190441/?ref_=ttfc_fc_cl_t42">Raymond Cruz</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0190441?ref_=ttfc_fc_cl_t42">Tuco Salamanca</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0190441\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i42\',0,0,\'#episodes-tt0903747-nm0190441-actor\', toggleSpan); return false;">4 episodes, 2008-2009&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0002128/?ref_=ttfc_fc_cl_i43"><img alt="Tess Harper" src="https://m.media-amazon.com/images/M/MV5BMTk1OTEzMjk5Nl5BMl5BanBnXkFtZTcwNzk1ODQ1MQ@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0002128/?ref_=ttfc_fc_cl_t43">Tess Harper</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Mrs. Pinkman<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0002128\',\'tt0903747\',\'actress\',\'ttfc_fc_cl_i43\',0,0,\'#episodes-tt0903747-nm0002128-actress\', toggleSpan); return false;">4 episodes, 2008-2010&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0209496/?ref_=ttfc_fc_cl_i44"><img alt="John de Lancie" src="https://m.media-amazon.com/images/M/MV5BMjIwMDk3OTAxM15BMl5BanBnXkFtZTcwNDM0NTQwOA@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0209496/?ref_=ttfc_fc_cl_t44">John de Lancie</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0209496?ref_=ttfc_fc_cl_t44">Donald Margolis</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0209496\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i44\',0,0,\'#episodes-tt0903747-nm0209496-actor\', toggleSpan); return false;">4 episodes, 2009-2010&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0122716/?ref_=ttfc_fc_cl_i45"><img alt="Jere Burns" src="https://m.media-amazon.com/images/M/MV5BMTQ1NjQ0MDc4M15BMl5BanBnXkFtZTYwMjk2Nzg0._V1_UY44_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0122716/?ref_=ttfc_fc_cl_t45">Jere Burns</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Group Leader<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0122716\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i45\',0,0,\'#episodes-tt0903747-nm0122716-actor\', toggleSpan); return false;">4 episodes, 2010-2011&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0316708/?ref_=ttfc_fc_cl_i46"><img alt="Nigel Gibbs" src="https://m.media-amazon.com/images/M/MV5BMTU0NjI3MDI3Nl5BMl5BanBnXkFtZTgwNzQzNTA2MDI@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0316708/?ref_=ttfc_fc_cl_t46">Nigel Gibbs</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;APD Detective Tim Roberts<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0316708\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i46\',0,0,\'#episodes-tt0903747-nm0316708-actor\', toggleSpan); return false;">4 episodes, 2009-2011&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0452622/?ref_=ttfc_fc_cl_i47"><img alt="Tom Kiesche" src="https://m.media-amazon.com/images/M/MV5BNzYxODcxZjktYjIwNi00MTFmLThhODYtMjAxY2M5MjVhMGNiXkEyXkFqcGdeQXVyMDUyOTIxMA@@._V1_UY44_CR1,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0452622/?ref_=ttfc_fc_cl_t47">Tom Kiesche</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Clovis<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0452622\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i47\',0,0,\'#episodes-tt0903747-nm0452622-actor\', toggleSpan); return false;">4 episodes, 2009-2010&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0173997/?ref_=ttfc_fc_cl_i48"><img alt="Maurice Compte" src="https://m.media-amazon.com/images/M/MV5BZGU4MzIwMDMtNGU2MS00MzQyLTk1ZGEtYzc2Yjk1YTFiNmM2XkEyXkFqcGdeQXVyMzYzMTI0NzE@._V1_UY44_CR17,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0173997/?ref_=ttfc_fc_cl_t48">Maurice Compte</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0173997?ref_=ttfc_fc_cl_t48">Gaff</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0173997\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i48\',0,0,\'#episodes-tt0903747-nm0173997-actor\', toggleSpan); return false;">4 episodes, 2011&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm2813734/?ref_=ttfc_fc_cl_i49"><img alt="Morse Bicknell" src="https://m.media-amazon.com/images/M/MV5BOTY5ZTM5MjItNDkyYS00YTMwLTliYTEtNjJlZjYzNzFiOWY0XkEyXkFqcGdeQXVyMjAyMTM2NDY@._V1_UY44_CR6,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm2813734/?ref_=ttfc_fc_cl_t49">Morse Bicknell</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Declan&#39;s Driver<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm2813734\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i49\',0,0,\'#episodes-tt0903747-nm2813734-actor\', toggleSpan); return false;">4 episodes, 2012-2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm5518772/?ref_=ttfc_fc_cl_i50"><img alt="Christopher King" src="https://m.media-amazon.com/images/G/01/imdb/images/nopicture/32x44/name-2138558783._CB468460248_.png" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm5518772/?ref_=ttfc_fc_cl_t50">Christopher King</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Chris Mara<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm5518772\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i50\',0,0,\'#episodes-tt0903747-nm5518772-actor\', toggleSpan); return false;">4 episodes, 2011-2012&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm1362980/?ref_=ttfc_fc_cl_i51"><img alt="Max Arciniega" src="https://m.media-amazon.com/images/M/MV5BZmMxMWM1Y2UtODJhZC00MGQ4LTk5YTEtMjhiMGUyZjczNTFjXkEyXkFqcGdeQXVyMTE3NjY4NjE@._V1_UY44_CR1,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm1362980/?ref_=ttfc_fc_cl_t51">Max Arciniega</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm1362980?ref_=ttfc_fc_cl_t51">Krazy-8</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm1362980\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i51\',0,0,\'#episodes-tt0903747-nm1362980-actor\', toggleSpan); return false;">3 episodes, 2008&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0091480/?ref_=ttfc_fc_cl_i52"><img alt="Michael Bofshever" src="https://m.media-amazon.com/images/M/MV5BMjAzMzg3MDIwMl5BMl5BanBnXkFtZTgwODM1MDU3OTE@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0091480/?ref_=ttfc_fc_cl_t52">Michael Bofshever</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Mr. Pinkman<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0091480\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i52\',0,0,\'#episodes-tt0903747-nm0091480-actor\', toggleSpan); return false;">3 episodes, 2008-2010&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0324134/?ref_=ttfc_fc_cl_i53"><img alt="Adam Godley" src="https://m.media-amazon.com/images/M/MV5BMjQwNzIzOTAwNl5BMl5BanBnXkFtZTgwMDg4NjA3NDE@._V1_UY44_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0324134/?ref_=ttfc_fc_cl_t53">Adam Godley</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0324134?ref_=ttfc_fc_cl_t53">Elliott Schwartz</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0324134\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i53\',0,0,\'#episodes-tt0903747-nm0324134-actor\', toggleSpan); return false;">3 episodes, 2008-2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0003740/?ref_=ttfc_fc_cl_i54"><img alt="Julie Dretzin" src="https://m.media-amazon.com/images/M/MV5BMTA1MTM2MTE1NTZeQTJeQWpwZ15BbWU3MDk0ODA0OTM@._V1_UY44_CR7,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0003740/?ref_=ttfc_fc_cl_t54">Julie Dretzin</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Pamela<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0003740\',\'tt0903747\',\'actress\',\'ttfc_fc_cl_i54\',0,0,\'#episodes-tt0903747-nm0003740-actress\', toggleSpan); return false;">3 episodes, 2010&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm2636838/?ref_=ttfc_fc_cl_i55"><img alt="Jesus Jr." src="https://m.media-amazon.com/images/M/MV5BZWFkNGEyMzYtMWVhYi00NjNhLTk0NjAtODE3OWQ0MmUwNzNiXkEyXkFqcGdeQXVyMjkwMTc0NTU@._V1_UY44_CR6,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm2636838/?ref_=ttfc_fc_cl_t55">Jesus Jr.</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;No-Doze / ...<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm2636838\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i55\',0,0,\'#episodes-tt0903747-nm2636838-actor\', toggleSpan); return false;">3 episodes, 2008-2009&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0274371/?ref_=ttfc_fc_cl_i56"><img alt="Louis Ferreira" src="https://m.media-amazon.com/images/M/MV5BMTIzNDMyMDQyM15BMl5BanBnXkFtZTcwOTMxNzEzMQ@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0274371/?ref_=ttfc_fc_cl_t56">Louis Ferreira</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0274371?ref_=ttfc_fc_cl_t56">Declan</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0274371\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i56\',0,0,\'#episodes-tt0903747-nm0274371-actor\', toggleSpan); return false;">3 episodes, 2012-2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm1075323/?ref_=ttfc_fc_cl_i57"><img alt="Cesar Garcia" src="https://m.media-amazon.com/images/M/MV5BNmYwZmU1OTUtNTgzMS00MjhhLTk4MTMtZmMxODZlNjZkNGJlXkEyXkFqcGdeQXVyMjQwMDg0Ng@@._V1_UY44_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm1075323/?ref_=ttfc_fc_cl_t57">Cesar Garcia</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Gonzo / ...<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm1075323\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i57\',0,0,\'#episodes-tt0903747-nm1075323-actor\', toggleSpan); return false;">3 episodes, 2008-2009&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm2928008/?ref_=ttfc_fc_cl_i58"><img alt="Julia Minesci" src="https://m.media-amazon.com/images/M/MV5BNzMwYTg4NGMtODI0Ni00YjBlLWFhOTYtOWFlODZhN2IzMmRmXkEyXkFqcGdeQXVyMTY3NTg5MDY@._V1_UY44_CR1,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm2928008/?ref_=ttfc_fc_cl_t58">Julia Minesci</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm2928008?ref_=ttfc_fc_cl_t58">Wendy</a>&nbsp;/ ...<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm2928008\',\'tt0903747\',\'actress\',\'ttfc_fc_cl_i58\',0,0,\'#episodes-tt0903747-nm2928008-actress\', toggleSpan); return false;">3 episodes, 2008-2010&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm2099399/?ref_=ttfc_fc_cl_i59"><img alt="Mike Batayeh" src="https://m.media-amazon.com/images/G/01/imdb/images/nopicture/32x44/name-2138558783._CB468460248_.png" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm2099399/?ref_=ttfc_fc_cl_t59">Mike Batayeh</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Dennis Markowski<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm2099399\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i59\',0,0,\'#episodes-tt0903747-nm2099399-actor\', toggleSpan); return false;">3 episodes, 2011-2012&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0334462/?ref_=ttfc_fc_cl_i60"><img alt="Javier Grajeda" src="https://m.media-amazon.com/images/M/MV5BYjM1MjRhMTMtZTVhYi00NzEwLWI1ZGMtMTUyZjlkNDU3YmVmXkEyXkFqcGdeQXVyMjM3NzYzMjQ@._V1_UY44_CR1,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0334462/?ref_=ttfc_fc_cl_t60">Javier Grajeda</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0334462?ref_=ttfc_fc_cl_t60">Juan Bolsa</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0334462\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i60\',0,0,\'#episodes-tt0903747-nm0334462-actor\', toggleSpan); return false;">3 episodes, 2010-2011&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm3089692/?ref_=ttfc_fc_cl_i61"><img alt="Angelo Martinez" src="https://m.media-amazon.com/images/G/01/imdb/images/nopicture/32x44/name-2138558783._CB468460248_.png" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm3089692/?ref_=ttfc_fc_cl_t61">Angelo Martinez</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Tomas / ...<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm3089692\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i61\',0,0,\'#episodes-tt0903747-nm3089692-actor\', toggleSpan); return false;">3 episodes, 2009-2010&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0579460/?ref_=ttfc_fc_cl_i62"><img alt="Gonzalo Menendez" src="https://m.media-amazon.com/images/M/MV5BNTA3MDk1NTE3MF5BMl5BanBnXkFtZTcwNDU2NDc5Mw@@._V1_UY44_CR17,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0579460/?ref_=ttfc_fc_cl_t62">Gonzalo Menendez</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0579460?ref_=ttfc_fc_cl_t62">Detective Kalanchoe</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0579460\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i62\',0,0,\'#episodes-tt0903747-nm0579460-actor\', toggleSpan); return false;">3 episodes, 2011-2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0293803/?ref_=ttfc_fc_cl_i63"><img alt="Chris Freihofer" src="https://m.media-amazon.com/images/M/MV5BZWM0NTZhZjAtNjFhYy00YTNmLThmOWQtZTdiMjFhYzBlZmM0XkEyXkFqcGdeQXVyMTIwMDU3NTA@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0293803/?ref_=ttfc_fc_cl_t63">Chris Freihofer</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Dan Wachsberger<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0293803\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i63\',0,0,\'#episodes-tt0903747-nm0293803-actor\', toggleSpan); return false;">3 episodes, 2012&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm2608171/?ref_=ttfc_fc_cl_i64"><img alt="Mike Seal" src="https://m.media-amazon.com/images/M/MV5BN2NmNWQ4MzEtOGIyMS00ZGFmLTlkN2QtOTMyNzJkOTlhZDI1XkEyXkFqcGdeQXVyMTgyNDIwNDQ@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm2608171/?ref_=ttfc_fc_cl_t64">Mike Seal</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Rival Dealer #1<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm2608171\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i64\',0,0,\'#episodes-tt0903747-nm2608171-actor\', toggleSpan); return false;">3 episodes, 2009-2010&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0218716/?ref_=ttfc_fc_cl_i65"><img alt="Christopher Dempsey" src="https://m.media-amazon.com/images/M/MV5BMjM0NjEyNzU1OV5BMl5BanBnXkFtZTgwMzE2NTI4OTE@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0218716/?ref_=ttfc_fc_cl_t65">Christopher Dempsey</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;E.M.T. / ...<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0218716\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i65\',0,0,\'#episodes-tt0903747-nm0218716-actor\', toggleSpan); return false;">3 episodes, 2008-2010&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm3612872/?ref_=ttfc_fc_cl_i66"><img alt="Ashley Kajiki" src="https://m.media-amazon.com/images/G/01/imdb/images/nopicture/32x44/name-2138558783._CB468460248_.png" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm3612872/?ref_=ttfc_fc_cl_t66">Ashley Kajiki</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Pollos Manager / ...<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm3612872\',\'tt0903747\',\'actress\',\'ttfc_fc_cl_i66\',0,0,\'#episodes-tt0903747-nm3612872-actress\', toggleSpan); return false;">3 episodes, 2009-2011&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm2523921/?ref_=ttfc_fc_cl_i67"><img alt="Mary Sue Evans" src="https://m.media-amazon.com/images/G/01/imdb/images/nopicture/32x44/name-2138558783._CB468460248_.png" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm2523921/?ref_=ttfc_fc_cl_t67">Mary Sue Evans</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Janice<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm2523921\',\'tt0903747\',\'actress\',\'ttfc_fc_cl_i67\',0,0,\'#episodes-tt0903747-nm2523921-actress\', toggleSpan); return false;">3 episodes, 2010-2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0235103/?ref_=ttfc_fc_cl_i68"><img alt="Jason Douglas" src="https://m.media-amazon.com/images/M/MV5BOGQzZWIxMzktMzJiMS00YTIyLWI2YjktOGY5ODg5OWY0ODhiXkEyXkFqcGdeQXVyMDA2MjgzMA@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0235103/?ref_=ttfc_fc_cl_t68">Jason Douglas</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0235103?ref_=ttfc_fc_cl_t68">Detective Munn</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0235103\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i68\',0,0,\'#episodes-tt0903747-nm0235103-actor\', toggleSpan); return false;">3 episodes, 2011-2013&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm3128797/?ref_=ttfc_fc_cl_i69"><img alt="Antonio Leyba" src="https://m.media-amazon.com/images/M/MV5BYmFmMGUxZTUtNDYwNy00ZjkwLWE1YjMtNWFlNDhjNzk3OTA3XkEyXkFqcGdeQXVyNTIyOTcyMTE@._V1_UY44_CR1,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm3128797/?ref_=ttfc_fc_cl_t69">Antonio Leyba</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Rival Dealer #2<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm3128797\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i69\',0,0,\'#episodes-tt0903747-nm3128797-actor\', toggleSpan); return false;">3 episodes, 2009-2010&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0468697/?ref_=ttfc_fc_cl_i70"><img alt="John Koyama" src="https://m.media-amazon.com/images/M/MV5BMTE4MjUxODU2N15BMl5BanBnXkFyZXN1bWU@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0468697/?ref_=ttfc_fc_cl_t70">John Koyama</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0468697?ref_=ttfc_fc_cl_t70">Emilio</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0468697\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i70\',0,0,\'#episodes-tt0903747-nm0468697-actor\', toggleSpan); return false;">2 episodes, 2008&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0001803/?ref_=ttfc_fc_cl_i71"><img alt="Danny Trejo" src="https://m.media-amazon.com/images/M/MV5BMzcxNTQ1ODQxMl5BMl5BanBnXkFtZTYwMzI4MDA2._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0001803/?ref_=ttfc_fc_cl_t71">Danny Trejo</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0001803?ref_=ttfc_fc_cl_t71">Tortuga</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0001803\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i71\',0,0,\'#episodes-tt0903747-nm0001803-actor\', toggleSpan); return false;">2 episodes, 2009-2010&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0225460/?ref_=ttfc_fc_cl_i72"><img alt="Dale Dickey" src="https://m.media-amazon.com/images/M/MV5BMTUxMzkyMjM1OF5BMl5BanBnXkFtZTcwMzc4OTE3MQ@@._V1_UY44_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0225460/?ref_=ttfc_fc_cl_t72">Dale Dickey</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0225460?ref_=ttfc_fc_cl_t72">Spooge&#39;s Woman</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0225460\',\'tt0903747\',\'actress\',\'ttfc_fc_cl_i72\',0,0,\'#episodes-tt0903747-nm0225460-actress\', toggleSpan); return false;">2 episodes, 2009&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm1352845/?ref_=ttfc_fc_cl_i73"><img alt="David Ury" src="https://m.media-amazon.com/images/M/MV5BY2ZmNjUzNjMtNTYwNC00YzY3LWFjMTEtMTdhNzU1YzliNThhXkEyXkFqcGdeQXVyMjQwMDg0Ng@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm1352845/?ref_=ttfc_fc_cl_t73">David Ury</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm1352845?ref_=ttfc_fc_cl_t73">Spooge</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm1352845\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i73\',0,0,\'#episodes-tt0903747-nm1352845-actor\', toggleSpan); return false;">2 episodes, 2009&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0064769/?ref_=ttfc_fc_cl_i74"><img alt="Jim Beaver" src="https://m.media-amazon.com/images/M/MV5BOTIwMjExMzY2MV5BMl5BanBnXkFtZTgwOTgxMDI0NzE@._V1_UY44_CR6,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0064769/?ref_=ttfc_fc_cl_t74">Jim Beaver</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0064769?ref_=ttfc_fc_cl_t74">Lawson</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0064769\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i74\',0,0,\'#episodes-tt0903747-nm0064769-actor\', toggleSpan); return false;">2 episodes, 2011-2012&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0573481/?ref_=ttfc_fc_cl_i75"><img alt="Sam McMurray" src="https://m.media-amazon.com/images/M/MV5BMTg0OTUwNDM4MV5BMl5BanBnXkFtZTcwODIxMzM5OA@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0573481/?ref_=ttfc_fc_cl_t75">Sam McMurray</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Dr. Victor Bravenec<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0573481\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i75\',0,0,\'#episodes-tt0903747-nm0573481-actor\', toggleSpan); return false;">2 episodes, 2009&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0221430/?ref_=ttfc_fc_cl_i76"><img alt="Dan Desmond" src="https://m.media-amazon.com/images/G/01/imdb/images/nopicture/32x44/name-2138558783._CB468460248_.png" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0221430/?ref_=ttfc_fc_cl_t76">Dan Desmond</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Mr. Gardiner<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0221430\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i76\',0,0,\'#episodes-tt0903747-nm0221430-actor\', toggleSpan); return false;">2 episodes, 2009-2010&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0397386/?ref_=ttfc_fc_cl_i77"><img alt="Jeremy Howard" src="https://m.media-amazon.com/images/M/MV5BMDNjMWExYWYtZWY3Mi00NjBhLTllY2YtN2Q1OGI1N2E2ODZhXkEyXkFqcGdeQXVyMjQwMDg0Ng@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0397386/?ref_=ttfc_fc_cl_t77">Jeremy Howard</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Sketchy<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0397386\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i77\',0,0,\'#episodes-tt0903747-nm0397386-actor\', toggleSpan); return false;">2 episodes, 2011&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0359969/?ref_=ttfc_fc_cl_i78"><img alt="Larry Hankin" src="https://m.media-amazon.com/images/M/MV5BZGMxNzdhOTYtMjJlZS00ZjIzLTkwZDgtM2VmZGU4Y2YxNjJmXkEyXkFqcGdeQXVyMTUwNzM4MjM@._V1_UY44_CR4,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0359969/?ref_=ttfc_fc_cl_t78">Larry Hankin</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0359969?ref_=ttfc_fc_cl_t78">Old Joe</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0359969\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i78\',0,0,\'#episodes-tt0903747-nm0359969-actor\', toggleSpan); return false;">2 episodes, 2010-2012&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm1072611/?ref_=ttfc_fc_cl_i79"><img alt="JB Blanc" src="https://m.media-amazon.com/images/M/MV5BMGJmOTM5MjQtMWUzOC00NzUxLThmMTctZTc2ZWVlNzkxYjg4XkEyXkFqcGdeQXVyMTM2MzA2NA@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm1072611/?ref_=ttfc_fc_cl_t79">JB Blanc</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Dr. Barry Goodman<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm1072611\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i79\',0,0,\'#episodes-tt0903747-nm1072611-actor\', toggleSpan); return false;">2 episodes, 2011-2012&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm2944601/?ref_=ttfc_fc_cl_i80"><img alt="Jason Byrd" src="https://m.media-amazon.com/images/G/01/imdb/images/nopicture/32x44/name-2138558783._CB468460248_.png" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm2944601/?ref_=ttfc_fc_cl_t80">Jason Byrd</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Ben / ...<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm2944601\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i80\',0,0,\'#episodes-tt0903747-nm2944601-actor\', toggleSpan); return false;">2 episodes, 2008&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm3130683/?ref_=ttfc_fc_cl_i81"><img alt="James Ning" src="https://m.media-amazon.com/images/M/MV5BMTcxNTY1MjMxNF5BMl5BanBnXkFtZTgwMzY0MDQ3NDE@._V1_UY44_CR1,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm3130683/?ref_=ttfc_fc_cl_t81">James Ning</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Duane Chow<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm3130683\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i81\',0,0,\'#episodes-tt0903747-nm3130683-actor\', toggleSpan); return false;">2 episodes, 2010-2012&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm2627391/?ref_=ttfc_fc_cl_i82"><img alt="Russ Dillen" src="https://m.media-amazon.com/images/G/01/imdb/images/nopicture/32x44/name-2138558783._CB468460248_.png" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm2627391/?ref_=ttfc_fc_cl_t82">Russ Dillen</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Ron Forenall<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm2627391\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i82\',0,0,\'#episodes-tt0903747-nm2627391-actor\', toggleSpan); return false;">2 episodes, 2012&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm3578462/?ref_=ttfc_fc_cl_i83"><img alt="Jonathan Ragsdale" src="https://m.media-amazon.com/images/G/01/imdb/images/nopicture/32x44/name-2138558783._CB468460248_.png" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm3578462/?ref_=ttfc_fc_cl_t83">Jonathan Ragsdale</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Barry<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm3578462\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i83\',0,0,\'#episodes-tt0903747-nm3578462-actor\', toggleSpan); return false;">2 episodes, 2009-2010&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm0000874/?ref_=ttfc_fc_cl_i84"><img alt="Steven Bauer" src="https://m.media-amazon.com/images/M/MV5BMTNjNTY4NDItODdlOC00N2QwLWI4Y2UtYTE2ZmM5MzI2NGFiXkEyXkFqcGdeQXVyMjQwMDg0Ng@@._V1_UX32_CR0,0,32,44_AL_.jpg" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm0000874/?ref_=ttfc_fc_cl_t84">Steven Bauer</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;<a href="https://www.imdb.com/title/tt0903747/characters/nm0000874?ref_=ttfc_fc_cl_t84">Don Eladio</a><a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_sm#" onclick="toggleSeeMoreEpisodes(this,\'nm0000874\',\'tt0903747\',\'actor\',\'ttfc_fc_cl_i84\',0,0,\'#episodes-tt0903747-nm0000874-actor\', toggleSpan); return false;">2 episodes, 2011&nbsp;</a></td>\r\n		</tr>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td><a href="https://www.imdb.com/name/nm3476022/?ref_=ttfc_fc_cl_i85"><img alt="Sam Webb" src="https://m.media-amazon.com/images/G/01/imdb/images/nopicture/32x44/name-2138558783._CB468460248_.png" style="height:44px; width:32px" /></a></td>\r\n			<td><a href="https://www.imdb.com/name/nm3476022/?ref_=ttfc_fc_cl_t85">Sam Webb</a></td>\r\n			<td>...</td>\r\n			<td>&nbsp;Drew Sharp<a href="https://www.imdb.com/title/tt0903747/fullcredits/?ref_=tt_ov_st_', 1, '2020-09-27 03:31:23', '2020-09-27 03:31:23');
INSERT INTO `cast_crews` (`id`, `unique_id`, `name`, `image`, `description`, `status`, `created_at`, `updated_at`) VALUES
(68, 'ararabi603a0d7a77521', 'ararabi', 'http://adminview.streamhash.com/storage//uploads/images/cast_crews/SV-2021-02-27-09-14-34-e1fa800bf6c1df5dfc2b694bdb29dc5903973580.png', '<p>sfstyfdytwqdytwdswytswxcvxtfstfgf</p>', 1, '2021-02-27 09:14:34', '2021-05-14 18:09:38'),
(69, 'Adam-Sandler608280c2be9b8', 'Adam Sandler', 'http://adminview.streamhash.com/storage//uploads/images/cast_crews/SV-2021-04-23-08-09-38-d3f527c914a572049897c53299fa48a8362c30b9.jpeg', '<p>Adam Sandler (born September 9, 1966) is an American actor, comedian, and producer.</p>\r\n\r\n<p>At seventeen, he took his first step towards becoming a stand-up comedian when he took the stage at a Boston comedy club. He regularly performed in clubs and at universities while attending New York University.</p>\r\n\r\n<p>In 1987, he got a recurring role on The Cosby Show. While working at a comedy club in Los Angeles, he recommended to Saturday Night Live producer Lorne Michaels by Dennis Miller. Sandler was a cast member from 1991 to 1995. After Saturday Night Live, Sandler went on to star in movies such as Airheads, Happy Gilmore, Billy Madison, and Big Daddy. He has also starred in Mr. Deeds, Eight Crazy Nights, and Punch-Drunk Love.</p>\r\n\r\n<p>He also writes and produces many of his other films and has composed songs for several of them, including The Wedding Singer. Sandler has had several of his songs placed on the Billboard charts, including The Chanukah Song.</p>', 1, '2021-04-23 08:09:38', '2021-05-14 18:11:03');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_series` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_home_display` int(11) NOT NULL DEFAULT '0',
  `is_approved` int(11) NOT NULL DEFAULT '1',
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `picture`, `is_series`, `status`, `is_home_display`, `is_approved`, `created_by`, `created_at`, `updated_at`) VALUES
(172, 'Action', 'http://adminview.streamhash.com/uploads/images/categories/SV-2020-09-17-06-15-58-8709905c894ca2b0b1aefcc2117f1d77971643eb.jpg', 0, '1', 0, 0, 'admin', '2020-09-17 06:07:28', '2021-06-04 18:00:27'),
(176, 'Comedy', 'http://adminview.streamhash.com/uploads/images/categories/SV-2020-09-23-09-17-22-67ea230cf92354ff5f1e2f83d5b453eed9e0dcb4.jpg', 0, '1', 0, 0, 'admin', '2020-09-23 09:17:22', '2021-06-04 18:00:31'),
(177, 'Romance', 'http://adminview.streamhash.com/uploads/images/categories/SV-2020-09-23-10-10-00-d5b180d8561bf4ebe36b0ee1dd42f90e2580dc9a.jpg', 0, '1', 0, 0, 'admin', '2020-09-23 10:10:00', '2021-06-04 18:00:06'),
(178, 'SCI-FI', 'http://adminview.streamhash.com/uploads/images/categories/SV-2020-09-23-10-54-58-a2325dabade9a700a6dadf6e2b35290551bb26b3.jpg', 0, '1', 0, 0, 'admin', '2020-09-23 10:54:58', '2021-06-04 18:00:11'),
(180, 'Adventure', 'http://adminview.streamhash.com/uploads/images/categories/SV-2020-09-24-06-00-48-c1ef99e237d0837d5a98a9a70015aaaa83d02bc7.jpg', 0, '1', 0, 0, 'admin', '2020-09-24 06:00:48', '2021-06-04 18:00:17'),
(184, 'Animation', 'http://adminview.streamhash.com/uploads/images/categories/SV-2020-11-10-12-28-17-3c3e64d866615485cf0f5c93ef40155c629561f0.jpeg', 0, '1', 0, 0, 'admin', '2020-10-02 07:54:53', '2021-06-04 17:59:48'),
(221, 'Drama', 'http://adminview.streamhash.com/storage//uploads/images/categories/SV-2021-04-25-01-42-45-0fc2e6b8e867cbb48559107da71e87fc6966cb26.jpeg', 0, '1', 0, 0, 'admin', '2021-04-25 01:42:45', '2021-06-04 18:00:57'),
(222, 'Music', 'http://adminview.streamhash.com/storage//uploads/images/categories/SV-2021-04-26-03-25-30-d050ece09ee2f1a8cc603267315e80bddc9544b8.jpg', 0, '1', 0, 0, 'admin', '2021-04-26 03:25:30', '2021-06-04 18:00:52'),
(223, 'Horror', 'http://adminview.streamhash.com/storage//uploads/images/categories/SV-2021-04-26-07-58-10-1dde60a9c131c87cd9108079115e9231e52cca78.jpeg', 0, '1', 0, 0, 'admin', '2021-04-26 07:58:10', '2021-06-04 18:00:47'),
(235, 'Adult Animation', 'http://adminview.streamhash.com/storage//uploads/images/categories/SV-2021-05-02-08-57-03-ade2b1628efb77b2e03faf9498f0075ee37ad909.jpeg', 0, '1', 0, 0, 'admin', '2021-05-02 08:57:03', '2021-06-04 17:59:42'),
(237, 'Anime', 'http://adminview.streamhash.com/storage//uploads/images/categories/SV-2021-05-12-01-46-47-cd5992ddb0be5759bf7080b913db20d8483917da.png', 0, '1', 0, 1, 'admin', '2021-05-12 01:46:47', '2021-05-12 01:46:47'),
(238, 'Documentary', 'http://adminview.streamhash.com/storage//uploads/images/categories/SV-2021-05-30-04-16-01-3e10cc6ebd1d9570e06db798328be42e85060f83.jpeg', 0, '1', 0, 0, 'admin', '2021-05-30 04:16:01', '2021-06-04 17:59:36'),
(239, 'Movies', 'http://adminview.streamhash.com/storage//uploads/images/categories/SV-2021-06-04-18-05-30-33132c07f317e4ec80f999aab269a5c50944880e.jpg', 0, '1', 0, 1, 'admin', '2021-06-04 18:05:30', '2021-06-04 18:05:30');

-- --------------------------------------------------------

--
-- Table structure for table `continue_watching_videos`
--

CREATE TABLE `continue_watching_videos` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `sub_profile_id` int(11) NOT NULL,
  `admin_video_id` int(11) NOT NULL,
  `duration` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `duration_in_seconds` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_genre` tinyint(4) NOT NULL,
  `position` smallint(6) NOT NULL,
  `genre_position` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `expiry_date` date NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `status` int(11) NOT NULL,
  `no_of_users_limit` smallint(6) NOT NULL,
  `per_users_limit` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_wallets`
--

CREATE TABLE `custom_wallets` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` double(8,2) NOT NULL DEFAULT '0.00',
  `used` double(8,2) NOT NULL DEFAULT '0.00',
  `remaining` double(8,2) NOT NULL DEFAULT '0.00',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_wallet_histories`
--

CREATE TABLE `custom_wallet_histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `custom_field_id` int(11) NOT NULL DEFAULT '0',
  `custom_payment_id` int(11) NOT NULL DEFAULT '0',
  `payment_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `amount` double(8,2) NOT NULL DEFAULT '0.00',
  `history_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ADD',
  `transaction_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `paid_date` datetime DEFAULT NULL,
  `payment_mode` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_wallet_payments`
--

CREATE TABLE `custom_wallet_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `wallet_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'DIRECT',
  `voucher_id` int(11) NOT NULL DEFAULT '0',
  `voucher_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `actual_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `paid_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `payment_mode` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'card',
  `is_cancelled` int(11) NOT NULL DEFAULT '0',
  `cancel_reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `paid_date` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_wallet_vouchers`
--

CREATE TABLE `custom_wallet_vouchers` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `voucher_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL DEFAULT '0.00',
  `total_count` int(11) NOT NULL,
  `per_user_limit` int(11) NOT NULL,
  `used_count` int(11) NOT NULL,
  `remaining_count` int(11) NOT NULL,
  `expiry_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `template_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `template_type`, `subject`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'automatic_renewal', 'Automatic Renewal Notification', 'Your subscription is renewed automatically.', 1, '2018-06-08 04:59:40', '2018-06-08 04:59:40'),
(2, 'user_welcome', 'Welcome to Flixzilla', '<p>Thanks for signing up! We&#39;re very excited to have you on board.</p>', 1, '2018-06-20 19:02:00', '2021-04-23 04:40:27'),
(3, 'admin_user_welcome', 'Welcome to Flixzilla', '<p>Thanks for signing up! Where very excited to have you on board.</p>', 1, '2018-06-20 19:02:00', '2021-04-28 01:38:59'),
(4, 'forgot_password', 'Your new password', '', 1, '2018-06-20 19:02:00', '2021-02-27 11:03:28'),
(5, 'moderator_welcome', 'Welcome to Flixzilla', '<p>Congratulations! Admin has made you a Content Creator. Please use the link and details below to login and upload Content.<br />\r\nPlease find your credentials of Flixzilla.</p>', 1, '2018-06-20 19:02:00', '2021-04-28 01:38:05'),
(6, 'payment_expired', 'Payment Notification', 'Your notification has expired. To keep using channel creation  & upload video without interruption, subscribe any one of our plans and continue to upload', 1, '2018-06-20 19:02:00', '2018-06-20 19:02:00'),
(7, 'payment_going_to_expiry', 'Payment Notification', 'Your subscription will expire soon. Our records indicate that no payment method has been associated with this subscripton account. Go to the subscription plans and provide the required payment information to renew your subscription for watching videos and continue using your profile uninterrupted.', 1, '2018-06-20 19:02:00', '2018-06-20 19:02:00'),
(8, 'new_video', '\'<%video_name%>\' in <%site_name%>', '\'<%video_name%>\' video uploaded in \'<%category_name%>\', don\'t miss the video from <%site_name%>', 1, '2018-06-20 19:02:00', '2018-06-20 19:02:00'),
(9, 'edit_video', '\'<%video_name%>\' in <%site_name%>', '\'<%video_name%>\' video uploaded in \'<%category_name%>\', don\'t miss the video from <%site_name%>', 1, '2018-06-20 19:02:00', '2018-06-20 19:02:00'),
(10, 'moderator_update_mail', 'Email Change Notification', '<p>You receive this one at your old email address. Please note that this email is a security measure to protect your account in case someone is trying to take it over.<br />\r\n<strong>Your New Email Address is : &lt;%email%&gt; </strong></p>\r\n', 1, '2018-08-04 10:19:06', '2019-03-21 11:09:41');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `unique_id`, `question`, `answer`, `status`, `created_at`, `updated_at`) VALUES
(1, '994997994', 'What is Streamhash?', '<p>StreamView is programmed to start subscription-based on-demand video streaming sites like Netflix and Amazon Prime. Any business idea with this core concept can be easily developed using StreamView. From admin uploading a video to users making payment to users watching the videos, it&rsquo;s all automated by a dynamic and responsive admin panel with multiple monetization channels.</p>', 1, '2020-09-23 10:25:31', '2021-06-05 12:04:45'),
(2, '1769827823', 'How much does StreamView cost?', '<p>The StreamView is the clone script of Netflix. Please contact the sales team in the streamhash.com</p>', 1, '2020-09-23 10:26:18', '2021-06-05 12:04:12'),
(3, '689735254', 'Where can i watch?', '<p>StreamView is programmed to start subscription based on-demand video streaming sites like Netflix and Amazon Prime. Any business idea with this core concept can be easily developed using StreamView. From admin uploading a video to users making payment to users watching the videos, it&rsquo;s all automated by a dynamic and responsive admin panel with multiple monetization channels.</p>', 1, '2020-09-29 17:26:57', '2021-06-05 12:04:59'),
(4, '276812971', 'How do i cancel?', '<p>StreamView is programmed to start subscription based on-demand video streaming sites like Netflix and Amazon Prime. Any business idea with this core concept can be easily developed using StreamView. From admin uploading a video to users making payment to users watching the videos, it&rsquo;s all automated by a dynamic and responsive admin panel with multiple monetization channels.</p>', 1, '2020-09-29 17:27:20', '2021-06-05 12:05:07'),
(5, '70219851', 'What can i watch on StreamView?', '<p>Watch anywhere, anytime, on an unlimited number of devices. Sign in with your streamview account to watch instantly on the web at streamhash.com from your personal computer or on any internet-connected device that offers the streamview app, including smart TVs, smartphones, tablets, streaming media players and game consoles.</p>', 1, '2020-09-29 17:27:52', '2021-06-05 12:03:07'),
(6, '1174050106', 'How StreamView works?', '<p>Complete white-label solution to launch your own Netflix-like venture.</p>\r\n\r\n<p>Streamview provides Netflix clone script that facilitates you to get started with your own video on demand platform. This video on demand script of ours is highly scalable and can be customized to suit your requirements &ndash; be it modifying the front-end UI, adding features in the mobile app or anything else.</p>\r\n\r\n<p>The video on demand software that you get from us will be a Netflix clone with all the standard features of Netflix, but we will work with you through any changes you need in design, development, deployment, hosting and maintenance.</p>', 1, '2020-11-09 13:30:24', '2021-06-05 12:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `flags`
--

CREATE TABLE `flags` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key, It is an unique key',
  `user_id` int(10) UNSIGNED NOT NULL,
  `sub_profile_id` int(11) NOT NULL,
  `video_id` int(10) UNSIGNED NOT NULL,
  `reason` longtext COLLATE utf8_unicode_ci COMMENT 'Reason for flagging the video',
  `status` smallint(6) NOT NULL DEFAULT '0' COMMENT 'Status of the flag table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '5f4fccba775cc',
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `video` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `position` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1',
  `is_home_display` int(11) NOT NULL DEFAULT '0',
  `is_approved` int(11) NOT NULL DEFAULT '1',
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `folder_name` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `folder_name`, `language`, `status`, `created_at`, `updated_at`) VALUES
(2, 'en', 'English', 1, '2019-04-02 05:18:32', '2020-04-18 19:47:44');

-- --------------------------------------------------------

--
-- Table structure for table `like_dislike_videos`
--

CREATE TABLE `like_dislike_videos` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_video_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sub_profile_id` int(11) NOT NULL,
  `like_status` int(11) NOT NULL,
  `dislike_status` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `like_dislike_videos`
--

INSERT INTO `like_dislike_videos` (`id`, `admin_video_id`, `user_id`, `sub_profile_id`, `like_status`, `dislike_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 1171, 7, 7, 1, 0, 0, '2021-06-05 12:58:41', '2021-06-05 12:58:41'),
(2, 1172, 7, 7, 1, 0, 0, '2021-06-05 12:58:45', '2021-06-05 12:58:45');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2015_08_25_172600_create_settings_table', 1),
(4, '2016_07_25_142335_create_admins_table', 1),
(5, '2016_07_25_142358_create_moderators_table', 1),
(6, '2016_07_28_111853_create_categories_table', 1),
(7, '2016_07_28_111900_create_sub_categories_table', 1),
(8, '2016_07_28_113237_create_sub_category_images_table', 1),
(9, '2016_07_30_033554_add_is_series_field_to_categories_table', 1),
(10, '2016_07_30_040800_create_admin_videos_table', 1),
(11, '2016_07_30_040833_create_admin_video_images_table', 1),
(12, '2016_07_30_132812_create_genres_table', 1),
(13, '2016_07_31_140521_add_genre_id_to_admin_videos_table', 1),
(14, '2016_08_01_151115_add_status_to_admin_videos_table', 1),
(15, '2016_08_02_030955_add_is_approved_to_categories_table', 1),
(16, '2016_08_02_031030_add_is_approved_to_sub_categories_table', 1),
(17, '2016_08_02_031053_add_is_approved_genres_table', 1),
(18, '2016_08_02_031301_add_is_approved_admin_videos_table', 1),
(19, '2016_08_02_134552_create_user_ratings_table', 1),
(20, '2016_08_02_143110_create_wishlists_table', 1),
(21, '2016_08_02_144545_create_user_histories_table', 1),
(22, '2016_08_02_152202_add_default_image_to_admin_videos_table', 1),
(23, '2016_08_02_154250_add_watch_count_to_admin_videos_table', 1),
(24, '2016_08_07_122712_create_pages_table', 1),
(25, '2016_08_08_091037_add_publish_time_to_admin_videos_table', 1),
(26, '2016_08_13_075844_add_video_type-to_admin_videos_table', 1),
(27, '2016_08_13_083130_add_video_upload_type-to_admin_videos_table', 1),
(28, '2016_08_14_042749_add_description_as_text_type', 1),
(29, '2016_08_16_035007_add_is_moderator_to_users_table', 1),
(30, '2016_08_16_070128_add_is_user_to_moderator_table', 1),
(31, '2016_08_19_134019_create_user_payments_table', 1),
(32, '2016_08_19_182650_add_is_paid_to_users', 1),
(33, '2016_08_26_065631_add_duration_to_admin_videos', 1),
(34, '2016_08_29_064138_change_device_type_in_users_table', 1),
(35, '2016_08_29_073204_create_mobile_registers_table', 1),
(36, '2016_08_29_082431_create_page_counters_table', 1),
(37, '2016_08_31_194838_change_video_id_in_admin_video_images', 1),
(38, '2016_09_02_133843_add_is_home_slider_to_admin_videos', 1),
(39, '2016_09_15_070030_create_jobs_table', 1),
(40, '2016_09_15_070051_create_failed_jobs_table', 1),
(41, '2016_09_15_163652_add_is_banner_to_admin_videos_table', 1),
(42, '2016_09_23_180525_add_push_status_users_table', 1),
(43, '2016_09_29_103536_change_login_by_users', 1),
(44, '2017_01_31_114409_create_user_tracks_table', 1),
(45, '2017_03_21_144617_add_timezone_users_field', 1),
(46, '2017_03_21_144742_add_timezone_moderators_field', 1),
(47, '2017_03_21_144824_add_timezone_admins_field', 1),
(48, '2017_03_22_124504_create_flags_table', 1),
(49, '2017_03_23_093118_create_pay_per_views_table', 1),
(50, '2017_03_23_100352_add_pay_per_view_fields_to_admin_videos_table', 1),
(51, '2017_04_07_083733_add_email_verification_fields_to_users_table', 1),
(52, '2017_04_12_085551_create_language_table', 1),
(53, '2017_07_03_110327_create_sub_profile', 1),
(54, '2017_07_04_062546_added_subscription_field_in_user_payments_table', 2),
(55, '2017_07_04_062857_create_subscription_table', 2),
(56, '2017_07_04_063121_added_subscription_fields_in_users_table', 2),
(57, '2017_07_04_145640_add_details_field_in_videos_table', 3),
(58, '2017_07_08_072952_add_no_of_account_in_subscription_table', 4),
(59, '2017_07_08_091332_added_video_fields_table_genres', 4),
(60, '2017_07_08_105614_added_image_field_table_genres', 5),
(61, '2017_07_13_082946_create_notification_table', 6),
(62, '2017_05_24_151437_create_redeems_table', 7),
(63, '2017_05_24_161212_create_redeem_requests_table', 7),
(64, '2017_07_29_115401_add_unique_id_in_admin_videos', 7),
(65, '2017_08_07_133107_added_unique_id_in_genre_table', 7),
(66, '2017_08_14_085732_added_subtitle_to_admin_videos', 7),
(67, '2017_08_14_092159_create_like_dislike_videos', 7),
(68, '2017_09_04_102357_added_enum_in_page', 7),
(69, '2017_10_09_073405_create_card_table', 7),
(70, '2017_10_09_145238_alter_table_in_videos', 7),
(71, '2017_10_09_145431_added_created_by_in_payperview', 7),
(72, '2017_10_10_065833_added_redeem_amount_in_admin_videos', 7),
(73, '2017_10_10_131357_added_payments_in_admin_videos', 7),
(74, '2017_10_10_131448_added_payments_in_moderators', 7),
(75, '2017_10_11_092951_added_subtitle_in_genre_table', 7),
(76, '2017_10_13_144508_added_card_id_in_users_table', 7),
(77, '2017_10_14_071458_added_payment_mode_in_users_table', 7),
(78, '2017_10_14_092354_added_sub_profile_id_in_spam_videos', 7),
(79, '2017_11_26_055417_added_no_of_account_in_users', 8),
(80, '2017_11_26_061536_created_user_logged_in_table', 8),
(81, '2017_12_12_173534_changed_data_type_of_admin_video_amount', 9),
(82, '2017_12_13_094327_added_fields_in_pay_perviews', 10),
(83, '2017_12_22_182954_add_notes_to_user_payments_table', 11),
(84, '2017_12_22_183016_add_notes_to_pay_per_views_table', 11),
(85, '2017_12_27_074050_add_commission_fields_to_pay_per_views_table', 12),
(86, '2017_12_27_085914_add_commission_spilit_details_to_redeems', 12),
(87, '2017_12_28_094142_changed_data_type_of_redeem', 13),
(88, '2018_03_13_190955_create_continue_watching_videos_table', 14),
(89, '2018_03_13_191127_add_position_in_admin_videos_table', 14),
(90, '2018_03_14_074409_add_duration_of_the_video_in_continue_watching', 14),
(91, '2018_03_16_135221_add_payment_mode_in_user_payments', 14),
(92, '2018_03_16_135256_add_payment_mode_in_pay_per_views', 14),
(93, '2018_03_19_112443_add_age_in_admin_videos', 14),
(94, '2018_03_19_113402_add_email_notification_in_users', 14),
(95, '2018_03_19_113707_create_email_templates_table', 14),
(96, '2018_03_13_062232_create_coupons_table', 15),
(97, '2018_03_19_104311_add_ppv_amount_to_pay_per_views', 15),
(98, '2018_03_19_105540_add_sub_coupon_amount', 15),
(99, '2018_05_28_081507_add_user_type_by_field_to_users_table', 16),
(100, '2018_01_27_073919_added_cancel_subscription_status', 17),
(101, '2018_05_05_064436_added_enum_values_in_pages', 17),
(102, '2018_06_20_112835_add_coupon_status_fields_in_user_payments', 18),
(103, '2018_06_20_112849_add_coupon_status_fields_in_pay_per_views', 18),
(104, '2018_06_21_123332_add_ppv_fields_in_admin_videos_table', 19),
(105, '2018_06_21_123354_add_ppv_fields_in_pay_per_views_table', 19),
(106, '2018_07_03_094024_add_compression_status_in_admin_videos_table', 19),
(107, '2018_07_04_095136_create_cast_crews_table', 20),
(108, '2018_07_04_120838_create_video_cast_crews_table', 20),
(109, '2018_07_07_090350_add_cancel_resaon_in_subscriptions', 20),
(110, '2018_07_07_103833_add_coupon_fields_in_coupons_table', 20),
(111, '2018_07_07_114047_create_user_coupons_table', 20),
(112, '2018_07_09_182616_add_payment_fields_in_table', 20),
(113, '2018_07_10_103948_add_video_fields_in_admin_videos_table', 20),
(114, '2018_07_13_062658_change_coupon_fields_in_user_paymants_table', 20),
(115, '2018_08_01_133331_add_payment_mode_to_redeem_requests_table', 20),
(116, '2018_05_29_094606_add_auto_renewal_fields_to_user_payments_table', 21),
(117, '2017_09_18_064132_create_notification_templates_table', 22),
(118, '2018_09_10_083546_add_download_fields_in_admin_videos', 22),
(119, '2018_09_17_110923_create_offline_admin_videos', 22),
(120, '2018_09_25_115241_add_fields_in_admins_table', 22),
(121, '2018_10_11_113012_add_kids_fields_in_admin_videos', 22),
(122, '2018_11_26_153554_add_fields_in_user_notifications_table', 22),
(123, '2019_01_19_071509_version_4_tables_and_changes', 22),
(124, '2019_03_13_092259_add_v4_1_migrations', 22),
(125, '2019_03_14_053152_create_sub_admins_table', 22),
(126, '2019_05_13_070759_add_is_current_to_user_payments_table', 23),
(127, '2019_09_23_095351_add_section_type_to_static_pages', 24),
(128, '2020_02_17_161716_v6_0_referral_related_migrations', 25),
(129, '2020_02_20_135523_v6_0_wallet_related_migrations', 25),
(130, '2020_05_07_081537_add_apple_to_users_table', 26),
(131, '2020_06_03_065322_add_player_json_to_admin_videos_table', 27),
(132, '2020_07_25_081948_add_default_to_fields_version_upgrade', 28),
(133, '2020_07_31_121603_add_hls_video_fields_to_admin_videos_table', 28),
(134, '2020_08_14_080400_create_video_watch_count_table', 29),
(135, '2020_09_04_055441_createfaqs_table', 29),
(136, '2020_10_07_104801_add_subtitle_vtt_fields_to_admin_videos', 30);

-- --------------------------------------------------------

--
-- Table structure for table `mobile_registers`
--

CREATE TABLE `mobile_registers` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mobile_registers`
--

INSERT INTO `mobile_registers` (`id`, `type`, `count`, `created_at`, `updated_at`) VALUES
(1, 'android', 2864, NULL, '2021-06-05 12:12:56'),
(2, 'ios', 4701, NULL, '2021-06-05 12:12:42'),
(3, 'web', 2543, NULL, '2021-06-05 12:58:05');

-- --------------------------------------------------------

--
-- Table structure for table `moderators`
--

CREATE TABLE `moderators` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token_expiry` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `is_activated` int(11) NOT NULL DEFAULT '1',
  `is_user` int(11) NOT NULL DEFAULT '0',
  `gender` enum('male','female','others') COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `paypal_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timezone` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'America/Los_Angeles',
  `total` double(8,2) DEFAULT '0.00',
  `total_admin_amount` double(8,2) DEFAULT '0.00',
  `total_user_amount` double(8,2) DEFAULT '0.00',
  `paid_amount` double(8,2) DEFAULT '0.00',
  `remaining_amount` double(8,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `moderators`
--

INSERT INTO `moderators` (`id`, `name`, `email`, `password`, `token`, `token_expiry`, `picture`, `description`, `is_activated`, `is_user`, `gender`, `mobile`, `paypal_email`, `address`, `remember_token`, `timezone`, `total`, `total_admin_amount`, `total_user_amount`, `paid_amount`, `remaining_amount`, `created_at`, `updated_at`) VALUES
(387, 'Moderator', 'moderator@streamview.com', '$2y$10$AczJXgbAC1behlDZR28wYORecPakdCqe6oeTDewuJupv471TIBxO6', '2y10CN84YvuZ9TXkj7nSIAZj0eLeiBRX17m8fTljMXxToFKUUdJi27eQW', '1622845694', 'http://adminview.streamhash.com/placeholder.png', '', 1, 0, 'male', '', '', '', NULL, 'America/Los_Angeles', 0.00, 0.00, 0.00, 0.00, 0.00, '2021-05-12 00:00:02', '2021-06-05 10:44:09');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `admin_video_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_templates`
--

CREATE TABLE `notification_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offline_admin_videos`
--

CREATE TABLE `offline_admin_videos` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_video_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sub_profile_id` int(11) NOT NULL,
  `download_status` tinyint(4) NOT NULL COMMENT '1 - Started Download, 2 - Onprogress, 3 - Pause, 4 - Completed, 5 - Failed/Cancelled,',
  `download_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `is_expired` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '5f4fccb9a782f',
  `heading` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('about','privacy','terms','help','others','contact','faq') COLLATE utf8_unicode_ci DEFAULT 'contact',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `section_type` enum('1','2','3','4') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `unique_id`, `heading`, `description`, `type`, `status`, `created_at`, `updated_at`, `title`, `section_type`) VALUES
(5, 'help', 'Help', '<h2><strong>Let&rsquo;s Talk</strong></h2>\r\n\r\n<p>Questions? Comments? We&rsquo;d love to hear from you.</p>\r\n\r\n<p>Mail : sales@streamhash.com</p>\r\n\r\n<p>Skype:&nbsp;Contact@streamhash.com</p>\r\n\r\n<p>Mobile : +1-(415)-418-7755</p>', 'help', 1, '2017-12-03 11:48:22', '2021-06-05 11:36:25', '', '1'),
(19, 'terms', 'Terms', '<h2><strong>Terms and Conditions</strong></h2>\r\n\r\n<p>Welcome to StreamHash!</p>\r\n\r\n<p>These terms and conditions outline the rules and regulations for the use of StreamHash\'s Website, located at https://streamhash.com/.</p>\r\n\r\n<p>By accessing this website we assume you accept these terms and conditions. Do not continue to use StreamHash if you do not agree to take all of the terms and conditions stated on this page.</p>\r\n\r\n<p>The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and all Agreements: "Client", "You" and "Your" refers to you, the person log on this website and compliant to the Company’s terms and conditions. "The Company", "Ourselves", "We", "Our" and "Us", refers to our Company. "Party", "Parties", or "Us", refers to both the Client and ourselves. All terms refer to the offer, acceptance and consideration of payment necessary to undertake the process of our assistance to the Client in the most appropriate manner for the express purpose of meeting the Client’s needs in respect of provision of the Company’s stated services, in accordance with and subject to, prevailing law of Netherlands. Any use of the above terminology or other words in the singular, plural, capitalization and/or he/she or they, are taken as interchangeable and therefore as referring to same.</p>\r\n\r\n<h3><strong>Cookies</strong></h3>\r\n\r\n<p>We employ the use of cookies. By accessing StreamHash, you agreed to use cookies in agreement with the StreamHash\'s Privacy Policy. </p>\r\n\r\n<p>Most interactive websites use cookies to let us retrieve the user’s details for each visit. Cookies are used by our website to enable the functionality of certain areas to make it easier for people visiting our website. Some of our affiliate/advertising partners may also use cookies.</p>\r\n\r\n<h3><strong>License</strong></h3>\r\n\r\n<p>Unless otherwise stated, StreamHash and/or its licensors own the intellectual property rights for all material on StreamHash. All intellectual property rights are reserved. You may access this from StreamHash for your own personal use subjected to restrictions set in these terms and conditions.</p>\r\n\r\n<p>You must not:</p>\r\n<ul>\r\n    <li>Republish material from StreamHash</li>\r\n    <li>Sell, rent or sub-license material from StreamHash</li>\r\n    <li>Reproduce, duplicate or copy material from StreamHash</li>\r\n    <li>Redistribute content from StreamHash</li>\r\n</ul>\r\n\r\n<p>This Agreement shall begin on the date hereof. Our Terms and Conditions were created with the help of the <a href="https://www.termsandconditionsgenerator.com">Terms And Conditions Generator</a>.</p>\r\n\r\n<p>Parts of this website offer an opportunity for users to post and exchange opinions and information in certain areas of the website. StreamHash does not filter, edit, publish or review Comments prior to their presence on the website. Comments do not reflect the views and opinions of StreamHash,its agents and/or affiliates. Comments reflect the views and opinions of the person who post their views and opinions. To the extent permitted by applicable laws, StreamHash shall not be liable for the Comments or for any liability, damages or expenses caused and/or suffered as a result of any use of and/or posting of and/or appearance of the Comments on this website.</p>\r\n\r\n<p>StreamHash reserves the right to monitor all Comments and to remove any Comments which can be considered inappropriate, offensive or causes breach of these Terms and Conditions.</p>\r\n\r\n<p>You warrant and represent that:</p>\r\n\r\n<ul>\r\n    <li>You are entitled to post the Comments on our website and have all necessary licenses and consents to do so;</li>\r\n    <li>The Comments do not invade any intellectual property right, including without limitation copyright, patent or trademark of any third party;</li>\r\n    <li>The Comments do not contain any defamatory, libelous, offensive, indecent or otherwise unlawful material which is an invasion of privacy</li>\r\n    <li>The Comments will not be used to solicit or promote business or custom or present commercial activities or unlawful activity.</li>\r\n</ul>\r\n\r\n<p>You hereby grant StreamHash a non-exclusive license to use, reproduce, edit and authorize others to use, reproduce and edit any of your Comments in any and all forms, formats or media.</p>\r\n\r\n<h3><strong>Hyperlinking to our Content</strong></h3>\r\n\r\n<p>The following organizations may link to our Website without prior written approval:</p>\r\n\r\n<ul>\r\n    <li>Government agencies;</li>\r\n    <li>Search engines;</li>\r\n    <li>News organizations;</li>\r\n    <li>Online directory distributors may link to our Website in the same manner as they hyperlink to the Websites of other listed businesses; and</li>\r\n    <li>System wide Accredited Businesses except soliciting non-profit organizations, charity shopping malls, and charity fundraising groups which may not hyperlink to our Web site.</li>\r\n</ul>\r\n\r\n<p>These organizations may link to our home page, to publications or to other Website information so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products and/or services; and (c) fits within the context of the linking party’s site.</p>\r\n\r\n<p>We may consider and approve other link requests from the following types of organizations:</p>\r\n\r\n<ul>\r\n    <li>commonly-known consumer and/or business information sources;</li>\r\n    <li>dot.com community sites;</li>\r\n    <li>associations or other groups representing charities;</li>\r\n    <li>online directory distributors;</li>\r\n    <li>internet portals;</li>\r\n    <li>accounting, law and consulting firms; and</li>\r\n    <li>educational institutions and trade associations.</li>\r\n</ul>\r\n\r\n<p>We will approve link requests from these organizations if we decide that: (a) the link would not make us look unfavorably to ourselves or to our accredited businesses; (b) the organization does not have any negative records with us; (c) the benefit to us from the visibility of the hyperlink compensates the absence of StreamHash; and (d) the link is in the context of general resource information.</p>\r\n\r\n<p>These organizations may link to our home page so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products or services; and (c) fits within the context of the linking party’s site.</p>\r\n\r\n<p>If you are one of the organizations listed in paragraph 2 above and are interested in linking to our website, you must inform us by sending an e-mail to StreamHash. Please include your name, your organization name, contact information as well as the URL of your site, a list of any URLs from which you intend to link to our Website, and a list of the URLs on our site to which you would like to link. Wait 2-3 weeks for a response.</p>\r\n\r\n<p>Approved organizations may hyperlink to our Website as follows:</p>\r\n\r\n<ul>\r\n    <li>By use of our corporate name; or</li>\r\n    <li>By use of the uniform resource locator being linked to; or</li>\r\n    <li>By use of any other description of our Website being linked to that makes sense within the context and format of content on the linking party’s site.</li>\r\n</ul>\r\n\r\n<p>No use of StreamHash\'s logo or other artwork will be allowed for linking absent a trademark license agreement.</p>\r\n\r\n<h3><strong>iFrames</strong></h3>\r\n\r\n<p>Without prior approval and written permission, you may not create frames around our Webpages that alter in any way the visual presentation or appearance of our Website.</p>\r\n\r\n<h3><strong>Content Liability</strong></h3>\r\n\r\n<p>We shall not be hold responsible for any content that appears on your Website. You agree to protect and defend us against all claims that is rising on your Website. No link(s) should appear on any Website that may be interpreted as libelous, obscene or criminal, or which infringes, otherwise violates, or advocates the infringement or other violation of, any third party rights.</p>\r\n\r\n<h3><strong>Your Privacy</strong></h3>\r\n\r\n<p>Please read Privacy Policy</p>\r\n\r\n<h3><strong>Reservation of Rights</strong></h3>\r\n\r\n<p>We reserve the right to request that you remove all links or any particular link to our Website. You approve to immediately remove all links to our Website upon request. We also reserve the right to amen these terms and conditions and it’s linking policy at any time. By continuously linking to our Website, you agree to be bound to and follow these linking terms and conditions.</p>\r\n\r\n<h3><strong>Removal of links from our website</strong></h3>\r\n\r\n<p>If you find any link on our Website that is offensive for any reason, you are free to contact and inform us any moment. We will consider requests to remove links but we are not obligated to or so or to respond to you directly.</p>\r\n\r\n<p>We do not ensure that the information on this website is correct, we do not warrant its completeness or accuracy; nor do we promise to ensure that the website remains available or that the material on the website is kept up to date.</p>\r\n\r\n<h3><strong>Disclaimer</strong></h3>\r\n\r\n<p>To the maximum extent permitted by applicable law, we exclude all representations, warranties and conditions relating to our website and the use of this website. Nothing in this disclaimer will:</p>\r\n\r\n<ul>\r\n    <li>limit or exclude our or your liability for death or personal injury;</li>\r\n    <li>limit or exclude our or your liability for fraud or fraudulent misrepresentation;</li>\r\n    <li>limit any of our or your liabilities in any way that is not permitted under applicable law; or</li>\r\n    <li>exclude any of our or your liabilities that may not be excluded under applicable law.</li>\r\n</ul>\r\n\r\n<p>The limitations and prohibitions of liability set in this Section and elsewhere in this disclaimer: (a) are subject to the preceding paragraph; and (b) govern all liabilities arising under the disclaimer, including liabilities arising in contract, in tort and for breach of statutory duty.</p>\r\n\r\n<p>As long as the website and the information and services on the website are provided free of charge, we will not be liable for any loss or damage of any nature.</p>', 'terms', 1, '2019-03-21 06:59:41', '2021-06-05 11:44:16', '', '1'),
(24, 'faq', 'FAQ', '<h2>Get Started!</h2>\r\n\r\n<p>Follow these easy steps to start watching StreamView today:</p>\r\n\r\n<ol>\r\n	<li>\r\n	<p>Choose the membership plan  that&rsquo;s right for you.</p>\r\n	</li>\r\n	<li>\r\n	<p>Create an account by entering your email address and creating a password.</p>\r\n	</li>\r\n	<li>\r\n	<p>Enter a payment method.</p>\r\n	</li>\r\n	<li>\r\n	<p>That&#39;s it. Stream on!</p>\r\n	</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>', 'faq', 1, '2020-09-02 18:58:18', '2021-06-05 11:43:20', '', '1'),
(29, 'privacy', 'Privacy', '<h1>Privacy Policy for StreamHash</h1>\r\n\r\n<p>At StreamHash, accessible from https://streamhash.com/, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by StreamHash and how we use it.</p>\r\n\r\n<p>If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us.</p>\r\n\r\n<p>This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in StreamHash. This policy is not applicable to any information collected offline or via channels other than this website. Our Privacy Policy was created with the help of the <a href="https://www.privacypolicygenerator.info/">Privacy Policy Generator</a>.</p>\r\n\r\n<h2>Consent</h2>\r\n\r\n<p>By using our website, you hereby consent to our Privacy Policy and agree to its terms.</p>\r\n\r\n<h2>Information we collect</h2>\r\n\r\n<p>The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information.</p>\r\n<p>If you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and/or attachments you may send us, and any other information you may choose to provide.</p>\r\n<p>When you register for an Account, we may ask for your contact information, including items such as name, company name, address, email address, and telephone number.</p>\r\n\r\n<h2>How we use your information</h2>\r\n\r\n<p>We use the information we collect in various ways, including to:</p>\r\n\r\n<ul>\r\n<li>Provide, operate, and maintain our website</li>\r\n<li>Improve, personalize, and expand our website</li>\r\n<li>Understand and analyze how you use our website</li>\r\n<li>Develop new products, services, features, and functionality</li>\r\n<li>Communicate with you, either directly or through one of our partners, including for customer service, to provide you with updates and other information relating to the website, and for marketing and promotional purposes</li>\r\n<li>Send you emails</li>\r\n<li>Find and prevent fraud</li>\r\n</ul>\r\n\r\n<h2>Log Files</h2>\r\n\r\n<p>StreamHash follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services\' analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking users\' movement on the website, and gathering demographic information.</p>\r\n\r\n<h2>Cookies and Web Beacons</h2>\r\n\r\n<p>Like any other website, StreamHash uses \'cookies\'. These cookies are used to store information including visitors\' preferences, and the pages on the website that the visitor accessed or visited. The information is used to optimize the users\' experience by customizing our web page content based on visitors\' browser type and/or other information.</p>\r\n\r\n<p>For more general information on cookies, please read <a href="https://www.privacypolicyonline.com/what-are-cookies/">"What Are Cookies"</a>.</p>\r\n\r\n\r\n\r\n<h2>Advertising Partners Privacy Policies</h2>\r\n\r\n<P>You may consult this list to find the Privacy Policy for each of the advertising partners of StreamHash.</p>\r\n\r\n<p>Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used in their respective advertisements and links that appear on StreamHash, which are sent directly to users\' browser. They automatically receive your IP address when this occurs. These technologies are used to measure the effectiveness of their advertising campaigns and/or to personalize the advertising content that you see on websites that you visit.</p>\r\n\r\n<p>Note that StreamHash has no access to or control over these cookies that are used by third-party advertisers.</p>\r\n\r\n<h2>Third Party Privacy Policies</h2>\r\n\r\n<p>StreamHash\'s Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options. </p>\r\n\r\n<p>You can choose to disable cookies through your individual browser options. To know more detailed information about cookie management with specific web browsers, it can be found at the browsers\' respective websites.</p>\r\n\r\n<h2>CCPA Privacy Rights (Do Not Sell My Personal Information)</h2>\r\n\r\n<p>Under the CCPA, among other rights, California consumers have the right to:</p>\r\n<p>Request that a business that collects a consumer\'s personal data disclose the categories and specific pieces of personal data that a business has collected about consumers.</p>\r\n<p>Request that a business delete any personal data about the consumer that a business has collected.</p>\r\n<p>Request that a business that sells a consumer\'s personal data, not sell the consumer\'s personal data.</p>\r\n<p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>\r\n\r\n<h2>GDPR Data Protection Rights</h2>\r\n\r\n<p>We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:</p>\r\n<p>The right to access – You have the right to request copies of your personal data. We may charge you a small fee for this service.</p>\r\n<p>The right to rectification – You have the right to request that we correct any information you believe is inaccurate. You also have the right to request that we complete the information you believe is incomplete.</p>\r\n<p>The right to erasure – You have the right to request that we erase your personal data, under certain conditions.</p>\r\n<p>The right to restrict processing – You have the right to request that we restrict the processing of your personal data, under certain conditions.</p>\r\n<p>The right to object to processing – You have the right to object to our processing of your personal data, under certain conditions.</p>\r\n<p>The right to data portability – You have the right to request that we transfer the data that we have collected to another organization, or directly to you, under certain conditions.</p>\r\n<p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>\r\n\r\n<h2>Children\'s Information</h2>\r\n\r\n<p>Another part of our priority is adding protection for children while using the internet. We encourage parents and guardians to observe, participate in, and/or monitor and guide their online activity.</p>\r\n\r\n<p>StreamHash does not knowingly collect any Personal Identifiable Information from children under the age of 13. If you think that your child provided this kind of information on our website, we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records.</p>', 'privacy', 1, '2021-02-08 11:56:49', '2021-06-05 11:44:06', '', '1'),
(38, 'Cookies-Preferences', 'Cookies Preferences', '<p style="font-style: italic;">We and our Service Providers use cookies and other technologies (such as web beacons), as well as resettable device identifiers, for various reasons. We want you to be informed about our use of these technologies, so this section explains the types of technologies we use, what they do, and your choices regarding their use.&nbsp;</p>', 'others', 1, '2021-06-05 11:45:05', '2021-06-05 11:45:05', '', '2'),
(39, 'about', 'About Us', '<p>We are a team of experts across the video streaming domain. Be it like Netflix/Youtube /Live streaming, we provide solutions for all these business ideas. Websites/Mobile apps &ndash; Ready-made solutions to launch a business-ready application.</p>\r\n\r\n<p><strong>Dream to Stream &ndash; we are here for you.</strong></p>', 'about', 1, '2021-06-05 11:46:34', '2021-06-05 11:46:34', '', '2'),
(40, 'contact', 'Contact Us', '<p>Call Us &ndash;&nbsp;<a href="tel:+1-(415)-418-7755">+1-(415)-418-7755</a></p>\r\n\r\n<p><strong>Located At</strong></p>\r\n\r\n<p>Sukhumvit Soi 69, Prakanong,Wattana, Bangkok 10110, Thailand.</p>\r\n\r\n<p>1st Floor, N.A Elixir-1,<br />\r\n73/A, Doddathogur village, Begur Hobli, Electronic City phase-1, Bangalore: 560100.</p>', 'contact', 1, '2021-06-05 11:47:13', '2021-06-05 11:47:13', '', '2');

-- --------------------------------------------------------

--
-- Table structure for table `page_counters`
--

CREATE TABLE `page_counters` (
  `id` int(10) UNSIGNED NOT NULL,
  `page` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `page_counters`
--

INSERT INTO `page_counters` (`id`, `page`, `count`, `created_at`, `updated_at`) VALUES
(1, 'home', 52, '2017-11-09 07:55:48', '2017-11-09 22:35:28'),
(2, 'home', 67, '2017-11-10 00:07:57', '2017-11-10 23:36:46'),
(3, 'home', 96, '2017-11-11 00:36:25', '2017-11-11 23:40:20'),
(4, 'home', 47, '2017-11-12 02:13:27', '2017-11-12 23:51:32'),
(5, 'home', 102, '2017-11-13 00:18:37', '2017-11-13 22:27:31'),
(6, 'home', 102, '2017-11-14 02:46:49', '2017-11-14 23:12:56'),
(7, 'home', 251, '2017-11-15 01:48:52', '2017-11-15 23:38:24'),
(8, 'home', 160, '2017-11-16 00:08:23', '2017-11-16 23:30:39'),
(9, 'home', 64, '2017-11-17 01:18:50', '2017-11-17 22:38:46'),
(10, 'home', 125, '2017-11-18 00:06:26', '2017-11-18 23:23:09'),
(11, 'home', 76, '2017-11-19 00:41:57', '2017-11-19 23:17:18'),
(12, 'home', 79, '2017-11-20 01:20:55', '2017-11-20 23:24:27'),
(13, 'home', 102, '2017-11-21 00:39:26', '2017-11-21 23:13:11'),
(14, 'home', 84, '2017-11-22 00:10:22', '2017-11-22 23:09:45'),
(15, 'home', 79, '2017-11-23 00:52:29', '2017-11-23 23:34:22'),
(16, 'home', 70, '2017-11-24 00:36:11', '2017-11-24 23:53:19'),
(17, 'home', 84, '2017-11-25 00:17:18', '2017-11-25 22:52:37'),
(18, 'home', 63, '2017-11-26 02:01:54', '2017-11-26 23:52:49'),
(19, 'home', 37, '2017-11-27 00:23:37', '2017-11-27 20:49:37'),
(20, 'home', 46, '2017-11-28 00:11:02', '2017-11-28 21:13:53'),
(21, 'home', 22, '2017-11-29 03:18:37', '2017-11-29 20:57:48'),
(22, 'home', 72, '2017-11-30 00:16:15', '2017-11-30 21:21:46'),
(23, 'home', 76, '2017-12-01 01:49:11', '2017-12-01 23:53:21'),
(24, 'home', 34, '2017-12-02 08:47:12', '2017-12-02 23:55:58'),
(25, 'home', 52, '2017-12-03 00:02:39', '2017-12-03 21:41:43'),
(26, 'home', 130, '2017-12-04 00:08:25', '2017-12-04 23:37:49'),
(27, 'home', 37, '2017-12-05 01:08:09', '2017-12-05 23:58:46'),
(28, 'home', 93, '2017-12-06 00:51:22', '2017-12-06 21:17:09'),
(29, 'home', 197, '2017-12-07 00:57:22', '2017-12-07 23:44:10'),
(30, 'home', 90, '2017-12-08 00:44:23', '2017-12-08 22:18:38'),
(31, 'home', 75, '2017-12-09 03:10:58', '2017-12-09 22:48:49'),
(32, 'home', 32, '2017-12-10 00:06:39', '2017-12-10 22:51:22'),
(33, 'home', 220, '2017-12-11 01:09:14', '2017-12-11 23:57:22'),
(34, 'home', 307, '2017-12-12 00:23:45', '2017-12-12 23:09:32'),
(35, 'home', 346, '2017-12-13 01:16:26', '2017-12-13 23:33:00'),
(36, 'home', 353, '2017-12-14 00:25:05', '2017-12-14 22:43:21'),
(37, 'home', 158, '2017-12-15 01:41:25', '2017-12-15 23:51:43'),
(38, 'home', 46, '2017-12-16 02:41:05', '2017-12-16 23:36:36'),
(39, 'home', 50, '2017-12-17 01:00:03', '2017-12-17 23:47:47'),
(40, 'home', 158, '2017-12-18 04:51:19', '2017-12-18 23:50:39'),
(41, 'home', 178, '2017-12-19 01:37:54', '2017-12-19 23:12:38'),
(42, 'home', 115, '2017-12-20 02:26:41', '2017-12-20 22:20:17'),
(43, 'home', 89, '2017-12-21 00:01:53', '2017-12-21 22:38:35'),
(44, 'home', 32, '2017-12-22 05:40:56', '2017-12-22 17:15:40'),
(45, 'home', 71, '2017-12-23 05:03:52', '2017-12-23 20:35:35'),
(46, 'home', 34, '2017-12-24 07:38:37', '2017-12-24 22:13:12'),
(47, 'home', 90, '2017-12-25 00:18:37', '2017-12-25 20:35:29'),
(48, 'home', 80, '2017-12-26 02:39:53', '2017-12-26 22:48:15'),
(49, 'home', 95, '2017-12-27 05:12:08', '2017-12-27 20:33:34'),
(50, 'home', 103, '2017-12-28 04:53:33', '2017-12-28 22:58:15'),
(51, 'home', 89, '2017-12-29 00:14:46', '2017-12-29 23:59:12'),
(52, 'home', 54, '2017-12-30 00:50:14', '2017-12-30 22:33:50'),
(53, 'home', 47, '2017-12-31 01:12:42', '2017-12-31 23:05:15'),
(54, 'home', 18, '2018-01-01 03:13:02', '2018-01-01 23:32:34'),
(55, 'home', 82, '2018-01-02 00:41:28', '2018-01-02 21:38:29'),
(56, 'home', 67, '2018-01-03 00:09:58', '2018-01-03 21:09:04'),
(57, 'home', 84, '2018-01-04 00:27:58', '2018-01-04 21:45:25'),
(58, 'home', 63, '2018-01-05 00:18:22', '2018-01-05 23:51:32'),
(59, 'home', 85, '2018-01-06 01:56:20', '2018-01-06 23:07:04'),
(60, 'home', 84, '2018-01-07 00:30:34', '2018-01-07 22:58:01'),
(61, 'home', 66, '2018-01-08 01:28:21', '2018-01-08 23:36:18'),
(62, 'home', 69, '2018-01-09 00:37:12', '2018-01-09 23:48:04'),
(63, 'home', 174, '2018-01-10 00:11:23', '2018-01-10 23:43:37'),
(64, 'home', 74, '2018-01-11 00:12:30', '2018-01-11 21:57:31'),
(65, 'home', 64, '2018-01-12 07:03:09', '2018-01-12 23:52:44'),
(66, 'home', 3, '2018-01-13 02:03:00', '2018-01-13 23:58:15'),
(67, 'home', 1, '2018-01-14 03:50:14', '2018-01-14 03:50:14'),
(68, 'home', 52, '2018-01-15 12:38:44', '2018-01-15 23:46:26'),
(69, 'home', 85, '2018-01-16 00:13:49', '2018-01-16 22:16:04'),
(70, 'home', 57, '2018-01-17 00:52:56', '2018-01-17 22:27:09'),
(71, 'home', 166, '2018-01-18 00:27:42', '2018-01-18 22:41:28'),
(72, 'home', 99, '2018-01-19 00:49:14', '2018-01-19 23:57:28'),
(73, 'home', 115, '2018-01-20 01:35:04', '2018-01-20 23:58:18'),
(74, 'home', 52, '2018-01-21 00:13:10', '2018-01-21 21:58:47'),
(75, 'home', 59, '2018-01-22 03:07:06', '2018-01-22 23:06:44'),
(76, 'home', 90, '2018-01-23 00:02:29', '2018-01-23 23:41:36'),
(77, 'home', 67, '2018-01-24 00:27:31', '2018-01-24 22:24:30'),
(78, 'home', 101, '2018-01-25 00:20:33', '2018-01-25 23:29:07'),
(79, 'home', 135, '2018-01-26 00:28:37', '2018-01-26 23:59:48'),
(80, 'home', 64, '2018-01-27 00:00:29', '2018-01-27 22:09:36'),
(81, 'home', 25, '2018-01-28 05:29:27', '2018-01-28 23:32:30'),
(82, 'home', 55, '2018-01-29 05:09:32', '2018-01-29 23:16:08'),
(83, 'home', 87, '2018-01-30 00:23:36', '2018-01-30 23:51:12'),
(84, 'home', 53, '2018-01-31 01:43:17', '2018-01-31 23:39:12'),
(85, 'home', 57, '2018-02-01 01:21:47', '2018-02-01 23:47:27'),
(86, 'home', 61, '2018-02-02 00:01:27', '2018-02-02 23:37:26'),
(87, 'home', 92, '2018-02-03 02:26:50', '2018-02-03 23:36:15'),
(88, 'home', 44, '2018-02-04 01:28:00', '2018-02-04 23:48:53'),
(89, 'home', 45, '2018-02-05 00:49:08', '2018-02-05 23:46:16'),
(90, 'home', 77, '2018-02-06 00:17:55', '2018-02-06 22:13:56'),
(91, 'home', 56, '2018-02-07 00:10:22', '2018-02-07 23:44:05'),
(92, 'home', 114, '2018-02-08 02:20:42', '2018-02-08 23:52:32'),
(93, 'home', 66, '2018-02-09 00:08:41', '2018-02-09 21:26:22'),
(94, 'home', 73, '2018-02-10 02:30:30', '2018-02-10 21:15:49'),
(95, 'home', 88, '2018-02-11 00:59:56', '2018-02-11 22:30:47'),
(96, 'home', 101, '2018-02-12 02:29:48', '2018-02-12 22:30:39'),
(97, 'home', 154, '2018-02-13 00:42:37', '2018-02-13 23:01:46'),
(98, 'home', 89, '2018-02-14 01:14:23', '2018-02-14 23:19:59'),
(99, 'home', 89, '2018-02-15 00:03:04', '2018-02-15 21:47:42'),
(100, 'home', 98, '2018-02-16 00:36:50', '2018-02-16 23:54:46'),
(101, 'home', 30, '2018-02-17 06:00:40', '2018-02-17 23:40:43'),
(102, 'home', 60, '2018-02-18 00:18:23', '2018-02-18 23:51:57'),
(103, 'home', 97, '2018-02-19 00:57:10', '2018-02-19 23:00:49'),
(104, 'home', 93, '2018-02-20 00:38:46', '2018-02-20 23:35:58'),
(105, 'home', 107, '2018-02-21 00:40:16', '2018-02-21 22:57:40'),
(106, 'home', 88, '2018-02-22 00:15:06', '2018-02-22 21:45:09'),
(107, 'home', 63, '2018-02-23 00:10:40', '2018-02-23 23:00:02'),
(108, 'home', 68, '2018-02-24 00:09:13', '2018-02-24 20:52:34'),
(109, 'home', 101, '2018-02-25 00:29:57', '2018-02-25 23:51:46'),
(110, 'home', 129, '2018-02-26 00:09:35', '2018-02-26 23:44:18'),
(111, 'home', 114, '2018-02-27 00:17:35', '2018-02-27 22:46:56'),
(112, 'home', 61, '2018-02-28 00:31:09', '2018-02-28 21:06:13'),
(113, 'home', 56, '2018-03-01 00:03:04', '2018-03-01 23:34:09'),
(114, 'home', 69, '2018-03-02 00:09:41', '2018-03-02 21:32:43'),
(115, 'home', 167, '2018-03-03 00:48:47', '2018-03-03 23:49:39'),
(116, 'home', 73, '2018-03-04 00:20:09', '2018-03-04 23:05:23'),
(117, 'home', 78, '2018-03-05 00:10:22', '2018-03-05 23:36:25'),
(118, 'home', 129, '2018-03-06 00:51:43', '2018-03-06 18:20:58'),
(119, 'home', 124, '2018-03-07 05:20:17', '2018-03-07 23:35:19'),
(120, 'home', 250, '2018-03-08 01:04:25', '2018-03-08 22:27:03'),
(121, 'home', 212, '2018-03-09 00:47:05', '2018-03-09 21:58:31'),
(122, 'home', 175, '2018-03-10 00:15:12', '2018-03-10 21:00:40'),
(123, 'home', 79, '2018-03-11 00:52:14', '2018-03-11 23:45:48'),
(124, 'home', 123, '2018-03-12 00:03:16', '2018-03-12 22:56:58'),
(125, 'home', 305, '2018-03-13 00:16:51', '2018-03-13 23:59:21'),
(126, 'home', 145, '2018-03-14 01:07:08', '2018-03-14 23:56:51'),
(127, 'home', 125, '2018-03-15 01:30:12', '2018-03-15 23:42:25'),
(128, 'home', 194, '2018-03-16 03:04:55', '2018-03-16 23:46:25'),
(129, 'home', 114, '2018-03-17 00:20:54', '2018-03-17 21:12:10'),
(130, 'home', 44, '2018-03-18 04:29:22', '2018-03-18 22:52:37'),
(131, 'home', 145, '2018-03-19 00:06:16', '2018-03-19 23:45:15'),
(132, 'home', 169, '2018-03-20 01:01:45', '2018-03-20 23:46:17'),
(133, 'home', 224, '2018-03-21 01:24:09', '2018-03-21 23:31:11'),
(134, 'home', 121, '2018-03-22 01:39:29', '2018-03-22 23:28:36'),
(135, 'home', 132, '2018-03-23 00:20:24', '2018-03-23 22:58:48'),
(136, 'home', 275, '2018-03-24 03:39:28', '2018-03-24 23:43:33'),
(137, 'home', 117, '2018-03-25 00:22:16', '2018-03-25 23:42:17'),
(138, 'home', 142, '2018-03-26 00:41:51', '2018-03-26 23:15:34'),
(139, 'home', 151, '2018-03-27 00:15:07', '2018-03-27 23:15:26'),
(140, 'home', 272, '2018-03-28 01:01:50', '2018-03-28 23:48:28'),
(141, 'home', 253, '2018-03-29 00:03:49', '2018-03-29 20:44:00'),
(142, 'home', 197, '2018-03-30 01:43:39', '2018-03-30 23:07:29'),
(143, 'home', 193, '2018-03-31 01:08:56', '2018-03-31 23:35:59'),
(144, 'home', 103, '2018-04-01 02:27:44', '2018-04-01 23:24:27'),
(145, 'home', 255, '2018-04-02 00:37:48', '2018-04-02 23:44:32'),
(146, 'home', 219, '2018-04-03 00:01:59', '2018-04-03 20:42:10'),
(147, 'home', 200, '2018-04-04 00:46:42', '2018-04-04 22:39:18'),
(148, 'home', 253, '2018-04-05 00:29:31', '2018-04-05 23:19:03'),
(149, 'home', 140, '2018-04-06 00:04:23', '2018-04-06 23:43:28'),
(150, 'home', 111, '2018-04-07 00:44:56', '2018-04-07 23:24:50'),
(151, 'home', 44, '2018-04-08 00:22:28', '2018-04-08 19:58:09'),
(152, 'home', 269, '2018-04-09 00:39:47', '2018-04-09 23:36:28'),
(153, 'home', 202, '2018-04-10 00:45:59', '2018-04-10 23:12:40'),
(154, 'home', 242, '2018-04-11 00:31:37', '2018-04-11 23:10:40'),
(155, 'home', 221, '2018-04-12 00:14:37', '2018-04-12 21:18:21'),
(156, 'home', 284, '2018-04-13 00:29:25', '2018-04-13 22:37:35'),
(157, 'home', 45, '2018-04-14 02:20:22', '2018-04-14 23:58:10'),
(158, 'home', 109, '2018-04-15 03:53:38', '2018-04-15 23:55:51'),
(159, 'home', 522, '2018-04-16 00:28:21', '2018-04-16 23:59:55'),
(160, 'home', 365, '2018-04-17 01:27:16', '2018-04-17 23:56:26'),
(161, 'home', 185, '2018-04-18 00:00:19', '2018-04-18 23:20:19'),
(162, 'home', 206, '2018-04-19 01:39:00', '2018-04-19 23:52:50'),
(163, 'home', 159, '2018-04-20 00:18:11', '2018-04-20 22:37:44'),
(164, 'home', 128, '2018-04-21 00:30:07', '2018-04-21 22:38:57'),
(165, 'home', 174, '2018-04-22 00:15:02', '2018-04-22 23:43:00'),
(166, 'home', 257, '2018-04-23 01:10:50', '2018-04-23 23:54:07'),
(167, 'home', 276, '2018-04-24 00:29:02', '2018-04-24 23:59:51'),
(168, 'home', 524, '2018-04-25 00:00:24', '2018-04-25 23:50:59'),
(169, 'home', 207, '2018-04-26 00:12:09', '2018-04-26 22:13:46'),
(170, 'home', 328, '2018-04-27 01:00:13', '2018-04-27 23:58:53'),
(171, 'home', 128, '2018-04-28 00:00:14', '2018-04-28 23:59:36'),
(172, 'home', 110, '2018-04-29 00:00:14', '2018-04-29 23:54:57'),
(173, 'home', 142, '2018-04-30 00:09:37', '2018-04-30 23:23:44'),
(174, 'home', 57, '2018-05-01 00:31:02', '2018-05-01 23:43:51'),
(175, 'home', 179, '2018-05-02 00:19:05', '2018-05-02 22:41:04'),
(176, 'home', 161, '2018-05-03 00:37:55', '2018-05-03 23:20:58'),
(177, 'home', 137, '2018-05-04 00:02:09', '2018-05-04 23:01:44'),
(178, 'home', 102, '2018-05-05 00:46:56', '2018-05-05 23:02:33'),
(179, 'home', 81, '2018-05-06 01:39:57', '2018-05-06 23:20:46'),
(180, 'home', 220, '2018-05-07 00:29:40', '2018-05-07 22:46:00'),
(181, 'home', 135, '2018-05-08 00:32:26', '2018-05-08 23:46:35'),
(182, 'home', 152, '2018-05-09 01:49:17', '2018-05-09 23:45:53'),
(183, 'home', 103, '2018-05-10 00:01:27', '2018-05-10 23:19:57'),
(184, 'home', 113, '2018-05-11 00:45:17', '2018-05-11 23:25:18'),
(185, 'home', 106, '2018-05-12 00:08:56', '2018-05-12 23:29:32'),
(186, 'home', 87, '2018-05-13 00:11:03', '2018-05-13 23:23:10'),
(187, 'home', 121, '2018-05-14 00:26:37', '2018-05-14 21:15:47'),
(188, 'home', 114, '2018-05-15 01:11:07', '2018-05-15 23:27:44'),
(189, 'home', 85, '2018-05-16 00:09:43', '2018-05-16 23:56:48'),
(190, 'home', 189, '2018-05-17 00:19:05', '2018-05-17 23:15:00'),
(191, 'home', 201, '2018-05-18 02:37:12', '2018-05-18 23:09:41'),
(192, 'home', 231, '2018-05-19 00:09:07', '2018-05-19 19:40:53'),
(193, 'home', 84, '2018-05-20 00:04:34', '2018-05-20 23:57:56'),
(194, 'home', 288, '2018-05-21 00:15:45', '2018-05-21 23:56:31'),
(195, 'home', 109, '2018-05-22 00:52:07', '2018-05-22 21:38:37'),
(196, 'home', 132, '2018-05-23 01:06:02', '2018-05-23 23:59:34'),
(197, 'home', 99, '2018-05-24 00:04:14', '2018-05-24 23:54:48'),
(198, 'home', 84, '2018-05-25 00:39:16', '2018-05-25 22:38:46'),
(199, 'home', 41, '2018-05-26 02:54:14', '2018-05-26 23:01:03'),
(200, 'home', 72, '2018-05-27 03:11:50', '2018-05-27 23:58:45'),
(201, 'home', 104, '2018-05-28 01:07:30', '2018-05-28 23:46:53'),
(202, 'home', 202, '2018-05-29 00:21:48', '2018-05-29 22:55:23'),
(203, 'home', 162, '2018-05-30 00:08:47', '2018-05-30 20:43:02'),
(204, 'home', 183, '2018-05-31 00:35:00', '2018-05-31 23:58:52'),
(205, 'home', 107, '2018-06-01 00:02:30', '2018-06-01 23:41:18'),
(206, 'home', 55, '2018-06-02 00:04:17', '2018-06-02 21:16:05'),
(207, 'home', 34, '2018-06-03 00:09:30', '2018-06-03 19:16:31'),
(208, 'home', 117, '2018-06-04 00:28:20', '2018-06-04 23:38:12'),
(209, 'home', 134, '2018-06-05 00:15:12', '2018-06-05 22:53:39'),
(210, 'home', 95, '2018-06-06 01:34:58', '2018-06-06 23:14:58'),
(211, 'home', 36, '2018-06-07 03:54:53', '2018-06-07 23:08:44'),
(212, 'home', 55, '2018-06-08 00:29:56', '2018-06-08 17:25:20'),
(213, 'home', 131, '2018-06-09 00:57:54', '2018-06-09 23:55:40'),
(214, 'home', 60, '2018-06-10 00:27:27', '2018-06-10 23:41:43'),
(215, 'home', 177, '2018-06-11 02:09:52', '2018-06-11 21:16:12'),
(216, 'home', 115, '2018-06-12 00:48:20', '2018-06-12 23:38:41'),
(217, 'home', 88, '2018-06-13 01:01:54', '2018-06-13 22:58:39'),
(218, 'home', 129, '2018-06-14 02:54:38', '2018-06-14 23:20:58'),
(219, 'home', 112, '2018-06-15 00:05:46', '2018-06-15 23:51:27'),
(220, 'home', 40, '2018-06-16 01:55:06', '2018-06-16 23:57:21'),
(221, 'home', 51, '2018-06-17 03:10:43', '2018-06-17 23:24:47'),
(222, 'home', 101, '2018-06-18 00:01:50', '2018-06-18 22:58:06'),
(223, 'home', 265, '2018-06-19 00:02:47', '2018-06-19 23:54:58'),
(224, 'home', 189, '2018-06-20 00:00:48', '2018-06-20 23:32:48'),
(225, 'home', 171, '2018-06-21 01:47:38', '2018-06-21 22:29:56'),
(226, 'home', 96, '2018-06-22 00:24:29', '2018-06-22 23:03:42'),
(227, 'home', 167, '2018-06-23 00:06:51', '2018-06-23 22:11:18'),
(228, 'home', 50, '2018-06-24 00:12:04', '2018-06-24 23:43:56'),
(229, 'home', 77, '2018-06-25 00:41:22', '2018-06-25 23:52:41'),
(230, 'home', 129, '2018-06-26 00:21:48', '2018-06-26 23:53:58'),
(231, 'home', 99, '2018-06-27 00:15:35', '2018-06-27 23:32:41'),
(232, 'home', 90, '2018-06-28 00:20:26', '2018-06-28 23:34:31'),
(233, 'home', 81, '2018-06-29 00:40:01', '2018-06-29 22:15:50'),
(234, 'home', 49, '2018-06-30 00:01:06', '2018-06-30 23:05:09'),
(235, 'home', 67, '2018-07-01 00:17:33', '2018-07-01 21:23:23'),
(236, 'home', 103, '2018-07-02 01:27:44', '2018-07-02 23:34:50'),
(237, 'home', 112, '2018-07-03 00:24:03', '2018-07-03 23:40:43'),
(238, 'home', 96, '2018-07-04 01:10:39', '2018-07-04 23:54:06'),
(239, 'home', 165, '2018-07-05 00:50:48', '2018-07-05 23:34:53'),
(240, 'home', 148, '2018-07-06 02:12:38', '2018-07-06 22:53:59'),
(241, 'home', 83, '2018-07-07 00:28:41', '2018-07-07 23:17:24'),
(242, 'home', 79, '2018-07-08 00:01:15', '2018-07-08 21:11:52'),
(243, 'home', 243, '2018-07-09 00:36:15', '2018-07-09 23:58:37'),
(244, 'home', 130, '2018-07-10 01:33:52', '2018-07-10 23:59:26'),
(245, 'home', 198, '2018-07-11 00:00:18', '2018-07-11 19:38:24'),
(246, 'home', 136, '2018-07-12 00:59:00', '2018-07-12 23:12:01'),
(247, 'home', 90, '2018-07-13 02:30:09', '2018-07-13 23:33:24'),
(248, 'home', 108, '2018-07-14 01:09:46', '2018-07-14 23:47:14'),
(249, 'home', 58, '2018-07-15 04:33:06', '2018-07-15 22:47:11'),
(250, 'home', 76, '2018-07-16 02:19:33', '2018-07-16 23:05:46'),
(251, 'home', 140, '2018-07-17 00:12:35', '2018-07-17 23:44:19'),
(252, 'home', 133, '2018-07-18 00:06:50', '2018-07-18 23:37:13'),
(253, 'home', 61, '2018-07-19 00:41:25', '2018-07-19 23:31:20'),
(254, 'home', 91, '2018-07-20 00:07:10', '2018-07-20 23:35:52'),
(255, 'home', 104, '2018-07-21 00:57:20', '2018-07-21 23:54:58'),
(256, 'home', 29, '2018-07-22 00:13:02', '2018-07-22 23:46:37'),
(257, 'home', 85, '2018-07-23 00:07:01', '2018-07-23 22:43:32'),
(258, 'home', 160, '2018-07-24 05:03:59', '2018-07-24 23:33:59'),
(259, 'home', 112, '2018-07-25 00:07:43', '2018-07-25 22:59:45'),
(260, 'home', 83, '2018-07-26 00:08:25', '2018-07-26 22:45:16'),
(261, 'home', 96, '2018-07-27 00:22:33', '2018-07-27 23:42:16'),
(262, 'home', 63, '2018-07-28 04:32:32', '2018-07-28 23:19:31'),
(263, 'home', 62, '2018-07-29 00:21:50', '2018-07-29 20:37:00'),
(264, 'home', 85, '2018-07-30 00:57:04', '2018-07-30 23:57:12'),
(265, 'home', 65, '2018-07-31 01:40:23', '2018-07-31 22:04:20'),
(266, 'home', 159, '2018-08-01 00:09:16', '2018-08-01 23:56:10'),
(267, 'home', 133, '2018-08-02 00:03:26', '2018-08-02 23:57:34'),
(268, 'home', 142, '2018-08-03 00:07:26', '2018-08-03 23:34:50'),
(269, 'home', 138, '2018-08-04 00:23:32', '2018-08-04 23:38:53'),
(270, 'home', 65, '2018-08-05 00:21:40', '2018-08-05 19:22:49'),
(271, 'home', 104, '2018-08-06 00:39:31', '2018-08-06 23:07:32'),
(272, 'home', 86, '2018-08-07 00:00:34', '2018-08-07 22:21:19'),
(273, 'home', 108, '2018-08-08 02:28:20', '2018-08-08 22:54:33'),
(274, 'home', 273, '2018-08-09 01:36:14', '2018-08-09 23:24:46'),
(275, 'home', 132, '2018-08-10 00:03:13', '2018-08-10 17:16:36'),
(276, 'home', 126, '2018-08-11 05:05:27', '2018-08-11 22:01:30'),
(277, 'home', 52, '2018-08-12 00:14:20', '2018-08-12 20:16:43'),
(278, 'home', 150, '2018-08-13 00:36:17', '2018-08-13 23:36:36'),
(279, 'home', 102, '2018-08-14 01:06:52', '2018-08-14 23:17:48'),
(280, 'home', 57, '2018-08-15 00:16:40', '2018-08-15 23:06:48'),
(281, 'home', 118, '2018-08-16 01:11:54', '2018-08-16 22:34:56'),
(282, 'home', 139, '2018-08-17 00:13:41', '2018-08-17 23:35:56'),
(283, 'home', 51, '2018-08-18 00:05:49', '2018-08-18 23:16:50'),
(284, 'home', 76, '2018-08-19 00:24:10', '2018-08-19 23:36:09'),
(285, 'home', 159, '2018-08-20 02:21:05', '2018-08-20 22:54:42'),
(286, 'home', 202, '2018-08-21 00:53:14', '2018-08-21 22:01:24'),
(287, 'home', 105, '2018-08-22 02:12:07', '2018-08-22 23:46:23'),
(288, 'home', 328, '2018-08-23 00:01:59', '2018-08-23 23:55:15'),
(289, 'home', 146, '2018-08-24 01:31:15', '2018-08-24 19:47:42'),
(290, 'home', 67, '2018-08-25 02:05:26', '2018-08-25 23:01:57'),
(291, 'home', 81, '2018-08-26 00:31:39', '2018-08-26 22:25:35'),
(292, 'home', 99, '2018-08-27 02:38:02', '2018-08-27 22:52:08'),
(293, 'home', 99, '2018-08-28 00:27:20', '2018-08-28 23:12:30'),
(294, 'home', 96, '2018-08-29 00:21:21', '2018-08-29 22:59:30'),
(295, 'home', 99, '2018-08-30 00:13:41', '2018-08-30 23:34:59'),
(296, 'home', 93, '2018-08-31 00:01:51', '2018-08-31 23:52:26'),
(297, 'home', 51, '2018-09-01 01:20:52', '2018-09-01 22:37:22'),
(298, 'home', 68, '2018-09-02 01:34:01', '2018-09-02 22:28:09'),
(299, 'home', 167, '2018-09-03 02:31:53', '2018-09-03 22:38:10'),
(300, 'home', 266, '2018-09-04 00:30:58', '2018-09-04 23:07:18'),
(301, 'home', 171, '2018-09-05 00:03:47', '2018-09-05 23:28:39'),
(302, 'home', 138, '2018-09-06 02:15:28', '2018-09-06 23:49:26'),
(303, 'home', 105, '2018-09-07 03:01:33', '2018-09-07 23:43:01'),
(304, 'home', 104, '2018-09-08 04:59:55', '2018-09-08 23:06:47'),
(305, 'home', 89, '2018-09-09 01:07:38', '2018-09-09 22:25:42'),
(306, 'home', 99, '2018-09-10 00:07:17', '2018-09-10 22:20:53'),
(307, 'home', 157, '2018-09-11 00:00:00', '2018-09-11 21:43:33'),
(308, 'home', 186, '2018-09-12 01:07:52', '2018-09-12 22:45:21'),
(309, 'home', 76, '2018-09-13 01:32:50', '2018-09-13 22:17:59'),
(310, 'home', 94, '2018-09-14 00:09:24', '2018-09-14 22:32:52'),
(311, 'home', 67, '2018-09-15 01:43:04', '2018-09-15 22:54:54'),
(312, 'home', 66, '2018-09-16 00:12:33', '2018-09-16 22:09:13'),
(313, 'home', 124, '2018-09-17 01:50:02', '2018-09-17 21:17:50'),
(314, 'home', 124, '2018-09-18 00:41:48', '2018-09-18 23:44:51'),
(315, 'home', 79, '2018-09-19 00:36:40', '2018-09-19 21:38:30'),
(316, 'home', 94, '2018-09-20 00:25:43', '2018-09-20 23:40:30'),
(317, 'home', 90, '2018-09-21 00:08:25', '2018-09-21 23:31:04'),
(318, 'home', 105, '2018-09-22 01:09:41', '2018-09-22 21:28:35'),
(319, 'home', 44, '2018-09-23 01:17:07', '2018-09-23 22:07:02'),
(320, 'home', 100, '2018-09-24 01:14:47', '2018-09-24 23:16:42'),
(321, 'home', 119, '2018-09-25 00:34:45', '2018-09-25 22:50:41'),
(322, 'home', 190, '2018-09-26 00:33:53', '2018-09-26 23:30:30'),
(323, 'home', 139, '2018-09-27 00:21:33', '2018-09-27 23:39:37'),
(324, 'home', 118, '2018-09-28 02:09:39', '2018-09-28 23:18:15'),
(325, 'home', 73, '2018-09-29 02:41:17', '2018-09-29 21:13:55'),
(326, 'home', 78, '2018-09-30 01:36:27', '2018-09-30 23:28:26'),
(327, 'home', 89, '2018-10-01 00:41:36', '2018-10-01 23:24:42'),
(328, 'home', 115, '2018-10-02 00:21:38', '2018-10-02 22:17:15'),
(329, 'home', 92, '2018-10-03 00:01:07', '2018-10-03 23:39:36'),
(330, 'home', 73, '2018-10-04 02:46:49', '2018-10-04 21:55:50'),
(331, 'home', 257, '2018-10-05 01:58:37', '2018-10-05 23:39:28'),
(332, 'home', 48, '2018-10-06 00:39:08', '2018-10-06 22:17:52'),
(333, 'home', 102, '2018-10-07 01:30:34', '2018-10-07 22:23:34'),
(334, 'home', 200, '2018-10-08 00:22:25', '2018-10-08 23:17:18'),
(335, 'home', 60, '2018-10-09 00:08:41', '2018-10-09 23:54:40'),
(336, 'home', 166, '2018-10-10 00:08:25', '2018-10-10 23:19:04'),
(337, 'home', 392, '2018-10-11 00:18:45', '2018-10-11 23:59:54'),
(338, 'home', 332, '2018-10-12 00:00:09', '2018-10-12 23:50:34'),
(339, 'home', 308, '2018-10-13 00:01:22', '2018-10-13 21:40:22'),
(340, 'home', 85, '2018-10-14 00:39:07', '2018-10-14 23:32:54'),
(341, 'home', 371, '2018-10-15 00:52:03', '2018-10-15 18:34:17'),
(342, 'home', 192, '2018-10-16 01:57:39', '2018-10-16 23:00:54'),
(343, 'home', 134, '2018-10-17 00:50:25', '2018-10-17 23:37:52'),
(344, 'home', 178, '2018-10-18 00:01:20', '2018-10-18 23:39:43'),
(345, 'home', 64, '2018-10-19 01:04:16', '2018-10-19 23:59:47'),
(346, 'home', 75, '2018-10-20 00:00:23', '2018-10-20 22:14:53'),
(347, 'home', 50, '2018-10-21 00:23:59', '2018-10-21 22:09:26'),
(348, 'home', 90, '2018-10-22 00:57:56', '2018-10-22 23:26:39'),
(349, 'home', 157, '2018-10-23 00:14:33', '2018-10-23 23:08:08'),
(350, 'home', 140, '2018-10-24 01:14:52', '2018-10-24 22:44:27'),
(351, 'home', 176, '2018-10-25 00:35:40', '2018-10-25 23:23:54'),
(352, 'home', 60, '2018-10-26 00:32:24', '2018-10-26 21:27:12'),
(353, 'home', 79, '2018-10-27 03:51:41', '2018-10-27 22:56:38'),
(354, 'home', 40, '2018-10-28 05:08:00', '2018-10-28 22:59:01'),
(355, 'home', 96, '2018-10-29 00:04:55', '2018-10-29 23:57:05'),
(356, 'home', 144, '2018-10-30 00:12:11', '2018-10-30 23:16:03'),
(357, 'home', 245, '2018-10-31 02:15:07', '2018-10-31 22:26:08'),
(358, 'home', 130, '2018-11-01 00:28:28', '2018-11-01 23:37:22'),
(359, 'home', 108, '2018-11-02 00:17:12', '2018-11-02 23:58:19'),
(360, 'home', 98, '2018-11-03 00:33:30', '2018-11-03 23:58:30'),
(361, 'home', 66, '2018-11-04 00:00:49', '2018-11-04 23:36:00'),
(362, 'home', 50, '2018-11-05 01:18:11', '2018-11-05 23:59:41'),
(363, 'home', 154, '2018-11-06 00:01:33', '2018-11-06 22:59:14'),
(364, 'home', 59, '2018-11-07 00:10:35', '2018-11-07 21:13:48'),
(365, 'home', 106, '2018-11-08 02:05:10', '2018-11-08 23:29:03'),
(366, 'home', 225, '2018-11-09 00:31:43', '2018-11-09 23:59:33'),
(367, 'home', 64, '2018-11-10 00:05:14', '2018-11-10 23:48:32'),
(368, 'home', 40, '2018-11-11 00:11:23', '2018-11-11 22:14:01'),
(369, 'home', 108, '2018-11-12 00:46:24', '2018-11-12 23:16:12'),
(370, 'home', 127, '2018-11-13 02:11:17', '2018-11-13 23:12:08'),
(371, 'home', 108, '2018-11-14 02:03:52', '2018-11-14 23:32:05'),
(372, 'home', 202, '2018-11-15 00:32:18', '2018-11-15 23:12:40'),
(373, 'home', 129, '2018-11-16 01:19:35', '2018-11-16 22:55:56'),
(374, 'home', 48, '2018-11-17 00:15:39', '2018-11-17 23:50:37'),
(375, 'home', 78, '2018-11-18 00:44:15', '2018-11-18 21:31:04'),
(376, 'home', 148, '2018-11-19 01:55:03', '2018-11-19 23:33:44'),
(377, 'home', 69, '2018-11-20 00:32:26', '2018-11-20 22:29:04'),
(378, 'home', 140, '2018-11-21 00:16:48', '2018-11-21 23:31:35'),
(379, 'home', 120, '2018-11-22 00:06:40', '2018-11-22 23:49:21'),
(380, 'home', 111, '2018-11-23 00:03:01', '2018-11-23 23:50:43'),
(381, 'home', 78, '2018-11-24 00:38:32', '2018-11-24 23:45:06'),
(382, 'home', 83, '2018-11-25 00:35:35', '2018-11-25 22:53:20'),
(383, 'home', 109, '2018-11-26 00:02:23', '2018-11-26 23:59:51'),
(384, 'home', 129, '2018-11-27 00:00:43', '2018-11-27 23:58:07'),
(385, 'home', 126, '2018-11-28 00:01:58', '2018-11-28 23:43:32'),
(386, 'home', 82, '2018-11-29 00:00:22', '2018-11-29 22:08:26'),
(387, 'home', 130, '2018-11-30 00:10:23', '2018-11-30 22:46:10'),
(388, 'home', 69, '2018-12-01 00:19:03', '2018-12-01 22:25:48'),
(389, 'home', 56, '2018-12-02 00:34:14', '2018-12-02 23:35:00'),
(390, 'home', 108, '2018-12-03 02:04:58', '2018-12-03 23:05:59'),
(391, 'home', 53, '2018-12-04 01:03:24', '2018-12-04 23:31:20'),
(392, 'home', 63, '2018-12-05 00:05:07', '2018-12-05 23:17:37'),
(393, 'home', 65, '2018-12-06 00:10:48', '2018-12-06 21:03:32'),
(394, 'home', 173, '2018-12-07 01:44:44', '2018-12-07 23:28:46'),
(395, 'home', 77, '2018-12-08 00:12:33', '2018-12-08 22:08:50'),
(396, 'home', 95, '2018-12-09 00:57:48', '2018-12-09 23:40:55'),
(397, 'home', 80, '2018-12-10 01:12:56', '2018-12-10 23:47:59'),
(398, 'home', 199, '2018-12-11 00:13:47', '2018-12-11 23:14:27'),
(399, 'home', 306, '2018-12-12 00:21:50', '2018-12-12 23:23:31'),
(400, 'home', 454, '2018-12-13 00:01:09', '2018-12-13 23:01:22'),
(401, 'home', 145, '2018-12-14 04:01:24', '2018-12-14 23:32:06'),
(402, 'home', 98, '2018-12-15 00:31:13', '2018-12-15 20:31:07'),
(403, 'home', 101, '2018-12-16 00:24:05', '2018-12-16 23:55:30'),
(404, 'home', 176, '2018-12-17 00:48:18', '2018-12-17 23:18:55'),
(405, 'home', 107, '2018-12-18 01:04:32', '2018-12-18 23:17:54'),
(406, 'home', 198, '2018-12-19 00:19:07', '2018-12-19 23:29:20'),
(407, 'home', 65, '2018-12-20 00:22:22', '2018-12-20 23:44:21'),
(408, 'home', 75, '2018-12-21 00:10:16', '2018-12-21 22:49:28'),
(409, 'home', 54, '2018-12-22 00:02:38', '2018-12-22 22:36:21'),
(410, 'home', 44, '2018-12-23 03:38:00', '2018-12-23 23:11:28'),
(411, 'home', 87, '2018-12-24 01:09:23', '2018-12-24 22:37:29'),
(412, 'home', 54, '2018-12-25 05:17:02', '2018-12-25 20:47:34'),
(413, 'home', 86, '2018-12-26 00:19:36', '2018-12-26 22:19:11'),
(414, 'home', 81, '2018-12-27 02:04:39', '2018-12-27 23:18:20'),
(415, 'home', 82, '2018-12-28 04:47:51', '2018-12-28 22:56:34'),
(416, 'home', 39, '2018-12-29 00:05:43', '2018-12-29 22:10:01'),
(417, 'home', 51, '2018-12-30 01:36:54', '2018-12-30 23:43:58'),
(418, 'home', 96, '2018-12-31 02:00:34', '2018-12-31 23:11:30'),
(419, 'home', 51, '2019-01-01 00:46:28', '2019-01-01 23:59:08'),
(420, 'home', 162, '2019-01-02 00:16:04', '2019-01-02 23:16:14'),
(421, 'home', 129, '2019-01-03 00:49:24', '2019-01-03 23:00:03'),
(422, 'home', 105, '2019-01-04 00:57:49', '2019-01-04 23:22:10'),
(423, 'home', 116, '2019-01-05 04:51:56', '2019-01-05 23:41:08'),
(424, 'home', 82, '2019-01-06 00:22:17', '2019-01-06 22:25:25'),
(425, 'home', 171, '2019-01-07 00:17:01', '2019-01-07 23:37:49'),
(426, 'home', 128, '2019-01-08 00:50:43', '2019-01-08 23:18:31'),
(427, 'home', 73, '2019-01-09 00:04:25', '2019-01-09 23:41:23'),
(428, 'home', 86, '2019-01-10 00:02:09', '2019-01-10 23:53:07'),
(429, 'home', 54, '2019-01-11 00:15:33', '2019-01-11 22:40:42'),
(430, 'home', 44, '2019-01-12 00:57:15', '2019-01-12 23:54:17'),
(431, 'home', 31, '2019-01-13 07:53:15', '2019-01-13 22:21:57'),
(432, 'home', 57, '2019-01-14 01:39:40', '2019-01-14 23:45:19'),
(433, 'home', 107, '2019-01-15 00:23:06', '2019-01-15 22:10:58'),
(434, 'home', 82, '2019-01-16 01:57:37', '2019-01-16 23:13:57'),
(435, 'home', 184, '2019-01-17 00:29:36', '2019-01-17 23:20:19'),
(436, 'home', 151, '2019-01-18 00:02:43', '2019-01-18 23:45:23'),
(437, 'home', 76, '2019-01-19 04:17:09', '2019-01-19 23:01:04'),
(438, 'home', 95, '2019-01-20 00:31:23', '2019-01-20 22:46:50'),
(439, 'home', 138, '2019-01-21 01:34:08', '2019-01-21 23:44:06'),
(440, 'home', 105, '2019-01-22 01:55:49', '2019-01-22 23:29:05'),
(441, 'home', 79, '2019-01-23 00:00:11', '2019-01-23 22:53:24'),
(442, 'home', 83, '2019-01-24 01:01:40', '2019-01-24 23:44:15'),
(443, 'home', 180, '2019-01-25 00:39:59', '2019-01-25 23:14:46'),
(444, 'home', 100, '2019-01-26 00:08:56', '2019-01-26 23:58:36'),
(445, 'home', 65, '2019-01-27 00:00:27', '2019-01-27 22:50:27'),
(446, 'home', 282, '2019-01-28 00:19:55', '2019-01-28 23:50:23'),
(447, 'home', 103, '2019-01-29 00:37:01', '2019-01-29 23:09:31'),
(448, 'home', 157, '2019-01-30 00:09:11', '2019-01-30 23:30:23'),
(449, 'home', 115, '2019-01-31 00:27:34', '2019-01-31 22:44:27'),
(450, 'home', 155, '2019-02-01 00:03:41', '2019-02-01 23:47:04'),
(451, 'home', 164, '2019-02-02 00:02:53', '2019-02-02 23:31:08'),
(452, 'home', 101, '2019-02-03 00:45:02', '2019-02-03 23:29:56'),
(453, 'home', 338, '2019-02-04 00:08:50', '2019-02-04 23:14:56'),
(454, 'home', 139, '2019-02-05 01:00:05', '2019-02-05 23:36:34'),
(455, 'home', 68, '2019-02-06 00:57:38', '2019-02-06 23:52:52'),
(456, 'home', 130, '2019-02-07 00:49:58', '2019-02-07 22:41:02'),
(457, 'home', 125, '2019-02-08 00:14:21', '2019-02-08 23:35:37'),
(458, 'home', 79, '2019-02-09 00:44:40', '2019-02-09 23:47:45'),
(459, 'home', 44, '2019-02-10 00:02:19', '2019-02-10 23:58:20'),
(460, 'home', 75, '2019-02-11 00:05:00', '2019-02-11 23:34:19'),
(461, 'home', 125, '2019-02-12 01:58:03', '2019-02-12 21:11:55'),
(462, 'home', 145, '2019-02-13 00:19:34', '2019-02-13 23:38:24'),
(463, 'home', 164, '2019-02-14 00:56:07', '2019-02-14 23:46:38'),
(464, 'home', 98, '2019-02-15 04:41:56', '2019-02-15 23:54:04'),
(465, 'home', 139, '2019-02-16 00:22:26', '2019-02-16 20:39:50'),
(466, 'home', 175, '2019-02-17 00:18:08', '2019-02-17 23:54:19'),
(467, 'home', 146, '2019-02-18 00:07:32', '2019-02-18 23:14:34'),
(468, 'home', 76, '2019-02-19 01:21:16', '2019-02-19 21:40:49'),
(469, 'home', 83, '2019-02-20 00:18:23', '2019-02-20 23:57:40'),
(470, 'home', 79, '2019-02-21 00:30:53', '2019-02-21 22:28:20'),
(471, 'home', 78, '2019-02-22 00:07:02', '2019-02-22 21:59:19'),
(472, 'home', 67, '2019-02-23 00:08:14', '2019-02-23 22:48:47'),
(473, 'home', 49, '2019-02-24 00:04:04', '2019-02-24 22:32:29'),
(474, 'home', 69, '2019-02-25 00:40:01', '2019-02-25 21:34:25'),
(475, 'home', 67, '2019-02-26 00:09:42', '2019-02-26 22:34:00'),
(476, 'home', 94, '2019-02-27 00:43:47', '2019-02-27 21:34:24'),
(477, 'home', 92, '2019-02-28 00:23:17', '2019-02-28 23:38:36'),
(478, 'home', 91, '2019-03-01 01:09:58', '2019-03-01 21:51:42'),
(479, 'home', 89, '2019-03-02 02:02:11', '2019-03-02 21:26:10'),
(480, 'home', 45, '2019-03-03 00:04:06', '2019-03-03 21:56:05'),
(481, 'home', 152, '2019-03-04 01:06:46', '2019-03-04 23:57:42'),
(482, 'home', 193, '2019-03-05 02:33:51', '2019-03-05 23:57:37'),
(483, 'home', 288, '2019-03-06 00:01:10', '2019-03-06 23:59:21'),
(484, 'home', 252, '2019-03-07 02:45:43', '2019-03-07 23:47:55'),
(485, 'home', 200, '2019-03-08 00:00:20', '2019-03-08 23:30:32'),
(486, 'home', 91, '2019-03-09 02:43:43', '2019-03-09 23:19:32'),
(487, 'home', 87, '2019-03-10 01:00:52', '2019-03-10 21:34:26'),
(488, 'home', 234, '2019-03-11 00:20:50', '2019-03-11 23:54:43'),
(489, 'home', 308, '2019-03-12 00:06:52', '2019-03-12 23:48:22'),
(490, 'home', 106, '2019-03-13 00:42:21', '2019-03-13 23:58:42'),
(491, 'home', 116, '2019-03-14 00:00:09', '2019-03-14 23:45:01'),
(492, 'home', 184, '2019-03-15 00:00:03', '2019-03-15 23:55:28'),
(493, 'home', 73, '2019-03-16 00:35:41', '2019-03-16 23:36:53'),
(494, 'home', 52, '2019-03-17 00:02:34', '2019-03-17 18:36:29'),
(495, 'home', 88, '2019-03-18 02:30:31', '2019-03-18 22:59:09'),
(496, 'home', 181, '2019-03-19 05:28:49', '2019-03-19 23:54:57'),
(497, 'home', 154, '2019-03-20 00:34:38', '2019-03-20 23:43:08'),
(498, 'home', 169, '2019-03-21 00:01:59', '2019-03-21 23:50:30'),
(499, 'home', 61, '2019-03-22 00:56:37', '2019-03-22 23:38:32'),
(500, 'home', 107, '2019-03-23 00:14:20', '2019-03-23 23:07:45'),
(501, 'home', 97, '2019-03-24 00:13:18', '2019-03-24 23:35:21'),
(502, 'home', 134, '2019-03-25 00:56:57', '2019-03-25 22:32:37'),
(503, 'home', 163, '2019-03-26 00:36:40', '2019-03-26 23:43:04'),
(504, 'home', 83, '2019-03-27 00:57:50', '2019-03-27 22:54:08'),
(505, 'home', 49, '2019-03-28 00:07:40', '2019-03-28 23:22:26'),
(506, 'home', 50, '2019-03-29 00:03:27', '2019-03-29 23:13:19'),
(507, 'home', 39, '2019-03-30 01:06:09', '2019-03-30 22:05:00'),
(508, 'home', 31, '2019-03-31 00:30:40', '2019-03-31 23:34:46'),
(509, 'home', 69, '2019-04-01 00:20:24', '2019-04-01 23:38:25'),
(510, 'home', 69, '2019-04-02 00:36:22', '2019-04-02 23:00:34'),
(511, 'home', 97, '2019-04-03 01:01:47', '2019-04-03 23:27:13'),
(512, 'home', 84, '2019-04-04 00:10:04', '2019-04-04 19:44:45'),
(513, 'home', 52, '2019-04-05 00:03:58', '2019-04-05 22:45:42'),
(514, 'home', 29, '2019-04-06 00:05:32', '2019-04-06 20:21:19'),
(515, 'home', 34, '2019-04-07 00:44:32', '2019-04-07 23:30:47'),
(516, 'home', 157, '2019-04-08 03:31:05', '2019-04-08 23:59:43'),
(517, 'home', 69, '2019-04-09 00:00:43', '2019-04-09 23:29:52'),
(518, 'home', 62, '2019-04-10 01:50:54', '2019-04-10 23:49:58'),
(519, 'home', 62, '2019-04-11 00:22:52', '2019-04-11 23:11:41'),
(520, 'home', 68, '2019-04-12 01:47:05', '2019-04-12 22:32:26'),
(521, 'home', 48, '2019-04-13 00:43:16', '2019-04-13 22:24:56'),
(522, 'home', 76, '2019-04-14 00:03:29', '2019-04-14 23:59:08'),
(523, 'home', 85, '2019-04-15 02:08:15', '2019-04-15 23:46:25'),
(524, 'home', 110, '2019-04-16 00:39:49', '2019-04-16 23:47:13'),
(525, 'home', 81, '2019-04-17 00:39:58', '2019-04-17 22:56:08'),
(526, 'home', 103, '2019-04-18 00:25:32', '2019-04-18 22:40:17'),
(527, 'home', 30, '2019-04-19 03:10:22', '2019-04-19 23:56:49'),
(528, 'home', 60, '2019-04-20 00:02:21', '2019-04-20 23:02:54'),
(529, 'home', 41, '2019-04-21 02:42:39', '2019-04-21 23:08:25'),
(530, 'home', 62, '2019-04-22 01:48:36', '2019-04-22 23:53:27'),
(531, 'home', 67, '2019-04-23 02:36:51', '2019-04-23 23:41:36'),
(532, 'home', 54, '2019-04-24 00:04:26', '2019-04-24 23:59:50'),
(533, 'home', 70, '2019-04-25 00:02:54', '2019-04-25 23:44:14'),
(534, 'home', 51, '2019-04-26 00:22:13', '2019-04-26 23:43:10'),
(535, 'home', 37, '2019-04-27 00:42:45', '2019-04-27 21:18:49'),
(536, 'home', 17, '2019-04-28 09:05:57', '2019-04-28 21:12:50'),
(537, 'home', 74, '2019-04-29 00:23:51', '2019-04-29 23:33:16'),
(538, 'home', 60, '2019-04-30 00:42:38', '2019-04-30 22:19:19'),
(539, 'home', 34, '2019-05-01 01:11:11', '2019-05-01 22:16:42'),
(540, 'home', 33, '2019-05-02 02:04:39', '2019-05-02 21:41:09'),
(541, 'home', 39, '2019-05-03 00:39:01', '2019-05-03 23:05:22'),
(542, 'home', 61, '2019-05-04 03:08:35', '2019-05-04 23:33:06'),
(543, 'home', 25, '2019-05-05 00:11:19', '2019-05-05 22:53:55'),
(544, 'home', 59, '2019-05-06 01:51:23', '2019-05-06 23:44:42'),
(545, 'home', 71, '2019-05-07 00:41:15', '2019-05-07 23:48:42'),
(546, 'home', 61, '2019-05-08 00:17:18', '2019-05-08 23:15:16'),
(547, 'home', 68, '2019-05-09 00:15:45', '2019-05-09 23:58:02'),
(548, 'home', 91, '2019-05-10 00:41:00', '2019-05-10 23:25:27'),
(549, 'home', 27, '2019-05-11 01:44:07', '2019-05-11 21:17:49'),
(550, 'home', 24, '2019-05-12 03:02:38', '2019-05-12 21:51:30'),
(551, 'home', 62, '2019-05-13 01:37:13', '2019-05-13 23:58:43'),
(552, 'home', 65, '2019-05-14 01:35:28', '2019-05-14 23:36:10'),
(553, 'home', 64, '2019-05-15 00:16:53', '2019-05-15 23:52:24'),
(554, 'home', 44, '2019-05-16 00:12:16', '2019-05-16 22:31:06'),
(555, 'home', 40, '2019-05-17 01:10:28', '2019-05-17 23:16:32'),
(556, 'home', 42, '2019-05-18 00:10:59', '2019-05-18 23:27:49'),
(557, 'home', 12, '2019-05-19 00:56:23', '2019-05-19 11:14:16'),
(558, 'home', 38, '2019-05-20 04:46:40', '2019-05-20 21:54:43'),
(559, 'home', 37, '2019-05-21 00:44:42', '2019-05-21 23:56:57'),
(560, 'home', 42, '2019-05-22 00:57:50', '2019-05-22 23:42:15'),
(561, 'home', 61, '2019-05-23 00:18:11', '2019-05-23 23:50:32'),
(562, 'home', 74, '2019-05-24 00:39:14', '2019-05-24 23:40:20'),
(563, 'home', 57, '2019-05-25 00:05:37', '2019-05-25 23:49:32'),
(564, 'home', 23, '2019-05-26 00:00:05', '2019-05-26 22:21:54'),
(565, 'home', 47, '2019-05-27 04:32:26', '2019-05-27 23:51:49'),
(566, 'home', 54, '2019-05-28 01:30:38', '2019-05-28 23:43:36'),
(567, 'home', 49, '2019-05-29 01:06:30', '2019-05-29 22:03:48'),
(568, 'home', 52, '2019-05-30 04:06:35', '2019-05-30 23:52:28'),
(569, 'home', 31, '2019-05-31 02:36:52', '2019-05-31 23:29:13'),
(570, 'home', 28, '2019-06-01 06:16:45', '2019-06-01 16:51:35'),
(571, 'home', 43, '2019-06-02 05:57:08', '2019-06-02 23:59:56'),
(572, 'home', 37, '2019-06-03 00:00:17', '2019-06-03 22:40:52'),
(573, 'home', 50, '2019-06-04 00:54:11', '2019-06-04 23:59:00'),
(574, 'home', 86, '2019-06-05 00:44:00', '2019-06-05 21:38:17'),
(575, 'home', 51, '2019-06-06 00:11:59', '2019-06-06 23:56:56'),
(576, 'home', 49, '2019-06-07 00:03:35', '2019-06-07 21:33:42'),
(577, 'home', 29, '2019-06-08 00:01:38', '2019-06-08 21:10:50'),
(578, 'home', 25, '2019-06-09 09:33:38', '2019-06-09 23:54:30'),
(579, 'home', 97, '2019-06-10 01:42:33', '2019-06-10 22:27:33'),
(580, 'home', 52, '2019-06-11 02:21:42', '2019-06-11 20:50:53'),
(581, 'home', 43, '2019-06-12 01:48:10', '2019-06-12 23:26:40'),
(582, 'home', 60, '2019-06-13 00:15:51', '2019-06-13 21:36:24'),
(583, 'home', 79, '2019-06-14 00:55:24', '2019-06-14 23:16:03'),
(584, 'home', 21, '2019-06-15 00:06:42', '2019-06-15 21:21:16'),
(585, 'home', 20, '2019-06-16 00:20:43', '2019-06-16 23:55:57'),
(586, 'home', 32, '2019-06-17 04:19:19', '2019-06-17 19:08:39'),
(587, 'home', 64, '2019-06-18 00:40:20', '2019-06-18 23:33:55'),
(588, 'home', 31, '2019-06-19 00:23:47', '2019-06-19 23:39:33'),
(589, 'home', 53, '2019-06-20 00:23:37', '2019-06-20 23:58:32'),
(590, 'home', 32, '2019-06-21 04:47:33', '2019-06-21 20:03:46'),
(591, 'home', 27, '2019-06-22 04:58:38', '2019-06-22 23:49:03'),
(592, 'home', 26, '2019-06-23 00:47:23', '2019-06-23 23:50:25'),
(593, 'home', 29, '2019-06-24 02:21:43', '2019-06-24 22:33:22'),
(594, 'home', 62, '2019-06-25 03:06:57', '2019-06-25 23:56:47'),
(595, 'home', 16, '2019-06-26 04:10:16', '2019-06-26 23:16:42'),
(596, 'home', 61, '2019-06-27 00:18:56', '2019-06-27 23:33:48'),
(597, 'home', 46, '2019-06-28 00:30:26', '2019-06-28 20:17:58'),
(598, 'home', 13, '2019-06-29 03:47:25', '2019-06-29 15:33:49'),
(599, 'home', 24, '2019-06-30 00:12:07', '2019-06-30 21:46:19'),
(600, 'home', 50, '2019-07-01 00:11:27', '2019-07-01 23:55:07'),
(601, 'home', 36, '2019-07-02 00:00:52', '2019-07-02 22:04:56'),
(602, 'home', 87, '2019-07-03 04:36:17', '2019-07-03 22:45:32'),
(603, 'home', 68, '2019-07-04 03:51:28', '2019-07-04 23:40:34'),
(604, 'home', 64, '2019-07-05 00:28:55', '2019-07-05 23:53:09'),
(605, 'home', 19, '2019-07-06 06:23:12', '2019-07-06 21:18:31'),
(606, 'home', 35, '2019-07-07 00:20:50', '2019-07-07 22:46:54'),
(607, 'home', 69, '2019-07-08 04:23:33', '2019-07-08 23:15:37'),
(608, 'home', 90, '2019-07-09 00:01:35', '2019-07-09 20:51:16'),
(609, 'home', 31, '2019-07-10 02:36:28', '2019-07-10 23:02:23'),
(610, 'home', 42, '2019-07-11 01:25:07', '2019-07-11 20:24:13'),
(611, 'home', 60, '2019-07-12 01:38:54', '2019-07-12 20:03:46'),
(612, 'home', 31, '2019-07-13 00:15:17', '2019-07-13 23:12:40'),
(613, 'home', 27, '2019-07-14 01:58:37', '2019-07-14 22:43:56'),
(614, 'home', 59, '2019-07-15 00:20:57', '2019-07-15 20:59:34'),
(615, 'home', 34, '2019-07-16 03:53:13', '2019-07-16 20:48:54'),
(616, 'home', 37, '2019-07-17 02:10:02', '2019-07-17 22:21:01'),
(617, 'home', 40, '2019-07-18 01:47:38', '2019-07-18 22:18:55'),
(618, 'home', 33, '2019-07-19 00:32:45', '2019-07-19 22:06:58'),
(619, 'home', 40, '2019-07-20 00:57:57', '2019-07-20 22:11:26'),
(620, 'home', 31, '2019-07-21 00:04:33', '2019-07-21 21:50:08'),
(621, 'home', 112, '2019-07-22 00:53:09', '2019-07-22 23:08:59'),
(622, 'home', 52, '2019-07-23 03:05:30', '2019-07-23 22:44:22'),
(623, 'home', 46, '2019-07-24 01:06:04', '2019-07-24 22:36:12'),
(624, 'home', 55, '2019-07-25 00:47:13', '2019-07-25 23:47:56'),
(625, 'home', 53, '2019-07-26 04:44:04', '2019-07-26 23:57:43'),
(626, 'home', 48, '2019-07-27 00:16:33', '2019-07-27 22:06:38'),
(627, 'home', 32, '2019-07-28 02:10:17', '2019-07-28 22:42:00'),
(628, 'home', 67, '2019-07-29 01:00:15', '2019-07-29 21:36:50'),
(629, 'home', 56, '2019-07-30 02:09:49', '2019-07-30 22:29:51'),
(630, 'home', 70, '2019-07-31 00:23:32', '2019-07-31 23:30:48'),
(631, 'home', 77, '2019-08-01 01:10:35', '2019-08-01 23:09:19'),
(632, 'home', 25, '2019-08-02 00:48:54', '2019-08-02 20:40:54'),
(633, 'home', 8, '2019-08-03 00:10:23', '2019-08-03 22:15:39'),
(634, 'home', 19, '2019-08-04 06:29:05', '2019-08-04 22:21:27'),
(635, 'home', 47, '2019-08-05 05:00:39', '2019-08-05 23:22:40'),
(636, 'home', 28, '2019-08-06 01:30:20', '2019-08-06 18:49:44'),
(637, 'home', 46, '2019-08-07 02:20:53', '2019-08-07 23:44:16'),
(638, 'home', 46, '2019-08-08 04:48:02', '2019-08-08 22:49:26'),
(639, 'home', 49, '2019-08-09 02:28:29', '2019-08-09 19:29:55'),
(640, 'home', 41, '2019-08-10 02:11:56', '2019-08-10 20:47:55'),
(641, 'home', 24, '2019-08-11 08:54:17', '2019-08-11 23:51:39'),
(642, 'home', 67, '2019-08-12 01:55:53', '2019-08-12 22:12:20'),
(643, 'home', 90, '2019-08-13 03:00:32', '2019-08-13 22:15:09'),
(644, 'home', 69, '2019-08-14 00:11:21', '2019-08-14 23:41:32'),
(645, 'home', 58, '2019-08-15 00:06:30', '2019-08-15 22:36:30'),
(646, 'home', 54, '2019-08-16 00:30:23', '2019-08-16 23:14:20'),
(647, 'home', 43, '2019-08-17 01:12:53', '2019-08-17 22:37:51'),
(648, 'home', 30, '2019-08-18 01:16:55', '2019-08-18 20:05:53'),
(649, 'home', 65, '2019-08-19 00:21:20', '2019-08-19 21:04:57'),
(650, 'home', 47, '2019-08-20 00:16:23', '2019-08-20 21:45:55'),
(651, 'home', 31, '2019-08-21 00:53:12', '2019-08-21 22:53:13'),
(652, 'home', 49, '2019-08-22 02:21:07', '2019-08-22 22:11:03'),
(653, 'home', 44, '2019-08-23 01:20:50', '2019-08-23 23:39:12'),
(654, 'home', 12, '2019-08-24 00:04:57', '2019-08-24 22:36:59'),
(655, 'home', 33, '2019-08-25 02:54:00', '2019-08-25 23:59:00'),
(656, 'home', 72, '2019-08-26 00:05:18', '2019-08-26 21:11:12'),
(657, 'home', 88, '2019-08-27 01:34:22', '2019-08-27 23:04:41'),
(658, 'home', 60, '2019-08-28 01:06:23', '2019-08-28 23:17:11'),
(659, 'home', 48, '2019-08-29 03:15:12', '2019-08-29 22:39:34'),
(660, 'home', 39, '2019-08-30 02:04:10', '2019-08-30 21:08:43'),
(661, 'home', 22, '2019-08-31 04:29:57', '2019-08-31 22:42:32'),
(662, 'home', 17, '2019-09-01 01:19:25', '2019-09-01 22:19:22'),
(663, 'home', 40, '2019-09-02 00:14:20', '2019-09-02 23:48:00'),
(664, 'home', 34, '2019-09-03 00:40:49', '2019-09-03 23:51:36'),
(665, 'home', 40, '2019-09-04 01:58:47', '2019-09-04 22:46:22'),
(666, 'home', 34, '2019-09-05 00:08:07', '2019-09-05 20:18:05'),
(667, 'home', 46, '2019-09-06 01:25:12', '2019-09-06 20:06:34'),
(668, 'home', 44, '2019-09-07 00:05:50', '2019-09-07 21:50:43'),
(669, 'home', 45, '2019-09-08 01:17:33', '2019-09-08 23:10:30'),
(670, 'home', 33, '2019-09-09 00:54:37', '2019-09-09 23:35:45'),
(671, 'home', 40, '2019-09-10 04:26:45', '2019-09-10 23:54:52'),
(672, 'home', 61, '2019-09-11 00:45:57', '2019-09-11 21:42:47'),
(673, 'home', 42, '2019-09-12 03:27:49', '2019-09-12 21:15:46'),
(674, 'home', 53, '2019-09-13 00:17:59', '2019-09-13 19:50:51'),
(675, 'home', 28, '2019-09-14 02:33:25', '2019-09-14 23:59:13'),
(676, 'home', 29, '2019-09-15 00:00:04', '2019-09-15 21:44:39'),
(677, 'home', 48, '2019-09-16 00:11:55', '2019-09-16 21:53:13'),
(678, 'home', 30, '2019-09-17 04:22:29', '2019-09-17 21:37:39'),
(679, 'home', 36, '2019-09-18 00:46:05', '2019-09-18 21:39:19'),
(680, 'home', 60, '2019-09-19 00:40:46', '2019-09-19 21:31:08'),
(681, 'home', 32, '2019-09-20 00:25:07', '2019-09-20 22:24:50'),
(682, 'home', 31, '2019-09-21 02:50:34', '2019-09-21 21:41:50'),
(683, 'home', 23, '2019-09-22 03:33:24', '2019-09-22 20:19:05'),
(684, 'home', 46, '2019-09-23 03:11:36', '2019-09-23 23:25:34'),
(685, 'home', 47, '2019-09-24 00:03:05', '2019-09-24 23:35:19'),
(686, 'home', 36, '2019-09-25 05:05:53', '2019-09-25 23:36:50'),
(687, 'home', 26, '2019-09-26 02:20:54', '2019-09-26 20:40:52'),
(688, 'home', 41, '2019-09-27 01:41:40', '2019-09-27 20:59:28'),
(689, 'home', 68, '2019-09-28 01:00:23', '2019-09-28 23:36:41'),
(690, 'home', 53, '2019-09-29 03:41:02', '2019-09-29 23:18:02'),
(691, 'home', 43, '2019-09-30 00:48:36', '2019-09-30 23:48:43'),
(692, 'home', 46, '2019-10-01 04:00:40', '2019-10-01 21:52:55'),
(693, 'home', 14, '2019-10-02 01:39:20', '2019-10-02 20:23:39'),
(694, 'home', 42, '2019-10-03 00:57:09', '2019-10-03 17:56:38'),
(695, 'home', 31, '2019-10-04 01:27:17', '2019-10-04 23:57:54'),
(696, 'home', 28, '2019-10-05 00:00:12', '2019-10-05 21:50:00'),
(697, 'home', 26, '2019-10-06 01:53:56', '2019-10-06 19:51:01'),
(698, 'home', 41, '2019-10-07 03:09:59', '2019-10-07 22:55:16'),
(699, 'home', 33, '2019-10-08 01:11:27', '2019-10-08 23:18:23'),
(700, 'home', 32, '2019-10-09 02:07:51', '2019-10-09 23:28:24'),
(701, 'home', 15, '2019-10-10 00:06:58', '2019-10-10 07:58:32'),
(702, 'home', 8, '2019-10-12 05:30:38', '2019-10-12 07:35:59'),
(703, 'home', 7, '2019-11-06 16:26:26', '2019-11-06 16:53:22'),
(704, 'home', 3, '2019-11-08 10:48:09', '2019-11-08 10:51:17'),
(705, 'home', 2, '2019-11-20 16:11:22', '2019-11-20 18:58:44'),
(706, 'home', 1, '2019-11-21 03:31:27', '2019-11-21 03:31:27'),
(707, 'home', 8, '2019-11-26 05:12:30', '2019-11-26 09:16:55'),
(708, 'home', 11, '2019-12-09 08:33:07', '2019-12-09 08:40:35'),
(709, 'home', 1, '2019-12-11 13:54:19', '2019-12-11 13:54:19'),
(710, 'home', 52, '2019-12-15 11:34:03', '2019-12-15 14:07:04'),
(711, 'home', 6, '2019-12-17 08:32:35', '2019-12-17 08:46:07'),
(712, 'home', 72, '2019-12-19 07:03:05', '2019-12-19 10:58:37'),
(713, 'home', 79, '2019-12-20 05:04:48', '2019-12-20 17:48:05'),
(714, 'home', 32, '2019-12-21 05:04:11', '2019-12-21 19:40:44'),
(715, 'home', 141, '2019-12-22 03:44:42', '2019-12-22 14:09:56'),
(716, 'home', 6, '2019-12-23 23:05:17', '2019-12-23 23:09:51'),
(717, 'home', 66, '2019-12-24 04:58:29', '2019-12-24 12:08:40'),
(718, 'home', 25, '2019-12-25 13:05:18', '2019-12-25 18:09:08'),
(719, 'home', 15, '2019-12-26 13:33:21', '2019-12-26 19:21:25'),
(720, 'home', 26, '2019-12-27 13:42:01', '2019-12-27 19:22:40'),
(721, 'home', 43, '2019-12-28 02:18:03', '2019-12-28 18:03:25'),
(722, 'home', 33, '2020-01-01 12:22:31', '2020-01-01 16:19:50'),
(723, 'home', 20, '2020-01-02 04:52:51', '2020-01-02 14:30:53'),
(724, 'home', 27, '2020-01-04 08:04:36', '2020-01-04 10:34:00'),
(725, 'home', 6, '2020-01-05 11:48:47', '2020-01-05 11:52:31'),
(726, 'home', 4, '2020-01-13 17:50:28', '2020-01-13 18:44:37'),
(727, 'home', 18, '2020-01-15 19:34:45', '2020-01-15 22:02:18'),
(728, 'home', 26, '2020-01-17 12:18:55', '2020-01-17 21:01:10'),
(729, 'home', 3, '2020-01-18 23:25:01', '2020-01-18 23:25:30'),
(730, 'home', 1, '2020-01-19 00:06:12', '2020-01-19 00:06:12'),
(731, 'home', 20, '2020-01-30 05:21:37', '2020-01-30 06:27:00'),
(732, 'home', 9, '2020-02-09 01:21:20', '2020-02-09 10:32:03'),
(733, 'home', 1, '2020-02-10 02:03:41', '2020-02-10 02:03:41'),
(734, 'home', 24, '2020-02-19 06:18:56', '2020-02-19 14:34:58'),
(735, 'home', 35, '2020-02-24 09:04:46', '2020-02-24 12:21:02'),
(736, 'home', 8, '2020-02-26 09:32:53', '2020-02-26 10:24:16'),
(737, 'home', 70, '2020-02-28 05:28:27', '2020-02-28 11:21:18'),
(738, 'home', 39, '2020-03-02 06:23:19', '2020-03-02 08:37:35'),
(739, 'home', 114, '2020-03-03 05:30:49', '2020-03-03 12:51:59'),
(740, 'home', 3, '2020-03-05 11:53:36', '2020-03-05 11:54:39'),
(741, 'home', 7, '2020-03-10 09:10:36', '2020-03-10 10:59:42'),
(742, 'home', 3, '2020-03-14 17:51:19', '2020-03-14 17:51:41'),
(743, 'home', 7, '2020-03-16 11:31:33', '2020-03-16 13:17:40'),
(744, 'home', 2, '2020-03-19 14:49:17', '2020-03-19 14:49:22'),
(745, 'home', 1, '2020-03-20 02:52:39', '2020-03-20 02:52:39'),
(746, 'home', 1, '2020-03-22 10:28:15', '2020-03-22 10:28:15'),
(747, 'home', 4, '2020-03-24 16:15:11', '2020-03-24 16:15:45'),
(748, 'home', 8, '2020-03-29 14:34:21', '2020-03-29 14:36:14'),
(749, 'home', 1, '2020-03-31 05:27:46', '2020-03-31 05:27:46'),
(750, 'home', 3, '2020-04-10 08:23:09', '2020-04-10 08:23:56'),
(751, 'home', 5, '2020-04-14 13:17:28', '2020-04-14 13:18:10'),
(752, 'home', 1, '2020-04-15 16:28:10', '2020-04-15 16:28:10'),
(753, 'home', 4, '2020-04-21 05:37:49', '2020-04-21 05:41:13'),
(754, 'home', 1, '2020-04-25 23:55:17', '2020-04-25 23:55:17'),
(755, 'home', 2, '2020-04-26 20:50:27', '2020-04-26 20:50:59'),
(756, 'home', 1, '2020-04-27 09:19:55', '2020-04-27 09:19:55'),
(757, 'home', 4, '2020-05-02 08:19:14', '2020-05-02 08:20:47'),
(758, 'home', 17, '2020-05-05 09:22:26', '2020-05-05 11:31:29'),
(759, 'home', 4, '2020-05-18 14:27:31', '2020-05-18 14:31:03'),
(760, 'home', 2, '2020-05-20 16:17:20', '2020-05-20 16:17:40'),
(761, 'home', 7, '2020-05-28 14:51:39', '2020-05-28 15:02:11'),
(762, 'home', 27, '2020-05-29 11:27:03', '2020-05-29 14:10:47'),
(763, 'home', 4, '2020-05-30 08:42:43', '2020-05-30 08:43:16'),
(764, 'home', 4, '2020-06-01 18:54:24', '2020-06-01 18:55:15'),
(765, 'home', 7, '2020-06-04 00:36:05', '2020-06-04 00:59:17'),
(766, 'home', 4, '2020-06-16 17:34:11', '2020-06-16 17:35:16'),
(767, 'home', 2, '2020-06-25 21:56:01', '2020-06-25 21:56:17'),
(768, 'home', 45, '2020-06-24 21:56:01', '2020-06-24 21:56:17'),
(769, 'home', 10, '2020-06-28 16:26:36', '2020-06-28 20:33:34'),
(770, 'home', 39, '2020-06-29 00:19:51', '2020-06-29 23:00:21'),
(771, 'home', 41, '2020-06-30 02:59:35', '2020-06-30 22:29:02'),
(772, 'home', 22, '2020-07-01 00:15:32', '2020-07-01 23:55:12'),
(773, 'home', 46, '2020-07-02 01:32:49', '2020-07-02 22:03:03'),
(774, 'home', 44, '2020-07-03 00:07:05', '2020-07-03 22:40:25'),
(775, 'home', 11, '2020-07-04 00:24:02', '2020-07-04 22:32:53'),
(776, 'home', 32, '2020-07-05 00:15:56', '2020-07-05 20:46:35'),
(777, 'home', 54, '2020-07-06 01:48:37', '2020-07-06 23:23:35'),
(778, 'home', 36, '2020-07-07 00:07:02', '2020-07-07 23:12:11'),
(779, 'home', 49, '2020-07-08 02:49:18', '2020-07-08 23:53:23'),
(780, 'home', 38, '2020-07-09 02:37:09', '2020-07-09 23:08:01'),
(781, 'home', 37, '2020-07-10 01:41:21', '2020-07-10 21:45:59'),
(782, 'home', 28, '2020-07-11 01:37:05', '2020-07-11 22:46:08'),
(783, 'home', 30, '2020-07-12 00:16:04', '2020-07-12 23:35:48'),
(784, 'home', 36, '2020-07-13 00:14:44', '2020-07-13 23:36:57'),
(785, 'home', 36, '2020-07-14 00:08:07', '2020-07-14 23:02:30'),
(786, 'home', 35, '2020-07-15 00:06:14', '2020-07-15 22:46:33'),
(787, 'home', 32, '2020-07-16 01:08:25', '2020-07-16 22:50:54'),
(788, 'home', 21, '2020-07-17 02:48:32', '2020-07-17 22:28:27'),
(789, 'home', 31, '2020-07-18 00:56:44', '2020-07-18 22:58:29'),
(790, 'home', 26, '2020-07-19 00:48:44', '2020-07-19 21:54:29');
INSERT INTO `page_counters` (`id`, `page`, `count`, `created_at`, `updated_at`) VALUES
(791, 'home', 49, '2020-07-20 02:16:40', '2020-07-20 21:57:32'),
(792, 'home', 48, '2020-07-21 02:53:46', '2020-07-21 22:43:42'),
(793, 'home', 48, '2020-07-22 00:31:55', '2020-07-22 23:23:59'),
(794, 'home', 28, '2020-07-23 01:25:57', '2020-07-23 22:19:27'),
(795, 'home', 39, '2020-07-24 01:12:49', '2020-07-24 23:36:58'),
(796, 'home', 33, '2020-07-25 00:01:05', '2020-07-25 23:10:43'),
(797, 'home', 24, '2020-07-26 01:22:07', '2020-07-26 22:33:13'),
(798, 'home', 41, '2020-07-27 00:13:11', '2020-07-27 23:44:10'),
(799, 'home', 26, '2020-07-28 01:14:02', '2020-07-28 22:00:38'),
(800, 'home', 23, '2020-07-29 02:21:29', '2020-07-29 23:29:41'),
(801, 'home', 26, '2020-07-30 02:55:04', '2020-07-30 23:59:07'),
(802, 'home', 29, '2020-07-31 00:00:14', '2020-07-31 22:46:29'),
(803, 'home', 23, '2020-08-01 00:38:19', '2020-08-01 21:41:43'),
(804, 'home', 13, '2020-08-02 00:36:39', '2020-08-02 22:21:31'),
(805, 'home', 39, '2020-08-03 04:44:32', '2020-08-03 23:35:47'),
(806, 'home', 33, '2020-08-04 01:10:04', '2020-08-04 22:30:49'),
(807, 'home', 30, '2020-08-05 00:52:44', '2020-08-05 23:04:01'),
(808, 'home', 31, '2020-08-06 00:33:34', '2020-08-06 23:29:20'),
(809, 'home', 30, '2020-08-07 01:26:17', '2020-08-07 23:26:03'),
(810, 'home', 17, '2020-08-08 03:12:10', '2020-08-08 23:42:17'),
(811, 'home', 18, '2020-08-09 00:18:44', '2020-08-09 21:55:54'),
(812, 'home', 44, '2020-08-10 00:11:02', '2020-08-10 23:22:01'),
(813, 'home', 21, '2020-08-11 04:02:17', '2020-08-11 21:55:53'),
(814, 'home', 42, '2020-08-12 00:42:43', '2020-08-12 20:54:39'),
(815, 'home', 29, '2020-08-13 00:07:40', '2020-08-13 23:18:55'),
(816, 'home', 30, '2020-08-14 00:55:50', '2020-08-14 23:11:31'),
(817, 'home', 24, '2020-08-15 01:25:24', '2020-08-15 23:46:51'),
(818, 'home', 15, '2020-08-16 06:35:42', '2020-08-16 20:29:01'),
(819, 'home', 37, '2020-08-17 00:38:26', '2020-08-17 21:48:34'),
(820, 'home', 27, '2020-08-18 00:03:38', '2020-08-18 23:51:16'),
(821, 'home', 20, '2020-08-19 01:26:55', '2020-08-19 23:40:13'),
(822, 'home', 20, '2020-08-20 02:29:59', '2020-08-20 22:33:49'),
(823, 'home', 24, '2020-08-21 00:07:54', '2020-08-21 23:46:57'),
(824, 'home', 19, '2020-08-22 01:15:35', '2020-08-22 20:55:41'),
(825, 'home', 16, '2020-08-23 02:12:17', '2020-08-23 23:50:16'),
(826, 'home', 34, '2020-08-24 00:12:42', '2020-08-24 23:08:28'),
(827, 'home', 33, '2020-08-25 01:04:08', '2020-08-25 23:59:31'),
(828, 'home', 28, '2020-08-26 00:05:14', '2020-08-26 21:19:47'),
(829, 'home', 36, '2020-08-27 00:19:02', '2020-08-27 23:11:05'),
(830, 'home', 30, '2020-08-28 00:05:12', '2020-08-28 23:45:01'),
(831, 'home', 25, '2020-08-29 00:40:38', '2020-08-29 23:15:35'),
(832, 'home', 33, '2020-08-30 00:03:32', '2020-08-30 22:59:20'),
(833, 'home', 25, '2020-08-31 01:52:54', '2020-08-31 21:52:11'),
(834, 'home', 24, '2020-09-01 01:30:30', '2020-09-01 23:24:21'),
(835, 'home', 25, '2020-09-02 01:46:52', '2020-09-02 19:04:54'),
(836, 'home', 17, '2020-09-03 06:35:28', '2020-09-03 23:18:33'),
(837, 'home', 24, '2020-09-04 00:56:31', '2020-09-04 23:58:20'),
(838, 'home', 31, '2020-09-05 00:39:03', '2020-09-05 23:55:41'),
(839, 'home', 19, '2020-09-06 01:54:46', '2020-09-06 23:29:41'),
(840, 'home', 42, '2020-09-07 01:25:21', '2020-09-07 23:44:32'),
(841, 'home', 23, '2020-09-08 00:26:08', '2020-09-08 23:28:22'),
(842, 'home', 23, '2020-09-09 03:05:38', '2020-09-09 23:45:25'),
(843, 'home', 23, '2020-09-10 01:35:31', '2020-09-10 21:57:14'),
(844, 'home', 45, '2020-09-11 00:31:08', '2020-09-11 23:21:17'),
(845, 'home', 23, '2020-09-12 03:04:52', '2020-09-12 22:14:54'),
(846, 'home', 26, '2020-09-13 01:52:13', '2020-09-13 21:50:41'),
(847, 'home', 28, '2020-09-14 04:54:45', '2020-09-14 22:47:45'),
(848, 'home', 18, '2020-09-15 01:43:42', '2020-09-15 20:20:53'),
(849, 'home', 26, '2020-09-16 00:37:34', '2020-09-16 19:36:59'),
(850, 'home', 21, '2020-09-17 01:23:17', '2020-09-17 20:00:05'),
(851, 'home', 36, '2020-09-18 00:40:38', '2020-09-18 23:57:01'),
(852, 'home', 26, '2020-09-19 02:23:43', '2020-09-19 23:32:25'),
(853, 'home', 28, '2020-09-20 06:41:47', '2020-09-20 23:03:18'),
(854, 'home', 36, '2020-09-21 00:07:41', '2020-09-21 23:29:54'),
(855, 'home', 52, '2020-09-22 00:05:50', '2020-09-22 23:15:50'),
(856, 'home', 43, '2020-09-23 00:18:32', '2020-09-23 23:40:51'),
(857, 'home', 19, '2020-09-24 01:26:27', '2020-09-24 22:17:15'),
(858, 'home', 20, '2020-09-25 02:01:08', '2020-09-25 21:41:49'),
(859, 'home', 19, '2020-09-26 03:53:43', '2020-09-26 22:23:40'),
(860, 'home', 21, '2020-09-27 01:45:54', '2020-09-27 23:40:32'),
(861, 'home', 22, '2020-09-28 01:47:42', '2020-09-28 18:43:07'),
(862, 'home', 22, '2020-09-29 01:10:18', '2020-09-29 16:31:15'),
(863, 'home', 17, '2020-09-30 03:01:19', '2020-09-30 23:33:35'),
(864, 'home', 21, '2020-10-01 00:42:09', '2020-10-01 23:47:18'),
(865, 'home', 14, '2020-10-02 05:00:20', '2020-10-02 22:31:38'),
(866, 'home', 19, '2020-10-03 04:00:56', '2020-10-03 23:09:31'),
(867, 'home', 14, '2020-10-04 07:21:21', '2020-10-04 21:42:19'),
(868, 'home', 23, '2020-10-05 04:39:25', '2020-10-05 21:56:46'),
(869, 'home', 24, '2020-10-06 00:43:48', '2020-10-06 22:10:43'),
(870, 'home', 18, '2020-10-07 01:00:07', '2020-10-07 23:57:00'),
(871, 'home', 20, '2020-10-08 01:16:44', '2020-10-08 23:39:21'),
(872, 'home', 18, '2020-10-09 05:09:08', '2020-10-09 22:33:41'),
(873, 'home', 10, '2020-10-10 01:02:20', '2020-10-10 16:43:43'),
(874, 'home', 15, '2020-10-11 00:44:19', '2020-10-11 19:27:07'),
(875, 'home', 34, '2020-10-12 00:11:52', '2020-10-12 22:43:10'),
(876, 'home', 23, '2020-10-13 00:38:22', '2020-10-13 23:54:51'),
(877, 'home', 15, '2020-10-14 04:56:52', '2020-10-14 19:53:06'),
(878, 'home', 19, '2020-10-15 01:08:40', '2020-10-15 20:05:18'),
(879, 'home', 21, '2020-10-16 01:26:26', '2020-10-16 20:50:44'),
(880, 'home', 12, '2020-10-17 02:08:22', '2020-10-17 21:21:34'),
(881, 'home', 20, '2020-10-18 02:20:27', '2020-10-18 19:40:09'),
(882, 'home', 22, '2020-10-19 01:42:14', '2020-10-19 23:43:04'),
(883, 'home', 29, '2020-10-20 00:20:55', '2020-10-20 23:13:33'),
(884, 'home', 22, '2020-10-21 01:25:08', '2020-10-21 22:02:26'),
(885, 'home', 26, '2020-10-22 01:09:26', '2020-10-22 22:04:01'),
(886, 'home', 16, '2020-10-23 00:46:19', '2020-10-23 20:41:28'),
(887, 'home', 27, '2020-10-24 00:03:07', '2020-10-24 22:21:25'),
(888, 'home', 14, '2020-10-25 00:19:52', '2020-10-25 17:28:41'),
(889, 'home', 20, '2020-10-26 02:28:49', '2020-10-26 23:18:09'),
(890, 'home', 27, '2020-10-27 00:03:00', '2020-10-27 23:44:20'),
(891, 'home', 29, '2020-10-28 00:42:52', '2020-10-28 22:24:07'),
(892, 'home', 32, '2020-10-29 04:07:54', '2020-10-29 21:43:43'),
(893, 'home', 18, '2020-10-30 01:41:21', '2020-10-30 21:32:41'),
(894, 'home', 14, '2020-10-31 06:09:37', '2020-10-31 23:52:53'),
(895, 'home', 18, '2020-11-01 00:01:50', '2020-11-01 23:29:00'),
(896, 'home', 18, '2020-11-02 00:08:04', '2020-11-02 20:05:38'),
(897, 'home', 25, '2020-11-03 01:14:33', '2020-11-03 23:58:27'),
(898, 'home', 24, '2020-11-04 01:13:01', '2020-11-04 23:34:52'),
(899, 'home', 26, '2020-11-05 01:27:50', '2020-11-05 23:31:03'),
(900, 'home', 10, '2020-11-06 00:16:36', '2020-11-06 23:41:42'),
(901, 'home', 7, '2020-11-07 01:13:57', '2020-11-07 23:45:42'),
(902, 'home', 15, '2020-11-08 11:49:13', '2020-11-08 23:40:35'),
(903, 'home', 15, '2020-11-09 02:32:18', '2020-11-09 22:27:44'),
(904, 'home', 47, '2020-11-10 00:11:00', '2020-11-10 23:56:42'),
(905, 'home', 19, '2020-11-11 02:25:31', '2020-11-11 23:03:35'),
(906, 'home', 42, '2020-11-12 00:00:54', '2020-11-12 21:45:59'),
(907, 'home', 27, '2020-11-13 00:02:33', '2020-11-13 23:49:05'),
(908, 'home', 10, '2020-11-14 00:49:43', '2020-11-14 23:14:32'),
(909, 'home', 14, '2020-11-15 01:36:50', '2020-11-15 23:53:30'),
(910, 'home', 20, '2020-11-16 02:32:23', '2020-11-16 22:15:00'),
(911, 'home', 12, '2020-11-17 02:23:47', '2020-11-17 23:02:57'),
(912, 'home', 16, '2020-11-18 00:53:48', '2020-11-18 23:53:08'),
(913, 'home', 29, '2020-11-19 02:06:15', '2020-11-19 23:03:36'),
(914, 'home', 21, '2020-11-20 00:19:59', '2020-11-20 21:59:58'),
(915, 'home', 17, '2020-11-21 01:31:50', '2020-11-21 22:05:37'),
(916, 'home', 15, '2020-11-22 02:08:46', '2020-11-22 22:06:10'),
(917, 'home', 21, '2020-11-23 04:51:15', '2020-11-23 23:25:48'),
(918, 'home', 26, '2020-11-24 00:32:33', '2020-11-24 17:26:48'),
(919, 'home', 15, '2020-11-25 02:33:04', '2020-11-25 22:52:07'),
(920, 'home', 18, '2020-11-26 05:51:21', '2020-11-26 23:22:00'),
(921, 'home', 10, '2020-11-27 00:45:50', '2020-11-27 15:10:18'),
(922, 'home', 20, '2020-11-30 06:41:06', '2020-11-30 17:33:13'),
(923, 'home', 14, '2020-12-01 01:36:23', '2020-12-01 19:34:41'),
(924, 'home', 10, '2020-12-02 05:07:43', '2020-12-02 22:33:36'),
(925, 'home', 24, '2020-12-03 00:41:53', '2020-12-03 23:31:54'),
(926, 'home', 14, '2020-12-04 02:34:48', '2020-12-04 21:18:22'),
(927, 'home', 13, '2020-12-05 04:41:08', '2020-12-05 22:30:09'),
(928, 'home', 8, '2020-12-06 05:21:42', '2020-12-06 19:23:09'),
(929, 'home', 30, '2020-12-07 01:07:23', '2020-12-07 20:17:21'),
(930, 'home', 15, '2020-12-08 00:45:50', '2020-12-08 21:08:38'),
(931, 'home', 27, '2020-12-09 00:39:30', '2020-12-09 23:03:27'),
(932, 'home', 15, '2020-12-10 01:25:13', '2020-12-10 19:07:44'),
(933, 'home', 22, '2020-12-11 00:10:02', '2020-12-11 20:41:29'),
(934, 'home', 16, '2020-12-12 04:53:27', '2020-12-12 23:58:32'),
(935, 'home', 19, '2020-12-13 00:00:11', '2020-12-13 19:36:59'),
(936, 'home', 26, '2020-12-14 01:21:23', '2020-12-14 23:28:58'),
(937, 'home', 21, '2020-12-15 00:41:22', '2020-12-15 23:41:17'),
(938, 'home', 23, '2020-12-16 00:40:42', '2020-12-16 22:49:25'),
(939, 'home', 16, '2020-12-17 01:24:57', '2020-12-17 23:34:57'),
(940, 'home', 19, '2020-12-18 00:02:12', '2020-12-18 23:56:23'),
(941, 'home', 10, '2020-12-19 03:35:24', '2020-12-19 21:20:54'),
(942, 'home', 16, '2020-12-20 00:30:52', '2020-12-20 23:58:54'),
(943, 'home', 16, '2020-12-21 01:15:56', '2020-12-21 23:13:22'),
(944, 'home', 16, '2020-12-22 03:18:12', '2020-12-22 21:13:08'),
(945, 'home', 17, '2020-12-23 00:13:24', '2020-12-23 18:21:56'),
(946, 'home', 17, '2020-12-24 00:36:08', '2020-12-24 22:49:04'),
(947, 'home', 16, '2020-12-25 00:34:43', '2020-12-25 20:13:52'),
(948, 'home', 16, '2020-12-26 00:18:36', '2020-12-26 21:56:20'),
(949, 'home', 24, '2020-12-27 01:20:34', '2020-12-27 22:09:49'),
(950, 'home', 18, '2020-12-28 00:37:56', '2020-12-28 23:59:18'),
(951, 'home', 24, '2020-12-29 00:24:55', '2020-12-29 23:10:00'),
(952, 'home', 15, '2020-12-30 01:02:58', '2020-12-30 23:10:03'),
(953, 'home', 13, '2020-12-31 02:30:56', '2020-12-31 21:46:14'),
(954, 'home', 13, '2021-01-01 00:05:19', '2021-01-01 23:05:51'),
(955, 'home', 17, '2021-01-02 01:26:10', '2021-01-02 21:26:20'),
(956, 'home', 15, '2021-01-03 02:55:54', '2021-01-03 19:56:03'),
(957, 'home', 23, '2021-01-04 03:40:03', '2021-01-04 23:37:38'),
(958, 'home', 20, '2021-01-05 05:12:53', '2021-01-05 22:53:52'),
(959, 'home', 25, '2021-01-06 00:40:50', '2021-01-06 23:50:03'),
(960, 'home', 13, '2021-01-07 12:35:46', '2021-01-07 23:15:12'),
(961, 'home', 22, '2021-01-08 00:36:23', '2021-01-08 23:52:33'),
(962, 'home', 15, '2021-01-09 03:20:58', '2021-01-09 22:54:39'),
(963, 'home', 9, '2021-01-10 00:32:48', '2021-01-10 23:01:24'),
(964, 'home', 17, '2021-01-11 02:44:12', '2021-01-11 23:39:09'),
(965, 'home', 17, '2021-01-12 05:20:40', '2021-01-12 23:13:19'),
(966, 'home', 13, '2021-01-13 01:40:28', '2021-01-13 23:35:39'),
(967, 'home', 17, '2021-01-14 00:39:11', '2021-01-14 23:59:49'),
(968, 'home', 27, '2021-01-15 07:49:23', '2021-01-15 23:06:00'),
(969, 'home', 9, '2021-01-16 08:16:30', '2021-01-16 22:37:02'),
(970, 'home', 13, '2021-01-17 00:12:10', '2021-01-17 23:34:41'),
(971, 'home', 14, '2021-01-18 01:53:30', '2021-01-18 22:21:32'),
(972, 'home', 23, '2021-01-19 00:11:13', '2021-01-19 20:29:13'),
(973, 'home', 24, '2021-01-20 01:58:51', '2021-01-20 21:44:18'),
(974, 'home', 15, '2021-01-21 01:26:15', '2021-01-21 21:48:18'),
(975, 'home', 18, '2021-01-22 00:05:33', '2021-01-22 22:32:46'),
(976, 'home', 24, '2021-01-23 00:56:59', '2021-01-23 23:17:32'),
(977, 'home', 16, '2021-01-24 01:38:47', '2021-01-24 23:20:40'),
(978, 'home', 28, '2021-01-25 03:50:24', '2021-01-25 23:10:11'),
(979, 'home', 25, '2021-01-26 00:12:00', '2021-01-26 21:58:43'),
(980, 'home', 25, '2021-01-27 00:33:02', '2021-01-27 23:34:43'),
(981, 'home', 20, '2021-01-28 03:07:37', '2021-01-28 21:53:32'),
(982, 'home', 25, '2021-01-29 05:30:23', '2021-01-29 22:30:13'),
(983, 'home', 19, '2021-01-30 00:25:33', '2021-01-30 22:44:04'),
(984, 'home', 15, '2021-01-31 03:07:38', '2021-01-31 23:57:15'),
(985, 'home', 25, '2021-02-01 00:09:30', '2021-02-01 17:57:50'),
(986, 'home', 25, '2021-02-02 02:02:37', '2021-02-02 22:26:37'),
(987, 'home', 24, '2021-02-03 00:02:37', '2021-02-03 22:20:03'),
(988, 'home', 14, '2021-02-04 03:53:49', '2021-02-04 23:16:20'),
(989, 'home', 20, '2021-02-05 00:35:52', '2021-02-05 21:59:39'),
(990, 'home', 15, '2021-02-06 04:38:45', '2021-02-06 22:47:17'),
(991, 'home', 7, '2021-02-07 00:27:03', '2021-02-07 18:58:06'),
(992, 'home', 14, '2021-02-08 08:03:01', '2021-02-08 20:28:29'),
(993, 'home', 18, '2021-02-09 02:06:00', '2021-02-09 23:33:36'),
(994, 'home', 15, '2021-02-10 02:05:07', '2021-02-10 18:23:51'),
(995, 'home', 20, '2021-02-11 04:52:24', '2021-02-11 23:23:59'),
(996, 'home', 25, '2021-02-12 00:52:49', '2021-02-12 23:54:43'),
(997, 'home', 17, '2021-02-13 02:20:32', '2021-02-13 22:14:28'),
(998, 'home', 9, '2021-02-14 01:17:45', '2021-02-14 21:59:47'),
(999, 'home', 15, '2021-02-15 02:38:48', '2021-02-15 22:44:08'),
(1000, 'home', 13, '2021-02-16 00:00:06', '2021-02-16 21:36:31'),
(1001, 'home', 15, '2021-02-17 04:34:19', '2021-02-17 23:40:15'),
(1002, 'home', 11, '2021-02-18 01:18:39', '2021-02-18 23:52:09'),
(1003, 'home', 17, '2021-02-19 01:35:04', '2021-02-19 23:54:44'),
(1004, 'home', 9, '2021-02-20 00:45:23', '2021-02-20 22:07:21'),
(1005, 'home', 9, '2021-02-21 01:46:22', '2021-02-21 16:08:00'),
(1006, 'home', 10, '2021-02-22 03:18:21', '2021-02-22 20:37:34'),
(1007, 'home', 18, '2021-02-23 02:27:41', '2021-02-23 23:59:32'),
(1008, 'home', 24, '2021-02-24 01:02:00', '2021-02-24 22:58:08'),
(1009, 'home', 10, '2021-02-25 00:50:56', '2021-02-25 22:12:36'),
(1010, 'home', 25, '2021-02-26 04:17:17', '2021-02-26 22:47:24'),
(1011, 'home', 14, '2021-02-27 10:52:50', '2021-02-27 23:26:24'),
(1012, 'home', 14, '2021-02-28 02:15:55', '2021-02-28 21:53:19'),
(1013, 'home', 27, '2021-03-01 00:36:51', '2021-03-01 23:13:15'),
(1014, 'home', 16, '2021-03-02 05:44:06', '2021-03-02 23:20:28'),
(1015, 'home', 12, '2021-03-03 00:17:10', '2021-03-03 21:49:15'),
(1016, 'home', 7, '2021-03-04 00:24:06', '2021-03-04 18:30:12'),
(1017, 'home', 22, '2021-03-05 00:23:25', '2021-03-05 23:45:09'),
(1018, 'home', 15, '2021-03-06 00:37:09', '2021-03-06 22:55:46'),
(1019, 'home', 14, '2021-03-07 05:58:23', '2021-03-07 23:11:04'),
(1020, 'home', 20, '2021-03-08 00:35:03', '2021-03-08 23:00:15'),
(1021, 'home', 16, '2021-03-09 07:39:38', '2021-03-09 22:25:15'),
(1022, 'home', 7, '2021-03-10 05:37:34', '2021-03-10 18:26:27'),
(1023, 'home', 17, '2021-03-11 01:40:18', '2021-03-11 23:11:00'),
(1024, 'home', 25, '2021-03-12 00:31:30', '2021-03-12 21:48:44'),
(1025, 'home', 6, '2021-03-13 06:03:36', '2021-03-13 23:40:53'),
(1026, 'home', 9, '2021-03-14 02:02:44', '2021-03-14 20:02:13'),
(1027, 'home', 18, '2021-03-15 02:46:25', '2021-03-15 23:56:47'),
(1028, 'home', 24, '2021-03-16 01:31:58', '2021-03-16 23:58:56'),
(1029, 'home', 33, '2021-03-17 00:06:20', '2021-03-17 23:00:40'),
(1030, 'home', 18, '2021-03-18 00:36:33', '2021-03-18 23:17:23'),
(1031, 'home', 15, '2021-03-19 00:12:18', '2021-03-19 23:03:47'),
(1032, 'home', 11, '2021-03-20 03:39:34', '2021-03-20 21:06:57'),
(1033, 'home', 16, '2021-03-21 00:27:53', '2021-03-21 19:05:22'),
(1034, 'home', 13, '2021-03-22 01:08:02', '2021-03-22 22:54:49'),
(1035, 'home', 13, '2021-03-23 01:13:44', '2021-03-23 22:56:39'),
(1036, 'home', 17, '2021-03-24 02:07:40', '2021-03-24 23:01:50'),
(1037, 'home', 15, '2021-03-25 03:58:13', '2021-03-25 22:25:01'),
(1038, 'home', 21, '2021-03-26 02:22:51', '2021-03-26 23:10:57'),
(1039, 'home', 11, '2021-03-27 06:11:59', '2021-03-27 23:26:39'),
(1040, 'home', 9, '2021-03-28 02:34:46', '2021-03-28 23:18:25'),
(1041, 'home', 12, '2021-03-29 04:16:04', '2021-03-29 23:18:50'),
(1042, 'home', 19, '2021-03-30 01:22:49', '2021-03-30 23:23:30'),
(1043, 'home', 24, '2021-03-31 01:01:06', '2021-03-31 23:47:47'),
(1044, 'home', 13, '2021-04-01 00:05:46', '2021-04-01 23:41:04'),
(1045, 'home', 11, '2021-04-02 02:16:19', '2021-04-02 22:45:59'),
(1046, 'home', 10, '2021-04-03 08:25:59', '2021-04-03 23:50:02'),
(1047, 'home', 14, '2021-04-04 00:27:09', '2021-04-04 23:11:11'),
(1048, 'home', 14, '2021-04-05 03:37:06', '2021-04-05 19:04:21'),
(1049, 'home', 11, '2021-04-06 08:12:15', '2021-04-06 23:50:18'),
(1050, 'home', 28, '2021-04-07 04:54:50', '2021-04-07 22:21:08'),
(1051, 'home', 19, '2021-04-08 00:09:43', '2021-04-08 21:42:14'),
(1052, 'home', 15, '2021-04-09 04:04:08', '2021-04-09 22:56:43'),
(1053, 'home', 7, '2021-04-10 00:50:49', '2021-04-10 20:52:23'),
(1054, 'home', 12, '2021-04-11 04:43:45', '2021-04-11 22:24:36'),
(1055, 'home', 17, '2021-04-12 00:48:12', '2021-04-12 22:29:29'),
(1056, 'home', 17, '2021-04-13 01:21:53', '2021-04-13 23:34:54'),
(1057, 'home', 13, '2021-04-14 00:47:13', '2021-04-14 17:38:28'),
(1058, 'home', 26, '2021-04-15 04:42:55', '2021-04-15 20:06:50'),
(1059, 'home', 7, '2021-04-16 03:52:25', '2021-04-16 20:59:55'),
(1060, 'home', 16, '2021-04-17 00:32:52', '2021-04-17 23:59:29'),
(1061, 'home', 8, '2021-04-18 02:11:32', '2021-04-18 18:18:10'),
(1062, 'home', 7, '2021-04-19 01:47:48', '2021-04-19 19:10:02'),
(1063, 'home', 16, '2021-04-20 03:51:31', '2021-04-20 23:04:13'),
(1064, 'home', 9, '2021-04-21 04:49:33', '2021-04-21 22:16:39'),
(1065, 'home', 13, '2021-04-22 02:34:58', '2021-04-22 19:57:37'),
(1066, 'home', 24, '2021-04-23 01:35:59', '2021-04-23 22:27:56'),
(1067, 'home', 12, '2021-04-24 01:45:16', '2021-04-24 21:13:05'),
(1068, 'home', 21, '2021-04-25 00:38:05', '2021-04-25 23:16:28'),
(1069, 'home', 24, '2021-04-26 00:04:18', '2021-04-26 23:48:58'),
(1070, 'home', 26, '2021-04-27 00:05:20', '2021-04-27 23:04:11'),
(1071, 'home', 26, '2021-04-28 00:48:24', '2021-04-28 23:44:23'),
(1072, 'home', 23, '2021-04-29 03:04:45', '2021-04-29 21:25:04'),
(1073, 'home', 24, '2021-04-30 00:07:29', '2021-04-30 23:26:06'),
(1074, 'home', 8, '2021-05-01 03:31:23', '2021-05-01 20:45:54'),
(1075, 'home', 11, '2021-05-02 00:20:00', '2021-05-02 22:45:51'),
(1076, 'home', 8, '2021-05-03 00:26:48', '2021-05-03 20:03:07'),
(1077, 'home', 15, '2021-05-04 01:40:27', '2021-05-04 23:34:33'),
(1078, 'home', 17, '2021-05-05 01:25:17', '2021-05-05 23:25:33'),
(1079, 'home', 12, '2021-05-06 00:33:54', '2021-05-06 22:05:06'),
(1080, 'home', 8, '2021-05-07 04:02:43', '2021-05-07 20:53:30'),
(1081, 'home', 8, '2021-05-08 00:31:39', '2021-05-08 22:55:25'),
(1082, 'home', 9, '2021-05-09 04:04:47', '2021-05-09 22:46:04'),
(1083, 'home', 8, '2021-05-10 04:50:54', '2021-05-10 22:12:41'),
(1084, 'home', 18, '2021-05-11 01:36:02', '2021-05-11 22:34:15'),
(1085, 'home', 21, '2021-05-12 00:22:39', '2021-05-12 23:43:52'),
(1086, 'home', 9, '2021-05-13 00:01:46', '2021-05-13 15:58:28'),
(1087, 'home', 19, '2021-05-14 05:04:43', '2021-05-14 23:50:36'),
(1088, 'home', 16, '2021-05-15 07:02:21', '2021-05-15 21:12:56'),
(1089, 'home', 34, '2021-05-16 01:31:07', '2021-05-16 23:38:42'),
(1090, 'home', 21, '2021-05-17 01:59:40', '2021-05-17 22:54:27'),
(1091, 'home', 18, '2021-05-18 04:44:40', '2021-05-18 23:04:32'),
(1092, 'home', 11, '2021-05-19 04:33:10', '2021-05-19 18:38:43'),
(1093, 'home', 16, '2021-05-20 01:27:39', '2021-05-20 23:04:39'),
(1094, 'home', 17, '2021-05-21 00:36:18', '2021-05-21 19:29:23'),
(1095, 'home', 11, '2021-05-22 05:53:46', '2021-05-22 23:28:59'),
(1096, 'home', 9, '2021-05-23 02:59:39', '2021-05-23 23:12:49'),
(1097, 'home', 20, '2021-05-24 00:01:01', '2021-05-24 21:54:26'),
(1098, 'home', 23, '2021-05-25 00:28:33', '2021-05-25 20:11:27'),
(1099, 'home', 19, '2021-05-26 04:46:05', '2021-05-26 23:35:00'),
(1100, 'home', 11, '2021-05-27 01:25:07', '2021-05-27 22:57:56'),
(1101, 'home', 13, '2021-05-28 05:02:30', '2021-05-28 18:48:46'),
(1102, 'home', 9, '2021-05-29 01:34:25', '2021-05-29 22:26:36'),
(1103, 'home', 16, '2021-05-30 00:25:27', '2021-05-30 23:13:29'),
(1104, 'home', 27, '2021-05-31 02:04:34', '2021-05-31 23:52:25'),
(1105, 'home', 41, '2021-06-01 03:57:20', '2021-06-01 22:26:36'),
(1106, 'home', 12, '2021-06-02 01:46:45', '2021-06-02 22:51:12'),
(1107, 'home', 7, '2021-06-03 04:36:58', '2021-06-03 15:52:35'),
(1108, 'home', 13, '2021-06-04 01:54:47', '2021-06-04 22:50:35'),
(1109, 'home', 11, '2021-06-05 01:55:32', '2021-06-05 12:59:05');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pay_per_views`
--

CREATE TABLE `pay_per_views` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key, It is an unique key',
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'User table Primary key given as Foreign Key',
  `video_id` int(10) UNSIGNED NOT NULL COMMENT 'Admin Video table Primary key given as Foreign Key',
  `payment_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ppv_amount` double(8,2) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `payment_mode` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `admin_amount` double(8,2) NOT NULL,
  `moderator_amount` double(8,2) NOT NULL,
  `type_of_subscription` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_of_user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expiry_date` datetime NOT NULL,
  `is_coupon_applied` tinyint(4) NOT NULL,
  `coupon_reason` text COLLATE utf8_unicode_ci NOT NULL,
  `is_watched` tinyint(4) NOT NULL,
  `paid_date` date NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0' COMMENT 'Status of the per_per_view table',
  `reason` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `coupon_amount` double(8,2) NOT NULL,
  `is_wallet_credits_applied` tinyint(4) NOT NULL DEFAULT '0',
  `wallet_amount` double(8,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `redeems`
--

CREATE TABLE `redeems` (
  `id` int(10) UNSIGNED NOT NULL,
  `moderator_id` int(11) NOT NULL,
  `total` double(8,2) DEFAULT '0.00',
  `total_admin_amount` double(8,2) DEFAULT '0.00',
  `total_moderator_amount` double(8,2) DEFAULT '0.00',
  `paid` double(8,2) DEFAULT '0.00',
  `remaining` double(8,2) DEFAULT '0.00',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `redeem_requests`
--

CREATE TABLE `redeem_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `moderator_id` int(11) NOT NULL,
  `request_amount` double(8,2) NOT NULL,
  `paid_amount` double(8,2) NOT NULL,
  `payment_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin_paid_amount` double(8,2) NOT NULL COMMENT 'Temporary Column',
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_mode` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `referral_codes`
--

CREATE TABLE `referral_codes` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '5f4fccba65be5',
  `user_id` int(11) NOT NULL,
  `referral_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `total_referrals` int(11) NOT NULL DEFAULT '0',
  `referral_earnings` double(8,2) NOT NULL DEFAULT '0.00' COMMENT 'Using the current user code, if someone joined means the current user will get this earnings',
  `referee_earnings` double(8,2) NOT NULL DEFAULT '0.00' COMMENT 'if the current user joined using someother user referral code means the current user will get some earnings',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `referral_codes`
--

INSERT INTO `referral_codes` (`id`, `unique_id`, `user_id`, `referral_code`, `total_referrals`, `referral_earnings`, `referee_earnings`, `status`, `created_at`, `updated_at`) VALUES
(1, '5f4fccba65be5', 1, '60bb73c513c46', 0, 0.00, 0.00, 1, '2021-06-05 12:53:25', '2021-06-05 12:53:25');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'StreamView', NULL, '2021-06-04 17:57:52'),
(2, 'site_logo', 'http://adminview.streamhash.com/storage/uploads/settings/SV-2021-06-04-17-57-52-26088a3cfce0187a03c9e6c65f0556aa31305553.png', NULL, '2021-06-04 17:57:52'),
(3, 'site_icon', 'http://adminview.streamhash.com/storage/uploads/settings/SV-2021-06-04-17-57-52-705ec6dce975fcce2a311a1dd765bc0a290f7521.png', NULL, '2021-06-04 17:57:52'),
(4, 'tag_name', '', NULL, NULL),
(5, 'paypal_email', '', NULL, NULL),
(6, 'browser_key', '', NULL, NULL),
(7, 'default_lang', 'en', NULL, '2021-05-24 13:52:30'),
(8, 'currency', '$', NULL, NULL),
(9, 'admin_delete_control', '0', NULL, '2021-06-05 11:34:12'),
(10, 'admin_theme_control', '0', NULL, NULL),
(11, 'theme', 'streamtube', NULL, NULL),
(12, 'paypal_client_id', '', NULL, NULL),
(13, 'paypal_secret', '', NULL, '2021-04-28 07:50:31'),
(14, 'installation_process', '2', NULL, '2017-11-10 00:30:26'),
(15, 'amount', '10', NULL, NULL),
(16, 'expiry_days', '28', NULL, NULL),
(17, 'admin_take_count', '12', NULL, NULL),
(18, 'google_analytics', '', NULL, '2021-05-24 13:52:30'),
(19, 'streaming_url', 'http://adminview.streamhash.com:8080/', NULL, '2019-09-10 09:30:48'),
(20, 'video_compress_size', '1', NULL, NULL),
(21, 'image_compress_size', '8', NULL, NULL),
(22, 's3_key', '', NULL, '2020-08-29 20:43:07'),
(23, 's3_secret', '', NULL, '2020-08-29 20:43:07'),
(24, 's3_region', '', NULL, '2020-08-29 20:43:07'),
(25, 's3_bucket', '', NULL, '2020-08-29 20:43:07'),
(26, 'track_user_mail', '0', NULL, NULL),
(27, 'REPORT_VIDEO', 'Sexual content', NULL, NULL),
(28, 'REPORT_VIDEO', 'Violent or repulsive content.', NULL, NULL),
(29, 'REPORT_VIDEO', 'Hateful or abusive content.', NULL, NULL),
(30, 'REPORT_VIDEO', 'Harmful dangerous acts.', NULL, NULL),
(31, 'REPORT_VIDEO', 'Child abuse.', NULL, NULL),
(32, 'REPORT_VIDEO', 'Spam or misleading.', NULL, NULL),
(33, 'REPORT_VIDEO', 'Infringes my rights.', NULL, NULL),
(34, 'REPORT_VIDEO', 'Captions issue.', NULL, NULL),
(35, 'VIDEO_RESOLUTIONS', '426x240', NULL, NULL),
(36, 'VIDEO_RESOLUTIONS', '640x360', NULL, NULL),
(37, 'VIDEO_RESOLUTIONS', '854x480', NULL, NULL),
(38, 'VIDEO_RESOLUTIONS', '1280x720', NULL, NULL),
(39, 'VIDEO_RESOLUTIONS', '1920x1080', NULL, NULL),
(40, 'email_verify_control', '0', NULL, '2020-02-18 07:20:20'),
(41, 'is_subscription', '1', NULL, '2021-06-04 18:34:54'),
(42, 'is_spam', '1', NULL, '2018-04-05 13:51:25'),
(43, 'is_payper_view', '1', NULL, '2018-06-23 06:52:28'),
(44, 'admin_language_control', '0', '2017-11-09 07:59:34', '2017-11-09 07:59:34'),
(45, 'appstore', 'https://itunes.apple.com/us/app/streamflix/id1373623182?mt=8', NULL, '2021-04-26 23:01:34'),
(46, 'playstore', 'https://play.google.com/store/apps/details?id=com.streamhash.streamflix', NULL, '2021-04-26 23:01:34'),
(47, 'home_page_bg_image', 'http://adminview.streamhash.com/storage/uploads/settings/SV-2021-03-16-09-59-07-98ecfb70080e483ad60d8e1e59d034968279ddd0.jpg', '2017-11-09 07:59:34', '2021-03-16 09:59:07'),
(48, 'common_bg_image', 'http://adminview.streamhash.com/storage/uploads/settings/SV-2021-03-16-09-59-18-50f0748d3d379684e75f816542a4481ca9bf18ba.jpg', '2017-11-09 07:59:34', '2021-03-16 09:59:18'),
(49, 'header_scripts', '', NULL, '2021-05-24 13:52:30'),
(50, 'body_scripts', '', NULL, '2021-05-24 13:52:30'),
(51, 'ANGULAR_SITE_URL', 'http://demo.streamhash.com/', NULL, '2021-06-04 17:57:52'),
(52, 'JWPLAYER_KEY', 'M2NCefPoiiKsaVB8nTttvMBxfb1J3Xl7PDXSaw==', '2017-11-09 07:59:34', '2020-10-30 13:22:49'),
(53, 'HLS_STREAMING_URL', 'http://adminview.streamhash.com:8080/', '2017-11-09 07:59:34', '2020-08-29 20:43:07'),
(54, 'demo_admin_email', 'admin@streamview.com', '2017-11-09 07:59:34', '2017-11-09 07:59:34'),
(55, 'demo_admin_password', '123456', '2017-11-09 07:59:34', '2017-11-09 07:59:34'),
(56, 'post_max_size', '1M', NULL, '2018-06-11 07:17:09'),
(57, 'upload_max_size', '1M', NULL, '2018-06-11 07:17:09'),
(58, 'stripe_publishable_key', 'pk_test_uDYrTXzzAuGRwDYtu7dkhaF3', NULL, '2021-04-28 07:50:31'),
(59, 'stripe_secret_key', 'sk_test_lRUbYflDyRP3L2UbnsehTUHW', NULL, '2021-04-28 07:50:31'),
(60, 'video_viewer_count', '1', '2017-11-09 07:59:35', '2021-05-11 06:53:12'),
(61, 'amount_per_video', '100', '2017-11-09 07:59:35', '2021-05-11 06:53:12'),
(62, 'minimum_redeem', '1', '2017-11-09 07:59:35', '2017-11-09 07:59:35'),
(63, 'redeem_control', '1', '2017-11-09 07:59:35', '2017-11-09 07:59:35'),
(64, 'admin_commission', '90', '2017-11-09 07:59:35', '2021-05-11 06:53:12'),
(65, 'user_commission', '10', '2017-11-09 07:59:35', '2021-05-11 06:53:12'),
(66, 'facebook_link', 'https://www.facebook.com/flixzilla', NULL, '2021-06-01 10:50:16'),
(67, 'linkedin_link', 'https://www.linkedin.com/company/73810570', NULL, '2021-06-01 10:50:16'),
(68, 'twitter_link', 'https://www.twitter.com/weareflixzilla', NULL, '2021-06-01 10:50:16'),
(69, 'google_plus_link', '', NULL, '2021-06-01 10:50:16'),
(70, 'pinterest_link', '', NULL, '2021-06-01 10:50:16'),
(71, 'token_expiry_hour', '100000', NULL, '2021-06-04 18:34:59'),
(72, 'MAILGUN_PUBLIC_KEY', 'pubkey-7dc021cf4689a81a4afb340d1a055021', NULL, NULL),
(73, 'MAILGUN_PRIVATE_KEY', '', NULL, NULL),
(74, 'copyright_content', 'Copyrights 2018 . All rights reserved.', NULL, NULL),
(75, 'contact_email', '', NULL, NULL),
(76, 'contact_address', '', NULL, NULL),
(77, 'contact_mobile', '', NULL, NULL),
(78, 'RTMP_SECURE_VIDEO_URL', '', '2018-03-08 11:50:04', '2018-03-08 11:50:04'),
(79, 'HLS_SECURE_VIDEO_URL', '', '2018-03-08 11:50:04', '2018-03-08 11:50:04'),
(80, 'VIDEO_SMIL_URL', '', '2018-03-13 13:14:25', '2018-03-13 13:14:25'),
(81, 'socket_url', 'http://adminview.streamhash.com:9001/', NULL, '2020-08-29 20:43:07'),
(84, 'no_of_static_pages', '8', NULL, '2018-06-11 07:17:09'),
(85, 'custom_users_count', '45', NULL, '2019-03-05 16:58:05'),
(86, 'ios_payment_subscription_status', '0', NULL, '2019-05-20 05:48:08'),
(87, 'ffmpeg_installed', '1', NULL, '2018-07-16 09:51:51'),
(88, 'home_banner_heading', 'See what\'s next for your kids', '2018-08-04 10:10:59', '2021-04-26 01:14:20'),
(89, 'home_banner_description', 'WATCH ANYWHERE. WATCH AT ANY TIME.', '2018-08-04 10:10:59', '2021-04-26 01:14:20'),
(90, 'home_about_site', 'StreamView is programmed to start subscription based on-demand video streaming sites like Netflix and Amazon Prime. Any business idea with this core concept can be easily developed using Streamview. From admin uploading a video to users making payment to users watching the videos, it’s all automated by a dynamic and responsive admin panel with multiple monetization channels.', '2018-08-04 10:10:59', '2020-09-28 11:51:22'),
(91, 'home_cancel_content', 'If you decide Streamview isn\'t for you - no problem. No commitment. Cancel online at anytime.', '2018-08-04 10:10:59', '2020-09-28 11:51:22'),
(92, 'home_browse_desktop_image', 'http://adminview.streamhash.com/uploads/settings/SV-2020-09-05-06-01-12-5dcbe8305cffdf22a8a56559ac835f80e4e5ba3e.jpeg', '2018-08-04 10:10:59', '2020-09-05 06:01:12'),
(93, 'home_browse_tv_image', 'http://adminview.streamhash.com/uploads/settings/SV-2020-09-03-09-34-11-a929b9cf8803ca4f0c876a499141ed5e4c95ae36.png', '2018-08-04 10:10:59', '2020-09-03 09:34:11'),
(94, 'home_browse_mobile_image', 'http://adminview.streamhash.com/uploads/settings/SV-2020-09-05-05-46-59-2c2d8ec04c62b9f841c4797ad4f40a73c00e176a.jpeg', '2018-08-04 10:10:59', '2020-09-05 05:46:59'),
(95, 'home_cancel_image', 'http://adminview.streamhash.com/uploads/settings/SV-2020-09-03-09-34-11-b85285635b063de25e1a6e7df0bdea045c0981b5.png', '2018-08-04 10:10:59', '2020-09-03 09:34:11'),
(96, 'meta_title', 'Flixzilla Ver. 3.0', '2018-08-04 10:11:11', '2021-06-01 22:26:17'),
(97, 'meta_description', 'Flixzilla is a streaming service that offers a wide variety of award-winning TV shows, movies, anime, documentaries and more on thousands of internet-connected devices.', '2018-08-04 10:11:11', '2021-06-01 22:26:17'),
(98, 'meta_author', 'Flixzilla', '2018-08-04 10:11:11', '2021-06-01 22:26:17'),
(99, 'meta_keywords', 'Flixzilla', '2018-08-04 10:11:11', '2021-06-01 22:26:17'),
(100, 'ffmpeg_installed', '1', NULL, NULL),
(101, 'prefix_file_name', 'SV', NULL, NULL),
(102, 'email_notification', '1', NULL, '2021-05-24 13:52:30'),
(103, 'is_mailgun_check_email', '0', NULL, NULL),
(104, 'is_push_notification', '1', NULL, NULL),
(105, 'currency_code', 'USD', '2019-03-21 06:20:53', '2019-03-21 06:20:53'),
(106, 'max_banner_count', '6', '2019-03-21 06:20:53', '2019-03-21 06:20:53'),
(107, 'max_home_count', '6', '2019-03-21 06:20:53', '2019-03-21 06:20:53'),
(108, 'max_origianl_count', '20', '2019-03-21 06:20:53', '2019-03-21 06:20:53'),
(109, 'is_home_category_feature', '0', '2019-03-21 06:20:53', '2019-03-21 06:20:53'),
(111, 'social_email_suffix', '', NULL, '2021-05-24 13:52:30'),
(112, 'FB_CLIENT_ID', '', '2019-09-24 18:12:31', '2020-10-15 10:02:13'),
(113, 'FB_CLIENT_SECRET', '', '2019-09-24 18:12:31', '2020-10-15 10:02:13'),
(114, 'FB_CALL_BACK', '', '2019-09-24 18:12:31', '2020-10-15 10:02:13'),
(115, 'TWITTER_CLIENT_ID', '', '2019-09-24 18:12:31', '2019-09-24 18:12:31'),
(116, 'TWITTER_CLIENT_SECRET', '', '2019-09-24 18:12:31', '2019-09-24 18:12:31'),
(117, 'TWITTER_CALL_BACK', '', '2019-09-24 18:12:31', '2019-09-24 18:12:31'),
(118, 'GOOGLE_CLIENT_ID', '', '2019-09-24 18:12:31', '2020-10-15 10:02:13'),
(119, 'GOOGLE_CLIENT_SECRET', '', '2019-09-24 18:12:31', '2020-10-15 10:02:13'),
(120, 'GOOGLE_CALL_BACK', '', '2019-09-24 18:12:31', '2020-10-15 10:02:13'),
(121, 'redeem_paypal_url', 'https://www.sandbox.paypal.com/cgi-bin/webscr', NULL, '2020-02-23 19:51:13'),
(122, 'referral_earnings', '100', '2020-04-14 14:48:16', '2021-05-11 06:53:12'),
(123, 'referrer_earnings', '1', '2020-04-14 14:48:16', '2021-05-11 06:53:12'),
(124, 'download_video_expiry_days', '3', '2020-06-08 14:18:04', '2020-06-08 14:18:04'),
(125, 'is_jwplayer_configured_mobile', '0', '2020-06-08 14:18:04', '2020-06-08 14:18:04'),
(126, 'jwplayer_key_mobile', '3FqL/SpvVBWLTmzbGsWMN5QGtFxz/V+KTAH2uZpHiNZTK7G2g91lMuiGeuwcZ+fR', '2020-06-08 14:18:04', '2020-06-08 14:18:04'),
(127, 'home_banner_heading', 'See what\'s next for your kids', '2020-09-29 17:24:48', '2021-04-26 01:14:20'),
(128, 'home_banner_title', 'WATCH ANYWHERE. WATCH AT ANY TIME.', '2020-09-29 17:24:48', '2021-04-26 01:14:20'),
(129, 'home_banner_description', 'WATCH ANYWHERE. WATCH AT ANY TIME.', '2020-09-29 17:24:48', '2021-04-26 01:14:20'),
(130, 'home_section_1_title', 'Enjoy on your TV.', '2020-09-29 17:24:48', '2021-04-26 01:14:20'),
(131, 'home_section_1_description', 'Watch on smart TVs, PlayStation, Xbox, Chromecast, Apple TV, Blu-ray players', '2020-09-29 17:24:48', '2021-04-26 01:14:20'),
(132, 'home_section_1_video', 'http://adminview.streamhash.com/uploads/settings/SV-2021-04-26-01-14-20-1ae6dd5b3fcd9af0f0bf62a4e601b78b8da912d7.mp4', '2020-09-29 17:24:48', '2021-04-26 01:14:20'),
(133, 'home_section_2_title', 'Download your programs to watch offline.', '2020-09-29 17:24:48', '2021-04-26 01:14:20'),
(134, 'home_section_2_description', 'Save your favorites easily and always have something to watch.', '2020-09-29 17:24:48', '2021-04-26 01:14:20'),
(135, 'home_section_2_image', 'http://adminview.streamhash.com/storage/uploads/settings/SV-2021-02-22-13-26-28-8eee548f600f3129735cb90050e163aab3ac9559.jpg', '2020-09-29 17:24:48', '2021-02-22 13:26:28'),
(136, 'home_section_2_mob_image', 'http://adminview.streamhash.com/images/boxshot.png', '2020-09-29 17:24:48', '2020-09-29 17:24:48'),
(137, 'home_section_2_image_title', 'David Regis', '2020-09-29 17:24:48', '2021-04-26 01:14:20'),
(138, 'home_section_3_title', 'Watch everywhere.', '2020-09-29 17:24:48', '2021-04-26 01:14:20'),
(139, 'home_section_3_description', 'Stream unlimited movies and TV shows on your phone, tablet, laptop and', '2020-09-29 17:24:48', '2021-04-26 01:14:20'),
(140, 'home_section_3_video', 'http://adminview.streamhash.com/uploads/settings/SV-2021-04-26-01-11-22-3e9d9f611694bf61782acf666c0ea2ed55647082.mp4', '2020-09-29 17:24:48', '2021-04-26 01:11:24'),
(141, 'home_section_3_cover_image', 'http://adminview.streamhash.com/storage/uploads/settings/SV-2021-04-01-16-49-26-74d50f8801c9d9b5c5d574968d6975884d3e8577.png', '2021-04-01 16:38:42', '2021-04-01 16:49:26'),
(141, 'video_player_type', 2, '2021-04-01 16:38:42', '2021-04-01 16:49:26');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '5f4fccba66fbb',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `subscription_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'month,year,days',
  `plan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `total_subscription` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `popular_status` int(11) NOT NULL DEFAULT '0',
  `no_of_account` int(11) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `unique_id`, `title`, `description`, `subscription_type`, `plan`, `amount`, `total_subscription`, `status`, `popular_status`, `no_of_account`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'One-Time-Plan595cc83902372', 'Free Trial', 'For Individuals, Free Forever\n\nFirst month free\n\nWatch on your laptop, TV, phone and tablet	\n\nUnlimited films and TV programmes	', '', '1', 0.00, 0, -1, 0, 1, NULL, '2017-07-05 11:06:32', '2017-11-22 22:21:15'),
(2, 'Basic-Plan595cc85b685a6', 'Basic', 'HD available - Yes \r\n\r\nUltra HD available	 - Yes\r\n\r\nScreens you can watch on at the same time  \r\n\r\nWatch on your laptop, TV, phone and tablet	\r\n\r\nUnlimited films and TV programmes	', '', '1', 7.99, 0, -1, 0, 2, NULL, '2017-07-05 11:07:07', '2020-04-13 10:00:41'),
(3, 'STANDARD59e206d479be2', 'STANDARD', 'HD available - Yes \r\n\r\nUltra HD available	 - Yes\r\n\r\nScreens you can watch on at the same time  \r\n\r\nWatch on your laptop, TV, phone and tablet	\r\n\r\nUnlimited films and TV programmes	\r\n\r\nCancel at any time	', '', '6', 199.00, 0, -1, 0, 6, NULL, '2017-07-05 11:07:25', '2018-01-03 00:11:29'),
(4, 'PREMIUM59e2072496a3e', 'PREMIUM', 'HD available - Yes \r\n\r\nUltra HD available	 - Yes\r\n\r\nScreens you can watch on at the same time  \r\n\r\nWatch on your laptop, TV, phone and tablet	\r\n\r\nUnlimited films and TV programmes	\r\n\r\nCancel at any time	\r\n\r\nFirst month free	', '', '12', 269.00, 0, -1, 0, 6, NULL, '2017-07-07 11:12:36', '2018-03-20 05:17:07'),
(7, 'TEST5a14701bca051', 'TEST', 'test', '', '7', 12.00, 0, -1, 0, 1, NULL, '2017-11-21 18:27:39', '2017-11-21 18:29:00'),
(8, 'HDHGDHGD5a14707b72330', 'HDHGDHGD', 'ghdgdghd', '', '1', 1.00, 0, -1, 0, 1, NULL, '2017-11-21 18:29:15', '2017-11-21 18:30:47'),
(9, 'DJDJDJ5a1470e49d2c1', 'DJDJDJ', 'jjdjdj', '', '7', 7.00, 0, -1, 0, 7, NULL, '2017-11-21 18:31:00', '2017-11-21 18:31:19'),
(10, 'FREE-TRAIL5a1a80e50fab3', 'FREE TRIAL', 'FREE TRIAL', '', '1', 0.00, 0, -1, 1, 2, NULL, '2017-11-26 08:52:53', '2020-02-08 11:10:42'),
(11, '1-year5a2be8cee044e', 'All-Access Seminar video', 'Watch all 100 videos as often as you wish, make notes save favorites, etc. ', '', '12', 175.00, 0, -1, 0, 8, NULL, '2017-12-09 13:44:46', '2017-12-19 10:45:26'),
(12, 'qqqq5a38926c85d43', 'qqqq', 'qqqq', '', '12', 111.00, 0, -1, 0, 1, NULL, '2017-12-19 04:15:40', '2017-12-19 10:45:20'),
(13, 'safcA5a3ccf455487d', 'safcA', 'ASXJSAVXCJH', '', '12', 4.00, 0, -1, 0, 4, NULL, '2017-12-22 09:24:21', '2017-12-22 09:40:35'),
(14, 'mon5a49cae712cf4', 'mon', 'monthly', '', '1', 4.99, 0, -1, 0, 1, NULL, '2018-01-01 05:45:11', '2018-02-05 10:56:53'),
(15, 'Free5a4c1fb1b2397', 'Free', 'Gratis', '', '1', 0.00, 0, -1, 0, 1, NULL, '2018-01-03 00:11:29', '2018-02-06 16:43:03'),
(16, 'OTAKUZÃO5a6560cb4c23b', 'OTAKUZÃO', 'SejaumOtaku! <3', '', '12', 0.00, 0, -1, 0, 2147483647, NULL, '2018-01-22 03:55:55', '2018-02-05 10:56:45'),
(17, 'Good-friday-best-offer5ab09953e4a17', 'Good friday best offer', 'Best offer price', '', '1', 50.00, 0, -1, 0, 6, NULL, '2018-03-20 05:17:07', '2018-04-20 12:43:14'),
(18, 'Twestrad5ab62fe175a8d', 'Twestrad', 'sef', '', '1', 1.00, 0, -1, 0, 1, NULL, '2018-03-24 11:00:49', '2018-03-24 12:01:05'),
(19, 'Test5ad74561274ab', 'Test', '10', '', '1', 0.00, 0, -1, 0, 10, NULL, '2018-04-18 13:17:21', '2018-04-19 07:05:27'),
(20, 'awesome-offer5ad9d16485800', 'awesome offer', 'the best offer never ever get', '', '12', 45.00, 0, -1, 0, 89, NULL, '2018-04-20 11:39:16', '2018-04-23 13:41:57'),
(21, 'Best-offer-for-april-5ad9e06268d1b', 'Best price ', 'The best', '', '4', 10.00, 0, -1, 0, 2, NULL, '2018-04-20 12:43:14', '2018-05-09 21:00:36'),
(22, 'nnc5af58ae637694', 'nnc', 'mnmvc', '', '12', 8787.00, 0, -1, 0, 8787, NULL, '2018-05-11 12:21:58', '2018-05-11 12:22:40'),
(23, 'Premium5afd5571034b1', 'Premium', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', '', '1', 5.00, 0, -1, 0, 12, NULL, '2018-05-17 10:12:01', '2018-08-03 10:42:36'),
(24, 'Good-offer5b0274451406b', 'Good offer', 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '', '1', 20.00, 0, -1, 0, 0, NULL, '2018-05-21 07:24:53', '2018-05-21 07:46:58'),
(25, 'Premium5b0279cb0bb07', 'Premium', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English', '', '2', 50.00, 0, -1, 0, 4, NULL, '2018-05-21 07:48:27', '2018-06-01 02:09:02'),
(26, 'Best-offer5b03a62a1a3ac', 'Best offer', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', '', '2', 10.00, 0, -1, 0, 4, NULL, '2018-05-22 05:10:02', '2018-05-28 09:59:33'),
(27, 'test5b0d8520a23d6', 'test', 'hgdhdghdhg', '', '3', 5.00, 0, -1, 0, 0, NULL, '2018-05-29 16:51:44', '2018-05-29 16:53:14'),
(28, 'Best--15b0e8a03acf55', 'Best -1', 'Followers:- Search-->click on follow & username -->redirects to user single page. Once click on follow open from profile---> following-->user single page not opened. For reference:- https://prnt.sc/jgf0tc. If user needs to unblock option not dispalyed', '', '12', 0.00, 0, -1, 0, 1, NULL, '2018-05-30 11:24:51', '2018-05-30 11:43:37'),
(29, 'best-offer-2`5b0e8a2141ef1', 'best offer 2`', 'Followers:- Search-->click on follow & username -->redirects to user single page. Once click on follow open from profile---> following-->user single page not opened. For reference:- https://prnt.sc/jgf0tc. If user needs to unblock option not dispalyed', '', '1', 0.00, 0, -1, 0, 1, NULL, '2018-05-30 11:25:21', '2018-05-30 11:43:29'),
(30, 'Ramdan-offer5b0e8a39a7317', 'Ramdan offer', 'Followers:- Search-->click on follow & username -->redirects to user single page. Once click on follow open from profile---> following-->user single page not opened. For reference:- https://prnt.sc/jgf0tc. If user needs to unblock option not dispalyed', '', '5', 0.00, 0, -1, 0, 2, NULL, '2018-05-30 11:25:45', '2018-05-30 11:43:23'),
(31, 'Standard--new5b2be2c67edfc', 'Standard -new', 'SStandard -new', '', '1', 1.00, 0, -1, 0, 1, NULL, '2018-06-21 17:39:18', '2018-07-04 05:06:59'),
(32, 'teste5b69ac887de9e', 'Premium', 'Premium', '', '3', 99.00, 0, -1, 1, 2, NULL, '2018-08-07 14:28:24', '2020-01-25 21:51:41'),
(33, 'Vida5b6d197170872', 'DELUXE PLAN', 'DELUXE PLAN', '', '6', 199.00, 0, -1, 0, 3, NULL, '2018-08-10 04:49:53', '2018-12-11 05:46:57'),
(34, 'Egdhdh5b6d199e12073', 'Ultra Deluxe', 'Ultra Deluxe', '', '12', 399.00, 0, -1, 0, 10, NULL, '2018-08-10 04:50:38', '2018-12-11 05:46:45'),
(35, 'Test-Title-0015bd6cd27bf7eb', 'Test Title 001', 'Lorem Ipsum', '', '3', -1.00, 0, -1, 0, 2, NULL, '2018-10-29 09:04:39', '2018-10-29 09:16:03'),
(36, 'Test-Title-0025bd6cdae0d15a', 'Test Title 002', 'Lorem Ipsum', '', '3', 12.00, 0, -1, 0, 3, NULL, '2018-10-29 09:06:54', '2018-12-11 05:45:05'),
(37, 'Plan-Mensual5c15a0bfe422b', 'Plan Mensual', 'Plan mensual', '', '1', 5.00, 0, -1, 0, 1, NULL, '2018-12-16 00:47:59', '2018-12-19 08:55:09'),
(38, 'Subscription-4795c936ea532923', 'Subscription 479', 'None', '', '10', 75.00, 0, -1, 0, 10, NULL, '2019-03-21 10:59:49', '2019-03-21 11:00:22'),
(39, 'Subscription-4095c936efe3c002', 'Subscription 409', 'None', '', '10', 75.00, 0, -1, 0, 10, NULL, '2019-03-21 11:01:18', '2019-03-25 13:15:17'),
(40, 'Subscribe5c98d47eddcb1', 'Subscribe', 'SubscribeSubscribeSubscribeSubscribeSubscribeSubscribeSubscribeSubscribeSubscribeSubscribeSubscribeSubscribeSubscribeSubscribeSubscribeSubscribeSubscribeSubscribeSubscribeSubscribeSubscribeSubscribeSubscribeSubscribeSubscribeSubscribeSubscribe', '', '12', 33.00, 0, -1, 0, 3, NULL, '2019-03-25 13:15:42', '2019-03-25 13:16:57'),
(41, 'helllo5c9a7925d8cb5', 'helllo', 'helllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllohelllo', '', '3', 0.00, 0, -1, 0, 3, NULL, '2019-03-26 19:10:29', '2019-03-26 19:10:47'),
(42, 'Samplee5c9c95733505c', 'Samplee', 'Samplee', '', '3', 12.09, 0, -1, 0, 2, NULL, '2019-03-28 09:35:47', '2019-03-28 09:35:54'),
(43, 'SSMSM5c9c95c648142', 'SSMSM', 'SMMSSM', '', '1', 23.00, 0, -1, 0, 2, NULL, '2019-03-28 09:37:10', '2019-03-28 09:37:16'),
(44, 'Go-Premium5d6675b0df69e', 'Go Premium', 'Subscribe for 6 months at a lower cost', '', '6', 3.99, 0, -1, 0, 2, NULL, '2019-08-28 12:38:08', '2019-09-12 07:02:33'),
(45, 'Zebi-bjo5d692f64a54fa', 'Zebi bjo', 'Test zebi', '', '3', 0.10, 0, -1, 0, 1, NULL, '2019-08-30 14:15:00', '2019-09-12 07:02:21'),
(46, 'Summer-Campaign5d8a423b2f47a', 'Summer Campaign', 'Limited time only Summer Campaign.', '', '1', 3.99, 0, -1, 1, 1, NULL, '2019-09-24 16:20:11', '2019-10-10 05:37:07'),
(47, 'Full5de8784c9f484', 'Full', 'Full with 4 dispositives', '', '1', 39.90, 0, -1, 0, 4, NULL, '2019-12-05 03:23:56', '2019-12-10 05:53:17'),
(48, 'Premium5e32752e7e772', 'Premium', 'Premium Plan', '', '12', 50.00, 0, -1, 1, 12, NULL, '2020-01-30 06:18:22', '2020-05-30 17:11:47'),
(49, '6-Months5e33496cc80a7', 'Free With base', 'Free With base', '', '6', 20.00, 0, -1, 0, 4, NULL, '2020-01-30 21:23:56', '2020-04-02 04:53:36'),
(50, 'fdgfdg5e566be0c5114', 'fdgfdg', 'fdhgh', '', '2', 10.00, 0, -1, 0, 2, NULL, '2020-02-26 13:00:16', '2020-02-26 13:03:48'),
(51, 'fgfdgg5e566ccb651c7', 'fgfdgg', 'sdfsdf', '', '2', 10.00, 0, -1, 0, 2, NULL, '2020-02-26 13:04:11', '2020-02-26 13:07:03'),
(52, 'fgfdgg5e566d9aa28ac', 'fgfdgg', 'fgfdgg', '', '2', 1.00, 0, -1, 0, 2, NULL, '2020-02-26 13:07:38', '2020-04-02 04:50:16'),
(53, 'Free5e6eaef6f3975', 'Free', 'Free', '', '1', 0.00, 0, -1, 1, 1, NULL, '2020-03-15 22:40:54', '2020-05-30 16:54:25'),
(54, '1235e7ccdaaa42f6', '123', '321', '', '1', 5.00, 0, -1, 0, 1, NULL, '2020-03-26 15:43:38', '2020-04-02 04:42:52'),
(55, 'fulll5eba56162bcfe', 'Premium', 'vj..b.bnjlk', '', '12', 45.00, 0, -1, 1, 2, NULL, '2020-05-12 07:53:58', '2020-05-31 20:27:11'),
(56, 'Free5ed4a67c03ef0', 'Free', 'free', '', '1', 0.00, 0, -1, 0, 2, NULL, '2020-06-01 06:55:56', '2020-06-01 07:13:30'),
(57, 'FREE-PLAN5ed4cbaa740bc', 'Basic Plan', 'Best basic plan', '', '3', 4.00, 0, -1, 0, 1, NULL, '2020-06-01 09:34:34', '2021-05-29 07:05:02'),
(58, 'BASIC-PLAN5ed4cbc39652d', 'Standard Plan', 'Best Standard Plan', '', '6', 15.00, 0, -1, 0, 3, NULL, '2020-06-01 09:34:59', '2021-05-29 07:04:43'),
(59, 'Premium-Plan5ed4cbd9162a7', 'Premium Plan', 'Premium Plan', '', '12', 50.00, 0, -1, 0, 4, NULL, '2020-06-01 09:35:21', '2021-05-29 07:04:49'),
(60, 'Premiuim-plan5ede60aedeacb', 'Premiuim plan', 'tehfjre', '', '12', 450.00, 0, -1, 0, 4, NULL, '2020-06-08 16:00:46', '2020-10-12 05:08:46'),
(61, 'test5ee0ab71422df', 'test', 'test', '', '1', 1.00, 0, -1, 0, 1, NULL, '2020-06-10 09:44:17', '2020-10-12 05:08:36'),
(62, 'new5ef71c253340c', 'Free Plan', 'Grab this plan for your best Movies to Watch.', '', '1', 0.00, 0, 1, 0, 2, NULL, '2020-06-27 10:15:01', '2021-05-31 05:22:46'),
(63, 'Raghavendra5ef9edb481869', 'Raghavendra', 'TEST', '', '1', 0.00, 0, -1, 0, 1, NULL, '2020-06-29 13:33:40', '2020-10-12 05:02:16'),
(64, 'Good5efd60c31df2a', 'Good', 'Aniem acc', '', '12', 20.00, 0, -1, 0, 1, NULL, '2020-07-02 04:21:23', '2020-10-12 05:01:16'),
(65, 'Shankara5efdbdc489fa4', 'Shankara', 'test', '', '5', 1000.00, 0, -1, 0, 1, NULL, '2020-07-02 10:58:12', '2020-10-12 05:01:07'),
(66, 'PERSONAL5f05995825cb4', 'PERSONAL', '1 peli', '', '1', 90.00, 0, -1, 0, 1, NULL, '2020-07-08 10:00:56', '2020-10-12 05:00:56'),
(67, 'Mouna-Ragam-15f0f093da7380', 'Mouna Ragam 1', 'mouna ragam paied', '', '3', 300.00, 0, -1, 0, 1, NULL, '2020-07-15 13:48:45', '2020-10-12 05:00:05'),
(68, 'Premium5f32cc6ea1994', 'Premium', 'De', '', '1', 12.00, 0, -1, 0, 11, NULL, '2020-08-11 16:50:54', '2020-10-12 05:08:24'),
(69, 'FREE-SUB5f46ca9d5d259', 'FREE SUB', 'Desc Here', '', '12', 0.00, 0, -1, 0, 3, NULL, '2020-08-26 20:48:29', '2020-10-12 05:01:54'),
(70, 'Teste5f47e2f710bad', 'Teste', 'Teste', '', '1', 0.99, 0, -1, 0, 1, NULL, '2020-08-27 16:44:39', '2020-10-12 05:02:08'),
(71, 'SAN5f508dbe9e3c8', 'SAN', '123456', '', '1', 10.00, 0, -1, 0, 5, NULL, '2020-09-03 06:31:26', '2020-10-12 05:01:46'),
(72, 'Festive-offer-20205f50b28cf2bca', 'Festive offer 2020', '#corona_days', '', '2', 10.00, 0, -1, 0, 2, NULL, '2020-09-03 09:08:28', '2020-10-12 05:01:39'),
(73, 'Annual-Subscription5f5ffc7c192bf', 'Annual Subscription', 'Get access to all our movies for 12 months', '', '12', 48.00, 0, -1, 0, 2, NULL, '2020-09-14 23:27:56', '2020-10-12 05:08:19'),
(74, 'AccountTest5f6877915fb5f', 'AccountTest', 'Testing', '', '12', 100.00, 0, -1, 0, 1, NULL, '2020-09-21 09:51:13', '2020-10-12 05:01:30'),
(75, 'PriyaRaghav5f69d5df1e988', 'PriyaRaghav', 'Three months plan', '', '3', 100.00, 0, -1, 0, 1, NULL, '2020-09-22 10:45:51', '2020-10-12 05:01:24'),
(76, 'FREE5f6ed8b1bdfd2', 'FREE', 'Test', '', '2', 0.00, 0, -1, 1, 1000, NULL, '2020-09-26 05:59:13', '2020-10-12 05:02:49'),
(77, 'Universal5f848e25c1f3d', 'Universal', 'Allow complete access', '', '12', 199.00, 0, -1, 0, 1, NULL, '2020-10-12 17:11:01', '2021-02-20 14:39:56'),
(78, 'BP5f86f7c547e2a', 'BP', 'mov from BP', '', '1', 0.00, 0, -1, 0, 1, NULL, '2020-10-14 13:06:13', '2020-10-15 04:59:47'),
(79, 'PLANO-IPTV-30-DIAS5f87a177deffe', 'PLANO IPTV 30 DIAS', 'Plano Iptv Todos os canais', '', '1', 35.00, 0, -1, 0, 1, NULL, '2020-10-15 01:10:15', '2020-10-15 04:59:14'),
(80, 'SUBS15fa0d3a5b2238', 'SUBS1', 'SuBS-1', '', '3', 100.00, 0, -1, 0, 10, NULL, '2020-11-03 03:51:01', '2020-11-04 16:07:14'),
(81, 'Test-1K5fada2ab6b34e', 'Test 1K', 'Test $1K', '', '1', 1000.00, 0, -1, 1, 2, NULL, '2020-11-12 21:01:31', '2020-11-16 04:44:47'),
(82, '99-Cents5faf1a42503e8', '99 Cents', '99 cents per month', '', '1', 0.99, 0, -1, 1, 3, NULL, '2020-11-13 23:44:02', '2020-11-16 04:44:37'),
(83, 'BASIC5fcf4541da7bd', 'BASIC', 'test,..', '', '1', 4.00, 0, -1, 0, 3, NULL, '2020-12-08 09:20:01', '2020-12-13 20:01:25'),
(84, 'Ultimate5fd67260edb38', 'Ultimate', 'All access to exclusive PPV content', '', '12', 55.99, 0, -1, 0, 5, NULL, '2020-12-13 19:58:24', '2021-01-19 05:46:27'),
(85, 'Ultra5ff30fbae16a0', 'Ultra', 'MAX', '', '1', 50.00, 0, -1, 0, 1, NULL, '2021-01-04 12:53:14', '2021-01-19 05:46:17'),
(86, 'Jonu5ffeeb904edda', 'Jonu', 'good', '', '1', 20.00, 0, -1, 0, 1, NULL, '2021-01-13 12:46:08', '2021-01-19 05:46:10'),
(87, 'PREMIUM600c1ee69500a', 'PREMIUM', 'TEST PREMIUM', '', '1', 30.00, 0, -1, 1, 1, NULL, '2021-01-23 13:04:38', '2021-01-25 07:01:17'),
(88, 'standard600edc52bbf99', 'standard', 'test1', '', '6', 2000.00, 0, -1, 0, 2, NULL, '2021-01-25 14:57:22', '2021-01-27 05:39:52'),
(89, 'Test-016011877728e66', 'Test 01', 'Test 01', '', '1', 6.99, 0, -1, 0, 1, NULL, '2021-01-27 15:32:07', '2021-02-01 08:02:34'),
(90, 'prova60144b58d186e', 'prova', 'prova', '', '1', 5.99, 0, -1, 1, 3, NULL, '2021-01-29 17:52:24', '2021-02-01 08:02:20'),
(91, 'Koko-De-Mer601779459199b', 'Koko De Mer', '2 months', '', '3', 599.00, 0, -1, 0, 2, NULL, '2021-02-01 03:45:09', '2021-02-01 08:02:26'),
(92, 'Free-subscription6017b56d32eba', 'Free subscription', 'ghhjg', '', '1', 10.00, 0, -1, 0, 2, NULL, '2021-02-01 08:01:49', '2021-02-01 08:03:05'),
(93, 'Free6017e230b7571', 'Free', 'free', '', '12', 500.00, 0, -1, 0, 4, NULL, '2021-02-01 11:12:48', '2021-02-09 05:54:41'),
(94, '1-day60311f290502d', '1-day', '24 hr', '', '1', 0.00, 0, -1, 0, 1, NULL, '2021-02-20 14:39:37', '2021-02-22 13:25:14'),
(95, 'Monthly6033849a22b6d', 'Monthly', 'Monthly Subscription', '', '1', 100.00, 0, -1, 0, 1, NULL, '2021-02-22 10:16:58', '2021-02-22 13:25:05'),
(96, 'm-------------------------------------------------------------------------------m603a2047e6cb9', 'Moni', 'testtcfchgfhgfvh', '', '3', 34.00, 0, -1, 0, 4, NULL, '2021-02-27 10:34:47', '2021-03-01 07:46:05'),
(97, 'Sonuuuu603a21cfb311f', 'Sonuuuu', 'saytewtyuhjyufcyucdyujgygcydgyhc', '', '6', 999999.99, 0, -1, 0, 2324, NULL, '2021-02-27 10:41:19', '2021-03-01 07:45:37'),
(98, 'video605081418d079', 'video', 'good', '', '6', 200.00, 0, -1, 0, 4, NULL, '2021-03-16 09:58:25', '2021-03-17 05:45:31'),
(99, 'movie6051dc37d1a87', 'movie', 'not bad', '', '6', 4.00, 0, -1, 0, 3, NULL, '2021-03-17 10:38:47', '2021-05-29 07:04:56'),
(100, 'heftueg6082b06e15291', 'heftueg', 'gfkdtyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyydddddddddfthcdykrsryilfyierygdyrgbeftr68ygtr68fyrtgfyioriaetttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttteooooonfmmmmmmmmmmmmmmmmmmmmmmmmgfdchjbfdsglyirsdghbrhfidstygrfbhdsgiyrifdsgyhbrfdsiytiefhdsbhfryeiedghbhgrytirgfdhhhdyifterfdhcbjhfiytirfdjkjiuysrgfdhbjfgiyregdfkfiudygiiygiygigyreigshylyireygryghergyuedysguhbrjdsgyhbrfidguhgrueiyghberyifdhriyufhreilufdjysirhfjruidfhdrgfbfrgfdsbirfsduikjkrugdfbkreuigfdugrfdbiddguidsfuiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiig;jk;rseeeeeeeeeessssssssssssssssssssk\r\ngfkdtyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyydddddddddfthcdykrsryilfyierygdyrgbeftr68ygtr68fyrtgfyioriaetttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttteooooonfmmmmmmmmmmmmmmmmmmmmmmmmgfdchjbfdsglyirsdghbrhfidstygrfbhdsgiyrifdsgyhbrfdsiytiefhdsbhfryeiedghbhgrytirgfdhhhdyifterfdhcbjhfiytirfdjkjiuysrgfdhbjfgiyregdfkfiudygiiygiygigyreigshylyireygryghergyuedysguhbrjdsgyhbrfidguhgrueiyghberyifdhriyufhreilufdjysirhfjruidfhdrgfbfrgfdsbirfsduikjkrugdfbkreuigfdugrfdbiddguidsfuiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiig;jk;rseeeeeeeeeesssssssssssssssssssskgfkdtyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyydddddddddfthcdykrsryilfyierygdyrgbeftr68ygtr68fyrtgfyioriaetttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttteooooonfmmmmmmmmmmmmmmmmmmmmmmmmgfdchjbfdsglyirsdghbrhfidstygrfbhdsgiyrifdsgyhbrfdsiytiefhdsbhfryeiedghbhgrytirgfdhhhdyifterfdhcbjhfiytirfdjkjiuysrgfdhbjfgiyregdfkfiudygiiygiygigyreigshylyireygryghergyuedysguhbrjdsgyhbrfidguhgrueiyghberyifdhriyufhreilufdjysirhfjruidfhdrgfbfrgfdsbirfsduikjkrugdfbkreuigfdugrfdbiddguidsfuiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiig;jk;rseeeeeeeeeesssssssssssssssssssskgfkdtyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyydddddddddfthcdykrsryilfyierygdyrgbeftr68ygtr68fyrtgfyioriaetttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttteooooonfmmmmmmmmmmmmmmmmmmmmmmmmgfdchjbfdsglyirsdghbrhfidstygrfbhdsgiyrifdsgyhbrfdsiytiefhdsbhfryeiedghbhgrytirgfdhhhdyifterfdhcbjhfiytirfdjkjiuysrgfdhbjfgiyregdfkfiudygiiygiygigyreigshylyireygryghergyuedysguhbrjdsgyhbrfidguhgrueiyghberyifdhriyufhreilufdjysirhfjruidfhdrgfbfrgfdsbirfsduikjkrugdfbkreuigfdugrfdbiddguidsfuiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiig;jk;rseeeeeeeeeesssssssssssssssssssskgfkdtyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyydddddddddfthcdykrsryilfyierygdyrgbeftr68ygtr68fyrtgfyioriaetttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttteooooonfmmmmmmmmmmmmmmmmmmmmmmmmgfdchjbfdsglyirsdghbrhfidstygrfbhdsgiyrifdsgyhbrfdsiytiefhdsbhfryeiedghbhgrytirgfdhhhdyifterfdhcbjhfiytirfdjkjiuysrgfdhbjfgiyregdfkfiudygiiygiygigyreigshylyireygryghergyuedysguhbrjdsgyhbrfidguhgrueiyghberyifdhriyufhreilufdjysirhfjruidfhdrgfbfrgfdsbirfsduikjkrugdfbkreuigfdugrfdbiddguidsfuiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiig;jk;rseeeeeeeeeesssssssssssssssssssskgfkdtyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyydddddddddfthcdykrsryilfyierygdyrgbeftr68ygtr68fyrtgfyioriaetttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttteooooonfmmmmmmmmmmmmmmmmmmmmmmmmgfdchjbfdsglyirsdghbrhfidstygrfbhdsgiyrifdsgyhbrfdsiytiefhdsbhfryeiedghbhgrytirgfdhhhdyifterfdhcbjhfiytirfdjkjiuysrgfdhbjfgiyregdfkfiudygiiygiygigyreigshylyireygryghergyuedysguhbrjdsgyhbrfidguhgrueiyghberyifdhriyufhreilufdjysirhfjruidfhdrgfbfrgfdsbirfsduikjkrugdfbkreuigfdugrfdbiddguidsfuiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiig;jk;rseeeeeeeeeesssssssssssssssssssskgfkdtyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyydddddddddfthcdykrsryilfyierygdyrgbeftr68ygtr68fyrtgfyioriaetttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttteooooonfmmmmmmmmmmmmmmmmmmmmmmmmgfdchjbfdsglyirsdghbrhfidstygrfbhdsgiyrifdsgyhbrfdsiytiefhdsbhfryeiedghbhgrytirgfdhhhdyifterfdhcbjhfiytirfdjkjiuysrgfdhbjfgiyregdfkfiudygiiygiygigyreigshylyireygryghergyuedysguhbrjdsgyhbrfidguhgrueiyghberyifdhriyufhreilufdjysirhfjruidfhdrgfbfrgfdsbirfsduikjkrugdfbkreuigfdugrfdbiddguidsfuiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiig;jk;rseeeeeeeeeesssssssssssssssssssskgfkdtyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyydddddddddfthcdykrsryilfyierygdyrgbeftr68ygtr68fyrtgfyioriaetttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttteooooonfmmmmmmmmmmmmmmmmmmmmmmmmgfdchjbfdsglyirsdghbrhfidstygrfbhdsgiyrifdsgyhbrfdsiytiefhdsbhfryeiedghbhgrytirgfdhhhdyifterfdhcbjhfiytirfdjkjiuysrgfdhbjfgiyregdfkfiudygiiygiygigyreigshylyireygryghergyuedysguhbrjdsgyhbrfidguhgrueiyghberyifdhriyufhreilufdjysirhfjruidfhdrgfbfrgfdsbirfsduikjkrugdfbkreuigfdugrfdbiddguidsfuiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiig;jk;rseeeeeeeeeesssssssssssssssssssskgfkdtyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyydddddddddfthcdykrsryilfyierygdyrgbeftr68ygtr68fyrtgfyioriaetttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttteooooonfmmmmmmmmmmmmmmmmmmmmmmmmgfdchjbfdsglyirsdghbrhfidstygrfbhdsgiyrifdsgyhbrfdsiytiefhdsbhfryeiedghbhgrytirgfdhhhdyifterfdhcbjhfiytirfdjkjiuysrgfdhbjfgiyregdfkfiudygiiygiygigyreigshylyireygryghergyuedysguhbrjdsgyhbrfidguhgrueiyghberyifdhriyufhreilufdjysirhfjruidfhdrgfbfrgfdsbirfsduikjkrugdfbkreuigfdugrfdbiddguidsfuiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiig;jk;rseeeeeeeeeesssssssssssssssssssskgfkdtyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyydddddddddfthcdykrsryilfyierygdyrgbeftr68ygtr68fyrtgfyioriaetttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttteooooonfmmmmmmmmmmmmmmmmmmmmmmmmgfdchjbfdsglyirsdghbrhfidstygrfbhdsgiyrifdsgyhbrfdsiytiefhdsbhfryeiedghbhgrytirgfdhhhdyifterfdhcbjhfiytirfdjkjiuysrgfdhbjfgiyregdfkfiudygiiygiygigyreigshylyireygryghergyuedysguhbrjdsgyhbrfidguhgrueiyghberyifdhriyufhreilufdjysirhfjruidfhdrgfbfrgfdsbirfsduikjkrugdfbkreuigfdugrfdbiddguidsfuiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiig;jk;rseeeeeeeeeesssssssssssssssssssskgfkdtyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyydddddddddfthcdykrsryilfyierygdyrgbeftr68ygtr68fyrtgfyioriaetttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttteooooonfmmmmmmmmmmmmmmmmmmmmmmmmgfdchjbfdsglyirsdghbrhfidstygrfbhdsgiyrifdsgyhbrfdsiytiefhdsbhfryeiedghbhgrytirgfdhhhdyifterfdhcbjhfiytirfdjkjiuysrgfdhbjfgiyregdfkfiudygiiygiygigyreigshylyireygryghergyuedysguhbrjdsgyhbrfidguhgrueiyghberyifdhriyufhreilufdjysirhfjruidfhdrgfbfrgfdsbirfsduikjkrugdfbkreuigfdugrfdbiddguidsfuiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiig;jk;rseeeeeeeeeesssssssssssssssssssskgfkdtyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyydddddddddfthcdykrsryilfyierygdyrgbeftr68ygtr68fyrtgfyioriaetttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttteooooonfmmmmmmmmmmmmmmmmmmmmmmmmgfdchjbfdsglyirsdghbrhfidstygrfbhdsgiyrifdsgyhbrfdsiytiefhdsbhfryeiedghbhgrytirgfdhhhdyifterfdhcbjhfiytirfdjkjiuysrgfdhbjfgiyregdfkfiudygiiygiygigyreigshylyireygryghergyuedysguhbrjdsgyhbrfidguhgrueiyghberyifdhriyufhreilufdjysirhfjruidfhdrgfbfrgfdsbirfsduikjkrugdfbkreuigfdugrfdbiddguidsfuiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiig;jk;rseeeeeeeeeessssssssssssssssssssk', '', '1', 520.00, 0, -1, 0, 5, NULL, '2021-04-23 11:33:02', '2021-04-23 11:33:14'),
(101, 'Free6088d0b58b212', 'Free', 'Free Subscription', '', '1', 0.00, 0, -1, 0, 1, NULL, '2021-04-28 03:04:21', '2021-04-28 03:05:38'),
(102, 'nature-movie609a222c6f358', 'nature movie', 'good capture', '', '3', 0.00, 0, -1, 0, 3, NULL, '2021-05-11 06:20:28', '2021-05-11 23:44:07'),
(103, 'nature-moviee22609a22629e78d', 'nature moviee22', 'good thing', '', '4', 50.00, 0, -1, 0, 4, NULL, '2021-05-11 06:21:22', '2021-05-11 23:44:01'),
(104, 'Pro60b2fbe3d41a0', 'Premium Plan', 'Premium Plan\r\n\r\nEnjoy Unlimited Videos for 1 year', '', '12', 69.99, 0, 1, 0, 6, NULL, '2021-05-30 02:43:47', '2021-06-05 12:51:15'),
(105, 'Sponsor60b2fc21e63f6', 'BASIC PLAN', 'BASIC PLAN: \r\n\r\nEnjoy Unlimited Videos for 6months..', '', '6', 39.99, 0, 1, 1, 3, NULL, '2021-05-30 02:44:49', '2021-06-05 12:52:15');

-- --------------------------------------------------------

--
-- Table structure for table `sub_admins`
--

CREATE TABLE `sub_admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `gender` enum('male','female','others') COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paypal_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token_expiry` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timezone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `is_home_display` int(11) NOT NULL DEFAULT '0',
  `is_approved` int(11) NOT NULL DEFAULT '1',
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `name`, `description`, `status`, `is_home_display`, `is_approved`, `created_by`, `created_at`, `updated_at`) VALUES
(202, 177, '365 Days', 'Massimo is a member of the Sicilian Mafia family and Laura is a sales director. She does not expect that on a trip to Sicily trying to save her relationship, Massimo will kidnap her and give her 365 days to fall in love with him.', '1', 0, 0, 'admin', '2020-09-23 10:10:40', '2021-06-04 18:00:06'),
(203, 177, 'Titanic (1997)', 'A seventeen-year-old aristocrat falls in love with a kind but poor artist aboard the luxurious, ill-fated R.M.S. Titanic.', '1', 0, 0, 'admin', '2020-09-23 10:21:27', '2021-06-04 18:00:06'),
(204, 177, 'Palm Springs', 'When carefree Nyles and reluctant maid of honor Sarah have a chance encounter at a Palm Springs wedding, things get complicated as they are unable to escape the venue, themselves, or each other.', '1', 0, 0, 'admin', '2020-09-23 10:29:29', '2021-06-04 18:00:06'),
(205, 177, 'Forrest Gump', 'The presidencies of Kennedy and Johnson, the events of Vietnam, Watergate and other historical events unfold through the perspective of an Alabama man with an IQ of 75, whose only desire is to be reunited with his childhood sweetheart.', '1', 0, 0, 'admin', '2020-09-23 10:37:47', '2021-06-04 18:00:06'),
(206, 177, 'Beauty and the Beast', 'A selfish Prince is cursed to become a monster for the rest of his life, unless he learns to fall in love with a beautiful young woman he keeps prisoner.', '1', 0, 0, 'admin', '2020-09-23 10:47:35', '2021-06-04 18:00:06'),
(207, 178, 'Interstellar', 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity\'s survival.', '1', 0, 0, 'admin', '2020-09-23 12:03:05', '2021-06-04 18:00:11'),
(208, 178, 'Dune', 'Feature adaptation of Frank Herbert\'s science fiction novel, about the son of a noble family entrusted with the protection of the most valuable asset and most vital element in the galaxy.', '1', 0, 0, 'admin', '2020-09-23 12:12:49', '2021-06-04 18:00:11'),
(209, 178, 'The Prestige', 'After a tragic accident, two stage magicians engage in a battle to create the ultimate illusion while sacrificing everything they have to outwit each other.', '1', 0, 0, 'admin', '2020-09-23 12:20:08', '2021-06-04 18:00:11'),
(210, 178, 'The Matrix', 'A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.', '1', 0, 0, 'admin', '2020-09-23 12:34:54', '2021-06-04 18:00:11'),
(211, 178, 'The Invisible Man (2020)', 'When Cecilia\'s abusive ex takes his own life and leaves her his fortune, she suspects his death was a hoax. As a series of coincidences turn lethal, Cecilia works to prove that she is being hunted by someone nobody can see.', '1', 0, 0, 'admin', '2020-09-23 12:40:47', '2021-06-04 18:00:11'),
(243, 176, 'Click', 'A married workaholic, Michael Newman doesn\'t have time for his wife and children, not if he\'s to impress his ungrateful boss and earn a well-deserved promotion. So when he meets Morty, a loopy sales clerk, he gets the answer to his prayers: a magical remo', '1', 0, 0, 'admin', '2021-04-23 08:00:26', '2021-06-04 18:00:31'),
(244, 184, 'Raya and the Last Dragon', 'Long ago, in the fantasy world of Kumandra, humans and dragons lived together in harmony. But when an evil force threatened the land, the dragons sacrificed themselves to save humanity. Now, 500 years later, that same evil has returned and it’s up to a lo', '1', 0, 0, 'admin', '2021-04-23 08:15:19', '2021-06-04 17:59:48'),
(245, 176, 'Superhero Movie', 'The team behind Scary Movie takes on the comic book genre in this tale of Rick Riker, a nerdy teen imbued with superpowers by a radioactive dragonfly. And because every hero needs a nemesis, enter Lou Landers, aka the villainously goofy Hourglass.', '1', 0, 0, 'admin', '2021-04-23 10:09:26', '2021-06-04 18:00:31'),
(246, 177, 'A Recipe for Seduction', 'As the holidays draw near, a young heiress contends with the affections of a suitor handpicked by her mother. When the handsome chef, Harland Sanders, arrives with his secret fried chicken recipe and a dream, he sets in motion a series of events that unra', '1', 0, 0, 'admin', '2021-04-23 12:01:54', '2021-06-04 18:00:06'),
(247, 176, 'Scary Movie 4', 'Cindy finds out the house she lives in is haunted by a little boy and goes on a quest to find out who killed him and why. Also, Alien "Tr-iPods" are invading the world and she has to uncover the secret in order to stop them.', '1', 0, 0, 'admin', '2021-04-23 12:22:34', '2021-06-04 18:00:31'),
(248, 176, 'The Man Who Knew Too Little', 'An American gets a ticket for an audience participation game in London, then gets involved in a case of mistaken identity. As an international plot unravels around him, he thinks it\'s all part of the act.', '1', 0, 0, 'admin', '2021-04-23 14:33:53', '2021-06-04 18:00:31'),
(249, 177, 'The Map Of Tiny Perfect Things', 'The film tells the story of quick-witted teen Mark, contentedly living the same day in an endless loop whose world is turned upside-down when he meets mysterious Margaret also stuck in the time loop. Mark and Margaret form a magnetic partnership, setting ', '1', 0, 0, 'admin', '2021-04-23 20:49:04', '2021-06-04 18:00:06'),
(250, 178, 'Godzilla vs. Kong', 'In a time when monsters walk the Earth, humanity’s fight for its future sets Godzilla and Kong on a collision course that will see the two most powerful forces of nature on the planet collide in a spectacular battle for the ages.', '1', 0, 0, 'admin', '2021-04-23 21:25:31', '2021-06-04 18:00:11'),
(251, 184, 'Barnyard', 'Passeggiate nei boschi', '1', 0, 0, 'admin', '2021-04-23 21:39:03', '2021-06-04 17:59:48'),
(252, 176, 'Bedazzled', 'Elliot Richardson, a suicidal techno geek, is given seven wishes to turn his life around when he meets a very seductive Satan. The catch: his soul. Some of his wishes include a 7 foot basketball star, a rock star, and a hamburger. But, as could be expecte', '1', 0, 0, 'admin', '2021-04-23 21:53:00', '2021-06-04 18:00:31'),
(256, 176, 'Action Point', 'A daredevil designs and operates his own theme park with his friends.', '1', 0, 0, 'admin', '2021-04-24 06:17:33', '2021-06-04 18:00:31'),
(257, 176, 'An American Pickle', 'An immigrant worker at a pickle factory is accidentally preserved for 100 years and wakes up in modern day Brooklyn. He learns his only surviving relative is his great grandson, a computer coder who he can’t connect with.', '1', 0, 0, 'admin', '2021-04-24 22:21:47', '2021-06-04 18:00:31'),
(258, 176, 'Hercules in New York', 'Hercules has grown tired of his life on Mount Olympus, and wishes to visit Earth. His father Zeus forbids such a voyage, but a misdirected thunderbolt sends Hercules tumbling down the mountain and into New York City, where he\'s befriended by Pretzie, who ', '1', 0, 0, 'admin', '2021-04-25 01:13:19', '2021-06-04 18:00:31'),
(260, 221, 'Bohemian Rhapsody', 'Singer Freddie Mercury, guitarist Brian May, drummer Roger Taylor and bass guitarist John Deacon take the music world by storm when they form the rock \'n\' roll band Queen in 1970. Hit songs become instant classics. When Mercury\'s increasingly wild lifesty', '1', 0, 0, 'admin', '2021-04-25 01:43:32', '2021-06-04 18:00:57'),
(261, 184, 'Soul', 'Joe Gardner is a middle school teacher with a love for jazz music. After a successful gig at the Half Note Club, he suddenly gets into an accident that separates his soul from his body and is transported to the You Seminar, a center in which souls develop', '1', 0, 0, 'admin', '2021-04-25 02:04:03', '2021-06-04 17:59:48'),
(262, 184, 'Onward', 'In a suburban fantasy world, two teenage elf brothers embark on an extraordinary quest to discover if there is still a little magic left out there.', '1', 0, 0, 'admin', '2021-04-25 02:10:44', '2021-06-04 17:59:48'),
(263, 172, 'Mortal Kombat', 'Washed-up MMA fighter Cole Young, unaware of his heritage, and hunted by Emperor Shang Tsung\'s best warrior, Sub-Zero, seeks out and trains with Earth\'s greatest champions as he prepares to stand against the enemies of Outworld in a high stakes battle for', '1', 0, 0, 'admin', '2021-04-25 02:39:11', '2021-06-04 18:00:27'),
(264, 184, 'Phineas and Ferb the Movie: Candace Against the Universe', 'Phineas and Ferb travel across the galaxy to rescue their older sister Candace, who has been abducted by aliens and taken to a utopia in a far-off planet, free of her pesky little brothers.', '1', 0, 0, 'admin', '2021-04-25 07:28:22', '2021-06-04 17:59:48'),
(265, 184, 'Secret Magic Control Agency', 'The Secret Magic Control Agency sends its two best agents, Hansel and Gretel, to fight against the witch of the Gingerbread House.', '1', 0, 0, 'admin', '2021-04-25 07:34:34', '2021-06-04 17:59:48'),
(266, 176, 'Tom and Jerry', 'Tom the cat and Jerry the mouse get kicked out of their home and relocate to a fancy New York hotel, where a scrappy employee named Kayla will lose her job if she can’t evict Jerry before a high-class wedding at the hotel. Her solution? Hiring Tom to get ', '1', 0, 0, 'admin', '2021-04-25 07:38:49', '2021-06-04 18:00:31'),
(267, 172, 'Sonic the Hedgehog', 'Based on the global blockbuster videogame franchise from Sega, Sonic the Hedgehog tells the story of the world’s speediest hedgehog as he embraces his new home on Earth. In this live-action adventure comedy, Sonic and his new best friend team up to defend', '1', 0, 0, 'admin', '2021-04-25 07:42:27', '2021-06-04 18:00:27'),
(268, 172, 'Boss Level', 'A retired special forces officer is trapped in a never-ending time loop on the day of his death.', '1', 0, 0, 'admin', '2021-04-25 11:30:57', '2021-06-04 18:00:27'),
(269, 176, 'Shrek the Musical', 'Shrek The Musical is a musical with music by Jeanine Tesori and book and lyrics by David Lindsay-Abaire. It is based on the 2001 DreamWorks Animation\'s film Shrek and William Steig\'s 1990 book Shrek! It was nominated for 8 Tony Awards including Best Music', '1', 0, 0, 'admin', '2021-04-25 23:04:36', '2021-06-04 18:00:31'),
(271, 178, 'Bill & Ted Face the Music', 'Yet to fulfill their rock and roll destiny, the now middle-aged best friends Bill and Ted set out on a new adventure when a visitor from the future warns them that only their song can save life as we know it. Along the way, they are helped by their daught', '1', 0, 0, 'admin', '2021-04-26 06:27:35', '2021-06-04 18:00:11'),
(272, 222, 'Hamilton', 'Presenting the tale of American founding father Alexander Hamilton, this filmed version of the original Broadway smash hit is the story of America then, told by America now.', '1', 0, 0, 'admin', '2021-04-26 06:33:31', '2021-04-28 13:16:07'),
(273, 172, 'Mulan', 'When the Emperor of China issues a decree that one man per family must serve in the Imperial Chinese Army to defend the country from Huns, Hua Mulan, the eldest daughter of an honored warrior, steps in to take the place of her ailing father. She is spirit', '1', 0, 0, 'admin', '2021-04-26 06:36:55', '2021-06-04 18:00:27'),
(274, 180, 'Dolittle (2020)', 'After losing his wife seven years earlier, the eccentric Dr. John Dolittle, famed doctor and veterinarian of Queen Victoria’s England, hermits himself away behind the high walls of Dolittle Manor with only his menagerie of exotic animals for company. But ', '1', 0, 0, 'admin', '2021-04-26 06:40:03', '2021-06-04 18:00:17'),
(275, 172, 'Get Smart', 'When the identities of secret agents from Control are compromised, the Chief promotes hapless but eager analyst Maxwell Smart and teams him with stylish, capable Agent 99, the only spy whose cover remains intact. Can they work together to thwart the evil ', '1', 0, 0, 'admin', '2021-04-26 07:38:15', '2021-06-04 18:00:27'),
(276, 223, 'Halloween (2018)', 'Jamie Lee Curtis returns to her iconic role as Laurie Strode, who comes to her final confrontation with Michael Myers, the masked figure who has haunted her since she narrowly escaped his killing spree on Halloween night four decades ago.', '1', 0, 0, 'admin', '2021-04-26 07:58:48', '2021-06-04 18:00:47'),
(280, 172, 'Black Panther', 'King T\'Challa returns home to the reclusive, technologically advanced African nation of Wakanda to serve as his country\'s new leader. However, T\'Challa soon finds that he is challenged for the throne by factions within his own country as well as without. ', '1', 0, 0, 'admin', '2021-04-28 07:19:01', '2021-06-04 18:00:27'),
(281, 172, '400 Bullets', '400 BULLETS is an edge-of-your-seat Military Action story about what it means to fight for honor instead of profit. The film packs gun battles, epic hand-to-hand fight sequences and witty dialogue into its 90 minute run time.', '1', 0, 0, 'admin', '2021-04-28 09:12:20', '2021-06-04 18:00:27'),
(282, 172, 'Shazam', 'A boy is given the ability to become an adult superhero in times of need with a single magic word.', '1', 0, 0, 'admin', '2021-04-28 09:51:11', '2021-06-04 18:00:27'),
(283, 172, 'Armageddon Tales', 'After surviving a worldwide pandemic, two men with different agendas, two women from a survival colony, and young girl and a man each form alliances as they cross post-apocalyptic landscapes.', '1', 0, 0, 'admin', '2021-04-28 10:10:38', '2021-06-04 18:00:27'),
(284, 176, 'Barb and Star Go to Vista Del Mar', 'The story of best friends Barb and Star, who leave their small midwestern town for the first time to go on vacation in Vista Del Mar, Florida, where they soon find themselves tangled up in adventure, love, and a villain’s evil plot to kill everyone in tow', '1', 0, 0, 'admin', '2021-04-28 10:23:04', '2021-05-14 16:51:03'),
(285, 184, 'Ratatouille', 'Remy, a resident of Paris, appreciates good food and has quite a sophisticated palate. He would love to become a chef so he can create and enjoy culinary masterpieces to his heart\'s delight. The only problem is, Remy is a rat. When he winds up in the sewe', '1', 0, 0, 'admin', '2021-04-28 10:29:24', '2021-06-04 17:59:48'),
(286, 184, 'The Emoji Movie', 'Gene, a multi-expressional emoji, sets out on a journey to become a normal emoji.', '1', 0, 0, 'admin', '2021-04-28 10:34:33', '2021-06-04 17:59:48'),
(287, 184, 'The Boss Baby', 'A story about how a new baby\'s arrival impacts a family, told from the point of view of a delightfully unreliable narrator, a wildly imaginative 7 year old named Tim.', '1', 0, 0, 'admin', '2021-04-28 10:38:23', '2021-06-04 17:59:48'),
(288, 184, 'The Boss Baby and Tim\'s Treasure Hunt Through Time', 'Join the fun as Boss Baby and Tim battle pirates, travel through outer space, swim deep into the sea, and go toe-to-toe with some ferocious dinosaurs!', '1', 0, 0, 'admin', '2021-04-28 10:40:57', '2021-06-04 17:59:48'),
(289, 184, 'The LEGO Batman Movie', 'A cooler-than-ever Bruce Wayne must deal with the usual suspects as they plan to rule Gotham City, while discovering that he has accidentally adopted a teenage orphan who wishes to become his sidekick.', '1', 0, 0, 'admin', '2021-04-28 10:44:02', '2021-06-04 17:59:48'),
(290, 184, 'The LEGO Ninjago Movie', 'Six young ninjas are tasked with defending their island home of Ninjago. By night, they’re gifted warriors using their skill and awesome fleet of vehicles to fight villains and monsters. By day, they’re ordinary teens struggling against their greatest ene', '1', 0, 0, 'admin', '2021-04-28 10:47:07', '2021-06-04 17:59:48'),
(302, 172, 'Baby Driver', 'After being coerced into working for a crime boss, a young getaway driver finds himself taking part in a heist doomed to fail.', '1', 0, 0, 'admin', '2021-04-30 02:16:33', '2021-06-04 18:00:27'),
(304, 172, 'Born a Champion', 'After a blood- soaked jujitsu match in Dubai, fighting legend Mickey Kelley falls to superstar Blaine. But years later, an online video proves that Blaine cheated, and the world demands a rematch. Can the aging underdog get back into shape in time to vanq', '1', 0, 0, 'admin', '2021-04-30 06:25:56', '2021-06-04 18:00:27'),
(305, 184, 'Luca', 'In a beautiful seaside town on the Italian Riviera, two young boys experience an unforgettable summer filled with gelato, pasta and endless scooter rides. But all the fun is threatened by a deeply-held secret: they are sea monsters from another world just', '1', 0, 0, 'admin', '2021-04-30 23:21:41', '2021-06-04 17:59:48'),
(306, 221, 'Crisis', 'Three stories about the world of opioids collide: a drug trafficker arranges a multi-cartel Fentanyl smuggling operation between Canada and the U.S., an architect recovering from an OxyContin addiction tracks down the truth behind her son\'s involvement wi', '1', 0, 0, 'admin', '2021-05-01 09:07:36', '2021-06-04 18:00:57'),
(309, 235, 'Peepoodo', 'An educative series for children over 18 years old that explores sexuality without taboos and in all its forms, including dicks and nipples. A positive sexuality, that is unrestrained and totally ignores prejudices… culminating into one single message: to', '1', 0, 0, 'admin', '2021-05-02 08:57:48', '2021-06-04 17:59:42'),
(312, 172, 'Fist of the North Star', 'From the immensely popular FIST OF THE NORTH STAR comic book series, comes a new hero. The fate of mankind rests with superhuman warrior Kenshiro who roams the wastelands of the future waging a battle against overwhelming evil. With the spiritual guidance', '1', 0, 0, 'admin', '2021-05-12 00:01:34', '2021-06-04 18:00:27'),
(316, 184, 'The Owl House', 'An animated fantasy-comedy series that follows Luz, a self-assured teenage girl who accidentally stumbles upon a portal to a magical world where she befriends a rebellious witch, Eda, and an adorably tiny warrior, King. Despite not having magical abilitie', '1', 0, 0, 'admin', '2021-05-20 22:39:53', '2021-06-04 17:59:48'),
(317, 172, 'Bionicle: The Legend Reborn', 'Once the ruler of an entire universe, the Great Spirit Mata Nui finds himself cast out of his own body, his spirit trapped inside the fabled Mask of Life, hurtling through space. After landing on the far-away planet of Bara Magna, the mask creates a new b', '1', 0, 0, 'admin', '2021-05-21 03:14:33', '2021-06-04 18:00:27'),
(318, 184, 'The Critic', 'The Critic is an American prime time animated series revolving around the life of New York film critic Jay Sherman, voiced by actor Jon Lovitz. It was created by writing partners Al Jean and Mike Reiss, who had previously worked as writers and showrunners', '1', 0, 0, 'admin', '2021-05-23 23:12:12', '2021-06-04 17:59:48'),
(319, 235, 'Meru the Succubus', 'A demon succubus, Meru, is thirsting for revenge towards the priest who took away her powers, and she has swore to find the perfect human host to permanently possess and enact her revenge.', '1', 0, 0, 'admin', '2021-05-26 10:57:31', '2021-06-04 17:59:42'),
(320, 184, 'Troopers: Animated Adventures', 'The Animated Adventures of Rich and Larry', '1', 0, 0, 'admin', '2021-05-26 23:02:27', '2021-06-04 17:59:48'),
(321, 221, 'The Founder', 'The true story of how Ray Kroc, a salesman from Illinois, met Mac and Dick McDonald, who were running a burger operation in 1950s Southern California. Kroc was impressed by the brothers’ speedy system of making the food and saw franchise potential. He man', '1', 0, 0, 'admin', '2021-05-27 08:25:13', '2021-06-04 18:00:57'),
(323, 176, 'Cruella', 'In 1970s London amidst the punk rock revolution, a young grifter named Estella is determined to make a name for herself with her designs. She befriends a pair of young thieves who appreciate her appetite for mischief, and together they are able to build a', '1', 0, 0, 'admin', '2021-05-30 03:17:56', '2021-06-04 18:00:31'),
(324, 176, 'Friends: The Reunion', 'The cast of Friends reunites for a once-in-a-lifetime celebration of the hit series, an unforgettable evening filled with iconic memories, uncontrollable laughter, happy tears, and special guests.', '1', 0, 0, 'admin', '2021-05-30 03:44:51', '2021-06-04 18:00:31'),
(325, 238, 'Class Action Park', 'Class Action Park explores the legend, legacy, and truth behind the 1980\'s water park in Vernon, New Jersey that long ago entered the realm of myth. Known for its dangerous, unsupervised rides and lack of regulation, guests of Action Park expected to walk', '1', 0, 0, 'admin', '2021-05-30 04:16:59', '2021-06-04 17:59:36'),
(327, 237, 'Your Name.', 'High schoolers Mitsuha and Taki are complete strangers living separate lives. But one night, they suddenly switch places. Mitsuha wakes up in Taki’s body, and he in hers. This bizarre occurrence continues to happen randomly, and the two must adjust their ', '1', 0, 1, 'admin', '2021-05-30 09:30:58', '2021-05-30 09:30:58'),
(329, 237, 'My Hero Academia: Two Heroes', 'All Might and Deku accept an invitation to go abroad to a floating and mobile manmade city, called \'I-Island\', where they research quirks as well as hero supplemental items at the special \'I-Expo\' convention that is currently being held on the island. Dur', '1', 0, 1, 'admin', '2021-05-30 09:40:03', '2021-05-30 09:40:03'),
(330, 237, 'My Hero Academia: Heroes Rising', 'Class 1-A visits Nabu Island where they finally get to do some real hero work. The place is so peaceful that it\'s more like a vacation … until they\'re attacked by a villain with an unfathomable Quirk! His power is eerily familiar, and it looks like Shigar', '1', 0, 1, 'admin', '2021-05-30 09:44:12', '2021-05-30 09:44:12'),
(331, 237, 'My Hero Academia: World Heroes\' Mission', 'A mysterious group called Humarize strongly believes in the Quirk Singularity Doomsday theory which states that was quirks get mixed further in with future generations, that power will bring forth the end of humanity. In order to save everyone, the Pro-He', '1', 0, 1, 'admin', '2021-05-30 09:47:32', '2021-05-30 09:47:32'),
(332, 172, 'Dynoman and the Volt!!', 'An awkward young boy and his grandfather are transformed by the arrival of a mysterious ring ordered from a comic book 60 years ago.', '1', 0, 0, 'admin', '2021-06-02 04:23:53', '2021-06-04 18:00:27'),
(333, 239, 'Hollywood', 'Hollywood', '1', 0, 1, 'admin', '2021-06-04 18:11:21', '2021-06-04 18:11:21');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category_images`
--

CREATE TABLE `sub_category_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sub_category_images`
--

INSERT INTO `sub_category_images` (`id`, `sub_category_id`, `picture`, `position`, `created_at`, `updated_at`) VALUES
(212, 202, 'http://adminview.streamhash.com/uploads/images/sub_categories/SV-2020-09-23-10-10-40-3c43717d84a618939c0858abc25c33a6386b67bc.jpg', '1', '2020-09-23 10:10:40', '2020-09-23 10:10:40'),
(213, 203, 'http://adminview.streamhash.com/uploads/images/sub_categories/SV-2020-09-23-10-21-27-ead44bb461ede0a05bb6b07fef826699e529c87e.jpg', '1', '2020-09-23 10:21:27', '2020-09-23 10:21:27'),
(214, 204, 'http://adminview.streamhash.com/uploads/images/sub_categories/SV-2020-09-23-10-29-29-83c7311ed7c3a22321a7a573705653c144d085f4.jpg', '1', '2020-09-23 10:29:29', '2020-09-23 10:29:29'),
(215, 205, 'http://adminview.streamhash.com/uploads/images/sub_categories/SV-2020-09-23-10-37-47-21afc7f28f629bfb0a30f1557feaaec0ab14ed83.jpg', '1', '2020-09-23 10:37:47', '2020-09-23 10:37:47'),
(216, 206, 'http://adminview.streamhash.com/uploads/images/sub_categories/SV-2020-09-23-10-47-35-6ea4e1458302734dd0682a52649ad29c7967c0e4.jpg', '1', '2020-09-23 10:47:35', '2020-09-23 10:47:35'),
(217, 207, 'http://adminview.streamhash.com/uploads/images/sub_categories/SV-2020-09-23-12-03-05-7b29649c6da85f0b63503eb4579ada5023d008e4.jpg', '1', '2020-09-23 12:03:05', '2020-09-23 12:03:05'),
(218, 208, 'http://adminview.streamhash.com/uploads/images/sub_categories/SV-2020-09-23-12-12-49-b0bcaa1424127ee04f908d2a3aad95120ba8ce2c.jpg', '1', '2020-09-23 12:12:49', '2020-09-23 12:12:49'),
(219, 209, 'http://adminview.streamhash.com/uploads/images/sub_categories/SV-2020-09-23-12-26-32-f31d2d0a8d6e7f9de4c7c8894358ba2185f7982d.jpg', '1', '2020-09-23 12:20:08', '2020-09-23 12:26:32'),
(220, 210, 'http://adminview.streamhash.com/uploads/images/sub_categories/SV-2020-09-23-12-34-54-1298d8ad2b8d0bedaebe17be6b634a28311c6290.jpg', '1', '2020-09-23 12:34:54', '2020-09-23 12:34:54'),
(221, 211, 'http://adminview.streamhash.com/uploads/images/sub_categories/SV-2020-09-23-12-40-47-5132729e8745e34ecfdc653ef51b2dc053703d9c.jpg', '1', '2020-09-23 12:40:47', '2020-09-23 12:40:47'),
(253, 243, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-23-08-00-45-56ce78c5975f012ff95fc5c7baecaab8c5800089.jpeg', '1', '2021-04-23 08:00:26', '2021-04-23 08:00:45'),
(254, 244, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-23-08-15-19-cec7a518ebecffd826ca9eab9684a4e745e40f4f.jpeg', '1', '2021-04-23 08:15:19', '2021-04-23 08:15:19'),
(255, 245, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-23-10-09-26-51588222a144abf55efab305c82c5b16c0cbc089.jpeg', '1', '2021-04-23 10:09:26', '2021-04-23 10:09:26'),
(256, 246, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-23-12-01-54-ec743c5fa5441b2701bab7bd076e041d1d663dd7.jpeg', '1', '2021-04-23 12:01:54', '2021-04-23 12:01:54'),
(257, 247, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-23-12-22-34-ff1acd5614d2f00480506c39c3bec6746ca97fc9.jpeg', '1', '2021-04-23 12:22:34', '2021-04-23 12:22:34'),
(258, 248, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-23-14-33-53-b0ac5d49504ec6f97eb3dd264464be35520b4025.jpeg', '1', '2021-04-23 14:33:53', '2021-04-23 14:33:53'),
(259, 249, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-23-20-49-04-8a85efeb82332ea643843b8a4538f5ba57e4f3d8.jpeg', '1', '2021-04-23 20:49:04', '2021-04-23 20:49:04'),
(260, 250, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-23-21-25-31-8e4b5b4ba0032eb25341c0622144d61e01214237.jpeg', '1', '2021-04-23 21:25:31', '2021-04-23 21:25:31'),
(261, 251, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-23-21-39-03-d2b6e52634bac9dd0e1e31cdad01f34e0d1c1d0e.jpeg', '1', '2021-04-23 21:39:03', '2021-04-23 21:39:03'),
(262, 252, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-23-21-53-00-c3fe32fb9f43d7d679d275189ae7112d542607f8.jpeg', '1', '2021-04-23 21:53:00', '2021-04-23 21:53:00'),
(266, 256, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-24-06-17-33-16f8b47244127037a8e226257d00eda833e1dbdc.jpeg', '1', '2021-04-24 06:17:33', '2021-04-24 06:17:33'),
(267, 257, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-24-22-21-47-43078d5245beb57be80f95c1619cc7d2f3744095.jpeg', '1', '2021-04-24 22:21:47', '2021-04-24 22:21:47'),
(268, 258, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-25-01-13-19-ea0fa21ac828dca03f8ac675fa639195718b8c6b.jpeg', '1', '2021-04-25 01:13:19', '2021-04-25 01:13:19'),
(270, 260, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-25-01-43-32-d562dd85ea4da2e36f12949512f67efc6a3ca74c.jpeg', '1', '2021-04-25 01:43:32', '2021-04-25 01:43:32'),
(271, 261, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-25-02-04-03-d6cb4c53ab9080b35290806e336e64821514ecd9.jpeg', '1', '2021-04-25 02:04:03', '2021-04-25 02:04:03'),
(272, 262, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-25-02-10-44-1c8ed2db1d77122aba033fef8fa38b7845510656.jpeg', '1', '2021-04-25 02:10:44', '2021-04-25 02:10:44'),
(273, 263, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-25-02-39-11-7dceeaf879ef4fead52266c6467d4828a4364c51.jpeg', '1', '2021-04-25 02:39:11', '2021-04-25 02:39:11'),
(274, 264, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-25-07-28-22-3be0d89bfad62ce69bd6b6d203acf4db852a1cc2.jpeg', '1', '2021-04-25 07:28:22', '2021-04-25 07:28:22'),
(275, 265, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-25-07-34-34-ee77410fc26d8ce5d45bd6d5edd458c1412745a9.jpeg', '1', '2021-04-25 07:34:34', '2021-04-25 07:34:34'),
(276, 266, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-25-07-38-49-ab57043638ddfed56901fdb3aa74f5492dbc5bb9.jpeg', '1', '2021-04-25 07:38:49', '2021-04-25 07:38:49'),
(277, 267, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-25-07-42-27-cb7c07046a8ea4a9b06c773f978c708de651085b.jpeg', '1', '2021-04-25 07:42:27', '2021-04-25 07:42:27'),
(278, 268, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-25-11-30-57-1014041f382b259d7284c106bb9061ba14bf1996.jpeg', '1', '2021-04-25 11:30:57', '2021-04-25 11:30:57'),
(279, 269, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-25-23-04-36-0179720d43eb8c3e7f0621137f9c98e463da0e72.jpg', '1', '2021-04-25 23:04:36', '2021-04-25 23:04:36'),
(281, 271, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-26-06-27-35-208b98942abfabe882508f2f86231bfc9195b822.jpeg', '1', '2021-04-26 06:27:35', '2021-04-26 06:27:35'),
(282, 272, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-26-06-33-31-0ca6a95284d92f896efd80cc4607a8a86364d017.jpeg', '1', '2021-04-26 06:33:31', '2021-04-26 06:33:31'),
(283, 273, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-26-06-36-56-6a11bf2c9c62aff803a1ae00ddfb07e3167fc84b.jpeg', '1', '2021-04-26 06:36:56', '2021-04-26 06:36:56'),
(284, 274, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-26-06-40-03-6c4cac501adbef2bf86b2338412fac2da295856f.jpeg', '1', '2021-04-26 06:40:03', '2021-04-26 06:40:03'),
(285, 275, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-26-07-38-15-687cd5b69dcc74469f5814815737d6dbe3210b48.jpeg', '1', '2021-04-26 07:38:15', '2021-04-26 07:38:15'),
(286, 276, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-26-07-58-48-68f258d74a7ee996f9cb6aa2ee060ac713d536b2.jpeg', '1', '2021-04-26 07:58:48', '2021-04-26 07:58:48'),
(290, 280, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-28-07-19-01-12239d08baa875aa622b5385591d5db5d6358b09.jpeg', '1', '2021-04-28 07:19:01', '2021-04-28 07:19:01'),
(291, 281, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-28-09-12-20-c19aa96233d0213e6880e5b848f9750721d70bea.png', '1', '2021-04-28 09:12:20', '2021-04-28 09:12:20'),
(292, 282, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-28-09-51-11-e723701d023dd3023d40ad5d6649e5fdd65bedf0.jpeg', '1', '2021-04-28 09:51:11', '2021-04-28 09:51:11'),
(293, 283, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-28-10-10-38-9ffa9f05fb29450e81d0fad9373c504d47c84757.jpg', '1', '2021-04-28 10:10:38', '2021-04-28 10:10:38'),
(294, 284, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-28-10-23-04-3debf492ae485d9a6288d3b13da349b48ce83fb2.jpg', '1', '2021-04-28 10:23:04', '2021-04-28 10:23:04'),
(295, 285, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-28-10-29-24-9c407bc92bcf02fb91ed965294454e3a1c151dda.jpeg', '1', '2021-04-28 10:29:24', '2021-04-28 10:29:24'),
(296, 286, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-28-10-34-33-cf1213487cff8aaa2d91acd87b3f4609b8ed8c2a.jpeg', '1', '2021-04-28 10:34:33', '2021-04-28 10:34:33'),
(297, 287, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-28-10-38-23-6faa4448c984c5d48855704ac43b544c39da9b26.jpeg', '1', '2021-04-28 10:38:23', '2021-04-28 10:38:23'),
(298, 288, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-28-10-40-57-f02a0435cf03481de5fadd3f824a0996fb64b041.jpeg', '1', '2021-04-28 10:40:57', '2021-04-28 10:40:57'),
(299, 289, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-28-10-44-02-4a15142c22df903e440f9b82ab5aa92b1fd39ca6.jpeg', '1', '2021-04-28 10:44:02', '2021-04-28 10:44:02'),
(300, 290, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-28-10-47-07-0740a76dcb2c053445eda7d995f8f59fb87a2435.jpeg', '1', '2021-04-28 10:47:07', '2021-04-28 10:47:07'),
(312, 302, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-30-02-16-33-93f3c2935e292e28cf30573c1db8c1bbf97f77e5.jpg', '1', '2021-04-30 02:16:33', '2021-04-30 02:16:33'),
(314, 304, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-30-06-25-56-228b2eec59426fb0547c22f4a4c8c567c5e42270.jpg', '1', '2021-04-30 06:25:56', '2021-04-30 06:25:56'),
(315, 305, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-04-30-23-21-41-644ddbc04ba34cb5f11924ac20b4fa67e52dcf15.jpeg', '1', '2021-04-30 23:21:41', '2021-04-30 23:21:41'),
(316, 306, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-05-01-09-07-36-b4ece9e572f585c0cf5130912b5692c699530b65.jpg', '1', '2021-05-01 09:07:36', '2021-05-01 09:07:36'),
(319, 309, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-05-02-08-57-48-a2950e5cd4fe8ad4f677640adcdd82ec9d95bf0b.jpeg', '1', '2021-05-02 08:57:48', '2021-05-02 08:57:48'),
(322, 312, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-05-12-00-01-34-e5d24c77ecc5b5ed0e1087b182e8d2d5e9a3d4d3.jpg', '1', '2021-05-12 00:01:34', '2021-05-12 00:01:34'),
(326, 316, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-05-20-22-39-53-ff6ffa53905ff29c07735e5442534e75bc9f9b68.jpg', '1', '2021-05-20 22:39:53', '2021-05-20 22:39:53'),
(327, 317, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-05-21-03-14-33-2d3343cc248e86cfb4c71f6ab5e5e688d14a823a.jpg', '1', '2021-05-21 03:14:33', '2021-05-21 03:14:33'),
(328, 318, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-05-23-23-12-12-d1367f3779ffdb9d55ce979e33e8e9513fe8aa11.jpg', '1', '2021-05-23 23:12:12', '2021-05-23 23:12:12'),
(329, 319, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-05-26-10-57-31-c423d5ea42914c4acba039520abc23dd27cee639.png', '1', '2021-05-26 10:57:31', '2021-05-26 10:57:31'),
(330, 320, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-05-26-23-02-27-cf83c3cd0adc6f209075f362c724f34841efd2a3.jpg', '1', '2021-05-26 23:02:27', '2021-05-26 23:02:27'),
(331, 321, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-05-27-08-25-13-c517de873ac4f8c4c7b1aa5e56792d57dc9bbd27.jpeg', '1', '2021-05-27 08:25:13', '2021-05-27 08:25:13'),
(333, 323, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-05-30-03-17-56-ad5cb077c6c47326b951dbe81813445d538d4666.jpeg', '1', '2021-05-30 03:17:56', '2021-05-30 03:17:56'),
(334, 324, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-05-30-03-44-51-bfb4b696b8de5d49b5c144b684cb1fe0d0d885be.jpeg', '1', '2021-05-30 03:44:51', '2021-05-30 03:44:51'),
(335, 325, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-05-30-04-16-59-76ef09f7df13d79b7e161bb153764f2f4595121a.jpeg', '1', '2021-05-30 04:16:59', '2021-05-30 04:16:59'),
(337, 327, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-05-30-09-30-58-5ece05f3ecdb9af1ba4896d55f9cc623c258343d.jpeg', '1', '2021-05-30 09:30:58', '2021-05-30 09:30:58'),
(339, 329, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-05-30-09-40-03-92b419053fa9fab93a10e091bc306ae4b4197171.jpeg', '1', '2021-05-30 09:40:03', '2021-05-30 09:40:03'),
(340, 330, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-05-30-09-44-12-45c8b68a6a45601f200b5a6aa00dd3a5d1efa8b3.jpeg', '1', '2021-05-30 09:44:12', '2021-05-30 09:44:12'),
(341, 331, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-05-30-09-47-32-c29e432c9b46467a18e8bd802199b001f8e2655a.jpeg', '1', '2021-05-30 09:47:32', '2021-05-30 09:47:32'),
(342, 332, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-06-02-04-23-53-b3b38be2d5c6d93dd45ab576433857d089e741ac.jpg', '1', '2021-06-02 04:23:53', '2021-06-02 04:23:53'),
(343, 333, 'http://adminview.streamhash.com/storage//uploads/images/sub_categories/SV-2021-06-04-18-11-21-e4bc8e147e9b90f803f0781380ed5859edb6316e.jpg', '1', '2021-06-04 18:11:21', '2021-06-04 18:11:21');

-- --------------------------------------------------------

--
-- Table structure for table `sub_profiles`
--

CREATE TABLE `sub_profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sub_profiles`
--

INSERT INTO `sub_profiles` (`id`, `user_id`, `name`, `picture`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'User', 'http://adminview.streamhash.com/placeholder.png', 1, '2021-06-05 12:49:46', '2021-06-05 12:49:46'),
(2, 2, 'Jackie Kelly', 'http://adminview.streamhash.com/placeholder.png', 1, '2021-06-05 12:53:52', '2021-06-05 12:53:52'),
(3, 3, 'Stacey Ray', 'http://adminview.streamhash.com/placeholder.png', 1, '2021-06-05 12:55:06', '2021-06-05 12:55:06'),
(4, 4, 'Clayton Barrett', 'http://adminview.streamhash.com/placeholder.png', 1, '2021-06-05 12:55:30', '2021-06-05 12:55:30'),
(5, 5, 'Theresa Holmes', 'http://adminview.streamhash.com/placeholder.png', 1, '2021-06-05 12:56:43', '2021-06-05 12:56:43'),
(6, 6, 'Frederick Nichols', 'http://adminview.streamhash.com/placeholder.png', 1, '2021-06-05 12:57:29', '2021-06-05 12:57:29'),
(7, 7, 'Allison Obrien', 'http://adminview.streamhash.com/placeholder.png', 1, '2021-06-05 12:58:05', '2021-06-05 12:58:05'),
(8, 1, 'Christon', 'http://adminview.streamhash.com/uploads/images/SV-2021-06-05-12-59-40-bf34529bb93f2734d3200a92300844c102450310.jpeg', 0, '2021-06-05 12:59:40', '2021-06-05 12:59:40'),
(9, 1, 'Fannie', 'http://adminview.streamhash.com/uploads/images/SV-2021-06-05-13-00-06-997addaa7130431dd38b9f89f3b3b7335bddc9b4.jpeg', 0, '2021-06-05 13:00:06', '2021-06-05 13:00:06'),
(10, 1, 'Vernon', 'http://adminview.streamhash.com/uploads/images/SV-2021-06-05-13-00-28-f14896d6a5a4e575054d15263747d0aa7062ae92.jpeg', 0, '2021-06-05 13:00:28', '2021-06-05 13:00:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token_expiry` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `device_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `device_type` enum('android','ios','web') COLLATE utf8_unicode_ci NOT NULL,
  `login_by` enum('manual','facebook','apple','twitter','instagram','google') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'manual',
  `social_unique_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `fb_lg` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `gl_lg` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `is_activated` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '0',
  `email_notification_status` int(11) NOT NULL DEFAULT '0',
  `push_notification_status` int(11) NOT NULL,
  `email_notification` tinyint(4) NOT NULL DEFAULT '1',
  `no_of_account` int(11) NOT NULL DEFAULT '0',
  `logged_in_account` int(11) NOT NULL DEFAULT '0',
  `card_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `payment_mode` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'cod',
  `verification_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `verification_code_expiry` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `is_verified` int(11) NOT NULL DEFAULT '0',
  `push_status` int(11) NOT NULL DEFAULT '0',
  `user_type` int(11) NOT NULL DEFAULT '0',
  `user_type_change_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `is_moderator` int(11) NOT NULL DEFAULT '0',
  `moderator_id` int(11) NOT NULL DEFAULT '0',
  `gender` enum('male','female','others') COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `latitude` double(15,8) DEFAULT '0.00000000',
  `longitude` double(15,8) DEFAULT '0.00000000',
  `paypal_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timezone` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'America/Los_Angeles',
  `amount_paid` double(8,2) DEFAULT '0.00',
  `expiry_date` datetime DEFAULT NULL,
  `no_of_days` int(11) NOT NULL DEFAULT '0',
  `one_time_subscription` int(11) NOT NULL DEFAULT '0' COMMENT '0 - Not Subscribed , 1 - Subscribed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `picture`, `token`, `token_expiry`, `device_token`, `device_type`, `login_by`, `social_unique_id`, `fb_lg`, `gl_lg`, `description`, `is_activated`, `status`, `email_notification_status`, `push_notification_status`, `email_notification`, `no_of_account`, `logged_in_account`, `card_id`, `payment_mode`, `verification_code`, `verification_code_expiry`, `is_verified`, `push_status`, `user_type`, `user_type_change_by`, `is_moderator`, `moderator_id`, `gender`, `mobile`, `latitude`, `longitude`, `paypal_email`, `address`, `remember_token`, `timezone`, `amount_paid`, `expiry_date`, `no_of_days`, `one_time_subscription`, `created_at`, `updated_at`) VALUES
(1, 'User', 'user@streamview.com', '$2y$10$D/SsvbZwpUOzU31WX3/re.IGnkPhNOE9nB1b.Cn1bSBE1w11D5ywu', 'http://adminview.streamhash.com/placeholder.png', '2y10DhoJ27tDDEGBXV2wlgZuanKZiwdgQrCm8zfaxRefyib4nbprp5C', '1982897945', '123456', 'web', 'manual', '', '', '', '', 1, 1, 0, 0, 1, 4, 1, '1', 'card', '', '', 1, 1, 1, '', 0, 0, 'male', '', 0.00000000, 0.00000000, '', '', NULL, 'Asia/Calcutta', 0.00, NULL, 0, 0, '2021-06-05 12:49:45', '2021-06-05 13:00:28'),
(2, 'Jackie Kelly', 'jackiekelly@gmail.com', '$2y$10$wuh.76IKcQSu0rT.FrPW8upf6ijQ8k5shoftHK/XYw5vY31koVrYC', 'http://adminview.streamhash.com/placeholder.png', '2y10JOyZ1t5MCbYDZPWUhvsXOyMWmbLNJ5HF29sXtN9t9dSSl7UoVyMS', '1982897632', '', 'web', 'manual', '', '', '', '', 1, 1, 0, 0, 1, 1, 1, '4', 'card', '', '', 1, 1, 1, '', 0, 0, 'male', '', 0.00000000, 0.00000000, '', '', NULL, 'Asia/Calcutta', 0.00, NULL, 0, 0, '2021-06-05 12:53:52', '2021-06-05 12:55:06'),
(3, 'Stacey Ray', 'staceyray@gmail.com', '$2y$10$97kwwlBPNS7tzi.6SiL6wOG8PxsC.lfzos.gB9yn6Qj.LbpvHPUx6', 'http://adminview.streamhash.com/placeholder.png', '2y10a0BD70Z3Dl6gA9dBTaShduXmDsZGs9cJZ6jGcB4Dw1qyBMjLQR8ra', '1982897706', '', 'web', 'manual', '', '', '', '', 1, 1, 0, 0, 1, 1, 1, '0', 'cod', '', '', 1, 1, 0, '', 0, 0, 'male', '', 0.00000000, 0.00000000, '', '', NULL, 'Asia/Calcutta', 0.00, NULL, 0, 0, '2021-06-05 12:55:06', '2021-06-05 12:55:30'),
(4, 'Clayton Barrett', 'claytonbarrett@gmail.com', '$2y$10$5A1aEYIhqfMe8bnGaFej3utHbvkJnhDawGFwkwTnZGSMAJFUG7Fga', 'http://adminview.streamhash.com/placeholder.png', '2y10AgeYk8DlPtXgMVK4GgH1Zepo89PsyZrYWNnISSPCWOstn4d4qHUC', '1982897730', '', 'web', 'manual', '', '', '', '', 1, 1, 0, 0, 1, 1, 1, '5', 'card', '', '', 1, 1, 1, '', 0, 0, 'male', '', 0.00000000, 0.00000000, '', '', NULL, 'Asia/Calcutta', 0.00, NULL, 0, 0, '2021-06-05 12:55:30', '2021-06-05 12:56:43'),
(5, 'Theresa Holmes', 'theresaholmes@gmail.com', '$2y$10$Q3PMsR5rVMAJUdKO8Df6yeqf.VQaiQD89JdSjU4Op5gifRc5O5RbS', 'http://adminview.streamhash.com/placeholder.png', '2y10Gl6OpjnMJKK67IcVmPIKSOizg0pSYEoSHm6vZNN0dfb6CPbXLD6', '1982897803', '', 'web', 'manual', '', '', '', '', 1, 1, 0, 0, 1, 1, 1, '6', 'card', '', '', 1, 1, 1, '', 0, 0, 'male', '', 0.00000000, 0.00000000, '', '', NULL, 'Asia/Calcutta', 0.00, NULL, 0, 0, '2021-06-05 12:56:43', '2021-06-05 12:57:29'),
(6, 'Frederick Nichols', 'Frederick@gmail.com', '$2y$10$Yt8BAHY48KqJ40NuJq/HNOksmF.FUyXruAKneQkY7lnPSnaUjqyUy', 'http://adminview.streamhash.com/placeholder.png', '2y10h9bMjkDEZYRx8nbdseapFej7NiDVYAT5dNBtiTM4RIidu2dUe7S', '1982897849', '', 'web', 'manual', '', '', '', '', 1, 1, 0, 0, 1, 1, 1, '0', 'cod', '', '', 1, 1, 0, '', 0, 0, 'male', '', 0.00000000, 0.00000000, '', '', NULL, 'Asia/Calcutta', 0.00, NULL, 0, 0, '2021-06-05 12:57:29', '2021-06-05 12:58:05'),
(7, 'Allison Obrien', 'allison@gmail.com', '$2y$10$BlLq6MtEYemvHEVhappuweI9tE60ocWf66NTSlHOLi7f6qXLfnpBy', 'http://adminview.streamhash.com/placeholder.png', '2y10gBr06YkJDCEtcdLD1kfcuBLRb8XXqbp3ksyKP2rzXvtF62a6mpRS', '1982897885', '123456', 'web', 'manual', '', '', '', '', 1, 1, 0, 0, 1, 1, 1, '7', 'card', '', '', 1, 1, 1, '', 0, 0, 'male', '', 0.00000000, 0.00000000, '', '', NULL, 'Asia/Calcutta', 0.00, NULL, 0, 0, '2021-06-05 12:58:05', '2021-06-05 12:58:30');

-- --------------------------------------------------------

--
-- Table structure for table `user_coupons`
--

CREATE TABLE `user_coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `no_of_times_used` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_histories`
--

CREATE TABLE `user_histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `sub_profile_id` int(11) NOT NULL,
  `admin_video_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_logged_devices`
--

CREATE TABLE `user_logged_devices` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `token_expiry` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_logged_devices`
--

INSERT INTO `user_logged_devices` (`id`, `user_id`, `token_expiry`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '1982897386', 1, '2021-06-05 12:49:46', '2021-06-05 12:49:46'),
(2, 2, '1982897632', 1, '2021-06-05 12:53:52', '2021-06-05 12:53:52'),
(3, 3, '1982897706', 1, '2021-06-05 12:55:06', '2021-06-05 12:55:06'),
(4, 4, '1982897730', 1, '2021-06-05 12:55:30', '2021-06-05 12:55:30'),
(5, 5, '1982897803', 1, '2021-06-05 12:56:43', '2021-06-05 12:56:43'),
(6, 6, '1982897849', 1, '2021-06-05 12:57:29', '2021-06-05 12:57:29'),
(7, 7, '1982897885', 1, '2021-06-05 12:58:05', '2021-06-05 12:58:05'),
(8, 1, '1982897945', 1, '2021-06-05 12:59:05', '2021-06-05 12:59:05');

-- --------------------------------------------------------

--
-- Table structure for table `user_payments`
--

CREATE TABLE `user_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_current` tinyint(4) NOT NULL,
  `subscription_amount` double(8,2) NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `coupon_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `payment_mode` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `expiry_date` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `from_auto_renewed` int(11) NOT NULL,
  `reason_auto_renewal_cancel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_cancelled` int(11) NOT NULL,
  `is_coupon_applied` tinyint(4) NOT NULL,
  `coupon_reason` text COLLATE utf8_unicode_ci NOT NULL,
  `reason` text COLLATE utf8_unicode_ci NOT NULL,
  `cancel_reason` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_wallet_credits_applied` tinyint(4) NOT NULL DEFAULT '0',
  `wallet_amount` double(8,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_payments`
--

INSERT INTO `user_payments` (`id`, `subscription_id`, `user_id`, `payment_id`, `is_current`, `subscription_amount`, `coupon_code`, `coupon_amount`, `amount`, `payment_mode`, `expiry_date`, `status`, `from_auto_renewed`, `reason_auto_renewal_cancel`, `is_cancelled`, `is_coupon_applied`, `coupon_reason`, `reason`, `cancel_reason`, `created_at`, `updated_at`, `is_wallet_credits_applied`, `wallet_amount`) VALUES
(1, 104, 1, 'ch_1Iyz07K3Y96PKCCvvrY95qog', 1, 69.99, '', '0', 69.99, 'card', '2022-06-05 12:53:19', 1, 0, '', 0, 0, '', '', NULL, '2021-06-05 12:53:19', '2021-06-05 12:53:19', 0, 0.00),
(2, 105, 2, 'ch_1Iyz1CK3Y96PKCCvWdK01Jyb', 1, 39.99, '', '0', 39.99, 'card', '2021-12-05 12:54:27', 1, 0, '', 0, 0, '', '', NULL, '2021-06-05 12:54:27', '2021-06-05 12:54:27', 0, 0.00),
(3, 104, 2, 'ch_1Iyz1PK3Y96PKCCvS2KKmlnV', 1, 69.99, '', '0', 69.99, 'card', '2022-12-05 12:54:27', 1, 0, '', 0, 0, '', '', NULL, '2021-06-05 12:54:39', '2021-06-05 12:54:39', 0, 0.00),
(4, 105, 4, 'ch_1Iyz2fK3Y96PKCCvp7TeWPqo', 1, 39.99, '', '0', 39.99, 'card', '2021-12-05 12:55:58', 1, 0, '', 0, 0, '', '', NULL, '2021-06-05 12:55:58', '2021-06-05 12:55:58', 0, 0.00),
(5, 104, 5, 'ch_1Iyz3lK3Y96PKCCv8f0ymzzu', 1, 69.99, '', '0', 69.99, 'card', '2022-06-05 12:57:06', 1, 0, '', 0, 0, '', '', NULL, '2021-06-05 12:57:06', '2021-06-05 12:57:06', 0, 0.00),
(6, 104, 7, 'ch_1Iyz58K3Y96PKCCvjiBXoXiY', 1, 69.99, '', '0', 69.99, 'card', '2022-06-05 12:58:30', 1, 0, '', 0, 0, '', '', NULL, '2021-06-05 12:58:30', '2021-06-05 12:58:30', 0, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `user_ratings`
--

CREATE TABLE `user_ratings` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `admin_video_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_referrals`
--

CREATE TABLE `user_referrals` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_user_id` int(11) NOT NULL,
  `referral_code_id` int(11) NOT NULL,
  `referral_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `device_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'web',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_tracks`
--

CREATE TABLE `user_tracks` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip_address` text COLLATE utf8_unicode_ci NOT NULL,
  `HTTP_USER_AGENT` text COLLATE utf8_unicode_ci NOT NULL,
  `REQUEST_TIME` text COLLATE utf8_unicode_ci NOT NULL,
  `REMOTE_ADDR` text COLLATE utf8_unicode_ci NOT NULL,
  `hostname` text COLLATE utf8_unicode_ci NOT NULL,
  `latitude` double(10,8) NOT NULL,
  `longitude` double(10,8) NOT NULL,
  `origin` text COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `region` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `others` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `view` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `video_cast_crews`
--

CREATE TABLE `video_cast_crews` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_video_id` int(11) NOT NULL,
  `cast_crew_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `video_watch_counts`
--

CREATE TABLE `video_watch_counts` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_video_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `watch_count` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `sub_profile_id` int(11) NOT NULL,
  `admin_video_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `sub_profile_id`, `admin_video_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, 7, 1171, 1, '2021-06-05 12:58:37', '2021-06-05 12:58:37'),
(2, 7, 7, 1172, 1, '2021-06-05 12:58:44', '2021-06-05 12:58:44'),
(3, 1, 1, 1171, 1, '2021-06-05 12:59:12', '2021-06-05 12:59:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_videos`
--
ALTER TABLE `admin_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_video_images`
--
ALTER TABLE `admin_video_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_video_subtitles`
--
ALTER TABLE `admin_video_subtitles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cast_crews`
--
ALTER TABLE `cast_crews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `continue_watching_videos`
--
ALTER TABLE `continue_watching_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_coupon_code_unique` (`coupon_code`);

--
-- Indexes for table `custom_wallets`
--
ALTER TABLE `custom_wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_wallet_histories`
--
ALTER TABLE `custom_wallet_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_wallet_payments`
--
ALTER TABLE `custom_wallet_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_wallet_vouchers`
--
ALTER TABLE `custom_wallet_vouchers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flags`
--
ALTER TABLE `flags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_reserved_reserved_at_index` (`queue`,`reserved`,`reserved_at`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like_dislike_videos`
--
ALTER TABLE `like_dislike_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobile_registers`
--
ALTER TABLE `mobile_registers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moderators`
--
ALTER TABLE `moderators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `moderators_email_unique` (`email`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_templates`
--
ALTER TABLE `notification_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offline_admin_videos`
--
ALTER TABLE `offline_admin_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_counters`
--
ALTER TABLE `page_counters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `pay_per_views`
--
ALTER TABLE `pay_per_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `redeems`
--
ALTER TABLE `redeems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `redeem_requests`
--
ALTER TABLE `redeem_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referral_codes`
--
ALTER TABLE `referral_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `settings_key_index` (`key`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_admins`
--
ALTER TABLE `sub_admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sub_admins_email_unique` (`email`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category_images`
--
ALTER TABLE `sub_category_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_profiles`
--
ALTER TABLE `sub_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_coupons`
--
ALTER TABLE `user_coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_histories`
--
ALTER TABLE `user_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_logged_devices`
--
ALTER TABLE `user_logged_devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_payments`
--
ALTER TABLE `user_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_ratings`
--
ALTER TABLE `user_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_referrals`
--
ALTER TABLE `user_referrals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_tracks`
--
ALTER TABLE `user_tracks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video_cast_crews`
--
ALTER TABLE `video_cast_crews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video_watch_counts`
--
ALTER TABLE `video_watch_counts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `admin_videos`
--
ALTER TABLE `admin_videos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1174;
--
-- AUTO_INCREMENT for table `admin_video_images`
--
ALTER TABLE `admin_video_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1105;
--
-- AUTO_INCREMENT for table `admin_video_subtitles`
--
ALTER TABLE `admin_video_subtitles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `cast_crews`
--
ALTER TABLE `cast_crews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;
--
-- AUTO_INCREMENT for table `continue_watching_videos`
--
ALTER TABLE `continue_watching_videos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `custom_wallets`
--
ALTER TABLE `custom_wallets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `custom_wallet_histories`
--
ALTER TABLE `custom_wallet_histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `custom_wallet_payments`
--
ALTER TABLE `custom_wallet_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `custom_wallet_vouchers`
--
ALTER TABLE `custom_wallet_vouchers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `flags`
--
ALTER TABLE `flags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key, It is an unique key';
--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `like_dislike_videos`
--
ALTER TABLE `like_dislike_videos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;
--
-- AUTO_INCREMENT for table `mobile_registers`
--
ALTER TABLE `mobile_registers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `moderators`
--
ALTER TABLE `moderators`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=392;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notification_templates`
--
ALTER TABLE `notification_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `offline_admin_videos`
--
ALTER TABLE `offline_admin_videos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `page_counters`
--
ALTER TABLE `page_counters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1110;
--
-- AUTO_INCREMENT for table `pay_per_views`
--
ALTER TABLE `pay_per_views`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key, It is an unique key';
--
-- AUTO_INCREMENT for table `redeems`
--
ALTER TABLE `redeems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `redeem_requests`
--
ALTER TABLE `redeem_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `referral_codes`
--
ALTER TABLE `referral_codes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;
--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
--
-- AUTO_INCREMENT for table `sub_admins`
--
ALTER TABLE `sub_admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=334;
--
-- AUTO_INCREMENT for table `sub_category_images`
--
ALTER TABLE `sub_category_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=344;
--
-- AUTO_INCREMENT for table `sub_profiles`
--
ALTER TABLE `sub_profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user_coupons`
--
ALTER TABLE `user_coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_histories`
--
ALTER TABLE `user_histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_logged_devices`
--
ALTER TABLE `user_logged_devices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user_payments`
--
ALTER TABLE `user_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_ratings`
--
ALTER TABLE `user_ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_referrals`
--
ALTER TABLE `user_referrals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_tracks`
--
ALTER TABLE `user_tracks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `video_cast_crews`
--
ALTER TABLE `video_cast_crews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=308;
--
-- AUTO_INCREMENT for table `video_watch_counts`
--
ALTER TABLE `video_watch_counts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
