-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2015 at 06:33 AM
-- Server version: 5.6.19
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `email` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`) VALUES
('utkarsh911@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
  `qid` text NOT NULL,
  `ansid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`qid`, `ansid`) VALUES
('55892169bf6a7', '55892169d2efc'),
('5589216a3646e', '5589216a48722'),
('558922117fcef', '5589221195248'),
('55892211e44d5', '55892211f1fa7'),
('558922894c453', '558922895ea0a'),
('558922899ccaa', '55892289aa7cf'),
('558923538f48d', '558923539a46c'),
('55892353f05c4', '55892354051be'),
('558973f4389ac', '558973f462e61'),
('558973f4c46f2', '558973f4d4abe'),
('558973f51600d', '558973f526fc5'),
('558973f55d269', '558973f57af07'),
('558973f5abb1a', '558973f5e764a'),
('5589751a63091', '5589751a81bf4'),
('5589751ad32b8', '5589751adbdbd'),
('5589751b304ef', '5589751b3b04d'),
('5589751b749c9', '5589751b9a98c');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` text NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `feedback` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `subject`, `feedback`, `date`, `time`) VALUES
('55846be776610', 'Samrat', 'utk@gmail.com', 'feedback', 'bad', '2015-06-19', '09:22:15pm'),
('5584ddd0da0ab', 'Shabir', 'utk10@gmail.com', 'feedback', 'good', '2015-06-20', '05:28:16am'),
('558510a8a1234', 'Utkarsh', 'utkarsh@gmail.com', 'frontend', 'fmdsfld fdj', '2015-06-20', '09:05:12am'),
('5585509097ae2', 'ABC', 'abc10@gmail.com', 'backend', 'l.mdsavn', '2015-06-20', '01:37:52pm'),
('5586ee27af2c9', 'DEF', 'def@gmail.com', 'trial feedback', 'triaal feedbak', '2015-06-21', '07:02:31pm'),
('5589858b6c43b', 'GHI', 'ghi@gmail.com', 'good', 'good site', '2015-06-23', '06:12:59pm');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE IF NOT EXISTS `history` (
  `email` varchar(50) NOT NULL,
  `eid` text NOT NULL,
  `score` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `sahi` int(11) NOT NULL,
  `wrong` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history`
--

/*INSERT INTO `history` (`email`, `eid`, `score`, `level`, `sahi`, `wrong`, `date`) VALUES
('utkarsh@gmail.com', '558921841f1ec', 4, 2, 2, 0, '2015-06-23 09:31:26'),
('akash@gmail.com', '558920ff906b8', 4, 2, 2, 0, '2015-06-23 13:32:09'),
('rupesh@gmail.com', '5589222f16b93', 4, 2, 2, 0, '2015-06-23 14:49:39'),
('shabir@gmail.com', '5589741f9ed52', 4, 5, 3, 2, '2015-06-23 15:07:16'),
('jai@gmail.com', '5589222f16b93', 4, 2, 2, 0, '2015-06-23 15:12:56'),
('vishal@gmail.com', '558921841f1ec', 1, 2, 1, 1, '2015-06-23 16:11:50'),
('akash@gmail.com', '5589222f16b93', 1, 2, 1, 1, '2015-06-24 03:22:38');*/

-- --------------------------------------------------------

--
-- Table structure for table `options`
--



--
-- Dumping data for table `options`
--



-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `eid` text NOT NULL,
  `qid` text NOT NULL,
  `qns` text NOT NULL,
  `sn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`eid`, `qid`, `qns`,  `sn`) VALUES
('558920ff906b8', '55892169bf6a7', 'What is  the command used for changing user information?', 1),
('558920ff906b8', '5589216a3646e', 'What is the permission value for view only for others?',  2),
('558921841f1ec', '558922117fcef', 'What is the command to print in PHP?',  1),
('558921841f1ec', '55892211e44d5', 'Which is a variable in PHP?',  2),
('5589222f16b93', '558922894c453', 'Which of these is a correct statement in C++?', 1),
('5589222f16b93', '558922899ccaa', 'Which command is used to print the output in C++?',  2),
('558922ec03021', '558923538f48d', 'What is the correct mask for class A IP?',  1),
('558922ec03021', '55892353f05c4', 'Which of these is not a private IP?',  2),
('55897338a6659', '558973f4389ac', 'In Linux, initrd is a file',  1),
('55897338a6659', '558973f4c46f2', 'Which of these is loaded into memory when system is booted?',  2),
('55897338a6659', '558973f51600d', ' The process of starting up a computer is known as',  3),
('55897338a6659', '558973f55d269', ' Bootstrapping is also known as',  4),
('55897338a6659', '558973f5abb1a', 'The shell used for Single user mode shell is:',  5),
('5589741f9ed52', '5589751a63091', ' Which command is used to close the vi editor?',  1),
('5589741f9ed52', '5589751ad32b8', ' In vi editor, the key combination CTRL+f',  2),
('5589741f9ed52', '5589751b304ef', ' Which vi editor command copies the current line of the file?',  3),
('5589741f9ed52', '5589751b749c9', ' Which command is used to delete the character before the cursor location in vi editor?',  4),
('5589741f9ed52', '5589751bd02ec', ' Which one of the following statement is true?',  5);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE IF NOT EXISTS `quiz` (
  `eid` text NOT NULL,
  `title` varchar(16) NOT NULL,
  `sahi` int(11) NOT NULL,
  `wrong` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `time` bigint(20) NOT NULL,
  `intro` text NOT NULL,
  `tag` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`eid`, `title`, `sahi`, `wrong`, `total`, `time`, `intro`, `tag`, `date`) VALUES
('558920ff906b8', 'Linux : File Managment', 2, 1, 2, 5, '', 'linux', '2015-06-23 09:03:59'),
('558921841f1ec', 'Php Coding', 2, 1, 2, 5, '', 'PHP', '2015-06-23 09:06:12'),
('5589222f16b93', 'C++ Coding', 2, 1, 2, 5, '', 'c++', '2015-06-23 09:09:03'),
('558922ec03021', 'Networking', 2, 1, 2, 5, '', 'networking', '2015-06-23 09:12:12'),
('55897338a6659', 'Linux:startup', 2, 1, 5, 10, '', 'linux', '2015-06-23 14:54:48'),
('5589741f9ed52', 'Linux :vi Editor', 2, 1, 5, 10, '', 'linux', '2015-06-23 14:58:39');

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE IF NOT EXISTS `rank` (
  `email` varchar(50) NOT NULL,
  `score` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rank`
--

/*INSERT INTO `rank` (`email`, `score`, `time`) VALUES
('rupeshl@gmail.com', 9, '2015-06-24 03:22:38'),
('shabir@gmail.com', 8, '2015-06-23 14:49:39'),
('rupesh@gmail.com', 4, '2015-06-23 15:12:56'),
('akash@gmail.com', 1, '2015-06-23 16:11:50');
('akash@gmail.com', 1, '2015-06-23 16:11:50');
('akash@gmail.com', 1, '2015-06-23 16:11:50');*/


-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `name` varchar(50) NOT NULL,
  `year1` varchar(5) NOT NULL,
  `department` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mob` bigint(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--


INSERT INTO `user` (`name`, `year1`, `department`, `email`, `mob`, `password`) VALUES
('Utkarsh', '1', 'CSE', 'utkarsh@gmail.com', 123456789011, 'e10adc3949ba59abbe56e057f20f883e'),
('Shabir', '2', 'IT', 'shabir@gmail.com', 123456789012, 'e10adc3949ba59abbe56e057f20f883e'),
('Jai', '3', 'ECE', 'jai@gmail.com', 1234567890113, 'e10adc3949ba59abbe56e057f20f883e'),
('Rupesh', '4', 'EE', 'rupesh@gmail.com', 123456789016, 'e10adc3949ba59abbe56e057f20f883e'),
('Akash', '3', 'CSE', 'akash@gmail.com', 123456789017, 'e10adc3949ba59abbe56e057f20f883e'),
('Vishal', '1', 'IT', 'vishal@gmail.com', 123456789019, 'e10adc3949ba59abbe56e057f20f883e');

CREATE TABLE IF NOT EXISTS `reset` (
  `email` varchar(50) NOT NULL,
  `id` text NOT NULL,
  `expires` DATETIME NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `qnset` (
  `email` varchar(50) NOT NULL,
  `id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
