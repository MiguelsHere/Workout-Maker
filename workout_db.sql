CREATE TABLE `user` (
  `user_id` bigint UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `user_name` varchar(50) UNIQUE NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `user_description` text,
  `birth_date` date,
  `height_cm` decimal(5,2),
  `weight_kg` decimal(5,2),
  `is_public` boolean NOT NULL DEFAULT 0
);

CREATE TABLE `user_workout` (
  `user_workout_id` bigint UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `workout_id` bigint UNSIGNED NOT NULL,
  `user_feedback` enum('liked','disliked','neither') NOT NULL DEFAULT 'neither'
);

CREATE TABLE `workout` (
  `workout_id` bigint UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `workout_name` varchar(200) NOT NULL,
  `workout_description` text,
  `time_min` smallint UNSIGNED,
  `is_public` boolean NOT NULL DEFAULT 0,
  `creator_id` bigint UNSIGNED NOT NULL
);

CREATE TABLE `workout_exercise` (
  `workout_exercise_id` bigint UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `workout_id` bigint UNSIGNED NOT NULL,
  `exercise_id` bigint UNSIGNED NOT NULL
);

CREATE TABLE `exercise` (
  `exercise_id` bigint UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `exercise_name` varchar(200) NOT NULL,
  `exercise_description` text NOT NULL
);

CREATE TABLE `exercise_equipment` (
  `exercise_equipment_id` bigint UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `exercise_id` bigint UNSIGNED NOT NULL,
  `equipment_id` bigint UNSIGNED NOT NULL
);

CREATE TABLE `equipment` (
  `equipment_id` bigint UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `equipment_name` varchar(200) NOT NULL,
  `equipment_description` text NOT NULL
);

ALTER TABLE `exercise_equipment` ADD FOREIGN KEY (`exercise_id`) REFERENCES `exercise` (`exercise_id`);

ALTER TABLE `exercise_equipment` ADD FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`equipment_id`);

ALTER TABLE `workout_exercise` ADD FOREIGN KEY (`exercise_id`) REFERENCES `exercise` (`exercise_id`);

ALTER TABLE `workout_exercise` ADD FOREIGN KEY (`workout_id`) REFERENCES `workout` (`workout_id`);

ALTER TABLE `workout` ADD FOREIGN KEY (`creator_id`) REFERENCES `user` (`user_id`);

ALTER TABLE `user_workout` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

ALTER TABLE `user_workout` ADD FOREIGN KEY (`workout_id`) REFERENCES `workout` (`workout_id`);
