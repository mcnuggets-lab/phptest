-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- 主機: 127.3.234.2:3306
-- 建立日期: 2015 年 12 月 09 日 13:39
-- 伺服器版本: 5.5.45
-- PHP 版本: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `polls`
--

-- --------------------------------------------------------

--
-- 資料表結構 `chart_types`
--

CREATE TABLE IF NOT EXISTS `chart_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 資料表的匯出資料 `chart_types`
--

INSERT INTO `chart_types` (`id`, `type`) VALUES
(1, 'ColumnChart'),
(2, 'PieChart');

-- --------------------------------------------------------

--
-- 資料表結構 `choices`
--

CREATE TABLE IF NOT EXISTS `choices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `choice_text` varchar(255) NOT NULL,
  `followup_question_id` int(11) DEFAULT NULL,
  `votes` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`),
  KEY `followup_question_id` (`followup_question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 資料表的匯出資料 `choices`
--

INSERT INTO `choices` (`id`, `question_id`, `choice_text`, `followup_question_id`, `votes`) VALUES
(1, 1, 'Yes!', 2, 4),
(2, 1, 'No.', 3, 7),
(3, 2, 'Algebra / Algebraic Geometry', NULL, 1),
(4, 2, 'Analysis / PDE', NULL, 0),
(5, 2, 'Applied Mathematics', NULL, 0),
(6, 2, 'Geometry / Topology', NULL, 0),
(7, 2, 'Logic', NULL, 0),
(8, 2, 'Number Theory / Arithmetic Geometry', NULL, 1),
(9, 2, 'Other', NULL, 0),
(10, 3, 'It is too boring. I hate repetitive calculations.', NULL, 1),
(11, 3, 'It is too difficult. I can never understand it.', NULL, 1),
(12, 3, 'It is too abstract and simply useless in daily life.', NULL, 1),
(13, 3, 'My math teacher sucks.', NULL, 1),
(14, 3, 'There are too many formula and theorems to remember.', NULL, 1),
(15, 3, 'I hate model answers. It just cripples my creativity.', NULL, 1),
(16, 3, 'Other', NULL, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `input_types`
--

CREATE TABLE IF NOT EXISTS `input_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_text` varchar(255) NOT NULL,
  `starting` tinyint(1) NOT NULL DEFAULT '0',
  `input_type_id` int(11) NOT NULL,
  `chart_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `input_type_id` (`input_type_id`),
  KEY `chart_type_id` (`chart_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 資料表的匯出資料 `questions`
--

INSERT INTO `questions` (`id`, `question_text`, `starting`, `input_type_id`, `chart_type_id`) VALUES
(1, 'Do you like Mathematics?', 1, 1, 2),
(2, 'What branches of mathematics do you like?', 0, 2, 1),
(3, 'Why don''t you like Mathematics?', 0, 2, 1);

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
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`input_type_id`) REFERENCES `input_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`chart_type_id`) REFERENCES `chart_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
