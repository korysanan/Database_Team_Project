create table board (
   num int not null auto_increment,
   id char(15) not null,
   name char(10) not null,
   subject char(200) not null,
   content text not null,        
   regist_day char(20) not null,
   hit int not null,
   file_name char(40),
   file_type char(40),
   file_copied char(40),
   recommend int not null,
   public char(5), #처음에 불리언 했는데 false로 공백이 들어가면 오류가 생겨서 문자열로 바꿈
   primary key(num)
);

