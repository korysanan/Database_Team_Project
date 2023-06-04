DROP DATABASE IF EXISTS DBDBDIB;
CREATE DATABASE DBDBDIB;

use DBDBDIB;

/*Table structure for table `members`(회원) */

DROP TABLE IF EXISTS members;

CREATE TABLE members
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

DROP TABLE IF EXISTS reviews;

CREATE TABLE reviews
(
	postNumber INT PRIMARY KEY AUTO_INCREMENT,
    memberName VARCHAR(50) NOT NULL,
    reviewTitle VARCHAR(20) NOT NULL CHECK (LENGTH(reviewTitle) <= 20),
    reviewContent LONGTEXT CHECK (LENGTH(reviewContent) >= 30),
    postDate TIMESTAMP DEFAULT now(),
    likes INT default 0,
    dislikes INT default 0,
    FOREIGN KEY (memberName) references members(name)
);

DROP TABLE IF EXISTS contents;

create table contents
(
	id int NOT NULL Auto_increment,
    title varchar(50)  default '' NOT NULL,
    opening_time date NOT NULL,	#date자료형은 YY-MM-DD의 형식으로 날짜를 표현한다. 
    running_times int default 60 NOT NULL,
    views int default 0 NOT NULL,
    age_limit int,
	director varchar(50),
    author varchar(50),
    PRIMARY KEY(id)
);

DROP TABLE IF EXISTS contents_platform;

create table contents_platform
(
	id int default 0 NOT NULL,
	platform varchar(30)  NOT NULL,
	platform_link varchar(2048) default '' NOT NULL,	#https://careerly.co.kr/qnas/1758-브라우저마다 url입력 최대 사이즈가 다른데요, 점유율이 가장 높은 크롬브라우저의 url 최대 길이(2048)를 고려해서 설정한 값입니다.
	PRIMARY KEY(platform),
    KEY (id),
    CONSTRAINT contents_platform_ibfk FOREIGN KEY (id) REFERENCES contents(id)
);

DROP TABLE IF EXISTS contents_limit;

create table contents_limit
(
	id int default 0 NOT NULL,
    limit_reason varchar(5) default '' NOT NULL,
    PRIMARY KEY(limit_reason),
    KEY(id),
    CONSTRAINT contents_limit_ibfk FOREIGN KEY(id) REFERENCES contents(id)
);

DROP TABLE IF EXISTS contents_genre;

create table contents_genre
(
	id int default 0 NOT NULL,
    genre varchar(5) default '' NOT NULL,
    PRIMARY KEY(genre),
    KEY(id),
    CONSTRAINT contents_genre_ibfk FOREIGN KEY(id) REFERENCES contents(id)
);

DROP TABLE IF EXISTS Grade;

ALTER TABLE members ADD INDEX idx_members_id (id);

create table Grade
(
	Content_ID int Not Null,
    Member_ID varchar(20) Not Null,
    grade int,
	constraint Grade_PK primary key(Content_ID, Member_ID),
    constraint grade_limit check(grade >=1 and grade<=10),
    foreign key (Content_ID) references contents(id),
    foreign key (Member_ID) references members(id)
);

DROP TABLE IF EXISTS event;

create table event
(
	event_id int NOT NULL,
    event_name varchar(50) NOT NULL,
    event_start TIMESTAMP NOT NULL,
    event_end TIMESTAMP NOT NULL,
    event_condition VARCHAR(100) NOT NULL,
    event_detail varchar(500) NOT NULL,
    PRIMARY KEY(event_id),
    UNIQUE (event_name)
);

DROP TABLE IF EXISTS users;

create table users
(
	user_nickname varchar(20) NOT NULL,
	user_id varchar(20) NOT NULL,
	pw varchar(20) NOT NULL,
    email varchar(20) NOT NULL,
    register_day TIMESTAMP NOT NULL,
    recent_connect TIMESTAMP NOT NULL,
    genre varchar(20),
    register_yn BOOL NOT NULL,
    wave_yn BOOL NOT NULL,
    netflix_yn BOOL NOT NULL,
	disney_yn BOOL NOT NULL,
    tving_yn BOOL NOT NULL,
    FOREIGN KEY (genre) REFERENCES contents_genre(genre),
    PRIMARY KEY(user_id),
    UNIQUE (user_nickname)
);

DROP TABLE IF EXISTS platforms;

CREATE TABLE platforms
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

DROP TABLE IF EXISTS platform_events;

CREATE TABLE platform_events
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