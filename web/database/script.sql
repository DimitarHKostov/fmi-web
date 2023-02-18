create database db;

SET FOREIGN_KEY_CHECKS = 0;

create table db.roles (
    id int not null primary key,
    name varchar(16) not null
);

create table db.users (
    username varchar(64) not null,
    password varchar(255) not null, 
    firstName varchar(64) not null,
    lastName varchar(64) not null,
    email varchar(64) not null primary key,
    uuid char(36) not null,
    roleId int,
    foreign key(roleId)
    references db.roles(id)
);

insert into db.roles values(1, "admin");
insert into db.roles values(2, "regular");

insert into db.users values("Root123", "$2y$10$aMTYaSEDOPvOUkoTKvGSEuy9W.2srte3wkUn3i7UyxSkYomtn1UuG", "fname", "lname", "root@gmail.com", "1036ce41-2b0c-47b9-a17e-7c09ce020fdf", 1);

create table db.events (
    id int auto_increment primary key,
    name varchar(64) not null,
    iban varchar(34) not null,
    description varchar(64) not null
);

create table db.eventRoles (
    id int not null primary key,
    name varchar(16)
);

insert into db.eventRoles values(1, "beneficier");
insert into db.eventRoles values(2, "participant");
insert into db.eventRoles values(3, "creator");

create table db.participants (
    id int auto_increment primary key,
    userEmail varchar(64),
    eventId int,
    eventRoleId int,
    foreign key(userEmail)
    references db.users(email),
    foreign key(eventId)
    references db.events(id),
    foreign key(eventRoleId)
    references db.eventRoles(id)
);