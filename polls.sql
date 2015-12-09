-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2015-12-09 03:45:02
-- 伺服器版本: 10.0.17-MariaDB
-- PHP 版本： 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `polls`
--

-- --------------------------------------------------------

--
-- 資料表結構 `choices`
--

CREATE TABLE `choices` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `choice_text` varchar(255) NOT NULL,
  `followup_question_id` int(11) DEFAULT NULL,
  `votes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `choices`
--

INSERT INTO `choices` (`id`, `question_id`, `choice_text`, `followup_question_id`, `votes`) VALUES
(1, 1, 'Yes!', 2, 0),
(2, 1, 'No.', 3, 0),
(3, 2, 'Choice 01 for Q2', NULL, 0),
(4, 2, 'Choice 02 for Q2', NULL, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `input_types`
--

CREATE TABLE `input_types` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `input_types`
--

INSERT INTO `input_types` (`id`, `type`) VALUES
(1, 'radio'),
(2, 'checkbox');

-- --------------------------------------------------------

--
-- 資料表結構 `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question_text` varchar(255) NOT NULL,
  `starting` tinyint(1) NOT NULL DEFAULT '0',
  `input_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `questions`
--

INSERT INTO `questions` (`id`, `question_text`, `starting`, `input_type_id`) VALUES
(1, 'Do you like Mathematics?', 1, 1),
(2, 'Why do you like Mathematics?', 0, 2),
(3, 'Why don''t you like Mathematics?', 0, 2);

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `choices`
--
ALTER TABLE `choices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `followup_question_id` (`followup_question_id`);

--
-- 資料表索引 `input_types`
--
ALTER TABLE `input_types`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `input_type_id` (`input_type_id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `choices`
--
ALTER TABLE `choices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用資料表 AUTO_INCREMENT `input_types`
--
ALTER TABLE `input_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用資料表 AUTO_INCREMENT `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 已匯出資料表的限制(Constraint)
--

--
-- 資料表的 Constraints `choices`
--
ALTER TABLE `choices`
  ADD CONSTRAINT `choices_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `choices_ibfk_2` FOREIGN KEY (`followup_question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`input_type_id`) REFERENCES `input_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
