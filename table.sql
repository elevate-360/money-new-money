CREATE TABLE tblTransection (
    traId int primary key AUTO_INCREMENT,
    traTitle varchar(128) not null,
    traEntity varchar(128) not null,
    traAmount decimal(12,2) not null,
    traType char(1) not null,
    traMethod char(1) not null,
    traDate datetime default CURRENT_TIMESTAMP
);
