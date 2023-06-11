DROP DATABASE IF EXISTS `DBDBDIB`;
CREATE DATABASE `DBDBDIB`;

use `DBDBDIB`;

/*Table structure for table `members`(회원) */
CREATE TABLE `members`
(
	`id` varchar(50) DEFAULT '' NOT NULL,
    `name` varchar(50) DEFAULT ''  NOT NULL,
    `password` varchar(50) DEFAULT '' NOT NULL,
    `email` varchar(50) DEFAULT '' NOT NULL,
    `age` int(3) DEFAULT 0 NOT NULL,
    `sub` timestamp DEFAULT now() NOT NULL,
    `last_join` int(11) DEFAULT 0,
    `genre` varchar(50) DEFAULT NULL,
	`wave` bool DEFAULT false,
	`netflix` bool DEFAULT false,
	`tving` bool DEFAULT false,
	`disney` bool DEFAULT false,
    PRIMARY KEY(`name`)
);

/*Data for the table `members`(회원) */
#insert into `members` values
#();

/*Table structure for table `contents`(콘텐츠) */
CREATE TABLE `contents`
(
	`id` int(11) DEFAULT 0 NOT NULL,
    `title` varchar(50) DEFAULT '' NOT NULL,
    `opening_time` timestamp DEFAULT now() NOT NULL,
    `genre` varchar(50) DEFAULT '' NOT NULL,
    `time` int(11) DEFAULT 60 NOT NULL,
    `views` int(11) DEFAULT 0 NOT NULL,
    `age_limit` int(2) DEFAULT 0 NOT NULL,
    `restriction_reason` varchar(50) DEFAULT '' NOT NULL,
    `director` varchar(50) DEFAULT '' NOT NULL,
    `author` varchar(50) DEFAULT '' NOT NULL,
    PRIMARY KEY(`id`)#,
#    KEY `rating`(`rating`),
#    CONSTRAINT `contents_ibfk_1` FOREIGN KEY(`rating`) REFERENCES `ratings`(`rating`)
);

/*Date for the table `contents`(콘텐츠)*/
#insert into `contents` values
#();


/*Table structure for table `reviews`(리뷰) */
CREATE TABLE `reviews`
(
	postNumber INT PRIMARY KEY AUTO_INCREMENT,
    memberNumber INT NOT NULL,
    reviewTitle VARCHAR(20) NOT NULL CHECK (LENGTH(reviewTitle) <= 20),
    reviewContent LONGTEXT CHECK (LENGTH(reviewContent) >= 30),
    postDate TIMESTAMP DEFAULT current_timestamp,
    likes INT default 0,
    dislikes INT default 0,
    FOREIGN KEY (memberNumber) references members(id)
);

/*Data for the table `reviews`(리뷰) */
#insert into `reviews`(`content_id`, `writer`, `review`, `time`, `good`, `bad`) values
#();  

/*Table structure for table `ratings`(평점) */
CREATE TABLE `ratings`
(
	`content_id` int(11) DEFAULT 0 NOT NULL,
    `writer` varchar(50) DEFAULT '' NOT NULL,
    `rating` int(1) DEFAULT 0 NOT NULL,
    PRIMARY KEY(`content_id`, `writer`),
    KEY `content_id`(`content_id`),
    KEY `writer`(`writer`),
    CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `contents`(`id`),
    CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`writer`) REFERENCES `members`(`name`) ON UPDATE CASCADE ON DELETE CASCADE
);

/*Date for the table `ratings`(리뷰)*/
#insert into `ratings` values
#();


    
/*Table structure for table `events`(이벤트) */
CREATE TABLE `events`
(
	`num` int(11) AUTO_INCREMENT,
    `name` varchar(50) DEFAULT '' NOT NULL,
    `start` timestamp DEFAULT now() NOT NULL,
    `end` timestamp DEFAULT now() NOT NULL,			/*default값 설정?*/
    `condition` varchar(50) DEFAULT '' NOT NULL,	/*크기 얼마나?*/
    `detail` varchar(100) DEFAULT '' NOT NULL,		/*크기 얼마나?*/
    PRIMARY KEY(`num`)
);

/*Date for the table `events`(이벤트)*/
#insert into `events`(`name`, `start`, `end`, `condition`, `detail`) values
#();
    
/*Table structure for table `platforms`(플랫폼) */
CREATE TABLE `platforms`
(
	`name` varchar(50) DEFAULT '' NOT NULL,
    `introduction` varchar(50) DEFAULT '' NOT NULL,
    `price` int(11) DEFAULT 0 NOT NULL,
    `family_price` bool DEFAULT false,
    `link` varchar(50) DEFAULT '' NOT NULL,
    `rating` int(1) DEFAULT 0 NOT NULL,
    PRIMARY KEY(`name`)
);

/*Date for the table `platforms`(플랫폼)*/
#insert into `platforms` values
#();

/*Table structure for table `platform_events`(플랫폼 이벤트) */
CREATE TABLE `platform_events`
(
	`num` int(11) AUTO_INCREMENT,
    `platform_name` varchar(50) DEFAULT '' NOT NULL,
    `name` varchar(50)DEFAULT '' NOT NULL,
	`start` timestamp DEFAULT now() NOT NULL,
    `end` timestamp DEFAULT now() NOT NULL,
    `condition` varchar(20) DEFAULT '' NOT NULL,
    `detail` varchar(50) DEFAULT '' NOT NULL,
    PRIMARY KEY(`num`),
    KEY `platform_name`(`platform_name`),
    CONSTRAINT `platform_events_ibfk_1` FOREIGN KEY(`platform_name`) REFERENCES `platforms`(`name`) ON DELETE CASCADE
);

/*Date for the table `platform_events`(플랫폼 이벤트)*/
#insert into `platform_events`(`platform_name`, `name`, `start`, `start`, `condition`, `detail`) values
#();



/*Table structure for table `content_platforms`(콘텐츠) */
/*
CREATE TABLE `content_platforms`
(
	


);



*/