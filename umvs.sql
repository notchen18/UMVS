/*
SQLyog Community v13.2.1 (64 bit)
MySQL - 10.4.32-MariaDB : Database - umvs
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`umvs` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `umvs`;

/*Table structure for table `faculty` */

DROP TABLE IF EXISTS `faculty`;

CREATE TABLE `faculty` (
  `FacultyID` int(11) NOT NULL AUTO_INCREMENT,
  `FacultyName` varchar(255) NOT NULL,
  `Position` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`FacultyID`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `faculty` */

insert  into `faculty`(`FacultyID`,`FacultyName`,`Position`) values 
(1,'ABELLANOSA, GAUDENCIO G.','Program Head, MS Development Administration'),
(2,'AGBAS, MARY GRACE Z.','Program Head, General Education'),
(3,'AGUILAR, ANALIZA P.','Associate Dean'),
(4,'ALEJANDRINO, ALAN B.','Local, Regional, National, International Development Planning'),
(5,'ARATIA, MELISA H.','Program Head, BS Agricultural Economics'),
(6,'BERNALES-PALERO, HAZEL QUEEN','Program Head, BS AgriBusiness (Mainstream Program)'),
(7,'BUGARIN, JOETEDDY B.','MCPS Director/ KTTD'),
(8,'CACANANTA, MARY ANN C.','Guidance Coordinator, External Campus'),
(9,'CAMPAÑA, CHERRELYN P.','Program Head, MS Development Communication & Coor. BSEd-Filipino'),
(10,'CIFRA, MINITTE M.','Head, Cultural Affairs, External Campus'),
(11,'CUTAD, CHERRY ANN P.','Communication, Social Marketing and Mobilization'),
(12,'EGUIA, REC',''),
(13,'ESPEJO, ELIZABETH R.','NSTP, Coordinator'),
(14,'GARILLOS, EMMALINDA A.',''),
(15,'GASCON, MERVIN G.','Program Head, Master of Public Administration'),
(16,'Geneston, Karen','Coordinator OSAS & Scholarship Coor.'),
(17,'Delos Reyes, Jaharry',''),
(18,'LANTAJO, GRACE MEROFLOR A.',''),
(19,'LEAÑO, MERCY C.','Head, Campus Enterprise Development Unit'),
(20,'MAGALLON, SILVERIO','Program Head, Doctor of Philosophy'),
(21,'MALINAO, JEPPY',''),
(22,'MATEO, MYRNA S.','Deputy Director, Human Resource Management Division'),
(23,'ORTIZ, GLADYS FLORANGEL I.',''),
(24,'PACOY, RICHELLE C.','School Nurse'),
(25,'PANES, RONIE G.','Program Head, Bachelor Public Administration'),
(26,'PARAMI, SAMUEL O.','Procurement Unit Head, Mintal Campus'),
(27,'PATAYON, EULALIO C.','Head, Sports, External Campus & Adviser, Undergrad Student Council'),
(28,'PEREZ, VELOUNA R.','Deputy Director- Continuing Education Center'),
(29,'RECLA, ROMMEL V.',''),
(30,'RICABLANCA, ERIC P.','Head, SDMD / LMS'),
(31,'SAJONIA, KETHELLE','Coordinator, PAD/Alumni & Student Publication Adviser'),
(32,'SANTANDER, Edsan Colin','Extension Head'),
(33,'TANGGE, NEKILO B.','Program Head, Off-Site Program ( BSAB, BEED and BS Entrep)'),
(34,'TALIP, BERNADETH A.','Program Head,  BS Community Development'),
(35,'TORRENTIRA, JR., MOISES','Director of Curriculum and Instruction Office & PCO & Faculty Club President'),
(36,'YARES, JETHER  On-study Leave',''),
(37,'SALAPA, ARISTEO C.','College Dean & Campus Administrator'),
(38,'VILLA ABRILLE, JEVIE M. (CPA)','Accounting and Head of Finance Office'),
(39,'Barde, Rachelle','Campus OJT Coordinator'),
(40,'BARTOLOME, RANNIE',''),
(41,'POLISTICO, ARNIE',''),
(42,'Laborte, Charibelle I. ','Program Head, BS Development Anthropology'),
(43,'Adona, Rae Katherine D.','International Affairs Coor. & Adviser, CDM Graduate School Student Council'),
(44,'Macarayo, Restituta',''),
(45,'Labrador, Ayesha','PART-TIMERS, Undergraduate Programs'),
(46,'Talungon, Carl','PART-TIMERS, Undergraduate Programs'),
(47,'Bata, M. ','PART-TIMERS, Undergraduate Programs'),
(48,'Mara  (MEC)','PART-TIMERS, Undergraduate Programs'),
(49,'Bocog, Rolen (Shared faculty)','PART-TIMERS, Undergraduate Programs'),
(50,'Bahian (Shared faculty)','PART-TIMERS, Undergraduate Programs'),
(51,'DAIS, ALDRIN','PART-TIME FACULTY FOR GENERAL EDUCATION DEPARTMENT (Physical Education)'),
(52,'Faunillan, Antonio M Jr.','PART-TIMERS, Graduate School'),
(53,'Sable, Sherlito C','PART-TIMERS, Graduate School'),
(54,'Murcia, John Vianne P. ','PART-TIMERS, Graduate School'),
(55,'Palma, Artelo ','PART-TIMERS, Graduate School'),
(56,'Bayogan, Jonathan  ','PART-TIMERS, Graduate School'),
(57,'Manalo, Lemuel','PART-TIMERS, Graduate School'),
(58,'Antipolo, Sophremiano','PART-TIMERS, Graduate School'),
(59,'TAGALO, ROMULO','PART-TIMERS, Graduate School'),
(60,'MAKILAN, MICHAEL','PART-TIMERS, Graduate School');

/*Table structure for table `facultyload` */

DROP TABLE IF EXISTS `facultyload`;

CREATE TABLE `facultyload` (
  `LoadID` int(11) NOT NULL AUTO_INCREMENT,
  `FacultyID` int(11) DEFAULT NULL,
  `ScheduleID` int(11) DEFAULT NULL,
  `TotalLoads` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`LoadID`),
  KEY `FacultyID` (`FacultyID`),
  KEY `ScheduleID` (`ScheduleID`),
  CONSTRAINT `facultyload_ibfk_1` FOREIGN KEY (`FacultyID`) REFERENCES `faculty` (`FacultyID`),
  CONSTRAINT `facultyload_ibfk_2` FOREIGN KEY (`ScheduleID`) REFERENCES `schedule` (`ScheduleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `facultyload` */

/*Table structure for table `rooms` */

DROP TABLE IF EXISTS `rooms`;

CREATE TABLE `rooms` (
  `RoomID` int(11) NOT NULL AUTO_INCREMENT,
  `RoomName` varchar(255) NOT NULL,
  PRIMARY KEY (`RoomID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `rooms` */

insert  into `rooms`(`RoomID`,`RoomName`) values 
(1,'ALB 1'),
(2,'ALB 2'),
(3,'ALB 3'),
(4,'ALB 4'),
(5,'ALB 5'),
(6,'ALB 6'),
(7,'ALB 7'),
(8,'ALB 8'),
(9,'ALB 9'),
(10,'ALB 10'),
(11,'ALB 11'),
(12,'ALB 12'),
(13,'COMLAB');

/*Table structure for table `schedule` */

DROP TABLE IF EXISTS `schedule`;

CREATE TABLE `schedule` (
  `ScheduleID` int(11) NOT NULL AUTO_INCREMENT,
  `RoomID` int(11) DEFAULT NULL,
  `FacultyID` int(11) DEFAULT NULL,
  `SubjectID` int(11) DEFAULT NULL,
  `SectionID` int(11) DEFAULT NULL,
  `TimeStart` time NOT NULL,
  `TimeEnd` time NOT NULL,
  `AcademicYearStart` year(4) NOT NULL,
  `AcademicYearEnd` year(4) NOT NULL,
  `Semester` varchar(50) NOT NULL,
  `LectureUnits` int(11) NOT NULL DEFAULT 0,
  `LaboratoryUnits` int(11) NOT NULL DEFAULT 0,
  `DayOfWeek` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ScheduleID`),
  KEY `RoomID` (`RoomID`),
  KEY `FacultyID` (`FacultyID`),
  KEY `SubjectID` (`SubjectID`),
  KEY `SectionID` (`SectionID`),
  CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`RoomID`) REFERENCES `rooms` (`RoomID`),
  CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`FacultyID`) REFERENCES `faculty` (`FacultyID`),
  CONSTRAINT `schedule_ibfk_3` FOREIGN KEY (`SubjectID`) REFERENCES `subjects` (`SubjectID`),
  CONSTRAINT `schedule_ibfk_4` FOREIGN KEY (`SectionID`) REFERENCES `sections` (`SectionID`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `schedule` */

insert  into `schedule`(`ScheduleID`,`RoomID`,`FacultyID`,`SubjectID`,`SectionID`,`TimeStart`,`TimeEnd`,`AcademicYearStart`,`AcademicYearEnd`,`Semester`,`LectureUnits`,`LaboratoryUnits`,`DayOfWeek`) values 
(1,12,1,82,23,'01:00:00','04:00:00',2023,2024,'1st Semester',0,0,NULL),
(2,1,2,1,1,'19:39:00','19:39:00',2023,2024,'2nd Semester',0,0,NULL),
(3,10,1,1,1,'18:42:00','20:42:00',2023,2024,'2nd Semester',0,0,NULL),
(4,3,5,1,1,'19:48:00','19:48:00',2000,2000,'1st Semester',0,0,NULL),
(5,1,1,1,1,'19:13:00','20:12:00',2000,2000,'2nd Semester',3,3,NULL),
(6,1,1,1,1,'19:15:00','19:15:00',2000,2000,'1st Semester',3,3,NULL),
(7,1,1,1,1,'19:15:00','19:15:00',2000,2000,'1st Semester',3,3,NULL),
(8,1,1,1,1,'19:28:00','19:28:00',2001,2000,'1st Semester',3,3,NULL),
(9,1,1,1,1,'20:30:00','19:31:00',2000,2000,'1st Semester',3,3,NULL),
(10,1,1,1,1,'20:33:00','19:35:00',2000,2000,'1st Semester',3,3,NULL),
(11,1,1,1,1,'20:33:00','19:35:00',2000,2000,'1st Semester',3,3,NULL)