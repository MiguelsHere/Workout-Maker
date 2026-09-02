CREATE TABLE `user` (
  `id_user` bigint UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `user_name` varchar(50) UNIQUE NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `user_description` text,
  `birth_date` date,
  `height_cm` decimal(4,1),
  `weight_kg` decimal(4,1),
  `is_public` boolean NOT NULL DEFAULT 0
);

CREATE TABLE `user_workout` (
  `id_user_workout` bigint UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `id_user` bigint UNSIGNED NOT NULL,
  `id_workout` bigint UNSIGNED NOT NULL,
  `feedback` enum(liked,disliked,neither) DEFAULT 'neither',
  `is_creator` boolean NOT NULL DEFAULT 0
);

CREATE TABLE `workout` (
  `id_workout` bigint UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `workout_name` tinytext NOT NULL,
  `workout_description` text,
  `time_min` tinyint(3) UNSIGNED,
  `is_public` boolean NOT NULL DEFAULT 0
);

CREATE TABLE `workout_exercise` (
  `id_workout_exercise` bigint UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `id_workout` bigint UNSIGNED NOT NULL,
  `id_exercise` bigint UNSIGNED NOT NULL
);

CREATE TABLE `exercise` (
  `id_exercise` bigint UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `exercise_name` tinytext NOT NULL,
  `exercise_description` text NOT NULL
);

CREATE TABLE `exercise_equipment` (
  `id_exercise_equipment` bigint UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `id_exercise` bigint UNSIGNED NOT NULL,
  `id_equipment` bigint UNSIGNED NOT NULL
);

CREATE TABLE `equipment` (
  `id_equipment` bigint UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `equipment_name` tinytext NOT NULL,
  `equipment_description` text NOT NULL
);

ALTER TABLE `user_workout` ADD FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

ALTER TABLE `user_workout` ADD FOREIGN KEY (`id_workout`) REFERENCES `workout` (`id_workout`);

ALTER TABLE `workout_exercise` ADD FOREIGN KEY (`id_workout`) REFERENCES `workout` (`id_workout`);

ALTER TABLE `workout_exercise` ADD FOREIGN KEY (`id_exercise`) REFERENCES `exercise` (`id_exercise`);

ALTER TABLE `exercise_equipment` ADD FOREIGN KEY (`id_equipment`) REFERENCES `equipment` (`id_equipment`);

ALTER TABLE `exercise_equipment` ADD FOREIGN KEY (`id_exercise`) REFERENCES `exercise` (`id_exercise`);
