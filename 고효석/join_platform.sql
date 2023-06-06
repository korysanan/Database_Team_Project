create table join_platform (
    user_num int,
    platform varchar(50),
    foreign key (user_num) references members(user_num)
);
