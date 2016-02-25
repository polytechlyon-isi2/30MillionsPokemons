<?php

// Return all articles
function getArticles() {
    $bdd = new PDO('mysql:host=localhost;dbname=30MillionsPokemons;charset=utf8', 'pokemons_user', 'secret');
    $articles = $bdd->query('select * from Pokemons order by nom_pkm desc');
    return $articles;
}