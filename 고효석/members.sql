create table members (
    user_num int not null auto_increment,
    email varchar(50) not null,
    user_id char(50) not null,
    password char(50) not null,
    recent_access char(20) not null default "tmp_string",
    num_of_messege int default 0,
    primary key(user_num)
);
