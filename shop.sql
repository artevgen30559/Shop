

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";




CREATE TABLE `prise` (
  `id` int(50) NOT NULL,
  `num` text NOT NULL,
  `name` text NOT NULL,
  `cost` int(30) NOT NULL,
  `value` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO `prise` (`id`, `num`, `name`, `cost`, `value`) VALUES
(1, '1234545', 'tea', 100, 100),
(2, '541141534', 'coffee', 50, 148),
(3, '1234545', 'tea', 100, 100),
(4, '541141534', 'coffee', 50, 148);





CREATE TABLE `tread` (
  `id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `prise_id` int(50) NOT NULL,
  `prise_value` int(50) NOT NULL,
  `tread_const` int(50) NOT NULL,
  `tread_data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;





CREATE TABLE `users` (
  `user_id` int(50) NOT NULL,
  `login` tinytext NOT NULL,
  `password` text NOT NULL,
  `user_balance` int(50) NOT NULL,
  `dtat_regist` datetime NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



ALTER TABLE `prise`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `tread`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `prise_id` (`prise_id`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);


ALTER TABLE `prise`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


ALTER TABLE `tread`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;


ALTER TABLE `users`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT;


ALTER TABLE `tread`
  ADD CONSTRAINT `tread_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `tread_ibfk_2` FOREIGN KEY (`prise_id`) REFERENCES `prise` (`id`);
COMMIT;

