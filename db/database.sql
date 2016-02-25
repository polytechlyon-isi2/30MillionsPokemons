create database if not exists 30MillionsPokemons character set utf8 collate utf8_unicode_ci;
use 30MillionsPokemons;

grant all privileges on 30MillionsPokemons.* to 'pokemons_user'@'localhost' identified by 'secret';
