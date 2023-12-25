
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



CREATE TABLE `job_applications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_offer_id` int(11) NOT NULL,
  `status` varchar(20) DEFAULT 'wait_answer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `visibility` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `job_applications` (`id`, `user_id`, `job_offer_id`, `status`, `created_at`, `visibility`) VALUES
(57, 3, 86, 'accept', '2023-12-22 10:39:44', 0);


CREATE TABLE `job_offers` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `job_offers` (`id`, `title`, `company`, `location`, `description`, `is_active`, `created_at`, `img`) VALUES
(86, 'c-p-0', 'Terniobi', 'red line ', 'you can be a member in the c-p-0 clan just you need the haki ', 1, '2023-12-22 10:32:37', '658565d932cf9OIP (1).jpeg');



CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `useremail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `users` (`id`, `username`, `useremail`, `password`, `role`) VALUES
(3, 'abdo', 'o@o.com', '$2y$10$K5FdNPP1iiiilmpANvY6O.H7q69B4MrpAuUWiozR5fu49rag4SOhy', 'candidate'),
(4, 'amine', 'a@a.com', '$2y$10$SeT4VilZsDCmQ62VUBwet.Bmw7qMnu2GeG4BhpCL5jCQcP.CAsE/u', 'admin'),
(5, 'latifa', 'l@l.com', '$2y$10$Wv.a9UyPMm4/u4OWWsIEjO5j92K8pNZySWDtX8QFlPLlKnzZmqpW2', 'candidate'),
(10, 'latifaaa', 'll@l.com', '$2y$10$BBXfTaF5Z.5HFGEQzt/JGOstGFAR7uvC8bac5D8yCNJJ3npANgpEG', 'candidate'),
(11, 'olol', 'ol@o.com', '$2y$10$axEi3Spj5KMbrID93u9hwOYJXTAfbIxhSM9KSTftbIm19H0bKPbi6', 'candidate'),
(12, '1', 's@s.com', '$2y$10$pIS3y.NmrlQ0z8sUvJWPZuPDH1JjNcha/mPbAx4Vl.31q2H.QqhC.', 'candidate'),
(14, 'khalid', 'k@k.com', '$2y$10$96mFPP7FbJhD8Ay44ESFf.9BHDpeyuNpVHiYGzIFGPwiIwcD9eEUe', 'candidate'),
(15, 'amine ', 'amine@gmail.com', '$2y$10$knLqhQFmv3xNoZYcFUgm3.xbqW4vAprxZJnzW6ZjfLmNLptt4hQLW', 'candidate'),
(16, 'fg', 'fh', '$2y$10$whpJ0Caci4E3TvCL3.aTSO5BARoxq8NdCVcMYTaJWVEJxOIgrF8aq', 'candidate'),
(17, 'ggg', 'elarek2023@gmail.com', '$2y$10$D5EJgqVOE1Io8d0UwsLp8.NUvVsMdK.NY1isLil54AREKTAJ.A3ae', 'candidate'),
(22, 'latifalatifa', 'elaadraouimbarek', '$2y$10$F3heln5ATr.JNgJrj6JY.O.34Hj22Dkpc2Hd0qg3zDbAwcRNTCsqi', 'candidate'),
(24, 'abdo', 'elaadraouimbarekouimbarek2023@gmail.com', '$2y$10$ebL7guS8Dn45Xgt0WklOZOborzh/9a217nzI1hSCmM4QfBR9ZceCe', 'candidate'),
(26, 'hh', 'hhhhn@g.com', '$2y$10$dPuGxi0/gtw76YKEE0ku6et.VWxgtU6BUjHduDG/ltjT0mKzS4aOW', 'candidate');



ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_applications_ibfk_1` (`user_id`),
  ADD KEY `job_applications_ibfk_2` (`job_offer_id`);

ALTER TABLE `job_offers`
  ADD PRIMARY KEY (`id`);



ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `useremail` (`useremail`);


ALTER TABLE `job_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;


ALTER TABLE `job_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;


ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;


ALTER TABLE `job_applications`
  ADD CONSTRAINT `job_applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `job_applications_ibfk_2` FOREIGN KEY (`job_offer_id`) REFERENCES `job_offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
