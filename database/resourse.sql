create table if not exists teacher(
    office varchar(50) not null,
    name varchar(50) not null unique,
    UID varchar(50) not null unique,
    pwd varchar(50) not null
    );

create table if not exists student(
    SID int not null unique,
    class int not null,
    name varchar(50) not null
    );
    
create table if not exists reason(
    YID varchar(50) not null unique,
    description varchar(50) not null
    );