<?php

/* Home page */
$app->get('/', function () use ($app) {
    $types = $app['dao.types']->findAll();
    return $app['twig']->render('index.html.twig', array('categories' => $types));
})->bind('home');

/* Category details */
$app->get('/category/{id}', function ($id) use ($app) {
    $allPokemons = " ";
    $types = $app['dao.types']->findAll();
    //$article = $app['dao.article']->find($id);
    //$comments = $app['dao.comment']->findAllByArticle($id);
    return $app['twig']->render('index.html.twig', array('categories' => $types));
})->bind('category');