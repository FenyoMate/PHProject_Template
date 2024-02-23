DROP DATABASE IF EXISTS forumDB;

CREATE DATABASE forumDB
	DEFAULT CHARACTER SET utf8
	DEFAULT COLLATE utf8_general_ci;

USE forumDB;

create table users(
                      id int primary key auto_increment,
                      email varchar(255) NOT NULL,
                      password varchar(255) NOT NULL
);

INSERT INTO users (email, password) VALUES ('teszt@elek.hu', 'asdasd123');


create table threads(
	id int  primary key auto_increment,
    title varchar(255) NOT NULL,
    content varchar(255) NOT NULL,
    created_by int NOT NULL,

    foreign key (created_by) references users(id)
);

INSERT INTO threads (title, content, created_by) VALUES ('Teszt1', 'Ez egy teszt thread', '1');
INSERT INTO threads (title, content, created_by) VALUES ('Teszt2', 'Ez egy másik teszt thread', '1');
