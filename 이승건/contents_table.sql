

use DBDBDIB;

create table contents
(
	id int NOT NULL Auto_increment,
    title varchar(50)  default '' NOT NULL,
    opening_time date default now() NOT NULL,	#date자료형은 YY-MM-DD의 형식으로 날짜를 표현한다.
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
    CONSTRAINT contents_limit_ibfk FOREIGN KEY(id) REFERENCES contents(id)
);
