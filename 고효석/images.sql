create table images (
   id int not null auto_increment,
   imageType char(255) ,
   imageData MEDIUMBLOB,
   imageId char(255),
   primary key(id)
);

