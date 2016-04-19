drop table if exists Pokemons;
drop table if exists Users;
drop table if exists Historiques;
drop table if exists Types;
drop table if exists TypesPokemons;

create table Pokemons (
    idpkm integer not null primary key auto_increment,
    nom_pkm varchar(100) not null,
    prix double not null,
    qteStock integer not null,
    description varchar(2000)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table Users (
    idUser integer not null primary key auto_increment,
    login varchar(50) not null,
    mdp varchar(100) not null,
    name varchar(50) not null,
    firstname varchar(50) not null,
    adress varchar(100) not null,
    postCode varchar(23) not null,
    salt varchar(23) not null,
    admin varchar(50) not null, 
    CONSTRAINT loginUnique_Users UNIQUE (login)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table Panier (
    idUser integer not null,
    idpkm integer not null,
    qte integer not null,
    PRIMARY KEY (idpkm, idUser),
    CONSTRAINT fk_idpkmPanier FOREIGN KEY (idpkm)
REFERENCES Pokemons(idpkm),
    CONSTRAINT fk_idUserPanier FOREIGN KEY (idUser)
REFERENCES Users(idUser)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table Types (
    codeType varchar(100) not null primary key,
    type varchar(100)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table TypesPokemons (
    idpkm integer not null,
    type varchar(100) not null,
    PRIMARY KEY (idpkm, type),
    CONSTRAINT fk_idpkmTypesPokemons FOREIGN KEY (idpkm)
REFERENCES Pokemons(idpkm),
    CONSTRAINT fk_typeTypesPokemons FOREIGN KEY (type)
REFERENCES Types(codeType)
) engine=innodb character set utf8 collate utf8_unicode_ci;

