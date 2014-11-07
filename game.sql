SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `theme` int(10) unsigned NOT NULL,
  `url` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

INSERT INTO `links` (`id`, `theme`, `url`) VALUES
(1, 1, 'K1KPcXRMMo4'),
(2, 1, 'c1MKteYHe6E'),
(3, 1, 'zHPqO0UnaW8'),
(6, 2, 'Cb_i8sP1R3Q'),
(7, 2, '4RpQSaNkDd0'),
(8, 2, 'iEj1rTHYboY'),
(9, 3, 'l0D7xud4uis'),
(10, 3, 'w6aYjbpBm-E'),
(11, 3, 'xko1Mx5w4tg');

CREATE TABLE IF NOT EXISTS `questionsanswers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `theme` int(10) unsigned NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

INSERT INTO `questionsanswers` (`id`, `theme`, `question`, `answer`) VALUES
(1, 1, 'Q1', 'AQ1'),
(2, 1, 'Q2', 'AQ2'),
(3, 1, 'Q3', 'AQ3'),
(4, 1, 'Q4', 'AQ4'),
(5, 1, 'Q5', 'AQ5'),
(9, 2, 'asdsad', 'adsdad'),
(10, 2, 'asdsad', 'asdasd'),
(11, 2, 'werwe', 'werw e'),
(12, 2, 'dsfasdfsa', 'dsafsadf'),
(13, 3, 'sdf', 'ghjghj'),
(14, 3, 'ghj', 'jgh jhg hgj'),
(15, 3, 'tyu ty u yt', 'ty uyt'),
(16, 3, 'tyu tyu yt ut', 'y uyt');

CREATE TABLE IF NOT EXISTS `themes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `fullName` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

INSERT INTO `themes` (`id`, `name`, `fullName`) VALUES
(1, 'harry', 'Harry Potter'),
(2, 'winnie', 'Winnie the Pooh'),
(3, 'percy', 'Percy the Jackson');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
