-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2022 at 05:59 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbusers`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `id` int(50) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role` varchar(100) NOT NULL,
  `active` int(11) NOT NULL,
  `profile` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `email`, `password`, `role`, `active`, `profile`) VALUES
(1, 'admin', '', 'Administrator', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tblevents`
--

CREATE TABLE `tblevents` (
  `id` int(128) NOT NULL,
  `event` varchar(128) NOT NULL,
  `description` varchar(128) NOT NULL,
  `time` varchar(128) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblevents`
--

INSERT INTO `tblevents` (`id`, `event`, `description`, `time`) VALUES
(1, 'Profile Update', 'Mikoyupdated profile settings.', '2022-02-14 01:55:31'),
(2, 'Profile Update', 'Mikoy updated password settings.', '2022-02-20 01:27:10'),
(3, 'Profile Update', 'Mikoy updated profile settings.', '2022-02-22 15:59:58'),
(5, 'Log In', 'Mikoy logged in.', '2022-02-22 16:14:50'),
(6, 'Log In', 'Mikoy logged in.', '2022-02-23 00:19:39'),
(7, 'Log In', 'Mikoy logged in.', '2022-02-23 15:30:09'),
(8, 'Log Out', 'Mikoy logged out.', '2022-02-23 15:37:54'),
(9, 'Log In', 'allen kalbo logged in.', '2022-02-23 15:41:22'),
(10, 'Log Out', 'allen kalbo logged out.', '2022-02-23 15:43:51'),
(11, 'Registration', 'admin successfully registered.', '2022-02-23 15:51:38'),
(12, 'Log In', 'Mikoy logged in.', '2022-02-23 21:13:24'),
(13, 'Log In', 'Myk Escala logged in.', '2022-02-24 00:18:32'),
(14, 'Log In', 'Myk Escala logged in.', '2022-02-24 00:19:42'),
(15, 'Log In', 'Myk Escala logged in.', '2022-02-24 12:44:19'),
(16, 'Log In', 'Mikoy logged in.', '2022-02-24 14:35:14'),
(17, 'Profile Update', 'Mikoy updated profile settings.', '2022-02-24 14:37:50'),
(18, 'Email Verify', 'allen kalbo verify email address.', '2022-02-24 18:01:27'),
(19, 'Log Out', 'Mikoy logged out.', '2022-02-24 18:02:00'),
(20, 'Email Update', 'allen kalbo updated email settings.', '2022-02-24 18:51:10'),
(21, 'Email Update', 'allen kalbo updated email settings.', '2022-02-24 18:54:19'),
(22, 'Log In', 'Myk Escala logged in.', '2022-02-24 19:18:23'),
(23, 'Log In', 'Mikoy logged in.', '2022-02-24 19:58:47'),
(24, 'Profile Update', 'Mikoy updated profile settings.', '2022-02-24 19:58:59'),
(25, 'Profile Update', 'Mikoy updated profile settings.', '2022-02-24 20:01:19'),
(26, 'Profile Update', 'Mikoy updated profile settings.', '2022-02-24 20:02:31'),
(27, 'Profile Update', 'Mikoy updated profile settings.', '2022-02-24 20:03:16'),
(28, 'Profile Update', 'Mikoy updated profile settings.', '2022-02-24 20:03:49'),
(29, 'Profile Update', 'Mikoy updated profile settings.', '2022-02-24 20:04:02'),
(30, 'Profile Update', 'Mikoy updated profile settings.', '2022-02-24 20:05:01'),
(31, 'Profile Update', 'Mikoy updated profile settings.', '2022-02-24 20:07:24'),
(32, 'Log In', 'Mikoy logged in.', '2022-02-24 20:10:56'),
(33, 'Profile Update', 'Mikoy updated profile settings.', '2022-02-24 20:11:08'),
(34, 'Profile Update', 'Mikoy updated profile settings.', '2022-02-24 20:11:40'),
(35, 'Log In', 'Myk Escala logged in.', '2022-02-24 20:11:48'),
(36, 'Email Update', 'Myk Escala updated mBS4ztsNC9lg1p3Hoar7 profile settings.', '2022-02-24 20:27:32'),
(37, 'Email Update', 'Myk Escala updated OsnqhGQmLujtMRe4wBrx profile settings.', '2022-02-24 21:00:48'),
(38, 'Email Update', 'Myk Escala archived  allen kalbo .', '2022-02-25 01:34:15'),
(39, 'Email Update', 'Myk Escala archived  allen kalbo .', '2022-02-25 01:37:57'),
(40, 'Email Update', 'Myk Escala restored  allen kalbo .', '2022-02-25 01:38:04'),
(41, 'Lesson Update', 'Myk Escala archived lesson  testers .', '2022-02-25 01:48:57'),
(42, 'Lesson Update', 'Myk Escala archived lesson  testers .', '2022-02-25 01:49:36'),
(43, 'Lesson Update', 'Myk Escala restored lesson testers .', '2022-02-25 01:49:42'),
(44, 'Lesson Update', 'Myk Escala archived lesson  testers .', '2022-02-25 01:50:13'),
(45, '|User Update', 'Myk Escala archived  allen kalbo .', '2022-02-25 02:36:03'),
(46, 'User Update', 'Myk Escala restored  allen kalbo .', '2022-02-25 02:38:33'),
(47, 'Log Out', 'Myk Escala logged out.', '2022-02-25 03:18:34'),
(48, 'Log In', 'Myk Escala logged in.', '2022-02-25 03:18:51'),
(49, 'Log Out', 'Myk Escala logged out.', '2022-02-25 03:24:39'),
(50, 'Log In', 'Myk Escala logged in.', '2022-02-25 03:24:40'),
(51, 'Log Out', 'Myk Escala logged out.', '2022-02-25 03:25:30'),
(52, 'Log In', 'Myk Escala logged in.', '2022-02-25 11:32:05'),
(53, 'Log In', 'Myk Escala logged in.', '2022-02-26 03:10:54'),
(54, 'Email Update', 'Myk Escala updated Getting Started in Microsoft PowerPoint question number 1.', '2022-02-26 04:08:41'),
(55, 'Quiz Update', 'Myk Escala updated Getting Started in Microsoft PowerPoint question number 1.', '2022-02-26 04:10:37'),
(56, 'Quiz Update', 'Myk Escala updated Create New Lesson question number 45.', '2022-02-26 04:45:55'),
(57, 'Log In', 'Myk Escala logged in.', '2022-02-26 11:35:00'),
(58, 'Quiz Update', 'Myk Escala archived question  45  from Lesson ID  14 .', '2022-02-26 12:27:14'),
(59, 'Quiz Update', 'Myk Escala archived question  45  from Lesson ID  14 .', '2022-02-26 12:34:31'),
(60, 'Quiz Update', 'Myk Escala archive question  45  from Lesson ID  14 .', '2022-02-26 12:37:41'),
(61, 'Lesson Update', 'Myk Escala archived lesson  Create New Lesson .', '2022-02-26 13:05:24'),
(62, 'Lesson Update', 'Myk Escala archived lesson  Presenting Your Slide Show .', '2022-02-26 15:40:47'),
(63, 'Lesson Update', 'Myk Escala restored lesson Presenting Your Slide Show .', '2022-02-26 15:45:00'),
(64, 'Registration', 'Panel Name successfully registered.', '2022-02-26 16:38:27'),
(65, 'Registration', 'Panel Test successfully registered.', '2022-02-26 16:39:24'),
(66, 'Email Verify', 'Panel Test verify email address.', '2022-02-26 16:40:07'),
(67, 'Log In', 'Panel Test logged in.', '2022-02-26 16:40:41'),
(68, 'Profile Update', 'Panel Test updated password settings.', '2022-02-26 16:47:07'),
(69, 'Profile Update', 'Panel Test updated profile settings.', '2022-02-26 16:47:22'),
(70, 'User Update', 'Myk Escala archived  allen kalbo .', '2022-02-26 16:49:49'),
(71, 'User Update', 'Myk Escala restored  allen kalbo .', '2022-02-26 16:50:13'),
(72, 'Log Out', 'Panel Test logged out.', '2022-02-26 16:50:28'),
(73, 'Log In', 'Panel Test logged in.', '2022-02-26 16:52:06'),
(74, 'Registration', 'Panel User successfully registered.', '2022-02-26 17:03:07'),
(75, 'Email Verify', 'Panel User verify email address.', '2022-02-26 17:03:58'),
(76, 'Log Out', 'Myk Escala logged out.', '2022-02-26 17:05:05'),
(77, 'Log In', 'Myk Escala logged in.', '2022-02-26 17:05:07'),
(78, 'Log Out', 'Myk Escala logged out.', '2022-02-26 17:05:23'),
(79, 'Log Out', 'Panel Test logged out.', '2022-02-26 17:06:06'),
(80, 'Log In', 'Panel Test logged in.', '2022-02-26 17:06:53'),
(81, 'Log In', 'Myk Escala logged in.', '2022-02-26 17:08:27'),
(82, 'Log In', 'Myk Escala logged in.', '2022-03-05 15:31:01'),
(83, 'Log Out', 'Myk Escala logged out.', '2022-03-05 15:43:15'),
(84, 'Log In', 'Myk Escala logged in.', '2022-03-05 15:43:36'),
(85, 'Log In', 'allen kalbo logged in.', '2022-07-13 11:57:17');

-- --------------------------------------------------------

--
-- Table structure for table `tbllessoncon`
--

CREATE TABLE `tbllessoncon` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `thumb` varchar(128) NOT NULL DEFAULT 'default.gif',
  `vid_link` varchar(50) NOT NULL,
  `short_description` varchar(128) NOT NULL,
  `achievement` varchar(128) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `archive` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbllessoncon`
--

INSERT INTO `tbllessoncon` (`id`, `title`, `thumb`, `vid_link`, `short_description`, `achievement`, `icon`, `archive`) VALUES
(1, 'Getting Started in Microsoft PowerPoint', 'default.gif', 'https://www.youtube.com/embed/k6pg4nZS6fA', 'Gives you the idea of  what is a PowerPoint', 'Fire Starter', 'fa-fire', 0),
(2, 'Creating and Opening PowerPoint Presentations', 'default.gif', 'https://www.youtube.com/embed/OX3vRazm4fw', 'Gives you the idea on how to open and create a PowerPoint', 'The Creator', 'fa-hammer', 0),
(3, 'Slide Basics of a PowerPoint Presentation', 'default.gif', 'https://www.youtube.com/embed/TZfcVbKJs1E', 'Gives you the idea on how to manage different slide.', 'Rookie', 'fa-chess-pawn', 0),
(4, 'Managing Slides', 'default.gif', 'https://www.youtube.com/embed/UmOJXAr_riE', 'Gives you the idea on how to manage different slide', 'Manager', 'fa-tasks', 0),
(5, 'Applying Transitions', 'default.gif', 'https://www.youtube.com/embed/Ey1atEavZ-M', 'Gives you the idea on how to apply different transitions', 'Transition Master', 'fa-layer-group', 0),
(6, 'Using Find & Replace', 'default.gif', 'https://www.youtube.com/embed/TEqzwdC4x58', 'Gives you the idea on how to use \"Find & Replace\" ', 'Search & Destroy', 'fa-search', 0),
(7, 'Saving Presentations', 'default.gif', 'https://www.youtube.com/embed/6904g24ElmM', 'Gives you the idea on how to save your PowerPoint ', 'Finalizer', 'fa-save', 0),
(8, 'Presenting Your Slide Show', 'default.gif', 'https://www.youtube.com/embed/7-2oM3AGHQM', 'Gives you the idea on how to present your PowerPoint', 'Pro Presenter', 'fa-eye', 0),
(11, 'testers', '1645708556_2bef18331a030845af10.png', 'https://www.youtube.com/embed/k6pg4nZS6fA', 'test', 'Tester', 'fa-fire', 1),
(14, 'Create New Lesson', '', 'https://www.youtube.com/embed/ybdz-nTVHrk', 'Happier than ever - Billie Eillish', 'Billie', 'fa-fire', 1),
(15, 'Panel Lesson', '1645865822_41cbd85ff0da6a33839f.png', 'https://www.youtube.com/embed/zkb0um-k8Kc', 'Panel Description', 'Ace', 'fa-fire', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbllessonques`
--

CREATE TABLE `tbllessonques` (
  `id` int(2) NOT NULL,
  `lesson_id` int(2) NOT NULL,
  `number` int(2) NOT NULL,
  `question` varchar(1000) NOT NULL,
  `choice1` varchar(30) NOT NULL,
  `choice2` varchar(30) NOT NULL,
  `choice3` varchar(30) NOT NULL,
  `choice4` varchar(30) NOT NULL,
  `answer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbllessonques`
--

INSERT INTO `tbllessonques` (`id`, `lesson_id`, `number`, `question`, `choice1`, `choice2`, `choice3`, `choice4`, `answer`) VALUES
(1, 1, 1, 'PowerPoint 2016 is a _______ that allows you to create dynamic slide presentations that can include animation, narration, images, and videos.', 'Presentation', 'Presentation Software ', 'Software', 'System Presentation', 'Presentation Software '),
(2, 1, 2, 'It contains multiple tabs, each with several groups of commands.', 'Ribbon', 'Menu', 'Settings', 'Display', 'Ribbon'),
(3, 1, 3, 'Gives you a view of your slides in thumbnail form. ', 'View', 'Slide View', 'Slide Sorter', 'Sorter', 'Slide Sorter'),
(4, 1, 4, 'It is editing mode where you\'ll work most frequently to create your slides. ', 'Normal View', 'Simple', 'View', 'Display', 'Normal View'),
(5, 1, 5, 'It gives you various options for saving, opening, printing, and sharing your presentation.', 'Presentation', 'Menu', 'Setttings', 'Backstage View', 'Backstage View'),
(6, 2, 1, 'A _____ is a predesigned presentation you can use to create a new slide show quickly.', 'Presentation', 'Template', 'Design', 'PowerPoint', 'Template'),
(7, 2, 2, 'To exit Compatibility mode, you\'ll need to ______ the presentation to the current version type.', 'Convert', 'Open', 'Export', 'Download', 'Convert'),
(8, 2, 3, 'It allows you to Save and Edit the files in the', 'Application', 'Compatibility Mode', 'Functionality', 'Capability', 'Compatibility Mode'),
(9, 2, 4, 'An Online storage space for your documents and ', 'One Drive', 'Google Drive', 'Flash Drive', 'Hard Drive', 'One Drive'),
(10, 2, 5, 'Compatibility mode ____ certain features, so yo', 'Enables', 'Disables', 'Offers', 'Gives', 'Disables'),
(11, 3, 1, 'Every PowerPoint presentation is composed of a ', 'PowerPoint', 'Layers', 'Slides', 'Layout', 'Slides'),
(12, 3, 2, 'When you insert a new slide, it will usually ha', 'Slide', 'Placeholders', 'Layout', 'Thumbnail', 'Placeholders'),
(13, 3, 3, 'Many placeholders have ___________you can click', 'Thumbnail Icons', 'Layout', 'Slides', 'Icons', 'Thumbnail Icons'),
(14, 3, 4, 'It makes you organize your slide easily.', 'Navigation Pane', 'Slide Navigation Pane', 'Navigation', 'Slides Pane', 'Slide Navigation Pane'),
(15, 3, 5, 'By click and drag the desired slide in the Slid', 'Move Slides', 'Delete Slides', 'Insert Slides', 'Duplicate Slides', 'Move Slides'),
(16, 4, 1, 'This allows you to quickly edit your slide text', 'Outline View', 'Slide Sorter', 'Normal View', 'Reading View', 'Outline View'),
(17, 4, 2, 'The _______ are located in the bottom-right of ', 'Settings', 'Menu', 'Slide view commands ', 'Slide Show', 'Slide view commands'),
(18, 4, 3, 'It can help you deliver or prepare for your pre', 'Menu', 'Notes', 'Command', 'Speaker', 'Notes'),
(19, 4, 4, 'This view fills the PowerPoint window with a pr', 'Normal View ', 'Outline View', 'Slide Sorter', 'Reading View', 'Reading View'),
(20, 4, 5, 'If you have a lot of slides, you can organize t', 'Section', 'Slide', 'Group', 'View', 'Section'),
(21, 5, 1, 'Which one is not a type of transition?', 'Fade', 'Push', 'Shuffle', 'Box', 'Shuffle'),
(22, 5, 2, 'What are movements from one slide to another du', 'Emphasis', 'Animation', 'Simulation', 'Transitions', 'Transitions'),
(23, 5, 3, 'Which command is used to specify the length of ', 'Timing', 'Preview', 'Duration', 'Rehearse', 'Duration'),
(24, 5, 4, 'Which one of these are not included in the cate', 'Subtle', 'Colorful', 'Exciting', 'Dynamic Content', 'Colorful'),
(25, 5, 5, 'What command you should click if you want to pl', 'Preview', 'Show', 'Previous', 'Replay', 'Preview'),
(26, 6, 1, 'Where can you find the Find and Replace command', 'Design Tab', 'Insert Tab', 'Home Tab', 'Format Tab', 'Home Tab'),
(27, 6, 2, '______ command to locate all instances of a par', 'Find', 'Search', 'Replace', 'Select', 'Find'),
(28, 6, 3, 'What is the keyboard shortcut for Find and Repl', 'Ctrl + F', 'Ctrl + H', 'Ctrl + A', 'Ctrl + X', 'Ctrl + H'),
(29, 6, 4, 'Which editing group tool is used to search for ', 'Find', 'Search', 'Replace', 'Undo', 'Replace'),
(30, 6, 5, 'Which tool on the home tab lets a user search f', 'Replace', 'Search', 'Select', 'Find', 'Find'),
(31, 7, 1, 'You\'ll use this command to create a copy of a p', 'Save', 'Save As', 'Print', 'Download', 'Save As'),
(32, 7, 2, 'Whenever you create a new presentation in Power', 'Edit', 'Export', 'Format', 'Save', 'Save'),
(33, 7, 3, 'PowerPoint offers two ways to save a file.', 'Save and Edit', 'Save and Export', 'Save and Save As', 'Save and Format', 'Save and Save As'),
(34, 7, 4, 'PowerPoint automatically saves your presentatio', 'Save As ', 'Auto Recover', 'OneDrive', 'Quick Access Toolbar', 'Auto Recover'),
(35, 7, 5, 'By default, PowerPoint autosaves every _____ mi', '10', '5', '15', '2', '10'),
(36, 8, 1, 'PowerPoint allows you to access your ____ witho', 'Taskbar', 'Menu', 'Home', 'Settings', 'Taskbar'),
(37, 8, 2, 'It gives you access to a special set of control', 'Reading View', 'Presenter View', 'Outline View', 'Normal View', 'Outline View'),
(38, 8, 3, 'Click the Start from Beginning command on the Q', 'F3 Key', 'F5 Key', 'F1 Key', 'F4 Key', 'F5 Key'),
(39, 8, 4, 'You can exit presentation mode by pressing the ', 'Enter', 'Backspace', 'Esc', 'Shift', 'Esc'),
(40, 8, 5, 'Your mouse pointer can act as ______ to draw at', 'Pen or Highlighter ', 'Drawing', 'Colour', 'Design', 'Pen or Highlighter');

-- --------------------------------------------------------

--
-- Table structure for table `tbllessonquess`
--

CREATE TABLE `tbllessonquess` (
  `id` int(2) NOT NULL,
  `lesson_id` int(2) NOT NULL,
  `number` int(2) NOT NULL,
  `question` varchar(200) NOT NULL DEFAULT 'Question',
  `choice1` varchar(30) NOT NULL DEFAULT 'choice1',
  `choice2` varchar(30) NOT NULL DEFAULT 'choice2',
  `choice3` varchar(30) NOT NULL DEFAULT 'choice3',
  `choice4` varchar(30) NOT NULL DEFAULT 'choice4',
  `answer` varchar(50) NOT NULL DEFAULT 'answer',
  `archive` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbllessonquess`
--

INSERT INTO `tbllessonquess` (`id`, `lesson_id`, `number`, `question`, `choice1`, `choice2`, `choice3`, `choice4`, `answer`, `archive`) VALUES
(1, 1, 1, 'PowerPoint 2010 is a _______ that allows you to create dynamic slide presentations that can include animation, narration, images, and videos.', 'Presentation', 'Presentation Software ', 'Software', 'System Presentation', 'Presentation Software ', 0),
(2, 1, 2, 'It contains multiple tabs, each with several groups of commands.', 'Ribbon', 'Menu', 'Settings', 'Display', 'Ribbon', 0),
(3, 1, 3, 'Gives you a view of your slides in thumbnail form.', 'View', 'Slide View', 'Slide Sorter', 'Sorter', 'Slide Sorter', 0),
(4, 1, 4, 'It is editing mode where you\'ll work most frequently to create your slides. ', 'Normal View', 'Simple', 'View', 'Display', 'Normal View', 0),
(5, 1, 5, 'It gives you various options for saving, opening, printing, and sharing your presentation.', 'Presentation', 'Menu', 'Setttings', 'Backstage View', 'Backstage View', 0),
(6, 2, 1, 'A _____ is a predesigned presentation you can use to create a new slide show quickly.', 'Presentation', 'Template', 'Design', 'PowerPoint', 'Template', 0),
(7, 2, 2, 'To exit Compatibility mode, you\'ll need to ______ the presentation to the current version type', 'Convert', 'Open', 'Export', 'Download', 'Convert', 0),
(8, 2, 3, 'It allows you to Save and Edit the files in the older .ppt format, also allows collaborations with people using earlier versions of PowerPoint.', 'Application', 'Compatibility Mode', 'Functionality', 'Capability', 'Compatibility Mode', 0),
(9, 2, 4, 'An Online storage space for your documents and files so you can access them even when you’re away from your computer.', 'One Drive', 'Google Drive', 'Flash Drive', 'Hard Drive', 'One Drive', 0),
(10, 2, 5, 'Compatibility mode ____ certain features, so you\'ll only be able to access commands found in the program that was used to create the presentation.', 'Enables', 'Disables', 'Offers', 'Gives', 'Disables', 0),
(11, 3, 1, 'Every PowerPoint presentation is composed of a series of _________________.\r\n', 'PowerPoint', 'Layers', 'Slides', 'Layout', 'Slides', 0),
(12, 3, 2, 'When you insert a new slide, it will usually have______ to show you where content will be placed.', 'Slide', 'Placeholders', 'Layout', 'Thumbnail', 'Placeholders', 0),
(13, 3, 3, 'Many placeholders have ___________you can click to add specific types of content.', 'Thumbnail Icons', 'Layout', 'Slides', 'Icons', 'Thumbnail Icons', 0),
(14, 3, 4, 'It makes you organize your slide easily.', 'Navigation Pane', 'Slide Navigation Pane', 'Navigation', 'Slides Pane', 'Slide Navigation Pane', 0),
(15, 3, 5, 'By clicking and dragging the desired slide in the Slide Navigation pane to the desired position.', 'Move Slides', 'Delete Slides', 'Insert Slides', 'Duplicate Slides', 'Move Slides', 0),
(16, 4, 1, 'This allows you to quickly edit your slide text and view the content of multiple slides at once.', 'Outline View', 'Slide Sorter', 'Normal View', 'Reading View', 'Outline View', 0),
(17, 4, 2, 'The _______ are located in the bottom-right of the PowerPoint window.', 'Settings', 'Menu', 'Slide view commands ', 'Slide Show', 'Slide view commands', 0),
(18, 4, 3, 'It can help you deliver or prepare for your presentation.', 'Menu', 'Notes', 'Command', 'Speaker', 'Notes', 0),
(19, 4, 4, 'This view fills the PowerPoint window with a preview of your presentation. It includes easily accessible navigation buttons at the bottom-right.', 'Normal View ', 'Outline View', 'Slide Sorter', 'Reading View', 'Reading View', 0),
(20, 4, 5, 'If you have a lot of slides, you can organize them into _____to make your presentation easier to navigate.', 'Section', 'Slide', 'Group', 'View', 'Section', 0),
(21, 5, 1, 'Which one is not a type of transition?', 'Fade', 'Push', 'Shuffle', 'Box', 'Shuffle', 0),
(22, 5, 2, 'What are movements from one slide to another during a presentation called?', 'Emphasis', 'Animation', 'Simulation', 'Transitions', 'Transitions', 0),
(23, 5, 3, 'Which command is used to specify the length of the transition effect for each slide in a presentation?', 'Timing', 'Preview', 'Duration', 'Rehearse', 'Duration', 0),
(24, 5, 4, 'which one of these are not included in the category of transitions?', 'Subtle', 'Colorful', 'Exciting', 'Dynamic Content', 'Colorful', 0),
(25, 5, 5, 'What command you should click if you want to play the transition?', 'Preview', 'Show', 'Previous', 'Replay', 'Preview', 0),
(26, 6, 1, 'Where can you find the Find and Replace commands?', 'Design Tab', 'Insert Tab', 'Home Tab', 'Format Tab', 'Home Tab', 0),
(27, 6, 2, '______ command to locate all instances of a particular word.', 'Find', 'Search', 'Replace', 'Select', 'Find', 0),
(28, 6, 3, 'What is the keyboard shortcut for Find and Replace?', 'Ctrl + F', 'Ctrl + H', 'Ctrl + A', 'Ctrl + X', 'Ctrl + H', 0),
(29, 6, 4, 'Which editing group tool is used to search for and replace specific text in a document?', 'Find', 'Search', 'Replace', 'Undo', 'Replace', 0),
(30, 6, 5, 'Which tool on the home tab lets a user search for text in a document by keying the word into a search box?', 'Replace', 'Search', 'Select', 'Find', 'Find', 0),
(31, 7, 1, 'You\'ll use this command to create a copy of a presentation while keeping the original.', 'Save', 'Save As', 'Print', 'Download', 'Save As', 0),
(32, 7, 2, 'Whenever you create a new presentation in PowerPoint, you\'ll need to know how to _____________in order to access and edit it later.', 'Edit', 'Export', 'Format', 'Save', 'Save', 0),
(33, 7, 3, 'PowerPoint offers two ways to save a file.', 'Save and Edit', 'Save and Export', 'Save and Save As', 'Save and Format', 'Save and Save As', 0),
(34, 7, 4, 'PowerPoint automatically saves your presentations to a temporary folder while you are working on them. If you forget to save your changes or if PowerPoint crashes, you can restore the file using.', 'Save As ', 'Auto Recover', 'OneDrive', 'Quick Access Toolbar', 'Auto Recover', 0),
(35, 7, 5, 'By default, PowerPoint autosaves every _____ minutes.', '10', '5', '15', '2', '10', 0),
(36, 8, 1, 'PowerPoint allows you to access your ____ without ending the presentation.', 'Taskbar', 'Menu', 'Home', 'Settings', 'Taskbar', 0),
(37, 8, 2, 'It gives you access to a special set of controls on your screen that the audience won\'t see, allowing you to easily reference slide notes, preview the upcoming slide, and much more.', 'Reading View', 'Presenter View', 'Outline View', 'Normal View', 'Outline View', 0),
(38, 8, 3, 'Click the Start from Beginning command on the Quick Access Toolbar, or press the _____ at the top of your keyboard. The presentation will appear in full-screen mode.', 'F3 Key', 'F5 Key', 'F1 Key', 'F4 Key', 'F5 Key', 0),
(39, 8, 4, 'You can exit presentation mode by pressing the ____ key on your keyboard.', 'Enter', 'Backspace', 'Esc', 'Shift', 'Esc', 0),
(40, 8, 5, 'Your mouse pointer can act as ______ to draw attention to items in your slides', 'Pen or Highlighter ', 'Drawing', 'Colour', 'Design', 'Pen or Highlighter', 0),
(45, 14, 1, 'Question', 'choice1', 'choice2', 'choice3', 'choice4', 'choice1', 1),
(46, 14, 2, 'Question', 'choice1', 'choice2', 'choice3', 'choice4', 'answer', 0),
(47, 14, 3, 'Question', 'choice1', 'choice2', 'choice3', 'choice4', 'answer', 0),
(48, 14, 4, 'Question', 'choice1', 'choice2', 'choice3', 'choice4', 'answer', 0),
(49, 14, 5, 'Question', 'choice1', 'choice2', 'choice3', 'choice4', 'answer', 0),
(50, 15, 1, 'Question', 'choice1', 'choice2', 'choice3', 'choice4', 'answer', 0),
(51, 15, 2, 'Question', 'choice1', 'choice2', 'choice3', 'choice4', 'answer', 0),
(52, 15, 3, 'Question', 'choice1', 'choice2', 'choice3', 'choice4', 'answer', 0),
(53, 15, 4, 'Question', 'choice1', 'choice2', 'choice3', 'choice4', 'answer', 0),
(54, 15, 5, 'Question', 'choice1', 'choice2', 'choice3', 'choice4', 'answer', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbllessons`
--

CREATE TABLE `tbllessons` (
  `id` int(100) NOT NULL,
  `lesson` varchar(128) NOT NULL,
  `duration` varchar(128) NOT NULL,
  `status` varchar(128) NOT NULL,
  `link` varchar(128) NOT NULL,
  `description` varchar(128) NOT NULL,
  `review` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbllessons`
--

INSERT INTO `tbllessons` (`id`, `lesson`, `duration`, `status`, `link`, `description`, `review`) VALUES
(1, 'Introduction', '10:00', 'Ready', '', '', ''),
(3, 'Creation', '', '', '', '', ''),
(4, 'Saves', '', '', '', '', ''),
(5, 'Slides Basic', '', '', '', '', ''),
(6, 'Managing Slides', '', '', '', '', ''),
(7, 'Transitions', '', '', '', '', ''),
(8, 'Presentation', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudent`
--

CREATE TABLE `tblstudent` (
  `id` int(100) NOT NULL,
  `name` varchar(128) NOT NULL,
  `lesson` varchar(128) NOT NULL,
  `grade` int(100) NOT NULL,
  `a_status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblstudent`
--

INSERT INTO `tblstudent` (`id`, `name`, `lesson`, `grade`, `a_status`) VALUES
(1, 'OsnqhGQmLujtMRe4wBrx', '1', 1, 1),
(2, 'OsnqhGQmLujtMRe4wBrx', '2', 3, 0),
(3, 'OsnqhGQmLujtMRe4wBrx', '3', 4, 0),
(5, 'mBS4ztsNC9lg1p3Hoar7', '1', 5, 0),
(6, 'mBS4ztsNC9lg1p3Hoar7', '2', 1, 0),
(7, 'OsnqhGQmLujtMRe4wBrx', '4', 1, 0),
(8, '1gGuzYWHkPmsi7xypOql', '1', 5, 0),
(9, '1gGuzYWHkPmsi7xypOql', '2', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbltop`
--

CREATE TABLE `tbltop` (
  `id` int(50) NOT NULL,
  `grade` int(128) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(100) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `code` varchar(128) NOT NULL,
  `bio` longtext NOT NULL DEFAULT 'How ironic?! No bio is also a bio!',
  `profile` varchar(128) NOT NULL DEFAULT 'default.png',
  `role` varchar(128) NOT NULL,
  `active` int(1) NOT NULL,
  `attempt` int(50) NOT NULL,
  `visible` int(1) NOT NULL,
  `activatelink` varchar(128) NOT NULL,
  `email_rep` varchar(128) NOT NULL,
  `resetlink` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `name`, `email`, `password`, `code`, `bio`, `profile`, `role`, `active`, `attempt`, `visible`, `activatelink`, `email_rep`, `resetlink`) VALUES
(35, 'Mikoy', 'rapidstrike13@gmail.com', '$2y$10$C.VbnQi1wY0.cC087NkKp.kl/ltT6phQwuTO8VzvOY39..6vFL/oq', 'OsnqhGQmLujtMRe4wBrx', 'Kapag ba kinasal ang kalapati naghahagis ng tao??', '1645516798_ee391d682b33f0e1ca73.jpg', 'User', 1, 0, 0, 'used', '', 'used'),
(44, 'allen kalbo', 'escalamykkenneth@gmail.com', '$2y$10$wBakOcTPr8ss8Dwe3wS4n.25607CvHVbjenWumr1MCDgLzPqD64IO', 'mBS4ztsNC9lg1p3Hoar7', 'Testing', '1644390376_6357e72bbe756ea2ef75.jpg', 'User', 1, 0, 0, 'used', '', 'used'),
(45, 'Myk Escala', 'admin@admin.admin', '$2y$10$j/dC2A1tZASsz1eK1M1UNeGdU2sOA/74viDtsIKyA4u/ZBMUO.zPW', 'GJmleAXCvj2frsQUkTF6', '', '1645457247_dc38093998f3032780dd.jpg', 'Administrator', 1, 0, 0, '', '', ''),
(49, 'Panel Name', 'escalamykkenneth@yahoo.com', '$2y$10$Lq9pp.bBsin6PA5HMIDzb.Awx8cbTd640IHWQ0DLoQ8RRSqNzKXWO', 'lSanTKZ1wJqrthdgGHzL', 'How ironic?! No bio is also a bio!', 'default.png', 'User', 0, 0, 0, '2022-02-26 02:38:23', '', ''),
(50, 'Panel Test', 'escalamyk@yahoo.com', '$2y$10$.M6kS8i1dstTZ0TByf1UW.mlFZcYHe9yVW517oIHIwrlpmmwxY2U2', '1gGuzYWHkPmsi7xypOql', 'How ironic?! No bio is also a bio!', '1645865242_02c45ebdefe7a4733a84.png', 'User', 1, 0, 0, 'used', '', 'used'),
(51, 'Panel User', 'caipower09@gmail.com', '$2y$10$CnJRq/0.wiQLENgl5yxuHe4yFb8j5tMYx/m5snuGU19J69/1Y.Sxe', 'hxjIkqWLEKrCfwD6dc3v', 'How ironic?! No bio is also a bio!', 'default.png', 'Teacher', 1, 0, 0, 'used', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblevents`
--
ALTER TABLE `tblevents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbllessoncon`
--
ALTER TABLE `tbllessoncon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbllessonques`
--
ALTER TABLE `tbllessonques`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbllessonquess`
--
ALTER TABLE `tbllessonquess`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbllessons`
--
ALTER TABLE `tbllessons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstudent`
--
ALTER TABLE `tblstudent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltop`
--
ALTER TABLE `tbltop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblevents`
--
ALTER TABLE `tblevents`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `tbllessoncon`
--
ALTER TABLE `tbllessoncon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbllessonques`
--
ALTER TABLE `tbllessonques`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbllessonquess`
--
ALTER TABLE `tbllessonquess`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tbllessons`
--
ALTER TABLE `tbllessons`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblstudent`
--
ALTER TABLE `tblstudent`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbltop`
--
ALTER TABLE `tbltop`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
