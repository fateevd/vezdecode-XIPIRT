create
database Task_manager;


create table Tasks
(
    Id          INTEGER primary key unique AUTO_INCREMENT,
    Title       char(30) not null,
    Start_date  date     not null,
    Due_date    date     not null,
    Estimate HOUR not null,
    Description char(max) not null
)