create table questions
(
    id integer primary key,
    author_id varchar(128),
    paper_id varchar(128),
    content varchar(10000),
    category integer,
    datetime timestamp,
    anonymous boolean
);

create table comments
(
    id integer primary key,
    author_id varchar(128),
    question_id integer,
    content varchar(10000),
    datetime timestamp,
    anonymous boolean
);

create table relations
(
    question_id intger,
    paper_id varchar(128)
);

insert into questions values(1, 'aaa', 'paper1', 'test1', 0, '2011-01-01 10:00:00', 'false');
insert into questions values(2, 'bbb', 'paper2', 'test2', 0, '2011-01-02 10:00:00', 'true');
insert into comments values(1, 'ccc', 1, 'test3', '2011-01-02 10:00:00', 'true');
insert into comments values(2, 'ddd', 2, 'test4', '2011-01-02 10:00:00', 'true');
insert into relations values(1, 'paper1');
insert into relations values(2, 'paper2');


