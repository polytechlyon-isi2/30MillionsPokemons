<?php

/* Home page 
 * Display all categories */
$app->get('/', function () use ($app) {
    $types = $app['dao.types']->findAll();
    return $app['twig']->render('index.html.twig', array('categories' => $types));
})->bind('home');

/* Category details 
 * Display all articles of the category selected */
$app->get('/category/{id}', function ($id) use ($app) {
    $allPokemons = " ";
    return $app['twig']->render('category.html.twig', array('articles' => $allPokemons));
})->bind('category');