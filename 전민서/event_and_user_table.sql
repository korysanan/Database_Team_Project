
use DBDBDIB;

create table event
(
	event_id int NOT NULL,
    event_name varchar(50) NOT NULL,
    event_start TIMESTAMP NOT NULL,
    event_end TIMESTAMP NOT NULL,
    event_condition VARCHAR(100) NOT NULL,
    event_detail varchar(500) NOT NULL,
    PRIMARY KEY(event_id),
    PRIMARY KEY(event_name)
);

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
    PRIMARY KEY(user_nickname),
    PRIMARY KEY(user_id)
);