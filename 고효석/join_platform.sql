create table join_platform (
    user_num int,
    platform varchar(50),
    primary key(user_num),
    foreign key (user_num) references members(user_num)
);
