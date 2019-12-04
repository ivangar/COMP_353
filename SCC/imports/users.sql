-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2019 at 09:18 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scc_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `middle_name` varchar(250) DEFAULT NULL,
  `last_name` varchar(250) NOT NULL,
  `user_pwd` varchar(1000) NOT NULL,
  `address` varchar(500) DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(120) NOT NULL,
  `organization` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `middle_name`, `last_name`, `user_pwd`, `address`, `date_of_birth`, `email`, `organization`) VALUES
(781264, 'Kalpdrum', NULL, 'Passi', '$2y$10$i6ah.SR.n9Qxb1uN3GemueD4TMiLPxx3ameFnLXCeceiq1I1mKhqK', '123 street street', '0000-00-00', 'aemail@ca.ca', ' org '),
(1043082, 'Hannes', NULL, 'Voigt', '$2y$10$vvk4rUx0aTZL/tUKK.OQBuiKX.ghib6bJ4Deoa9J3/qP7GrgoMWYC', '123 street street', '0000-00-00', 'xemail@ca.ca', ' org '),
(1157581, 'Wookey', NULL, 'Lee', '$2y$10$qRY137wuJ/8xI4vpwd5ZD.RGh6cOMZeX5lAzM9Htd7egYYi5wQfz.', '123 street street', '0000-00-00', 'ddemail@ca.ca', ' org '),
(1751053, 'Sandra', NULL, 'Deamo', '$2y$10$iTQWCgPzeAhd1YVyhegLIu1yMEOqIPStS3IRZKYAEnmiuaA44IHl6', '123 street street', '0000-00-00', 'eemail@ca.ca', ' org '),
(1940295, 'Normand', NULL, 'Seguin', '$2y$10$p3MjVUVo5QvN8X6xEHtiOuyy4fVNywoMlwseVahGp3L9B8DCtvVkS', '123 street street', '0000-00-00', 'lemail@ca.ca', ' org '),
(2135714, 'Di', NULL, 'Wang', '$2y$10$QmHPjf5D5B4Y8F.rKkUV0OYgJROORkibYgkM6V.ghlJlGo.Cj4qcu', '123 street street', '0000-00-00', 'yemail@ca.ca', ' org '),
(3060862, 'Theo', NULL, 'Harder', '$2y$10$XloLbvnLY4RiSSXvQWKegePzYDkFIRU1mwvqKk2Wu65eeglpyls8W', '123 street street', '0000-00-00', 'uemail@ca.ca', ' org '),
(3143297, 'Dominique', NULL, 'Laurent', '$2y$10$5fuNZTnV8WMdkQr3GvY3Lef0KuEOjc8ldaMecRHA6.cEWaVjkLUkS', '123 street street', '0000-00-00', 'wemail@ca.ca', ' org '),
(3715673, 'Shri', 'Kant', 'Ojha', '$2y$10$j2jMpU/A4QepLgexnpsjyuRhqCFkG8eCWQ.HX.fGD4vd6yCivrdtO', '123 street street', '0000-00-00', 'pemail@ca.ca', ' org '),
(4433784, 'Ozgur', NULL, 'Ulusoy', '$2y$10$/r886wBtQzviDQCr6XTcGeUrpTikdXz62Qt/M8BvMVxxLmjYkUxva', '123 street street', '0000-00-00', 'semail@ca.ca', ' org '),
(4480757, 'Carlos', 'Jose', 'Lucena', '$2y$10$BT5LRWMW6M4.QSd.p4REYOGwO8oUMRzdtobG0HdoyjYWs6sdTqmp6', '123 street street', '0000-00-00', 'zemail@ca.ca', ' org '),
(4569161, 'Leong', NULL, 'Lee', '$2y$10$Xkuhzu1aFHv2GIEiz9uWjOXNgDNjfke8mxRiO.FgxYYhezJCdM4Zq', '123 street street', '0000-00-00', 'nemail@ca.ca', ' org '),
(5526601, 'Sanja', NULL, 'Candrlic', '$2y$10$jmbuprs/UtRI71r1RxGpEOXUsUqspC1F2gCk5lRFeZBc.PKLNf8qe', '123 street street', '0000-00-00', 'memail@ca.ca', ' org '),
(5528650, 'John', NULL, 'Plaice', '$2y$10$I6M5bEVj7sBhc432tH.JxeEFhvfbZ7FH9dj9s8bXqAu1glF/M9mmq', '123 street street', '0000-00-00', 'oemail@ca.ca', ' org '),
(5677623, 'R.', 'K.', 'Agrawal', '$2y$10$tg6bVlmR.IiTwogclEB3kean1CYlrKqPafvk8.rLegeoyxU6PkLgO', '123 street street', '0000-00-00', 'kemail@ca.ca', ' org '),
(6461563, 'Cagatay', NULL, 'Catal', '$2y$10$TuLaSoX.ro25J7aC4AIv/.RyVJV8.gBVIKGGZG67BTMN2IBurKpU.', '123 street street', '0000-00-00', 'temail@ca.ca', ' org '),
(6630784, 'Jennifer', 'L', 'Leopold', '$2y$10$kamVljKETUoJwq0tg7vO4ehj2tFBtV3JPBj0.ABx6pv2FGcDWfc76', '123 street street', '0000-00-00', 'vemail@ca.ca', ' org '),
(6797613, 'Michael', NULL, 'Jenkin', '$2y$10$J7Kw4rzQup7Y8vTJghPK4eBqJH2tUMNCeOpQmT/mumgfi7ouqRvma', '123 street street', '0000-00-00', 'jemail@ca.ca', ' org '),
(6890285, 'Jeevaratnam', NULL, 'Kolins', '$2y$10$lk07wXhE7g/87duGk6.HAuMMycA5lX.emmJU6FqVRlBR92Qwrw9hO', '123 street street', '0000-00-00', 'iemail@ca.ca', ' org '),
(7034113, 'Kyoko', NULL, 'Nagano', '$2y$10$OdK5jf1SFLAbu2iKchr3yOeCMzU1SoJARW6BHRevvuYn1u7.iby96', '123 street street', '0000-00-00', 'bemail@ca.ca', '  '),
(7126196, 'Udai', NULL, 'Shanker', '$2y$10$oHzK0.x3QsdYHig3M.BReO0u2H1wOP4Tyd8m74Qvz8HWC1jxfdRj.', '123 street street', '0000-00-00', 'aaemail@ca.ca', ' org '),
(7137011, 'Olivier', NULL, 'Savarybelanger', '$2y$10$ZMPYsxgYaWMHY4sq3Gita.pQoAjL2uUPR7gc95U.304JwvXNDY3lO', '123 street street', '0000-00-00', 'bbemail@ca.ca', ' org '),
(7935081, 'Guenter', NULL, 'Hackl', '$2y$10$m0Lkg0aetzHvwOsvESG7feBoc.Q5EfN9D5ljo9fW3ay8nbnA.Ct0a', '123 street street', '0000-00-00', 'remail@ca.ca', ' org '),
(8263266, 'Rainer', NULL, 'Unland', '$2y$10$ni5W4.FKT9pZHSWCvlrvb.YenoLM7p1ZbdBL77aEKfYDHPhIUKDKi', '123 street street', '0000-00-00', 'qemail@ca.ca', ' org '),
(8634886, 'Alfredo', NULL, 'Cuzzocrea', '$2y$10$MzYFolEdSENGUAiqz/5bbesryBWDvogcpyTlT1MejfpWeLHuJqzuq', '123 street street', '0000-00-00', 'cemail@ca.ca', ' org '),
(8640039, 'Wolfgang', NULL, 'Lehner', '$2y$10$A5A5nQ6Oig5shbruP5/1ruosUVKs6oGj0IGMmkfjpa4wr2OrqAASy', '123 street street', '0000-00-00', 'hemail@ca.ca', ' org '),
(9547285, 'Alen', NULL, 'Jakupovic', '$2y$10$K7coGNs8VKsMAtlBlkhJD.26aqwKi0AzINvL77CKtdvOjGWTbhRV6', '123 street street', '0000-00-00', 'gemail@ca.ca', ' org '),
(9693449, 'Christine', NULL, 'Collet', '$2y$10$OF24l9mGiy1/me4Hw.sMpOeYUlq4cJhiHSrRFyGnS8FPVljxawQ3C', '123 street street', '0000-00-00', 'demail@ca.ca', ' org '),
(9818575, 'Ratvinder', 'S', 'Grewal', '$2y$10$U/N1p8zsGwEbVQjvbX9eLOLlBbjAdlgDMlOETMXZJ3VXIIDM.EU/6', '123 street street', '0000-00-00', 'ccemail@ca.ca', ' org '),
(9981456, 'Roger', 'Castillo', 'Espinola', '$2y$10$cwqgN3Nk2zxhraNWQ0RFgeLDvb5aDdi8Xk3K7lPuNpDHBqGnqUBWq', '123 street street', '0000-00-00', 'femail@ca.ca', ' org ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9981457;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
