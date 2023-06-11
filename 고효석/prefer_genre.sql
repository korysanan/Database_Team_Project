create table prefer_genre (
    user_num int,
    genre varchar(50),
    foreign key(user_num) references members(user_num)
);
