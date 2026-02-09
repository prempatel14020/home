-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 24, 2025 at 08:55 PM
-- Server version: 10.5.27-MariaDB
-- PHP Version: 8.3.17
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;
--
-- Database: `ppatel133_dmit2025`
--

-- --------------------------------------------------------
--
-- Table structure for table `anime_characters`
--

CREATE TABLE `anime_characters` (
  `id` int(11) NOT NULL,
  `image_filename` varchar(255) DEFAULT NULL,
  `character_name` varchar(255) DEFAULT NULL,
  `anime` varchar(255) DEFAULT NULL,
  `total_episodes` int(11) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `personality_type` varchar(50) DEFAULT NULL,
  `genre` enum(
    'Shonen',
    'Shojo',
    'Seinen',
    'Josei',
    'Isekai',
    'Slice of Life',
    'Fantasy',
    'Adventure',
    'Romance',
    'Horror'
  ) DEFAULT NULL,
  `genre_2` enum(
    'Shonen',
    'Shojo',
    'Seinen',
    'Josei',
    'Isekai',
    'Slice of Life',
    'Fantasy',
    'Adventure',
    'Romance',
    'Horror'
  ) NOT NULL,
  `year_of_release` int(11) DEFAULT NULL,
  `voice_actor` varchar(255) DEFAULT NULL,
  `popularity_rating` int(11) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_edited` datetime DEFAULT NULL,
  `image_url_src` varchar(512) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1 COLLATE = latin1_swedish_ci;
--
-- Dumping data for table `anime_characters`
--

INSERT INTO `anime_characters` (
    `id`,
    `image_filename`,
    `character_name`,
    `anime`,
    `total_episodes`,
    `description`,
    `personality_type`,
    `genre`,
    `genre_2`,
    `year_of_release`,
    `voice_actor`,
    `popularity_rating`,
    `date_added`,
    `date_edited`,
    `image_url_src`
  )
VALUES (
    1,
    '6800917945eed0.25789573.jpg',
    ' Naruto Uzumaki',
    'Naruto',
    720,
    'A ninja with dreams of becoming Hokage.',
    'Determined',
    'Adventure',
    'Slice of Life',
    2002,
    'Mayumi Tanaka',
    9,
    '2025-04-17 00:00:00',
    '2025-04-22 10:58:50',
    'https://wallpaper-house.com/wallpaper-id-175415.php'
  ),
  (
    2,
    '68009531d7e898.70044372.jpg',
    'Sailor Moon',
    'Sailor Moon',
    200,
    'A magical girl who fights for love and justice.',
    'Kind-hearted',
    'Seinen',
    'Shonen',
    1992,
    'Mayumi Tanaka',
    8,
    '2025-04-17 00:00:00',
    '2025-04-22 23:38:13',
    'https://sailormoondub.fandom.com/wiki/Sailor_Moon_(season)'
  ),
  (
    3,
    '68009567879069.78723831.jpg',
    'Guts',
    'Berserk',
    25,
    'test edit description',
    'Brooding',
    'Seinen',
    'Fantasy',
    1997,
    'Nobutoshi Canna',
    9,
    '2025-04-17 00:00:00',
    '2025-04-22 23:49:16',
    'https://www.reddit.com/r/Berserk/comments/ujzgoy/guts_art_by_daverapoza/'
  ),
  (
    4,
    '6800959b328025.61165340.jpeg',
    'Edward Elric',
    'Fullmetal Alchemist',
    64,
    'A young alchemist searching for the Philosopher\'s Stone.',
    'Intelligent',
    'Adventure',
    'Shonen',
    2003,
    'Vic Mignogna',
    10,
    '2025-04-17 00:00:00',
    NULL,
    'https://fullmetal-alchemist-database.fandom.com/wiki/Edward_Elric'
  ),
  (
    5,
    '6800963e106334.56767076.jpeg',
    'Light Yagami',
    'Death Note',
    37,
    'A high school student who discovers a notebook that can kill anyone.',
    'Manipulative',
    'Horror',
    'Shonen',
    2006,
    'Mamoru Miyano',
    9,
    '2025-04-17 00:00:00',
    '2025-04-20 19:35:00',
    'https://www.flickr.com/photos/chikkychappy/306299236'
  ),
  (
    6,
    '68009962c63ab6.67791906.jpeg',
    'Monkey D. Luffy',
    'One Piece',
    1128,
    'A pirate with the ability to stretch his body like rubber.Future pirate king',
    ' Cheerful',
    'Adventure',
    'Shojo',
    1999,
    'Mayumi Tanaka',
    10,
    '2025-04-17 00:00:00',
    '2025-04-22 23:49:04',
    'https://animebattlearenaaba.fandom.com/f/p/4400000000000027245/r/4400000000000097245'
  ),
  (
    31,
    '680569ce41ee19.61525960.jpg',
    'Mikasa Ackerman',
    'Attack on Titan',
    75,
    'A skilled soldier and protector of Eren Yeager.',
    'Loyal',
    'Horror',
    'Shonen',
    2013,
    'Yui Ishikawa',
    9,
    '2025-04-20 00:00:00',
    NULL,
    'https://international-task-force-alliance.fandom.com/wiki/Mikasa_Ackerman'
  ),
  (
    32,
    '68056a19e40830.35323268.jpg',
    'Inuyasha',
    'Inuyasha',
    167,
    'A half-demon searching for the Shikon Jewel.',
    'Gruff',
    'Fantasy',
    'Shonen',
    2000,
    'Kappei Yamaguchi',
    8,
    '2025-04-20 00:00:00',
    NULL,
    'https://www.reddit.com/r/Dreams/comments/15qux8e/had_a_dream_that_disney_aired_inuyasha_on_disney/'
  ),
  (
    33,
    '68056a51151297.27276153.jpg',
    'Rem',
    'Re:Zero',
    50,
    'A maid with a strong sense of loyalty.',
    'Caring',
    'Isekai',
    'Shonen',
    2016,
    'Inori Minase',
    9,
    '2025-04-20 00:00:00',
    NULL,
    'https://64.media.tumblr.com/4914232851a44cab3d54dc0d4d86cb06/tumblr_ortd8bYxaR1vy2tgqo10_1280.png'
  ),
  (
    34,
    '68056aa3c491c9.12437466.jpg',
    'Ash Ketchum',
    'Pokemon',
    1123,
    'A Pokemon trainer aiming to become a Pokemon Master',
    'Adventurous',
    'Adventure',
    'Shonen',
    1997,
    'Veronica Taylor',
    9,
    '2025-04-20 00:00:00',
    NULL,
    'https://nintenduo.com/ash-vuelve-serie-pokemon-despedida/'
  ),
  (
    35,
    '68056adb6c9c44.71659538.jpg',
    'Natsu Dragneel',
    'Fairy Tail',
    328,
    'A fire wizard searching for his adoptive father.',
    'Hot-headed',
    'Fantasy',
    'Shonen',
    2009,
    'Yuichi Nakamura',
    9,
    '2025-04-20 00:00:00',
    NULL,
    'https://wallpapers.com/wallpapers/natsu-dragneel-2560-x-1440-wallpaper-7bqdhb0uypj03wee.html'
  ),
  (
    36,
    '68056b1791d358.28468433.png',
    'Shinji Ikari',
    'Neon Genesis Evangelion',
    26,
    'A reluctant pilot of a giant robot. that helps save poeple.',
    'Introverted',
    'Adventure',
    'Shonen',
    1995,
    'Megumi Ogata',
    8,
    '2025-04-20 00:00:00',
    NULL,
    'https://www.reddit.com/r/evangelion/comments/1fyo7w4/i_just_realized_kaworu_resembles_each_of_the/'
  ),
  (
    37,
    '68056b439be880.29794135.jpg',
    'Erza Scarlet',
    'Fairy Tail',
    328,
    'A powerful wizard known for her armor and weapons.',
    'Strong-willed',
    'Fantasy',
    'Shonen',
    2009,
    'Sayaka Ohara',
    9,
    '2025-04-20 00:00:00',
    NULL,
    'https://www.reddit.com/r/fairytail/comments/1camzfs/discussion_titania/'
  ),
  (
    38,
    '68056b74ca48d3.59884607.jpg',
    'Kaneki Ken',
    'Tokyo Ghoul',
    48,
    'A college student turned half-ghoul.',
    'Conflicted',
    'Horror',
    'Shonen',
    2014,
    'Natsuki Hanae',
    9,
    '2025-04-20 00:00:00',
    NULL,
    'https://zeta-ai.io/ko/plots/5cea5b1f-5348-47be-98c6-a136ae08c358/profile'
  ),
  (
    39,
    '68056bd2aaa851.23099958.jpeg',
    'Bulma',
    'Dragon Ball',
    291,
    'A brilliant scientist and inventor.',
    'Intelligent',
    'Adventure',
    'Shonen',
    1986,
    'Hiromi Tsuru',
    8,
    '2025-04-20 00:00:00',
    NULL,
    'https://fwmedia.fandomwire.com/wp-content/uploads/2024/04/04112048/Bulma-Dragon-Ball--1024x614.jpg'
  ),
  (
    40,
    '68056c9de4f122.13882496.jpg',
    'Yato',
    'Noragami',
    25,
    'A minor god trying to gain followers.',
    'Laid-back',
    'Adventure',
    'Shonen',
    2014,
    'Hiroshi Kamiya',
    9,
    '2025-04-20 00:00:00',
    NULL,
    'https://images2.alphacoders.com/808/808845.png'
  ),
  (
    41,
    '68056d9f3b8326.65613369.jpg',
    'Koro-sensei',
    'Assassination Classroom',
    47,
    'An alien teacher with a plan to destroy the world.',
    'Charismatic',
    'Slice of Life',
    'Shonen',
    2015,
    'Jun Fukuyama',
    9,
    '2025-04-20 00:00:00',
    NULL,
    'https://flic.kr/p/UtBRYw'
  ),
  (
    42,
    '68056e00d4c120.19550039.webp',
    'Hachiman Hikigaya',
    '\'My Teen Romantic Comedy SNAFU',
    36,
    'A cynical high school student.',
    'Pessimistic',
    'Shonen',
    'Shonen',
    2013,
    'Slice of Life',
    8,
    '2025-04-20 00:00:00',
    NULL,
    'https://images-ng.pixai.art/images/orig/0eed2377-6f89-40d8-bfa2-8ce2ed691273'
  ),
  (
    43,
    '68056ec08d1739.29131866.webp',
    'Kaguya Shinomiya',
    'Love Is War',
    24,
    'A genius student council vice president',
    'Competitive',
    'Romance',
    'Shonen',
    2019,
    'Kaguya Sakamoto',
    9,
    '2025-04-20 00:00:00',
    NULL,
    'https://image.cdn2.seaart.me/2023-08-20/14845044306496517/c3a6e6d3efbd2555dd8ea9d36a5c9268f29dcb80_high.webp'
  ),
  (
    44,
    '68056f7aa38424.52682898.webp',
    'Saitama',
    'One Punch Man',
    25,
    'A hero who can defeat any opponent with a single punch.',
    'Bored',
    'Shonen',
    'Shonen',
    2015,
    'Makoto Furukawa',
    10,
    '2025-04-20 00:00:00',
    NULL,
    'https://soundcloud.com/oussema-mekki'
  ),
  (
    45,
    '68056ffa3132c9.36809390.jpg',
    'Asuka Langley Soryu',
    'Neon Genesis Evangelion',
    27,
    'A confident and skilled Eva pilot.',
    'Arrogant',
    'Adventure',
    'Shonen',
    1995,
    'Yuko Miyamura',
    8,
    '2025-04-20 00:00:00',
    NULL,
    'https://images2.alphacoders.com/226/226750.jpg'
  ),
  (
    46,
    '6805708e905f13.38251119.png',
    'Shoyo Hinata',
    'Haikyuu',
    85,
    'A passionate volleyball player with a dream of becoming a top player.',
    'Energetic',
    'Slice of Life',
    'Shonen',
    2014,
    'Ayumu Murase',
    9,
    '2025-04-20 00:00:00',
    NULL,
    'https://static.wikia.nocookie.net/haikyuu/images/d/d2/Hinata_s4-e1-4.png/revision/latest?cb=20200506183149'
  ),
  (
    47,
    '680570d72adf00.87049724.webp',
    'Yuki Nagato',
    'The Melancholy of Haruhi Suzumiya',
    12,
    'A quiet alien interface with vast knowledge.',
    'nerdy/knowledgeable',
    'Shonen',
    'Shonen',
    2006,
    'Junko Takeuchi',
    8,
    '2025-04-20 00:00:00',
    NULL,
    'https://image.cdn2.seaart.me/2023-08-06/53074585931845/a4922fd2525cd7d7b6613c4726343c3451ebab03_high.webp'
  ),
  (
    48,
    '680571283a2700.97770548.jpg',
    'Gintoki Sakata',
    'Gintama',
    367,
    'A samurai with a laid-back attitude and a love for sweets.',
    'Lazy',
    'Slice of Life',
    'Shonen',
    2006,
    'Tomokazu Sugita',
    9,
    '2025-04-20 00:00:00',
    NULL,
    'https://4kwallpapers.com/images/walls/thumbs_3t/16164.png'
  ),
  (
    49,
    '68057163378059.98535493.jpg',
    'Kenshin Himura',
    'Rurouni Kenshin',
    95,
    ' A wandering swordsman seeking redemption.',
    'Kind',
    'Seinen',
    'Shonen',
    1996,
    'Mayo Suzukaze',
    9,
    '2025-04-20 00:00:00',
    NULL,
    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShRRNt5s1iNwTltGTXV7rDazbcUQEpBzQf8KKlHGTN5KDW6l8l'
  ),
  (
    50,
    '680571b632f219.47264889.webp',
    'Shizuku Sangou',
    'KonoSuba',
    20,
    'A skilled assassin with a sharp tongue.',
    'Sarcastic',
    'Isekai',
    'Shonen',
    2016,
    'Rie Takahashi',
    8,
    '2025-04-20 00:00:00',
    NULL,
    'https://images-ng.pixai.art/images/orig/ae56af10-0121-4279-b608-e2f70946f89d'
  ),
  (
    51,
    '680571f3898c19.85272164.jpg',
    'Chihiro Ogino',
    'Spirited Away [ Movie ]',
    1,
    'A young girl navigating a spirit world to save her parents.',
    'Brave',
    'Fantasy',
    'Shonen',
    2001,
    'Rumi Hiiragi',
    10,
    '2025-04-20 00:00:00',
    NULL,
    'https://www.dist.phillips.com/content/web/lot-component/FIG%204_78125342-1b9b-4b3d-b731-061f4d293928.jpg'
  );
--
-- Indexes for dumped tables
--

--
-- Indexes for table `anime_characters`
--
ALTER TABLE `anime_characters`
ADD PRIMARY KEY (`id`);
--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anime_characters`
--
ALTER TABLE `anime_characters`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 53;
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;