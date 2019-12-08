create database advanced_bbs_db;

create user dbuser@localhost identified by 'zaq123';
grant all privileges on advanced_bbs_db.* to 'dbuser'@'localhost';

use advanced_bbs_db

create table topics (
  id int not null auto_increment primary key,
  title varchar(255),
  created datetime
);

create table messages (
  id int not null auto_increment primary key,
  belong_to int not null,
  u_name varchar(255),
  u_content varchar(255),
  password varchar(255) not null,
  first boolean,
  created datetime
);

desc topics;
desc messages;