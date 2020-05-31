create database if not exists student_management_system;

create table student_management_system.student_registration (
id MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
name varchar(100) NOT NULL,
email varchar(200) NOT NULL,
username varchar(100) NOT NULL,
password varchar(25) NOT NULL,
confirm_password varchar(25) NOT NULL,
phone_no varchar(50),
address varchar(300) NOT NULL,
#image longtext NOT NULL,
created timestamp,
modified timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
status varchar(100) collate utf8mb4_unicode_ci DEFAULT 1,
primary key(id)
) engine = InnoDB default charset = utf8mb4 collate = utf8mb4_unicode_ci AUTO_INCREMENT = 1; 

create table student_management_system.teacher_info (
id int unsigned NOT NULL AUTO_INCREMENT,
name varchar(100) NOT NULL,
email varchar(200) NOT NULL,
username varchar(100) NOT NULL,
password varchar(25) NOT NULL,
confirm_password varchar(25) NOT NULL,
phone_no varchar(50),
address varchar(300) NOT NULL,
created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
modified timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
status varchar(100) collate utf8mb4_unicode_ci DEFAULT 1,
primary key(id)
) engine = InnoDB default charset = utf8mb4 collate = utf8mb4_unicode_ci AUTO_INCREMENT = 1; 

INSERT INTO `student_management_system`.`teacher_info` (`name`, `email`, `username`, `password`, `confirm_password`, `phone_no`, `address`) VALUES ('Yogita Deshmukh', 'yogita6@gmail.com', 'yogita_deshmukh', 'Yogita@123', 'Yogita@123', '9985001245', 'Trimurti, Nagpur');
INSERT INTO `student_management_system`.`teacher_info` (`name`, `email`, `username`, `password`, `confirm_password`, `phone_no`, `address`) VALUES ('Apeksha Sakhare', 'sakhare@gmail.com', 'ap_sakhare', 'Apeksha@123', 'Apeksha@123', '9921547810', 'Pratap Nagar, Nagpur');

select * from student_management_system.student_registration;
select * from student_management_system.teacher_info;

CREATE TABLE `student_management_system`.`add_course` ( 
`id` MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT , 
`name` VARCHAR(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
`summary` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
`start_date` DATE NOT NULL ,
`end_date` DATE NOT NULL , 
`notes` varchar(300),
created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
modified timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
status varchar(100) collate utf8mb4_unicode_ci DEFAULT 1,
PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci AUTO_INCREMENT = 1;


INSERT INTO `student_management_system`.`add_course` (`name`, `summary`, `start_date`, `end_date`, `status`) VALUES ('React Native', 'It is used for cross-development app development', '2020-05-30', '2020-06-30', '1');

select * from `student_management_system`.`add_course`;


CREATE TABLE `student_management_system`.`student_my_courses` ( 
`id` MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT ,
course_id MEDIUMINT(8) UNSIGNED NOT NULL, 
student_id MEDIUMINT(8) UNSIGNED NOT NULL, 
`name` VARCHAR(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
`summary` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
`start_date` DATE NOT NULL ,
`end_date` DATE NOT NULL , 
created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
modified timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
status varchar(100) collate utf8mb4_unicode_ci DEFAULT 1,
PRIMARY KEY (`id`),
constraint `sms_student_id` foreign key (student_id) references student_registration(id) ON DELETE CASCADE,
constraint `sms_add_course_id` foreign key (student_id) references add_course(id) ON DELETE CASCADE
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci AUTO_INCREMENT = 1;

select * from `student_management_system`.`student_registration`;
select * from `student_management_system`.`add_course`;
select * from `student_management_system`.`student_my_courses`;

select * from `student_management_system`.student_registration sr inner join `student_management_system`.student_my_courses sc on sr.id = sc.student_id where sr.id = 1 and sc.id = 2;

select * from student_management_system.add_course;
select * from student_management_system.add_course where id  = 1;
select * from student_management_system.add_course;


CREATE TABLE IF NOT EXISTS login.`tbl_images` (
  `id` int(11) NOT NULL,
  `name` longblob NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


ALTER TABLE login.`tbl_images`
  ADD PRIMARY KEY (`id`);


ALTER TABLE login.`tbl_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
  
select * from student_management_system.add_course where id  = 1;

INSERT INTO `add_course` (`name`, `summary`, `start_date`, `end_date`,`status`) values ('$name', '$summary', '$start_date', '$end_date','0');

INSERT INTO student_management_system.`student_my_courses` (`course_id`, `student_id`, `name`, `summary`, `start_date`, `end_date`, `status`) values (5,4,'React Native', 'app development', '2020-06-05', '2020-07-30',1);

select sr.name from student_management_system.student_registration sr join student_management_system.student_my_courses sc on sr.id = sc.student_id where course_id = 1;


drop table student_management_system.student_my_courses;
drop table student_management_system.student_registration;
drop table student_management_system.add_course;