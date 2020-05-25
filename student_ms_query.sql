create database if not exists student_management_system;

create table student_management_system.student_registration (
id int unsigned NOT NULL AUTO_INCREMENT,
name varchar(100) NOT NULL,
email varchar(200) NOT NULL,
username varchar(100) NOT NULL,
password varchar(25) NOT NULL,
confirm_password varchar(25) NOT NULL,
phone_no varchar(50),
address varchar(300) NOT NULL,
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

select u.* from student_management_system.student_registration AS u join student_management_system.teacher_info AS c ON u.id = c.id where u.email = 'sawarkar_prachi.ghrcecs@raisoni.net';

drop table student_management_system.student_registration;
