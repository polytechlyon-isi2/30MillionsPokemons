<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;

// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();

// Register service providers.
$app->register(new Silex\Provider\DoctrineServiceProvider());

// Register services.
$app['dao.pokemons'] = $app->share(function ($app) {
    return new 30MillionsPokemons\DAO\PokemonsDAO($app['db']);
});

/*$app['dao.users'] = $app->share(function ($app) {
    return new 30MillionsPokemons\DAO\UsersDAO($app['db']);
});

$app['dao.types'] = $app->share(function ($app) {
    return new 30MillionsPokemons\DAO\TypesDAO($app['db']);
});

$app['dao.historiques'] = $app->share(function ($app) {
    return new 30MillionsPokemons\DAO\HistoriquesDAO($app['db']);
});*/