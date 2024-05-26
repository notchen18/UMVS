/*
SQLyog Ultimate v13.1.1 (64 bit)
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(13,'COMLAB'),
(14,'Field'),
(15,'Pamu'),
(16,'Pamu 1');

/*Table structure for table `schedule` */

DROP TABLE IF EXISTS `schedule`;

CREATE TABLE `schedule` (
  `ScheduleID` int(11) NOT NULL AUTO_INCREMENT,
  `RoomID` int(11) DEFAULT NULL,
  `FacultyID` int(11) DEFAULT NULL,
  `SubjectID` int(11) DEFAULT NULL,
  `SectionID` int(11) DEFAULT NULL,
  `TimeStart` time DEFAULT NULL,
  `TimeEnd` time DEFAULT NULL,
  `AcademicYearStart` year(4) DEFAULT NULL,
  `AcademicYearEnd` year(4) DEFAULT NULL,
  `Semester` varchar(50) DEFAULT NULL,
  `LectureUnits` int(11) DEFAULT 0,
  `LaboratoryUnits` int(11) DEFAULT 0,
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `schedule` */

insert  into `schedule`(`ScheduleID`,`RoomID`,`FacultyID`,`SubjectID`,`SectionID`,`TimeStart`,`TimeEnd`,`AcademicYearStart`,`AcademicYearEnd`,`Semester`,`LectureUnits`,`LaboratoryUnits`,`DayOfWeek`) values 
(1,NULL,1,1,37,NULL,NULL,2023,2024,'2nd',0,0,NULL),
(2,12,1,77,23,'13:00:00','16:00:00',2023,2024,'2nd',3,0,'SATURDAY'),
(3,7,1,45,12,'14:30:00','16:00:00',2023,2024,'2nd',3,0,'TUESDAY, THURSDAY'),
(4,12,1,3,38,'10:00:00','13:00:00',2023,2024,'2nd',3,0,'SATURDAY'),
(5,14,2,94,41,'09:00:00','12:00:00',2023,2024,'2nd',0,6,'MONDAY'),
(6,15,2,95,41,'13:00:00','16:00:00',2023,2024,'2nd',3,0,'FRIDAY'),
(7,14,2,94,41,'13:00:00','16:00:00',2023,2024,'2nd',0,6,'WEDNESDAY'),
(8,9,2,48,17,'09:00:00','10:00:00',2023,2024,'2nd',3,0,'TUESDAY, THURSDAY'),
(9,9,2,96,42,'10:30:00','12:00:00',2023,2024,'2nd',3,0,'TUESDAY, THURSDAY'),
(10,16,2,96,8,'13:00:00','14:30:00',2023,2024,'2nd',3,0,'TUESDAY, THURSDAY'),
(11,1,3,2,26,'16:00:00','19:00:00',2023,2024,'2nd',3,0,'SATURDAY'),
(12,12,3,78,26,'13:00:00','16:00:00',2023,2024,'2nd',3,0,'SATURDAY'),
(13,13,3,84,35,'10:00:00','13:00:00',2023,2024,'2nd',3,0,'SATURDAY'),
(14,13,3,85,2,'10:00:00','13:00:00',2023,2024,'2nd',3,0,'TUESDAY, THURSDAY'),
(15,13,3,85,31,'09:00:00','10:30:00',2023,2023,'2nd',3,0,'TUESDAY, THURSDAY'),
(16,13,3,86,33,'09:00:00','10:30:00',2023,2023,'2nd',3,0,'MONDAY, WEDNESDAY'),
(17,1,NULL,NULL,NULL,'01:19:00','01:19:00',2024,2025,'2nd Semester',0,3,'Array'),
(18,1,NULL,NULL,NULL,'01:45:00','02:45:00',2024,2025,'2nd Semester',0,3,'Array');

/*Table structure for table `sections` */

DROP TABLE IF EXISTS `sections`;

CREATE TABLE `sections` (
  `SectionID` int(11) NOT NULL AUTO_INCREMENT,
  `SectionCode` varchar(50) NOT NULL,
  PRIMARY KEY (`SectionID`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `sections` */

insert  into `sections`(`SectionID`,`SectionCode`) values 
(1,'BSDA 3'),
(2,'BPA 1A'),
(3,'BSAB 3A'),
(4,'BSBA 1A'),
(5,'BSAE 1A'),
(6,'BSAB 1A'),
(7,'MSDC-1/MSDA'),
(8,'BSCD 1A'),
(9,'MSDC-1/MPA/MSDA'),
(10,'BSCD 1'),
(11,'BSAE 2'),
(12,'BSCD 2'),
(13,'BSCD'),
(14,'MSDC-1'),
(15,'BSAB 2-A'),
(16,'BSAB 2A'),
(17,'BPA 2'),
(18,'BPA 1-B'),
(19,'BPA 1B'),
(20,'BSCD 3'),
(21,'MSDC 2'),
(22,'BSAE 3'),
(23,'MSDC-1/MPA'),
(24,'MSDA'),
(25,'BSAB 4'),
(26,'MPA'),
(27,'BSAB 1CJ'),
(28,'BSAB 2CJ'),
(29,'BSAB 3'),
(30,'BSAB 2B'),
(31,'BPA B'),
(32,'BPA A'),
(33,'BPA'),
(34,'BPA 3'),
(35,'PhD'),
(36,'DhD'),
(37,'BSCD 4'),
(38,'MSDA/MSDC'),
(39,'BEEd 4'),
(40,'Pamu'),
(41,'BEEd 4 Pamu'),
(42,'BSDA 1A');

/*Table structure for table `subjects` */

DROP TABLE IF EXISTS `subjects`;

CREATE TABLE `subjects` (
  `SubjectID` int(11) NOT NULL AUTO_INCREMENT,
  `SubjectCode` varchar(50) NOT NULL,
  `SubjectName` varchar(255) NOT NULL,
  PRIMARY KEY (`SubjectID`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `subjects` */

insert  into `subjects`(`SubjectID`,`SubjectCode`,`SubjectName`) values 
(1,'CD 422','Thesis'),
(2,'PFA 203','Public Expenditure Management'),
(3,'RM 201','Quantitative Methods of Research'),
(4,'LGA 203','Local-National Agency Collaboration in Public Service'),
(5,'RM 325','Participatory Action Research: Theory and Practice'),
(6,'Anth Elec 324','Anthropology Elective 4'),
(7,'Anth 322','Development Communication and Social Media'),
(8,'Anth 321','Ethno-biology'),
(9,'GE 113','Understanding the Self'),
(10,'GE 114','Ethics'),
(11,'PA 112','Technical Writing'),
(12,'OS 200','Human Capital Management'),
(13,'OS 202','Leadership and Change Management'),
(14,'OS 201','Strategic Knowledge Management'),
(15,'LGA 202','Local Resource Management'),
(16,'PPPA 200','Introduction to Public Policy'),
(17,'GE 211','Purposive Communication'),
(18,'GE 112','Mathematics in the Modern World'),
(19,'DA 203','Special Problem in Development Administration'),
(20,'PFA 202','Revenue and Treasury Management'),
(21,'CDRM 201','Climate Change Adaptation and Humanitarian Action'),
(22,'AGB 321','Agribusiness Research Methods'),
(23,'AGB 122','Introduction to Agribusiness Management'),
(24,'Crop Sci 122','Practices of Crop Production'),
(25,'AE 122','Mathematical Economics'),
(26,'AE 121','Agricultural Economics Statistics'),
(27,'AGB 121','Principles of Accounting'),
(28,'Ani Sci 122','Introduction to Livestock and Poultry Production'),
(29,'Crop Sci 122','Fundamentals of Horticulture'),
(30,'CDM 201','Advance Data Analytics'),
(31,'RM 200','Qualitative Methods of Research'),
(32,'DC 201','ICT and Knowledge Management in Dev.Comm.'),
(33,'CD 122','Technical Writing'),
(34,'CDM 202','Development and Governance: Dialectics of Theory & Practice'),
(35,'CD 121','Philippine Society and Community Development'),
(36,'Ag Eng 221','Basic Farm Structures and Machineries'),
(37,'AE 423','Agricultural Price Analysis'),
(38,'AE 222','Macroeconomics'),
(39,'AE 223','Technical Writing'),
(40,'GE 215','The Life and Works of Rizal'),
(41,'Ag Ext 221','Agricultural Extension and Communication'),
(42,'DA 301','International Development Theory and Policy'),
(43,'GE 216','Readings in the Philippine History'),
(44,'AE 221','Environmental Economics'),
(45,'RM 222','Qualitative Research Method'),
(46,'CD 221','Organizing and Social Movements'),
(47,'CD 223','Planning and Administration in Community Development'),
(48,'GE 218','Arts Appreciation'),
(49,'DC 200','Comm. and Development: Concept & Approaches'),
(50,'CD Elec 2','Accounting for Community-based Enterprises'),
(51,'CD 222','Communication Strategies for Community Development'),
(52,'DC 204','Special Problems in Development Communication'),
(53,'UEP 200','Intro to National Planning Policy, History & Profession'),
(54,'UEP 205','Environmental Laws and Administration'),
(55,'Crop Prot 222','Plant Pathology'),
(56,'Soil Sci 221','Principles of Soil Science'),
(57,'AGB 223','Intermediate Microeconomic Theory'),
(58,'DRA 303','Strategic Research and Development Management'),
(59,'GE 217','Science, Technology, and Society'),
(60,'EGE 312','Philippine Indigenous Communities'),
(61,'PA 123','Organization and Management'),
(62,'PA 323','Administrative Law'),
(63,'PFA 201','Government Accounting, Auditing, and Financial Control'),
(64,'PPPA 203','Political Economy'),
(65,'DC 203','Communication, Social Marketing and Mobilization'),
(66,'CD 322','Policies, Programs and Services to Community Development'),
(67,'CD 325','Special Topics in Community Organizing'),
(68,'CD 321','Project Monitoring and Evaluation'),
(69,'CD 323','Educational Strategies for Community Development'),
(70,'DC 202','Strategic Foresight in Development Communication'),
(71,'SDA 200','Political Economy and Development'),
(72,'AE 322','Spatial Analysis'),
(73,'AE 325','Managerial Economics'),
(74,'AE 321','Development Economics'),
(75,'EGE 311','Philippine Indigenous Communities'),
(76,'AE 323','Project Feasibility Study'),
(77,'CDM 200','Basic Data Analytics'),
(78,'PFA 200','Philippine National Expenditure Planning'),
(79,'CDRM 200','Collaborative Governance and Crisis and Disaster Resilience'),
(80,'AGB 423','Farm Management'),
(81,'LGA 201','Local Development Planning and Policy'),
(82,'LGA 200','Phronetic Leadership in Public service'),
(83,'EGE 313','Gender and Society'),
(84,'DRA 301','Methods of Program Impact Evaluation'),
(85,'PA 121','Development Economics'),
(86,'PA 221','Public Fiscal Administration'),
(87,'PA core 4','Statistics for Social Science'),
(88,'Pa 222','Quantitative Research Methods'),
(89,'PA 442','Public Policy and Program Administration'),
(90,'PA 322','Foreign Language 2'),
(91,'CDM 301','Predictive Analytics & Machine Learning'),
(92,'DRA 302','Discrete Choice Analysis'),
(93,'DRA 300','Development'),
(94,'Educ 412','Teaching Internship'),
(95,'EdRes 400','Thesis'),
(96,'GE 111','Purposive Communication');

/*Table structure for table `fullschedule` */

DROP TABLE IF EXISTS `fullschedule`;

/*!50001 DROP VIEW IF EXISTS `fullschedule` */;
/*!50001 DROP TABLE IF EXISTS `fullschedule` */;

/*!50001 CREATE TABLE  `fullschedule`(
 `FacultyName` varchar(255) ,
 `SubjectName` varchar(255) ,
 `RoomName` varchar(255) ,
 `SectionCode` varchar(50) ,
 `DayOfWeek` varchar(255) ,
 `TimeStart` time ,
 `TimeEnd` time 
)*/;

/*Table structure for table `scheduledetails` */

DROP TABLE IF EXISTS `scheduledetails`;

/*!50001 DROP VIEW IF EXISTS `scheduledetails` */;
/*!50001 DROP TABLE IF EXISTS `scheduledetails` */;

/*!50001 CREATE TABLE  `scheduledetails`(
 `Faculty Name` varchar(255) ,
 `Subject Code` varchar(50) ,
 `Description` varchar(255) ,
 `Yr./Block` varchar(50) ,
 `Lec` int(11) ,
 `Lab` int(11) ,
 `Day` varchar(255) ,
 `TimeStart` time ,
 `TimeEnd` time ,
 `Room` varchar(255) 
)*/;

/*View structure for view fullschedule */

/*!50001 DROP TABLE IF EXISTS `fullschedule` */;
/*!50001 DROP VIEW IF EXISTS `fullschedule` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `fullschedule` AS select `f`.`FacultyName` AS `FacultyName`,`s`.`SubjectName` AS `SubjectName`,`r`.`RoomName` AS `RoomName`,`se`.`SectionCode` AS `SectionCode`,`sc`.`DayOfWeek` AS `DayOfWeek`,`sc`.`TimeStart` AS `TimeStart`,`sc`.`TimeEnd` AS `TimeEnd` from ((((`schedule` `sc` join `faculty` `f` on(`sc`.`FacultyID` = `f`.`FacultyID`)) join `subjects` `s` on(`sc`.`SubjectID` = `s`.`SubjectID`)) join `rooms` `r` on(`sc`.`RoomID` = `r`.`RoomID`)) join `sections` `se` on(`sc`.`SectionID` = `se`.`SectionID`)) */;

/*View structure for view scheduledetails */

/*!50001 DROP TABLE IF EXISTS `scheduledetails` */;
/*!50001 DROP VIEW IF EXISTS `scheduledetails` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `scheduledetails` AS select `f`.`FacultyName` AS `Faculty Name`,`s`.`SubjectCode` AS `Subject Code`,`s`.`SubjectName` AS `Description`,`sec`.`SectionCode` AS `Yr./Block`,`sch`.`LectureUnits` AS `Lec`,`sch`.`LaboratoryUnits` AS `Lab`,`sch`.`DayOfWeek` AS `Day`,`sch`.`TimeStart` AS `TimeStart`,`sch`.`TimeEnd` AS `TimeEnd`,`r`.`RoomName` AS `Room` from ((((`schedule` `sch` join `faculty` `f` on(`sch`.`FacultyID` = `f`.`FacultyID`)) join `subjects` `s` on(`sch`.`SubjectID` = `s`.`SubjectID`)) join `sections` `sec` on(`sch`.`SectionID` = `sec`.`SectionID`)) left join `rooms` `r` on(`sch`.`RoomID` = `r`.`RoomID`)) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
