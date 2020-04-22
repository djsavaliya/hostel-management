DROP TABLE IF EXISTS `hostels`;

CREATE TABLE `hostels` (
 `hostel_id` int(11) NOT NULL AUTO_INCREMENT,
 `hoste_name` varchar(255) NOT NULL,
 `no_of_rooms` int(11) NOT NULL,
 `no_of_students` int(11) NOT NULL,
 PRIMARY KEY (`hostel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
