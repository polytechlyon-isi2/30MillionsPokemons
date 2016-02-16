drop table if exists Pokemons;
drop table if exists Users;
drop table if exists Historiques;
drop table if exists Types;

create table Pokemons (
    idpkm integer not null primary key auto_increment,
    nom_pkm varchar(100) not null,
    prix double not null,
    qteStock integer not null,
    description varchar(2000)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table Users (
    login varchar(100) not null primary key,
    mdp varchar(100) not null,
    nom varchar(100),
    prenom varchar(100),
    mail varchar(100),
    adresse varchar(500),
    admin tinyint (1) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;
