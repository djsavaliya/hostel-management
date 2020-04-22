DROP TABLE IF EXISTS `managers`

CREATE TABLE `managers` (
 `manager_id` int(11) NOT NULL AUTO_INCREMENT,
 `first_name` varchar(255) NOT NULL,
 `last_name` varchar(255) NOT NULL,
 `date_of_birth` date NOT NULL,
 `mobile` varchar(30) NOT NULL,
 `email` varchar(255) NOT NULL,
 `password` varchar(255) NOT NULL,
 `is_admin` tinyint(1) NOT NULL,
 `hostel_id` int(11) DEFAULT NULL,
 PRIMARY KEY (`manager_id`),
 UNIQUE KEY `email` (`email`),
 KEY `hostel_id` (`hostel_id`),
 CONSTRAINT `managers_ibfk_1` FOREIGN KEY (`hostel_id`) REFERENCES `hostels` (`hostel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4