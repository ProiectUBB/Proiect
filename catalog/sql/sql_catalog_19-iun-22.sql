-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: localhost
-- Timp de generare: iun. 19, 2022 la 02:22 AM
-- Versiune server: 10.4.22-MariaDB
-- Versiune PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `sql_catalog`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `classes`
--

CREATE TABLE `classes` (
  `id_class` int(11) NOT NULL,
  `class_name` varchar(128) DEFAULT NULL,
  `description` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `classes`
--

INSERT INTO `classes` (`id_class`, `class_name`, `description`) VALUES
(5, 'Administrarea şi securitatea reţelelor de calcul', 'Pellentesque vitae diam enim. Sed molestie sem vitae tellus elementum vehicula. Etiam ac arcu facilisis, venenatis lorem ut, sodales velit. Nullam neque dolor, viverra eget libero a, pulvinar suscipit nulla. Vivamus aliquam, purus sit amet rhoncus tempus, ante metus aliquam nulla, ut vestibulum sapien diam non felis'),
(18, 'Fundamentele programării şi algoritmică', 'Aenean massa metus, fermentum ut semper vel, mattis eget ligula. Praesent quis nunc quis libero tincidunt efficitur quis ac quam. Mauris porttitor luctus ligula, vel varius lectus varius sed. In eget ligula id libero semper aliquet. Vivamus in enim non turpis porttitor faucibus quis sit amet lacus'),
(19, 'Introducere în Programare', 'Nam a lobortis tortor. Sed ornare tincidunt lorem, sed hendrerit libero convallis vel. Cras eget vulputate nibh, a dapibus mauris. Nam pellentesque, odio sit amet suscipit placerat, felis dolor tempor metus, in hendrerit ipsum ligula in purus. Quisque imperdiet mi diam, a egestas erat suscipit congue'),
(20, 'Metode avansate de gestiune a documentelor şi a sistemelor de calcul', 'Maecenas lobortis mauris varius ante porta, vel tristique lectus porttitor. Nulla sit amet pharetra massa. Nam dignissim lacinia tortor. Pellentesque tincidunt congue purus sed malesuada. Cras dictum lectus magna, ut efficitur tellus tincidunt ac'),
(21, 'Programare şi structuri de date', 'Nulla leo ipsum, elementum feugiat justo eget, sodales congue ipsum. Proin sed ipsum et diam porta viverra a in lectus. Quisque elementum libero ex, pretium pellentesque nunc aliquet id. Maecenas ac dolor ut ligula mollis ornare nec vitae enim. Sed rhoncus leo nec molestie aliquam'),
(23, 'Baze de date', 'Quisque vehicula quis tortor at viverra. Nunc dui eros, efficitur eget arcu sit amet, placerat sollicitudin erat. Suspendisse a enim sed lacus imperdiet posuere. Aenean laoreet neque vitae dui condimentum efficitur et eu lorem. Sed sagittis, augue et fringilla suscipit, velit magna pellentesque tortor, id egestas lorem neque accumsan nisi'),
(24, 'Programare orientată obiect', 'Fusce eget ligula metus. Duis eros massa, dignissim sed justo ac, molestie hendrerit massa. Curabitur enim arcu, consequat ac mauris in, porttitor facilisis magna. Quisque aliquet, nisi et malesuada finibus, neque dui varius libero, sed fringilla massa quam sagittis nisl. Phasellus viverra felis nisl, at placerat lectus condimentum vitae'),
(25, 'Tehnologii web client-side', 'Morbi blandit ligula sit amet magna efficitur feugiat. Aliquam erat volutpat. In a massa at metus lacinia semper vitae eget felis. Phasellus lobortis turpis quis lacus euismod eleifend. Proin et ex ipsum'),
(26, 'Medii de programare', 'Maecenas rhoncus est ac risus porttitor scelerisque. Fusce vulputate dapibus aliquet. Maecenas sodales auctor lorem scelerisque pulvinar. Aliquam quis finibus leo, eu gravida lorem. Nunc facilisis ipsum at pulvinar cursus'),
(27, 'Tehnologii și Framework-uri Enterprise', 'Suspendisse blandit vulputate nisi id ullamcorper. Curabitur congue suscipit mauris, non luctus metus tempor ac. Vestibulum luctus erat et nunc consectetur, sit amet condimentum justo varius. Proin in nunc accumsan, congue tellus eget, hendrerit elit. Nullam tempus placerat neque vitae vehicula'),
(28, 'Tehnologii web server-side', 'Nullam vulputate ac mi ut mattis. Nullam pharetra elementum eros sit amet cursus. Morbi at dictum erat, a porttitor nibh. Aenean commodo sit amet mi eu faucibus. Mauris malesuada dui quam, bibendum imperdiet massa ultricies eu'),
(29, 'Verificare, validare și testare automată ', 'Nulla imperdiet augue magna. Donec quis orci in massa congue pharetra. Nullam in convallis dui, eu posuere sem. In sollicitudin sapien nisl, vehicula fermentum purus fringilla lobortis. Phasellus pharetra tincidunt enim a viverra'),
(31, 'Introducere în Platforma.NET', 'Quisque finibus bibendum semper. Donec id tristique orci. Quisque fermentum enim leo, eget dapibus lorem euismod ut. Vestibulum sed blandit massa. Proin facilisis ullamcorper augue, in vulputate quam placerat id'),
(32, 'Practică', 'Etiam rutrum risus justo, sed tincidunt eros blandit id. In maximus mi nisi, nec interdum urna luctus sed. Curabitur placerat tortor nulla, vel sollicitudin orci consectetur quis. Vivamus a congue quam, non eleifend nulla. Suspendisse sed iaculis quam'),
(33, 'Proiect', 'Aliquam ut lorem non tellus venenatis venenatis sed ac dui. In nec tellus varius, luctus felis et, pellentesque augue. Donec eget ultricies lectus, facilisis consequat urna. Nam quis risus posuere, euismod odio blandit, placerat risus. Nunc pulvinar nisl sed vehicula rutrum'),
(34, 'Software Engineering', 'Vivamus eleifend augue purus, eu dictum velit rutrum sit amet. Duis vel ullamcorper arcu. Curabitur ac augue sed enim mollis semper. Duis feugiat ac leo a maximus. Sed vestibulum ipsum ex, in commodo odio fringilla eu');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `laboratory`
--

CREATE TABLE `laboratory` (
  `id_laboratory` int(11) NOT NULL,
  `id_class` int(11) NOT NULL,
  `laboratory_name` varchar(64) NOT NULL,
  `laboratory_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `laboratory`
--

INSERT INTO `laboratory` (`id_laboratory`, `id_class`, `laboratory_name`, `laboratory_date`) VALUES
(3, 23, 'hhhhhhhhhhhhhhhhhhh', '2022-06-03 00:00:00'),
(4, 18, 'qqq', '2022-06-04 00:00:00'),
(5, 18, 'qqq2', '2022-06-11 00:00:00');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `laboratory_attendance`
--

CREATE TABLE `laboratory_attendance` (
  `id_laboratory` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `is_present` tinyint(4) NOT NULL,
  `date` datetime NOT NULL,
  `grade` tinyint(4) DEFAULT NULL,
  `mentions` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `role_name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `roles`
--

INSERT INTO `roles` (`id_role`, `role_name`) VALUES
(1, 'sysadmin'),
(2, 'admin'),
(3, 'teacher'),
(4, 'student');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `seminar`
--

CREATE TABLE `seminar` (
  `id_seminar` int(11) NOT NULL,
  `id_class` int(11) NOT NULL,
  `seminar_name` varchar(64) NOT NULL,
  `seminar_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `seminar`
--

INSERT INTO `seminar` (`id_seminar`, `id_class`, `seminar_name`, `seminar_date`) VALUES
(2, 23, 'bbbbbbbbbbbbbc', '2022-06-10 00:00:00'),
(3, 23, 'ccccccccccccc', '2022-06-17 00:00:00'),
(5, 23, 'nnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn', '2022-06-30 00:00:00'),
(6, 23, 'vvvvvvvvvvvvvvvvv', '2022-06-02 00:00:00'),
(7, 23, 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', '2022-06-04 00:00:00');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `seminar_attendance`
--

CREATE TABLE `seminar_attendance` (
  `id_seminar` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `mentions` varchar(256) DEFAULT NULL,
  `last_updated` datetime DEFAULT NULL,
  `is_present` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `seminar_attendance`
--

INSERT INTO `seminar_attendance` (`id_seminar`, `id_user`, `date`, `mentions`, `last_updated`, `is_present`) VALUES
(6, 4, '2022-06-19 02:51:04', '', '2022-06-19 03:17:01', 1),
(6, 21, '2022-06-19 02:51:58', '', '2022-06-19 03:17:01', 1),
(6, 22, '2022-06-19 03:05:29', '', '2022-06-19 03:17:01', 1),
(6, 23, '2022-06-19 02:52:26', '', '2022-06-19 03:17:01', 2),
(6, 24, '2022-06-19 03:05:29', '', '2022-06-19 03:17:01', 0),
(7, 4, '2022-06-19 03:08:48', '', '2022-06-19 03:08:48', 1),
(7, 21, '2022-06-19 03:08:48', '', '2022-06-19 03:08:48', 0),
(7, 22, '2022-06-19 03:08:48', '', '2022-06-19 03:08:48', 1),
(7, 23, '2022-06-19 03:08:48', '', '2022-06-19 03:08:48', 1),
(7, 24, '2022-06-19 03:08:48', '', '2022-06-19 03:08:48', 2);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `reg_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `users`
--

INSERT INTO `users` (`id_user`, `id_role`, `username`, `password`, `first_name`, `last_name`, `email`, `reg_date`) VALUES
(1, 1, 'sysadmin', 'sysadmin', 'sysAdmin1', 'sysAdmin1', 'sysAdmin1@gmail.com', '2022-06-13 15:37:48'),
(2, 2, 'admin', 'admin', 'admin1', 'admin1', 'admin1@gmail.com', '2022-06-13 15:37:48'),
(3, 3, 'teacher', 'teacher', 'teacher1', 'teacher1', 'teacher1@gmail.com', '2022-06-13 15:37:48'),
(4, 4, 'student', 'student', 'student1', 'student1', 'student1@gmail.com', '2022-06-13 15:37:48'),
(21, 4, 'escl20', 'escl20', 'Esme', 'Clark', 'esme.clark@email.com', '2022-06-13 15:37:48'),
(22, 4, 'naal62', 'naal62', 'Naomi', 'Allen', 'naomi.allen@email.com', '2022-06-13 15:37:48'),
(23, 4, 'emhe79', 'emhe79', 'Emery', 'Hendricks', 'emery.hendricks@email.com', '2022-06-13 15:37:48'),
(24, 4, 'cemy69', 'cemy69', 'Cecelia', 'Myers', 'cecelia.myers@email.com', '2022-06-13 15:37:48'),
(25, 4, 'ishi16', 'ishi16', 'Isabel', 'Higgins', 'isabel.higgins@email.com', '2022-06-13 15:37:48'),
(26, 4, 'meca79', 'meca79', 'Meadow', 'Carlson', 'meadow.carlson@email.com', '2022-06-13 15:37:48'),
(27, 4, 'ripa79', 'ripa79', 'River', 'Parry', 'river.parry@email.com', '2022-06-13 15:37:48'),
(28, 4, 'lefr42', 'lefr42', 'Lesley', 'Fraser', 'lesley.fraser@email.com', '2022-06-13 15:37:48'),
(29, 4, 'stbu18', 'stbu18', 'Steff', 'Burton', 'steff.burton@email.com', '2022-06-13 15:37:48'),
(30, 4, 'saho26', 'saho26', 'Sammy', 'Hopkins', 'sammy.hopkins@email.com', '2022-06-13 15:37:48'),
(32, 4, 'skhi30', 'skhi30', 'Skyler', 'Hill', 'skyler.hill@email.com', '2022-06-13 15:37:48'),
(33, 4, 'caes57', 'caes57', 'Caden', 'Espinoza', 'caden.espinoza@email.com', '2022-06-13 15:37:48'),
(34, 4, 'roro57', 'roro57', 'Robin', 'Roberts', 'robin.roberts@email.com', '2022-06-13 15:37:48'),
(36, 4, 'hape99', 'hape99', 'Harper', 'Peck', 'harper.peck@email.com', '2022-06-13 15:37:48'),
(37, 4, 'iscu75', 'iscu75', 'Isabelle', 'Cunningham', 'isabelle.cunningham@email.com', '2022-06-13 15:37:48'),
(38, 4, 'kepr96', 'kepr96', 'Keira', 'Price', 'keira.price@email.com', '2022-06-13 15:37:48'),
(39, 4, 'maat66', 'maat66', 'Maria', 'Atkinson', 'maria.atkinson@email.com', '2022-06-13 15:37:48'),
(40, 4, 'jakh41', 'jakh41', 'Jasmine', 'Khan', 'jasmine.khan@email.com', '2022-06-13 15:37:48'),
(41, 4, 'pabu73', 'pabu73', 'Paige', 'Burke', 'paige.burke@email.com', '2022-06-13 15:37:48'),
(42, 4, 'kasa79', 'kasa79', 'Karen', 'Sanchez', 'karen.sanchez@email.com', '2022-06-13 15:37:48'),
(43, 4, 'laho67', 'laho67', 'Laurel', 'Howard', 'laurel.howard@email.com', '2022-06-13 15:37:48'),
(44, 4, 'list77', 'list77', 'Lillyana', 'Stanton', 'lillyana.stanton@email.com', '2022-06-13 15:37:48'),
(45, 4, 'chri93', 'chri93', 'Cherish', 'Richardson', 'cherish.richardson@email.com', '2022-06-13 15:37:48'),
(46, 4, 'elle82', 'elle82', 'Elaine', 'Levine', 'elaine.levine@email.com', '2022-06-13 15:37:48'),
(47, 4, 'jopr46', 'jopr46', 'Josh', 'Price', 'josh.price@email.com', '2022-06-13 15:37:48'),
(48, 4, 'hath50', 'hath50', 'Harrison', 'Thomas', 'harrison.thomas@email.com', '2022-06-13 15:37:48'),
(49, 4, 'mapr46', 'mapr46', 'Mason', 'Price', 'mason.price@email.com', '2022-06-13 15:37:48'),
(50, 4, 'sapo64', 'sapo64', 'Sam', 'Powell', 'sam.powell@email.com', '2022-06-13 15:37:48'),
(51, 4, 'elbu38', 'elbu38', 'Ellis', 'Burke', 'ellis.burke@email.com', '2022-06-13 15:37:48'),
(54, 4, 'jaev73', 'jaev73', 'Jaden', 'Everett', 'jaden.everett@email.com', '2022-06-13 15:37:48'),
(55, 4, 'nopa91', 'nopa91', 'Noah', 'Padilla', 'noah.padilla@email.com', '2022-06-13 15:37:48'),
(56, 4, 'nash42', 'nash42', 'Nathan', 'Sheppard', 'nathan.sheppard@email.com', '2022-06-13 15:37:48'),
(57, 4, 'phan45', 'phan45', 'Phoebe', 'Andrews', 'phoebe.andrews@email.com', '2022-06-13 15:37:48'),
(58, 4, 'elsm68', 'elsm68', 'Elsie', 'Smith', 'elsie.smith@email.com', '2022-06-13 15:37:48'),
(59, 4, 'mejo53', 'mejo53', 'Melissa', 'Jordan', 'melissa.jordan@email.com', '2022-06-13 15:37:48'),
(60, 4, 'emwa20', 'emwa20', 'Emilia', 'Wallace', 'emilia.wallace@email.com', '2022-06-13 15:37:48'),
(61, 4, 'macu71', 'macu71', 'Maisy', 'Cunningham', 'maisy.cunningham@email.com', '2022-06-13 15:37:48'),
(64, 4, 'olca56', 'olca56', 'Olivia', 'Castillo', 'olivia.castillo@email.com', '2022-06-13 15:37:48'),
(65, 4, 'skph73', 'skph73', 'Skyla', 'Phelps', 'skyla.phelps@email.com', '2022-06-13 15:37:48'),
(67, 4, 'lahe33', 'lahe33', 'Lane', 'Henderson', 'lane.henderson@email.com', '2022-06-13 15:37:48'),
(69, 4, 'chpo43', 'chpo43', 'Charlie', 'Porter', 'charlie.porter@email.com', '2022-06-13 15:37:48'),
(71, 4, 'camo29', 'camo29', 'Caden', 'Morris', 'caden.morris@email.com', '2022-06-13 15:37:48'),
(72, 4, 'stco68', 'stco68', 'Steff', 'Cox', 'steff.cox@email.com', '2022-06-13 15:37:48'),
(73, 4, 'mafr14', 'mafr14', 'Maddox', 'Franks', 'maddox.franks@email.com', '2022-06-13 15:37:48'),
(74, 4, 'lefi64', 'lefi64', 'Leigh', 'Fischer', 'leigh.fischer@email.com', '2022-06-13 15:37:48'),
(75, 4, 'joch15', 'joch15', 'Jordan', 'Cherry', 'jordan.cherry@email.com', '2022-06-13 15:37:48'),
(76, 4, 'chca81', 'chca81', 'Charlie', 'Campos', 'charlie.campos@email.com', '2022-06-13 15:37:48'),
(78, 4, 'fabr74', 'fabr74', 'Faith', 'Brooks', 'faith.brooks@email.com', '2022-06-13 15:37:48'),
(79, 4, 'catu56', 'catu56', 'Caitlin', 'Turner', 'caitlin.turner@email.com', '2022-06-13 15:37:48'),
(80, 4, 'ruho49', 'ruho49', 'Ruby', 'Howard', 'ruby.howard@email.com', '2022-06-13 15:37:48'),
(81, 4, 'kafo58', 'kafo58', 'Kayla', 'Fox', 'kayla.fox@email.com', '2022-06-13 15:37:48'),
(83, 4, 'lamu12', 'lamu12', 'Lainey', 'Mullen', 'lainey.mullen@email.com', '2022-06-13 15:37:48'),
(84, 4, 'chba98', 'chba98', 'Christina', 'Barrera', 'christina.barrera@email.com', '2022-06-13 15:37:48'),
(86, 4, 'sobo80', 'sobo80', 'Sofie', 'Bonner', 'sofie.bonner@email.com', '2022-06-13 15:37:48'),
(88, 4, 'kaha92', 'kaha92', 'Kayden', 'Hayes', 'kayden.hayes@email.com', '2022-06-13 15:37:48'),
(89, 4, 'lufr86', 'lufr86', 'Luca', 'Fraser', 'luca.fraser@email.com', '2022-06-13 15:37:48'),
(91, 4, 'isbr52', 'isbr52', 'Isaac', 'Brown', 'isaac.brown@email.com', '2022-06-13 15:37:48'),
(93, 4, 'brmu18', 'brmu18', 'Braylen', 'Murray', 'braylen.murray@email.com', '2022-06-13 15:37:48'),
(94, 4, 'gafi77', 'gafi77', 'Gauge', 'Fisher', 'gauge.fisher@email.com', '2022-06-13 15:37:48'),
(95, 4, 'cobl27', 'cobl27', 'Colby', 'Blanchard', 'colby.blanchard@email.com', '2022-06-13 15:37:48'),
(96, 4, 'cabr89', 'cabr89', 'Camilo', 'Brown', 'camilo.brown@email.com', '2022-06-13 15:37:48'),
(98, 4, 'cawa20', 'cawa20', 'Carol', 'Walsh', 'carol.walsh@email.com', '2022-06-13 15:37:48'),
(107, 4, 'ccc', 'ccc', 'ccc', 'ccc', 'ccc@c.c', '2022-06-13 15:37:48'),
(118, 4, 'fff', 'fff', 'fff', 'fff', 'fff@f.ff', '2022-06-13 15:37:48'),
(120, 4, 'qqqqqqqqq', 'qqq', 'qqq', 'qqq', 'qq@qq.qq', '2022-06-13 15:37:48'),
(122, 4, 'cvcvcv', 'cvc', 'sd', 'sd', 'cvcv@ddsa.s', '2022-06-13 15:37:48'),
(123, 3, 'joby17', 'joby17', 'Jordan', 'Byrne', 'jordan.byrne@email.com', '2022-06-13 15:37:48'),
(124, 3, 'osco47', 'osco47', 'Oscar', 'Cox', 'oscar.cox@email.com', '2022-06-13 15:37:48'),
(125, 3, 'frja64', 'frja64', 'Frederick', 'Jackson', 'frederick.jackson@email.com', '2022-06-13 15:37:48'),
(126, 3, 'reda65', 'reda65', 'Reece', 'Dawson', 'reece.dawson@email.com', '2022-06-13 15:37:48'),
(127, 3, 'hama67', 'hama67', 'Harry', 'Matthews', 'harry.matthews@email.com', '2022-06-13 15:37:48'),
(128, 4, 'test', 'test', 'Jordan', 'Byrne', 'jordan.byrne@email.com', '2022-06-13 15:37:48');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users_classes`
--

CREATE TABLE `users_classes` (
  `id_user` int(11) NOT NULL,
  `id_class` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `users_classes`
--

INSERT INTO `users_classes` (`id_user`, `id_class`) VALUES
(3, 5),
(3, 18),
(3, 23),
(4, 20),
(4, 23),
(21, 20),
(21, 23),
(22, 20),
(22, 23),
(23, 20),
(23, 23),
(24, 23),
(25, 5),
(26, 5),
(27, 5),
(28, 5),
(29, 5),
(30, 5),
(32, 5),
(33, 5),
(34, 5),
(36, 5),
(37, 5),
(38, 5),
(39, 5),
(40, 5),
(41, 5),
(42, 5),
(43, 5),
(44, 5),
(45, 5),
(46, 5),
(47, 5),
(48, 5),
(49, 5),
(50, 5),
(51, 5),
(54, 5),
(55, 5),
(56, 5),
(57, 5),
(58, 5),
(59, 5),
(60, 5),
(61, 5),
(64, 5),
(65, 5),
(67, 5),
(69, 5),
(71, 5),
(72, 5),
(73, 5),
(74, 5),
(75, 5),
(76, 5),
(78, 5),
(79, 5),
(80, 5),
(81, 5),
(83, 5),
(84, 5),
(86, 5),
(88, 5),
(89, 5),
(91, 5),
(93, 5),
(94, 5),
(95, 5),
(96, 5),
(98, 5),
(107, 5),
(118, 5),
(120, 5),
(122, 5),
(123, 5),
(123, 20),
(124, 5),
(124, 20),
(125, 5),
(125, 20),
(126, 5),
(127, 5);

-- --------------------------------------------------------

--
-- Substitut structură pentru vizualizare `user_roles`
-- (Vezi mai jos vizualizarea actuală)
--
CREATE TABLE `user_roles` (
`username` varchar(32)
,`role_name` varchar(32)
);

-- --------------------------------------------------------

--
-- Structură pentru vizualizare `user_roles`
--
DROP TABLE IF EXISTS `user_roles`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_roles`  AS SELECT `u`.`username` AS `username`, `r`.`role_name` AS `role_name` FROM (`users` `u` join `roles` `r` on(`u`.`id_role` = `r`.`id_role`)) ;

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id_class`);

--
-- Indexuri pentru tabele `laboratory`
--
ALTER TABLE `laboratory`
  ADD PRIMARY KEY (`id_laboratory`),
  ADD KEY `FK_32` (`id_class`);

--
-- Indexuri pentru tabele `laboratory_attendance`
--
ALTER TABLE `laboratory_attendance`
  ADD PRIMARY KEY (`id_laboratory`,`id_user`),
  ADD KEY `FK_38` (`id_user`),
  ADD KEY `FK_47` (`id_laboratory`);

--
-- Indexuri pentru tabele `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexuri pentru tabele `seminar`
--
ALTER TABLE `seminar`
  ADD PRIMARY KEY (`id_seminar`),
  ADD KEY `FK_35` (`id_class`);

--
-- Indexuri pentru tabele `seminar_attendance`
--
ALTER TABLE `seminar_attendance`
  ADD PRIMARY KEY (`id_seminar`,`id_user`),
  ADD KEY `FK_41` (`id_user`),
  ADD KEY `FK_44` (`id_seminar`);

--
-- Indexuri pentru tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `FK_29` (`id_role`);

--
-- Indexuri pentru tabele `users_classes`
--
ALTER TABLE `users_classes`
  ADD PRIMARY KEY (`id_user`,`id_class`),
  ADD KEY `FK_22` (`id_user`),
  ADD KEY `FK_25` (`id_class`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `classes`
--
ALTER TABLE `classes`
  MODIFY `id_class` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pentru tabele `laboratory`
--
ALTER TABLE `laboratory`
  MODIFY `id_laboratory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pentru tabele `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pentru tabele `seminar`
--
ALTER TABLE `seminar`
  MODIFY `id_seminar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pentru tabele `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `laboratory`
--
ALTER TABLE `laboratory`
  ADD CONSTRAINT `FK_30` FOREIGN KEY (`id_class`) REFERENCES `classes` (`id_class`);

--
-- Constrângeri pentru tabele `laboratory_attendance`
--
ALTER TABLE `laboratory_attendance`
  ADD CONSTRAINT `FK_36` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `FK_45` FOREIGN KEY (`id_laboratory`) REFERENCES `laboratory` (`id_laboratory`);

--
-- Constrângeri pentru tabele `seminar`
--
ALTER TABLE `seminar`
  ADD CONSTRAINT `FK_33` FOREIGN KEY (`id_class`) REFERENCES `classes` (`id_class`);

--
-- Constrângeri pentru tabele `seminar_attendance`
--
ALTER TABLE `seminar_attendance`
  ADD CONSTRAINT `FK_39` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `FK_42` FOREIGN KEY (`id_seminar`) REFERENCES `seminar` (`id_seminar`);

--
-- Constrângeri pentru tabele `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_27` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`);

--
-- Constrângeri pentru tabele `users_classes`
--
ALTER TABLE `users_classes`
  ADD CONSTRAINT `FK_20` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `FK_23` FOREIGN KEY (`id_class`) REFERENCES `classes` (`id_class`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
