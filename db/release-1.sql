begin;

create schema dw;

------------------------------------------------------------------------------------------------------------------------

create sequence dw.conta_id_seq
    as integer;

alter sequence dw.conta_id_seq owner to admin;

create table dw.conta
(
    id     serial constraint conta_pkey primary key,
    nome   varchar(255) not null,
    saldo  numeric      not null,
    status boolean      not null
);

alter table dw.conta
    owner to admin;

alter sequence dw.conta_id_seq owned by dw.conta.id;

------------------------------------------------------------------------------------------------------------------------

create sequence dw.tipo_movimento_id_seq
    as integer;

alter sequence dw.tipo_movimento_id_seq owner to admin;

create table dw.tipo_movimento
(
    id        serial constraint tipo_movimento_pkey primary key,
    cod       varchar(255) not null,
    descricao varchar(255) not null
);

alter table dw.tipo_movimento
    owner to admin;

alter sequence dw.tipo_movimento_id_seq owned by dw.tipo_movimento.id;

------------------------------------------------------------------------------------------------------------------------

create sequence dw.movimento_id_seq
    as integer;

alter sequence dw.movimento_id_seq owner to admin;

create table dw.movimento
(
    id                serial       constraint movimento_pkey primary key,
    id_tipo_movimento integer      not null constraint fk_tipimovimento_id references dw.tipo_movimento,
    id_conta_origem   integer      not null constraint fk_conta_origem_id references dw.conta,
    id_conta_destino  integer      constraint fk_conta_destino_id references dw.conta,
    descricao         varchar(255) not null,
    valor             numeric      not null,
    datahora          timestamp    not null
);

alter table dw.movimento
    owner to admin;

 alter sequence dw.movimento_id_seq owned by dw.movimento.id;

commit;

------------------------------------------------------------------------------------------------------------------------

begin;

insert into dw.tipo_movimento
values (nextval('dw.tipo_movimento_id_seq'), 'DEP', 'Depósito'),
       (nextval('dw.tipo_movimento_id_seq'), 'SQE', 'Saque'),
       (nextval('dw.tipo_movimento_id_seq'), 'TRS', 'Transferência');

commit;