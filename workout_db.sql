CREATE TABLE `user` (
  `user_id` bigint UNSIGNED NULL PRIMARY KEY AUTO_INCREMENT,
  `user_name` varchar(50) UNIQUE NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `user_description` text,
  `birth_date` date,
  `height_cm` decimal(4,1) CHECK (height_cm > 0),
  `weight_kg` decimal(5,2) CHECK (weight_kg > 0),
  `is_public` boolean NOT NULL DEFAULT 0
);

CREATE TABLE `workout` (
  `workout_id` bigint UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `workout_name` varchar(200) NOT NULL,
  `workout_description` text,
  `time_min` smallint UNSIGNED, 
  `is_public` boolean NOT NULL DEFAULT 0,
  `creator_id` bigint UNSIGNED NULL,
  FOREIGN KEY (`creator_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL
);

CREATE TABLE `user_workout` (
  `user_workout_id` bigint UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `workout_id` bigint UNSIGNED NOT NULL,
  `user_feedback` enum('liked','disliked','neither') NOT NULL DEFAULT 'neither',
  FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  FOREIGN KEY (`workout_id`) REFERENCES `workout` (`workout_id`) ON DELETE CASCADE

);

CREATE TABLE `exercise` (
  `exercise_id` bigint UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `exercise_name` varchar(200) NOT NULL,
  `exercise_description` text NOT NULL
);

CREATE TABLE `set` (
  `set_id` bigint UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `reps` tinyint UNSIGNED,
  `set_time_sec` int UNSIGNED,
  `notes` text,
  `workout_id` bigint UNSIGNED NOT NULL,
  `exercise_id` bigint UNSIGNED NOT NULL,
  `set_number` tinyint UNSIGNED NOT NULL AUTO_INCREMENT,
  FOREIGN KEY (`workout_id`) REFERENCES `workout` (`workout_id`) ON DELETE CASCADE,
  FOREIGN KEY (`exercise_id`) REFERENCES `exercise` (`exercise_id`) ON DELETE CASCADE
);

CREATE TABLE `equipment` (
  `equipment_id` bigint UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `equipment_name` varchar(200) NOT NULL,
  `equipment_description` text NOT NULL
);

CREATE TABLE `exercise_equipment` (
  `exercise_equipment_id` bigint UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `exercise_id` bigint UNSIGNED NOT NULL,
  `equipment_id` bigint UNSIGNED NOT NULL,
  FOREIGN KEY (`exercise_id`) REFERENCES `exercise` (`exercise_id`),
  FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`equipment_id`)
);

CREATE TABLE `user_equipment` (
  `user_equipment_id` bigint UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `equipment_id` bigint UNSIGNED NOT NULL,
  FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`equipment_id`) ON DELETE CASCADE
);
