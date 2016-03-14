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
    login varchar(256) not null,
    mdp varchar(100) not null,
    salt varchar(23) not null,
    admin varchar(50) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

/* TODO : fix historiques db 
create table Historiques (
    historiqueId integer not null auto_increment,
    login varchar(100) not null,
    idpkm integer not null,
    dateAchat date not null,
    qteAchat integer not null,
    // >> Just historiqueId as Primary key ??? 
    PRIMARY KEY (historiqueId, login, idpkm, dateAchat),
    CONSTRAINT fk_loginHisto FOREIGN KEY (login)
REFERENCES Users(login),
    CONSTRAINT fk_idpkmHisto FOREIGN KEY (idpkm)
REFERENCES Pokemons(idpkm)
) engine=innodb character set utf8 collate utf8_unicode_ci;

*/

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

