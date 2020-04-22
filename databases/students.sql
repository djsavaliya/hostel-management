DROP TABLE IF EXISTS `students`;

CREATE TABLE `students` (
 `student_id` int(11) NOT NULL AUTO_INCREMENT,
 `first_name` varchar(255) NOT NULL,
 `last_name` varchar(255) NOT NULL,
 `date_of_birth` date NOT NULL,
 `mobile` int(10) NOT NULL,
 `email` varchar(255) NOT NULL,
 `college_id` varchar(255) NOT NULL,
 `password` varchar(255) NOT NULL,
 `hostel_id` int(11) NOT NULL,
 PRIMARY KEY (`student_id`),
 UNIQUE KEY `college_id` (`college_id`),
 KEY `hostel_id` (`hostel_id`),
 CONSTRAINT `students_ibfk_1` FOREIGN KEY (`hostel_id`) REFERENCES `hostels` (`hostel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4