DROP TABLE IF EXISTS `applications`

CREATE TABLE `applications` (
 `application_id` int(11) NOT NULL AUTO_INCREMENT,
 `student_id` int(11) NOT NULL,
 `hostel_id` int(11) NOT NULL,
 PRIMARY KEY (`application_id`),
 KEY `hostel_id` (`hostel_id`),
 KEY `student_id` (`student_id`),
 CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`hostel_id`) REFERENCES `hostels` (`hostel_id`),
 CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4