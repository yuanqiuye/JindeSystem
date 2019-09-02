create table if not exists jinde(
    JID int not null AUTO_INCREMENT,
    RID varchar(50) not null,
    AID varchar(50),
    UID varchar(50) not null,
    SID int not null,
    finished bit DEFAULT 0,
    access_flag bit DEFAULT 1,
    applytime date not null,
    PRIMARY KEY(JID)
);

create table if not exists event(
    EID int NOT NULL AUTO_INCREMENT,
    JID int DEFAULT null UNIQUE,
    teacher varchar(50) not null,
    office varchar(50) not null, 
    wantday int not null,
    wanttime int not null,
    finished bit DEFAULT 0,
    PRIMARY KEY(EID)
);

create table if not exists appeal(
    AID int NOT NULL AUTO_INCREMENT,
    JID int DEFAULT null UNIQUE,
    description varchar(50) not null,
    PRIMARY KEY(AID)
);

