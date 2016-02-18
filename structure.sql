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

create table Historiques (
    login varchar(100) not null,
    idpkm integer not null,
    dateAchat date not null,
    qteAchat integer not null,
    PRIMARY KEY (login, idpkm, dateAchat),
    CONSTRAINT fk_loginHisto FOREIGN KEY (login)
REFERENCES Users(login),
    CONSTRAINT fk_idpkmHisto FOREIGN KEY (idpkm)
REFERENCES Pokemons(idpkm)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table (
    idpkm integer not null,
    type ENUM('acier','combat','dragon','eau','electrique','fee','feu','glace','insecte','normal','plante','poison','psy','roche','sol','spectre','tenebre','vol'),
    PRIMARY KEY (idpkm, type),
    CONSTRAINT fk_idpkmType FOREIGN KEY (idpkm)
REFERENCES Pokemons(idpkm)    
) engine=innodb character set utf8 collate utf8_unicode_ci;

