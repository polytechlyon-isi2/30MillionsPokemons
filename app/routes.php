<?php

// Home page
$app->get('/', function () use ($app) {
    $pokemons = $app['dao.pokemons']->findAll();
    return $app['twig']->render('index.html.twig', array('pokemons' => $pokemons));
});