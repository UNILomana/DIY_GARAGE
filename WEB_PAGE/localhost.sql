-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 11-05-2022 a las 10:06:00
-- Versión del servidor: 8.0.29-0ubuntu0.20.04.3
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_garage`
--
CREATE DATABASE IF NOT EXISTS `db_garage` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_garage`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bookings`
--

CREATE TABLE `bookings` (
  `Booking_Id` int NOT NULL,
  `User_Id` varchar(9) NOT NULL,
  `Cabin_Id` int NOT NULL,
  `Date` date NOT NULL,
  `Hour` time NOT NULL,
  `Vehicle_Type` varchar(30) NOT NULL,
  `Employee_Help` varchar(5) NOT NULL DEFAULT 'no',
  `Employee_Id` varchar(9) DEFAULT NULL,
  `Use_Hours` int NOT NULL DEFAULT '1',
  `Price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `bookings`
--

INSERT INTO `bookings` (`Booking_Id`, `User_Id`, `Cabin_Id`, `Date`, `Hour`, `Vehicle_Type`, `Employee_Help`, `Employee_Id`, `Use_Hours`, `Price`) VALUES
(99, '22222222L', 7, '2022-04-07', '16:00:00', 'Big vehicles', 'yes', '44444444F', 1, 40),
(108, '11111111A', 7, '2022-03-30', '10:00:00', 'Big vehicles', 'yes', '44444444F', 2, 600),
(111, '11111111A', 3, '2022-03-16', '10:00:00', 'Cars', 'no', '44444444F', 1, 1000),
(114, '22222222L', 5, '2022-04-26', '12:00:00', 'Motorbikes', 'yes', '44444444F', 1, 20),
(147, '22222222L', 5, '2022-04-14', '12:00:00', 'Motorbikes', 'yes', '44444444F', 2, 40),
(149, '22222222L', 7, '2022-05-08', '16:00:00', 'Big vehicles', 'no', NULL, 5, 200),
(150, '22222222L', 6, '2022-04-29', '12:00:00', 'Motorbikes', 'yes', '44444444F', 3, 60),
(151, '22222222L', 1, '2022-04-30', '11:00:00', 'Cars', 'yes', '44444444F', 1, 30),
(153, '22222222L', 2, '2022-05-04', '09:00:00', 'Cars', 'yes', '44444444F', 2, 60);

--
-- Disparadores `bookings`
--
DELIMITER $$
CREATE TRIGGER `delete_booking_cabin_0` AFTER INSERT ON `bookings` FOR EACH ROW UPDATE cabins
SET cabins.Disponibility = 0
WHERE cabins.Cabin_Id = NEW.Cabin_Id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete_booking_cabin_1` AFTER DELETE ON `bookings` FOR EACH ROW UPDATE cabins
SET cabins.Disponibility = 1
WHERE cabins.Cabin_Id = OLD.Cabin_Id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cabins`
--

CREATE TABLE `cabins` (
  `Cabin_Id` int NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Disponibility` tinyint(1) NOT NULL,
  `Helper` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cabins`
--

INSERT INTO `cabins` (`Cabin_Id`, `Type`, `Disponibility`, `Helper`) VALUES
(1, 'Cars', 1, '11111111A'),
(2, 'Cars', 1, '22222222B'),
(3, 'Cars', 1, '33333333C'),
(4, 'Cars', 1, '55555555E'),
(5, 'Motorbikes', 1, '11111111A'),
(6, 'Motorbikes', 0, '22222222B'),
(7, 'Big vehicles', 0, '33333333C'),
(8, 'Big vehicles', 1, '55555555E');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees`
--

CREATE TABLE `employees` (
  `Employee_Id` varchar(9) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Surname` varchar(50) NOT NULL,
  `TLF` int NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `employees`
--

INSERT INTO `employees` (`Employee_Id`, `Name`, `Surname`, `TLF`, `Address`, `Email`, `Password`) VALUES
('11111111A', 'Markel', 'Lomana', 123456789, '', 'lomana@gmail.com', '12345678'),
('22222222B', 'Raul', 'Parra', 123456789, '', 'raul@gmail.com', '12345678'),
('33333333C', 'Mikel', 'Perez', 123456789, '', 'perez@gmail.com', '12345678'),
('44444444F', 'Empleado', 'Garage', 123456789, '', 'empleado@uni.eus', '12345678'),
('55555555E', 'Ander', 'Garcia', 123456789, '', 'garcia@gmail.com', '12345678');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `Product_Id` int NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Price` float NOT NULL,
  `Stock` int NOT NULL,
  `Product_picture` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`Product_Id`, `Name`, `Price`, `Stock`, `Product_picture`) VALUES
(1, 'Oil', 10.5, 200, '../Images/Products/oil.jpg'),
(2, 'Chains', 55.9, 100, '../Images/Products/cadenas.jpg'),
(3, 'Air Filter', 15.2, 120, '../Images/Products/filtro.jpg'),
(4, 'Car mats', 14.75, 100, '../Images/Products/alfombrillas.jpg'),
(5, 'Brake pads', 20.5, 250, '../Images/Products/pastillas.jpg'),
(6, 'Spark Plug', 15.75, 150, '../Images/Products/bujia.jpg'),
(7, 'Shock-absorber', 85.9, 175, '../Images/Products/amortiguador.jpg'),
(8, 'Fuse kit', 14.5, 230, '../Images/Products/fusibles.jpg'),
(9, 'Tyres', 60.35, 497, '../Images/Products/neumatico.jpeg'),
(10, 'Led Lights', 14.35, 200, '../Images/Products/led.jpg'),
(13, 'kaka', 10.23, 300, '../Images/Products/1638442975245.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchase`
--

CREATE TABLE `purchase` (
  `Purchase_Id` int NOT NULL,
  `User_Id` varchar(9) NOT NULL,
  `Product_Id` int NOT NULL,
  `Quantity` int NOT NULL,
  `Date` date NOT NULL,
  `Total_Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `purchase`
--

INSERT INTO `purchase` (`Purchase_Id`, `User_Id`, `Product_Id`, `Quantity`, `Date`, `Total_Price`) VALUES
(35, '11111111A', 1, 3, '2022-03-30', 0),
(39, '22222222A', 8, 20, '2022-03-16', 150),
(40, '22222222L', 9, 3, '2022-05-11', 181.05);

--
-- Disparadores `purchase`
--
DELIMITER $$
CREATE TRIGGER `añadir_stock` AFTER DELETE ON `purchase` FOR EACH ROW UPDATE products
SET products.Stock = (products.Stock + OLD.Quantity)
WHERE products.Product_Id = OLD.Product_Id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `restar_stock` AFTER INSERT ON `purchase` FOR EACH ROW UPDATE products
SET products.Stock = (products.Stock - NEW.Quantity)
WHERE products.Product_Id = NEW.Product_Id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `User_Id` varchar(9) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Surname` varchar(30) NOT NULL,
  `TLF` int NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Profile_Img` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`User_Id`, `Name`, `Surname`, `TLF`, `Email`, `Password`, `Profile_Img`) VALUES
('11111111A', 'Usuario', 'Berria', 943200000, 'u.berria@gmail.com', 'Pasahitza', ''),
('11111111N', 'Unai', 'Perez', 0, 'unai@gmail.com', '12345678', ''),
('22222222A', 'Markel', 'Lomana', 0, 'parra@gmail.com', '123456', '../Images/Clients/1638442975245.jpg'),
('22222222L', 'Cliente', 'Bezeroa', 987654321, 'cliente@uni.eus', '12345678', '../Images/Clients//1638442975245.jpg'),
('99999999A', 'Iker', 'Fernandez', 0, 'iker.fer@gmail', '123456', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehicles`
--

CREATE TABLE `vehicles` (
  `Type` varchar(30) NOT NULL,
  `Price_Hour` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `vehicles`
--

INSERT INTO `vehicles` (`Type`, `Price_Hour`) VALUES
('Big vehicles', 40),
('Cars', 30),
('Motorbikes', 20);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`Booking_Id`),
  ADD KEY `User_Id` (`User_Id`),
  ADD KEY `Garage_Id` (`Cabin_Id`),
  ADD KEY `Vehicle_Type` (`Vehicle_Type`),
  ADD KEY `Employee_Id` (`Employee_Id`);

--
-- Indices de la tabla `cabins`
--
ALTER TABLE `cabins`
  ADD PRIMARY KEY (`Cabin_Id`),
  ADD KEY `Type` (`Type`),
  ADD KEY `Helper` (`Helper`);

--
-- Indices de la tabla `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`Employee_Id`),
  ADD KEY `Email` (`Email`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Product_Id`);

--
-- Indices de la tabla `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`Purchase_Id`),
  ADD KEY `User_Id` (`User_Id`),
  ADD KEY `Product_Id` (`Product_Id`),
  ADD KEY `Product_Id_2` (`Product_Id`),
  ADD KEY `Product_Id_3` (`Product_Id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_Id`),
  ADD KEY `Email` (`Email`);

--
-- Indices de la tabla `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`Type`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bookings`
--
ALTER TABLE `bookings`
  MODIFY `Booking_Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `Product_Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `purchase`
--
ALTER TABLE `purchase`
  MODIFY `Purchase_Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`Cabin_Id`) REFERENCES `cabins` (`Cabin_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_4` FOREIGN KEY (`Employee_Id`) REFERENCES `employees` (`Employee_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_5` FOREIGN KEY (`User_Id`) REFERENCES `users` (`User_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cabins`
--
ALTER TABLE `cabins`
  ADD CONSTRAINT `cabins_ibfk_1` FOREIGN KEY (`Type`) REFERENCES `vehicles` (`Type`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cabins_ibfk_2` FOREIGN KEY (`Helper`) REFERENCES `employees` (`Employee_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_2` FOREIGN KEY (`User_Id`) REFERENCES `users` (`User_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_ibfk_3` FOREIGN KEY (`Product_Id`) REFERENCES `products` (`Product_Id`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Base de datos: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int UNSIGNED NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin COMMENT='Settings related to Designer';

--
-- Volcado de datos para la tabla `pma__designer_settings`
--

INSERT INTO `pma__designer_settings` (`username`, `settings_data`) VALUES
('Markel', '{\"angular_direct\":\"direct\",\"relation_lines\":\"true\",\"snap_to_grid\":\"off\"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

--
-- Volcado de datos para la tabla `pma__pdf_pages`
--

INSERT INTO `pma__pdf_pages` (`db_name`, `page_nr`, `page_descr`) VALUES
('db_garage', 1, 'Erlazioak');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Volcado de datos para la tabla `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('Markel', '[{\"db\":\"db_garage\",\"table\":\"users\"},{\"db\":\"db_garage\",\"table\":\"products\"},{\"db\":\"db_garage\",\"table\":\"purchase\"},{\"db\":\"db_garage\",\"table\":\"bookings\"}]'),
('root', '[{\"db\":\"db_garage\",\"table\":\"employees\"},{\"db\":\"db_garage\",\"table\":\"users\"},{\"db\":\"db_garage\",\"table\":\"purchase\"},{\"db\":\"db_garage\",\"table\":\"cabins\"},{\"db\":\"db_garage\",\"table\":\"products\"}]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int NOT NULL DEFAULT '0',
  `x` float UNSIGNED NOT NULL DEFAULT '0',
  `y` float UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

--
-- Volcado de datos para la tabla `pma__table_coords`
--

INSERT INTO `pma__table_coords` (`db_name`, `table_name`, `pdf_page_number`, `x`, `y`) VALUES
('db_garage', 'bookings', 1, 509, 260),
('db_garage', 'cabins', 1, 845, 155),
('db_garage', 'employees', 1, 234, 101),
('db_garage', 'products', 1, 1047, 509),
('db_garage', 'purchase', 1, 779, 548),
('db_garage', 'users', 1, 515, 525),
('db_garage', 'vehicles', 1, 828, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin,
  `data_sql` longtext COLLATE utf8_bin,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Volcado de datos para la tabla `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `config_data`) VALUES
('Markel', '{\"lang\":\"es\",\"Console\\/Mode\":\"collapse\"}'),
('root', '{\"lang\":\"es\",\"Console\\/Mode\":\"collapse\"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indices de la tabla `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indices de la tabla `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indices de la tabla `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indices de la tabla `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indices de la tabla `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indices de la tabla `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indices de la tabla `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indices de la tabla `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indices de la tabla `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indices de la tabla `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indices de la tabla `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indices de la tabla `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indices de la tabla `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
