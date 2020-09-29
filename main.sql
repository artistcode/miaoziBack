CREATE TABLE `api_dsrcz_com`.`jobs`  (
  `id` int NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT 0,
  `jobs_category_id` int UNSIGNED NOT NULL DEFAULT 0,
  `company_id` int UNSIGNED NOT NULL DEFAULT 0,
  `education` tinyint UNSIGNED NOT NULL DEFAULT 0,
  `work_time` varchar NOT NULL DEFAULT '',
  `salary_start` int UNSIGNED NOT NULL DEFAULT 0,
  `salary_end` int NOT NULL DEFAULT 0,
  `longitude` decimal(20,17) UNSIGNED NOT NULL DEFAULT 0,
  `latitude` decimal(20,17)  UNSIGNED NOT NULL DEFAULT 0,
  `house` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
);