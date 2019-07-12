create table if not exists jinde(
    JID int not null AUTO_INCREMENT,
    YID varchar(50) not null,
    UID varchar(50) not null,
    SID int not null,
    applytime datetime not null DEFAULT now(),
    PRIMARY KEY(JID)
);

create table if not exists event(
    EID int NOT NULL AUTO_INCREMENT,
    JID int DEFAULT null,
    teacher varchar(50) not null,
    wantday int not null,
    wanttime int not null,
    finished bit DEFAULT 0,
    PRIMARY KEY(EID)
);

