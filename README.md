Set up project

- git clone the repository

  Project setup
- Rename your project directory to "lession2"

  Create Database:

- create database name "demo"
- create table using given below sql statement


CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-insert values

INSERT INTO `categories` (`id`, `name`, `parent_id`) VALUES
(1, 'PHP', 0),
(2, 'JAVASCRIPT', 0),
(3, 'vanduong', 1),
(4, 'Phalcon', 1),
(5, 'Tutorials', 3),
(6, 'AngularJS', 2),
(7, 'jQuery', 8),
(8, 'Basic', 5),
(9, 'vanduong', 2),
(10, 'Course', 3),
(13, 'sdddd', 2),
(14, 'Duong', 2),
(15, 'Duong', 8);

### Run the Project

Run the localhost (Apache service)
point to the:

http://localhost/projectname
