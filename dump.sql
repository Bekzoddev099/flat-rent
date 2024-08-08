CREATE TABLE IF NOT EXISTS `users` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(255),
  `position` varchar(255),
  `gender` enum('male', 'female'),
  `phone`  varchar(255),
  `created_at` timestamp
);

CREATE TABLE `ads` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(255),
  `description` text,
  `user_id` integer,
  `status_id` int,
  `address` varchar(255),
  `branch_id`  int,
  `price` float,
  `rooms` int,
  `created_at` timestamp
);

CREATE TABLE `branch` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255),
  `address` varchar (255),
  `created_at` timestamp
);

CREATE TABLE `status` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255)
);

ALTER TABLE `ads` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
ALTER TABLE `ads` ADD FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`);
ALTER TABLE `ads` ADD FOREIGN KEY (`status_id`) REFERENCES `status` (`id`);