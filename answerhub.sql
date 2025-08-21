SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `answerhub` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `answerhub`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` LONGBLOB NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_categoryName` (`categoryName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `questiontitle` varchar(255) NOT NULL,
  `questiontext` TEXT NOT NULL,
  `questiondate` date NOT NULL,
  `userid` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `imageData` LONGBLOB NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_userid` (`userid`),
  KEY `idx_categoryid` (`categoryid`),
  KEY `idx_questiondate` (`questiondate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `answertext` TEXT NOT NULL,
  `answerdate` date NOT NULL,
  `questionid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_questionid` (`questionid`),
  KEY `idx_userid` (`userid`),
  KEY `idx_answerdate` (`answerdate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `category` (`categoryName`) VALUES
('General'),
('Programming'),
('Web Development'),
('Database'),
('Mobile Development'),
('Data Science'),
('Machine Learning'),
('DevOps'),
('UI/UX Design'),
('Computer Science'),
('Software Engineering'),
('Network Security'),
('Cloud Computing'),
('Game Development'),
('Hardware'),
('Operating Systems'),
('Mathematics'),
('Algorithms'),
('Project Management'),
('Career Advice');

INSERT INTO `users` (`username`, `email`, `password`) VALUES
('admin', 'admin@answerhub.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

INSERT INTO `question` (`questiontitle`, `questiontext`, `questiondate`, `userid`, `categoryid`) VALUES
('How to connect to MySQL database in PHP?', 'I am trying to connect to a MySQL database using PHP PDO but getting connection errors. Can someone help me with the correct syntax?', CURDATE(), 1, 4),
('What is the difference between GET and POST methods?', 'I am learning web development and confused about when to use GET vs POST methods in HTTP requests. Can someone explain the differences?', CURDATE(), 1, 3),
('Best practices for responsive web design', 'What are the current best practices for creating responsive websites that work well on all devices?', CURDATE(), 1, 3);

INSERT INTO `answer` (`answertext`, `answerdate`, `questionid`, `userid`) VALUES
('You can use PDO like this:\n\n$pdo = new PDO(''mysql:host=localhost;dbname=your_db'', $username, $password);\n$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);\n\nMake sure your credentials are correct!', CURDATE(), 1, 1),
('GET is used for retrieving data and parameters are visible in URL. POST is used for sending data securely and parameters are not visible in URL. Use GET for search forms, POST for login forms.', CURDATE(), 2, 1),
('Use CSS Grid and Flexbox for layouts, relative units like em/rem for typography, mobile-first approach, and test on multiple devices. Consider using CSS frameworks like Bootstrap for faster development.', CURDATE(), 3, 1);

COMMIT;

ALTER TABLE `users` AUTO_INCREMENT = 2;
ALTER TABLE `category` AUTO_INCREMENT = 21;
ALTER TABLE `question` AUTO_INCREMENT = 4;
ALTER TABLE `answer` AUTO_INCREMENT = 4;
