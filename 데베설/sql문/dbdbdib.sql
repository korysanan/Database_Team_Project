DROP DATABASE IF EXISTS DBDBDIB;
CREATE DATABASE DBDBDIB;

use DBDBDIB;

/*Table structure for table `members`(회원) */

create table members (
    user_num int not null auto_increment,
    user_nickname varchar(50) not null,
    email varchar(50) not null,
    user_id char(50) not null,
    password char(50) not null,
    recent_access char(20) not null default "tmp_string",
    num_of_messege int default 0,
    primary key(user_num)
);

create table join_platform (
    user_num int,
    platform varchar(50),
    primary key(user_num),
    foreign key (user_num) references members(user_num)
);

create table prefer_genre (
    user_num int,
    genre varchar(50),
    primary key(user_num),
    foreign key(user_num) references members(user_num)
);

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

create table contents_platform
(
	id int default 0 NOT NULL,
	platform varchar(30)  NOT NULL,
	platform_link varchar(2048) default '' NOT NULL,	#https://careerly.co.kr/qnas/1758-브라우저마다 url입력 최대 사이즈가 다른데요, 점유율이 가장 높은 크롬브라우저의 url 최대 길이(2048)를 고려해서 설정한 값입니다.
	PRIMARY KEY(platform),
    KEY (id),
    CONSTRAINT contents_platform_ibfk FOREIGN KEY (id) REFERENCES contents(id)
);

create table contents_limit
(
	id int default 0 NOT NULL,
    limit_reason varchar(5) default '' NOT NULL,
    PRIMARY KEY(limit_reason),
    KEY(id),
    CONSTRAINT contents_limit_ibfk FOREIGN KEY(id) REFERENCES contents(id)
);

create table contents_genre
(
	id int default 0 NOT NULL,
    genre varchar(5) default '' NOT NULL,
    PRIMARY KEY(genre),
    KEY(id),
    CONSTRAINT contents_genre_ibfk FOREIGN KEY(id) REFERENCES contents(id)
);

ALTER TABLE members ADD INDEX idx_members_id (user_nickname);

ALTER TABLE contents ADD INDEX idx_title (title);

CREATE TABLE reviews
(
	postNumber INT NOT NULL Auto_increment,
    user_nickname VARCHAR(50) NOT NULL,
    contents_title VARCHAR(50)  default '' NOT NULL,
    reviewTitle VARCHAR(20) NOT NULL CHECK (LENGTH(reviewTitle) <= 20),
    reviewContent LONGTEXT CHECK (LENGTH(reviewContent) >= 30),
    postDate TIMESTAMP DEFAULT now(),
    likes INT default 0,
    dislikes INT default 0,
    PRIMARY KEY(postNumber),
    FOREIGN KEY (user_nickname) references members(user_nickname),
    FOREIGN KEY (contents_title) references contents(title)
);

create table Grade
(
	Content_ID int Not Null,
    Member_ID int Not Null,
    grade int,
	constraint Grade_PK primary key(Content_ID, Member_ID),
    constraint grade_limit check(grade >=1 and grade<=10),
    foreign key (Content_ID) references contents(id),
    foreign key (Member_ID) references members(user_num)
);

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