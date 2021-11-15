create or replace schema looper_test_test collate utf8_general_ci;
use looper_test_test;

create or replace table exercise_statuses
(
    id   int         not null,
    name varchar(45) null,
    constraint id_UNIQUE
        unique (id)
);

alter table exercise_statuses
    add primary key (id);

create or replace table exercises
(
    id                 int auto_increment,
    title              varchar(45)   not null,
    exercise_status_id int default 0 not null,
    constraint id_UNIQUE
        unique (id),
    constraint fk_exercises_exercise_statuses1
        foreign key (exercise_status_id) references exercise_statuses (id)
            on update cascade on delete cascade
);

create or replace index fk_exercises_exercise_statuses1_idx
    on exercises (exercise_status_id);

alter table exercises
    add primary key (id);

create or replace table question_types
(
    id   int         not null,
    name varchar(45) not null,
    constraint id_UNIQUE
        unique (id)
);

alter table question_types
    add primary key (id);

create or replace table questions
(
    id               int auto_increment,
    label            varchar(45) not null,
    exercise_id      int         not null,
    question_type_id int         not null,
    constraint id_UNIQUE
        unique (id),
    constraint fk_Questions_Exercises
        foreign key (exercise_id) references exercises (id)
            on update cascade on delete cascade,
    constraint fk_questions_question_types1
        foreign key (question_type_id) references question_types (id)
            on update cascade on delete cascade
);

create or replace index fk_Questions_Exercises_idx
    on questions (exercise_id);

create or replace index fk_questions_question_types1_idx
    on questions (question_type_id);

alter table questions
    add primary key (id);

create or replace table takes
(
    id        int auto_increment,
    timestamp datetime not null,
    constraint id_UNIQUE
        unique (id)
);

alter table takes
    add primary key (id);

create or replace table answers
(
    take_id     int  not null,
    question_id int  not null,
    value       text not null,
    primary key (take_id, question_id),
    constraint fk_Takes_has_Questions_Questions1
        foreign key (question_id) references questions (id)
            on update cascade on delete cascade,
    constraint fk_Takes_has_Questions_Takes1
        foreign key (take_id) references takes (id)
            on update cascade on delete cascade
);

create or replace index fk_Takes_has_Questions_Questions1_idx
    on answers (question_id);

create or replace index fk_Takes_has_Questions_Takes1_idx
    on answers (take_id);

