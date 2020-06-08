create database if not exists student_management_system;

/*create table student_management_system.student_registration (
id MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
name varchar(100) NOT NULL,
email varchar(200) NOT NULL,
username varchar(100) NOT NULL,
password varchar(25) NOT NULL,
confirm_password varchar(25) NOT NULL,
encrypted_password varchar(200) NOT NULL,
phone_no varchar(50),
address varchar(300) NOT NULL,
image varchar(300) default 'profile.png',
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
*/

create table student_management_system.roles(
id smallint(4) UNSIGNED NOT NULL AUTO_INCREMENT,
name varchar(100) NOT NULL,
primary key(id)
) engine = InnoDB default charset= utf8mb4 collate = utf8mb4_unicode_ci AUTO_INCREMENT = 1;

INSERT INTO `student_management_system`.`roles` (`name`) VALUES ('Teacher');
INSERT INTO `student_management_system`.`roles` (`name`) VALUES ('Student');

create table student_management_system.users (
id MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
role_id smallint(4) UNSIGNED NOT NULL,
name varchar(100) NOT NULL,
email varchar(200) NOT NULL,
username varchar(100) NOT NULL,
password varchar(25) NOT NULL,
confirm_password varchar(25) NOT NULL,
phone_no varchar(50),
address varchar(300) NOT NULL,
image varchar(300) default 'profile.png',
created timestamp,
modified timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
status varchar(100) collate utf8mb4_unicode_ci DEFAULT 1,
primary key(id),
constraint `user_role` foreign key(role_id) references roles(id) 
) engine = InnoDB default charset = utf8mb4 collate = utf8mb4_unicode_ci AUTO_INCREMENT = 1; 

INSERT INTO `student_management_system`.`users` (`role_id`, `name`, `email`, `username`, `password`, `confirm_password`, `phone_no`, `address`) VALUES ('1', 'Apeksha Sakhare', 'apeksha@gmail.com', 'Apeksha', '123', '123', '9990786700', 'Mankapur');


CREATE TABLE `student_management_system`.`courses` ( 
`id` MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT , 
`name` VARCHAR(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
`summary` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , 
`start_date` DATE NOT NULL ,
`end_date` DATE NOT NULL ,
created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
modified timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
status varchar(100) collate utf8mb4_unicode_ci DEFAULT 0,
PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci AUTO_INCREMENT = 1;


CREATE TABLE `student_management_system`.`course_attachments` ( 
`id` MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT , 
`course_id` MEDIUMINT(8) UNSIGNED NOT NULL,  
`notes` varchar(300),
created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
modified timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
status varchar(100) collate utf8mb4_unicode_ci DEFAULT 0,
PRIMARY KEY (`id`),
constraint `course_notes_id` foreign key(course_id) references courses(id) ON DELETE CASCADE
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci AUTO_INCREMENT = 1;


CREATE TABLE `student_management_system`.`my_courses` ( 
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
constraint `sms_student_id` foreign key (student_id) references users(id) ON DELETE CASCADE,
constraint `sms_course_id` foreign key (course_id) references courses(id) ON DELETE CASCADE
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci AUTO_INCREMENT = 1;


select * from student_management_system.roles;
select * from `student_management_system`.`users`;
select * from `student_management_system`.`courses`;
select * from `student_management_system`.`course_attachments`;
select * from `student_management_system`.`my_courses`;



drop table student_management_system.roles;
drop table `student_management_system`.`my_courses`;
drop table student_management_system.users;
drop table `student_management_system`.`course_attachments`;
drop table `student_management_system`.`courses`;

