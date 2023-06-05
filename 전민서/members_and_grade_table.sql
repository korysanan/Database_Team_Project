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


insert into members(user_num,user_nickname,email,user_id,password)
values
(1,'Jay','jay3821@gmail.com','jay3821','jayjay3821!'),
(2,'JJ','jiji0512@gmail.com','jiji0512','jiji0512@'),
(3,'고쉬','ogsh0909@gmail.com','ogsh0909','ogsh0909!'),
(4,'서강준','skj1217@naver.com','skj1217','skj1217!'),
(5,'고수리','gsl4179@gmail.com','gsl4179','gsl4179!'),
(6,'jul','jul8821@gmail.com','jul8821','jul8821!'),
(7,'siiiiiiiiiiiu','ronaldo231@gmail.com','ronaldo231','ronaldo231!'),
(8,'볼빨간덕배','kdb0628@gmail.com','kdb0628','kdb0628!'),
(9,'무야호','mudo563@naver.com','mudo563','mudo563!'),
(10,'korysanan','krsn421@naver.com','krsn421','krsn421!'),
(11,'소고기발탄','valtan01@gmail.com','valtan01','valtan01@!'),
(12,'상남자김대판','supermuffin@gmail.com','kdp5152','kdp5152!'),
(13,'알자르타카르센','alzaltak@gmail.com','azl1987','azl1987!'),
(14,'제니훈','jennyh@gmail.com','hoon1993','hoon1993!'),
(15,'르힛','ksh1441@naver.com','ksh1441','ksh1441!'),
(16,'옥냥이가먼저함','mjl0909@gmail.com','mjl0909','mjl0909!'),
(17,'아바다케다브라','ljh0812@naver.com','ljh0812','ljh0812!'),
(18,'죽음은바람과같지','yasuo1213@gmail.com','yasuo1213','yasuo1213!'),
(19,'돈많은백수','kyj0420@naver.com','kyj0420','kyj0420!'),
(20,'숙련없는숙련팟','lsg1128@naver.com','lsg1128','lsg1128!');


insert into join_platform(user_num,platform) values
(1),
(2, 'netflix'),
(3, 'netflix'), (3, 'disney'),
(4, 'netflix'), (4, 'wave'),
(5, 'netflix'), (5, 'wave'), (5, 'tving'),
(6, 'netflix'),
(7, 'netflix'), (7, 'disney'),
(8, 'netflix'), (8, 'disney'),
(9, 'netflix'), (9, 'wave'), (9, 'tving'),
(10, 'netflix'), (10, 'wave'), (10, 'tving'), (10, 'disney'),
(11, 'wave'), (11, 'tving'),
(12, 'netflix'), (12, 'tving'), (12, 'disney'),
(13, 'netflix'),
(14, 'netflix'), (14, 'disney'),
(15, 'netflix'),
(16, 'netflix'), (16, 'tving'), (16, 'wave'), (16, 'disney'),
(17),
(18, 'netflix'),
(19, 'netflix'), (19, 'disney'),
(20, 'netflix');

insert into prefer_genre(user_num, genre) values
(1, 'SF'),
(2, '코미디'), (2, '범죄'), (2, '가족'), (2, '스릴러'), (2, 'SF'), (2, '애니'), (2, '드라마'),
(3, '액션'),
(4, '액션'), (4, '코미디'), (4, '범죄'), (4, '판타지'), (4, '로맨스'), (4, 'SF'), (4, '스포츠'), (4, '드라마'),
(5, '액션'),
(6, '코미디'), (6, '판타지'), (6, '가족'), (6, '로맨스'), (6, '스포츠'), (6, '애니'), (6, '드라마'),
(7, '액션'), (7, '코미디'), (7, '범죄'), (7, '다큐'), (7, '역사'), (7, '가족'), (7, '스릴러'), (7, '스포츠'), (7, '전쟁'), (7, '드라마'),
(8, '액션'), (8, '코미디'), (8, '범죄'), (8, '다큐'), (8, '역사'), (8, '가족'), (8, '스릴러'), (8, '스포츠'), (8, '전쟁'), (8, '드라마'),
(9, '액션'), (9, '코미디'), (9, '범죄'), (9, '다큐'), (9, '판타지'), (9, '역사'), (9, '공포'), (9, '가족'), (9, '음악'), (9, '스릴러'), (9, '로맨스'), (9, 'SF'), (9, '스포츠'), (9, '전쟁'), (9, '서부'), (9, '애니'), (9, '드라마'),
(10, '코미디'), (10, '판타지'), (10, '가족'), (10, '로맨스'), (10, '스포츠'), (10, '애니'), (10, '드라마'),
(11, '액션'), (11, '코미디'), (11, '범죄'), (11, '다큐'), (11, '판타지'), (11, '역사'), (11, '공포'), (11, '음악'), (11, '스릴러'), (11, 'SF'), (11, '스포츠'), (11, '전쟁'), (11, '드라마'),
(12, '액션'), (12, '코미디'), (12, '범죄'), (12, '판타지'), (12, '전쟁'), (12, '애니'),
(13, '코미디'), (13, '다큐'), (13, '판타지'), (13, '역사'), (13, '가족'), (13, '드라마'),
(14, '코미디'), (14, '다큐'), (14, '판타지'), (14, '역사'), (14, '가족'), (14, '드라마'),
(15, '액션'), (15, '코미디'), (15, '범죄'), (15, '판타지'), (15, '역사'), (15, '공포'), (15, '음악'), (15, '스릴러'), (15, 'SF'), (15, '스포츠'), (15, '전쟁'),
(16, '액션'), (16, '코미디'), (16, '범죄'), (16, '다큐'), (16, '판타지'), (16, '역사'), (16, '공포'), (16, '가족'), (16, '음악'), (16, '스릴러'), (16, '로맨스'), (16, 'SF'), (16, '스포츠'), (16, '전쟁'), (16, '서부'), (16, '애니'), (16, '드라마'),
(17, '액션'), (17, '범죄'), (17, '판타지'), (17, '역사'), (17, '공포'), (17, '스릴러'), (17, '전쟁'),
(18, '액션'), (18, '범죄'), (18, '판타지'), (18, '역사'), (18, '가족'), (18, '스릴러'), (18, 'SF'), (18, '전쟁'), (18, '서부'),
(19, '액션'), (19, '코미디'), (19, '범죄'), (19, '다큐'), (19, '판타지'), (19, '역사'), (19, '공포'), (19, '가족'), (19, '음악'), (19, '스릴러'), (19, '로맨스'), (19, 'SF'), (19, '스포츠'), (19, '전쟁'), (19, '서부'), (19, '애니'), (19, '드라마'),
(20, 'SF');


insert into grade(content_id,member_id,grade) values
(1,1,9),
(2,2,8),
(3,3,9),
(4,4,6),
(5,5,8),
(6,6,10),
(7,7,9),
(8,8,7),
(9,9,10),
(10,10,1),
(11,11,5),
(12,12,7),
(13,13,8),
(14,14,9),
(15,15,10),
(16,16,8),
(17,17,9),
(18,18,10),
(19,19,7),
(20,20,9);