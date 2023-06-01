create table prefer_genre (
    user_num int not null auto_increment,
    genre varchar(50),
    primary key(user_num),
    foreign key(user_num) references members(user_num)
);
