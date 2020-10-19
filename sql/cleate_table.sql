drop table request_table;
drop table time_details;
drop table club;
drop table time_table;

create table time_table (
    id int auto_increment primary key,
    time_num int,
    start_day date,
    end_day date,
    message varchar(10000)
    );

create table club (
    id int auto_increment primary key,
    club_name  varchar(30) unique,
    student_no int
    );

create table chat (
    id int auto_increment primary key,
    time_id int,
    time_no int,
    week int,
    club_id int,
    message varchar(10000),
    chat_time datetime,
    FOREIGN KEY (time_id) REFERENCES time_table(id)
    on delete cascade
    on update cascade,
    FOREIGN KEY (club_id) REFERENCES club(id)
    on delete cascade
    on update cascade
    );

create table time_details (
    time_id int,
    time_no int,
    week int,
    club_id int,
    start_time time,
    end_time time,
    primary key (time_id,time_no,week),
    FOREIGN KEY (time_id) REFERENCES time_table(id)
        on delete cascade
        on update cascade,
    FOREIGN KEY (club_id) REFERENCES club(id)
        on delete cascade
        on update cascade
    );

create table request_table (
    time_id int,
    time_no int,
    week int,
    club_id int,
    primary key (time_id,time_no,week,club_id),
    FOREIGN KEY (time_id) REFERENCES time_table(id)
        on delete cascade
        on update cascade,
    FOREIGN KEY (time_id,time_no,week) REFERENCES time_details(time_id,time_no,week)
        on delete cascade
        on update cascade,
    FOREIGN KEY (club_id) REFERENCES club(id)
        on delete cascade
        on update cascade
    );


